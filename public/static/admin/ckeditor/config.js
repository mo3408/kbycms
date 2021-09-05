/**
 * @license Copyright (c) 2003-2021, CKSource - Frederico Knabben. All rights reserved.
 * For licensing, see https://ckeditor.com/legal/ckeditor-oss-license
 */
function getNowFormatDate() {
	var date = new Date();
	var seperator1 = "-";
	var year = date.getFullYear();
	var month = date.getMonth() + 1;
	var strDate = date.getDate();
	if (month >= 1 && month <= 9) {
		month = "0" + month;
	}
	if (strDate >= 0 && strDate <= 9) {
		strDate = "0" + strDate;
	}
	var currentdate = year + seperator1 + month + seperator1 + strDate;
	return currentdate;
}
CKEDITOR.editorConfig = function(config) {
	// config.removePlugins = 'easyimage,cloudservices,exportpdf';
	config.toolbar = [{
			name: 'document',
			items: ['Source', '-', 'Save', 'NewPage', 'ExportPdf', 'Preview', 'Print', '-', 'Templates']
		},
		{
			name: 'clipboard',
			items: ['Cut', 'Copy', 'Paste', 'PasteText', 'PasteFromWord', '-', 'Undo', 'Redo']
		},
		{
			name: 'editing',
			items: ['Find', 'Replace', '-', 'SelectAll', '-', 'Scayt']
		},
		{
			name: 'forms',
			items: ['Form', 'Checkbox', 'Radio', 'TextField', 'Textarea', 'Select', 'Button', 'ImageButton',
				'HiddenField'
			]
		},
		{
			name: 'basicstyles',
			items: ['Bold', 'Italic', 'Underline', 'Strike', 'Subscript', 'Superscript', '-', 'CopyFormatting',
				'RemoveFormat'
			]
		},
		{
			name: 'paragraph',
			items: ['NumberedList', 'BulletedList', '-', 'Outdent', 'Indent', '-', 'Blockquote', 'CreateDiv',
				'-', 'JustifyLeft', 'JustifyCenter', 'JustifyRight', 'JustifyBlock', '-', 'BidiLtr',
				'BidiRtl', 'Language'
			]
		},
		{
			name: 'links',
			items: ['Link', 'Unlink', 'Anchor']
		},
		{
			name: 'insert',
			items: ['Image', 'Flash', 'Table', 'HorizontalRule', 'Smiley', 'SpecialChar', 'PageBreak', 'Iframe']
		},
		{
			name: 'styles',
			items: ['Styles', 'Format', 'Font', 'FontSize']
		},
		{
			name: 'colors',
			items: ['TextColor', 'BGColor']
		},
		{
			name: 'tools',
			items: ['Maximize', 'ShowBlocks']
		},
		{
			name: 'about',
			items: ['About']
		}
	];
	var date = new Date();
	var seperator1 = "-";
	var year = date.getFullYear();
	var month = date.getMonth() + 1;
	var strDate = date.getDate();
	if (month >= 1 && month <= 9) {
		month = "0" + month;
	}
	if (strDate >= 0 && strDate <= 9) {
		strDate = "0" + strDate;
	}
	var currentdate = year + seperator1 + month + seperator1 + strDate;
	// console.log(date)
	config.removePlugins = 'easyimage,cloudservices,exportpdf';
	config.image_previewText = ' ';
	config.exportPdf_fileName = currentdate;
	// config.toolbar = 'Full';
	// config.toolbar_Full = 
	// [ 
	//     { name: 'document', items : [ 'Source','-','Save','NewPage','DocProps','Preview','Print','-','Templates' ] }, 
	//     { name: 'clipboard', items : [ 'Cut','Copy','Paste','PasteText','PasteFromWord','-','Undo','Redo' ] }, 
	//     { name: 'editing', items : [ 'Find','Replace','-','SelectAll','-','SpellChecker', 'Scayt' ] }, 
	//     { name: 'forms', items : [ 'Form', 'Checkbox', 'Radio', 'TextField', 'Textarea', 'Select', 'Button', 'ImageButton',  'HiddenField' ] }, 
	//     { name: 'basicstyles', items : [ 'Bold','Italic','Underline','Strike','Subscript','Superscript','-','RemoveFormat' ] }, 
	//     { name: 'paragraph', items : [ 'NumberedList','BulletedList','-','Outdent','Indent','-','Blockquote','CreateDiv','- ','JustifyLeft','JustifyCenter','JustifyRight','JustifyBlock','-','BidiLtr','BidiRtl' ] }, 
	//     { name: 'links', items : [ 'Link','Unlink','Anchor' ] }, 
	//     { name: 'insert', items : [ 'Image','Flash','Table','HorizontalRule','Smiley','SpecialChar','PageBreak','Iframe' ] }, 
	//     { name: 'styles', items : [ 'Styles','Format','Font','FontSize' ] }, 
	//     { name: 'colors', items : [ 'TextColor','BGColor' ] }, 
	//     // { name: 'tools', items : [ 'Maximize', 'ShowBlocks','-','About' ] } 
	// ]; 

	// config.toolbar_Basic = 
	// [ 
	//     ['Bold', 'Italic', '-', 'NumberedList', 'BulletedList', '-', 'Link', 'Unlink','-','About'] 
	// ]; 


	// config.toolbar_Full = [
	// 	{ name: 'document', items: [ 'Source', '-', 'Save', 'NewPage', 'ExportPdf', 'Preview', 'Print', '-', 'Templates' ] },
	// 	{ name: 'clipboard', items: [ 'Cut', 'Copy', 'Paste', 'PasteText', 'PasteFromWord', '-', 'Undo', 'Redo' ] },
	// 	{ name: 'editing', items: [ 'Find', 'Replace', '-', 'SelectAll', '-', 'Scayt' ] },
	// 	{ name: 'forms', items: [ 'Form', 'Checkbox', 'Radio', 'TextField', 'Textarea', 'Select', 'Button', 'ImageButton', 'HiddenField' ] },
	// 	'/',
	// 	{ name: 'basicstyles', items: [ 'Bold', 'Italic', 'Underline', 'Strike', 'Subscript', 'Superscript', '-', 'CopyFormatting', 'RemoveFormat' ] },
	// 	{ name: 'paragraph', items: [ 'NumberedList', 'BulletedList', '-', 'Outdent', 'Indent', '-', 'Blockquote', 'CreateDiv', '-', 'JustifyLeft', 'JustifyCenter', 'JustifyRight', 'JustifyBlock', '-', 'BidiLtr', 'BidiRtl', 'Language' ] },
	// 	{ name: 'links', items: [ 'Link', 'Unlink', 'Anchor' ] },
	// 	{ name: 'insert', items: [ 'Image', 'Flash', 'Table', 'HorizontalRule', 'Smiley', 'SpecialChar', 'PageBreak', 'Iframe' ] },
	// 	'/',
	// 	{ name: 'styles', items: [ 'Styles', 'Format', 'Font', 'FontSize' ] },
	// 	{ name: 'colors', items: [ 'TextColor', 'BGColor' ] },
	// 	{ name: 'tools', items: [ 'Maximize', 'ShowBlocks' ] },
	// 	{ name: 'about', items: [ 'About' ] }
	// ];

};
