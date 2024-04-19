<?php
$zamowienia = new kalkulatorHcZamowienia;
$materialy = new kalkulatorHcMaterial;
$ustawienia = new kalkulatorHcSettings;
$lang = new kalkulatorHcLanguage;

$waluta = $ustawienia -> getSettings('waluta');
$miejsceWaluty = $ustawienia -> getSettings('miejsceWaluty');
$konfiguracjaWalutaRight = "";
$konfiguracjaWalutaLeft = "";
if($miejsceWaluty == 'right'){
  $konfiguracjaWalutaRight = $waluta;
  $konfiguracjaWalutaLeft = "";
}
if($miejsceWaluty == 'rightSpace'){
  $konfiguracjaWalutaRight = ' '.$waluta;
  $konfiguracjaWalutaLeft = "";
}
if($miejsceWaluty == 'left'){
  $konfiguracjaWalutaLeft = $waluta;
  $konfiguracjaWalutaRight="";
}
if($miejsceWaluty == 'leftSpace'){
  $konfiguracjaWalutaLeft = $waluta.' ';
  $konfiguracjaWalutaRight="";
}

if(isset($_POST['remove'])){
    $idRemove = (int)$_POST['remove'];
    $zamowienia -> removeFromCard($idRemove);
    ?>
    <script>
      var ileKoszyk = parseInt($('.cartCountMenu').text());
      ileKoszyk = ileKoszyk - 1;
      $('.cartCountMenu').text(ileKoszyk);
    </script>
      <?php
    ?>


<?php
    // usunac remove z url !
    // koszta zrobic juz z php aby byla tylko jedna funkcja liczaca
}
$koszyk = $zamowienia -> getCard();
if($koszyk == NULL){
     $zamowienia -> createCard();
    $koszyk = $zamowienia -> getCard();
}
// $zamowienia ->unsetCard();

$uri = $_SERVER['REQUEST_URI'];
$orderKoszykLink = array('action' => 'zamowienie');

?>

  
<form method="post" id="removeFromCardForm">
    <input type="hidden" value="" name="remove" id="valueToRemove">
</form>

<div class="row khc-card">

    <div class="col-12 khc-card-inside">

        <?php 
        global $wpdb;

        function zobrazitPrislusenstvo($pole) {
            $akcesoria = array();
        
            foreach ($pole as $klic => $hodnota) {
                if (strpos($klic, 'akcesoriaId-') === 0) {
                    $akcesoriaId = str_replace('akcesoriaId-', '', $klic);
                    $akcesoria[$akcesoriaId] = $hodnota;
                } elseif (strpos($klic, 'akcesoriaCount-') === 0) {
                    $akcesoriaCountId = str_replace('akcesoriaCount-', '', $klic);
                    $akcesoria[$akcesoriaCountId] = $hodnota;
                }
            }
        
            return $akcesoria;
        }





        $sumaNettoLacznie = 0;
        $sumaBruttoLacznie = 0;
        if($koszyk != NULL){
            
        foreach($koszyk as $numer => $produkt){
            $uri = $_SERVER['REQUEST_URI'];
            $removeKoszykLink = array('action' => 'koszyk','remove'=>$numer);
            $idKsztaltu = $produkt['idKsztaltu'];
            $ksztalt = $materialy -> getksztaltProfilu($idKsztaltu);
            $image = $ksztalt -> image;

            // echo "<hr>";
            // echo "<pre>";
            // echo print_r($koszyk[$numer]);
            // echo "</pre>";
            // echo "<hr>";

            $kategoria = $produkt['slugKsztaltu'];

            if ($kategoria == 'doplnky') {
                $akcesoriaId = $produkt['request']['doplnok-id'];
                $result = $wpdb->get_row("SELECT tytul, image FROM wp_calculator_aj_material WHERE ID = $akcesoriaId");
                $sumaNettoLacznie += $produkt['request']['doplnok-count'] * $produkt['request']['doplnok-price'];
            ?>
                <div class="row singleCardProduct">
                    <div class="col-2"><img src="<?php echo KHC_PATH2.'uploads/' . $result->image; ?>" class="img-fluid" alt=""></div>
                    <div class="col-8">
                        <p class="cardShapeTitle"><b><?php echo $result->tytul; ?></b></p>

                        <?php if (isset($produkt['cennik']['cenaZaWszystkieNetto'])) {; ?>
                            <div class="row paramsInCard">
                                <div class="col-6">Cena za kus s DPH:</div>
                                <div class="col-6"><?php echo $konfiguracjaWalutaLeft;?><?php echo $produkt['request']['doplnok-price']; ?><?php echo $konfiguracjaWalutaRight;?></div>
                            </div>
                        <?php } ?>
                        <?php if (isset($produkt['request']['doplnok-price'])) {; ?>
                            <div class="row paramsInCard">
                                <div class="col-6"><?php echo $lang->getLanguage('liczbaSztuk','Liczba Sztuk');?>:</div>
                                <div class="col-6"><?php echo $produkt['request']['doplnok-count']; ?> ks</div>
                            </div>
                        <?php } ?>
                        <div class="row paramsInCard cena-spolu">
                            <div class="col-6">Cena spolu s DPH:</div>
                            <div class="col-6"><?php echo $produkt['request']['doplnok-price'] * $produkt['request']['doplnok-count']; ?> €</div>
                        </div>
                    </div>
                    <div class="col-2 btnRemoveCardWrapper"><button class="btnRemoveCard" onclick="removeFromCard(<?php echo $numer;?>)"><?php echo $lang->getLanguage('usun','Usuń');?></button></div>
                </div>


            <?php
            } else if ($kategoria == 'spoje') {
                $akcesoriaId = $produkt['request']['spoje-id'];
                $result = $wpdb->get_row("SELECT tytul, image FROM wp_calculator_aj_material WHERE ID = $akcesoriaId");
                $sumaNettoLacznie += $produkt['request']['spoje-count'] * $produkt['request']['spoje-price'];
            ?>
                <div class="row singleCardProduct">
                    <div class="col-2"><img src="<?php echo KHC_PATH2.'uploads/' . $result->image; ?>" class="img-fluid" alt=""></div>
                    <div class="col-8">
                        <p class="cardShapeTitle"><b><?php echo $result->tytul; ?></b></p>

                        <?php if (isset($produkt['cennik']['cenaZaWszystkieNetto'])) {; ?>
                            <div class="row paramsInCard">
                                <div class="col-6">Cena za kus s DPH:</div>
                                <div class="col-6"><?php echo $konfiguracjaWalutaLeft;?><?php echo $produkt['request']['spoje-price']; ?><?php echo $konfiguracjaWalutaRight;?></div>
                            </div>
                        <?php } ?>
                        <?php if (isset($produkt['request']['spoje-price'])) {; ?>
                            <div class="row paramsInCard">
                                <div class="col-6"><?php echo $lang->getLanguage('liczbaSztuk','Liczba Sztuk');?>:</div>
                                <div class="col-6"><?php echo $produkt['request']['spoje-count']; ?> ks</div>
                            </div>
                        <?php } ?>
                        <div class="row paramsInCard cena-spolu">
                            <div class="col-6">Cena spolu s DPH:</div>
                            <div class="col-6"><?php echo $produkt['request']['spoje-price'] * $produkt['request']['spoje-count']; ?> €</div>
                        </div>
                    </div>
                    <div class="col-2 btnRemoveCardWrapper"><button class="btnRemoveCard" onclick="removeFromCard(<?php echo $numer;?>)"><?php echo $lang->getLanguage('usun','Usuń');?></button></div>
                </div>


            <?php
            } else if ($kategoria == 'konzoly') {
                $akcesoriaId = $produkt['request']['konzoly-id'];
                $result = $wpdb->get_row("SELECT id, tytul, caption, image FROM wp_calculator_aj_material WHERE ID = $akcesoriaId");
                $sumaNettoLacznie += $produkt['request']['konzoly-count'] * $produkt['request']['konzoly-price'];
            ?>
                <div class="row singleCardProduct">
                    <div class="col-2 col-img"><img src="<?php echo KHC_PATH2.'uploads/' . $result->image; ?>" class="img-fluid" alt=""></div>
                    <div class="col-8">
                        <p class="cardShapeTitle"><b><?php echo $produkt['request']['konzoly-title']; ?></b></p>
                        <?php if (isset($produkt['request']['konzoly-color'])) {; ?>
                            <div class="row paramsInCard">
                                <div class="col-6"><?php echo $lang->getLanguage('kolory','Farby štandardné');?>:</div>
                                <div class="col-6"><?php echo $produkt['request']['konzoly-color']; ?></div>
                            </div>
                        <?php } ?>
                            <div class="row paramsInCard">
                                <div class="col-6">Šírka:</div>
                                <div class="col-6"><?php echo $produkt['request']['konzoly-price']; ?> cm</div>
                            </div>
                        <?php if (isset($produkt['request']['konzoly-price'])) {; ?>
                            <div class="row paramsInCard">
                                <div class="col-6"><?php echo $lang->getLanguage('liczbaSztuk','Liczba Sztuk');?>:</div>
                                <div class="col-6"><?php echo $produkt['request']['konzoly-count']; ?> ks</div>
                            </div>
                        <?php } ?>
                        <?php if (isset($produkt['cennik']['cenaZaWszystkieNetto'])) {; ?>
                            <div class="row paramsInCard">
                                <div class="col-6">Cena za kus s DPH:</div>
                                <div class="col-6"><?php echo $konfiguracjaWalutaLeft;?><?php echo $produkt['request']['konzoly-price']; ?><?php echo $konfiguracjaWalutaRight;?></div>
                            </div>
                        <?php } ?>
                        <div class="row paramsInCard cena-spolu">
                            <div class="col-6">Cena spolu s DPH:</div>
                            <div class="col-6"><?php echo $produkt['request']['konzoly-price'] * $produkt['request']['konzoly-count']; ?> €</div>
                        </div>
                    </div>
                    <div class="col-2 btnRemoveCardWrapper"><button class="btnRemoveCard" onclick="removeFromCard(<?php echo $numer;?>)"><?php echo $lang->getLanguage('usun','Usuń');?></button></div>
                </div>



            <?php
            } else {
            ?>

            <div class="row singleCardProduct">
                <div class="col-2"><img src="<?php echo KHC_PATH2.'uploads/'.$image; ?>" class="img-fluid" alt=""></div>
                <div class="col-8">
                    <p class="cardShapeTitle"><b><?php echo $produkt['ksztalt'];?></b></p>
                    <!--  -->
                

                  <?php if (isset($produkt['cennik']['cenaZaWszystkieNetto'])) {; ?>
                    <?php
                        $sumaNettoLacznie += $produkt['cennik']['cenaZaWszystkieNetto'];
                        ?>
                        <div class="row paramsInCard">
                            <div class="col-6"><?php echo $lang->getLanguage('cenaBrutto','Cena brutto');?>:</div>
                            <div class="col-6"><?php echo $konfiguracjaWalutaLeft;?><?php echo $produkt['cennik']['cenaZaWszystkieNetto']; ?><?php echo $konfiguracjaWalutaRight;?></div>
                         </div>
                     <?php } ?>
                     <?php if (isset($produkt['request']['liczbaSztuk'])) {; ?>
                        <div class="row paramsInCard">
                            <div class="col-6"><?php echo $lang->getLanguage('liczbaSztuk','Liczba Sztuk');?>:</div>
                            <div class="col-6"><?php echo $produkt['request']['liczbaSztuk']; ?> ks</div>
                         </div>
                     <?php } ?>

                     <?php if (isset($produkt['nazwyMaterialow']['kolor'])) {; ?>
                        <div class="row paramsInCard">
                            <div class="col-6">Farba štandardná:</div>
                            <div class="col-6"><?php echo $produkt['nazwyMaterialow']['kolor']; ?></div>
                         </div>
                     <?php } ?>



                     <?php if (isset($produkt['nazwyMaterialow']['kolorColorIndividual'])) {; ?>
                        <div class="row paramsInCard">
                            <div class="col-6">Farba individuálna:</div>
                            <div class="col-6"><?php echo $produkt['nazwyMaterialow']['kolorColorIndividual']; ?></div>
                         </div>
                     <?php } ?>



                     <?php if (isset($produkt['nazwyMaterialow']['material'])) {; ?>
                        <div class="row paramsInCard">
                            <div class="col-6"><?php echo $lang->getLanguage('material','Materiał');?>:</div>
                            <div class="col-6"><?php echo $produkt['nazwyMaterialow']['material']; ?></div>
                         </div>
                     <?php } ?>
                     <?php if (isset($produkt['nazwyMaterialow']['wykonczenie'])) {; ?>
                        <div class="row paramsInCard">
                            <div class="col-6"><?php echo $lang->getLanguage('wykonczenia','Wykończenie');?>:</div>
                            <div class="col-6"><?php echo $produkt['nazwyMaterialow']['wykonczenie']; ?></div>
                         </div>
                     <?php } ?>



                     <?php if (isset($produkt['request']['dodatkoweZaslepki'])) {; ?>
                        <div class="row paramsInCard">
                    <div class="col-6"><?php echo $lang->getLanguage('dodatkoweZaslepki','Dodatkowe zaślepki');?>:</div>
                    <div class="col-6"><?php if($produkt['request']['dodatkoweZaslepki'] == NULL) {
                        echo $lang->getLanguage('brak','Brak');
                       
                        }else{ 
                            if($produkt['request']['dodatkoweZaslepki']>0){
                                echo $produkt['request']['dodatkoweZaslepki'] . ' ks';
                            }else{
                                echo $lang->getLanguage('brak','Brak');
                            }
                            
                            } 
                            // var_export($produkt['request']); 
                            ?></div>
                    </div>
                    <?php } ?>


                    
                     <?php if (isset($produkt['nazwyMaterialow']['endings'])) {; ?>
                        <div class="row paramsInCard">
                            <div class="col-6">Ukončenia:</div>
                            <div class="col-6"><?php echo $produkt['nazwyMaterialow']['endings']; ?></div>
                         </div>
                     <?php } ?>
                     <?php if (isset($produkt['nazwyMaterialow']['joints'])) {; ?>
                        <div class="row paramsInCard">
                            <div class="col-6">Spoje:</div>
                            <div class="col-6"><?php echo $produkt['nazwyMaterialow']['joints']; ?></div>
                         </div>
                     <?php } ?>



                     
                     <?php if (isset($produkt['nazwyMaterialow']['kolorAkcesoria'])) {; ?>
                        <div class="row paramsInCard">
                            <div class="col-6">Doplnky:</div>
                            <div class="col-6"><?php echo $produkt['nazwyMaterialow']['kolorAkcesoria']; ?></div>
                         </div>
                     <?php } ?>




                    <?php if (isset($produkt['request']['dlugosc'])) {; ?>
                        <div class="row paramsInCard">
                            <div class="col-6"><?php echo $lang->getLanguage('dlugosc','Długość');?>:</div>
                            <div class="col-6"><?php echo $produkt['request']['dlugosc']; ?> cm</div>
                         </div>
                     <?php } ?>
                     <?php if (isset($produkt['request']['szerokosc'])) {; ?>
                        <div class="row paramsInCard">
                    <div class="col-6"><?php echo $lang->getLanguage('szerokosc','Szerokość');?>:</div>
                    <div class="col-6"><?php echo $produkt['request']['szerokosc']; ?> cm</div>
                    </div>
                    <?php } ?>
                    <?php if (isset($produkt['request']['wysokosc'])) {; ?>
                        <div class="row paramsInCard">
                    <div class="col-6"><?php echo $lang->getLanguage('wysokosc','Wysokość');?>:</div>
                    <div class="col-6"><?php echo $produkt['request']['wysokosc']; ?> cm</div>
                    </div>
                    <?php } ?>
                    <?php if (isset($produkt['request']['wysokoscA'])) {; ?>
                        <div class="row paramsInCard">
                    <div class="col-6"><?php echo $lang->getLanguage('wysokoscA','Wysokość A');?>:</div>
                    <div class="col-6"><?php echo $produkt['request']['wysokoscA']; ?> cm</div>
                    </div>
                    <?php } ?>
                    <?php if (isset($produkt['request']['wysokoscB'])) {; ?>
                        <div class="row paramsInCard">
                    <div class="col-6"><?php echo $lang->getLanguage('wysokoscB','Wysokość B');?>:</div>
                    <div class="col-6"><?php echo $produkt['request']['wysokoscB']; ?> cm</div>
                    </div>
                    <?php } ?>


                    <?php if (isset($produkt['request']['gruboscRdzenia']) && $produkt['request']['id'] == 6) {; ?>
                        <div class="row paramsInCard">
                    <div class="col-6"><?php echo $lang->getLanguage('gruboscRdzenia','Grubość rdzenia');?>:</div>
                    <div class="col-6"><?php echo $produkt['request']['gruboscRdzenia']; ?> cm</div>
                    </div>
                    <?php } ?>
                    <?php if (isset($produkt['request']['gruboscRdzenia']) && $produkt['request']['id'] == 5) {; ?>
                        <div class="row paramsInCard">
                    <div class="col-6">Hrúbka profilu DOSKA:</div>
                    <div class="col-6"><?php echo $produkt['request']['gruboscRdzenia']; ?> cm</div>
                    </div>
                    <?php } ?>





                    <?php if (isset($produkt['request']['przekroj'])) {; ?>
                        <div class="row paramsInCard">
                    <div class="col-6"><?php echo $lang->getLanguage('przekroj','Przekrój');?>:</div>
                    <div class="col-6"><?php echo $produkt['request']['przekroj']; ?> cm</div>
                    </div>
                    <?php } ?>








                    <?php if (isset($produkt['request']['dodatkowaOzdobnaScianka'])) {; ?>
                        <div class="row paramsInCard">
                    <div class="col-6"><?php echo $lang->getLanguage('dodatkowaOzdobnaScianka','Dodatkowa ozdobna ścianka');?>:</div>
                    <div class="col-6"><?php echo $lang->getLanguage('tak','Tak');?></div>
                    </div>
                    <?php } ?>
                    <?php if (isset($produkt['request']['dodatkoweOzdobneKrawedzie'])) {; ?>
                    <div class="row paramsInCard">
                    <div class="col-6"><?php echo $lang->getLanguage('dodatkoweOzdobneKrawedzie','Dodatkowe ozdobne krawędzie');?>:</div>
                    <div class="col-6"><?php echo $lang->getLanguage('tak','Tak');?></div>
                    </div>
                    <?php } ?>


                    

<?php

    $akcesoria = array();

    foreach ($_SESSION['KHCkoszyk'][$numer]['request'] as $klic => $hodnota) {
        if (strpos($klic, 'akcesoriaId-') === 0) {
            $akcesoriaId = str_replace('akcesoriaId-', '', $klic);
            $akcesoria[$akcesoriaId]['count'] = $hodnota;
        } elseif (strpos($klic, 'akcesoriaCount-') === 0) {
            $akcesoriaCountId = str_replace('akcesoriaCount-', '', $klic);
            $akcesoria[$akcesoriaCountId]['count'] = $hodnota;
        }
    }



    foreach ($akcesoria as $akcesoriaId => $data) {
        $count = $data['count'];

        $result = $wpdb->get_row("SELECT tytul, price, units FROM wp_calculator_aj_material WHERE ID = $akcesoriaId");
        echo '<div class="row paramsInCard">';
        echo "<div class='col-6'>" . $result->tytul . " " . $result->units . "</div>";
        echo "<div class='col-6'>" . $count . " ks</div>";
        echo '</div>';
    }

?>






                </div>
                <div class="col-2 btnRemoveCardWrapper"><button class="btnRemoveCard" onclick="removeFromCard(<?php echo $numer;?>)"><?php echo $lang->getLanguage('usun','Usuń');?></button></div>
        </div>
        
    <?php
            } 
        }
    ?>
    <div class="row pl-3 singleCardProduct paramsInCard">
            <div class="col-12"> <p class="cardShapeTitle"><b>Zhrnutie objednávky</b></p></div>
            <div class="col-12"> <p class="cardShapeText">Suma s DPH: <?php echo $sumaNettoLacznie;?> €</p></div>
        </div>
    <?php
    
    }else{
            echo '<div class="row"><div class="col-12 emptyCardBox">'.$lang->getLanguage('koszykJestPusty','Koszyk jest pusty').'</div></div>';
        } ?>
        
    </div>

</div>
<?php
  if($koszyk != NULL){ 
    
    $get_ID = $_GET['id'];  

    switch ($get_ID) {
        case '6':
            $title = '<b>fasádne dosky</b>';
            $a_href = '/fasadne-dosky/?action=konfiguracja&id=' . $get_ID;
            break;
        case '7':
            $title = '<b>L profil</b>';
            $a_href = '/l-profil/?action=konfiguracja&id=' . $get_ID;
            break;
        case '11':
            $title = '<b>U profil</b>';
            $a_href = '/u-profil/?action=konfiguracja&id=' . $get_ID;
            break;
        case '8':
            $title = '<b>O profil</b>';
            $a_href = '/o-profil/?action=konfiguracja&id=' . $get_ID;
            break;
        case '5':
            $title = '<b>dosky na stenu</b>';
            $a_href = '/doska-profil/?action=konfiguracja&id=' . $get_ID;
            break;
        default:
            $title = '<b>doplnky</b>';
            $a_href = '/doplnky/?action=doplnky';
            break;
    }
  ?>
<div class="row">
    <div class="col-12 btnSubmitOrderBox">
        <a class="btnBack" href="../imitacie-tramov-vsetky/"><span><?php echo $lang->getLanguage('spatNaProdukty','Zobraziť <b>všetky produkty</b>');?></span></a>
        <a class="btnBack" href="<?php echo $a_href; ?>"><span><?php echo $lang->getLanguage('spatJedenKrok','Spať na '); echo $title; ?></span></a>
        <a class="btnSubmitOrder" href="<?php echo add_query_arg($orderKoszykLink, $uri); ?>" class="orderButton"><span><?php echo $lang->getLanguage('zlozZamowienie','Złóż zamówienie');?></span></a>
    </div>
</div>


    <div class="info-wrapper">
        <div class="info-wrapper-row-text">
            <p>* Nebojte sa odoslať objednávku. Objednávka je záväzná až po vzájomnom odsúhlasení a zaplatení preddavku.</p>
        </div>
    </div>




<?php } ?>
<script>

function removeFromCard(id){
    $('#valueToRemove').val(id);
    $('#removeFromCardForm').submit();

}

</script>
