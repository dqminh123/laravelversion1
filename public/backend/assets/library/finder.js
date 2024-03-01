// npm package: ace-builds (Ajax.org Cloud9 Editor)
// github link: https://github.com/ajaxorg/ace-builds

$(function() {
    'use strict';
  
    var HT = {};

    //chọn ảnh
    HT.uploadImageToInput = () => {
        $('.upload-image').click(function () { 
            let input = $(this)
            let type = input.attr('data-type')
           HT.setupCkFinder2(input,type);
             
         })
    }
    
    HT.setupCkFinder2 = (object,type) => {
        if(typeof(type) == 'undefined'){
            type = 'Images';
        }
        var finder = new CKFinder();
        finder.resourceType = type;
        //sau khi chọn ảnh
        finder.selectActionFunction = function (fileUrl, data){
           object.val(fileUrl)
        }
        finder.popup();
    }
    
    

    $(document).ready(function () {
            HT.uploadImageToInput();
    });
  
  });