<?php
/* Template Name: Magazine */

get_header();

/* Get blog layout from theme options */
$blog_layout = ot_get_option('blog_layout_radio');

/* Set main container class based on blog layout */
if ($blog_layout == 'one-column-no-sidebar' || $blog_layout == 'two-column-no-sidebar' || $blog_layout == 'three-column-no-sidebar') {
    $main_class = "col-md-12";
} else {
    $main_class = "col-sm-12 col-md-8 col-lg-9";
}
?>
<section class="oct-main-section" role="main">
    <div class="container">
        <div class="row">

            <?php if ($blog_layout == 'one-column-left-sidebar' || $blog_layout == 'two-column-left-sidebar') { ?>
                <!-- Blog Left Sidebar -->
                <div class="col-sm-12 col-md-4 col-lg-3">
                    <?php get_sidebar(); ?>
                </div>
            <?php } ?>

            <div class="<?php echo $main_class; ?>">

                <?php
                // Check if magazine slider is on
                $magazine_slider = get_post_meta(get_the_ID(), 'magazine_slider_switch', true);
                if ($magazine_slider != 'off') {
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
                            get_template_part('template-parts/layout/blog', 'magazine');

                        endwhile;
                        ?>

                        <?php
                    else :
                        get_template_part('template-parts/content', 'none');

                    endif;
                    ?>
                </div>
            </div>

            <?php if ($blog_layout == 'one-column-right-sidebar' || $blog_layout == 'two-column-right-sidebar') { ?>
                <!-- Blog Left Sidebar -->
                <div class="col-sm-12 col-md-4 col-lg-3">
                    <?php get_sidebar(); ?>
                </div>
            <?php } ?>
        </div>
    </div>
</section>

<?php get_footer(); ?>