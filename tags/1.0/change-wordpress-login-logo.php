<?php
/* 
Plugin Name: wp-logo-login
Plugin URI: clarotm.ir
Version: 1
Author: clarotm.ir 
Author URI: https://clarotm.ir
Description: جای گذاری لوگو پنل مدیر وردپرس
*/

/* Settings to manage logo */
function register_custom_logo_settings() 
{
    $args = array(
            'type' => 'string', 
            'sanitize_callback' => 'sanitize_text_field',
            'default' => NULL,
   );
   register_setting( 'change_login_options_group', 'wp_logo_url', $args);
   register_setting( 'change_login_options_group', 'wp_logo_height', $args);
   register_setting( 'change_login_options_group', 'wp_logo_width', $args);
}
add_action( 'admin_init', 'register_custom_logo_settings' );


function register_login_logo_setting_page() {
  add_options_page('لوگو صفحه ورود', 'لوگو صفحه ورود', 'manage_options', 'change-login-logo', 'change_wordpress_login_logo');
}
add_action('admin_menu', 'register_login_logo_setting_page');

function change_wordpress_login_logo()
{
	wp_enqueue_script('jquery');
	wp_enqueue_media();
	?>
	<div class="wrap">
		<h1>تنظیمات تغییر لوگو ورود</h1>
		<h3>تنظیمات لوگو</h3>
		<form method="post" action="options.php">
			<?php settings_fields( 'change_login_options_group' ); ?>
			<?php do_settings_sections( 'change_login_options_group' ); ?>
			<table class="form-table">
				<tr valign="top">
					<th scope="row">لوگو صفحه ورود</th>
					<td>
						<input type="text" id="wp_logo_url" name="wp_logo_url" value="<?php echo esc_attr( get_option('wp_logo_url') ); ?>" />
						<input type="button" name="upload-btn" id="upload-btn" class="button-secondary" value="بارگذاری تصویر">
						<p class="description"><i>در صفحه wp-login ظاهر خواهد شد</i></p>
					</td>
				</tr>
				<tr valign="top">
					<th scope="row">ارتفاع</th>
					
					<td>
						<input type="number" name="wp_logo_height" value="<?php echo esc_attr( get_option('wp_logo_height') ); ?>" />	
						<p class="description"><i>لطفا سایز را به صورت px وارد کنید.</i></p>				
					</td>
				</tr>
				<tr valign="top">
					<th scope="row">عرض</th>
					
					<td>
						<input type="number" name="wp_logo_width" value="<?php echo esc_attr( get_option('wp_logo_width') ); ?>" />
						<p class="description"><i>لطفا سایز را به صورت px وارد کنید.</i></p>
					</td>
				</tr>
			</table>
			<?php submit_button(); ?>
		</form>
		<script type="text/javascript">
	jQuery(document).ready(function($){
		$('#upload-btn').click(function(e) {
			e.preventDefault();
			var image = wp.media({ 
				title: 'Upload Logo',
				multiple: false
			}).open()
			.on('select', function(e){
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
function wordpress_custom_login_logo() {
    $logo_url=get_option('wp_logo_url');
    $wp_logo_height=get_option('wp_logo_height');
    $wp_logo_width=get_option('wp_logo_width');
	if(empty($wp_logo_height))
	{
		$wp_logo_height='100px';
	}
	else
	{
		$wp_logo_height.='px';
	}
	if(empty($wp_logo_width))
	{
		$wp_logo_width='100%';
	}	
	else
	{
		$wp_logo_width.='px';
	}
	if(!empty($logo_url))
	{
		echo '<style type="text/css">'.
             'h1 a { 
				background-image:url('.$logo_url.') !important;
				height:'.$wp_logo_height.' !important;
				width:'.$wp_logo_width.' !important;
				background-size:100% !important;
				line-height:inherit !important;
				}'.
         '</style>';
	}
}
add_action( 'login_head', 'wordpress_custom_login_logo' );

/* Add action links to plugin list*/
add_filter( 'plugin_action_links_' . plugin_basename(__FILE__), 'add_change_wordpress_login_logo_action_links' );
function add_change_wordpress_login_logo_action_links ( $links ) {
	 $settings_link = array('<a href="' . admin_url( 'options-general.php?page=change-login-logo' ) . '">تنظیمات</a>');
	return array_merge( $links, $settings_link );
}

/*Change login logo URL*/
add_filter( 'login_headerurl', 'change_login_logo_url' );
function change_login_logo_url($url) {
	return home_url();
}
?>