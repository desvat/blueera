<?php
$zamowienia = new kalkulatorHcZamowienia;
$lang = new kalkulatorHcLanguage;
$ustawienia = new kalkulatorHcSettings;
// $numerZamowienia = $zamowienia ->orderNo();
// var_dump($numerZamowienia);
// echo "NUMER".$numerZamowienia."<br>";
// echo "dziala";
$errorOrder = 0;
$linkRegulamin = $ustawienia -> getSettings('linkRegulamin');
$linkPolityka = $ustawienia -> getSettings('linkPolityka');
if (isset($_POST['submit'])) {

    //////
    if (isset($_POST['imie'])) {
        $imie = htmlspecialchars($_POST['imie'], ENT_QUOTES);
        if (strlen($imie) < 2 || strlen($imie) > 30) {
            $errorOrder = 1;
            //echo 'ERROR: IMIE';
        }
    } else {
        $errorOrder = 1;
    }
    //////
    //////
    if (isset($_POST['nazwisko'])) {
        $nazwisko = htmlspecialchars($_POST['nazwisko'], ENT_QUOTES);
        if (strlen($nazwisko) < 2 || strlen($nazwisko) > 50) {
            $errorOrder = 1;
            //echo 'ERROR: nazwisko';
        }
    } else {
        $errorOrder = 1;
    }
    //////
    //////
    if (isset($_POST['email'])) {
        $email = htmlspecialchars($_POST['email'], ENT_QUOTES);
        if (strlen($email) < 2 || strlen($email) > 50) {
            $errorOrder = 1;
            //echo 'ERROR: email';
        }
    } else {
        $errorOrder = 1;
    }
    //////
    //////
    if (isset($_POST['ulica'])) {
        $ulica = htmlspecialchars($_POST['ulica'], ENT_QUOTES);
        if (strlen($ulica) < 2 || strlen($ulica) > 50) {
            $errorOrder = 1;
            //echo 'ERROR: ulica';
        }
    } else {
        $errorOrder = 1;
    }

    if (isset($_POST['ulicaInne'])) {
        $ulicaInne = htmlspecialchars($_POST['ulicaInne'], ENT_QUOTES);
        if($ulicaInne !=""){
            if (strlen($ulicaInne) < 2 || strlen($ulicaInne) > 50) {
                $errorOrder = 1;
                //echo 'ERROR: ulica';
            }
        }
    } else {
        $ulicaInne = '';
    }
    //////
      //////
      if (isset($_POST['miasto'])) {
        $miasto = htmlspecialchars($_POST['miasto'], ENT_QUOTES);
        if (strlen($miasto) < 2 || strlen($miasto) > 50) {
            $errorOrder = 1;
            //echo 'ERROR: miasto';
        }
    } else {
        $errorOrder = 1;
    }
    if (isset($_POST['miastoInne'])) {
        $miastoInne = htmlspecialchars($_POST['miastoInne'], ENT_QUOTES);
        if($miastoInne != ''){
            if (strlen($miastoInne) < 2 || strlen($miastoInne) > 50) {
                $errorOrder = 1;
                //echo 'ERROR: miasto';
            }
         }
    } else {
        $miastoInne = "";
    }
    //////
    //////
    if (isset($_POST['kodPocztowy'])) {
        $kodPocztowy = htmlspecialchars($_POST['kodPocztowy'], ENT_QUOTES);
        if (strlen($kodPocztowy) < 2 || strlen($kodPocztowy) > 50) {
            $errorOrder = 1;
            //echo 'ERROR: kodPocztowy';
        }
    } else {
        $errorOrder = 1;
    }
    //////
     //////
     if (isset($_POST['kodPocztowyInne'])) {
            $kodPocztowyInne = htmlspecialchars($_POST['kodPocztowy'], ENT_QUOTES);
            if($kodPocztowyInne !=''){
            if (strlen($kodPocztowyInne) < 2 || strlen($kodPocztowyInne) > 50) {
                $errorOrder = 1;
                //echo 'ERROR: kodPocztowy';
            }
        }
    } else {
        $kodPocztowyInne = '';
    }
    //////
      //////
      if (isset($_POST['telefon'])) {
        $telefon = htmlspecialchars($_POST['telefon'], ENT_QUOTES);
        if (strlen($telefon) < 2 || strlen($telefon) > 50) {
            $errorOrder = 1;
            //echo 'ERROR: telefon';
        }
    } else {
        $errorOrder = 1;
    }
    //////
       //////
       if (isset($_POST['nazwaFirmy'])) {
                if($_POST['nazwaFirmy'] != ''){
                $nazwaFirmy = htmlspecialchars($_POST['nazwaFirmy'], ENT_QUOTES);
                    if (strlen($nazwaFirmy) < 2 || strlen($nazwaFirmy) > 100) {
                        $errorOrder = 1;
                        //echo 'ERROR: nazwaFirmy';
                    }
                }else{
                    $nazwaFirmy = '';
                }
    } else {
        $nazwaFirmy = '';
    }
    //////
        //////
        if (isset($_POST['nip'])) {
            if($_POST['nip'] != ''){
            $nip = htmlspecialchars($_POST['nip'], ENT_QUOTES);
                if (strlen($nip) < 2 || strlen($nip) > 100) {
                    $errorOrder = 1;
                    //echo 'ERROR: nip';
                }
            }
            else{
                $nip = '';
            }
        } else {
            $nip = '';
        }
        //////
        //////
        if (isset($_POST['kraj'])) {
            $kraj = htmlspecialchars($_POST['kraj'], ENT_QUOTES);
            if (strlen($kraj) < 2 || strlen($kraj) > 50) {
                $errorOrder = 1;
                //echo 'ERROR: kraj';
            }
            } else {
                $errorOrder = 1;
        }
        //////

        //////
        if (isset($_POST['poznamka'])) {
            $poznamka = htmlspecialchars($_POST['poznamka'], ENT_QUOTES);
        }
        //////

      //////
      if (isset($_POST['wiadomosc'])) {
        $wiadomosc = htmlspecialchars($_POST['wiadomosc'], ENT_QUOTES);
            if($wiadomosc != ''){
                    if (strlen($wiadomosc) < 2 || strlen($wiadomosc) > 250) {
                        $errorOrder = 1;
                        //echo 'ERROR: wiadomosc';
                    }
            }else{
                $wiadomosc = '';
            }
        } else {
            $wiadomosc = '';
        }
    ////// DODANIE ZAMOWIENIA
    if ($errorOrder == 1) {
        $komunikatBledu = 'Uzupełnij poprawnie wszyskie pola';
    }else{
        //dodac tutaj sprawdzenie koszyka plus doliczenie cen do niego itp moze zrobienie drugiej sesji zeby niemieszac ze starym koszykiem
       
        $koszyk = $zamowienia -> getCard();
        $userId = get_current_user_id();
       

        $data = [
            'imie' => $imie,
            'nazwisko' => $nazwisko,
            'email' => $email,
            'ulica' => $ulica,
            'miasto' => $miasto,
            'kodPocztowy' => $kodPocztowy,
            'telefon' => $telefon,
            'nazwaFirmy' => $nazwaFirmy,
            'nip' => $nip,
            'kraj' => $kraj,
            'poznamka' => $poznamka,
            'produkty' => json_encode($koszyk),
            'wiadomosc' => $wiadomosc,
            'notatka' => '',
            'dataDodania' => date("Y-m-d H:i:s"),
            'status' => 'Nová',
            'userId' => $userId,
            'ulicaInne' => $ulicaInne,
            'miastoInne' => $miastoInne,
            'kodPocztowyInne' => $kodPocztowyInne

        ];
        $zamowienia -> addOrder($data);
        $zamowienia -> unsetCard();
        $uri = $_SERVER['REQUEST_URI'];
        $successKoszykLink = array('action' => 'success');
        ?>
<script>
    window.location.replace("<?php echo add_query_arg($successKoszykLink, $uri); ?>");
</script>
        <?php
        // tutaj zrobic przekierowanie na action=success
    }

}
$koszyk = $zamowienia -> getCard();

if($koszyk == NULL || count($koszyk)<1){
    $konfiguracjaLink = array('action' => 'home');
    $uri = $_SERVER['REQUEST_URI'];
    echo '<script>window.location.replace("'.add_query_arg($konfiguracjaLink, $uri).'");</script>';
}

?>
<style>
    .container-checkbox {
  display: block;
  position: relative;
  padding-left: 35px;
  margin-bottom: 12px;
  cursor: pointer;
  font-size: 22px;
  -webkit-user-select: none;
  -moz-user-select: none;
  -ms-user-select: none;
  user-select: none;
}

/* Hide the browser's default checkbox */
.container-checkbox input {
  position: absolute;
  opacity: 0;
  cursor: pointer;
  height: 0;
  width: 0;
}

/* Create a custom checkbox */
.checkmark {
  position: absolute;
  top: 0;
  left: 0;
  height: 25px;
  width: 25px;
  background-color: #eee;
}

/* On mouse-over, add a grey background color */
.container-checkbox:hover input ~ .checkmark {
  background-color: #ccc;
}

/* When the checkbox is checked, add a blue background */
.container-checkbox input:checked ~ .checkmark {
  background-color: #2196F3;
}

/* Create the checkmark/indicator (hidden when not checked) */
.checkmark:after {
  content: "";
  position: absolute;
  display: none;
}

/* Show the checkmark when checked */
.container-checkbox input:checked ~ .checkmark:after {
  display: block;
}

/* Style the checkmark/indicator */
.container-checkbox .checkmark:after {
  left: 9px;
  top: 5px;
  width: 5px;
  height: 10px;
  border: solid white;
  border-width: 0 3px 3px 0;
  -webkit-transform: rotate(45deg);
  -ms-transform: rotate(45deg);
  transform: rotate(45deg);
}
</style>
</style>
<div class="row" class="orderFormBox">

    <div class="col-12" class="orderFormInside">
        <form method="POST" id="orderForm">
            <div class="orderFormWrapper"> 
            <label class="orderFormLabel"><?php echo $lang->getLanguage('imie','Imię');?><sup>*</sup> </label><input class="OrderFormInput" type="text" name="imie" required >
            <label class="orderFormLabel"><?php echo $lang->getLanguage('nazwisko','Nazwisko');?><sup>*</sup> </label><input class="OrderFormInput" type="text" name="nazwisko" required >
            <label class="orderFormLabel"><?php echo $lang->getLanguage('email','E-mail');?><sup>*</sup> </label><input class="OrderFormInput" type="email" name="email" required >
            <label class="orderFormLabel"><?php echo $lang->getLanguage('ulica','Ulica');?><sup>*</sup> </label><input class="OrderFormInput" type="text" name="ulica" required >
            <label class="orderFormLabel"><?php echo $lang->getLanguage('miasto','Miasto');?><sup>*</sup> </label><input class="OrderFormInput" type="text" name="miasto" required >
            <label class="orderFormLabel"><?php echo $lang->getLanguage('kodPocztowy','Kod pocztowy');?><sup>*</sup> </label><input class="OrderFormInput" type="text" name="kodPocztowy" required>
               <!--  -->
               <label class="container-checkbox"><?php echo $lang->getLanguage('innyAdress','Inny adress dostawy');?>
                <input type="checkbox" id="myCheck2" onclick="adressCheck()">
                <span class="checkmark"></span>
                 </label>
                 <label class="orderFormLabel" id="adressLabel1"><?php echo $lang->getLanguage('ulica','Ulica');?><sup>*</sup> </label><input id="adressInput1" class="OrderFormInput" type="text" name="ulicaInne">
            <label class="orderFormLabel" id="adressLabel2"><?php echo $lang->getLanguage('miasto','Miasto');?><sup>*</sup> </label><input id="adressInput2" class="OrderFormInput" type="text" name="miastoInne">
            <label class="orderFormLabel" id="adressLabel3"><?php echo $lang->getLanguage('kodPocztowy','Kod pocztowy');?><sup>*</sup> </label><input id="adressInput3" class="OrderFormInput" type="text" name="kodPocztowyInne">
            <!--  -->
            <label class="orderFormLabel"><?php echo $lang->getLanguage('telefon','Telefon');?><sup>*</sup> </label><input class="OrderFormInput" type="text" name="telefon" required >
            <label class="container-checkbox"><?php echo $lang->getLanguage('firma','Firma');?>
                <input type="checkbox" id="myCheck" onclick="companyCheck()">
                <span class="checkmark"></span>
             </label>
            <label class="orderFormLabel" id="companyLabel1"><?php echo $lang->getLanguage('nazwaFirmy','Nazwa firmy');?><sup>*</sup></label><input id="companyInput1" class="OrderFormInput" type="text" name="nazwaFirmy">
            <label class="orderFormLabel" id="companyLabel2"><?php echo $lang->getLanguage('nip','Nip');?><sup>*</sup></label><input id="companyInput2" class="OrderFormInput" type="text" name="nip">
         
            <label class="orderFormLabel"><?php echo $lang->getLanguage('kraj','Kraj');?><sup>*</sup></label><input class="OrderFormInput" type="text" name="kraj" value="Slovensko" required>


            <label class="orderFormLabel"><?php echo $lang->getLanguage('poznamka','Poznámka');?></label>
            
            <textarea class="OrderFormInput" name="poznamka" row="5"></textarea>




            <?php if($linkRegulamin != ''){?>
            <label class="container-checkbox checkbox-max-width"> <?php echo $lang->getLanguage('accordance-with-the-act-of','');?><sup>*</sup> <a class="zobacz-form" target="_blank" href="<?php echo $linkRegulamin;?>"><?php echo $lang->getLanguage('zobacz','Zobacz');?></a>
                <input type="checkbox" required>
                <span class="checkmark"></span>
             </label>
             <?php } ;?>
             <?php if($linkPolityka != ''){?>
             <label class="container-checkbox checkbox-max-width"> <?php echo $lang->getLanguage('in-accordance-with','');?> <sup>*</sup> <a class="zobacz-form" target="_blank" href="<?php echo $linkPolityka;?>"><?php echo $lang->getLanguage('zobacz','Zobacz');?></a>
                <input type="checkbox" required>
                <span class="checkmark"></span>
             </label>
             <?php } ;?>
            <button class="btnZamow" name="submit"><?php echo $lang->getLanguage('zamow','Zamów');?></button>
            </div>
        </form>
    </div>
</div>

<script>
    function companyCheck() {
        
  // Get the checkbox
  var checkBox = document.getElementById("myCheck");

  // Get the output text
  var label1 = document.getElementById("companyLabel1");
  var input1 = document.getElementById("companyInput1");

  var label2 = document.getElementById("companyLabel2");
  var input2 = document.getElementById("companyInput2");
  // If the checkbox is checked, display the output text
  if (checkBox.checked == true){
    label1.style.display = "block";
    input1.style.display = "block";

    label2.style.display = "block";
    input2.style.display = "block";

    input1.required = true;
    input2.required = true;
  } else {
    label1.style.display = "none";
    input1.style.display = "none";
    
    label2.style.display = "none";
    input2.style.display = "none";

    input1.required = false;
    input2.required = false;
    input1.value="";
    input2.value="";
  }
}

function adressCheck() {
        
        // Get the checkbox
        var checkBox = document.getElementById("myCheck2");
      
        // Get the output text
        var label1 = document.getElementById("adressLabel1");
        var input1 = document.getElementById("adressInput1");
      
        var label2 = document.getElementById("adressLabel2");
        var input2 = document.getElementById("adressInput2");

        var label3 = document.getElementById("adressLabel3");
        var input3 = document.getElementById("adressInput3");
        // If the checkbox is checked, display the output text
        if (checkBox.checked == true){
          label1.style.display = "block";
          input1.style.display = "block";
      
          label2.style.display = "block";
          input2.style.display = "block";
      
          label3.style.display = "block";
          input3.style.display = "block";

          input1.required = true;
          input2.required = true;
          input3.required = true;
        } else {
          label1.style.display = "none";
          input1.style.display = "none";
          
          label2.style.display = "none";
          input2.style.display = "none";
      
          label3.style.display = "none";
          input3.style.display = "none";

          input1.required = false;
          input2.required = false;
          input3.required = false;
          input1.value="";
          input2.value="";
          input3.value="";
        }
      }
</script>
