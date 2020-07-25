<?php

/**
 * The plugin bootstrap file
 *
 * This file is read by KCMS to generate the plugin information in the plugin
 * admin area. This file also includes all of the dependencies used by the plugin,
 * registers the activation and deactivation functions, and defines a function
 * that starts the plugin.
 *
 * @link              https://github.com/KubeeCMS/Forms-Registration/
 * @since             4.5.5
 * @package           forms-registration
 *
 * @wordpress-plugin
 * Plugin Name: Forms Registration
 * Plugin URI: https://github.com/KubeeCMS/Forms-Registration
 * Description: Allows KCMS users to be automatically created upon submitting a Form.
 * Version: 4.5.5
 * Author: Kubee CMS
 * Author URI: https://github.com/KubeeCMS/
 * License: GNU GENERAL PUBLIC LICENSE
 * License URI:       http://www.gnu.org/licenses/gpl-2.0.txt
 * Text Domain:       gravityformsuserregistration
 * Domain Path:       /languages
 */



defined( 'ABSPATH' ) || die();

define( 'GF_USER_REGISTRATION_VERSION', '4.5.5' );

// If Gravity Forms is loaded, bootstrap the User Registration Add-On.
add_action( 'gform_loaded', array( 'GF_User_Registration_Bootstrap', 'load' ), 5 );

/**
 * Class GF_User_Registration_Bootstrap
 *
 * Handles the loading of the User Registration add-on and registers with the add-on framework
 */
class GF_User_Registration_Bootstrap {

	/**
	 * If the Feed Add-On Framework exists, User Registration Add-On and login widget are loaded.
	 *
	 * @access public
	 * @static
	 */
	public static function load() {

		if ( ! method_exists( 'GFForms', 'include_feed_addon_framework' ) ) {
			return;
		}

		require_once( 'class-gf-user-registration.php' );
		require_once( 'includes/class-gf-login-widget.php' );
		require_once( 'includes/class-gf-user-registration-dynamic-hook.php' );

		GFAddOn::register( 'GF_User_Registration' );

	}

}

/**
 * Returns an instance of the GF_User_Registration class
 *
 * @see    GF_User_Registration::get_instance()
 * @return GF_User_Registration
 */
function gf_user_registration() {
	return GF_User_Registration::get_instance();
}

/**
 * Obtains the login form HTML markup
 *
 * @see GF_User_Registration->get_login_html()
 *
 * @param array $args Login form arguments.
 *
 * @return string The login form HTML
 */
function gf_user_registration_login_form( $args = array() ) {
	return gf_user_registration()->get_login_html( $args );
}
