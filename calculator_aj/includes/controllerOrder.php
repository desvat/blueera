<?php
$bootstrap_path = KHC_PATH2 . 'css/bootstrap.min.css';
$css_patch = KHC_PATH2 . 'css/khc.css';
// $addColorGet = array('page' => 'calculator_aj_kolor_subcat_menu', 'do' => 'add');
// // Tytuł strony
// $khc_title_page = "Kolory";





?>
<link rel="stylesheet" href="<?php echo $bootstrap_path; ?>">
<link rel="stylesheet" href="<?php echo $css_patch; ?>">
<div class="container khc-container">
   <?php

    if(isset($_GET['action'])){

        if($_GET['action']=='orderList'){

            require_once 'orderList.php';

        }elseif($_GET['action']=='showOrder'){

            require_once 'orderShow.php';
        }

    }else{
        require_once 'orderList.php';
    }
?>
</div>