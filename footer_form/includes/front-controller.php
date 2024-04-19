<div class="custom-footer-wrapper">
  <div class="custom-footer-left">
    <div class="custom-footer-left-row">
      <img src="./../wp-content/uploads/2024/01/Tramy-sk-LOGO-WHITE.svg">
    </div>
    <div class="custom-footer-left-row">
      <h4>ADRESA</h4>
      <span>PLASTMAKER SLOVAKIA</span>
      <a href="https://www.google.com/maps/place/Hokovce+87,+935+84+Hokovce/data=!4m2!3m1!1s0x476ac079ee4843e5:0x7970f0dff6249d87?sa=X&ved=2ahUKEwiU9YKMs_aCAxWMhf0HHUGZBtIQ8gF6BAgWEAA"
        title="Zobraziť na mape" target="_blank" class="tag-show-map">Hokovce 87<br>935 84 Hokovce</a>
    </div>
    <div class="custom-footer-left-row">
      <h4>KONTAKTY</h4>
      <a href="mailto:info@tramy.sk" title="Napíšte nám email" class="tag-send-mail">info@tramy.sk</a>
      <a href="tel:+421 904 471 812" title="Zavolajte nám" class="tag-call-us">+421 904 471 812</a>
      <a href="whatsapp://send?phone=+421908526032" title="Napíšte nám cez whatsapp" class="tag-write-us">Whatsapp
        správa</a>
    </div>
  </div>
  <div class="custom-footer-right">
    <div class="custom-footer-right-map">

      <div class="kontakt-map-img">
        <img src="./../wp-content/plugins/footer_form/images/kontakt-mapa.png">
      </div>

      <div class="kontakt-map-area">
        <a href="https://www.google.com/maps/place/Hokovce+87,+935+84+Hokovce/data=!4m2!3m1!1s0x476ac079ee4843e5:0x7970f0dff6249d87?sa=X&ved=2ahUKEwiU9YKMs_aCAxWMhf0HHUGZBtIQ8gF6BAgWEAA"
          title="Zobraziť na mape" target="_blank" class="tag-show-map">Kde nás nájdete</a>
        <svg>
          <circle class="circle circle-3" cx="50%" cy="50%" r="12px"></circle>
          <circle class="circle circle-4" cx="50%" cy="50%" r="12px"></circle>
          <circle class="circle circle-center" cx="50%" cy="50%" r="12px"></circle>
        </svg>
      </div>

    </div>

    <style>
      .custom-footer-right-form {
        position: relative;
      }

      .form-row.row-email,
      .form-row.row-textarea,
      .form-row.row-button {
        opacity: 1;
        z-index: 11;
      }

      .custom-footer-right-form-hlaska {
        position: absolute;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        opacity: 0;
        background-color: white;
        z-index: 1;
        display: flex;
        justify-content: center;
        align-items: center;
      }
    </style>

    <div class="custom-footer-right-form">
      <div class="custom-footer-right-form-hlaska">
        Ďakujeme za Vašu správu.
      </div>
      <div class="form-row row-email">
        <label>E-mail:</label>
        <input name="f-f-email" id="f-f-email" type="text">
      </div>
      <div class="form-row row-textarea">
        <label>Správa:</label>
        <textarea name="f-f-text" id="f-f-message" row="5"></textarea>
      </div>
      <div class="form-row row-button">
        <button class="btn-send-form" id="f-f-sendButton">Odoslať</button>
      </div>
    </div>
    <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
    <script>
      $(document).ready(function () {
        $('.btn-send-form').click(function () {

          var email = $('#f-f-email').val();
          var message = $('#f-f-message').val();
          var url = '<?php echo site_url() . '/wp-content/plugins/footer_form/includes/send_email.php'; ?>';

          // Kontrola, či je e-mailová adresa platná
          if (!isValidEmail(email)) {
            alert("Neplatná e-mailová adresa.");
          } else if (message.trim() === "") {  // Kontrola, či je textové pole prázdné
            alert("Textové pole správy nemôže byť prázdne.");
          } else {

            $.ajax({
              type: 'POST',
              url: url,  // Prispôsobte si túto URL adriesu podľa vašich potrieb
              data: {
                email: email,
                message: message
              },
              success: function (response) {
                if (response.message) {
                  // Spracovanie úspešnej odpovede
                  console.log(response.message);
                  $('.form-row.row-email, .form-row.row-textarea, .form-row.row-button').css('opacity', 0.01);
                  $('.custom-footer-right-form-hlaska').css('opacity', 1);

                } else {
                  // Spracovanie chybovej odpovede
                  console.error("Chyba pri odosielaní e-mailu.");
                }
              },
              error: function (error) {
                // Spracovanie chyby v prípade, že server nevrátil správny formát JSON
                console.error("Nastala chyba pri spracovaní odpovede zo servera.");
                //                console.error("Nastala chyba pri spracovaní odpovede zo servera:", error.responseText);
              }
            });

          }

          // Funkcia na kontrolu e-mailovej adresy
          function isValidEmail(email) {
            // Implementujte váš vlastný kód na kontrolu e-mailu
            // Môžete použiť regulárny výraz alebo inú metódu
            // Toto je jednoduchý príklad:
            var emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
            return emailRegex.test(email);
          }

        });
      });
    </script>

  </div>
</div>

<!-- Scroll UP BUTTON -->
<div id="scrollUP" class="scroll-up">
  <button onclick="topFunction()" title="Prejsť na začiatok" style="display: ;">
    <svg version="1.1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px"
      viewBox="0 0 40 40" style="enable-background:new 0 0 40 40;" xml:space="preserve">
      <path class="scroll-up-arrow" d="M25.7,5.7L20,0l-5.7,5.7L15,6.4l4.5-4.5V40h1V1.9L25,6.4L25.7,5.7z" />
    </svg>
  </button>
</div>
<script>
  // Get the button
  var mybutton = document.getElementById("scrollUP");
  // When the user scrolls down 20px from the top of the document, show the button
  window.onscroll = function () { scrollFunction() };

  function scrollFunction() {
    if (document.body.scrollTop > 20 || document.documentElement.scrollTop > 20) {
      // mybutton.style.display = "block";
      mybutton.style.opacity = 1;
    } else {
      // mybutton.style.display = "none";
      mybutton.style.opacity = 0;
    }
  }

  // When the user clicks on the button, scroll to the top of the document
  function topFunction() {
    document.body.scrollTop = 0;
    document.documentElement.scrollTop = 0;
  }
</script>