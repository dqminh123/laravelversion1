/**
 * @license Copyright (c) 2003-2023, CKSource Holding sp. z o.o. All rights reserved.
 * For licensing, see https://ckeditor.com/legal/ckeditor-oss-license
 */

CKEDITOR.editorConfig = function( config ) {
    config.removePlugins = 'easyimage, cloudservices';
	config.filebrowserBrowseUrl = BASE_URL + 'public/backend/assets/plugin/ckfinder_2/ckfinder.html',
    config.filebrowserImageBrowseUrl = BASE_URL +'public/backend/assets/plugin/ckfinder_2/ckfinder.html?type=Images',
	config.filebrowserFlashBrowseUrl = BASE_URL +'public/backend/assets/plugin/ckfinder_2/ckfinder.html?type=Flash',
    config.filebrowserUploadUrl = BASE_URL +'public/backend/assets/plugin/ckfinder_2/core/connector/php/connector.php?command=QuickUpload&type=Files',
    config.filebrowserImageUploadUrl= BASE_URL +'public/backend/assets/plugin/ckfinder_2/core/connector/php/connector.php?command=QuickUpload&type=Images',
	config.filebrowserImageUploadUrl= BASE_URL +'public/backend/assets/plugin/ckfinder_2/core/connector/php/connector.php?command=QuickUpload&type=Flash'
};
