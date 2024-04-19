  <header class="header-default anim-wrapper">
    <div class="header-titles">
      <div class="titles-wrapper">
        <h2><?php echo get_the_title(); ?></h2>
      </div>
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
    <div class="header-background-custom">
      <?php

        if( get_post_meta( $post->ID, 'addimageheader' , true) ) {
          $post_header_has = get_post_meta( $post->ID, 'addimageheader' , true);
        } else {
          $post_header_has = "/../../wp-content/themes/HSG/assets/images/thumbnail-cube.png";
        }
        echo "<img src=\" ". $post_header_has ." \" alt=\"\" />";;

      ?>
    </div>
  </header>
