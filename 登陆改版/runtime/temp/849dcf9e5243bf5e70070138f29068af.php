<?php if (!defined('THINK_PATH')) exit(); /*a:4:{s:69:"E:\phpstudy_pro\WWW\www.home.com/application/admin\view\cate\edit.htm";i:1584698602;s:71:"E:\phpstudy_pro\WWW\www.home.com\application\admin\view\common\head.htm";i:1584698602;s:70:"E:\phpstudy_pro\WWW\www.home.com\application\admin\view\common\top.htm";i:1625984588;s:71:"E:\phpstudy_pro\WWW\www.home.com\application\admin\view\common\left.htm";i:1584698602;}*/ ?>
    <!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>KBYCMS管理系统</title>

    <meta name="description" content="Dashboard">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <!--Basic Styles-->
    <link href="/public/static/admin/style/bootstrap.css" rel="stylesheet">
    <link href="/public/static/admin/style/font-awesome.css" rel="stylesheet">
    <link href="/public/static/admin/style/weather-icons.css" rel="stylesheet">
    <link href="/public/static/admin/css/style_new.css" rel="stylesheet">

    <!--Beyond styles-->
    <link id="beyond-link" href="/public/static/admin/style/beyond.css" rel="stylesheet" type="text/css">
    <link href="/public/static/admin/style/demo.css" rel="stylesheet">
    <link href="/public/static/admin/style/typicons.css" rel="stylesheet">
    <link href="/public/static/admin/style/animate.css" rel="stylesheet">
    <link href="/public/static/admin/plus/fileinput/fileinput.min.css" rel="stylesheet">
    <script src="/public/static/admin/style/jquery_002.js"></script>
    <script src="/public/static/admin/plus/layer/layer.js"></script>
    <script src="/public/static/admin/plus/laydate/laydate.js"></script>
    <script src="/public/static/admin/plus/fileinput/fileinput.min.js"></script>
    <script src="/public/static/admin/plus/fileinput/zh.js"></script>
    <script src="/public/static/admin/plus/fileinput/sortable.min.js"></script>
    <script src="/public/static/admin/script/common.js"></script>


</head>
<body>
    <!-- 页面顶部 -->
    
    <div class="navbar">
    <div class="navbar-inner" style="background: #000000;">
        <div class="navbar-container">
            <!-- Navbar Barnd -->
            <div class="navbar-header pull-left">
                <a href="#" class="navbar-brand">
                    <small>
                            <img src="/public/static/admin/images/logo.png" alt="">
                        </small>
                </a>
            </div>
            <!-- /Navbar Barnd -->
            <!-- Sidebar Collapse -->
            <div class="sidebar-collapse" id="sidebar-collapse">
                <i class="collapse-icon fa fa-bars"></i>
            </div>
            <div class="sidebar-collapses" >
                <a href="<?php echo url('admin/Cate/cateList'); ?>" class="btn btn-default">站点栏目管理</a>
                <!-- <a href="<?php echo url('admin_en/Cate/cateList'); ?>" class="btn btn-default">英文站点管理</a> -->
            </div>
            <!-- /Sidebar Collapse -->
            <!-- Account Area and Settings -->
            <div class="navbar-header pull-right">
                <div class="navbar-account">
                    <ul class="account-area" >
                        <li>
                            <a class="login-area dropdown-toggle" data-toggle="dropdown">
                                <div class="avatar" title="View your public profile">
                                    <!--img src="/public/static/admin/images/adam-jansen.jpg"-->
                                    <span style="font-size:30px;" class="glyphicon glyphicon-user"></span>
                                </div>
                                <section>
                                    <h2><span class="profile"><span><?php echo \think\Session::get('uname'); ?></span></span></h2>
                                </section>
                            </a>
                            <!--Login Area Dropdown-->
                            <ul class="pull-right dropdown-menu dropdown-arrow dropdown-login-area">
                                <li class="username"><a><?php echo \think\Session::get('uname'); ?></a></li>
                                <li class="dropdown-footer">
                                    <a href="<?php echo url('index/Index/index'); ?>" target="_blank">前台首页</a>
                                </li>
                                <li class="dropdown-footer">
                                    <a href="#modal-form" data-toggle="modal">修改密码</a>
                                </li>
                                <li class="dropdown-footer">
                                    <a href="<?php echo url('Admin/logout'); ?>">退出登录</a>
                                </li>
                            </ul>
                        </li>
               
                    </ul>
                    
                </div>
            </div>
        </div>
    </div>
</div>


<div id="modal-form" class="modal fade" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-body">
                <div class="row">
                    <div class="col-sm-12 b-r">
                        <h3 class="m-t-none m-b">修改密码</h3>
                        <form role="form" id="update_pwd">
                            <div class="form-group">
                                <label>账号：</label>
                                <input type="text" class="form-control" name="uname" require="true" id="uname" value="<?php echo \think\Session::get('uname'); ?>">
                            </div>
                            <div class="form-group">
                                <label>原密码：</label>
                                <input type="password" placeholder="请输入原密码" class="form-control" name="old_pwd" require="true" id="old_pwd">
                            </div>
                            <div class="form-group">
                                <label>新密码：</label>
                                <input type="password" placeholder="请输入新密码" class="form-control" name="new_pwd" require="true" id="password">
                            </div>
                            <div class="form-group">
                                <label>重复密码：</label>
                                <input type="password" placeholder="重复输入新密码" class="form-control {required:true,minlength:6,equalTo:'#password'}" name="confirm_password" require="true" id="new_pwd2">
                            </div>
                            <div>
                                <button class="btn btn-sm btn-primary pull-right m-t-n-xs" type="submit" id="update_pwd_btn"><strong>确认提交</strong>
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<script type="text/javascript" src="/public/static/admin/plus/validate/jquery.validate.min.js"></script>
<script type="text/javascript">
        var validate = $("#update_pwd").validate({
            debug: false, //调试模式取消submit的默认提交功能   
            //errorClass: "label.error", //默认为错误的样式类为：error   
            focusInvalid: false, //当为false时，验证无效时，没有焦点响应  
            onkeyup: false,   
            submitHandler: function(form){   //表单提交句柄,为一回调函数，带一个参数：form   
                $.ajax({
                    url:"<?php echo url('admin/updatePwd'); ?>",
                    type:'post',
                    data:{old_pwd:form.old_pwd.value,new_pwd:form.new_pwd.value,uname:uname.value},
                    async : false,
                    dataType:'json',
                    success:function(data){

                        if(data.status == 1){
                            layer.tips(data.msg, '#update_pwd_btn',{
                                tips: [4, '#78BA32'],
                                time:600,
                                end: function(){
                                window.location.href="";
                                }
                            })
                        }else{

                           layer.tips(data.msg, '#update_pwd_btn',{tips: [4, '#78BA32']});
                        }
                    },
                    error:function(){

                    }
                });

                return false;  
                form.submit();   //提交表单   
            },   
            
            rules:{
                uname:{
                    required:true,
                    rangelength:[4,16]
                },
                old_pwd:{
                    required:true
                },
                new_pwd:{
                    required:true,
                    rangelength:[6,16]
                },
                confirm_password:{
                    equalTo:"#password"
                }                    
            },
            messages:{
                uname:{
                    required:"请输入账号",
                    rangelength: '账号是5到15位'
                },
                old_pwd:{
                    required:"请输入密码"
                },
                new_pwd:{
                    required: "不能为空",
                    rangelength: '密码是6到16位'
                },
                confirm_password:{
                    equalTo:"两次密码输入不一致"
                }                                    
            }
                      
        });    
    </script>
	<!-- /头部 -->
	
	<div class="main-container container-fluid">
		<div class="page-container">
			<!-- Page Sidebar -->
                        <div class="page-sidebar" id="sidebar">
                <!-- Page Sidebar Header-->
                <div class="sidebar-header-wrapper">
                    <!--input class="searchinput" type="text"-->
                    <!--i class="searchicon fa fa-search"></i-->
                    <div class="searchhelper">Search Reports, Charts, Emails or Notifications</div>
                </div>
                <!-- /Page Sidebar Header -->
                <!-- Sidebar Menu -->
                <ul class="nav sidebar-menu">

                    <?php if(is_array($menu) || $menu instanceof \think\Collection || $menu instanceof \think\Paginator): if( count($menu)==0 ) : echo "" ;else: foreach($menu as $key=>$vo): ?>
                    <li <?php $arr=explode('/',$vo['name']); $pcon=$arr[1]; if($pcon==$con){ echo 'class="active open"';} ?>  >
                        <a href="#" class="menu-dropdown">
                            <i class="menu-icon fa <?php echo $vo['icon']; ?>"></i>
                            <span class="menu-text"><?php echo $vo['title']; ?></span>
                            <i class="menu-expand"></i>
                        </a>
                    
                    <ul class="submenu">
                        <?php if(is_array($vo['children']) || $vo['children'] instanceof \think\Collection || $vo['children'] instanceof \think\Paginator): if( count($vo['children'])==0 ) : echo "" ;else: foreach($vo['children'] as $key=>$vo2): ?>
                            <li <?php if($name == $vo2['name']): ?> class="active" <?php endif; ?>>
                                <a href="<?php echo url($vo2['name']); ?>">
                                    <span class="menu-text">
                                        <?php echo $vo2['title']; ?>                        </span>
                                    <i class="menu-expand"></i>
                                </a>
                            </li>
                        <?php endforeach; endif; else: echo "" ;endif; ?>
                    </ul>
                    </li>
                    <?php endforeach; endif; else: echo "" ;endif; ?>
                </ul>
                <!-- /Sidebar Menu -->
            </div>
            <!-- /Page Sidebar -->
            <!-- Page Content -->
            <div class="page-content">
                <!-- Page Breadcrumb -->
                <div class="page-breadcrumbs">
                    <ul class="breadcrumb">
                        <li>
                            <a href="<?php echo url('Index/index'); ?>">系统</a>
                        </li>
                         <li>
                            <a href="<?php echo url('Cate/lst'); ?>">栏目管理</a>
                        </li>
                        <li class="active">添加栏目</li>
                    </ul>
                </div>
                <!-- /Page Breadcrumb -->

                <!-- Page Body -->
                <div class="page-body">
                    
<div class="row">
    <div class="col-lg-12 col-sm-12 col-xs-12">
        <div class="widget">
        <form class="form-horizontal" role="form" action="" method="post" enctype="multipart/form-data">
        <input type="hidden" name="id" value="<?php echo $cates['id']; ?>">
            <div class="widget-body">
                <div class="widget-main ">
                    <div class="tabbable">
                        <ul class="nav nav-tabs tabs-flat" id="myTab11">
                            <li class="active">
                                <a data-toggle="tab" href="#home1">
                                    基本信息
                                </a>
                            </li>
                            <li>
                                <a data-toggle="tab" href="#profile2">
                                    栏目信息
                                </a>
                            </li>
                            <li>
                                <a data-toggle="tab" href="#profile3">
                                    栏目内容
                                </a>
                            </li>
                        </ul>
                        <div class="tab-content tabs-flat">
                            <div id="home1" class="tab-pane in active">
                                <div class="form-group">
                                    <label for="username" class="col-sm-2 control-label no-padding-right">所属模型</label>
                                    <div class="col-sm-6">
                                       <select name="model_id">
                                            <?php if(is_array($modelRes) || $modelRes instanceof \think\Collection || $modelRes instanceof \think\Paginator): $i = 0; $__LIST__ = $modelRes;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$model): $mod = ($i % 2 );++$i;?>
                                               <option <?php if($model['id'] == $cates['model_id']): ?> selected="selected" <?php endif; ?> value="<?php echo $model['id']; ?>"><?php echo $model['model_name']; ?></option>
                                             <?php endforeach; endif; else: echo "" ;endif; ?>
                                       </select>
                                    </div>
                                    <p class="help-block col-sm-4 red">* 必填</p>
                                </div>
                                <div class="form-group">
                                    <label for="username" class="col-sm-2 control-label no-padding-right">上级栏目</label>
                                    <div class="col-sm-6">
                                       <select name="pid">
                                           <option value="0">顶级栏目</option>
                                            <?php if(is_array($cateRes) || $cateRes instanceof \think\Collection || $cateRes instanceof \think\Paginator): $i = 0; $__LIST__ = $cateRes;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$cate): $mod = ($i % 2 );++$i;?>
                                           <option <?php if($cate['id'] == $cates['pid']): ?> selected="selected" <?php endif; ?> value="<?php echo $cate['id']; ?>"><?php echo str_repeat('-',$cate['level']*4);?><?php echo $cate['cate_name']; ?></option>
                                            <?php endforeach; endif; else: echo "" ;endif; ?>
                                       </select>
                                    </div>
                                    <p class="help-block col-sm-4 red">* 必填</p>
                                </div>
                                <div class="form-group">
                                    <label for="username" class="col-sm-2 control-label no-padding-right">语言版本</label>
                                    <div class="col-sm-6">
                                       <select name="language">
                                       <?php if(is_array($language) || $language instanceof \think\Collection || $language instanceof \think\Paginator): $i = 0; $__LIST__ = $language;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$langs): $mod = ($i % 2 );++$i;?>
                                           <option <?php if($langs == $cates['language']): ?> selected="selected" <?php endif; ?> value="<?php echo $langs; ?>"><?php echo $langs; ?></option>
                                       <?php endforeach; endif; else: echo "" ;endif; ?>
                                       </select>
                                    </div>
                                    <p class="help-block col-sm-4 red">* 必填</p>
                                </div>
                                <div class="form-group">
                                    <label for="username" class="col-sm-2 control-label no-padding-right">栏目名称</label>
                                    <div class="col-sm-6">
                                        <input class="form-control"  placeholder="" name="cate_name" required="" type="text" value="<?php echo $cates['cate_name']; ?>">
                                    </div>
                                    <p class="help-block col-sm-4 red">* 必填</p>
                                </div>
                                <div class="form-group">
                                    <label for="username" class="col-sm-2 control-label no-padding-right">附栏目名称</label>
                                    <div class="col-sm-6">
                                        <input class="form-control"  placeholder="" name="cate_ename"  type="text" value="<?php echo $cates['cate_ename']; ?>">
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label for="username" class="col-sm-2 control-label no-padding-right">栏目级别</label>
                                    <div class="col-sm-6">
                                       <select name="level">

                                           <option value="1" <?php if($cates['level'] == 1): ?>selected<?php endif; ?>>一级列表</option>
                                           <option value="2" <?php if($cates['level'] == 2): ?>selected<?php endif; ?>>二级列表</option>
                                           <option value="3" <?php if($cates['level'] == 3): ?>selected<?php endif; ?>>三级列表</option>
                                           <option value="4" <?php if($cates['level'] == 4): ?>selected<?php endif; ?>>四级列表</option>
                                           <option value="-1" <?php if($cates['level'] == -1): ?>selected<?php endif; ?>>无限级列表</option>
                                           <option value="0" <?php if($cates['level'] == 0): ?>selected<?php endif; ?>>基础信息</option>
                                       </select>
                                    </div>
                                    <p class="help-block col-sm-4 red">* 必填</p>
                                </div>

                                <?php if($cates['pid'] == 0): ?>
                                <div class="form-group">
                                    <label for="username" class="col-sm-2 control-label no-padding-right">栏目图标</label>
                                    <div class="col-sm-6">
                                    <!--单选-->
                                       <div class="radio" style="float:left; padding-left:10px;">
                                                <label>
                                                    <input <?php if($cates['icon'] == 'fa-users'): ?> checked="checked" <?php endif; ?> name="icon" value="fa-users" type="radio">
                                                    <span class="text"><i class="fa fa-users"></i></span>
                                                </label>
                                                <label>
                                                    <input <?php if($cates['icon'] == 'fa-cogs'): ?> checked="checked" <?php endif; ?> name="icon" value="fa-cogs" type="radio">
                                                    <span class="text"><i class="fa fa-cogs"></i></span>
                                                </label>
                                                <label>
                                                    <input <?php if($cates['icon'] == 'fa-th-list'): ?> checked="checked" <?php endif; ?> name="icon" value="fa-th-list" type="radio">
                                                    <span class="text"><i class="fa fa-th-list"></i></span>
                                                </label>
                                                <label>
                                                    <input <?php if($cates['icon'] == 'fa-bullhorn'): ?> checked="checked" <?php endif; ?> name="icon" value="fa-bullhorn" type="radio">
                                                    <span class="text"><i class="fa fa-bullhorn"></i></span>
                                                </label>
                                                <label>
                                                    <input <?php if($cates['icon'] == ' fa-globe'): ?> checked="checked" <?php endif; ?> name="icon" value="fa-globe" type="radio">
                                                    <span class="text"><i class="fa  fa-globe"></i></span>
                                                </label>
                                                <label>
                                                    <input <?php if($cates['icon'] == 'fa-phone-square'): ?> checked="checked" <?php endif; ?> name="icon" value="fa-phone-square" type="radio">
                                                    <span class="text"><i class="fa  fa-phone-square"></i></span>
                                                </label>
                                                <label>
                                                    <input <?php if($cates['icon'] == 'fa-book'): ?> checked="checked" <?php endif; ?> name="icon" value="fa-book" type="radio">
                                                    <span class="text"><i class="fa   fa-book"></i></span>
                                                </label>
                                                <label>
                                                    <input <?php if($cates['icon'] == 'fa-picture-o'): ?> checked="checked" <?php endif; ?> name="icon" value="fa-picture-o" type="radio">
                                                    <span class="text"><i class="fa   fa-picture-o"></i></span>
                                                </label>
                                                <label>
                                                    <input <?php if($cates['icon'] == 'fa-truck'): ?> checked="checked" <?php endif; ?> name="icon" value="fa-truck" type="radio">
                                                    <span class="text"><i class="fa   fa-truck"></i></span>
                                                </label>
                                                <label>
                                                    <input <?php if($cates['icon'] == ' fa-user'): ?> checked="checked" <?php endif; ?> name="icon" value="fa-user" type="radio">
                                                    <span class="text"><i class="fa    fa-user"></i></span>
                                                </label>
                                                <label>
                                                    <input <?php if($cates['icon'] == 'fa-comments-o'): ?> checked="checked" <?php endif; ?> name="icon" value="fa-comments-o" type="radio">
                                                    <span class="text"><i class="fa fa-comments-o"></i></span>
                                                </label>
                                                <label>
                                                    <input <?php if($cates['icon'] == 'fa-keyboard-o'): ?> checked="checked" <?php endif; ?> name="icon" value="fa-keyboard-o" type="radio">
                                                    <span class="text"><i class="fa  fa-keyboard-o"></i></span>
                                                </label>
                                            </div>
                                    </div>
                                    <p class="help-block col-sm-4 red">* 必填</p>
                                </div>
                                <?php endif; ?>
                                <div class="form-group">
                                    <label for="username" class="col-sm-2 control-label no-padding-right">跳转ID</label>
                                    <div class="col-sm-6">
                                        <input class="form-control" value="<?php echo $cates['jump_id']; ?>"  placeholder="" name="jump_id"  type="text" value="<?php echo $cates['cate_ename']; ?>">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="username" class="col-sm-2 control-label no-padding-right">隐藏栏目</label>
                                        <div class="col-xs-6">
                                            <label >
                                                <input value="" name="status" <?php if($cates['status'] != 1): ?> checked="checked" <?php endif; ?> class="checkbox-slider colored-blue" type="checkbox">
                                                <span class="text"></span>
                                            </label>
                                        </div>
                                    <p class="help-block col-sm-4 red">* 必填</p>
                                </div>

                                <div class="form-group">
                                    <label for="username" class="col-sm-2 control-label no-padding-right">是否底部导航</label>
                                        <div class="col-sm-6">
                                            <!-- 单选 -->
                                            <div class="radio" style="float:left; padding-left:10px;">
                                                <label>
                                                    <input <?php if($cates['bottom_nav'] == 1): ?> checked="checked" <?php endif; ?> name="bottom_nav" value="1" type="radio">
                                                    <span class="text">是</span>
                                                </label>
                                            </div>
                                            <!-- 单选 -->
                                            <div class="radio" style="float:left; padding-left:10px;">
                                                <label>
                                                    <input  <?php if($cates['bottom_nav'] == 0): ?> checked="checked" <?php endif; ?>  name="bottom_nav" value="0" type="radio">
                                                    <span class="text">否</span>
                                                </label>
                                            </div>
                                        </div>
                                    <p class="help-block col-sm-4 red">* 必填</p>
                                </div>

                                <div class="form-group">
                                    <label for="username" class="col-sm-2 control-label no-padding-right">是否左侧导航</label>
                                        <div class="col-sm-6">
                                            <!-- 单选 -->
                                            <div class="radio" style="float:left; padding-left:10px;">
                                                <label>
                                                    <input <?php if($cates['programa'] == 1): ?> checked="checked" <?php endif; ?>    name="programa" value="1" type="radio">
                                                    <span class="text">是</span>
                                                </label>
                                            </div>
                                            <!-- 单选 -->
                                            <div class="radio" style="float:left; padding-left:10px;">
                                                <label>
                                                    <input <?php if($cates['programa'] == 0): ?> checked="checked" <?php endif; ?> name="programa" value="0" type="radio">
                                                    <span class="text">否</span>
                                                </label>
                                            </div>
                                        </div>
                                    <p class="help-block col-sm-4 red">* 必填</p>
                                </div>
                             
                             <div class="form-group">
                                    <label for="username" class="col-sm-2 control-label no-padding-right">栏目图片</label>
                                    <div class="col-sm-6">
                                        <label>
                                            <span id="uploadify" ></span>
                                            <input name="img" value="<?php echo $cates['img']; ?>" type="hidden">
                                        </label>
                                        <label>
                                            <div id="cancel" name="img" value="" type="float:left;" class="uploadify-button btn btn-azure"><span class="uploadify-button-text"><i class="fa fa-rotate-left" style="padding-right:4px;"></i>撤销上传</span></div>
                                        </label>
                                    </div>
                                </div>
                                <div class="form-group" id="cateimgdiv" <?php if($cates['img'] == ''): ?> style="display:none;" <?php endif; ?>>
                                <label for="username" class="col-sm-2 control-label no-padding-right"></label>
                                    <div class="col-sm-6">
                                        <span id="cateimg" ><?php if($cates['img'] != ''): ?><img src="/public/static/index/uploads/cateimg/<?php echo $cates['img']; ?>" height="50px"> <?php endif; ?></span>
                                    </div>
                                </div>

                                <?php if($cates['pid'] == 23): ?>
                                <div class="form-group">
                                    <label for="username" class="col-sm-2 control-label no-padding-right">附件上传</label>
                                    <div class="col-sm-6">
                                        <input style="float:left;"  placeholder="" name="cate_file"  type="file" value="" width="215px">
                                        <?php if($cates['cate_file'] != ''): ?>
                                        <span><?php echo $cates['cate_file']; ?></span><a style="display: inline; height:30px"  href='javascript:;' onclick='delimg(this);'>删除文件</a>
                                        <?php endif; ?>
                                    </div>
                                    <p class="help-block col-sm-4 red"></p>
                                </div>
                                <?php endif; ?>


                                <div class="form-group">
                                    <label for="username" class="col-sm-2 control-label no-padding-right">栏目属性</label>
                                    <div class="col-sm-6">
                                        <div class="radio" style="float:left; padding-left:10px;">
                                                <label>
                                                    <input name="cate_attr" value="1" <?php if($cates['cate_attr'] == 1): ?> checked="checked" <?php endif; ?> type="radio">
                                                    <span class="text">列表页栏目 </span>
                                                </label>
                                         </div>
                                         <div class="radio" style="float:left; padding-left:10px;">
                                                <label>
                                                    <input name="cate_attr" value="2" <?php if($cates['cate_attr'] == 2): ?> checked="checked" <?php endif; ?>  type="radio">
                                                    <span class="text">单页栏目 </span>
                                                </label>
                                         </div>
                                         <div class="radio" style="float:left; padding-left:10px;">
                                                <label>
                                                    <input name="cate_attr" value="3" <?php if($cates['cate_attr'] == 3): ?> checked="checked" <?php endif; ?>  type="radio">
                                                    <span class="text">外链栏目 </span>
                                                </label>
                                         </div>
                                    </div>
                                    <p class="help-block col-sm-4 red">* 必填</p>
                                </div>
                                <div class="form-group">
                                    <label for="username" class="col-sm-2 control-label no-padding-right">列表页模版</label>
                                    <div class="col-sm-6">
                                        <input class="form-control"  placeholder="" name="list_tmp" required="" type="text" value="<?php echo $cates['list_tmp']; ?>">
                                    </div>
                                    <p class="help-block col-sm-4 red">* 必填</p>
                                </div>
                                <div class="form-group">
                                    <label for="username" class="col-sm-2 control-label no-padding-right">单页模版</label>
                                    <div class="col-sm-6">
                                        <input class="form-control"  placeholder="" name="index_tmp" required="" type="text" value="<?php echo $cates['index_tmp']; ?>">
                                    </div>
                                    <p class="help-block col-sm-4 red">* 必填</p>
                                </div>
                                <div class="form-group">
                                    <label for="username" class="col-sm-2 control-label no-padding-right">内容页模版</label>
                                    <div class="col-sm-6">
                                        <input class="form-control"  placeholder="" name="article_tmp" required="" type="text" value="<?php echo $cates['article_tmp']; ?>">
                                    </div>
                                    <p class="help-block col-sm-4 red">* 必填</p>
                                </div>
                                <div class="form-group">
                                    <label for="username" class="col-sm-2 control-label no-padding-right">外链地址</label>
                                    <div class="col-sm-6">
                                        <input class="form-control"  placeholder="" name="link"  type="text" value="<?php echo $cates['link']; ?>">
                                    </div>
                                    <p class="help-block col-sm-4 red">* 如果是外链类型请在此填写外链地址以http://开头</p>
                                </div>
                            </div>
                            <div id="profile2" class="tab-pane">
                                <div class="form-group">
                                    <label for="username" class="col-sm-2 control-label no-padding-right">栏目标题</label>
                                    <div class="col-sm-6">
                                        <input class="form-control"  placeholder="" name="title"  type="text" value="<?php echo $cates['title']; ?>">
                                    </div>
                                    <!--p class="help-block col-sm-4 red">* 必填</p-->
                                </div>
                                <div class="form-group">
                                    <label for="username" class="col-sm-2 control-label no-padding-right">关键词</label>
                                    <div class="col-sm-6">
                                        <input class="form-control"   name="keywords"  type="text" value="<?php echo $cates['keywords']; ?>">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="username" class="col-sm-2 control-label no-padding-right">描述</label>
                                    <div class="col-sm-6">
                                        <textarea class="form-control"  name="desc"><?php echo $cates['desc']; ?></textarea>
                                    </div>
                                </div>

                            </div>
                            <div id="profile3" class="tab-pane">
                                <textarea id="content"    name="content"><?php echo $cates['content']; ?></textarea>

                            </div>
                        </div>
                    </div>
                </div>
                <div class="form-group">
                    <div class="col-sm-offset-2 col-sm-10">
                        <button type="submit" class="btn btn-default">保存信息</button>
                    </div>
                </div>
           </form>
        </div>

                </div>
            </div>
        </div>
    </div>
</div>

                </div>
                <!-- /Page Body -->
            </div>
            <!-- /Page Content -->
		</div>	
	</div>

	    <!--Basic Scripts-->

    <script src="/public/static/admin/style/bootstrap.js"></script>
    <!--<script src="/public/static/admin/style/jquery.js"></script>
    Beyond Scripts-->
    <script src="/public/static/admin/style/beyond.js"></script>
    <script src="/public/static/admin/plus/layer/layer.js"></script>
    <script src="/public/static/admin/plus/ueditor/ueditor.config.js"></script>
    <script src="/public/static/admin/plus/ueditor/ueditor.all.js"></script>
    <script src="/public/static/admin/plus/ueditor/lang/zh-cn/zh-cn.js"></script>
<script type="text/javascript">

    //实例化编辑器
    var editor_a = new baidu.editor.ui.Editor();
    editor_a.render( 'content' ); //此处的参数值为编辑器的id值

    $("#cancel").click(function(){
        var cateid=<?php echo $cates['id']; ?>;
        var img='img';
        var imgurl=$("input[name='img']").val();
        if(!imgurl){
            layer.msg('请先上传图片！', {icon: 2}); 
            return false;
        }
       layer.confirm('确认清除图片吗？', {icon: 3, title:'提示'}, function(index){
            $("#cateimgdiv").hide();
            $("input[name='img']").val('');
            $.ajax({
                type:"post",
                dataType:"json",
                data:{imgurl:imgurl,cateid:cateid,img:img},
                url:"<?php echo url('Cate/delimg'); ?>",
                success:function(data){
                    if(data==1){
                        layer.msg('撤销成功！', {icon: 1}); 
                    }else{
                         layer.msg('撤销失败!', {icon: 2}); 
                    }
                }
            });
            layer.close(index);
        });
    });

     <!--ajax删除附件开始-->
                            function delimg(o){
                                layer.confirm('你确认要删除文件吗？', {icon: 3, title:'提示'}, function(index){
                                    var cateid=<?php echo $cates['id']; ?>;
                                    var img='cate_file';
                                    var file=$(o).prev();
                                    var imgurl=file.html();
                                    //alert(imgurl);
                                    file.remove();
                                    $(o).remove();
                                    $.ajax({
                                        type:"POST",
                                        url:"<?php echo url('Cate/delimg'); ?>",
                                        dataType:"json",
                                        data:{imgurl:imgurl,cateid:cateid,img:img},
                                        success:function(data){
                                            if(data==1){
                                                    //alert('撤销成功！');
                                                        layer.msg('删除成功！', {icon: 1}); 
                                                    }else{
                                                        //alert('撤销失败!');
                                                        layer.msg('删除失败!', {icon: 2}); 
                                                    }
                                              }
                                    });
                                layer.close(index);
                                 });
                            }
                       
                       <!--ajax删除附件结束-->

        //修改模版
            function changetmp(){
                 var pcateid=$("select[name=pid]").find("option:selected").val();
                if(pcateid != 0){
                    $.ajax({
                        type:"post",
                        dataType:"json",
                        data:{cateid:pcateid},
                        url:"<?php echo url('Cate/ajaxcateinfo'); ?>",
                        success:function(data){
                            $("input[name=list_tmp").val(data.list_tmp);
                            $("input[name=index_tmp").val(data.index_tmp);
                            $("input[name=article_tmp").val(data.article_tmp);
                            $("select[name=model_id]").val(data.model_id);
                        }
                    });
                }
            }


            //选择上级栏目更改模版数据
           $("select[name=pid]").change(function(){
            changetmp();
           });

</script>


</body></html>