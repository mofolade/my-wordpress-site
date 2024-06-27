<?php
/**
 * The template for displaying the footer
 *
 * Contains the closing of the #content div and all content after.
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package blog
 */
?>

<?php
$footer_widgets = wp_get_sidebars_widgets();
if (!empty($footer_widgets['oct-footer-1']) || !empty($footer_widgets['oct-footer-2']) || !empty($footer_widgets['oct-footer-3'])) :
    ?>
    <footer id="oct-site-footer" class="footer-section bg-with-black">
        <div class="container no-padding">
            <div class="row">
                <div class="col-md-4 flex-column">
                    <div class="v-center">
                        <?php dynamic_sidebar('oct-footer-1'); ?>
                    </div>
                </div>
                <div class="col-md-4 push-md-4 flex-column">
                    <div class="v-center">
                        <?php dynamic_sidebar('oct-footer-2'); ?>
                    </div>
                </div>
                <div class="col-md-4 pull-md-4 flex-column">
                    <div class="v-center">
                        <?php dynamic_sidebar('oct-footer-3'); ?>
                    </div>
                </div>
            </div>
        </div>
    </footer>

<?php endif; ?>

<div class="container-fluid copyright p-0">
    <div id="oct-copyright">
        <div class="row m-0">
            <div class="col-md-12 col-sm-12 col-xs-12">
                <div class="oct-copyright text-center">
                    <span><?php
                        echo ot_get_option('copyright_text');
                        onecom_edit_icon('ot_option', 'section_footer_options', '', 'inline');
                        ?> 
                    </span>
                </div>
            </div>
        </div>
    </div>
</div>

</div><!-- #wrapper -->
</div>


<?php

function mobile_menu() {
    echo '<!--- START Mobile Menu --->
    <div id="sticky_menu_wrapper" class="d-lg-none">';
    wp_nav_menu(
            array(
                'theme_location' => 'mobile_oct_showcase',
                'menu_id' => 'sticky_menu',
                'container' => '',
            )
    );

    echo '<div class="sticky_menu_collapse"><i></i></div></div>';
}

add_action('wp_footer', 'mobile_menu');
?>
<?php wp_footer(); ?>

</body>
</html>
