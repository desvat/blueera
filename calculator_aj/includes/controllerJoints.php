<?php
 $bootstrap_path = KHC_PATH2.'css/bootstrap.min.css';
 $css_patch = KHC_PATH2.'css/khc.css';
 $addJointGet = array( 'page' => 'calculator_aj_joints_subcat_menu', 'do' => 'add');
 // Tytuł strony
 $khc_title_page = "Spoje";
 if (isset($_GET['do'])) {
     $where = $_GET['do'];
     if($where =='edit'){
         $khc_title_page = "Upraviť spoj";
     }
     elseif($where =='add'){
         $khc_title_page = "Pridanie nový spoj";
     }
     else{
         $khc_title_page = "Spoje";
     }

 }
 ?>
 <link rel="stylesheet" href="<?php echo $bootstrap_path ;?>">
 <link rel="stylesheet" href="<?php echo $css_patch ;?>">
 <div class="container khc-container">
 <h3 class="khc_title"><?php echo $khc_title_page;?></h3>



 <?php if(!isset($_GET['do'])): ?><a class="btn btn-success mb-3" href="<?php echo add_query_arg( $addJointGet, admin_url( 'admin.php' ) );?>">Pridať nový spoj</a><?php endif;?>

 <?php
 // jaki widok zwrócić
 if (isset($_GET['do'])) {
     $where = $_GET['do'];
     if(isset($_GET['id'])){
         $khcJointId = $_GET['id'];
     }
     if(isset($_GET['page']))
     {
         $khcReturnPage = $_GET['page'];
     }
     switch ($where) {
         case 'edit':
             return khc_JointsEdit($khcJointId);
             break;
         case 'add':
             return khc_JointsAdd();
             break;
         case 'remove':
              return removeMaterial($khcJointId,$khcReturnPage);
             break;   
         case 2:
             echo "i equals 2";
             break;
     }
 } else {
     return khc_showAllJoints();
 }


 ?>
 </div>

 