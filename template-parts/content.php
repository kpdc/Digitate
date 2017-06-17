<?php
/**
 * Template part for displaying posts
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package Digitate
 */

?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
    
    <?php if(is_home() || is_tax('resource-tag') || is_tag()) { ?>
    <a href="<?php the_permalink(); ?>">
        <?php if( has_post_thumbnail() ) {
            the_post_thumbnail( 'blog-post-thumbnail' );
        } else { ?>
        <img src="<?php bloginfo( 'template_directory' ); ?>/images/noThumb.png" alt="<?php the_title(); ?>">
        <?php } ?>
        <div class="source">
            <div class="excerpt">
                <p><?php the_title(); ?></p>
            </div>
        </div>
    </a>
    
    <?php } elseif(is_tax('newsroom-tag')) { ?>
        <div class="event-date newsImg">
            <?php the_post_thumbnail(); ?>
            <p class="media">
                <span></span>
                <?php the_field('name_of_media'); ?>
            </p>
            <cite class="media-author"><?php the_field('author_of_media'); ?></cite>
            <?php  ?>
        </div>
        <div class="event-info">
            <div class="info-details">
                <h3>
                    <?php if(get_field( 'media_link' )) : ?>
                    <a href="<?php the_field('media_link'); ?>">
                        <?php the_title(); ?>
                    </a>
                    <?php endif; ?>
                    <cite><?php the_field('date_of_media_publish'); ?></cite>
                </h3>
                <?php the_content();
                if(get_field( 'media_link' )) : ?>
                <div class="external-link">
                    <a href="<?php the_field('media_link'); ?>">Read more</a>
                </div>
                <?php endif; ?>
            </div>
        </div>
    
    <?php } elseif(is_tax('event-group')) { ?>
        <div class="event-date">
            <?php
            $date = get_field('date', false, false);
            $date = new DateTime($date);
            ?>
            <span class="month"><?php echo $date->format('M'); ?></span>
            <span class="date"><?php echo $date->format('j'); ?></span>
            <span class="day"><?php echo $date->format('D'); ?></span>
        </div>
        <div class="event-info">
            <div class="info-details">
                <h3>
                    <?php
                    if(get_field( 'external_link' )) { ?>
                        <a href="<?php the_field('external_link'); ?>"><?php the_title(); ?></a>
                    <?php } elseif(get_field( 'webinar_video_link' )) { ?>
                        <a href="<?php the_field('webinar_video_link'); ?>"><?php the_title(); ?></a>
                    <?php } else { ?>
                        <?php the_title(); ?>
                    <?php } ?>
                    <?php
                    if(has_term( array('events', 'webinars'), 'event-group' )) {
                        if(get_field( 'venue' )) { ?>
                            <cite class="location">
                                <?php the_field('venue'); ?>
                            </cite>
                        <?php } elseif(get_field( 'webinar_time' )) { ?>
                            <cite class="location">
                                <?php echo 'Webinar Time: '; the_field('webinar_time'); ?>
                            </cite>
                        <?php } ?>
                    <?php } ?>
                </h3>
                <?php the_content();
                if(get_field( 'external_link' )) { ?>
                    <div class="external-link">
                        <a href="<?php the_field('external_link'); ?>">Learn more</a>
                    </div>
                    <?php } elseif(get_field( 'webinar_video_link' )) { ?>
                    <div class="external-link">
                        <a href="<?php the_field('webinar_video_link'); ?>">Watch now</a>
                    </div>
                <?php } ?>
            </div>
        </div>
    
    <?php } else { ?>
        
        <header class="entry-header">
            <?php
            if ( is_single() ) :
                    the_title( '<h1 class="entry-title">', '</h1>' );
            else :
                    the_title( '<h2 class="entry-title"><a href="' . esc_url( get_permalink() ) . '" rel="bookmark">', '</a></h2>' );
            endif;

            if ( 'post' === get_post_type() ) : ?>
            <div class="entry-meta">
                    <?php digitate_posted_on(); ?>
            </div><!-- .entry-meta -->
            <?php
            endif; ?>
	</header><!-- .entry-header -->

	<div class="entry-content">
            <?php
                the_content( sprintf(
                    /* translators: %s: Name of current post. */
                    wp_kses( __( 'Continue reading %s <span class="meta-nav">&rarr;</span>', 'digitate' ), array( 'span' => array( 'class' => array() ) ) ),
                    the_title( '<span class="screen-reader-text">"', '"</span>', false )
                ) );

                wp_link_pages( array(
                    'before' => '<div class="page-links">' . esc_html__( 'Pages:', 'digitate' ),
                    'after'  => '</div>',
                ) );
            ?>
	</div><!-- .entry-content -->

	<footer class="entry-footer">
            <?php digitate_entry_footer(); ?>
	</footer><!-- .entry-footer -->
        
    <?php } ?>
   
</article><!-- #post-## -->