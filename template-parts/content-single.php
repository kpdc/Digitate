<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
    <div class="title">
        <h1 class="post-title"><?php the_title(); ?></h1>
    </div>
    <?php if( has_tag() ) { ?>
    <div class="meta">
        <div class="tags">
            <?php
                echo get_the_tag_list( '<i class="fa fa-tag"></i> ', ' <i class="fa fa-tag"></i> ', '' );
            ?>
        </div>
    </div>
    <?php } ?>
    <div class="post">
        <?php if(is_singular('post')) :
            the_post_thumbnail();
        endif; ?>
        <div class="txt">
                <?php the_content(); ?>
            <?php
                wp_link_pages( array(
                        'before' => '<div class="page-links">' . __( 'Pages:', 'digitate' ),
                        'after'  => '</div>',
                ) );
            ?>
        </div>
        <div class="interactive">
            <div class="comments">
                <?php 
                    if ( ! post_password_required() && ( comments_open() || '0' != get_comments_number() ) ) { 
                        echo '<span class="comments-link">';
                        comments_popup_link( __( 'Leave a comment', 'my-simone' ), __( '1 Comment', 'my-simone' ), __( '% Comments', 'my-simone' ) );
                        echo '</span>';
                    }
                ?>
            </div>
        </div>
    </div>
</article>