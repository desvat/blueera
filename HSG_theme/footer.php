  <?php
  global $post;
  $post_slug = $post->post_name;

  if ( get_post_type() == 'page' && $post_slug == 'kontakt' || is_page( 7 ))
  {
    $contact_form = TRUE;
  }
  ?>
    <footer <?php if($contact_form == TRUE) { echo "class=\"contact-form\""; } else { echo "class=\"after\""; } ?>>
      <h2>footer</h2>

      <div class="footer-wrapper">
        <div id="footer-items">
          <div class="footer-adress">
            <div class="footer-adress-logo">
              <a href="<?php echo home_url() ?>" title="Úvod" target="_self">
                <svg version="1.1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px" viewBox="0 0 330 149" style="enable-background:new 0 0 330 149;" xml:space="preserve">
                  <path class="HSG-logo" d="M314.9,149H15.1C6.8,149,0,142.2,0,133.9V15.1C0,6.8,6.8,0,15.1,0h299.8c8.3,0,15.1,6.8,15.1,15.1v118.8
                    C330,142.2,323.2,149,314.9,149z M15.1,12.9c-1.2,0-2.2,1-2.2,2.2v118.8c0,1.2,1,2.2,2.2,2.2h299.8c1.2,0,2.2-1,2.2-2.2V15.1
                    c0-1.2-1-2.2-2.2-2.2H15.1z M89.5,123.5v-41H51.2v41H27.5V25.6h23.7v37.1h38.2V25.6h23.7v97.9H89.5z M185.2,51c-2-2.6-4.7-4.6-8-6.2
                    c-3.3-1.5-6.4-2.3-9.5-2.3c-1.6,0-3.2,0.1-4.8,0.4c-1.6,0.3-3.1,0.8-4.4,1.6c-1.3,0.8-2.4,1.8-3.3,3c-0.9,1.2-1.3,2.8-1.3,4.8
                    c0,1.7,0.3,3,1,4.2c0.7,1.1,1.7,2.1,3,2.9c1.3,0.8,2.9,1.6,4.8,2.3c1.8,0.7,3.9,1.4,6.2,2.1c3.3,1.1,6.8,2.3,10.4,3.7
                    c3.6,1.3,6.9,3.1,9.8,5.3c3,2.2,5.4,5,7.3,8.2c1.9,3.3,2.9,7.4,2.9,12.2c0,5.6-1,10.5-3.1,14.6c-2.1,4.1-4.9,7.5-8.4,10.2
                    c-3.5,2.7-7.5,4.7-12.1,5.9c-4.5,1.3-9.2,1.9-14,1.9c-7,0-13.8-1.2-20.4-3.7c-6.6-2.4-12-5.9-16.4-10.4l15.5-15.8
                    c2.4,3,5.6,5.4,9.5,7.4c3.9,2,7.8,3,11.7,3c1.8,0,3.5-0.2,5.1-0.6c1.7-0.4,3.1-1,4.4-1.8c1.2-0.8,2.2-1.9,3-3.3c0.7-1.4,1.1-3,1.1-5
                    c0-1.8-0.5-3.4-1.4-4.7c-0.9-1.3-2.2-2.5-4-3.5c-1.7-1.1-3.8-2-6.4-2.9c-2.5-0.9-5.4-1.8-8.7-2.8c-3.1-1-6.2-2.2-9.2-3.6
                    c-3-1.4-5.7-3.2-8-5.3c-2.4-2.2-4.3-4.8-5.7-7.9c-1.4-3.1-2.1-6.8-2.1-11.3c0-5.4,1.1-10.1,3.3-14c2.2-3.9,5.1-7.1,8.7-9.5
                    c3.6-2.5,7.7-4.3,12.2-5.5c4.5-1.2,9.1-1.7,13.7-1.7c5.5,0,11.2,1,17,3s10.8,5,15.2,9L185.2,51z M285.6,123.7
                    c-6.4,1.6-13.4,2.4-21,2.4c-7.9,0-15.1-1.2-21.7-3.7c-6.6-2.5-12.3-6-17-10.5c-4.8-4.5-8.5-9.9-11.2-16.3c-2.7-6.3-4-13.3-4-21.1
                    c0-7.8,1.4-14.9,4.1-21.3c2.7-6.4,6.5-11.8,11.3-16.3c4.8-4.5,10.4-7.9,16.9-10.3c6.5-2.4,13.4-3.6,20.9-3.6c7.8,0,15,1.2,21.6,3.5
                    c6.7,2.4,12.1,5.5,16.2,9.5l-15,17c-2.3-2.7-5.4-4.9-9.1-6.6c-3.8-1.7-8.1-2.6-12.9-2.6c-4.2,0-8,0.8-11.5,2.3
                    c-3.5,1.5-6.6,3.6-9.1,6.4c-2.6,2.7-4.6,5.9-6,9.7c-1.4,3.7-2.1,7.8-2.1,12.2c0,4.5,0.6,8.7,1.9,12.4c1.3,3.8,3.2,7,5.8,9.8
                    c2.5,2.7,5.7,4.8,9.4,6.4c3.7,1.5,8,2.3,12.8,2.3c2.8,0,5.4-0.2,7.9-0.6c2.5-0.4,4.8-1.1,6.9-2V84.8H262V65.7h40.5v51.9
                    C297.7,120.1,292.1,122.1,285.6,123.7z"/>
                </svg>
              </a>
            </div>
            <div class="footer-adress-items">
              <div>
                <h4>Adresa</h4>
                <p>HSG, s.r.o.</p>
                <p>Oravský Podzámok 138</p>
                <p>027 41</p>
              </div>
              <div>
                <h4>Kontakty</h4>
                <p><a href="tel:+421(0)435893011" title="Zavolajte nám">+421 (0)43 58 93 011</a></p>
                <p><a href="mailto:info@hsg.sk" title="Napíšte nám">info@hsg.sk</a></p>
              </div>
              <div>
                <h4>Otváracie hodiny</h4>
                <p>6:30 - 15:30</p>
              </div>
            </div>
          </div>
          <div class="footer-nav">
            <?php wp_nav_menu( array('theme_location' => 'footer-menu') ); ?>
          </div>
        </div>
        <div id="footer-breadcrumb" style="display: none;">
          <?php get_breadcrumb(); ?>
        </div>
        <div id="footer-copyright">
          <div class="social-links">
            <?php wp_nav_menu( array('theme_location' => 'social-menu') ); ?>
          </div>
          <div class="copyright">
            <a href="./index.php" title="Úvod" target="_self">© 2022 HSG.sk</a>
          </div>
          <div class="created-by">
            <span>Created by</span>
            <a href="https://www.jakubca.com?url=mahhu.sk" title="Túto stránku vytvoril Adrián Jakubča." target="_blank">
              <svg version="1.1" class="jakubca-logo" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px" viewBox="0 0 350 350" style="enable-background:new 0 0 350 350;" xml:space="preserve">
                <path class="logo-bg" d="M166.9,130.4c5.2-22,10.8-43.3,15.6-58.5l0,0l0,0l1-3.5l1.2,9.5l2,16.1l2.7,20.3l2.9,22l1.8,14.1
                  c0.7,5.6,1.4,11,2,16.4l0.2,1.7l-0.3,0.2l-0.1,0.1l-0.1,0.1l-0.3,0.2l-0.4,0.3c-0.6,0.4-1.9,1.4-5.4,4.2l-2,1.6l-0.7,0.6l0,0l0,0
                  l-1.2,1l-1.2,0.8l-0.2,0.1l-0.2,0.2c-9.1,7.6-19.1,16.2-29.8,25.8c-1.4,1.3-2.8,2.6-4.2,3.8c0.7-3.7,1.4-7.4,2.2-11.3
                  c0.4-2.3,0.8-4.1,1.3-6c0.2-0.7,0.3-1.4,0.5-2.2c1.1-4.7,2.3-10.3,3.6-16.2C160.4,159.2,163.5,145,166.9,130.4z M125.4,264.2
                  c-0.1,0.1-0.2,0.2-0.3,0.3c-2.7,2.7-4.5,4.4-6,5.9c-1.2,1.2-2.3,2.2-3.6,3.5l0,0l0,0l-0.4,0.4c-2.6,2.7-5.3,5.4-8,8.5l0,0l-4.2,4.7
                  c-7.3,8.2-13.6,15.4-20,22.9l-4.6,5.4h40.5c0.1-0.7,0.2-1.4,0.2-2.1C120.5,299.2,123.1,280.5,125.4,264.2z M49.2,313.1
                  c1.7-2.3,3.5-4.6,5.3-6.8c1.1-1.3,2.1-2.7,3.2-4l0,0l0,0c6.4-7.8,14-17.1,22.3-26.4c1.9-2.2,4.2-4.6,6.4-6.9
                  c1.1-1.1,2.2-2.3,3.2-3.3c3-3.2,5.8-6.1,8.2-8.7l1.4-1.5l0,0l0,0c2.5-2.6,5-4.9,7.2-7c6.4-6.5,9.7-9.5,10.7-10.3
                  c2.1-2.1,4.1-3.9,5.6-5.2c0.1-0.1,0.1-0.1,0.2-0.2c1.2-7.8,3.2-20,6.2-36.2c0.2-0.8,0.3-1.7,0.5-2.5c0.4-2.2,0.8-4.4,1.2-6.7
                  l0.2-1.8v-0.2v-0.2c0.4-2.3,0.9-4.5,1.3-6.8c1-5.2,2.1-10.6,3.2-15.9c0.5-2.9,1.2-6.2,2-9.8c3.7-18.3,7.4-34.5,11.4-49.4
                  c1.3-5,3.3-12.5,3.9-14.3c0.6-1.9,1.4-4.4,2.3-7.3c3.1-10.1,7.4-24,10.1-31.7c0.9-2.4,1.9-5.5,3.1-9.2l1-3l1-3.1l0,0l0,0l0,0H49.7
                  c-8.7,0-15.7,7-15.7,15.7v250.3c0,7.9,5.8,14.3,13.3,15.5L49.2,313.1z M142.9,247.5c-3.7,21.3-7,41.6-10.2,63.7
                  c-0.3,2.2-0.5,3.6-0.7,4.7h78.8c-0.5-4.7-0.9-9.9-1.3-16l-0.4-6.5l-0.2-1.7l-0.2-2.6l-0.5-5.4c-0.1-1.4-0.2-2.5-0.3-3.4l-0.2-2.3
                  l-0.1-1.7c-0.7-7.6-1.4-16.2-1.9-22.1c-0.5-6.6-0.7-9.2-0.2-10.8l-0.2-1.9l-0.9-7.5c-1.5-12.9-3-25.7-4.4-37.2
                  c-0.7,0.6-1.5,1.3-2.4,2.1l-17.4,14.9c-7.6,6.7-19.2,16.7-34,30.7C144.9,245.6,143.9,246.6,142.9,247.5z M315.7,102.8
                  c-8.6,6-17.7,12.3-27.4,19.2c0.2,1.1,0.2,2.9-1.6,4.7c-1.5,1.4-5.7,4.6-15.8,12.4c-3.4,2.6-7.4,5.7-11.9,9.1c-10.5,8-26,20-38.3,30
                  l0.1,0.8l0.4,3.1c0.9,5.5,2.2,16.7,2.9,24.4c3.6,36.7,7,72.7,10,108.9v0.4H300c8.7,0,15.7-7,15.7-15.7V102.8z M300,34.1h-97.8
                  c0.1,0.3,0.1,0.5,0.2,0.8l0,0l0,0l0.3,1.7v0.1v0.1l0.2,1.6l0.4,3.2l1.4,10.8l1.9,14.6c1.5,11.3,3,22.8,4.4,33.8
                  c0.7,5.6,1.4,11.3,2.2,16.9l0,0l0,0l3.4,28.4l0.7,6.3c0.9-0.6,1.6-1.2,2.3-1.7l0,0l0,0l0.1-0.1l0.7-0.5c2.5-1.9,3.6-2.6,4.2-3
                  c1-0.7,2.1-1.6,3.2-2.4c2.6-1.9,5.1-3.8,6.3-4.6c1.8-1.2,3.1-2.1,4.4-2.9c1.4-0.9,2.8-1.7,4.9-3.2c1.5-1,3.8-2.7,6.3-4.4
                  c6.1-4.3,8.9-6.3,10.2-6.9l2.3-1.1l3.5-2.5l6.8-4.8l2.5-1.8c5.3-3.8,11.4-8.1,14-9.7c11.1-7.8,18.6-12.8,21-14.2
                  c0.5-0.3,1.5-0.8,2.8-0.8l2.8-1.8V49.9C315.7,41.2,308.7,34.1,300,34.1z M252.3,102.8c-0.1,0.4-0.2,0.8-0.3,1.2
                  c-0.7,3.1-1.7,7.9-6.8,8.9c-0.6,0.1-1.2,0.2-1.7,0.2c-4.4,0-6.6-3.7-8.2-6.3l-0.4-0.6c-3.7-5.9-4.2-12.4-1.5-19.2l0.9-2.1l2.1,0.9
                  c1.1,0.4,2.2,0.9,3.3,1.3c2.6,1,5,1.9,7.3,3.1c2.1,1.1,3.9,3.2,4.7,5.2C252.6,97.6,252.8,100.5,252.3,102.8z"></path>
                <path class="logo-aj" d="M349.6,73.5c-1.2,0.5-8.9,5.6-15.1,9.6c-14.1,9-57.1,39.7-30.7,19.8c2.7-2.3,13.9-10,20.7-14.8
                  c4.9-3.5,9.6-6.8,10.1-7.3c0.4-0.5-1.5,0.6-2.4,1c2.2-1.9-7.4,4.4-9.3,5.3c-4.7,3.2-8.9,6-13.3,8.9c-0.4,0.2-0.8,0.4-0.9,0.4
                  c3.1-2.5,5.5-4.4,3.8-3.4s-7.5,4.8-20.7,14c-2.8,1.7-10.7,7.3-16.4,11.4c-4.6,3.3-8.8,6.2-12.7,8.9c-0.3,0.2-0.6,0.4-0.7,0.4
                  c-6.6,4.6-6.6,4.6,0.1-0.5c-1.6,0.8-11.9,8.3-15.9,11c-4.1,2.8-5.5,3.5-9.3,6.1c-1.7,1.1-6.3,4.6-9.6,7l0,0
                  c-0.4,0.2-1.8,1.2-3.9,2.8c-0.3,0.2-0.5,0.4-0.8,0.6c-2.6,2-5.5,4.2-8.7,6.6c-0.6-4.8-1.1-9.6-1.7-14.4c-1.1-9.5-2.3-19.3-3.4-28.4
                  c-2.2-17-4.3-33.8-6.6-50.8c-1.1-8.5-2.2-16.9-3.4-25.4l-0.4-3.2l-0.2-1.6l-0.3-1.7c-0.4-2.2-0.9-4.5-1.8-7.1
                  c-0.5-1.3-1-2.6-2.2-4.2c-0.3-0.4-0.6-0.8-1.1-1.2c-0.2-0.2-0.5-0.4-0.7-0.6c-0.3-0.2-0.6-0.4-0.9-0.6c-0.6-0.4-1.4-0.7-2.1-0.9
                  c-0.8-0.2-1.6-0.3-2.3-0.2c-0.8,0.1-1.5,0.2-2.2,0.4c-0.7,0.2-1.3,0.5-1.8,0.8c-0.3,0.2-0.5,0.3-0.7,0.5l-0.6,0.5
                  c-0.4,0.3-0.7,0.7-1,1c-1.2,1.3-1.9,2.6-2.5,3.8c-1.4,2.8-2.2,5.3-3,7.6c-0.7,2.2-1.4,4.2-2,6.1c-1.2,3.8-2.3,6.9-3.2,9.4
                  c-3.5,9.8-9.8,30.7-12.3,38.9c-0.5,1.5-2.5,8.9-3.8,14.1c-4.4,16.7-8.1,33.3-11.3,49.2c-0.8,3.6-1.5,6.9-2,9.8
                  c-1.6,7.5-3,15.1-4.5,22.7c-0.1,0.8-0.2,1.3-0.3,2c-0.6,3.1-1.2,6.3-1.7,9.3c-3,15.9-5,28.6-6.4,37.6c-0.5,0.4-0.9,0.9-1.4,1.3
                  c-1.2,1.1-3.1,2.8-5.6,5.3c-1.6,1.4-5.2,4.7-10.6,10.2c-1.9,1.8-4.3,4.1-7.2,7c-2.8,2.9-6,6.2-9.6,10.1c-3.2,3.4-6.8,7.1-9.5,10.2
                  c-7.8,8.7-15,17.5-22.2,26.3c-2.8,3.6-5.7,7.2-8.4,10.8h19.3c0.7-0.9,1.5-1.8,2.2-2.6c1.7-1.9,3.3-3.9,4.9-5.7
                  c7.6-9,15.2-17.4,24.3-27.7l-0.3,0.4c3-3.4,6-6.5,8.8-9.4l0,0c3.1-3.1,4.9-4.7,9.7-9.4c4.1-4.1,7.1-7.1,10-9.7
                  c-0.2,1.3-0.3,2.6-0.5,3.7c-2.5,17.7-5.8,41.5-7.8,59.1c-1.1,8.8-1.7,16-2,20s-0.1,4.9,0.8,1.1c0.5-3.7,0.9-7.5,1.4-11.2
                  s1-7.4,1.5-11.1c0.4-2.9,0.8-5.1,1.1-7.5c-0.5,3.7-1,7.5-1.4,11.2c-0.6,4.7-0.9,7.5-0.7,6.6c0.2-0.6,0.5-2.2,0.8-4.6
                  c1.4-10,2.7-20.1,4.2-30.4c1.5-10.3,3-20.8,4.5-31.4v0.4c0.5-3,1-6,1.5-9.1c0.1-0.1,0.2-0.2,0.3-0.2c-1.1,7.2-2.1,14.2-3,21
                  c-0.8,5.7-1.6,11.5-2.3,17.2c-0.7,5.8-1.5,11.5-2.2,17.2c-0.1,0.7-0.2,2-0.4,3.5l0.4-3.5c-0.9,6.7-1.8,13.4-2.6,20.1
                  c-0.8,6.7-1.5,13.3-2.3,19.9c-0.5,4.9-0.6,6.5,0,3.1c0.8-5.1,1.7-12.8,2.6-20.5c1.4-10.8,1.4-7.6,2.5-15.7
                  c3.3-22.7,6.6-43.3,10.5-65.3c1.3-1.2,2.7-2.6,4.3-4c14.5-13.7,25.8-23.5,34.2-30.8c8.4-7.2,14-12,17.4-14.9c6.9-6,5.4-5.1,2.4-3.4
                  l0.1-0.1c1.7-1.5,3.9-3.3,6.3-5.3c2,16,3.8,31.3,5.6,46.9c0.4,3.8,0.8,7.3,1.3,10.9c0.7,8-0.3-1.2-0.1,0.9c-0.8-3.2,0.3,10.6,2,30.6
                  c0.1,1.3,0.2,2.6,0.3,4c0.1,0.9,0.1,2,0.3,3.3c0.2,2.7,0.5,5.4,0.7,8.1c0.3,3.1,0.6,5.8,0.8,8.2c-0.1,0.1-0.1,0.1-0.2,0.1
                  c0.5,7.2,0.9,12.3,1.3,16.4h1.2c0-0.1,0-0.3,0-0.4c0,0.1,0,0.3,0,0.4h12.7c-2.9-36.3-6.4-72.6-10-108.8c-0.8-7.8-2.1-18.8-2.9-24.2
                  c-0.3-2.2-0.5-4.3-0.8-6.5c12.2-10,27.9-22.1,40.4-31.7c16.3-12.5,25.6-19.5,27.4-21.2s-3.9,1.8-17.2,11c-13.4,9.3-13.7,9-8,4.2
                  c3.4-3,5-4.3,12.5-9.7c4.5-3.3,9.1-6.5,13.5-9.7c22.6-15.9,43.1-30.2,63.4-44.2C349.3,73.9,349.9,73.3,349.6,73.5z M200.1,171.7
                  c-0.4,0.3-0.9,0.6-1.3,0.9c-0.2,0.2-0.5,0.4-0.8,0.6c-0.8,0.5-2.6,2-5.3,4.1c-0.9,0.7-1.8,1.4-2.8,2.2c-0.5,0.4-1,0.8-1.4,1.2
                  c-0.4,0.3-0.9,0.6-1.4,0.9c-10.1,8.4-20.2,17.2-29.7,25.7c-4.9,4.5-9.7,8.7-14.4,13c1.5-7.9,3-16.2,4.7-24.9
                  c0.6-3.2,1.2-5.6,1.8-8.3c3.3-14.6,7.7-36,12.8-57.7c5.1-21.6,10.9-43.4,15.7-58.8c1.4-4.5,2.7-9.1,4.1-13.6c1.1-3.5,2.2-7,3.3-10.5
                  l0.5,4.2c0.6,4.7,1.2,9.5,1.8,14.3c1.2,9.5,2.4,19.1,3.6,28.6c2.1,16,3.7,28,5.6,42.3c0.6,4.7,1.2,9.5,1.8,14.1
                  c0.9,7.2,1.7,14.1,2.6,20.8L200.1,171.7z M237.1,90.8c-1.3,4.6-0.7,8.9,1.8,12.9l0.4,0.6c1.6,2.6,2.6,4.1,4.3,4.1
                  c0.2,0,0.5,0,0.8-0.1c1.9-0.4,2.5-2,3.2-5.4c0.1-0.4,0.2-0.8,0.3-1.2c0.3-1.5,0.2-3.4-0.4-5c-0.4-1-1.4-2.1-2.5-2.7
                  c-2.1-1.1-4.4-1.9-6.8-2.8C237.8,91.1,237.4,90.9,237.1,90.8z"></path>
              </svg>
            </a>
          </div>
        </div>
      </div>

    </footer>

    <button onclick="topFunction()" id="scrollUP" title="Go to top">
      <svg version="1.1" id="Layer_1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px" viewBox="0 0 20 13" style="enable-background:new 0 0 20 13;" xml:space="preserve">
      <polygon class="arrow-up-1" points="7,1.4 7.9,0 12.1,0 20,12.2 18.7,13 11.2,1.4 7,1.4 "/>
      <polygon class="arrow-up-2" points="6.1,2.9 0,12.2 1.3,13 7.9,2.9 "/>
      </svg>
    </button>

    <script>
      //Get the button
      var mybutton = document.getElementById("scrollUP");
      // When the user scrolls down 20px from the top of the document, show the button
      window.onscroll = function() {scrollFunction()};

      function scrollFunction() {
        if (document.body.scrollTop > 20 || document.documentElement.scrollTop > 20) {
          mybutton.style.display = "flex";
        } else {
          mybutton.style.display = "none";
        }
      }

      // When the user clicks on the button, scroll to the top of the document
      function topFunction() {
        document.body.scrollTop = 0;
        document.documentElement.scrollTop = 0;
      }


        function reveal() {
          var reveals = document.querySelectorAll(".anim-wrapper");

          for (var i = 0; i < reveals.length; i++) {
            var windowHeight = window.innerHeight;
            var elementTop = reveals[i].getBoundingClientRect().top;
            var elementVisible = 100;

            if (elementTop < windowHeight - elementVisible) {
              reveals[i].classList.add("anim-active");
              reveals[i].style.opacity = "1";
            } else {
              reveals[i].classList.remove("anim-active");
              reveals[i].style.opacity = "0";
            }
          }
        }

        window.addEventListener("load", reveal);
        window.addEventListener("scroll", reveal);

    </script>

    <?php wp_footer(); ?>

  </body>
</html>