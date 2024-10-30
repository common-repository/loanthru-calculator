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

 //Widget Code Stars Here
class Loanthru_calculator_Widget extends WP_Widget {

  // Set up the widget name and description.
  public function __construct( $plugin_name, $version ) {

    $this->plugin_name = $plugin_name;
    $this->version = $version;
	
    $widget_options = array( 'classname' => 'Loanthru_calculator_Widget', 'description' => 'This is LoanThru Calculator Widget' );
    parent::__construct( 'Loanthru_calculator_Widget', 'LoanThru Calculator', $widget_options );
  }

  // Create the widget output.
  public function widget( $args, $instance ) {
	wp_enqueue_style( $this->plugin_name, plugin_dir_url( __FILE__ ) . 'css/loanthru_calculator-public.css', array(), $this->version, 'all' );
	wp_enqueue_script( $this->plugin_name, plugin_dir_url( __FILE__ ) . 'js/loanthru_calculator-public.js', array( 'jquery' ), $this->version, false );
    echo do_shortcode( '[loanthru_calculator]' );
  }

  
  // Create the admin area widget settings form.
  public function form( $instance ) {
    
  }


  // Apply settings to the widget instance.
  public function update( $new_instance, $old_instance ) {
    $instance = $old_instance;
    $instance[ 'title' ] = strip_tags( $new_instance[ 'title' ] );
    return $instance;
  }

}