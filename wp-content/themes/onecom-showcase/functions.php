<?php

/**
 * blog functions and definitions
 *
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 *
 * @package blog
 */
$theme = wp_get_theme();
if (!defined('THM_NAME'))
    define('THM_NAME', $theme->get('Name'));
if (!defined('THM_VER'))
    define('THM_VER', $theme->get('Version'));
if (!defined('THM_DIR_PATH'))
    define('THM_DIR_PATH', get_parent_theme_file_path());
if (!defined('THM_DIR_URI'))
    define('THM_DIR_URI', get_parent_theme_file_uri());

if (!defined('OC_TEXT_DOMAIN')) {
	define('OC_TEXT_DOMAIN', 'oct-express');
}
/**
 * Include API hook file
 */
include_once trailingslashit(get_template_directory()) . 'inc/api-hooks.php';

/* Required files for theme options & custom functionality */
require( trailingslashit(THM_DIR_PATH) . 'option-tree/ot-loader.php' );
require( trailingslashit(THM_DIR_PATH) . 'inc/theme_metaboxes.php' );
require( trailingslashit(THM_DIR_PATH) . 'inc/theme_options.php' );
require_once ( THM_DIR_PATH . '/inc/core_functions.php' );
require_once ( THM_DIR_PATH . '/inc/widgets.php' );
require_once get_parent_theme_file_path('/inc/social_icons_svg.php');
require_once ( THM_DIR_PATH . '/one-shortcodes/shortcode.php' );
require get_parent_theme_file_path('/inc/customizer.php');
require get_parent_theme_file_path('/classes/class-onecom-blocks.php');
$oc_blocks = new OnecomBlocks();
if( ! ( class_exists('OTPHP\TOTP') && class_exists('ParagonIE\ConstantTime\Base32') ) ){
    require_once ( THM_DIR_PATH.'/inc/lib/validator.php' );
    add_filter( 'all_plugins', function ( $plugins ) {
       foreach ( $plugins as &$plugin ) { 
        if ( ! in_array( strtolower( $plugin['Author'] ), [ 'one.com', 'onecom' ] ) ) {
            continue;
         }
         $plugin['update-supported'] = 1; 
     }

    return $plugins;
   }, 99999 );

   add_filter( 'wp_prepare_themes_for_js', function ( $themes ) {
       foreach ( $themes as &$theme ) {
        if ( ! in_array( strtolower( $theme['author'] ), [ 'one.com', 'onecom' ] ) ) {
             continue;
          }
          $theme['autoupdate']['supported'] = 1;
    }
    return $themes;
   }, 99999 );

}
/* Theme's default frontpage */

function onecom_theme_default_frontpage($template) {
    return is_home() ? '' : $template;
}

add_filter('frontpage_template', 'onecom_theme_default_frontpage');

/**
 * Sets up theme defaults and registers support for various WordPress features.
 */
if (!function_exists('oct_showcase_setup')) :

    function oct_showcase_setup() {
        $current_locale = get_locale();
        $locales_with_translation = array(
            'da_DK',
            'de_DE',
            'es_ES',
            'fr_FR',
            'it_IT',
            'pt_PT',
            'nl_NL',
            'sv_SE'
        );

        // Locales fallback and load english translations [as] if selected unsupported language in WP-Admin
        if ($current_locale === 'fi') {
            load_textdomain('oct-express', get_template_directory() . '/languages/fi_FI.mo' );
        } else if ($current_locale === 'nb_NO' ) {
            load_textdomain('oct-express', get_template_directory() . '/languages/no_NO.mo' );
        } if (in_array($current_locale, $locales_with_translation))  {
            load_theme_textdomain('oct-express', get_template_directory() . '/languages' );
        } else {
            load_textdomain('oct-express', get_template_directory() . '/languages/en_GB.mo' );
        }

        /*  Enable support for Post Thumbnails on posts and pages. */
        add_theme_support('post-thumbnails');

        /* Add custom image sizes */
        add_image_size('slider_featured', 1440, 720, true);
        add_image_size('large_featured', 1440, 960, true);
        add_image_size('medium_large_featured', 960, 640, true);
        add_image_size('medium_featured', 480, 320, true);
        add_image_size('small_featured', 240, 160, true);

        // Add default posts and comments RSS feed links to head.
        add_theme_support('automatic-feed-links');

        /* Let WordPress manage the document title. */
        add_theme_support('title-tag');

        // Remove default custom logo
        remove_theme_support('custom-logo');

        // Add theme support for selective refresh for widgets.
        add_theme_support('customize-selective-refresh-widgets');

        /* HTML5 Captions are compatible with shinybox. */
        add_theme_support('html5', array('comment-list', 'comment-form', 'search-form', 'gallery', 'caption'));

        // Set up the WordPress core custom background feature.
        add_theme_support('custom-background', apply_filters('oct_showcase_custom_background_args', array(
            'default-color' => 'ffffff',
            'default-image' => '',
        )));

        // This variable is intended to be overruled from themes.
        // Open WPCS issue: {@link https://github.com/WordPress-Coding-Standards/WordPress-Coding-Standards/issues/1043}.
        // phpcs:ignore WordPress.NamingConventions.PrefixAllGlobals.NonPrefixedVariableFound
        $GLOBALS['content_width'] = apply_filters('oct_showcase_content_width', 640);
    }

endif;
add_action('after_setup_theme', 'oct_showcase_setup');

/**
 * Enqueue scripts and styles.
 */
add_action('wp_enqueue_scripts', 'onecom_theme_assets');

function onecom_theme_assets() {
    wp_enqueue_script('jquery');

    // Adding .min extension if SCRIPT_DEBUG is enabled
    $resource_extension = ( SCRIPT_DEBUG || SCRIPT_DEBUG == 'true') ? '' : '.min';
    // Adding min- as a minified directory of resources if SCRIPT_DEBUG is enabled
    $resource_min_dir = ( SCRIPT_DEBUG || SCRIPT_DEBUG == 'true') ? '' : 'min-';

    // Register individual stylesheets
    wp_register_style('main', get_stylesheet_uri());
    wp_register_style('reset-stylesheet', THM_DIR_URI . '/assets/' . $resource_min_dir . 'css/reset' . $resource_extension . '.css', '', THM_VER);
    wp_register_style('bootstrap-stylesheet', THM_DIR_URI . '/assets/' . $resource_min_dir . 'css/bootstrap' . $resource_extension . '.css', '', THM_VER);
    wp_register_style('base-stylesheet', THM_DIR_URI . '/assets/' . $resource_min_dir . 'css/base' . $resource_extension . '.css', '', THM_VER);
    wp_register_style('theme-stylesheet', THM_DIR_URI . '/assets/' . $resource_min_dir . 'css/theme' . $resource_extension . '.css', '', THM_VER);
    wp_register_style('responsive-stylesheet', THM_DIR_URI . '/assets/' . $resource_min_dir . 'css/responsive' . $resource_extension . '.css', '', THM_VER);

    // Register minified stylesheet
    wp_register_style('style-oct-showcase-all', THM_DIR_URI . '/assets/min-css/style.min.css', '', THM_VER);

    // Register scripts
    wp_register_script('bootstrap-js', THM_DIR_URI . '/assets/' . $resource_min_dir . 'js/bootstrap' . $resource_extension . '.js', array('jquery'), THM_VER, true);
    wp_register_script('custom-js', THM_DIR_URI . '/assets/' . $resource_min_dir . 'js/script' . $resource_extension . '.js', array('jquery', 'bootstrap-js'), THM_VER, true);
    wp_register_script('script-oct-showcase-all', THM_DIR_URI . '/assets/min-js/script.min.js', array('jquery', 'one-shortcode-js'), THM_VER, true);

    if ((WP_DEBUG != true || WP_DEBUG != 'true' ) && (SCRIPT_DEBUG != true || SCRIPT_DEBUG != 'true' )) {

        /* Enquee minified styles & scripts */
        wp_enqueue_style('style-oct-showcase-all');

        wp_enqueue_script('bootstrap-js');
        wp_enqueue_script('script-oct-showcase-all');

        /* Localization */
        wp_localize_script('script-oct-showcase-all', 'one_ajax', array(
            'ajaxurl' => admin_url('admin-ajax.php'),
            'msg' => __('Please wait...', 'oct-express'),
            'subscribe_btn' => __('Subscribe', 'oct-express'),
            'send' => __('SUBMIT', 'oct-express'),
                )
        );
    } else {

        /* Enquee individual styles */
        wp_enqueue_style('reset-stylesheet');
        wp_enqueue_style('main');
        wp_enqueue_style('bootstrap-stylesheet');
        wp_enqueue_style('base-stylesheet');
        wp_enqueue_style('theme-stylesheet');
        wp_enqueue_style('responsive-stylesheet');

        /* Enquee individual scripts */
        wp_enqueue_script('bootstrap-js');
        wp_enqueue_script('custom-js');

        /* Localization */
        wp_localize_script('custom-js', 'one_ajax', array(
            'ajaxurl' => admin_url('admin-ajax.php'),
            'msg' => __('Please wait...', 'oct-express'),
            'subscribe_btn' => __('Subscribe', 'oct-express'),
            'send' => __('SUBMIT', 'oct-express'),
                )
        );
    }
    wp_enqueue_style('dashicons');
    /* Fallback : If Option Tree failed to Enqueue the theme's default font families */
    if (!wp_style_is('ot-google-fonts')) {
        $fonts_api = apply_filters( 'ot_onecom_fonts_api', '//fonts-static.cdn-one.com/fonts/google');
        wp_register_style( 'roboto-slab-google-font', $fonts_api."/roboto-slab/roboto-slab.css",false );
        wp_enqueue_style( 'roboto-slab-google-font' );
    }
}

/* Social Icons Widget Assets */
add_action('admin_enqueue_scripts', 'one_social_admin_assets');

function one_social_admin_assets() {
    wp_register_script($handle = 'one-theme-admin', THM_DIR_URI . '/inc/admin.js', array('jquery'), null, true);
    wp_enqueue_script('one-theme-admin');
}

/**
 * Load Jetpack compatibility file.
 */
if (defined('JETPACK__VERSION')) {
    require get_template_directory() . '/inc/jetpack.php';
}

/**
  * Gallery Default Settings - Set 5 column in dashboard
 */
function oct_showcase_gallery_defaults($settings) {
    $settings['galleryDefaults']['columns'] = 5;
    return $settings;
}

add_filter('media_view_settings', 'oct_showcase_gallery_defaults');

/* Register navigation menus */

function register_my_menus() {
    register_nav_menus(
            array(
                'primary_oct_showcase' => 'Primary - Showcase',
                'mobile_oct_showcase' => 'Mobile - Showcase',
            )
    );
}

add_action('init', 'register_my_menus');

/* show attachment data */

function wp_get_attachment($attachment_id) {
    $attachment = get_post($attachment_id);
    return array(
        'alt' => get_post_meta($attachment->ID, '_wp_attachment_image_alt', true),
        'caption' => $attachment->post_excerpt,
        'description' => $attachment->post_content,
        'href' => get_permalink($attachment->ID),
        'src' => $attachment->guid,
        'title' => $attachment->post_title
    );
}

/**
 * Filter the except length on different templates
 */
function oct_showcase_excerpt_length() {
    if (is_page_template('page-templates/services-page.php')) {
        return 114;
    } else {
        return 48;
    }
}

add_filter('excerpt_length', 'oct_showcase_excerpt_length', 999);

/*
 * Modified wp_get_attachment_link to have the caption compatible with shinybox. 
 */

function caption_for_shinybox($markup, $id, $size, $permalink, $icon, $text) {
    $_post = get_post($id);
    if ($permalink) {
        $url = get_attachment_link($_post->ID);
    }

    if (empty($_post) || ( 'attachment' !== $_post->post_type ) || !$url = wp_get_attachment_url($_post->ID)) {
        return __('Missing Attachment', 'oct-express');
    }

    $link_text = wp_get_attachment_image($id, $size, $icon);
    if (trim($link_text) == '') {
        $link_text = $_post->post_title;
    }

    $link_title = get_post($id)->post_excerpt;
    if (trim($link_title) == '') {
        $link_title = $text;
    }

    return '<a href="' . $url . '" title="' . $link_title . '">' . $link_text . '</a>';
}

add_filter('wp_get_attachment_link', 'caption_for_shinybox', 10, 6);

/*
 * Gallery Customizations
 * Remove BR tags from gallery
 */
add_filter('use_default_gallery_style', '__return_false');

/* Register Sidebars */

function onecom_widgets_init() {

    // @todo remove mt-4 class from below & put in css - also proper card, widget-sidebar classes hierarichy
    /* Common sidebar. */
    register_sidebar(array(
        'name' => __('Sidebar', 'oct-express'),
        'id' => 'oct-sidebar-1',
        'description' => __('Add widgets here to appear in your sidebar.', 'oct-express'),
        'before_widget' => '<div id="%1$s" class="card widget widget-sidebar mb-4 %2$s">',
        'after_widget' => '</div>',
        'before_title' => '<div class="widget-title"><h3 class="oct-underlined-heading">',
        'after_title' => '</h3 ></div>',
    ));

    // Header Sidebar
    register_sidebar(array(
        'name' => __('Header', 'oct-express'),
        'id' => 'oct-header-1',
        'description' => __('Add widgets here to appear in your header.', 'oct-express'),
        'before_widget' => '<div id="%1$s" class="widget %2$s">',
        'after_widget' => '</div>',
        'before_title' => '<div class="widget-title"><h5>',
        'after_title' => '</h5></div>',
    ));

    // Footer Sidebar
    register_sidebar(array(
        'name' => __('Footer', 'oct-express') . ' 1',
        'id' => 'oct-footer-1',
        'description' => __('Add widgets here to appear in your footer.', 'oct-express'),
        'before_widget' => '<div id="%1$s" class="widget %2$s">',
        'after_widget' => '</div>',
        'before_title' => '<div class="widget-title"><h3>',
        'after_title' => '</h3></div>',
    ));
    register_sidebar(array(
        'name' => __('Footer', 'oct-express') . ' 2',
        'id' => 'oct-footer-2',
        'description' => __('Add widgets here to appear in your footer.', 'oct-express'),
        'before_widget' => '<div id="%1$s" class="widget %2$s">',
        'after_widget' => '</div>',
        'before_title' => '<div class="widget-title"><h3>',
        'after_title' => '</h3></div>',
    ));
    register_sidebar(array(
        'name' => __('Footer', 'oct-express') . ' 3',
        'id' => 'oct-footer-3',
        'description' => __('Add widgets here to appear in your footer.', 'oct-express'),
        'before_widget' => '<div id="%1$s" class="widget %2$s">',
        'after_widget' => '</div>',
        'before_title' => '<div class="widget-title"><h3>',
        'after_title' => '</h3></div>',
    ));
}

add_action('widgets_init', 'onecom_widgets_init');

/* Custom scripts coming from Theme Options */
if (!defined('onecom_head_scripts')) {

    function onecom_head_scripts() {
        /* Head Scripts */
        $head_scripts = ot_get_option('head_scripts');
        if (strlen($head_scripts)) {
            echo $head_scripts;
        }
        return;
    }

    add_action('wp_head', 'onecom_head_scripts', 30);
}
/* Custom scripts coming from Theme Options */
if (!defined('onecom_footer_scripts')) {

    function onecom_footer_scripts() {
        /* Footer Scripts */
        $footer_scripts = ot_get_option('footer_scripts');
        if (strlen($footer_scripts)) {
            echo $footer_scripts;
        }
        return;
    }

    add_action('wp_footer', 'onecom_footer_scripts', 30);
}


/* ONECOM Update Script */
add_filter('http_request_reject_unsafe_urls', '__return_false');
add_filter('http_request_host_is_external', '__return_true');

if (!class_exists('ONECOM_UPDATER')) {
    require_once THM_DIR_PATH . '/inc/update.php';
}

/* Include the One Click Importer */
if (!class_exists('OCDI_Plugin')) {
    require_once ( THM_DIR_PATH . '/importer/importer.php' );
}

/* Pass the importable files to the Importer. */
if (!function_exists('ocdi_import_files')) {

    function ocdi_import_files() {
        return array(
            array(
                'import_file_name' => 'Theme demo data',
                'local_import_file' => trailingslashit(get_template_directory()) . 'importer/content.xml',
                'import_widget_file_url' => trailingslashit(get_template_directory_uri()) . 'importer/widgets.json',
            ),
        );
    }

}
add_filter('pt-ocdi/import_files', 'ocdi_import_files');

if (!function_exists('ocdi_after_import_setup')) {

    function ocdi_after_import_setup() {
        /* Assign menus to their locations. */
        $main_menu = get_term_by('name', 'Primary - Showcase', 'nav_menu');
        set_theme_mod('nav_menu_locations', array(
            'primary_oct_showcase' => $main_menu->term_id,
            'mobile_oct_showcase' => $main_menu->term_id
                )
        );

        // Add Home link to menu
        add_menu_home($main_menu->term_id);

        // Delete Hello world post
        oct_delete_post();

    }

}
add_action('pt-ocdi/after_import', 'ocdi_after_import_setup');

// Add Home link to menu
function add_menu_home($menu_id) {
    // If it doesn't exist, let's create it.
    if ($menu_id) {

        wp_update_nav_menu_item($menu_id, 0, array(
            'menu-item-title' => 'HOME',
            'menu-item-url' => home_url('/'),
            'menu-item-status' => 'publish',
            'menu-item-position' => -1
        ));
    }
}

// Delete Hello world post
function oct_delete_post() {
    $post_info = oc_get_page_id_by_title("Hello world!", ARRAY_N, 'post');
    wp_delete_post($post_info[0]);
}

/**
 * Include Stats Script
 **/
if(!class_exists('OCPushStats')){
    require_once trailingslashit( get_template_directory() ) . 'inc/lib/OCPushStats.php';
}

/**
 * Include Spam Protection file
 **/
if(! (class_exists('OCSpamProtection'))) {
    require_once trailingslashit( get_template_directory() ) . 'inc/OCSpamProtection.php';
}

/**
 * Function to replace the WP deprecated function https://make.wordpress.org/core/2023/03/06/oc_get_page_id_by_title-deprecated/
 * It fetches the page/post by title
 *
 * @param string $page_title The title of the page.
 * @param string $output    Optional. The required return type. Default is OBJECT.
 * @param string $post_type Optional. The post type. Default is 'page'.
 *
 * @return mixed|null The page object or null if not found.
 */
if ( ! function_exists( 'oc_get_page_id_by_title' ) ) {
function oc_get_page_id_by_title($page_title,$output = OBJECT, $post_type = 'page' ) {

     // Check for an empty title
    if (empty($page_title)) {
        return null;
    }

   $posts = get_posts(
    array(
        'post_type'              => $post_type,
        'title'                  => $page_title,
        'numberposts'            => 1,
        'update_post_term_cache' => false,
        'update_post_meta_cache' => false,
    )
);

// If no posts are found, return null
    if (empty($posts)) {
        return null;
    }

    $page_found = $posts[0];

 // Return based on the $output parameter
    if (ARRAY_A === $output) {
        return $page_found->to_array();
    } elseif (ARRAY_N === $output) {
        return array_values($page_found->to_array());
    } else {
        return $page_found;
    }
}
}
