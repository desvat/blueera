<?php

$profil = new kalkulatorHcProfil();
$material = new kalkulatorHcMaterial();
$ustawienia = new kalkulatorHcSettings;
$waluta = $ustawienia -> getSettings('waluta');
if (isset($_GET['id'])) {
    //relacja Kształtu z profilem
    $id_relacji = $_GET['id'];
}
// pobiera informacje o relacjach
$ksztalt = $profil -> khc_showAssignedShape($id_relacji);
$idKsztaltuProfilu = $ksztalt -> idKsztaltuProfilu;
$idProfilu = $ksztalt->idProfilu;
// $slugKsztalt = $ksztalt->ksztalt;

if(isset($_POST['submit']) && isset($_POST['idRelacji']) && isset($_POST['remove'])){

    $profil -> khc_removeAssignedShape($idProfilu, $id_relacji);
    exit();
}





$tabelaDaty = $ksztalt -> data;
$data = json_decode($tabelaDaty, true);

$nowaData = [];
$nowaData = $data;

// pętla po akceptacji 
if(isset($_REQUEST) && isset($_POST['submit'])){
    $przekrojeWartosci = [];
    
    if(isset($nowaData['przekroj']['wartosci'])){
        $nowaData['przekroj']['wartosci'] = [];

    }
    
    foreach($_REQUEST as $requestTitle => $valueRequest){
        if($requestTitle == 'assignedMaterial'){
            continue;
        }
        if($requestTitle == 'assignedMaterialRemove'){
            continue;
        }
        $requestTitleExplode = explode("-", $requestTitle);

        //tutaj pare bledow
        //  echo $requestTitleExplode[0] . " " . $valueRequest."<br>";

        //sprawdzanie czy taka wartosc istniala
            //sprawdzanie czy wartosc jest tablica
            // jezeli jest tablica
            
            if(is_array($valueRequest)){
                    //jezeli ma tablice
                  

                    // sprawdzanie czy nie jes już tablicą w przypadku grubosci rdzenia
                    if(isset($nowaData['gruboscRdzenia']['wartosci'])){
                        $nowaData['gruboscRdzenia']['wartosci'] = [];
                    
                        foreach($valueRequest as $valueRequestTitle =>$RequestArrayValue){
                            
                            
                            
                            if(!is_array($RequestArrayValue)){
                                // ECHO $requestTitleExplode[0]
                                if($requestTitleExplode[0] == 'gruboscRdzenia'){
                                   
                                $nowaData[$requestTitleExplode[0]][$requestTitleExplode[1]][$valueRequestTitle] = $RequestArrayValue;
                                }
                            }
                            // else{// sprawdza w przypadku przekroju
                            //         echo "cos jest";
                            //         foreach($RequestArrayValue as $RequestArrayValueTitle => $wartosciPrzekroju){
                            //             echo $wartosciPrzekroju;
                            //         }

                            // }
                            
                    
                        } 


                    }
                    // W przypadku przekroju
                    if(isset($nowaData['przekroj']['wartosci'])){
                        // 
                        foreach($valueRequest as $valueRequestTitle => $RequestArrayValue){
                            
                          
                       
                            // $przekrojeWartosci[$valueRequestTitle][$requestTitleExplode[0]] = $RequestArrayValue;
                            // echo $requestTitleExplode[0]." | ";
                            $nowaData['przekroj']['wartosci'][$valueRequestTitle][$requestTitleExplode[0]] = $RequestArrayValue;
                            // echo $valueRequestTitle .' '.$requestTitleExplode[0]." ".$RequestArrayValue."<br>";
                        } 
                       
                    }
               
            }
            else{
                // jezeli nie ma tablicy
                if(isset($requestTitleExplode[0]) && isset($requestTitleExplode[1])){

                    if (isset($nowaData[$requestTitleExplode[0]][$requestTitleExplode[1]])) {
                        $nowaData[$requestTitleExplode[0]][$requestTitleExplode[1]] = $valueRequest;
                    }
                }
                //
            }
            
            $data = $nowaData;
        
    }
   
// pozostałe wartości

if(isset($_POST['aktywny'])){
    if($_POST['aktywny']=="on"){
        $aktywny = 1;
    }else{
        $aktywny = 0;
    }
    

}else{
    $aktywny = 0;
}
if(isset($_POST['cenaZaMetr'])){
    $cenaZaMetr = $_POST['cenaZaMetr'];
    
}else{
    $cenaZaMetr = 0;
}


    $editWhere = [
        'id'=> $id_relacji
    ];
    
    $dataEdit = [
        'widoczny'=> $aktywny,
        'cena'=>$cenaZaMetr,
        'data'=> json_encode($nowaData),
    
    ];
  
    $profil -> khc_editAssignedShape($dataEdit, $editWhere);

    // materialy Przypisywanie
    if(isset($_POST['assignedMaterial'])){
        $wybraneMaterialy = $_POST['assignedMaterial'];
            foreach($wybraneMaterialy as $idMaterialu){
                
                if($idMaterialu != ''){
                    $material->assignMatKolWyk($idMaterialu,$idKsztaltuProfilu,$idProfilu);
                }
            }
        }
        if(isset($_POST['assignedMaterialRemove'])){
            $wybraneMaterialyRemove = $_POST['assignedMaterialRemove'];
            foreach($wybraneMaterialyRemove as $idMaterialu){
            //    echo $idMaterialu." ";
                if($idMaterialu != ''){
                    $material->assignMatKolWykRemove($idMaterialu,$idKsztaltuProfilu,$idProfilu);
                }
            }
        }
        //assignMatKolWyk($idMaterialu,$idKsztaltu,$idProfilu)
        
}
// pobierz jeszcze raz żęby odświeżyć
$ksztalt = $profil -> khc_showAssignedShape($id_relacji);
if($ksztalt->widoczny== 1){
    $AktywnyChecked = 'checked';
}else{
    $AktywnyChecked = '';
}

// var_dump($_REQUEST);
// cos takiego trzeba zrobic chyba, sprawdzac czy istnieje i przypisywac


// $profil -> khc_testAssignedShape($_REQUEST);
// // echo "<br> Powinno byc";
// $profil -> khc_testAssignedShape($data);

// // echo "NOWA DATA<br>";
// $profil -> khc_testAssignedShape($nowaData);

$queryPowrotKsztaltyProfilow = array( 'page' => 'calculator_aj_profil_subcat_menu','do'=>'konfiguruj','id'=>$idProfilu);

$przypisaneMaterialy = $material -> getAllMatKolWyk($idProfilu,$idKsztaltuProfilu,"material");
$przypisaneKolory = $material -> getAllMatKolWyk($idProfilu,$idKsztaltuProfilu,"kolor");
$przypisaneWykonczenia = $material -> getAllMatKolWyk($idProfilu,$idKsztaltuProfilu,"wykonczenie");


// -------------------------------------------------------------------------------------------------------- Doplnene 18. 8. 2023
$przypisaneKolorIndywidualny = $material -> getAllMatKolWyk($idProfilu,$idKsztaltuProfilu,"kolorIndywidualny");
// -------------------------------------------------------------------------------------------------------- Doplnene 18. 8. 2023
$przypisaneJoints = $material -> getAllMatKolWyk($idProfilu,$idKsztaltuProfilu,"joints");
// -------------------------------------------------------------------------------------------------------- Doplnene 18. 8. 2023
$przypisaneKoloryAkcesoria = $material -> getAllMatKolWyk($idProfilu,$idKsztaltuProfilu,"kolorAkcesoria");
// -------------------------------------------------------------------------------------------------------- Doplnene 2. 10. 2023
$przypisaneEndings = $material -> getAllMatKolWyk($idProfilu,$idKsztaltuProfilu,"endings");

?>
<!-- USUWANIE -->
<style>


        .modal {
        display: none; 
        position: fixed; 
        z-index: 1; 
        padding-top: 100px; 
        left: 0;
        top: 0;
        width: 100%;
        height: 100%; 
        overflow: auto; 
        background-color: rgb(0,0,0); 
        background-color: rgba(0,0,0,0.4); 
        }


        .modal-content {
        background-color: #fefefe;
        margin: auto;
        padding: 20px;
        border: 1px solid #888;
        width: 60%;
        }


        .close {
            color: #aaaaaa;
        text-align:right;
        font-size: 28px;
        font-weight: bold;
        }

        .close:hover,
        .close:focus {
            color: #000;
        text-decoration: none;
        cursor: pointer;
        }
        .btn-danger{
            color:white !important;
        }
</style>
<form action="" method="POST">
    <h6 class="mb-3">Aktívny</h6>
        <label class="switch">
            <input type="checkbox" name="aktywny" <?php echo $AktywnyChecked;?>>
            <span class="slider round"></span>
        </label>
        <hr>
        <div class="form-group">

        <label for="cenazametr">Cena ( <?php echo $waluta;?> )</label>
        <input type="number" step="0.01" min="0.01" class="form-control" name="cenaZaMetr" id="cenazametr" placeholder="" value="<?php echo (float)$ksztalt->cena; ?>" required>
       
        </div>
        <hr>
    <?php 
   
    $profil -> khc_ProfilParamsForm($data);
  
    ?>
    <pre> <?php // var_export($przypisaneMaterialy); ?> </pre>
    <?php
    foreach($przypisaneMaterialy as $material){
        if($material['przypisany']==true){
            $materialAssignedClass = 'AssignedMaterialActive';
        }else{
            $materialAssignedClass = '';

        }
        ?>
        <!-- <div class="col-md-3 col-sm-2 AssignedMaterial <?php echo $materialAssignedClass;?>" data-materialId="<?php echo $material['id'];?>"><input class="inputMaterialIdRemove" type="hidden" name="assignedMaterialRemove[]" value=""><input class="inputMaterialId" type="hidden" name="assignedMaterial[]" value=""><div class="row"><div class="col-12 imgAssignedMaterial"><img src="<?php echo KHC_PATH.'uploads/'. $material['image']; ?>" class="img-fluid" alt=""></div><div class="col-12 titleAssignedMaterial"><?php echo $material['tytul'];?></div></div></div> -->
        <?php
    } 
    ?>
    <!-- dodac do pnel -->
    <div class="row">
        <!-- <div class="col-md-3 col-sm-2 AssignedMaterial" data-materialId="18"><input class="inputMaterialIdRemove" type="hidden" name="assignedMaterialRemove[]" value=""><input class="inputMaterialId" type="hidden" name="assignedMaterial[]" value=""><div class="row"><div class="col-12 imgAssignedMaterial"><img src="<?php echo KHC_PATH.'uploads/1634496594DSCF7272.jpg'; ?>" class="img-fluid" alt=""></div><div class="col-12 titleAssignedMaterial">test</div></div></div>
        <div class="col-md-3 col-sm-2 AssignedMaterial" data-materialId="26"><input class="inputMaterialIdRemove" type="hidden" name="assignedMaterialRemove[]" value=""><input class="inputMaterialId" type="hidden" name="assignedMaterial[]" value=""><div class="row"><div class="col-12 imgAssignedMaterial"><img src="<?php echo KHC_PATH.'uploads/1634496594DSCF7272.jpg'; ?>" class="img-fluid" alt=""></div><div class="col-12 titleAssignedMaterial">test</div></div></div>
        <div class="col-md-3 col-sm-2 AssignedMaterial" data-materialId="27"><input class="inputMaterialIdRemove" type="hidden" name="assignedMaterialRemove[]" value=""><input class="inputMaterialId" type="hidden" name="assignedMaterial[]" value=""><div class="row"><div class="col-12 imgAssignedMaterial"><img src="<?php echo KHC_PATH.'uploads/1634496594DSCF7272.jpg'; ?>" class="img-fluid" alt=""></div><div class="col-12 titleAssignedMaterial">test</div></div></div>
        <div class="col-md-3 col-sm-2 AssignedMaterial" data-materialId="28"><input class="inputMaterialIdRemove" type="hidden" name="assignedMaterialRemove[]" value=""><input class="inputMaterialId" type="hidden" name="assignedMaterial[]" value=""><div class="row"><div class="col-12 imgAssignedMaterial"><img src="<?php echo KHC_PATH.'uploads/1634496594DSCF7272.jpg'; ?>" class="img-fluid" alt=""></div><div class="col-12 titleAssignedMaterial">test</div></div></div>
        <div class="col-md-3 col-sm-2 AssignedMaterial" data-materialId="16"><input class="inputMaterialIdRemove" type="hidden" name="assignedMaterialRemove[]" value=""><input class="inputMaterialId" type="hidden" name="assignedMaterial[]" value=""><div class="row"><div class="col-12 imgAssignedMaterial"><img src="<?php echo KHC_PATH.'uploads/1634496594DSCF7272.jpg'; ?>" class="img-fluid" alt=""></div><div class="col-12 titleAssignedMaterial">test</div></div></div> -->
   
    </div>
<!--  -->

  <button class="accordion" type="button">Vzor dreva</button>
  <div class="panel">
    <div class="row">
      <!--  -->
      <?php
        foreach($przypisaneMaterialy as $material){
        if($material['przypisany']==true){
            $materialAssignedClass = 'AssignedMaterialActive';
        }else{
            $materialAssignedClass = '';

        }
        ?>
        <div class="col-md-3 col-sm-2 AssignedMaterial <?php echo $materialAssignedClass;?>" data-materialId="<?php echo $material['id'];?>"><input class="inputMaterialIdRemove" type="hidden" name="assignedMaterialRemove[]" value=""><input class="inputMaterialId" type="hidden" name="assignedMaterial[]" value=""><div class="row"><div class="col-12 imgAssignedMaterial"><img src="<?php echo KHC_PATH2.'uploads/'. $material['image']; ?>" class="img-fluid" alt=""></div><div class="col-12 titleAssignedMaterial"><?php echo $material['tytul'];?></div></div></div>
        <?php
    } 
    ?>
      <!--  -->
    </div>
  </div>

  <button class="accordion" type="button">Farby štandardné</button>
  <div class="panel">
    <div class="row">
        <!--  -->
        <?php
            foreach($przypisaneKolory as $material){
            if($material['przypisany']==true){
                $materialAssignedClass = 'AssignedMaterialActive';
            }else{
                $materialAssignedClass = '';

            }
            ?>
            <div class="col-md-3 col-sm-2 AssignedMaterial <?php echo $materialAssignedClass;?>" data-materialId="<?php echo $material['id'];?>"><input class="inputMaterialIdRemove" type="hidden" name="assignedMaterialRemove[]" value=""><input class="inputMaterialId" type="hidden" name="assignedMaterial[]" value=""><div class="row"><div class="col-12 imgAssignedMaterial"><img src="<?php echo KHC_PATH2.'uploads/'. $material['image']; ?>" class="img-fluid" alt=""></div><div class="col-12 titleAssignedMaterial"><?php echo $material['tytul'];?></div></div></div>
            <?php
        } 
        ?>
        <!--  -->
        </div>
  </div>

  

  <button class="accordion" type="button">Farby špeciálne</button>
  <div class="panel">
    <div class="row">
        <!--  -->
        <?php
            foreach($przypisaneKolorIndywidualny as $material){
            if($material['przypisany']==true){
                $materialAssignedClass = 'AssignedMaterialActive';
            }else{
                $materialAssignedClass = '';

            }
            ?>
            <div class="col-md-3 col-sm-2 AssignedMaterial <?php echo $materialAssignedClass;?>" data-materialId="<?php echo $material['id'];?>"><input class="inputMaterialIdRemove" type="hidden" name="assignedMaterialRemove[]" value=""><input class="inputMaterialId" type="hidden" name="assignedMaterial[]" value=""><div class="row"><div class="col-12 imgAssignedMaterial"><img src="<?php echo KHC_PATH2.'uploads/'. $material['image']; ?>" class="img-fluid" alt=""></div><div class="col-12 titleAssignedMaterial"><?php echo $material['tytul'];?></div></div></div>
            <?php
        } 
        ?>
        <!--  -->
        </div>
  </div>
  

    
    <!-- // -------------------------------------------------------------------------------------------------------- Doplnene 2. 10. 2023 -->
    <button class="accordion" type="button">Ukončenia</button>
    <div class="panel">
        <div class="row">
        <?php
        foreach($przypisaneEndings as $material){
        if($material['przypisany']==true){
            $materialAssignedClass = 'AssignedMaterialActive';
        }else{
            $materialAssignedClass = '';
        }
        ?>
        <div class="col-md-3 col-sm-2 AssignedMaterial <?php echo $materialAssignedClass;?>" data-materialId="<?php echo $material['id'];?>"><input class="inputMaterialIdRemove" type="hidden" name="assignedMaterialRemove[]" value=""><input class="inputMaterialId" type="hidden" name="assignedMaterial[]" value=""><div class="row"><div class="col-12 imgAssignedMaterial"><img src="<?php echo KHC_PATH2.'uploads/'. $material['image']; ?>" class="img-fluid" alt=""></div><div class="col-12 titleAssignedMaterial"><?php echo $material['tytul'];?></div></div></div>
        <?php
        } 
        ?>
        </div>
    </div>

  
    <!-- // -------------------------------------------------------------------------------------------------------- Doplnene 18. 8. 2023 -->
    <button class="accordion" type="button">Doplnky</button>
    <div class="panel">
        <div class="row">
        <?php
          foreach($przypisaneKoloryAkcesoria as $material){
          if($material['przypisany']==true){
            $materialAssignedClass = 'AssignedMaterialActive';
          }else{
            $materialAssignedClass = '';
          }
        ?>
        <div class="col-md-3 col-sm-2 AssignedMaterial <?php echo $materialAssignedClass;?>" data-materialId="<?php echo $material['id'];?>"><input class="inputMaterialIdRemove" type="hidden" name="assignedMaterialRemove[]" value=""><input class="inputMaterialId" type="hidden" name="assignedMaterial[]" value=""><div class="row"><div class="col-12 imgAssignedMaterial"><img src="<?php echo KHC_PATH2.'uploads/'. $material['image']; ?>" class="img-fluid" alt=""></div><div class="col-12 titleAssignedMaterial"><?php echo $material['tytul'];?></div></div></div>
        <?php
        } 
        ?>
        </div>
    </div>


    
    <!-- // -------------------------------------------------------------------------------------------------------- Doplnene 18. 8. 2023 -->
    <button class="accordion" type="button">Spoje</button>
    <div class="panel">
        <div class="row">
        <?php
          foreach($przypisaneJoints as $material){
          if($material['przypisany']==true){
            $materialAssignedClass = 'AssignedMaterialActive';
          }else{
            $materialAssignedClass = '';
          }
        ?>
        <div class="col-md-3 col-sm-2 AssignedMaterial <?php echo $materialAssignedClass;?>" data-materialId="<?php echo $material['id'];?>"><input class="inputMaterialIdRemove" type="hidden" name="assignedMaterialRemove[]" value=""><input class="inputMaterialId" type="hidden" name="assignedMaterial[]" value=""><div class="row"><div class="col-12 imgAssignedMaterial"><img src="<?php echo KHC_PATH2.'uploads/'. $material['image']; ?>" class="img-fluid" alt=""></div><div class="col-12 titleAssignedMaterial"><?php echo $material['tytul'];?><br><span class="addationalTitleAssignPage"><?php echo $material['uniqueText'];?></span></div></div></div>
        <?php
        } 
        ?>
        </div>
    </div>



    <!-- // -------------------------------------------------------------------------------------------------------- Doplnene 18. 8. 2023 -->
    <button class="accordion" type="button">Hrany</button>
    <div class="panel">
        <div class="row">
        <?php
          foreach($przypisaneWykonczenia as $material){
          if($material['przypisany']==true){
            $materialAssignedClass = 'AssignedMaterialActive';
          }else{
            $materialAssignedClass = '';
          }
        ?>
        <div class="col-md-3 col-sm-2 AssignedMaterial <?php echo $materialAssignedClass;?>" data-materialId="<?php echo $material['id'];?>"><input class="inputMaterialIdRemove" type="hidden" name="assignedMaterialRemove[]" value=""><input class="inputMaterialId" type="hidden" name="assignedMaterial[]" value=""><div class="row"><div class="col-12 imgAssignedMaterial"><img src="<?php echo KHC_PATH2.'uploads/'. $material['image']; ?>" class="img-fluid" alt=""></div><div class="col-12 titleAssignedMaterial"><?php echo $material['tytul'];?><br><span class="addationalTitleAssignPage"><?php echo $material['uniqueText'];?></span></div></div></div>
        <?php
        } 
        ?>
        </div>
    </div>

  <!--  -->
  <button type="submit" name="submit" class="btn btn-success mt-3">Zmeniť</button>
  
</form>
<p class="mt-3"><button id="btn-delete" class="btn btn-danger">Odstrániť</button></p>
    <a class="khc_powrot" href="<?php echo add_query_arg( $queryPowrotKsztaltyProfilow, admin_url( 'admin.php' ) );?>">< Späť</a>
<script>

var accordions = document.querySelectorAll(".accordion");
accordions.forEach((acc) =>
  acc.addEventListener("click", () => {
    acc.classList.toggle("active");
    var panel = acc.nextElementSibling;
    panel.classList.toggle("activeP");
    if (panel.style.maxHeight) {
      panel.style.maxHeight = null;
    } else {
      panel.style.maxHeight = panel.scrollHeight + "px";
    }
  })
);

$( document ).on('click','.AssignedMaterial',function() {
  var materialId = $(this).attr( "data-materialId" );
  if($(this).hasClass('AssignedMaterialActive')){
      //usuwanie klasy itp
      $(this).removeClass('AssignedMaterialActive');
      $(this).find('.inputMaterialId').val("");
      $(this).find('.inputMaterialIdRemove').val(materialId);
  }else{
      //dodanie klasy
    $(this).addClass('AssignedMaterialActive');
    $(this).find('.inputMaterialId').val(materialId);
    $(this).find('.inputMaterialIdRemove').val('');
  }

});

</script>

<!-- The Modal -->
<div id="modal-delete" class="modal">

<!-- Modal content -->
<div class="modal-content">
<span class="close">&times;</span>
<form method="POST">
    <p>Ste si istí, že chcete tento tvar odstrániť?</p>
    <input type="hidden" name="remove" value="true">
    <input type="hidden" name="idRelacji" value="<?php echo $id_relacji;?>">
    <p><button name="submit" class="btn btn-danger">Odstrániť</button></p>
    </div>
</form>
</div>

<script>

var modal = document.getElementById("modal-delete");
var btn = document.getElementById("btn-delete");
var span = document.getElementsByClassName("close")[0];
btn.onclick = function() {
modal.style.display = "block";
}
span.onclick = function() {
modal.style.display = "none";
}
window.onclick = function(event) {
if (event.target == modal) {
modal.style.display = "none";
}
}
</script>

