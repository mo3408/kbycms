/**
 * Created by junyv on 2018/10/24.
 */
layui.use(['form','upload','linkmenu'], function(){
    var $ = layui.jquery,layer = layui.layer,upload = layui.upload,uploadUrl = $("#uploadUrl").val();
    $(".J_city_select").select({field : 'J_city_id',id : 'J_city_select'});
//普通图片上传
    upload.render({
        elem: '#img'
        ,url: ''
        ,auto:false
        ,choose: function(obj){
            //预读本地文件示例，不支持ie8
            obj.preview(function(index, file, result){
                var img = "<img class='layui-upload-img' src='"+result+"' width='100'/>";
                $('#img_preview').html(img); //图片链接（base64）
            });
        }
    });
    $(document).on('click','.deleteImg',function(){
        var that = $(this),img = $(this).data('src'),textId = $(this).data('text'),id = $("#id").val(),url = $("#deleteUrl").val();
        layer.confirm('确定要删除图片么?', {icon: 3, title:'提示'}, function(index){
            var param = {
                'path' : img,
                'id'   : id,
                'field': 'img'
            };
            $.post(url,param,function(res){
                layer.close(index);
                if(res.code == 1){
                    $("#"+textId).val('');
                    that.parent().html('');
                }else{
                    layer.msg(res.msg,{icon:2});
                }
            });
        });

    });
    //删除视频
    $(document).on('click','#delete_video',function(){
        var that = $(this),url = $('#deleteVideo').val(),video = $(this).data('file'),textObj = $("input[name='video']"),id = $("#id").val();
        layer.confirm('确定要删除视频么?', {icon: 3, title:'提示'}, function(index){
            var param = {
                'path' : video,
                'id'   : id,
                'field': 'video'
            };
            layer.msg('删除中,请稍候……');
            $.post(url,param,function(res){
                layer.close(index);
                if(res.code == 1){
                    textObj.val('');
                    that.parents('#ossfile').html('');
                    layer.msg('删除成功',{icon:1});
                }else{
                    layer.msg(res.msg,{icon:2});
                }
            });
        });
    });
    $("#address").on('blur',function(){
        var city = $("#J_city_id").val();
        var address = $(this).val(),url = $("#mark").data('autouri');
        var param = {
            city : city,
            address : address
        };
        $.get(url,param,function(res){
            if(res.code == 1)
            {
                $("#map").val(res.data.map);
            }
        });
    });
    $("#mark").on('click',function(){
        var url = $(this).data('uri');
        var map = $('#map').val();
        var city = $("#J_city_id").val();
        if(!map)
        {
            if(!city)
            {
                layer.msg('请选择城市',{icon:2});
                return false;
            }
        }
        url += '?map='+map+'&city='+city;
        layer.open(
            {
                type : 2,
                title : '地图标注',
                area : ['100%','100%'],
                shade : 0.2,
                content : url,
                iframeAuto:true
            }
        );
    });
    $("#estate_name").on('focus',function(){
        layer.open({
            type : 2,
            title : $(this).data('title'),
            area : ['500px','500px'],
            shade : 0.2,
            content : $(this).data('uri'),
            iframeAuto:true
        });
    });
});