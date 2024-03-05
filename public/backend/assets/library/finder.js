// npm package: ace-builds (Ajax.org Cloud9 Editor)
// github link: https://github.com/ajaxorg/ace-builds

$(function() {
    'use strict';
  
    var HT = {};
    //editor set up 
    HT.setupCkeditor = () =>{
        if($('.ck-editor')){
            $('.ck-editor').each(function(){
                let editor = $(this)
                let elementId = editor.attr('id')
                let elementHeight = editor.attr('data-height')
                HT.ckeditor4(elementId,elementHeight)
            })
        }
        
        
    }

    HT.ckeditor4 = (elementId, elementHeight) =>{
        if(typeof(elementHeight) == 'undefinded'){
            elementHeight = 500;
        }
        CKEDITOR.replace(elementId, {
            cloudServices_tokenUrl: 'http://localhost/laravelversion1.com/',
            height: elementHeight,
            removeButton: '',
            entities: true,
            allowedContent: true,
            toolbarGroups: [
                {name: 'clipboard', groups: ['clipboard','undo' ]},
                {name: 'editing'  , groups: [ 'find', 'selection',  'spellchecker' ] },
                { name: 'links' },
                { name: 'insert' },
                { name: 'forms' },
                { name: 'tools' },
                { name: 'document', groups:  [ 'mode', 'document', 'doctool' ] },
                { name: 'others' },
                '/',
                { name: 'basicstyles', groups:  [ 'basicstyles', 'cleanup' ] },
                {name: 'paragraph', group: ['list','indent','blocks','align','bidi']},
                { name: 'styles'},

            ]
        })
    }

    HT.uploadImageAvatar = () => {
        $('.image-target').click(function () { 
            let input = $(this);
            let type = 'Images';
            HT.browseServerAvatar(input,type);
            
        });
    }

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
    
    HT.browseServerAvatar = (object,type) =>{
        if(typeof(type) == 'undefined'){
            type = 'Images';
        }
        var finder = new CKFinder();
        finder.resourceType = type;
        //sau khi chọn ảnh
        finder.selectActionFunction = function (fileUrl, data){
           object.find('img').attr('src',fileUrl)
           object.siblings('input').val(fileUrl)
        }
        finder.popup();
    }
    

    $(document).ready(function () {
            HT.uploadImageToInput();
            HT.setupCkeditor();
            HT.uploadImageAvatar();
    });
  
  });