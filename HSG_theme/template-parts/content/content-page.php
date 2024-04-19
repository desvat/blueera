<?php
  if( is_page( array(18,425,427,429) ) ) // blogy
  {
    $show_aside = TRUE;
  }
  else
  {
    $show_aside = FALSE;
  }

  // $show_aside = FALSE;
?>
<div id="content-page" class="main-content-page">
  <div class="main-content-wrapper-page row-reverse">
    <main <?php if($show_aside == TRUE) { echo "class=\"main-padding\""; } ?>>
      <div class="main-wrapper-page anim-wrapper">
        <?php
          $id = get_the_ID();
          $post = get_post($id);

          $content_title = apply_filters('the_content', $post->post_title);
          $content_text = apply_filters('the_content', $post->post_content);

          echo "<h3>" . $content_title . "</h3>";
          echo $content_text;
        ?>
      </div>
    </main>
    <aside <?php if($show_aside == FALSE) { echo "style=\"display: none;\""; } ?>>
      <div class="aside-wrapper-page">

        <div class="widget-menu-wrapper">
          <div id="block-9" class="widget-files widget_block">
            <h4>Dokumenty</h4>
          </div>
          <div class="widget-menu-list anim-wrapper">
            <ul>
              <li class="anim-left-to-right anim-delay-250 <?php if( is_page(18) ) { echo "current-menu-item"; } ?>"><a href="/dokumenty/" title="CERTIFIKÁTY" target="_self">CERTIFIKÁTY</a></li>
              <li class="anim-left-to-right anim-delay-500 <?php if( is_page(425) ) { echo "current-menu-item"; } ?>"><a href="/navody/" title="NÁVODY" target="_self">NÁVODY</a></li>
              <li class="anim-left-to-right anim-delay-750 <?php if( is_page(427) ) { echo "current-menu-item"; } ?>"><a href="/katalogy/" title="KATALÓGY" target="_self">KATALÓGY</a></li>
              <li class="anim-left-to-right anim-delay-1000 <?php if( is_page(429) ) { echo "current-menu-item"; } ?>"><a href="/ostatne-dokumenty/" title="OSTATNÉ DOKUMENTY" target="_self">OSTATNÉ DOKUMENTY</a></li>
            </ul>
          </div>
        </div>

      </div>
    </aside>
  </div>
</div>