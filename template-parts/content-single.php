<article>
    <div class="title">
        <h1 class="page-title"><?php the_title(); ?></h1>
    </div>
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

