<?php

/**
 * The file that defines the core plugin class
 *
 * A class definition that includes attributes and functions used across both the
 * public-facing side of the site and the admin area.
 *
 * @link       https://https://wppb.me/
 * @since      1.0.0
 *
 * @package    Realty_Workstation_Pro
 * @subpackage Realty_Workstation_Pro/includes
 */

/**
 * The core plugin class.
 *
 * This is used to define internationalization, admin-specific hooks, and
 * public-facing site hooks.
 *
 * Also maintains the unique identifier of this plugin as well as the current
 * version of the plugin.
 *
 * @since      1.0.0
 * @package    Realty_Workstation_Pro
 * @subpackage Realty_Workstation_Pro/includes
 * @author     Tech Mirza <talhamirza2@gmail.com>
 */
class Realty_Workstation_Pro {

	/**
	 * The loader that's responsible for maintaining and registering all hooks that power
	 * the plugin.
	 *
	 * @since    1.0.0
	 * @access   protected
	 * @var      Realty_Workstation_Pro_Loader    $loader    Maintains and registers all hooks for the plugin.
	 */
	protected $loader;

	/**
	 * The unique identifier of this plugin.
	 *
	 * @since    1.0.0
	 * @access   protected
	 * @var      string    $plugin_name    The string used to uniquely identify this plugin.
	 */
	protected $plugin_name;

	/**
	 * The current version of the plugin.
	 *
	 * @since    1.0.0
	 * @access   protected
	 * @var      string    $version    The current version of the plugin.
	 */
	protected $version;

	/**
	 * Define the core functionality of the plugin.
	 *
	 * Set the plugin name and the plugin version that can be used throughout the plugin.
	 * Load the dependencies, define the locale, and set the hooks for the admin area and
	 * the public-facing side of the site.
	 *
	 * @since    1.0.0
	 */
	public function __construct() {
		if ( defined( 'REALTY_WORKSTATION_PRO_VERSION' ) ) {
			$this->version = REALTY_WORKSTATION_PRO_VERSION;
		} else {
			$this->version = '1.0.0';
		}
		$this->plugin_name = 'realty-workstation-pro';

		$this->load_dependencies();
		$this->set_locale();
		$this->define_admin_hooks();
		$this->define_public_hooks();

	}

	/**
	 * Load the required dependencies for this plugin.
	 *
	 * Include the following files that make up the plugin:
	 *
	 * - Realty_Workstation_Pro_Loader. Orchestrates the hooks of the plugin.
	 * - Realty_Workstation_Pro_i18n. Defines internationalization functionality.
	 * - Realty_Workstation_Pro_Admin. Defines all hooks for the admin area.
	 * - Realty_Workstation_Pro_Public. Defines all hooks for the public side of the site.
	 *
	 * Create an instance of the loader which will be used to register the hooks
	 * with WordPress.
	 *
	 * @since    1.0.0
	 * @access   private
	 */
	private function load_dependencies() {

		/**
		 * The class responsible for orchestrating the actions and filters of the
		 * core plugin.
		 */
		require_once plugin_dir_path( dirname( __FILE__ ) ) . 'includes/class-realty-workstation-pro-loader.php';

		/**
		 * The class responsible for defining internationalization functionality
		 * of the plugin.
		 */
		require_once plugin_dir_path( dirname( __FILE__ ) ) . 'includes/class-realty-workstation-pro-i18n.php';

		/**
		 * The class responsible for defining all actions that occur in the admin area.
		 */
		require_once plugin_dir_path( dirname( __FILE__ ) ) . 'admin/class-realty-workstation-pro-admin.php';

		/**
		 * The class responsible for defining all actions that occur in the public-facing
		 * side of the site.
		 */
		require_once plugin_dir_path( dirname( __FILE__ ) ) . 'public/class-realty-workstation-pro-public.php';

		$this->loader = new Realty_Workstation_Pro_Loader();

	}

	/**
	 * Define the locale for this plugin for internationalization.
	 *
	 * Uses the Realty_Workstation_Pro_i18n class in order to set the domain and to register the hook
	 * with WordPress.
	 *
	 * @since    1.0.0
	 * @access   private
	 */
	private function set_locale() {

		$plugin_i18n = new Realty_Workstation_Pro_i18n();

		$this->loader->add_action( 'plugins_loaded', $plugin_i18n, 'load_plugin_textdomain' );

	}

	/**
	 * Register all of the hooks related to the admin area functionality
	 * of the plugin.
	 *
	 * @since    1.0.0
	 * @access   private
	 */
	private function define_admin_hooks() {

		$plugin_admin = new Realty_Workstation_Pro_Admin( $this->get_plugin_name(), $this->get_version() );

		$this->loader->add_action( 'admin_enqueue_scripts', $plugin_admin, 'enqueue_styles' );
		$this->loader->add_action( 'admin_enqueue_scripts', $plugin_admin, 'enqueue_scripts' );

		$this->loader->add_action( 'admin_init', $plugin_admin, 'realty_workstation_pro_settings' );
		$this->loader->add_action( 'admin_menu', $plugin_admin, 'realty_workstation_pro_menu' );

		// Adding New Agent
		$this->loader->add_action( 'wp_ajax_realty_workstation_pro_add_new_agent', $plugin_admin, 'realty_workstation_pro_add_new_agent' );
		$this->loader->add_action( 'wp_ajax_nopriv_realty_workstation_pro_add_new_agent', $plugin_admin, 'realty_workstation_pro_add_new_agent' );

		// Updating Agent
		$this->loader->add_action( 'wp_ajax_realty_workstation_pro_update_agent', $plugin_admin, 'realty_workstation_pro_update_agent' );
		$this->loader->add_action( 'wp_ajax_nopriv_realty_workstation_pro_update_agent', $plugin_admin, 'realty_workstation_pro_update_agent' );

		// Deleting Agent
		$this->loader->add_action( 'wp_ajax_realty_workstation_pro_delete_agent', $plugin_admin, 'realty_workstation_pro_delete_agent' );
		$this->loader->add_action( 'wp_ajax_nopriv_realty_workstation_pro_delete_agent', $plugin_admin, 'realty_workstation_pro_delete_agent' );

		// Adding New Agent Transaction
		$this->loader->add_action( 'wp_ajax_realty_workstation_pro_add_new_transaction', $plugin_admin, 'realty_workstation_pro_add_new_transaction' );
		$this->loader->add_action( 'wp_ajax_nopriv_realty_workstation_pro_add_new_transaction', $plugin_admin, 'realty_workstation_pro_add_new_transaction' );

		// Uploading Document For Transaction
		$this->loader->add_action( 'wp_ajax_realty_workstation_pro_upload_document', $plugin_admin, 'realty_workstation_pro_upload_document' );
		$this->loader->add_action( 'wp_ajax_nopriv_realty_workstation_pro_upload_document', $plugin_admin, 'realty_workstation_pro_upload_document' );

		// Deleting Document For Transaction
		$this->loader->add_action( 'wp_ajax_realty_workstation_pro_delete_document', $plugin_admin, 'realty_workstation_pro_delete_document' );
		$this->loader->add_action( 'wp_ajax_nopriv_realty_workstation_pro_delete_document', $plugin_admin, 'realty_workstation_pro_delete_document' );

		// Deleting Document For Transaction
		$this->loader->add_action( 'wp_ajax_realty_workstation_pro_delete_transaction', $plugin_admin, 'realty_workstation_pro_delete_transaction' );
		$this->loader->add_action( 'wp_ajax_nopriv_realty_workstation_pro_delete_transaction', $plugin_admin, 'realty_workstation_pro_delete_transaction' );

		// Update Agent Transaction
		$this->loader->add_action( 'wp_ajax_realty_workstation_pro_update_transaction', $plugin_admin, 'realty_workstation_pro_update_transaction' );
		$this->loader->add_action( 'wp_ajax_nopriv_realty_workstation_pro_update_transaction', $plugin_admin, 'realty_workstation_pro_update_transaction' );

		// Close Agent Transaction
		$this->loader->add_action( 'wp_ajax_realty_workstation_pro_close_transaction', $plugin_admin, 'realty_workstation_pro_close_transaction' );
		$this->loader->add_action( 'wp_ajax_nopriv_realty_workstation_pro_close_transaction', $plugin_admin, 'realty_workstation_pro_close_transaction' );

		// Update General Settings
		$this->loader->add_action( 'wp_ajax_realty_workstation_pro_update_general_settings', $plugin_admin, 'realty_workstation_pro_update_general_settings' );
		$this->loader->add_action( 'wp_ajax_nopriv_realty_workstation_pro_update_general_settings', $plugin_admin, 'realty_workstation_pro_update_general_settings' );

		// Update General Settings
		$this->loader->add_action( 'wp_ajax_realty_workstation_pro_change_password', $plugin_admin, 'realty_workstation_pro_change_password' );
		$this->loader->add_action( 'wp_ajax_nopriv_realty_workstation_pro_change_password', $plugin_admin, 'realty_workstation_pro_change_password' );

		// Update General Settings
		$this->loader->add_action( 'wp_ajax_realty_workstation_pro_signin', $plugin_admin, 'realty_workstation_pro_signin' );
		$this->loader->add_action( 'wp_ajax_nopriv_realty_workstation_pro_signin', $plugin_admin, 'realty_workstation_pro_signin' );

		// Update General Settings
		$this->loader->add_action( 'wp_ajax_realty_workstation_pro_logout', $plugin_admin, 'realty_workstation_pro_logout' );
		$this->loader->add_action( 'wp_ajax_nopriv_realty_workstation_pro_logout', $plugin_admin, 'realty_workstation_pro_logout' );

		// Mail Content Settings
		$this->loader->add_filter( 'wp_mail_content_type', $plugin_admin, 'wpse27856_set_content_type' );
		$this->loader->add_filter( 'wp_mail_from_name', $plugin_admin, 'wpb_sender_name' );

		$this->loader->add_action( 'admin_notices', $plugin_admin, 'realty_workstation_pro_check_activation' );
		
		// Update Activate Licence Key Settings
		$this->loader->add_action( 'wp_ajax_realty_workstation_pro_activate_license_key_settings', $plugin_admin, 'realty_workstation_pro_activate_license_key_settings' );
		$this->loader->add_action( 'wp_ajax_nopriv_realty_workstation_pro_activate_license_key_settings', $plugin_admin, 'realty_workstation_pro_activate_license_key_settings' );

		// Adding New Lead
		$this->loader->add_action( 'wp_ajax_realty_workstation_pro_add_new_lead', $plugin_admin, 'realty_workstation_pro_add_new_lead' );
		$this->loader->add_action( 'wp_ajax_nopriv_realty_workstation_pro_add_new_lead', $plugin_admin, 'realty_workstation_pro_add_new_lead' );

		// Update Lead
		$this->loader->add_action( 'wp_ajax_realty_workstation_pro_update_lead', $plugin_admin, 'realty_workstation_pro_update_lead' );
		$this->loader->add_action( 'wp_ajax_nopriv_realty_workstation_pro_update_lead', $plugin_admin, 'realty_workstation_pro_update_lead' );

		// Create Agent Transaction from Lead
		$this->loader->add_action( 'wp_ajax_realty_workstation_pro_create_transaction_from_lead', $plugin_admin, 'realty_workstation_pro_create_transaction_from_lead' );
		$this->loader->add_action( 'wp_ajax_nopriv_realty_workstation_pro_create_transaction_from_lead', $plugin_admin, 'realty_workstation_pro_create_transaction_from_lead' );

		// Deleting Lead Temporary
		$this->loader->add_action( 'wp_ajax_realty_workstation_pro_delete_lead_temporary', $plugin_admin, 'realty_workstation_pro_delete_lead_temporary' );
		$this->loader->add_action( 'wp_ajax_nopriv_realty_workstation_pro_delete_lead_temporary', $plugin_admin, 'realty_workstation_pro_delete_lead_temporary' );

		// Deleting Lead
		$this->loader->add_action( 'wp_ajax_realty_workstation_pro_delete_lead', $plugin_admin, 'realty_workstation_pro_delete_lead' );
		$this->loader->add_action( 'wp_ajax_nopriv_realty_workstation_pro_delete_lead', $plugin_admin, 'realty_workstation_pro_delete_lead' );

		// Adding New Contract
		$this->loader->add_action( 'wp_ajax_realty_workstation_pro_add_new_contract', $plugin_admin, 'realty_workstation_pro_add_new_contract' );
		$this->loader->add_action( 'wp_ajax_nopriv_realty_workstation_pro_add_new_contract', $plugin_admin, 'realty_workstation_pro_add_new_contract' );

		// Deleting Contract
		$this->loader->add_action( 'wp_ajax_realty_workstation_pro_delete_contract', $plugin_admin, 'realty_workstation_pro_delete_contract' );
		$this->loader->add_action( 'wp_ajax_nopriv_realty_workstation_pro_delete_contract', $plugin_admin, 'realty_workstation_pro_delete_contract' );

		// Deleting Contract
		$this->loader->add_action( 'wp_ajax_realty_workstation_pro_update_contract', $plugin_admin, 'realty_workstation_pro_update_contract' );
		$this->loader->add_action( 'wp_ajax_nopriv_realty_workstation_pro_update_contract', $plugin_admin, 'realty_workstation_pro_update_contract' );

		// Creating Backup
		$this->loader->add_action( 'wp_ajax_realty_workstation_pro_create_backup', $plugin_admin, 'realty_workstation_pro_create_backup' );
		$this->loader->add_action( 'wp_ajax_nopriv_realty_workstation_pro_create_backup', $plugin_admin, 'realty_workstation_pro_create_backup' );

		// Uploading Backup
		$this->loader->add_action( 'wp_ajax_realty_workstation_pro_upload_backup', $plugin_admin, 'realty_workstation_pro_upload_backup' );
		$this->loader->add_action( 'wp_ajax_nopriv_realty_workstation_pro_upload_backup', $plugin_admin, 'realty_workstation_pro_upload_backup' );

		// Restoring Backup
		$this->loader->add_action( 'wp_ajax_realty_workstation_pro_restore_backup', $plugin_admin, 'realty_workstation_pro_restore_backup' );
		$this->loader->add_action( 'wp_ajax_nopriv_realty_workstation_pro_restore_backup', $plugin_admin, 'realty_workstation_pro_restore_backup' );

	}

	/**
	 * Register all of the hooks related to the public-facing functionality
	 * of the plugin.
	 *
	 * @since    1.0.0
	 * @access   private
	 */
	private function define_public_hooks() {

		$plugin_public = new Realty_Workstation_Pro_Public( $this->get_plugin_name(), $this->get_version() );

		$this->loader->add_action( 'wp_enqueue_scripts', $plugin_public, 'enqueue_styles' );
		$this->loader->add_action( 'wp_enqueue_scripts', $plugin_public, 'enqueue_scripts' );

		$this->loader->add_filter( 'template_include', $plugin_public, 'realty_workstation_pro_load_plugin_template' );

	}

	/**
	 * Run the loader to execute all of the hooks with WordPress.
	 *
	 * @since    1.0.0
	 */
	public function run() {
		$this->loader->run();
	}

	/**
	 * The name of the plugin used to uniquely identify it within the context of
	 * WordPress and to define internationalization functionality.
	 *
	 * @since     1.0.0
	 * @return    string    The name of the plugin.
	 */
	public function get_plugin_name() {
		return $this->plugin_name;
	}

	/**
	 * The reference to the class that orchestrates the hooks with the plugin.
	 *
	 * @since     1.0.0
	 * @return    Realty_Workstation_Pro_Loader    Orchestrates the hooks of the plugin.
	 */
	public function get_loader() {
		return $this->loader;
	}

	/**
	 * Retrieve the version number of the plugin.
	 *
	 * @since     1.0.0
	 * @return    string    The version number of the plugin.
	 */
	public function get_version() {
		return $this->version;
	}

}
