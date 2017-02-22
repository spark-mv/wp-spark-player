// JavaScript Document
jQuery(document).ready(function($) {
    var hvped;
    var hvpurl;
    //add the button to tinymce editor
    (function() {
        tinymce.create('tinymce.plugins.hvp_video', {
            init : function(ed, url) {
                ed.addButton('hvp_video', {
                    title : 'Hola Video Player',
                    image : url+'/../images/hola_player.svg',
                    onclick : function() {
                        $('.hvp-popup-overlay').fadeIn();

                        var popupcontent = $('.hvp-popup-content');
                        popupcontent.fadeIn();
                        $('.hvp-popup-overlay').fadeIn();
                        $('html, body').animate({ scrollTop: popupcontent.offset().top - 80 }, 500);
                    }
                });
            },
            createControl : function(n, cm) {
                return null;
            },
        });
        tinymce.PluginManager.add('hvp_video', tinymce.plugins.hvp_video);
    })();

    //close popup window
    $(document).on("click", ".hvp-close-button, .hvp-popup-overlay", function() {
        $('.hvp-popup-overlay').fadeOut();
        $('.hvp-popup-content').fadeOut();
    });

    $(document).on("click", "#hvp-insert-shortcode", function() {
        var hvpshortcode = 'hvp-video';
        var hvpshortcodestr = '';

        var analytics = $('#hvp-analytics-optin')[0];
        if (analytics && analytics.checked) {
            window.hvp.create_lead();
        }

        hvpSwitchDefaultEditorVisual();
        var hvp_vid_url = $('#hvp-video-url').val();
        var hvp_ads_url = $('#hvp-ads-url').val();
        var hvp_width = $('#hvp-width').val();
        var hvp_height = $('#hvp-height').val();
        var hvp_poster = $('#hvp-poster').val();
        var hvp_class = $('#hvp-class').val();
        var hvp_template = $('#hvp-template').val();
        var hvp_video_control = $('#hvp-video-control').is(':checked');
        var hvp_autoplay = $('#hvp-autoplay').is(':checked');
        var hvp_loop = $('#hvp-loop').is(':checked');
        var hvp_mute = $('#hvp-mute').is(':checked');
        var hvp_ytcontrol = $('#hvp-ytcontrol').is(':checked');

        hvpshortcodestr += '['+hvpshortcode;
        if(hvp_vid_url != '')
            hvpshortcodestr += ' url="'+hvp_vid_url+'"';
        if(hvp_ads_url != '' && $('#hvp-video-ads').is(':checked')) {
            hvpshortcodestr += ' adtagurl="'+hvp_ads_url+'"';
        }
        if(hvp_width != '')
            hvpshortcodestr += ' width="'+hvp_width+'"';
        if(hvp_height != '')
            hvpshortcodestr += ' height="'+hvp_height+'"';
        if(hvp_poster != '')
            hvpshortcodestr += ' poster="'+hvp_poster+'"';
        if(hvp_class != '')
            hvpshortcodestr += ' class="'+hvp_class+'"';
        if(hvp_template != 'hola-skin' && hvp_template != '')
            hvpshortcodestr += ' template="'+hvp_template+'"';
        hvpshortcodestr += ' controls="'+hvp_video_control+'"';
        hvpshortcodestr += ' autoplay="'+hvp_autoplay+'"';
        hvpshortcodestr += ' loop="'+hvp_loop+'"';
        hvpshortcodestr += ' muted="'+hvp_mute+'"';
        hvpshortcodestr += ' ytcontrol="'+hvp_ytcontrol+'"';

        hvpshortcodestr += '][/'+hvpshortcode+']';
        //send_to_editor(hvpshortcodestr);
        //tinymce.get('content').execCommand('mceInsertContent',false, wpwfpshortcodestr);
        window.send_to_editor(hvpshortcodestr);
        jQuery('.hvp-popup-overlay').fadeOut();
        jQuery('.hvp-popup-content').fadeOut();

    });
});

//switch wordpress editor to visual mode
function hvpSwitchDefaultEditorVisual() {
    if (jQuery('#content').hasClass('html-active')) {
        switchEditors.go(editor, 'tinymce');
    }
}
