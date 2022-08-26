<?php
if (!defined('ABSPATH')) exit;
function clarofont_create_menu()
{
    // add_menu_page( __("کلارو فونت", 'awp'), __("کلارو فونت", 'awp'), 1,"clarofont-settings", "clarofont_settings_page" ,'dashicons-admin-customizer' );
    add_action('admin_init', 'register_clarofont_settings');
}
add_action('admin_menu', 'clarofont_create_menu');
function register_clarofont_settings()
{
    // Register our settings
    register_setting('clarofont_font_settings', 'clarofont_font_settings');
}
