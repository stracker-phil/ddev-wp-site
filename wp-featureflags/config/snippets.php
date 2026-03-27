<?php
/**
 * Sample snippets file — copied to wp-content/wp-featureflags/snippets.php on first load.
 *
 * Edit that copy to add arbitrary PHP code (e.g. custom action handlers).
 * It persists across plugin updates.
 */

use WooCommerce\PayPalCommerce\PPCP;
use WooCommerce\PayPalCommerce\Settings\Service\SettingsDataManager;
use WooCommerce\PayPalCommerce\Settings\Service\AuthenticationManager;

add_action(
	'ppcp-reset-plugin',
	static function () {
		global $wpdb;

		if ( class_exists( 'WooCommerce\PayPalCommerce\PPCP' ) ) {
			$container = PPCP::container();

			// Disconnect the merchant.
			if ( $container->has( 'settings.service.authentication_manager' ) ) {
				$auth = $container->get( 'settings.service.authentication_manager' );

				assert( $auth instanceof AuthenticationManager );
				$auth->disconnect();
			}

			// Run the official "start over" logic from the new React UI.
			if ( $container->has( 'settings.service.data-manager' ) ) {
				$manager = $container->get( 'settings.service.data-manager' );

				assert( $manager instanceof SettingsDataManager );
				$manager->reset_all_settings();
			}
		}

		// Delete any left-over settings.
		$wpdb->query( "DELETE FROM {$wpdb->options} WHERE option_name LIKE 'woocommerce_ppcp-%'" );
	}
);
