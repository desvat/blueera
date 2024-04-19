<?php
  $lang = new kalkulatorHcLanguage;
  $material = new kalkulatorHcMaterial();
  $zamowienia = new kalkulatorHcZamowienia;
  $przypisaneAccessories = $material->getAllDoplnky("kolorAkcesoria");
  $przypisaneJoints = $material->getAllJointsSingle("joints");
  $przypisaneKonzoly = $material->getAllKonzoly("konzoly");
  $przypisaneKolory = $material->getAllMatKolWyk($idProfilu, $idKsztaltuProfilu, "kolor");

  if (isset($_POST['submit'])) {
    $produkt = [
      'ksztalt' => 'doplnky',
      'slugKsztaltu' => $_POST['submit'],
      'idKsztaltu' => $idKsztaltuProfilu,
      'idProfilu' => $idProfilu,
      'request' => $_REQUEST,
    ];
    $zamowienia->addToCard($produkt);
?>
    <script>
      window.location.href = "https://www.tramy.sk/kosik/?action=koszyk";
    </script>
<?php
  }
?>

  <div class="row-title"><h3>Doplnky</h3></div>
  <div class="row-akcesoria row-akcesoria-margin">
    <?php
      foreach ($przypisaneAccessories as $singleMaterial) {
        if ($singleMaterial['przypisany'] == false) continue;
    ?>
    <form method="POST">
      <div class="box-akcesoria">
        <div class="box-row-img">
          <a href="./../wp-content/plugins/calculator_aj/uploads/<?php echo $singleMaterial['image']; ?>" data-lightbox="<?php echo $singleMaterial['id']; ?>" data-title="<?php echo $singleMaterial['caption']; ?>">
            <img src="./../wp-content/plugins/calculator_aj/uploads/<?php echo $singleMaterial['image']; ?>" alt="">
          </a>
          <div class="box-row-img-price"><?php echo $singleMaterial['units'] . " / " . $singleMaterial['price']; ?> €</div>
        </div>
        <div class="box-row-title">
          <h4><?php echo $singleMaterial['tytul']; ?></h4>
        </div>

        <div class="box-row-count">

          <div class="box-row-count-input">
            <input type="number" name="doplnok-count" class="" value="1">
            <input type="number" name="doplnok-id" style="display: none;" value="<?php echo $singleMaterial['id']; ?>">

            <input type="hidden" name="doplnok-title" value="<?php echo $singleMaterial['tytul'] . ' ' . $singleMaterial['units']; ?>">



            <input type="number" name="doplnok-price" style="display: none;" value="<?php echo $singleMaterial['price']; ?>">
          </div>

          <div class="box-row-count-buttons">
            <div class="button-plus">+</div>
            <div class="button-minus">-</div>
          </div>

          <div class="box-row-button">
            <button name="submit" value="doplnky" class="tag-add-to-card-accessories"><?php echo $lang->getLanguage('dodajDoKoszyka','Add');?></button>
          </div>

        </div>
      </div>
    </form>
    <?php 
      } 
    ?>
  </div>
  <script>
    $(document).ready(function(){
        $(".button-plus").click(function(){
            var inputElement = $(this).closest('.box-row-count').find('input[name="doplnok-count"]');
            var currentValue = parseInt(inputElement.val());
            if(currentValue < 10) {
                inputElement.val(currentValue + 1);
            }
        });

        $(".button-minus").click(function(){
            var inputElement = $(this).closest('.box-row-count').find('input[name="doplnok-count"]');
            var currentValue = parseInt(inputElement.val());
            if(currentValue > 1) {
                inputElement.val(currentValue - 1);
            }
        });
    });
  </script>

  <div class="row-title"><h3>Konzoly</h3></div>
  <div class="row-akcesoria row-akcesoria-margin">
    <?php
      foreach ($przypisaneKonzoly as $singleMaterial) {
    ?>
    <form method="POST" onsubmit="return validateForm(this);">
      <div class="box-akcesoria">

        <div class="box-row-img">
          <a href="./../wp-content/plugins/calculator_aj/uploads/<?php echo $singleMaterial['image']; ?>" data-lightbox="<?php echo $singleMaterial['id']; ?>" data-title="<?php echo $singleMaterial['caption']; ?>">
            <img src="./../wp-content/plugins/calculator_aj/uploads/<?php echo $singleMaterial['image']; ?>" alt="">
          </a>
          <div class="box-row-img-price"><span class="sirka">12</span> cm / <span class="cena">12.00</span> €</div>
        </div>

        <div class="box-row-title">
          <h4><?php echo $singleMaterial['tytul']; ?></h4>
          <input type="hidden" name="konzoly-id" value="<?php echo $singleMaterial['id']; ?>">
          <input type="hidden" name="konzoly-title" value="<?php echo $singleMaterial['tytul']; ?>">
        </div>

        <div class="box-row-sirka">

          <div class="box-row-sirka-btns-minus">-</div>
        
          <input type="range" name="konzoly-price" min="12" max="20" value="12" class="slider-doplnky">

          <div class="box-row-sirka-btns-plus">+</div>

        </div>

        <div class="box-row-farba">
          <div class="box-row-farba-checkbox" id="vyberteFarbu">

            <input type="checkbox" name="konzoly-color" value="" style="display: none;">

            <div class="farba-button">
              <div class="farba-option-img-none">
                <img src="<?php echo KHC_PATH2 . 'uploads/thumbs/none-products.jpg' ?>">
              </div>
              <label>Vyberte farbu</label>
            </div>

            <div class="farba-dropdown">
              <div class="farba-dropdown-wrapper">
                <?php foreach ($przypisaneKolory as $singleMaterial) { ?>
                  <div class="farba-option" data-value="<?php echo $singleMaterial['tytul']; ?>">
                    <div class="farba-option-img">
                      <img src="<?php echo KHC_PATH2 . 'uploads/thumbs/' . $singleMaterial['image']; ?>" alt="<?php echo $singleMaterial['tytul']; ?>">
                    </div>
                </div>
                <?php } ?>
              </div>
            </div>

          </div>
        </div>

        <div class="box-row-count">

          <div class="box-row-count-input">
            <input type="number" name="konzoly-count" class="" value="1">
          </div>

          <div class="box-row-count-buttons">
            <div class="button-plus">+</div>
            <div class="button-minus">-</div>
          </div>

          <div class="box-row-button">
            <button name="submit" value="konzoly" class="tag-add-to-card-accessories"><?php echo $lang->getLanguage('dodajDoKoszyka','Add');?></button>
          </div>

        </div>
      </div>
    </form>
    <?php 
      } 
    ?>
  </div>
  <script>

    function validateForm(form) {
      // Najdi checkbox uvnitř formuláře
      var checkbox = $(form).find('input[name="konzoly-color"]');

      // Ověř, zda je checkbox zaškrtnutý
      if (!checkbox.prop("checked")) {
        // Pokud není, zobraz upozornění
        alert("Musíte vybrat farbu!");
        // Zabrání odeslání formuláře
        return false;
      }

      // Pokud je checkbox zaškrtnutý, formulář může být odeslán
      return true;
    }
    
    $(document).ready(function(){

      $('.box-akcesoria').each(function() {
        var $box = $(this);
        $box.find('.slider-doplnky').on('input', function() {
          // Získání hodnoty ze slideru
          var sliderValue = $(this).val();
          // Aktualizace odpovídajících elementů uvnitř tohoto konkrétního prvku
          $box.find('.sirka').text(sliderValue);
          $box.find('.cena').text(sliderValue + ".00"); // Pokud chcete získat hodnotu s desetinným místem
        });
      });

      $('.slider-doplnky').on('input', function () {
        var sliderValue = $(this).val();
        $(this).closest('.box-row-sirka').find('.sirka').text(sliderValue);
        $(this).closest('.box-row-img-price').find('.cena').text(sliderValue + ".00");
      });

      $(".box-row-sirka-btns-plus").click(function () {
        var slider = $(this).siblings('.slider-doplnky');
        var currentValue = parseInt(slider.val());
        if (currentValue < parseInt(slider.attr('max'))) {
          slider.val(currentValue + 1).trigger('input');
        }
      });

      $(".box-row-sirka-btns-minus").click(function () {
        var slider = $(this).siblings('.slider-doplnky');
        var currentValue = parseInt(slider.val());
        if (currentValue > parseInt(slider.attr('min'))) {
          slider.val(currentValue - 1).trigger('input');
        }
      });

      $(".button-plus").click(function () {
        var inputElement = $(this).closest('.box-akcesoria').find('input[name="konzoly-count"]');
        var currentValue = parseInt(inputElement.val());
        if (currentValue < 10) {
          inputElement.val(currentValue + 1);
        }
      });

      $(".button-minus").click(function () {
        var inputElement = $(this).closest('.box-akcesoria').find('input[name="konzoly-count"]');
        var currentValue = parseInt(inputElement.val());
        if (currentValue > 1) {
          inputElement.val(currentValue - 1);
        }
      });

      $(".box-row-farba").each(function () {
        var $boxRowFarba = $(this);
        var $farbaButton = $boxRowFarba.find(".farba-button");
        var $farbaDropdown = $boxRowFarba.find(".farba-dropdown");
        var $checkbox = $boxRowFarba.find('input[name="konzoly-color"]');

        $farbaButton.click(function () {
          // Skryje všechny ostatní dropdowny
          $(".farba-dropdown").not($farbaDropdown).hide();
          $farbaDropdown.toggle();
        });

        $farbaDropdown.on("click", ".farba-option", function () {
          var selectedColor = $(this).data("value");
          var selectedImage = $(this).find("img").attr("src");

          $farbaButton.find("label").text(selectedColor);
          $farbaButton.find("img").attr("src", selectedImage);
          $checkbox.val(selectedColor);
    
          $checkbox.prop("checked", true); // Zaškrtne checkbox

          $farbaDropdown.hide();
        });
      });

    });
  </script>

  <div class="row-title"><h3>Spoje</h3></div>
  <div class="row-akcesoria">
    <?php
      foreach ($przypisaneJoints as $singleMaterial) {
        if ($singleMaterial['przypisany'] == false) continue;
        if ($singleMaterial['tytul'] == 'Priznaný spoj') continue;

    ?>
    <form method="POST">
      <div class="box-akcesoria">
        <div class="box-row-img">
          <a href="./../wp-content/plugins/calculator_aj/uploads/<?php echo $singleMaterial['image']; ?>" data-lightbox="<?php echo $singleMaterial['id']; ?>" data-title="<?php echo $singleMaterial['caption']; ?>">
            <img src="./../wp-content/plugins/calculator_aj/uploads/<?php echo $singleMaterial['image']; ?>" alt="">
          </a>
          <div class="box-row-img-price">1ks / <?php echo $singleMaterial['price']; ?> €</div>
        </div>
        <div class="box-row-title">
          <h4><?php echo $singleMaterial['tytul']; ?></h4>
        </div>

        <div class="box-row-count">

          <div class="box-row-count-input">
            <input type="number" name="spoje-count" class="" value="1">
            <input type="number" name="spoje-id" style="display: none;" value="<?php echo $singleMaterial['id']; ?>">
            <input type="hidden" name="spoje-title" value="<?php echo $singleMaterial['tytul']; ?>">
            <input type="number" name="spoje-price" style="display: none;" value="<?php echo $singleMaterial['price']; ?>">
          </div>

          <div class="box-row-count-buttons">
            <div class="button-plus">+</div>
            <div class="button-minus">-</div>
          </div>

          <div class="box-row-button">
            <button name="submit" value="spoje" class="tag-add-to-card-accessories"><?php echo $lang->getLanguage('dodajDoKoszyka','Add');?></button>
          </div>

        </div>
      </div>
    </form>
    <?php 
      } 
    ?>
  </div>
  <script>
    $(document).ready(function(){
        $(".button-plus").click(function(){
            var inputElement = $(this).closest('.box-row-count').find('input[name="spoje-count"]');
            var currentValue = parseInt(inputElement.val());
            if(currentValue < 10) {
                inputElement.val(currentValue + 1);
            }
        });

        $(".button-minus").click(function(){
            var inputElement = $(this).closest('.box-row-count').find('input[name="spoje-count"]');
            var currentValue = parseInt(inputElement.val());
            if(currentValue > 1) {
                inputElement.val(currentValue - 1);
            }
        });
    });
  </script>
