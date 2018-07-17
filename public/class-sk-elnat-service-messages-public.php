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
	 * Defines the short code so wordpress knows where the plugin should be displayed.
	 *
	 * @author Joakim Sundqvist <joakim.sundqvist@cybercom.com>
	 * 
	 */
	public function add_shortcode() {
		add_shortcode( 'sk-elnat-service-messages', array( $this, 'output' ) );
	}

	/**
	 * Defines the service messages variable that contains information from the json-file
	 * and then includes the file that is responsible for the front-end part of the plugin.
	 *
	 * @author Joakim Sundqvist <joakim.sundqvist@cybercom.com>
	 * 
	 */
	public function output() {
		$service_messages = $this->get_filtered_messages();
		include_once(plugin_dir_path(__DIR__) . 'templates/sk-elnat-service-messages-view.php');
	}

	/**
	 * Filters the service messages so that the messages with status 3 is not included. This
	 * creates cleaner html-code since it does not need to be handled there.
	 *
	 * @author Joakim Sundqvist <joakim.sundqvist@cybercom.com>
	 * 
	 */
	public function get_filtered_messages() {
		$return = array();
		$json = $this->load_json_file(plugin_dir_path(__DIR__) . get_field( 'sk_elnat_service_messages_sokvag', 'option' ) ); //driftmeddelanden/driftmeddelandeelnat.json
		
		if ( $json ) {
			$all_service_messages = $json['servicemessages'];
			foreach($all_service_messages as $value) {
				if ( $value['status'] != 3) {
					array_push( $return, $value);
				}
			}
		}

		return $return;
	}

	/**
	 * Loads a json file and decodes it before returning object
	 *
	 * @author Joakim Sundqvist <joakim.sundqvist@cybercom.com>
	 * @param $file_path The path to the json-file
	 * 
	 */
	public function load_json_file( $file_path ) {
		$file = @file_get_contents( $file_path );
		if ( $file ) {
			return json_decode($file, true);
		} else {
			return null;
		}
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
