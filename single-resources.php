<?php
/**
 * The template for displaying all single posts
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/#single-post
 *
 * @package Digitate
 */

get_header(); ?>

    <div id="primary" class="content-area">
        <main id="main" class="site-main" role="main">

            <?php
            while ( have_posts() ) : the_post(); ?>
            
                <div class="resource-post">

                    <article>
                        <div class="post">
                            <?php the_post_thumbnail(); ?>
                            <div class="txt">
                                <?php the_content(); ?>
                            <?php
                                wp_link_pages( array(
                                        'before' => '<div class="page-links">' . __( 'Pages:', 'digitate' ),
                                        'after'  => '</div>',
                                ) );
                            ?>
                            </div>
                        </div>
                    </article>
                </div>

            <?php endwhile; // End of the loop.
            ?>

        </main><!-- #main -->
    </div><!-- #primary -->

<?php
get_footer();