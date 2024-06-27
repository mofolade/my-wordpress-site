<?php if ('post' === get_post_type() && 'off' != ot_get_option('show_post_meta')) { ?>
    <div class="oct-post-meta" role="contentinfo">
        <ul class="list-inline">
            <!-- Post Author -->
            <li class="list-inline-item post-author">
                <span class="dashicons dashicons-admin-users"></span>
                <a href="<?php echo esc_url(get_author_posts_url(get_the_author_meta('ID'))); ?>">
                    <?php
                    if (strlen(get_the_author_meta('first_name'))) {
                        echo get_the_author_meta('first_name') . ' ' . get_the_author_meta('last_name');
                    } else {
                        echo get_the_author();
                    }
                    ?>
                </a>
            </li>

            <?php if (!empty(wp_get_post_categories(get_the_ID()))): ?>
                <!-- Post Publish & Updated Date & Time -->
                <li class="list-inline-item post-date">
                    <i class="dashicons dashicons-clock" aria-hidden="true"></i>
                    <?php
                    $time_string = '<time class="post-date entry-date published updated" datetime="%1$s">%2$s</time>';
                    $time_string = sprintf($time_string, get_the_date(DATE_W3C), get_the_date(), get_the_modified_date(DATE_W3C), get_the_modified_date());
                    echo $time_string;
                    ?>
                </li>
            <?php endif; ?>


            <!-- If single show all categories, else first only -->
            <?php if (is_single() && !empty(wp_get_post_categories(get_the_ID()))) { ?>

                <li class="list-inline-item post-categories">
                    <i class="dashicons dashicons-category"></i>
                    <?php the_category(', '); ?>
                </li>

                <?php //} else if ((!empty(wp_get_post_categories(get_the_ID())) && is_archive() && is_font_page())) { ?>
            <?php } else { ?>
                <li class="list-inline-item post-categories">
                    <i class="dashicons dashicons-category"></i>
                    <?php
                    $category = get_the_category();
                    $category_name = $category[0]->cat_name;
                    $category_link = get_category_link($category[0]->cat_ID);
                    ?>

                    <!-- Print a link to this category -->
                    <a href="<?php echo esc_url($category_link); ?>" title="<?php echo $category_name; ?>">
                        <?php echo $category_name; ?>
                    </a>
                </li>
            <?php } ?>

            <?php if (is_single()) { 
                $comments_count = wp_count_comments(get_the_ID());
                ?>

                <li class="list-inline-item post-comments">
                    <i class="dashicons dashicons-format-chat" aria-hidden="true"></i> 
                        <?php echo $comments_count->total_comments; ?> 
                    </li>
            <?php } ?>
        </ul>
    </div>
<?php } ?>