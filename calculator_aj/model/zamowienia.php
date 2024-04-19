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
            'Nová','V procese','Dokončená','Odoslaná','Zrušená','Čaká na platbu','Zaplatená','Vrátená','Odoslaná, ale neprijatá',
            'Potvrdená','Vo výrobe'
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
    OR poznamka LIKE '%$search%' 
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


        $html = "";

        // Adresa a Kontakt
        $valueOrderID = $data['orderNo'];
        $valueDatum = $data['dataDodania'];
        $valueMeno = $data['imie'];
        $valuePriezvisko = $data['nazwisko'];
        $valueEmail = $data['email'];
        $valueTelefon = $data['telefon'];
        $valueUlica = $data['ulica'];
        $valueMesto = $data['miasto'];
        $valuePCS = $data['kodPocztowy'];
        $valueUlicaIna = $data['ulicaInne'];
        $valueMestoIna = $data['miastoInne'];
        $valuePCSIna = $data['kodPocztowyInne'];
        $valueFirma = $data['nazwaFirmy']; // 
        $valueICO = $data['nip'];          //
        $valueKraj = $data['kraj'];
        $valuePoznamka = $data['poznamka'];

        $html .= '<div style="width: 100%; max-width: 600px; height: 40px; background: white;"></div>';

        $html .= '<div style="width: 100%; max-width: 600px; font-family: arial; border: 1px solid #efefef; margin: 40px auto 0 auto; padding: 5px;">';
        $html .= '<div style="background: #dbdbdb; padding: 10px; margin: 0 0 1px 0; font-weight: bold; text-align: center;"><div>Objednávka č.: ' . $valueOrderID . '</div></div>';
        $html .= '<div style="display: flex; margin: 0 0 1px 0; background: #f8f8f8;"><div style="width: 210px; background: #efefef; font-size: 0.9rem; font-weight: bold; text-transform: uppercase; padding: 10px 10px 10px 15px;">Meno:</div><div style="flex: 1; padding: 10px 15px 10px 15px;">' . $valueMeno . ' ' . $valuePriezvisko . '</div></div>';
        $html .= '<div style="display: flex; margin: 0 0 1px 0; background: #f8f8f8;"><div style="width: 210px; background: #efefef; font-size: 0.9rem; font-weight: bold; text-transform: uppercase; padding: 10px 10px 10px 15px;">Telefón:</div><div style="flex: 1; padding: 10px 15px 10px 15px;">' . $valueTelefon . '</div></div>';
        $html .= '<div style="display: flex; margin: 0 0 1px 0; background: #f8f8f8;"><div style="width: 210px; background: #efefef; font-size: 0.9rem; font-weight: bold; text-transform: uppercase; padding: 10px 10px 10px 15px;">E-mail:</div><div style="flex: 1; padding: 10px 15px 10px 15px;">' . $valueEmail . '</div></div>';
        $html .= '<div style="display: flex; margin: 0 0 1px 0; background: #f8f8f8;"><div style="width: 210px; background: #efefef; font-size: 0.9rem; font-weight: bold; text-transform: uppercase; padding: 10px 10px 10px 15px;">Adresa:</div><div style="flex: 1; padding: 10px 15px 10px 15px;">' . $valueUlica . ', ' . $valueMesto . ', ' . $valuePCS . '</div></div>';
        if (!empty($valueUlicaIna)) {
          $html .= '<div style="display: flex; margin: 0 0 1px 0; background: #f8f8f8;"><div style="width: 210px; background: #efefef; font-size: 0.9rem; font-weight: bold; text-transform: uppercase; padding: 10px 10px 10px 15px;">Adresa doručenia:</div><div style="flex: 1; padding: 10px 15px 10px 15px;">' . $valueUlicaIna . ', ' . $valueMestoIna . ', ' . $valuePCSIna . '</div></div>';
        }
        if (!empty($valueFirma)) {
          $html .= '<div style="display: flex; margin: 0 0 1px 0; background: #f8f8f8;"><div style="width: 210px; background: #efefef; font-size: 0.9rem; font-weight: bold; text-transform: uppercase; padding: 10px 10px 10px 15px;">Názov firmy:</div><div style="flex: 1; padding: 10px 15px 10px 15px;">' . $valueFirma . '</div></div>';
          $html .= '<div style="display: flex; margin: 0 0 1px 0; background: #f8f8f8;"><div style="width: 210px; background: #efefef; font-size: 0.9rem; font-weight: bold; text-transform: uppercase; padding: 10px 10px 10px 15px;">IČO:</div><div style="flex: 1; padding: 10px 15px 10px 15px;">' . $valueICO . '</div></div>';
        }
        $html .= '<div style="display: flex; margin: 0 0 1px 0; background: #f8f8f8;"><div style="width: 210px; background: #efefef; font-size: 0.9rem; font-weight: bold; text-transform: uppercase; padding: 10px 10px 10px 15px;">Kraj:</div><div style="flex: 1; padding: 10px 15px 10px 15px;">' . $valueKraj . '</div></div>';
        if (!empty($valuePoznamka)) {
          $html .= '<div style="display: flex; margin: 0 0 1px 0; background: #f8f8f8;"><div style="width: 210px; background: #efefef; font-size: 0.9rem; font-weight: bold; text-transform: uppercase; padding: 10px 10px 10px 15px;">Poznámka:</div><div style="flex: 1; padding: 10px 15px 10px 15px;">' . $valuePoznamka . '</div></div>';
        }
        $html .= '</div>';

        // Produkty
        $data = json_decode($data['produkty'], true);
        foreach ($data as $klic => $hodnota) {

            if ($hodnota['slugKsztaltu'] == 'konzoly') {

            $nazov = $hodnota['request']['konzoly-title'];
            $cena = $hodnota['request']['konzoly-price'];
            $farba = $hodnota['request']['konzoly-color'];
            $mnozstvo = $hodnota['request']['konzoly-count'];

            $html .= "<div style='width: 100%; max-width: 600px; font-family: arial; border: 1px solid #efefef; margin: 40px auto 0 auto; padding: 5px;'>";
            $html .= '<div style="background: #dbdbdb; padding: 10px; margin: 0 0 1px 0; font-weight: bold; text-align: center;"><div>Konzoly</div></div>';

            if (isset($nazov)) {
                $html .= '<div style="display: flex; margin: 0 0 1px 0; background: #f8f8f8;"><div style="width: 210px; background: #efefef; font-size: 0.9rem; font-weight: bold; text-transform: uppercase; padding: 10px 10px 10px 15px;">Názov:</div><div style="flex: 1; padding: 10px 15px 10px 15px;">' . $nazov . '</div></div>';
            }   
            if (isset($farba)) {
                $html .= '<div style="display: flex; margin: 0 0 1px 0; background: #f8f8f8;"><div style="width: 210px; background: #efefef; font-size: 0.9rem; font-weight: bold; text-transform: uppercase; padding: 10px 10px 10px 15px;">Farba:</div><div style="flex: 1; padding: 10px 15px 10px 15px;">' . $farba . '</div></div>';
            }   
            if (isset($cena)) {
                $html .= '<div style="display: flex; margin: 0 0 1px 0; background: #f8f8f8;"><div style="width: 210px; background: #efefef; font-size: 0.9rem; font-weight: bold; text-transform: uppercase; padding: 10px 10px 10px 15px;">Cena:</div><div style="flex: 1; padding: 10px 15px 10px 15px;">' . $cena . ' €</div></div>';
            }
            if (isset($mnozstvo)) {
                $html .= '<div style="display: flex; margin: 0 0 1px 0; background: #f8f8f8;"><div style="width: 210px; background: #efefef; font-size: 0.9rem; font-weight: bold; text-transform: uppercase; padding: 10px 10px 10px 15px;">Množstvo:</div><div style="flex: 1; padding: 10px 15px 10px 15px;">' . $mnozstvo . ' ks</div></div>';
            }

            $html .= '</div>';
            
            }
            elseif ($hodnota['slugKsztaltu'] == 'spoje') {

            $nazov = $hodnota['request']['spoje-title'];
            $cena = $hodnota['request']['spoje-price'];
            $mnozstvo = $hodnota['request']['spoje-count'];

            $html .= "<div style='width: 100%; max-width: 600px; font-family: arial; border: 1px solid #efefef; margin: 40px auto 0 auto; padding: 5px;'>";
            $html .= '<div style="background: #dbdbdb; padding: 10px; font-weight: bold; text-align: center;"><div>Spoje</div></div>';

            if (isset($nazov)) {
                $html .= '<div style="display: flex; margin: 0 0 1px 0; background: #f8f8f8;"><div style="width: 210px; background: #efefef; font-size: 0.9rem; font-weight: bold; text-transform: uppercase; padding: 10px 10px 10px 15px;">Názov:</div><div style="flex: 1; padding: 10px 15px 10px 15px;">' . $nazov . '</div></div>';
            }      
            if (isset($cena)) {
                $html .= '<div style="display: flex; margin: 0 0 1px 0; background: #f8f8f8;"><div style="width: 210px; background: #efefef; font-size: 0.9rem; font-weight: bold; text-transform: uppercase; padding: 10px 10px 10px 15px;">Cena:</div><div style="flex: 1; padding: 10px 15px 10px 15px;">' . $cena . ' €</div></div>';
            }
            if (isset($mnozstvo)) {
                $html .= '<div style="display: flex; margin: 0 0 1px 0; background: #f8f8f8;"><div style="width: 210px; background: #efefef; font-size: 0.9rem; font-weight: bold; text-transform: uppercase; padding: 10px 10px 10px 15px;">Množstvo:</div><div style="flex: 1; padding: 10px 15px 10px 15px;">' . $mnozstvo . ' ks</div></div>';
            }

            $html .= '</div>';

            }
            elseif ($hodnota['slugKsztaltu'] == 'doplnky') {

            $nazov = $hodnota['request']['doplnok-title'];
            $cena = $hodnota['request']['doplnok-price'];
            $mnozstvo = $hodnota['request']['doplnok-count'];

            $html .= "<div style='width: 100%; max-width: 600px; font-family: arial; border: 1px solid #efefef; margin: 40px auto 0 auto; padding: 5px;'>";
            $html .= '<div style="background: #dbdbdb; padding: 10px; font-weight: bold; text-align: center;"><div>Doplnky</div></div>';

            if (isset($nazov)) {
                $html .= '<div style="display: flex; margin: 0 0 1px 0; background: #f8f8f8;"><div style="width: 210px; background: #efefef; font-size: 0.9rem; font-weight: bold; text-transform: uppercase; padding: 10px 10px 10px 15px;">Názov:</div><div style="flex: 1; padding: 10px 15px 10px 15px;">' . $nazov . '</div></div>';
            }      
            if (isset($cena)) {
                $html .= '<div style="display: flex; margin: 0 0 1px 0; background: #f8f8f8;"><div style="width: 210px; background: #efefef; font-size: 0.9rem; font-weight: bold; text-transform: uppercase; padding: 10px 10px 10px 15px;">Cena:</div><div style="flex: 1; padding: 10px 15px 10px 15px;">' . $cena . ' €</div></div>';
            }
            if (isset($mnozstvo)) {
                $html .= '<div style="display: flex; margin: 0 0 1px 0; background: #f8f8f8;"><div style="width: 210px; background: #efefef; font-size: 0.9rem; font-weight: bold; text-transform: uppercase; padding: 10px 10px 10px 15px;">Množstvo:</div><div style="flex: 1; padding: 10px 15px 10px 15px;">' . $mnozstvo . ' ks</div></div>';
            }

            $html .= '</div>';

            }
            else {

            // Rozmery a mnozstvo
            $dlzka = $hodnota['request']['dlugosc'];
            $sirka = $hodnota['request']['szerokosc'];

            // Hrubky pre profil DOSKA a fasadna doska
            if ($hodnota['slugKsztaltu'] == 'deskaWall') {
                $hrubka = $hodnota['request']['gruboscRdzenia'];
            }
            if ($hodnota['slugKsztaltu'] == 'deska') {
                $hrubka = $hodnota['request']['gruboscRdzenia'];
            }

            // Vyska pre profil L a profil O
            if ($hodnota['slugKsztaltu'] == 'katownik' || $hodnota['slugKsztaltu'] == 'profilPrzelotowy') {
                $vyska = $hodnota['request']['wysokosc'];
            }

            // Vyska pre profil U
            if ($hodnota['slugKsztaltu'] == 'Ceownik') {
                $vyskaA = $hodnota['request']['wysokoscA'];
                $vyskaB = $hodnota['request']['wysokoscB'];
            }

            $mnozstvo = $hodnota['request']['liczbaSztuk'];
            
            // Ceny
            $cenaZaKus = $hodnota['cennik']['cenaZaSztukeNetto'];
            $cenaSpolu = $hodnota['cennik']['cenaZaWszystkieNetto'];

            // Nazvy materialov
            $material = $hodnota['nazwyMaterialow']['material'];
            $farba = $hodnota['nazwyMaterialow']['kolor'];
            $farbaSpecialna = $hodnota['nazwyMaterialow']['kolorColorIndividual'];
            $hrany = $hodnota['nazwyMaterialow']['wykonczenie'];
            $ukoncenia = $hodnota['nazwyMaterialow']['endings'];
            $spoje = $hodnota['nazwyMaterialow']['joints'];

            $html .= "<div style='width: 100%; max-width: 600px; font-family: arial; border: 1px solid #efefef; margin: 40px auto 0 auto; padding: 5px;'>";

                $html .= '<div style="background: #dbdbdb; padding: 10px; font-weight: bold; text-align: center;"><div>' . $hodnota['ksztalt'] . '</div></div>';


                $html .= '<div style="display: flex; margin: 1px 0 1px 0; background: #f8f8f8;"><div style="width: 210px; background: #efefef; font-size: 0.9rem; font-weight: bold; text-transform: uppercase; padding: 10px 10px 10px 15px;">Množstvo:</div><div style="flex: 1; padding: 10px 15px 10px 15px;">' . $mnozstvo . ' ks</div></div>';
                $html .= '<div style="display: flex; margin: 1px 0 1px 0; background: #f8f8f8;"><div style="width: 210px; background: #efefef; font-size: 0.9rem; font-weight: bold; text-transform: uppercase; padding: 10px 10px 10px 15px;">Cena za kus:</div><div style="flex: 1; padding: 10px 15px 10px 15px;">' . $cenaZaKus . ' €</div></div>';
                $html .= '<div style="display: flex; margin: 1px 0 1px 0; background: #f8f8f8;"><div style="width: 210px; background: #efefef; font-size: 0.9rem; font-weight: bold; text-transform: uppercase; padding: 10px 10px 10px 15px;">Cena spolu:</div><div style="flex: 1; padding: 10px 15px 10px 15px;">' . $cenaSpolu . ' €</div></div>';


                $html .= '<div style="padding: 5px 0 5px 0; text-align: center; font-size: 0.75rem; background: #efefef; color: #a5a5a5 !important; text-transform: uppercase; font-weight: bold; margin: 1px 0 1px 0;">Rozmery</div>';
                if (isset($dlzka)) {
                $html .= '<div style="display: flex; margin: 0 0 1px 0; background: #f8f8f8;"><div style="width: 210px; background: #efefef; font-size: 0.9rem; font-weight: bold; text-transform: uppercase; padding: 10px 10px 10px 15px;">Dĺžka:</div><div style="flex: 1; padding: 10px 15px 10px 15px;">' . $dlzka . ' cm</div></div>';
                }
                if (isset($sirka)) {
                $html .= '<div style="display: flex; margin: 0 0 1px 0; background: #f8f8f8;"><div style="width: 210px; background: #efefef; font-size: 0.9rem; font-weight: bold; text-transform: uppercase; padding: 10px 10px 10px 15px;">Šírka:</div><div style="flex: 1; padding: 10px 15px 10px 15px;">' . $sirka . ' cm</div></div>';
                }
                if (isset($hrubka) && $hodnota['slugKsztaltu'] == 'deskaWall') {
                $html .= '<div style="display: flex; margin: 0 0 1px 0; background: #f8f8f8;"><div style="width: 210px; background: #efefef; font-size: 0.9rem; font-weight: bold; text-transform: uppercase; padding: 10px 10px 10px 15px;">Hrúbka profilu DOSKA:</div><div style="flex: 1; padding: 10px 15px 10px 15px;">' . $hrubka . ' cm</div></div>';
                }
                if (isset($hrubka) && $hodnota['slugKsztaltu'] == 'deska') {
                $html .= '<div style="display: flex; margin: 0 0 1px 0; background: #f8f8f8;"><div style="width: 210px; background: #efefef; font-size: 0.9rem; font-weight: bold; text-transform: uppercase; padding: 10px 10px 10px 15px;">Hrúbka fasádnej dosky:</div><div style="flex: 1; padding: 10px 15px 10px 15px;">' . $hrubka . ' cm</div></div>';
                }
                if (isset($vyska) && $hodnota['slugKsztaltu'] == 'katownik') {
                $html .= '<div style="display: flex; margin: 0 0 1px 0; background: #f8f8f8;"><div style="width: 210px; background: #efefef; font-size: 0.9rem; font-weight: bold; text-transform: uppercase; padding: 10px 10px 10px 15px;">Výška:</div><div style="flex: 1; padding: 10px 15px 10px 15px;">' . $vyska . ' cm</div></div>';
                }
                if (isset($vyskaA) && $hodnota['slugKsztaltu'] == 'Ceownik') {
                $html .= '<div style="display: flex; margin: 0 0 1px 0; background: #f8f8f8;"><div style="width: 210px; background: #efefef; font-size: 0.9rem; font-weight: bold; text-transform: uppercase; padding: 10px 10px 10px 15px;">Výška A:</div><div style="flex: 1; padding: 10px 15px 10px 15px;">' . $vyskaA . ' cm</div></div>';
                }
                if (isset($vyskaB) && $hodnota['slugKsztaltu'] == 'Ceownik') {
                $html .= '<div style="display: flex; margin: 0 0 1px 0; background: #f8f8f8;"><div style="width: 210px; background: #efefef; font-size: 0.9rem; font-weight: bold; text-transform: uppercase; padding: 10px 10px 10px 15px;">Výška B:</div><div style="flex: 1; padding: 10px 15px 10px 15px;">' . $vyskaB . ' cm</div></div>';
                }
                if (isset($vyskaB) && $hodnota['slugKsztaltu'] == 'profilPrzelotowy') {
                $html .= '<div style="display: flex; margin: 0 0 1px 0; background: #f8f8f8;"><div style="width: 210px; background: #efefef; font-size: 0.9rem; font-weight: bold; text-transform: uppercase; padding: 10px 10px 10px 15px;">Výška:</div><div style="flex: 1; padding: 10px 15px 10px 15px;">' . $vyska . ' cm</div></div>';
                }

                if (isset($mnozstvo)) {
                $html .= '<div style="display: flex; margin: 0 0 1px 0; background: #f8f8f8;"><div style="width: 210px; background: #efefef; font-size: 0.9rem; font-weight: bold; text-transform: uppercase; padding: 10px 10px 10px 15px;">Množstvo:</div><div style="flex: 1; padding: 10px 15px 10px 15px;">' . $mnozstvo . ' ks</div></div>';
                }

                $html .= '<div style="padding: 5px 0 5px 0; text-align: center; font-size: 0.75rem; background: #efefef; color: #a5a5a5 !important; text-transform: uppercase; font-weight: bold; margin: 0 0 1px 0;">Materiály</div>';

                if (isset($material)) {
                $html .= '<div style="display: flex; margin: 0 0 1px 0; background: #f8f8f8;"><div style="width: 210px; background: #efefef; font-size: 0.9rem; font-weight: bold; text-transform: uppercase; padding: 10px 10px 10px 15px;">Material:</div><div style="flex: 1; padding: 10px 15px 10px 15px;">' . $material . '</div></div>';
                }
                if (isset($farba)) {
                $html .= '<div style="display: flex; margin: 0 0 1px 0; background: #f8f8f8;"><div style="width: 210px; background: #efefef; font-size: 0.9rem; font-weight: bold; text-transform: uppercase; padding: 10px 10px 10px 15px;">Farba</div><div style="flex: 1; padding: 10px 15px 10px 15px;">' . $farba . '</div></div>';
                }
                else {
                $html .= '<div style="display: flex; margin: 0 0 1px 0; background: #f8f8f8;"><div style="width: 210px; background: #efefef; font-size: 0.9rem; font-weight: bold; text-transform: uppercase; padding: 10px 10px 10px 15px;">Farba špeciálna</div><div style="flex: 1; padding: 10px 15px 10px 15px;">' . $farbaSpecialna . '</div></div>';
                }
                if (isset($hrany)) {
                $html .= '<div style="display: flex; margin: 0 0 1px 0; background: #f8f8f8;"><div style="width: 210px; background: #efefef; font-size: 0.9rem; font-weight: bold; text-transform: uppercase; padding: 10px 10px 10px 15px;">Úprava hrán</div><div style="flex: 1; padding: 10px 15px 10px 15px;">' . $hrany . '</div></div>';
                }
                if (isset($ukoncenia)) {
                $html .= '<div style="display: flex; margin: 0 0 1px 0; background: #f8f8f8;"><div style="width: 210px; background: #efefef; font-size: 0.9rem; font-weight: bold; text-transform: uppercase; padding: 10px 10px 10px 15px;">Ukončenia</div><div style="flex: 1; padding: 10px 15px 10px 15px;">' . $ukoncenia . '</div></div>';
                }
                if (isset($spoje)) {
                $html .= '<div style="display: flex; margin: 0 0 1px 0; background: #f8f8f8;"><div style="width: 210px; background: #efefef; font-size: 0.9rem; font-weight: bold; text-transform: uppercase; padding: 10px 10px 10px 15px;">Spoje</div><div style="flex: 1; padding: 10px 15px 10px 15px;">' . $spoje . '</div></div>';
                }

            }

            $html .= '</div>';
            $html .= '<div style="width: 100%; max-width: 600px; height: 40px; background: white;"></div>';
        }


        $email = $ustawienia -> getSettings('email');
        $sideTitle = wp_title();
        $sideDomain = "$_SERVER[HTTP_HOST]";

        // $headers[] = 'From: Nová objednávka '.$sideTitle.' <noreply@'.$sideDomain.'>';
        $headers[] = 'Content-Type: text/html; charset=UTF-8';
        $headers[] = 'From: Tramy.sk <info@'.$sideDomain.'>';

        wp_mail( $email, 'Máte novú objednávku Tramy.sk', $html, $headers);
        wp_mail( $valueEmail, 'Sumár vašej objednávky Tramy.sk', $html, $headers);
//        $this->sendMailToClient($data,$numerZamowienia);

        return $lastid = $this->wpdb->insert_id;
    }

//    public function sendMailToClient($data,$numerZamowienia){
//        // $numerZamowienia = 10;
//        $lang = new kalkulatorHcLanguage;
//        $email = $data['email'];
//        // $email = 'adrian.starczewski@hypercon.pl';
//        $sideTitle = wp_title();
//        $sideDomain = "$_SERVER[HTTP_HOST]";
//        $koszyk = $this -> getCard();
//        $to = $email;
//        $subject = $lang->getLanguage('zamowienie','Zamówienie').' '.$sideTitle.'';
//        $body = $lang->getLanguage('dziekujemyZaZlozenieZamowienia','Ďakujeme vám za vašu objednávku!').'<br>';
//        $body.='<br>'.$lang->getLanguage('twojNumerZamowienia','Vaše číslo objednávky je:').' <b>'.$numerZamowienia.'</b>';
//        $body.='<br><br>'.$lang->getLanguage('prosimyOKontakt','Budeme vás kontaktovat.');
//        $headers[] = 'Content-Type: text/html; charset=UTF-8';
//        $headers[] = 'From: Tramy.sk <info@'.$sideDomain.'>';
//        wp_mail( $to, $subject, $body, $headers );
//
//    }
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
    public function calcPriceUpravene($metry, $cena) {
      $lacznyKoszt = $metry * $cena;
      $lacznyKoszt = number_format($lacznyKoszt, 2, '.', '');
      return $lacznyKoszt;
    }
    
    public function calcPriceAll($cenaZasztuke, $liczbaSztuk, $cenaZaSpecFarby) {
    
        $lacznyKoszt = $cenaZasztuke * $liczbaSztuk + $cenaZaSpecFarby;
        $lacznyKoszt = number_format($lacznyKoszt, 2, '.', '');
        return $lacznyKoszt;
      }

      public function AddMaterialNameToCard($data){
        $materialyModel = new kalkulatorHcMaterial;
        if(isset($data['request']['material'])){

            $materialId = $data['request']['material'];
            $kolorId = $data['request']['kolor'];
            $wykonczenieId = $data['request']['wykonczenie'];

            $kolorColorIndividualId = $data['request']['kolorIndywidualny'];  // Add
            $jointsId = $data['request']['joints'];  // Add
            $kolorAkcesoriaId = $data['request']['kolorAkcesoria'];  // Add
            $kolorEndingsId = $data['request']['endings'];  // Add
            $kolordodatkoweZaslepkiId = $data['request']['dodatkoweZaslepki'];  // Add

            $doplnokPrice = $data['request']['doplnok-price'];

            
            $material = $materialyModel->getMaterial($materialId);
            $kolor = $materialyModel->getColor($kolorId);
            $wykonczenie = $materialyModel->getWykonczenie($wykonczenieId);

            $kolorColorIndividual = $materialyModel->getColorIndividual($kolorColorIndividualId);  // Add
            $joints = $materialyModel->getJoints($jointsId);  // Add
            $kolorAkcesoria = $materialyModel->getAccessories($kolorAkcesoriaId);  // Add
            $endings = $materialyModel->getEndings($kolorEndingsId);  // Add

            $data = [
                'material' => $material->tytul,
                'kolor' => $kolor->tytul,
                'wykonczenie'=> $wykonczenie->tytul,
                'kolorColorIndividual'=> $kolorColorIndividual->tytul,  // Add
                'endings'=> $endings->tytul,  // Add
                'joints'=> $joints->tytul,  // Add
                'dodatkoweZaslepki'=> $kolordodatkoweZaslepkiId,  // Add
                'kolorAkcesoria'=> $kolorAkcesoria->tytul,  // Add
                'doplnokSpojSirka'=> 111,  // Add
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
        
        // if(isset($dataDecode['dodatkoweZaslepki']['cena'])){
        //     $cenaZaZaslepke = (float)$dataDecode['dodatkoweZaslepki']['cena'];
        // }
        // echo "cenaZX:".$currentShape->data->dodatkoweZaslepki['cena'];
        $dlugosc = 0;
       
        // Profil U
        if ($data['slugKsztaltu'] == 'Ceownik') {
            $dodatkoweZaslepki = $data['request']['dodatkoweZaslepki'];
            $gruboscRdzenia = 2.5;
            $dlugosc = $data['request']['dlugosc'];
            $szerokosc = $data['request']['szerokosc'];
            $wysokoscA = $data['request']['wysokoscA'];
            $wysokoscB = $data['request']['wysokoscB'];
            $mnozstvo = $data['request']['liczbaSztuk'];
            $sucetMetrov = ($dlugosc * $szerokosc * $mnozstvo) / 10000;

            $pow1 = $this->pPow($dlugosc, $szerokosc); // gorna
            $pow2 = $this->pPow($dlugosc, $wysokoscA); // Wysokosc A PPole powierzchni
            $pow3 = $this->pPow($dlugosc, $wysokoscB); // Wysokosc A PPole powierzchni
            $pow4 = 0; // Wysokosc A PPole powierzchni
            // dodatkowe ozdobne krawędzie
            if (isset($data['request']['dodatkoweOzdobneKrawedzie'])) {
                $pow4 =  $this->pPow($dlugosc, $gruboscRdzenia) * 2; // Wysokosc A PPole powierzchni
            }
            $suma = $pow1 + $pow2 + $pow3 + $pow4;
            $suma = $suma/10000;

            // Specialna farba
            $specialnaFarbaId = $data['request']['kolorIndywidualny'];
            $specialnaFarbaCena = $materialyModel->getColorIndividual($specialnaFarbaId);
            $specialnaFarbaCena = $specialnaFarbaCena->price;
            $specialnaFarbaCena = $specialnaFarbaCena / 100;

            // Ukoncenia cena a pocet
            $ukonceniaPocet = $data['request']['dodatkoweZaslepki'];
            $ukonceniaId = $data['request']['endings'];
            $ukonceniaCena = $materialyModel->getEndings($ukonceniaId);
            $ukonceniaCena = $ukonceniaCena->price;
            
            // Upravene hrany
            $wykonczenieId = $data['request']['wykonczenie'];
            $wykonczeniePrice = $materialyModel->getWykonczenie($wykonczenieId);
            $wykonczeniePrice = $wykonczeniePrice->price;
            $wykonczeniePrice = $wykonczeniePrice / 100;

            // Spoje
            $spojeId = $data['request']['joints'];
            $spojePrice = $materialyModel->getJoints($spojeId);
            $spojePrice = $spojePrice->price;
            if ($mnozstvo >= 1) {
                $spojePocet = $mnozstvo -1;
            } else {
                $spojePocet = 0;
            }

            $cenaZaSztuke = $this->calcPriceUpravene($suma, $cena);
            $cenaPlusUkoncenia = ($cenaZaSztuke * $mnozstvo) + (($dlugosc * $specialnaFarbaCena) * $mnozstvo) + (($dlugosc * $wykonczeniePrice) * $mnozstvo) + ($spojePocet * $spojePrice) + (($ukonceniaPocet * $ukonceniaCena) * $mnozstvo);

        }

        // Fasadna doska
        if ($data['slugKsztaltu'] == 'deska') {
        
            $dlugosc = $data['request']['dlugosc'];
            $szerokosc = $data['request']['szerokosc'];
            $gruboscRdzenia = $data['request']['gruboscRdzenia'];
            $pow1 = $this->pPow($dlugosc, $szerokosc); // gora
            // $pow2 = $this->pPow($dlugosc, $gruboscRdzenia) * 2; // boki
            // $suma = $pow1 + $pow2;
            $mnozstvo = $data['request']['liczbaSztuk'];
            
            $suma = $pow1;
            $suma = $suma/10000;

            // Specialna farba
            $specialnaFarbaId = $data['request']['kolorIndywidualny'];
            $specialnaFarbaCena = $materialyModel->getColorIndividual($specialnaFarbaId);
            $specialnaFarbaCena = $specialnaFarbaCena->price;
            
            $sucetMetrov = ($dlugosc * $szerokosc * $mnozstvo) / 10000;
            $sucetMetrov = floor($sucetMetrov);

            // tutaj brakuje 
            $cenaZaSztuke = $this->calcPrice($suma, $cena, $dodatkoweZaslepki, $cenaZaZaslepke);
            $cenaPlusUkoncenia = ($cenaZaSztuke * $mnozstvo) + ($sucetMetrov * $specialnaFarbaCena);
      
        }
        
        // Profil DOSKA
        if ($data['slugKsztaltu'] == 'deskaWall') {
          
            $dlugosc = $data['request']['dlugosc']; // dlzka
            $szerokosc = $data['request']['szerokosc']; // sirka
            $gruboscRdzenia = $data['request']['gruboscRdzenia'];
            $pow1 = $this->pPow($dlugosc, $szerokosc); // gora
            // $pow2 = $this->pPow($dlugosc, $gruboscRdzenia) * 2; // boki
            // $suma = $pow1 + $pow2;
            $mnozstvo = $data['request']['liczbaSztuk'];
            // $sucetMetrov = ($dlugosc * $szerokosc * $mnozstvo) / 10000;
              
            $suma = $pow1;
            $suma = $suma/10000;

            // Specialna farba
            $specialnaFarbaId = $data['request']['kolorIndywidualny'];
            $specialnaFarbaCena = $materialyModel->getColorIndividual($specialnaFarbaId);
            $specialnaFarbaCena = $specialnaFarbaCena->price;
            $specialnaFarbaCena = $specialnaFarbaCena / 100;
            
            // Upravene hrany
            $wykonczenieId = $data['request']['wykonczenie'];
            $wykonczeniePrice = $materialyModel->getWykonczenie($wykonczenieId);
            $wykonczeniePrice = $wykonczeniePrice->price;
            $wykonczeniePrice = $wykonczeniePrice / 100;
            
            // tutaj brakuje 
            $cenaZaSztuke = $this->calcPrice($suma, $cena, $dodatkoweZaslepki, $cenaZaZaslepke);
            $cenaPlusUkoncenia = ($cenaZaSztuke * $mnozstvo) + (($dlugosc * $specialnaFarbaCena) * $mnozstvo) + (($dlugosc * $wykonczeniePrice) * $mnozstvo);
        
        }

        if ($data['slugKsztaltu'] == 'elastycznaimitacjadeski') {
        
            $dlugosc = $data['request']['dlugosc'];
            $szerokosc = $data['request']['szerokosc'];
            $gruboscRdzenia = $gruboscRdzenia = 2.5;
            $pow1 = $this->pPow($dlugosc, $szerokosc); // gora
            $pow2 = $this->pPow($dlugosc, $gruboscRdzenia) * 2; // boki
            $suma = $pow1 + $pow2;
            $suma = $suma/10000;
            // tutaj brakuje 
            $cenaZaSztuke = $this->calcPrice($suma, $cena, $dodatkoweZaslepki, $cenaZaZaslepke);
            $cenaZaWszystkie = $this->calcPriceAll($cenaZaSztuke, $data['request']['liczbaSztuk'], $data['request']['colorsSpecialPrice']);
            
      
        }

        if ($data['slugKsztaltu'] == 'elastycznaokleina') {
        
            $dlugosc = $data['request']['dlugosc'];
            $szerokosc = $data['request']['szerokosc'];
          
            $pow1 = $this->pPow($dlugosc, $szerokosc); // gora
           
            $suma = $pow1;
            $suma = $suma/10000;
            // tutaj brakuje 
            $cenaZaSztuke = $this->calcPrice($suma, $cena, $dodatkoweZaslepki, $cenaZaZaslepke);
            $cenaZaWszystkie = $this->calcPriceAll($cenaZaSztuke, $data['request']['liczbaSztuk'], $data['request']['colorsSpecialPrice']);
            
      
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
            $suma = $suma/10000;
            // tutaj brakuje 
            $cenaZaSztuke = $this->calcPrice($suma, $cena, $dodatkoweZaslepki, $cenaZaZaslepke);
            $cenaZaWszystkie = $this->calcPriceAll($cenaZaSztuke, $data['request']['liczbaSztuk'], $data['request']['colorsSpecialPrice']);
            
      
        }

        // Profil L
        if ($data['slugKsztaltu'] == 'katownik') {
            $gruboscRdzenia = 2.5;
            $dlugosc = $data['request']['dlugosc'];
            $szerokosc = $data['request']['szerokosc'];
            $wysokosc = $data['request']['wysokosc'];
            $mnozstvo = $data['request']['liczbaSztuk'];
            $sucetMetrov = ($dlugosc * $szerokosc * $mnozstvo) / 10000;

            $pow1 = $this->pPow($dlugosc, $szerokosc); // gora 
            $pow2 = $this->pPow($dlugosc, $wysokosc); // bok
            $pow3 = 0;
            if (isset($data['request']['dodatkoweOzdobneKrawedzie'])) {
            $pow3 = $this->pPow($dlugosc, $gruboscRdzenia) * 2; // Wysokosc A PPole powierzchni
            }
            $suma = $pow1 + $pow2 + $pow3;
            $suma = $suma/10000;

            // Specialna farba
            $specialnaFarbaId = $data['request']['kolorIndywidualny'];
            $specialnaFarbaCena = $materialyModel->getColorIndividual($specialnaFarbaId);
            $specialnaFarbaCena = $specialnaFarbaCena->price;
            $specialnaFarbaCena = $specialnaFarbaCena / 100;
            
            // Upravene hrany
            $wykonczenieId = $data['request']['wykonczenie'];
            $wykonczeniePrice = $materialyModel->getWykonczenie($wykonczenieId);
            $wykonczeniePrice = $wykonczeniePrice->price;
            $wykonczeniePrice = $wykonczeniePrice / 100;

            // Spoje
            $spojeId = $data['request']['joints'];
            $spojePrice = $materialyModel->getJoints($spojeId);
            $spojePrice = $spojePrice->price;
            if ($mnozstvo >= 1) {
                $spojePocet = $mnozstvo -1;
            } else {
                $spojePocet = 0;
            }

            $cenaZaSztuke = $this->calcPriceUpravene($suma, $cena);
            $cenaPlusUkoncenia = ($cenaZaSztuke * $mnozstvo) + (($dlugosc * $specialnaFarbaCena) * $mnozstvo) + (($dlugosc * $wykonczeniePrice) * $mnozstvo) + ($spojePocet * $spojePrice);

        }

        // Profil O
        if ($data['slugKsztaltu'] == 'profilPrzelotowy') {
            
            $gruboscRdzenia = 2.5;
            $dlugosc = $data['request']['dlugosc'];
            $szerokosc = $data['request']['szerokosc'];
            $wysokosc = $data['request']['wysokosc'];
            $mnozstvo = $data['request']['liczbaSztuk'];
            $sucetMetrov = ($dlugosc * $szerokosc * $mnozstvo) / 10000;

            $pow1 = $this->pPow($dlugosc, $szerokosc) * 2; // gora 
            $pow2 = $this->pPow($dlugosc, $wysokosc) * 2; // bok
            $suma = $pow1 + $pow2;
            $suma = $suma / 10000;

            // Specialna farba
            $specialnaFarbaId = $data['request']['kolorIndywidualny'];
            $specialnaFarbaCena = $materialyModel->getColorIndividual($specialnaFarbaId);
            $specialnaFarbaCena = $specialnaFarbaCena->price;
            $specialnaFarbaCena = $specialnaFarbaCena / 100;

            // Ukoncenia cena a pocet
            $ukonceniaPocet = $data['request']['dodatkoweZaslepki'];
            $ukonceniaId = $data['request']['endings'];
            $ukonceniaCena = $materialyModel->getEndings($ukonceniaId);
            $ukonceniaCena = $ukonceniaCena->price;
            
            // Upravene hrany
            $wykonczenieId = $data['request']['wykonczenie'];
            $wykonczeniePrice = $materialyModel->getWykonczenie($wykonczenieId);
            $wykonczeniePrice = $wykonczeniePrice->price;
            $wykonczeniePrice = $wykonczeniePrice / 100;

            // Spoje
            $spojeId = $data['request']['joints'];
            $spojePrice = $materialyModel->getJoints($spojeId);
            $spojePrice = $spojePrice->price;
            if ($mnozstvo >= 1) {
                $spojePocet = $mnozstvo -1;
            } else {
                $spojePocet = 0;
            }

            $cenaZaSztuke = $this->calcPriceUpravene($suma, $cena);
            $cenaPlusUkoncenia = ($cenaZaSztuke * $mnozstvo) + (($dlugosc * $specialnaFarbaCena) * $mnozstvo) + (($dlugosc * $wykonczeniePrice) * $mnozstvo) + ($spojePocet * $spojePrice) + (($ukonceniaPocet * $ukonceniaCena) * $mnozstvo);

        }

        // Doplnky
        if ($data['slugKsztaltu'] == 'doplnky') {
            $doplnokPrice = $data['request']['doplnok-price'];
            $doplnokCount = $data['request']['doplnok-count'];
            $suma = $doplnokPrice * $doplnokCount;
            $cenaZaSztuke = $suma;
            $cenaPlusUkoncenia = $suma;
        }

        // Spoje
        if ($data['slugKsztaltu'] == 'spoje') {
            $doplnokPrice = $data['request']['spoje-price'];
            $doplnokCount = $data['request']['spoje-count'];
            $suma = $doplnokPrice * $doplnokCount;
            $cenaZaSztuke = $suma;
            $cenaPlusUkoncenia = $suma;
        }

        // Konzoly
        if ($data['slugKsztaltu'] == 'konzoly') {
            $doplnokPrice = $data['request']['konzoly-price'];
            $doplnokCount = $data['request']['konzoly-count'];
            $suma = $doplnokPrice * $doplnokCount;
            $cenaZaSztuke = $suma;
            $cenaPlusUkoncenia = $suma;
        }


        

    
        $cenaZasztukeBrutto = $cenaZaSztuke * $podatekVat;
        $cenaZasztukeBrutto = number_format($cenaZasztukeBrutto, 2, '.', '');

        $cenaPlusUkonceniaBrutto = $cenaPlusUkoncenia * $podatekVat;
        $cenaPlusUkonceniaBrutto = number_format($cenaPlusUkonceniaBrutto, 2, '.', '');
    


        $dane = [
            'ileCenymetrowKwadratowych' => $suma,
            'cenaZaMetrNetto'=> $cena,
            'cenaZaMetrBrutto'=> $cenaBrutto,
            'cenaZaSztukeNetto' => $cenaZaSztuke,
            'cenaZaSztukeBrutto' => $cenaZasztukeBrutto,

            'cenaZaWszystkieNetto' => $cenaPlusUkoncenia, // Celkova cena bez DPH
            'cenaZaWszystkieBrutto' => $cenaPlusUkonceniaBrutto, // Celkova s DPH

            'mnozstvo' => $doplnokPrice, // Celkova s DPH
        ];
        return $dane;
    }
}






?>
