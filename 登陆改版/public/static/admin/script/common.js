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
         fileExtensions=['txt', 'pdf', 'doc', 'docx','ppt','pptx','xlsx','xls','zip','mp4','rar'];
     }
     if(filedInputValue){
            var fileUrl=filedInputValue;
            if(filedInputValue.indexOf("http")<0){
                fileUrl=fileServiceRootUrl+filedInputValue;
            }
            var ext=filedInputValue.substring(filedInputValue.lastIndexOf(".")+1,filedInputValue.length);
            var newFileName=fileName+"."+ext;
            var config={caption: fileName,filename:newFileName, showRemove:false,width: "80px",height:"80px", key: 1,showDelete: false,showZoom: isImage};
            var iconicPreview=false;
            if(!isImage){
                iconicPreview=true;
            }else{

            }
            controlFileInput.fileinput({
                overwriteInitial: true,
                showClose:false,
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
                        'png': '<i class="fa fa-file-photo-o text-primary"></i>',
                        'zip': '<i class="fa fa-file-zip-o"></i>',
                        'mp4': '<i class="fa fa-file-movie-o"></i>'
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
                        'mp4': function(ext) {
                            return ext.match(/(mp4)$/i);
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
                showPreview:false,
                language: "zh",
                removeClass: "btn btn-danger",
                allowedFileExtensions: fileExtensions
             });
        }
}

function initFileInputAll(id,data,aid,uploadUrl){ 
    if(data){
        var initialPreview = data.path;
        var initialPreviewConfig = data.initialPreviewConfig;
    }else{
        var initialPreview = false;
        var initialPreviewConfig = false;
    }
    $("#"+id).fileinput({
        theme: 'fa',
        language: "zh",
        allowedFileExtensions: ['jpg', 'gif', 'png'],
        showUpload: true,
        showCaption: false,
        elCaptionText:false,
        browseClass: "btn btn-primary btn-lg",
        fileType: "any",
        previewFileIcon: "<i class='glyphicon glyphicon-king'></i>",
        overwriteInitial: false,
        initialPreviewAsData: true,
        initialPreview: initialPreview,
        initialPreviewConfig:initialPreviewConfig,
        uploadUrl: uploadUrl,
        uploadAsync: false,//默认异步上传
        uploadExtraData:function (previewId, index) {    
                    var data = {
                        aid : aid
                    };
                    return data;
               },
       }).on('fileuploaded', function(event, data, previewId, index) {
            if(data.response.status===0){
                window.location.href='';
            }
        }).on('filesorted', function(event, params) {
            // console.log(params.oldIndex, params.newIndex, params.stack);
            // console.log(params.stack);
            var newDate = new Array();
            var jsonData = new Array();
            var data = params.stack;

           

             

            var len = data.length;
            for (var i = 0; i < len; i++) {
                newDate.push({'id':data[i]['key'],'sort':data[i]['sort']});
            }

             //  按照排序号排序
            var compare = function (prop) {
                return function (obj1, obj2) {
                    var val1 = obj1[prop];
                    var val2 = obj2[prop];if (val1 < val2) {
                        return -1;
                    } else if (val1 > val2) {
                        return 1;
                    } else {
                        return 0;
                    }            
                } 
            }
             newData = newDate.sort(compare("sort"));
            for (var i = 0; i < len; i++) {
                if(data[i]['sort'] !=newDate[i]['sort']){
                   jsonData.push({'id':data[i]['key'],'sort':newDate[i]['sort']});
                }
                
            }

            jsonStr = JSON.stringify(jsonData);
            $.ajax({
                type:"post",
                dataType:"json",
                data:{'data':jsonStr},
                url:data[0]['sort_url'],
                success:function(data){
                    if(data==1){
                        window.location.href='';
                    }
                    
                }
            });

        });

}

function save_sort(tis,act,id)
{
    val = $(tis).val();
    url = $(tis).attr('url');

    $.ajax({
        type:"post",
        dataType:"json",
        data:{act:act,id:id,sort:val},
        url:url,
        success:function(data){
            if (data.status==2){
                return false;
            }
            if(data.status==1){
               layer.msg('修改排序成功,页面刷新后，将按新的序号排列');
            }else{
                layer.msg('修改排序失败');
            }
        }
    });
}