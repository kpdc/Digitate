<?php get_header(); ?>

    <div class="content-area">
        <main>
            <header class="page-header">
                <h2 class="page-title">Events</h2>
                <nav class="event-filter">
                    <?php
                        wp_nav_menu(array(
                            'theme_location' => 'eventfilter',
                            'container' => '',
                        ));
                    ?>
                </nav>
            </header>
            <?php
            $paged = (get_query_var('paged')) ? get_query_var('paged') : 1;
            $event_post = new WP_Query(array(
                'post_type' => 'events',
                'posts_per_page' => 12,
                'paged' => $paged,
            )); ?>
            <section class="event">
                <?php if( $event_post->have_posts() ) : while( $event_post->have_posts() ) : $event_post->the_post(); ?>
                <article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
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
                                <?php } ?>
                                <?php
                                if(is_category( 'events' )) {
                                    if(get_field( 'venue' )) : ?>
                                    <cite class="location">
                                        <?php the_field('venue'); ?>
                                    </cite>
                                    <?php endif;
                                } else {
                                    if(is_category( 'webinars' )) {
                                        if(get_field( 'webinar_time' )) : ?>
                                        <cite class="location">
                                            <?php echo 'Webinar Time: '; the_field('webinar_time'); ?>
                                        </cite>
                                        <?php endif;
                                    } ?>
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
                </article>
                <?php endwhile; endif; wp_reset_postdata(); ?>
                <?php digitate_custom_pagination($event_post->max_num_pages,"",$paged); ?>
            </section>
        </main>
    </div>

<?php get_footer(); ?>