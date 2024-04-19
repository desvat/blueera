    <header id="header-main" class="header-main-index">
      <div class="header-main-wrapper">


        <div class="header-content-wrapper">
          <div class="svg-logo">
            <svg stroke="#D72528" stroke-width="2" class="text-line">
              <text style="" x="50%" y="50%"  dominant-baseline="middle" text-anchor="middle" fill="none">HSG</text>
            </svg>
          </div>
          <div class="carousel">
            <div class="container">
              <div class="ui-card">
                hidden
              </div>
              <div class="ui-card" data-tab="1">
                <p><span><a href="/hlinikove-okna-dvere-presklene-fasady/" title="">Hliníkové okná, dvere<br>presklené fasády</a></span></p>
                <a href="/hlinikove-okna-dvere-presklene-fasady/" title="">zobraziť viac</a>
                <img src="../wp-content/themes/HSG/assets/images/hlinikove-okna-header.jpg" alt="" />
              </div>
              <div class="ui-card" data-tab="2">
                <p><span><a href="/prevetravane-fasady/" title="">Prevetrávané fasády</a></span></p>
                <a href="/prevetravane-fasady/" title="">zobraziť viac</a>
                <img src="../wp-content/themes/HSG/assets/images/prevetravane-fasady-header-2.jpg" alt="" />
              </div>
              <div class="ui-card" data-tab="3">
                <p><span><a href="/ocelove-konstrukcie/" title="">Oceľové konštrukcie</a></span></p>
                <a href="/ocelove-konstrukcie/" title="">zobraziť viac</a>
                <img src="../wp-content/themes/HSG/assets/images/ocelove-konstrukcie-header.jpg" alt="" />
              </div>
              <div class="ui-card" data-tab="4">
                <p><span><a href="/garazove-a-priemyselna-brany-pohony/" title="">Garážové a priemyselná<br>brány, pohony</a></span></p>
                <a href="/garazove-a-priemyselna-brany-pohony/" title="">zobraziť viac</a>
                <img src="../wp-content/themes/HSG/assets/images/garazove-brany-header.jpg" alt="" />
              </div>
              <div class="ui-card">
                hidden
              </div>

              <div class="carousel-arrow-left"></div>
              <div class="carousel-arrow-right"></div>

            </div>
          </div>

          <div class="header-main-dots">
            <div class="ui-dots" data-dots="1">
              <span>1</span>
            </div>
            <div class="ui-dots active" data-dots="2">
              <span>2</span>
            </div>
            <div class="ui-dots" data-dots="3">
              <span>3</span>
            </div>
            <div class="ui-dots" data-dots="4">
              <span>4</span>
            </div>
          </div>

        </div>


        <div class="header-main-background">
          <div class="ui-background" data-background="1">
            <img src="../wp-content/themes/HSG/assets/images/hlinikove-okna-header.jpg" alt="" />
          </div>
          <div class="ui-background active" data-background="2">
            <img src="../wp-content/themes/HSG/assets/images/prevetravane-fasady-header-2.jpg" alt="" />
          </div>
          <div class="ui-background" data-background="3">
            <img src="../wp-content/themes/HSG/assets/images/ocelove-konstrukcie-header.jpg" alt="" />
          </div>
          <div class="ui-background" data-background="4">
            <img src="../wp-content/themes/HSG/assets/images/garazove-brany-header.jpg" alt="" />
          </div>
        </div>

      </div>

      <script>
        $num = $('.ui-card').length;
        $even = $num / 2;
        $odd = ($num + 1) / 2;

        console.log($odd);

        if ($num % 2 == 0) {
          $('.ui-card:nth-child(' + $even + ')').addClass('active');
          $('.ui-card:nth-child(' + $even + ')').prev().addClass('prev');
          $('.ui-card:nth-child(' + $even + ')').next().addClass('next');
        } else {
          $('.ui-card:nth-child(' + $odd + ')').addClass('active');
          $('.ui-card:nth-child(' + $odd + ')').prev().addClass('prev');
          $('.ui-card:nth-child(' + $odd + ')').next().addClass('next');
        }

        $('.ui-card').click(function() {
          // $slide = $('.active').width();

          var dataTab = this.getAttribute("data-tab");
          var dataBackground = this.getAttribute("data-background");
          var dataDots = this.getAttribute("data-dots");

          if ($(this).hasClass('next'))
          {
            // $('.container').stop(false, true).animate({left: '-=' + $slide});
          }
          else if ($(this).hasClass('prev'))
          {
            // $('.container').stop(false, true).animate({left: '+=' + $slide});
          }

          $(this).removeClass('prev next');
          $(this).siblings().removeClass('prev active next');

          $(this).addClass('active');
          $(this).prev().addClass('prev');
          $(this).next().addClass('next');

          // $('data-background' + dataTab).addClass('active');
          $('.header-main-background .ui-background').removeClass("active");
          $('.header-main-background div[data-background=' + dataTab + ']').addClass("active");

          $('.header-main-dots .ui-dots').removeClass("active");
          $('.header-main-dots div[data-dots=' + dataTab + ']').addClass("active");

        });


          // var myVar = $(".container").find('div.active').val();
          // var object = document.querySelector(".active");
          // var element = $(".ui-card").attr("data-tab");

          // console.log('A: ' + element);





        // Arrow nav
        $('#header-main .carousel-arrow-left').click(function() {

          var myVar = $(".active").attr("data-tab");
          var myVarMinus = parseInt(myVar) - parseInt(1);

          if(myVarMinus == 0) {
            myVarMinus = 1;
          }

          $('.container div[data-tab=' + myVarMinus + ']').removeClass('prev next');
          $('.container div[data-tab=' + myVarMinus + ']').siblings().removeClass('prev active next');

          $('.container div[data-tab=' + myVarMinus + ']').addClass('active');
          $('.container div[data-tab=' + myVarMinus + ']').prev().addClass('prev');
          $('.container div[data-tab=' + myVarMinus + ']').next().addClass('next');

          $('.header-main-background .ui-background').removeClass("active");
          $('.header-main-background div[data-background=' + myVarMinus + ']').addClass("active");

          $('.header-main-dots .ui-dots').removeClass("active");
          $('.header-main-dots div[data-dots=' + myVarMinus + ']').addClass("active");

        });
        $('#header-main .carousel-arrow-right').click(function() {

          var myVar = $(".active").attr("data-tab");
          var myVarPlus = parseInt(myVar) + parseInt(1);

          if(myVarPlus == 5) {
            myVarPlus = 4;
          }

          $('.container div[data-tab=' + myVarPlus + ']').removeClass('prev next');
          $('.container div[data-tab=' + myVarPlus + ']').siblings().removeClass('prev active next');

          $('.container div[data-tab=' + myVarPlus + ']').addClass('active');
          $('.container div[data-tab=' + myVarPlus + ']').prev().addClass('prev');
          $('.container div[data-tab=' + myVarPlus + ']').next().addClass('next');

          $('.header-main-background .ui-background').removeClass("active");
          $('.header-main-background div[data-background=' + myVarPlus + ']').addClass("active");

          $('.header-main-dots .ui-dots').removeClass("active");
          $('.header-main-dots div[data-dots=' + myVarPlus + ']').addClass("active");

        });

        // Dots nav
        $('.ui-dots').click(function() {
          var dataTab = this.getAttribute("data-dots");
          console.log(dataTab);

          $('.container div[data-tab=' + dataTab + ']').removeClass('prev next');
          $('.container div[data-tab=' + dataTab + ']').siblings().removeClass('prev active next');

          $('.container div[data-tab=' + dataTab + ']').addClass('active');
          $('.container div[data-tab=' + dataTab + ']').prev().addClass('prev');
          $('.container div[data-tab=' + dataTab + ']').next().addClass('next');

          $('.header-main-background .ui-background').removeClass("active");
          $('.header-main-background div[data-background=' + dataTab + ']').addClass("active");

          $('.header-main-dots .ui-dots').removeClass("active");
          $('.header-main-dots div[data-dots=' + dataTab + ']').addClass("active");

        });

        // Keyboard nav
        $('html body').keydown(function(e) {
          if (e.keyCode == 37) { // left
            $('.active').prev().trigger('click');
          }
          else if (e.keyCode == 39) { // right
            $('.active').next().trigger('click');
          }
        });
      </script>
    </header>
