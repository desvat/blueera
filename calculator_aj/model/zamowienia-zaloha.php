<?php

/**
 * Model zamówień
 *
 * @author jakubca.com
 */
class kalkulatorHcZamowienia
{
 

   
    private $kalkulatorHcZamowienia_tablename;
    private $wpdb;
    private $listaStatusow;
    public function __construct()
    {
        global $wpdb;
        $prefix = $wpdb->prefix;
        $this->kalkulatorHcZamowienia_tablename = $prefix . "calculator_aj_zamowienia";
        $this->wpdb = $wpdb;
        $this->listaStatusow = [
            'Nový','V procese','Dokončený','Odoslaný','Zrušený','Čaká na platbu','Zaplatený','Vrátený','Odoslaný, ale neprijatý',
            'Potvrdené','Vo výrobe'
        ];
    }


//Zamowienia
public function updateOrder($data,$id)
{
    $this->wpdb->update($this->kalkulatorHcZamowienia_tablename, $data, $id);
}

public function getOrder($id)
{
    
    // $query = "SELECT * FROM  " . $this->kalkulatorHcZamowienia_tablename . " WHERE id = '$id' ORDER BY id DESC;";
    $query = "SELECT * FROM  " . $this->kalkulatorHcZamowienia_tablename . " WHERE id = $id";
    $order = $this->wpdb->get_row($query);

    return $order;
}

public function getOrders($offset,$no_of_records_per_page,$wybranyStatus,$search,$orderBy)
{
    if($wybranyStatus=="all"){
        $dodaj_status = '';
    }else{
        $dodaj_status = "AND status = '$wybranyStatus'";
    }
    $searchSql="(nazwaFirmy LIKE '%$search%' 
    OR telefon LIKE '%$search%' 
    OR imie LIKE '%$search%' 
    OR nazwisko LIKE '%$search%' 
    OR email LIKE '%$search%' 
    OR ulica LIKE '%$search%' 
    OR miasto LIKE '%$search%' 
    OR kodPocztowy LIKE '%$search%' 
    OR nip LIKE '%$search%' 
    OR kraj LIKE '%$search%' 
    OR orderNo LIKE '%$search%'
    )";
    // $query = "SELECT * FROM  " . $this->kalkulatorHcZamowienia_tablename . " WHERE id = '$id' ORDER BY id DESC;";
    $query = "SELECT * FROM  " . $this->kalkulatorHcZamowienia_tablename . " WHERE $searchSql $dodaj_status ORDER BY dataDodania $orderBy LIMIT $offset, $no_of_records_per_page;";
    $orders = $this->wpdb->get_results($query, ARRAY_A);

    return $orders;
}
public function getCountOrders()
{
    
    // $query = "SELECT * FROM  " . $this->kalkulatorHcZamowienia_tablename . " WHERE id = '$id' ORDER BY id DESC;";
    $query = "SELECT * FROM  " . $this->kalkulatorHcZamowienia_tablename . " ORDER BY dataDodania DESC;";
    $orders = $this->wpdb->get_results($query, ARRAY_A);

    return $orders;
}

public function getStatusy()
{
    return $this->listaStatusow;
  
}

// koszyk
    public function addToCard($data)
    {
        // 
        if(!isset($_SESSION['KHCkoszyk'])){
            $_SESSION['KHCkoszyk'] = [];
        }
            $this -> sortCard();
            array_push($_SESSION['KHCkoszyk'], $data);
           //adding price
           $this->cardWithPrice();
        
    }

    public function createCard(){
        if(!isset($_SESSION['KHCkoszyk'])){
            $_SESSION['KHCkoszyk'] = [];
        }
    }

    public function removeFromCard($element){
        
        unset($_SESSION['KHCkoszyk'][$element]);
        $this -> sortCard();
    }

    public function unsetCard(){
        
        unset($_SESSION['KHCkoszyk']);
        
    }
    
    public function sortCard(){

        $_SESSION['KHCkoszyk'] = array_values($_SESSION['KHCkoszyk']);

    }
    public function getCard(){
        if(isset($_SESSION['KHCkoszyk'])){
            $this->cardWithPrice();
            return $_SESSION['KHCkoszyk'];
        }
    }

    public function addOrder($data)
    {
        $numerZamowienia = $this->orderNo();
        $data['orderNo'] = $numerZamowienia;
        $ustawienia = new kalkulatorHcSettings;
       $this->wpdb->insert($this->kalkulatorHcZamowienia_tablename, $data);
       $email = $ustawienia -> getSettings('email');
       $sideTitle = wp_title();
       $sideDomain = "$_SERVER[HTTP_HOST]";
       $headers[] = 'From: Nová objednávka '.$sideTitle.' <noreply@'.$sideDomain.'>';
        wp_mail( $email, 'Máte novú objednávku', 'Na webovej stránke máte novú objednávku!', $headers);
        $this->sendMailToClient($data,$numerZamowienia);
        return $lastid = $this->wpdb->insert_id;
    }

    public function sendMailToClient($data,$numerZamowienia){
        // $numerZamowienia = 10;
        $lang = new kalkulatorHcLanguage;
        $email = $data['email'];
        // $email = 'adrian.starczewski@hypercon.pl';
        $sideTitle = wp_title();
        $sideDomain = "$_SERVER[HTTP_HOST]";
        $koszyk = $this -> getCard();
        $to = $email;
        $subject = $lang->getLanguage('zamowienie','Zamówienie').' '.$sideTitle.'';
        $body = $lang->getLanguage('dziekujemyZaZlozenieZamowienia','Ďakujeme vám za vašu objednávku!').'<br>';
        $body.='<br>'.$lang->getLanguage('twojNumerZamowienia','Vaše číslo objednávky je:').' <b>'.$numerZamowienia.'</b>';
        $body.='<br><br>'.$lang->getLanguage('prosimyOKontakt','Zavolajte nám a overte si vašu objednávku.');
        $headers[] = 'Content-Type: text/html; charset=UTF-8';
        $headers[] = 'From: Plastmaker <noreply@'.$sideDomain.'>';
        wp_mail( $to, $subject, $body, $headers );

    }
    public function orderNo(){
        $query = "SELECT MAX(orderNo) FROM  " . $this->kalkulatorHcZamowienia_tablename . "";
        // $order = $this->wpdb->get_row($query);
        $order = $this->wpdb->get_results($query, ARRAY_A);
        if($order == NULL){
            return 1;
        }else{
            if((int)$order[0]["MAX(orderNo)"] == NULL){
                return 1;
            }
            return (int)$order[0]["MAX(orderNo)"]+1;
        }
    }

    public function cardWithPrice(){
        if(isset($_SESSION['KHCkoszyk'])){
            $this->sortCard();
            foreach($_SESSION['KHCkoszyk'] as $numer => $produkt){

                $ksztalt = $produkt['slugKsztaltu'];
                $_SESSION['KHCkoszyk'][$numer]['cennik'] = $this->PowKsztaltu($produkt);
                $_SESSION['KHCkoszyk'][$numer]['nazwyMaterialow'] = $this->AddMaterialNameToCard($produkt);
                   
            }
            
            return $_SESSION['KHCkoszyk'];
        }



    }


    // funkcje obliczajace metry
    public function pPow($a, $b) {

        return $a * $b;
    
      }
    public function calcPrice($metry, $cena, $dodatkoweZaslepki, $cenaZaZaslepke) {
        $dodatkoweZaslepkiKoszt = $cenaZaZaslepke * $dodatkoweZaslepki;
        $lacznyKoszt = $metry * $cena + $dodatkoweZaslepkiKoszt;
        $lacznyKoszt = number_format($lacznyKoszt, 2, '.', '');
        return $lacznyKoszt;
      }
    
    public function calcPriceAll($cenaZasztuke, $liczbaSztuk) {
    
        $lacznyKoszt = $cenaZasztuke * $liczbaSztuk;
        $lacznyKoszt = number_format($lacznyKoszt, 2, '.', '');
        return $lacznyKoszt;
      }


      public function AddMaterialNameToCard($data){
        $materialyModel = new kalkulatorHcMaterial;
        if(isset($data['request']['material']) && isset($data['request']['kolor']) && isset($data['request']['wykonczenie']) && isset($data['request']['kolorIndywidualny'])  && isset($data['request']['kolorAkcesoria'])){
            $materialId = $data['request']['material'];
            $kolorId = $data['request']['kolor'];
            $wykonczenieId = $data['request']['wykonczenie'];
            $kolorIndywidualnyId = $data['request']['kolorIndywidualny'];                       // Add
            $kolorAkcesoriaId = $data['request']['kolorAkcesoria'];                             // Add
            $material = $materialyModel->getMaterial($materialId);
            $kolor = $materialyModel->getColor($kolorId);
            $wykonczenie = $materialyModel->getWykonczenie($wykonczenieId);
            $kolorIndywidualny = $materialyModel->getColorIndividual($kolorIndywidualnyId);     // Add
            $kolorAkcesoria = $materialyModel->getAccessories($kolorAkcesoriaId);               // Add
            $data = [
                'material' => $material->tytul,
                'kolor' => $kolor->tytul,
                'wykonczenie'=> $wykonczenie->tytul,
                'kolorIndywidualny'=> $kolorIndywidualny->tytul,                                // Add
                'kolorAkcesoria'=> $kolorAkcesoria->tytul,                                      // Add
            ];
            return $data;
          }
      }

      public function PowKsztaltu($data) {
        $materialyModel = new kalkulatorHcMaterial;
        $profileModel = new kalkulatorHcProfil;
        $ustawienia = new kalkulatorHcSettings;
        $idRelacji = $data['request']['id'];
        $currentShape = $profileModel -> khc_showAssignedShape($idRelacji);
       
        $dodatkoweZaslepki = 0;
        $podatek = $ustawienia -> getSettings('podatek');
        $podatek = $podatek/100;
        $podatekVat = 1+(float)$podatek;

        $cena = (float)$currentShape->cena;
        $cenaBrutto = number_format($cena * $podatekVat, 2, '.', '');
        $cenaZaZaslepke = 0;
        $dataCurrentShape = $currentShape->data;
        $dataDecode = json_decode($dataCurrentShape, true);
        
        if(isset($dataDecode['dodatkoweZaslepki']['cena'])){
            $cenaZaZaslepke = (float)$dataDecode['dodatkoweZaslepki']['cena'];
        }
        // echo "cenaZX:".$currentShape->data->dodatkoweZaslepki['cena'];
        $dlugosc = 0;
       
        //CEOWNIK
        if ($data['slugKsztaltu'] == 'Ceownik') {
          $dodatkoweZaslepki = $data['request']['dodatkoweZaslepki'];
          $gruboscRdzenia = 2.5;
          $dlugosc = $data['request']['dlugosc'];
          $szerokosc = $data['request']['szerokosc'];
          $wysokoscA = $data['request']['wysokoscA'];;
          $wysokoscB = $data['request']['wysokoscB'];;
          $pow1 = $this->pPow($dlugosc, $szerokosc); // gorna
          $pow2 = $this->pPow($dlugosc, $wysokoscA); // Wysokosc A PPole powierzchni
          $pow3 = $this->pPow($dlugosc, $wysokoscB); // Wysokosc A PPole powierzchni
          $pow4 = 0; // Wysokosc A PPole powierzchni
          // dodatkowe ozdobne krawędzie
          if (isset($data['request']['dodatkoweOzdobneKrawedzie'])) {
            $pow4 =  $this->pPow($dlugosc, $gruboscRdzenia) * 2; // Wysokosc A PPole powierzchni
          }
          $suma = $pow1 + $pow2 + $pow3 + $pow4;
    
    
        }
        // DESKA
        if ($data['slugKsztaltu'] == 'deska') {
        
            $dlugosc = $data['request']['dlugosc'];
            $szerokosc = $data['request']['szerokosc'];
            $gruboscRdzenia = $data['request']['gruboscRdzenia'];
            $pow1 = $this->pPow($dlugosc, $szerokosc); // gora
            $pow2 = $this->pPow($dlugosc, $gruboscRdzenia) * 2; // boki
            $suma = $pow1 + $pow2;
      
          }
          if ($data['slugKsztaltu'] == 'elastycznaimitacjadeski') {
        
            $dlugosc = $data['request']['dlugosc'];
            $szerokosc = $data['request']['szerokosc'];
            $gruboscRdzenia = $gruboscRdzenia = 2.5;
            $pow1 = $this->pPow($dlugosc, $szerokosc); // gora
            $pow2 = $this->pPow($dlugosc, $gruboscRdzenia) * 2; // boki
            $suma = $pow1 + $pow2;
      
          }
          if ($data['slugKsztaltu'] == 'elastycznaokleina') {
        
            $dlugosc = $data['request']['dlugosc'];
            $szerokosc = $data['request']['szerokosc'];
          
            $pow1 = $this->pPow($dlugosc, $szerokosc); // gora
           
            $suma = $pow1;
      
          }

          if ($data['slugKsztaltu'] == 'profilPelny') {
            
            $dodatkoweZaslepki = $data['request']['dodatkoweZaslepki'];
         
            $przekroj = $data['request']['przekroj'];
            $wartosci = explode("x", $przekroj);
            $dlugosc = $data['request']['dlugosc'];
           
            $wysokosc = (float)$wartosci[0];
            $szerokosc = (float)$wartosci[1];
            $pow1 = $this->pPow($dlugosc, $szerokosc); // gora 
            $pow2 = $this->pPow($dlugosc, $wysokosc) * 2; // gora 
            if (isset($data['request']['dodatkowaOzdobnaScianka'])) {
              $pow1 = $pow1 * 2; // Wysokosc A PPole powierzchni
            }
            //dodatkowa ozdobna scianka
            $suma = $pow1 + $pow2;
      
          }

        //katownik
        if ($data['slugKsztaltu'] == 'katownik') {
            $gruboscRdzenia = 2.5;
            $dlugosc = $data['request']['dlugosc'];
            $szerokosc = $data['request']['szerokosc'];
            $wysokosc = $data['request']['wysokosc'];
            $pow1 = $this->pPow($dlugosc, $szerokosc); // gora 
            $pow2 = $this->pPow($dlugosc, $wysokosc); // bok
            $pow3 = 0;
            if (isset($data['request']['dodatkoweOzdobneKrawedzie'])) {
            $pow3 = $this->pPow($dlugosc, $gruboscRdzenia) * 2; // Wysokosc A PPole powierzchni
            }
            $suma = $pow1 + $pow2 + $pow3;

        }
  //profilPrzelotowy
        if ($data['slugKsztaltu'] == 'profilPrzelotowy') {
            $dodatkoweZaslepki = $data['request']['dodatkoweZaslepki'];
            $gruboscRdzenia = 2.5;
            $dlugosc = $data['request']['dlugosc'];
            $szerokosc = $data['request']['szerokosc'];
            $wysokosc = $data['request']['wysokosc'];
            $pow1 = $this->pPow($dlugosc, $szerokosc) * 2; // gora 
            $pow2 = $this->pPow($dlugosc, $wysokosc) * 2; // bok


            $suma = $pow1 + $pow2;

        }
        $suma = $suma/10000;
        // tutaj brakuje 
        $cenaZaSztuke = $this->calcPrice($suma, $cena, $dodatkoweZaslepki, $cenaZaZaslepke);
      
        $cenaZaWszystkie = $this->calcPriceAll($cenaZaSztuke, $data['request']['liczbaSztuk']);

    
        $cenaZasztukeBrutto = $cenaZaSztuke * $podatekVat;
        $cenaZasztukeBrutto = number_format($cenaZasztukeBrutto, 2, '.', '');

        $cenaZaWszystkieBrutto = $cenaZaWszystkie * $podatekVat;
        $cenaZaWszystkieBrutto = number_format($cenaZaWszystkieBrutto, 2, '.', '');
    


        $dane = [
            'ileCenymetrowKwadratowych' => $suma,
            'cenaZaMetrNetto'=> $cena,
            'cenaZaMetrBrutto'=> $cenaBrutto,
            'cenaZaSztukeNetto' => $cenaZaSztuke,
            'cenaZaSztukeBrutto' => $cenaZasztukeBrutto,
            'cenaZaWszystkieNetto' => $cenaZaWszystkie,
            'cenaZaWszystkieBrutto' => $cenaZaWszystkieBrutto,

        ];
        return $dane;
    }
}






?>