<?php
/* Slider Settings  */

if (is_singular( 'page' )) {
    $slide_count = get_post_meta(get_the_ID(), 'oct_slide_count', true);
    $slide_interval = get_post_meta(get_the_ID(), 'oct_slide_interval', true);
} else if (is_home()) {
    $slide_count = ot_get_option('oct_home_slide_count');
    $slide_interval = ot_get_option('oct_home_slide_interval');
} else {
    // if slider is supported on other pages
}
// If settings data empty, set default
$slide_count = (!empty($slide_count) ? $slide_count : '5');
$slide_interval = (!empty($slide_interval) ? $slide_interval : '5000');

$args = array(
    'post_type' => 'oc_slider',
    'posts_per_page' => $slide_count,
    'paged' => $paged
);
$slider_query = new WP_Query($args);

if ($slider_query->have_posts()) :
    ?>
    <section id="oct-slider" class="oct-slider mb-5">
        <div id="carouselExampleIndicators" class="carousel slide" data-ride="carousel" data-interval="<?php echo $slide_interval; ?>">
            <ol class="carousel-indicators">
                <?php
                if ($slider_query->have_posts()) :
                    while ($slider_query->have_posts()) : $slider_query->the_post();
                        $class = ($slider_query->current_post == 0 ? "active" : "");
                        ?>
                        <li data-target="#carouselExampleIndicators" data-slide-to="<?php echo $slider_query->current_post; ?>" class="<?php echo $class; ?>"></li>
                        <?php
                    endwhile;
                endif;
                wp_reset_postdata();
                ?>
            </ol>
            <div class="carousel-inner">
                <?php
                if ($slider_query->have_posts()) :
                    while ($slider_query->have_posts()) : $slider_query->the_post();
                        $class = ($slider_query->current_post == 0 ? "active" : "");
                        ?>
                        <div class="carousel-item <?php echo $class; ?>">
                            <?php
                            if (has_post_thumbnail()) {
                                the_post_thumbnail('slider_featured', array('class' => 'img-fluid d-block w-100'));
                            } else {
                                ?>
                                <img src="<?php echo get_template_directory_uri(); ?>/assets/images/image-not-found.png" alt="<?php the_title(); ?>" />
                            <?php } ?>
                            <div class="carousel-caption d-none d-md-block">
                                <h4><?php the_title(); ?></h4>
                                <div class="carousel-description"><?php the_excerpt(); ?></div>
                            </div>
                        </div>
                        <?php
                    endwhile;
                endif;
                wp_reset_postdata();
                ?>
            </div>
            <a class="carousel-control-prev" href="#carouselExampleIndicators" role="button" data-slide="prev">
                <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                <span class="sr-only">
                    <?php _e('Previous', 'oct-express'); ?>
                </span>
            </a>
            <a class="carousel-control-next" href="#carouselExampleIndicators" role="button" data-slide="next">
                <span class="carousel-control-next-icon" aria-hidden="true"></span>
                <span class="sr-only">
                    <?php _e('Next', 'oct-express');?> 
                </span>
            </a>
        </div>
    </section>
    <?php
endif;
?>


