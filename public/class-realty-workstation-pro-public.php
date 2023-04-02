<?php

/**
 * The public-facing functionality of the plugin.
 *
 * @link       https://https://wppb.me/
 * @since      1.0.0
 *
 * @package    Realty_Workstation_Pro
 * @subpackage Realty_Workstation_Pro/public
 */

/**
 * The public-facing functionality of the plugin.
 *
 * Defines the plugin name, version, and two examples hooks for how to
 * enqueue the public-facing stylesheet and JavaScript.
 *
 * @package    Realty_Workstation_Pro
 * @subpackage Realty_Workstation_Pro/public
 * @author     Tech Mirza <talhamirza2@gmail.com>
 */
class Realty_Workstation_Pro_Public {

	/**
	 * The ID of this plugin.
	 *
	 * @since    1.0.0
	 * @access   private
	 * @var      string    $plugin_name    The ID of this plugin.
	 */
	private $plugin_name;

	/**
	 * The version of this plugin.
	 *
	 * @since    1.0.0
	 * @access   private
	 * @var      string    $version    The current version of this plugin.
	 */
	private $version;

	/**
	 * Initialize the class and set its properties.
	 *
	 * @since    1.0.0
	 * @param      string    $plugin_name       The name of the plugin.
	 * @param      string    $version    The version of this plugin.
	 */
	public function __construct( $plugin_name, $version ) {

		$this->plugin_name = $plugin_name;
		$this->version = $version;

	}

	/**
	 * Register the stylesheets for the public-facing side of the site.
	 *
	 * @since    1.0.0
	 */
	public function enqueue_styles() {

		/**
		 * This function is provided for demonstration purposes only.
		 *
		 * An instance of this class should be passed to the run() function
		 * defined in Realty_Workstation_Pro_Loader as all of the hooks are defined
		 * in that particular class.
		 *
		 * The Realty_Workstation_Pro_Loader will then create the relationship
		 * between the defined hooks and the functions defined in this
		 * class.
		 */

		wp_enqueue_style( $this->plugin_name, plugin_dir_url( __FILE__ ) . 'css/realty-workstation-pro-public.css', array(), $this->version, 'all' );

	}

	/**
	 * Register the JavaScript for the public-facing side of the site.
	 *
	 * @since    1.0.0
	 */
	public function enqueue_scripts() {

		/**
		 * This function is provided for demonstration purposes only.
		 *
		 * An instance of this class should be passed to the run() function
		 * defined in Realty_Workstation_Pro_Loader as all of the hooks are defined
		 * in that particular class.
		 *
		 * The Realty_Workstation_Pro_Loader will then create the relationship
		 * between the defined hooks and the functions defined in this
		 * class.
		 */

		wp_enqueue_script( $this->plugin_name, plugin_dir_url( __FILE__ ) . 'js/realty-workstation-pro-public.js', array( 'jquery' ), $this->version, false );

	}

	public function realty_workstation_pro_load_plugin_template( $template ) {
		global $post;
		$rw_webpage = get_option( 'rw_webpage' );
		if ( isset($rw_webpage) && !empty($rw_webpage) && $rw_webpage == $post->ID ) {
			if ( count($_GET) == 0 ) {
				$template = REALTY_WORKSTATION_PRO_PATH . 'public/partials/login.php';
			} else {
				$template = REALTY_WORKSTATION_PRO_PATH . 'public/partials/dashboard.php';
			}
		}
	    return $template;
	}

}
