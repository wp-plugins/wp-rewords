<?php

/**
 * The admin-specific functionality of the plugin.
 *
 * @link       http://wp-rewords.com
 * @since      1.0.0
 *
 * @package    Wp_Rewords
 * @subpackage Wp_Rewords/admin
 */

/**
 * The admin-specific functionality of the plugin.
 *
 * Defines the plugin name, version, and two examples hooks for how to
 * enqueue the admin-specific stylesheet and JavaScript.
 *
 * @package    Wp_Rewords
 * @subpackage Wp_Rewords/admin
 * @author     Yuval Oren <yuval@pinewise.com>
 */
class Wp_Rewords_Admin {

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
	public function __construct( $plugin_name, $version, $options ) {

		$this->plugin_name = $plugin_name;
		$this->version = $version;
		$this->options = $options;

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
		 * defined in Wp_Rewords_Loader as all of the hooks are defined
		 * in that particular class.
		 *
		 * The Wp_Rewords_Loader will then create the relationship
		 * between the defined hooks and the functions defined in this
		 * class.
		 */

		wp_enqueue_style( $this->plugin_name, plugin_dir_url( __FILE__ ) . 'css/wp-rewords-admin.css', array(), $this->version, 'all' );

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
		 * defined in Wp_Rewords_Loader as all of the hooks are defined
		 * in that particular class.
		 *
		 * The Wp_Rewords_Loader will then create the relationship
		 * between the defined hooks and the functions defined in this
		 * class.
		 */

		wp_enqueue_script( $this->plugin_name."_mustache", plugin_dir_url( __FILE__ ) . 'js/mustache.min.js', array( 'jquery' ), $this->version, false );
		wp_enqueue_script( $this->plugin_name, plugin_dir_url( __FILE__ ) . 'js/wp-rewords-admin.js', array( 'jquery' ), $this->version, false );
	}

	public function add_metaboxes() {
		add_meta_box('wp_rewords_campaigns',
			'WP ReWords',
			array( $this, 'callback_metabox_campaign_settings')
			);
	}

	public function callback_metabox_campaign_settings( $object, $box) {
		include( plugin_dir_path( __FILE__ ).'partials/wp-rewords-admin-page-metabox.php');
	}

	public function wp_rewords_ajax_create_campaign(){

		$options = get_option("wp_rewords_options");
		$campaigns = $options["campaigns"];

		if (isset($_POST["pageId"])) {
			$page_id = $_POST["pageId"];
			$campaign = array();
			if (isset($_POST["name"])) {
				$campaign["name"] = sanitize_text_field($_POST["name"]);
							$campaign["title"] = sanitize_text_field($_POST["title"], "");
							$campaign["url"] = $_POST["url"];
			}
			if (!isset($campaigns[$page_id])) {
				$campaigns[$page_id] = array();
			}
			array_push($campaigns[$page_id], $campaign);
			$options["campaigns"] = $campaigns;
			update_option("wp_rewords_options", $options);

		}

		$this->getCampgainsJson();

		die();
	}

	public function wp_rewords_ajax_get_campaigns(){
		$this->getCampgainsJson();
		die();
	}

	public function wp_rewords_save_campaign(){
		$options = get_option("wp_rewords_options");
		$campaigns = $options["campaigns"];

		if (isset($_POST["pageId"]) && isset($_POST["index"])) {
			$page_id = $_POST["pageId"];
			$campaign = array("name"=> $_POST["name"], "title"=> $_POST["title"], "url"=> $_POST["url"]);
			$campaigns[$page_id][(int) $_POST["index"]] = $campaign;
			$options["campaigns"] = $campaigns;
			update_option("wp_rewords_options", $options);
		}
		$this->getCampgainsJson();

		die();
	}

	public function wp_rewords_delete_campaign(){
		$options = get_option("wp_rewords_options");
		$campaigns = $options["campaigns"];
		if (isset($_POST["pageId"]) && isset($_POST["index"])) {
			$page_id = $_POST["pageId"];
			$index = $_POST["index"];
			unset($campaigns[$page_id][$index]);
			$options["campaigns"] = $campaigns;
			update_option("wp_rewords_options", $options);
		}
		$this->getCampgainsJson();

		die();
	}

	public function getCampgainsJson()
	{
		$options = get_option("wp_rewords_options");
		$campaigns = $options["campaigns"];
		if (isset($_POST["pageId"])) {
			$page_id = $_POST["pageId"];
			$ret = array();
			if (isset($campaigns[$page_id])) {
				foreach ($campaigns[$page_id] as $key => $value) {
					$value["id"] = $key;
					array_push($ret, $value);
				}
				wp_send_json($ret);
			}
		}
	}
}
