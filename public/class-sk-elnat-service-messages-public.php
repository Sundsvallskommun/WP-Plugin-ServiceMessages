<?php

/**
 * The public-facing functionality of the plugin.
 *
 * @link       https://www.cybercom.com/
 * @since      1.0.0
 *
 * @package    Sk_Elnat_Service_Messages
 * @subpackage Sk_Elnat_Service_Messages/public
 */

/**
 * The public-facing functionality of the plugin.
 *
 * Defines the plugin name, version, and two examples hooks for how to
 * enqueue the public-facing stylesheet and JavaScript.
 *
 * @package    Sk_Elnat_Service_Messages
 * @subpackage Sk_Elnat_Service_Messages/public
 * @author     Joakim Sundqvist <joakim.sundqvist@cybercom.com>
 */

/**
 * External classes to include.
 */ 
require_once( plugin_dir_path(__DIR__) . 'public/classes/service-messages.class.php' );

class Sk_Elnat_Service_Messages_Public {

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
	 * @param      string    $plugin_name       The name of the plugin.
	 * @param      string    $version    The version of this plugin.
	 */
	public function __construct( $plugin_name, $version ) {

		$this->plugin_name = $plugin_name;
		$this->version = $version;

	}

	/**
	 * Defines the service messages variable that contains information from the json-file
	 * and then includes the file that is responsible for the front-end part of the plugin.
	 *
	 * @author Joakim Sundqvist <joakim.sundqvist@cybercom.com>
	 * 
	 */
	public function output() {
		$service_messages = $this->get_service_messages();
		include_once(plugin_dir_path(__DIR__) . 'templates/sk-elnat-service-messages-view.php');
	}

	/**
	 * Creates service messages, removes status 3 and return the results
	 *
	 * @author Joakim Sundqvist <joakim.sundqvist@cybercom.com>
	 * 
	 */
	public function get_service_messages() {
		$file_path = get_field( 'sk_elnat_service_messages_sokvag', 'option' ); //driftmeddelanden/driftmeddelandeelnat.json
		$service_messages = new Service_messages( $file_path );
		$service_messages->remove_status( 1 );
		$service_messages->set_valid_class_id_numbers( array(1211, 1212, 1213, 1214, 1411, 3101, 3102, 3103, 3201, 3202, 3203, 3208, 3301) );
		return $service_messages->get_service_messages();
	}

	/**
	 * Defines the short code so wordpress knows where the plugin should be displayed.
	 *
	 * @author Joakim Sundqvist <joakim.sundqvist@cybercom.com>
	 * 
	 */
	public function add_shortcode() {
		add_shortcode( 'sk-elnat-service-messages', array( $this, 'output' ) );
	}

	/**
	 * Register the stylesheets for the public-facing side of the site.
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

		wp_enqueue_style( $this->plugin_name, plugin_dir_url( __FILE__ ) . 'css/sk-elnat-service-messages-public.css', array(), $this->version, 'all' );

	}

	/**
	 * Register the JavaScript for the public-facing side of the site.
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

		wp_enqueue_script( $this->plugin_name, plugin_dir_url( __FILE__ ) . 'js/sk-elnat-service-messages-public.js', array( 'jquery' ), $this->version, false );
	}

}
