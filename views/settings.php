<style>
    .theme-options .setting-panel span {
        float: none;
        text-transform: none;
    }
</style>
<div class="wrap theme-options">
    <div class="icon32" id="icon-options-general"></div><br />
    <h2><?php _e( 'Simple Page Transition Settings', 'spt' ); ?></h2>
    <form method="post" action="options.php">
        <?php settings_fields( 'simple_page_transition_settings-group' );?>
        <div class="postbox metabox-holder">
            <h3 class="hndle"><?php _e( 'Simple Page Transition general settings', 'spt' );?></h3>
            <div class="inside">
                <div class="setting-panel upload">
                    <?php 
                        $simple_page_transition_bg_image = get_option( 'simple_page_transition_bg_image' );
                        
                        $simple_page_transition_bg_image_src = '';
                        if( !empty( $simple_page_transition_bg_image ) ) {
                            $simple_page_transition_bg_image_src = wp_get_attachment_image_src( $simple_page_transition_bg_image, 'full' );
                            $simple_page_transition_bg_image_src = $simple_page_transition_bg_image_src[0];
                        } else {
                            $simple_page_transition_bg_image_src = SPT_PLUGIN_URL . 'images/gear-loader.gif';
                        }
                    ?>
                    <p>
                        <input type="hidden" id="simple_page_transition_bg_image" name="simple_page_transition_bg_image" value="<?php print $simple_page_transition_bg_image; ?>" />
                        <input id="upload_image_button" class="button" type="button" value="<?php _e( 'Choose Background Image', 'spt' ); ?>" /><br />
                        <img id="simple_page_transition_loader_image" src="<?php print $simple_page_transition_bg_image_src; ?>" /><br />
                    </p>
                    <?php 
                        $simple_page_transition_bg_color = get_option( 'simple_page_transition_bg_color', '#ffffff' );
                    ?>
                    <p>
                        <label for="simple_page_transition_bg_color"><?php _e( 'Background Color', 'spt' ); ?></label><br />
                        <input type="text" id="simple_page_transition_bg_color" name="simple_page_transition_bg_color" value="<?php print $simple_page_transition_bg_color; ?>" />
                    </p>
                    <?php 
                        $simple_page_transition_bg_opacity = get_option( 'simple_page_transition_bg_opacity', '1' );
                    ?>
                    <p>
                        <label for="simple_page_transition_bg_opacity"><?php _e( 'Background Opacity', 'spt' ); ?></label><br />
                        <input type="text" id="simple_page_transition_bg_opacity" name="simple_page_transition_bg_opacity" value="<?php print $simple_page_transition_bg_opacity; ?>" />
                    </p>
                    <?php 
                        $simple_page_transition_bg_position = get_option( 'simple_page_transition_bg_position', '50% 100px' );
                    ?>
                    <p>
                        <label for="simple_page_transition_bg_position"><?php _e( 'Background Position', 'spt' ); ?></label><br />
                        <input type="text" id="simple_page_transition_bg_position" name="simple_page_transition_bg_position" value="<?php print $simple_page_transition_bg_position; ?>" /><br />
                        <span><?php _e( 'CSS position, LEFT TOP (ex: 50% 100px)', 'spt' ) ?></span>
                    </p>
                    <?php 
                        $simple_page_transition_duration_in = get_option( 'simple_page_transition_duration_in', 1000 );
                    ?>
                    <p>
                        <label for="simple_page_transition_duration_in"><?php _e( 'Transition Duration in in ms', 'spt' ); ?></label><br />
                        <input type="text" id="simple_page_transition_duration_in" name="simple_page_transition_duration_in" value="<?php print $simple_page_transition_duration_in; ?>" />
                    </p>
                    <?php 
                        $simple_page_transition_duration_out = get_option( 'simple_page_transition_duration_out', 1000 );
                    ?>
                    <p>
                        <label for="simple_page_transition_duration_out"><?php _e( 'Transition Duration out in ms', 'spt' ); ?></label><br />
                        <input type="text" id="simple_page_transition_duration_out" name="simple_page_transition_duration_out" value="<?php print $simple_page_transition_duration_out; ?>" />
                    </p>
                   <?php 
                        $simple_page_transition_ignored = get_option( 'simple_page_transition_ignored' );
                    ?>
                    <p>
                        <label for="simple_page_transition_ignored"><?php _e( 'Ignored Download Links', 'spt' ); ?></label><br />
                        <input type="text" id="simple_page_transition_ignored" name="simple_page_transition_ignored" value="<?php print $simple_page_transition_ignored; ?>" /><br />
                        <span><?php _e( 'CSS Selectors, separated by comas<br />ex: .downloadlink1, #downloadlink2, ...<br />Avoid showing Loader when a download link is click.', 'spt' ); ?></span>
                    </p>
                </div>
            </div>
        </div>
        <p class="submit">
            <input id="restore_settings" class="button" type="button" value="<?php _e( 'Restore Defaults', 'spt' ); ?>" /><br />
            <input type="submit" class="button-primary" value="<?php _e( 'Save settings', 'spt' ); ?>" />
        </p>
    </form>
</div>