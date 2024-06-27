<div class="col-md-12">
    <article id="post-<?php the_ID(); ?>" <?php post_class('oct-main-content'); ?>>

        <h1 class="oct-post-title oct-underlined-heading">
            <?php the_title(); ?>
        </h1>

        <!-- Featured Image or Video -->
        <figure class="oct-featured-media">
            <?php
            // Check if featured video enabled or featured image exists, else set default image.
            if (get_post_meta(get_the_ID(), 'featured_video_switch', true) == 'on') {
                $featured_video_url = get_post_meta(get_the_ID(), 'featured_video_url', true);
                echo do_shortcode("[video src='" . $featured_video_url . "']");
            } else if (has_post_thumbnail()) {
                the_post_thumbnail('slider_featured', array('class' => 'img-fluid'));
            } else {
                // If not featured, handle here
            }
            ?>
        </figure>

        <!-- Post content excerpt -->
        <div class="oct-post-content">
            <?php
            the_content();
            edit_post_link(' edit', '<div class="clearfix">', '</div>');
            ?>
        </div>

        <!--  Tags -->
        <?php if (!empty(wp_get_post_tags(get_the_ID()))): ?>
            <div class="oct-post-tags">
                <?php the_tags('<i class="dashicons dashicons-tag"></i> Tags: ', ' '); ?>
            </div>

            <?php
        endif;

        // If comments are open or we have at least one comment, load up the comment template.
        if (comments_open() || get_comments_number()) :
            comments_template();
        endif;
        ?>
    </article>
</div>