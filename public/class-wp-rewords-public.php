<?php

/**
 * The public-facing functionality of the plugin.
 *
 * @link       http://wp-rewords.com
 * @since      1.0.0
 *
 * @package    Wp_Rewords
 * @subpackage Wp_Rewords/public
 */

/**
 * The public-facing functionality of the plugin.
 *
 * Defines the plugin name, version, and two examples hooks for how to
 * enqueue the admin-specific stylesheet and JavaScript.
 *
 * @package    Wp_Rewords
 * @subpackage Wp_Rewords/public
 * @author     Yuval Oren <yuval@pinewise.com>
 */
class Wp_Rewords_Public {

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
		 * defined in Wp_Rewords_Loader as all of the hooks are defined
		 * in that particular class.
		 *
		 * The Wp_Rewords_Loader will then create the relationship
		 * between the defined hooks and the functions defined in this
		 * class.
		 */

		wp_enqueue_style( $this->plugin_name, plugin_dir_url( __FILE__ ) . 'css/wp-rewords-public.css', array(), $this->version, 'all' );

	}

	/**
	 * Register the stylesheets for the public-facing side of the site.
	 *
	 * @since    1.0.0
	 */
	public function enqueue_scripts() {

		/**
		 * This function is provided for demonstration purposes only.
		 *
		 * An instance of this class should be passed to the run() function
		 * defined in Wp_Rewords_Loader as all of the hooks are defined
		 * in that particular class.
		 *
		 * The Wp_Rewords_Loader will then create the relationship
		 * between the defined hooks and the functions defined in this
		 * class.
		 */

		wp_enqueue_script( $this->plugin_name, plugin_dir_url( __FILE__ ) . 'js/wp-rewords-public.js', array( 'jquery' ), $this->version, false );

	}

	public function wp_rewords_replace_title($title) {
		$page_id = get_the_ID();
		if (in_the_loop()) {
			$options = get_option("wp_rewords_options");
			$campaigns = $options["campaigns"];
			if (isset($campaigns[$page_id])) {
				foreach($campaigns[$page_id] as $campaign) {
					if (strpos($this->getUrlEnding($_SERVER['REQUEST_URI']), $this->getUrlEnding($campaign["url"])) !== false) {
						return $campaign["title"];
					}
				}
			}
		}
		return $title;
	}

	public function getUrlEnding($url) {
		$parts = explode("/", $url);
		return $parts[sizeof($parts) - 1];
	}


}
