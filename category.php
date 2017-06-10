<?php get_header(); ?>

    <?php if(is_category('analyst-speak') && is_category('media') && is_category('press-releases') ) { ?>

    <div class="content-area">
        <main>
            <?php if(have_posts()) : ?>
            <header>
                <?php echo '<h2 class="page-title">';single_cat_title();echo '</h2>'; ?>
                <div class="news-filter">
                    <nav>
                        <?php wp_nav_menu(array(
                            'theme_location' => 'newsfilter',
                            'container' => '',
                        ))?>
                    </nav>
                </div>
            </header>
            <section class="event">
                <?php while(have_posts()) : the_post(); ?>
                <article>
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
                                <?php the_title(); ?>
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
                </article>
                <?php endwhile; ?>
            </section>
            <?php digitate_paging_nav(); ?>
            <?php endif;?>
        </main>
    </div>
    <?php } ?>

<?php get_footer(); ?>