jQuery(document).ready(function($) {
    if ($('.hvp-video-upload').length > 0) {
        if (typeof wp !== 'undefined' && wp.media && wp.media.editor) {
            $(document).on('click', '.hvp-video-upload', function(e) {
                e.preventDefault();
                window.ga('hvp.send', 'event', 'video-upload', 'click');
                var button = $(this);
                var id = button.prev();
                uploader(button, id, 'video');
                return false;
            });
            $(document).on('click', '.hvp-poster-upload', function(e) {
                e.preventDefault();
                window.ga('hvp.send', 'event', 'image-upload', 'click');
                var button = $(this);
                var id = button.prev();
                uploader(button, id, 'image');
                return false;
            });
        }
    }

    function uploader(button, id, upload_type) {
        var file_frame = wp.media.frames.file_frame = wp.media({
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
            window.ga('hvp.send', 'event', upload_type+'-upload', 'insert');
            var selection = file_frame.state().get('selection');
            selection.each(function(attachment, index) {
                attachment = attachment.toJSON();
                id.val(attachment.url);
            });
        });

        file_frame.open();
    }

    $(document).on('click', '.hvp-close-button', function() {
        window.ga('hvp.send', 'event', 'hvp-close-button', 'click');
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
            window.ga('hvp.send', 'event', 'hvp-video-ads', 'change', '', 1);
            $('#hvp-ads-url').prop('disabled', false).focus();
        }
        else{
            window.ga('hvp.send', 'event', 'hvp-video-ads', 'change', '', 0);
            $('#hvp-ads-url').prop('disabled', true);
        }
    });

    window.hvp = {
        handle_close: function() {
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
