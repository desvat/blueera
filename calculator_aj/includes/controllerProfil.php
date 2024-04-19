<?php
 $bootstrap_path = KHC_PATH2.'css/bootstrap.min.css';
 $css_patch = KHC_PATH2.'css/khc.css';
 $addWykonczenieGet = array( 'page' => 'calculator_aj_profil_subcat_menu', 'do' => 'add','step' => '1' ,'action' => 'new' , 'id' => 'none');

 $khc_title_page = "Profily";
 ?>
 <link rel="stylesheet" href="<?php echo $bootstrap_path ;?>">
 <link rel="stylesheet" href="<?php echo $css_patch ;?>">
 <script src="<?php echo KHC_PATH_JQUERY2;?>"></script>
 <div class="container khc-container">
 <h3 class="khc_title"><?php echo $khc_title_page;?></h3>
 <?php if(!isset($_GET['do'])): ?>

<a class="btn btn-success mb-3" href="<?php echo add_query_arg( $addWykonczenieGet, admin_url( 'admin.php' ) );?>">Pridať nový profil</a>
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
            if(isset($_GET['step'])){
                // Tytuł opis
                if($_GET['step']==1){
                    return khc_profilAdd();
                }
                // Ddodanie do bazy  
                elseif($_GET['step']==2){
                    echo "Dodano do bazy";
                }
                // do usunięcia te stepy
                elseif($_GET['step']==2){
                    echo "Dodano do bazy";
                }
                elseif($_GET['step']==3){
                    echo "Konfiguracja trzeba jeszcze dodać id z bazy";
                }

            }
            
             break;
         case 'remove':
             
              return removeMaterial($khcksztaltProfiluId,$khcReturnPage);
             break;   
         case 'konfiguruj':
            khc_profilShowConfiguration();
             break;
             case 'addksztalt':
                khc_profilAddKsztalt();
                 break;
                 case 'editksztalt':
                    khc_profilEditKsztalt();
                     break;
                     case 'assignShape':
                        khc_assignShape();
                         break;
     }
 } else {
    return khc_showAllProfile();
 }

 function khc_profilAdd(){
 
    require_once 'profil/addProfil.php'; 
    // echo "Działa";     
   
}
function khc_profilShowConfiguration(){
 
    require_once 'profil/configurationProfil.php';
    // echo "Działa";     
   
}
function khc_profilAddKsztalt(){
 
    require_once 'profil/addKsztaltProfil.php';
    // echo "Działa";     
   
}

function khc_profilEditKsztalt(){
 
    require_once 'profil/editKsztaltProfil.php';
    // echo "Działa";     
   
}

function khc_assignShape(){
    
    if(isset($_GET['id']) && isset($_GET['idKsztaltu'])){
        $profil = new kalkulatorHcProfil();
        $idProfilu = $_GET['id'];
        $idKsztaltu = $_GET['idKsztaltu'];
        //switch z szablonami
      
        //aktualnie szuka po tytule można w przyszłosci
        $material = new kalkulatorHcMaterial();
        $wybranyKsztalt = $material -> getksztaltProfilu($idKsztaltu);
        $ktorySzablon = $wybranyKsztalt->slug;

        // $ktorySzablon = 'Profil pełny';

 
        // przerobić na slug
        switch ($ktorySzablon) {
            case 'katownik':
                $ksztalt = 'katownik';
                require_once KHC_PATH.'includes/templateKsztalt/katownik.php';
             
                break;
            case "ceownik":
                $ksztalt = 'Ceownik';
                require_once KHC_PATH.'includes/templateKsztalt/ceownik.php';
               
                break;
            case "deska":
                $ksztalt = 'deska';
                require_once KHC_PATH.'includes/templateKsztalt/deska.php';
                break;

            case "deskaWall":
                $ksztalt = 'deskaWall';
                require_once KHC_PATH.'includes/templateKsztalt/deskaWall.php';
                break;

            case "profilpelny":
                $ksztalt = 'profilPelny';
                 require_once KHC_PATH.'includes/templateKsztalt/profil_pelny.php';   
                break;
            case "profilprzelotowy":
                $ksztalt = 'profilPrzelotowy';
                require_once KHC_PATH.'includes/templateKsztalt/profil_przelotowy.php';   
                break;
            case "elastycznaimitacjadeski":
                    $ksztalt = 'elastycznaimitacjadeski';
                    require_once KHC_PATH.'includes/templateKsztalt/elastycznaimitacjadeski.php';   
                break;
            case "elastycznaokleina":
                    $ksztalt = 'elastycznaokleina';
                    require_once KHC_PATH.'includes/templateKsztalt/elastycznaokleina.php';   
                break;          
        }


        
        //dodaj do bazy
        $dataAddTemplate = [
            'idProfilu'=> $idProfilu,
            'idKsztaltuProfilu'=>$idKsztaltu,
            'ksztalt'=>$ksztalt,
            'cena'=>10.2,
            'data'=> json_encode($data),
        
        ];
       
        $addProfil = $profil -> khc_addAssignedShape($dataAddTemplate);
        $editKsztaltGet = array( 'page' => 'calculator_aj_profil_subcat_menu', 'do' => 'editksztalt', 'id' => $addProfil);
    //    echo add_query_arg( $editKsztaltGet, admin_url( 'admin.php' ) );
        ?>
            <script>
                window.location.replace("<?php echo add_query_arg( $editKsztaltGet, admin_url( 'admin.php' ) );?>");
            </script>
        <?php
    }

   
    
}


 ?>
</div>