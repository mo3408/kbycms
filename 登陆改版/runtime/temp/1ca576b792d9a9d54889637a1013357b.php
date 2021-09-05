<?php if (!defined('THINK_PATH')) exit(); /*a:1:{s:72:"E:\phpstudy_pro\WWW\www.kbcms.com/application/admin\view\login\login.htm";i:1630051363;}*/ ?>
<!DOCTYPE html>
<html lang="zh-cn">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no">
    <title>后台管理登录</title>
    <link href="/public/static/admin/layui/src/css/layui.css" rel="stylesheet" />
    <link href="/public/static/admin/font-awesome/css/font-awesome.css" rel="stylesheet" />
    <link href="/public/static/admin/static/manage/css/login.css" rel="stylesheet" />
    <link href="/public/static/admin/static/sideshow/css/normalize.css" rel="stylesheet" />
    <link href="/public/static/admin/static/sideshow/css/demo.css" rel="stylesheet" />
    <link href="/public/static/admin/static/sideshow/css/component.css" rel="stylesheet" />
    <style>
        canvas {
            position: absolute;
            z-index: -1;
        }

        .kit-login-box header h1 {
            line-height: normal;
        }

        .kit-login-box header {
            height: auto;
        }

        .content {
            position: relative;
        }

        .codrops-demos {
            position: absolute;
            bottom: 0;
            left: 40%;
            z-index: 10;
        }

        .codrops-demos a {
            border: 2px solid rgba(242, 242, 242, 0.41);
            color: rgba(255, 255, 255, 0.51);
        }

        .kit-pull-right button,
        .kit-login-main .layui-form-item input {
            background-color: transparent;
            color: white;
        }

        .kit-login-main .layui-form-item input::-webkit-input-placeholder {
            color: white;
        }

        .kit-login-main .layui-form-item input:-moz-placeholder {
            color: white;
        }

        .kit-login-main .layui-form-item input::-moz-placeholder {
            color: white;
        }

        .kit-login-main .layui-form-item input:-ms-input-placeholder {
            color: white;
        }

        .kit-pull-right button:hover {
            border-color: #009688;
            color: #009688
        }
    </style>
</head>
<body class="kit-login-bg" style="background-color:transparent;">
   <div id="loginTopBar" class="tips_3 mt_5" style="color:red;text-align:center; background-color:transparent;">友情提示：为保证后台账号安全，建议在不使用后台时 <span class=font_red>关闭浏览器</span> 或者 点击后台的 <span class=font_red>退出</span> 按钮。</div>
<div class="container demo-<?php echo $k; ?>">

    <div class="content">

        <div id="large-header" class="large-header">
            <canvas id="demo-canvas"></canvas>
            <div class="kit-login-box">
                <header>
                    <h1>后台管理系统</h1>
                </header>
                <div class="kit-login-main">
                    <form  class="layui-form" id="forms">
                        <div class="layui-form-item">
                            <label class="kit-login-icon">
                                <i class="layui-icon">&#xe612;</i>
                            </label>
                            <input type="text" name="uname" lay-verify="required" autocomplete="off" placeholder="这里输入用户名" class="layui-input" id="uname">
                        </div>
                        <div class="layui-form-item">
                            <label class="kit-login-icon">
                                <i class="layui-icon">&#xe673;</i>
                            </label>
                            <input type="password" name="password" lay-verify="required" autocomplete="off" placeholder="这里输入密码" class="layui-input" id="password">
                        </div>
                        <div class="layui-form-item">
                            <label class="kit-login-icon">
                                <i class="layui-icon">&#xe60d;</i>
                            </label>
                            <input type="text" name="code" lay-verify="required" autocomplete="off" placeholder="输入右侧验证码." class="layui-input" id="code">
                                <span class="form-code" id="changeCode" style="position:absolute;right:2px; top:2px;">
                                    <img style="width:110px"; border:0;padding:0;" src="<?php echo captcha_src(); ?>" onclick=this.src="<?php echo captcha_src(); ?>?id="+Math.random() id="code_img" title="点击刷新">
                                </span>
                        </div>

                        <div class="layui-form-item">
                            <button type="submit" class="layui-btn btn-submit lbtn" lay-submit="" lay-filter="login" style="width:100%;">立即登录</button>
                        </div>
                    </form>
                </div>
                <footer>
                </footer>
            </div>
        </div>
    </div>
</div>
<!-- /container -->
<script src="/public/static/admin/script/jquery-1.10.2.min.js"></script>
<script src="/public/static/admin/layui/src/layui.js"></script>
<script src="/public/static/admin/static/sideshow/js/TweenLite.min.js"></script>
<script src="/public/static/admin/static/sideshow/js/EasePack.min.js"></script>
<script src="/public/static/admin/static/sideshow/js/rAF.js"></script>
<script src="/public/static/admin/static/sideshow/js/demo-2.js"></script>
<script>
    layui.use(['layer', 'form'], function() {
        var layer = layui.layer,
                $ = layui.jquery,
                form = layui.form;
        var ie = IEVersion();
        if(!ie){
            layer.alert('为达到最佳使用体验，请使用ie9及以上浏览器或火狐/谷哥/safari浏览');
        }
        function IEVersion() {
            var userAgent = navigator.userAgent; //取得浏览器的userAgent字符串
            var isIE = userAgent.indexOf("compatible") > -1 && userAgent.indexOf("MSIE") > -1; //判断是否IE<11浏览器
            var isEdge = userAgent.indexOf("Edge") > -1 && !isIE; //判断是否IE的Edge浏览器
            var isIE11 = userAgent.indexOf('Trident') > -1 && userAgent.indexOf("rv:11.0") > -1;
            if(isIE) {
                var reIE = new RegExp("MSIE (\\d+\\.\\d+);");
                reIE.test(userAgent);
                var fIEVersion = parseFloat(RegExp["$1"]);
                if(fIEVersion < 9) {
                    return false;
                }
            } else if(isEdge) {
                return 'edge';//edge
            } else if(isIE11) {
                return true; //IE11
            }else{
                return true;//不是ie浏览器
            }
        }
    });
</script>
<script type="text/javascript">
    $('#forms').submit(function(){
    
        var uname = $('#uname').val();
        var password = $('#password').val();
        var code = $('#code').val();
    
    
        if(!uname){
            layer.tips('请输入用户名', '#uname',{ tips: [2, '#CC0000'],time:1000})
            return false;
        }
    
        if(uname.length<5){
            layer.tips('用户名错误', '#uname',{ tips: [2, '#CC0000'],time:1000})
            return false;
        }
    
        if(!password){
            layer.tips('请输入密码', '#password',{ tips: [2, '#CC0000'],time:1000})
            return false;
        }
    
        if(!code){
            layer.tips('请输入验证码', '#code',{ tips: [4, '#CC0000'],time:1000})
            return false;
        }
    
        if(code.length!=4){
            layer.tips('验证码错误', '#code',{ tips: [4, '#CC0000'],time:1000})
            return false;
        }
        var index = layer.load(1);
        $.ajax({
                url:"<?php echo url('admin/login/login'); ?>",
                type:'post',
                data:{uname:uname,password:password,code:code},
                async : false,
                dataType:'json',
                success:function(data){
                    layer.close(index);
                    if(data.code == 1){
                        $('#code_img').attr('src','<?php echo captcha_src(); ?>');
                        $('#code').val('');
                        layer.tips('验证码错误', '#code',{ tips: [4, '#CC0000'],time:1000})
                        return false;
                    }
    
                    if(data.code == 0){
                        
                        layer.tips(data.msg, '.lbtn',{
                            tips: [2, '#78BA32'],
                            time:4000,
                            end: function(){
                            window.location.href=data.url;
                            }
                        })
    
                    }else{
                        $('#code_img').attr('src','<?php echo captcha_src(); ?>');
                        $('#code').val('');
                        layer.tips(data.msg, '.lbtn',{ tips: [2, '#CC0000'],time:1000})
                        return false;
                    }
                },
                error:function(){
    
                }
            });
    
        return false;
    })  
    </script>


</body>

</html>