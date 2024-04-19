<?php
  if( is_page( array(32,33,34,35) ) ) // Pre domácnosť, Pre priemysel, Oceľové konštrukcie, Prevetrávané fasády
  {
    $show_aside = FALSE;
  }
  else
  {
    $show_aside = TRUE;
  }
?>
<div id="content-page" class="main-content-page">
  <div class="main-content-wrapper-page">
    <main <?php if($show_aside == TRUE) { echo "class=\"main-padding\""; } ?>>
      <div class="main-wrapper-page anim-wrapper">
        <?php
          $id = get_the_ID();
          $post = get_post($id);

          $content_text = apply_filters('the_content', $post->post_content);

          echo $content_text;
        ?>
      </div>

      <?php
        if(get_the_ID() == 32 ) { // PRE DOMÁCNOSŤ
            $id_sub = 370;
            $post = get_post($id_sub);
            $content = apply_filters('the_content', $post->post_content);
        } elseif(get_the_ID() == 33 ) { // PRE PRIEMYSEL
            $id_sub = 512;
            $post = get_post($id_sub);
            $content = apply_filters('the_content', $post->post_content);
        } elseif(get_the_ID() == 44 ) { // GARÁŽOVÉ BRÁNY A DVERE
            $id_sub = 355;
            $post = get_post($id_sub);
            $content = apply_filters('the_content', $post->post_content);
        }
      ?>

      <div id="widget-cathegory-sub" class="cathegory-sub-wrapper <?php if ( !empty( $content ) && !empty( $content_text ) ) { echo "cathegory-margin "; } ?> cathegory-sub-wrapper-4 anim-wrapper">
        <?php
          echo $content;
          wp_reset_postdata();
        ?>
      </div>

    </main>
    <aside <?php if($show_aside == FALSE) { echo "style=\"display: none;\""; } ?>>
      <div class="aside-wrapper-page">

        <div class="widget-menu-wrapper">
          <div id="block-9" class="widget-files widget_block">
            <?php
              $parent_title = get_the_title($post->post_parent);
              $parent_permalink = get_permalink($post->post_parent);
            ?>
            <h4><a href="<?php echo $parent_permalink; ?>" title="" target="_self"><?php echo $parent_title; ?></a></h4>
          </div>
          <div class="widget-products-list anim-wrapper">
            <ul>
              <?php
                wp_nav_menu( array(
                  'menu'     => 'Products sub menu',
                  'sub_menu' => true
                ) );
              ?>
            </ul>
          </div>
        </div>

      </div>
    </aside>
  </div>
</div>
<?php // if ( !empty( get_the_content() ) ) { echo "cathegory-margin "; } ?>
