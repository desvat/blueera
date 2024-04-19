<?php

/**
 * The HSG template file
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package HSG
 */

  get_header();

  get_template_part( 'template-parts/top-nav' );
?>

<?php

  global $post;
  $post_slug = $post->post_name;

  if ( is_front_page() )
  {
    get_template_part( 'template-parts/headers/header-index' );
    // get_template_part( 'template-parts/content/content-index' );
  }
  elseif ( get_post_type() == 'blogs' )
  {
    get_template_part( 'template-parts/headers/header-small' );
    get_template_part( 'template-parts/content/content-blog' );
  }
  elseif ( get_post_type() == 'page' )
  {
    if( is_page( 7 ) )
    {
      get_template_part( 'template-parts/headers/header-home' );
      get_template_part( 'template-parts/content/content-home' );
    }
    elseif ( $post_slug == 'referencie' )
    {
      get_template_part( 'template-parts/headers/header-small' );
      get_template_part( 'template-parts/content/content-references' );
    }
    elseif ( $post_slug == 'hlinikove-konstrukcie-referencie' || $post_slug == 'garazove-brany-referencie' || $post_slug == 'prevetrane-fasady-referencie' || $post_slug == 'ocelove-konstrukcie-referencie')
    {
      get_template_part( 'template-parts/headers/header-small' );
      get_template_part( 'template-parts/content/content-references' );
    }
    elseif ( $post_slug == 'blogy' )
    {
      get_template_part( 'template-parts/headers/header-small' );
      get_template_part( 'template-parts/content/content-blogs' );
    }
    elseif ( $post_slug == 'kontakt' )
    {
      get_template_part( 'template-parts/headers/header-kontakt' );
      get_template_part( 'template-parts/content/content-kontakt' );
    }
    else
    {
      get_template_part( 'template-parts/headers/header-default' );
      get_template_part( 'template-parts/content/content-default' );
    }
  }
  else
  {
    get_template_part( 'template-parts/headers/header-default' );
    get_template_part( 'template-parts/content/content-default' );
  }

?>

<?php get_footer(); ?>
