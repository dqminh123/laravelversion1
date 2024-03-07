// npm package: ace-builds (Ajax.org Cloud9 Editor)
// github link: https://github.com/ajaxorg/ace-builds

$(function() {
    'use strict';
  
    var HT = {};
    HT.seoPreview = () =>{
        $('input[name=meta_title').on('keyup', function () {
                let input = $(this)
                let value = input.val()
                $('.meta-title').html(value);
        });
        $('input[name=canonical').css({
            'padding-left' : parseInt($('.baseUrl').outerWidth()) + 10
        });
        $('input[name=canonical').on('keyup', function () {
            let input = $(this)
            let value = input.val()
            $('.canonical').html(BASE_URL + value + SUFFIX);
        });
        $('textarea[name=meta_description]').on('keyup', function(){
            let input = $(this)
            let value = input.val()
            $('.meta_description').html(value);
        });
        $('input[name=meta_keyword').on('keyup', function () {
            let input = $(this)
            let value = input.val()
            $('.meta_keyword').html(value);
        });
       
    }
    
    

    $(document).ready(function () {
       HT.seoPreview();
    });
  
  });