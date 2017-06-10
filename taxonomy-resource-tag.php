<?php get_header(); ?>

    <div id="primary" class="content-area">
        <main id="main" class="site-main" role="main">
            
            <?php echo '<h2 class="page-title">';single_cat_title();echo '</h2>'; ?>
    
            <?php if(has_term( array( 'case-studies','product-sheets','whitepapers','videos' ), 'resource-tag')) : ?>
            
                <?php
                    if ( have_posts() ) : ?>

                        <div class="blogpost">
                            <article>
                             <?php   /* Start the Loop */
                                while ( have_posts() ) : the_post();

                                    if( has_post_thumbnail() ) {
                                        the_post_thumbnail( 'blog-post-thumbnail' );
                                    } else { ?>
                                    <img src="<?php bloginfo( 'template_directory' ); ?>/images/noThumb.png" alt="<?php the_title(); ?>">
                                    <?php } ?>
                                    <div class="source">
                                        <div class="excerpt">
                                            <p><?php the_title(); ?></p>
                                            <a href="<?php the_permalink(); ?>">download &#62;&#62;</a>
                                        </div>
                                        <div class="meta">
                                            <i class="fa fa-file-text-o" aria-hidden="true"></i> <?php the_date(); ?>
                                        </div>
                                    </div>

                                <?php endwhile;

                            else :

                                get_template_part( 'template-parts/content', 'none' );

                            endif; ?>
                            </article>
                        </div>

                    <?php digitate_paging_nav(); ?>
            
            <?php else:
                
                get_template_part( 'single', 'resources' );
            
            endif; ?>
        
        </main>
    </div>
        
<?php get_footer(); ?>