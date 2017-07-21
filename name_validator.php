<?php
/**
 * This class is responsible for validating a postal code
 * as provided by the user in the Dashboard.
 *
 * @since         1.0.0
 *
 * @implements    Input_Validator
 * @package       Acme/classes
 */
class Name_Validator {
	
	/**
	 * Slug title of the setting to which this error applies
	 * as defined via the implementation of the Settings API.
	 * 
	 * @access private
	 */
	private $setting;
	
	/**
	 * Creates an instance of the class and associates the
	 * specified setting with the property of this class.
	 * 
	 * @param    string    $setting    The title of the setting we're validating
	 */
	public function __construct( $setting ) {
		$this->setting = $setting;
		//echo "in cccccccccccccccccccccccccccccccccccccccccccccccccccccccconstructor";
	}
	
	/**
	 * Determines if the specified input is valid. For these postal codes,
	 * we're verifying the input that the user provides against a regular
	 * expression that verifies it's a valid Canadian postal code
	 * 
	 * @param    string    $input    The postal code string
	 * @return   bool                True if the input is valid; otherwise, false
	 */
	public function is_valid($input) {
		
		$valid = true;
		echo "in iiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiissssssssssssssssssssssssssssvaaaaaaaaaaaaaaaaaaaaalllllllllllllllllliiiiiiddddddddddd";
		
		// Use the following RegEx to determine if the specified zip code is of proper Canadian format
		$valid = preg_match ('/^[a-zA-Z ]*$/', $input);
		
		// If the input is an empty string, add the error message and mark the validity as false
		if ( ! $valid ) {
			
			$this->add_error( 'invalid-name', 'Only letters and white space allowed in name.' );
			$input = false;
		}
		
		return $input;
		
	}
	
	/**
	 * Adds an error message to WordPress' error collection to be displayed in the dashboard.
	 * 
	 * @access   private
	 * 
	 * @param    string    $key        The key to which the specified message will be associated
	 * @param    string    $message    The message to display in the dashboard
	 */
	private function add_error( $key, $message ) {
		
		add_settings_error(
			$this->setting,
			$key,
			$message,
			'error'
		);
		
	}
	
}
