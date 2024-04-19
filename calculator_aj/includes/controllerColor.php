<?php
 $bootstrap_path = KHC_PATH2.'css/bootstrap.min.css';
 $css_patch = KHC_PATH2.'css/khc.css';
 $addColorGet = array( 'page' => 'calculator_aj_kolor_subcat_menu', 'do' => 'add');
 // Tytuł strony
 $khc_title_page = "Farby";
 if (isset($_GET['do'])) {
     $where = $_GET['do'];
     if($where =='edit'){
        $khc_title_page = "Upraviť farbu";
    }
    elseif($where =='add'){
        $khc_title_page = "Pridanie novej farby";
    }
    else{
        $khc_title_page = "Farby";
    }

 }
 ?>
 <link rel="stylesheet" href="<?php echo $bootstrap_path ;?>">
 <link rel="stylesheet" href="<?php echo $css_patch ;?>">
 <div class="container khc-container">
 <h3 class="khc_title"><?php echo $khc_title_page;?></h3>
 <?php if(!isset($_GET['do'])): ?>

     <a class="btn btn-success mb-3" href="<?php echo add_query_arg( $addColorGet, admin_url( 'admin.php' ) );?>">Pridať novú farbu</a>
     <?php endif;?>

 <?php
 // jaki widok zwrócić
 if (isset($_GET['do'])) {
     $where = $_GET['do'];
     if(isset($_GET['id'])){
         $khcColorId = $_GET['id'];
     }
     if(isset($_GET['page']))
     {
         $khcReturnPage = $_GET['page'];
     }
     switch ($where) {
         case 'edit':
             
             return khc_ColorEdit($khcColorId);
             break;
         case 'add':
             return khc_colorAdd();
             break;
         case 'remove':
             
              return removeMaterial($khcColorId,$khcReturnPage);
             break;   
         case 2:
             echo "i equals 2";
             break;
     }
 } else {
     return khc_showAllColor();
 }


 ?>
 </div>

 