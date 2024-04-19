<?php
  $show_aside = TRUE;
?>
<main>
  <div class="main-the-blog <?php if ( !empty( get_the_content() ) ) { echo "no_empty_content"; }?>">
    <selection class="main-with-aside">
      <article class="anim-wrapper <?php if($show_aside == TRUE) { echo "aside-padding"; } ?>">
        <?php echo the_content(); ?>
      </article>
      <aside <?php if($show_aside == FALSE) { echo "style=\"display: none;\""; } ?>>
        <div class="aside-wrapper-page">

          <div class="widget-blog-wrapper anim-wrapper">

            <div class="">
              <h4>Ďalšie blogy</h4>
            </div>

            <div class="widget-blog-list">

                <?php

                  $args = [
                      'post_type'              => ['blogs'],
                      'post_status'            => 'publish',
                      'nopaging'               => false,
                      'posts_per_page'         => '3',
                      'ignore_sticky_posts'    => false,
                      'post__not_in'           => [get_the_ID()]
                  ];

                  $query = new WP_Query($args);

                  if ($query->have_posts()) :
                      while ($query->have_posts()) : $query->the_post();
                      // row themplate

                      if( has_post_thumbnail() ) {
                        $post_thumbnail_has = get_the_post_thumbnail( get_the_ID(), 'full' );
                      } else {
                        $post_thumbnail_has = "<img src=\"../../wp-content/themes/HSG/assets/images/thumbnail-cube.png\" alt=\"\" />";
                      }

                      // echo $post_thumbnail_has;
                ?>

              <div class="widget-blog-row anim-left-to-right">
                <a href="<?php echo get_permalink(); ?>" title="<?php echo get_the_title(); ?>">
                  <div class="widget-blog-img">
                    <div class="img-hover">
                      <svg version="1.1" class="icon-right-arrow" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px" viewBox="0 0 13 20" style="enable-background:new 0 0 13 20;" xml:space="preserve">
                        <path d="M11.6,7L13,7.9v4.2L0.8,20L0,18.7l11.6-7.5V7L11.6,7z M10.2,6.1L0.8,0L0,1.3l10.2,6.6V6.1z"/>
                      </svg>
                    </div>
                    <div class="img-picture">
                      <?php echo $post_thumbnail_has; ?>
                    </div>
                  </div>
                  <div class="widget-blog-title">
                    <?php echo get_the_title(); ?>
                    <div class="read-more">Zobratiť viac</div>
                  </div>
                </a>
              </div>

              <?php
                  endwhile;
                endif;

                wp_reset_postdata();
              ?>
            </div>

          </div>


      </aside>
    </selection>
  </div>
</main>
