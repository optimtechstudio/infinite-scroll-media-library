<?php
/**
 * Plugin Name:       Infinite Scroll in Media Library
 * Plugin URI:        https://optimtechstudio.com/
 * Description:       Get back the Infinite Scrolling in Media Gallery with This Plugin. WordPress has removed the infinite scrolling since v5.8.0.
 * Version:           1.0.0
 * Requires at least: 5.8
 * Requires PHP:      7.2
 * Author:            Optim TechStudio
 * Author URI:        https://malavvasita.github.io/
 * License:           GPL v2 or later
 * License URI:       https://www.gnu.org/licenses/gpl-2.0.html
 * Text Domain:       infinite-scroll-media-library
 * Domain Path:       /languages
 */

// Don't allow if user access this file directly
 defined( 'ABSPATH' ) || die( __( 'You are not allowed to access this file directly.', 'infinite-scroll-media-library' ) );

// Version Number for Future Release Maintenance
 define( 'OPTIM_INFINITE_SCROLL_MEDIA_LIBRARY', '1.0.0' );

/**
 * This is the main class of the plugin.
 *
 * This class initiates the proceedings of Making Infinite scroll functionality.
 *
 * @return void.
 */
class Infinite_Scroll_In_Media_Library {
    /**
     *  Constructor.
     */
    public function __construct() {
        $this->optim_infinite_scroll_hooks();
    }

    /**
     * Filter to Enable the Infinite Scroll
     *
     * @since 1.0.0
     *
     * @return void
     */
    public function optim_infinite_scroll_hooks() {
        
        // If the option is not set for Infinite Scroll, Enable it by default.
        if ( ! get_option( "optim_is_choice" ) ) {
             add_option( "optim_is_choice", "1" );
        }

        $optim_is_user_choice = get_option( 'optim_is_choice' );

        if( !empty( $optim_is_user_choice ) && 0 !== $optim_is_user_choice ){
            // Filter to Enable the Infinite Scroll in Media Library
            add_filter( 'media_library_infinite_scrolling', '__return_true' );
        }

    }
}

new Infinite_Scroll_In_Media_Library(); // Initialize of the Main Class

// Page for the Admin Settings for User's Choice
require_once( dirname(__FILE__) . '/admin-pages/AdminSettingPage.php' );
new Admin_Settings_Page(); // Initialization of Admin Settings Page