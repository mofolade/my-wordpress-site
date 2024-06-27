<?php
/**
 * The main template file
 *
 * This is the most generic template file in a WordPress theme
 * and one of the two required files for a theme (the other being style.css).
 * It is used to display a page when nothing more specific matches a query.
 * E.g., it puts together the home page when no home.php file exists.
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package blog
 */
get_header();

/* Get blog layout from theme options */
$blog_layout = ot_get_option('blog_layout_radio');

/* Set main container class based on blog layout */
if ($blog_layout == 'one-column-no-sidebar' || $blog_layout == 'two-column-no-sidebar' || $blog_layout == 'three-column-no-sidebar') {
    $main_class = "col-md-12";
} else {
    $main_class = "col-sm-12 col-md-7 col-lg-9";
}
?>
<section class="oct-main-section" role="main">
    <div class="container">
        <div class="row">

            <?php if ($blog_layout == 'one-column-left-sidebar' || $blog_layout == 'two-column-left-sidebar') { ?>
                <!-- Blog Left Sidebar -->
                <div class="col-sm-12 col-md-5 col-lg-3">
                    <?php get_sidebar(); ?>
                </div>
            <?php } ?>

            <div class="<?php echo $main_class; ?>">

                <?php
                // Check if home slider is on
                if (ot_get_option('home_slider_switch') != 'off') {
                    // START slider container 
                    get_template_part('template-parts/section', 'slider');
                    // END slider container 
                }
                ?>

                <?php if (have_posts()) : ?>

                    <div class="row">
                        <?php
                        /* Start the Loop */
                        while (have_posts()) :
                            the_post();
                            /* Include main content */
                            get_template_part('template-parts/content', 'layout');

                        endwhile;
                        ?>

                        <?php
                    else :
                        get_template_part('template-parts/content', 'none');

                    endif;
                    ?>
                </div>
                <!-- CPT Pagination -->
                <div class="row">
                    <div class="col-md-12">
                        <!-- CPT Pagination -->
                        <?php
                        the_posts_pagination(array(
                            'mid_size' => '5',
                            'prev_text' => __( 'Previous', 'oct-express'),
                            'next_text' => __( 'Next', 'oct-express'),
                                //'before_page_number' => '<span class="meta-nav screen-reader-text">' . __('Page', 'twentyseventeen') . ' </span>',
                        ));
                        ?>
                    </div>
                </div>
            </div>

            <?php if ($blog_layout == 'one-column-right-sidebar' || $blog_layout == 'two-column-right-sidebar') { ?>
                <!-- Blog Left Sidebar -->
                <div class="col-sm-12 col-md-5 col-lg-3">
                    <?php get_sidebar(); ?>
                </div>
            <?php } ?>
        </div>
    </div>
</section>

<?php get_footer(); ?>