<?php

/**
 * The public-facing functionality of the plugin.
 *
 * @link       www.loanthru.com
 * @since      1.0.0
 *
 * @package    Loanthru_calculator
 * @subpackage Loanthru_calculator/public
 */

/**
 * The public-facing functionality of the plugin.
 *
 * Defines the plugin name, version, and two examples hooks for how to
 * enqueue the admin-specific stylesheet and JavaScript.
 *
 * @package    Loanthru_calculator
 * @subpackage Loanthru_calculator/public
 * @author     LoanThru <contact_us@loanthru.com>
 */
class Loanthru_calculator_Public {

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
	 * Register the stylesheets for the public-facing side of the site.
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

		wp_enqueue_style( $this->plugin_name, plugin_dir_url( __FILE__ ) . 'css/loanthru_calculator-public.css', array(), $this->version, 'all' );

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
		 * defined in Loanthru_calculator_Loader as all of the hooks are defined
		 * in that particular class.
		 *
		 * The Loanthru_calculator_Loader will then create the relationship
		 * between the defined hooks and the functions defined in this
		 * class.
		 */

		wp_enqueue_script( $this->plugin_name, plugin_dir_url( __FILE__ ) . 'js/loanthru_calculator-public.js', array( 'jquery' ), $this->version, false );

	}
	
    /**
	 * Register the shortcodes.
	 *
	 * @since    1.0.0
	 */
    public function html_form_code() {
		$db_values = get_option( 'LT_option_name' );
		
        echo '<div class="LT_form">';
        echo '<table class="LT_table">';
		
		if(empty($db_values['LT_calc_title'])) {
			echo '<tr><td width="100%" valign="bottom"><p class="LT_header">Loan Calculator</p>';
		} else { echo '<tr><td width="100%" valign="bottom"><p class="LT_header">'. $db_values['LT_calc_title'] .'</p>'; }
		
        echo '<form id="LT_calc01" name="LT_calc01" method="POST" action="" onsubmit="LoanThru_submit(); return false;">';
        echo '<fieldset><p class="LT_label">Loan Amount ($)</p>';
		
		if(empty($db_values['LT_calc_amt'])) {
			echo '<input id="LT_calc_amt" name="LT_calc_amt" placeholder="Loan Amount ($)" required type="number" min="1" value="50000" />';
		} else { echo '<input id="LT_calc_amt" name="LT_calc_amt" placeholder="Loan Amount ($)" required type="number" min="1" value="'.$db_values['LT_calc_amt'].'" />'; }
			
        echo '</fieldset>';
        echo '<fieldset><p class="LT_label">Term (months)</p>';
		
		if(empty($db_values['LT_calc_term'])){
			echo '<input id="LT_calc_term" name="LT_calc_term" placeholder="Term (months)" required type="number" min="1" max="1200" value="120" />';
		} else { echo '<input id="LT_calc_term" name="LT_calc_term" placeholder="Term (months)" required type="number" min="1" max="1200" value="'.$db_values['LT_calc_term'].'" />'; }
		
        echo '</fieldset>';
        echo '<fieldset><p class="LT_label">Interest Rate per annum (%)</p>';
		
		if(empty($db_values['LT_calc_rate'])){
			echo '<input id="LT_calc_rate" name="LT_calc_rate" placeholder="Interest Rate per annum (%)" required type="number" min="0" max="100" step="any" value="5" />';
		} else { echo '<input id="LT_calc_rate" name="LT_calc_rate" placeholder="Interest Rate per annum (%)" required type="number" min="0" max="100" step="any" value="'.$db_values['LT_calc_rate'].'" />'; }
			
        echo '</fieldset>';
        echo '<fieldset><p class="LT_label">Interest calculation method</p>';
		
		if(empty($db_values['LT_calc_Hmethod'])){
			echo '<select id="LT_calc_method" name="LT_calc_method" >';
			if($db_values['LT_calc_method'] == "daily") {
				echo '	<option value="daily" selected>Daily Reducing</option>';
			} else { echo '	<option value="daily">Daily Reducing</option>'; }
			
			if($db_values['LT_calc_method'] == "monthly" || empty($db_values['LT_calc_method'])) {
				echo '	<option value="monthly" selected>Monthly Reducing</option>';
			} else { echo '	<option value="monthly">Monthly Reducing</option>'; }
				
			if($db_values['LT_calc_method'] == "yearly") {
				echo '	<option value="yearly" selected>Yearly Reducing</option>';
			} else { echo '	<option value="yearly">Yearly Reducing</option>'; }
			
			if($db_values['LT_calc_method'] == "flat") {
				echo '	<option value="flat" selected>Flat Rate</option>';
			} else { echo '	<option value="flat">Flat Rate</option>'; }
			
			if($db_values['LT_calc_method'] == "rule78") {
				echo '	<option value="rule78" selected>Rule of 78</option>';
			} else { echo '	<option value="rule78">Rule of 78</option>'; }
				
				
			echo '</select>';
		} else { 
			if(empty($db_values['LT_calc_method'])){
				echo '<input type="hidden" id="LT_calc_method" name="LT_calc_method" value="monthly">';
			} else { echo '<input type="hidden" id="LT_calc_method" name="LT_calc_method" value="'.$db_values['LT_calc_method'].'">'; }
		}
		
        echo '</fieldset>';
        echo '<fieldset>';
        echo '<p id="LT_calc_mth_repay" class="LT_result">Monthly Payments  $ 00.00</p>';
        echo '<p id="LT_calc_tot_int" class="LT_result">Total Interest  $ 00.00</p>';
        echo '</fieldset>';
        echo '<fieldset>';
        echo '<button id="lt_submit" name="lt_submit" type="submit" >Calculate</button>';
        echo '</fieldset>';
        echo '</form>';
        echo '<p class="LT_footer">Powered by <a href="http://www.loanthru.com" target="_blank">LoanThru.com</a></p>';
        echo '</td></tr>';
        echo '</table>';
        echo '</div>';
    }
    public function register_shortcodes() {
        add_shortcode( 'loanthru_calculator', array( $this, 'html_form_code') );
    }
}
