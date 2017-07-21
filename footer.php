<?php
/**
 * The template for displaying the footer
 *
 * Contains the closing of the #content div and all content after.
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package Digitate
 */

?>

        </div><!-- .site-content -->
    </div><!-- .container -->

    <footer class="site-footer">
        <div class="wrap">
            <img src="<?php bloginfo('template_directory'); ?>/images/digitate.png" alt="digitate" class="footBrand">
            <div class="contact-group">
                <div class="foot-info">
                    <div class="address">
                        5201 Great America Parkway<br>
                        Suite 522<br>
                        Santa Clara, CA 95054<br>
                        USA
                    </div> <!-- .address -->
                </div> <!-- .foot-info -->
                <div class="foot-info">
                    <div class="address">
                        Sahyadri Park, Plot No.2 &amp; 3<br>
                        Rajiv Gandhi Infotech Park<br>
                        Phase-III<br>
                        Hinjewadi, Pune 411057<br>
                        Maharashtra<br>
                        India
                    </div> <!-- .address -->
                </div> <!-- .foot-info -->
                <div class="foot-info">
                    <nav class="legal">
                        <?php
                            wp_nav_menu(array(
                                'theme_location' => 'legal',
                                'container' => '',
                            ));
                        ?>
                    </nav> <!-- .legal -->
                    <nav class="social">
                        <?php
                            wp_nav_menu(array(
                                'theme_location' => 'social',
                                'container' => '',
                            ));
                        ?>
                    </nav> <!-- .legal -->
                </div> <!-- .foot-info -->
                <div class="foot-info">
                    <ul class="awards">
                        <li><a href="/digitate-wins-best-enterprise-application-for-artificial-intelligence-at-ai-summit/"><img src="<?php bloginfo('template_directory'); ?>/images/awards_1.jpg" height="73" width="57" alt=""></a></li>
                        <li><a href="/digitate-earns-big-innovation-award-recognition/"><img src="<?php bloginfo('template_directory'); ?>/images/awards_2.png" height="72" width="80" alt=""></a></li>
                    </ul> <!-- .awards -->
                </div> <!-- .foot-info -->
            </div> <!-- .contact-group -->
        </div> <!-- .wrap -->
    </footer>

    <div class="demo">
        <p class="demo-button">Request a Demo</p>
        <div class="eform">
            <div class="close">x</div>
            <?php echo do_shortcode( '[contact-form-7 id="47" title="Request a Demo"]' ); ?>
        </div>
    </div>
</div><!-- .pageWrap -->

<?php wp_footer(); ?>

</body>
</html>