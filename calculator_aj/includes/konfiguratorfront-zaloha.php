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
// echo '<pre>';
// var_export($ksztalt);
// echo '</pre>';
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
    </script>
<?php
    $koszykInfo = '<div class="row"><div class="col-12"><span style="color:green;font-size:15px;">' . $lang->getLanguage('dodanoDoKoszyka', 'Dodano do koszyka!') . '</span></div></div>';
}

?>
<link href="<?php echo KHC_PATH2 . 'shapeimg/client-product.css' ?>" rel="stylesheet">
<?php echo $koszykInfo; ?>

<div class="row khc-configurator-front">
    <form method="POST" id="formConfigurator">
        <div class="col-md-7">
            <div class="row">
                <div class="col-12 daneProfiluFront">
                    <p><b><?php echo $tytulProfilu; ?> > <?php echo $nazwaKsztaltu; ?></b></p>
                    <div>
                         Brutto <input type="checkbox" class="brutto-netto-switch" /> Netto
                    </div>
                    <div class="ceny-brutto-box">
                    <?php if ($ksztalt->ksztalt == 'deska' || $ksztalt->ksztalt == 'elastycznaimitacjadeski' || $ksztalt->ksztalt == 'elastycznaokleina') { ?>
                        <!-- <p><?php echo $lang->getLanguage('cenaZaMetr', 'Cena za metr'); ?><sup>2</sup>: <?php echo $konfiguracjaWalutaLeft; ?><span id="cenazametrkwadratowyBrutto"><?php echo number_format($ksztalt->cena * $podatekVat, 2, ',', ' '); ?></span><?php echo $konfiguracjaWalutaRight; ?> <?php echo $lang->getLanguage('brutto', 'brutto'); ?></p> -->
                    <?php } ?>   
                   
                    <p><?php echo $lang->getLanguage('cenaZaSztuke', 'Cena za sztukę'); ?>: <?php echo $konfiguracjaWalutaLeft; ?><span id="cenazasztukeBrutto">0</span><?php echo $konfiguracjaWalutaRight; ?> <?php echo $lang->getLanguage('brutto', 'brutto'); ?></p>
                    <p><?php echo $lang->getLanguage('cenaZaWszystkie', 'Cena za wszystkie'); ?>: <?php echo $konfiguracjaWalutaLeft; ?><span id="cenazawszystkieBrutto">0</span><?php echo $konfiguracjaWalutaRight; ?> <?php echo $lang->getLanguage('brutto', 'brutto'); ?></p>
                    </div>
                    <div class="ceny-netto-box">
                    <?php if ($ksztalt->ksztalt == 'deska' || $ksztalt->ksztalt == 'elastycznaimitacjadeski' || $ksztalt->ksztalt == 'elastycznaokleina') { ?>
                        <!-- <p><?php echo $lang->getLanguage('cenaZaMetr', 'Cena za metr'); ?><sup>2</sup>: <span id="cenazametrkwadratowy"><?php echo $konfiguracjaWalutaLeft; ?><?php echo $ksztalt->cena; ?></span><?php echo $konfiguracjaWalutaRight; ?> <?php echo $lang->getLanguage('netto', 'netto'); ?></p> -->
                    <?php } ?>
                    <!-- <p><?php echo $lang->getLanguage('cenaZaMetr', 'Cena za metr'); ?><sup>2</sup>: <span id="cenazametrkwadratowy"><?php echo $konfiguracjaWalutaLeft; ?><?php echo $ksztalt->cena; ?></span><?php echo $konfiguracjaWalutaRight; ?> <?php echo $lang->getLanguage('netto', 'netto'); ?></p> -->
                    <p><?php echo $lang->getLanguage('cenaZaSztuke', 'Cena za sztukę'); ?>: <?php echo $konfiguracjaWalutaLeft; ?><span id="cenazasztuke">0</span><?php echo $konfiguracjaWalutaRight; ?> <?php echo $lang->getLanguage('netto', 'netto'); ?></p> 
                    <p><?php echo $lang->getLanguage('cenaZaWszystkie', 'Cena za wszystkie'); ?>: <?php echo $konfiguracjaWalutaLeft; ?><span id="cenazawszystkie">0</span><?php echo $konfiguracjaWalutaRight; ?> <?php echo $lang->getLanguage('netto', 'netto'); ?></p> 
                    </div>

                   
                   
                   
                    <?php if ($ksztalt->ksztalt == 'deska1' || $ksztalt->ksztalt == 'elastycznaimitacjadeski1' || $ksztalt->ksztalt == 'elastycznaokleina1') { ?>
                        <!-- usunac 1 aby pokazac -->
                        <p><?php echo $lang->getLanguage('lacznieMetrow', 'Łącznie metrów'); ?>: <span id="lacznieMetrowFront">0</span> m<sup>2</sup></p>
                    <?php } ?>   
                </div>
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

                    <div id="productCustomBottom" style="top: 33px; left: 25px; width: 79px; height: 45px;"></div>
                    <div id="productCustomRight" style="top: 0px; left: 59px; width: 45px; height: 58px;"></div>
                    <div id="productCustomLeft" style="top: 0px; left: 0px; width: 45px; height: 78px;"></div>
                    <div id="productCustomTopleft" style="top: 0px; left: -225px; width: 329px; height: 45px;"></div>
                    <div id="productCustomTopright" style="top: 0px; left: 79px; width: 25px; height: 45px;"></div>
                    <div id="productCustomEdge1" style="top: 73px; left: 25px; width: 20px; height: 5px; visibility: visible;"></div>
                    <div id="productCustomEdge2" style="top: 73px; left: 84px; width: 20px; height: 5px; visibility: visible;"></div>
                    <div id="productCustomEnding1" style="top: -10px; left: -10px; width: 79px; height: 53px; visibility: hidden;"></div>
                    <div id="productCustomEnding2" style="top: 35px; left: 35px; width: 79px; height: 53px; visibility: hidden;"></div>

                <?php }
                ?>
                <?php if ($ksztalt->ksztalt == 'katownik') {
                ?>
                    <div id="productCustomLeft" style="top: 0px; left: 0px; width: 70px; height: 103px;"></div>
                    <div id="productCustomTopleft" style="top: 0px; left: -200px; width: 329px; height: 70px;"></div>
                    <div id="productCustomTopright" style="top: 0px; left: 79px; width: 50px; height: 0px;"></div>
                    <div id="productCustomTopright2" style="top: 0px; left: 79px; width: 50px; height: 70px;"></div>
                    <div id="productCustomEdge1" style="top: 98px; left: 50px; width: 20px; height: 5px; visibility: hidden;"></div>
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


        </div>

        <div class="col-md-5 mt-3">

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
                            $czyCm = "cm";
                        } else {
                            $czyCm = "";
                        }
            ?>

                        <div class="input-container">
                            <label for="<?php echo $title; ?>"><?php echo $lang->getLanguage($title, $tytul); ?>: <span class="khcValue"><?php echo $min; ?><?php echo $czyCm; ?></span></label>
                            <input type="range" step="<?php echo $step; ?>" min="<?php echo $min; ?>" max="<?php echo $max; ?>" value="<?php echo $min; ?>" class="slider" id="<?php echo $title; ?>" name="<?php echo $title; ?>">
                        </div>

                    <?php

                    }
                    //Dodatkowe zaślepki
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
                    // Grubosc rdzenia
                    if ($title == "gruboscRdzenia") {
                        $tytul = $value['tytul'];
                        echo '<label class="mt-1 otherLabel">' . $lang->getLanguage($title, $tytul) . '</label>';
                        foreach ($value['wartosci'] as $gruboscRdzenia) {

                            $nazwa = $gruboscRdzenia;
                        ?>
                            <div class="input-container">
                                <label><input type="radio" name="gruboscRdzenia" value="<?php echo $nazwa; ?>"><?php echo $nazwa; ?>cm</label><br>

                            </div>
                        <?php

                        }
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
            <div class="accordion-container">

                <div class="set">
                    <a>
                        <?php echo $lang->getLanguage('materialy', 'Materiały'); ?>
                        <i class="fa fa-plus"></i>
                    </a>
                    <div class="content">
                        <!-- Materialy -->

                        <?php foreach ($przypisaneMaterialy as $singleMaterial) {
                            if ($singleMaterial['przypisany'] == false) continue;
                        ?>
                            <div class="row frontSingleMaterial singleMaterialBox">
                                <div class="col-md-4 frontMaterialImg"><img src="<?php echo KHC_PATH2 . 'uploads/' . $singleMaterial['image']; ?>" alt=""></div>
                                <div class="col-md-8 frontMaterialTitle"><?php echo $singleMaterial['tytul']; ?></div>
                                <input type="radio" name="material" class="radioMaterial" value="<?php echo $singleMaterial['id']; ?>" required> <!-- required -->
                            </div>
                        <?php } ?>

                        <!-- -->
                    </div>
                </div>
                <div class="set">
                    <a>
                        <?php // echo $lang->getLanguage('kolory', 'Kolory'); ?>
                        Farby štandardné
                        <i class="fa fa-plus"></i>
                    </a>
                    <div class="content">
                        <!-- kolory -->

                        <?php foreach ($przypisaneKolory as $singleMaterial) {

                            if ($singleMaterial['przypisany'] == false) continue;
                        ?>
                            <div class="row frontSingleMaterial singleKolorBox">
                                <div class="col-md-4 frontMaterialImg"><img src="<?php echo KHC_PATH2 . 'uploads/' . $singleMaterial['image']; ?>" alt=""></div>
                                <div class="col-md-8 frontMaterialTitle"><?php echo $singleMaterial['tytul']; ?></div>
                                <input type="radio" name="kolor" class="radioMaterial radioMaterial" value="<?php echo $singleMaterial['id']; ?>" required> <!-- required -->
                            </div>
                        <?php } ?>

                        <!-- -->
                    </div>
                </div>

                <!-- Dropdown menu Indywidualny -->
                <div class="set">
                  <a>Farby individuálne<i class="fa fa-plus"></i></a>
                  <div class="content">
                    <?php
                      foreach ($przypisaneIndywidualny as $singleMaterial) {
                        if ($singleMaterial['przypisany'] == false) continue;
                    ?>
                    <div class="row frontSingleMaterial singleIndywidualnyBox">
                      <div class="col-md-4 frontMaterialImg"><img src="<?php echo KHC_PATH2 . 'uploads/' . $singleMaterial['image']; ?>" alt=""></div>
                      <div class="col-md-8 frontMaterialTitle"><?php echo $singleMaterial['tytul']; ?></div>
                      <input type="radio" name="kolorIndywidualny" class="radioMaterial" value="<?php echo $singleMaterial['id']; ?>" required>  <!-- required -->
                    </div>
                  <?php } ?>
                  </div>
                </div>


                <div class="set">
                    <a>
                        <?php echo $lang->getLanguage('wykonczenia', 'Wykończenia'); ?>
                        <i class="fa fa-plus"></i>
                    </a>
                    <div class="content">
                        <!-- Wykończenia -->

                        <?php foreach ($przypisaneWykonczenia as $singleMaterial) {
                            if ($singleMaterial['przypisany'] == false) continue;
                        ?>
                            <div class="row frontSingleMaterial singleWykonczeniaBox">
                                <div class="col-md-4 frontMaterialImg"><img src="<?php echo KHC_PATH2 . 'uploads/' . $singleMaterial['image']; ?>" alt=""></div>
                                <div class="col-md-8 frontMaterialTitle"><?php echo $singleMaterial['tytul']; ?></div>
                                <input type="radio" name="wykonczenie" class="radioMaterial" value="<?php echo $singleMaterial['id']; ?>" required> <!-- required -->
                            </div>
                        <?php } ?>

                        <!-- -->
                    </div>
                </div>



                <!-- Dropdown menu joints -->
                <div id="set-joins" class="set set-joins-hidden">
                  <a>Spoje<i class="fa fa-plus"></i></a>
                  <div class="content">
                    <?php
                      foreach ($przypisaneJoints as $singleMaterial) {
                        if ($singleMaterial['przypisany'] == false) continue;
                    ?>
                    <div class="row frontSingleMaterial singleJointsBox">
                      <div class="col-md-4 frontMaterialImg"><img src="<?php echo KHC_PATH2 . 'uploads/' . $singleMaterial['image']; ?>" alt=""></div>
                      <div class="col-md-8 frontMaterialTitle"><?php echo $singleMaterial['tytul']; ?></div>
                      <input type="radio" name="joints" class="radioMaterial" value="<?php echo $singleMaterial['id']; ?>" required>  <!-- required -->
                    </div>
                  <?php } ?>
                  </div>
                </div>
                <!-- Dropdown menu accessories -->
                <div class="set">
                  <a>Doplnky<i class="fa fa-plus"></i></a>
                  <div class="content">
                    <?php
                      foreach ($przypisaneAccessories as $singleMaterial) {
                        if ($singleMaterial['przypisany'] == false) continue;
                    ?>
                    <div class="row frontSingleMaterial singleAkcesoriaBox">
                      <div class="col-md-4 frontMaterialImg"><img src="<?php echo KHC_PATH2 . 'uploads/' . $singleMaterial['image']; ?>" alt=""></div>
                      <div class="col-md-8 frontMaterialTitle"><?php echo $singleMaterial['tytul']; ?></div>
                      <input type="radio" name="kolorAkcesoria" class="radioMaterial" value="<?php echo $singleMaterial['id']; ?>" required>  <!-- required -->
                    </div>
                  <?php } ?>
                  </div>
                </div>




            </div>
            <div class="col-12 btnaddToCardBox">
             <button class="btnAddToCard" name="submit"><?php echo $lang->getLanguage('dodajDoKoszyka','Dodaj do koszyka');?></button>
            </div>
        </div>

        <!-- Akordeon -->


        <script>
            $(document).ready(function() {
                $(".set > a").on("click", function() {
                    if ($(this).hasClass("active")) {
                        $(this).removeClass("active");
                        $(this)
                            .siblings(".content")
                            .slideUp(200);
                        $(".set > a i")
                            .removeClass("fa-minus")
                            .addClass("fa-plus");
                    } else {
                        $(".set > a i")
                            .removeClass("fa-minus")
                            .addClass("fa-plus");
                        $(this)
                            .find("i")
                            .removeClass("fa-plus")
                            .addClass("fa-minus");
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
                }
                if ($(this).hasClass('singleWykonczeniaBox')) {
                    $('.singleWykonczeniaBox').removeClass('frontSingleMaterialActive');
                    $(this).addClass('frontSingleMaterialActive');
                }



                if ($(this).hasClass('singleIndywidualnyBox')) {
                    $('.singleIndywidualnyBox').removeClass('frontSingleMaterialActive');
                    $(this).addClass('frontSingleMaterialActive');
                }
                if ($(this).hasClass('singleAkcesoriaBox')) {
                    $('.singleAkcesoriaBox').removeClass('frontSingleMaterialActive');
                    $(this).addClass('frontSingleMaterialActive');
                }
            });

            $(document).ready(function() {
                // $('.singleMaterialBox').first().find('.radioMaterial').prop('checked', true);
                // $('.singleMaterialBox').first().addClass('frontSingleMaterialActive');
                // $('.singleKolorBox').first().find('.radioMaterial').prop('checked', true);
                // $('.singleKolorBox').first().addClass('frontSingleMaterialActive');
                // $('.singleWykonczeniaBox').first().find('.radioMaterial').prop('checked', true);
                // $('.singleWykonczeniaBox').first().addClass('frontSingleMaterialActive');
                var totalCountMaterial = $(".singleMaterialBox > input").length;
                var totalCountKolor = $(".singleKolorBox > input").length;
                var totalCountWykonczenia = $(".singleWykonczeniaBox > input").length;
                
                var totalCountIndywidualny = $(".singleIndywidualnyBox > input").length;
                var totalCountAkcesoria = $(".singleAkcesoriaBox > input").length;

                if(totalCountMaterial==1){
                    $('.singleMaterialBox').first().find('.radioMaterial').prop('checked', true);
                    $('.singleMaterialBox').first().addClass('frontSingleMaterialActive');
                }
                if(totalCountKolor==1){
                    $('.singleKolorBox').first().find('.radioMaterial').prop('checked', true);
                    $('.singleKolorBox').first().addClass('frontSingleMaterialActive');
                }
                if(totalCountWykonczenia==1){
                    $('.singleWykonczeniaBox').first().find('.radioMaterial').prop('checked', true);
                    $('.singleWykonczeniaBox').first().addClass('frontSingleMaterialActive');
                }
                
                if(totalCountIndywidualny==1){
                    $('.singleIndywidualnyBox').first().find('.radioMaterial').prop('checked', true);
                    $('.singleIndywidualnyBox').first().addClass('frontSingleMaterialActive');
                }
                if(totalCountAkcesoria==1){
                    $('.singleAkcesoriaBox').first().find('.radioMaterial').prop('checked', true);
                    $('.singleAkcesoriaBox').first().addClass('frontSingleMaterialActive');
                }
            });
            $('.btnAddToCard').click(function() {
                var totalCountMaterial = $(".singleMaterialBox > input").length;
                var totalCountKolor = $(".singleKolorBox > input").length;
                var totalCountWykonczenia = $(".singleWykonczeniaBox > input").length;
                
                var totalCountIndywidualny = $(".singleIndywidualnyBox > input").length;
                var totalCountAkcesoria = $(".singleAkcesoriaBox > input").length;

                if(totalCountMaterial>1){
                    if($('.singleMaterialBox').find('.radioMaterial').prop('checked') == false){
                        $('.singleMaterialBox').parent().parent().css('background','#ffa3a3');
                    }
                }
                if(totalCountKolor>1){
                    if($('.singleKolorBox').find('.radioMaterial').prop('checked') == false){
                        $('.singleKolorBox').parent().parent().css('background','#ffa3a3');
                    }
                }
                if(totalCountWykonczenia>1){
                    if($('.singleWykonczeniaBox').find('.radioMaterial').prop('checked') == false){
                        $('.singleWykonczeniaBox').parent().parent().css('background','#ffa3a3');
                    }
                }
                
                if(totalCountWykonczenia>1){
                    if($('.singleIndywidualnyBox').find('.radioMaterial').prop('checked') == false){
                        $('.singleIndywidualnyBox').parent().parent().css('background','#ffa3a3');
                    }
                }                
                if(totalCountWykonczenia>1){
                    if($('.singleAkcesoriaBox').find('.radioMaterial').prop('checked') == false){
                        $('.singleAkcesoriaBox').parent().parent().css('background','#ffa3a3');
                    }
                }

                //#f5f5f5
            });
            $('.singleMaterialBox').click(function() {
                $(this).parent().parent().css('background','#f5f5f5');
            });
            $('.singleKolorBox').click(function() {
                $(this).parent().parent().css('background','#f5f5f5');
            });
            $('.singleWykonczeniaBox').click(function() {
                $(this).parent().parent().css('background','#f5f5f5');
            });
            
            $('.singleIndywidualnyBox').click(function() {
                $(this).parent().parent().css('background','#f5f5f5');
            });
            $('.singleAkcesoriaBox').click(function() {
                $(this).parent().parent().css('background','#f5f5f5');
            });
        </script>
        <!-- Koniec akordeona -->



    </form>
</div>

<script>
    var podatekVat = <?php echo $podatekVat; ?>;
    var cena = <?php echo $ksztalt->cena; ?>;
    var cenaZaZaslepke = <?php echo $cenaZaZaslepke; ?>;
    dlugosc = 0;
    var ksztalt = '<?php echo $ksztalt->ksztalt; ?>';
    var lacznieMetrow = 0;
    PowKsztaltu(ksztalt);




    $(".slider").on("input", function(e) {

        if ($(this).attr("id") == "dlugosc" || $(this).attr("id") == "szerokosc" || $(this).attr("id") == "wysokoscA" || $(this).attr("id") == "wysokoscB") {
            var wartoscZinputa = $(e.target).val();
            var wartoscDoDodania = wartoscZinputa.toString() + "cm";
            $(this).parent().find('.khcValue').text(wartoscDoDodania);

        } else {
            $(this).parent().find('.khcValue').text($(e.target).val());

        }

    });

    //obliczanie
    $(".slider").on("input", function(e) {
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
            var gruboscRdzenia = 2.5;
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
            var szerokosc = $('#szerokosc').val();
            var gruboscRdzenia = $("input:radio[name=gruboscRdzenia]:checked").val();
            var pow1 = pPow(dlugosc, szerokosc); // gora
            var pow2 = pPow(dlugosc, gruboscRdzenia) * 2; // boki
            var suma = pow1 + pow2;

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
        // przeliczenie cm2 na metry2
        // console.log(suma);

        suma = suma / 10000;
        lacznieMetrow = suma;
        $('#lacznieMetrowFront').text(lacznieMetrow);
        // console.log(suma)
        var cenaZaSztuke = calcPrice(suma, cena, dodatkoweZaslepki, cenaZaZaslepke);
        $('#cenazasztuke').text(cenaZaSztuke);

        var liczbaSztuk = $('#liczbaSztuk').val();

        var cenaZaWszystkie = calcPriceAll(cenaZaSztuke, liczbaSztuk);
        $('#cenazawszystkie').text(cenaZaWszystkie);

        var cenaZasztukeBrutto = cenaZaSztuke * podatekVat;
        cenaZasztukeBrutto = cenaZasztukeBrutto.toFixed(2);
        var cenaZaWszystkieBrutto = cenaZaWszystkie * podatekVat;
        cenaZaWszystkieBrutto = cenaZaWszystkieBrutto.toFixed(2);

        $('#cenazasztukeBrutto').text(cenaZasztukeBrutto);
        $('#cenazawszystkieBrutto').text(cenaZaWszystkieBrutto);
    }
    // liczba sztuk i dodatkowe zaslepki pozniej

    function pPow(a, b) {

        return a * b;

    }

    function calcPrice(metry, cena, dodatkoweZaslepki, cenaZaZaslepke) {
        var dodatkoweZaslepkiKoszt = cenaZaZaslepke * dodatkoweZaslepki;
        var lacznyKoszt = metry * cena + dodatkoweZaslepkiKoszt;
        // console.log("Koszt:"+lacznyKoszt);
        lacznyKoszt = lacznyKoszt.toFixed(2);
        return lacznyKoszt;
    }

    function calcPriceAll(cenaZasztuke, liczbaSztuk) {

        var lacznyKoszt = cenaZasztuke * liczbaSztuk;
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

    // var ksztalt = "Ceownik";

    $(".slider").on("input", function(e) {

        // if($( "#productCustomRight" ).data( "dlugosc", true )){
        // 	console.log("tak");
        // }

        var inputId = $(this).attr('id');

        // $(this).parent().find('.khcValue').text($(e.target).val());
        if ($(this).attr("id") == "dlugosc" || $(this).attr("id") == "szerokosc" || $(this).attr("id") == "wysokoscA" || $(this).attr("id") == "wysokoscB") {
            var wartoscZinputa = $(e.target).val();
            var wartoscDoDodania = wartoscZinputa.toString() + "cm";
            $(this).parent().find('.khcValue').text(wartoscDoDodania);

        } else {
            $(this).parent().find('.khcValue').text($(e.target).val());

        }
        <?php
        require_once KHC_PATH . "shapeimg/wizualizacjaRange.js";
        ?>


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
        var steps = 0.3; // o ile px przeskok

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
<style>
    .btnAddToCard {
        background-color: #dd8a3c !important;
    }

    .set-joins-hidden {
        display: none;
        border: 1px solid red;
    }
    .daneProfiluFront div, .daneProfiluFront .ceny-brutto-box p {
        display: block !important;
    }






</style>

<script>

$(document).ready(function() {


    $('#liczbaSztuk').on('input', function() {
        var hodnota = parseInt($(this).val());
        if (hodnota >= 2) {
            $("#set-joins").removeClass('set-joins-hidden');
        } else {
            $("#set-joins").addClass('set-joins-hidden');
        }
    });



});



</script>