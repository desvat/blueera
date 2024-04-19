    <header id="header" class="header-blog anim-wrapper">
      <div class="header-titles">
        <div class="titles-wrapper">
          <?php
            $id = get_the_ID();
            $post = get_post($id);

            $content_title = apply_filters('the_content', $post->post_title);
          ?>
          <h2><?php echo $content_title; ?></h2>
        </div>
      </div>
      <div class="header-contacts white anim-down-to-up">
        <a href="" title="" target="_blank" class="icon-location">
          <svg version="1.1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px" viewBox="0 0 19.5 18" style="enable-background:new 0 0 19.5 18;" xml:space="preserve">
            <path class="st0" d="M9.1,0C6,0.5,3.8,3.2,4.1,6.3c0.3,4,4,6.9,5.3,7.9c0.2,0.2,0.6,0.2,0.8,0c1.3-1,5.3-4.5,5.3-8.4
              c0-3.2-2.6-5.7-5.7-5.7C9.5,0,9.3,0,9.1,0z M9.8,8C8.5,8,7.5,7,7.5,5.7c0-1.2,1-2.3,2.3-2.3c1.2,0,2.3,1,2.3,2.3C12,7,11,8,9.8,8
              L9.8,8z M15.7,18H3.8c-0.6,0-1.1-0.5-1.1-1.1c0-0.1,0-0.1,0-0.2l0.9-4.2c0.1-0.5,0.5-0.8,1-0.8h0.2c1,1.4,2.3,2.6,3.6,3.6
              c0.7,0.5,1.7,0.5,2.4,0c1.3-1,2.5-2.2,3.5-3.5h0.3c0.5,0,0.9,0.3,1,0.8l0.9,4.2c0.1,0.6-0.2,1.1-0.8,1.3C15.8,18,15.8,18,15.7,18z"
              />
          </svg>
          <span>Oravský Podzámok 138,</span>&nbsp; 027 41 Oravský Podzámok
        </a>
        <a href="" title="" class="icon-open">
          <svg version="1.1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px" viewBox="0 0 19.5 18" style="enable-background:new 0 0 19.5 18;" xml:space="preserve">
            <path class="st0" d="M7.6,2.7C7.5,2.3,7.1,2.2,6.8,2.3c-0.1,0-0.1,0.1-0.2,0.1L3.7,4.7C3.4,5,3.4,5.4,3.6,5.7
              c0.1,0.2,0.3,0.2,0.5,0.3c0.1,0,0.3,0,0.4-0.1l2.9-2.3C7.6,3.3,7.7,2.9,7.6,2.7L7.6,2.7z M9.8,0C8.9,0,8.1,0.7,8.1,1.7
              c0,0.9,0.7,1.7,1.7,1.7c0.9,0,1.7-0.7,1.7-1.7c0,0,0,0,0,0C11.5,0.8,10.8,0,9.8,0L9.8,0z M15.8,4.6l-2.7-2.2
              c-0.3-0.2-0.7-0.2-0.9,0.1c0,0-0.1,0.1-0.1,0.2l0,0c-0.1,0.3,0,0.6,0.2,0.8L15,5.6c0.3,0.2,0.7,0.2,0.9-0.1c0,0,0,0,0,0
              C16.1,5.2,16.1,4.8,15.8,4.6L15.8,4.6z M5.1,11.6c0.4,0.5,0.4,1.2,0,1.7c-0.2,0.2-0.5,0.3-0.8,0.3c-0.3,0-0.6-0.1-0.8-0.3
              c-0.4-0.5-0.4-1.2,0-1.7c0.2-0.2,0.5-0.3,0.8-0.3C4.7,11.3,4.9,11.4,5.1,11.6L5.1,11.6z M8.9,11.4c0.2,0.2,0.2,0.5,0,0.8
              c-0.1,0.1-0.3,0.1-0.4,0.1H7.9v-1h0.5C8.6,11.3,8.8,11.3,8.9,11.4L8.9,11.4z M18.5,7H1C0.5,7,0,7.5,0,8V17c0,0.6,0.5,1,1,1h17.4
              c0.6,0,1-0.5,1-1V8C19.5,7.5,19,7,18.5,7L18.5,7z M6.1,13.6c-0.2,0.3-0.4,0.6-0.7,0.7c-0.6,0.4-1.4,0.4-2.1,0
              c-0.3-0.2-0.6-0.4-0.7-0.7c-0.4-0.7-0.4-1.5,0-2.2c0.2-0.3,0.4-0.6,0.7-0.7c0.6-0.4,1.4-0.4,2.1,0c0.3,0.2,0.6,0.4,0.7,0.7
              C6.5,12.1,6.5,12.9,6.1,13.6L6.1,13.6z M9.9,12.4c-0.1,0.2-0.3,0.4-0.5,0.5c-0.3,0.1-0.5,0.2-0.8,0.2H7.9v1.5H7v-4.1h1.6
              c0.3,0,0.6,0,0.8,0.2c0.2,0.1,0.4,0.3,0.5,0.5c0.1,0.2,0.2,0.4,0.2,0.7C10,12,10,12.2,9.9,12.4L9.9,12.4z M13,11.3h-1.5v0.8h1.3v0.8
              h-1.3v0.9H13v0.8h-2.5v-4.1H13L13,11.3z M17.2,14.6h-1L14.6,12v2.5h-1v-4.1h1l1.6,2.5v-2.5h1V14.6z"/>
          </svg>
          Prevádzkový čas:<span>&nbsp; PO-PIA: 6:30 – 15:30</span>
        </a>
        <a href="tel:" title="" class="icon-phone">
          <svg version="1.1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px" viewBox="0 0 18 18" style="enable-background:new 0 0 18 18;" xml:space="preserve">
            <path class="st0" d="M17.8,15.2c-0.5,1.5-2.6,2.9-3.6,2.8C6.8,17,1,11.2,0,3.8c-0.1-1,1.3-3.1,2.8-3.6
              c1.1-0.4,1.8-0.2,2.3,0.7l1.2,2.3c0.3,0.6,0.1,1-0.6,1.5C4.3,5.7,4,6.2,4.7,7.5c1.5,2.3,3.4,4.2,5.7,5.7c1.3,0.7,1.8,0.4,2.9-1
              c0.5-0.7,0.9-0.9,1.5-0.6l2.3,1.2C18.1,13.4,18.2,14.1,17.8,15.2z M12.9,5.2c0.7,0.7,1.1,1.7,1.1,2.6c0,0.5-0.4,0.9-0.9,0.9h0
              c-0.5,0-0.9-0.4-0.9-0.9c0,0,0,0,0,0c0-1.1-0.8-1.9-1.9-2c0,0,0,0,0,0h0c-0.5,0-0.9-0.4-0.8-0.9c0-0.5,0.4-0.8,0.8-0.8
              C11.2,4.1,12.2,4.5,12.9,5.2z M17.6,7.8c0,0.5-0.4,0.9-0.9,0.9l0,0c-0.5,0-0.9-0.4-0.9-0.9c0,0,0,0,0,0c0-3.1-2.5-5.6-5.6-5.6
              c0,0,0,0,0,0h0c-0.5,0-0.9-0.4-0.8-0.9c0-0.5,0.4-0.8,0.8-0.8C14.3,0.4,17.6,3.7,17.6,7.8C17.6,7.8,17.6,7.8,17.6,7.8L17.6,7.8z"/>
          </svg>
          <span>+421 (0) 43 58 93 011</span>
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
