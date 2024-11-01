<?php /* 
Plugin Name: Simple Page Transition
Plugin URI: http://www.juzed.fr/
Description: Add simple transition between pages (between unload and load)
Version: 1.4.1 
Author: Julien Zerbib
Author URI: http://www.juzed.fr/
  
  
    Copyright 2013  Julien Zerbib  (email : contact@juzed.fr)

    This program is free software; you can redistribute it and/or modify
    it under the terms of the GNU General Public License, version 2, as 
    published by the Free Software Foundation.

    This program is distributed in the hope that it will be useful,
    but WITHOUT ANY WARRANTY; without even the implied warranty of
    MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
    GNU General Public License for more details.

    You should have received a copy of the GNU General Public License
    along with this program; if not, write to the Free Software
    Foundation, Inc., 51 Franklin St, Fifth Floor, Boston, MA  02110-1301  USA
*/
define( 'SPT_PLUGIN_URL', plugin_dir_url( __FILE__ ) );
define( 'SPT_PLUGIN_PATH', plugin_dir_path( __FILE__ ) );

$upload_dir = wp_upload_dir();
define( 'SPT_UPLOAD_URL', $upload_dir['baseurl'] . '/spt/' );
define( 'SPT_UPLOAD_PATH', $upload_dir['basedir'] . '/spt/' );

class Simple_Page_Transition {
    /**
     * Construct the plugin object
     */
    public function __construct() {
        // Add some functions
        require_once( dirname(__FILE__) . '/inc/functions.php' );

        // Initialize Settings
        require_once( dirname(__FILE__) . '/settings.php' );
        $Simple_Page_Transition_Settings = new Simple_Page_Transition_Settings();
    } // END public function __construct
    
    /**
     * Activate the plugin
     */
    public static function activate( $networkwide ) {
        // Do nothing    
    } // END public static function activate

    /**
     * Deactivate the plugin
     */        
    public static function deactivate() {
        // Do nothing
    } // END public static function deactivate
} // END class Simple_Page_Transition

// Installation and uninstallation hooks
register_activation_hook( __FILE__, array( 'Simple_Page_Transition', 'activate' ) );
register_deactivation_hook( __FILE__, array( 'Simple_Page_Transition', 'deactivate' ) );

// instantiate the plugin class
$simple_page_transition_plugin = new Simple_Page_Transition();
