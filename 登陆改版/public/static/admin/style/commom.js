/*
 *  @param fileInput input id
 *  @param filedInput 存放文件名的input
 *  @param isImage 是否是图片
 *  @param fileName 文件名
 */ 
function initFileInput(fileInput,filedInput,isImage,fileName) {
    if(filedInput){
        var filedInputValue=$('#' + filedInput).val();
    }else{
         var filedInputValue=false;
    }
     var controlFileInput = $('#' + fileInput);
     var fileExtensions=['jpg', 'jpeg', 'gif', 'png'];
     if(!isImage){
         fileExtensions=['txt', 'pdf', 'doc', 'docx','ppt','pptx','xlsx','xls','zip'];
     }
     if(filedInputValue){
            var fileUrl=filedInputValue;
            if(filedInputValue.indexOf("http")<0){
                fileUrl=fileServiceRootUrl+filedInputValue;
            }
            var ext=filedInputValue.substring(filedInputValue.lastIndexOf(".")+1,filedInputValue.length);
            var newFileName=fileName+"."+ext;
            var config={caption: fileName,filename:newFileName,width: "80px",height:"80px", key: 1,showDelete: false,showZoom: isImage};
            var iconicPreview=false;
            if(!isImage){
                iconicPreview=true;
            }else{

            }
            controlFileInput.fileinput({
                overwriteInitial: true,
                showRemove:false,
                initialPreviewAsData: true,
                initialPreview: [fileUrl],
                initialPreviewConfig: [config],
                 preferIconicPreview: iconicPreview, 
                 previewFileIconSettings: { 
                        'doc': '<i class="fa fa-file-word-o text-primary"></i>',
                        'xls': '<i class="fa fa-file-excel-o text-success"></i>',
                        'ppt': '<i class="fa fa-file-powerpoint-o text-danger"></i>',
                        'pdf': '<i class="fa fa-file-pdf-o text-danger"></i>',
                        'apk': '<i class="fa fa-file-archive-o text-muted"></i>',
                        'txt': '<i class="fa fa-file-text-o text-info"></i>',
                        'jpg': '<i class="fa fa-file-photo-o text-danger"></i>', 
                        'gif': '<i class="fa fa-file-photo-o text-muted"></i>', 
                        'png': '<i class="fa fa-file-photo-o text-primary"></i>'
                    },
                    previewFileExtSettings: { 
                        'doc': function(ext) {
                            return ext.match(/(doc|docx)$/i);
                        },
                        'xls': function(ext) {
                            return ext.match(/(xls|xlsx)$/i);
                        },
                        'ppt': function(ext) {
                            return ext.match(/(ppt|pptx)$/i);
                        },
                        'zip': function(ext) {
                            return ext.match(/(zip|rar|tar|gzip|gz|7z)$/i);
                        },
                        'txt': function(ext) {
                            return ext.match(/(txt|ini|csv|java|php|js|css)$/i);
                        },
                        'apk': function(ext) {
                            return ext.match(/(apk)$/i);
                        },
                    },
                showUpload:false,
                language: "zh",
                removeClass: "btn btn-danger",
                initialCaption: fileUrl,
                allowedFileExtensions: fileExtensions
             });
        }else{
            controlFileInput.fileinput({
                showUpload:false,
                overwriteInitial: true,
                language: "zh",
                removeClass: "btn btn-danger",
                allowedFileExtensions: fileExtensions
             });
        }
}