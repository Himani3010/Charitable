<?php 
/**
 * Class that sets up the Charitable Admin functionality.
 * 
 * @package 	Charitable/Classes/Charitable_Admin
 * @version     1.0.0
 * @author 		Eric Daams
 * @copyright 	Copyright (c) 2014, Studio 164a
 * @license     http://opensource.org/licenses/gpl-2.0.php GNU Public License   
 */

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

if ( ! class_exists( 'Charitable_Admin' ) ) : 

/**
 * Charitable_Admin 
 *
 * @final
 * @since     	1.0.0
 */
final class Charitable_Admin {

	/**
	 * @var Charitable $charitable
	 * @access private
	 */
	private $charitable;

	/**
	 * Set up the class. 
	 * 
	 * Note that the only way to instantiate an object is with the charitable_start method, 
	 * which can only be called during the start phase. In other words, don't try 
	 * to instantiate this object. 
	 *
	 * @param 	Charitable 		$charitable 
	 * @access 	private
	 * @since 	1.0.0
	 */
	private function __construct(Charitable $charitable) {
		$this->charitable = $charitable;

		$this->charitable->register_object($this);

		$this->include_files();

		$this->attach_hooks_and_filters();
	}

	/**
	 * Instantiate the class, but only during the start phase.
	 * 
	 * @param 	Charitable 		$charitable
	 * @return 	void
	 * @static 
	 * @access 	public
	 * @since 	1.0.0
	 */
	public static function start(Charitable $charitable) {
		if ( $charitable->started() ) {
			return;
		}

		new Charitable_Admin( $charitable );
	}

	/**
	 * Include admin-only files.
	 * 
	 * @return 	void
	 * @access 	private
	 * @since 	1.0.0
	 */
	private function include_files() {
		require_once( $this->charitable->get_path( 'admin' ) . 'includes/charitable-core-admin-functions.php' );			
		require_once( $this->charitable->get_path( 'admin' ) . 'includes/class-charitable-admin-settings.php' );
		require_once( $this->charitable->get_path( 'admin' ) . 'includes/class-charitable-meta-box-helper.php' );
		require_once( $this->charitable->get_path( 'admin' ) . 'includes/class-charitable-campaign-post-type.php' );
		require_once( $this->charitable->get_path( 'admin' ) . 'includes/class-charitable-donation-post-type.php' );
	}

	/**
	 * Sets up hook and filter callback functions for admin-only functionality.
	 * 
	 * @return 	void
	 * @access 	private
	 * @since 	1.0.0
	 */
	private function attach_hooks_and_filters() {
		add_action( 'charitable_start', 		array( 'Charitable_Admin_Settings', 'charitable_start' ) );
		add_action( 'charitable_start', 		array( 'Charitable_Campaign_Post_Type', 'charitable_start' ) );
		add_action( 'charitable_start', 		array( 'Charitable_Donation_Post_Type', 'charitable_start' ) );
		add_action( 'admin_enqueue_scripts', 	array( $this, 'admin_enqueue_scripts' ) );
		add_filter( 'plugin_action_links_' . plugin_basename( $this->charitable->get_path() ), 	array( $this, 'add_plugin_action_links' ) );
	}

	/**
	 * Loads admin-only scripts and stylesheets. 
	 *
	 * @global 	WP_Scripts 		$wp_scripts
	 * @return 	void
	 * @access 	public
	 * @since 	1.0.0
	 */
	public function admin_enqueue_scripts() {		
		global $wp_scripts;

		$assets_path = $this->charitable->get_path( 'admin', false ) . 'assets/';	

		/* Menu styles are loaded everywhere in the Wordpress dashboard. */
		wp_register_style( 'charitable-admin-menu', $assets_path . 'css/charitable-admin-menu.css', array(), $this->charitable->get_version() );
		wp_enqueue_style( 'charitable-admin-menu' );

		/* The following styles are only loaded on Charitable screens. */
		$screen = get_current_screen();

		if ( in_array( $screen->id, $this->get_charitable_screens() ) ) {		
		
			wp_register_style( 'charitable-admin', $assets_path . 'css/charitable-admin.css', array(), $this->charitable->get_version() );
			wp_enqueue_style( 'charitable-admin' );

			wp_register_script( 'charitable-admin', $assets_path . 'js/charitable-admin.js', array('jquery-ui-datepicker', 'jquery-ui-tabs'), $this->charitable->get_version() );		
			wp_enqueue_script( 'charitable-admin' );

		}
	}

	/**
	 * Add custom links to the plugin actions. 
	 *
	 * @param 	array 		$links
	 * @return 	array
	 * @access  public
	 * @since 	1.0.0
	 */
	public function add_plugin_action_links( $links ) {
		$links[] = '<a href="' . admin_url( 'admin.php?page=charitable-settings' ) . '">' . __( 'Settings', 'charitable' ) . '</a>';
		return $links;
	}

	/**
	 * Returns an array of screen IDs where the Charitable scripts should be loaded. 
	 *
	 * @uses charitable_admin_screens
	 * 
	 * @return 	array
	 * @access 	private
	 * @since 	1.0.0
	 */
	private function get_charitable_screens() {
		return apply_filters( 'charitable_admin_screens', array(
			'campaign', 
			'donation', 
			'charitable_page_charitable-settings'
		) );
	}
}

endif;