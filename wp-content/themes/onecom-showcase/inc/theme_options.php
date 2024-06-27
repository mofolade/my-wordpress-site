<?php

/**
 * Initialize the custom Theme Options.
 */
add_action('init', 'custom_theme_options');

/**
 * Build the custom settings & update OptionTree.
 *
 * @return    void
 * @since     2.0
 */
function custom_theme_options() {

    /* OptionTree is not loaded yet, or this is not an admin request */
    if (!function_exists('ot_settings_id') || !is_admin()) {
        return false;
    }

    /* Check if action is reset (Reset Options) */
    $action = isset($_REQUEST['action']) ? $_REQUEST['action'] : '';
    $social_std = '';

    /* Save default values if Reset or Fresh site */
    if (is_ot_fresh_site() === true OR $action === 'reset') :

        $social_std = array(
            array(
                'title' => 'Twitter',
                'social_icon_entry' => 'twitter',
                'social_icon_link' => '#',
            ),
            array(
                'title' => 'Facebook',
                'social_icon_entry' => 'facebook',
                'social_icon_link' => '#',
            ),
            array(
                'title' => 'LinkedIn',
                'social_icon_entry' => 'linkedin',
                'social_icon_link' => '#',
            )
        );
    endif;

    /**
     * Get a copy of the saved settings array.
     */
    $saved_settings = get_option(ot_settings_id(), array());

    /**
     * Custom settings array that will eventually be
     * passes to the OptionTree Settings API Class.
     */
    $custom_settings = array(
        /* 'contextual_help' => array(
          'content'       => array(
          array(
          'id'        => 'option_types_help',
          'title'     => __( 'Option Types', 'oct-express' ),
          'content'   => '<p>' . __( 'Help content goes here!', 'oct-express' ) . '</p>'
          ),
          ),
          'sidebar'       => '<p>' . __( 'Sidebar content goes here!', 'oct-express' ) . '</p>'
          ), */
        'sections' => array(
            array(
                'id' => 'header_option',
                'title' => __('Header', 'oct-express')
            ),
            array(
                'id' => 'footer_options',
                'title' => __('Footer', 'oct-express')
            ),
            array(
                'id' => 'slider_option',
                'title' => __('Slider', 'oct-express')
            ),
            array(
                'id' => 'blog_options',
                'title' => __('Blog', 'oct-express')
            ),
            array(
                'id' => 'layout_options',
                'title' => __('Layout', 'oct-express')
            ),
            array(
                'id' => 'social_links',
                'title' => __('Social', 'oct-express')
            ),
            array(
                'id' => 'typo_option',
                'title' => __('Typography', 'oct-express')
            ),
            array(
                'id' => 'styling_options',
                'title' => __('Color Scheme', 'oct-express')
            ),
            array(
                'id' => 'advanced_options',
                'title' => __('Advanced', 'oct-express')
            ),
            array(
                'id' => 'importer_section',
                'title' => __('Import', 'oct-express')
            ),
        ),
        'settings' => array(
            /* Styling Options */

            array(
                'id' => 'skin_primary',
                'label' => __('Skin - Primary Color', 'oct-express'),
                'std' => '#2C4A58',
                'type' => 'colorpicker',
                'section' => 'styling_options',
            ),
            array(
                'id' => 'custom_skin_switch',
                'label' => __('Customize Skin', 'oct-express'),
                'desc' => __('Custom colors selection may override the Primary and Secondary Skin colors at some places', 'oct-express'),
                'std' => 'on',
                'type' => 'on-off',
                'class' => 'switch_div',
                'section' => 'styling_options',
            ),
            array(
                'id' => 'body_bg_tab',
                'label' => __('Body', 'oct-express'),
                'type' => 'tab',
                'section' => 'styling_options',
            ),
            array(
                'id' => 'body_bg',
                'label' => __('Background', 'oct-express'),
                'desc' => __('Body background with image, color, etc.', 'oct-express'),
                'std' => array(
                    'background-color' => '#E5E4E5'
                ),
                'type' => 'background',
                'section' => 'styling_options',
                'condition' => 'custom_skin_switch:is(on)',
            ),
            array(
                'id' => 'body_text_color',
                'label' => __('Body Text Color', 'oct-express'),
                'std' => '#313131',
                'type' => 'colorpicker',
                'section' => 'styling_options',
                'condition' => 'custom_skin_switch:is(on)',
            ),
            array(
                'id' => 'headings_colors',
                'label' => __('Headings Colors', 'oct-express'),
                'std' => array(
                    'h1' => '#313131',
                    'h2' => '#313131',
                    'h3' => '#313131',
                    'h4' => '#313131',
                    'h5' => '#313131',
                    'h6' => '#313131',
                ),
                'type' => 'link-color',
                'section' => 'styling_options',
                'condition' => 'custom_skin_switch:is(on)',
            ),
            array(
                'id' => 'body_link_color',
                'label' => __('Link Color', 'oct-express'),
                'std' => array(
                    'link' => '#2C4A58',
                    'active' => '#2C4A58',
                    'hover' => '#5a9e25',
                    'visited' => '#2C4A58',
                ),
                'type' => 'link-color',
                'section' => 'styling_options',
                'condition' => 'custom_skin_switch:is(on)',
            ),
            array(
                'id' => 'header_bg_tab',
                'label' => __('Header', 'oct-express'),
                'type' => 'tab',
                'section' => 'styling_options',
            /* 'condition'     => 'custom_skin_switch:is(on)', */
            ),
            array(
                'id' => 'header_bg',
                'label' => __('Background', 'oct-express'),
                'std' => array(
                    'background-color' => '#ebebeb',
                ),
                'type' => 'background',
                'section' => 'styling_options',
                'condition' => 'custom_skin_switch:is(on)',
            ),
            array(
                'id' => 'logo_color',
                'label' => __('Logo Text Color', 'oct-express'),
                'std' => array(
                    'link' => '#3e3e3e',
                    'hover' => ''
                ),
                'type' => 'link-color',
                'section' => 'styling_options',
                'condition' => 'custom_skin_switch:is(on)',
            ),
            array(
                'id' => 'menu_bg_tab',
                'label' => __('Menu', 'oct-express'),
                'type' => 'tab',
                'section' => 'styling_options',
            /* 'condition'     => 'custom_skin_switch:is(on)', */
            ),
            array(
                'id' => 'menu_bg_color',
                'label' => __('Menu Background Color', 'oct-express'),
                'type' => 'background',
                'section' => 'styling_options',
                'std' => array(
                    'background-color' => '#333333',
                ),
                'condition' => 'custom_skin_switch:is(on)',
            ),
            array(
                'id' => 'menu_link_color',
                'label' => __('Menu Item Color', 'oct-express'),
                'std' => array(
                    'link' => '#efefef',
                    'hover' => '#efefef',
                    'active' => '#efefef',
                ),
                'type' => 'link-color',
                'section' => 'styling_options',
                'condition' => 'custom_skin_switch:is(on)',
            ),
            array(
                'id' => 'menu_typo_bg',
                'label' => __('Menu Item Background Color', 'oct-express'),
                'std' => array(
                    'link' => '#333333',
                    'hover' => '#5a9e25',
                    'active' => '#5a9e25',
                ),
                'type' => 'link-color',
                'section' => 'styling_options',
                'condition' => 'custom_skin_switch:is(on)',
            ),
            array(
                'id' => 'submenu_link_color',
                'label' => __('Submenu Item Color', 'oct-express'),
                'std' => array(
                    'link' => '#efefef',
                    'hover' => '#efefef',
                    'active' => '#efefef',
                ),
                'type' => 'link-color',
                'section' => 'styling_options',
                'condition' => 'custom_skin_switch:is(on)',
            ),
            array(
                'id' => 'submenu_typo_bg',
                'label' => __('Submenu Item Background Color', 'oct-express'),
                'std' => array(
                    'link' => '#333333',
                    'hover' => '#5a9e25',
                    'active' => '#5a9e25',
                ),
                'type' => 'link-color',
                'section' => 'styling_options',
                'condition' => 'custom_skin_switch:is(on)',
            ),
            array(
                'id' => 'slider_color_tab',
                'label' => __('Slider', 'oct-express'),
                'type' => 'tab',
                'section' => 'styling_options',
            /* 'condition'     => 'custom_skin_switch:is(on)', */
            ),
            array(
                'id' => 'hbanner_text_color',
                'label' => __('Text Color', 'oct-express'),
                'type' => 'link-color',
                'std' => array(
                    'link' => '#efefef',
                    'hover' => '#efefef',
                ),
                'section' => 'styling_options',
                'condition' => 'custom_skin_switch:is(on)',
            ),
            array(
                'id' => 'hbanner_bg_color',
                'label' => __('Background', 'oct-express'),
                'type' => 'background',
                'std' => array(
                    'background-color' => '#000000',
                ),
                'section' => 'styling_options',
                'condition' => 'custom_skin_switch:is(on)',
            ),
            array(
                'id' => 'button_bg_tab',
                'label' => __('Buttons', 'oct-express'),
                'type' => 'tab',
                'section' => 'styling_options',
            /* 'condition'     => 'custom_skin_switch:is(on)', */
            ),
            /* Content Buttons */
            array(
                'id' => 'content_buttons_text_color',
                'label' => '<b>' . __('Content Buttons', 'oct-express') . '</b>',
                'type' => 'link-color',
                'std' => array(
                    'link' => '#efefef',
                    'hover' => '#efefef',
                    'active' => '#5a9e25',
                    'visited' => '#7CAE59',
                ),
                'section' => 'styling_options',
                'condition' => 'custom_skin_switch:is(on)',
            ),
            array(
                'id' => 'content_buttons_border_sw',
                'label' => __('Content Buttons - Show Border', 'oct-express'),
                'type' => 'on-off',
                'std' => 'off',
                'section' => 'styling_options',
                'condition' => 'custom_skin_switch:is(on)',
            ),
            array(
                'id' => 'content_buttons_border',
                'label' => __('Content Buttons - Border', 'oct-express'),
                'type' => 'border',
                'std' => array(
                    'width' => '1',
                    'unit' => 'px',
                    'style' => 'solid',
                    'color' => '#2C4A58',
                ),
                'section' => 'styling_options',
                'condition' => 'content_buttons_border_sw:is(on),custom_skin_switch:is(on)',
            ),
            array(
                'id' => 'content_buttons_border_rad',
                'label' => __('Content Buttons - Border Radius', 'oct-express'),
                'desc' => 'pixels',
                'type' => 'numeric-slider',
                'std' => '0',
                'section' => 'styling_options',
                'condition' => 'content_buttons_border_sw:is(on),custom_skin_switch:is(on)',
            ),
            array(
                'id' => 'footer_bg_tab',
                'label' => __('Footer', 'oct-express'),
                'type' => 'tab',
                'section' => 'styling_options',
            /* 'condition'     => 'custom_skin_switch:is(on)', */
            ),
            array(
                'id' => 'footer_bg',
                'label' => __('Background', 'oct-express'),
                'type' => 'background',
                'section' => 'styling_options',
                'std' => array(
                    'background-color' => '#202020',
                ),
                'condition' => 'custom_skin_switch:is(on)',
            ),
            array(
                'id' => 'footer_heading_color',
                'label' => __('Heading', 'oct-express'),
                'type' => 'colorpicker',
                'section' => 'styling_options',
                'std' => '#efefef',
                'condition' => 'custom_skin_switch:is(on)',
            ),
            array(
                'id' => 'footer_text_color',
                'label' => __('Text', 'oct-express'),
                'type' => 'colorpicker',
                'section' => 'styling_options',
                'std' => '#efefef',
                'condition' => 'custom_skin_switch:is(on)',
            ),
            array(
                'id' => 'footer_link_color',
                'label' => __('Link Color', 'oct-express'),
                'std' => array(
                    'link' => '#ffffff',
                    'active' => '#efefef',
                    'hover' => '#efefef',
                    'visited' => '#ffffff',
                ),
                'type' => 'link-color',
                'section' => 'styling_options',
                'condition' => 'custom_skin_switch:is(on)',
            ),
            array(
                'id' => 'copyright_bg',
                'label' => __('Copyright Background Color', 'oct-express'),
                'type' => 'background',
                'section' => 'styling_options',
                'std' => array(
                    'background-color' => '#181818',
                ),
                'condition' => 'custom_skin_switch:is(on)',
            ),
            array(
                'id' => 'copyright_color',
                'label' => __('Copyright Text Color', 'oct-express'),
                'type' => 'colorpicker',
                'std' => '#cccccc',
                'section' => 'styling_options',
                'condition' => 'custom_skin_switch:is(on)',
            ),
            /* ########### Header Options ########### */

            /* Logo */
            array(
                'id' => 'logo_switch',
                'label' => __('Show Logo', 'oct-express'),
                'std' => 'on',
                'type' => 'on-off',
                'section' => 'header_option',
                'class' => 'switch_div',
            ),
            array(
                'id' => 'logo_img',
                'label' => __('Upload Logo', 'oct-express'),
                'desc' => __('Site title will be displayed if no image uploaded.', 'oct-express') . '<br>' . __('Site title', 'oct-express') . ' : ' . get_bloginfo('blogname'),
                'std' => '',
                'type' => 'upload',
                'section' => 'header_option',
                'class' => 'align_top',
                'condition' => 'logo_switch:is(on)',
                'operator' => 'and'
            ),
            array(
                'id' => 'header_logo_height',
                'label' => __('Logo Height', 'oct-express'),
                'std' => array('130', 'px'),
                'type' => 'measurement',
                'section' => 'header_option',
            ),
            array(
                'id' => 'logo_text_helper',
                'label' => __('Manage Site Title', 'oct-express'),
                'desc' => '<span class="dashicons dashicons-external"></span> ' . sprintf('<a href="%s" target="_blank">' . __('Manage Logo Text', 'oct-express') . '</a>', admin_url('customize.php?autofocus[control]=blogname')) . '<br><br>' . __('To change the font style of logo', 'oct-express') . ': <b>' . __('Typography > Header Font Style > Logo Font Style', 'oct-express') . '</b>',
                'std' => '',
                'type' => 'textblock',
                'section' => 'header_option',
                'class' => 'ot-upload-attachment-id',
                'condition' => 'logo_switch:is(on)',
                'operator' => 'and'
            ),
            array(
                'id' => 'header_nav_helper',
                'label' => __('Manage Logo Text', 'oct-express'),
                'desc' => '<span class="dashicons dashicons-external"></span> ' . sprintf('<a href="%s" target="_blank">' . __('Manage Header Menu', 'oct-express') . '</a>', admin_url('customize.php?autofocus[panel]=nav_menus')) . '<br><br>' . __('To change the font style of header', 'oct-express') . ': <b>' . __('Typography > Header Font Style > Header Menu Font Style', 'oct-express') . '</b>',
                'std' => '',
                'type' => 'textblock',
                'section' => 'header_option',
                'class' => 'ot-upload-attachment-id',
            ),
            array(
                'id' => 'favicon_img',
                'desc' => '<span class="dashicons dashicons-external"></span> ' . sprintf('<a href="%s" target="_blank">' . __('Upload Favicon', 'oct-express') . '</a>', admin_url('customize.php?autofocus[control]=site_icon')) . '<br><br>' . __('Upload favicon of your website.', 'oct-express') . ' : <b>' . __('Customize > Site Identity > Site Icon', 'oct-express') . '</b>',
                'std' => '',
                'type' => 'textblock',
                'section' => 'header_option',
                'class' => 'ot-upload-attachment-id',
            ),
            /* #Fonts# */
            array(
                'id' => 'typo_fonts',
                'label' => __('Font Families', 'oct-express'),
                'desc' => __("Add fonts in your website.", "oct-express") . PHP_EOL . __("The newly added font families will appear after saving the options.", "oct-express"),
                'std' => array(
                    array(
                        'family' => 'robotoslab',
                        'variants' => array('400','700', 'regular', 'italic'),
                        'subsets' => array('latin', 'latin-ext')
                    ),
                ),
                'type' => 'google-fonts',
                'section' => 'typo_option',
                'rows' => '',
                'post_type' => '',
                'taxonomy' => '',
                'min_max_step' => '',
                'class' => 'align_top',
                'condition' => '',
                'operator' => 'and'
            ),
            array(
                'id' => 'font_typos',
                'label' => __('Font Styles', 'oct-express'),
                'desc' => __('Theme\'s default font properties can be changed from the section specific tabs given below.', 'oct-express'),
                'std' => '',
                'type' => 'textblock-titled',
                'section' => 'typo_option',
                'rows' => '',
                'post_type' => '',
                'taxonomy' => '',
                'min_max_step' => '',
                'class' => '',
                'condition' => '',
                'operator' => 'and'
            ),
            /* ############## Typography ################ /*
              /* Logo Fonts */
            array(
                'id' => 'logof_tab',
                'label' => __('Header', 'oct-express'),
                'type' => 'tab',
                'section' => 'typo_option',
            ),
            array(
                'id' => 'logo_typo',
                'label' => __('Logo Font Style', 'oct-express'),
                'desc' => __('This will change the typography of logo text only.', 'oct-express'),
                'std' => array(
                    'font-family' => 'robotoslab',
                    'font-color' => '#000000',
                    'font-size' => '40px',
                    'font-style' => 'normal',
                    'font-variant' => 'normal',
                    'font-weight' => 'bold',
                    'letter-spacing' => '',
                    'line-height' => '',
                    'text-decoration' => 'none',
                    'text-transform' => 'none',
                ),
                'type' => 'typography',
                'section' => 'typo_option',
            ),
            array(
                'id' => 'menu_typo',
                'label' => __('Header Menu Font Style', 'oct-express'),
                'desc' => __('This will change the typography of navigation menu in header.', 'oct-express'),
                'std' => array(
                    'font-family' => 'robotoslab',
                    'font-color' => '#000000',
                    'font-size' => '14px',
                    'font-style' => 'normal',
                    'font-variant' => 'normal',
                    'font-weight' => '500',
                    'letter-spacing' => '',
                    'line-height' => '',
                    'text-decoration' => 'none',
                    'text-transform' => 'none',
                ),
                'type' => 'typography',
                'section' => 'typo_option',
            ),
            /* Body Fonts */
            array(
                'id' => 'bodyf_tab',
                'label' => __('Body', 'oct-express'),
                'type' => 'tab',
                'section' => 'typo_option',
            ),
            array(
                'id' => 'body_typo',
                'label' => __('Body', 'oct-express'),
                'desc' => __('This will change the typography of content areas only.', 'oct-express'),
                'std' => array(
                    'font-family' => 'arial',
                    'font-color' => '#000000',
                    'font-size' => '14px',
                    'font-style' => 'normal',
                    'font-variant' => 'normal',
                    'font-weight' => '400',
                    'letter-spacing' => '',
                    'line-height' => '',
                    'text-decoration' => 'none',
                    'text-transform' => 'none',
                ),
                'type' => 'typography',
                'section' => 'typo_option',
            ),
            /* H1 - H6 */
            array(
                'id' => 'h1_typo',
                'label' => __('H1 Font Style', 'oct-express'),
                'std' => array(
                    'font-family' => 'robotoslab',
                    'font-color' => '#000000',
                    'font-size' => '26px',
                    'font-style' => 'normal',
                    'font-variant' => 'normal',
                    'font-weight' => '700',
                    'letter-spacing' => '',
                    'line-height' => '',
                    'text-decoration' => 'none',
                    'text-transform' => 'none',
                ),
                'type' => 'typography',
                'section' => 'typo_option',
            ),
            array(
                'id' => 'h2_typo',
                'label' => __('H2 Font Style', 'oct-express'),
                'std' => array(
                    'font-family' => 'robotoslab',
                    'font-color' => '#000000',
                    'font-size' => '22px',
                    'font-style' => 'normal',
                    'font-variant' => 'normal',
                    'font-weight' => '400',
                    'letter-spacing' => '',
                    'line-height' => '',
                    'text-decoration' => 'none',
                    'text-transform' => 'none',
                ),
                'type' => 'typography',
                'section' => 'typo_option',
            ),
            array(
                'id' => 'h3_typo',
                'label' => __('H3 Font Style', 'oct-express'),
                'std' => array(
                    'font-family' => 'robotoslab',
                    'font-color' => '#000000',
                    'font-size' => '20px',
                    'font-style' => 'normal',
                    'font-variant' => 'normal',
                    'font-weight' => '400',
                    'letter-spacing' => '',
                    'line-height' => '',
                    'text-decoration' => 'none',
                    'text-transform' => 'none',
                ),
                'type' => 'typography',
                'section' => 'typo_option',
            ),
            array(
                'id' => 'h4_typo',
                'label' => __('H4 Font Style', 'oct-express'),
                'std' => array(
                    'font-family' => 'robotoslab',
                    'font-color' => '#000000',
                    'font-size' => '18px',
                    'font-style' => 'normal',
                    'font-variant' => 'normal',
                    'font-weight' => '400',
                    'letter-spacing' => '',
                    'line-height' => '',
                    'text-decoration' => 'none',
                    'text-transform' => 'none',
                ),
                'type' => 'typography',
                'section' => 'typo_option',
            ),
            array(
                'id' => 'h5_typo',
                'label' => __('H5 Font Style', 'oct-express'),
                'std' => array(
                    'font-family' => 'robotoslab',
                    'font-color' => '#000000',
                    'font-size' => '16px',
                    'font-style' => 'normal',
                    'font-variant' => 'normal',
                    'font-weight' => '400',
                    'letter-spacing' => '',
                    'line-height' => '',
                    'text-decoration' => 'none',
                    'text-transform' => 'none',
                ),
                'type' => 'typography',
                'section' => 'typo_option',
            ),
            array(
                'id' => 'h6_typo',
                'label' => __('H6 Font Style', 'oct-express'),
                'std' => array(
                    'font-family' => 'robotoslab',
                    'font-color' => '#000000',
                    'font-size' => '14px',
                    'font-style' => 'normal',
                    'font-variant' => 'normal',
                    'font-weight' => '400',
                    'letter-spacing' => '',
                    'line-height' => '',
                    'text-decoration' => 'none',
                    'text-transform' => 'none',
                ),
                'type' => 'typography',
                'section' => 'typo_option',
            ),
            /* Buttons */
            array(
                'id' => 'buttonsf_tab',
                'label' => __('Buttons', 'oct-express'),
                'type' => 'tab',
                'section' => 'typo_option',
            ),
            array(
                'id' => 'content_button_typo',
                'label' => __('Content Buttons', 'oct-express'),
                'desc' => '',
                'std' => array(
                    'font-family' => 'robotoslab',
                    'font-color' => '#000000',
                    'font-size' => '14px',
                    'font-style' => 'normal',
                    'font-variant' => 'normal',
                    'font-weight' => 'normal',
                    'letter-spacing' => '',
                    'line-height' => '',
                    'text-decoration' => 'none',
                    'text-transform' => 'none',
                ),
                'type' => 'typography',
                'section' => 'typo_option',
            ),
            /* Footer */
            array(
                'id' => 'footerf_tab',
                'label' => __('Footer', 'oct-express'),
                'type' => 'tab',
                'section' => 'typo_option',
            ),
            array(
                'id' => 'footer_heading_typo',
                'label' => __('Heading', 'oct-express'),
                'desc' => __('This will change the typography of the Footer.', 'oct-express'),
                'std' => array(
                    'font-family' => 'robotoslab',
                    'font-color' => '#000000',
                    'font-size' => '20px',
                    'font-style' => 'normal',
                    'font-variant' => 'normal',
                    'font-weight' => '500',
                    'letter-spacing' => '',
                    'line-height' => '',
                    'text-decoration' => 'none',
                    'text-transform' => 'none',
                ),
                'type' => 'typography',
                'section' => 'typo_option',
            ),
            array(
                'id' => 'footer_text_typo',
                'label' => __('Text', 'oct-express'),
                'std' => array(
                    'font-family' => 'robotoslab',
                    'font-color' => '#000000',
                    'font-size' => '13px',
                    'font-style' => 'normal',
                    'font-variant' => 'normal',
                    'font-weight' => 'normal',
                    'letter-spacing' => '',
                    'line-height' => '22px',
                    'text-decoration' => 'none',
                    'text-transform' => 'none',
                ),
                'type' => 'typography',
                'section' => 'typo_option',
            ),
            /* Slider Options */
            array(
                'id' => 'slider_posts_url',
                'label' => __('Manage Slider', 'oct-express'),
                'desc' => sprintf('<span class="dashicons dashicons-external"></span> <a href="%s" target="_blank">' . __('Edit Slides', 'oct-express') . '</a>', admin_url('edit.php?post_type=oc_slider')),
                'type' => 'textblock-titled',
                'section' => 'slider_option',
            ),
            array(
                'label' => __('Homepage Slider', 'oct-express'),
                'id' => 'home_slider_switch',
                'desc' => __('This setting will be applied to the home page only. You can apply a similar setting on individual pages as well.', 'oct-express'),
                'type' => 'on-off',
                'class' => 'switch_div',
                'std' => 'off',
                'section' => 'slider_option',
            ),
            array(
                'id' => 'oct_home_slide_count',
                'label' => __('Number of slides', 'oct-express'),
                'desc' => __('This setting will be applied to the home page only. You can apply a similar setting on individual pages as well.', 'oct-express'),
                'type' => 'text',
                'std' => '4',
                'rows' => '1',
                'condition' => 'home_slider_switch:is(on)',
                'section' => 'slider_option',
            ),
            array(
                'id' => 'oct_home_slide_interval',
                'label' => __('Interval', 'oct-express'),
                'desc' => __('This specifies the delay (in milliseconds) between each slide.', 'oct-express'),
                'type' => 'text',
                'std' => '5000',
                'rows' => '1',
                'condition' => 'home_slider_switch:is(on)',
                'section' => 'slider_option',
            ),
            /* Blog Options */
            array(
                'id' => 'show_post_meta',
                'label' => __('Show Post Metadata', 'oct-express'),
                'desc' => __('This will show/hide the post details.', 'oct-express') . '<br>' . __('For example: Post Author, Published Date, Post Categories', 'oct-express'),
                'std' => 'on',
                'type' => 'on-off',
                'section' => 'blog_options',
                'class' => 'switch_div',
            ),
            array(
                'id' => 'show_blog_thumb',
                'label' => __('Show Thumbnail', 'oct-express'),
                'desc' => __('This will show/hide the featured images on archive pages.', 'oct-express', 'oct-express'),
                'std' => 'on',
                'type' => 'on-off',
                'section' => 'blog_options',
                'class' => 'switch_div',
            ),
            array(
                'id' => 'blog_button_label',
                'label' => __('Button Title', 'oct-express'),
                'std' => 'Read More',
                'type' => 'text',
                'section' => 'blog_options',
            ),
            // Layout section
            array(
                'id' => 'header_layout',
                'label' => __('Header Layout', 'oct-express'),
                'desc' => __('This will change the position of elements on header.', 'oct-express'),
                'std' => 'center-logo',
                'type' => 'radio-image',
                'section' => 'layout_options',
                'choices' => array(
                    array(
                        'value' => 'left-logo-right-widget',
                        'label' => __('Left logo with right widget', 'oct-express'),
                        'src' => get_template_directory_uri() . '/option-tree/assets/images/layout/header-layout-1.png',
                    ),
                    array(
                        'value' => 'center-logo',
                        'label' => __('Center logo only', 'oct-express'),
                        'src' => get_template_directory_uri() . '/option-tree/assets/images/layout/header-layout-2.png',
                    ),
                )
            ),
            array(
                'id' => 'blog_layout_radio',
                'label' => __('Blog Listing - Page Layout', 'oct-express'),
                'desc' => __('This will change the visibility and position of sidebar on the blog post listing pages.', 'oct-express'),
                'std' => 'three-column-no-sidebar',
                'type' => 'radio-image',
                'section' => 'layout_options',
                'choices' => array(
                    array(
                        'value' => 'one-column-no-sidebar',
                        'label' => __('One column without sidebar', 'oct-express'),
                        'src' => get_template_directory_uri() . '/option-tree/assets/images/layout/one-column.png',
                    ),
                    array(
                        'value' => 'two-column-no-sidebar',
                        'label' => __('Two columns without sidebar', 'oct-express'),
                        'src' => get_template_directory_uri() . '/option-tree/assets/images/layout/two-column.png',
                    ),
                    array(
                        'value' => 'three-column-no-sidebar',
                        'label' => __('Three columns without sidebar', 'oct-express'),
                        'src' => get_template_directory_uri() . '/option-tree/assets/images/layout/three-column.png',
                    ),
                    array(
                        'value' => 'one-column-right-sidebar',
                        'label' => __('One column with right sidebar', 'oct-express'),
                        'src' => get_template_directory_uri() . '/option-tree/assets/images/layout/one-column-sidebar.png',
                    ),
                    array(
                        'value' => 'two-column-right-sidebar',
                        'label' => __('Two columns with right sidebar', 'oct-express'),
                        'src' => get_template_directory_uri() . '/option-tree/assets/images/layout/two-column-sidebar.png',
                    ),
                    array(
                        'value' => 'one-column-left-sidebar',
                        'label' => __('One column with left sidebar', 'oct-express'),
                        'src' => get_template_directory_uri() . '/option-tree/assets/images/layout/sidebar-one-column.png',
                    ),
                    array(
                        'value' => 'two-column-left-sidebar',
                        'label' => __('Two columns with left sidebar', 'oct-express'),
                        'src' => get_template_directory_uri() . '/option-tree/assets/images/layout/sidebar-two-column.png',
                    ),
                )
            ),
            array(
                'id' => 'single_post_layout',
                'label' => __('Single Post - Page Layout', 'oct-express'),
                'desc' => __('This will change the visibility and position of sidebar on the post details pages.', 'oct-express') . PHP_EOL . __('Note: You can override this setting on a specific post.', 'oct-express'),
                'std' => 'one-column-right-sidebar',
                'type' => 'radio-image',
                'section' => 'layout_options',
                'choices' => array(
                    array(
                        'value' => 'one-column-right-sidebar',
                        'label' => __('One column with right sidebar', 'oct-express'),
                        'src' => get_template_directory_uri() . '/option-tree/assets/images/layout/one-column-sidebar.png',
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
            array(
                'id' => 'single_page_layout',
                'label' => __('Single Page - Page layout', 'oct-express'),
                'desc' => __('This will change the visibility and position of the sidebar on the pages.', 'oct-express') . PHP_EOL . __('Note: You can override this setting on a specific page.', 'oct-express'),
                'std' => 'one-column-right-sidebar',
                'type' => 'radio-image',
                'section' => 'layout_options',
                'choices' => array(
                    array(
                        'value' => 'one-column-right-sidebar',
                        'label' => __('One column with right sidebar', 'oct-express'),
                        'src' => get_template_directory_uri() . '/option-tree/assets/images/layout/one-column-sidebar.png',
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
            /* Social Icons Links */
            array(
                'id' => 'social_icons',
                'label' => __('Social Links', 'oct-express'),
                'desc' => __('Enter your social profile links here:', 'oct-express'),
                'type' => 'list-item',
                'section' => 'social_links',
                'rows' => '',
                'post_type' => '',
                'taxonomy' => '',
                'min_max_step' => '',
                'class' => 'hide_title social_grid align_top',
                'operator' => 'and',
                'settings' => array(
                    array(
                        'id' => 'social_icon_entry',
                        'label' => __('Social Profile Icon', 'oct-express'),
                        'desc' => '',
                        'class' => 'social_icons_array',
                        'type' => 'radio-image',
                        'choices' => array(
                            array(
                                'value' => 'facebook',
                                'label' => 'Facebook',
                                'src' => get_template_directory_uri() . '/assets/images/social/facebook.svg',
                            ),
                            array(
                                'value' => 'linkedin',
                                'label' => 'LinkedIn',
                                'src' => get_template_directory_uri() . '/assets/images/social/linkedin.svg',
                            ),
                            array(
                                'value' => 'twitter',
                                'label' => 'Twitter',
                                'src' => get_template_directory_uri() . '/assets/images/social/twitter.svg',
                            ),
                            array(
                                'value' => 'instagram',
                                'label' => 'Instagram',
                                'src' => get_template_directory_uri() . '/assets/images/social/instagram.svg',
                            ),
                            array(
                                'value' => 'skype',
                                'label' => 'Skype',
                                'src' => get_template_directory_uri() . '/assets/images/social/skype.svg',
                            ),
                            array(
                                'value' => 'youtube',
                                'label' => 'Youtube',
                                'src' => get_template_directory_uri() . '/assets/images/social/youtube.svg',
                            ),
                            array(
                                'value' => 'vimeo',
                                'label' => 'Vimeo',
                                'src' => get_template_directory_uri() . '/assets/images/social/vimeo.svg',
                            ),
                            array(
                                'value' => 'pinterest',
                                'label' => 'Pinterest',
                                'src' => get_template_directory_uri() . '/assets/images/social/pinterest.svg',
                            ),
                            array(
                                'value' => 'stumbleupon',
                                'label' => 'Stumblupon',
                                'src' => get_template_directory_uri() . '/assets/images/social/stumblupon.svg',
                            ),
                            array(
                                'value' => 'tumblr',
                                'label' => 'Tumblr',
                                'src' => get_template_directory_uri() . '/assets/images/social/tumblr.svg',
                            ),
                            array(
                                'value' => 'behance',
                                'label' => 'Behance',
                                'src' => get_template_directory_uri() . '/assets/images/social/behance.svg',
                            ),
                            array(
                                'value' => 'blogger',
                                'label' => 'Blogger',
                                'src' => get_template_directory_uri() . '/assets/images/social/blogger.svg',
                            ),
                            array(
                                'value' => 'delicios',
                                'label' => 'Delicios',
                                'src' => get_template_directory_uri() . '/assets/images/social/delicios.svg',
                            ),
                            array(
                                'value' => 'github',
                                'label' => 'Github',
                                'src' => get_template_directory_uri() . '/assets/images/social/github.svg',
                            ),
                            array(
                                'value' => 'amazon',
                                'label' => 'Amazon',
                                'src' => get_template_directory_uri() . '/assets/images/social/amazon.svg',
                            ),
                            array(
                                'value' => 'android',
                                'label' => 'Android',
                                'src' => get_template_directory_uri() . '/assets/images/social/android.svg',
                            ),
                            array(
                                'value' => 'apple',
                                'label' => 'Apple',
                                'src' => get_template_directory_uri() . '/assets/images/social/apple.svg',
                            ),
                            array(
                                'value' => 'digg',
                                'label' => 'Digg',
                                'src' => get_template_directory_uri() . '/assets/images/social/digg.svg',
                            ),
                            array(
                                'value' => 'dribble',
                                'label' => 'Dribble',
                                'src' => get_template_directory_uri() . '/assets/images/social/dribble.svg',
                            ),
                            array(
                                'value' => 'dropbox',
                                'label' => 'Dropbox',
                                'src' => get_template_directory_uri() . '/assets/images/social/dropbox.svg',
                            ),
                            array(
                                'value' => 'ebay',
                                'label' => 'Ebay',
                                'src' => get_template_directory_uri() . '/assets/images/social/ebay.svg',
                            ),
                            array(
                                'value' => 'foursquare',
                                'label' => 'Foursquare',
                                'src' => get_template_directory_uri() . '/assets/images/social/foursquare.svg',
                            ),
                            array(
                                'value' => 'myspace',
                                'label' => 'Myspace',
                                'src' => get_template_directory_uri() . '/assets/images/social/myspace.svg',
                            ),
                            array(
                                'value' => 'soundcloud',
                                'label' => 'Soundcloud',
                                'src' => get_template_directory_uri() . '/assets/images/social/soundcloud.svg',
                            ),
                            array(
                                'value' => 'stackoverflow',
                                'label' => 'Stackoverflow',
                                'src' => get_template_directory_uri() . '/assets/images/social/stackoverflow.svg',
                            ),
                            array(
                                'value' => 'windows',
                                'label' => 'Windows',
                                'src' => get_template_directory_uri() . '/assets/images/social/windows.svg',
                            ),
                            array(
                                'value' => 'wordpress',
                                'label' => 'WordPress',
                                'src' => get_template_directory_uri() . '/assets/images/social/wordpress.svg',
                            ),
                            array(
                                'value' => 'rss',
                                'label' => 'RSS',
                                'src' => get_template_directory_uri() . '/assets/images/social/rss.svg',
                            ),
                            array(
                                'value' => 'connection',
                                'label' => 'Social',
                                'src' => get_template_directory_uri() . '/assets/images/social/general.svg',
                            ),
                        ),
                    ),
                    array(
                        'id' => 'social_profile_link',
                        'label' => __('Social Profile Link', 'oct-express'),
                        'std' => '#',
                        'type' => 'text',
                    ),
                ),
                'std' => $social_std,
            ),
            /* Footer */
            array(
                'id' => 'footer_color',
                'label' => __('Footer Color', 'oct-express'),
                'type' => 'colorpicker',
                'section' => 'footer_options',
                'condition' => 'footer_widgets_switch:is(on)',
                'std' => '#ffffff',
            ),
            array(
                'id' => 'copyright_text',
                'label' => __('Copyright Text', 'oct-express'),
                'std' => 'Copyright &copy; All Rights Reserved.',
                'type' => 'text',
                'section' => 'footer_options',
            ),
            array(
                'id' => 'footer_widgets_url',
                'label' => __('Manage Footer Widgets', 'oct-express'),
                'desc' => sprintf('<span class="dashicons dashicons-external"></span> <a href="%s" target="_blank">' . __('Edit Footer Widgets', 'oct-express') . '</a>', admin_url('widgets.php')),
                'type' => 'textblock-titled',
                'section' => 'footer_options',
            ),
            /* Miscellaneous */

            /* Custom CSS */
            array(
                'id' => 'custom_css',
                'label' => __('Custom CSS', 'oct-express'),
                'desc' => __('The rules added here will be applied as additional CSS.', 'oct-express'),
                'type' => 'css',
                'section' => 'advanced_options',
                'std' => '/* Your custom CSS goes here */',
            ),
            array(
                'id' => 'head_scripts',
                'label' => __('Head Scripts', 'oct-express'),
                'desc' => __('Scripts to be inserted in "head" tag.', 'oct-express'),
                'std' => '',
                'type' => 'textarea-simple',
                'rows' => '3',
                'section' => 'advanced_options',
            ),
            array(
                'id' => 'footer_scripts',
                'label' => __('Footer Scripts', 'oct-express'),
                'desc' => __('Scripts to be inserted after footer.', 'oct-express'),
                'std' => '',
                'type' => 'textarea-simple',
                'rows' => '3',
                'section' => 'advanced_options',
            ),
            array(
                'id' => '404_content',
                'label' => __('404 Page Content', 'oct-express'),
                'type' => 'textarea',
                'section' => 'advanced_options',
                'std' => '<h1>{404} Not Found!</h1><h3>Sorry, we could not find what you were looking for.</h3>',
            ),
            array(
                'id' => 'importer_button',
                'label' => __('Import', 'oct-express'),
                'type' => 'onecom_importer',
                'section' => 'importer_section',
                'class' => 'importer',
            ),
        )
    );

    /* allow settings to be filtered before saving */
    $custom_settings = apply_filters(ot_settings_id() . '_args', $custom_settings);

    /* settings are not the same update the DB */
    if ($saved_settings !== $custom_settings) {
        update_option(ot_settings_id(), $custom_settings);
    }

    /* Lets OptionTree know the UI Builder is being overridden */
    global $ot_has_custom_theme_options;
    $ot_has_custom_theme_options = true;
}
