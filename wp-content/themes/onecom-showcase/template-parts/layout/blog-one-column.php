<?php
// Define laoyut class depending on the thumbnail on-off
$list_class = (ot_get_option('show_blog_thumb') != 'off' ? 'col-md-6' : 'col-md-12'); // returns true
?>
<div class="col-md-12">
    <section class="section-list-layout oct-main-content">
        <div class="row">
            <?php if (ot_get_option('show_blog_thumb') != 'off') { ?>
                <div class="col-md-6">
                    <figure class="oct-featured-media">
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
                </div>
            <?php } ?>
            <div class="<?php echo $list_class; ?>">
                <div class="oct-card-body">
                    <h2 class="oct-post-title">
                        <a href="<?php the_permalink(); ?>" title="<?php the_title(); ?>">
                            <?php the_title(); ?>
                        </a>
                    </h2>

                    <!-- Post post meta -->
                    <?php get_template_part('template-parts/post', 'meta'); ?>
                    <!-- Ends post meta -->

                    <!-- Post content excerpt -->
                    <div class="oct-card-text my-2">
                        <?php echo wp_trim_words(get_the_excerpt(), 55, '...'); ?>
                    </div>
                    <div class="oct-card-text">
                        <a class="btn btn-primary" href="<?php the_permalink(); ?>" >
                            <?php
                            /* Get button title */
                            $button_title = ot_get_option('blog_button_label');
                            if (!empty($button_title)) {
                                echo $button_title;
                            } else {
                                _e('Read More', 'oct-express');
                            }
                            ?>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- Featured Image or Video -->
</div>