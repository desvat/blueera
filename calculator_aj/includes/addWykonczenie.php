    <?php
$wykonczenie = new kalkulatorHcMaterial();
$queryPowrotKolory = array( 'page' => 'calculator_aj_wykonczenie_subcat_menu');
$redirectLink = add_query_arg( $queryPowrotKolory, admin_url( 'admin.php' ) );
if(isset($_POST['submit'])){

        
     // Przesylanie pliku
     if(isset($_FILES['fileToUpload']['tmp_name']) && $_FILES['fileToUpload']['tmp_name'] != ""){
       
        //dodawanie nowego zdjecia
        $stringsalt = time();
        $my_custom_filename = $stringsalt.$_FILES['fileToUpload']['name'];
        $uploads_new_path = KHC_PATH.'uploads/'.$my_custom_filename;
        
        $upload_dir = wp_upload_dir();
        wp_upload_bits($my_custom_filename , null, file_get_contents($_FILES['fileToUpload']['tmp_name']));
        move_uploaded_file( $_FILES['fileToUpload']['tmp_name'], $uploads_new_path );
      
        $edytowaneParamenty['image'] = $my_custom_filename;
        
    }

        $dodawaneParamenty = [
            'tytul'=>$_POST['tytul'],
            'typ'=>'wykonczenie',
            'uniqueText'=>$_POST['dodatkowytytul'],
            'image'=>$my_custom_filename
        ];
        $wykonczenie->addWykonczenie($dodawaneParamenty);
        echo '<script>window.location.replace("'.$redirectLink.'");</script>';
}
    ?>
    <form method="POST" enctype="multipart/form-data">
    <div class="mb-3">
        <label for="TytulKolor" class="form-label">Názov</label>
        <input type="text" class="form-control" name="tytul" id="TytulKolor" aria-describedby="emailHelp" required>
        <div id="emailHelp" class="form-text">Zadajte názov zobrazeného cieľa</div>
       
        <label for="dodatkowyTytulKolor" class="form-label mt-3">Ďalšie informácie</label>
        <input type="text" class="form-control" name="dodatkowytytul" id="dodatkowyTytulKolor" aria-describedby="emailHelp" value="">
        <div id="emailHelp" class="form-text">Zadajte ďalšie meno, ktoré je viditeľné len v paneli správcu</div>
        
        <input class="mt-3" id="fileToUpload" name="fileToUpload" accept=".jpg,.jpeg,.gif,.png" type="file" required> 
     
        
        </div>
        <button type="submit" name="submit" class="btn btn-primary">Pridať</button>
    </form>
    
    <p><a class="khc_powrot" href="<?php echo add_query_arg( $queryPowrotKolory, admin_url( 'admin.php' ) );?>">< späť</a></p>