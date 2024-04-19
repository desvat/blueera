    <header class="header-home anim-wrapper">
      <div class="header-content">

        <div class="content-wrapper">

            <section id="section-1" style="display: none1;">
              <div class="content-slider">
                <input type="radio" id="banner1" class="sec-1-input" name="banner" checked>
                <input type="radio" id="banner2" class="sec-1-input" name="banner">
                <input type="radio" id="banner3" class="sec-1-input" name="banner">
                <input type="radio" id="banner4" class="sec-1-input" name="banner">
                <div class="slider">
                  <div id="top-banner-1" class="banner">
                    <div class="banner-inner-wrapper">
                      <div class="banner-inner-wrapper-text">
                        <h2>Novinka I</h2>
                        <h3>Či už staváte energeticky úsporný dom, pasívnu alebo štandardnú novostavbu, alebo „iba“ chcete vymeniť Vaše staré okná za nové, HSG Vám ponúka optimálne riešenie pre Vaše potreby.</h3>
                        <a href="#" title="">zobraziť viac</a>
                      </div>
                      <img src="./../wp-content/themes/HSG/assets/images/hlinikove-okna-header.jpg" alt="" />
                    </div>
                  </div>
                  <div id="top-banner-2" class="banner">
                    <div class="banner-inner-wrapper">
                      <div class="banner-inner-wrapper-text">
                        <h2>Novinka II</h2>
                        <h3>Brány HSG predstavujú funkčné, odolné a bezpečné riešenie a zároveň dokonale ladia s vonkajším vzhľadom fasády.</h3>
                        <a href="#" title="">zobraziť viac</a>
                      </div>
                      <img src="./../wp-content/themes/HSG/assets/images/garazove-brany-header.jpg" alt="" />
                    </div>
                  </div>
                  <div id="top-banner-3" class="banner">
                    <div class="banner-inner-wrapper">
                      <div class="banner-inner-wrapper-text">
                        <h2>Novinka III</h2>
                        <h3>Prevetrávaná fasáda je fasáda, ktorá má vrchný plášť oddelený od obvodovej steny vzduchovou medzerou. Jej funkčnosť sa zabezpečuje odvetrávaním tohto priestoru.  V tomto priestore dochádza k zrýchleniu prúdenia vzduchu, tzv. komínový efekt, vďaka čomu je zabezpečená cirkulácia vzduchu.</h3>
                        <a href="#" title="">zobraziť viac</a>
                      </div>
                      <img src="./../wp-content/themes/HSG/assets/images/prevetravane-fasady-header-2.jpg" alt="" />
                    </div>
                  </div>
                  <div id="top-banner-4" class="banner">
                    <div class="banner-inner-wrapper">
                      <div class="banner-inner-wrapper-text">
                        <h2>Novinka IV</h2>
                        <h3>Naša spoločnosť vyrába, dodáva a montuje oceľové konštrukcie celozvárané alebo skrutkované pre rôzne stavebné aplikácie, od priemyselných stavieb, cez oblasť skladovania a logistiky, až po oblasť služieb a využitia voľného času.</h3>
                        <a href="#" title="">zobraziť viac</a>
                      </div>
                      <img src="./../wp-content/themes/HSG/assets/images/ocelove-konstrukcie-header.jpg" alt="" />
                    </div>
                  </div>
                </div>

                <nav>
                  <div class="controls">
                    <label for="banner1" class="anim-down-to-up anim-delay-250"><span class="progressbar"><span class="progressbar-fill"></span></span>Novinka I</label>
                    <label for="banner2" class="anim-down-to-up anim-delay-500"><span class="progressbar"><span class="progressbar-fill"></span></span>Novinka II</label>
                    <label for="banner3" class="anim-down-to-up anim-delay-750"><span class="progressbar"><span class="progressbar-fill"></span></span>Novinka III</label>
                    <label for="banner4" class="anim-down-to-up anim-delay-1000"><span class="progressbar"><span class="progressbar-fill"></span></span>Novinka IV</label>
                  </div>
                </nav>

              </div>
            </section>

            <script>
              function bannerSwitcher() {
                next = $('.sec-1-input').filter(':checked').next('.sec-1-input');
                console.log(next);
                if (next.length)
                {
                  next.prop('checked', true);
                }
                else {
                  $('.sec-1-input').first().prop('checked', true);
                }
              }

              var bannerTimer = setInterval(bannerSwitcher, 5000);

              $('nav .controls label').click(function() {
                clearInterval(bannerTimer);
                bannerTimer = setInterval(bannerSwitcher, 5000)
              });
            </script>

        </div>

      </div>
      <div class="header-eu">
        <a href="https://www.hsg.sk/wp-content/uploads/2020/10/2018-07-09-142004-Publicita_HSG_podklad.pdf" title="" target="_blank">
          <img src="./../wp-content/themes/HSG/assets/images/eu-stitok.png" class="anim-right-to-left" alt="" />
        </a>
      </div>
      <div class="header-mouse anim-left-to-right">
        <div class="mouse"></div>
      </div>
      <div class="header-social anim-left-to-right">
        <h3><span>sledujte nás</span> na sociálnych médiách</h3>
        <div class="header-social-links">
          <a href="https://www.facebook.com/" title="Facebook" target="_blank" class="icon-facebook">
            <span>Facebook</span>
          </a>
          <a href="https://www.instagram.com/" title="Instagram" target="_blank" class="icon-instagram">
            <span>Instagram</span>
          </a>
        </div>
      </div>
    </header>
