
if (empty(is_mobile_skin))
    var is_mobile_skin = 0;

if (empty(app_ios_id)) {
    var app_ios_id = 585178888; // tapatalk 2, 307880732 for tapatalk 1
    var app_ios_hd_id = 481579541;
} else {
    var app_ios_hd_id = app_ios_id;
}

if (app_ios_id == '-1')
{
    var app_ios_url = '-1';
    var app_ios_hd_url = '-1';
}
else
{
    var app_ios_url = 'https://itunes.apple.com/us/app/id'+app_ios_id;
    var app_ios_hd_url = 'https://itunes.apple.com/us/app/id'+app_ios_hd_id;
}

if (empty(app_android_url)) {
    var app_android_url = "market://details?id=com.quoord.tapatalkpro.activity";
    var app_android_hd_url = "market://details?id=com.quoord.tapatalkHD";
} else {
    var app_android_hd_url = app_android_url;
}

if (empty(app_kindle_url)) {
    var app_kindle_url = "http://www.amazon.com/gp/mas/dl/android?p=com.quoord.tapatalkpro.activity";
    var app_kindle_hd_url = "http://www.amazon.com/gp/mas/dl/android?p=com.quoord.tapatalkHD";
} else {
    var app_kindle_hd_url = app_kindle_url;
}

if (empty(app_location_url))
    var app_location_url = "tapatalk://";

if (empty(app_forum_name))
    var app_forum_name = "this forum";

if (empty(app_banner_message))
    var app_banner_message = "Follow {your_forum_name} <br /> with {app_name} for [os_platform]";


// Support native iOS Smartbanner
var native_ios_banner = false;
if (app_ios_id != '-1' && navigator.userAgent.match(/Safari/i) != null &&
    (navigator.userAgent.match(/CriOS/i) == null && window.Number(navigator.userAgent.substr(navigator.userAgent.indexOf('OS ') + 3, 3).replace('_', '.')) >= 6))
{
    app_location_url = "tapatalk://";   // hard code for tapatalk 1 issue
    
    if (navigator.userAgent.match(/iPad/i) != null)
    {
        document.write('<meta name="apple-itunes-app" content="app-id='+app_ios_hd_id+',app-argument="'+app_location_url+'">');
        native_ios_banner = true;
    }
    else if (navigator.userAgent.match(/iPod|iPhone/i) != null)
    {
        document.write('<meta name="apple-itunes-app" content="app-id='+app_ios_id+',app-argument='+app_location_url+'">');
        native_ios_banner = true;
    }
}


function tapatalkDetect()
{
    var standalone = navigator.standalone // Check if it's already a standalone web app or running within a webui view of an app (not mobile safari)
    
    // work only when browser support cookie
    if (!navigator.cookieEnabled 
        || standalone
        || document.cookie.indexOf("banner-closed=true") >= 0 
        || native_ios_banner)
        return
    
    app_banner_message = app_banner_message.replace(/\{your_forum_name\}/gi, app_forum_name);
    app_banner_message = app_banner_message.replace(/\{app_name\}/gi, 'Tapatalk');
    
    var app_install_url = '';
    if (navigator.userAgent.match(/iPhone|iPod/i)) {
        app_banner_message = app_banner_message.replace(/\[os_platform\]/gi, 'iPhone');
        app_install_url = app_ios_url;
        app_location_url = "tapatalk://";   // hard code for tapatalk 1 issue
    }
    else if (navigator.userAgent.match(/iPad/i)) {
        app_banner_message = app_banner_message.replace(/\[os_platform\]/gi, 'iPad');
        app_install_url = app_ios_hd_url;
        app_location_url = "tapatalk://";   // hard code for tapatalk 1 issue
    }
    else if (navigator.userAgent.match(/Silk/)) {
        if (navigator.userAgent.match(/Android 2/i)) {
            app_banner_message = app_banner_message.replace(/\[os_platform\]/gi, 'Kindle');
            app_install_url = app_kindle_url;
        }
        else if (navigator.userAgent.match(/Android 4/i)) {
            app_banner_message = app_banner_message.replace(/\[os_platform\]/gi, 'Kindle');
            app_install_url = app_kindle_hd_url;
        }
    }
    else if (navigator.userAgent.match(/Android/i)) {
        if(navigator.userAgent.match(/mobile/i)) {
            app_banner_message = app_banner_message.replace(/\[os_platform\]/gi, 'Android');
            app_install_url = app_android_url ;
        }
        else {
            app_banner_message = app_banner_message.replace(/\[os_platform\]/gi, 'Android');
            app_install_url = app_android_hd_url;
        }
    }
    else if (navigator.userAgent.match(/BlackBerry/i)) {
        app_banner_message = app_banner_message.replace(/\[os_platform\]/gi, 'BlackBerry');
        app_install_url = "http://appworld.blackberry.com/webstore/content/46654?lang=en";
    }
    else
        return
    
    
    if (app_install_url == '-1') return
    
    htmlElement = document.getElementsByTagName("html")[0]
    origHtmlMargin = parseFloat(htmlElement.style.marginTop)
    if ( isNaN(origHtmlMargin)) origHtmlMargin = 0
    
    var bannerScale = document.body.clientWidth / window.screen.width
    
    if (bannerScale < 1 || (is_mobile_skin && navigator.userAgent.match(/mobile/i))) bannerScale = 1;
        
    // mobile portrait mode may need bigger scale
    if (window.innerWidth < window.innerHeight)
    {
        if (navigator.userAgent.match(/mobile/i) && bannerScale < 2 && !is_mobile_skin && document.body.clientWidth > 600) {
            bannerScale = 2
        } else if (bannerScale > 2.8) {
            bannerScale = 2.8
        }
    }
    else
    {
        if (navigator.userAgent.match(/mobile/i) && bannerScale < 1.5 && !is_mobile_skin && document.body.clientWidth > 600) {
            bannerScale = 1.5
        } else if (bannerScale > 2) {
            bannerScale = 2
        }
    }
    
    
    bodyItem = document.body
    appBanner = document.createElement("div")
    appBanner.id = "mobile_banner"
    appBanner.className = "mobile_banner banner_format_handset banner_device_android banner_theme_light mobile_banner_animate"
    appBanner.innerHTML = 
                    '<div class="mobile_banner_inner">'+
                        '<span class="mobile_banner_icon"></span>'+
                        '<div class="mobile_banner_body">'+
                            '<h3 class="mobile_banner_heading">'+app_banner_message+'</h3>'+
                        '</div>'+
                        '<div class="mobile_banner_controls">'+
                            '<a class="mobile_banner_button chrome white mobile_banner_open" href="'+app_location_url+'" id="mobile_banner_open">'+'Open in app'+'</a>'+
                            '<a class="mobile_banner_button chrome blue mobile_banner_install" href="'+app_install_url+'" id="mobile_banner_install">'+'Install'+'</a>'+
                            '<a class="mobile_banner_close" href="#" onclick="closeBanner()" id="mobile_banner_close">x</a>'+
                        '</div>'+
                    '</div>'
    bodyItem.insertBefore(appBanner, bodyItem.firstChild)
    
    if (bannerScale > 1) {
        appBanner.style.fontSize = (8*bannerScale)+"px"
    }
    
    bannerHeight = getWH(appBanner, 'height', true)
    htmlElement.style.marginTop = (origHtmlMargin+bannerHeight)+"px"
    
    if (getComputedStyle(bodyItem, null).position !== 'static')
        appBanner.style.top = -1*(origHtmlMargin+bannerHeight)+"px"
}

function closeBanner()
{
    bodyItem.removeChild( appBanner )
    htmlElement.style.marginTop = origHtmlMargin+"px"
    setBannerCookies('banner-closed', 'true', 90)
}

function setBannerCookies(name, value, exdays)
{
    var exdate = new Date();
    exdate.setDate(exdate.getDate()+exdays);
    value=escape(value)+((exdays==null)?'':'; expires='+exdate.toUTCString());
    document.cookie=name+'='+value+'; path=/;';
}

function empty(a){
    if(typeof(a) == "undefined" || a == '') {
        return true;
    }
    if(a == '0' || a == false) {
        return true;
    }
    return false;
}

/* to get element outer height */

var defView = document.defaultView;

var getStyle = defView && defView.getComputedStyle ?
    function( elem ) {
      return defView.getComputedStyle( elem, null );
    }
    :
    function( elem ) {
      return elem.currentStyle;
    };

function hackPercentMargin( elem, computedStyle, marginValue ) {
    if ( marginValue.indexOf('%') === -1 ) {
        return marginValue;
    }

    var elemStyle = elem.style,
        originalWidth = elemStyle.width,
        ret;

    // get measure by setting it on elem's width
    elemStyle.width = marginValue;
    ret = computedStyle.width;
    elemStyle.width = originalWidth;

    return ret;
}

function getWH( elem, measure, isOuter )
{
    // Start with offset property
    var isWidth = measure !== 'height',
        val = isWidth ? elem.offsetWidth : elem.offsetHeight,
        dirA = isWidth ? 'Left' : 'Top',
        dirB = isWidth ? 'Right' : 'Bottom',
        computedStyle = getStyle( elem ),
        paddingA = parseFloat( computedStyle[ 'padding' + dirA ] ) || 0,
        paddingB = parseFloat( computedStyle[ 'padding' + dirB ] ) || 0,
        borderA = parseFloat( computedStyle[ 'border' + dirA + 'Width' ] ) || 0,
        borderB = parseFloat( computedStyle[ 'border' + dirB + 'Width' ] ) || 0,
        computedMarginA = computedStyle[ 'margin' + dirA ],
        computedMarginB = computedStyle[ 'margin' + dirB ],
        marginA, marginB;

    var tmpDiv = document.createElement('div');
    tmpDiv.style.marginTop = '1%';
    bodyItem.appendChild( tmpDiv );
    var supportsPercentMargin = getStyle( tmpDiv ).marginTop !== '1%';
    bodyItem.removeChild( tmpDiv );

    if ( !supportsPercentMargin ) {
        computedMarginA = hackPercentMargin( elem, computedStyle, computedMarginA );
        computedMarginB = hackPercentMargin( elem, computedStyle, computedMarginB );
    }

    marginA = parseFloat( computedMarginA ) || 0;
    marginB = parseFloat( computedMarginB ) || 0;

    if ( val > 0 ) {

        if ( isOuter ) {
            // outerWidth, outerHeight, add margin
            val += marginA + marginB;
        } else {
            // like getting width() or height(), no padding or border
            val -= paddingA + paddingB + borderA + borderB;
        }

    } else {

        // Fall back to computed then uncomputed css if necessary
        val = computedStyle[ measure ];
        if ( val < 0 || val === null ) {
            val = elem.style[ measure ] || 0;
        }
        // Normalize "", auto, and prepare for extra
        val = parseFloat( val ) || 0;
        
        if ( isOuter ) {
            // Add padding, border, margin
            val += paddingA + paddingB + marginA + marginB + borderA + borderB;
        }
    }

    return val;
}
