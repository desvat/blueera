    <main>
      <div class="main-the-content <?php if ( !empty( get_the_content() ) ) { echo "no_empty_content"; }?>">
        <?php echo the_content(); ?>
      </div>
      <div id="widget-blogs" class="blogs anim-down-to-up">

        <h3 class="widget-titles max-width">Blogy</h3>

        <div class="blogs-wrapper">

          <?php
          $args = array(
            'post_type' => 'blogs',
            'post_status' => 'publish',
            'posts_per_page' => 4,
            'orderby' => 'id',
            'order' => 'DESC',
          );

          $loop = new WP_Query( $args );

            while ( $loop->have_posts() ) : $loop->the_post();
            ?>
            <div class="blog-box">
              <div class="blog-box-top">
                <div class="blog-box-title"><a href="<?php echo get_permalink(); ?>" title=""><h4><?php echo mb_strimwidth( get_the_title(), 0, 40, '...' ); ?></h4></a></div>
                <div class="blog-box-text"><p><?php echo wp_trim_words( get_the_content(), 18, '...' ); ?></p></div>
                <div class="blog-box-buttton">
                  <a href="<?php echo get_permalink(); ?>" title="">
                    <span>zobraziť viac</span>
                    <svg version="1.1" class="icon-arrow-button" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px"viewBox="0 0 24 16" style="enable-background:new 0 0 24 16;" xml:space="preserve">
                      <path d="M21.6,7.4v1.2H0V7.4H21.6z M12.9,1l9.8,6V9l-9.8,6l0.6,1L24,9.6V6.4L13.6,0L12.9,1z"/>
                    </svg>
                  </a>
                </div>
              </div>
              <div class="blog-box-bottom">
                <?php
                  if( has_post_thumbnail() ) {
                    $post_thumbnail_has = get_the_post_thumbnail( get_the_ID(), 'full' );
                  } else {
                    $post_thumbnail_has = "<img src=\"wp-content/themes/HSG/assets/images/thumbnail-cube.png\" alt=\"\" />";
                  }
                ?>

                <div class="blog-box-img">

                    <div class="img-wrapper">

                      <a href="<?php echo get_permalink(); ?>" title="">

                        <div class="img-hover">
                          <svg version="1.1" class="icon-right-arrow" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px" viewBox="0 0 13 20" style="enable-background:new 0 0 13 20;" xml:space="preserve">
                            <path d="M11.6,7L13,7.9v4.2L0.8,20L0,18.7l11.6-7.5V7L11.6,7z M10.2,6.1L0.8,0L0,1.3l10.2,6.6V6.1z"/>
                          </svg>
                        </div>
                        <div class="img-picture">
                          <?php echo $post_thumbnail_has; ?>
                        </div>
                        ccc
                      </a>

                    </div>

                </div>
              </div>
            </div>


            <!-- <a href="<?php echo get_permalink(); ?>" title=""><?php echo $post_thumbnail_has; ?></a> -->
            <?php
              // the_excerpt();
              endwhile;
              wp_reset_postdata();
            ?>
        </div>

      </div>
    </main>
    <div id="widget-form-big" class="widget-contact-form">
      <div class="widget-contact-form-wrapper-kontakt">
        <div class="adress">
          <div class="adress-top">
            <div>
              <h4>HSG s.r.o.</h4>
              <p><a href="" title="">Oravský Podzámok 138</a></p>
              <p><a href="" title="">027 41</a></p>
            </div>
            <div>
              <h4>KONTAKTY</h4>
              <p><a href="" title="">043 58 93 011</a></p>
              <p><a href="" title="">info@hsg.sk</a></p>
            </div>
          </div>
          <div class="adress-bottom">
            <div class="opening-hours">
              <p>Sme Vám k dispozícii počas prevádzkových hodín:</p>
              <p>PO-PIA 6:30 – 15:30</p>
            </div>
            <div class="call-us">

              <a href="" title="">
                <div class="icon-pulse">
                  <svg version="1.1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px" viewBox="0 0 30 30" style="enable-background:new 0 0 30 30;" xml:space="preserve">
                  <path id="icon-pulse-phone" d="M29.7,25.3c-0.8,2.4-4.3,4.8-6,4.7C11.4,28.3,1.7,18.6,0,6.3c-0.1-1.7,2.2-5.2,4.7-6
                    c1.8-0.6,3-0.4,3.8,1.2l2.1,3.8c0.5,0.9,0.1,1.7-1,2.5c-2.4,1.8-2.9,2.6-1.7,4.8c2.5,3.8,5.7,7.1,9.5,9.5c2.2,1.2,3,0.7,4.8-1.7
                    c0.8-1.1,1.5-1.5,2.5-1l3.8,2.1C30.1,22.3,30.3,23.5,29.7,25.3z M21.4,8.6c1.2,1.2,1.8,2.8,1.8,4.4c0,0.8-0.7,1.4-1.5,1.4h0
                    c-0.8,0-1.5-0.7-1.4-1.5c0,0,0,0,0,0c0-1.8-1.4-3.2-3.2-3.3c0,0,0,0,0,0h0c-0.8,0-1.4-0.7-1.4-1.5c0-0.8,0.6-1.4,1.4-1.4
                    C18.7,6.8,20.3,7.4,21.4,8.6z M29.3,13c0,0.8-0.7,1.5-1.5,1.5l0,0c-0.8,0-1.5-0.7-1.5-1.5c0,0,0,0,0,0c0-5.1-4.1-9.3-9.3-9.4
                    c0,0,0,0,0,0h0c-0.8,0-1.4-0.7-1.4-1.5c0-0.8,0.6-1.4,1.4-1.4C23.8,0.7,29.3,6.1,29.3,13C29.3,12.9,29.3,12.9,29.3,13L29.3,13z"/>
                  </svg>
                </div>
                <div class="phone-number">+421 (0)43 58 93 011</div>
              </a>

            </div>
          </div>
        </div>
        <div class="form">
          <div class="form-wrapper">
            <div class="form-title">
              <h3>Kontaktujte nás</h3>
              <p>Mimo prevádzkových hodín nám kedykoľvek pošlite e-mail s vašou požiadavkou alebo použite formulár na tejto stránke. Budeme sa snažiť odpovedať čo najskôr.</p>
            </div>
            <div class="form-items">
              <div class="form-row-two">
                <input type="text" name="" placeholder="Meno" />
                <input type="text" name="" placeholder="Email" />
              </div>
              <div class="form-row-two">
                <input type="text" name="" placeholder="Mobil" />
                <input type="text" name="" placeholder="Poznámka" />
              </div>
              <div class="form-row-one">
                <textarea name="name" rows="2" placeholder="Text"></textarea>
              </div>
              <div class="form-row-button">
              <input type="button" name="" value="Odoslať" />
            </div>
            </div>
          </div>
        </div>
      </div>
    </div>
