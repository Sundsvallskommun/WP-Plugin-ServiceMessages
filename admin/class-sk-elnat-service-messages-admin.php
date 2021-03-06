<?php

/**
 * The admin-specific functionality of the plugin.
 *
 * @link       https://www.cybercom.com/
 * @since      1.0.0
 *
 * @package    Sk_Elnat_Service_Messages
 * @subpackage Sk_Elnat_Service_Messages/admin
 */

/**
 * The admin-specific functionality of the plugin.
 *
 * Defines the plugin name, version, and two examples hooks for how to
 * enqueue the admin-specific stylesheet and JavaScript.
 *
 * @package    Sk_Elnat_Service_Messages
 * @subpackage Sk_Elnat_Service_Messages/admin
 * @author     Joakim Sundqvist <joakim.sundqvist@cybercom.com>
 */
class Sk_Elnat_Service_Messages_Admin {

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
	 * Adding optiones page for Sundsvall Elnät Service Messages ( this plugin ) called
	 * 'Service Meddelanden'
	 *
	 * @author Joakim Sundqvist <joakim.sundqvist@cybercom.com>
	 *
	 */
	public function add_options_page() {
		
		if ( function_exists( 'acf_add_options_sub_page' ) ) {
			// add sub page
			acf_add_options_sub_page( array(
				'page_title' 	=> 'Service Meddelanden',
				'menu_title' 	=> 'Service Meddelanden',
				'parent_slug' 	=> 'general-settings',
			));
		}

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
		 * defined in Sk_Elnat_Service_Messages_Loader as all of the hooks are defined
		 * in that particular class.
		 *
		 * The Sk_Elnat_Service_Messages_Loader will then create the relationship
		 * between the defined hooks and the functions defined in this
		 * class.
		 */

		wp_enqueue_style( $this->plugin_name, plugin_dir_url( __FILE__ ) . 'css/sk-elnat-service-messages-admin.css', array(), $this->version, 'all' );

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
		 * defined in Sk_Elnat_Service_Messages_Loader as all of the hooks are defined
		 * in that particular class.
		 *
		 * The Sk_Elnat_Service_Messages_Loader will then create the relationship
		 * between the defined hooks and the functions defined in this
		 * class.
		 */

		wp_enqueue_script( $this->plugin_name, plugin_dir_url( __FILE__ ) . 'js/sk-elnat-service-messages-admin.js', array( 'jquery' ), $this->version, false );

	}

}
