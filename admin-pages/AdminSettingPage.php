<?php
/**
 * This is the class for the Admin Settings.
 *
 * This class initiates the Admin Settings page and allow users to make a choice.
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
        $this->optim_admin_settings_page();
    }

    /**
     * Set admin settings page for options
     *
     * @since 1.0.0
     *
     * @return void
     */
    public function optim_admin_settings_page()
    {
        add_action('admin_menu', array( $this, 'optim_add_settings_page' )); // Setting Admin Page
        add_action('admin_init', array( $this, 'optim_register_settings' )); // Registering Settings
    }

    /**
     * Adding Setting Page under Settings Option
     *
     * @since 1.0.0
     *
     * @return void
     */
    public function optim_add_settings_page()
    {
        add_options_page( 
            __('Infinite Scroll in Media Library', 'infinite-scroll-media-library'), 
            __('Media Infinite Scroll', 'infinite-scroll-media-library'), 
            'manage_options', 
            'optim-infinite-scroll', 
            array( $this, 'optim_is_settings' ) 
        );
    }

    /**
     * Creats Settings Sections
     *
     * @since 1.0.0
     *
     * @return void
     */
    public function optim_is_settings()
    {
        echo '<div class="wrap">
		<h1>' . __('Enable Infinite Scroll In Media Library', 'infinite-scroll-media-library') . '</h1>
		<form method="post" action="options.php">';
                
        settings_fields('optim_is_choice'); // settings group name
        do_settings_sections('optim-infinite-scroll'); // just a page slug
        submit_button();

        echo '</form></div>
		<hr/>
			<div class="ring-builder-info-div">
	        <div class="info-left" style="display: inline-block">
	            <a href="https://optimtechstudio.com/" target="_blank">
	                <img style="width: 200px;" src="https://optimtechstudio.com/wp-content/uploads/2021/06/logo.png">
	            </a>
	        </div>

	        <div class="info-right" style="display: inline-block; margin-left: 2em;">
	            <h2><b>' . __('Optim Infinite Scroll for Media Library', 'infinite-scroll-media-library') . '</b></h2>
	            <p>
	                <b>' . __('Installed Version:', 'infinite-scroll-media-library') . ' v' . OPTIM_INFINITE_SCROLL_MEDIA_LIBRARY . '</b><br>
	                 ' . __('Website:', 'infinite-scroll-media-library') . ' <a target="_blank" href="https://www.facebook.com/optimtechstudio">Facebook</a>,
	                <a target="_blank" href="https://in.linkedin.com/in/optim-techstudio-1228b5213">Linked In</a> &amp;
	                <a target="_blank" href="https://instagram.com/optim_techstudio">Instagram</a>.
	                <br>' . __('Please contact us on', 'infinite-scroll-media-library') . ' <a href="mailto:infinitescroll@optimtechstudio.com">infinitescroll@optimtechstudio.com</a> '. __('to get in touch.', 'infinite-scroll-media-library') . '
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
    public function optim_register_settings()
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
            array( $this, 'optim_infinite_scroll_settings_section' ), // function which prints the field
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
    public function optim_infinite_scroll_settings_section()
    {
        $optim_is_choice = get_option('optim_is_choice');

        echo '<input type="radio" ' . ( '1' == $optim_is_choice ? 'checked' : '' ) . ' name="optim_is_choice" value="1" /> ' . __('Enable', 'infinite-scroll-media-library')
        . '<input type="radio" ' . ( '0' == $optim_is_choice ? 'checked' : '' ) . ' name="optim_is_choice" value="0" /> ' . __('Disable', 'infinite-scroll-media-library');
    }

}
