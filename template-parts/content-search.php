<?php
/**
 * Template part for displaying results in search pages
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package Digitate
 */

?>
<article  id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
	<?php if( has_post_thumbnail() ) {
        the_post_thumbnail( 'blog-post-thumbnail' );
    } else { ?>
    <img src="<?php bloginfo( 'template_directory' ); ?>/images/noThumb.png" alt="<?php the_title(); ?>">
    <?php } ?>
    <div class="source">
        <div class="excerpt">
            <p><?php the_title(); ?></p>
            <a href="<?php the_permalink(); ?>">more &#62;&#62;</a>
        </div>
        <div class="meta">
            <i class="fa fa-file-text-o" aria-hidden="true"></i> <?php digitate_posted_on(); ?>
        </div>
    </div>
</article><!-- #post-## -->
