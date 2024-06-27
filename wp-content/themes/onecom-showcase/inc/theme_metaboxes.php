<?php

/**
 * Initialize the custom Meta Boxes.
 */
add_action('admin_init', 'custom_meta_boxes');

global $post;

/**
 * Meta Boxes demo code.
 *
 * You can find all the available option types in demo-theme-options.php.
 *
 * @return    void
 * @since     2.0
 */
function custom_meta_boxes() {

    /**
     * Create a custom meta boxes array that we pass to
     * the OptionTree Meta Box API Class.
     */
    $homepage_sections = array(
        'id' => 'home_sections',
        'title' => __('Page Sections', 'oct-express'),
        'desc' => '',
        'pages' => array('page'),
        'context' => 'normal',
        'priority' => 'high',
        'fields' => array(
            /* Home Content Section */
            array(
                'label' => __('Content', 'oct-express'),
                'id' => 'content_tab',
                'type' => 'tab'
            ),
            array(
                'label' => __('Show Title', 'oct-express'),
                'id' => 'custom_page_title_switch',
                'type' => 'on-off',
                'class' => 'switch_div',
                'std' => 'off'
            ),
            array(
                'id' => 'custom_page_title',
                'label' => __('Custom Title', 'oct-express'),
                'type' => 'text',
                'std' => '',
                'rows' => '1',
                'condition' => 'custom_page_title_switch:is(on)'
            ),
//            array(
//                'id' => 'home_category',
//                'label' => __('Category', 'oct-express'),
//                'desc' => __('Select category or recent posts will be displayed.', 'oct-express'),
//                'type' => 'category-select',
//            ),
//            array(
//                'id' => 'home_post_count',
//                'label' => __('Number of Posts', 'oct-express'),
//                'type' => 'text',
//                'std' => '8',
//                'rows' => '1',
//                'condition' => ''
//            ),
            /* Banner Section */
            array(
                'label' => __('Slider', 'oct-express'),
                'id' => 'home_slider_tab',
                'type' => 'tab'
            ),
            array(
                'label' => __('Show Slider', 'oct-express'),
                'id' => 'home_slider_switch',
                'type' => 'on-off',
                'class' => 'switch_div',
                'std' => 'on',
            ),
            
        )
    );

    /* Magazine page sections */
    $magazine_sections = array(
        'id' => 'magazine_sections',
        'title' => __('Page Sections', 'oct-express'),
        'desc' => '',
        'pages' => array('page'),
        'context' => 'normal',
        'priority' => 'high',
        'fields' => array(
            /* Slider Section */
            array(
                'label' => __('Slider', 'oct-express'),
                'id' => 'home_slider_tab',
                'type' => 'tab'
            ),
            array(
                'label' => __('Show Slider', 'oct-express'),
                'id' => 'magazine_slider_switch',
                'type' => 'on-off',
                'class' => 'switch_div',
                'std' => 'on',
            ),
            array(
                'id' => 'oct_slide_count',
                'label' => __('Number of slides', 'oct-express'),
                'type' => 'text',
                'std' => '4',
                'rows' => '1',
                'condition' => 'magazine_slider_switch:is(on)'
            ),
            array(
                'id' => 'oct_slide_interval',
                'label' => __('Interval', 'oct-express'),
                'desc' => __('Time interval between each slide (in milliseconds)', 'oct-express'),
                'type' => 'text',
                'std' => '5000',
                'rows' => '1',
                'condition' => 'magazine_slider_switch:is(on)'
            ),
            /* Section 1 */
            array(
                'label' => __('Section', 'oct-express') . ' 1',
                'id' => 'section_1_tab',
                'type' => 'tab'
            ),
            array(
                'label' => __('Show Section', 'oct-express'),
                'id' => 'section_1_switch',
                'type' => 'on-off',
                'class' => 'switch_div',
                'std' => 'on'
            ),
            array(
                'id' => 'section_1_category_1',
                'label' => __('Category', 'oct-express'),
                'type' => 'category-select',
                'condition' => 'section_1_switch:is(on)'
            ),
            array(
                'id' => 'section_1_post_count',
                'label' => __('Number of Posts', 'oct-express'),
                'type' => 'text',
                'std' => '5',
                'rows' => '1',
                'condition' => 'section_1_switch:is(on)'
            ),
            /* Section 2 */
            array(
                'label' => __('Section', 'oct-express') . ' 2',
                'id' => 'section_2_tab',
                'type' => 'tab'
            ),
            array(
                'label' => __('Show Section', 'oct-express'),
                'id' => 'section_2_switch',
                'type' => 'on-off',
                'class' => 'switch_div',
                'std' => 'on'
            ),
            array(
                'id' => 'section_2_category_1',
                'label' => __('Category', 'oct-express'),
                'type' => 'category-select',
                'condition' => 'section_2_switch:is(on)'
            ),
            array(
                'id' => 'section_2_post_count',
                'label' => __('Number of Posts', 'oct-express'),
                'type' => 'text',
                'std' => '8',
                'rows' => '1',
                'condition' => 'section_2_switch:is(on)'
            ),
            /* Section 1 */
            array(
                'label' => __('Section', 'oct-express') . ' 3',
                'id' => 'section_3_tab',
                'type' => 'tab'
            ),
            array(
                'label' => __('Show Section', 'oct-express'),
                'id' => 'section_3_switch',
                'type' => 'on-off',
                'class' => 'switch_div',
                'std' => 'on'
            ),
            array(
                'id' => 'section_3_category_1',
                'label' => __('Category', 'oct-express').' 1',
                'type' => 'category-select',
                'condition' => 'section_3_switch:is(on)'
            ),
            array(
                'id' => 'section_3_category_2',
                'label' => __('Category', 'oct-express').' 2',
                'type' => 'category-select',
                'condition' => 'section_3_switch:is(on)'
            ),
            array(
                'id' => 'section_3_category_3',
                'label' => __('Category', 'oct-express').' 3',
                'type' => 'category-select',
                'condition' => 'section_3_switch:is(on)'
            ),
            array(
                'id' => 'section_3_post_count',
                'label' => __('Number of Posts', 'oct-express'),
                'type' => 'text',
                'std' => '4',
                'rows' => '1',
                'condition' => 'section_3_switch:is(on)'
            ),
            
        )
    );

    /* Contact page sections */
    $contact_sections = array(
        'id' => 'contact_sections',
        'title' => __('Page Section', 'oct-express'),
        'desc' => '',
        'pages' => array('page'),
        'context' => 'normal',
        'priority' => 'low',
        'fields' => array(
            array(
                'label' => __('Content', 'oct-express'),
                'id' => 'content_tab',
                'type' => 'tab'
            ),
            array(
                'label' => __('Show Slider', 'oct-express'),
                'id' => 'oct_page_slider_switch',
                'type' => 'on-off',
                'class' => 'switch_div',
                'std' => 'off',
            ),
            array(
                'id' => 'oct_slide_count',
                'label' => __('Number of slides', 'oct-express'),
                'type' => 'text',
                'std' => '4',
                'rows' => '1',
                'condition' => 'oct_page_slider_switch:is(on)'
            ),
            array(
                'id' => 'oct_slide_interval',
                'label' => __('Interval', 'oct-express'),
                'desc' => __('Time interval between each slide (in milliseconds)', 'oct-express'),
                'type' => 'text',
                'std' => '5000',
                'rows' => '1',
                'condition' => 'oct_page_slider_switch:is(on)'
            ),
            array(
                'label' => __('Show Featured Video', 'oct-express'),
                'desc' => __('A video will override the featured image for this post.', 'oct-express'),
                'id' => 'featured_video_switch',
                'type' => 'on-off',
                'class' => 'switch_div',
                'std' => 'off',
            ),
            array(
                'id' => 'featured_video_url',
                'label' => __('Video URL', 'oct-express'),
                'type' => 'text',
                'std' => '',
                'rows' => '1',
                'condition' => 'featured_video_switch:is(on)',
            ),
            /* Contact Form Section */
            array(
                'label' => __('Form Section', 'oct-express'),
                'id' => 'contact_form_tab',
                'type' => 'tab',
            ),
            array(
                'label' => __('Show Section', 'oct-express'),
                'id' => 'contact_form_switch',
                'type' => 'on-off',
                'class' => 'switch_div',
                'std' => 'on',
            ),
            array(
                'id' => 'form_labels',
                'label' => __('Form Fields Labels', 'oct-express'),
                'std' => '',
                'type' => 'textblock-titled',
                'section' => 'contact_options',
                'class' => 'inline_cols',
                'condition' => 'contact_form_switch:is(on)',
                'operator' => 'and'
            ),
            array(
                'id' => 'form_label_1',
                'std' => 'Name',
                'type' => 'text',
                'section' => 'contact_options',
                'class' => 'inline_cols',
                'condition' => 'contact_form_switch:is(on)',
                'operator' => 'and'
            ),
            array(
                'id' => 'form_label_2',
                'std' => 'Email',
                'type' => 'text',
                'section' => 'contact_options',
                'class' => 'inline_cols',
                'condition' => 'contact_form_switch:is(on)',
                'operator' => 'and'
            ),
            array(
                'id' => 'form_label_3',
                'std' => 'Message',
                'type' => 'text',
                'section' => 'contact_options',
                'class' => 'inline_cols',
                'condition' => 'contact_form_switch:is(on)',
                'operator' => 'and'
            ),
            array(
                'id' => 'form_label_4',
                'std' => 'SUBMIT',
                'type' => 'text',
                'section' => 'contact_options',
                'class' => 'inline_cols',
                'condition' => 'contact_form_switch:is(on)',
                'operator' => 'and'
            ),
            array(
                'id' => 'cmail_subject',
                'label' => __('Email Subject', 'oct-express'),
                'std' => 'Contact query from website ' . get_bloginfo('name'),
                'type' => 'text',
                'section' => 'contact_options',
                'condition' => 'contact_form_switch:is(on)',
            ),
            array(
                'id' => 'recipient_email',
                'label' => __('Recipients', 'oct-express'),
                'desc' => __('Provide email accounts where you want to receive emails from this form.', 'oct-express'),
                'std' => get_option('admin_email'),
                'type' => 'text',
                'section' => 'contact_options',
                'condition' => 'contact_form_switch:is(on)',
            ),
            array(
                'label' => __('Custom Form', 'oct-express'),
                'desc' => __('This will replace the default form.', 'oct-express'),
                'id' => 'custom_form_switch',
                'type' => 'on-off',
                'std' => 'off',
                'condition' => 'contact_form_switch:is(on)',
            ),
            array(
                'label' => __('Form Embed Code or Shortcode', 'oct-express'),
                'desc' => __('Please copy and paste the Embed Code or Shortcode of the custom form (if any). This will replace the default form.', 'oct-express'),
                'id' => 'custom_form_embed',
                'type' => 'textarea',
                'rows' => '3',
                'condition' => 'custom_form_switch:is(on), contact_form_switch:is(on)',
                'operator' => 'and'
            ),
        )
    );

    /**
     * Single page details
     * */
    $page_sections = array(
        'id' => 'page_sections',
        'title' => __('Page Sections', 'oct-express'),
        'desc' => '',
        'pages' => array('page'),
        'context' => 'normal',
        'priority' => 'high',
        'fields' => array(
            /* Content Section */
            array(
                'label' => __('Content', 'oct-express'),
                'id' => 'content_tab',
                'type' => 'tab'
            ),
            array(
                'label' => __('Show Slider', 'oct-express'),
                'id' => 'oct_page_slider_switch',
                'type' => 'on-off',
                'class' => 'switch_div',
                'std' => 'off',
            ),
            array(
                'id' => 'oct_slide_count',
                'label' => __('Number of slides', 'oct-express'),
                'type' => 'text',
                'std' => '4',
                'rows' => '1',
                'condition' => 'oct_page_slider_switch:is(on)'
            ),
            array(
                'id' => 'oct_slide_interval',
                'label' => __('Interval', 'oct-express'),
                'desc' => __('Time interval between each slide (in milliseconds)', 'oct-express'),
                'type' => 'text',
                'std' => '5000',
                'rows' => '1',
                'condition' => 'oct_page_slider_switch:is(on)'
            ),
            array(
                'label' => __('Show Featured Video', 'oct-express'),
                'desc' => __('A video will override the featured image for this post.', 'oct-express'),
                'id' => 'featured_video_switch',
                'type' => 'on-off',
                'class' => 'switch_div',
                'std' => 'off',
            ),
            array(
                'id' => 'featured_video_url',
                'label' => __('Video URL', 'oct-express'),
                'type' => 'text',
                'std' => '',
                'rows' => '1',
                'condition' => 'featured_video_switch:is(on)',
            ),
        )
    );

    /**
     * Single post details
     * */
    $post_sections = array(
        'id' => 'page_sections',
        'title' => __('Page Sections', 'oct-express'),
        'desc' => '',
        'pages' => array('post'),
        'context' => 'normal',
        'priority' => 'high',
        'fields' => array(
            /* Content Section */
            array(
                'label' => __('Content', 'oct-express'),
                'id' => 'content_tab',
                'type' => 'tab'
            ),
            array(
                'label' => __('Show Featured Video', 'oct-express'),
                'desc' => __('A video will override the featured image for this post.', 'oct-express'),
                'id' => 'featured_video_switch',
                'type' => 'on-off',
                'class' => 'switch_div',
                'std' => 'off',
            ),
            array(
                'id' => 'featured_video_url',
                'label' => __('Video URL', 'oct-express'),
                'type' => 'text',
                'std' => '',
                'rows' => '1',
                'condition' => 'featured_video_switch:is(on)',
            ),
        )
    );

    /**
     * Sidebar option to pages
     * */
    $layouts = array(
        'id' => 'single_page_meta_box',
        'title' => __('Layout', 'oct-express'),
        //'desc'        => '',
        'pages' => array('page', 'post'),
        'context' => 'side',
        'priority' => 'low',
        'fields' => array(
            array(
                'id' => 'single_post_page_layout',
                //'label'       => __( 'Sidebar', 'oct-express' ),
                'std' => ot_get_option('single_page_layout'),
                'type' => 'radio-image',
                'choices' => array(
                    array(
                        'value' => 'one-column-right-sidebar',
                        'label' => __('One column with right sidebar', 'oct-express'),
                        'src' => get_template_directory_uri().'/option-tree/assets/images/layout/one-column-sidebar.png',
                    ),
                    array(
                        'value' => 'one-column-no-sidebar',
                        'label' => __('One column without sidebar', 'oct-express'),
                        'src' => get_template_directory_uri() . '/option-tree/assets/images/layout/one-column.png',
                    ),
                    array(
                        'value' => 'one-column-left-sidebar',
                        'label' => __('One column with left sidebar', 'oct-express'),
                        'src' => get_template_directory_uri() . '/option-tree/assets/images/layout/sidebar-one-column.png',
                    ),
                )
            ),
        )
    );

    /**
     * Register our meta boxes using the
     * ot_register_meta_box() function.
     */
    if (function_exists('ot_register_meta_box')) {
         /* Exclude these templates from having common metaboxes. */
        $exclude_page_templates = array(
            'page-templates/contact-page.php',
            'page-templates/magazine-page.php'
        );
    }

    $page_id = get_permalink();
    $page_template_file = '';
    if (isset($_REQUEST['post'])) {
        $page_id = $_GET['post'] ? $_GET['post'] : $_POST['post_ID'];
        $page_template_file = get_post_meta($page_id, '_wp_page_template', TRUE);
    }
    if (isset($_POST['post_ID'])) {
        $page_id = $_POST['post_ID'];
        $page_template_file = get_post_meta($page_id, '_wp_page_template', TRUE);
    }

    $front_page = get_option('page_on_front');
    $blog_page = get_option('page_for_posts');

    /* Contact Page Metaboxes */
    if ($page_template_file == 'page-templates/contact-page.php') {
        ot_register_meta_box($contact_sections);
    }

    /* Contact Page Metaboxes */
    if ($page_template_file == 'page-templates/magazine-page.php') {
        ot_register_meta_box($magazine_sections);
    }

    /* General Pages Sections Settings */
    if (isset($page_id) && $front_page != $page_id && $blog_page != $page_id && !in_array($page_template_file, $exclude_page_templates)) {
        ot_register_meta_box($page_sections);
        ot_register_meta_box($post_sections);
        ot_register_meta_box($layouts);
    }
}
