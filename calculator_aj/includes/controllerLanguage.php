<?php
$bootstrap_path = KHC_PATH2 . 'css/bootstrap.min.css';
$css_patch = KHC_PATH2 . 'css/khc.css';
// $addColorGet = array('page' => 'calculator_aj_kolor_subcat_menu', 'do' => 'add');
// // Tytuł strony
// $khc_title_page = "Kolory";

$language = new kalkulatorHcLanguage;
if(isset($_POST['podatek'])){
    // $ustawienia -> setSettings(['wartosc'=>$_POST['podatek']],['nazwa'=>'podatek']);
    // $komunikatpodatek = 'Podatek został zaktualizowany!';
}
if(isset($_POST['submit'])){
    if(isset($_POST['profile'])){
        $language->setLanguage('profile',$_POST['profile']);
    }
    if(isset($_POST['brutto'])){
        $language->setLanguage('brutto',$_POST['brutto']);
    }
    if(isset($_POST['netto'])){
        $language->setLanguage('netto',$_POST['netto']);
    }
    if(isset($_POST['cenaBrutto'])){
        $language->setLanguage('cenaBrutto',$_POST['cenaBrutto']);
    }
    if(isset($_POST['cenaNetto'])){
        $language->setLanguage('cenaNetto',$_POST['cenaNetto']);
    }
    if(isset($_POST['cenaZaMetr'])){
        $language->setLanguage('CenaZaMetr',$_POST['cenaZaMetr']);
    }
    if(isset($_POST['cenaZaSztuke'])){
        $language->setLanguage('CenaZaSztuke',$_POST['cenaZaSztuke']);
    }
    if(isset($_POST['cenaZaWszystkie'])){
        $language->setLanguage('cenaZaWszystkie',$_POST['cenaZaWszystkie']);
    }
    if(isset($_POST['lacznieMetrow'])){
        $language->setLanguage('LacznieMetrow',$_POST['lacznieMetrow']);
    }
    if(isset($_POST['materialy'])){
        $language->setLanguage('materialy',$_POST['materialy']);
    }
    if(isset($_POST['kolory'])){
        $language->setLanguage('kolory',$_POST['kolory']);
    }
    if(isset($_POST['wykonczenia'])){
        $language->setLanguage('wykonczenia',$_POST['wykonczenia']);
    }
    if(isset($_POST['material'])){
        $language->setLanguage('material',$_POST['material']);
    }
    if(isset($_POST['kolor'])){
        $language->setLanguage('kolor',$_POST['kolor']);
    }
    if(isset($_POST['wykonczenie'])){
        $language->setLanguage('wykonczenie',$_POST['wykonczenie']);
    }
    if(isset($_POST['dodajDoKoszyka'])){
        $language->setLanguage('dodajDoKoszyka',$_POST['dodajDoKoszyka']);
    }
    if(isset($_POST['dodanoDoKoszyka'])){
        $language->setLanguage('dodanoDoKoszyka',$_POST['dodanoDoKoszyka']);
    }
    if(isset($_POST['koszykJestPusty'])){
        $language->setLanguage('koszykJestPusty',$_POST['koszykJestPusty']);
    }
    if(isset($_POST['zlozZamowienie'])){
        $language->setLanguage('zlozZamowienie',$_POST['zlozZamowienie']);
    }
    if(isset($_POST['usun'])){
        $language->setLanguage('usun',$_POST['usun']);
    }
    if(isset($_POST['dlugosc'])){
        $language->setLanguage('dlugosc',$_POST['dlugosc']);
    }
    if(isset($_POST['szerokosc'])){
        $language->setLanguage('szerokosc',$_POST['szerokosc']);
    }
    if(isset($_POST['wysokosc'])){
        $language->setLanguage('wysokosc',$_POST['wysokosc']);
    }
    if(isset($_POST['wysokoscA'])){
        $language->setLanguage('wysokoscA',$_POST['wysokoscA']);
    }
    if(isset($_POST['wysokoscB'])){
        $language->setLanguage('wysokoscB',$_POST['wysokoscB']);
    }
    if(isset($_POST['gruboscRdzenia'])){
        $language->setLanguage('gruboscRdzenia',$_POST['gruboscRdzenia']);
    }
    if(isset($_POST['przekroj'])){
        $language->setLanguage('przekroj',$_POST['przekroj']);
    }
    if(isset($_POST['liczbaSztuk'])){
        $language->setLanguage('liczbaSztuk',$_POST['liczbaSztuk']);
    }
    if(isset($_POST['dodatkoweZaslepki'])){
        $language->setLanguage('dodatkoweZaslepki',$_POST['dodatkoweZaslepki']);
    }
    if(isset($_POST['dodatkoweOzdobneKrawedzie'])){
        $language->setLanguage('dodatkoweOzdobneKrawedzie',$_POST['dodatkoweOzdobneKrawedzie']);
    }
    if(isset($_POST['dodatkowaOzdobnaScianka'])){
        $language->setLanguage('dodatkowaOzdobnaScianka',$_POST['dodatkowaOzdobnaScianka']);
    }
    if(isset($_POST['imie'])){
        $language->setLanguage('imie',$_POST['imie']);
    }
    if(isset($_POST['nazwisko'])){
        $language->setLanguage('nazwisko',$_POST['nazwisko']);
    }
    if(isset($_POST['email'])){
        $language->setLanguage('email',$_POST['email']);
    }
    if(isset($_POST['ulica'])){
        $language->setLanguage('ulica',$_POST['ulica']);
    }
    if(isset($_POST['miasto'])){
        $language->setLanguage('miasto',$_POST['miasto']);
    }
    if(isset($_POST['kodPocztowy'])){
        $language->setLanguage('kodPocztowy',$_POST['kodPocztowy']);
    }
    if(isset($_POST['telefon'])){
        $language->setLanguage('telefon',$_POST['telefon']);
    }
    if(isset($_POST['nazwaFirmy'])){
        $language->setLanguage('nazwaFirmy',$_POST['nazwaFirmy']);
    }
    if(isset($_POST['nip'])){
        $language->setLanguage('nip',$_POST['nip']);
    }
    if(isset($_POST['kraj'])){
        $language->setLanguage('kraj',$_POST['kraj']);
    }
    if(isset($_POST['informacjaDlaSprzedajacego'])){
        $language->setLanguage('informacjaDlaSprzedajacego',$_POST['informacjaDlaSprzedajacego']);
    }
    if(isset($_POST['zamow'])){
        $language->setLanguage('zamow',$_POST['zamow']);
    }
    if(isset($_POST['podziekowanie'])){
        $language->setLanguage('podziekowanie',$_POST['podziekowanie']);
    }
    if(isset($_POST['dziekujemyZaZlozenieZamowienia'])){
        $language->setLanguage('dziekujemyZaZlozenieZamowienia',$_POST['dziekujemyZaZlozenieZamowienia']);
    }
    if(isset($_POST['twojNumerZamowienia'])){
        $language->setLanguage('twojNumerZamowienia',$_POST['twojNumerZamowienia']);
    }
    if(isset($_POST['prosimyOKontakt'])){
        $language->setLanguage('prosimyOKontakt',$_POST['prosimyOKontakt']);
    }
    if(isset($_POST['tak'])){
        $language->setLanguage('tak',$_POST['tak']);
    }
    if(isset($_POST['brak'])){
        $language->setLanguage('brak',$_POST['brak']);
    }
    if(isset($_POST['zamowienie'])){
        $language->setLanguage('zamowienie',$_POST['zamowienie']);
    }
    if(isset($_POST['firma'])){
        $language->setLanguage('firma',$_POST['firma']);
    }
    if(isset($_POST['akceptujeRegulamin'])){
        $language->setLanguage('akceptujeRegulamin',$_POST['akceptujeRegulamin']);
    }
    if(isset($_POST['akceptujePolityke'])){
        $language->setLanguage('akceptujePolityke',$_POST['akceptujePolityke']);
    }
    if(isset($_POST['zobacz'])){
        $language->setLanguage('zobacz',$_POST['zobacz']);
    }
    if(isset($_POST['innyAdress'])){
        $language->setLanguage('innyAdress',$_POST['innyAdress']);
    }
    if(isset($_POST['koszykKalkulatora'])){
        $language->setLanguage('koszykKalkulatora',$_POST['koszykKalkulatora']);
    }
}
?>
<link rel="stylesheet" href="<?php echo $bootstrap_path; ?>">
<link rel="stylesheet" href="<?php echo $css_patch; ?>">
<div class="container khc-container">
<h4 class="khc_title">Jazyk</h4>

        


        <form method="POST">
            <div class="form-group mt-5">
                <label for="InputProfile">Profile</label>
                <input type="text" name="profile" class="form-control" id="InputProfile" placeholder="" value="<?php $language->getLanguageInCms('profile');?>">       
            </div>
            <div class="form-group mt-5">
                <label for="InputkoszykKalkulatora">Koszyk kalkulatora</label>
                <input type="text" name="koszykKalkulatora" class="form-control" id="koszykKalkulatora" placeholder="" value="<?php $language->getLanguageInCms('koszykKalkulatora');?>">       
            </div>
            
            <div class="form-group mt-1">
                <label for="InputNetto">Netto</label>
                <input type="text" name="netto" class="form-control" id="InputNetto" placeholder="" value="<?php $language->getLanguageInCms('netto');?>">       
            </div>
            <div class="form-group mt-1">
                <label for="InputBrutto">Brutto</label>
                <input type="text" name="brutto" class="form-control" id="InputBrutto" placeholder="" value="<?php $language->getLanguageInCms('brutto');?>">       
            </div>
            <div class="form-group mt-1">
                <label for="InputCenaNetto">Cena netto</label>
                <input type="text" name="cenaNetto" class="form-control" id="InputCenaNetto" placeholder="" value="<?php $language->getLanguageInCms('cenaNetto');?>">       
            </div>
            <div class="form-group mt-1">
                <label for="InputCenaBrutto">Cena brutto</label>
                <input type="text" name="cenaBrutto" class="form-control" id="InputCenaBrutto" placeholder="" value="<?php $language->getLanguageInCms('cenaBrutto');?>">       
            </div>
            <div class="form-group mt-1">
                <label for="InputCenaZaMetr">Cena za metr</label>
                <input type="text" name="cenaZaMetr" class="form-control" id="InputCenaZaMetr" placeholder="" value="<?php $language->getLanguageInCms('cenaZaMetr');?>">
                <!-- <small class="form-text text-muted">Adres e-mail na który mają dochodzić powiadomienia</small> -->
            </div>
            <div class="form-group mt-1">
                <label for="InputCenaZaMetr">Cena za sztukę</label>
                <input type="text" name="cenaZaSztuke" class="form-control" id="InputCenaZaSztuke" placeholder="" value="<?php $language->getLanguageInCms('cenaZaSztuke');?>">       
            </div>
            <div class="form-group mt-1">
                <label for="InputCenaZaWszystkie">Cena za wszystkie</label>
                <input type="text" name="cenaZaWszystkie" class="form-control" id="InputCenaZaWszystkie" placeholder="" value="<?php $language->getLanguageInCms('cenaZaWszystkie');?>">       
            </div>
            <div class="form-group mt-1">
                <label for="InputLacznieMetrow">Łącznie metrów</label>
                <input type="text" name="lacznieMetrow" class="form-control" id="InputLacznieMetrow" placeholder="" value="<?php $language->getLanguageInCms('lacznieMetrow');?>">       
            </div>
            <div class="form-group mt-1">
                <label for="InputMaterialy">Materiały</label>
                <input type="text" name="materialy" class="form-control" id="InputMaterialy" placeholder="" value="<?php $language->getLanguageInCms('materialy');?>">       
            </div>
            <div class="form-group mt-1">
                <label for="InputMaterial">Materiał</label>
                <input type="text" name="material" class="form-control" id="InputMaterial" placeholder="" value="<?php $language->getLanguageInCms('material');?>">       
            </div>
            <div class="form-group mt-1">
                <label for="InputKolory">Kolory</label>
                <input type="text" name="kolory" class="form-control" id="InputKolory" placeholder="" value="<?php $language->getLanguageInCms('kolory');?>">       
            </div>
            <div class="form-group mt-1">
                <label for="InputKolor">Kolor</label>
                <input type="text" name="kolor" class="form-control" id="InputKolor" placeholder="" value="<?php $language->getLanguageInCms('kolor');?>">       
            </div>
            <div class="form-group mt-1">
                <label for="InputWykonczenia">Wykończenia</label>
                <input type="text" name="wykonczenia" class="form-control" id="InputWykonczenia" placeholder="" value="<?php $language->getLanguageInCms('wykonczenia');?>">       
            </div>
            <div class="form-group mt-1">
                <label for="InputWykonczenie">Wykończenie</label>
                <input type="text" name="wykonczenie" class="form-control" id="InputWykonczenie" placeholder="" value="<?php $language->getLanguageInCms('wykonczenie');?>">       
            </div>
            <div class="form-group mt-1">
                <label for="InputDodajDoKoszyka">Dodaj do koszyka</label>
                <input type="text" name="dodajDoKoszyka" class="form-control" id="InputDodajDoKoszyka" placeholder="" value="<?php $language->getLanguageInCms('dodajDoKoszyka');?>">       
            </div>
            <div class="form-group mt-1">
                <label for="InputDodanoDoKoszyka">Dodano do koszyka!</label>
                <input type="text" name="dodanoDoKoszyka" class="form-control" id="InputDodanoDoKoszyka" placeholder="" value="<?php $language->getLanguageInCms('dodanoDoKoszyka');?>">       
            </div>
            <div class="form-group mt-1">
                <label for="InputKoszykJestPusty">Koszyk jest pusty</label>
                <input type="text" name="koszykJestPusty" class="form-control" id="InputKoszykJestPusty" placeholder="" value="<?php $language->getLanguageInCms('koszykJestPusty');?>">       
            </div>
            <div class="form-group mt-1">
                <label for="InputZlozZamowienie">Złóż zamówienie</label>
                <input type="text" name="zlozZamowienie" class="form-control" id="InputZlozZamowienie" placeholder="" value="<?php $language->getLanguageInCms('zlozZamowienie');?>">       
            </div>
            <div class="form-group mt-1">
                <label for="InputUsun">Usuń</label>
                <input type="text" name="usun" class="form-control" id="InputUsun" placeholder="" value="<?php $language->getLanguageInCms('usun');?>">       
            </div>
            <!-- profile -->
            <div class="form-group mt-1">
                <label for="InputDlugosc">Długość</label>
                <input type="text" name="dlugosc" class="form-control" id="InputDlugosc" placeholder="" value="<?php $language->getLanguageInCms('dlugosc');?>">       
            </div>
            <div class="form-group mt-1">
                <label for="InputSzerokosc">Szerokość</label>
                <input type="text" name="szerokosc" class="form-control" id="InputSzerokosc" placeholder="" value="<?php $language->getLanguageInCms('szerokosc');?>">       
            </div>
            <div class="form-group mt-1">
                <label for="InputWysokosc">Wysokość</label>
                <input type="text" name="wysokosc" class="form-control" id="InputWysokosc" placeholder="" value="<?php $language->getLanguageInCms('wysokosc');?>">       
            </div>
            <div class="form-group mt-1">
                <label for="InputWysokoscA">Wysokość A</label>
                <input type="text" name="wysokoscA" class="form-control" id="InputWysokoscA" placeholder="" value="<?php $language->getLanguageInCms('wysokoscA');?>">       
            </div>
            <div class="form-group mt-1">
                <label for="InputWysokoscB">Wysokość B</label>
                <input type="text" name="wysokoscB" class="form-control" id="InputWysokoscB" placeholder="" value="<?php $language->getLanguageInCms('wysokoscB');?>">       
            </div>
            <div class="form-group mt-1">
                <label for="InputGruboscRdzenia">Hrúbka jadra</label>
                <input type="text" name="gruboscRdzenia" class="form-control" id="InputGruboscRdzenia" placeholder="" value="<?php $language->getLanguageInCms('gruboscRdzenia');?>">       
            </div>
            <div class="form-group mt-1">
                <label for="InputPrzekroj">Przekrój</label>
                <input type="text" name="przekroj" class="form-control" id="InputPrzekroj" placeholder="" value="<?php $language->getLanguageInCms('przekroj');?>">       
            </div>
            <div class="form-group mt-1">
                <label for="InputLiczbaSztuk">Liczba sztuk</label>
                <input type="text" name="liczbaSztuk" class="form-control" id="InputLiczbaSztuk" placeholder="" value="<?php $language->getLanguageInCms('liczbaSztuk');?>">       
            </div>
            <div class="form-group mt-1">
                <label for="InputDodatkoweZaslepki">Dodatkowe zaślepki</label>
                <input type="text" name="dodatkoweZaslepki" class="form-control" id="InputDodatkoweZaslepki" placeholder="" value="<?php $language->getLanguageInCms('dodatkoweZaslepki');?>">       
            </div>
            <div class="form-group mt-1">
                <label for="InputDodatkoweOzdobneKrawedzie">Dodatkowe ozdobne krawędzie</label>
                <input type="text" name="dodatkoweOzdobneKrawedzie" class="form-control" id="InputDodatkoweOzdobneKrawedzie" placeholder="" value="<?php $language->getLanguageInCms('dodatkoweOzdobneKrawedzie');?>">       
            </div>
            <div class="form-group mt-1">
                <label for="InputDodatkowaOzdobnaScianka">Dodatkowa ozdobna ścianka</label>
                <input type="text" name="dodatkowaOzdobnaScianka" class="form-control" id="InputDodatkowaOzdobnaScianka" placeholder="" value="<?php $language->getLanguageInCms('dodatkowaOzdobnaScianka');?>">       
            </div>
            <div class="form-group mt-1">
                <label for="InputTak">Tak</label>
                <input type="text" name="tak" class="form-control" id="InputTak" placeholder="" value="<?php $language->getLanguageInCms('tak');?>">       
            </div>
            <div class="form-group mt-1">
                <label for="InputBrak">Brak</label>
                <input type="text" name="brak" class="form-control" id="InputBrak" placeholder="" value="<?php $language->getLanguageInCms('brak');?>">       
            </div>
            <!-- koniec profili -->
            <!-- Dane kontaktowe -->
            <div class="form-group mt-1">
                <label for="InputImie">Imię</label>
                <input type="text" name="imie" class="form-control" id="InputImie" placeholder="" value="<?php $language->getLanguageInCms('imie');?>">       
            </div>
            <div class="form-group mt-1">
                <label for="InputNazwisko">Nazwisko</label>
                <input type="text" name="nazwisko" class="form-control" id="InputNazwisko" placeholder="" value="<?php $language->getLanguageInCms('nazwisko');?>">       
            </div>
            <div class="form-group mt-1">
                <label for="InputEmail">E-mail</label>
                <input type="text" name="email" class="form-control" id="InputEmail" placeholder="" value="<?php $language->getLanguageInCms('email');?>">       
            </div>
            <div class="form-group mt-1">
                <label for="InputUlica">Ulica</label>
                <input type="text" name="ulica" class="form-control" id="InputUlica" placeholder="" value="<?php $language->getLanguageInCms('ulica');?>">       
            </div>
            <div class="form-group mt-1">
                <label for="InputMiasto">Miasto</label>
                <input type="text" name="miasto" class="form-control" id="InputMiasto" placeholder="" value="<?php $language->getLanguageInCms('miasto');?>">       
            </div>
            <div class="form-group mt-1">
                <label for="InputKodPocztowy">Kod pocztowy</label>
                <input type="text" name="kodPocztowy" class="form-control" id="InputKodPocztowy" placeholder="" value="<?php $language->getLanguageInCms('kodPocztowy');?>">       
            </div>
            <div class="form-group mt-1">
                <label for="InputTelefon">Telefon</label>
                <input type="text" name="telefon" class="form-control" id="InputTelefon" placeholder="" value="<?php $language->getLanguageInCms('telefon');?>">       
            </div>
            <div class="form-group mt-1">
                <label for="InputFirma">Firma</label>
                <input type="text" name="firma" class="form-control" id="InputFirma" placeholder="" value="<?php $language->getLanguageInCms('firma');?>">       
            </div>
            <div class="form-group mt-1">
                <label for="InputNazwaFirmy">Názov firmy</label>
                <input type="text" name="nazwaFirmy" class="form-control" id="InputNazwaFirmy" placeholder="" value="<?php $language->getLanguageInCms('nazwaFirmy');?>">       
            </div>
            <div class="form-group mt-1">
                <label for="InputNip">IČO</label>
                <input type="text" name="nip" class="form-control" id="InputNip" placeholder="" value="<?php $language->getLanguageInCms('nip');?>">       
            </div>
            <div class="form-group mt-1">
                <label for="InputKraj">Kraj</label>
                <input type="text" name="kraj" class="form-control" id="InputKraj" placeholder="" value="<?php $language->getLanguageInCms('kraj');?>">       
            </div>
            <div class="form-group mt-1">
                <label for="innyAdress">Iná adresa na doručenie</label>
                <input type="text" name="innyAdress" class="form-control" id="innyAdress" placeholder="" value="<?php $language->getLanguageInCms('innyAdress');?>">       
            </div>
            <div class="form-group mt-1">
                <label for="InputInformacjaDlaSprzedajacego">Informácie pre predávajúceho</label>
                <input type="text" name="informacjaDlaSprzedajacego" class="form-control" id="InputInformacjaDlaSprzedajacego" placeholder="" value="<?php $language->getLanguageInCms('informacjaDlaSprzedajacego');?>">       
            </div>
            <div class="form-group mt-1">
                <label for="InputZamow">Objednať</label>
                <input type="text" name="zamow" class="form-control" id="InputZamow" placeholder="" value="<?php $language->getLanguageInCms('zamow');?>">       
            </div>
            <div class="form-group mt-1">
                <label for="InputZamowienie">Objednávka</label>
                <input type="text" name="zamowienie" class="form-control" id="InputZamowienie" placeholder="" value="<?php $language->getLanguageInCms('zamowienie');?>">       
            </div>
            <div class="form-group mt-1">
                <label for="InputPodziekowanie">Ďakujeme! Vaša objednávka bola odoslaná!</label>
                <input type="text" name="podziekowanie" class="form-control" id="InputPodziekowanie" placeholder="" value="<?php $language->getLanguageInCms('podziekowanie');?>">       
            </div>
            <div class="form-group mt-1">
                <label for="InputDziekujemyZaZlozenieZamowienia">Ďakujeme vám za vašu objednávku!</label>
                <input type="text" name="dziekujemyZaZlozenieZamowienia" class="form-control" id="InputDziekujemyZaZlozenieZamowienia" placeholder="" value="<?php $language->getLanguageInCms('dziekujemyZaZlozenieZamowienia');?>">       
            </div>
            <div class="form-group mt-1">
                <label for="InputTwojNumerZamowienia">Vaše číslo objednávky je:</label>
                <input type="text" name="twojNumerZamowienia" class="form-control" id="InputTwojNumerZamowienia" placeholder="" value="<?php $language->getLanguageInCms('twojNumerZamowienia');?>">       
            </div>
            <div class="form-group mt-1">
                <label for="InputProsimyOKontakt">Zavolajte nám a overte si vašu objednávku.</label>
                <input type="text" name="prosimyOKontakt" class="form-control" id="InputProsimyOKontakt" placeholder="" value="<?php $language->getLanguageInCms('prosimyOKontakt');?>">       
            </div>
            <div class="form-group mt-1">
                <label for="InputAkceptujeRegulamin">Súhlasím s podmienkami</label>
                <input type="text" name="akceptujeRegulamin" class="form-control" id="InputAkceptujeRegulamin" placeholder="" value="<?php $language->getLanguageInCms('akceptujeRegulamin');?>">       
            </div>
            <div class="form-group mt-1">
                <label for="InputAkceptujePolityke">Súhlasím so zásadami ochrany osobných údajov na webovej stránke</label>
                <input type="text" name="akceptujePolityke" class="form-control" id="InputAkceptujePolityke" placeholder="" value="<?php $language->getLanguageInCms('akceptujePolityke');?>">       
            </div>
            <div class="form-group mt-1">
                <label for="InputZobacz">Zobraziť</label>
                <input type="text" name="zobacz" class="form-control" id="InputZobacz" placeholder="" value="<?php $language->getLanguageInCms('zobacz');?>">       
            </div>
            <!-- Koniec dane kontaktowe -->
            <button name="submit" type="submit" class="btn btn-primary">Aktualizovať</button>
        </form>
       

  
</div>