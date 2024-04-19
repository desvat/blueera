<?php
  if( is_page( array(16,127,128,129) ) ) // blogy
  {
    $show_aside = TRUE;
  }
  else
  {
    $show_aside = FALSE;
  }
?>
    <main>
      <div class="main-the-content <?php if ( !empty( get_the_content() ) ) { echo "no_empty_content"; }?>">
        <selection class="main-with-aside">
          <article class="anim-wrapper <?php if($show_aside == TRUE) { echo "aside-padding"; } ?>">
              <?php echo the_content(); ?>
            </article>
          <aside <?php if($show_aside == FALSE) { echo "style=\"display: none;\""; } ?>>
              <div class="aside-wrapper-page">

                <div class="widget-menu-wrapper">
                  <div id="block-9" class="widget-files widget_block">
                    <h4>Dokumenty</h4>
                  </div>
                  <div class="widget-menu-list anim-wrapper">
                    <ul>
                      <li class="anim-left-to-right anim-delay-250 <?php if( is_page(16) ) { echo "current-menu-item"; } ?>"><a href="/dokumenty/" title="CERTIFIKÁTY" target="_self">CERTIFIKÁTY</a></li>
                      <li class="anim-left-to-right anim-delay-500 <?php if( is_page(127) ) { echo "current-menu-item"; } ?>"><a href="/navody/" title="NÁVODY" target="_self">NÁVODY</a></li>
                      <li class="anim-left-to-right anim-delay-750 <?php if( is_page(128) ) { echo "current-menu-item"; } ?>"><a href="/katalogy/" title="KATALÓGY" target="_self">KATALÓGY</a></li>
                      <li class="anim-left-to-right anim-delay-1000 <?php if( is_page(129) ) { echo "current-menu-item"; } ?>"><a href="/ostatne-dokumenty/" title="OSTATNÉ DOKUMENTY" target="_self">OSTATNÉ DOKUMENTY</a></li>
                    </ul>
                  </div>
                </div>

              </div>
            </aside>
        </selection>
      </div>
    </main>
    <style>
      main .elementor-image-gallery {
      }
      main .elementor-image-gallery .gallery {
      }
      main .elementor-image-gallery .gallery dl {
        aspect-ratio: 1 / 1;
        padding: 50px 25px 0px 25px;
        position: relative;
      }
      main .elementor-image-gallery .gallery dl.gallery-item:nth-child(1),
      main .elementor-image-gallery .gallery dl.gallery-item:nth-child(6),
      main .elementor-image-gallery .gallery dl.gallery-item:nth-child(11),
      main .elementor-image-gallery .gallery dl.gallery-item:nth-child(16),
      main .elementor-image-gallery .gallery dl.gallery-item:nth-child(21) {
        padding: 50px 25px 0px 25px;
      }
      main .elementor-image-gallery .gallery dl.gallery-item:nth-child(4),
      main .elementor-image-gallery .gallery dl.gallery-item:nth-child(9),
      main .elementor-image-gallery .gallery dl.gallery-item:nth-child(14),
      main .elementor-image-gallery .gallery dl.gallery-item:nth-child(19),
      main .elementor-image-gallery .gallery dl.gallery-item:nth-child(24) {
        padding: 50px 25px 0px 25px;
      }
      #gallery-1 .gallery-item,
      #gallery-2 .gallery-item,
      #gallery-3 .gallery-item,
      #gallery-4 .gallery-item,
      #gallery-5 .gallery-item {
        margin-top: 0;
      }
      #gallery-1 img,
      #gallery-2 img,
      #gallery-3 img,
      #gallery-4 img,
      #gallery-5 img {
        border: 0px solid transparent;
      }
      main .elementor-image-gallery .gallery img {
        width: 100%;
        height: 100%;
        object-fit: cover;
        border: 0px solid transparent;
      }
      main .elementor-image-gallery .gallery a {
        position: relative;
        display: block;
        width: 100%;
        height: 100%;
      }
      main .elementor-image-gallery .gallery a::after {
        content: '';
        width: 100%;
        height: 100%;
        position: absolute;
        left: 0;
        right: 0;
        margin-left: auto;
        margin-right: auto;
        bottom: 0;
        background-color: var(--red);
        background-image: url('./../wp-content/themes/HSG/assets/images/icon-right-arrow-white.svg');
        background-position: center center;
        background-size: 20px auto;
        background-repeat: no-repeat;
        z-index: 11;
        opacity: 0;
          -webkit-transition: all 500ms ease-out;
          -moz-transition: all 500ms ease-out;
          -ms-transition: all 500ms ease-out;
          -o-transition: all 500ms ease-out;
          transition: all 500ms ease-out;
      }
      main .elementor-image-gallery .gallery a:hover::after {
        opacity: 0.8;
      }
      @media only screen and (max-width: 428px) {
        #gallery-1 .gallery-item {
          width: 100%;
        }
        main .elementor-image-gallery .gallery dl {
          padding: 25px 0px 0px 0px;
        }
        main .elementor-image-gallery .gallery dl.gallery-item:nth-child(1),
        main .elementor-image-gallery .gallery dl.gallery-item:nth-child(6),
        main .elementor-image-gallery .gallery dl.gallery-item:nth-child(11),
        main .elementor-image-gallery .gallery dl.gallery-item:nth-child(16),
        main .elementor-image-gallery .gallery dl.gallery-item:nth-child(21) {
          padding: 25px 0px 0px 0px;
        }
        main .elementor-image-gallery .gallery dl.gallery-item:nth-child(4),
        main .elementor-image-gallery .gallery dl.gallery-item:nth-child(9),
        main .elementor-image-gallery .gallery dl.gallery-item:nth-child(14),
        main .elementor-image-gallery .gallery dl.gallery-item:nth-child(19),
        main .elementor-image-gallery .gallery dl.gallery-item:nth-child(24) {
          padding: 25px 0px 0px 0px;
        }
      }
    </style>
