<?php

/**
 * Fired during plugin activation
 *
 * @link       https://https://wppb.me/
 * @since      1.0.0
 *
 * @package    Realty_Workstation_Pro
 * @subpackage Realty_Workstation_Pro/includes
 */

/**
 * Fired during plugin activation.
 *
 * This class defines all code necessary to run during the plugin's activation.
 *
 * @since      1.0.0
 * @package    Realty_Workstation_Pro
 * @subpackage Realty_Workstation_Pro/includes
 * @author     Tech Mirza <talhamirza2@gmail.com>
 */
class Realty_Workstation_Pro_Activator {

	/**
	 * Short Description. (use period)
	 *
	 * Long Description.
	 *
	 * @since    1.0.0
	 */
	public static function activate() {
		
		if ( array_key_exists('realty-workstation/realty-workstation.php', get_plugins()) ) {
			if ( is_plugin_active( 'realty-workstation/realty-workstation.php' ) ) {
				deactivate_plugins( 'realty-workstation/realty-workstation.php' );
			}
			delete_plugins( ['realty-workstation/realty-workstation.php'] );
		}
		$page = get_page_by_path( 'workstation', OBJECT, 'page' );
		if ( $page ) {
			update_option( 'rw_webpage', $page->ID );
		} else {
			$new_post = array(
				'post_title' => 'Workstation',
				'post_content' => '',
				'post_status' => 'publish',
				'post_date' => date('Y-m-d H:i:s'),
				'post_type' => 'page'
			);
			$post_id = wp_insert_post($new_post);
			if ( $post_id ) {
				update_option( 'rw_webpage', $post_id );
			}
		}
	}

}
