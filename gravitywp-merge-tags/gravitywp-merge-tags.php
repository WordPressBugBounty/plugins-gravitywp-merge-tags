<?php
/*
Plugin Name: GravityWP - Merge Tags
Plugin URI: https://gravitywp.com/plugin/merge-tags
Description: Gravity Forms add-on to list all the merge tags from a specific form
Version: 1.3
Author: GravityWP
Author URI: https://gravitywp.com
License: GPL2
Text Domain: gravitywp-merge-tags
Domain Path: /languages
*/

define( 'GWP_MERGETAGS_VERSION', '1.3' );

add_action( 'gform_loaded', array( 'GWPMergeTags_AddOn_Bootstrap', 'load' ), 5 );

/**
 * GWPMergeTags_AddOn_Bootstrap.
 *
 * @author GravityWP
 * @since v0.0.1
 * @version v1.0.0
 *
 * @global
 */
class GWPMergeTags_AddOn_Bootstrap {

	/**
	 * Function: load.
	 *
	 * @author GravityWP
	 * @since v0.0.1
	 * @version v1.0.0
	 * @access public
	 *
	 * @return void
	 */
	public static function load() {

		if ( ! method_exists( 'GFForms', 'include_addon_framework' ) ) {
			return;
		}

		require_once 'class-gwp-mergetags.php';

		GFAddOn::register( 'GWPMergeTags' );
	}
}

add_filter( 'gform_toolbar_menu', 'gwpmergetags_toolbar', 10, 2 );
/**
 * Function: gwpmergetags_toolbar.
 *
 * @author GravityWP
 * @since v0.0.1
 * @version v1.0.0
 * @global
 * @param array<mixed> $menu_items
 * @param int          $form_id
 *
 * @return mixed
 */
function gwpmergetags_toolbar( $menu_items, $form_id ) {

		$menu_items['gwpmergetags_link'] = array(
			'label'        => 'Merge Tags',
			'title'        => 'Merge Tags',
			'icon'         => '<span style="font-size:15px;font-weight: 700;">{ }</span>',
			'url'          => self_admin_url( 'admin.php?page=gravitywp-merge-tags&id=' . $form_id . '&tab=merge-tags' ),
			'menu_class'   => 'gf_form_toolbar_custom_link',
			'capabilities' => array( 'gravityforms_edit_forms' ),
			'priority'     => 500,
		);

		return $menu_items;
}

// Translation files of the plugin
add_action( 'plugins_loaded', 'gwp_merge_tags_load_textdomain' );

/**
 * Function: gwp_merge_tags_load_textdomain.
 *
 * @author GravityWP
 * @since v0.0.1
 * @version v1.0.0
 * @global
 *
 * @return void
 */
function gwp_merge_tags_load_textdomain() {
	load_plugin_textdomain( 'gravitywp-merge-tags', false, dirname( plugin_basename( __FILE__ ) ) . '/languages' );
}
