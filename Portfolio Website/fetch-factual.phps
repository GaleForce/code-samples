<?php

class FetchFactual {

	/*--------------------------------------------*
	 * Constants
	 *--------------------------------------------*/
	const name = 'Fetch Factual';
	const slug = 'fetch_factual';
	
	/**
	 * Constructor
	 */
	function __construct() {
		//register an activation hook for the plugin
		//register_activation_hook( __FILE__, array( &$this, 'install_fetch_factual' ) );

		//Hook up to the init action
		add_action( 'init', array( &$this, 'init_fetch_factual' ) );
	}
  
	/**
	 * Runs when the plugin is activated
	 */  
	function install_fetch_factual() {
		// do not generate any output here
	}
  
	/**
	 * Runs when the plugin is initialized
	 */
	function init_fetch_factual() {
		// Load JavaScript and stylesheets
		$this->register_scripts_and_styles();

		// Register the shortcode [fetch_factual]
		add_shortcode( 'fetch_factual', array( &$this, 'fetch_factual_shortcode' ) );
	}

	function fetch_factual_shortcode($atts) {
		// Extract the attributes
		extract(shortcode_atts(array(
			'latitude' => '',
			'longitude' => ''
			), $atts));

		$form = <<<FFFORM
			<!--START ff-container-->
			<div id="ff-container">

			<!--Alert Bar-->
			<div id="ff-alert-bar" class="">
				<h4 id="ff-alert-head"></h4>
				<div id="ff-alert-msg"></div>
			</div>

			<div id="ff-content">

				<form id="ff-form-loc" name="ff-form-loc">
					<!--selected location & coordinates-->
					<div id="ff-loc-div" class="ff-form-sect">
						<input type="hidden" id="ff-lat" name="ff-lat" class="ff-coord" value="$latitude">
						
						<input type="hidden" id="ff-lon" name="ff-lon" class="ff-coord" value="$longitude">
					</div>		
				</form>

			<!--Places Info-->
			<section id="ff-business-profile" class="ff-rsect">
				<div id="ff-places-div">
					<h2>Business Profile</h2>
					<form id="ff-form-places" name="ff-form-places">
						<input type="text" id="ff-places-lat" name="ff-places-lat" hidden>
						<input type="text" id="ff-places-lon" name="ff-places-lon" hidden>
						<input type="hidden" id="ff-rad" name="ff-rad" value="8047">
						<input type="hidden" id="ff-rad-unit" name="ff-rad-unit" value="meters">
						
						<input type="submit" id="ff-sub-places" value="Fetch Data">
					</form>
				
					<ul id="ff-cat-res-list">
						<li id="ff-cat-4" class="ff-cat-res"><div class="ff-cat-swatch"></div><div class="ff-cat-count">-</div>Car Dealers &amp; Leasing</li>
						<li id="ff-cat-5" class="ff-cat-res"><div class="ff-cat-swatch"></div><div class="ff-cat-count">-</div>Used Car Dealers &amp; Leasing</li>
						<li id="ff-cat-14" class="ff-cat-res"><div class="ff-cat-swatch"></div><div class="ff-cat-count">-</div>Motorcycles, Mopeds &amp; Scooters</li>
						<li id="ff-cat-17" class="ff-cat-res"><div class="ff-cat-swatch"></div><div class="ff-cat-count">-</div>RVs &amp; Motor Homes</li>
						<!--<li id="ff-cat-272" class="ff-cat-res"><div class="ff-cat-swatch"></div><div class="ff-cat-count">-</div>Insurance</li>-->
					</ul>
				</div>
				<div class="aligncenter  wp-chart-wrap" style="max-width: 100%; width: 53%; height: 200px; margin: 5px auto;" data-proportion="1"><canvas style="width: 200px; height: 200px;" id="mydough" height="200" width="200" class="wp_charts_canvas" data-proportion="1"></canvas></div>
			</section>

			<!--Demographics Info--><!--
			<section id="ff-dg" class="ff-rsect">
				<div id="ff-dg-div">
					<h4>Demographics</h4>
					<form id="ff-form-dg" name="ff-form-dg">
						<input type="text" id="ff-dg-lat" name="ff-dg-lat" >
						<input type="text" id="ff-dg-lon" name="ff-dg-lon" >
						<input type="text" id="ff-dg-show" name="ff-dg-show" value="true" hidden>
						<input type="text" id="ff-dg-format" name="ff-dg-format" value="json" hidden>
						
						<div id="ff-sub-dg-div" class="ff-form-sect ff-right-none">
							<input type="submit" id="ff-sub-dg" value="Fetch Data">
						</div>
					</form>
				</div>
			</section> -->

			</div> <!--END ff-content-->

			</div> <!--END ff-container-->
FFFORM;
		
		
		//return 'returned'.$longitude;
		return $form;
	}
  
	/**
	 * Registers and enqueues stylesheets for the administration panel and the
	 * public facing site.
	 */
	private function register_scripts_and_styles() {
		if ( is_admin() ) {
			//$this->load_file( self::slug . '-admin-script', '/js/admin.js', true );
			//$this->load_file( self::slug . '-admin-style', '/css/admin.css' );
		} else {
			$this->load_file( self::slug . '-script-events', '/scripts/events.js', true );
			$this->load_file( self::slug . '-script-ff-alert', '/scripts/ff-alert.js', true );
			$this->load_file( self::slug . '-script-fetch-factual', '/scripts/fetch-factual.js', true );
			$this->load_file( self::slug . '-style', '/style.css' );
		}
	} // end register_scripts_and_styles
	
	/**
	 * Helper function for registering and enqueueing scripts and styles.
	 *
	 * @name			The ID to register with WordPress
	 * @file_path		The path to the actual file
	 * @is_script		Optional argument for if the incoming file_path is a JavaScript source file.
	 */
	private function load_file( $name, $file_path, $is_script = false ) {

		$url = plugins_url($file_path, __FILE__);
		$file = plugin_dir_path(__FILE__) . $file_path;

		if( file_exists( $file ) ) {
			if( $is_script ) {
				wp_register_script( $name, $url, array('jquery') ); //depends on jquery
				wp_enqueue_script( $name );
			} else {
				wp_register_style( $name, $url );
				wp_enqueue_style( $name );
			} // end if
		} // end if

	} // end load_file
  
} // end class
new FetchFactual();