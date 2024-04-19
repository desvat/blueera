
<main>
  <div class="main-the-content <?php if ( !empty( get_the_content() ) ) { echo "no_empty_content"; }?>">
    <selection class="main-with-aside">
      <article class="anim-wrapper <?php if($show_aside == TRUE) { echo "aside-padding"; } ?>">
        <?php echo the_content(); ?>
      </article>
    </selection>
    <selection>
      <div id="widget-blogs" class="blogs-page">

        <div class="blogs-wrapper anim-wrapper" >

          <?php
          $args = array(
            'post_type' => 'blogs',
            'post_status' => 'publish',
            'posts_per_page' => 8,
            'orderby' => 'id',
            'order' => 'DESC',
          );

          $loop = new WP_Query( $args );

            while ( $loop->have_posts() ) : $loop->the_post();
            ?>
            <div class="blog-box anim-down-to-up">
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
                    $post_thumbnail_has = "<img src=\"../wp-content/themes/HSG/assets/images/thumbnail-cube.png\" alt=\"\" />";
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

            <?php
              // the_excerpt();
              endwhile;
              wp_reset_postdata();
            ?>

        </div>

      </div>
    </selection>
  </div>
</main>
