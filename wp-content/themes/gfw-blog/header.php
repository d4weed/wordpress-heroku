<?php
/**
 * The Header for our theme.
 *
 * Displays all of the <head> section and everything up till <div id="content">
 *
 * @package GFW blog
 */
?><!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
<meta charset="<?php bloginfo( 'charset' ); ?>">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title><?php wp_title( '|', true, 'right' ); ?></title>
<link rel="profile" href="http://gmpg.org/xfn/11">
<link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>">

<?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>
<div id="page" class="hfeed site">
  <?php do_action( 'before' ); ?>
  <?php $image = wp_get_attachment_image_src( get_post_thumbnail_id( $post->ID ), 'single-post-thumbnail' ); ?>
  <header id="masthead" role="banner" <?php if (is_single() && in_category( 'News roundups' )) : ?>class="site-header news-header"<?php elseif (is_single()) : ?>style="background-image: url('<?php echo $image[0]; ?>'); -webkit-background-size: cover; -moz-background-size: cover; -o-background-size: cover; background-size: cover;" class="site-header"<?php else : ?>class="site-header"<?php endif; ?>>
    <div class="header-inner">
      <nav id="site-navigation" class="main-navigation" role="navigation">
        <a href="<?php echo esc_url( home_url( '/' ) ); ?>" title="Home" class="logo">Blog</a>

        <?php wp_nav_menu( array( 'theme_location' => 'primary' ) ); ?>
      </nav><!-- #site-navigation -->

      <?php if (is_single()) : ?>
        <div class="site-branding">
          <p class="post-description"><?php gfw_blog_posted_on(); ?></p>
          <div class="site-branding-sep"></div>
          <h1 class="post-title"><a href="<?php the_permalink(); ?>" rel="home"><?php the_title(); ?></a></h1>
          <div class="site-branding-sep"></div>

          <div class="entry-meta">
            <?php
              /* translators: used between list items, there is a space after the comma */
              $category_list = get_the_category_list( __( ', ', 'gfw-blog' ) );

              /* translators: used between list items, there is a space after the comma */
              $tag_list = get_the_tag_list( '', __( ', ', 'gfw-blog' ) );

              if ( ! gfw_blog_categorized_blog() ) {
                // This blog only has 1 category so we just need to worry about tags in the meta text
                if ( '' != $tag_list ) {
                  $meta_text = __( '<span class="cat-links">%2$s</span><span class="sep"><span>·</span></span>', 'gfw-blog' );
                }

              } else {
                // But this blog has loads of categories so we should probably display them here
                if ( '' != $tag_list ) {
                  $meta_text = __( '<span class="cat-links">%1$s</span><span class="sep"><span>·</span></span><span class="tags-links">%2$s</span>', 'gfw-blog' );
                } else {
                  $meta_text = __( '<span class="cat-links">%1$s</span>', 'gfw-blog' );
                }

              } // end check for categories on this blog

              printf(
                $meta_text,
                $category_list,
                $tag_list
              );
            ?>

            <?php edit_post_link( __( 'Edit', 'gfw-blog' ), '<span class="sep"><span>·</span></span><span class="edit-link">', '</span>' ); ?>
          </div><!-- .entry-meta -->
        </div>
      <?php else : ?>
        <div class="site-branding">
          <div class="site-branding-sep top"></div>
          <h1 class="site-title"><a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home"><?php bloginfo( 'name' ); ?></a></h1>
          <p class="site-description"><?php bloginfo( 'description' ); ?></p>
          <div class="site-branding-sep"></div>
        </div>
      <?php endif; ?>
    </div><!-- .header-inner -->

    <?php if (is_single() && in_category( 'News roundups' )) : ?>
      <div class="badge badge-news"><i></i>News roundups</div>
    <?php elseif (is_single() && in_category( 'Feature stories' )) : ?>
      <div class="badge badge-feature"><i></i>Feature stories</div>
    <?php elseif (is_single()) : ?>
      <div class="badge badge-updates"><i></i>Updates</div>
    <?php else : ?>
      <div class="badge">
      </div>
    <?php endif; ?>
  </header><!-- #masthead -->

  <div id="content" class="site-content">