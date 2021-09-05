/**
 * Created by junyv on 2018/11/2.
 */
var uptoken = '',domain = '',filename = '';
function send_request()
{
    var xmlhttp = null;
    if (window.XMLHttpRequest)
    {
        xmlhttp=new XMLHttpRequest();
    }
    else if (window.ActiveXObject)
    {
        xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");
    }

    if (xmlhttp!=null)
    {
        // serverUrl是 用户获取 '签名和Policy' 等信息的应用服务器的URL，请将下面的IP和Port配置为您自己的真实信息。
        // serverUrl = 'http://88.88.88.88:8888/aliyun-oss-appserver-php/php/get.php'
        serverUrl = '/get_oss_token/index.html?type=qiniu'

        xmlhttp.open( "GET", serverUrl, false );
        xmlhttp.send( null );
        return xmlhttp.responseText
    }
    else
    {
        alert("Your browser does not support XMLHTTP.");
    }
};
function set_upload_param()
{
    var result = send_request();
    result = eval ("(" + result + ")");
    if(result.code == 0){
        alert(result.msg);
        return false;
    }else{
        data     = result.data;
        uptoken  = data.uptoken;
        domain   = data.domain;
        filename = data.filename;
    }
}
set_upload_param();
if(uptoken){
    var uploader = Qiniu.uploader({
        runtimes: 'html5,flash,html4',      // 上传模式，依次退化
        browse_button: 'select-video-btn',  // 上传选择的点选按钮，必需
        uptoken: uptoken,
        get_new_uptoken: false,             // 设置上传文件的时候是否每次都重新获取新的uptoken
        // downtoken_url: '/downtoken',
        // Ajax请求downToken的Url，私有空间时使用，JS-SDK将向该地址POST文件的key和domain，服务端返回的JSON必须包含url字段，url值为该文件的下载地址
        unique_names: false,              // 默认false，key为文件名。若开启该选项，JS-SDK会为每个文件自动生成key（文件名）
        save_key: true,                  // 默认false。若在服务端生成uptoken的上传策略中指定了sava_key，则开启，SDK在前端将不对key进行任何处理
        domain: domain,     // bucket域名，下载资源时用到，必需
        container: 'container',             // 上传区域DOM ID，默认是browser_button的父元素
        max_file_size: '500mb',             // 最大文件体积限制
        flash_swf_url: '',  //引入flash，相对路径
        max_retries: 3,                     // 上传失败最大重试次数
        dragdrop: false,                     // 开启可拖曳上传
//                drop_element: '',          // 拖曳上传区域元素的ID，拖曳文件或文件夹后可触发上传
        chunk_size: '4mb',                  // 分块上传时，每块的体积
        auto_start: false,                   // 选择文件后自动上传，若关闭需要自己绑定事件触发上传
        init: {
            PostInit: function() {
                document.getElementById('upload-video-btn').onclick = function() {
                    uploader.start();
                };
            },
            FilesAdded: function(up, files) {
                plupload.each(files, function(file) {
                    document.getElementById('ossfile').innerHTML += '<div id="' + file.id + '">' + file.name + ' (' + plupload.formatSize(file.size) + ')<b></b>'
                        +'<div class="progress"><div class="progress-bar" style="width: 0%"></div></div>'
                        +'</div>';
                });
            },
            'UploadProgress': function (up, file) {
                var d = document.getElementById(file.id);
                d.getElementsByTagName('b')[0].innerHTML = '<span>' + file.percent + "%</span>";
                var prog = d.getElementsByTagName('div')[0];
                var progBar = prog.getElementsByTagName('div')[0]
                progBar.style.width= 2*file.percent+'px';
                progBar.setAttribute('aria-valuenow', file.percent);
            },
            'FileUploaded': function (up, file, info) {
                // 每个文件上传成功后，处理相关的事情
                var res = JSON.parse(info.response);
                if (info.status == 200 || info.status == 203)
                {
                    $("#video").val(res.key);
                    document.getElementById(file.id).getElementsByTagName('b')[0].innerHTML = 'upload to oss success.<a href="javascript:;" data-file="'+res.key+'" id="delete_video" class="layui-btn layui-btn-xs layui-btn-danger">删除</a>';
                }else
                {
                    document.getElementById(file.id).getElementsByTagName('b')[0].innerHTML = info.response;
                }
            },
            'Error': function (up, err, errTip) {
                //上传出错时，处理相关的事情
            },
            'UploadComplete': function () {
                //队列文件处理完毕后，处理相关的事情
                $('#progress').html('上传成功');
            }
        }
    });
}else{
    alert('获取token失败')
}
