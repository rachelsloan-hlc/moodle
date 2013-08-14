// Avoid `console` errors in browsers that lack a console.
if (!(window.console && console.log)) {
    (function() {
        var noop = function() {};
        var methods = ['assert', 'clear', 'count', 'debug', 'dir', 'dirxml', 'error', 'exception', 'group', 'groupCollapsed', 'groupEnd', 'info', 'log', 'markTimeline', 'profile', 'profileEnd', 'markTimeline', 'table', 'time', 'timeEnd', 'timeStamp', 'trace', 'warn'];
        var length = methods.length;
        var console = window.console = {};
        while (length--) {
            console[methods[length]] = noop;
        }
    }());
}

// Place any jQuery/helper plugins in here.


// http://www.femgeek.co.uk/html5-placeholders-for-troublesome-browsers-ie-ie9/
// Placeholder support for older browsers.
$(function() {
    $('head').append('<style> .hasPlaceholder { color: #aaa !important; } </style>');
});

$(function() {
    if(!$.support.placeholder) {
        var active = document.activeElement;
        $('textarea').each(function(index, element) {
            if($(this).val().length == 0) {
                $(this).html($(this).attr('id')).addClass('hasPlaceholder');
            }
        });
        $('input, textarea').focus(function () {
            if ($(this).attr('placeholder') != '' && $(this).val() == $(this).attr('placeholder')) {
                $(this).val('').removeClass('hasPlaceholder');
            }
        }).blur(function () {
                if (($(this).attr('placeholder') != '' && ($(this).val() == '' || $(this).val() == $(this).attr('placeholder')))) {
                    $(this).val($(this).attr('placeholder')).addClass('hasPlaceholder');
                    //$(this).css('background', 'red');
                }
            });
        $(':text').blur();
        $(active).focus();
        $('form').submit(function () {
            $(this).find('.hasPlaceholder').each(function() { $(this).val(''); });
        });
    }
});

$("a#popupmap").fancybox({
    'frameWidth': 600, 'frameHeight': 500
});

$(".popupSwf").fancybox({
    'padding'           : 0,
    'autoScale'     	: false,
    'transitionIn'		: 'none',
    'transitionOut'		: 'none'
});

$(".popupHtml").fancybox({
    'padding'           : 0,
    'width'				: 800,
    'height'			: 600,
    'autoScale'     	: false,
    'transitionIn'		: 'none',
    'transitionOut'		: 'none',
    'type'				: 'iframe'
});

$(".popupHtmlFull").fancybox({
    'padding'           : 0,
    'width'				: 1024,
    'height'			: 768,
    'autoScale'     	: false,
    'transitionIn'		: 'none',
    'transitionOut'		: 'none',
    'type'				: 'iframe',
    'centerOnScroll'    : true
});

$(".popupFeedback").fancybox({
    'padding'           : 0,
    'width'				: 640,
    'height'			: 480,
    'autoScale'     	: false,
    'transitionIn'		: 'none',
    'transitionOut'		: 'none',
    'type'				: 'iframe',
    'scrolling'			: 'no',
    'centerOnScroll'	: true
});

$(".popupCertificate").fancybox({
    'padding'           : 0,
    'width'				: 640,
    'height'			: 740,
    'autoScale'     	: false,
    'transitionIn'		: 'none',
    'transitionOut'		: 'none',
    'type'				: 'iframe',
    'scrolling'			: 'yes',
    'centerOnScroll'	: true
});

