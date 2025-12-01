<?php
/*
Plugin Name: RestFox
Description: Provides custom REST API endpoints for remote WordPress management.
Author: Alexander Anastasiadis
Author URI: https://www.alexanast.gr
Version: 1.0.0

*/

if (! defined('ABSPATH')) {
    exit;
}

require_once __DIR__ . '/core/API.php';



/** 
 *  Add CSS for plugin settings page 
 */

add_action('admin_enqueue_scripts', function ($hook) {

    if (strpos($hook, 'restfox-settings') === false) {
        return;
    }

    wp_enqueue_style(
        'restfox-css-admin',
        plugin_dir_url(__FILE__) . 'assets/css/admin.css',
        [],
        filemtime(plugin_dir_path(__FILE__) . 'assets/css/admin.css'),
       
    );
});
