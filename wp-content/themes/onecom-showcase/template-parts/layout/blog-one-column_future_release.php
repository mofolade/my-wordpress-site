<div class="col-md-12">
    <article class="card mb-5 box-shadow oct-card">
        <!-- Featured Image or Video -->
        <?php
        if (get_post_meta(get_the_ID(), 'featured_video_switch', true) == 'on') {
            $featured_video_url = get_post_meta(get_the_ID(), 'featured_video_url', true);
            ?>
            <div class="oct-featured-media">
                <?php echo do_shortcode("[video src='" . $featured_video_url . "']"); ?>
            </div>
        <?php } else if (has_post_thumbnail()) {
            ?>
            <figure class="media-thumbnails" >
                <?php the_post_thumbnail('large_featured', array('class' => 'img-fluid')); ?>
            </figure>
            <?php
        } else {
            // @todo set default image or do nothing
        }
        ?>

        <div class="card-body">
            <h2 class="oct-post-title my-1"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a> </h2>
            <!-- Post meta data -->
            <?php if ('post' === get_post_type() && 'off' != ot_get_option('show_post_meta')) { ?>
                <?php get_template_part('template-parts/post', 'meta'); ?>
            <?php } ?>

            <!-- Post content excerpt -->
            <div class="oct-card-text my-3">
                <?php echo wp_trim_words(get_the_excerpt(), 35, '...'); ?>
            </div>
            <div class="oct-card-text">
                <a class="btn btn-primary" href="<?php the_permalink(); ?>" >
                    <?php _e('Read More', 'oct-express'); ?>
                </a>
            </div>
        </div>
    </article>
</div>