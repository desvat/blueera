<?php
	/*
	Plugin Name: Konfigurátor profilov
	Description: Program pre výpočet ceny profilov podla rozmerov a dĺžky
	Version: 2.0
	Author: Adrián Jakubča
	Author URI: https://www.jakubca.com/
	*/
?>
<?php
/**
 * Tworzy tabele bazy danych dla pluginu
 *
 * @global $wpdb
 */
function boot_session() {
    if(!isset($_SESSION)) {
        session_start();
   }
  }
  add_action('wp_loaded','boot_session');

function kalkulatorhc_install() {
    global $wpdb;
    $prefix = $wpdb->prefix;
    $kalkulatorHcMaterial_tablename = $prefix . "calculator_aj_material";
    $kalkulatorHcProfile_tablename = $prefix . "calculator_aj_profile";
    $kalkulatorHcProfileKsztaltyProfili_tablename = $prefix . "calculator_aj_profil_ksztaltProfilu";
    $kalkulatorHcKsztaltyProfiliMaterialy_tablename = $prefix . "calculator_aj_ksztaltProfilu_material";
    $kalkulatorHcZamowienia_tablename = $prefix . "calculator_aj_zamowienia";
    $kalkulatorHcSettings_tablename = $prefix . "calculator_aj_settings";
    $kalkulatorHcLanguage_tablename = $prefix . "calculator_aj_language";


    $rmlc_db_version = "1.0";
 // tworzenie tabeli materiałów
    if ($wpdb->get_var("SHOW TABLES LIKE '" . $kalkulatorHcMaterial_tablename . "'") != $kalkulatorHcMaterial_tablename) {
        $query = "CREATE TABLE " . $kalkulatorHcMaterial_tablename . " (
        id int(9) NOT NULL AUTO_INCREMENT,
        image varchar(250) NOT NULL,
        tytul varchar(250) NOT NULL,
        typ varchar(250) NOT NULL,
        slug varchar(250),
        uniqueText varchar(250),
        PRIMARY KEY  (id)
        ) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci";

        $wpdb->query($query);

        // dodaje odrazu materiały

        $queryShape = "INSERT INTO `$kalkulatorHcMaterial_tablename` (`id`, `image`, `tytul`, `typ`,`slug`) VALUES
        (NULL, '1634746308katownik.png', 'Kątownik', 'ksztaltProfilu','katownik'),
        (NULL, '1636214323ceownik.png', 'Ceownik', 'ksztaltProfilu','ceownik'),
        (NULL, '1635445550przelotowy.png', 'Profil przelotowy', 'ksztaltProfilu','profilprzelotowy'),
        (NULL, '1635445590pelny.png', 'Profil pełny', 'ksztaltProfilu','profilpelny'),
        (NULL, '123123123elastyczna.png', 'Elastyczna imitacja deski', 'ksztaltProfilu','elastycznaimitacjadeski'),
        (NULL, '123123123elastyczna.png', 'Elastyczna okleina', 'ksztaltProfilu','elastycznaokleina'),
        (NULL, '1635445629deska.png', 'Deska', 'ksztaltProfilu','deska')";
        $wpdb->query($queryShape);

    }
 // tworzenie tabeli materiałów
    if ($wpdb->get_var("SHOW TABLES LIKE '" . $kalkulatorHcProfile_tablename . "'") != $kalkulatorHcProfile_tablename) {
        $query2 = "CREATE TABLE " . $kalkulatorHcProfile_tablename . " (
        id int(9) NOT NULL AUTO_INCREMENT,
        image varchar(250) NOT NULL,
        tytul varchar(250) NOT NULL,
        opis varchar(250) NOT NULL,
        roboczy boolean DEFAULT true,
        PRIMARY KEY  (id)
        ) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci";
        $wpdb->query($query2);


    }

    // tworzy relacje profil do kształtu profilu gdzie ustawiana jest również cena
    if ($wpdb->get_var("SHOW TABLES LIKE '" . $kalkulatorHcProfileKsztaltyProfili_tablename . "'") != $kalkulatorHcProfileKsztaltyProfili_tablename) {
        $query3 = "CREATE TABLE " . $kalkulatorHcProfileKsztaltyProfili_tablename . " (
        id int(9) NOT NULL AUTO_INCREMENT,
        idProfilu int NOT NULL,
        idKsztaltuProfilu int NOT NULL,
        cena float NOT NULL,
        data json,
        ksztalt varchar(250) NOT NULL,
        widoczny boolean DEFAULT false,
        PRIMARY KEY  (id)
        ) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci";
        $wpdb->query($query3);

    }

        // tworzy relacje materiały do ksztaltu i profilu
        if ($wpdb->get_var("SHOW TABLES LIKE '" . $kalkulatorHcKsztaltyProfiliMaterialy_tablename . "'") != $kalkulatorHcKsztaltyProfiliMaterialy_tablename) {
            $query4 = "CREATE TABLE " . $kalkulatorHcKsztaltyProfiliMaterialy_tablename . " (
            id int(9) NOT NULL AUTO_INCREMENT,
            idProfilu int NOT NULL,
            idKsztaltuProfilu int NOT NULL,
            idMaterialu int NOT NULL,
            typ varchar(250) NOT NULL,
            PRIMARY KEY  (id)
            ) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci";
            $wpdb->query($query4);

        }
        // tworzy tabele z zamowieniami
        if ($wpdb->get_var("SHOW TABLES LIKE '" . $kalkulatorHcZamowienia_tablename . "'") != $kalkulatorHcZamowienia_tablename) {
            $query5 = "CREATE TABLE " . $kalkulatorHcZamowienia_tablename . " (
                `id` INT NOT NULL AUTO_INCREMENT,
                `imie` TEXT NOT NULL,
                `nazwisko` TEXT NOT NULL,
                `email` TEXT NOT NULL,
                `ulica` TEXT NOT NULL,
                `miasto` TEXT NOT NULL,
                `kodPocztowy` TEXT NOT NULL,
                `telefon` TEXT NOT NULL,
                `nazwaFirmy` TEXT NOT NULL,
                `nip` TEXT NOT NULL,
                `kraj` TEXT NOT NULL,
                `produkty` json NOT NULL,
                `wiadomosc` TEXT NOT NULL,
                `notatka` TEXT NOT NULL,
                `dataDodania` DATETIME NOT NULL,
                `status` TEXT NOT NULL,
                `userId` INT,
                `orderNo` INT,
                `ulicaInne` TEXT NOT NULL,
                `miastoInne` TEXT NOT NULL,
                `kodPocztowyInne` TEXT NOT NULL,
                PRIMARY KEY (`id`)
            ) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci";
            $wpdb->query($query5);

        }

         // Dodaje ustawienia
         if ($wpdb->get_var("SHOW TABLES LIKE '" . $kalkulatorHcSettings_tablename . "'") != $kalkulatorHcSettings_tablename) {
            $query6 = "CREATE TABLE " . $kalkulatorHcSettings_tablename . " (
            id int(9) NOT NULL AUTO_INCREMENT,
            nazwa text NOT NULL,
            wartosc text NOT NULL,
            PRIMARY KEY  (id)
            ) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci";
            $wpdb->query($query6);

              //CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci

            $querySettings = "INSERT INTO `$kalkulatorHcSettings_tablename` (`id`, `nazwa`, `wartosc`) VALUES
            (NULL, 'email', ''),
            (NULL, 'podatek', '23'),
            (NULL, 'waluta', '€'),
            (NULL, 'miejsceWaluty', 'rightSpace'),
            (NULL, 'linkRegulamin', ''),
            (NULL, 'linkPolityka', '')";
            $wpdb->query($querySettings);

        }
           // Dodaje tłumaczenia
           if ($wpdb->get_var("SHOW TABLES LIKE '" . $kalkulatorHcLanguage_tablename . "'") != $kalkulatorHcLanguage_tablename) {
            $query7 = "CREATE TABLE " . $kalkulatorHcLanguage_tablename . " (
            id int(9) NOT NULL AUTO_INCREMENT,
            nazwa text NOT NULL,
            wartosc text NOT NULL,
            PRIMARY KEY (id)
            ) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci";
            $wpdb->query($query7);

        }


}

register_activation_hook(__FILE__, 'kalkulatorhc_install');

function add_to_menu_hc() {
    // dodaje to główne menu do ma się wyświetlić
    add_menu_page('Konfigurátor profilov', 'Konfigurátor profilov', 'administrator', 'calculator_aj_settings', 'calculator_aj_display_main');
    // dodaje podkategorie
    add_submenu_page('calculator_aj_settings', __('Objednávky'), __('Objednávky'), 'edit_themes', 'calculator_aj_zamowienia_subcat_menu', 'calculator_aj_display_orders');
    add_submenu_page('calculator_aj_settings', __('Profily'), __('Profily'), 'edit_themes', 'calculator_aj_profil_subcat_menu', 'calculator_aj_display_profil');
    add_submenu_page('calculator_aj_settings', __('Farby štandardné'), __('Farby štandardné'), 'edit_themes', 'calculator_aj_kolor_subcat_menu', 'calculator_aj_display_kolor');

    // -------------------------------------------------------------------------------------------------------- Doplnene 18. 8. 2023
    add_submenu_page('calculator_aj_settings', __('Farby špeciálne'), __('Farby špeciálne'), 'edit_themes', 'calculator_aj_kolor_individual_subcat_menu', 'calculator_aj_display_kolor_individual');
    // -------------------------------------------------------------------------------------------------------- Doplnene 2. 10. 2023
    add_submenu_page('calculator_aj_settings', __('Ukončenia'), __('Ukončenia'), 'edit_themes', 'calculator_aj_endings_subcat_menu', 'calculator_aj_display_endings');
    // -------------------------------------------------------------------------------------------------------- Doplnene 18. 8. 2023
    add_submenu_page('calculator_aj_settings', __('Spoje'), __('Spoje'), 'edit_themes', 'calculator_aj_joints_subcat_menu', 'calculator_aj_display_joints');
    // -------------------------------------------------------------------------------------------------------- Doplnene 18. 8. 2023
    add_submenu_page('calculator_aj_settings', __('Doplnky'), __('Doplnky'), 'edit_themes', 'calculator_aj_accessories_subcat_menu', 'calculator_aj_display_accessories');

    add_submenu_page('calculator_aj_settings', __('Vzor dreva'), __('Vzor dreva'), 'edit_themes', 'calculator_aj_material_subcat_menu', 'calculator_aj_display_material');
    add_submenu_page('calculator_aj_settings', __('Hrany'), __('Hrany'), 'edit_themes', 'calculator_aj_wykonczenie_subcat_menu', 'calculator_aj_display_wykonczenie');
    add_submenu_page('calculator_aj_settings', __('Tvary profilov'), __('Tvary profilov'), 'edit_themes', 'calculator_aj_ksztaltProfilu_subcat_menu', 'calculator_aj_display_ksztaltProfilu');
    add_submenu_page('calculator_aj_settings', __('Jazyk'), __('Jazyk'), 'edit_themes', 'calculator_aj_jezyk_subcat_menu', 'calculator_aj_display_jezyk');
    add_submenu_page('calculator_aj_settings', __('Nastavenia'), __('Nastavenia'), 'edit_themes', 'calculator_aj_ustawienia_subcat_menu', 'calculator_aj_display_settings');
}

add_action('admin_menu', 'add_to_menu_hc');

// ladowanie modeli

// $urlPluginu = plugins_url().'/kalkulator_hc/';
// $plugins_dir = str_replace( 'https://plastmaker.pl', '', $urlPluginu );
// define( 'KHC_PATH', $plugins_dir );


// $plugins_dir = str_replace( 'https://plastmaker.pl', '', $urlPluginu );
// najlepsze
// $plugins_dir = str_replace( ABSPATH, '', plugin_dir_path( __FILE__ ));
// define( 'KHC_PATH', '../'.$plugins_dir );
//

// define( 'KHC_PATH', '/wp-content/plugins/kalkulator_hc/' );
// define( 'KHC_PATH', plugin_dir_url( __FILE__ ) );
// define( 'KHC_PATH', '../wp-content/plugins/kalkulator_hc/');
define( 'KHC_PATH', plugin_dir_path( __FILE__ ) );
define( 'KHC_PATH2', '/wp-content/plugins/calculator_aj/' );

include(KHC_PATH.'model/language.php');
include(KHC_PATH.'model/settings.php');
include(KHC_PATH.'model/material.php');
include(KHC_PATH.'model/profil.php');
include(KHC_PATH.'model/zamowienia.php');
define( 'KHC_PATH_JQUERY', KHC_PATH.'js/jquery.min.js' );
define( 'KHC_PATH_JQUERY2', KHC_PATH2.'js/jquery.min.js' );
// require BOOTSTRAP_CSS_PATH.'css/bootstrap.min.css';

function calculator_aj_display_main(){
    // tutaj to co w menu głównym
    $bootstrap_path = KHC_PATH2.'css/bootstrap-grid.min.css';
    $css_front_patch = KHC_PATH2.'css/khc.css';


    ?>

    <link rel="stylesheet" href="<?php echo $bootstrap_path ;?>">
    <link rel="stylesheet" href="<?php echo $css_front_patch ;?>">
    <script src="<?php echo KHC_PATH_JQUERY2;?>"></script>
    <div class="container khc-container khc-containerMain">
        <h3 class="khc_title">Konfigurátor profilov</h3>
        <div class="row singleMenuOptionBox">
          <div class="col-md-6 singleMenuOption"><a href="/wp-admin/admin.php?page=calculator_aj_zamowienia_subcat_menu">Objednávky</a></div>
          <div class="col-md-6 singleMenuOption"><a href="/wp-admin/admin.php?page=calculator_aj_profil_subcat_menu">Profily</a></div>
          <!-- <div class="col-md-6 singleMenuOption"><a href="/wp-admin/admin.php?page=calculator_aj_kolor_subcat_menu">Farby štandardné</a></div>
          <div class="col-md-6 singleMenuOption"><a href="/wp-admin/admin.php?page=calculator_aj_kolor_subcat_menu">Farby špeciálne - xxx</a></div>
          <div class="col-md-6 singleMenuOption"><a href="/wp-admin/admin.php?page=calculator_aj_material_subcat_menu">Vzor dreva</a></div>
          <div class="col-md-6 singleMenuOption"><a href="/wp-admin/admin.php?page=calculator_aj_wykonczenie_subcat_menu">Hrany</a></div> -->
          <div class="col-md-6 singleMenuOption"><a href="/wp-admin/admin.php?page=calculator_aj_jezyk_subcat_menu">Jazyk</a></div>
          <div class="col-md-6 singleMenuOption"><a href="/wp-admin/admin.php?page=calculator_aj_ustawienia_subcat_menu">Nastavenia</a></div>
        </div>
    </div>

<?php

}
/////////////////////////////////////////  kontroller kolorow
function calculator_aj_display_profil(){
    // require_once 'includes/controllerColor.php';
    require_once 'includes/controllerProfil.php';

}
/////////////////////////////////////////  kontroller kolorow
function calculator_aj_display_kolor(){
  require_once 'includes/controllerColor.php';
}
// -------------------------------------------------------------------------------------------------------- Doplnene 2. 10. 2023
function calculator_aj_display_endings(){
    require_once 'includes/controllerEndings.php';
  }
// -------------------------------------------------------------------------------------------------------- Doplnene 18. 8. 2023
function calculator_aj_display_kolor_individual(){
  require_once 'includes/controllerColorIndividual.php';
}
// -------------------------------------------------------------------------------------------------------- Doplnene 18. 8. 2023
function calculator_aj_display_accessories(){
  require_once 'includes/controllerAccessories.php';
}
// -------------------------------------------------------------------------------------------------------- Doplnene 18. 8. 2023
function calculator_aj_display_joints(){
  require_once 'includes/controllerJoints.php';
}

/////////////////////////////////////////  kontroller materiałów
function calculator_aj_display_material(){
  require_once 'includes/controllerMaterial.php';
}
/////////////////////////////////////////  kontroller wykończenia
function calculator_aj_display_wykonczenie(){
    require_once 'includes/controllerWykonczenie.php';

}
/////////////////////////////////////////  kontroller kształtów profilów
function calculator_aj_display_ksztaltProfilu(){
    require_once 'includes/controllerKsztaltProfilu.php';

}
/////////////////////////////////////////  kontroller Zamowien
function calculator_aj_display_orders(){
    require_once 'includes/controllerOrder.php';

}
/////////////////////////////////////////  kontroller Ustawien
function calculator_aj_display_settings(){
    require_once 'includes/controllerSetting.php';

}
/////////////////////////////////////////  kontroller Ustawien
function calculator_aj_display_jezyk(){
    require_once 'includes/controllerLanguage.php';

}
///////////////////////////////////////////// WYŚWIETLA LISTĘ WSZYSTKICH KOLORÓW
function khc_showAllColor(){
        $material = new kalkulatorHcMaterial();

        $khcAllColors = $material->getAllKolor();


        ?>
        <table class="table">
    <thead>
        <tr>
        <th scope="col">#</th>
        <th scope="col">Foto</th>
        <th scope="col">Názov</th>
        <th scope="col"></th>
        </tr>
    </thead>
    <tbody>
        <?php
         $i = 1;
        foreach($khcAllColors as $color){
            $query_args = array( 'page' => 'calculator_aj_kolor_subcat_menu', 'do' => 'edit','id'=>$color['id'] );

           ?>
                <tr>
                <th scope="row"><?php echo $i;?></th>
                <td style="width:20%"><img src="<?php echo KHC_PATH2.'uploads/'.$color['image']; ?>" class="img-fluid" alt=""></td>
                <td><?php echo $color['tytul'];?></td>
                <td><a class="btn btn-secondary" href="<?php echo add_query_arg( $query_args, admin_url( 'admin.php' ) );?>">Upraviť</a></td>
                </tr>
            <?php
            $i++;
        }
        ?>

    </tbody>
    </table>

        <?php

}

// -------------------------------------------------------------------------------------------------------- Doplnene 2. 10. 2023
function khc_showAllEndings(){
    $material = new kalkulatorHcMaterial();

    $khcEndings = $material->getAllEndings();


    ?>
    <table class="table">
<thead>
    <tr>
    <th scope="col">#</th>
    <th scope="col">Foto</th>
    <th scope="col">Názov</th>
    <th scope="col"></th>
    </tr>
</thead>
<tbody>
    <?php
     $i = 1;
    foreach($khcEndings as $Ending){
        $query_args = array( 'page' => 'calculator_aj_endings_subcat_menu', 'do' => 'edit','id'=>$Ending['id'] );

       ?>
            <tr>
            <th scope="row"><?php echo $i;?></th>
            <td style="width:20%"><img src="<?php echo KHC_PATH2.'uploads/'.$Ending['image']; ?>" class="img-fluid" alt=""></td>
            <td><?php echo $Ending['tytul'];?></td>
            <td><a class="btn btn-secondary" href="<?php echo add_query_arg( $query_args, admin_url( 'admin.php' ) );?>">Upraviť</a></td>
            </tr>
        <?php
        $i++;
    }
    ?>

</tbody>
</table>

    <?php

}
// -------------------------------------------------------------------------------------------------------- Doplnene 18. 8. 2023
function khc_showAllColorIndividual(){
    $material = new kalkulatorHcMaterial();

    $khcAllColors = $material->getAllColorIndividual();


    ?>
    <table class="table">
<thead>
    <tr>
    <th scope="col">#</th>
    <th scope="col">Foto</th>
    <th scope="col">Názov</th>
    <th scope="col"></th>
    </tr>
</thead>
<tbody>
    <?php
     $i = 1;
    foreach($khcAllColors as $color){
        $query_args = array( 'page' => 'calculator_aj_kolor_individual_subcat_menu', 'do' => 'edit','id'=>$color['id'] );

       ?>
            <tr>
            <th scope="row"><?php echo $i;?></th>
            <td style="width:20%"><img src="<?php echo KHC_PATH2.'uploads/'.$color['image']; ?>" class="img-fluid" alt=""></td>
            <td><?php echo $color['tytul'];?></td>
            <td><a class="btn btn-secondary" href="<?php echo add_query_arg( $query_args, admin_url( 'admin.php' ) );?>">Upraviť</a></td>
            </tr>
        <?php
        $i++;
    }
    ?>

</tbody>
</table>

    <?php

}
// -------------------------------------------------------------------------------------------------------- Doplnene 18. 8. 2023
function khc_showAllJoints(){
    $material = new kalkulatorHcMaterial();

    $khcAllColors = $material->getAllJoints();


    ?>
    <table class="table">
<thead>
    <tr>
    <th scope="col">#</th>
    <th scope="col">Foto</th>
    <th scope="col">Názov</th>
    <th scope="col"></th>
    </tr>
</thead>
<tbody>
    <?php
     $i = 1;
    foreach($khcAllColors as $color){
        $query_args = array( 'page' => 'calculator_aj_joints_subcat_menu', 'do' => 'edit','id'=>$color['id'] );

       ?>
            <tr>
            <th scope="row"><?php echo $i;?></th>
            <td style="width:20%"><img src="<?php echo KHC_PATH2.'uploads/'.$color['image']; ?>" class="img-fluid" alt=""></td>
            <td><?php echo $color['tytul'];?></td>
            <td><a class="btn btn-secondary" href="<?php echo add_query_arg( $query_args, admin_url( 'admin.php' ) );?>">Upraviť</a></td>
            </tr>
        <?php
        $i++;
    }
    ?>

</tbody>
</table>

    <?php

}
// -------------------------------------------------------------------------------------------------------- Doplnene 18. 8. 2023
function khc_showAllAccessories(){
    $material = new kalkulatorHcMaterial();

    $khcAllColors = $material->getAllAccessories();


    ?>
    <table class="table">
<thead>
    <tr>
    <th scope="col">#</th>
    <th scope="col">Foto</th>
    <th scope="col">Názov</th>
    <th scope="col"></th>
    </tr>
</thead>
<tbody>
    <?php
     $i = 1;
    foreach($khcAllColors as $color){
        $query_args = array( 'page' => 'calculator_aj_accessories_subcat_menu', 'do' => 'edit','id'=>$color['id'] );

       ?>
            <tr>
            <th scope="row"><?php echo $i;?></th>
            <td style="width:20%"><img src="<?php echo KHC_PATH2.'uploads/'.$color['image']; ?>" class="img-fluid" alt=""></td>
            <td><?php echo $color['tytul'];?></td>
            <td><a class="btn btn-secondary" href="<?php echo add_query_arg( $query_args, admin_url( 'admin.php' ) );?>">Upraviť</a></td>
            </tr>
        <?php
        $i++;
    }
    ?>

</tbody>
</table>

    <?php

}

//////////////////////// Wyświetla liste materiałów
function khc_showAllMaterial(){
    $material = new kalkulatorHcMaterial();

    $khcAllMaterials = $material->getAllMaterial();


    ?>
    <table class="table">
<thead>
    <tr>
    <th scope="col">#</th>
    <th scope="col">Foto</th>
    <th scope="col">Názov</th>
    <th scope="col"></th>

    </tr>
</thead>
<tbody>
    <?php
     $i = 1;
    foreach($khcAllMaterials as $material){
        $query_args = array( 'page' => 'calculator_aj_material_subcat_menu', 'do' => 'edit','id'=>$material['id'] );

       ?>
            <tr>
            <th scope="row"><?php echo $i;?></th>
            <td style="width:20%"><img src="<?php echo KHC_PATH2.'uploads/'.$material['image']; ?>" class="img-fluid" alt=""></td>
            <td><?php echo $material['tytul'];?></td>
            <td><a class="btn btn-secondary" href="<?php echo add_query_arg( $query_args, admin_url( 'admin.php' ) );?>">Upraviť</a></td>
            </tr>
        <?php
        $i++;
    }
    ?>

</tbody>
</table>

    <?php

}
////////// koniec wyświetlania materiałów

//////////////////////// Wyświetla liste wykończeń
function khc_showAllWykonczenie(){
    $material = new kalkulatorHcMaterial();

    $khcAllWykonczenie = $material->getAllWykonczenie();


    ?>
    <table class="table">
<thead>
    <tr>
    <th scope="col">#</th>
    <th scope="col">Foto</th>
    <th scope="col">Názov</th>
    <th scope="col"></th>

    </tr>
</thead>
<tbody>
    <?php
     $i = 1;
    foreach($khcAllWykonczenie as $wykonczenie){
        $query_args = array( 'page' => 'calculator_aj_wykonczenie_subcat_menu', 'do' => 'edit','id'=>$wykonczenie['id'] );

       ?>
            <tr>
            <th scope="row"><?php echo $i;?></th>
            <td style="width:20%"><img src="<?php echo KHC_PATH2.'uploads/'.$wykonczenie['image']; ?>" class="img-fluid" alt=""></td>
            <td><?php echo $wykonczenie['tytul'];?><br><span class="addationalTitle"><?php echo $wykonczenie['uniqueText'];?></span></td>
            <td><a class="btn btn-secondary" href="<?php echo add_query_arg( $query_args, admin_url( 'admin.php' ) );?>">Upraviť</a></td>
            </tr>
        <?php
        $i++;
    }
    ?>

</tbody>
</table>

    <?php

}

////////////////////// Wyświetla liste wykończeń
function khc_showAllksztaltProfilu(){
    $material = new kalkulatorHcMaterial();

    $khcAllksztaltProfilu = $material->getAllksztaltProfiluAll();


    ?>
    <table class="table">
    <thead>
        <tr>
        <th scope="col">#</th>
        <th scope="col">Foto</th>
        <th scope="col">Názov</th>
        <th scope="col"></th>

        </tr>
    </thead>
<tbody>
    <?php
     $i = 1;
    foreach($khcAllksztaltProfilu as $ksztaltProfilu){
        $query_args = array( 'page' => 'calculator_aj_ksztaltProfilu_subcat_menu', 'do' => 'edit','id'=>$ksztaltProfilu['id'] );

       ?>
            <tr>
            <th scope="row"><?php echo $i;?></th>
            <td style="width:20%"><img src="<?php echo KHC_PATH2.'uploads/'.$ksztaltProfilu['image']; ?>" class="img-fluid" alt=""></td>
            <td><?php echo $ksztaltProfilu['tytul'];?></td>
            <td><a class="btn btn-secondary" href="<?php echo add_query_arg( $query_args, admin_url( 'admin.php' ) );?>">Upraviť</a></td>
            </tr>
        <?php
        $i++;
    }
    ?>

</tbody>
</table>

    <?php

}

////////// koniec wyświetlania materiałów
function khc_ColorEdit($id){
    require_once 'includes/editColor.php';
}

function khc_colorAdd(){

    require_once 'includes/addColor.php';

}
// -------------------------------------------------------------------------------------------------------- Doplnene 2. 10. 2023
function khc_EndingsEdit($id){
  require_once 'includes/editEndings.php';
}
// -------------------------------------------------------------------------------------------------------- Doplnene 2. 10. 2023
function khc_EndingsAdd(){
  require_once 'includes/addEndings.php';
}
// -------------------------------------------------------------------------------------------------------- Doplnene 18. 8. 2023
function khc_KolorIndividualEdit($id){
  require_once 'includes/editKolorIndividual.php';
}
// -------------------------------------------------------------------------------------------------------- Doplnene 18. 8. 2023
function khc_KolorIndividualAdd(){
  require_once 'includes/addKolorIndividual.php';
}
// -------------------------------------------------------------------------------------------------------- Doplnene 18. 8. 2023
function khc_JointsEdit($id){
  require_once 'includes/editJoints.php';
}
// -------------------------------------------------------------------------------------------------------- Doplnene 18. 8. 2023
function khc_JointsAdd(){
  require_once 'includes/addJoints.php';
}
// -------------------------------------------------------------------------------------------------------- Doplnene 18. 8. 2023
function khc_AccessoriesEdit($id){
  require_once 'includes/editAccessories.php';
}
// -------------------------------------------------------------------------------------------------------- Doplnene 18. 8. 2023
function khc_AccessoriesAdd(){
  require_once 'includes/addAccessories.php';
}

function khc_materialEdit($id){
    require_once 'includes/editMaterial.php';
}

function khc_materialAdd(){

    require_once 'includes/addMaterial.php';

}

function khc_wykonczenieEdit($id){
    require_once 'includes/editWykonczenie.php';
}

function khc_wykonczenieAdd(){

    require_once 'includes/addWykonczenie.php';

}

function khc_ksztaltProfiluEdit($id){
    require_once 'includes/editKsztaltProfilu.php';
}

function removeMaterial($id,$return){

    $material = new kalkulatorHcMaterial();
    return $material->remove($id,$return);

}

//////////////////Profile

function khc_showAllProfile(){
    // Jeden Profil
    $profile = new kalkulatorHcProfil();

    $khcAllProfile = $profile->getAllProfil();

    ?>

    <?php
     $i = 1;
    foreach($khcAllProfile  as $profil){
        $KonfigurujGet = array( 'page' => 'calculator_aj_profil_subcat_menu', 'do' => 'konfiguruj', 'id' => $profil['id']);
        // var_dump($profil);
       $roboczyProfil = $profil['roboczy'];
       if($roboczyProfil == 0){
           $roboczyTekst = '<span style="color:lightgray"> Pracovná verzia </span>';
       }else{
           $roboczyTekst = "";
       }
       ?>


       <div class="row mt-3 single-profile-list-backend">
       <a href="<?php echo add_query_arg( $KonfigurujGet, admin_url( 'admin.php' ) );?>">
           <div class="col-12">
               <div class="row">
                   <div class="col-lg-7 text-back-profile-panel-col"><h3><?php echo $profil['tytul'];?> <?php echo $roboczyTekst;?></h3><p><?php echo $profil['opis'];?></p></div>
                   <div class="col-lg-5 img-back-profile-panel-col"><img class="img-back-profile-panel" src="<?php echo KHC_PATH2 . 'uploads/' . $profil['image']; ?>" alt=""></div>
               </div>
           </div>
           </a>
       </div>

        <?php
        $i++;
    }


    }


// frontend
function calc_aj_shortcode( $atts, $content = null ) {
    $bootstrap_path = KHC_PATH2.'css/bootstrap-grid.min.css';
    $css_front_patch = KHC_PATH2.'css/khc-front.css?random=' . rand();
    $css_lightbox_path = KHC_PATH2.'css/lightbox.min.css';
    $js_lightbox_path = KHC_PATH2.'js/lightbox.min.js';

    $a = shortcode_atts( array(
        'class' => 'button',
        'href'  =>  '#',
        'text' => '',
    ), $atts );

    echo '<div class="container khc-container">';

    ?>
    <link rel="stylesheet" href="<?php echo $bootstrap_path ;?>">
    <link rel="stylesheet" href="<?php echo $css_front_patch ;?>">
    <script src="<?php echo KHC_PATH_JQUERY2;?>"></script>
    <?php
    require_once 'includes/frontController.php';
    echo '</div>';
    ?>
    
    <?php

    // return '<a class="' . esc_attr($a['class']) . '" href="' . esc_attr($a['href']) . '">' . $a['text'] . '</a>';
}
add_shortcode( 'calc_aj_display', 'calc_aj_shortcode' );


?>
