document.addEventListener('DOMContentLoaded', (event) => {
    
    const setCookie = () => {
        const cookieAcceptButton = document.getElementById('cookie-accept-button');
        if (cookieAcceptButton !== null) {
            cookieAcceptButton.addEventListener('click', function(e) {
                e.preventDefault();
                // set cookie
                let date = new Date();
                date.setDate(new Date().getDate() + 14);
                document.cookie = `cookie-accepted=1; expires=${date.toUTCString()}`;
                // hide cookie info
                const cookieInfo = document.getElementById('jlplg-prvpol-cookie-info-container');
                cookieInfo.style.display = 'none';
            });
        }
    }
    setCookie();
});