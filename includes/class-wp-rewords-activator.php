<?php

/**
 * Fired during plugin activation
 *
 * @link       http://wp-rewords.com
 * @since      1.0.0
 *
 * @package    Wp_Rewords
 * @subpackage Wp_Rewords/includes
 */

/**
 * Fired during plugin activation.
 *
 * This class defines all code necessary to run during the plugin's activation.
 *
 * @since      1.0.0
 * @package    Wp_Rewords
 * @subpackage Wp_Rewords/includes
 * @author     Yuval Oren <yuval@pinewise.com>
 */
class Wp_Rewords_Activator {

	/**
	 * Short Description. (use period)
	 *
	 * Long Description.
	 *
	 * @since    1.0.0
	 */
	public static function activate() {
		$wp_rewords_options = array(
            "campaigns" => array()
//            "campaigns" => array(array('4'=>array("name" => "Mailing list", "page_tile" => "10 things you wanted", "url" => "http://wprewords.com/?utm=123123)))
		);
        if (!get_option("wp_rewords_options")) {
            update_option("wp_rewords_options", $wp_rewords_options);
        }

	}

}
