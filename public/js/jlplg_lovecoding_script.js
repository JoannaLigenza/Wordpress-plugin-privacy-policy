jQuery( document ).ready( function( $ ) { 
    function jlplg_lovecoding_setCookie() {
        const cookieAcceptButton = $('#cookie-accept-button');
        if (cookieAcceptButton !== null) {
            cookieAcceptButton.on('click', function(e) {
                e.preventDefault();
                $.ajax({
                url     :   jlplg_lovecoding_script_ajax_object.ajax_url,   // wp_localize_script -> jlplg_lovecoding_script_ajax_object.ajax_url
                method  :   'post',
                dataType:   'json',
                data    :   { action: 'set_cookie_ajax' },
                success :   function(response) {
                                if (response === 'cookies-added') {
                                    $('#jlplg-lovecoding-cookie-info-container').css('display', 'none');
                                }
                },
                error   :   function(){
                                console.log('connection error ');
                }
                });
            });
        }
    }
    jlplg_lovecoding_setCookie();
});
