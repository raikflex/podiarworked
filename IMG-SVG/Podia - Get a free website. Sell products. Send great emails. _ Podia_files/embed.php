window.cfields = [];
window._show_thank_you = function(id, message, trackcmp_url, email) {
    var form = document.getElementById('_form_' + id + '_'), thank_you = form.querySelector('._form-thank-you');
    form.querySelector('._form-content').style.display = 'none';
    thank_you.innerHTML = message;
    thank_you.style.display = 'block';
    const vgoAlias = typeof visitorGlobalObjectAlias === 'undefined' ? 'vgo' : visitorGlobalObjectAlias;
    var visitorObject = window[vgoAlias];
    if (email && typeof visitorObject !== 'undefined') {
        visitorObject('setEmail', email);
        visitorObject('update');
    } else if (typeof(trackcmp_url) != 'undefined' && trackcmp_url) {
        // Site tracking URL to use after inline form submission.
        _load_script(trackcmp_url);
    }
    if (typeof window._form_callback !== 'undefined') window._form_callback(id);
};
window._show_unsubscribe = function(id, message, trackcmp_url, email) {
    var form = document.getElementById('_form_' + id + '_'), unsub = form.querySelector('._form-thank-you');
    var branding = form.querySelector('._form-branding');
    if (branding) {
        branding.style.display = 'none';
    }
    form.querySelector('._form-content').style.display = 'none';
    unsub.style.display = 'block';
    form.insertAdjacentHTML('afterend', message)
    const vgoAlias = typeof visitorGlobalObjectAlias === 'undefined' ? 'vgo' : visitorGlobalObjectAlias;
    var visitorObject = window[vgoAlias];
    if (email && typeof visitorObject !== 'undefined') {
        visitorObject('setEmail', email);
        visitorObject('update');
    } else if (typeof(trackcmp_url) != 'undefined' && trackcmp_url) {
        // Site tracking URL to use after inline form submission.
        _load_script(trackcmp_url);
    }
    if (typeof window._form_callback !== 'undefined') window._form_callback(id);
};
window._show_error = function(id, message, html) {
    var form = document.getElementById('_form_' + id + '_'),
        err = document.createElement('div'),
        button = form.querySelector('button'),
        old_error = form.querySelector('._form_error');
    if (old_error) old_error.parentNode.removeChild(old_error);
    err.innerHTML = message;
    err.className = '_error-inner _form_error _no_arrow';
    var wrapper = document.createElement('div');
    wrapper.className = '_form-inner';
    wrapper.appendChild(err);
    button.parentNode.insertBefore(wrapper, button);
    var submitButton = form.querySelector('[id^="_form"][id$="_submit"]');
    submitButton.disabled = false;
    submitButton.classList.remove('processing');
    if (html) {
        var div = document.createElement('div');
        div.className = '_error-html';
        div.innerHTML = html;
        err.appendChild(div);
    }
};
window._show_pc_confirmation = function(id, header, detail, show, email) {
    var form = document.getElementById('_form_' + id + '_'), pc_confirmation = form.querySelector('._form-pc-confirmation');
    if (pc_confirmation.style.display === 'none') {
        form.querySelector('._form-content').style.display = 'none';
        pc_confirmation.innerHTML = "<div class='_form-title'>" + header + "</div>" + "<p>" + detail + "</p>" +
        "<button class='_submit' id='hideButton'>Manage preferences</button>";    
        pc_confirmation.style.display = 'block';
        var mp = document.querySelector('input[name="mp"]');
        mp.value = '0';
    } else {
        form.querySelector('._form-content').style.display = 'inline';
        pc_confirmation.style.display = 'none';
    }

    var hideButton = document.getElementById('hideButton');
    // Add event listener to the button
    hideButton.addEventListener('click', function() {
        var submitButton = document.querySelector('#_form_10_submit');
        submitButton.disabled = false;
        submitButton.classList.remove('processing');
        var mp = document.querySelector('input[name="mp"]');
        mp.value = '1';
        window.location.href = window.location.href;
    });

    const vgoAlias = typeof visitorGlobalObjectAlias === 'undefined' ? 'vgo' : visitorGlobalObjectAlias;
    var visitorObject = window[vgoAlias];
    if (email && typeof visitorObject !== 'undefined') {
        visitorObject('setEmail', email);
        visitorObject('update');
    } else if (typeof(trackcmp_url) != 'undefined' && trackcmp_url) {
        // Site tracking URL to use after inline form submission.
        _load_script(trackcmp_url);
    }
    if (typeof window._form_callback !== 'undefined') window._form_callback(id);
};
window._load_script = function(url, callback, isSubmit) {
    var head = document.querySelector('head'), script = document.createElement('script'), r = false;
    var submitButton = document.querySelector('#_form_10_submit');
    script.charset = 'utf-8';
    script.src = url;
    if (callback) {
        script.onload = script.onreadystatechange = function() {
            if (!r && (!this.readyState || this.readyState == 'complete')) {
                r = true;
                callback();
            }
        };
    }
    script.onerror = function() {
        if (isSubmit) {
            if (script.src.length > 10000) {
                _show_error("6697BACD04C60", "Sorry, your submission failed. Please shorten your responses and try again.");
            } else {
                _show_error("6697BACD04C60", "Sorry, your submission failed. Please try again.");
            }
            submitButton.disabled = false;
            submitButton.classList.remove('processing');
        }
    }

    head.appendChild(script);
};
(function() {
    if (window.location.search.search("excludeform") !== -1) return false;
    var getCookie = function(name) {
        var match = document.cookie.match(new RegExp('(^|; )' + name + '=([^;]+)'));
        return match ? match[2] : null;
    }
    var setCookie = function(name, value) {
        var now = new Date();
        var time = now.getTime();
        var expireTime = time + 1000 * 60 * 60 * 24 * 365;
        now.setTime(expireTime);
        document.cookie = name + '=' + value + '; expires=' + now + ';path=/; Secure; SameSite=Lax;';
    }
        var cookie = getCookie('_form_10_');
    if (cookie) {
        var cookie_date = new Date(Date.parse(cookie));
        var reveal_on_date = new Date(cookie_date);
        var now = new Date();
        reveal_on_date.setDate(cookie_date.getDate() + parseInt('14', 10));
        if (reveal_on_date > now) {
            return;
        }
    }
            var addEvent = function(element, event, func) {
        if (element.addEventListener) {
            element.addEventListener(event, func);
        } else {
            var oldFunc = element['on' + event];
            element['on' + event] = function() {
                oldFunc.apply(this, arguments);
                func.apply(this, arguments);
            };
        }
    }
    var _removed = false;
    var _form_output = '\<style\>@import url(https:\/\/fonts.bunny.net\/css?family=ibm-plex-sans:400,600);\<\/style\>\<style\>\n#_form_6697BACD04C60_{font-size:14px;line-height:1.6;font-family:arial, helvetica, sans-serif;margin:0}#_form_6697BACD04C60_ *{outline:0}._form_hide{display:none;visibility:hidden}._form_show{display:block;visibility:visible}#_form_6697BACD04C60_._form-top{top:0}#_form_6697BACD04C60_._form-bottom{bottom:0}#_form_6697BACD04C60_._form-left{left:0}#_form_6697BACD04C60_._form-right{right:0}#_form_6697BACD04C60_ input[type=\"text\"],#_form_6697BACD04C60_ input[type=\"tel\"],#_form_6697BACD04C60_ input[type=\"date\"],#_form_6697BACD04C60_ textarea{padding:6px;height:auto;border:#979797 1px solid;border-radius:4px;color:#000000 !important;font-size:14px;-webkit-box-sizing:border-box;-moz-box-sizing:border-box;box-sizing:border-box}#_form_6697BACD04C60_ textarea{resize:none}#_form_6697BACD04C60_ ._submit{-webkit-appearance:none;cursor:pointer;font-family:arial, sans-serif;font-size:14px;text-align:center;background:#5008CC !important;border:0 !important;-moz-border-radius:4px !important;-webkit-border-radius:4px !important;border-radius:4px !important;color:#FFFFFF !important;padding:7px !important}#_form_6697BACD04C60_ ._submit:disabled{cursor:not-allowed;opacity:0.4}#_form_6697BACD04C60_ ._submit.processing{position:relative}#_form_6697BACD04C60_ ._submit.processing::before{content:\"\";width:1em;height:1em;position:absolute;z-index:1;top:50%;left:50%;border:double 3px transparent;border-radius:50%;background-image:linear-gradient(#5008CC, #5008CC), conic-gradient(#5008CC, #FFFFFF);background-origin:border-box;background-clip:content-box, border-box;animation:1200ms ease 0s infinite normal none running _spin}#_form_6697BACD04C60_ ._submit.processing::after{content:\"\";position:absolute;top:0;bottom:0;left:0;right:0;background:#5008CC !important;border:0 !important;-moz-border-radius:4px !important;-webkit-border-radius:4px !important;border-radius:4px !important;color:#FFFFFF !important;padding:7px !important}@keyframes _spin{0%{transform:translate(-50%, -50%) rotate(90deg)}100%{transform:translate(-50%, -50%) rotate(450deg)}}#_form_6697BACD04C60_ ._close-icon{cursor:pointer;background-image:url(\"https:\/\/d226aj4ao1t61q.cloudfront.net\/esfkyjh1u_forms-close-dark.png\");background-repeat:no-repeat;background-size:14.2px 14.2px;position:absolute;display:block;top:11px;right:9px;overflow:hidden;width:16.2px;height:16.2px}#_form_6697BACD04C60_ ._close-icon:before{position:relative}#_form_6697BACD04C60_ ._form-body{margin-bottom:30px}#_form_6697BACD04C60_ ._form-image-left{width:150px;float:left}#_form_6697BACD04C60_ ._form-content-right{margin-left:164px}#_form_6697BACD04C60_ ._form-branding{color:#fff;font-size:10px;clear:both;text-align:left;margin-top:30px;font-weight:100}#_form_6697BACD04C60_ ._form-branding ._logo{display:block;width:130px;height:14px;margin-top:6px;background-image:url(\"https:\/\/d226aj4ao1t61q.cloudfront.net\/hh9ujqgv5_aclogo_li.png\");background-size:130px auto;background-repeat:no-repeat}#_form_6697BACD04C60_ .form-sr-only{position:absolute;width:1px;height:1px;padding:0;margin:-1px;overflow:hidden;clip:rect(0, 0, 0, 0);border:0}#_form_6697BACD04C60_ ._form-label,#_form_6697BACD04C60_ ._form_element ._form-label{font-weight:bold;margin-bottom:5px;display:block}#_form_6697BACD04C60_._dark ._form-branding{color:#333}#_form_6697BACD04C60_._dark ._form-branding ._logo{background-image:url(\"https:\/\/d226aj4ao1t61q.cloudfront.net\/jftq2c8s_aclogo_dk.png\")}#_form_6697BACD04C60_ ._form_element{position:relative;margin-bottom:10px;font-size:0;max-width:100%}#_form_6697BACD04C60_ ._form_element *{font-size:14px}#_form_6697BACD04C60_ ._form_element._clear{clear:both;width:100%;float:none}#_form_6697BACD04C60_ ._form_element._clear:after{clear:left}#_form_6697BACD04C60_ ._form_element input[type=\"text\"],#_form_6697BACD04C60_ ._form_element input[type=\"date\"],#_form_6697BACD04C60_ ._form_element select,#_form_6697BACD04C60_ ._form_element textarea:not(.g-recaptcha-response){display:block;width:100%;-webkit-box-sizing:border-box;-moz-box-sizing:border-box;box-sizing:border-box;font-family:inherit}#_form_6697BACD04C60_ ._field-wrapper{position:relative}#_form_6697BACD04C60_ ._inline-style{float:left}#_form_6697BACD04C60_ ._inline-style input[type=\"text\"]{width:150px}#_form_6697BACD04C60_ ._inline-style:not(._clear)+._inline-style:not(._clear){margin-left:20px}#_form_6697BACD04C60_ ._form_element img._form-image{max-width:100%}#_form_6697BACD04C60_ ._form_element ._form-fieldset{border:0;padding:0.01em 0 0 0;margin:0;min-width:0}#_form_6697BACD04C60_ ._clear-element{clear:left}#_form_6697BACD04C60_ ._full_width{width:100%}#_form_6697BACD04C60_ ._form_full_field{display:block;width:100%;margin-bottom:10px}#_form_6697BACD04C60_ input[type=\"text\"]._has_error,#_form_6697BACD04C60_ textarea._has_error{border:#F37C7B 1px solid}#_form_6697BACD04C60_ input[type=\"checkbox\"]._has_error{outline:#F37C7B 1px solid}#_form_6697BACD04C60_ ._error{display:block;position:absolute;font-size:14px;z-index:10000001}#_form_6697BACD04C60_ ._error._above{padding-bottom:4px;bottom:39px;right:0}#_form_6697BACD04C60_ ._error._below{padding-top:8px;top:100%;right:0}#_form_6697BACD04C60_ ._error._above ._error-arrow{bottom:-4px;right:15px;border-left:8px solid transparent;border-right:8px solid transparent;border-top:8px solid #FFDDDD}#_form_6697BACD04C60_ ._error._below ._error-arrow{top:0;right:15px;border-left:8px solid transparent;border-right:8px solid transparent;border-bottom:8px solid #FFDDDD}#_form_6697BACD04C60_ ._error-inner{padding:12px 12px 12px 36px;background-color:#FFDDDD;background-image:url(\"data:image\/svg+xml,%3Csvg width=\'16\' height=\'16\' viewBox=\'0 0 16 16\' fill=\'none\' xmlns=\'http:\/\/www.w3.org\/2000\/svg\'%3E%3Cpath fill-rule=\'evenodd\' clip-rule=\'evenodd\' d=\'M16 8C16 12.4183 12.4183 16 8 16C3.58172 16 0 12.4183 0 8C0 3.58172 3.58172 0 8 0C12.4183 0 16 3.58172 16 8ZM9 3V9H7V3H9ZM9 13V11H7V13H9Z\' fill=\'%23CA0000\'\/%3E%3C\/svg%3E\");background-repeat:no-repeat;background-position:12px center;font-size:14px;font-family:arial, sans-serif;font-weight:600;line-height:16px;color:#000;text-align:center;text-decoration:none;-webkit-border-radius:4px;-moz-border-radius:4px;border-radius:4px;box-shadow:0px 1px 4px rgba(31, 33, 41, 0.298295)}#_form_6697BACD04C60_ ._error-inner._form_error{margin-bottom:5px;text-align:left}#_form_6697BACD04C60_ ._button-wrapper ._error-inner._form_error{position:static}#_form_6697BACD04C60_ ._error-inner._no_arrow{margin-bottom:10px}#_form_6697BACD04C60_ ._error-arrow{position:absolute;width:0;height:0}#_form_6697BACD04C60_ ._error-html{margin-bottom:10px}.pika-single{z-index:10000001 !important}#_form_6697BACD04C60_ input[type=\"text\"].datetime_date{width:69%;display:inline}#_form_6697BACD04C60_ select.datetime_time{width:29%;display:inline;height:32px}#_form_6697BACD04C60_ input[type=\"date\"].datetime_date{width:69%;display:inline-flex}#_form_6697BACD04C60_ input[type=\"time\"].datetime_time{width:29%;display:inline-flex}._form-wrapper{z-index:9999999}#_form_6697BACD04C60_._animated{-webkit-animation-duration:1s;animation-duration:1s;-webkit-animation-fill-mode:both;animation-fill-mode:both}#_form_6697BACD04C60_._animated._fast{-webkit-animation-duration:0.4s;animation-duration:0.4s}@-webkit-keyframes _fadeIn{0%{opacity:0}100%{opacity:1}}@keyframes _fadeIn{0%{opacity:0}100%{opacity:1}}#_form_6697BACD04C60_._fadeIn{-webkit-animation-name:_fadeIn;animation-name:_fadeIn}@media (min-width:320px) and (max-width:667px){::-webkit-scrollbar{display:none}#_form_6697BACD04C60_{margin:0;width:100%;min-width:100%;max-width:100%;box-sizing:border-box}#_form_6697BACD04C60_ *{-webkit-box-sizing:border-box;-moz-box-sizing:border-box;box-sizing:border-box;font-size:1em}#_form_6697BACD04C60_ ._form-content{margin:0;width:100%}#_form_6697BACD04C60_ ._form-inner{display:block;min-width:100%}#_form_6697BACD04C60_ ._form-title,#_form_6697BACD04C60_ ._inline-style{margin-top:0;margin-right:0;margin-left:0}#_form_6697BACD04C60_ ._form-title{font-size:1.2em}#_form_6697BACD04C60_ ._form_element{margin:0 0 20px;padding:0;width:100%}#_form_6697BACD04C60_ ._form-element,#_form_6697BACD04C60_ ._inline-style,#_form_6697BACD04C60_ input[type=\"text\"],#_form_6697BACD04C60_ label,#_form_6697BACD04C60_ p,#_form_6697BACD04C60_ textarea:not(.g-recaptcha-response){float:none;display:block;width:100%}#_form_6697BACD04C60_ ._row._checkbox-radio label{display:inline}#_form_6697BACD04C60_ ._row,#_form_6697BACD04C60_ p,#_form_6697BACD04C60_ label{margin-bottom:0.7em;width:100%}#_form_6697BACD04C60_ ._row input[type=\"checkbox\"],#_form_6697BACD04C60_ ._row input[type=\"radio\"]{margin:0 !important;vertical-align:middle !important}#_form_6697BACD04C60_ ._row input[type=\"checkbox\"]+span label{display:inline}#_form_6697BACD04C60_ ._row span label{margin:0 !important;width:initial !important;vertical-align:middle !important}#_form_6697BACD04C60_ ._form-image{max-width:100%;height:auto !important}#_form_6697BACD04C60_ input[type=\"text\"]{padding-left:10px;padding-right:10px;font-size:16px;line-height:1.3em;-webkit-appearance:none}#_form_6697BACD04C60_ input[type=\"radio\"],#_form_6697BACD04C60_ input[type=\"checkbox\"]{display:inline-block;width:1.3em;height:1.3em;font-size:1em;margin:0 0.3em 0 0;vertical-align:baseline}#_form_6697BACD04C60_ button[type=\"submit\"]{padding:20px;font-size:1.5em}#_form_6697BACD04C60_ ._inline-style{margin:20px 0 0 !important}}#_form_6697BACD04C60_{text-align:center;position:fixed;bottom:0;margin:0;padding:20px;overflow:visible;outline:none;box-shadow:0 1px 13px rgba(0, 0, 0, 0.3);z-index:10000000;-webkit-box-sizing:border-box;-moz-box-sizing:border-box;box-sizing:border-box;background:#FFFFFF !important;width:330px;color:#000000 !important}#_form_6697BACD04C60_._floating-box{font-family:\"IBM Plex Sans\", Helvetica, sans-serif, \"IBM Plex Sans\", arial, sans-serif;padding:20px;-moz-border-radius:4px;-webkit-border-radius:4px;border-radius:4px;-moz-box-shadow:0px 1px 13px 0px rgba(0, 0, 0, 0.3);-webkit-box-shadow:0px 1px 13px 0px rgba(0, 0, 0, 0.3);box-shadow:0px 1px 13px 0px rgba(0, 0, 0, 0.3)}#_form_6697BACD04C60_._floating-box input{background:#FFFFFF;color:#5D5D5D !important;-moz-border-radius:4px;-webkit-border-radius:4px;border-radius:4px;font-family:\"IBM Plex Sans\", Helvetica, sans-serif, \"IBM Plex Sans\", arial, sans-serif}#_form_6697BACD04C60_._floating-box input::placeholder{color:#5D5D5D}#_form_6697BACD04C60_._floating-box ._submit{font-family:\"IBM Plex Sans\", Helvetica, sans-serif, \"IBM Plex Sans\", arial, sans-serif}#_form_6697BACD04C60_ ._form-title{font-size:22px;line-height:22px;font-weight:600;margin-bottom:20px}#_form_6697BACD04C60_._image_left{width:464px;text-align:left}#_form_6697BACD04C60_ ._close{cursor:pointer;position:absolute;top:-16px;right:-18px;width:auto;margin:0;padding:18px;overflow:visible;background-color:#FFF;-moz-border-radius:100%;-webkit-border-radius:100%;border-radius:100%;outline:none;box-shadow:0 1px 5px rgba(0, 0, 0, 0.3);-webkit-box-sizing:border-box;-moz-box-sizing:border-box;box-sizing:border-box}#_form_6697BACD04C60_._form-right ._close{right:auto;left:-18px}#_form_6697BACD04C60_ ._form-thank-you{text-align:center;padding:20px;font-size:18px}#_form_6697BACD04C60_ ._form-element{position:relative}#_form_6697BACD04C60_ ._form-image{margin-bottom:20px}#_form_6697BACD04C60_ ._form-image-left ._form-image{margin-bottom:0}@-webkit-keyframes _slideInLeft{0%{-webkit-transform:translateX(-100%);transform:translateX(-100%);visibility:visible}100%{-webkit-transform:translateX(0);transform:translateX(0)}}@keyframes _slideInLeft{0%{-webkit-transform:translateX(-100%);transform:translateX(-100%);visibility:visible}100%{-webkit-transform:translateX(0);transform:translateX(0)}}#_form_6697BACD04C60_._slideInLeft{-webkit-animation-name:_slideInLeft;animation-name:_slideInLeft}@-webkit-keyframes _slideInRight{0%{-webkit-transform:translateX(100%);transform:translateX(100%);visibility:visible}100%{-webkit-transform:translateX(0);transform:translateX(0)}}@keyframes _slideInRight{0%{-webkit-transform:translateX(100%);transform:translateX(100%);visibility:visible}100%{-webkit-transform:translateX(0);transform:translateX(0)}}#_form_6697BACD04C60_._slideInRight{-webkit-animation-name:_slideInRight;animation-name:_slideInRight}@media (min-width:1px) and (max-width:667px){._form-wrapper{position:fixed;overflow-y:scroll;top:0;bottom:0}#_form_6697BACD04C60_{position:static;top:0;left:0;right:0;margin:30px auto;width:90%;min-width:90%;max-width:90%;-moz-border-radius:10px;-webkit-border-radius:10px;border-radius:10px}#_form_6697BACD04C60_ ._close{top:16px;right:8px}#_form_6697BACD04C60_ ._form-thank-you{position:static;top:initial;left:initial;margin:10px auto}#_form_6697BACD04C60_._form-right ._close{left:auto;right:12px}#_form_6697BACD04C60_ ._form-image-left,#_form_6697BACD04C60_ ._form-content-right{float:none;width:100%;margin:0}#_form_6697BACD04C60_ ._form-image-left{margin-bottom:20px}}\n\<\/style\>\n\n\<form method=\"POST\" action=\"https://podia37110.activehosted.com\/proc.php\" id=\"_form_6697BACD04C60_\" class=\"_form _form_10 _floating-box _animated _fast _dark _form-left\" novalidate\>\n    \<input type=\"hidden\" name=\"u\" value=\"6697BACD04C60\" \/\>\n    \<input type=\"hidden\" name=\"f\" value=\"10\" \/\>\n    \<input type=\"hidden\" name=\"s\" \/\>\n    \<input type=\"hidden\" name=\"c\" value=\"0\" \/\>\n    \<input type=\"hidden\" name=\"m\" value=\"0\" \/\>\n    \<input type=\"hidden\" name=\"act\" value=\"sub\" \/\>\n    \<input type=\"hidden\" name=\"v\" value=\"2\" \/\>\n    \<div class=\"_close\"\>\n        \<i class=\"_close-icon\"\>\<\/i\>\n    \<\/div\>\n            \<div class=\"_form-content\"\>\n                            \<img src=\"\/\/content.app-us1.com\/7bbvQ\/2024\/06\/27\/fc13ae83-13f9-4e06-ad33-fa5e727b99df.png\" class=\"_full_width _form-image\" \/\>\n                                        \<div class=\"_form-title\"\>Make a free lead magnet and find your people\<\/div\>\n                                        \<div class=\"_form-body\"\>Get your free guide to building an audience who loves your work.\<\/div\>\n                                        \<div class=\"_form-element\"\>\<label class=\"form-sr-only\" for=\"_field_name\"\>Type your name\<\/label\>\<input id=\"_field_name\" type=\"text\" name=\"name\" placeholder=\"Type your name\" class=\"_form_full_field _field_name\" \>\<\/div\>\n                                    \<div class=\"_form-element\"\>\<label class=\"form-sr-only\" for=\"_field_email\"\>Type your email\<\/label\>\<input id=\"_field_email\" type=\"text\" name=\"email\" placeholder=\"Type your email\" class=\"_form_full_field _field_email\" required\>\<\/div\>\n                            \<button id=\"_form_10_submit\" type=\"submit\" class=\"_submit _full_width\"\>Get the free guide!\<\/button\>\n                    \<\/div\>\n        \<div class=\"_form-thank-you\" style=\"display:none;\"\>\<\/div\>\n    \<\/form\>\n';
        var _form_outer = document.createElement('div');
    _form_outer.className = '_form-wrapper';
    _form_outer.innerHTML = _form_output;
    if (!document.body) { document.firstChild.appendChild(document.createElement('body')); }
    document.body.appendChild(_form_outer);
        var form_to_submit = document.getElementById('_form_6697BACD04C60_');
    var scroll_pos = +'20', shown = false, scrollTimeout = null;
    _form_outer.className = _form_outer.className + ' _form_hide';
    var onScroll = function() {
        if (scrollTimeout) clearTimeout(scrollTimeout);
        scrollTimeout = window.setTimeout(checkPercentage, 100);
    };
    var checkPercentage = function() {
        if (_removed || shown) return;
        // document.documentElement = <html>
        // document.body = <body>
        // The first non-zero scrollTop value.
        var top = document.documentElement.scrollTop || document.body.scrollTop;
        // The first non-zero scrollHeight value.
        var height_scroll = document.documentElement.scrollHeight || document.body.scrollHeight;
        // The lower clientHeight value.
        var height_client = Math.min(document.documentElement.clientHeight, document.body.clientHeight);
        var percentage = top / (height_scroll - height_client) * 100;
        if (percentage >= scroll_pos) {
            _form_outer.className = _form_outer.className.replace(/ ?_form_hide ?/g, '');
            _form_outer.className = _form_outer.className + ' _form_show';
            form_to_submit.className = form_to_submit.className + ' ' + '_slideInLeft';
            shown = true;
                    }
    };
    addEvent(window, 'scroll', onScroll);
    onScroll();
    var close_icon = _form_outer.querySelector('._close');
    var close_form = function() {
        if (_form_outer) _form_outer.parentNode.removeChild(_form_outer);
        remove_tooltips();
        _removed = true;
                setCookie("_form_10_", new Date());
            };
    addEvent(close_icon, 'click', close_form);
    var allInputs = form_to_submit.querySelectorAll('input, select, textarea'), tooltips = [], submitted = false;

    var getUrlParam = function(name) {
        if (name.toLowerCase() !== 'email') {
            var params = new URLSearchParams(window.location.search);
            return params.get(name) || false;
        }
        // email is a special case because a plus is valid in the email address
        var qString = window.location.search;
        if (!qString) {
            return false;
        }
        var parameters = qString.substr(1).split('&');
        for (var i = 0; i < parameters.length; i++) {
            var parameter = parameters[i].split('=');
            if (parameter[0].toLowerCase() === 'email') {
                return parameter[1] === undefined ? true : decodeURIComponent(parameter[1]);
            }
        }
        return false;
    };

    var acctDateFormat = "%m/%d/%Y";
    var getNormalizedDate = function(date, acctFormat) {
        var decodedDate = decodeURIComponent(date);
        if (acctFormat && acctFormat.match(/(%d|%e).*%m/gi) !== null) {
            return decodedDate.replace(/(\d{2}).*(\d{2}).*(\d{4})/g, '$3-$2-$1');
        } else if (Date.parse(decodedDate)) {
            var dateObj = new Date(decodedDate);
            var year = dateObj.getFullYear();
            var month = dateObj.getMonth() + 1;
            var day = dateObj.getDate();
            return `${year}-${month < 10 ? `0${month}` : month}-${day < 10 ? `0${day}` : day}`;
        }
        return false;
    };

    var getNormalizedTime = function(time) {
        var hour, minutes;
        var decodedTime = decodeURIComponent(time);
        var timeParts = Array.from(decodedTime.matchAll(/(\d{1,2}):(\d{1,2})\W*([AaPp][Mm])?/gm))[0];
        if (timeParts[3]) { // 12 hour format
            var isPM = timeParts[3].toLowerCase() === 'pm';
            if (isPM) {
                hour = parseInt(timeParts[1]) === 12 ? '12' : `${parseInt(timeParts[1]) + 12}`;
            } else {
                hour = parseInt(timeParts[1]) === 12 ? '0' : timeParts[1];
            }
        } else { // 24 hour format
            hour = timeParts[1];
        }
        var normalizedHour = parseInt(hour) < 10 ? `0${parseInt(hour)}` : hour;
        var minutes = timeParts[2];
        return `${normalizedHour}:${minutes}`;
    };

    for (var i = 0; i < allInputs.length; i++) {
        var regexStr = "field\\[(\\d+)\\]";
        var results = new RegExp(regexStr).exec(allInputs[i].name);
        if (results != undefined) {
            allInputs[i].dataset.name = allInputs[i].name.match(/\[time\]$/)
                ? `${window.cfields[results[1]]}_time`
                : window.cfields[results[1]];
        } else {
            allInputs[i].dataset.name = allInputs[i].name;
        }
        var fieldVal = getUrlParam(allInputs[i].dataset.name);

        if (fieldVal) {
            if (allInputs[i].dataset.autofill === "false") {
                continue;
            }
            if (allInputs[i].type == "radio" || allInputs[i].type == "checkbox") {
                if (allInputs[i].value == fieldVal) {
                    allInputs[i].checked = true;
                }
            } else if (allInputs[i].type == "date") {
                allInputs[i].value = getNormalizedDate(fieldVal, acctDateFormat);
            } else if (allInputs[i].type == "time") {
                allInputs[i].value = getNormalizedTime(fieldVal);
            } else {
                allInputs[i].value = fieldVal;
            }
        }
    }

    var remove_tooltips = function() {
        for (var i = 0; i < tooltips.length; i++) {
            tooltips[i].tip.parentNode.removeChild(tooltips[i].tip);
        }
        tooltips = [];
    };
    var remove_tooltip = function(elem) {
        for (var i = 0; i < tooltips.length; i++) {
            if (tooltips[i].elem === elem) {
                tooltips[i].tip.parentNode.removeChild(tooltips[i].tip);
                tooltips.splice(i, 1);
                return;
            }
        }
    };
    var create_tooltip = function(elem, text) {
        var tooltip = document.createElement('div'),
            arrow = document.createElement('div'),
            inner = document.createElement('div'), new_tooltip = {};
        if (elem.type != 'radio' && elem.type != 'checkbox') {
            tooltip.className = '_error';
            arrow.className = '_error-arrow';
            inner.className = '_error-inner';
            inner.innerHTML = text;
            tooltip.appendChild(arrow);
            tooltip.appendChild(inner);
            elem.parentNode.appendChild(tooltip);
        } else {
            tooltip.className = '_error-inner _no_arrow';
            tooltip.innerHTML = text;
            elem.parentNode.insertBefore(tooltip, elem);
            new_tooltip.no_arrow = true;
        }
        new_tooltip.tip = tooltip;
        new_tooltip.elem = elem;
        tooltips.push(new_tooltip);
        return new_tooltip;
    };
    var resize_tooltip = function(tooltip) {
        var rect = tooltip.elem.getBoundingClientRect();
        tooltip.tip.className = tooltip.tip.className + ' _above';
    };
    var resize_tooltips = function() {
        if (_removed) return;
        for (var i = 0; i < tooltips.length; i++) {
            if (!tooltips[i].no_arrow) resize_tooltip(tooltips[i]);
        }
    };
    var validate_field = function(elem, remove) {
        var tooltip = null, value = elem.value, no_error = true;
        remove ? remove_tooltip(elem) : false;
        if (elem.type != 'checkbox') elem.className = elem.className.replace(/ ?_has_error ?/g, '');
        if (elem.getAttribute('required') !== null) {
            if (elem.type == 'radio' || (elem.type == 'checkbox' && /any/.test(elem.className))) {
                var elems = form_to_submit.elements[elem.name];
                if (!(elems instanceof NodeList || elems instanceof HTMLCollection) || elems.length <= 1) {
                    no_error = elem.checked;
                }
                else {
                    no_error = false;
                    for (var i = 0; i < elems.length; i++) {
                        if (elems[i].checked) no_error = true;
                    }
                }
                if (!no_error) {
                    tooltip = create_tooltip(elem, "Please select an option.");
                }
            } else if (elem.type =='checkbox') {
                var elems = form_to_submit.elements[elem.name], found = false, err = [];
                no_error = true;
                for (var i = 0; i < elems.length; i++) {
                    if (elems[i].getAttribute('required') === null) continue;
                    if (!found && elems[i] !== elem) return true;
                    found = true;
                    elems[i].className = elems[i].className.replace(/ ?_has_error ?/g, '');
                    if (!elems[i].checked) {
                        no_error = false;
                        elems[i].className = elems[i].className + ' _has_error';
                        err.push("Checking %s is required".replace("%s", elems[i].value));
                    }
                }
                if (!no_error) {
                    tooltip = create_tooltip(elem, err.join('<br/>'));
                }
            } else if (elem.tagName == 'SELECT') {
                var selected = true;
                if (elem.multiple) {
                    selected = false;
                    for (var i = 0; i < elem.options.length; i++) {
                        if (elem.options[i].selected) {
                            selected = true;
                            break;
                        }
                    }
                } else {
                    for (var i = 0; i < elem.options.length; i++) {
                        if (elem.options[i].selected
                            && (!elem.options[i].value
                            || (elem.options[i].value.match(/\n/g)))
                        ) {
                            selected = false;
                        }
                    }
                }
                if (!selected) {
                    elem.className = elem.className + ' _has_error';
                    no_error = false;
                    tooltip = create_tooltip(elem, "Please select an option.");
                }
            } else if (value === undefined || value === null || value === '') {
                elem.className = elem.className + ' _has_error';
                no_error = false;
                tooltip = create_tooltip(elem, "This field is required.");
            }
        }
        if (no_error && (elem.id == 'field[]' || elem.id == 'ca[11][v]')) {
            if (elem.className.includes('phone-input-error')) {
                elem.className = elem.className + ' _has_error';
                no_error = false;
            }
        }
        if (no_error && elem.name == 'email') {
            if (!value.match(/^[\+_a-z0-9-'&=]+(\.[\+_a-z0-9-']+)*@[a-z0-9-]+(\.[a-z0-9-]+)*(\.[a-z]{2,})$/i)) {
                elem.className = elem.className + ' _has_error';
                no_error = false;
                tooltip = create_tooltip(elem, "Enter a valid email address.");
            }
        }
        if (no_error && /date_field/.test(elem.className)) {
            if (!value.match(/^\d\d\d\d-\d\d-\d\d$/)) {
                elem.className = elem.className + ' _has_error';
                no_error = false;
                tooltip = create_tooltip(elem, "Enter a valid date.");
            }
        }
        tooltip ? resize_tooltip(tooltip) : false;
        return no_error;
    };
    var needs_validate = function(el) {
        if(el.getAttribute('required') !== null){
            return true
        }
        if(el.name === 'email' && el.value !== ""){
            return true
        }

        if((el.id == 'field[]' || el.id == 'ca[11][v]') && el.className.includes('phone-input-error')){
            return true
        }

        return false
    };
    var validate_form = function(e) {
        var err = form_to_submit.querySelector('._form_error'), no_error = true;
        if (!submitted) {
            submitted = true;
            for (var i = 0, len = allInputs.length; i < len; i++) {
                var input = allInputs[i];
                if (needs_validate(input)) {
                    if (input.type == 'tel') {
                        addEvent(input, 'blur', function() {
                            this.value = this.value.trim();
                            validate_field(this, true);
                        });
                    }
                    if (input.type == 'text' || input.type == 'number' || input.type == 'time') {
                        addEvent(input, 'blur', function() {
                            this.value = this.value.trim();
                            validate_field(this, true);
                        });
                        addEvent(input, 'input', function() {
                            validate_field(this, true);
                        });
                    } else if (input.type == 'radio' || input.type == 'checkbox') {
                        (function(el) {
                            var radios = form_to_submit.elements[el.name];
                            for (var i = 0; i < radios.length; i++) {
                                addEvent(radios[i], 'click', function() {
                                    validate_field(el, true);
                                });
                            }
                        })(input);
                    } else if (input.tagName == 'SELECT') {
                        addEvent(input, 'change', function() {
                            validate_field(this, true);
                        });
                    } else if (input.type == 'textarea'){
                        addEvent(input, 'input', function() {
                            validate_field(this, true);
                        });
                    }
                }
            }
        }
        remove_tooltips();
        for (var i = 0, len = allInputs.length; i < len; i++) {
            var elem = allInputs[i];
            if (needs_validate(elem)) {
                if (elem.tagName.toLowerCase() !== "select") {
                    elem.value = elem.value.trim();
                }
                validate_field(elem) ? true : no_error = false;
            }
        }
        if (!no_error && e) {
            e.preventDefault();
        }
        resize_tooltips();
        return no_error;
    };
    addEvent(window, 'resize', resize_tooltips);
    addEvent(window, 'scroll', resize_tooltips);

    var hidePhoneInputError = function(inputId) {
        var errorMessage =  document.getElementById("error-msg-" + inputId);
        var input = document.getElementById(inputId);
        errorMessage.classList.remove("phone-error");
        errorMessage.classList.add("phone-error-hidden");
        input.classList.remove("phone-input-error");
    };

    var initializePhoneInput = function(input, defaultCountry) {
        return window.intlTelInput(input, {
            utilsScript: "https://unpkg.com/intl-tel-input@17.0.18/build/js/utils.js",
            autoHideDialCode: false,
            separateDialCode: true,
            initialCountry: defaultCountry,
            preferredCountries: []
        });
    }

    var setPhoneInputEventListeners = function(inputId, input, iti) {
        input.addEventListener('blur', function() {
            var errorMessage = document.getElementById("error-msg-" + inputId);
            if (input.value.trim()) {
                if (iti.isValidNumber()) {
                    iti.setNumber(iti.getNumber());
                    if (errorMessage.classList.contains("phone-error")){
                        hidePhoneInputError(inputId);
                    }
                } else {
                    showPhoneInputError(inputId)
                }
            } else {
                if (errorMessage.classList.contains("phone-error")){
                    hidePhoneInputError(inputId);
                }
            }
        });

        input.addEventListener("countrychange", function() {
            iti.setNumber('');
        });

        input.addEventListener("keydown", function(e) {
            var charCode = (e.which) ? e.which : e.keyCode;
            if (charCode > 31 && (charCode < 48 || charCode > 57) && charCode !== 8) {
                e.preventDefault();
            }
        });
    };

    var showPhoneInputError = function(inputId) {
        var errorMessage =  document.getElementById("error-msg-" + inputId);
        var input = document.getElementById(inputId);
        errorMessage.classList.add("phone-error");
        errorMessage.classList.remove("phone-error-hidden");
        input.classList.add("phone-input-error");
    };


    var _form_serialize = function(form){if(!form||form.nodeName!=="FORM"){return }var i,j,q=[];for(i=0;i<form.elements.length;i++){if(form.elements[i].name===""){continue}switch(form.elements[i].nodeName){case"INPUT":switch(form.elements[i].type){case"tel":q.push(form.elements[i].name+"="+encodeURIComponent(form.elements[i].previousSibling.querySelector('div.iti__selected-dial-code').innerText)+encodeURIComponent(" ")+encodeURIComponent(form.elements[i].value));break;case"text":case"number":case"date":case"time":case"hidden":case"password":case"button":case"reset":case"submit":q.push(form.elements[i].name+"="+encodeURIComponent(form.elements[i].value));break;case"checkbox":case"radio":if(form.elements[i].checked){q.push(form.elements[i].name+"="+encodeURIComponent(form.elements[i].value))}break;case"file":break}break;case"TEXTAREA":q.push(form.elements[i].name+"="+encodeURIComponent(form.elements[i].value));break;case"SELECT":switch(form.elements[i].type){case"select-one":q.push(form.elements[i].name+"="+encodeURIComponent(form.elements[i].value));break;case"select-multiple":for(j=0;j<form.elements[i].options.length;j++){if(form.elements[i].options[j].selected){q.push(form.elements[i].name+"="+encodeURIComponent(form.elements[i].options[j].value))}}break}break;case"BUTTON":switch(form.elements[i].type){case"reset":case"submit":case"button":q.push(form.elements[i].name+"="+encodeURIComponent(form.elements[i].value));break}break}}return q.join("&")};

    const formSupportsPost = false;
          var form_submit = function(e) {

        e.preventDefault();
        if (validate_form()) {
            // use this trick to get the submit button & disable it using plain javascript
            var submitButton = e.target.querySelector('#_form_10_submit');
            submitButton.disabled = true;
            submitButton.classList.add('processing');
                        setCookie("_form_10_", new Date());
                        var serialized = _form_serialize(
                document.getElementById('_form_6697BACD04C60_')
            ).replace(/%0A/g, '\\n');
            var err = form_to_submit.querySelector('._form_error');
            err ? err.parentNode.removeChild(err) : false;
            async function submitForm() {
              var formData = new FormData();
              const searchParams = new URLSearchParams(serialized);
              searchParams.forEach((value, key) => {
                if (key !== 'hideButton') {
                    formData.append(key, value);
                }
                //formData.append(key, value);
              });
                            let request = {
                                headers: {
                                    "Accept": "application/json"
                                },
                                body: formData,
                                method: "POST"
                            };

                            let pageUrlParams = new URLSearchParams(window.location.search);
                            if (pageUrlParams.has('t')) {
                                request.headers.Authorization = 'Bearer ' + pageUrlParams.get('t');
                            }
              const response = await fetch('https://podia37110.activehosted.com/proc.php?jsonp=true', request);
              return response.json();
            }
                if (formSupportsPost) {
                  submitForm().then((data) => {
                    eval(data.js);
                  });
                } else {
                  _load_script('https://podia37110.activehosted.com/proc.php?' + serialized + '&jsonp=true', null, true);
                }
        }
        return false;
    };
    addEvent(form_to_submit, 'submit', form_submit);
})();
