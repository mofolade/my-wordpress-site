<section class="page-content" role="main">
    <div class="container">
        <div class="row text-center">
            <div class="col-md-12">
                <div class="section-title">
                    <header class="page-header">
                        <?php
                        if (is_home() && !is_front_page()) {
                            $blog_page_id = get_option('page_for_posts');
                            the_custom_title($type='center-line',$blog_page_id);
                        } else if (is_search()) {
                            echo '<h2 class="center-line">';
                            echo sprintf(__('Search: %s', 'oct-express'), get_search_query());
                            echo '</h2>';
                        } else {
                            the_archive_title('<h2 class="center-line">', '</h2>');
                        }
                        ?>
                    </header><!-- .page-header -->
                </div>
                <?php if (strlen(get_the_archive_description())): ?>
                    <div class="section-content">
                        <?php the_archive_description('<div class="taxonomy-description">', '</div>'); ?>
                    </div>
                <?php endif; ?>

            </div>
        </div>
    </div>
</section>