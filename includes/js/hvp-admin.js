jQuery(document).ready(function($) {

    // Display ads url input
    $(document).on('change', '.is_video_ads', function(){
        if($(this).is(':checked')){
            $('.hvp-ads-container').show();
        }
        else{
            $('.hvp-ads-container').hide();
        }
    });

    if ($('.hvp-video-upload').length > 0) {
        if (typeof wp !== 'undefined' && wp.media && wp.media.editor) {
            $(document).on('click', '.hvp-video-upload', function(e) {
                e.preventDefault();
                var button = $(this);
                var id = button.prev();
                uploader(button, id, 'video');
                return false;
            });

            $(document).on('click', '.hvp-poster-upload', function(e) {
                e.preventDefault();
                var button = $(this);
                var id = button.prev();
                uploader(button, id, 'image');
                return false;
            });
        }
    }

    function uploader(button,id, upload_type) {
        var file_frame;
        if (file_frame) {
            file_frame.open();
            return;
        }
        file_frame = wp.media.frames.file_frame = wp.media({
            frame: 'post',
            state: 'insert',
            title: button.data('uploader-title'),
            button: {
                text: button.data('uploader-button-text')
            },
            library : { type: upload_type },
            multiple :false
        });

        file_frame.on('insert', function() {
            var selection = file_frame.state().get('selection');
            selection.each(function(attachment, index) {
                        attachment = attachment.toJSON();
                        id.val(attachment.url);
            });
        });

        file_frame.open();
    }
    var user_email;
    window.hvp_set_user_email = function(email) {
        user_email = email;
    };
    $(document).on('click', '.hvp-close-button', function() {
        var checkbox = $('#hvp-analytics-optin')[0];
        if (checkbox && checkbox.checked && user_email) {
            $.ajax({
                method: 'GET',
                url: '//holacdn.com/create_cdn_lead',
                data: { email: user_email, campaign: 'wordpress' },
            });
        }
        $('.hvp-popup-overlay').fadeOut();
        $('.hvp-popup-content').fadeOut();
    });
    $(document).on('ready', function() {
        $('#hvp-firstrun-overlay').fadeIn();
        $('#hvp-firstrun-content').fadeIn();
    });
});
