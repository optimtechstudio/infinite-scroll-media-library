<?php
/**
 * This file initiates the functionality.
 *
 * This file responsible for exectuting main purpose for the plugin.
 * From Admin Settings to WordPress Media Library, all thigs are
 * Covered in this file. 
 *
 * PHP version 7.4
 *
 * LICENSE: This source file is subject to version 3.01 of the PHP license
 * that is available through the world-wide-web at the following URI:
 * http://www.php.net/license/3_01.txt.  If you did not receive a copy of
 * the PHP License and are unable to obtain it through the web, please
 * send a note to license@php.net so we can mail you a copy immediately.
 *
 * @category  InfiniteSroll
 * @package   OptimPlugin
 * @author    Optim TechStudio <hello@optimtechstudio.com>
 * @copyright 2021-2021 Optim TechStudio
 * @license   http://www.php.net/license/3_01.txt  PHP License 3.01
 * @version   SVN: <1.0.0>
 * @link      http://pear.php.net/package/PackageName
 * @since     File available since Release 1.1.0
 */

/**
 * Plugin Name:       Infinite Scroll in Media Library
 * Plugin URI:        https://wordpress.org/plugins/infinite-scroll-in-media-library/
 * Description:       Get back the Infinite Scrolling in Media Gallery 
 * with This Plugin. WordPress has removed the infinite scrolling since v5.8.0.
 * Version:           1.0.0
 * Requires at least: 5.8
 * Requires PHP:      7.2
 * Author:            Optim TechStudio
 * Author URI:        https://optimtechstudio.com
 * License:           GPL v2 or later
 * License URI:       https://www.gnu.org/licenses/gpl-2.0.html
 * Text Domain:       infinite-scroll-media-library
 * Domain Path:       /languages
 */

// Don't allow if user access this file directly
defined('ABSPATH') || 
die(
    __(
        'You are not allowed to access this file directly.', 
        'infinite-scroll-media-library'
    )
);

// Version Number for Future Release Maintenance
define('OPTIM_INFINITE_SCROLL_MEDIA_LIBRARY', '1.0.0');

// Plugin directory URL for global use
define('OPTIM_INFINITE_SCROLL_PLUGIN_DIR', plugin_dir_url(__FILE__));

// Plugin base name
define('OPTIM_INFINITE_SCROLL_PLUGIN_BASENAME', plugin_basename(__FILE__));

/**
 * This is the main class of the plugin.
 *
 * This class initiates the proceedings of Making Infinite scroll functionality.
 * 
 * @category InfiniteSroll
 * @package  OptimPlugin
 * @author   Optim TechStudio <hello@optimtechstudio.com>
 * @license  http://www.php.net/license/3_01.txt  PHP License 3.01
 * @version  Release: <1.0.0>
 * @link     http://pear.php.net/package/PackageName   
 *
 * @return void.
 */
class InfiniteScrollInMediaLibrary
{
    /**
     *  Constructor.
     */
    public function __construct()
    {
        $this->optimInfiniteScrollHooks();
    }

    /**
     * Filter to Enable the Infinite Scroll
     *
     * @since 1.0.0
     *
     * @return void
     */
    public function optimInfiniteScrollHooks()
    {
        
        // If the option is not set for Infinite Scroll, Enable it by default.
        if (! get_option("optim_is_choice") ) {
             add_option("optim_is_choice", "1");
        }

        $optim_is_user_choice = get_option('optim_is_choice');

        if (!empty($optim_is_user_choice) && 0 !== $optim_is_user_choice ) {
            // Filter to Enable the Infinite Scroll in Media Library
            add_filter('media_library_infinite_scrolling', '__return_true');
        }

    }
}

new InfiniteScrollInMediaLibrary(); // Initialize of the Main Class

// Page for the Admin Settings for User's Choice
require_once dirname(__FILE__) . '/admin-pages/AdminSettingPage.php';
new Admin_Settings_Page(); // Initialization of Admin Settings Page
