<!-- Magazine Section 1 Subsection -->
<?php
$section_1_category_1 = get_post_meta(get_the_ID(), 'section_1_category_1', true);
$section_1_post_count = get_post_meta(get_the_ID(), 'section_1_post_count', true);
$section_1_post_count = (!empty($section_1_post_count) ? $section_1_post_count : '5');

$args = array(
    'post_status' => array('publish'),
    'nopaging' => false,
    'cat' => $section_1_category_1,
    'posts_per_page' => $section_1_post_count
);

// @todo default cat if no specified

$query = new WP_Query($args);
if ($query->have_posts()) :
    ?>
    <div class="col-md-12">
        <h3 class="oct-underlined-heading">
            <?php echo get_cat_name($section_1_category_1); ?>
        </h3>
    </div>

    <?php while ($query->have_posts()) : $query->the_post(); ?>

        <?php if ($query->current_post == 0) { ?>
            <div class="col-12 col-lg-6">
                <article class="magazine-featured-box box-shadow oct-card">
                    <!-- Featured Image or Video -->
                    <figure class="oct-featured-media media-thumbnails">
                        <?php
                        // Check if featured video enabled or featured image exists, else set default image.
                        if (get_post_meta(get_the_ID(), 'featured_video_switch', true) == 'on') {
                            $featured_video_url = get_post_meta(get_the_ID(), 'featured_video_url', true);
                            echo do_shortcode("[video src='" . $featured_video_url . "']");
                        } else if (has_post_thumbnail()) {
                            the_post_thumbnail('medium_large_featured', array('class' => 'img-fluid'));
                        } else {
                            ?>
                            <img src="<?php echo get_template_directory_uri(); ?>/assets/images/image-not-found-960x640.png" alt="<?php the_title(); ?>" class='img-fluid' />
                        <?php }
                        ?>
                    </figure>

                    <div class="magazine-featured-text-box">
                        <h3 class="oct-post-title">
                            <a href="<?php the_permalink(); ?>"><?php the_title(); ?></a> 
                        </h3>
                        <!-- Post meta data -->
                        <?php if ('post' === get_post_type() && 'off' != ot_get_option('show_post_meta')) { ?>
                            <?php get_template_part('template-parts/post', 'meta'); ?>
                        <?php } ?>

                        <!-- Post content excerpt -->
                        <div class="oct-card-text">
                            <?php echo wp_trim_words(get_the_excerpt(), 35, '...'); ?>
                        </div>
                    </div>
                </article>
            </div>
            <!-- Start next col-6 for next section here -->
            <div class="col-12 col-lg-6">

            <?php } else { ?>

                <article class="oct-magazine-subsection-list">
                    <div class="row no-gutters">
                        <div class="col-md-4 no-gutters">
                            <figure class="oct-featured-media media-thumbnails">
                                <?php
                                // Check if featured video enabled or featured image exists, else set default image.
                                if (get_post_meta(get_the_ID(), 'featured_video_switch', true) == 'on') {
                                    $featured_video_url = get_post_meta(get_the_ID(), 'featured_video_url', true);
                                    echo do_shortcode("[video src='" . $featured_video_url . "']");
                                } else if (has_post_thumbnail()) {
                                    the_post_thumbnail('small_featured', array('class' => 'img-fluid'));
                                } else {
                                    ?>
                                    <img src="<?php echo get_template_directory_uri(); ?>/assets/images/image-not-found-240x160.png" alt="<?php the_title(); ?>" class='img-fluid' />
                                <?php }
                                ?>
                            </figure>
                        </div>
                        <div class="col-md-8">
                            <div class="">
                                <h5 class="oct-post-title">
                                    <a href="<?php the_permalink(); ?>" title="<?php the_title(); ?>">
                                        <?php the_title(); ?>
                                    </a>
                                </h5>

                                <!-- Post content excerpt -->
                                <div class="">
                                    <?php
                                    add_filter('excerpt_length', function( $length ) {
                                        return 5;
                                    }, 999);
                                    the_excerpt();
                                    ?>
                                </div>
                                <!-- Post meta data -->
                                <?php if ('off' != ot_get_option('show_post_meta')) { ?>
                                    <!-- Post Publish & Updated Date & Time -->
                                    <span class="post-date">
                                        <i class="dashicons dashicons-clock" aria-hidden="true"></i>
                                        <?php
                                        $time_string = '<time class="post-date entry-date published updated" datetime="%1$s">%2$s</time>';
                                        $time_string = sprintf($time_string, get_the_date(DATE_W3C), get_the_date(), get_the_modified_date(DATE_W3C), get_the_modified_date());
                                        echo $time_string;
                                        ?>
                                    </span>
                                <?php } ?>
                                <!-- End Post meta data -->
                            </div>
                        </div>
                    </div>
                </article>
                <?php
                /* Close Magazine subsection md-6 at the end */
                if ($query->current_post == $query->post_count) {
                    ?>
                </div>
            <?php } ?>

            <?php
        }
    endwhile;
endif;
wp_reset_postdata();
?>
