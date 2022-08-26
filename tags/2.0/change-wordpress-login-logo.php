<?php

/**
 *Plugin Name: wp-logo-login
 *Plugin URI: clarotm.ir
 *Version: 2.0
 *Author: ClaroTM 
 *Author URI: https://clarotm.ir
 *Description: تعویض لوگو صفحه لاگین،تغییر لوگو سربرگ، تغییر فونت
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

function register_login_logo_setting_page()
{
    //   add_options_page('لوگو صفحه ورود', 'لوگو صفحه ورود', 'manage_options', 'change-login-logo', 'change_wordpress_login_logo');
}

function es_set_favicon_create_menu()
{
    $main_option_page = __FILE__;
    add_menu_page('تنظیمات لوگو کلارو', 'تنظیمات لوگو کلارو', 'administrator', 'change-login-logo', 'change_wordpress_login_logo');
}

add_action('admin_menu', 'register_login_logo_setting_page');

function change_wordpress_login_logo()
{
    wp_enqueue_script('jquery');
    wp_enqueue_media();
?>
    <div class="wrap">
        <hr />
        <center>
            <h2 class="fs">&darr; آیکون لاگین ادمین سایت &darr;</h2>
        </center>
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
    <!-- start favicon -->
    <div class="wrap">
        <hr />
        <center>
            <h2 class="fs">&darr; تغییر Favicon سایت &darr;</h2>
        </center>
        <hr />

        <?php if (!empty($_POST['link'])) : ?>
            <div class="updated inline below-h2">
                <p> تصویر سربرگ سرچ با موفقیت بروز شد. </p>
            </div>
            <br />
        <?php endif; ?>


        <form method="post" action="<?php echo $_SERVER['REQUEST_URI'] ?>">
            <?php wp_nonce_field('update-options'); ?>
            <label>
                آدرس Fav Icon را وارد کنید:
            </label>
            <input type="text" name="link" id='link' value="<?php echo $link; ?>">
            <p class="description fs"><i>لطفا تصویر خود را با فرمت png بارگذاری کنید</i></p>
            <input type="submit" class="button-primary" name="save-fav-icon" value="<?php _e('Save Changes');    ?>" />
            <input type="hidden" name="action" value="update" />
        </form>
    </div>
    <!-- end favicon -->
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

?>
<?php

include_once('in-pl.php');

register_activation_hook(__FILE__, 'es_favicon_install');
register_deactivation_hook(__FILE__, 'es_favicon_uninstall');

add_action('admin_menu', 'es_set_favicon_create_menu');
add_action('wp_head', 'es_enqueue_favicon_head');
add_action('admin_head', 'es_enqueue_favicon_head');

function es_enqueue_favicon_head()
{
    global $wpdb;
    $favIconTable = $wpdb->prefix . "fav_icon_link";
    $result = $wpdb->get_results("SELECT * FROM $favIconTable WHERE id = 1");

    if (!empty($result)) {
        echo '<link rel="shortcut icon" href="' . $result[0]->link . '" type="image/x-icon" /><!-- Favicon -->';
    }
}

function es_save_favicon_url()
{
    include("s-i-u.php");
}

?>