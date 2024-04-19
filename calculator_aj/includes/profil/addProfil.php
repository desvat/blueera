<?php
$profilModel = new kalkulatorHcProfil;

$addTymczasowyGet = array( 'page' => 'calculator_aj_profil_subcat_menu', 'do' => 'add','step' => '2');
if(isset($_GET['id']) && isset($_GET['action'])){
    if($_GET['id'] != "none" && $_GET['action'] == "edit"){
        // pobierz dane i dodaj do formy
        // echo "edytuje";
        $idprofilu = $_GET['id'];
        $profil = $profilModel->getProfil($idprofilu);
        $title = $profil->tytul;
        $description = $profil->opis;
        $idProfiluObj = $profil->id;
        $tekstPrzycisku = "Aktualizovať";
        $KonfigurujGet = array( 'page' => 'calculator_aj_profil_subcat_menu', 'do' => 'konfiguruj', 'id' => $idprofilu);
       
     
      
        //Aktualizacja
        if(!isset($_POST['description'])){
            $descriptionUpdate = '';
        }else{
            $descriptionUpdate = $_POST['description'];
        }
        if(isset($_POST['title'])){
            $title = $_POST['title'];
            $idArray=[
                'id' => $idProfiluObj
            ];




            $data = [
                'tytul'=> $title,
                'opis'=>$descriptionUpdate,
                
            ];

            if(isset($_FILES['fileToUpload']['tmp_name']) && $_FILES['fileToUpload']['tmp_name'] != ""){
                
                //dodawanie nowego zdjecia
                $stringsalt = time();
                $my_custom_filename = $stringsalt.$_FILES['fileToUpload']['name'];
                $uploads_new_path = KHC_PATH.'uploads/'.$my_custom_filename;
                
                $upload_dir = wp_upload_dir();
                wp_upload_bits($my_custom_filename , null, file_get_contents($_FILES['fileToUpload']['tmp_name']));
                move_uploaded_file( $_FILES['fileToUpload']['tmp_name'], $uploads_new_path );
            
                $data['image'] = $my_custom_filename;
                
            }


            $updateProfil = $profilModel->editProfil($data,$idArray);

            //$dodanyProfil definuje odrazu nowe id
        
            // dodaj do bazy i zró przekierowanie na step 2 z nowym id
        }

        // koniec aktualizacji
    }else{
        // echo "Dodaje nowy";
        $title = '';
        $description = '';
        $tekstPrzycisku = "Pridať";
        if(!isset($_POST['description'])){
            $description = '';
        }else{
            $description = $_POST['description'];
        }
        if(isset($_POST['title'])){
            $title = $_POST['title'];

            $data = [
                'tytul'=> $title,
                'opis'=>$description,
                'roboczy'=>0
            ];
            // Przesylanie pliku
            if(isset($_FILES['fileToUpload']['tmp_name']) && $_FILES['fileToUpload']['tmp_name'] != ""){
                
                //dodawanie nowego zdjecia
                $stringsalt = time();
                $my_custom_filename = $stringsalt.$_FILES['fileToUpload']['name'];
                $uploads_new_path = KHC_PATH.'uploads/'.$my_custom_filename;
                
                $upload_dir = wp_upload_dir();
                wp_upload_bits($my_custom_filename , null, file_get_contents($_FILES['fileToUpload']['tmp_name']));
                move_uploaded_file( $_FILES['fileToUpload']['tmp_name'], $uploads_new_path );
            
                $data['image'] = $my_custom_filename;
                
            }
           

            
            // var_dump($data);
            $dodanyProfil = $profilModel->addProfil($data);
            //$dodanyProfil definuje odrazu nowe id
        
             $KonfigurujGet = array( 'page' => 'calculator_aj_profil_subcat_menu', 'do' => 'konfiguruj', 'id' => $dodanyProfil);
            $redirectConfigUrl = add_query_arg( $KonfigurujGet, admin_url( 'admin.php' ) );
                ?>
                
     <script>  
                 window.location.replace("<?php echo $redirectConfigUrl;?>");
      </script>

                <?php
            // dodaj do bazy i zró przekierowanie na step 2 z nowym id
        }
       

    }
}


?>

<form method="post" enctype="multipart/form-data">
  <div class="mb-3">
    <label for="InputTitle" class="tytuł">Tytuł</label>
    <input type="text" name="title" class="form-control" value="<?php echo $title;?>">
  </div>
  <div class="mb-3">
    <label for="InputDescription" class="tytuł">Opis</label>
    <textarea name="description" class="form-control"><?php echo $description ;?></textarea>
  </div>
  <?php
    if(isset($_GET['action']) && $_GET['action']=='add'){
        $dopisRequired = 'required';
    }else{
        $dopisRequired = '';
    }
    ?>
  <div class="mb-3">
    <label for="InputDescription" class="tytuł">Zdjęcie tła</label><br>
    <input class="mt-3" id="fileToUpload" name="fileToUpload" accept=".jpg,.jpeg,.gif,.png" type="file" <?php echo $dopisRequired;?>>
  </div>
  
    <!-- <input type="hidden" name="action" value="AddToDb"> -->
  <button type="submit" class="btn btn-primary"><?php echo $tekstPrzycisku;?></button>
</form>
<?php
if($_GET['action'] == "edit"){
?>
  <a class="btn btn-success mt-3" href="<?php echo add_query_arg( $KonfigurujGet, admin_url( 'admin.php' ) );?>">Prejsť na konfiguráciu</a>

<?php
}
?>
