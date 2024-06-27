<?php

/* * * Required: set 'ot_theme_mode' filter to true. */
add_filter('ot_theme_mode', '__return_true');

/* * * Meta Boxes */
add_filter('ot_meta_boxes', '__return_true');

/* Theme Options screen customizations */
add_filter('ot_show_pages', '__return_false');

add_filter('ot_show_new_layout', '__return_false');

add_filter('ot_header_logo_link', function() {
    return sprintf('<a href="https://one.com/" target="_blank"><img src="%s" /></a>', THM_DIR_URI . '/assets/images/one-com.svg');
});

add_filter('ot_header_version_text', function() {
    return THM_NAME . '  v' . THM_VER;
});

/* Modified Field for Colors */

function oct_optiontree_tweaks($array, $field_id) {

    unset($array['focus']);

    $link_fields = array(
        'social_icons_color',
        'logo_color',
    );

    $menu_fields = array(
        'menu_link_color',
        'submenu_link_color',
        'submenu_typo_bg',
        'menu_typo_bg',
    );

    $banner_fields = array(
        'hbanner_text_color',
        'intbanner_text_color',
    );

    $button_fields = array(
        'ban_buttons_text_color',
        'ban_buttonsh_bg',
        'content_buttons_text_color',
        'cont_buttonsh_bg',
        'form_buttons_text_color',
        'form_buttonsh_bg',
        'serv_buttons_text_color',
        'serv_buttonsh_bg',
    );

    if (in_array($field_id, $button_fields)) {
        $array['link'] = __('Text Color', 'oct-express');
        $array['hover'] = __('Hover Text Color', 'oct-express');
        $array['active'] = __('Background Color', 'oct-express');
        $array['visited'] = __('Hover Background Color', 'oct-express');
    }

    if (in_array($field_id, $banner_fields)) {
        $array['link'] = __('Headings Colors', 'oct-express');
        $array['hover'] = __('Text Color', 'oct-express');
        unset($array['visited']);
        unset($array['active']);
        return $array;
    }

    if (in_array($field_id, $link_fields)) {
        unset($array['visited']);
        unset($array['active']);

        return $array;
    }

    if (in_array($field_id, $menu_fields)) {
        unset($array['visited']);
        return $array;
    }

    if ('headings_colors' === $field_id) {
        $array['h1'] = 'H1';
        $array['h2'] = 'H2';
        $array['h3'] = 'H3';
        $array['h4'] = 'H4';
        $array['h5'] = 'H5';
        $array['h6'] = 'H6';
        unset($array['link']);
        unset($array['hover']);
        unset($array['active']);
        unset($array['visited']);
    }

    return $array;
}

add_filter('ot_recognized_link_color_fields', 'oct_optiontree_tweaks', 10, 2);

function onecom_buttons_colors($array, $field_id) {
    return $array;
}

add_filter('ot_recognized_link_color_fields', 'onecom_buttons_colors', 10, 2);

/* Typography Fields */

function ot_filter_typography_fields($array, $field_id) {
    $array = array('font-family', 'font-size', 'font-weight', 'line-height', 'font-style', 'text-decoration');
    if ('secondf_typo' === $field_id) {
        $array = array('font-family');
        return $array;
    }
    if ('body_typo' === $field_id) {
        unset($array[array_search ('text-decoration', $array)]);
        return $array;
    }
    return $array;
}

add_filter('ot_recognized_typography_fields', 'ot_filter_typography_fields', 10, 2);
/* Single Unit Field */

function filter_measurement_unit_types($array, $field_id) {
    $array['px'] = 'px';
    $array['em'] = 'em';
    $array['pt'] = 'pt';
    unset($array['%']);
    return $array;
}

add_filter('ot_measurement_unit_types', 'filter_measurement_unit_types', 10, 2);

/* Header Menu Callback - If no menu set */

function onecom_add_nav_menu() {
    return printf('<a href="%s"><small><u>Add Menu</u></small></a>', admin_url('customize.php?autofocus[panel]=nav_menus'));
}

/* Custom Page Title Function */
if (!function_exists('the_custom_title')) {

    function the_custom_title() {
        global $post;
        $id = $post->ID;

        // Do not display title if switch off
        $title_switch = get_post_meta($id, 'custom_page_title_switch', true);
        if ($title_switch == 'off') {
            return;
        }

        // Show custom title if have else default title
        $custom_title = get_post_meta($id, 'custom_page_title', true);
        if (strlen($custom_title)) {
            echo $custom_title;
            return;
        } else {
            echo get_the_title($id);
        }

        return;
    }

}

/*
 * Function to truncate post title - used for magazine sections
 */

function the_short_title() {
    add_filter('the_title', 'custom_short_title');
    the_title();
    remove_filter('the_title', 'custom_short_title');
}

function custom_short_title($title) {
    $max = 30;
    if (strlen($title) > $max) {
        return substr($title, 0, $max) . "&hellip;";
    } else {
        return $title;
    }
}

/*
 * Rename Excerpt box title & description of Slider posts
 * get_post_type() & get_current_screen() works after admin_init only, so used current_screen
 */
add_action('current_screen', 'oc_admin_screen');

function oc_admin_screen() {
    $screen = get_current_screen();
    if ($screen->post_type == 'oc_slider') {
        add_filter('gettext', 'oc_excerpt_label', 10, 2);
    }
}

function oc_excerpt_label($translation, $original) {
    if ('Excerpt' == $original) {
        return __('Description', 'oct-express');
    } elseif (false !== strpos($original, 'Excerpts are optional hand-crafted summaries of your')) {
        $help_text = '<a href="'.menu_page_url('octheme_settings', false) . '#section_styling_options'.'" target="_blank">' . __("Manage Slider Colors", "oct-express") . '</a>';
        return $help_text;
    }
    return $translation;
}

/* Handle contact form request */
add_action('wp_ajax_send_contact_form', 'send_contact_form');
add_action('wp_ajax_nopriv_send_contact_form', 'send_contact_form');

function send_contact_form() {

    /* Check Nonce */
    if (!wp_verify_nonce($_POST['validate_nonce'], 'booking_form')) {
        $output = json_encode(array('type' => 'error', 'text' => 'Invalid security token, please reload the page and try again.'));
        die($output);
    }
    oc_secure_form();
    /* Check Length of the parameters being received from POST request */
    if (!strlen(trim($_POST['name']))) {
        $output = json_encode(array('type' => 'error', 'text' => __('Name is empty or too short.', 'oct-express')));
        die($output);
    }
    if (80 < mb_strlen($_POST['name'], '8bit')) {
        $output = json_encode(array('type' => 'error', 'text' => __('Name is too large.', 'oct-express')));
        die($output);
    }
    if (!(strlen(trim($_POST['email'])) && filter_var($_POST['email'], FILTER_VALIDATE_EMAIL))) {
        $output = json_encode(array('type' => 'error', 'text' => __('Email entered is not valid.', 'oct-express')));
        die($output);
    }
    if (180 < mb_strlen($_POST['email'], '8bit')) {
        $output = json_encode(array('type' => 'error', 'text' => __('Email is too large.', 'oct-express')));
        die($output);
    }
    if (!strlen(trim($_POST['message']))) {
        $output = json_encode(array('type' => 'error', 'text' => __('Message text is empty or too short.', 'oct-express')));
        die($output);
    }
    if (1024 < mb_strlen($_POST['message'], '8bit')) {
        $output = json_encode(array('type' => 'error', 'text' => __('Message is too large, please shorten it.', 'oct-express')));
        die($output);
    }

    $name = sanitize_text_field($_POST["name"]);
    $email = filter_var(mb_strtolower($_POST["email"], 'UTF-8'), FILTER_SANITIZE_EMAIL);
    $msg = sanitize_text_field($_POST["message"]);

    $label_1 = sanitize_text_field($_POST["label_1"]);
    if (!isset($label_1) && !strlen($label_1)) {
        $label_1 = __("Email", "oct-express");
    }
    $label_2 = sanitize_text_field($_POST["label_2"]);
    if (!isset($label_2) && !strlen($label_2)) {
        $label_2 = __("Name", "oct-express");
    }

    $label_3 = sanitize_text_field($_POST["label_3"]);
    if (!isset($label_3) && !strlen($label_3)) {
        $label_3 = __("Message", "oct-express");
    }

    //$to = get_option( 'admin_email' );
    $subject = sanitize_text_field($_POST["subject"]);

    if (!strlen($subject)) {
        /* set default subject if missing */
        $subject = __("Contact query from website", "oct-express") . get_bloginfo('name');
    }

    /*
     * Leaving the "from" field blank in mail-headers so that wordpress@domain.tld can act as sender
     * More details: https://app.asana.com/0/307895785186248/529519894576281/f
     */

    $body = __("You received a new message from", "oct-express") . ' ' . $email . ' ' .
            __("via the contact form on", "oct-express") . ' ' . get_site_url() . "\n\n\n" .
            __("Contact Details", "oct-express") . "\n\n" .
            $label_1 . ': ' . $name . " \n" .
            $label_2 . ': ' . $email . " \n" .
            $label_3 . ': ' . $msg . " \n" .
            /* $headers = "From: $email \r\n"; */
            $headers = "Reply-To: $email \r\n";




    //$sendto = filter_var(mb_strtolower($_POST["recipient"],'UTF-8'), FILTER_SANITIZE_EMAIL);
    $sendto = $_POST["recipient"];
    if (!strlen($sendto)) {
        $sendto = get_option('admin_email');
        $send_mail = wp_mail($sendto, $subject, $body, $headers);
    } else if (!strpos($sendto, ',') && strlen($sendto)) {
        $sendto = filter_var(mb_strtolower($sendto, 'UTF-8'), FILTER_SANITIZE_EMAIL);
        $send_mail = wp_mail($sendto, $subject, $body, $headers);
    } else {
        $send_mail = wp_mail($sendto, $subject, $body, $headers);
    }


    if ($send_mail) {
        $token_new = oc_get_captcha_string();
        $output = json_encode(array(
            'type' => 'success',
            'token' => $token_new,
            'image' => get_stylesheet_directory_uri() . '/inc/image.php?i=' . $token_new,
            'text' => __('Your message has been successfully sent.', 'oct-express'),
        ));
        die($output);
    } else {
        $output = json_encode(array('type' => 'error', 'text' => __('Some error occurred, please reload the page and try again.', 'oct-express'), 'body' => $body));
        die($output);
    }
}

/* Customize Theme Options link in admin menu. */
add_filter('ot_show_pages', '__return_false');
add_filter('ot_theme_options_parent_slug', '__return_false');
add_filter('ot_theme_options_menu_title', function( $title ) {
    return $title = 'Showcase Settings';
});
add_filter('ot_theme_options_menu_slug', function( $slug ) {
    return $slug = 'octheme_settings';
});
add_filter('ot_theme_options_icon_url', function( $url ) {
    return $url = ' dashicons-admin-customizer';
});

/* Starts: Register Custom Post Type for slider/carausal */

function oc_slider_post() {
    $labels = array(
        'name' => __('Slider', 'oct-express'),
        'singular_name' => __('Slide', 'oct-express'),
        'add_new' => __('Add New', 'oct-express'),
        'add_new_item' => __('Add New Slide', 'oct-express'),
        'edit_item' => __('Edit Slide', 'oct-express'),
        'new_item' => __('New Slide', 'oct-express'),
        'all_items' => __('All Slides', 'oct-express'),
        'view_item' => __('View Slide', 'oct-express'),
        'search_items' => __('Search Slides', 'oct-express'),
        'not_found' => __('No Slides found', 'oct-express'),
        'not_found_in_trash' => __('No Slides found in the Trash', 'oct-express'),
        'parent_item_colon' => '',
        'menu_name' => __('Slider', 'oct-express'),
    );
    $args = array(
        'labels' => $labels,
        'description' => '',
        'public' => true,
        'menu_position' => 5,
        'publicly_queryable' => false,
        'exclude_from_search' => true,
        'query_var' => false,
        // 'rewrite' => array('slug' => 'tabs'),
        'supports' => array('title', 'excerpt', 'thumbnail'),
        'has_archive' => false,
    );
    register_post_type('oc_slider', $args);
}

add_action('init', 'oc_slider_post');
/**
 * Function oc_sucure_forms
 * Secure form submission, try to block spams by using captcha and honeypot
 * @param void
 * @return void
 */
function oc_secure_form()
{
    /* Check Captcha */
    if (!isset($_POST['oc_cpt']) || !isset($_POST['oc_captcha_val']) || !$_POST['oc_captcha_val'] 
        || !$_POST['oc_cpt'] || !oc_validate_captcha($_POST['oc_captcha_val'], $_POST['oc_cpt'])
        ){
        $output = json_encode(array(
            'type' => 'error',
            'text' => __('Invalid answer, please try again.', 'oct-express'),
        ));
        die($output);
    }

    /** Check Honey Pot field */
    if (!isset($_POST['oc_csrf_token']) || $_POST['oc_csrf_token'] !== '') {
        $output = json_encode(array(
            'type' => 'error',
            'text' => __('Some error occurred, please reload the page and try again.', 'oct-express'),
        ));
        die($output);
    }
}

// Generate booking_form nonce via ajax and return to caller
add_action('wp_ajax_oc_booking_nonce', 'oc_nonce_cb');
add_action('wp_ajax_nopriv_oc_booking_nonce', 'oc_nonce_cb');

/**
 * Function oc_nonce_cb
 * Ajax handler to generate nonce and return it as response
 * @param void
 * @return void
 */
function oc_nonce_cb()
{
    wp_send_json([
        'nonce' => wp_create_nonce('booking_form'),
        'status' => '0',
    ]);
}

/**
 * Function oc_secure_fields
 * Return HTML string contaning the fields that will be used in forms to track 
 * token etc.
 * @param void
 * @return string
 */
function oc_secure_fields()
{
    $oc_token = oc_get_captcha_string();
    $fields = '<label class="d-block">'.__('Type in the answer to the sum below:', 'oct-express').'</label><span class="d-inline-block oc-cap-container"><img id="oc_cap_img" alt="Please reload" src="' . get_stylesheet_directory_uri() . '/inc/image.php?i=' . $oc_token . '">'
        . '<input type="text" name="oc_captcha_val" class="oc-captcha-val" id="oc-captcha-val" placeholder="?" required/></span>'
        . '<input type="hidden" name="oc_cpt" id="oc_cpt" value="' . $oc_token . '">'
		. '<input type="text" name="oc_csrf_token" value="" class="oc_csrf_token" id="oc_csrf_token">'.
		'<input type="hidden" value="" name="validate_nonce" id="validate_nonce">';
    return $fields;
}

add_action('wp_ajax_oc_refresh_captcha', 'oc_get_captcha_string');
if (!defined('OC_CAPTCHA_KEY')){
    define('OC_CAPTCHA_KEY', '1ASD2A4D2AA4DA15A');
}

/**
 * Function oc_get_captcha_string
 * Generate a token to be used to add value in captcha
 * @param void
 * @return string
 */
function oc_get_captcha_string($echo = false){
    $num1 = rand(0, 10);
    $num2 = rand(1, 10);
    $token = OC_CAPTCHA_KEY . base64_encode($num1 . '#'. $num2);
    if (defined('DOING_AJAX') && DOING_AJAX && $echo){
        wp_send_json([
            'token' => $token,
            'image' => get_stylesheet_directory_uri() . '/inc/image.php?i='.$token
        ]);
        wp_die();
    }
    return $token;
}

/** 
 * Function oc_validate_captcha
 * Check if incoming value of captcha is valid
 * @param $value, string that user entered as captcha solution
 * @param $encrypted_val, string the token that was used to generate captcha
 * @return string
 */
function oc_validate_captcha($value, $encrypted_val){
    $decrypted_value = base64_decode(str_replace(OC_CAPTCHA_KEY, '', $encrypted_val));
    if (! $decrypted_value ){   
        return false;
    }
    $exploded = explode('#', $decrypted_value);
    
    if (count($exploded) < 2){
        return false;
    }

    return (intval($exploded[0]) + intval($exploded[1])) === intval($value);
}