(function($) {
    $(function() {
        var custom_uploader;
        
        $('#upload_image_button').click(function(e) {
     
            e.preventDefault();
     
            //If the uploader object has already been created, reopen the dialog
            if (custom_uploader) {
                custom_uploader.open();
                return;
            }
     
            //Extend the wp.media object
            custom_uploader = wp.media.frames.file_frame = wp.media({
                title: sptParams.imageBouton,
                button: {
                    text: sptParams.imageBouton
                },
                multiple: false
            });
     
            //When a file is selected, grab the URL and set it as the text field's value
            custom_uploader.on('select', function() {
                attachment = custom_uploader.state().get('selection').first().toJSON();
                $('#simple_page_transition_bg_image').val(attachment.id);
                $('#simple_page_transition_loader_image').attr('src', attachment.sizes.full.url);
            });
     
            //Open the uploader dialog
            custom_uploader.open();
     
        });
        
        $( '#simple_page_transition_bg_color' ).wpColorPicker();
        
        $('#restore_settings').click(function(e) {
     
            e.preventDefault();
            $('#simple_page_transition_bg_image').val('');
            $('#simple_page_transition_bg_color').val(sptParams.bgColor);
            $('#simple_page_transition_bg_position').val(sptParams.bgPosition);
            $('#simple_page_transition_loader_image').attr('src', sptParams.loaderUrl);
     
        });
    });                
})(jQuery);
