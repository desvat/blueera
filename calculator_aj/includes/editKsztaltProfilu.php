<?php

$ksztaltProfilu = new kalkulatorHcMaterial();
   
if(isset($_POST['submit'])){
        
       
    $gdzieParamenty = [
        'id'=>$id
    ];
    $edytowaneParamenty = [
        'tytul'=>$_POST['tytul']
    ];
     // Przesylanie pliku
    if(isset($_FILES['fileToUpload']['tmp_name']) && $_FILES['fileToUpload']['tmp_name'] != ""){
        
        //usuwanie starego zdjecia
        $getImage = new kalkulatorHcMaterial();
            $oldImage =$getImage->getksztaltProfilu($id);
            $oldImageUrl = $oldImage->image;
            if($oldImageUrl != ''){
                if(file_exists(KHC_PATH.'uploads/'.$oldImageUrl)){
                    unlink(KHC_PATH.'uploads/'.$oldImageUrl);
                }
            }
        


        //dodawanie nowego zdjecia
        $stringsalt = time();
        $my_custom_filename = $stringsalt.$_FILES['fileToUpload']['name'];
        $uploads_new_path = KHC_PATH.'uploads/'.$my_custom_filename;
        
        $upload_dir = wp_upload_dir();
        wp_upload_bits($my_custom_filename , null, file_get_contents($_FILES['fileToUpload']['tmp_name']));
        move_uploaded_file( $_FILES['fileToUpload']['tmp_name'], $uploads_new_path );
      
        $edytowaneParamenty['image'] = $my_custom_filename;
        $ksztaltProfilu->editksztaltProfilu($edytowaneParamenty,$gdzieParamenty);
        $komunikat = '<p style="color:green;">Zaktualizowano pomyślnie!</p>';
    }
    $ksztaltProfilu->editksztaltProfilu($edytowaneParamenty,$gdzieParamenty);
    $komunikat = '<p style="color:green;">Zaktualizowano pomyślnie!</p>';
        
    }else{
      
        $komunikat = "";
    }
    $selectedksztaltProfilu = $ksztaltProfilu->getksztaltProfilu($id);

    $queryPowrotksztaltProfilu = array( 'page' => 'calculator_aj_ksztaltProfilu_subcat_menu');

    $remove_args = array( 'page' => 'calculator_aj_ksztaltProfilu_subcat_menu', 'do' => 'remove','id'=>$id ); 
    
?>
  
    <form method="POST" enctype="multipart/form-data">
        <div class="mb-3">
        <?php 
                if(file_exists(KHC_PATH.'uploads/'.$selectedksztaltProfilu->image) && $selectedksztaltProfilu->image != ""):?>
                 <div class="col-md-4">
                     <div class="row mb-3">
                        <img src="<?php echo KHC_PATH.'uploads/'.$selectedksztaltProfilu->image; ?>" class="img-fluid" alt="">
                     </div>
                
                 </div>   
        <?php endif;?>
        <?php
        if(isset($komunikat)){
            echo $komunikat;
        }
        ?>
        <label for="TytulKolor" class="form-label">Tytuł</label>
        <input class="form-control" name="tytul" id="TytulKolor" aria-describedby="emailHelp" value="<?php echo $selectedksztaltProfilu->tytul;?>" required>
        <div id="emailHelp" class="form-text">Podaj nazwę wyświetlanego kształtu</div>
       
        <input class="mt-3" id="fileToUpload" name="fileToUpload" accept=".jpg,.jpeg,.gif,.png" type="file"> 
     
    </div>
    <button type="submit" name="submit" class="btn btn-primary">Aktualizovať</button>
    </form>
    <!-- <p class="mt-3"><button id="btn-delete" class="btn btn-danger">Usuń</button></p> -->
    <a class="khc_powrot" href="<?php echo add_query_arg( $queryPowrotksztaltProfilu, admin_url( 'admin.php' ) );?>">< späť</a>

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






<!-- The Modal -->
<div id="modal-delete" class="modal">

<!-- Modal content -->
<div class="modal-content">
<span class="close">&times;</span>
<p>Czy na pewno chcesz usunąć to wykończenie?</p>
<p><a href="<?php echo add_query_arg( $remove_args, admin_url( 'admin.php' ) );?>" class="btn btn-danger">Usuń</a></p>
</div>

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
