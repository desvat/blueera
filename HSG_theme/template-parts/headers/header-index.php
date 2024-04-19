    <header class="header-index">

      <div class="boxs-index">
        
        <div class="box active-slider" data-box="1">
          <div class="box-inner-wrapper">
            <a href="/hlinikove-okna-dvere-a-presklene-fasady/" title="zobraziť viac" target="_self">
              <h3>HLINÍKOVÉ OKNÁ, DVERE A PRESKLENÉ FASÁDY</h3>
              <img src="./../wp-content/themes/HSG/assets/images/hlinikove-okna-header.jpg" alt="" />
            </a>
          </div>
        </div>

        <div class="box" data-box="2">
          <div class="box-inner-wrapper">
            <a href="/hlinikove-okna-dvere-a-presklene-fasady/" title="zobraziť viac" target="_self">
              <h3>ODVETRANÉ FASÁDY</h3>
              <img src="./../wp-content/themes/HSG/assets/images/prevetravane-fasady-header-2.jpg" alt="" />
            </a>
          </div>
        </div>

        <div class="box" data-box="3">
          <div class="box-inner-wrapper">
            <a href="/hlinikove-okna-dvere-a-presklene-fasady/" title="zobraziť viac" target="_self">
              <h3>OCEĽOVÉ KONŠTRUKCIE</h3>
              <img src="./../wp-content/themes/HSG/assets/images/ocelove-konstrukcie-header.jpg" alt="" />
            </a>
          </div>
        </div>

        <div class="box" data-box="4">
          <div class="box-inner-wrapper">
            <a href="/hlinikove-okna-dvere-a-presklene-fasady/" title="zobraziť viac" target="_self">
              <h3>GARÁŽOVÉ, PRIEMYSELNÁ BRÁNY A POHONY</h3>
              <img src="./../wp-content/themes/HSG/assets/images/garazove-brany-header.jpg" alt="" />
            </a>
          </div>
        </div>

      </div>

      <div class="header-background-custom-index">
        <img data-value="1" id="aaa" class="box-img active" src="./../wp-content/themes/HSG/assets/images/hlinikove-okna-header.jpg" alt="" />
        <img data-value="2" class="box-img" src="./../wp-content/themes/HSG/assets/images/prevetravane-fasady-header-2.jpg" alt="" />
        <img data-value="3" class="box-img" src="./../wp-content/themes/HSG/assets/images/ocelove-konstrukcie-header.jpg" alt="" />
        <img data-value="4" class="box-img" src="./../wp-content/themes/HSG/assets/images/garazove-brany-header.jpg" alt="" />
      </div>

      <script>
        let timerInterval = 5000;
        var paused = true;

        function bannerSwitcher() {
          // activeIMG = $('.header-background-custom-index').children('.active');
          // var dataValue = $(activeIMG).attr('data-value');
          // $(activeIMG).prev().removeClass('active');
          // $(activeIMG).next().addClass('active');
          // $(activeIMG).first().removeClass('active');
          // var dataImg = $('.header-background-custom-indeximg img').attr('data-value', dataBox);

          var activeIMG = $('.header-background-custom-index').children('.active');
          var dataValue = $(activeIMG).attr('data-value');

          if (dataValue <= 3) {
            $(activeIMG).first().removeClass('active');
            $(activeIMG).next().addClass('active');

            $(".box").removeClass('active-slider');
            $(".boxs-index [data-box="+ dataValue +"]").next().addClass('active-slider');

            var bbb = $(".box [data-box="+ dataValue +"]").attr('class');
            console.log(bbb);
          } else {
            $(activeIMG).last().removeClass('active');
            $("#aaa").addClass('active');

            $(".box").removeClass('active-slider');
            $(".boxs-index [data-box="+ dataValue +"]").addClass('active-slider');
          }

        }

        $(document).ready(function() {

          var bannerTimer = setInterval(bannerSwitcher, timerInterval);

          $(".box").mouseover(function() {

            var dataBox = $(this).attr('data-box');
            $('.header-background-custom-index img').removeClass('active');
            $(".header-background-custom-index [data-value="+ dataBox +"]").addClass('active');

            $(".box").removeClass('active-slider');
            $(this).addClass('active-slider');

            clearInterval(bannerTimer);
            bannerTimer = setInterval(bannerSwitcher, 60000)
          })
          .mouseout(function() {

            clearInterval(bannerTimer);
            bannerTimer = setInterval(bannerSwitcher, timerInterval)
          });

        });

      </script>

    </header>
