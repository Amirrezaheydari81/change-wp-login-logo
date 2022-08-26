<?php

/**
 *Plugin Name: wp-logo-login | تغییر لوگو ورود و سربرگ
 *Plugin URI: clarotm.ir
 *Version: 2.0.1
 *Author: امیررضا حیدری و تیم کلارو 
 *Author URI: https://clarotm.ir
 *Description: تعویض لوگو صفحه لاگین،تغییر لوگو سربرگ
 */

/* Settings to manage logo */

function register_custom_logo_settings()
{
    $args = array(
        'type' => 'string',
        'sanitize_callback' => 'sanitize_text_field',
        'default' => NULL,
    );
    register_setting('change_login_options_group', 'wp_logo_url', $args);
    register_setting('change_login_options_group', 'wp_logo_height', $args);
    register_setting('change_login_options_group', 'wp_logo_width', $args);
}
add_action('admin_init', 'register_custom_logo_settings');
function icon_wp_panel_nav()
{
    //
    include_once('icons.php');
    include_once('functions/base64.php');

    $main_option_page = __FILE__;
    add_menu_page(
        'پنل تنظیمات لوگو',
        'تنظیمات لوگو',
        'administrator',
        'change-login-logo',
        'change_wordpress_login_logo',
        setimageBase64($icon_nav),
    );
}

function change_wordpress_login_logo()
{
    wp_enqueue_script('jquery');
    wp_enqueue_media();
?>

    <head>
        <!--Added to beautify the font settings-->
        <style>
            @font-face {
                font-family: danapro;
                src: url("https://waregint.sirv.com/iseokar.ir/fonts/Dana-Regular.woff2") format("woff2");
                font-weight: 100;
                font-style: normal
            }

            .fs {
                font-family: danapro !important;
            }
        </style>
    </head>
    <div class="wrap">
        <h3 class="fs">آیکون لاگین ادمین سایت</h3>
        <hr />
        <form method="post" action="options.php">
            <?php settings_fields('change_login_options_group'); ?>
            <?php do_settings_sections('change_login_options_group'); ?>
            <table class="form-table" class="fs">
                <tr valign="top">
                    <th scope="row" class="fs">لوگو صفحه ورود</th>
                    <td>
                        <input type="text" class="inn" id="wp_logo_url" name="wp_logo_url" value="<?php echo esc_attr(get_option('wp_logo_url')); ?>" />
                        <input type="button" name="upload-btn" id="upload-btn" class="button-secondary fs inn" value="بارگذاری تصویر">
                        <p class="description fs"><i>در صفحه wp-login ظاهر خواهد شد</i></p>
                    </td>
                </tr>
                <tr valign="top">
                    <th scope="row" class="fs">ارتفاع</th>

                    <td>
                        <input type="number" class="inn" name="wp_logo_height" value="<?php echo esc_attr(get_option('wp_logo_height')); ?>" />
                        <p class="description fs"><i>لطفا سایز را به صورت px وارد کنید.</i></p>
                    </td>
                </tr>
                <tr valign="top">
                    <th scope="row" class="fs">عرض</th>

                    <td>
                        <input type="number" class="inn" name="wp_logo_width" value="<?php echo esc_attr(get_option('wp_logo_width')); ?>" />
                        <p class="description fs"><i>لطفا سایز را به صورت px وارد کنید.</i></p>
                    </td>
                </tr>
            </table>
            <?php submit_button(); ?>
        </form>
        <script type="text/javascript">
            jQuery(document).ready(function($) {
                $('#upload-btn').click(function(e) {
                    e.preventDefault();
                    var image = wp.media({
                            title: 'لوگو ادمین',
                            multiple: false
                        }).open()
                        .on('select', function(e) {
                            var uploaded_image = image.state().get('selection').first();
                            console.log(uploaded_image);
                            var image_url = uploaded_image.toJSON().url;
                            $('#wp_logo_url').val(image_url);
                        });
                });
            });
        </script>
    </div>
<?php
}

/* Custom WordPress admin login header logo */
function wordpress_custom_login_logo()
{
    $logo_url = get_option('wp_logo_url');
    $wp_logo_height = get_option('wp_logo_height');
    $wp_logo_width = get_option('wp_logo_width');
    if (empty($wp_logo_height)) {
        $wp_logo_height = '100px';
    } else {
        $wp_logo_height .= 'px';
    }
    if (empty($wp_logo_width)) {
        $wp_logo_width = '100%';
    } else {
        $wp_logo_width .= 'px';
    }
    if (!empty($logo_url)) {
        echo '<style type="text/css">' .
            'h1 a { 
				background-image:url(' . $logo_url . ') !important;
				height:' . $wp_logo_height . ' !important;
				width:' . $wp_logo_width . ' !important;
				background-size:100% !important;
				line-height:inherit !important;
				}' .
            '</style>';
    }
}
add_action('login_head', 'wordpress_custom_login_logo');

/* Add action links to plugin list*/
add_filter('plugin_action_links_' . plugin_basename(__FILE__), 'add_change_wordpress_login_logo_action_links');
function add_change_wordpress_login_logo_action_links($links)
{
    $settings_link = array('<a href="' . admin_url('options-general.php?page=change-login-logo') . '">تنظیمات</a>');
    return array_merge($links, $settings_link);
}

/*Change login logo URL*/
add_filter('login_headerurl', 'change_login_logo_url');
function change_login_logo_url($url)
{
    return home_url();
}

add_action('admin_menu', 'icon_wp_panel_nav');
?>