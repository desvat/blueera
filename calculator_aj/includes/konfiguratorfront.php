<?php
$show_dodatkowaOzdobnaScianka == TRUE;

//// wyswietlanie konfiguratora
$profil = new kalkulatorHcProfil;
$material = new kalkulatorHcMaterial();
$zamowienia = new kalkulatorHcZamowienia;
$ustawienia = new kalkulatorHcSettings;
$lang = new kalkulatorHcLanguage;

$waluta = $ustawienia->getSettings('waluta');
$miejsceWaluty = $ustawienia->getSettings('miejsceWaluty');
$konfiguracjaWalutaRight = "";
$konfiguracjaWalutaLeft = "";
if ($miejsceWaluty == 'right') {
    $konfiguracjaWalutaRight = $waluta;
    $konfiguracjaWalutaLeft = "";
}
if ($miejsceWaluty == 'rightSpace') {
    $konfiguracjaWalutaRight = ' ' . $waluta;
    $konfiguracjaWalutaLeft = "";
}
if ($miejsceWaluty == 'left') {
    $konfiguracjaWalutaLeft = $waluta;
    $konfiguracjaWalutaRight = "";
}
if ($miejsceWaluty == 'leftSpace') {
    $konfiguracjaWalutaLeft = $waluta . ' ';
    $konfiguracjaWalutaRight = "";
}
$id_relacji = (int)$_GET['id'];
$ksztalt = $profil->khc_showAssignedShape($id_relacji);
if ($ksztalt == NULL || !isset($_GET['id'])) {
    $konfiguracjaLink = array('action' => 'home');
    $uri = $_SERVER['REQUEST_URI'];
    echo '<script>window.location.replace("' . add_query_arg($konfiguracjaLink, $uri) . '");</script>';
}
$tabelaDaty = $ksztalt->data;
$data = json_decode($tabelaDaty, true);
$idProfilu = $ksztalt->idProfilu;
$idKsztaltuProfilu = $ksztalt->idKsztaltuProfilu;

$przypisaneMaterialy = $material->getAllMatKolWyk($idProfilu, $idKsztaltuProfilu, "material");
$przypisaneKolory = $material->getAllMatKolWyk($idProfilu, $idKsztaltuProfilu, "kolor");
$przypisaneWykonczenia = $material->getAllMatKolWyk($idProfilu, $idKsztaltuProfilu, "wykonczenie");


// -------------------------------------------------------------------------------------------------------- Doplnene 2. 10. 2023
$przypisaneEndings = $material->getAllMatKolWyk($idProfilu, $idKsztaltuProfilu, "endings");
// -------------------------------------------------------------------------------------------------------- Doplnene 18. 8. 2023
$przypisaneIndywidualny = $material->getAllMatKolWyk($idProfilu, $idKsztaltuProfilu, "kolorIndywidualny");
$przypisaneJoints = $material->getAllMatKolWyk($idProfilu, $idKsztaltuProfilu, "joints");
$przypisaneAccessories = $material->getAllMatKolWyk($idProfilu, $idKsztaltuProfilu, "kolorAkcesoria");

if (isset($data['dodatkoweZaslepki']['cena'])) {
    $cenaZaZaslepke = (float)$data['dodatkoweZaslepki']['cena'];
} else {
    $cenaZaZaslepke = 0;
}

$podatek = $ustawienia->getSettings('podatek');
$podatek = $podatek / 100;
$podatekVat = 1 + (float)$podatek;

$materialKsztalt = $material->getksztaltProfilu($idKsztaltuProfilu);
$nazwaKsztaltu = $materialKsztalt->tytul;
$aktualnyProfil = $profil->getProfil($idProfilu);
$tytulProfilu = $aktualnyProfil->tytul;


// if(isset($_REQUEST)){
//   echo '<pre>';
//   var_export($_REQUEST);
//   echo '</pre>';
// }

// echo '<pre>';
// var_export($produkt);
// echo '</pre>';

// echo '<hr>';
// echo '<pre>';
// var_export($ksztalt);
// echo '</pre>';
// echo '<hr>';

$koszykInfo = '';
if (isset($_POST['submit'])) {


    $produkt = [
        'ksztalt' => $nazwaKsztaltu,
        'slugKsztaltu' => $ksztalt->ksztalt,
        'idKsztaltu' => $idKsztaltuProfilu,
        'idProfilu' => $idProfilu,
        'request' => $_REQUEST,
    ];



    $zamowienia->addToCard($produkt);
?>
    <script>
        var ileKoszyk = parseInt($('.cartCountMenu').text());
        ileKoszyk = ileKoszyk + 1;
        $('.cartCountMenu').text(ileKoszyk);

        // Přesměrování na jinou URL
        window.location.href = "https://www.tramy.sk/kosik/?action=koszyk&id=<?php echo $_GET['id']; ?>";
    </script>
<?php
    $koszykInfo = '<div class="row"><div id="pridane-do-kosika" class="col-12">' . $lang->getLanguage('dodanoDoKoszyka', 'Dodano do koszyka!') . '</div></div>';
}
?>
<link href="<?php echo KHC_PATH2 . 'shapeimg/client-product.css' ?>" rel="stylesheet">
<?php // echo $koszykInfo; ?>

<div class="row khc-configurator-front">
    <form method="POST" id="formConfigurator">
        <div class="col-md-7">
            <div class="row">

<?php
    // echo $ksztalt->ksztalt;
?>
                
            </div>

            <div id="productVisualisation">
                <!-- start -->
                <?php if ($ksztalt->ksztalt == 'Ceownik') { ?>
                    <div class="wizElem" id="productCustomRight" style="top: 0px; left: 59px; width: 70px; height: 103px;"></div>
                    <div class="wizElem" id="productCustomInneredge" style="top: 48px; left: 59px; width: 50px; height: 55px; visibility: hidden;"></div>
                    <div class="wizElem" id="productCustomLeft" style="top: 0px; left: 0px; width: 70px; height: 103px;"></div>
                    <div class="wizElem" id="productCustomTopleft" style="top: 0px; left: -200px; width: 329px; height: 70px;"></div>
                    <div class="wizElem" id="productCustomTopright" style="top: 0px; left: 79px; width: 50px; height: 70px;"></div>
                    <div class="wizElem" id="productCustomEdge1" style="top: 98px; left: 50px; width: 20px; height: 5px; visibility: hidden;"></div>
                    <div class="wizElem" id="productCustomEdge2" style="top: 98px; left: 109px; width: 20px; height: 5px; visibility: hidden;"></div>
                    <div class="wizElem" id="productCustomPlankleft" style="top: 73px; left: 0px; width: 129px; height: 50px; visibility: hidden;"></div>
                    <div class="wizElem" id="productCustomPlankright" style="top: 73px; left: 79px; width: 50px; height: 50px; visibility: hidden;"></div>
                    <div class="wizElem" id="productCustomEnding1" style="top: -10px; left: -10px; width: 79px; height: 53px; visibility: hidden;"></div>
                    <div class="wizElem" id="productCustomEnding2" style="top: 60px; left: 60px; width: 79px; height: 53px; visibility: hidden;"></div>
                <?php }
                if ($ksztalt->ksztalt == 'profilPrzelotowy') {
                ?>

                    <div id="productCustomBottom" style="top: 51px; left: 25px; width: 79px; height: 45px;"></div>
                    <div id="productCustomRight" style="top: 0px; left: 59px; width: 45px; height: 76px;"></div>
                    <div id="productCustomLeft" style="top: 0px; left: 0px; width: 45px; height: 96px;"></div>
                    <div id="productCustomTopleft" style="top: 0px; left: -225px; width: 329px; height: 45px;"></div>
                    <div id="productCustomTopright" style="top: 0px; left: 79px; width: 25px; height: 45px;"></div>
                    <div id="productCustomEdge1" style="top: 91px; left: 25px; width: 20px; height: 5px; visibility: visible;"></div>
                    <div id="productCustomEdge2" style="top: 91px; left: 84px; width: 20px; height: 5px; visibility: visible;"></div>
                    <div id="productCustomEnding1" style="top: -10px; left: -10px; width: 79px; height: 71px; visibility: hidden;"></div>
                    <div id="productCustomEnding2" style="top: 35px; left: 35px; width: 79px; height: 71px; visibility: hidden;"></div>

                <?php }
                ?>
                <?php if ($ksztalt->ksztalt == 'katownik') {
                ?>
                    <div id="productCustomLeft" style="top: 0px; left: 0px; width: 70px; height: 121px;"></div>
                    <div id="productCustomTopleft" style="top: 0px; left: -200px; width: 329px; height: 70px;"></div>
                    <div id="productCustomTopright" style="top: 0px; left: 79px; width: 50px; height: 0px;"></div>
                    <div id="productCustomTopright2" style="top: 0px; left: 79px; width: 50px; height: 70px;"></div>
                    <div id="productCustomEdge1" style="top: 116px; left: 50px; width: 20px; height: 5px; visibility: hidden;"></div>
                <?php }
                ?>
                <?php if ($ksztalt->ksztalt == 'deska') {
                ?>
                    <div id="productCustomRight" style="top: 0px; left: 43px; width: 45px; height: 38px;"></div>
                    <div id="productCustomLeft" style="top: 0px; left: 0px; width: 45px; height: 38px;"></div>
                    <div id="productCustomTopleft2" style="top: 0px; left: -225px; width: 313px; height: 45px;"></div>
                    <div id="productCustomTopright2" style="top: 0px; left: 63px; width: 25px; height: 45px;"></div>
                    <div id="productCustomFront" style="top: 30px; left: 30px; width: 53px; height: 8px;"></div>
                <?php } ?>
                <?php if ($ksztalt->ksztalt == 'deskaWall') {
                ?>
                    <div id="productCustomRight" style="top: 0px; left: 43px; width: 45px; height: 38px;"></div>
                    <div id="productCustomLeft" style="top: 0px; left: 0px; width: 45px; height: 38px;"></div>
                    <div id="productCustomTopleft2" style="top: 0px; left: -225px; width: 313px; height: 45px;"></div>
                    <div id="productCustomTopright2" style="top: 0px; left: 63px; width: 25px; height: 45px;"></div>
                    <div id="productCustomFront" style="top: 30px; left: 30px; width: 53px; height: 8px;"></div>
                <?php } ?>
                <?php if ($ksztalt->ksztalt == 'elastycznaimitacjadeski') {
                ?>
                    <div id="productCustomRight" style="top: 0px; left: 43px; width: 45px; height: 38px;"></div>
                    <div id="productCustomLeftRdzen" style="top: 0px; left: 0px; width: 45px; height: 38px;"></div>
                    <div id="productCustomTopleft2" style="top: 0px; left: -225px; width: 313px; height: 45px;"></div>
                    <div id="productCustomTopright2" style="top: 0px; left: 63px; width: 25px; height: 45px;"></div>
                    <div id="productCustomFront" style="top: 26px; left: 23px; width: 65px; height: 12px;"></div>
                <?php } ?>
                <?php if ($ksztalt->ksztalt == 'profilPelny') {
                ?>
                    <div id="productCustomRight" style="top: 0px; left: 54px; width: 45px; height: 62px;"></div>
                    <div id="productCustomLeft" style="top: 0px; left: 0px; width: 45px; height: 62px;"></div>
                    <div id="productCustomTopleft" style="top: 0px; left: -225px; width: 324px; height: 45px;"></div>
                    <div id="productCustomTopright" style="top: 0px; left: 74px; width: 25px; height: 45px;"></div>
                    <div id="productCustomFace" style="top: 57px; left: 30px; width: 64px; height: 5px; visibility: hidden;"></div>
                    <div id="productCustomEnding1" style="top: -10px; left: -10px; width: 74px; height: 37px; visibility: hidden;"></div>
                    <div id="productCustomEnding2" style="top: 35px; left: 35px; width: 74px; height: 37px; visibility: hidden;"></div>
                    <div id="productCustomFront" style="top: 30px; left: 30px; width: 64px; height: 32px;"></div>
                <?php } ?>
                <?php if ($ksztalt->ksztalt == 'elastycznaokleina') {
                ?>
                    <div id="productCustomRight" style="top: 0px; left: 47px; width: 145px; height: 131px;"></div>
                    <div id="productCustomLeft" style="top: 0px; left: 0px; width: 145px; height: 131px;"></div>
                    <div id="productCustomTopleft2" style="top: 0px; left: -125px; width: 317px; height: 145px;"></div>
                    <div id="productCustomTopright2" style="top: 0px; left: 67px; width: 125px; height: 145px;"></div>
                    <div id="productCustomFront" style="top: 130px; left: 130px; width: 57px; height: 1px;"></div>
                <?php } ?>
                <!-- koniec -->
            </div>

            <div class="summary-wrapper">

                <div class="col-12 daneProfiluFront">
                  <b><?php echo $nazwaKsztaltu; ?></b>
                  <?php if ($ksztalt->ksztalt == 'deska') { ?><div class="celkove-metre"><?php echo $lang->getLanguage('lacznieMetrow', 'Łącznie metrów'); ?>: <span class="celkove-metre-bold"><span id="lacznieMetrowFront">0</span> m<sup>2</sup></span></div><?php } ?>   
                </div>

                <div class="summary-row-price ceny-brutto-box">
                  <div class="summary-column-title-price"><?php echo $lang->getLanguage('cenaZaWszystkie', 'Cena za wszystkie'); ?>:&nbsp;</div>
                  <div class="summary-column-price-price" id="cenazawszystkie">0</div>
                  <div class="summary-column-currency-price"><sub><?php echo $konfiguracjaWalutaRight; ?> <?php echo $lang->getLanguage('brutto', 's DPH'); ?></sub></div>
                </div>


                <div id="accordion-ends-hidden" class="row-display-hidden"><div class="summary-row<?php if (isset($_GET['id']) && (($_GET['id'] == 5) || ($_GET['id'] == 6))) { echo ' disabled'; } ?>"><div class="summary-column-title">Ukončenia</div><div id="hidden-accordion-ends-change" class="summary-column-value">-</div></div></div>
                <div class="summary-row"><div class="summary-column-title">Vzory dreva</div><div id="accordion-wood-patterns-change" class="summary-column-value">-</div></div>
                <div class="summary-row"><div id="accordion-color-change-title" class="summary-column-title">Farby <span>*</span></div><div id="accordion-color-change" class="summary-column-value">-</div></div>
                <div class="summary-row<?php if (isset($_GET['id']) && ($_GET['id'] == 6)) { echo ' disabled'; } ?>"><div class="summary-column-title">Hrany</div><div id="accordion-edges-change" class="summary-column-value">-</div></div>
                <div id="accordion-joints-hidden" class="row-display-hidden"><div class="summary-row<?php if (isset($_GET['id']) && (($_GET['id'] == 5) || ($_GET['id'] == 6))) { echo ' disabled'; } ?>"><div class="summary-column-title">Spoje</div><div id="hidden-accordion-joints-change" class="summary-column-value">-</div></div></div>
                <!-- <div class="summary-row"><div class="summary-column-title">Doplnky</div><div id="" class="summary-column-value">Mladé drevo</div></div> -->

                <div class="info-wrapper" id="info-wrapper-pc">
                    <div class="info-wrapper-row">
                        <div class="info-wrapper-row-svg">
                            <svg version="1.1" class="info-wrapper-row-svg-false" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px" viewBox="0 0 26 26" style="enable-background:new 0 0 26 26;" xml:space="preserve">
                                <path d="M13,0C5.8,0,0,5.8,0,13s5.8,13,13,13s13-5.8,13-13S20.2,0,13,0z M13,23.6C7.1,23.6,2.4,18.9,2.4,13S7.1,2.4,13,2.4 S23.6,7.1,23.6,13S18.9,23.6,13,23.6z M18.8,8.8L14.7,13l4.2,4.2l-1.7,1.7L13,14.7l-4.2,4.2l-1.7-1.7l4.2-4.2L7.2,8.8l1.7-1.7 l4.2,4.2l4.2-4.2L18.8,8.8z"/>
                            </svg>
                        </div>
                        <span>Z kategórie, označenej touto ikonou, si musíte vybrať jednu možnosť.</span>
                    </div>
                    <div class="info-wrapper-row-text">
                        <h5>Potrebujete pomôcť alebo osobnú konzultáciu?</h5>
                        <p>Nenašli ste potrebné informácie na našej stránke? <b>Potrebujete poradiť, alebo máte záujem o individuálnu úpravu</b> trámu, projektu alebo iného dôležitého detailu? </p>
                        <p>Žiadny problém. Neváhajte nás kontaktovať!</p>
                        <p>Môžete nám zavolať na naše telefónne číslo <a href="tel:+421 904 471 812" title="Zavolajte nám">+421 904 471 812</a> alebo napísať na <a href="mailto:info@tramy.sk" title="Napíšte nám email">info@tramy.sk</a> a <b>prekonzultujeme celý váš projekt</b>. <spam>Tešíme sa na spoluprácu!</spam></p>
                    </div>
                </div>

            </div>

        </div>

        <div class="col-md-5 mt-3 main-container-margin-top">

            <!-- Dane -->

            <?php

            foreach ($data as $title => $value) {

                if (isset($value['typ'])) {
                    // dla klasycznych suwaków
                    if ($value['typ'] == 'number' && isset($value['max'])) {
                        $max = $value['max'];
                        $min = $value['min'];
                        $step = $value['step'];
                        $tytul = $value['tytul'];
                        $srednia = round(($max - $min) / 2);
                        $wartosciCm = [
                            'dlugosc', 'szerokosc', 'wysokosc', 'wysokoscA', 'wysokoscB'
                        ];
                        if (in_array($title, $wartosciCm)) {
                            $czyCm = " cm";
                        } else {
                            $czyCm = " ks";
                        }

                        // -------------------------------------------------------------------------------------------------------- Doplnene 2. 10. 2023
                        $id_url = intval($_GET['id']);
                        if ($title === 'szerokosc' && $id_url === 6) {
                        ?>
                          <div class="input-container">
                            <label style="margin-top: 15px;" for="<?php echo $title; ?>"><?php echo $lang->getLanguage($title, $tytul); ?>: <span class="khcValue"><?php echo $min; ?><?php echo $czyCm; ?></span></label>
                            <input style="display: none;" type="range" step="1" min="20" max="20" value="20" class="slider" id="szerokosc" name="szerokosc">
                          </div>
                        <?php
                        }

                        elseif ($title === 'wysokoscA' && $id_url === 11) {
                          ?>
                          <div class="input-container">
                            <div class="label-button-wrapper">
                              <label for="<?php echo $title; ?>" class="wysokoscLabelA"><?php echo $lang->getLanguage($title, $tytul); ?>: <span class="khcValue"><?php echo $min; ?><?php echo $czyCm; ?></span></label>
                              <div class="button-wrapper">
                                <a class="buttonMinus">-</a>
                                <a class="buttonPlus">+</a>
                              </div>
                            </div>
                            <input type="range" step="<?php echo $step; ?>" min="<?php echo $min; ?>" max="<?php echo $max; ?>" value="<?php echo $min; ?>" class="slider" id="wysokoscA" name="wysokoscA">
                          </div>
                          <?php
                        }

                        elseif ($title === 'wysokoscB' && $id_url === 11) {
                          ?>
                          <div class="input-container">
                            <div class="label-button-wrapper">
                              <label for="<?php echo $title; ?>" class="wysokoscLabelB"><?php echo $lang->getLanguage($title, $tytul); ?>: <span class="khcValue"><?php echo $min; ?><?php echo $czyCm; ?></span></label>
                              <div class="button-wrapper">
                                <a class="buttonMinus">-</a>
                                <a class="buttonPlus">+</a>
                              </div>
                            </div>
                            <input type="range" step="<?php echo $step; ?>" min="<?php echo $min; ?>" max="<?php echo $max; ?>" value="<?php echo $min; ?>" class="slider" id="wysokoscB" name="wysokoscB">
                          </div>
                          <?php
                        }

                        else {
                        ?>
                          <div class="input-container">
                            <div class="label-button-wrapper">
                              <label for="<?php echo $title; ?>"><?php echo $lang->getLanguage($title, $tytul); ?>: <span class="khcValue"><?php echo $min; ?><?php echo $czyCm; ?></span></label>
                                <div class="button-wrapper">
                                  <a class="buttonMinus">-</a>
                                  <a class="buttonPlus">+</a>
                                </div>
                            </div>
                            <input type="range" step="<?php echo $step; ?>" min="<?php echo $min; ?>" max="<?php echo $max; ?>" value="<?php echo $min; ?>" class="slider" id="<?php echo $title; ?>" name="<?php echo $title; ?>">
                          </div>
                        <?php
                        }
                    }
                    // Dodatkowe zaślepki
                    if ($title == "dodatkoweZaslepki") {
                        $tytul = $value['tytul'];
                    ?>

                        <div class="input-container">
                            <label for="dodatkoweZaslepki"><?php echo $lang->getLanguage($title, $tytul); ?></label>
                            <!-- <input type="range" min="0" max="2" step="1" value="0" class="slider" id="dodatkoweZaslepki" name="dodatkoweZaslepki"> -->
                            <select class="slider" id="dodatkoweZaslepki" name="dodatkoweZaslepki">
                                <option value="0" selected>0</option>
                                <option value="1">1</option>
                                <option value="2">2</option>
                            </select>
                        </div>

                        <?php
                    }
                    // Przekrój
                    if ($title == "przekroj") {
                        $tytul = $value['tytul'];
                        echo '<label class="mt-1 otherLabel">' . $lang->getLanguage($title, $tytul) . '</label>';
                        foreach ($value['wartosci'] as $przekroj) {
                            $dlugosc = $przekroj['dlugosc'];
                            $szerokosc = $przekroj['szerokosc'];
                            $nazwa = $dlugosc . 'x' . $szerokosc;
                        ?>
                            <div class="input-container">
                                <label><input type="radio" name="przekroj" value="<?php echo $nazwa; ?>"> <?php echo $nazwa; ?>cm</label><br>

                            </div>
                        <?php

                        }
                    }
                    // -------------------------------------------------------------------------------------------------------- Doplnene 2. 10. 2023
                    // Hrúbka fasádnej dosky: 1.1 cm
                    if ($title == "gruboscRdzenia" && $id_url === 6) {
                    ?>
                        <div class="input-container no-bottom-margin">
                          <label><input style="display: none;" type="radio" name="gruboscRdzenia" value="1.1" checked="checked"><?php echo $lang->getLanguage('hrubkaFasDosky', 'Hrúbka fasádnej dosky') . ' 1.1 cm'; ?></label><br>
                        </div>
                    <?php
                    }
                    // Hrúbka fasádnej dosky: 2.5 cm
                    if ($title == "gruboscRdzenia" && $id_url === 5) {
                      ?>
                      <div class="input-container no-bottom-margin">
                        <label><input style="display: none;" type="radio" name="gruboscRdzenia" value="2.5" checked="checked"><?php echo $lang->getLanguage('hrubkaProfDoska', 'Hrúbka profilu DOSKA') . ' 2.5 cm'; ?></label><br>
                      </div>
                      <?php
                    }
                    // Dodatkowe ozdobne krawędzie
                    if ($title == "dodatkoweOzdobneKrawedzie" && $show_dodatkowaOzdobnaScianka == TRUE) {
                        $tytul = $value['tytul'];
                        ?>
                        <div class="input-container">
                            <label class="container-checkbox">
                                <input type="checkbox" id="<?php echo $title; ?>" name="<?php echo $title; ?>"> <?php echo $lang->getLanguage($title, $tytul); ?>
                                <span class="checkmark"></span>
                            </label>
                        </div>
                    <?php
                    }
                    // Dodatkowa ozdobna ścianka
                    if ($title == "dodatkowaOzdobnaScianka") {
                        $tytul = $value['tytul'];
                    ?>
                        <div class="input-container">
                            <label class="container-checkbox">
                                <input type="checkbox" id="<?php echo $title; ?>" name="<?php echo $title; ?>"> <?php echo $lang->getLanguage($title, $tytul); ?>
                                <span class="checkmark"></span>
                            </label>
                        </div>
                    <?php
                    }
                }
            }

            ?>




            <div class="info-visualisation-wrapper">
            Rozmery sú uvedené pre vonkajšie hrany.
            </div>



            <div class="accordion-container">
                <?php
                    // -------------------------------------------------------------------------------------------------------- Doplnene 2. 10. 2023
                    // Funkcia na kontrolu ci Accordion obsahuje aspon jednu polozku
                    // ak neobsahuje, tak sa nenacita cely <div class="set">
                    function showAccordion($array) {
                        foreach ($array as $item) {
                            if ($item['przypisany'] === true || $item['przypisany'] === 1) {
                                return true; // Aspoň jeden prvok má 'przypisany' nastavený na true alebo 1
                            }
                        }
                        return false; // Žiadny prvok nemá 'przypisany' nastavený na true alebo 1
                    }
                ?>

                <!-- Dropdown menu Ukoncenia -->
                <?php
                  if (showAccordion($przypisaneEndings)) {
                ?>
                <div id="hidden-accordion-ends" class="set hidden-accordion">
                        <a>
                          <div class="accordion-status disabled">
                            <svg version="1.1" class="accordion-status-true" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px" viewBox="0 0 26 26" style="enable-background:new 0 0 26 26;" xml:space="preserve">
                              <path d="M13,0C5.8,0,0,5.8,0,13s5.8,13,13,13s13-5.8,13-13S20.2,0,13,0z M13,23.6C7.1,23.6,2.4,18.9,2.4,13S7.1,2.4,13,2.4 S23.6,7.1,23.6,13S18.9,23.6,13,23.6z M17,7.3L19,8.7l-7.9,11.1l-3.9-3.9l1.7-1.7l1.9,1.9L17,7.3z"/>
                            </svg>
                            <svg version="1.1" class="accordion-status-false" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px" viewBox="0 0 26 26" style="enable-background:new 0 0 26 26;" xml:space="preserve">
                              <path d="M13,0C5.8,0,0,5.8,0,13s5.8,13,13,13s13-5.8,13-13S20.2,0,13,0z M13,23.6C7.1,23.6,2.4,18.9,2.4,13S7.1,2.4,13,2.4 S23.6,7.1,23.6,13S18.9,23.6,13,23.6z M18.8,8.8L14.7,13l4.2,4.2l-1.7,1.7L13,14.7l-4.2,4.2l-1.7-1.7l4.2-4.2L7.2,8.8l1.7-1.7 l4.2,4.2l4.2-4.2L18.8,8.8z"/>
                            </svg>
                          </div>
                          <span class="accordion-title"><?php echo $lang->getLanguage('endings', 'Ukončenia'); ?></span>
                          <span class="accordion-icon">
                            <svg version="1.1" id="Layer_1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px" viewBox="0 0 26 26" style="enable-background:new 0 0 26 26;" xml:space="preserve">
                              <polygon class="st0" points="13,17.9 5.3,10.2 6.7,8.8 13,15.1 19.3,8.8 20.7,10.2 "/>
                            </svg>
                          </span>
                        </a>
                        <div class="content">
                            <!-- Wykończenia -->

                            <?php foreach ($przypisaneEndings as $singleMaterial) {
                                if ($singleMaterial['przypisany'] == false) continue;
                            ?>
                                <div class="row frontSingleMaterial singleEndingsBox">
                                    <div class="col-md-4 frontMaterialImg">
                                
                                    <a href="<?php echo KHC_PATH2 . 'uploads/' . $singleMaterial['image']; ?>" data-lightbox="<?php echo $singleMaterial['id']; ?>" data-title="<?php echo $singleMaterial['caption']; ?>">
                                        <img src="<?php echo KHC_PATH2 . 'uploads/' . $singleMaterial['image']; ?>" alt="">
                                    </a>
                                
                                    </div>
                                    <div class="col-md-8 frontMaterialTitle"><?php echo $singleMaterial['tytul']; ?></div>
                                    <input type="radio" name="endings" class="radioMaterial" data-input-price ="<?php echo $singleMaterial['price']; ?>" value="<?php echo $singleMaterial['id']; ?>"> <!-- required -->
                                </div>
                            <?php } ?>

                            <!-- -->
                        </div>
                </div>
                <?php
                   }
                ?>

                <!-- Dropdown menu Vzory dreva -->
                <div id="accordion-wood-patterns" class="set">
                    <a>
                      <div class="accordion-status disabled">
                        <svg version="1.1" class="accordion-status-true" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px" viewBox="0 0 26 26" style="enable-background:new 0 0 26 26;" xml:space="preserve">
                            <path d="M13,0C5.8,0,0,5.8,0,13s5.8,13,13,13s13-5.8,13-13S20.2,0,13,0z M13,23.6C7.1,23.6,2.4,18.9,2.4,13S7.1,2.4,13,2.4 S23.6,7.1,23.6,13S18.9,23.6,13,23.6z M17,7.3L19,8.7l-7.9,11.1l-3.9-3.9l1.7-1.7l1.9,1.9L17,7.3z"/>
                        </svg>
                        <svg version="1.1" class="accordion-status-false" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px" viewBox="0 0 26 26" style="enable-background:new 0 0 26 26;" xml:space="preserve">
                            <path d="M13,0C5.8,0,0,5.8,0,13s5.8,13,13,13s13-5.8,13-13S20.2,0,13,0z M13,23.6C7.1,23.6,2.4,18.9,2.4,13S7.1,2.4,13,2.4 S23.6,7.1,23.6,13S18.9,23.6,13,23.6z M18.8,8.8L14.7,13l4.2,4.2l-1.7,1.7L13,14.7l-4.2,4.2l-1.7-1.7l4.2-4.2L7.2,8.8l1.7-1.7 l4.2,4.2l4.2-4.2L18.8,8.8z"/>
                        </svg>
                      </div>
                      <span class="accordion-title"><?php echo $lang->getLanguage('materialy', 'Materiały'); ?></span>
                      <span class="accordion-icon">
                        <svg version="1.1" id="Layer_1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px" viewBox="0 0 26 26" style="enable-background:new 0 0 26 26;" xml:space="preserve">
                          <polygon class="st0" points="13,17.9 5.3,10.2 6.7,8.8 13,15.1 19.3,8.8 20.7,10.2 "/>
                        </svg>
                      </span>
                    </a>
                    <div class="content">
                        <!-- Materialy -->

                        <?php foreach ($przypisaneMaterialy as $singleMaterial) {
                            if ($singleMaterial['przypisany'] == false) continue;
                        ?>
                            <div class="row frontSingleMaterial singleMaterialBox">
                                <div class="col-md-4 frontMaterialImg">

                                    <a href="<?php echo KHC_PATH2 . 'uploads/' . $singleMaterial['image']; ?>" data-lightbox="<?php echo $singleMaterial['id']; ?>" data-title="<?php echo $singleMaterial['caption']; ?>">
                                        <img src="<?php echo KHC_PATH2 . 'uploads/' . $singleMaterial['image']; ?>" alt="">
                                    </a>
                                
                                </div>
                                <div class="col-md-8 frontMaterialTitle"><?php echo $singleMaterial['tytul']; ?></div>
                                <input type="radio" name="material" class="radioMaterial" value="<?php echo $singleMaterial['id']; ?>" required> <!-- required -->
                            </div>
                        <?php } ?>

                        <!-- -->
                    </div>
                </div>

                <!-- Dropdown menu Farby standardne -->
                <div id="accordion-color-standard" class="set">
                    <a>
                      <div class="accordion-status disabled">
                        <svg version="1.1" class="accordion-status-true" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px" viewBox="0 0 26 26" style="enable-background:new 0 0 26 26;" xml:space="preserve">
                            <path d="M13,0C5.8,0,0,5.8,0,13s5.8,13,13,13s13-5.8,13-13S20.2,0,13,0z M13,23.6C7.1,23.6,2.4,18.9,2.4,13S7.1,2.4,13,2.4 S23.6,7.1,23.6,13S18.9,23.6,13,23.6z M17,7.3L19,8.7l-7.9,11.1l-3.9-3.9l1.7-1.7l1.9,1.9L17,7.3z"/>
                        </svg>
                        <svg version="1.1" class="accordion-status-false" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px" viewBox="0 0 26 26" style="enable-background:new 0 0 26 26;" xml:space="preserve">
                            <path d="M13,0C5.8,0,0,5.8,0,13s5.8,13,13,13s13-5.8,13-13S20.2,0,13,0z M13,23.6C7.1,23.6,2.4,18.9,2.4,13S7.1,2.4,13,2.4 S23.6,7.1,23.6,13S18.9,23.6,13,23.6z M18.8,8.8L14.7,13l4.2,4.2l-1.7,1.7L13,14.7l-4.2,4.2l-1.7-1.7l4.2-4.2L7.2,8.8l1.7-1.7 l4.2,4.2l4.2-4.2L18.8,8.8z"/>
                        </svg>
                      </div>
                      <span class="accordion-title"><?php echo $lang->getLanguage('kolory', 'Kolory'); ?></span>
                      <span class="accordion-icon">
                        <svg version="1.1" id="Layer_1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px" viewBox="0 0 26 26" style="enable-background:new 0 0 26 26;" xml:space="preserve">
                          <polygon class="st0" points="13,17.9 5.3,10.2 6.7,8.8 13,15.1 19.3,8.8 20.7,10.2 "/>
                        </svg>
                      </span>
                    </a>
                    <div class="content">
                        <?php foreach ($przypisaneKolory as $singleMaterial) {

                            if ($singleMaterial['przypisany'] == false) continue;
                        ?>
                            <div class="row frontSingleMaterial singleKolorBox">
                                <div class="col-md-4 frontMaterialImg">
                                    
                                    <a href="<?php echo KHC_PATH2 . 'uploads/' . $singleMaterial['image']; ?>" data-lightbox="<?php echo $singleMaterial['id']; ?>" data-title="<?php echo $singleMaterial['caption']; ?>">
                                        <img src="<?php echo KHC_PATH2 . 'uploads/' . $singleMaterial['image']; ?>" alt="">
                                    </a>
                            
                                </div>
                                <div class="col-md-8 frontMaterialTitle"><?php echo $singleMaterial['tytul']; ?></div>
                                <input type="radio" name="kolor" data-input-price="<?php echo $singleMaterial['price']; ?>" class="radioMaterial" value="<?php echo $singleMaterial['id']; ?>" required> <!-- required -->
                            </div>
                        <?php } ?>

                        <!-- -->
                    </div>
                </div>

                <!-- Dropdown menu Farby individualne -->
                <?php
                  if (showAccordion($przypisaneIndywidualny)) {
                ?>
                <div id="accordion-color-individual" class="set">
                  <a>
                      <div class="accordion-status none">
                        <svg version="1.1" class="accordion-status-true" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px" viewBox="0 0 26 26" style="enable-background:new 0 0 26 26;" xml:space="preserve">
                            <path d="M13,0C5.8,0,0,5.8,0,13s5.8,13,13,13s13-5.8,13-13S20.2,0,13,0z M13,23.6C7.1,23.6,2.4,18.9,2.4,13S7.1,2.4,13,2.4 S23.6,7.1,23.6,13S18.9,23.6,13,23.6z M17,7.3L19,8.7l-7.9,11.1l-3.9-3.9l1.7-1.7l1.9,1.9L17,7.3z"/>
                        </svg>
                        <svg version="1.1" class="accordion-status-false" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px" viewBox="0 0 26 26" style="enable-background:new 0 0 26 26;" xml:space="preserve">
                            <path d="M13,0C5.8,0,0,5.8,0,13s5.8,13,13,13s13-5.8,13-13S20.2,0,13,0z M13,23.6C7.1,23.6,2.4,18.9,2.4,13S7.1,2.4,13,2.4 S23.6,7.1,23.6,13S18.9,23.6,13,23.6z M18.8,8.8L14.7,13l4.2,4.2l-1.7,1.7L13,14.7l-4.2,4.2l-1.7-1.7l4.2-4.2L7.2,8.8l1.7-1.7 l4.2,4.2l4.2-4.2L18.8,8.8z"/>
                        </svg>
                      </div>
                      <span class="accordion-title"><?php echo $lang->getLanguage('koloryIndywidualny', 'Farby špeciálne'); ?></span>
                      <span class="accordion-icon">
                        <svg version="1.1" id="Layer_1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px" viewBox="0 0 26 26" style="enable-background:new 0 0 26 26;" xml:space="preserve">
                          <polygon class="st0" points="13,17.9 5.3,10.2 6.7,8.8 13,15.1 19.3,8.8 20.7,10.2 "/>
                        </svg>
                      </span>
                  </a>
                  <div class="content" style="display: block1;">
                    <?php
                      foreach ($przypisaneIndywidualny as $singleMaterial) {
                        if ($singleMaterial['przypisany'] == false) continue;
                    ?>
                    <div class="row frontSingleMaterial singleIndywidualnyBox">
                      <div class="col-md-4 frontMaterialImg">
                        
                        <a href="<?php echo KHC_PATH2 . 'uploads/' . $singleMaterial['image']; ?>" data-lightbox="<?php echo $singleMaterial['id']; ?>" data-title="<?php echo $singleMaterial['caption']; ?>">
                            <img src="<?php echo KHC_PATH2 . 'uploads/' . $singleMaterial['image']; ?>" alt="">
                        </a>
                        
                      </div>
                      <div class="col-md-8 frontMaterialTitle"><?php echo $singleMaterial['tytul']; ?></div>
                      <input type="radio" name="kolorIndywidualny" data-input-price="<?php echo $singleMaterial['price']; ?>" class="radioMaterial" value="<?php echo $singleMaterial['id']; ?>">  <!-- required -->
                    </div>
                  <?php } ?>
                  </div>
                </div>
                <?php
                  }
                ?>

                <!-- Dropdown menu Hrany -->
                <?php
                  if (showAccordion($przypisaneWykonczenia)) {
                ?>
                <div id="accordion-edges" class="set">
                        <a>
                        <div class="accordion-status disabled">
                            <svg version="1.1" class="accordion-status-true" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px" viewBox="0 0 26 26" style="enable-background:new 0 0 26 26;" xml:space="preserve">
                                <path d="M13,0C5.8,0,0,5.8,0,13s5.8,13,13,13s13-5.8,13-13S20.2,0,13,0z M13,23.6C7.1,23.6,2.4,18.9,2.4,13S7.1,2.4,13,2.4 S23.6,7.1,23.6,13S18.9,23.6,13,23.6z M17,7.3L19,8.7l-7.9,11.1l-3.9-3.9l1.7-1.7l1.9,1.9L17,7.3z"/>
                            </svg>
                            <svg version="1.1" class="accordion-status-false" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px" viewBox="0 0 26 26" style="enable-background:new 0 0 26 26;" xml:space="preserve">
                                <path d="M13,0C5.8,0,0,5.8,0,13s5.8,13,13,13s13-5.8,13-13S20.2,0,13,0z M13,23.6C7.1,23.6,2.4,18.9,2.4,13S7.1,2.4,13,2.4 S23.6,7.1,23.6,13S18.9,23.6,13,23.6z M18.8,8.8L14.7,13l4.2,4.2l-1.7,1.7L13,14.7l-4.2,4.2l-1.7-1.7l4.2-4.2L7.2,8.8l1.7-1.7 l4.2,4.2l4.2-4.2L18.8,8.8z"/>
                            </svg>
                        </div>
                          <span class="accordion-title"><?php echo $lang->getLanguage('wykonczenia', 'Wykończenia'); ?></span>
                            <span class="accordion-icon">
                                <svg version="1.1" id="Layer_1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px" viewBox="0 0 26 26" style="enable-background:new 0 0 26 26;" xml:space="preserve">
                                <polygon class="st0" points="13,17.9 5.3,10.2 6.7,8.8 13,15.1 19.3,8.8 20.7,10.2 "/>
                                </svg>
                            </span>
                        </a>
                        <div class="content">
                            <!-- Wykończenia -->

                            <?php foreach ($przypisaneWykonczenia as $singleMaterial) {
                                if ($singleMaterial['przypisany'] == false) continue;
                            ?>
                                <div class="row frontSingleMaterial singleWykonczeniaBox">
                                    <div class="col-md-4 frontMaterialImg">
                                        
                                        <a href="<?php echo KHC_PATH2 . 'uploads/' . $singleMaterial['image']; ?>" data-lightbox="<?php echo $singleMaterial['id']; ?>" data-title="<?php echo $singleMaterial['caption']; ?>">
                                            <img src="<?php echo KHC_PATH2 . 'uploads/' . $singleMaterial['image']; ?>" alt="">
                                        </a>
                                        
                                    </div>
                                    <div class="col-md-8 frontMaterialTitle"><?php echo $singleMaterial['tytul']; ?></div>
                                    <input type="radio" name="wykonczenie" class="radioMaterial" data-input-price="<?php echo $singleMaterial['price']; ?>" value="<?php echo $singleMaterial['id']; ?>" required> <!-- required -->
                                </div>
                            <?php } ?>

                            <!-- -->
                        </div>
                </div>
                <?php
                  }
                ?>

                <!-- Dropdown menu Spoje -->
                <?php
                  if (showAccordion($przypisaneJoints)) {
                ?>
                <div id="hidden-accordion-joints" class="set hidden-accordion">
                    <a>
                      <div class="accordion-status disabled">
                        <svg version="1.1" class="accordion-status-true" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px" viewBox="0 0 26 26" style="enable-background:new 0 0 26 26;" xml:space="preserve">
                            <path d="M13,0C5.8,0,0,5.8,0,13s5.8,13,13,13s13-5.8,13-13S20.2,0,13,0z M13,23.6C7.1,23.6,2.4,18.9,2.4,13S7.1,2.4,13,2.4 S23.6,7.1,23.6,13S18.9,23.6,13,23.6z M17,7.3L19,8.7l-7.9,11.1l-3.9-3.9l1.7-1.7l1.9,1.9L17,7.3z"/>
                        </svg>
                        <svg version="1.1" class="accordion-status-false" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px" viewBox="0 0 26 26" style="enable-background:new 0 0 26 26;" xml:space="preserve">
                            <path d="M13,0C5.8,0,0,5.8,0,13s5.8,13,13,13s13-5.8,13-13S20.2,0,13,0z M13,23.6C7.1,23.6,2.4,18.9,2.4,13S7.1,2.4,13,2.4 S23.6,7.1,23.6,13S18.9,23.6,13,23.6z M18.8,8.8L14.7,13l4.2,4.2l-1.7,1.7L13,14.7l-4.2,4.2l-1.7-1.7l4.2-4.2L7.2,8.8l1.7-1.7 l4.2,4.2l4.2-4.2L18.8,8.8z"/>
                        </svg>
                      </div>
                      <span class="accordion-title"><?php echo $lang->getLanguage('joints', 'Spoje'); ?></span>
                      <span class="accordion-icon">
                        <svg version="1.1" id="Layer_1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px" viewBox="0 0 26 26" style="enable-background:new 0 0 26 26;" xml:space="preserve">
                          <polygon class="st0" points="13,17.9 5.3,10.2 6.7,8.8 13,15.1 19.3,8.8 20.7,10.2 "/>
                        </svg>
                      </span>
                    </a>
                    <div class="content">
                        <?php
                        foreach ($przypisaneJoints as $singleMaterial) {
                            if ($singleMaterial['przypisany'] == false) continue;
                        ?>
                        <div class="row frontSingleMaterial singleJointsBox">
                        <div class="col-md-4 frontMaterialImg">
                            
                            <a href="<?php echo KHC_PATH2 . 'uploads/' . $singleMaterial['image']; ?>" data-lightbox="<?php echo $singleMaterial['id']; ?>" data-title="<?php echo $singleMaterial['caption']; ?>">
                                <img src="<?php echo KHC_PATH2 . 'uploads/' . $singleMaterial['image']; ?>" alt="">
                            </a>
                            
                        </div>
                        <div class="col-md-8 frontMaterialTitle"><?php echo $singleMaterial['tytul']; ?></div>
                        <input type="radio" name="joints" class="radioMaterial" data-input-price="<?php echo $singleMaterial['price']; ?>" value="<?php echo $singleMaterial['id']; ?>">  <!-- required -->
                        </div>
                    <?php } ?>
                    </div>
                </div>
                <?php
                  }
                ?>

            </div>

            <!-- Button odoslat -->
            <div class="col-12 btnaddToCardBox">
              <button class="btnAddToCard" name="submit"><?php echo $lang->getLanguage('dodajDoKoszyka','Dodaj do koszyka');?></button>
            </div>

            <div class="delete-wrapper" style="display: block1;">
                <div class="delete-row"><div>accessoriesCount: </div><input type="text" name="accessoriesCount" id="accessories-hidden-input" value="0"></div>
                <div class="delete-row"><div>Doplnky: </div><input type="text" name="accessoriesTotalPrice" id="accessories-total-price" value="0"></div>
                <div class="delete-row"><div>Koncovky: </div><input type="text" name="" id="ends-total-price" value="0"></div>
                <div class="delete-row"><div>Hrany: </div><input type="text" name="" id="edges-total-price" value="0"></div>
                <div class="delete-row"><div>Spoje: </div><input type="text" name="jointsCount" id="joints-total-price" value="0"></div>
                <div class="delete-row"><div>Farby specialne: </div><input type="text" name="colorsSpecialPrice" id="colors-special-total-price" value="0"></div>
            </div>

            <div class="info-wrapper" id="info-wrapper-phone">
                    <div class="info-wrapper-row">
                        <div class="info-wrapper-row-svg">
                            <svg version="1.1" class="info-wrapper-row-svg-false" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px" viewBox="0 0 26 26" style="enable-background:new 0 0 26 26;" xml:space="preserve">
                                <path d="M13,0C5.8,0,0,5.8,0,13s5.8,13,13,13s13-5.8,13-13S20.2,0,13,0z M13,23.6C7.1,23.6,2.4,18.9,2.4,13S7.1,2.4,13,2.4 S23.6,7.1,23.6,13S18.9,23.6,13,23.6z M18.8,8.8L14.7,13l4.2,4.2l-1.7,1.7L13,14.7l-4.2,4.2l-1.7-1.7l4.2-4.2L7.2,8.8l1.7-1.7 l4.2,4.2l4.2-4.2L18.8,8.8z"/>
                            </svg>
                        </div>
                        <span>Z kategórie, označenej touto ikonou, si musíte vybrať jednu možnosť.</span>
                    </div>
                    <div class="info-wrapper-row-text">
                        <h5>Potrebujete pomôcť alebo osobnú konzultáciu?</h5>
                        <p>Nenašli ste potrebné informácie na našej stránke? <b>Potrebujete poradiť, alebo máte záujem o individuálnu úpravu</b> trámu, projektu alebo iného dôležitého detailu? </p>
                        <p>Žiadny problém. Neváhajte nás kontaktovať!</p>
                        <p>Môžete nám zavolať na naše telefónne číslo <a href="tel:+421 904 471 812" title="Zavolajte nám">+421 904 471 812</a> alebo napíat na <a href="mailto:info@tramy.sk" title="Napíšte nám email">info@tramy.sk</a> a <b>prekonzultujeme celý váš projekt</b>. <spam>Tešíme sa na spoluprácu!</spam></p>
                    </div>
                </div>

        </div>

        <!-- Akordeon START -->
        <script>
            $(document).ready(function() {
                $(".set > a").on("click", function() {
                    if ($(this).hasClass("active")) {
                        $(this).removeClass("active");
                        $(this)
                            .siblings(".content")
                            .slideUp(200);
                    } else {
                        $(".set > a").removeClass("active");
                        $(this).addClass("active");
                        $(".content").slideUp(200);
                        $(this)
                            .siblings(".content")
                            .slideDown(200);
                    }
                });
            });

            $('.frontSingleMaterial').click(function() {

                $(this).find('.radioMaterial').prop('checked', true);

                if ($(this).hasClass('singleMaterialBox')) {
                    $('.singleMaterialBox').removeClass('frontSingleMaterialActive');
                    $(this).addClass('frontSingleMaterialActive');
                }
                if ($(this).hasClass('singleKolorBox')) {
                    $('.singleKolorBox').removeClass('frontSingleMaterialActive');
                    $(this).addClass('frontSingleMaterialActive');
                    resetAccordionIndividual();
                }
                if ($(this).hasClass('singleIndywidualnyBox')) {
                    $('.singleIndywidualnyBox').removeClass('frontSingleMaterialActive');
                    $(this).addClass('frontSingleMaterialActive');
                    resetAccordionStandard();
                }
                if ($(this).hasClass('singleJointsBox')) {
                    $('.singleJointsBox').removeClass('frontSingleMaterialActive');
                    $(this).addClass('frontSingleMaterialActive');
                }
                if ($(this).hasClass('singleWykonczeniaBox')) {
                    $('.singleWykonczeniaBox').removeClass('frontSingleMaterialActive');
                    $(this).addClass('frontSingleMaterialActive');
                }
                if ($(this).hasClass('singleEndingsBox')) {
                    $('.singleEndingsBox').removeClass('frontSingleMaterialActive');
                    $(this).addClass('frontSingleMaterialActive');
                }

            });

            function resetAccordionStandard() {
                // Odstraní třídu "frontSingleMaterialActive" ze všech elementů s touto třídou
                $("#accordion-color-standard .frontSingleMaterialActive").removeClass("frontSingleMaterialActive");

                // Odstraní atribut "required" ze všech radio inputů uvnitř #accordion-color-standard
                $("#accordion-color-standard input[type='radio']").removeAttr("required");

                // Nastaví všechny radio inputy jako "unchecked"
                $("#accordion-color-standard input[type='radio']").prop("checked", false);
            }
            function resetAccordionIndividual() {
                // Odstraní třídu "frontSingleMaterialActive" ze všech elementů s touto třídou
                $("#accordion-color-individual .frontSingleMaterialActive").removeClass("frontSingleMaterialActive");

                // Odstraní atribut "required" ze všech radio inputů uvnitř #accordion-color-individual
                $("#accordion-color-individual input[type='radio']").removeAttr("required");

                // Nastaví všechny radio inputy jako "unchecked"
                $("#accordion-color-individual input[type='radio']").prop("checked", false);
            }

            // Odklikne checked box input ak kliknem na riadok
            // -----------------------------------------------
            // 
            $(document).ready(function() {
                var totalCountMaterial = $(".singleMaterialBox > input").length;
                var totalCountKolor = $(".singleKolorBox > input").length;
                var totalCountWykonczenia = $(".singleWykonczeniaBox > input").length;
                var totalCountIndywidualny = $(".singleIndywidualnyBox > input").length;
                var totalCountJoints = $(".singleJointsBox > input").length;
                var totalCountAkcesoria = $(".singleAkcesoriaBox > input").length;
                var totalCountEndings = $(".singleEndingsBox > input").length;

                if(totalCountMaterial==1){
                    $('.singleMaterialBox').first().find('.radioMaterial').prop('checked', true);
                    $('.singleMaterialBox').first().addClass('frontSingleMaterialActive');
                }
                if(totalCountKolor==1){
                    $('.singleKolorBox').first().find('.radioMaterial').prop('checked', true);
                    $('.singleKolorBox').first().addClass('frontSingleMaterialActive');
                }
                if(totalCountIndywidualny==1){
                    $('.singleIndywidualnyBox').first().find('.radioMaterial').prop('checked', true);
                    $('.singleIndywidualnyBox').first().addClass('frontSingleMaterialActive');
                }
                if(totalCountWykonczenia==1){
                    $('.singleWykonczeniaBox').first().find('.radioMaterial').prop('checked', true);
                    $('.singleWykonczeniaBox').first().addClass('frontSingleMaterialActive');
                }
                if(totalCountJoints==1){
                    $('.singleJointsBox').first().find('.radioMaterial').prop('checked', true);
                    $('.singleJointsBox').first().addClass('frontSingleMaterialActive');
                }
                if(totalCountEndings==1){
                    $('.singleEndingsBox').first().find('.radioMaterial').prop('checked', true);
                    $('.singleEndingsBox').first().addClass('frontSingleMaterialActive');
                }
            });

            // Ked kliknem na pridat do kosika a inputy maju request false, tak oznaci ze treba vybrat produkt
            // -----------------------------------------------------------------------------------------------
            // 
            $('.btnAddToCard').click(function() {
                var totalCountMaterial = $(".singleMaterialBox > input").length;
                var totalCountKolor = $(".singleKolorBox > input").length;
                var totalCountWykonczenia = $(".singleWykonczeniaBox > input").length;
                
                var totalCountIndywidualny = $(".singleIndywidualnyBox > input").length;
                var totalCountJoints = $(".singleJointsBox > input").length;
                var totalCountEndings = $(".singleEndingsBox > input").length;

                if(totalCountMaterial>1){
                    if($('.singleMaterialBox').find('.radioMaterial').prop('checked') == false){
                        changeErrorIcon('.singleMaterialBox');
                    }
                }
                if(totalCountKolor>1){
                    if($('.singleKolorBox').find('.radioMaterial').prop('checked') == false){
                        changeErrorIcon('.singleKolorBox');
                    }
                }
                if(totalCountWykonczenia>1){
                    if($('.singleWykonczeniaBox').find('.radioMaterial').prop('checked') == false){
                        changeErrorIcon('.singleWykonczeniaBox');
                    }
                }
                if(totalCountIndywidualny>1){
                    if($('.singleIndywidualnyBox').find('.radioMaterial').prop('checked') == false){
                        changeErrorIcon('.singleIndywidualnyBox');
                    }
                }
                if(totalCountJoints>1){
                    if($('.singleJointsBox').find('.radioMaterial').prop('checked') == false){
                        changeErrorIcon('.singleJointsBox');
                    }
                }
                if(totalCountEndings>1){
                    if($('.singleEndingsBox').find('.radioMaterial').prop('checked') == false){
                        changeErrorIcon('.singleEndingsBox');
                    }
                }

                function changeErrorIcon(params) {
                    var parentId = $(params).parent().parent().attr('id');
                    var statusElement = $('#' + parentId).find('.accordion-status');

                    if (!$('#' + parentId).hasClass("hidden-accordion")) {
                        if (!statusElement.hasClass('none')) {
                            statusElement.removeClass('disabled').addClass('error');
                        }
                    }

                }
            });

            // Ak je nieco odkliknute, tak nazvu accordion zmeni background color
            // ------------------------------------------------------------------
            // 
            // $('.singleMaterialBox').click(function() {
            //     $(this).parent().parent().css('background','#ff0000');
            // });
            // $('.singleKolorBox').click(function() {
            //     $(this).parent().parent().css('background','#ff0000');
            // });
            // $('.singleWykonczeniaBox').click(function() {
            //     $(this).parent().parent().css('background','#ff0000');
            // });
            // $('.singleIndywidualnyBox').click(function() {
            //     $(this).parent().parent().css('background','#ff0000');
            // });
            // $('.singleJointsBox').click(function() {
            //     $(this).parent().parent().css('background','#ff0000');
            // });
            // $('.singleAkcesoriaBox').click(function() {
            //     // $(this).parent().parent().css('background','#f5f5f5');
            // });
            // $('.singleEndingsBox').click(function() {
            //     $(this).parent().parent().css('background','#ff0000');
            // });
        </script>
        <!-- Akordeon END -->

        <!-- Checkbox START -->
        <script>

            $(document).ready(function() {
            
                var doplnkySpolu = 0;

                $('.custom-accordion .frontSingleMaterialCheckbox').click(function() {

                    var checkbox = $(this).find('.checkboxMaterial');

                    // Pokud je tlačítko zaškrtnuto (checked), odškrtněte ho.
                    if (checkbox.is(':checked')) {
                        checkbox.prop('checked', false);
                        $(this).removeClass('frontSingleMaterialActive');
                        $(this).find('.countWrapper').addClass('disabled');

                        getPriceAndCountAkcesoria(this, null, 'clear-row');
                        PowKsztaltu(ksztalt);


                        // Při změně stavu checkboxu spusťte funkci toggleControls
                        toggleControls(checkbox);
                        // console.log('1');

                    } else {
                        // Pokud není zaškrtnuto, zaškrtněte ho.
                        checkbox.prop('checked', true);
                        $(this).addClass('frontSingleMaterialActive');
                        $(this).find('.countWrapper').removeClass('disabled');
                        

                        // Při změně stavu checkboxu spusťte funkci toggleControls
                        toggleControls(checkbox);

                        getPriceAndCountAkcesoria(this, 1, 'plus-start');
                        PowKsztaltu(ksztalt);

                        // console.log('2');

                    }

                    var pocetZaskrtnutych = $('.frontSingleMaterialCheckbox .checkboxMaterial:checked').length;
                    var atLeastOneChecked = $('.frontSingleMaterialCheckbox .checkboxMaterial:checked').length > 0;

                    if (!atLeastOneChecked) {
                        // Pokud není žádný zaškrtnutý, zaškrtneme prvního potomka
                        $('.checkboxMaterialNone').prop('checked', true);
                        $('.frontSingleMaterialCheckboxNone').addClass('frontSingleMaterialActive');
                        $("#accessories-hidden-input").val(pocetZaskrtnutych);

                        // console.log('A');

                    } else {
                        $('.checkboxMaterialNone').prop('checked', false);
                        $('.frontSingleMaterialCheckboxNone').removeClass('frontSingleMaterialActive');
                        $("#accessories-hidden-input").val(pocetZaskrtnutych);

                        // console.log('B');

                    }

                    // Vynuluje vsetky checkboxy ak clovek klikne ze nechce doplnky
                    $('.frontSingleMaterialCheckboxNone').click(function() {
                        $('.checkboxMaterialNone').prop('checked', true);
                        $('.frontSingleMaterialCheckboxNone').addClass('frontSingleMaterialActive');
                        $('.frontSingleMaterialCheckbox .checkboxMaterial').prop('checked', false);
                        $('.frontSingleMaterialCheckbox').removeClass('frontSingleMaterialActive');
                        $('.countWrapper').addClass('disabled');
                        $("#accessories-hidden-input").val(0);

                        // console.log('C');

                        toggleControls(checkbox);

                        getPriceAndCountAkcesoria(this, null, 'clear-all');
                        PowKsztaltu(ksztalt);

                    });

                });

                // Funkce pro aktivaci/deaktivaci tlačítek a inputu
                function toggleControls(checkbox) {

                    // event.stopPropagation(); // Zastaví šíření události
                    var row = checkbox.closest(".row");
                    var input = row.find(".numberInput");
                    var inputValue = parseInt(input.val(), 10);
                    var inputMax = input.attr("max");
                    var incrementBtn = input.siblings(".increment");
                    var decrementBtn = input.siblings(".decrement");

                    if (checkbox.is(":checked")) {
                    
                        input.prop("disabled", false);
                        
                        if(inputValue == inputMax) {
                            incrementBtn.addClass("disabled");
                            decrementBtn.removeClass("disabled");

                            // console.log('A');
                        }
                        
                        else if(inputValue == 0) {
                            incrementBtn.removeClass("disabled");
                            decrementBtn.addClass("disabled");

                            // console.log('B');
                        }
                        
                        else {
                            incrementBtn.removeClass("disabled");
                            // console.log('C');
                        }
                    
                    } else {
                          input.prop("disabled", true);
                          input.val(1);

                          row.addClass("disabled-button-in-row");

                          incrementBtn.addClass("disabled");
                          decrementBtn.addClass("disabled");

                        //   console.log('D');
                    }

                }

                // Funkce pro aktualizaci stavu tlačítek
                function updateButtons(input, max) {

                    event.stopPropagation(); // Zastaví šíření události
                    var value = parseInt(input.val(), 10);
                    
                    var incrementBtn = input.siblings(".increment");
                    var decrementBtn = input.siblings(".decrement");

                    if (value >= max) {
                        incrementBtn.addClass("disabled");
                    } else {
                        incrementBtn.removeClass("disabled");
                    }

                    if (value <= 1) {
                        decrementBtn.addClass("disabled");
                    } else {
                        decrementBtn.removeClass("disabled");
                    }

                }

                // Manipulace s tlačítky "plus"
                $(".increment").click(function() {
                    event.stopPropagation(); // Zastaví šíření události

                    var input = $(this).siblings(".numberInput");
                    var value = parseInt(input.val(), 10);
                    var maxAttributeValue = $(this).siblings(".numberInput").attr("max");

                    if (value < maxAttributeValue) {
                        input.val(value + 1);
                        inputCount = parseInt(input.val(), 10); // Aktualizace inputCount
                        // console.log('nové hodnoty A:' + inputCount); // Výpis nové hodnoty

                        if ($(this).hasClass('disabled') === false) {
                            getPriceAndCountAkcesoria(this, inputCount, 'plus');
                            PowKsztaltu(ksztalt);
                        }
                    }

                    updateButtons(input, maxAttributeValue);

                });

                // Manipulace s tlačítky "minus"
                $(".decrement").click(function() {

                    event.stopPropagation(); // Zastaví šíření události
                    var input = $(this).siblings(".numberInput");

                    // console.log(inputCount); // Výpis původní hodnoty
                    var value = parseInt(input.val(), 10);
                    if (value > 1) {
                        input.val(value - 1);
                        inputCount = parseInt(input.val(), 10); // Aktualizace inputCount
                        // console.log('nové hodnoty B:' + inputCount); // Výpis nové hodnoty
                        if ($(this).hasClass('disabled') === false) {
                            getPriceAndCountAkcesoria(this, inputCount, 'minus');
                            PowKsztaltu(ksztalt);
                        }
                    }

                    updateButtons(input);
                    
                });

                function getPriceAndCountAkcesoria(element, count, type) {

                    // console.clear();
                    
                    var count; 
                    var type; 
                    var newPrice;


                    var inputContainer = $(element).closest('.singleAkcesoriaBox');
                    var inputPrice = parseFloat(inputContainer.find('input.checkboxMaterial').data('akcesoria-price'));
                    var inputCount = parseFloat(inputContainer.find('input.numberInput').val());
                    var cenaSpolu = parseFloat($("#accessories-total-price").val());
            
                    // console.log('count: ' + count);
            
            
                    if (type === 'plus-start') {
                        // console.log('------- plus-start -------------------------------------');
            
                        newPrice = cenaSpolu + inputPrice;
                    }
                    else if (type === 'plus') {
                        // console.log('------- plus -------------------------------------------');
            
                        newPrice = cenaSpolu + inputPrice;
                    }
                    else if (type === 'minus') {
                        // console.log('------- minus ------------------------------------------');
            
                        newPrice = cenaSpolu - inputPrice;
            
                    }
                    else if (type === 'clear-all') {
                        // console.log('------- clear-all --------------------------------------');
            
                        newPrice = 0;
            
                    }
                    else if (type === 'clear-row') {
                        // console.log('------- clear-row --------------------------------------');
            
                        newPrice = cenaSpolu - ( inputPrice * inputCount )
            
                    }
                    else {
                        newPrice = 0;
                    }
                    
                    // console.log('newPrice: ' + newPrice);
                    $("#accessories-total-price").val(newPrice);
                    // console.log('--------------------------------------------------------');
                    
                }
        
        });

        </script>
        <!-- Checkbox END -->

        <!-- Selected items START -->
        <script>

            function updateStatusClass(statusElement) {
                if (statusElement.hasClass('error')) {
                    statusElement.removeClass('error').addClass('enabled');
                } else if (statusElement.hasClass('none')) {
                    statusElement.removeClass('none').addClass('enabled');
                } else {
                    statusElement.removeClass('disabled').addClass('enabled');
                }
            }


            $('.frontSingleMaterial').click(function() {
                // console.log('Klik: frontSingleMaterial');

                var titleValue = $(this).find('.frontMaterialTitle').text();

                var parentId = $(this).parent().parent().attr('id');
                var statusElement = $('#' + parentId).find('.accordion-status');

                // zmeni text v sumare
                switch (parentId) {
                  case "hidden-accordion-ends":
                    updateStatusClass(statusElement);
                    $('#' + parentId + '-change').html(titleValue);
                    break;
                  case "accordion-wood-patterns":
                    updateStatusClass(statusElement);
                    $('#' + parentId + '-change').html(titleValue);
                    break;
                  case "accordion-color-standard":
                    updateStatusClass(statusElement);
                    $('#accordion-color-individual').find('.accordion-status').removeClass('disabled error enabled').addClass('none');
                    $("#accordion-color-individual input[type='radio']").removeAttr("required");
                    $("#accordion-color-standard input[type='radio']").attr("required", "required");
                    $('#accordion-color-change-title span').html('štandardné');
                    $('#accordion-color-change').html(titleValue);
                    break;
                  case "accordion-color-individual":
                    updateStatusClass(statusElement);
                    $('#accordion-color-standard').find('.accordion-status').removeClass('disabled error enabled').addClass('none');
                    $('#accordion-color-change-title span').html('špeciálne');
                    $('#accordion-color-change').html(titleValue);
                    break;
                  case "accordion-edges":
                    updateStatusClass(statusElement);
                    $('#' + parentId + '-change').html(titleValue);
                    break;
                  case "hidden-accordion-joints":
                    updateStatusClass(statusElement);
                    $('#' + parentId + '-change').html(titleValue);
                    break;
                }

            });

        </script>
        <!-- Selected items END -->

        <!-- Akordeon open close START -->
        <script>
            $(document).ready(function() {

                $('.frontMaterialTitle').click(function() {

                    var doplnkyId = $(this).parent().parent().parent().attr('id');

                    if (doplnkyId != 'accordion-akcesoria') {
                        hidePreviewAccordion(this);
                    }

                });

                function hidePreviewAccordion(param) {
                            
                    var parentId = $(param).parent().parent().parent().attr('id');
                    var contentId = $('#' + parentId).find('.content');

                    // Zavriet
                    contentId.prev('a').removeClass("active");
                    contentId.slideUp(200);

                    // Otvorit
                    var nextDiv = $('#' + parentId).nextAll('div:not(.hidden-accordion):first').attr('id');
                    $('#' + nextDiv).find("a:first").addClass("active");
                    $('#' + nextDiv).find('.content').slideDown(200);

                }

            });
        </script>
        <!-- Akordeon open close END -->

    </form>
</div>
<?php // echo $podatekVat; ?>
<script>

    var podatekVat = 0;
    var cena = <?php echo $ksztalt->cena; ?>;
    var cenaZaZaslepke = 0;
    var doplnkySpolu = 0;

    dlugosc = 0;
    var ksztalt = '<?php echo $ksztalt->ksztalt; ?>';
    var lacznieMetrow = 0;
    PowKsztaltu(ksztalt);

    $(".slider").on("input", function(e) {

        if ($(this).attr("id") == "dlugosc" || $(this).attr("id") == "szerokosc" || $(this).attr("id") == "wysokoscA" || $(this).attr("id") == "wysokoscB") {
            var wartoscZinputa = $(e.target).val();
            var wartoscDoDodania = wartoscZinputa.toString() + " cm";
            $(this).parent().find('.khcValue').text(wartoscDoDodania);
        } else {
            $(this).parent().find('.khcValue').text($(e.target).val());
        }

    });

    //obliczanie
    $(".slider").on("input", function(e) {
        PowKsztaltu(ksztalt);
    });

    $('.singleJointsBox').click(function() {
        // Vypocet ceny pre spoje
        $('#hidden-accordion-joints input:checked').each(function() {
            var countValue = $('#liczbaSztuk').val();
            var priceValue = $(this).data('input-price');
            var newPrice = (parseFloat(countValue) - 1 ) * parseFloat(priceValue);

            $("#joints-total-price").val(newPrice);
        });
        
        PowKsztaltu(ksztalt);
    });

    $('.singleWykonczeniaBox').click(function() {
        PowKsztaltu(ksztalt);
    });

    $('.singleIndywidualnyBox').click(function() {
        
        PowKsztaltu(ksztalt);
    });

    $('.singleEndingsBox').click(function() {

        // Vypocet ceny pre koncovky
        $('#hidden-accordion-ends input:checked').each(function() {
            var countValue = $('#liczbaSztuk').val();
            var priceValue = $(this).data('input-price');
            var selectedValue = $("#dodatkoweZaslepki").val();
            var newPrice = (parseFloat(priceValue) * parseFloat(countValue)) * selectedValue;

            $("#ends-total-price").val(newPrice);
        });
        PowKsztaltu(ksztalt);

    });
    $('.singleKolorBox').click(function() {
        PowKsztaltu(ksztalt);
    });
    $('#dodatkoweOzdobneKrawedzie').click(function() {
        PowKsztaltu(ksztalt);
    });
    $('#dodatkowaOzdobnaScianka').click(function() {
        PowKsztaltu(ksztalt);
    });

    $('input:radio[name=gruboscRdzenia]').click(function() {
        PowKsztaltu(ksztalt);
    });
    $('input:radio[name=przekroj]').click(function() {
        PowKsztaltu(ksztalt);
    });


    
    function PowKsztaltu(ksztalt) {
        var dodatkoweZaslepki = 0;
        if (ksztalt == 'Ceownik') {
            dodatkoweZaslepki = $('#dodatkoweZaslepki').val();
            // var gruboscRdzenia = 2.5;
            var gruboscRdzenia = 1;
            var dlugosc = $('#dlugosc').val();
            var szerokosc = $('#szerokosc').val();
            var wysokoscA = $('#wysokoscA').val();
            var wysokoscB = $('#wysokoscB').val();
            var pow1 = pPow(dlugosc, szerokosc); // gorna
            var pow2 = pPow(dlugosc, wysokoscA); // Wysokosc A PPole powierzchni
            var pow3 = pPow(dlugosc, wysokoscB); // Wysokosc A PPole powierzchni
            var pow4 = 0; // Wysokosc A PPole powierzchni
            // dodatkowe ozdobne krawędzie
            if ($('#dodatkoweOzdobneKrawedzie').prop('checked')) {
                var pow4 = pPow(dlugosc, gruboscRdzenia) * 2; // Wysokosc A PPole powierzchni
            }
            var suma = pow1 + pow2 + pow3 + pow4;
        }

        if (ksztalt == 'deska') {
            $("input:radio[name=gruboscRdzenia]:first").attr('checked', true);
            var dlugosc = $('#dlugosc').val();
            var szerokosc = 20;
            // var gruboscRdzenia = 1.1;
            var gruboscRdzenia = 1;

            var pow1 = pPow(dlugosc, szerokosc); // gora
            // var pow2 = pPow(dlugosc, gruboscRdzenia) * 2; // boki
            // var suma = pow1 + pow2;
            var suma = pow1;

        }
        if (ksztalt == 'deskaWall') {
            $("input:radio[name=gruboscRdzenia]:first").attr('checked', true);
            var dlugosc = $('#dlugosc').val();
            var szerokosc = $('#szerokosc').val();
            // var gruboscRdzenia = 2.5;

            var pow1 = pPow(dlugosc, szerokosc); // gora
            // var pow2 = pPow(dlugosc, gruboscRdzenia) * 2; // boki
            // var suma = pow1 + pow2;
            var suma = pow1;
        }
        if (ksztalt == 'elastycznaimitacjadeski') {
            $("input:radio[name=gruboscRdzenia]:first").attr('checked', true);
            var dlugosc = $('#dlugosc').val();
            var szerokosc = $('#szerokosc').val();
            // var gruboscRdzenia = $("input:radio[name=gruboscRdzenia]:checked").val();
            var gruboscRdzenia = 2.5;
            var pow1 = pPow(dlugosc, szerokosc); // gora
            var pow2 = pPow(dlugosc, gruboscRdzenia) * 2; // boki
            var suma = pow1 + pow2;

        }

        if (ksztalt == 'elastycznaokleina') {
            $("input:radio[name=gruboscRdzenia]:first").attr('checked', true);
            var dlugosc = $('#dlugosc').val();
            var szerokosc = $('#szerokosc').val();
            var gruboscRdzenia = $("input:radio[name=gruboscRdzenia]:checked").val();
            var pow1 = pPow(dlugosc, szerokosc); // gora

            var suma = pow1;

        }
        if (ksztalt == 'profilPelny') {
            dodatkoweZaslepki = $('#dodatkoweZaslepki').val();
            $("input:radio[name=przekroj]:first").attr('checked', true);
            var przekroj = $("input:radio[name=przekroj]:checked").val();
            const wartosci = przekroj.split("x");
            var dlugosc = $('#dlugosc').val();
            var wysokosc = parseFloat(wartosci[0]);
            var szerokosc = parseFloat(wartosci[1]);
            var pow1 = pPow(dlugosc, szerokosc); // gora 
            var pow2 = pPow(dlugosc, wysokosc) * 2; // gora 
            if ($('#dodatkowaOzdobnaScianka').prop('checked')) {
                pow1 = pow1 * 2; // Wysokosc A PPole powierzchni
            }
            //dodatkowa ozdobna scianka
            var suma = pow1 + pow2;

        }

        //katownik
        if (ksztalt == 'katownik') {
            var gruboscRdzenia = 2.5;
            var dlugosc = $('#dlugosc').val();
            var szerokosc = $('#szerokosc').val();
            var wysokosc = $('#wysokosc').val();
            var pow1 = pPow(dlugosc, szerokosc); // gora 
            var pow2 = pPow(dlugosc, wysokosc); // bok
            var pow3 = 0;
            if ($('#dodatkoweOzdobneKrawedzie').prop('checked')) {
                var pow3 = pPow(dlugosc, gruboscRdzenia) * 2; // Wysokosc A PPole powierzchni
            }
            var suma = pow1 + pow2 + pow3;

        }
        //profilPrzelotowy
        if (ksztalt == 'profilPrzelotowy') {
            dodatkoweZaslepki = $('#dodatkoweZaslepki').val();
            var gruboscRdzenia = 2.5;
            var dlugosc = $('#dlugosc').val();
            var szerokosc = $('#szerokosc').val();
            var wysokosc = $('#wysokosc').val();
            var pow1 = pPow(dlugosc, szerokosc) * 2; // gora 
            var pow2 = pPow(dlugosc, wysokosc) * 2; // bok
            var suma = pow1 + pow2;
        }

        // console.log(suma);
        suma = suma / 10000;



        var liczbaSztuk = $('#liczbaSztuk').val();
        sucetMetrov = (dlugosc * szerokosc * liczbaSztuk) / 10000;
        $('#lacznieMetrowFront').text(sucetMetrov);


        // console.clear();
        // console.log(sucetMetrov);


        if (ksztalt == 'deska') {
            // Cena za specialne farby
            var inputValueColorStandard = $('#accordion-color-standard .radioMaterial:checked').data('input-price');
            var inputValueColorSpecial = $('#accordion-color-individual .radioMaterial:checked').data('input-price');
            if (inputValueColorStandard === undefined) {
                var priceColorSpecial = Math.floor(sucetMetrov);
                priceColorSpecial = priceColorSpecial * inputValueColorSpecial;
            }
            if (inputValueColorSpecial === undefined) {
                var priceColorSpecial = 0;
            }
            $("#colors-special-total-price").val(priceColorSpecial);

        
            // Cena za hrany
            var cenaZaHrany = 0;
            var zaskrtnutyInput = $('.content .singleWykonczeniaBox input[type="radio"]:checked');
            var hodnotaInputPrice = zaskrtnutyInput.data('input-price');
            if (hodnotaInputPrice === undefined) {
                var hodnotaInputPrice = 0;
            }
            cenaZaHrany = Math.floor(sucetMetrov) * hodnotaInputPrice;
            $("#edges-total-price").val(cenaZaHrany);


        } else {
            // Cena za specialne farby
            var inputValueColorStandard = $('#accordion-color-standard .radioMaterial:checked').data('input-price');
            var inputValueColorSpecial = $('#accordion-color-individual .radioMaterial:checked').data('input-price');
            if (inputValueColorStandard === undefined) {
                // var priceColorSpecial = Math.floor(sucetMetrov);
                var priceColorSpecial = (dlugosc * (inputValueColorSpecial / 100) * liczbaSztuk);
                if (isNaN(priceColorSpecial)) {
                    priceColorSpecial = 0;
                }
            }
            if (inputValueColorSpecial === undefined) {
                var priceColorSpecial = 0;
            }
            // console.log('Specialne farby: ' + priceColorSpecial);
            $("#colors-special-total-price").val(priceColorSpecial);


            // Cena za hrany
            var cenaZaHrany = 0;
            var zaskrtnutyInput = $('.content .singleWykonczeniaBox input[type="radio"]:checked');
            var hodnotaInputPrice = zaskrtnutyInput.data('input-price');
            if (hodnotaInputPrice === undefined) {
                var hodnotaInputPrice = 0;
            }
            cenaZaHrany = (dlugosc * (hodnotaInputPrice / 100) * liczbaSztuk);
            // console.log('Cena za hrany: ' + cenaZaHrany);
            $("#edges-total-price").val(cenaZaHrany);

        }

        // ---
        var cenaZaSztuke = calcPrice(suma, cena);
        $('#cenazasztuke').text(cenaZaSztuke);


        // ---
        var cenaZaWszystkie = calcPriceAll(cenaZaSztuke, liczbaSztuk);
        $('#cenazawszystkie').text(cenaZaWszystkie);

        
        // ---
        var cenaZasztukeBrutto = cenaZaSztuke * podatekVat;
        cenaZasztukeBrutto = cenaZasztukeBrutto.toFixed(2);
        var cenaZaWszystkieBrutto = cenaZaWszystkie * podatekVat;
        cenaZaWszystkieBrutto = cenaZaWszystkieBrutto.toFixed(2);

        $('#cenazasztukeBrutto').text(cenaZasztukeBrutto);
        $('#cenazawszystkieBrutto').text(cenaZaWszystkieBrutto);

    }

    function pPow(a, b) {
        return a * b;
    }

    function calcPrice(metry, cena) {
        var lacznyKoszt = metry * cena;

        lacznyKoszt = lacznyKoszt.toFixed(2);

        return lacznyKoszt;
    }
    
    function calcPriceAll(cenaZasztuke, liczbaSztuk) {

        var doplnkySpolu = parseFloat($("#accessories-total-price").val());
        var hranySpolu = parseFloat($("#edges-total-price").val());
        var spojeSpolu = parseFloat($("#joints-total-price").val());
        var koncovkySpolu = parseFloat($("#ends-total-price").val());
        var farbySpecialneSpolu = parseFloat($("#colors-special-total-price").val());

        // console.log(koncovkySpolu);

        var lacznyKoszt = (cenaZasztuke * liczbaSztuk + doplnkySpolu + hranySpolu + spojeSpolu + koncovkySpolu + farbySpecialneSpolu);

        lacznyKoszt = lacznyKoszt.toFixed(2);

        return lacznyKoszt;
    }

</script>

<script>
    var oldDlugosc = $('#dlugosc').val();
    var oldSzerokosc = $('#szerokosc').val();
    var oldWysokoscA = $('#wysokoscA').val();
    var oldWysokoscB = $('#wysokoscB').val();
    var oldWysokosc = $('#wysokosc').val();
    var gruboscRdzenia = $("input[name=gruboscRdzenia]:checked").val();

    if (ksztalt == 'profilPelny') {
        var wybranyPrzekroj = $("input[name=przekroj]:checked").val();

        var wybranyPrzekrojArray = wybranyPrzekroj.split("x");

        var oldWysokoscP = parseFloat(wybranyPrzekrojArray[0]);
        var oldSzerokoscP = parseFloat(wybranyPrzekrojArray[1]);
    }

    $(".slider").on("input", function(e) {

        var inputId = $(this).attr('id');
        // console.log('X ' + inputId);

        if ($(this).attr("id") == "dlugosc") {
            // Vypocet ceny pre hrany
            $('#accordion-edges input:checked').each(function () {
                var dlugosc = $('#dlugosc').val();
                var countValue = $('#liczbaSztuk').val();
                var priceValue = $(this).data('input-price');
                var newPrice = (parseFloat(dlugosc) * (parseFloat(priceValue)) * parseFloat(countValue));

                $("#edges-total-price").val(newPrice);
            });
        }

        if ($(this).attr("id") == "liczbaSztuk") {
            // Vypocet ceny pre spoje
            $('#hidden-accordion-joints input:checked').each(function () {
                var countValue = $('#liczbaSztuk').val();
                var priceValue = $(this).data('input-price');
                var newPrice = (parseFloat(countValue) - 1) * parseFloat(priceValue);

                $("#joints-total-price").val(newPrice);
            });

            // Vypocet ceny pre hrany
            $('#accordion-edges input:checked').each(function () {
                var dlugosc = $('#dlugosc').val();
                var countValue = $('#liczbaSztuk').val();
                var priceValue = $(this).data('input-price');
                var newPrice = (parseFloat(dlugosc) * (parseFloat(priceValue)) * parseFloat(countValue));

                $("#edges-total-price").val(newPrice);
            });

        }
        if ($(this).attr("id") == "wysokoscA") {

//            var vyskaAValue = $('#wysokoscA').val();
//            var vyskaBValue = $('#wysokoscB').val();
//
//            $('#wysokoscB').parent().find('.khcValue').text(vyskaAValue + " cm");
                    
                    var vyskaAValue = $('#wysokoscA').val();
                    var vyskaBValue = $('#wysokoscB').val();

                    var sliderA = $('#wysokoscA');
                    var sliderB = $('#wysokoscB');
                    
//                    console.log(vyskaAValue);
//                    console.log(vyskaBValue);
                    
//                    $('#wysokoscB').val(vyskaAValue);
                    $('#wysokoscA').parent().find('.khcValue').text( parseFloat(vyskaAValue) + ' cm');
                    $('#wysokoscB').parent().find('.khcValue').text( parseFloat(vyskaAValue) + ' cm');
                    sliderA.val(parseFloat(vyskaAValue));
                    sliderB.val(parseFloat(vyskaAValue));
                    PowKsztaltu(ksztalt);

        }

        if ($(this).attr("id") == "dlugosc" || $(this).attr("id") == "szerokosc" || $(this).attr("id") == "wysokoscA"  || $(this).attr("id") == "wysokosc" || $(this).attr("id") == "wysokoscB") {
            var wartoscZinputa = $(e.target).val();
            var wartoscDoDodania = wartoscZinputa.toString() + " cm";
            $(this).parent().find('.khcValue').text(wartoscDoDodania);
        } else {
            $(this).parent().find('.khcValue').text($(e.target).val() + " ks");
        }





        <?php
          require_once KHC_PATH . "shapeimg/wizualizacjaRange.js";
        ?>

    });

    $('.buttonMinus, .buttonPlus').click(function () {
        var inputContainer = $(this).closest('.input-container');
        var inputId = inputContainer.find('input.slider').attr('id');
        var khcValueElement = inputContainer.find('.khcValue');

        var slider = $('#' + inputId);
        var currentValue = parseInt(slider.val());
        var step = parseInt(slider.attr('step'));
        var minValue = parseInt(slider.attr('min'));
        var maxValue = parseInt(slider.attr('max'));


        // console.log('A ' + currentValue);

        
                                         if ($(this).hasClass('buttonMinus')) {

                                             var vyskaAValue = $('#wysokoscA').val();
                                             var vyskaBValue = $('#wysokoscB').val();

                                             var sliderA = $('#wysokoscA');
                                             var sliderB = $('#wysokoscB');

                                             if (currentValue - step >= minValue) {
                                                 slider.val(currentValue - step);
                                                 if (inputId === 'liczbaSztuk') {
                                                     khcValueElement.text(currentValue - step + ' ks');
                                                     PowKsztaltu(ksztalt);
                                                 }
                                                 else if (inputId === 'wysokoscA') {
                                                     $('#wysokoscB').val(vyskaAValue);
                                                     $('#wysokoscA').parent().find('.khcValue').text( parseFloat(vyskaAValue) -  parseFloat(step) + ' cm');
                                                     $('#wysokoscB').parent().find('.khcValue').text( parseFloat(vyskaAValue) -  parseFloat(step) + ' cm');
                                                     sliderA.val(parseFloat(vyskaAValue) - parseFloat(step));
                                                     sliderB.val(parseFloat(vyskaAValue) - parseFloat(step));
                                                     PowKsztaltu(ksztalt);
                                                 }
                                                 else if (inputId === 'wysokoscB') {
                                                     $('#wysokoscB').parent().find('.khcValue').text( parseFloat(vyskaBValue) - parseFloat(step) + ' cm');
                                                     PowKsztaltu(ksztalt);
                                                 }
                                                 else {
                                                     khcValueElement.text(currentValue - step + ' cm');
                                                     PowKsztaltu(ksztalt);
                                                 }

                                                 hodnota = currentValue - step;
                                                 var aktualnaHodnota = $('#liczbaSztuk').val();

                                                 if (aktualnaHodnota < 2) {
                                                     closedAccordionJoints();
                                                     $("#hidden-accordion-joints").addClass('hidden-accordion');

                                                     $("#accordion-joints-hidden").addClass("row-display-hidden").removeClass("row-display-show");
                                                     $("#hidden-accordion-joints-change").html("-");

                                                     var statusElement = $("#hidden-accordion-joints").find('.accordion-status');
                                                     statusElement.removeClass('enabled').removeClass('error').addClass('disabled');
                                                     
                                                 }

                                                 // Vypocet ceny pre spoje
                                                 $('#hidden-accordion-joints input:checked').each(function() {
                                                     var countValue = $('#liczbaSztuk').val();
                                                     var priceValue = $(this).data('input-price');
                                                     var newPrice = (parseFloat(countValue) - 1 ) * parseFloat(priceValue);

                                                     $("#joints-total-price").val(newPrice);
                                                         PowKsztaltu(ksztalt);
                                                 });

                                                 // Vypocet ceny pre hrany
                                                 $('#accordion-edges input:checked').each(function() {
                                                     var dlugosc = $('#dlugosc').val();
                                                     var countValue = $('#liczbaSztuk').val();
                                                     var priceValue = $(this).data('input-price');
                                                     var newPrice = (parseFloat(dlugosc) * (parseFloat(priceValue)) * parseFloat(countValue));

                                                     $("#edges-total-price").val(newPrice);
                                                         PowKsztaltu(ksztalt);
                                                     });

                                                 // Vypocet ceny koncovky
                                                 $('#hidden-accordion-ends input:checked').each(function() {
                                                     var countValue = $('#liczbaSztuk').val();
                                                     var priceValue = $(this).data('input-price');
                                                     var selectedValue = $("#dodatkoweZaslepki").val();
                                                     var newPrice = (parseFloat(countValue) * (parseFloat(priceValue))) * (parseFloat(selectedValue));

                                                     $("#ends-total-price").val(newPrice);
                                                     PowKsztaltu(ksztalt);
                                                 });
                                                 PowKsztaltu(ksztalt);

                                             }
                                         }
                                         else if ($(this).hasClass('buttonPlus')) {

                                             var vyskaAValue = $('#wysokoscA').val();
                                             var vyskaBValue = $('#wysokoscB').val();

                                             var sliderA = $('#wysokoscA');
                                             var sliderB = $('#wysokoscB');

                                             if (currentValue + step <= maxValue) {
                                                 slider.val(currentValue + step);

                                                 if (inputId === 'liczbaSztuk') {
                                                     khcValueElement.text(currentValue + step + ' ks');
                                                     PowKsztaltu(ksztalt);
                                                 }
                                                 else if (inputId === 'wysokoscA') {
                                                     $('#wysokoscB').val(vyskaAValue);
                                                     $('#wysokoscA').parent().find('.khcValue').text( parseFloat(vyskaAValue) + parseFloat(step) + ' cm');
                                                     $('#wysokoscB').parent().find('.khcValue').text( parseFloat(vyskaAValue) + parseFloat(step) + ' cm');
                                                     sliderA.val(parseFloat(vyskaAValue) + parseFloat(step));
                                                     sliderB.val(parseFloat(vyskaAValue) + parseFloat(step));
                                                     PowKsztaltu(ksztalt);
                                                 }
                                                 else if (inputId === 'wysokoscB') {
                                                     $('#wysokoscB').parent().find('.khcValue').text( parseFloat(vyskaBValue) + parseFloat(step) + ' cm');
                                                     sliderB.val(parseFloat(vyskaBValue) + parseFloat(step));
                                                     PowKsztaltu(ksztalt);
                                                 }
                                                 else {
                                                     khcValueElement.text(currentValue + step + ' cm');
                                                     PowKsztaltu(ksztalt);
                                                 }

                                                 hodnota = currentValue + step;
                                                 var aktualnaHodnota = $('#liczbaSztuk').val();

                                                 if (aktualnaHodnota >= 2) {
                                                     openAccordionJoints();
                                                     $("#hidden-accordion-joints").removeClass('hidden-accordion');
                                                     
                                                     $("#accordion-joints-hidden").removeClass("row-display-hidden").addClass("row-display-show");

                                                     // Vypocet ceny pre spoje
                                                     $('#hidden-accordion-joints input:checked').each(function() {
                                                         var countValue = $('#liczbaSztuk').val();
                                                         var priceValue = $(this).data('input-price');
                                                         var newPrice = (parseFloat(countValue) - 1 ) * parseFloat(priceValue);

                                                         $("#joints-total-price").val(newPrice);
                                                         PowKsztaltu(ksztalt);
                                                     });

                                                 }

                                                 // Vypocet ceny pre hrany
                                                 $('#accordion-edges input:checked').each(function() {
                                                     var dlugosc = $('#dlugosc').val();
                                                     var countValue = $('#liczbaSztuk').val();
                                                     var priceValue = $(this).data('input-price');
                                                     var newPrice = (parseFloat(dlugosc) * (parseFloat(priceValue)) * parseFloat(countValue));

                                                     $("#edges-total-price").val(newPrice);
                                                         PowKsztaltu(ksztalt);
                                                 });

                                                 // Vypocet ceny koncovky
                                                 $('#hidden-accordion-ends input:checked').each(function() {
                                                     var countValue = $('#liczbaSztuk').val();
                                                     var priceValue = $(this).data('input-price');
                                                     var selectedValue = $("#dodatkoweZaslepki").val();
                                                     var newPrice = (parseFloat(countValue) * (parseFloat(priceValue))) * (parseFloat(selectedValue));
                                                     $("#ends-total-price").val(newPrice);
                                                     PowKsztaltu(ksztalt);
                                                 });

                                             }
                                         }



        function openAccordionJoints() {
            $("#hidden-accordion-joints input[type='radio']").attr("required", "required");
        }
        function closedAccordionJoints() {
            $("#joints-total-price").val(0);
            // Odstraní třídu "frontSingleMaterialActive" ze všech elementů s touto třídou
            $("#hidden-accordion-joints .frontSingleMaterialActive").removeClass("frontSingleMaterialActive");
            // Odstraní atribut "required" ze všech radio inputů uvnitř #accordion-color-ends
            $("#hidden-accordion-joints input[type='radio']").removeAttr("required");
            // Nastaví všechny radio inputy jako "unchecked"
            $("#hidden-accordion-joints input[type='radio']").prop("checked", false);
        }





        



        if(ksztalt == "deska"){
            if(inputId == 'dlugosc'){
                var value = parseInt(slider.val());
                var roznica = Math.abs(value - oldDlugosc);
                if(roznica == 0){
                    var newPixel = checkDirectionValue(oldDlugosc,value);
                }else{
                    var newPixel = checkDirectionValue(oldDlugosc,value)*roznica;
                }
                newPixel = Math.round(newPixel);
                $('#productCustomRight').css('width',parseFloat($('#productCustomRight').css('width'))+newPixel+'px');
                $('#productCustomRight').css('height',parseFloat($('#productCustomRight').css('height'))+newPixel+'px');
                $('#productCustomLeft').css('width',parseFloat($('#productCustomLeft').css('width'))+newPixel+'px');
                $('#productCustomLeft').css('height',parseFloat($('#productCustomLeft').css('height'))+newPixel+'px');
                $('#productCustomTopleft2').css('left',(parseFloat($('#productCustomTopleft2').css('left'))+newPixel)+'px');
                $('#productCustomTopleft2').css('height',parseFloat($('#productCustomTopleft2').css('height'))+newPixel+'px');
                $('#productCustomTopright2').css('width',parseFloat($('#productCustomTopright2').css('width'))+(newPixel)+'px');
                $('#productCustomTopright2').css('height',parseFloat($('#productCustomTopright2').css('height'))+newPixel+'px');
                $('#productCustomFront').css('top',parseFloat($('#productCustomFront').css('top'))+newPixel+'px');
                $('#productCustomFront').css('left',(parseFloat($('#productCustomFront').css('left'))+newPixel)+'px');
                oldDlugosc = value;
            }
        }
        if(ksztalt == "deskaWall"){
            if(inputId == 'dlugosc'){
                var value = parseInt(slider.val());
                var roznica = Math.abs(value - oldDlugosc);
                if(roznica == 0){
                    var newPixel = checkDirectionValue(oldDlugosc,value);
                }else{
                    var newPixel = checkDirectionValue(oldDlugosc,value)*roznica;
                }
                newPixel = Math.round(newPixel);
                $('#productCustomRight').css('width',parseFloat($('#productCustomRight').css('width'))+newPixel+'px');
                $('#productCustomRight').css('height',parseFloat($('#productCustomRight').css('height'))+newPixel+'px');
                $('#productCustomLeft').css('width',parseFloat($('#productCustomLeft').css('width'))+newPixel+'px');
                $('#productCustomLeft').css('height',parseFloat($('#productCustomLeft').css('height'))+newPixel+'px');
                $('#productCustomTopleft2').css('left',(parseFloat($('#productCustomTopleft2').css('left'))+newPixel)+'px');
                $('#productCustomTopleft2').css('height',parseFloat($('#productCustomTopleft2').css('height'))+newPixel+'px');
                $('#productCustomTopright2').css('width',parseFloat($('#productCustomTopright2').css('width'))+(newPixel)+'px');
                $('#productCustomTopright2').css('height',parseFloat($('#productCustomTopright2').css('height'))+newPixel+'px');
                $('#productCustomFront').css('top',parseFloat($('#productCustomFront').css('top'))+newPixel+'px');
                $('#productCustomFront').css('left',(parseFloat($('#productCustomFront').css('left'))+newPixel)+'px');
                oldDlugosc = value;
            }
            if(inputId=='szerokosc'){
                var value = parseInt(slider.val());
                var roznica = Math.abs(value - oldSzerokosc);
                if(roznica == 0){
                    var newPixel = checkDirectionValue(oldSzerokosc,value);
                }else{
                    var newPixel = checkDirectionValue(oldSzerokosc,value)*roznica;
                }
                newPixel = newPixel * 10;
                $('#productCustomRight').css('left',(parseFloat($('#productCustomRight').css('left'))+newPixel)+'px');
                $('#productCustomTopleft2').css('width',parseFloat($('#productCustomTopleft2').css('width'))+newPixel+'px');
                $('#productCustomTopright2').css('left',(parseFloat($('#productCustomTopright2').css('left'))+newPixel)+'px');
                $('#productCustomFront').css('width',parseFloat($('#productCustomFront').css('width'))+newPixel+'px');
                oldSzerokosc = value;
            }
        }



        // L profil
        if(ksztalt == "katownik"){

            if(inputId=='dlugosc'){
                var value = parseInt(slider.val());
                var roznica = Math.abs(value - oldDlugosc);
                if(roznica == 0){
                    var newPixel = checkDirectionValue(oldDlugosc,value);
                }else{
                    var newPixel = checkDirectionValue(oldDlugosc,value)*roznica;
                }
                newPixel = newPixel *1.2;
                newPixel = Math.round(newPixel);

                $('#productCustomLeft').css('width',parseFloat($('#productCustomLeft').css('width'))+newPixel+'px');
                $('#productCustomLeft').css('height',parseFloat($('#productCustomLeft').css('height'))+newPixel+'px');

                $('#productCustomTopleft').css('left',(parseFloat($('#productCustomTopleft').css('left'))+newPixel)+'px');
                $('#productCustomTopleft').css('height',parseFloat($('#productCustomTopleft').css('height'))+newPixel+'px');
                
                $('#productCustomTopright').css('width',parseFloat($('#productCustomTopright').css('width'))+newPixel+'px');

                $('#productCustomTopright2').css('width',parseFloat($('#productCustomTopright2').css('width'))+newPixel+'px');
                $('#productCustomTopright2').css('height',parseFloat($('#productCustomTopright2').css('height'))+newPixel+'px');

                $('#productCustomEdge1').css('top',parseFloat($('#productCustomEdge1').css('top'))+newPixel+'px');
                $('#productCustomEdge1').css('left',(parseFloat($('#productCustomEdge1').css('left'))+newPixel)+'px');
                oldDlugosc = value;
            }



            if(inputId=='szerokosc'){
                var value = parseInt(slider.val());
                var roznica = Math.abs(value - oldSzerokosc);
                if(roznica == 0){
                    var newPixel = checkDirectionValue(oldSzerokosc,value);
                }else{
                    var newPixel = checkDirectionValue(oldSzerokosc,value)*roznica;
                }
                newPixel = newPixel *5;
                $('#productCustomTopleft').css('width',parseFloat($('#productCustomTopleft').css('width'))+newPixel+'px');
                $('#productCustomTopright').css('left',(parseFloat($('#productCustomTopright').css('left'))+newPixel)+'px');
                $('#productCustomTopright2').css('left',(parseFloat($('#productCustomTopright2').css('left'))+newPixel)+'px');


                oldSzerokosc = value;

            }
            if(inputId=='wysokosc'){
                var value = parseInt(slider.val());
                var roznica = Math.abs(value - oldWysokosc);
                if(roznica == 0){
                    var newPixel = checkDirectionValue(oldWysokosc,value);
                }else{
                    var newPixel = checkDirectionValue(oldWysokosc,value)*roznica;
                }
                newPixel = newPixel *5;
                $('#productCustomLeft').css('height',parseFloat($('#productCustomLeft').css('height'))+newPixel+'px');
                $('#productCustomEdge1').css('top',parseFloat($('#productCustomEdge1').css('top'))+newPixel+'px');


                oldWysokosc = value;
            }

            if ($('#dodatkoweOzdobneKrawedzie').is(':checked')) {
                $('#productCustomTopright').css('height', $('#productCustomTopright2').css('height'));
            }


        }



        // U profil
        if(ksztalt == "Ceownik"){

            if(inputId=='dlugosc'){

                var value = parseInt(slider.val());
                var roznica = Math.abs(value - oldDlugosc);
                if(roznica == 0){
                    var newPixel = checkDirectionValue(oldDlugosc,value);
                }else{
                    var newPixel = checkDirectionValue(oldDlugosc,value)*roznica;
                }
                newPixel = Math.round(newPixel);
                $('#productCustomRight').css('width',parseFloat($('#productCustomRight').css('width'))+newPixel+'px');
                $('#productCustomRight').css('height',parseFloat($('#productCustomRight').css('height'))+newPixel+'px');

                $('#productCustomInneredge').css('width',parseFloat($('#productCustomInneredge').css('width'))+newPixel+'px');
                $('#productCustomInneredge').css('height',parseFloat($('#productCustomInneredge').css('height'))+newPixel+'px');
                
                $('#productCustomLeft').css('width',parseFloat($('#productCustomLeft').css('width'))+newPixel+'px');
                $('#productCustomLeft').css('height',parseFloat($('#productCustomLeft').css('height'))+newPixel+'px');
                
                $('#productCustomTopleft').css('left',(parseFloat($('#productCustomTopleft').css('left'))+newPixel)+'px');
                $('#productCustomTopleft').css('height',parseFloat($('#productCustomTopleft').css('height'))+newPixel+'px');

                $('#productCustomTopright').css('width',parseFloat($('#productCustomTopright').css('width'))+newPixel+'px');
                $('#productCustomTopright').css('height',parseFloat($('#productCustomTopright').css('height'))+newPixel+'px');

                $('#productCustomEdge1').css('top',parseFloat($('#productCustomEdge1').css('top'))+newPixel+'px');
                $('#productCustomEdge1').css('left',parseFloat($('#productCustomEdge1').css('left'))+newPixel+'px');

                $('#productCustomEdge2').css('top',parseFloat($('#productCustomEdge2').css('top'))+newPixel+'px');
                $('#productCustomEdge2').css('left',parseFloat($('#productCustomEdge2').css('left'))+newPixel+'px');

                $('#productCustomPlankleft').css('width',parseFloat($('#productCustomPlankleft').css('width'))+newPixel+'px');
                $('#productCustomPlankleft').css('height',parseFloat($('#productCustomPlankleft').css('height'))+newPixel+'px');

                $('#productCustomPlankright').css('width',parseInt($('#productCustomPlankright').css('width'))+newPixel+'px');
                $('#productCustomPlankright').css('height',parseInt($('#productCustomPlankright').css('height'))+newPixel+'px');

                $('#productCustomEnding2').css('top',parseFloat($('#productCustomEnding2').css('top'))+newPixel+'px');
                $('#productCustomEnding2').css('left',parseFloat($('#productCustomEnding2').css('left'))+newPixel+'px');
                // 
                oldDlugosc = value;
            }

            if(inputId=='szerokosc'){
                var value = parseInt(slider.val());
                var roznica = Math.abs(value - oldSzerokosc);
                if(roznica == 0){
                    var newPixel = checkDirectionValue(oldSzerokosc,value);
                }else{
                    var newPixel = checkDirectionValue(oldSzerokosc,value)*roznica;
                }
                newPixel = newPixel *5;
                // newPixel = Math.round(newPixel);
                $('#productCustomRight').css('left',parseFloat($('#productCustomRight').css('left'))+newPixel+'px');
                $('#productCustomInneredge').css('left',parseFloat($('#productCustomInneredge').css('left'))+newPixel+'px');
                $('#productCustomTopleft').css('width',parseFloat($('#productCustomTopleft').css('width'))+newPixel+'px');
                $('#productCustomTopright').css('left',parseFloat($('#productCustomTopright').css('left'))+newPixel+'px');
                $('#productCustomEdge2').css('left',parseFloat($('#productCustomEdge2').css('left'))+newPixel+'px');
                $('#productCustomPlankleft').css('width',parseFloat($('#productCustomPlankleft').css('width'))+newPixel+'px');
                $('#productCustomPlankright').css('left',parseFloat($('#productCustomPlankright').css('left'))+newPixel+'px');
                $('#productCustomEnding1').css('width',parseFloat($('#productCustomEnding1').css('width'))+newPixel+'px');
                $('#productCustomEnding2').css('width',parseFloat($('#productCustomEnding2').css('width'))+newPixel+'px');
                oldSzerokosc = value;
            }
            if(inputId=='wysokoscA'){

                var value = parseInt(slider.val());

                var roznica = Math.abs(value - oldWysokoscA);
                if(roznica == 0){
                    var newPixel = checkDirectionValue(oldWysokoscA,value);
                }else{
                    var newPixel = checkDirectionValue(oldWysokoscA,value)*roznica;
                }
                newPixel = newPixel *5;
                // newPixel = Math.round(newPixel);
                $('#productCustomLeft').css('height',parseFloat($('#productCustomLeft').css('height'))+newPixel+'px');
                $('#productCustomEdge1').css('top',parseFloat($('#productCustomEdge1').css('top'))+newPixel+'px');
                $('#productCustomPlankleft').css('top',parseFloat($('#productCustomPlankleft').css('top'))+newPixel+'px');
                $('#productCustomPlankright').css('top',parseFloat($('#productCustomPlankright').css('top'))+newPixel+'px');

                
                if(value > parseFloat($('#wysokoscB').val())){
                    $('#productCustomEnding1').css('height',parseFloat($('#productCustomEnding1').css('height'))+newPixel+'px');
                    $('#productCustomEnding2').css('height',parseFloat($('#productCustomEnding2').css('height'))+newPixel+'px');
                }
                if(newPixel<0){
                        if(value == parseFloat($('#wysokoscB').val())){
                        $('#productCustomEnding1').css('height',parseFloat($('#productCustomEnding1').css('height'))-(newPixel*(-1))+'px');
                        $('#productCustomEnding2').css('height',parseFloat($('#productCustomEnding2').css('height'))-(newPixel*(-1))+'px');
                        
                    }
                }

                oldWysokoscA = value;
            }
            if(inputId=='wysokoscB' || inputId=='wysokoscA'){

                var value = parseInt(slider.val());

                var roznica = Math.abs(value - oldWysokoscB);
                if(roznica == 0){
                    var newPixel = checkDirectionValue(oldWysokoscB,value);
                }else{
                    var newPixel = checkDirectionValue(oldWysokoscB,value)*roznica;
                }
                newPixel = newPixel *5;
                // newPixel = Math.round(newPixel);
                $('#productCustomRight').css('height',parseFloat($('#productCustomRight').css('height'))+newPixel+'px');
                $('#productCustomInneredge').css('top',parseFloat($('#productCustomInneredge').css('top'))+newPixel+'px');
                $('#productCustomEdge2').css('top',parseFloat($('#productCustomEdge2').css('top'))+newPixel+'px');
                $('#productCustomPlankleft').css('top',parseFloat($('#productCustomPlankleft').css('top'))+newPixel+'px');
                $('#productCustomPlankright').css('top',parseFloat($('#productCustomPlankright').css('top'))+newPixel+'px');

                if(value > parseFloat($('#wysokoscA').val())){
                    $('#productCustomEnding1').css('height',parseFloat($('#productCustomEnding1').css('height'))+newPixel+'px');
                    $('#productCustomEnding2').css('height',parseFloat($('#productCustomEnding2').css('height'))+newPixel+'px');
                }
                if(newPixel<0){
                    if(value == parseFloat($('#wysokoscA').val())){
                        $('#productCustomEnding1').css('height',parseFloat($('#productCustomEnding1').css('height'))-(newPixel*(-1))+'px');
                        $('#productCustomEnding2').css('height',parseFloat($('#productCustomEnding2').css('height'))-(newPixel*(-1))+'px');
                    
                    }
                }
                oldWysokoscB = value;
            }

            if(inputId=='dodatkoweZaslepki'){
                var value = parseInt(slider.val());
            
                if(value == 0){
                    $('#productCustomEnding1').css('visibility','hidden');
                    $('#productCustomEnding2').css('visibility','hidden');
                }
                if(value == 1){
                    $('#productCustomEnding1').css('visibility','visible');
                    $('#productCustomEnding2').css('visibility','hidden');
                }
                if(value == 2){
                    $('#productCustomEnding1').css('visibility','visible');
                    $('#productCustomEnding2').css('visibility','visible');
                }
            }

        }




        // O profil
        if(ksztalt == "profilPrzelotowy"){

            if(inputId=='dlugosc'){
                var value = parseInt(slider.val());
                var roznica = Math.abs(value - oldDlugosc);
                if(roznica == 0){
                    var newPixel = checkDirectionValue(oldDlugosc,value);
                }else{
                    var newPixel = checkDirectionValue(oldDlugosc,value)*roznica;
                }
                newPixel = newPixel *1.5;
                newPixel = Math.round(newPixel);
                $('#productCustomBottom').css('left',(parseFloat($('#productCustomBottom').css('left'))+newPixel)+'px');
                $('#productCustomBottom').css('height',parseFloat($('#productCustomBottom').css('height'))+newPixel+'px');

                $('#productCustomRight').css('width',parseFloat($('#productCustomRight').css('width'))+newPixel+'px');
                $('#productCustomRight').css('height',parseFloat($('#productCustomRight').css('height'))+newPixel+'px');

                $('#productCustomLeft').css('width',parseFloat($('#productCustomLeft').css('width'))+newPixel+'px');
                $('#productCustomLeft').css('height',parseFloat($('#productCustomLeft').css('height'))+newPixel+'px');
                
                $('#productCustomTopleft').css('left',(parseFloat($('#productCustomTopleft').css('left'))+newPixel)+'px');
                $('#productCustomTopleft').css('height',parseFloat($('#productCustomTopleft').css('height'))+newPixel+'px');

                $('#productCustomTopright').css('width',parseFloat($('#productCustomTopright').css('width'))+newPixel+'px');
                $('#productCustomTopright').css('height',parseFloat($('#productCustomTopright').css('height'))+newPixel+'px');

                $('#productCustomEdge1').css('top',parseFloat($('#productCustomEdge1').css('top'))+newPixel+'px');
                $('#productCustomEdge1').css('left',(parseFloat($('#productCustomEdge1').css('left'))+newPixel)+'px');

                $('#productCustomEdge2').css('top',parseFloat($('#productCustomEdge2').css('top'))+newPixel+'px');
                $('#productCustomEdge2').css('left',(parseFloat($('#productCustomEdge2').css('left'))+newPixel)+'px');

                $('#productCustomEnding2').css('top',parseFloat($('#productCustomEnding2').css('top'))+newPixel+'px');
                $('#productCustomEnding2').css('left',(parseFloat($('#productCustomEnding2').css('left'))+newPixel)+'px');
                oldDlugosc = value;
            }

            if(inputId=='szerokosc'){
                var value = parseInt(slider.val());
                var roznica = Math.abs(value - oldSzerokosc);
                if(roznica == 0){
                    var newPixel = checkDirectionValue(oldSzerokosc,value);
                }else{
                    var newPixel = checkDirectionValue(oldSzerokosc,value)*roznica;
                }
                // newPixel = Math.round(newPixel);
                newPixel = newPixel *5;
                
                $('#productCustomBottom').css('width',parseFloat($('#productCustomBottom').css('width'))+newPixel+'px');
                $('#productCustomRight').css('left',(parseFloat($('#productCustomRight').css('left'))+newPixel)+'px');
                $('#productCustomTopleft').css('width',parseFloat($('#productCustomTopleft').css('width'))+newPixel+'px');
                $('#productCustomTopright').css('left',(parseFloat($('#productCustomTopright').css('left'))+newPixel)+'px');
                $('#productCustomEdge2').css('left',(parseFloat($('#productCustomEdge2').css('left'))+newPixel)+'px');
                $('#productCustomEnding1').css('width',parseFloat($('#productCustomEnding1').css('width'))+newPixel+'px');
                $('#productCustomEnding2').css('width',parseFloat($('#productCustomEnding2').css('width'))+newPixel+'px');

                oldSzerokosc = value;
            }
            if(inputId=='wysokosc'){
                var value = parseInt(slider.val());
                var roznica = Math.abs(value - oldWysokosc);
                if(roznica == 0){
                    var newPixel = checkDirectionValue(oldWysokosc,value);
                }else{
                    var newPixel = checkDirectionValue(oldWysokosc,value)*roznica;
                }
                newPixel = newPixel *5;
                $('#productCustomBottom').css('top',parseFloat($('#productCustomBottom').css('top'))+newPixel+'px');
                $('#productCustomRight').css('height',parseFloat($('#productCustomRight').css('height'))+newPixel+'px');
                $('#productCustomLeft').css('height',parseFloat($('#productCustomLeft').css('height'))+newPixel+'px');
                $('#productCustomEdge1').css('top',parseFloat($('#productCustomEdge1').css('top'))+newPixel+'px');
                $('#productCustomEdge2').css('top',parseFloat($('#productCustomEdge2').css('top'))+newPixel+'px');
                $('#productCustomEnding1').css('height',parseFloat($('#productCustomEnding1').css('height'))+newPixel+'px');
                $('#productCustomEnding2').css('height',parseFloat($('#productCustomEnding2').css('height'))+newPixel+'px');


                oldWysokosc = value;
            }

            if(inputId=='dodatkoweZaslepki'){
                var value = parseInt(slider.val());
            
                if(value == 0){
                    $('#productCustomEnding1').css('visibility','hidden');
                    $('#productCustomEnding2').css('visibility','hidden');
                }
                if(value == 1){
                    $('#productCustomEnding1').css('visibility','visible');
                    $('#productCustomEnding2').css('visibility','hidden');
                }
                if(value == 2){
                    $('#productCustomEnding1').css('visibility','visible');
                    $('#productCustomEnding2').css('visibility','visible');
                }
            }

        }

    });










    // radio przekrój
    $('input[name=przekroj]').change(function() {

        wybranyPrzekroj = $("input[name=przekroj]:checked").val();

        wybranyPrzekrojArray = wybranyPrzekroj.split("x");

        var wysokoscP = parseFloat(wybranyPrzekrojArray[0]);
        var szerokoscP = parseFloat(wybranyPrzekrojArray[1]);
        var mnoznik = 5;
        // szerokosc
        $('#productCustomRight').css('left', parseFloat($('#productCustomRight').css('left')) - (oldSzerokoscP * mnoznik) + 'px');
        $('#productCustomRight').css('left', parseFloat($('#productCustomRight').css('left')) + (szerokoscP * mnoznik) + 'px');
        $('#productCustomRight').css('height', parseFloat($('#productCustomRight').css('height')) - (oldWysokoscP * mnoznik) + 'px');
        $('#productCustomRight').css('height', parseFloat($('#productCustomRight').css('height')) + (wysokoscP * mnoznik) + 'px');

        $('#productCustomLeft').css('height', parseFloat($('#productCustomLeft').css('height')) - (oldWysokoscP * mnoznik) + 'px');
        $('#productCustomLeft').css('height', parseFloat($('#productCustomLeft').css('height')) + (wysokoscP * mnoznik) + 'px');

        $('#productCustomTopleft').css('width', parseFloat($('#productCustomTopleft').css('width')) - (oldSzerokoscP * mnoznik) + 'px');
        $('#productCustomTopleft').css('width', parseFloat($('#productCustomTopleft').css('width')) + (szerokoscP * mnoznik) + 'px');

        $('#productCustomTopright').css('left', parseFloat($('#productCustomTopright').css('left')) - (oldSzerokoscP * mnoznik) + 'px');
        $('#productCustomTopright').css('left', parseFloat($('#productCustomTopright').css('left')) + (szerokoscP * mnoznik) + 'px');

        $('#productCustomFace').css('top', parseFloat($('#productCustomFace').css('top')) - (oldWysokoscP * mnoznik - 6) + 'px');
        $('#productCustomFace').css('top', parseFloat($('#productCustomFace').css('top')) + (wysokoscP * mnoznik - 6) + 'px');

        $('#productCustomFace').css('width', parseFloat($('#productCustomFace').css('width')) - (oldSzerokoscP * mnoznik - 6) + 'px');
        $('#productCustomFace').css('width', parseFloat($('#productCustomFace').css('width')) + (szerokoscP * mnoznik - 6) + 'px');


        $('#productCustomFront').css('width', parseFloat($('#productCustomFront').css('width')) - (oldSzerokoscP * mnoznik - 6) + 'px');
        $('#productCustomFront').css('width', parseFloat($('#productCustomFront').css('width')) + (szerokoscP * mnoznik - 6) + 'px');
        $('#productCustomFront').css('height', parseFloat($('#productCustomFront').css('height')) - (oldWysokoscP * mnoznik - 6) + 'px');
        $('#productCustomFront').css('height', parseFloat($('#productCustomFront').css('height')) + (wysokoscP * mnoznik - 6) + 'px');

        $('#productCustomEnding1').css('height', parseFloat($('#productCustomEnding1').css('height')) - (oldWysokoscP * mnoznik - 6) + 'px');
        $('#productCustomEnding1').css('height', parseFloat($('#productCustomEnding1').css('height')) + (wysokoscP * mnoznik - 6) + 'px');
        $('#productCustomEnding1').css('width', parseFloat($('#productCustomEnding1').css('width')) - (oldSzerokoscP * mnoznik - 6) + 'px');
        $('#productCustomEnding1').css('width', parseFloat($('#productCustomEnding1').css('width')) + (szerokoscP * mnoznik - 6) + 'px');

        $('#productCustomEnding2').css('height', parseFloat($('#productCustomEnding2').css('height')) - (oldWysokoscP * mnoznik - 6) + 'px');
        $('#productCustomEnding2').css('height', parseFloat($('#productCustomEnding2').css('height')) + (wysokoscP * mnoznik - 6) + 'px');
        $('#productCustomEnding2').css('width', parseFloat($('#productCustomEnding2').css('width')) - (oldSzerokoscP * mnoznik - 6) + 'px');
        $('#productCustomEnding2').css('width', parseFloat($('#productCustomEnding2').css('width')) + (szerokoscP * mnoznik - 6) + 'px');

        oldWysokoscP = wysokoscP;
        oldSzerokoscP = szerokoscP;

    });
    //radio
    $('input[name=gruboscRdzenia]').change(function() {
        var nowaGruboscRdzenia = parseFloat($("input[name=gruboscRdzenia]:checked").val());
        // var mnoznikRdzen = nowaGruboscRdzenia - parseFloat(gruboscRdzenia);
        var mnoznik = 3;

        // odejmowanie
        $('#productCustomRight').css('height', parseFloat($('#productCustomRight').css('height')) - parseFloat(gruboscRdzenia * mnoznik) + 'px');
        $('#productCustomLeft').css('height', parseFloat($('#productCustomLeft').css('height')) - parseFloat(gruboscRdzenia * mnoznik) + 'px');
        $('#productCustomFront').css('height', parseFloat($('#productCustomFront').css('height')) - parseFloat(gruboscRdzenia * mnoznik) + 'px');

        $('#productCustomRight').css('height', parseFloat($('#productCustomRight').css('height')) + parseFloat(nowaGruboscRdzenia * mnoznik) + 'px');
        $('#productCustomLeft').css('height', parseFloat($('#productCustomLeft').css('height')) + parseFloat(nowaGruboscRdzenia * mnoznik) + 'px');
        $('#productCustomFront').css('height', parseFloat($('#productCustomFront').css('height')) + parseFloat(nowaGruboscRdzenia * mnoznik) + 'px');
        // dodawanie

        gruboscRdzenia = $("input[name=gruboscRdzenia]:checked").val();
    });

    //checkbox
    $('#dodatkowaOzdobnaScianka').change(function() {
        if ($(this).is(':checked')) {

            $('#productCustomFace').css('visibility', 'visible');
        } else {
            $('#productCustomFace').css('visibility', 'hidden');

        }
    });

    $('#dodatkoweOzdobneKrawedzie').change(function() {
        if ($(this).is(':checked')) {
            // Do something...
            if (ksztalt == "Ceownik") {
                $('#productCustomEdge1').css('visibility', 'visible');
                $('#productCustomEdge2').css('visibility', 'visible');
                $('#productCustomInneredge').css('visibility', 'visible');
            }
            if (ksztalt == "katownik") {
                $('#productCustomTopright').css('height', $('#productCustomTopright2').css('height'));

                $('#productCustomEdge1').css('visibility', 'visible');
            }

        } else {
            if (ksztalt == "Ceownik") {
                $('#productCustomEdge1').css('visibility', 'hidden');
                $('#productCustomEdge2').css('visibility', 'hidden');
                $('#productCustomInneredge').css('visibility', 'hidden');
            }
            if (ksztalt == "katownik") {
                $('#productCustomTopright').css('height', '0px');
                $('#productCustomEdge1').css('visibility', 'hidden');


            }

        }
    });


    function checkDirectionValue(oldVal, newVal) {
        var czulosc = 15;
        var direction;
        // var steps = 5/czulosc; // o ile px przeskok
        var steps = 0.3;

        if (newVal > oldVal) {
            direction = 'right';
            return +steps;
        } else if (newVal < oldVal) {
            direction = 'left';
            return -steps;
        }
    }


    $(document).ready(function(){
      if($('.brutto-netto-switch').prop("checked") == true){
        $('.ceny-brutto-box').fadeOut();
        $('.ceny-netto-box').fadeIn();
      }
      else if($('.brutto-netto-switch').prop("checked") == false){
        $('.ceny-netto-box').fadeOut();
        $('.ceny-brutto-box').fadeIn();
      }
    });
    $('.brutto-netto-switch').click(function(){
      if($(this).prop("checked") == true){
        $('.ceny-brutto-box').fadeOut();
        $('.ceny-netto-box').fadeIn();
      }
      else if($(this).prop("checked") == false){
        $('.ceny-netto-box').fadeOut();
        $('.ceny-brutto-box').fadeIn();
      }
    });

</script>

<script>
    $(document).ready(function() {
        
        // Prida spoje dropdown
        $('#liczbaSztuk').on('input', function() {
            var hodnota = parseInt($(this).val());
            if (hodnota >= 2) {
                openAccordionJoints();
                $("#hidden-accordion-joints").removeClass('hidden-accordion');

                $("#accordion-joints-hidden").removeClass("row-display-hidden").addClass("row-display-show");
            } else {
                closedAccordionJoints();
                $("#hidden-accordion-joints").addClass('hidden-accordion');

                $("#accordion-joints-hidden").addClass("row-display-hidden").removeClass("row-display-show");
                $("#hidden-accordion-joints-change").html("-");

                var statusElement = $("#hidden-accordion-joints").find('.accordion-status');
                statusElement.removeClass('enabled').removeClass('error').addClass('disabled');  
            }
        });

        // Prida ukoncenia dropdown
        $("#dodatkoweZaslepki").change(function () {
            var hodnota = parseInt($("#dodatkoweZaslepki").val(), 10);

            if (hodnota === 0) {
                closedAccordionEnds();
                $("#hidden-accordion-ends").addClass('hidden-accordion');

                $("#accordion-ends-hidden").addClass("row-display-hidden").removeClass("row-display-show");
                $("#hidden-accordion-ends-change").html("-");
                
                var statusElement = $("#hidden-accordion-ends").find('.accordion-status');
                statusElement.removeClass('enabled').removeClass('error').addClass('disabled');  

                $("#joints-total-price").val(0);
            } else {
                openAccordionEnds();
                $("#hidden-accordion-ends").removeClass('hidden-accordion');

                $("#accordion-ends-hidden").removeClass("row-display-hidden").addClass("row-display-show");

            }

        });

        function openAccordionEnds() {
            $("#hidden-accordion-ends input[type='radio']").attr("required", "required");
        }
        function closedAccordionEnds() {
            
            $("#ends-total-price").val(0);
            PowKsztaltu(ksztalt);

            // Odstraní třídu "frontSingleMaterialActive" ze všech elementů s touto třídou
            $("#hidden-accordion-ends .frontSingleMaterialActive").removeClass("frontSingleMaterialActive");
            // Odstraní atribut "required" ze všech radio inputů uvnitř #accordion-color-ends
            $("#hidden-accordion-ends input[type='radio']").removeAttr("required");
            // Nastaví všechny radio inputy jako "unchecked"
            $("#hidden-accordion-ends input[type='radio']").prop("checked", false);
        }

        function openAccordionJoints() {
            $("#hidden-accordion-joints input[type='radio']").attr("required", "required");
        }
        function closedAccordionJoints() {
            
            $("#joints-total-price").val(0);
            PowKsztaltu(ksztalt);

            // Odstraní třídu "frontSingleMaterialActive" ze všech elementů s touto třídou
            $("#hidden-accordion-joints .frontSingleMaterialActive").removeClass("frontSingleMaterialActive");
            // Odstraní atribut "required" ze všech radio inputů uvnitř #accordion-color-ends
            $("#hidden-accordion-joints input[type='radio']").removeAttr("required");
            // Nastaví všechny radio inputy jako "unchecked"
            $("#hidden-accordion-joints input[type='radio']").prop("checked", false);
        }

    });

    // Posuvnik A a B
    jQuery("#wysokoscA").on('input', function() {
        var wysokoscA = jQuery("#wysokoscA").val();
        jQuery("#wysokoscB").val(wysokoscA).trigger( "input" );
    });

</script>

<style>
    .btnAddToCard {
        background-color: #dd8a3c !important;
    }

    .hidden-accordion {
        display: none;
    }
    .daneProfiluFront div, .daneProfiluFront .ceny-brutto-box p {
        display: block !important;
    }

    .input-container {
        display: flex;
        flex-direction: column;
        gap: 15px;
        margin: 0 0 30px 0;
    }
    .input-container input:read-only {
        width: 100%;
        margin: 0;
        padding: 0;
        border: 0;
        border-radius: 0;
    }

    
    /* Štýl slideru */
    .input-container .slider {
        background-color: #ccc;
    }
    .slider {
        -webkit-appearance: none;
        width: 100%;
        height: 5px;
        opacity: 1;
        outline: none;
        -webkit-transition: background .2s; /* Animácia pre zmenu farby */
        transition: background .2s;
    }

    /* Štýl slideru, keď je hover (myš nad sliderom) */
    .slider:hover {
        background: #dd8a3c; /* Farba slideru aj pri hoveri (nemusíte meniť farbu) */
    }

    /* Štýl posuvníka (thumb) v pôvodnej farbe */
    .slider::-webkit-slider-thumb {
        -webkit-appearance: none;
        appearance: none;
        width: 20px;
        height: 20px;
        background-color: #dd8a3c; /* Farba posuvníka */
        cursor: pointer;
    }

    /* Štýl posuvníka (thumb) pri hoveri (myš nad sliderom) */
    .slider:hover::-webkit-slider-thumb {
        background-color: #dd8a3c; /* Farba posuvníka po prejdení myšou */
    }

    .set > a {
        border-bottom: 2px solid white;
    }

    .accordion-container {
        padding: 25px 0 25px 0;
    }

    .frontSingleMaterialActive, .frontSingleSpojeActive, .frontSingleKoncovkyActive, .frontSingleSpojeVarActive, .frontSingleFarby2Active {
        background-color: #cdcfd0 !important;
    }
    .themify_builder_content-87 .tb_83f7195.module_row a, .set > a {
    }


.tb_83f7195.module_row .frontSingleMaterial a {
    padding: 0;
    border: 2px solid transparent;
}
.tb_83f7195.module_row .frontSingleMaterial a:hover {
    border: 2px solid #dd8a3c;
}
.frontMaterialImg {
  width: 100%;
  height:  100%;
  display: block;
}
.frontMaterialImg img {
  border-style: none;
  width: 100%;
  height:  100%;
  display: block;
  object-fit: cover;
  transform-origin: center;
}


</style>
