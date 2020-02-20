jQuery( document ).ready( function( $ ) { 
    function setCookie() {
        const cookieAcceptButton = $('#cookie-accept-button');
        if (cookieAcceptButton !== null) {
            cookieAcceptButton.on('click', function(e) {
                e.preventDefault();
                const cookieAcceptButton = $('#cookie-accept-button').attr('name');
                $.ajax({
                url     :   jlplg_prvpol_script_ajax_object.ajax_url,   // wp_localize_script -> jlplg_prvpol_script_ajax_object.ajax_url
                method  :   'post',
                dataType:   'json',
                data    :   { cookieAcceptButton: cookieAcceptButton, action: 'set_cookie_ajax' },      // action: function, that is invoked by ajax (full name: jlplg_prvpol_set_cookie_ajax)
                success :   function(response) {
                                if (response === 'cookies-added') {
                                    $('#jlplg-prvpol-cookie-info-container').css('display', 'none');
                                }
                },
                error   :   function(){
                                console.log('connection error ');
                }
                })
                // 
            });
        }
    }
    setCookie();
});





// document.addEventListener('DOMContentLoaded', (e) => {
    
//     const setCookie = () => {
//         const cookieAcceptButton = document.getElementById('cookie-accept-button');
//         if (cookieAcceptButton !== null) {
//             cookieAcceptButton.addEventListener('click', function(e) {
//                 e.preventDefault();
//                 // set cookie (encodeURI -> sanitize cookie name)
//                 let date = new Date();
//                 date.setDate(new Date().getDate() + 14);
//                 document.cookie = encodeURI(`cookie-accepted=1; expires=${date.toUTCString()}`);
//                 // hide cookie info
//                 const cookieInfo = document.getElementById('jlplg-prvpol-cookie-info-container');
//                 cookieInfo.style.display = 'none';
//             });
//         }
//     }
//     setCookie();

// });

