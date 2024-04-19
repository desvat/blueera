<?php
 $bootstrap_path = KHC_PATH2.'css/bootstrap.min.css';
 $css_patch = KHC_PATH2.'css/khc.css';
 $addWykonczenieGet = array( 'page' => 'calculator_aj_wykonczenie_subcat_menu', 'do' => 'add');
 // Tytuł strony
 $khc_title_page = "Hrany";
 if (isset($_GET['do'])) {
     $where = $_GET['do'];
     if($where =='edit') {
         $khc_title_page = "Upraviť hranu";
     }
     elseif($where =='add') {
        $khc_title_page = "Pridať novú hranu";
     }
     else {
        $khc_title_page = "Hrany";
     }

 }
 ?>
 <link rel="stylesheet" href="<?php echo $bootstrap_path ;?>">
 <link rel="stylesheet" href="<?php echo $css_patch ;?>">
 <div class="container khc-container">
 <h3 class="khc_title"><?php echo $khc_title_page;?></h3>
 <?php if(!isset($_GET['do'])): ?>

     <a class="btn btn-success mb-3" href="<?php echo add_query_arg( $addWykonczenieGet, admin_url( 'admin.php' ) );?>">Pridať novú hranu</a>
     <?php endif;?>

 <?php
 // jaki widok zwrócić
 if (isset($_GET['do'])) {
     $where = $_GET['do'];
     if(isset($_GET['id'])){
         $khcWykonczenieId = $_GET['id'];
     }
     if(isset($_GET['page']))
     {
         $khcReturnPage = $_GET['page'];
     }
     switch ($where) {
         case 'edit':
             
             return khc_wykonczenieEdit($khcWykonczenieId);
             break;
         case 'add':
             return khc_wykonczenieAdd();
             break;
         case 'remove':
             
              return removeMaterial($khcWykonczenieId,$khcReturnPage);
             break;   
         case 2:
             echo "i equals 2";
             break;
     }
 } else {
     return khc_showAllWykonczenie();
 }


 ?>
 </div>

 