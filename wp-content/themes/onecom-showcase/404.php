<?php
/**
 * The template for displaying 404 pages (not found)
 *
 * @link https://codex.wordpress.org/Creating_an_Error_404_Page
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
                <header class="page-header">
                    <div class="row mt-4">
                        <div class="col-md-12">
                            <h1 class="oct-underlined-heading"><?php esc_html_e('Oops! That page can&rsquo;t be found.', 'oct-express'); ?></h1>
                            <div class="oct-main-content">
                                <p><?php echo ot_get_option('404_content'); ?> <?php esc_html_e('Try searching with a different keyword.', 'oct-express'); ?></p>
                            </div>
                        </div>
                    </div>
                </header><!-- .page-header -->
                <div class="row">
                    <div class="col-md-12">
                        <?php
                        get_search_form();
                        ?>
                    </div>
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