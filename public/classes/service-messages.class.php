<?php

class Service_messages {
    private $service_messages;

    /**
	 * Loads a json file, decodes it and finally it stores the service message
	 *
	 * @author Joakim Sundqvist <joakim.sundqvist@cybercom.com>
	 * @param $file_path The path to the json-file containing all service messages
	 * 
	 */
    public function __construct( $file_path ) {
        $file = file_get_contents( $file_path );
		$file = utf8_encode( $file );

		if ( $file ) {
            $json = json_decode( $file, true );
            $this->service_messages = $json['servicemessages'];
		}
	}
	
	/**
	 * Removes a given status code from service messages
	 *
	 * @author Joakim Sundqvist <joakim.sundqvist@cybercom.com>
     * @param $status The status code to remove 1,2 or 3
	 * 
	 */
    public function set_valid_class_id_numbers( array $class_id_numbers ) {
        $temp = array();
		
		if ( $this->service_messages ) {
			foreach( $this->service_messages as $value ) {
				if ( in_array( $value['classid'] , $class_id_numbers )) { //If not equal to status to remove, keep it
					array_push( $temp, $value );
				}
			}
		}
		$this->service_messages = $temp;
    }

    /**
	 * Removes a given status code from service messages
	 *
	 * @author Joakim Sundqvist <joakim.sundqvist@cybercom.com>
     * @param $status The status code to remove 1,2 or 3
	 * 
	 */
    public function remove_status( $status ) {
        $temp = array();
		
		if ( $this->service_messages ) {
			foreach( $this->service_messages as $value ) {
				if ( $value['status'] != $status) { //If not equal to status to remove, keep it
					array_push( $temp, $value );
				}
			}
		}
		$this->service_messages = $temp;
    }

    /**
	 * Return the service messages
	 *
	 * @author Joakim Sundqvist <joakim.sundqvist@cybercom.com>
	 * 
	 */
    public function get_service_messages() {
        return $this->service_messages;
    }
}