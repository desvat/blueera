<?php
  $show_aside = TRUE;

  echo is_page(16);
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
                    <h4>Kategórie</h4>
                  </div>
                  <div class="widget-menu-list anim-wrapper">
                    <ul>
                      <li class="anim-left-to-right anim-delay-250 <?php if( is_page(324) ) { echo "current-menu-item"; } ?>"><a href="/referencie/hlinikove-konstrukcie-referencie/" title="HLINÍKOVÉ KONŠTRUKCIE" target="_self">HLINÍKOVÉ KONŠTRUKCIE</a></li>
                      <li class="anim-left-to-right anim-delay-500 <?php if( is_page(326) ) { echo "current-menu-item"; } ?>"><a href="/referencie/garazove-brany-referencie/" title="GARÁŽOVÉ BRÁNY" target="_self">GARÁŽOVÉ BRÁNY</a></li>
                      <li class="anim-left-to-right anim-delay-750 <?php if( is_page(328) ) { echo "current-menu-item"; } ?>"><a href="/referencie/prevetrane-fasady-referencie/" title="PREVETRANÉ FASÁDY" target="_self">PREVETRANÉ FASÁDY</a></li>
                      <li class="anim-left-to-right anim-delay-1000 <?php if( is_page(330) ) { echo "current-menu-item"; } ?>"><a href="/referencie/ocelove-konstrukcie-referencie/" title="OCEĽOVÉ KONŠTRUKCIE" target="_self">OCEĽOVÉ KONŠTRUKCIE</a></li>
                    </ul>
                  </div>
                </div>

              </div>
            </aside>
        </selection>
      </div>
    </main>
