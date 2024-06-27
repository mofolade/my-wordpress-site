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

    </ul>
</div>