<?php
 $bootstrap_path = KHC_PATH2.'css/bootstrap.min.css';
 $css_patch = KHC_PATH2.'css/khc.css';
 $addColorGet = array( 'page' => 'calculator_aj_accessories_subcat_menu', 'do' => 'add');
 // Tytuł strony
 $khc_title_page = "Doplnky";
 if (isset($_GET['do'])) {
     $where = $_GET['do'];
     if($where =='edit'){
         $khc_title_page = "Upraviť doplnok";
     }
     elseif($where =='add'){
         $khc_title_page = "Pridanie nového doplnku";
     }
     else{
         $khc_title_page = "Doplnky";
     }

 }
 ?>
 <link rel="stylesheet" href="<?php echo $bootstrap_path ;?>">
 <link rel="stylesheet" href="<?php echo $css_patch ;?>">
 <div class="container khc-container">
 <h3 class="khc_title"><?php echo $khc_title_page;?></h3>



 <?php if(!isset($_GET['do'])): ?><a class="btn btn-success mb-3" href="<?php echo add_query_arg( $addColorGet, admin_url( 'admin.php' ) );?>">Pridať nový doplnok</a><?php endif;?>

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
             return khc_AccessoriesEdit($khcColorId);
             break;
         case 'add':
             return khc_AccessoriesAdd();
             break;
         case 'remove':
              return removeMaterial($khcColorId,$khcReturnPage);
             break;   
         case 2:
             echo "i equals 2";
             break;
     }
 } else {
     return khc_showAllAccessories();
 }


 ?>
 </div>

 