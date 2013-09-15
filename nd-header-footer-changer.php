<?php

/*
 * Plugin Name: Nomesdesign Header Footer Change
 * Plugin URI: http://blog.nomesdesign.com
 * Description: This plugin is for changing Header Banner and Footer Banner easily.
 * Author: Thiha (Synapseoriginal)
 * Version: 1.0
 * Author URI: http://synapseoriginal.com
 */

class TH_Options{

	public $options;

	public function __construct(){
		$this->options = get_option('th_plugin_options');
		$this->register_settings_and_fields();
	}

	public function add_menu_page(){
		add_options_page('SN Header Footer', 'SN Header Footer','administrator', __FILE__, array('TH_Options','display_options_page'));
	}

	public function display_options_page(){
		?>
 		<div class="wrap">
 		<?php screen_icon(); ?>
 		<h2>SN Header Footer Setting</h2>
 		<form method="post" action="options.php" enctype="multipart/form-data">
 			<?php settings_fields('th_plugin_options'); ?>
 			<?php do_settings_sections(__FILE__); ?>

 			<p class="submit">
 				<input name="submit" type="submit" class="button-primary" value="Save" />
 		</form>

 	</div>
 	<?php
	}

	public function register_settings_and_fields(){
		register_setting('th_plugin_options','th_plugin_options', array($this, 'th_validate_settings')); //3rd pram = optional callback
		add_settings_section('th_main_section','Banner Setting', array($this,'th_main_section_cb'), __FILE__);
		add_settings_field('th_banner_header','Hader Banner', array($this,'th_banner_header_setting'), __FILE__,'th_main_section');
		add_settings_field('th_banner_headercheck','Enable Hader Banner', array($this,'th_banner_headercheck_setting'), __FILE__,'th_main_section');
		add_settings_field('th_banner_footer','Footer Banner', array($this,'th_banner_footer_setting'), __FILE__,'th_main_section');
		add_settings_field('th_banner_fooercheck','Enable Banner', array($this,'th_banner_footercheck_setting'), __FILE__,'th_main_section');
		

	}

	public function th_main_section_cb()
	{

	}

	public function th_validate_settings($plugin_options)
	{
		if (!empty($_FILES['th_banner_header_upload']['tmp_name'])){
			$override = array('test_form' => false);
			$file=wp_handle_upload($_FILES['th_banner_header_upload'], $override);
			print_r($_FILES);
			print_r($plugin_options);
		}
	}

	//Banner Heading & Footer & Chekbox in Admin
	public function th_banner_header_setting()
	{
		echo '<input type="file" />';
	}
	public function th_banner_footer_setting()
	{
		echo '<input type="file" />';
	}
	public function th_banner_headercheck_setting()
	{
		echo '<input type="checkbox" />';
	}
	public function th_banner_footercheck_setting()
	{
		echo '<input type="checkbox" />';
	}
}
add_action('admin_menu', function(){
 	TH_Options::add_menu_page();

});

add_action('admin_init', function(){
	new TH_Options();
});
?>