<!-- Magazine Section 3 Subsection 2 -->
<?php
$section_3_category_2 = get_post_meta(get_the_ID(), 'section_3_category_2', true);
$section_3_post_count = get_post_meta(get_the_ID(), 'section_3_post_count', true);
$section_3_post_count = (!empty($section_3_post_count) ? $section_3_post_count : '4');

$args = array(
    'post_status' => array('publish'),
    'nopaging' => false,
    'cat' => $section_3_category_2,
    'posts_per_page' => $section_3_post_count
);
$query = new WP_Query($args);
if ($query->have_posts()) :
    ?>
    <h3 class="oct-underlined-heading">
        <?php echo get_cat_name($section_3_category_2); ?>
    </h3>

    <?php
    while ($query->have_posts()) : $query->the_post();
        /* Show first post regularly, and other posts in sub section */
        if ($query->current_post == 0) {
            ?>
            <article class="oct-magazine-3-featured-box">
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

                <h4 class="">
                    <a href="<?php the_permalink(); ?>" title="<?php the_title(); ?>">
                        <?php the_title(); ?>
                    </a>
                </h4>
                <!-- Post meta data -->
                <?php if ('off' != ot_get_option('show_post_meta')) { ?>
                    <?php get_template_part('template-parts/magazine-post', 'meta'); ?>
                <?php } ?>
            </article>
        <?php } else { ?>
            <div class="row no-gutters oct-magazine-list-3">
                <div class="col-12 col-lg-6">
                    <!-- Featured Image or Video -->
                    <figure class="oct-featured-media media-thumbnails">
                        <?php
                        // Check if featured video enabled or featured image exists, else set default image.
                        if (get_post_meta(get_the_ID(), 'show_blog_thumb', true) == 'on') {
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
                <div class="col-12 col-lg-6">
                    <section class="magazine-subsection">
                        <h6 class="">
                            <a href="<?php the_permalink(); ?>" title="<?php the_title(); ?>">
                                <?php
                                the_short_title()
                                ?>
                            </a>
                        </h6>
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
                    </section>
                </div>
            </div>
        <?php } ?>
        <?php
    endwhile;
endif;
wp_reset_postdata();
?>
