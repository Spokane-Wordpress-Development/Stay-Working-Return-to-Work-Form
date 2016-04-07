<?php

/**
 * Plugin Name: Stay Working - Return to Work Form
 * Plugin URI: http://stayworkingsystem.com/
 * Description: Custom plugin for Stay Working
 * Author: Thinking Cap Communications & Design
 * Author URI: http://tcapdesign.com/
 * Version: 1.0.0
 * Text Domain: return-to-work
 *
 * Copyright 2016 Thinking Cap Communications & Design
 *
 * This program is free software; you can redistribute it and/or modify
 * it under the terms of the GNU General Public License, version 2, as
 * published by the Free Software Foundation.
 *
 * This program is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
 * GNU General Public License for more details.
 *
 * You should have received a copy of the GNU General Public License
 * along with this program; if not, write to the Free Software
 * Foundation, Inc., 51 Franklin St, Fifth Floor, Boston, MA  02110-1301  USA
 *
 */

namespace StayWorking;

class ReturnToWork {

	const VERSION = '1.0.0';
	const VERSION_JS = '1.0.0';
	const VERSION_CSS = '1.0.0';

	const OPTION_VERSION = 'return_to_work_form_version';
	
	public function activate()
	{
		add_option( self::OPTION_VERSION, self::VERSION );
	}
	
	public function init()
	{
		wp_enqueue_script( 'return-to-work-form-js', plugin_dir_url( __FILE__ ) . 'return-to-work-form.js', array( 'jquery' ), ( WP_DEBUG ) ? time() : self::VERSION_JS, TRUE );
		wp_enqueue_style( 'return-to-work-form-bootstrap-css', plugin_dir_url( __FILE__ ) . 'bootstrap.css', array(), ( WP_DEBUG ) ? time() : self::VERSION_CSS );
		wp_enqueue_style( 'return-to-work-form-css', plugin_dir_url( __FILE__ ) . 'return-to-work-form.css', array(), ( WP_DEBUG ) ? time() : self::VERSION_CSS );
	}
	
	public function shortcode()
	{
		ob_start();
		include ( 'form.php' );
		return ob_get_clean();
	}

	function add_settings_link( $links )
	{
		$settings_link = '<a href="options-general.php?page=' . plugin_basename( __FILE__ ) . '">' . __( 'Instructions' ) . '</a>';
		$links[] = $settings_link;
		return $links;
	}

	function add_settings_page()
	{
		add_options_page(
			'Stay Working System',
			'Stay Working System',
			'manage_options',
			plugin_basename( __FILE__ ),
			array( $this, 'options_page')
		);
	}

	function options_page()
	{
		echo "
			<div class='wrap'>
        		<h2>Stay Working System - Return to Work Form Instructions</h2>
        		<p>
        			To add the return to work form to any WordPress page, 
        			simply copy and paste the below shortcode into the content section of your page:
                </p>

    			[return_to_work_form]

    		</div>";
	}
}

$controller = new ReturnToWork;

/** activate */
register_activation_hook( __FILE__, array( $controller, 'activate' ) );

/** Initialize any variables that the plugin needs */
add_action( 'init', array( $controller, 'init' ) );

/** Register shortcode */
add_shortcode ( 'return_to_work_form', array( $controller, 'shortcode') );

if ( is_admin() )
{
	/* add the instructions page link */
	add_filter( 'plugin_action_links_' . plugin_basename( __FILE__ ), array( $controller, 'add_settings_link' ) );

	/* add the instructions page */
	add_action( 'admin_menu', array( $controller, 'add_settings_page' ) );
}
