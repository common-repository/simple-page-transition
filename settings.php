<?php

class Simple_Page_Transition_Settings {
    /**
     * Construct the plugin object
     */
    public function __construct() {
        // register actions
        add_action( 'plugins_loaded', array( &$this, 'init_textdomain' ) );
        add_action( 'admin_menu', array( &$this, 'add_menu' ) );
        add_action( 'admin_init', array( &$this, 'register_settings' ) );
        add_action( 'admin_init', array( &$this, 'write_css' ), 11 );
        add_action( 'wp_enqueue_scripts', array( &$this, 'enqueue_scripts' ) );
        add_action( 'admin_enqueue_scripts', array( &$this, 'admin_enqueue_scripts' ) );
        add_action( 'wp_head', array( &$this, 'wp_head' ) );
        add_action( 'wp_footer', array( &$this, 'wp_footer' ) );
    } // END public function __construct

    /**
    * Init textdomain
    */
    public function init_textdomain() {
        
        load_plugin_textdomain( 'spt', false, dirname( plugin_basename( __FILE__ ) ) . '/lang' );
        
    } // END public function init_textdomain

    /**
    * Create an Nivo Lightbox menu entry in "Tools" called "Nivo Lightbox"
    * 
    */
    public function add_menu() {
        add_options_page( 
            __( 'Simple Page Transition', 'spt' ), 
            __( 'Simple Page Transition', 'spt' ), 
            'manage_options', 
            'simple_page_transition', 
            array( &$this, 'settings_page' ) 
        );
    } // END public function add_menu

    /**
    * Register Settings
    */
    public function register_settings() {
            
        register_setting( 'simple_page_transition_settings-group', 'simple_page_transition_bg_image' );
        register_setting( 'simple_page_transition_settings-group', 'simple_page_transition_bg_color' );
        register_setting( 'simple_page_transition_settings-group', 'simple_page_transition_bg_opacity' );
        register_setting( 'simple_page_transition_settings-group', 'simple_page_transition_bg_position' );
        register_setting( 'simple_page_transition_settings-group', 'simple_page_transition_duration_in' );
        register_setting( 'simple_page_transition_settings-group', 'simple_page_transition_duration_out' );
        register_setting( 'simple_page_transition_settings-group', 'simple_page_transition_ignored' );
        
    } // END public function register_settings

    public function write_css( $image ) {

        if( isset( $_GET[ 'page' ] ) && 'simple_page_transition' == $_GET[ 'page' ] && isset( $_GET[ 'settings-updated' ] ) && 'true' == $_GET[ 'settings-updated' ] ) {
            $css_content = '#spt-loader {';
            
            $image = get_option( 'simple_page_transition_bg_image', null );
            if( !empty( $image ) ) {
                $image_src = wp_get_attachment_image_src( $image, 'full' );
                $image_src = $image_src[0];
                
                $css_content .= 'background-image: url(' . $image_src . ');';
            } else {
                $css_content .= 'background-image: url(' . SPT_PLUGIN_URL . 'images/gear-loader.gif);';
            }
            
            $bg_color = spt_hex2rgba( get_option( 'simple_page_transition_bg_color', '#ffffff' ), get_option( 'simple_page_transition_bg_opacity', 1 ) );
            $css_content .= 'background-color: ' . $bg_color . ';';
            
            $position = get_option( 'simple_page_transition_bg_position', '50% 100px' );
            $css_content .= 'background-position: ' . $position . ';';
            
            $duration_out = get_option( 'simple_page_transition_duration_out', null );
            if( !empty( $duration_out ) ) {
                $css_content .= 'transition: opacity ' . $duration_out . 'ms ease-out 0s, left 0s ease-out ' . $duration_out . 'ms;';
            } else {
                $css_content .= 'transition: opacity 1000ms ease-out 0s, left 0s ease-out 1000ms;';
            }
            
            $css_content .= '}';    

            $css_content .= '#spt-loader.active {';
            
            $duration_in = get_option( 'simple_page_transition_duration_in', null );
            if( !empty( $duration_in ) ) {
                $css_content .= 'transition: opacity ' . $duration_in . 'ms ease-out 0s, left 0s ease-out 0s;';
            } else {
                $css_content .= 'transition: opacity 500ms ease-out 0s, left 0s ease-out 0s;';
            }
            
            $css_content .= '}';    
            
            if( !is_dir( SPT_UPLOAD_PATH ) )
                mkdir( SPT_UPLOAD_PATH );
                        
            $css_file = fopen( SPT_UPLOAD_PATH . 'spt-custom.css', 'w' );
            fwrite( $css_file, $css_content );
            fclose( $css_file );    
        }
        
    } // END public function write_css

    /**
    * Display a settings page
    */
    public function settings_page() {

        // Render the tools template
        include( dirname(__FILE__) . '/views/settings.php' );
        
    } // END public function settings_page

    /**
    * Enqueue scripts. 
    */
    public function enqueue_scripts() {
        wp_enqueue_script( 'spt', SPT_PLUGIN_URL . 'js/spt.js', array( 'jquery' ) );
        
        $params = array(
            'duration' => get_option( 'simple_page_transition_duration', 1000 ),
            'ignored' => get_option( 'simple_page_transition_ignored' ),
        );
        wp_localize_script( 'spt', 'sptParams', $params );
        
        wp_enqueue_style( 'spt', SPT_PLUGIN_URL . 'css/spt.css' );
        wp_enqueue_style( 'spt-custom', SPT_UPLOAD_URL . 'spt-custom.css' );
    } // END public function enqueue_scripts
    
    public function admin_enqueue_scripts( $hook_suhfix ) {
        // first check that $hook_suhfix is appropriate for your admin page
        if( 'settings_page_simple_page_transition' == $hook_suhfix ) {
            wp_enqueue_media();
            wp_enqueue_style( 'wp-color-picker' );
            wp_enqueue_script( 'admin-spt', SPT_PLUGIN_URL . 'js/admin-spt.js', array( 'jquery', 'wp-color-picker' ), false, true );
            
            $params = array(
                'loaderUrl' => SPT_PLUGIN_URL . 'images/gear-loader.gif',
                'bgColor' => '#ffffff',
                'bgPosition' => '50% 100px',
                'imageBouton' => __( 'Choose Background Image', 'spt' ),
            );
            wp_localize_script( 'admin-spt', 'sptParams', $params );
        }
    } // END public function admin_enqueue_scripts
    
    public function wp_head( $hook_suhfix ) {
        ?>
            <noscript>
                <link rel="stylesheet" media="all" href="<?php print SPT_PLUGIN_URL . 'css/spt-noscript.css'; ?>"></link>    
            </noscript>
        <?php
    } // END public function wp_head
    
    public function wp_footer( $hook_suhfix ) {
        ?>
            <div id="spt-loader" class="active"></div>
        <?php
    } // END public function wp_footer
} // END class Simple_Page_Transition_Settings