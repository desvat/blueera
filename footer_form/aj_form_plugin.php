<?php
/*
Plugin Name: AJ Form Plugin
Description: Plugin pre formulár s shortcode [aj_form_footer].
Version: 1.0
Author: Adrián Jakubča
Author URI: https://www.jakubca.com/
*/

define( 'AJ_PATH_FILE', '/wp-content/plugins/footer_form/' );

// Funkcia pre obsah shortcode [aj_form_footer]
function aj_form_footer_content($atts) {

    echo '<link rel="stylesheet" href="' . esc_url(AJ_PATH_FILE.'css/form-plugin.css?id=') . '">';

    require_once 'includes/front-controller.php';

    echo '<script src="' . esc_url(AJ_PATH_FILE.'js/form-plugin.js?id=1') . '"></script>';

}

// Pridanie shortcode [aj_form_footer]
add_shortcode('aj_form_footer', 'aj_form_footer_content');
?>
