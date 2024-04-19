<?php

$parse_uri = explode( 'wp-content', $_SERVER['SCRIPT_FILENAME'] );
require( $parse_uri[0] . 'wp-load.php' );

// Overenie, či bola formulár odoslaný cez AJAX
if (isset($_POST['formId'])) {
  // Identifikácia odoslaného formulára
  $formId = $_POST['formId'];

  // Podľa identifikátora formulára vykonávanie príslušného kódu
  if ($formId === 'form-soc-networks') {

    // Získanie hodnôt z formulára
    $facebook = $_POST['link-facebook'];
    $instagram = $_POST['link-instagram'];
    $linkedin = $_POST['link-linkedin'];
    $x = $_POST['link-x'];

    // Aktualizácia hodnôt v databáze
    update_option('facebook', sanitize_text_field($facebook));
    update_option('instagram', sanitize_text_field($instagram));
    update_option('linkedin', sanitize_text_field($linkedin));
    update_option('x', sanitize_text_field($x));

    echo json_encode(array('status' => 'success', 'message' => 'Nastavenia sociálnych sietí boli úspešne uložené.'));

  } elseif ($formId === 'form-copyright') {
    
    $text = $_POST['name-text'];
    $url = $_POST['name-url'];
    $title = $_POST['name-title'];

    // Aktualizácia hodnôt v databáze
    update_option('copyright-text', sanitize_text_field($text));
    update_option('copyright-url', sanitize_text_field($url));
    update_option('copyright-title', sanitize_text_field($title));

    echo json_encode(array('status' => 'success', 'message' => 'Nastavenie copyright inforácií bolo úspešne uložené.'));

  } else {
      // Neznámy formulár
      echo json_encode(array('status' => 'error', 'message' => 'Neznámy formulár.'));
  }
} else {
  // Odpoveď pre JavaScript v prípade neúspechu
  echo json_encode(array('status' => 'error', 'message' => 'Chyba pri spracovaní požiadavky.'));
}
  
?>
