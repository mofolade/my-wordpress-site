<?php
/*
 * Layout Selection Base
 */

/* Get blog layout from theme options */
$blog_layout = ot_get_option('blog_layout_radio');

/* Include layout based on layout selected */
if ($blog_layout == 'one-column-no-sidebar') {
    get_template_part('template-parts/layout/blog', 'one-column');
} else if ($blog_layout == 'two-column-no-sidebar') {
    get_template_part('template-parts/layout/blog', 'two-column');
} else if ($blog_layout == 'three-column-no-sidebar') {
    get_template_part('template-parts/layout/blog', 'three-column');
} else if ($blog_layout == 'one-column-right-sidebar') {
    get_template_part('template-parts/layout/blog', 'one-column');
} else if ($blog_layout == 'two-column-right-sidebar') {
    get_template_part('template-parts/layout/blog', 'two-column');
} else if ($blog_layout == 'one-column-left-sidebar') {
    get_template_part('template-parts/layout/blog', 'one-column');
} else if ($blog_layout == 'two-column-left-sidebar') {
    get_template_part('template-parts/layout/blog', 'two-column');
} else {
    get_template_part('template-parts/layout/blog', 'two-column');
}
?>
