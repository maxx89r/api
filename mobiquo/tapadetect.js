function detectTapatalk()
{
    var tapatalk_alert_message = '';
    var tapatalk_alert_url = '';
    if (navigator.userAgent.match(/iPhone|iPod/i)) {
        tapatalk_alert_message = tapatalk_iphone_msg;
        tapatalk_alert_url = tapatalk_iphone_url;
    }
    else if (navigator.userAgent.match(/iPad/i)) {
        tapatalk_alert_message = tapatalk_ipad_msg;
        tapatalk_alert_url = tapatalk_ipad_url;
    }
    else if (navigator.userAgent.match(/Silk/)) {
        if (navigator.userAgent.match(/Android 2/i)) {
            tapatalk_alert_message = tapatalk_kindle_msg;
            tapatalk_alert_url = tapatalk_kindle_url;
        }
        else if (navigator.userAgent.match(/Android 4/i)) {
            tapatalk_alert_message = tapatalk_kindle_hd_msg;
            tapatalk_alert_url = tapatalk_kindle_hd_url;
        }
    }
    else if (navigator.userAgent.match(/Android/i)) {
        if(navigator.userAgent.match(/mobile/i)) {
            tapatalk_alert_message = tapatalk_android_msg;
            tapatalk_alert_url = tapatalk_android_url;
        }
        else {
            tapatalk_alert_message = tapatalk_android_hd_msg;
            tapatalk_alert_url = tapatalk_android_hd_url;
        }
    }
    else if (navigator.userAgent.match(/BlackBerry/i)) {
        tapatalk_alert_message = "This forum has an app for BlackBerry! Click OK to learn more about Tapatalk.";
        tapatalk_alert_url = "http://appworld.blackberry.com/webstore/content/46654?lang=en";
    }
    
    if (tapatalk_alert_message && confirm(tapatalk_alert_message))
        window.location = tapatalk_alert_url;
}

function setTapatalkCookies()
{
    var date = new Date();
    var days = 90;
    date.setTime(date.getTime()+(days*24*60*60*1000));
    var expires = "; expires="+ date.toGMTString();
    var domain = "; path=/";
    document.cookie = "tapatalk_redirect=false" + expires + domain;
}

if (navigator.cookieEnabled && document.cookie.indexOf("tapatalk_redirect=false") < 0)
{
    detectTapatalk();
    setTapatalkCookies();
}