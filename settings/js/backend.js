$(function () {
    'use strict';
    
    //Hide Plaseholder on Form Focus
    $('[placeholder]').focus(function () {
        $(this).attr('data-text', $(this).attr('placeholder'));
        $(this).attr('placeholder', '');
        
    }).blur(function () {
        $(this).attr('placeholder', $(this).attr('data-text'));
    });
    
    // Add Astreisk on Required Field
    $('input, select').each(function (){
        if($(this).attr('required') === 'required'){
            $(this).after('<span class="asterisk">*</span>');
        }
    });
    
    // Convert Password Field To Text Field
    var passField = $('.password');
    $('.show-pass').hover(function (){
        passField.attr('type', 'text');
    }, function (){
        passField.attr('type', 'password');
    });
    
    // confirmation Message on Button
    $('.confirm').click(function () {
        return confirm('Are You Sure !!!');
    });
    
    // Convert Password Field To Text Field
    var passField = $('.password');
    var eye = $('.show-pass');
    $('.show-pass').hover(function (){
        eye.addClass('fa-eye-slash');
        eye.removeClass('fa-eye');
        passField.attr('type', 'text');
    }, function (){
        passField.attr('type', 'password');
        eye.addClass('fa-eye');
        eye.removeClass('fa-eye-slash');
    });
});
