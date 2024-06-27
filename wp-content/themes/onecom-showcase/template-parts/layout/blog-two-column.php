<div class="col-md-12 col-lg-6">
    <article id="post-<?php the_ID(); ?>" <?php post_class('card oct-card'); ?>>
        <!-- Featured Image or Video -->
        <?php if (ot_get_option('show_blog_thumb')  != 'off') {  ?>
        <figure class="oct-featured-media">
            <?php
            // Check if featured video enabled or featured image exists, else set default image.
            if (get_post_meta(get_the_ID(), 'featured_video_switch', true) == 'on') {
                $featured_video_url = get_post_meta(get_the_ID(), 'featured_video_url', true);
                echo do_shortcode("[video src='" . $featured_video_url . "']");
            } else if (has_post_thumbnail()) {
                the_post_thumbnail('large_featured', array('class' => 'img-fluid'));
            } else {
                ?>
                <img src="<?php echo get_template_directory_uri(); ?>/assets/images/image-not-found-960x640.png" alt="<?php the_title(); ?>" class='img-fluid' />
            <?php }
            ?>
        </figure>
        <?php } ?>
        <div class="card-body">
            <h2 class="oct-post-title">
                <a href="<?php the_permalink(); ?>" title="<?php the_title(); ?>">
                    <?php the_title(); ?>
                </a>
            </h2>
            
            <!-- Post post meta -->
            <?php get_template_part('template-parts/post', 'meta'); ?>
            <!-- Ends post meta -->

            <!-- Post content excerpt -->
            <div class="oct-card-text">
                <?php echo wp_trim_words(get_the_excerpt(), 32, '...'); ?>
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
    </article>
</div>