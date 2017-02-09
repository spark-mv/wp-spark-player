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

    $(document).on('click', '.hvp-close-button', function() {
        hvp.handle_close();
        return true;
    });
    $(document).on('ready', function() {
        $('#hvp-firstrun-overlay').fadeIn();
        $('#hvp-firstrun-content').fadeIn();
    });

    // Display ads url input
    $(document).on('change', '#hvp-video-ads', function(){
        if($(this).is(':checked')){
            $('#hvp-ads-url').prop('disabled', false).focus();
        }
        else{
            $('#hvp-ads-url').prop('disabled', true);
        }
    });

    // Auto-select video type for certain videos
    $(document).on('change', '#hvp-video-url', function(){
        var val = $(this).val();
        if (val.match(/.m3u8$/i))
            $('#hvp-type').val('hls');
        if (val.match(/.f4m$/i))
            $('#hvp-type').val('osmf');
    });

    $(document).on('change', '#hvp-analytics-optin', function(){
        if ($(this).is(":checked"))
            $('#hvp-analytics-info').fadeIn();
        else
            $('#hvp-analytics-info').fadeOut();
    });

    window.hvp = {
        handle_close: function() {
            var checkbox = $('#hvp-analytics-optin')[0];
            if (checkbox && checkbox.checked)
                this.create_lead();
            $('.hvp-popup-overlay').fadeOut();
            $('.hvp-popup-content').fadeOut();
        },
        create_lead: function() {
            if (this.user_info) {
                $.ajax({
                    method: 'GET',
                    url: '//holacdn.com/create_cdn_lead',
                    data: {campaign: 'wordpress', email: this.user_info.email,
                        name: this.user_info.name, site: this.user_info.site},
                });
            }
        },
        set_user_info: function(info) {
            this.user_info = info;
        },
    };
});
