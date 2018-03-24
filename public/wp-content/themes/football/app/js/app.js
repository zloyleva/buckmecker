window.$ = window.jQuery = require('jquery');
console.log('App was loaded');

require('jquery-editable-select');
require('jquery-ui');

import {HeaderModule} from './header/header';
import {LeftSidebarModule} from './content/left_sidebar';
import {RightSidebarModule} from './content/right_sidebar';

$(document).ready(() => {
    console.log('Start...');
    new HeaderModule();
    new LeftSidebarModule();
    new RightSidebarModule();

    function scaleCaptcha(elementWidth) {
        // Width of the reCAPTCHA element, in pixels
        var reCaptchaWidth = 304;
        // Get the containing element's width
        var containerWidth = $('.buttons_section').width();

        // Only scale the reCAPTCHA if it won't fit
        // inside the container
        if(reCaptchaWidth > containerWidth) {
            // Calculate the scale
            var captchaScale = containerWidth / reCaptchaWidth;
            // Apply the transformation
            $('.g-recaptcha').css({
                'transform':'scale('+captchaScale+')'
            });
        }
    }

    $(function() {

        // Initialize scaling
        scaleCaptcha();

        // Update scaling on window resize
        // Uses jQuery throttle plugin to limit strain on the browser
        $(window).resize( scaleCaptcha );

    });

});