<?php

/**
 * The admin-specific functionality of the plugin.
 *
 * @link       www.loanthru.com
 * @since      1.0.0
 *
 * @package    Loanthru_calculator
 * @subpackage Loanthru_calculator/admin
 */

/**
 * The admin-specific functionality of the plugin.
 *
 * Defines the plugin name, version, and two examples hooks for how to
 * enqueue the admin-specific stylesheet and JavaScript.
 *
 * @package    Loanthru_calculator
 * @subpackage Loanthru_calculator/admin
 * @author     LoanThru <contact_us@loanthru.com>
 */
class Loanthru_calculator_Admin {

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
	 * Register the stylesheets for the admin area.
	 *
	 * @since    1.0.0
	 */
	public function enqueue_styles() {

		/**
		 * This function is provided for demonstration purposes only.
		 *
		 * An instance of this class should be passed to the run() function
		 * defined in Loanthru_calculator_Loader as all of the hooks are defined
		 * in that particular class.
		 *
		 * The Loanthru_calculator_Loader will then create the relationship
		 * between the defined hooks and the functions defined in this
		 * class.
		 */

		wp_enqueue_style( $this->plugin_name, plugin_dir_url( __FILE__ ) . 'css/loanthru_calculator-admin.css', array(), $this->version, 'all' );

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
		 * defined in Loanthru_calculator_Loader as all of the hooks are defined
		 * in that particular class.
		 *
		 * The Loanthru_calculator_Loader will then create the relationship
		 * between the defined hooks and the functions defined in this
		 * class.
		 */

		wp_enqueue_script( $this->plugin_name, plugin_dir_url( __FILE__ ) . 'js/loanthru_calculator-admin.js', array( 'jquery' ), $this->version, false );

	}
	
	/**
	 * Register the settings page
	 *
	 * @since    1.0.0
	 */
	public function add_admin_menu() {
	    add_options_page( 
			'LoanThru Calculator', 	// Page Title
			'LoanThru Calculator', 	// Menu Title
			'manage_options', 	// Capability
			'LT-setting-admin', 	// Menu_slug
			array($this, 'create_admin_interface'));	// Callable Function
	}

	/**
	 * Callback function for the admin settings page.
	 *
	 * @since    1.0.0
	 */
	public function create_admin_interface(){
		// Set class property
        $this->options = get_option( 'LT_option_name' );
		?>
        <div class="wrap">
            <h1>LoanThru Calculator Settings</h1>
            <form method="post" action="options.php">
            <?php
                // This prints out all hidden setting fields
                settings_fields( 'LT_option_group' );
                do_settings_sections( 'LT-setting-admin' );
                submit_button();
            ?>
            </form>
        </div>
		<?php
	}
	
	/**
	 * Creates our settings sections with fields etc.
	 *
	 * @since    1.0.0
	 */
	public function settings_api_init(){

		/**
		 * Sections functions
		 */
		//register basic settings
		register_setting( 	'LT_option_group', // Option group
							'LT_option_name',	// Option name
							array( $this, 'sanitize' ) // Sanitize
						);
						
	 	add_settings_section(
			'loanthru_calculator_basic_settings_section',	// ID
			'',	// Title
			array( $this, 'print_section_info' ),	// Callback
			'LT-setting-admin'	// Page
		);

		// Add the field 
		add_settings_field(
			'LT_calc_title',			// ID
			'Calculator Label',		// Title
			array($this, 'loanthru_calculator_setting_callback_LT_calc_title'),		// Callback
			'LT-setting-admin',	// Page
			'loanthru_calculator_basic_settings_section'	// Setion
		);
		
	 	add_settings_field(
			'LT_calc_amt',			// ID
			'Loan Amount ($)',		// Title
			array($this, 'loanthru_calculator_setting_callback_LT_calc_amt'),		// Callback
			'LT-setting-admin',	// Page
			'loanthru_calculator_basic_settings_section'	// Setion
		);		
		
		add_settings_field(
			'LT_calc_term',			// ID
			'Term (months)',		// Title
			array($this, 'loanthru_calculator_setting_callback_LT_calc_term'),		// Callback
			'LT-setting-admin',	// Page
			'loanthru_calculator_basic_settings_section'	// Setion
		);
		
		add_settings_field(
			'LT_calc_rate',			// ID
			'Interest Rate per annum (%)',		// Title
			array($this, 'loanthru_calculator_setting_callback_LT_calc_rate'),		// Callback
			'LT-setting-admin',	// Page
			'loanthru_calculator_basic_settings_section'	// Setion
		);
		
		add_settings_field(
			'LT_calc_method',			// ID
			'Interest calculation method',		// Title
			array($this, 'loanthru_calculator_setting_callback_LT_calc_method'),		// Callback
			'LT-setting-admin',	// Page
			'loanthru_calculator_basic_settings_section'	// Setion
		);
		
		add_settings_field(
			'LT_calc_Hmethod',			// ID
			'Hide calculation method',		// Title
			array($this, 'loanthru_calculator_setting_callback_LT_calc_Hmethod'),		// Callback
			'LT-setting-admin',	// Page
			'loanthru_calculator_basic_settings_section'	// Setion
		);
		
	}
	
	/**
     * Sanitize each setting field as needed
     *
     * @param array $input Contains all settings fields as array keys
     */
    public function sanitize( $input )
    {
        $new_input = array();
		if( isset( $input['LT_calc_title'] ) )
            $new_input['LT_calc_title'] = sanitize_text_field( $input['LT_calc_title'] );
		
        if( isset( $input['LT_calc_amt'] ) )
            $new_input['LT_calc_amt'] = absint( $input['LT_calc_amt'] );
		
		if( isset( $input['LT_calc_term'] ) )
            $new_input['LT_calc_term'] = absint( $input['LT_calc_term'] );
		
		if( isset( $input['LT_calc_rate'] ) )
            $new_input['LT_calc_rate'] = absint( $input['LT_calc_rate'] );
		
		if( isset( $input['LT_calc_method'] ) )
            $new_input['LT_calc_method'] = sanitize_text_field( $input['LT_calc_method'] );
		
		if( isset( $input['LT_calc_Hmethod'] ) )
            $new_input['LT_calc_Hmethod'] = sanitize_text_field( $input['LT_calc_Hmethod'] );
		
        return $new_input;
    }
	
	/**
	 * Callback functions for settings
	 */
	 
    /** 
     * Print the Section text
     */
    public function print_section_info()
    {
        print 'Enter your settings below:';
    }
	
	/** 
     * Get the settings option array and print one of its values
     */
	public function loanthru_calculator_setting_callback_LT_calc_title()  {
 		printf(
            '<input type="text" id="LT_calc_title" name="LT_option_name[LT_calc_title]" value="%s" />',
            !empty( $this->options['LT_calc_title'] ) ? esc_attr( $this->options['LT_calc_title']) : 'Loan Calculator'
        );
 	}
	
    public function loanthru_calculator_setting_callback_LT_calc_amt()  {
 		printf(
            '<input type="number" id="LT_calc_amt" name="LT_option_name[LT_calc_amt]" value="%s" />',
            !empty( $this->options['LT_calc_amt'] ) ? esc_attr( $this->options['LT_calc_amt']) : '50000'
        );
 	}
	
    public function loanthru_calculator_setting_callback_LT_calc_term()  {
 		printf(
            '<input type="number" id="LT_calc_term" name="LT_option_name[LT_calc_term]" value="%s" />',
            !empty( $this->options['LT_calc_term'] ) ? esc_attr( $this->options['LT_calc_term']) : '120'
        );
 	}
	
	public function loanthru_calculator_setting_callback_LT_calc_rate()  {
 		printf(
            '<input type="number" id="LT_calc_rate" name="LT_option_name[LT_calc_rate]" value="%s" />',
            !empty( $this->options['LT_calc_rate'] ) ? esc_attr( $this->options['LT_calc_rate']) : '5'
        );
 	}
	
	public function loanthru_calculator_setting_callback_LT_calc_method()  {
		echo '<select id="LT_calc_method" name="LT_option_name[LT_calc_method]" >';
			if($this->options['LT_calc_method'] == "daily") {
				echo '	<option value="daily" selected>Daily Reducing</option>';
			} else { echo '	<option value="daily">Daily Reducing</option>'; }
			
			if($this->options['LT_calc_method'] == "monthly" || empty($this->options['LT_calc_method']) ) {
				echo '	<option value="monthly" selected>Monthly Reducing</option>';
			} else { echo '	<option value="monthly">Monthly Reducing</option>'; }
			
			if($this->options['LT_calc_method'] == "yearly") {
				echo '	<option value="yearly" selected>Yearly Reducing</option>';
			} else { echo '	<option value="yearly">Yearly Reducing</option>'; }
			
			if($this->options['LT_calc_method'] == "flat") {
				echo '	<option value="flat" selected>Flat Rate</option>';
			} else { echo '	<option value="flat">Flat Rate</option>'; }
			
			if($this->options['LT_calc_method'] == "rule78") {
				echo '	<option value="rule78" selected>Rule of 78</option>';
			} else { echo '	<option value="rule78">Rule of 78</option>'; }
        echo '</select>';
 	}
	
	public function loanthru_calculator_setting_callback_LT_calc_Hmethod()  {
 		printf(
            '<input type="checkbox" id="LT_calc_Hmethod" name="LT_option_name[LT_calc_Hmethod]" value="yes" %s />',
            !empty( $this->options['LT_calc_Hmethod'] ) ? 'checked' : ''
        );
 	}
}
