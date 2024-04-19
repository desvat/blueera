<?php
 $bootstrap_path = KHC_PATH2.'css/bootstrap.min.css';
 $css_patch = KHC_PATH2.'css/khc.css';
 $addksztaltProfiluGet = array( 'page' => 'calculator_aj_ksztaltProfilu_subcat_menu', 'do' => 'add');
 // Tytuł strony
 $khc_title_page = "Tvary profilov";
 if (isset($_GET['do'])) {
     $where = $_GET['do'];
     if($where =='edit'){
        $khc_title_page = "Upraviť profil";
     }
     elseif($where =='add'){
        $khc_title_page = "Pridať nový profil";

     }
     else{

         $khc_title_page = "Tvary profilov";

     }

 }
 ?>
 <link rel="stylesheet" href="<?php echo $bootstrap_path ;?>">
 <link rel="stylesheet" href="<?php echo $css_patch ;?>">
 <div class="container khc-container">
 <h3 class="khc_title"><?php echo $khc_title_page;?></h3>
 <?php if(!isset($_GET['do'])): ?>

     <!-- <a class="btn btn-success mb-3" href="<?php echo add_query_arg( $addksztaltProfiluGet, admin_url( 'admin.php' ) );?>">Pridať nový</a> -->
     <?php endif;?>

 <?php
 // jaki widok zwrócić
 if (isset($_GET['do'])) {
     $where = $_GET['do'];
     if(isset($_GET['id'])){
         $khcksztaltProfiluId = $_GET['id'];
     }
     if(isset($_GET['page']))
     {
         $khcReturnPage = $_GET['page'];
     }
     switch ($where) {
         case 'edit':
             
             return khc_ksztaltProfiluEdit($khcksztaltProfiluId);
             break;
         case 'add':
            //  return khc_ksztaltProfiluAdd();
             break;
         case 'remove':
             
              return removeMaterial($khcksztaltProfiluId,$khcReturnPage);
             break;   
         case 2:
             echo "i equals 2";
             break;
     }
 } else {
     return khc_showAllksztaltProfilu();
 }


 ?>
 </div>

 