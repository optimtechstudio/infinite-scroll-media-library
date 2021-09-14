<?php
/**
 * This file is for Admin settings.
 *
 * This file responsible for managing the admin settings.
 * Getting and setting user preferences for functionality.
 *
 * PHP version 7.4
 *
 * LICENSE: This source file is subject to version 3.01 of the PHP license
 * that is available through the world-wide-web at the following URI:
 * http://www.php.net/license/3_01.txt.  If you did not receive a copy of
 * the PHP License and are unable to obtain it through the web, please
 * send a note to license@php.net so we can mail you a copy immediately.
 *
 * @category  InfiniteSrollAdmin
 * @package   OptimPlugin
 * @author    Optim TechStudio <hello@optimtechstudio.com>
 * @copyright 2021-2021 Optim TechStudio
 * @license   http://www.php.net/license/3_01.txt  PHP License 3.01
 * @version   SVN: <1.0.0>
 * @link      http://pear.php.net/package/PackageName
 * @since     File available since Release 1.1.0
 */

/**
 * This is the class for the Admin Settings.
 *
 * This class initiates the Admin Settings page and allow users to make a choice.
 *
 * @category InfiniteSrollAdmin
 * @package  OptimPlugin
 * @author   Optim TechStudio <hello@optimtechstudio.com>
 * @license  http://www.php.net/license/3_01.txt  PHP License 3.01
 * @version  Release: <1.0.0>
 * @link     http://pear.php.net/package/PackageName   
 *
 * @return void.
 */
Class Admin_Settings_Page
{

    /**
     *  Constructor.
     */
    public function __construct()
    {
        // Creating and Managing Admin Settings Page.
        $this->optimAdminSettingsPage();
    }

    /**
     * Set admin settings page for options
     *
     * @since 1.0.0
     *
     * @return void
     */
    public function optimAdminSettingsPage()
    {
        add_action( 
            'admin_menu', 
            array( $this, 'optimAddSettingPage' ) 
        ); // Setting Admin Page
        
        add_action(
            'admin_init', 
            array( $this, 'optimRegisterSettings' )
        ); // Registering Settings

        add_filter(
            'plugin_action_links_' . OPTIM_INFINITE_SCROLL_PLUGIN_BASENAME, 
            array( $this, 'optimPluginSettingsLink' )
        ); // Add settings link under Plugin list

    }

    /**
     * Adding Setting link under Plugin List
     *
     * @param $links array An array which reflects links
     * 
     * @since 1.0.0
     *
     * @return array array of links for plugin options.
     */
    public function optimPluginSettingsLink($links)
    {
        $settings_link = '<a href="options-general.php?page=optim-infinite-scroll">Settings</a>'; // phpcs:ignore
        array_unshift($links, $settings_link); 
        return $links;
    }

    /**
     * Adding Setting Page under Settings Option
     *
     * @since 1.0.0
     *
     * @return void
     */
    public function optimAddSettingPage()
    {
        add_options_page( 
            __('Infinite Scroll in Media Library', 'infinite-scroll-media-library'), 
            __('Media Infinite Scroll', 'infinite-scroll-media-library'), 
            'manage_options', 
            'optim-infinite-scroll', 
            array( $this, 'optimIsSetting' ) 
        );
    }

    /**
     * Creats Settings Sections
     *
     * @since 1.0.0
     *
     * @return void
     */
    public function optimIsSetting()
    {
        echo '<div class="wrap">
		<h1>' . 
            __(
                'Enable Infinite Scroll In Media Library', 
                'infinite-scroll-media-library'
            ) 
        . '</h1>
        
		<form method="post" action="options.php">';
                
        settings_fields('optim_is_choice'); // settings group name
        do_settings_sections('optim-infinite-scroll'); // just a page slug
        submit_button();

        echo '</form></div>
		<hr/>
			<div class="ring-builder-info-div">
	        <div class="info-left" style="display: inline-block">
	            <a href="https://optimtechstudio.com/" target="_blank">
	                <img style="width: 200px;" src="' . 
                        OPTIM_INFINITE_SCROLL_PLUGIN_DIR . 
                        "images/optim-logo.png" . '">
	            </a>
	        </div>

	        <div class="info-right" style="display: inline-block; margin-left: 2em;">
	            <h2><b>' . __(
                            'Optim Infinite Scroll for Media Library', 
                            'infinite-scroll-media-library'
                        ) 
                . '</b></h2>
	            <p>
	                <b>' . __(
                    'Installed Version:', 'infinite-scroll-media-library'
                ) . 
                                ' v' . OPTIM_INFINITE_SCROLL_MEDIA_LIBRARY . 
                                '</b><br>
	                 ' . __(
                                    'Website:', 
                                    'infinite-scroll-media-library'
                                ) . 
                     ' <a target="_blank" href="https://www.facebook.com/optimtechstudio/">Facebook</a>,
	                <a target="_blank" href="https://www.linkedin.com/in/optim-techstudio-1228b5213/">LinkedIn</a> &amp;
	                <a target="_blank" href="https://instagram.com/optim_techstudio/">Instagram</a>.
	                <br>' . 
                        __(
                            'Please contact us on', 
                            'infinite-scroll-media-library'
                        ) . 
                    ' <a href="mailto:infinitescroll@optimtechstudio.com">
                        infinitescroll@optimtechstudio.com
                    </a> '. 
                        __(
                            'to get in touch.', 
                            'infinite-scroll-media-library'
                        ) . '
	            </p>
	        </div>
	        <hr/>
	    </div>';
    }

    /**
     * Registering ang adding content to Settings
     *
     * @since 1.0.0
     *
     * @return void
     */
    public function optimRegisterSettings()
    {

        register_setting(
            'optim_is_choice', // settings group name
            'optim_is_choice', // option name
            'sanitize_text_field' // sanitization function
        );

        add_settings_section(
            'optim_is_option_section', // section ID
            '', // title (if needed)
            '', // callback function (if needed)
            'optim-infinite-scroll' // page slug
        );

        add_settings_field(
            'optim_is_choice',
            __('Toggle for Infinite Scroll', 'infinite-scroll-media-library'),
            array( 
                $this, 
                'optimInfiniteScrollSettingsSelection' 
            ), // function which prints the field
            'optim-infinite-scroll', // page slug
            'optim_is_option_section', // section ID
            array( 
            'label_for' => 'homepage_text',
            'class' => 'misha-class', // for <tr> element
            )
        );

    }

    /**
     * Setting Buttons for toggling choice
     *
     * @since 1.0.0
     *
     * @return void
     */
    public function optimInfiniteScrollSettingsSelection()
    {
        $optim_is_choice = get_option('optim_is_choice');

        echo '<input type="radio" ' . 
            ( 
                '1' == $optim_is_choice ? 'checked' : '' 
            ) . ' name="optim_is_choice" value="1" /> ' . 
            __(
                'Enable ', 
                'infinite-scroll-media-library'
            )
        . ' <input type="radio" ' . 
        ( '0' == $optim_is_choice ? 'checked' : '' ) . 
        ' name="optim_is_choice" value="0" /> ' . 
        __(
            'Disable', 
            'infinite-scroll-media-library'
        );
    }

}
