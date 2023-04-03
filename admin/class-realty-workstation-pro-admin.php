<?php

require_once( REALTY_WORKSTATION_PRO_PATH . 'libraries/simplexlsxgen/vendor/autoload.php' );
require_once( REALTY_WORKSTATION_PRO_PATH . 'libraries/simplexlsx/vendor/autoload.php' );
use Shuchkin\SimpleXLSX;
require_once( REALTY_WORKSTATION_PRO_PATH . 'libraries/zip/vendor/autoload.php' );

/**
 * The admin-specific functionality of the plugin.
 *
 * @link       https://https://wppb.me/
 * @since      1.0.0
 *
 * @package    Realty_Workstation_Pro
 * @subpackage Realty_Workstation_Pro/admin
 */

/**
 * The admin-specific functionality of the plugin.
 *
 * Defines the plugin name, version, and two examples hooks for how to
 * enqueue the admin-specific stylesheet and JavaScript.
 *
 * @package    Realty_Workstation_Pro
 * @subpackage Realty_Workstation_Pro/admin
 * @author     Tech Mirza <talhamirza2@gmail.com>
 */
class Realty_Workstation_Pro_Admin {

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
	 * @param      string    $plugin_name       The name of this plugin.
	 * @param      string    $version    The version of this plugin.
	 */
	public function __construct( $plugin_name, $version ) {

		$this->plugin_name = $plugin_name;
		$this->version = $version;

	}

	/**
	 * Register the stylesheets for the admin area.
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

		wp_enqueue_style( $this->plugin_name . '-font-awesome', plugin_dir_url( __FILE__ ) . 'css/font-awesome/css/font-awesome.min.css', array(), $this->version, 'all' );
		wp_enqueue_style( $this->plugin_name . '-uploader', plugin_dir_url( __FILE__ ) . 'css/uploader.css', array(), $this->version, 'all' );
		wp_enqueue_style( $this->plugin_name . '-jquery-dataTables', plugin_dir_url( __FILE__ ) . 'css/jquery.dataTables.min.css', array(), $this->version, 'all' );
		wp_enqueue_style( $this->plugin_name, plugin_dir_url( __FILE__ ) . 'css/realty-workstation-pro-admin.css', array(), $this->version, 'all' );
		
	}

	/**
	 * Register the JavaScript for the admin area.
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

		wp_enqueue_script( $this->plugin_name . '-jquery-dataTables', plugin_dir_url( __FILE__ ) . 'js/jquery.dataTables.min.js', array( 'jquery' ), $this->version, false );
		wp_enqueue_script( $this->plugin_name . '-sweetalert2', plugin_dir_url( __FILE__ ) . 'js/sweetalert2.min.js', array( 'jquery' ), $this->version, false );
		wp_enqueue_script( $this->plugin_name . '-maskMoney', plugin_dir_url( __FILE__ ) . 'js/jquery.maskMoney.min.js', array( 'jquery' ), $this->version, false );
		wp_enqueue_script( $this->plugin_name, plugin_dir_url( __FILE__ ) . 'js/realty-workstation-pro-admin.js', array( 'jquery' ), $this->version, false );
		wp_localize_script( $this->plugin_name, 'rw_object', array( 'admin_url' => admin_url() ) );
		
	}

	public function realty_workstation_pro_settings() {
		register_setting( 'realty-workstation-pro-settings', 'realty_workstation_pro_settings' );
		add_role(
			'rw_agent',
			'Agent',
			array(
				'read'         => true,
				'delete_posts' => false
			)
		);
	}

	public function realty_workstation_pro_menu() {
		add_menu_page(
			'Realty Workstation',
			'Realty Workstation',
			'manage_options',
			'realty-workstation-pro-settings',
			array($this, 'plugin_settings_callback'),
			REALTY_WORKSTATION_PRO_URL . 'admin/icons/icon.png',
			5
		);
		add_submenu_page(
			'realty-workstation-pro-settings',
			'Agents',
			'Agents',
			'manage_options',
			'realty-workstation-pro-settings',
			array($this, 'plugin_agents_settings_callback')
		);
		add_submenu_page(
			'realty-workstation-pro-settings',
			'Agent Transactions',
			'Agent Transactions',
			'manage_options',
			'realty-workstation-pro-agent-transactions-settings',
			array($this, 'plugin_agent_transactions_settings_callback')
		);
		add_submenu_page(
			'realty-workstation-pro-settings',
			'Broker Transactions',
			'Broker Transactions',
			'manage_options',
			'realty-workstation-pro-broker-transactions-settings',
			array($this, 'plugin_broker_transactions_settings_callback')
		);
		add_submenu_page(
			'realty-workstation-pro-settings',
			'Leads',
			'Leads',
			'manage_options',
			'realty-workstation-pro-leads-settings',
			array($this, 'plugin_leads_settings_callback')
		);
		add_submenu_page(
			'realty-workstation-pro-settings',
			'Contracts',
			'Contracts',
			'manage_options',
			'realty-workstation-pro-contracts-settings',
			array($this, 'plugin_contracts_settings_callback')
		);
		add_submenu_page(
			'realty-workstation-pro-settings',
			'Backup and Restore',
			'Backup and Restore',
			'manage_options',
			'realty-workstation-pro-backup-and-restore-settings',
			array($this, 'plugin_backup_and_restore_settings_callback')
		);
		add_submenu_page(
			'realty-workstation-pro-settings',
			'Settings',
			'Settings',
			'manage_options',
			'realty-workstation-pro-general-settings',
			array($this, 'plugin_general_settings_callback')
		);
	}

	public function plugin_settings_callback() {
		require('partials/realty-workstation-pro-admin-display.php');
	}

	public function plugin_agents_settings_callback() {
		$newAgent = (isset($_GET['new-agent']) && !empty($_GET['new-agent']) ? $_GET['new-agent'] : '');
		$editAgent = (isset($_GET['edit-agent']) && !empty($_GET['edit-agent']) ? $_GET['edit-agent'] : '');
		$agentID = (isset($_GET['agent-id']) && !empty($_GET['agent-id']) ? $_GET['agent-id'] : '');
		if (isset($newAgent) && !empty($newAgent) && $newAgent == 'true') {
			require('partials/realty-workstation-pro-new-agent-display.php');
		} else if (isset($editAgent) && !empty($editAgent) && $editAgent == 'true') {
			$agent = get_user_by('ID', $agentID);
			require('partials/realty-workstation-pro-edit-agent-display.php');
		} else {
			require('partials/realty-workstation-pro-agents-display.php');
		}
	}

	public function plugin_agent_transactions_settings_callback() {
		$newAgentTransaction = (isset($_GET['new-agent-transaction']) && !empty($_GET['new-agent-transaction'])) ? $_GET['new-agent-transaction'] : '';
		$editAgentTransaction = (isset($_GET['edit-agent-transaction']) && !empty($_GET['edit-agent-transaction'])) ? $_GET['edit-agent-transaction'] : '';
		$transactionID = (isset($_GET['transaction-id']) && !empty($_GET['transaction-id'])) ? $_GET['transaction-id'] : '';
		if (isset($newAgentTransaction) && !empty($newAgentTransaction) && $newAgentTransaction == 'true') {
			require('partials/realty-workstation-pro-new-agent-transaction-display.php');
		} else if (isset($editAgentTransaction) && !empty($editAgentTransaction) && $editAgentTransaction == 'true') {
			$transaction = get_post((int) $transactionID);
			require('partials/realty-workstation-pro-edit-agent-transaction-display.php');
		} else {
			require('partials/realty-workstation-pro-agent-transactions-display.php');
		}
	}

	public function plugin_broker_transactions_settings_callback() {
		$newBrokerTransaction = (isset($_GET['new-broker-transaction']) && !empty($_GET['new-broker-transaction'])) ? $_GET['new-broker-transaction'] : '';
		$editBrokerTransaction = (isset($_GET['edit-broker-transaction']) && !empty($_GET['edit-broker-transaction'])) ? $_GET['edit-broker-transaction'] : '';
		$transactionID = (isset($_GET['transaction-id']) && !empty($_GET['transaction-id'])) ? $_GET['transaction-id'] : '';
		if (isset($newBrokerTransaction) && !empty($newBrokerTransaction) && $newBrokerTransaction == 'true') {
			require('partials/realty-workstation-pro-new-broker-transaction-display.php');
		} else if (isset($editBrokerTransaction) && !empty($editBrokerTransaction) && $editBrokerTransaction == 'true') {
			$transaction = get_post((int) $transactionID);
			require('partials/realty-workstation-pro-edit-broker-transaction-display.php');
		} else {
			require('partials/realty-workstation-pro-broker-transactions-display.php');
		}
	}

	public function plugin_leads_settings_callback() {
		$newLead = (isset($_GET['new-lead']) && !empty($_GET['new-lead'])) ? $_GET['new-lead'] : '';
		$editLead = (isset($_GET['edit-lead']) && !empty($_GET['edit-lead'])) ? $_GET['edit-lead'] : '';
		$leadID = (isset($_GET['lead-id']) && !empty($_GET['lead-id'])) ? $_GET['lead-id'] : '';
		if (isset($newLead) && !empty($newLead) && $newLead == 'true') {
			require('partials/realty-workstation-pro-new-lead-display.php');
		} else if (isset($editLead) && !empty($editLead) && $editLead == 'true') {
			$lead = get_post((int) $leadID);
			require('partials/realty-workstation-pro-edit-lead-display.php');
		} else {
			require('partials/realty-workstation-pro-leads-display.php');
		}
	}

	public function plugin_contracts_settings_callback() {
		$newContract = (isset($_GET['new-contract']) && !empty($_GET['new-contract'])) ? $_GET['new-contract'] : '';
		$editContract = (isset($_GET['edit-contract']) && !empty($_GET['edit-contract'])) ? $_GET['edit-contract'] : '';
		$viewContract = (isset($_GET['view-contract']) && !empty($_GET['view-contract'])) ? $_GET['view-contract'] : '';
		$contractID = (isset($_GET['contract-id']) && !empty($_GET['contract-id'])) ? $_GET['contract-id'] : '';
		if (isset($newContract) && !empty($newContract) && $newContract == 'true') {
			require('partials/realty-workstation-pro-new-contract-display.php');
		} else if (isset($viewContract) && !empty($viewContract) && $viewContract == 'true') {
			$contract = get_post((int) $contractID);
			require('partials/realty-workstation-pro-view-contract-display.php');
		} else if (isset($editContract) && !empty($editContract) && $editContract == 'true') {
			$contract = get_post((int) $contractID);
			require('partials/realty-workstation-pro-edit-contract-display.php');
		} else {
			require('partials/realty-workstation-pro-contracts-display.php');
		}
	}

	public function plugin_backup_and_restore_settings_callback() {
		require('partials/realty-workstation-pro-backup-and-restore-display.php');
	}

	public function plugin_general_settings_callback() {
		require('partials/realty-workstation-pro-general-settings-display.php');
	}

	public function realty_workstation_pro_add_new_agent() {
		$first_name = $_POST['first_name'];
		$last_name = $_POST['last_name'];
		$email = $_POST['email'];
		$password = $_POST['password'];
		$commission = $_POST['commission'];
		$lease = $_POST['lease'];
		$sale_and_purchase = $_POST['sale_and_purchase'];
		$exists = email_exists( $email );
		if ( $exists ) {
			echo false;
		} else {
			$user_id = wp_create_user($email, $password, $email);
			wp_update_user([
				'ID' => $user_id, // this is the ID of the user you want to update.
				'first_name' => $first_name,
				'last_name' => $last_name,
			]);
			update_user_meta( $user_id, 'commission', $commission );
			update_user_meta( $user_id, 'lease', $lease );
			update_user_meta( $user_id, 'sale_and_purchase', $sale_and_purchase );
			$user = get_user_by('id', $user_id);
			$user->remove_role('subscriber');
			$user->add_role('rw_agent');
			echo true;
		}
		wp_die();
	}

	public function realty_workstation_pro_update_agent() {
		$agent_id = $_POST['agent_id'];
		$first_name = $_POST['first_name'];
		$last_name = $_POST['last_name'];
		$email = $_POST['email'];
		$password = $_POST['password'];
		$commission = $_POST['commission'];
		$lease = $_POST['lease'];
		$sale_and_purchase = $_POST['sale_and_purchase'];
		if (isset($password) && !empty($password)) {
			wp_update_user([
				'ID' => $agent_id, // this is the ID of the user you want to update.
				'first_name' => $first_name,
				'last_name' => $last_name,
				'user_pass' => $password,
				'user_email' => $email,
				'user_login' => $email
			]);
		} else {
			wp_update_user([
				'ID' => $agent_id, // this is the ID of the user you want to update.
				'first_name' => $first_name,
				'last_name' => $last_name,
				'user_email' => $email,
				'user_login' => $email
			]);
		}
		update_user_meta( $agent_id, 'commission', $commission );
		update_user_meta( $agent_id, 'lease', $lease );
		update_user_meta( $agent_id, 'sale_and_purchase', $sale_and_purchase );
		echo true;
		wp_die();
	}

	public function realty_workstation_pro_delete_agent() {
		$agentID = $_POST['agentID'];
		wp_delete_user( (int) $agentID );
		echo admin_url('admin.php?page=realty-workstation-pro-settings&delete-success=true');
		wp_die();
	}

	public function generateRandomString($length = 10) {
		$characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
		$charactersLength = strlen($characters);
		$randomString = '';
		for ($i = 0; $i < $length; $i++) {
			$randomString .= $characters[random_int(0, $charactersLength - 1)];
		}
		return $randomString;
	}

	public function realty_workstation_pro_add_new_transaction() {
		$category = $_POST['category'];
		$agent = $_POST['agent'];
		$type = $_POST['type'];
		$address = $_POST['address'];
		$apt = $_POST['apt'];
		$city = $_POST['city'];
		$zip = $_POST['zip'];
		$fullname = $_POST['fullname'];
		$company = $_POST['company'];
		$phone = $_POST['phone'];
		$email = $_POST['email'];
		$new_post = array(
			'post_title' => $this->generateRandomString(),
			'post_content' => '',
			'post_status' => 'publish',
			'post_date' => date('Y-m-d H:i:s'),
			'post_type' => 'rw-transaction'
		);
		$post_id = wp_insert_post($new_post);
		if ( $post_id ) {
			update_post_meta( $post_id, 'category', $category );
			update_post_meta( $post_id, 'status', 'open' );
			update_post_meta( $post_id, 'agent', $agent );
			update_post_meta( $post_id, 'type', $type );
			update_post_meta( $post_id, 'address', $address );
			update_post_meta( $post_id, 'apt', $apt );
			update_post_meta( $post_id, 'city', $city );
			update_post_meta( $post_id, 'zip', $zip );
			update_post_meta( $post_id, 'fullname', $fullname );
			update_post_meta( $post_id, 'company', $company );
			update_post_meta( $post_id, 'phone', $phone );
			update_post_meta( $post_id, 'email', $email );
			echo true;
		}
		wp_die();
	}

	public function realty_workstation_pro_upload_document() {
		if ( ! function_exists('wp_handle_upload') ) {
			require_once( ABSPATH . 'wp-admin/includes/file.php' );
		}
		$transactionID = $_POST['transactionID'];
		$documentType = $_POST['documentType'];
		$uploadedDocument = $_FILES['document'];
		$upload_overrides = array('test_form' => false);
		$document = wp_handle_upload($uploadedDocument, $upload_overrides);
		$new_post = array(
			'post_title' => $this->generateRandomString(),
			'post_content' => '',
			'post_status' => 'publish',
			'post_date' => date('Y-m-d H:i:s'),
			'post_type' => 'rw-transaction-doc'
		);
		$post_id = wp_insert_post($new_post);
		if ( $post_id ) {
			update_post_meta( $post_id, 'transactionID', $transactionID );
			update_post_meta( $post_id, 'documentType', $documentType );
			update_post_meta( $post_id, 'documentName', basename($document['url']) );
			update_post_meta( $post_id, 'documentURL', $document['url'] );
			$array = array(
				'documentID' => $post_id,
				'documentName' => basename($document['url']),
				'documentURL' => $document['url']
			);
			echo json_encode($array);
		}
		wp_die();
	}

	public function realty_workstation_pro_delete_document() {
		$documentID = $_POST['documentID'];
		wp_delete_post( (int) $documentID, true );
		wp_die();
	}

	public function realty_workstation_pro_delete_transaction() {
		$transactionID = $_POST['transactionID'];
		wp_update_post(array(
			'ID'    		=>  (int) $transactionID,
			'post_status'   =>  'draft'
		));
		wp_die();
	}

	public function realty_workstation_pro_update_transaction() {
		$transactionID = (int) $_POST['transactionID'];
		update_post_meta( $transactionID, 'status', 'open' );
		update_post_meta( $transactionID, 'address', $_POST['address'] );
		update_post_meta( $transactionID, 'apt', $_POST['apt'] );
		update_post_meta( $transactionID, 'city', $_POST['city'] );
		update_post_meta( $transactionID, 'zip', $_POST['zip'] );
		update_post_meta( $transactionID, 'fullname', $_POST['fullname'] );
		update_post_meta( $transactionID, 'company', $_POST['company'] );
		update_post_meta( $transactionID, 'phone', $_POST['phone'] );
		update_post_meta( $transactionID, 'email', $_POST['email'] );
		update_post_meta( $transactionID, 'sales_price', $_POST['salesPrice'] );
		update_post_meta( $transactionID, 'total_commission', $_POST['totalCommission'] );
		update_post_meta( $transactionID, 'broker_referral', ($_POST['brokerReferral'] && $_POST['brokerReferral'] == 'true') ? 'true' : 'false' );
		update_post_meta( $transactionID, 'agent_payout', $_POST['agentPayout'] );
		echo true;
		wp_die();
	}

	public function realty_workstation_pro_close_transaction() {
		$transactionID = (int) $_POST['transactionID'];
		$time = current_time('mysql');
		wp_update_post(
			array (
				'ID'            => $transactionID, // ID of the post to update
				'post_modified'     => $time,
				'post_modified_gmt' => get_gmt_from_date( $time )
			)
		);
		update_post_meta( $transactionID, 'status', 'closed' );
		update_post_meta( $transactionID, 'address', $_POST['address'] );
		update_post_meta( $transactionID, 'apt', $_POST['apt'] );
		update_post_meta( $transactionID, 'city', $_POST['city'] );
		update_post_meta( $transactionID, 'zip', $_POST['zip'] );
		update_post_meta( $transactionID, 'fullname', $_POST['fullname'] );
		update_post_meta( $transactionID, 'company', $_POST['company'] );
		update_post_meta( $transactionID, 'phone', $_POST['phone'] );
		update_post_meta( $transactionID, 'email', $_POST['email'] );
		update_post_meta( $transactionID, 'sales_price', $_POST['salesPrice'] );
		update_post_meta( $transactionID, 'total_commission', $_POST['totalCommission'] );
		update_post_meta( $transactionID, 'broker_referral', ($_POST['brokerReferral'] && $_POST['brokerReferral'] == 'true') ? 'true' : 'false' );
		update_post_meta( $transactionID, 'agent_payout', $_POST['agentPayout'] );
		update_post_meta( $transactionID, 'completed', date('d-m-Y H:i:s') );
		$agent = get_post_meta( $transactionID, 'agent', true );
		if ( isset($agent) && !empty($agent) ) {
			$agent = get_user_by('ID', (int) $agent);
			$message = $agent->first_name . ' ' . $agent->last_name . ' has closed a transaction and requested payment.';
			$message .= '<p>';
			$message .= 'Property information is below:';
			$message .= '</p>';
			$message .= '<p>';
			$message .= '<ul>';
			$message .= '<li>Property Street: ' . get_post_meta( $transactionID, 'address', true ) . '</li>';
			$message .= '<li>Property Apt: ' . get_post_meta( $transactionID, 'apt', true ) . '</li>';
			$message .= '<li>Property City: ' . get_post_meta( $transactionID, 'city', true ) . '</li>';
			$message .= '<li>Property ZIP: ' . get_post_meta( $transactionID, 'zip', true ) . '</li>';
			$message .= '</ul>';
			$message .= '</p>';
			$message .= '<p>';
			$message .= 'Price and Commission:';
			$message .= '</p>';
			$message .= '<p>';
			$message .= '<ul>';
			$type = get_post_meta( $transactionID, 'type', true );
			if ($type == 'Sale' || $type == 'Purchase') {
				$message .= '<li>Sale Price: ' . get_post_meta( $transactionID, 'sales_price', true ) . '</li>';
			} else {
				$message .= '<li>Lease Price: ' . get_post_meta( $transactionID, 'sales_price', true ) . '</li>';
			}
			$message .= '<li>Total Commission: ' . get_post_meta( $transactionID, 'total_commission', true ) . '</li>';
			$message .= '<li>Agent Payout: ' . get_post_meta( $transactionID, 'agent_payout', true ) . '</li>';
			$message .= '</ul>';
			$message .= '</p>';
			wp_mail( get_option('rw_broker_email'), $agent->first_name . ' ' . $agent->last_name . ' has closed a transaction and requested payment. ', $message );
		}
		echo true;
		wp_die();
	}

	public function realty_workstation_pro_update_general_settings() {
		$rw_webpage = $_POST['rw_webpage'];
		$rw_name = $_POST['rw_name'];
		$rw_broker_email = $_POST['rw_broker_email'];
		$rw_broker_password = $_POST['rw_broker_password'];
		$rw_bank_name = $_POST['rw_bank_name'];
		$rw_account_name = $_POST['rw_account_name'];
		$rw_account_number = $_POST['rw_account_number'];
		$rw_account_address = $_POST['rw_account_address'];
		update_option( 'rw_webpage', $_POST['rw_webpage'] );
		update_option( 'rw_name', $_POST['rw_name'] );
		update_option( 'rw_broker_email', $_POST['rw_broker_email'] );
		update_option( 'rw_broker_password', $_POST['rw_broker_password'] );
		update_option( 'rw_bank_name', $_POST['rw_bank_name'] );
		update_option( 'rw_account_name', $_POST['rw_account_name'] );
		update_option( 'rw_account_number', $_POST['rw_account_number'] );
		update_option( 'rw_account_address', $_POST['rw_account_address'] );
		echo true;
		wp_die();
	}

	public function realty_workstation_pro_change_password() {
		$password = $_POST['password'];
		$userdata['ID'] = get_current_user_id();
		$userdata['user_pass'] = $password;
		wp_update_user( $userdata );
		echo true;
		wp_die();
	}

	public function realty_workstation_pro_signin() {
		$email = $_POST['email'];
		$password = $_POST['password'];
		$user = wp_authenticate($email, $password);
		if ( ! is_wp_error($user) ) {
			$roles = ( array ) $user->roles;
			if ( in_array( 'rw_agent', $roles ) ) {
				wp_clear_auth_cookie();
				wp_set_current_user($user->ID);
				wp_set_auth_cookie($user->ID);
				update_user_meta( $user->ID, 'last_accessed', date('d-m-Y H:i A') );
				session_start();
				$_SESSION['rwUser'] = 'agent';
				echo true;
			}
		} else {
			$rw_broker_email = get_option( 'rw_broker_email' );
    		$rw_broker_password = get_option( 'rw_broker_password' );
			if ($email == $rw_broker_email && $password == $rw_broker_password) {
				session_start();
				$_SESSION['rwUser'] = 'broker';
				echo true;
			} else {
				echo false;
			}
		}
		wp_die();
	}

	public function realty_workstation_pro_logout() {
		$user = wp_get_current_user();
		$roles = ( array ) $user->roles;
		session_start();
		unset($_SESSION['rwUser']);
		if ( in_array( 'rw_agent', $roles ) ) {
			wp_destroy_current_session();
			wp_clear_auth_cookie();
			wp_set_current_user( 0 );
		}
		echo true;
		wp_die();
	}

	public function wpse27856_set_content_type() {
		return "text/html";
	}

	public function wpb_sender_name( $original_email_from ) {
		$rw_name = get_option('rw_name');
		if ( isset($rw_name) && !empty($rw_name) ) {
			return $rw_name;
		} else {
			return $original_email_from;
		}
	}

	public function realty_workstation_pro_check_activation() {
		$rw_license_key = get_option( 'rw_license_key' );
		if ( ! $rw_license_key ) { ?>
			<div class="notice notice-error is-dismissible">
				<p><strong><?php _e( 'Seems, you have installed Realty Workstation Pro but you have not entered license key. Please continue to enter license key to enjoy Pro features.', 'realty-workstation-pro' ); ?></strong></p>
			</div>
		<?php }
	}

	public function realty_workstation_pro_activate_license_key_settings() {
		$rw_license_key = $_POST['rw_license_key'];
		update_option( 'rw_license_key', $_POST['rw_license_key'] );
		echo true;
		wp_die();
	}

	public function realty_workstation_pro_add_new_lead() {
		$type = $_POST['type'];
		$fullname = $_POST['fullname'];
		$company = $_POST['company'];
		$phone = $_POST['phone'];
		$email = $_POST['email'];
		$address_1 = $_POST['address_1'];
		$apt_1 = $_POST['apt_1'];
		$city_1 = $_POST['city_1'];
		$zip_1 = $_POST['zip_1'];
		$address_2 = $_POST['address_2'];
		$apt_2 = $_POST['apt_2'];
		$city_2 = $_POST['city_2'];
		$zip_2 = $_POST['zip_2'];
		$address_3 = $_POST['address_3'];
		$apt_3 = $_POST['apt_3'];
		$city_3 = $_POST['city_3'];
		$zip_3 = $_POST['zip_3'];
		$address_4 = $_POST['address_4'];
		$apt_4 = $_POST['apt_4'];
		$city_4 = $_POST['city_4'];
		$zip_4 = $_POST['zip_4'];
		$new_post = array(
			'post_title' => $this->generateRandomString(),
			'post_content' => '',
			'post_status' => 'publish',
			'post_date' => date('Y-m-d H:i:s'),
			'post_type' => 'rw-lead'
		);
		$post_id = wp_insert_post($new_post);
		if ( $post_id ) {
			update_post_meta( $post_id, 'status', 'unassigned' );
			update_post_meta( $post_id, 'type', $type );
			update_post_meta( $post_id, 'fullname', $fullname );
			update_post_meta( $post_id, 'company', $company );
			update_post_meta( $post_id, 'phone', $phone );
			update_post_meta( $post_id, 'email', $email );
			update_post_meta( $post_id, 'address_1', $address_1 );
			update_post_meta( $post_id, 'apt_1', $apt_1 );
			update_post_meta( $post_id, 'city_1', $city_1 );
			update_post_meta( $post_id, 'zip_1', $zip_1 );
			update_post_meta( $post_id, 'address_2', $address_2 );
			update_post_meta( $post_id, 'apt_2', $apt_2 );
			update_post_meta( $post_id, 'city_2', $city_2 );
			update_post_meta( $post_id, 'zip_2', $zip_2 );
			update_post_meta( $post_id, 'address_3', $address_3 );
			update_post_meta( $post_id, 'apt_3', $apt_3 );
			update_post_meta( $post_id, 'city_3', $city_3 );
			update_post_meta( $post_id, 'zip_3', $zip_3 );
			update_post_meta( $post_id, 'address_4', $address_4 );
			update_post_meta( $post_id, 'apt_4', $apt_4 );
			update_post_meta( $post_id, 'city_4', $city_4 );
			update_post_meta( $post_id, 'zip_4', $zip_4 );
			echo true;
		}
		wp_die();
	}

	public function realty_workstation_pro_update_lead() {
		$leadID = (int) $_POST['leadID'];
		if (isset($_POST['agent']) && !empty($_POST['agent'])) {
			update_post_meta( $leadID, 'status', 'assigned' );
		} else {
			update_post_meta( $leadID, 'status', 'unassigned' );
		}
		update_post_meta( $leadID, 'agent', $_POST['agent'] );
		update_post_meta( $leadID, 'type', $_POST['type'] );
		update_post_meta( $leadID, 'fullname', $_POST['fullname'] );
		update_post_meta( $leadID, 'company', $_POST['company'] );
		update_post_meta( $leadID, 'phone', $_POST['phone'] );
		update_post_meta( $leadID, 'email', $_POST['email'] );
		update_post_meta( $leadID, 'address_1', $_POST['address_1'] );
		update_post_meta( $leadID, 'apt_1', $_POST['apt_1'] );
		update_post_meta( $leadID, 'city_1', $_POST['city_1'] );
		update_post_meta( $leadID, 'zip_1', $_POST['zip_1'] );
		update_post_meta( $leadID, 'address_2', $_POST['address_2'] );
		update_post_meta( $leadID, 'apt_2', $_POST['apt_2'] );
		update_post_meta( $leadID, 'city_2', $_POST['city_2'] );
		update_post_meta( $leadID, 'zip_2', $_POST['zip_2'] );
		update_post_meta( $leadID, 'address_3', $_POST['address_3'] );
		update_post_meta( $leadID, 'apt_3', $_POST['apt_3'] );
		update_post_meta( $leadID, 'city_3', $_POST['city_3'] );
		update_post_meta( $leadID, 'zip_3', $_POST['zip_3'] );
		update_post_meta( $leadID, 'address_4', $_POST['address_4'] );
		update_post_meta( $leadID, 'apt_4', $_POST['apt_4'] );
		update_post_meta( $leadID, 'city_4', $_POST['city_4'] );
		update_post_meta( $leadID, 'zip_4', $_POST['zip_4'] );
		echo true;
		wp_die();
	}

	public function realty_workstation_pro_create_transaction_from_lead() {
		$lead = get_post((int) $_POST['leadID']);
		$category = 'agent';
		$agent = get_post_meta( $lead->ID, 'agent', true );
		$type = get_post_meta( $lead->ID, 'type', true );
		$address = get_post_meta( $lead->ID, 'address_1', true );
		$apt = get_post_meta( $lead->ID, 'apt_1', true );
		$city = get_post_meta( $lead->ID, 'city_1', true );
		$zip = get_post_meta( $lead->ID, 'zip_1', true );
		$fullname = get_post_meta( $lead->ID, 'fullname', true );
		$company = get_post_meta( $lead->ID, 'company', true );
		$phone = get_post_meta( $lead->ID, 'phone', true );
		$email = get_post_meta( $lead->ID, 'email', true );
		$new_post = array(
			'post_title' => $this->generateRandomString(),
			'post_content' => '',
			'post_status' => 'publish',
			'post_date' => date('Y-m-d H:i:s'),
			'post_type' => 'rw-transaction'
		);
		$post_id = wp_insert_post($new_post);
		if ( $post_id ) {
			update_post_meta( $post_id, 'category', $category );
			update_post_meta( $post_id, 'status', 'open' );
			update_post_meta( $post_id, 'agent', $agent );
			update_post_meta( $post_id, 'type', $type );
			update_post_meta( $post_id, 'address', $address );
			update_post_meta( $post_id, 'apt', $apt );
			update_post_meta( $post_id, 'city', $city );
			update_post_meta( $post_id, 'zip', $zip );
			update_post_meta( $post_id, 'fullname', $fullname );
			update_post_meta( $post_id, 'company', $company );
			update_post_meta( $post_id, 'phone', $phone );
			update_post_meta( $post_id, 'email', $email );
			echo true;
		}
		wp_delete_post( $lead->ID, true );
		wp_die();
	}

	public function realty_workstation_pro_delete_lead_temporary() {
		$leadID = $_POST['leadID'];
		update_post_meta( $leadID, 'status', 'deleted' );
		wp_die();
	}

	public function realty_workstation_pro_delete_lead() {
		$leadID = $_POST['leadID'];
		wp_delete_post( (int) $leadID, true );
		wp_die();
	}

	public function realty_workstation_pro_add_new_contract() {
		$name = $_POST['name'];
		$description = $_POST['description'];
		$new_post = array(
			'post_title' => $this->generateRandomString(),
			'post_content' => '',
			'post_status' => 'publish',
			'post_date' => date('Y-m-d H:i:s'),
			'post_type' => 'rw-contract'
		);
		$post_id = wp_insert_post($new_post);
		if ( $post_id ) {
			update_post_meta( $post_id, 'name', $name );
			update_post_meta( $post_id, 'description', $description );
			if ( ! function_exists('wp_handle_upload') ) {
				require_once( ABSPATH . 'wp-admin/includes/file.php' );
			}
			$uploadedDocument = $_FILES['document'];
			$upload_overrides = array('test_form' => false);
			$document = wp_handle_upload($uploadedDocument, $upload_overrides);
			update_post_meta( $post_id, 'documentName', basename($document['url']) );
			update_post_meta( $post_id, 'documentURL', $document['url'] );
			echo true;
			wp_die();
		}
	}

	public function realty_workstation_pro_delete_contract() {
		$contractID = $_POST['contractID'];
		wp_delete_post( (int) $contractID, true );
		wp_die();
	}

	public function realty_workstation_pro_update_contract() {
		$contractID = (int) $_POST['contractID'];
		$name = $_POST['name'];
		$description = $_POST['description'];
		if ( $contractID ) {
			update_post_meta( $contractID, 'name', $name );
			update_post_meta( $contractID, 'description', $description );
		}
		$uploadedDocument = $_FILES['document'];
		if ( $uploadedDocument ) {
			if ( ! function_exists('wp_handle_upload') ) {
				require_once( ABSPATH . 'wp-admin/includes/file.php' );
			}
			$upload_overrides = array('test_form' => false);
			$document = wp_handle_upload($uploadedDocument, $upload_overrides);
			update_post_meta( $contractID, 'documentName', basename($document['url']) );
			update_post_meta( $contractID, 'documentURL', $document['url'] );
		}
		echo true;
		wp_die();
	}

	public function deleteDir($dirPath) {
		if (! is_dir($dirPath)) {
			throw new InvalidArgumentException("$dirPath must be a directory");
		}
		if (substr($dirPath, strlen($dirPath) - 1, 1) != '/') {
			$dirPath .= '/';
		}
		$files = glob($dirPath . '*', GLOB_MARK);
		foreach ($files as $file) {
			if (is_dir($file)) {
				$this->deleteDir($file);
			} else {
				unlink($file);
			}
		}
		rmdir($dirPath);
	}

	public function folderSize( $dir ) {
		$size = 0;
		foreach (glob(rtrim($dir, '/').'/*', GLOB_NOSORT) as $each) {
			$size += is_file($each) ? filesize($each) : folderSize($each);
		}
		return ($size / 1024) / 1024;
	}

	public function realty_workstation_pro_create_backup() {
		// Removing Files
		$dir = REALTY_WORKSTATION_PRO_PATH . 'backup';
		if ( is_dir($dir) ) {
			$this->deleteDir( $dir );
		}
		mkdir(REALTY_WORKSTATION_PRO_PATH . 'backup/');
		// Removing Files
		// Saving Settings
		$rw_name = get_option( 'rw_name' );
		$rw_broker_email = get_option( 'rw_broker_email' );
		$rw_broker_password = get_option( 'rw_broker_password' );
		$rw_bank_name = get_option( 'rw_bank_name' );
		$rw_account_name = get_option( 'rw_account_name' );
		$rw_account_number = get_option( 'rw_account_number' );
		$rw_account_address = get_option( 'rw_account_address' );
		$rw_license_key = get_option( 'rw_license_key' );
		$settings = [
			['RW Name', 'RW Broker Email', 'RW Broker Password', 'RW Bank Name', 'RW Account Name', 'RW Account Number', 'RW Account Address', 'RW License Key' ],
			[$rw_name, $rw_broker_email, $rw_broker_password, $rw_bank_name, $rw_account_name, $rw_account_number, $rw_account_address, $rw_license_key]
		];
		$xlsx = Shuchkin\SimpleXLSXGen::fromArray( $settings );
		$xlsx->saveAs(REALTY_WORKSTATION_PRO_PATH . 'backup/settings.xlsx');
		// Saving Settings
		// Saving Agents
		$agentsArray = [];
		array_push($agentsArray, ['ID', 'First Name', 'Last Name', 'Email', 'Password', 'Last Accessed', 'Commission', 'Lease', 'Sale and Purchase', 'User Registered']);
		$args = array(
			'role' => 'rw_agent',
			'orderby' => 'user_nicename',
			'order' => 'ASC'
		);
		$agents = get_users($args);
		foreach ($agents as $agent) {
			$commission = get_user_meta( $agent->ID, 'commission', true );
			$lease = get_user_meta( $agent->ID, 'lease', true );
			$sale_and_purchase = get_user_meta( $agent->ID, 'sale_and_purchase', true );
			$last_accessed = get_user_meta( $agent->ID, 'last_accessed', true );
			array_push($agentsArray, [$agent->ID, $agent->first_name, $agent->last_name, $agent->user_email, $agent->user_pass, $last_accessed, $commission, $lease, $sale_and_purchase, $agent->user_registered]);
		}
		$xlsx = Shuchkin\SimpleXLSXGen::fromArray( $agentsArray );
		$xlsx->saveAs(REALTY_WORKSTATION_PRO_PATH . 'backup/agents.xlsx');
		// Saving Agents
		// Saving Transactions
		$transactionsArray = [];
		array_push($transactionsArray, ['ID', 'Title', 'Post Date', 'Post Modified', 'Category', 'Status', 'Completed', 'Agent', 'Type', 'Address', 'Apt', 'City', 'Zip', 'Full Nmae', 'Company', 'Phone', 'Email', 'Sales Price', 'Total Commission', 'Broker Referral', 'Agent Payout']);
		$transactions = get_posts([
			'post_type' => 'rw-transaction',
			'post_status' => 'publish',
			'numberposts' => -1,
		]);
		foreach ($transactions as $transaction) {
			$category = get_post_meta( $transaction->ID, 'category', true );
			$status = get_post_meta( $transaction->ID, 'status', true );
			$completed = get_post_meta( $transaction->ID, 'completed', true );
			$agent = get_post_meta( $transaction->ID, 'agent', true );
			if ( isset($agent) && !empty($agent) ) {
				$agent = get_user_by('ID', $agent);
				$agent = $agent->user_email;
			}
			$type = get_post_meta( $transaction->ID, 'type', true );
			$address = get_post_meta( $transaction->ID, 'address', true );
			$apt = get_post_meta( $transaction->ID, 'apt', true );
			$city = get_post_meta( $transaction->ID, 'city', true );
			$zip = get_post_meta( $transaction->ID, 'zip', true );
			$fullname = get_post_meta( $transaction->ID, 'fullname', true );
			$company = get_post_meta( $transaction->ID, 'company', true );
			$phone = get_post_meta( $transaction->ID, 'phone', true );
			$email = get_post_meta( $transaction->ID, 'email', true );
			$sales_price = get_post_meta( $transaction->ID, 'sales_price', true );
			$total_commission = get_post_meta( $transaction->ID, 'total_commission', true );
			$broker_referral = get_post_meta( $transaction->ID, 'broker_referral', true );
			$agent_payout = get_post_meta( $transaction->ID, 'agent_payout', true );
			array_push($transactionsArray, [$transaction->ID, $transaction->post_title, $transaction->post_date, $transaction->post_modified, $category, $status, $completed, $agent, $type, $address, $apt, $city, $zip, $fullname, $company, $phone, $email, $sales_price, $total_commission, $broker_referral, $agent_payout]);
		}
		$xlsx = Shuchkin\SimpleXLSXGen::fromArray( $transactionsArray );
		$xlsx->saveAs(REALTY_WORKSTATION_PRO_PATH . 'backup/transactions.xlsx');
		// Saving Transactions
		// Saving Leads
		$leadArray = [];
		array_push($leadArray, ['ID', 'Title', 'Post Date', 'Post Modified', 'Status', 'Agent', 'Type', 'Address 1', 'Apt 1', 'City 1', 'Zip 1', 'Address 2', 'Apt 2', 'City 2', 'Zip 2', 'Address 3', 'Apt 3', 'City 3', 'Zip 3', 'Address 4', 'Apt 4', 'City 4', 'Zip 4', 'Full Nmae', 'Company', 'Phone', 'Email']);
		$leads = get_posts([
			'post_type' => 'rw-lead',
			'post_status' => 'publish',
			'numberposts' => -1,
		]);
		foreach ($leads as $lead) {
			$status = get_post_meta( $lead->ID, 'status', true );
			$agent = get_post_meta( $lead->ID, 'agent', true );
			if ( isset($agent) && !empty($agent) ) {
				$agent = get_user_by('ID', $agent);
				$agent = $agent->user_email;
			}
			$type = get_post_meta( $lead->ID, 'type', true );
			$fullname = get_post_meta( $lead->ID, 'fullname', true );
			$company = get_post_meta( $lead->ID, 'company', true );
			$phone = get_post_meta( $lead->ID, 'phone', true );
			$email = get_post_meta( $lead->ID, 'email', true );
			$address_1 = get_post_meta( $lead->ID, 'address_1', true );
			$apt_1 = get_post_meta( $lead->ID, 'apt_1', true );
			$city_1 = get_post_meta( $lead->ID, 'city_1', true );
			$zip_1 = get_post_meta( $lead->ID, 'zip_1', true );
			$address_2 = get_post_meta( $lead->ID, 'address_2', true );
			$apt_2 = get_post_meta( $lead->ID, 'apt_2', true );
			$city_2 = get_post_meta( $lead->ID, 'city_2', true );
			$zip_2 = get_post_meta( $lead->ID, 'zip_2', true );
			$address_3 = get_post_meta( $lead->ID, 'address_3', true );
			$apt_3 = get_post_meta( $lead->ID, 'apt_3', true );
			$city_3 = get_post_meta( $lead->ID, 'city_3', true );
			$zip_3 = get_post_meta( $lead->ID, 'zip_3', true );
			$address_4 = get_post_meta( $lead->ID, 'address_4', true );
			$apt_4 = get_post_meta( $lead->ID, 'apt_4', true );
			$city_4 = get_post_meta( $lead->ID, 'city_4', true );
			$zip_4 = get_post_meta( $lead->ID, 'zip_4', true );
			array_push($leadArray, [$lead->ID, $lead->post_title, $lead->post_date, $lead->post_modified, $status, $agent, $type, $address_1, $apt_1, $city_1, $zip_2, $address_2, $apt_2, $city_2, $zip_2, $address_3, $apt_3, $city_3, $zip_3, $address_4, $apt_4, $city_4, $zip_4, $fullname, $company, $phone, $email]);
		}
		$xlsx = Shuchkin\SimpleXLSXGen::fromArray( $leadArray );
		$xlsx->saveAs(REALTY_WORKSTATION_PRO_PATH . 'backup/leads.xlsx');
		// Saving Leadsrw-transaction-doc
		// Saving Contracts
		$contractArray = [];
		array_push($contractArray, ['ID', 'Title', 'Post Date', 'Post Modified', 'Name', 'Description', 'Document Name', 'Document URL']);
		$contractDocsFolderCounter = 1;
		$contracts = get_posts([
			'post_type' => 'rw-contract',
			'post_status' => 'publish',
			'numberposts' => -1,
		]);
		foreach ($contracts as $contract) {
			$name = get_post_meta( $contract->ID, 'name', true );
			$description = get_post_meta( $contract->ID, 'description', true );
			$documentName = get_post_meta( $contract->ID, 'documentName', true );
			$documentURL = get_post_meta( $contract->ID, 'documentURL', true );
			if ( is_dir(REALTY_WORKSTATION_PRO_PATH . 'backup/ContractDocs-' . $contractDocsFolderCounter) ) {
				if ( $this->folderSize(REALTY_WORKSTATION_PRO_PATH . 'backup/ContractDocs-' . $contractDocsFolderCounter) < 30 ) {
					copy($documentURL, REALTY_WORKSTATION_PRO_PATH . 'backup/ContractDocs-' . $contractDocsFolderCounter . '/' . $documentName);
				} else {
					$contractDocsFolderCounter++;
					mkdir( REALTY_WORKSTATION_PRO_PATH . 'backup/ContractDocs-' . $contractDocsFolderCounter );
					copy($documentURL, REALTY_WORKSTATION_PRO_PATH . 'backup/ContractDocs-' . $contractDocsFolderCounter . '/' . $documentName);
				}

			} else {
				mkdir( REALTY_WORKSTATION_PRO_PATH . 'backup/ContractDocs-' . $contractDocsFolderCounter );
				copy($documentURL, REALTY_WORKSTATION_PRO_PATH . 'backup/ContractDocs-' . $contractDocsFolderCounter . '/' . $documentName);
			}
			array_push($contractArray, [$contract->ID, $contract->post_title, $contract->post_date, $contract->post_modified, $name, $description, $documentName, $documentURL]);
		}
		$xlsx = Shuchkin\SimpleXLSXGen::fromArray( $contractArray );
		$xlsx->saveAs(REALTY_WORKSTATION_PRO_PATH . 'backup/contracts.xlsx');
		// Saving Contracts
		// Saving Transaction Docs
		$transactionDocsArray = [];
		array_push($transactionDocsArray, ['ID', 'Title', 'Transaction ID', 'Document Type', 'Document Name', 'Document URL']);
		$transactionDocsFolderCounter = 1;
		$transactionDocs = get_posts([
			'post_type' => 'rw-transaction-doc',
			'post_status' => 'publish',
			'numberposts' => -1,
		]);
		foreach ($transactionDocs as $transactionDoc) {
			$transactionID = get_post_meta( $transactionDoc->ID, 'transactionID', true );
			$documentType = get_post_meta( $transactionDoc->ID, 'documentType', true );
			$documentName = get_post_meta( $transactionDoc->ID, 'documentName', true );
			$documentURL = get_post_meta( $transactionDoc->ID, 'documentURL', true );
			if ( is_dir(REALTY_WORKSTATION_PRO_PATH . 'backup/TransactionDocs-' . $transactionDocsFolderCounter) ) {
				if ( $this->folderSize(REALTY_WORKSTATION_PRO_PATH . 'backup/TransactionDocs-' . $transactionDocsFolderCounter) < 30 ) {
					copy($documentURL, REALTY_WORKSTATION_PRO_PATH . 'backup/TransactionDocs-' . $transactionDocsFolderCounter . '/' . $documentName);
				} else {
					$transactionDocsFolderCounter++;
					mkdir( REALTY_WORKSTATION_PRO_PATH . 'backup/TransactionDocs-' . $transactionDocsFolderCounter );
					copy($documentURL, REALTY_WORKSTATION_PRO_PATH . 'backup/TransactionDocs-' . $transactionDocsFolderCounter . '/' . $documentName);
				}

			} else {
				mkdir( REALTY_WORKSTATION_PRO_PATH . 'backup/TransactionDocs-' . $transactionDocsFolderCounter );
				copy($documentURL, REALTY_WORKSTATION_PRO_PATH . 'backup/TransactionDocs-' . $transactionDocsFolderCounter . '/' . $documentName);
			}
			array_push($transactionDocsArray, [$transactionDoc->ID, $transactionDoc->post_title, $transactionID, $documentType, $documentName, $documentURL]);
		}
		$xlsx = Shuchkin\SimpleXLSXGen::fromArray( $transactionDocsArray );
		$xlsx->saveAs(REALTY_WORKSTATION_PRO_PATH . 'backup/transactionDocs.xlsx');
		// Saving Transaction Docs
		// Zip Archiving
		$zipFile = new \PhpZip\ZipFile();
		try {
			$zipFile
				->addDir(REALTY_WORKSTATION_PRO_PATH . 'backup', '') // add files from the directory
				->saveAsFile(REALTY_WORKSTATION_PRO_PATH . 'backup-1.zip') // save the archive to a file
				->close(); // close archive
		}
		catch (\PhpZip\Exception\ZipException $e) {
			// handle exception
		}
		finally{
			$zipFile->close();
		}
		$backupCounter = 2;
		$transactionDocFolders = glob(REALTY_WORKSTATION_PRO_PATH . 'backup/TransactionDocs*' , GLOB_ONLYDIR);
		foreach ($transactionDocFolders as $transactionDocFolder) {
			$zipFile = new \PhpZip\ZipFile();
			try {
				$zipFile
					->addDir($transactionDocFolder, '') // add files from the directory
					->saveAsFile(REALTY_WORKSTATION_PRO_PATH . 'backup-'.$backupCounter++.'.zip') // save the archive to a file
					->close(); // close archive
			}
			catch (\PhpZip\Exception\ZipException $e) {
				// handle exception
			}
			finally{
				$zipFile->close();
			}
		}
		$contractDocFolders = glob(REALTY_WORKSTATION_PRO_PATH . 'backup/ContractDocs*' , GLOB_ONLYDIR);
		foreach ($contractDocFolders as $contractDocFolder) {
			$zipFile = new \PhpZip\ZipFile();
			try {
				$zipFile
					->addDir($contractDocFolder, '') // add files from the directory
					->saveAsFile(REALTY_WORKSTATION_PRO_PATH . 'backup-'.$backupCounter++.'.zip') // save the archive to a file
					->close(); // close archive
			}
			catch (\PhpZip\Exception\ZipException $e) {
				// handle exception
			}
			finally{
				$zipFile->close();
			}
		}
		// Zip Archiving
		$backupURLs = array();
		for ($i = 1; $i < $backupCounter; $i++) {
			array_push( $backupURLs, REALTY_WORKSTATION_PRO_URL . 'backup-'.$i.'.zip' );
		}
		echo json_encode($backupURLs);
		wp_die();
	}

	public function realty_workstation_pro_upload_backup() {
		$upload_overrides = array('test_form' => false);
		$backupFile = wp_handle_upload($_FILES['backup'], $upload_overrides);
		echo $backupFile['file'];
		wp_die();
	}

	public function realty_workstation_pro_restore_backup() {
		$dir = REALTY_WORKSTATION_PRO_PATH . 'backup/';
		if ( is_dir($dir) ) {
			$this->deleteDir( $dir );
		}
		mkdir(REALTY_WORKSTATION_PRO_PATH . 'backup/');
		mkdir(REALTY_WORKSTATION_PRO_PATH . 'backup/Docs/');
		global $wpdb;
		$backups = $_POST['backups'];
		foreach ($backups as $backup) {
			if (str_contains($backup, 'backup-1')) {
				// Zip File Extraction
				$zipFile = new \PhpZip\ZipFile();
				try {
					$zipFile
						->openFile($backup) // open archive from file
						->extractTo(REALTY_WORKSTATION_PRO_PATH . 'backup/');
				}
				catch (\PhpZip\Exception\ZipException $e) {
					// handle exception
				}
				finally {
					$zipFile->close();
				}
				// Zip File Extraction
			} else {
				// Zip File Extraction
				$zipFile = new \PhpZip\ZipFile();
				try {
					$zipFile
						->openFile($backup) // open archive from file
						->extractTo(REALTY_WORKSTATION_PRO_PATH . 'backup/Docs/'); // extract files to the specified directory
				}
				catch (\PhpZip\Exception\ZipException $e) {
					// handle exception
				}
				finally {
					$zipFile->close();
				}
				// Zip File Extraction
			}
		}
		$excelFilesPath = REALTY_WORKSTATION_PRO_PATH . 'backup/';
		$files = scandir($excelFilesPath);
		if (in_array('backup-1', $files)) {
			$source = $excelFilesPath . 'backup-1/';
			$destination = $excelFilesPath;
			$files = scandir($source);
			foreach ($files as $file) {
				if (in_array($file, array(".",".."))) {
					continue;
				}
				copy($source.$file, $destination.$file);
			}
			$this->deleteDir($source);
		}
		$docsFilesPath = REALTY_WORKSTATION_PRO_PATH . 'backup/Docs/';
		$files = scandir($docsFilesPath);
		foreach ($files as $file) {
			if ( str_contains($file, 'backup') ) {
				$source = $docsFilesPath . $file . '/';
				$destination = $docsFilesPath;
				$files = scandir($source);
				foreach ($files as $file) {
					if (in_array($file, array(".",".."))) {
						continue;
					}
					copy($source.$file, $destination.$file);
				}
				$this->deleteDir($source);
			}
		}
		// Starting Importing Settings Data
		if ( $xlsx = SimpleXLSX::parse( REALTY_WORKSTATION_PRO_PATH . 'backup/settings.xlsx' ) ) {
			if ($xlsx->rows() && count($xlsx->rows()) > 1) {
				$settings = $xlsx->rows();
				unset($settings[0]);
				foreach ($settings as $setting) {
					update_option( 'rw_name', $setting[0] );
					update_option( 'rw_broker_email', $setting[1] );
					update_option( 'rw_broker_password', $setting[2] );
					update_option( 'rw_bank_name', $setting[3] );
					update_option( 'rw_account_name', $setting[4] );
					update_option( 'rw_account_number', $setting[5] );
					update_option( 'rw_account_address', $setting[6] );
					update_option( 'rw_license_key', $setting[7] );
				}
			}
		} else {
			echo SimpleXLSX::parseError();
		}
		// Starting Importing Settings Data
		// Starting Importing Agents Data
		if ( $xlsx = SimpleXLSX::parse( REALTY_WORKSTATION_PRO_PATH . 'backup/agents.xlsx' ) ) {
			if ($xlsx->rows() && count($xlsx->rows()) > 1) {
				$agents = $xlsx->rows();
				unset($agents[0]);
				foreach ($agents as $agent) {
					$agentEmail = $agent[3];
					if ( ! get_user_by( 'email', $agentEmail ) ) {
						$user_id = wp_create_user($agent[3], '123', $agent[3]);
						wp_update_user([
							'ID' => $user_id, // this is the ID of the user you want to update.
							'first_name' => $agent[1],
							'last_name' => $agent[2],
						]);
						update_user_meta( $user_id, 'last_accessed', $agent[5] );
						update_user_meta( $user_id, 'commission', $agent[6] );
						update_user_meta( $user_id, 'lease', $agent[7] );
						update_user_meta( $user_id, 'sale_and_purchase', $agent[8] );
						$user = get_user_by( 'ID', $user_id );
						$user->remove_role('subscriber');
						$user->add_role('rw_agent');
						$wpdb->query( 
							$wpdb->prepare( 
								"UPDATE $wpdb->users SET user_pass = %s, user_registered = %s WHERE ID = %d",
								$agent[4],
								$agent[9],
								$user->ID,
							)
						);
					}
				}
			}
		} else {
			echo SimpleXLSX::parseError();
		}
		// Starting Importing Agents Data
		// Starting Importing Transactions Data
		if ( $xlsx = SimpleXLSX::parse( REALTY_WORKSTATION_PRO_PATH . 'backup/transactions.xlsx' ) ) {
			if ($xlsx->rows() && count($xlsx->rows()) > 1) {
				$transactions = $xlsx->rows();
				unset($transactions[0]);
				foreach ($transactions as $transaction) {
					$transactionID = $transaction[0];
					$transactionTitle = $transaction[1];
					global $wpdb;
					$ID = $wpdb->get_var($wpdb->prepare("SELECT ID FROM `$wpdb->posts` WHERE `post_type`= 'rw-transaction' AND `post_title` = '$transactionTitle'"));
					if ( ! $ID ) {
						$new_post = array(
							'post_title' => $transactionTitle,
							'post_content' => '',
							'post_status' => 'publish',
							'post_date' => date('Y-m-d H:i:s'),
							'post_type' => 'rw-transaction'
						);
						$post_id = wp_insert_post($new_post);
						if ( $post_id ) {
							update_post_meta( $post_id, 'previousTransactionID', $transactionID );
							update_post_meta( $post_id, 'category', $transaction[4] );
							update_post_meta( $post_id, 'status', $transaction[5] );
							update_post_meta( $post_id, 'completed', $transaction[6] );
							if (isset($transaction[7]) && !empty($transaction[7])) {
								update_post_meta( $post_id, 'agent', get_user_by( 'email', $transaction[7] )->ID );
							} else {
								update_post_meta( $post_id, 'agent', '0' );
							}
							update_post_meta( $post_id, 'type', $transaction[8] );
							update_post_meta( $post_id, 'address', $transaction[9] );
							update_post_meta( $post_id, 'apt', $transaction[10] );
							update_post_meta( $post_id, 'city', $transaction[11] );
							update_post_meta( $post_id, 'zip', $transaction[12] );
							update_post_meta( $post_id, 'fullname', $transaction[13] );
							update_post_meta( $post_id, 'company', $transaction[14] );
							update_post_meta( $post_id, 'phone', $transaction[15] );
							update_post_meta( $post_id, 'email', $transaction[16] );
							update_post_meta( $post_id, 'sales_price', $transaction[17] );
							update_post_meta( $post_id, 'total_commission', $transaction[18] );
							update_post_meta( $post_id, 'broker_referral', ($transaction[19] && $transaction[19] == 'true') ? 'true' : 'false' );
							update_post_meta( $post_id, 'agent_payout', $transaction[20] );
							$wpdb->query( 
								$wpdb->prepare( 
									"UPDATE $wpdb->posts SET post_date = %s, post_date_gmt = %s, post_modified = %s, post_modified_gmt = %s WHERE ID = %d",
									$transaction[2],
									get_gmt_from_date($transaction[2]),
									$transaction[3],
									get_gmt_from_date($transaction[3]),
									$post_id,
								)
							);
						}
					} else {
						$post_id = $ID;
						if ( $post_id ) {
							update_post_meta( $post_id, 'previousTransactionID', $transactionID );
							update_post_meta( $post_id, 'category', $transaction[4] );
							update_post_meta( $post_id, 'status', $transaction[5] );
							update_post_meta( $post_id, 'completed', $transaction[6] );
							if (isset($transaction[7]) && !empty($transaction[7])) {
								update_post_meta( $post_id, 'agent', get_user_by( 'email', $transaction[7] )->ID );
							} else {
								update_post_meta( $post_id, 'agent', '0' );
							}
							update_post_meta( $post_id, 'type', $transaction[8] );
							update_post_meta( $post_id, 'address', $transaction[9] );
							update_post_meta( $post_id, 'apt', $transaction[10] );
							update_post_meta( $post_id, 'city', $transaction[11] );
							update_post_meta( $post_id, 'zip', $transaction[12] );
							update_post_meta( $post_id, 'fullname', $transaction[13] );
							update_post_meta( $post_id, 'company', $transaction[14] );
							update_post_meta( $post_id, 'phone', $transaction[15] );
							update_post_meta( $post_id, 'email', $transaction[16] );
							update_post_meta( $post_id, 'sales_price', $transaction[17] );
							update_post_meta( $post_id, 'total_commission', $transaction[18] );
							update_post_meta( $post_id, 'broker_referral', ($transaction[19] && $transaction[19] == 'true') ? 'true' : 'false' );
							update_post_meta( $post_id, 'agent_payout', $transaction[20] );
							$wpdb->query( 
								$wpdb->prepare( 
									"UPDATE $wpdb->posts SET post_date = %s, post_date_gmt = %s, post_modified = %s, post_modified_gmt = %s WHERE ID = %d",
									$transaction[2],
									get_gmt_from_date($transaction[2]),
									$transaction[3],
									get_gmt_from_date($transaction[3]),
									$post_id,
								)
							);
						}
					}
				}
			}
		} else {
			echo SimpleXLSX::parseError();
		}
		// Starting Importing Transactions Data
		// Starting Importing Transactions Docs Data
		if ( $xlsx = SimpleXLSX::parse( REALTY_WORKSTATION_PRO_PATH . 'backup/transactionDocs.xlsx' ) ) {
			if ($xlsx->rows() && count($xlsx->rows()) > 1) {
				$transactionDocs = $xlsx->rows();
				unset($transactionDocs[0]);
				foreach ($transactionDocs as $transactionDoc) {
					$transactionDocID = $transactionDoc[0];
					$transactionDocTitle = $transactionDoc[1];
					global $wpdb;
					$ID = $wpdb->get_var($wpdb->prepare("SELECT ID FROM `$wpdb->posts` WHERE `post_type`= 'rw-transaction-doc' AND `post_title` = '$transactionDocTitle'"));
					if ( ! $ID ) {
						$posts = get_posts([
							'post_type' => 'rw-transaction',
							'post_status' => 'publish',
							'numberposts' => 1,
							'meta_query' => array(
								array(
									'key' => 'previousTransactionID',
									'value' => $transactionDoc[2],
									'compare' => '=',
								)
							)
						]);
						if ( isset($posts) && is_array($posts) && count($posts) > 0 ) {
							$transactionID = $posts[0]->ID;
							$new_post = array(
								'post_title' => $transactionDocTitle,
								'post_content' => '',
								'post_status' => 'publish',
								'post_date' => date('Y-m-d H:i:s'),
								'post_type' => 'rw-transaction-doc'
							);
							$post_id = wp_insert_post($new_post);
							if ( $post_id ) {
								update_post_meta( $post_id, 'transactionID', $transactionID );
								update_post_meta( $post_id, 'documentType', $transactionDoc[3] );
								require_once( ABSPATH . 'wp-admin/includes/file.php' );
								$temp_file = download_url( REALTY_WORKSTATION_PRO_URL . 'backup/Docs/' . $transactionDoc[4] );
								if( is_wp_error( $temp_file ) ) {
									return false;
								}
								// move the temp file into the uploads directory
								$file = array(
									'name'     => basename( REALTY_WORKSTATION_PRO_PATH . 'backup/Docs/' . $transactionDoc[5] ),
									'type'     => mime_content_type( $temp_file ),
									'tmp_name' => $temp_file,
									'size'     => filesize( $temp_file ),
								);
								$sideload = wp_handle_sideload(
									$file,
									array(
										'test_form'   => false // no needs to check 'action' parameter
									)
								);
								update_post_meta( $post_id, 'documentName', basename($sideload['url']) );
								update_post_meta( $post_id, 'documentURL', $sideload['url'] );
							}
						}
					}
				}
			}
		} else {
			echo SimpleXLSX::parseError();
		}
		// Starting Importing Transaction Docs Data
		// Starting Importing Leads Data
		if ( $xlsx = SimpleXLSX::parse( REALTY_WORKSTATION_PRO_PATH . 'backup/leads.xlsx' ) ) {
			if ($xlsx->rows() && count($xlsx->rows()) > 1) {
				$leads = $xlsx->rows();
				unset($leads[0]);
				foreach ($leads as $lead) {
					$leadID = $lead[0];
					$leadTitle = $lead[1];
					global $wpdb;
					$ID = $wpdb->get_var($wpdb->prepare("SELECT ID FROM `$wpdb->posts` WHERE `post_type`= 'rw-lead' AND `post_title` = '$leadTitle'"));
					if ( ! $ID ) {
						$new_post = array(
							'post_title' => $leadTitle,
							'post_content' => '',
							'post_status' => 'publish',
							'post_date' => date('Y-m-d H:i:s'),
							'post_type' => 'rw-lead'
						);
						$post_id = wp_insert_post($new_post);
						if ( $post_id ) {
							update_post_meta( $post_id, 'status', $lead[4] );
							if (isset($lead[5]) && !empty($lead[5])) {
								update_post_meta( $post_id, 'agent', get_user_by( 'email', $lead[5] )->ID );
							} else {
								update_post_meta( $post_id, 'agent', '0' );
							}
							update_post_meta( $post_id, 'type', $lead[6] );
							update_post_meta( $post_id, 'fullname', $lead[23] );
							update_post_meta( $post_id, 'company', $lead[24] );
							update_post_meta( $post_id, 'phone', $lead[25] );
							update_post_meta( $post_id, 'email', $lead[26] );
							update_post_meta( $post_id, 'address_1', $lead[7] );
							update_post_meta( $post_id, 'apt_1', $lead[8] );
							update_post_meta( $post_id, 'city_1', $lead[9] );
							update_post_meta( $post_id, 'zip_1', $lead[10] );
							update_post_meta( $post_id, 'address_2', $lead[11] );
							update_post_meta( $post_id, 'apt_2', $lead[12] );
							update_post_meta( $post_id, 'city_2', $lead[13] );
							update_post_meta( $post_id, 'zip_2', $lead[14] );
							update_post_meta( $post_id, 'address_3', $lead[15] );
							update_post_meta( $post_id, 'apt_3', $lead[16] );
							update_post_meta( $post_id, 'city_3', $lead[17] );
							update_post_meta( $post_id, 'zip_3', $lead[18] );
							update_post_meta( $post_id, 'address_4', $lead[19] );
							update_post_meta( $post_id, 'apt_4', $lead[20] );
							update_post_meta( $post_id, 'city_4', $lead[21] );
							update_post_meta( $post_id, 'zip_4', $lead[22] );
							$wpdb->query( 
								$wpdb->prepare( 
									"UPDATE $wpdb->posts SET post_date = %s, post_date_gmt = %s, post_modified = %s, post_modified_gmt = %s WHERE ID = %d",
									$lead[2],
									get_gmt_from_date($lead[2]),
									$lead[3],
									get_gmt_from_date($lead[3]),
									$post_id,
								)
							);
						}
					} else {
						$post_id = $ID;
						if ( $post_id ) {
							update_post_meta( $post_id, 'status', $lead[4] );
							if (isset($lead[5]) && !empty($lead[5])) {
								update_post_meta( $post_id, 'agent', get_user_by( 'email', $lead[5] )->ID );
							} else {
								update_post_meta( $post_id, 'agent', '0' );
							}
							update_post_meta( $post_id, 'type', $lead[6] );
							update_post_meta( $post_id, 'fullname', $lead[23] );
							update_post_meta( $post_id, 'company', $lead[24] );
							update_post_meta( $post_id, 'phone', $lead[25] );
							update_post_meta( $post_id, 'email', $lead[26] );
							update_post_meta( $post_id, 'address_1', $lead[7] );
							update_post_meta( $post_id, 'apt_1', $lead[8] );
							update_post_meta( $post_id, 'city_1', $lead[9] );
							update_post_meta( $post_id, 'zip_1', $lead[10] );
							update_post_meta( $post_id, 'address_2', $lead[11] );
							update_post_meta( $post_id, 'apt_2', $lead[12] );
							update_post_meta( $post_id, 'city_2', $lead[13] );
							update_post_meta( $post_id, 'zip_2', $lead[14] );
							update_post_meta( $post_id, 'address_3', $lead[15] );
							update_post_meta( $post_id, 'apt_3', $lead[16] );
							update_post_meta( $post_id, 'city_3', $lead[17] );
							update_post_meta( $post_id, 'zip_3', $lead[18] );
							update_post_meta( $post_id, 'address_4', $lead[19] );
							update_post_meta( $post_id, 'apt_4', $lead[20] );
							update_post_meta( $post_id, 'city_4', $lead[21] );
							update_post_meta( $post_id, 'zip_4', $lead[22] );
							$wpdb->query( 
								$wpdb->prepare( 
									"UPDATE $wpdb->posts SET post_date = %s, post_date_gmt = %s, post_modified = %s, post_modified_gmt = %s WHERE ID = %d",
									$lead[2],
									get_gmt_from_date($lead[2]),
									$lead[3],
									get_gmt_from_date($lead[3]),
									$post_id,
								)
							);
						}
					}
				}
			}
		} else {
			echo SimpleXLSX::parseError();
		}
		// Starting Importing Leads Data
		// Starting Importing Contracts Data
		if ( $xlsx = SimpleXLSX::parse( REALTY_WORKSTATION_PRO_PATH . 'backup/contracts.xlsx' ) ) {
			if ($xlsx->rows() && count($xlsx->rows()) > 1) {
				$contracts = $xlsx->rows();
				unset($contracts[0]);
				foreach ($contracts as $contract) {
					$contractID = $contract[0];
					$contractTitle = $contract[1];
					global $wpdb;
					$ID = $wpdb->get_var($wpdb->prepare("SELECT ID FROM `$wpdb->posts` WHERE `post_type`= 'rw-contract' AND `post_title` = '$contractTitle'"));
					if ( ! $ID ) {
						$new_post = array(
							'post_title' => $contractTitle,
							'post_content' => '',
							'post_status' => 'publish',
							'post_date' => date('Y-m-d H:i:s'),
							'post_type' => 'rw-contract'
						);
						$post_id = wp_insert_post($new_post);
						if ( $post_id ) {
							update_post_meta( $post_id, 'name', $contract[4] );
							update_post_meta( $post_id, 'description', $contract[5] );
							require_once( ABSPATH . 'wp-admin/includes/file.php' );
							$temp_file = download_url( REALTY_WORKSTATION_PRO_URL . 'backup/Docs/' . $contract[6] );
							if( is_wp_error( $temp_file ) ) {
								return false;
							}
							// move the temp file into the uploads directory
							$file = array(
								'name'     => basename( REALTY_WORKSTATION_PRO_PATH . 'backup/Docs/' . $contract[7] ),
								'type'     => mime_content_type( $temp_file ),
								'tmp_name' => $temp_file,
								'size'     => filesize( $temp_file ),
							);
							$sideload = wp_handle_sideload(
								$file,
								array(
									'test_form'   => false // no needs to check 'action' parameter
								)
							);
							update_post_meta( $post_id, 'documentName', basename($sideload['url']) );
							update_post_meta( $post_id, 'documentURL', $sideload['url'] );
							$wpdb->query( 
								$wpdb->prepare( 
									"UPDATE $wpdb->posts SET post_date = %s, post_date_gmt = %s, post_modified = %s, post_modified_gmt = %s WHERE ID = %d",
									$contract[2],
									get_gmt_from_date($contract[2]),
									$contract[3],
									get_gmt_from_date($contract[3]),
									$post_id,
								)
							);
						}
					} else {
						$post_id = $ID;
						if ( $post_id ) {
							update_post_meta( $post_id, 'name', $contract[4] );
							update_post_meta( $post_id, 'description', $contract[5] );
							require_once( ABSPATH . 'wp-admin/includes/file.php' );
							$temp_file = download_url( REALTY_WORKSTATION_PRO_URL . 'backup/Docs/' . $contract[6] );
							if( is_wp_error( $temp_file ) ) {
								return false;
							}
							// move the temp file into the uploads directory
							$file = array(
								'name'     => basename( REALTY_WORKSTATION_PRO_PATH . 'backup/Docs/' . $contract[7] ),
								'type'     => mime_content_type( $temp_file ),
								'tmp_name' => $temp_file,
								'size'     => filesize( $temp_file ),
							);
							$sideload = wp_handle_sideload(
								$file,
								array(
									'test_form'   => false // no needs to check 'action' parameter
								)
							);
							update_post_meta( $post_id, 'documentName', basename($sideload['url']) );
							update_post_meta( $post_id, 'documentURL', $sideload['url'] );
							$wpdb->query( 
								$wpdb->prepare( 
									"UPDATE $wpdb->posts SET post_date = %s, post_date_gmt = %s, post_modified = %s, post_modified_gmt = %s WHERE ID = %d",
									$contract[2],
									get_gmt_from_date($contract[2]),
									$contract[3],
									get_gmt_from_date($contract[3]),
									$post_id,
								)
							);
						}
					}
				}
			}
		} else {
			echo SimpleXLSX::parseError();
		}
		// Starting Importing Contract Data
		wp_die();
	}
}
