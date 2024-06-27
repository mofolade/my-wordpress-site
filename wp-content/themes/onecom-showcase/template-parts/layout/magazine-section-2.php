<!-- Magazine Section 1 Subsection -->
<?php
$section_2_category_1 = get_post_meta(get_the_ID(), 'section_2_category_1', true);
$section_2_post_count = get_post_meta(get_the_ID(), 'section_2_post_count', true);
$section_2_post_count = (!empty($section_2_post_count) ? $section_2_post_count : '8');

$args = array(
    'post_status' => array('publish'),
    'nopaging' => false,
    'cat' => $section_2_category_1,
    'posts_per_page' => $section_2_post_count
);
$query = new WP_Query($args);
if ($query->have_posts()) :
    ?>
    <div class="col-md-12">
        <h3 class="oct-underlined-heading">
            <?php echo get_cat_name($section_2_category_1); ?>
        </h3>
    </div>

    <?php while ($query->have_posts()) : $query->the_post(); ?>
        <div class="col-md-3">
            <article class="magazine-featured-box mb-4">
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

                <h5 class="my-1">
                    <a href="<?php the_permalink(); ?>"><?php the_title(); ?></a> 
                </h5>
            </article>

        </div>
        <?php
    endwhile;
endif;
wp_reset_postdata();
?>
