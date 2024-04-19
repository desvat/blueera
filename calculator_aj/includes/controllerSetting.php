<?php
$bootstrap_path = KHC_PATH2 . 'css/bootstrap.min.css';
$css_patch = KHC_PATH2 . 'css/khc.css';
// $addColorGet = array('page' => 'calculator_aj_kolor_subcat_menu', 'do' => 'add');
// // Tytuł strony
// $khc_title_page = "Kolory";

$ustawienia = new kalkulatorHcSettings;
if(isset($_POST['podatek'])){
    $ustawienia -> setSettings(['wartosc'=>$_POST['podatek']],['nazwa'=>'podatek']);
    $komunikatpodatek = 'Podatek został zaktualizowany!';
}
if(isset($_POST['email'])){
    $ustawienia -> setSettings(['wartosc'=>$_POST['email']],['nazwa'=>'email']);
    $komunikatEmail = 'Adres e-mail został zaktualizowany!';

}
if(isset($_POST['waluta'])){
    $ustawienia -> setSettings(['wartosc'=>$_POST['waluta']],['nazwa'=>'waluta']);
    $komunikatwaluta = 'Waluta została zaktualizowana!';

}
if(isset($_POST['linkRegulamin'])){
    $ustawienia -> setSettings(['wartosc'=>$_POST['linkRegulamin']],['nazwa'=>'linkRegulamin']);
    $komunikatregulamin = 'Link do regulaminu został zaktualizowany!';

}
if(isset($_POST['linkPolityka'])){
    $ustawienia -> setSettings(['wartosc'=>$_POST['linkPolityka']],['nazwa'=>'linkPolityka']);
    $komunikatpolityka = 'Link do polityka prywatności został zaktualizowany!';

}
$arrayMiejsce = ['rightSpace','leftSpace','right','left'];
$arrayMiejsceFull = ['rightSpace'=>'Po prawej z odstępem','leftSpace'=>'Po Lewej z odstępem','right'=>'Po prawej','left'=>'Po Lewej'];
if(isset($_POST['miejsceWaluty'])){
    if(in_array($_POST['miejsceWaluty'],$arrayMiejsce)){
    $ustawienia -> setSettings(['wartosc'=>$_POST['miejsceWaluty']],['nazwa'=>'miejsceWaluty']);
    $komunikatmiejscewaluty = 'Miejsce waluty zostało zaktualizowane!';
    }
}
$podatek = $ustawienia -> getSettings('podatek');
$email = $ustawienia -> getSettings('email');
$waluta = $ustawienia -> getSettings('waluta');
$miejsceWaluty = $ustawienia -> getSettings('miejsceWaluty');
$aktualneMiejsceWalutyTresc = $arrayMiejsceFull[$miejsceWaluty];
$linkRegulamin = $ustawienia -> getSettings('linkRegulamin');
$linkPolityka = $ustawienia -> getSettings('linkPolityka');
$opcje = '<option value="'.$miejsceWaluty.'">'.$aktualneMiejsceWalutyTresc.'</option>'; 
foreach($arrayMiejsceFull as $value => $title){
    if($miejsceWaluty != $value){
    $opcje .= '<option value="'.$value.'">'.$title.'</option>'; 
    }

}
?>
<link rel="stylesheet" href="<?php echo $bootstrap_path; ?>">
<link rel="stylesheet" href="<?php echo $css_patch; ?>">
<div class="container khc-container">
<h4 class="khc_title">Nastavenia</h4>

        


        <form method="POST">
        <div class="form-group mt-5">
            <?php if(isset($komunikatEmail)){
                echo '<div class="mb-3" style="color:green">'.$komunikatEmail.'</div>';
            }?>
            
            <label for="exampleInputEmail1">E-mail</label>
            <input type="email" name="email" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Enter email" value="<?php echo $email;?>">
            <small id="emailHelp" class="form-text text-muted">Adres e-mail na który mają dochodzić powiadomienia</small>
        </div>
        
       
        <button type="submit" class="btn btn-primary">Aktualizovať</button>
        </form>
        <form method="POST">
        <div class="form-group mt-5">
        <?php if(isset($komunikatpodatek)){
                echo '<div class="mb-3" style="color:green">'.$komunikatpodatek.'</div>';
            }?>
            <label for="PodatekInput">Podatek</label>
            <input type="number" min="1" step="1" name="podatek" class="form-control" id="PodatekInput" aria-describedby="PodatekInputHelp" placeholder="23" value="<?php echo $podatek;?>" required>
            <small id="PodatekInputHelp" class="form-text text-muted">Podaj aktualny podatek 23 jeżeli 23%</small>
        </div>
        
       
        <button type="submit" class="btn btn-primary">Aktualizovať</button>
        </form>

        
            <form method="POST">
            <div class="form-group mt-5">
            <?php if(isset($komunikatwaluta)){
                    echo '<div class="mb-3" style="color:green">'.$komunikatwaluta.'</div>';
                }?>
                <label for="WalutaInput">Waluta</label>
                <input type="text" min="1" step="1" name="waluta" class="form-control" id="WalutaInput" aria-describedby="WalutaInputHelp" placeholder="€" value="<?php echo $waluta;?>" required>
                <small id="WalutaInputHelp" class="form-text text-muted">Zadajte názov meny, ktorá sa má zobraziť (napr.: €)</small>
            </div>
            
        
            <button type="submit" class="btn btn-primary">Aktualizovať</button>
            </form>

            <form method="POST">
                <div class="form-group mt-5">
                <?php if(isset($komunikatmiejscewaluty)){
                    echo '<div class="mb-3" style="color:green">'.$komunikatmiejscewaluty.'</div>';
                }?>
                <label for="miejsceWaluty">Miejsce waluty</label><br>
                <select id="miejsceWaluty" name="miejsceWaluty" class="form-select">
                   <?php echo $opcje;?>
                </select>
                <small id="miejsceWalutyHelp" class="form-text text-muted">Podaj miejsce wyświetlanej waluty np 2zł, €2</small>
                </div>
                <button type="submit" class="btn btn-primary">Aktualizovať</button> 
            </form>  
            <!--  -->
            <form method="POST">
            <div class="form-group mt-5">
            <?php if(isset($komunikatregulamin)){
                    echo '<div class="mb-3" style="color:green">'.$komunikatregulamin.'</div>';
                }?>
                <label for="regulaminInput">Link do regulaminu</label>
                <input type="text" min="1" step="1" name="linkRegulamin" class="form-control" id="regulaminInput" aria-describedby="WalutaInputHelp" placeholder="" value="<?php echo $linkRegulamin;?>">
                <small id="regulaminInputHelp" class="form-text text-muted">Podaj pełny link do regulaminu</small>
            </div>
            
        
            <button type="submit" class="btn btn-primary">Aktualizovať</button>
            </form>
            <form method="POST">
            <div class="form-group mt-5">
            <?php if(isset($komunikatpolityka)){
                    echo '<div class="mb-3" style="color:green">'.$komunikatpolityka.'</div>';
                }?>
                <label for="politykaInput">Link do polityki prywatności</label>
                <input type="text" min="1" step="1" name="linkPolityka" class="form-control" id="politykaInput" aria-describedby="politykaInputHelp" placeholder="" value="<?php echo $linkPolityka;?>">
                <small id="politykaInputHelp" class="form-text text-muted">Podaj pełny link do polityki prywatności</small>
            </div>
            
        
            <button type="submit" class="btn btn-primary">Aktualizovať</button>
            </form>
        <!--  -->
        <div class="form-group mt-5">
            <label for="exampleInputEmail3">Shortcode</label>
            <input type="text" value="[calc_aj_display]" class="form-control" id="exampleInputEmail3" aria-describedby="emailHelp" placeholder="Enter email" readonly>
            <small id="emailHelp" class="form-text text-muted">Shortcode wyświetlający konfigurator</small>
        </div>
   <?php

    // if(isset($_GET['action'])){

    //     if($_GET['action']=='orderList'){

    //         require_once 'orderList.php';

    //     }elseif($_GET['action']=='showOrder'){

    //         require_once 'orderShow.php';
    //     }

    // }else{
    //     require_once 'orderList.php';
    // }
?>
</div>