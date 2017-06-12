<?php
/**
 * The template for displaying archive pages
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package digitate
 */

get_header(); ?>

    <div id="primary" class="content-area">
        <main id="main" class="site-main" role="main">

        <?php
        if ( have_posts() ) : ?>

            <header class="page-header">
                <?php
                    echo '<h2 class="page-title">';single_cat_title();echo '</h2>';
                ?>
                
                <?php
                    if( is_tax('resource-tag') ) { ?>
                        <nav class="resource-nav">
                            <?php
                                wp_nav_menu(array(
                                    'theme_location' => 'resourcenav',
                                    'container' => '',
                                ));
                            ?>
                        </nav>
                    <?php }
                ?>
                
                <?php
                    if( is_tax('newsroom-tag') ) { ?>
                        <nav class="news-filter">
                            <?php
                                wp_nav_menu(array(
                                    'theme_location' => 'newsfilter',
                                    'container' => '',
                                ));
                            ?>
                        </nav>
                    <?php }
                ?>
            </header><!-- .page-header -->
            
            <?php if(is_home() || is_tax('resource-tag')) { ?>
                <div class="blogpost">
            <?php } else { ?>
                <section class="event">
            <?php } ?>

            <?php
            /* Start the Loop */
            while ( have_posts() ) : the_post();

                /*
                 * Include the Post-Format-specific template for the content.
                 * If you want to override this in a child theme, then include a file
                 * called content-___.php (where ___ is the Post Format name) and that will be used instead.
                 */
                get_template_part( 'template-parts/content', get_post_format() );

            endwhile; ?>
                
            <?php if(is_home() || is_tax('resource-tag')) { ?>
                </div>
            <?php } else { ?>
                </section>
            <?php } ?>

            <?php digitate_paging_nav();

        else :

            get_template_part( 'template-parts/content', 'none' );

        endif; ?>

        </main><!-- #main -->
    </div><!-- #primary -->

<?php
get_footer();