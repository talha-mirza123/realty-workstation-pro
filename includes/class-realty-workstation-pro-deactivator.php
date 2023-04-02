<?php

/**
 * Fired during plugin deactivation
 *
 * @link       https://https://wppb.me/
 * @since      1.0.0
 *
 * @package    Realty_Workstation_Pro
 * @subpackage Realty_Workstation_Pro/includes
 */

/**
 * Fired during plugin deactivation.
 *
 * This class defines all code necessary to run during the plugin's deactivation.
 *
 * @since      1.0.0
 * @package    Realty_Workstation_Pro
 * @subpackage Realty_Workstation_Pro/includes
 * @author     Tech Mirza <talhamirza2@gmail.com>
 */
class Realty_Workstation_Pro_Deactivator {

	/**
	 * Short Description. (use period)
	 *
	 * Long Description.
	 *
	 * @since    1.0.0
	 */
	public static function deactivate() {
		delete_option( 'rw_webpage' );
		delete_option( 'rw_name' );
		delete_option( 'rw_broker_email' );
		delete_option( 'rw_broker_password' );
		delete_option( 'rw_bank_name' );
		delete_option( 'rw_account_name' );
		delete_option( 'rw_account_number' );
		delete_option( 'rw_account_address' );
		delete_option( 'rw_license_key' );
		$args = array(
			'role' => 'rw_agent',
			'orderby' => 'user_nicename',
			'order' => 'ASC'
		);
		$agents = get_users($args);
		foreach ($agents as $agent) {
			wp_delete_user( $agent->ID );
		}
		$transactions = get_posts([
			'post_type' => 'rw-transaction',
			'post_status' => array('publish', 'draft'),
			'numberposts' => -1
			// 'order'    => 'ASC'
		]);
		foreach ($transactions as $transaction) {
			wp_delete_post( $transaction->ID, true );
		}
		$transactionDocs = get_posts([
			'post_type' => 'rw-transaction-doc',
			'post_status' => array('publish'),
			'numberposts' => -1
			// 'order'    => 'ASC'
		]);
		foreach ($transactionDocs as $transactionDoc) {
			wp_delete_post( $transactionDoc->ID, true );
		}
		$leads = get_posts([
			'post_type' => 'rw-lead',
			'post_status' => array('publish'),
			'numberposts' => -1
			// 'order'    => 'ASC'
		]);
		foreach ($leads as $lead) {
			wp_delete_post( $lead->ID, true );
		}
		$contracts = get_posts([
			'post_type' => 'rw-contract',
			'post_status' => array('publish'),
			'numberposts' => -1
			// 'order'    => 'ASC'
		]);
		foreach ($contracts as $contract) {
			wp_delete_post( $contract->ID, true );
		}
	}

}
