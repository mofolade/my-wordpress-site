<?php
/**
 * The template for displaying all single posts
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/#single-post
 *
 * @package blog
 */
get_header();

/* Get blog layout from theme options */
$blog_layout = ot_get_option('single_post_layout');
$blog_layout_override = get_post_meta(get_the_ID(), 'single_post_page_layout', true);
if ($blog_layout_override != false) {
   $blog_layout = $blog_layout_override;
}

/* Decide main content area class based on sidebar layout available */
if ($blog_layout == 'one-column-no-sidebar' || $blog_layout == 'two-column-no-sidebar' || $blog_layout == 'three-column-no-sidebar') {
    $main_class = "col-md-12";
} else {
    $main_class = "col-sm-12 col-md-8 col-lg-9";
}
?>

<section class="oct-main-section" role="main">
    <div class="container mt-4">
        <div class="row">
            <?php if ($blog_layout == 'one-column-left-sidebar' || $blog_layout == 'two-column-left-sidebar') { ?>
                <!-- Blog Left Sidebar -->
                <div class="col-sm-12 col-md-4 col-lg-3">
                    <?php get_sidebar(); ?>
                </div>
            <?php } ?>

            <div class="<?php echo $main_class; ?>">
                <?php if (have_posts()) : ?>
                    <div class="row">
                        <?php
                        /* Start the Loop */
                        while (have_posts()) :
                            the_post();

                            /* Include main content */
                            get_template_part('template-parts/content', 'single');

                        endwhile;

                    else :

                        get_template_part('template-parts/content', 'none');

                    endif;
                    ?>
                </div>
            </div>

            <?php if ($blog_layout == 'one-column-right-sidebar' || $blog_layout == 'two-column-right-sidebar') { ?>
                <!-- Blog Right Sidebar -->
                <div class="col-sm-12 col-md-4 col-lg-3">
                    <?php get_sidebar(); ?>
                </div>
            <?php } ?>
        </div>
    </div>
</section>
<?php get_footer(); ?>