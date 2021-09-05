<?php if (!defined('THINK_PATH')) exit(); /*a:1:{s:71:"E:\phpstudy_pro\WWW\www.home.com/application/admin\view\login\login.htm";i:1629940304;}*/ ?>
<!DOCTYPE html>
<!--[if lte IE 8 ]><html lang="zh-CN" class="ie8"> <![endif]-->
<!--[if IE 9 ]><html lang="zh-CN" class="ie9"> <![endif]-->
<!--[if (gte IE 10)|!(IE)]><!--><html lang="zh-CN"><!--<![endif]-->
<head>
    <title>快帮云CMS系统</title>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="shortcut icon" href="/public/static/admin/images/icons/favicon.ico">
    <link rel="apple-touch-icon" href="/public/static/admin/images/icons/favicon.png">
    <link rel="apple-touch-icon" sizes="72x72" href="/public/static/admin/images/icons/favicon-72x72.png">
    <link rel="apple-touch-icon" sizes="114x114" href="/public/static/admin/images/icons/favicon-114x114.png">
    <link type="text/css" rel="stylesheet" href="/public/static/admin/styles/bootstrap.min.css">
    <link type="text/css" rel="stylesheet" href="/public/static/admin/css/base.css">
    <link type="text/css" rel="stylesheet" href="/public/static/admin/css/style.css">
</head>
<body style="overflow:hidden;">
<div class="loginbox">
<form action="" method="post" id="login_form">
    <div class="itemlogo"><img src="/public/static/admin/images/kblogo.png"></div>
    <div class="itemdiv"><input type="text" name="uname" class="text form-control" placeholder="用户名" id="uname"></div>
    <div class="itemdiv"><input type="password" name="password" class="text form-control" placeholder="密码" id="password"></div>
    <div class="itemdiv"><input type="text" name="code" class="yztext form-control w50" placeholder="验证码" id="code" maxlength="4"><span class="yzcode" style="cursor:pointer;"><img style="width:110px"; border:0;padding:0;" src="<?php echo captcha_src(); ?>" onclick=this.src="<?php echo captcha_src(); ?>?id="+Math.random() id="code_img"></span></div>
    <div class="itemdiv"><input type="submit" value="登 录" class="lbtn"></div>
</form>        
</div>
<iframe src="loginbg3.html" width="100%" height="100%" scrolling="0" frameborder="0" id="login_bg"></iframe>
<script src="/public/static/admin/script/jquery-1.10.2.min.js"></script>
<script src="/public/static/admin/plus/layer/layer.js"></script>

 <!--[if lte IE 10 ]>
<script>
(function(){
    $('#login_bg').hide();
    $('body').css('background','url(canvas_js/4.jpg) no-repeat;')
})();   
</script>   
<![endif]-->
<script>
    (function(){
        var sn=1+Math.random()*3;
        $('#login_bg').attr('src','loginbg'+parseInt(sn)+'.html');
    })();   
    </script>

<script type="text/javascript">
    $('form').submit(function(){
    
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
