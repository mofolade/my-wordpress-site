<?php
/**
 * The template for displaying search results pages
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/#search-result
 *
 * @package WordPress
 * @subpackage Twenty_Seventeen
 * @since 1.0
 * @version 1.0
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
    <div class="container mt-4">
        <div class="row">

            <?php if ($blog_layout == 'one-column-left-sidebar' || $blog_layout == 'two-column-left-sidebar') { ?>
                <!-- Blog Left Sidebar -->
                <div class="col-sm-12 col-md-5 col-lg-3">
                    <?php get_sidebar(); ?>
                </div>
            <?php } ?>

            <div class="<?php echo $main_class; ?>">
                <?php if (have_posts()) { ?>

                    <header class="page-header">
                        <div class="row mt-4">
                            <div class="col-md-12">
                                <h1 class="oct-underlined-heading">
                                    <?php printf(__('Search Results for: %s', 'oct-express'), '<span>' . get_search_query() . '</span>'); ?>
                                </h1>
                            </div>
                        </div>
                    </header><!-- .page-header -->
                    <div class="row">
                        <?php
                        /* Start the Loop */
                        while (have_posts()) :
                            the_post();

                            /* Include main content */
                            get_template_part('template-parts/content', 'layout');

                        endwhile;
                        ?>
                    </div>
                    <?php
                } else {

                    get_template_part('template-parts/content', 'none');
                }
                ?>

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

            <!-- Blog Sidebar Widgets Column -->
            <?php if ($blog_layout == 'one-column-right-sidebar' || $blog_layout == 'two-column-right-sidebar') { ?>
                <!-- Blog Left Sidebar -->
                <div class="col-md-3">
                    <?php get_sidebar(); ?>
                </div>
            <?php } ?>
        </div>
    </div>
</section>

<?php get_footer(); ?>