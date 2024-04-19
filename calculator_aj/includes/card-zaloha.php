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
        $sumaNettoLacznie = 0;
        $sumaBruttoLacznie = 0;
        if($koszyk != NULL){
            
        foreach($koszyk as $numer => $produkt){
            $uri = $_SERVER['REQUEST_URI'];
            $removeKoszykLink = array('action' => 'koszyk','remove'=>$numer);
            $idKsztaltu = $produkt['idKsztaltu'];
            $ksztalt = $materialy -> getksztaltProfilu($idKsztaltu);
            $image = $ksztalt -> image;
            
            ?>
        <div class="row singleCardProduct">
                <div class="col-2"><img src="<?php echo KHC_PATH2.'uploads/'.$image; ?>" class="img-fluid" alt=""></div>
                <div class="col-8">
                    <p class="cardShapeTitle"><?php echo $produkt['ksztalt'];?></p>
                    <!--  -->
                

                  <?php if (isset($produkt['cennik']['cenaZaWszystkieNetto'])) {; ?>
                    <?php
                        $sumaNettoLacznie += $produkt['cennik']['cenaZaWszystkieNetto'];
                        ?>
                        <div class="row paramsInCard">
                            <div class="col-6"><?php echo $lang->getLanguage('cenaNetto','Cena netto');?></div>
                            <div class="col-6"><?php echo $konfiguracjaWalutaLeft;?><?php echo $produkt['cennik']['cenaZaWszystkieNetto']; ?><?php echo $konfiguracjaWalutaRight;?></div>
                         </div>
                     <?php } ?>
                     <?php if (isset($produkt['cennik']['cenaZaWszystkieBrutto'])) {; ?>
                        <?php
                        $sumaBruttoLacznie += $produkt['cennik']['cenaZaWszystkieBrutto'];
                        ?>
                        <div class="row paramsInCard">
                            <div class="col-6"><?php echo $lang->getLanguage('cenaBrutto','Cena brutto');?></div>
                            <div class="col-6"><?php echo $konfiguracjaWalutaLeft;?><?php echo $produkt['cennik']['cenaZaWszystkieBrutto']; ?><?php echo $konfiguracjaWalutaRight;?></div>
                         </div>
                     <?php } ?>
                     <?php if (isset($produkt['request']['liczbaSztuk'])) {; ?>
                        <div class="row paramsInCard">
                            <div class="col-6"><?php echo $lang->getLanguage('liczbaSztuk','Liczba Sztuk');?></div>
                            <div class="col-6"><?php echo $produkt['request']['liczbaSztuk']; ?></div>
                         </div>
                     <?php } ?>

                     <?php if (isset($produkt['nazwyMaterialow']['kolor'])) {; ?>
                        <div class="row paramsInCard">
                            <div class="col-6"><?php echo $lang->getLanguage('kolor','Kolor');?></div>
                            <div class="col-6"><?php echo $produkt['nazwyMaterialow']['kolor']; ?></div>
                         </div>
                     <?php } ?>
                     <!-- -------------------------------------------------------------------------------------------------------- Doplnene 18. 8. 2023 -->
                     <?php if (isset($produkt['nazwyMaterialow']['kolorIndywidualny'])) {; ?>
                        <div class="row paramsInCard">
                            <div class="col-6">Farby špeciálne</div>
                            <div class="col-6">xxx</div>
                         </div>
                     <?php } ?>
                     <!-- ----------------------------------------------------------------------------------------------------------------------------- -->

                     <?php if (isset($produkt['nazwyMaterialow']['material'])) {; ?>
                        <div class="row paramsInCard">
                            <div class="col-6"><?php echo $lang->getLanguage('material','Materiał');?></div>
                            <div class="col-6"><?php echo $produkt['nazwyMaterialow']['material']; ?></div>
                         </div>
                     <?php } ?>

                     <!-- -------------------------------------------------------------------------------------------------------- Doplnene 18. 8. 2023 -->
                    <?php if (isset($produkt['nazwyMaterialow']['kolorAkcesoria'])) {; ?>
                    <div class="row paramsInCard">
                        <div class="col-6">Doplnky</div>
                        <div class="col-6">xxx</div>
                        </div>
                    <?php } ?>
                     <!-- ----------------------------------------------------------------------------------------------------------------------------- -->
                     <?php if (isset($produkt['nazwyMaterialow']['wykonczenie'])) {; ?>
                        <div class="row paramsInCard">
                            <div class="col-6"><?php echo $lang->getLanguage('wykonczenie','Wykończenie');?></div>
                            <div class="col-6"><?php echo $produkt['nazwyMaterialow']['wykonczenie']; ?></div>
                         </div>
                     <?php } ?>
                    <?php if (isset($produkt['request']['dlugosc'])) {; ?>
                        <div class="row paramsInCard">
                            <div class="col-6"><?php echo $lang->getLanguage('dlugosc','Długość');?></div>
                            <div class="col-6"><?php echo $produkt['request']['dlugosc']; ?> cm</div>
                         </div>
                     <?php } ?>
                     <?php if (isset($produkt['request']['szerokosc'])) {; ?>
                        <div class="row paramsInCard">
                    <div class="col-6"><?php echo $lang->getLanguage('szerokosc','Szerokość');?></div>
                    <div class="col-6"><?php echo $produkt['request']['szerokosc']; ?> cm</div>
                    </div>
                    <?php } ?>
                    <?php if (isset($produkt['request']['wysokosc'])) {; ?>
                        <div class="row paramsInCard">
                    <div class="col-6"><?php echo $lang->getLanguage('wysokosc','Wysokość');?></div>
                    <div class="col-6"><?php echo $produkt['request']['wysokosc']; ?> cm</div>
                    </div>
                    <?php } ?>
                    <?php if (isset($produkt['request']['wysokoscA'])) {; ?>
                        <div class="row paramsInCard">
                    <div class="col-6"><?php echo $lang->getLanguage('wysokoscA','Wysokość A');?></div>
                    <div class="col-6"><?php echo $produkt['request']['wysokoscA']; ?> cm</div>
                    </div>
                    <?php } ?>
                    <?php if (isset($produkt['request']['wysokoscB'])) {; ?>
                        <div class="row paramsInCard">
                    <div class="col-6"><?php echo $lang->getLanguage('wysokoscB','Wysokość B');?></div>
                    <div class="col-6"><?php echo $produkt['request']['wysokoscB']; ?> cm</div>
                    </div>
                    <?php } ?>
                    <?php if (isset($produkt['request']['gruboscRdzenia'])) {; ?>
                        <div class="row paramsInCard">
                    <div class="col-6"><?php echo $lang->getLanguage('gruboscRdzenia','Hrúbka jadra');?></div>
                    <div class="col-6"><?php echo $produkt['request']['gruboscRdzenia']; ?> cm</div>
                    </div>
                    <?php } ?>
                    <?php if (isset($produkt['request']['przekroj'])) {; ?>
                        <div class="row paramsInCard">
                    <div class="col-6"><?php echo $lang->getLanguage('przekroj','Przekrój');?></div>
                    <div class="col-6"><?php echo $produkt['request']['przekroj']; ?> cm</div>
                    </div>
                    <?php } ?>
                    <?php if (isset($produkt['request']['dodatkoweZaslepki'])) {; ?>
                        <div class="row paramsInCard">
                    <div class="col-6"><?php echo $lang->getLanguage('dodatkoweZaslepki','Dodatkowe zaślepki');?></div>
                    <div class="col-6"><?php if($produkt['request']['dodatkoweZaslepki'] == NULL) {
                        echo $lang->getLanguage('brak','Brak');
                       
                        }else{ 
                            if($produkt['request']['dodatkoweZaslepki']>0){
                                echo $produkt['request']['dodatkoweZaslepki'];
                            }else{
                                echo $lang->getLanguage('brak','Brak');
                            }
                            
                            } 
                            // var_export($produkt['request']); 
                            ?></div>
                    </div>
                    <?php } ?>
                    <?php if (isset($produkt['request']['dodatkowaOzdobnaScianka'])) {; ?>
                        <div class="row paramsInCard">
                    <div class="col-6"><?php echo $lang->getLanguage('dodatkowaOzdobnaScianka','Dodatkowa ozdobna ścianka');?></div>
                    <div class="col-6"><?php echo $lang->getLanguage('tak','Tak');?></div>
                    </div>
                    <?php } ?>
                    <?php if (isset($produkt['request']['dodatkoweOzdobneKrawedzie'])) {; ?>
                        <div class="row paramsInCard">
                    <div class="col-6"><?php echo $lang->getLanguage('dodatkoweOzdobneKrawedzie','Dodatkowe ozdobne krawędzie');?></div>
                    <div class="col-6"><?php echo $lang->getLanguage('tak','Tak');?></div>
                    </div>
                    <?php } ?>


                     <!--  -->

                </div>
                <div class="col-2"><button class="btnRemoveCard" onclick="removeFromCard(<?php echo $numer;?>)"><?php echo $lang->getLanguage('usun','Usuń');?></button></div>
        </div>
      
        
        
        <?php }
    ?>
    <div class="row pl-3 singleCardProduct paramsInCard">
            <div class="col-12"> <p class="cardShapeTitle">Zhrnutie</p></div>
            <div class="col-12"> <p>Suma netto: <?php echo $sumaNettoLacznie;?> <?php echo $ustawienia -> getSettings('waluta');?></p></div>
            <div class="col-12"> <p>Suma brutto: <?php echo $sumaBruttoLacznie;?> <?php echo $ustawienia -> getSettings('waluta');?></p></div>
            
        </div>
    <?php
    
    }else{
            echo '<div class="row"><div class="col-12 emptyCardBox">'.$lang->getLanguage('koszykJestPusty','Koszyk jest pusty').'</div></div>';
        } ?>
        
    </div>

</div>
<?php
 if($koszyk != NULL){?>
<div class="row">
    <div class="col-12 btnSubmitOrderBox">
        <a class="btnSubmitOrder"href="<?php echo add_query_arg($orderKoszykLink, $uri); ?>" class="orderButton"><?php echo $lang->getLanguage('zlozZamowienie','Złóż zamówienie');?></a>
    </div>
</div>
<?php } ?>
<script>

function removeFromCard(id){
    $('#valueToRemove').val(id);
    $('#removeFromCardForm').submit();

}

</script>