<?php
/**
 * Astra functions and definitions
 *
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 *
 * @package Astra
 * @since 1.0.0
 */


add_action( 'wp_footer', 'bbloomer_no_ajax_view_cart_button' );
function bbloomer_no_ajax_view_cart_button() {
   wc_enqueue_js( "
      $( document.body ).on('wc_cart_button_updated', function(){
         $('.added_to_cart.wc-forward').html('<span>added to cart</span><span>View Cart</span>');
      });   
      $('.added_to_cart.wc-forward').html('<span>added to cart</span><span>View Cart</span>');
   " );
}

// Enable svg support
function allow_svg_upload( $mime_types ) {
  $mime_types['svg'] = 'image/svg+xml';
  return $mime_types;
}
add_filter( 'upload_mimes', 'allow_svg_upload' );

function add_to_head() {
  ?>
  <link rel="stylesheet" href='<?php echo get_stylesheet_uri(); ?>?xxxv=<?php echo rand(1, 10000); ?>'>
  <?php
}
add_action('wp_head', 'add_to_head');

class Custom_Nav_Walker extends Walker_Nav_Menu {
  function start_el( &$output, $item, $depth = 0, $args = NULL, $id = 0 ) {
      $output .= "\n\t\t\t";
      $output .= '<li class="menu-item' . ( $item->current ? ' current-menu-item' : '' ) . '">';
      $attributes = '';
      $attributes .= ! empty( $item->url ) ? ' href="' . esc_attr( $item->url ) . '"' : '';
      $attributes .= ! empty( $item->target ) ? ' target="' . esc_attr( $item->target ) . '"' : '';
      $attributes .= ! empty( $item->xfn ) ? ' rel="' . esc_attr( $item->xfn ) . '"' : '';
      $attributes .= ! empty( $item->description ) ? ' title="' . esc_attr( $item->description ) . '"' : '';
      $attributes .= ' class="menu-item' . ( $item->current ? ' current-menu-item' : '' ) . '"';
      $attributes .= '>';
      $item_output = $args->before;
      $item_output = "\n\t\t\t\t";
      $item_output .= '<a' . $attributes;
      $item_output .= $args->link_before . apply_filters( 'the_title', $item->title, $item->ID ) . $args->link_after;
      $item_output .= '</a>';
      $item_output .= $args->after;
      $output .= apply_filters( 'walker_nav_menu_start_el', $item_output, $item, $depth, $args );
      $output .= "\n\t\t\t";
  }
}

// Admin
function add_custom_admin_styles() {
  wp_enqueue_style( 'custom-admin-styles', get_template_directory_uri() . '/admin-custom/css/custom-admin-styles.css?vvv=' . rand() ); // Upravte cestu k súboru podľa svojich potrieb
}
add_action( 'admin_enqueue_scripts', 'add_custom_admin_styles' );

/* Customize the admin menu */
function my_admin_menu() {
  add_menu_page(
      'AMCEF Theme', // Názov stránky v menu
      'AMCEF Theme', // Text v hlavičke stránky
      'manage_options', // Oprávnenia pre zobrazenie stránky
      'amcef-theme-settings', // Slug stránky
      'my_amcef_theme_settings_page', // Funkcia pre obsah stránky
      get_template_directory_uri() . '/admin-custom/img/admin-nav-custom-icon.svg', // URL vlastnej SVG ikony
      1
  );
}
add_action( 'admin_menu','my_admin_menu' );

function my_amcef_theme_settings_page() {
  include_once( 'admin-custom/theme-settings.php' );
}