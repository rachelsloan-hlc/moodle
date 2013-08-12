$(document).ready(function() {

    $('.collapse').on('show', function () {
        $(this).prev('.bucket-head').find('.i-toggle').removeClass('i-hollow-plus').addClass('i-hollow-minus');
    });
    $('.collapse').on('hide', function () {
        $(this).prev('.bucket-head').find('.i-toggle').removeClass('i-hollow-minus').addClass('i-hollow-plus');
    });

});