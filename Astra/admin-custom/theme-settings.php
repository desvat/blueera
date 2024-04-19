<h1>AMCEF Theme Settings</h1>

<?php
  // Overenie, či bol formulár odoslaný
  if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['submit-social-links'])) {
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

    // Zobrazenie správy o úspešnom uložení
    echo '<div class="success-message">Hodnoty boli úspešne uložené.</div>';
  }

  // Overenie, či bol formulár odoslaný
  if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['submit-copyright'])) {
    // Získanie hodnôt z formulára
    $text = $_POST['name-text'];
    $url = $_POST['name-url'];
    $title = $_POST['name-title'];

    // Aktualizácia hodnôt v databáze
    update_option('copyright-text', sanitize_text_field($text));
    update_option('copyright-url', sanitize_text_field($url));
    update_option('copyright-title', sanitize_text_field($title));

    // Zobrazenie správy o úspešnom uložení
    echo '<div class="success-message">Hodnoty boli úspešne uložené.</div>';
  }

?>

<div class="wrap">
  <div class="success-message">msg</div>
</div>

<div class="wrap">
  <h2>Nastavenia</h2>

  <h2 class="nav-tab-wrapper">
    <a href="#soc-networks" class="nav-tab nav-tab-active">Sociálne siete</a>
    <a href="#copyright" class="nav-tab">Copyright</a>
  </h2>

  <div id="soc-networks" class="form-tab">

    <div class="tab-inner">
      <div class="tab-inner-row">

        <h3>Odkazy na sociálne siete</h3>

        <form id="form-soc-networks" method="post" action="" class="default">
          
          <label for="label-facebook">Facebook<span>.com:</span></label>
          <input type="text" id="label-facebook" name="link-facebook" class="input-max-width-400" placeholder="www.facebook.com/profileID" value="<?php echo esc_attr(get_option('facebook')); ?>">
          
          <label for="label-instagram">Instagram<span>.com:</span></label>
          <input type="text" id="label-instagram" name="link-instagram" class="input-max-width-400" placeholder="www.instagram.com/profileID" value="<?php echo esc_attr(get_option('instagram')); ?>">
          
          <label for="label-linkedin">LinkedIn<span>.com:</span></label>
          <input type="text" id="label-linkedin" name="link-linkedin" class="input-max-width-400" placeholder="www.linkedin.com/profileID" value="<?php echo esc_attr(get_option('linkedin')); ?>">
          
          <label for="label-x">X<span>.com:</span></label>
          <input type="text" id="label-x" name="link-x" class="input-max-width-400" placeholder="www.x.com/profileID" value="<?php echo esc_attr(get_option('x')); ?>">

          <div class="save-button">
            <input type="submit" name="submit-social-links" value="Uložiť" class="transition-all">
          </div>

        </form>

      </div>
    </div>

  </div>

  <div id="copyright" class="form-tab" style="display:none;">

    <div class="tab-inner">
      <div class="tab-inner-row">

        <h3>Autor</h3>

          <form id="form-copyright" method="post" action="" class="default">
            
            <label for="label-text">Text</label>
            <input type="text" id="label-text" name="name-text" class="input-max-width-400" value="<?php echo esc_attr(get_option('copyright-text')); ?>">
            
            <label for="label-url">URL</label>
            <input type="text" id="label-url" name="name-url" placeholder="www.yourdomain.sk" class="input-max-width-400" value="<?php echo esc_attr(get_option('copyright-url')); ?>">
            
            <label for="label-title">Title</label>
            <input type="text" id="label-title" name="name-title" class="input-max-width-400" value="<?php echo esc_attr(get_option('copyright-title')); ?>">
            
            <div class="save-button">
              <input type="submit" name="submit-copyright" value="Uložiť" class="transition-all">
            </div>

          </form>

      </div>
    </div>

  </div>

</div>

<!-- Save data congroller -->
<script>
  document.addEventListener("DOMContentLoaded", function() {
    // Získanie všetkých formulárov
    var forms = document.querySelectorAll('.default');
    var successMessage = document.querySelector('.success-message');

    // Prechádzanie všetkých formulárov
    forms.forEach(function(form) {
        form.addEventListener('submit', function(e) {
            e.preventDefault(); // Zastavenie štandardnej akcie formulára

            var formData = new FormData(form); // Získanie dát formulára

            // Pridanie identifikátora formulára do dát pre identifikáciu
            formData.append('formId', form.id);

            var xhr = new XMLHttpRequest(); // Vytvorenie XMLHttpRequest objektu

            xhr.open('POST', '<?php echo get_template_directory_uri() . '/admin-custom/'; ?>save_settings.php', true); // Nastavenie typu požiadavky a adresy skriptu
            xhr.setRequestHeader('Content-type', 'application/x-www-form-urlencoded'); // Nastavenie hlavičky Content-Type

            // Spracovanie odpovede zo servera
            xhr.onload = function() {
                if (xhr.status >= 200 && xhr.status < 300) {
                    var response = JSON.parse(xhr.responseText);
                    if (response.status === 'success') {
                      successMessage.innerHTML = response.message;
                      successMessage.style.opacity = 1;
                    } else {
                      successMessage.innerHTML = response.message;
                      successMessage.style.opacity = 1;
                    }
                } else {
                  console.error("Chyba pri požiadavke: " + xhr.status); // Vypíš chybu pri neúspechu požiadavky
                }
            };

            // Spracovanie chyby pri komunikácii so serverom
            xhr.onerror = function() {
                console.error("Nastala chyba pri komunikácii so serverom."); // Vypíš chybu pri komunikácii so serverom
            };

            // Odoslanie dát formulára na server
            xhr.send(new URLSearchParams(formData));
        });
    });
  });
</script>

<!-- Tabs congroller -->
<script>
document.addEventListener("DOMContentLoaded", function() {
  // Získanie všetkých navigačných kariet
  var tabs = document.querySelectorAll('.nav-tab-wrapper a');

  // Pre každú navigačnú kartu pridajte poslucháč udalostí
  tabs.forEach(function(tab) {
    tab.addEventListener('click', function(e) {
      e.preventDefault(); // Zastavenie štandardnej akcie pre link

      // Zrušenie triedy nav-tab-active pre všetky navigačné karty
      tabs.forEach(function(t) {
        t.classList.remove('nav-tab-active');
      });

      // Pridanie triedy nav-tab-active pre kliknutú navigačnú kartu
      tab.classList.add('nav-tab-active');

      // Získanie identifikátora cieľovej sekcie z atribútu href navigačnej karty
      var target = tab.getAttribute('href');

      // Skrytie všetkých sekcií formulára
      document.querySelectorAll('.form-tab').forEach(function(section) {
        section.style.display = 'none';
      });

      // Zobrazenie cieľovej sekcie
      document.querySelector(target).style.display = 'block';
    });
  });
});
</script>