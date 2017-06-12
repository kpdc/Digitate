<?php get_header();?>
    <div class="content-area">
        <main>
            <?php
            $paged = (get_query_var('paged')) ? get_query_var('paged') : 1;
             $resources_group = new WP_Query(array(
                'post_type' => 'resources',
                'posts_per_page' => 2,
                'paged' => $paged,
            ));
            if($resources_group->have_posts()) : 
            ?>
            <header>
                <h2 class="page-title">Resources</h2>
                <nav class="resource-nav">
                    <?php
                        wp_nav_menu(array(
                            'theme_location' => 'resourcenav',
                            'container' => '',
                        ));
                    ?>
                </nav>
            </header>
            <div class="blogpost">
                <?php   /* Start the Loop */
                while ( $resources_group->have_posts() ) : $resources_group->the_post(); ?>
                <article>
                    <a href="<?php the_permalink(); ?>">
                        <?php
                        if( has_post_thumbnail() ) {
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
                </article>
                <?php endwhile; wp_reset_postdata();
                
                else :

                get_template_part( 'template-parts/content', 'none' );
                
                endif ?>
            </div>
            
            <?php digitate_custom_pagination($resources_group->max_num_pages,"",$paged); ?>
        
        </main>
    </div>
<?php get_footer(); ?>