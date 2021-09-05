<?php if (!defined('THINK_PATH')) exit(); /*a:4:{s:75:"F:\phpstudy_pro\WWW\www.kbycms.com/application/admin\view\content\edits.htm";i:1630675537;s:73:"F:\phpstudy_pro\WWW\www.kbycms.com\application\admin\view\common\head.htm";i:1630419368;s:72:"F:\phpstudy_pro\WWW\www.kbycms.com\application\admin\view\common\top.htm";i:1625984588;s:73:"F:\phpstudy_pro\WWW\www.kbycms.com\application\admin\view\common\left.htm";i:1584698602;}*/ ?>
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
    <link href="/public/static/admin/font-awesome/css/font-awesome.css" rel="stylesheet">
    <link href="/public/static/admin/style/weather-icons.css" rel="stylesheet">
    <link href="/public/static/admin/css/style_new.css" rel="stylesheet">

    <!--Beyond styles-->
    <link id="beyond-link" href="/public/static/admin/style/beyond.css" rel="stylesheet" type="text/css">
    <link href="/public/static/admin/style/demo.css" rel="stylesheet">
    <link href="/public/static/admin/style/typicons.css" rel="stylesheet">
    <link href="/public/static/admin/style/animate.css" rel="stylesheet">
	 <link href="/public/static/admin/ckeditor/samples/css/samples.css" rel="stylesheet">
    <link href="/public/static/admin/plus/fileinput/fileinput.min.css" rel="stylesheet">
    <script src="/public/static/admin/style/jquery_002.js"></script>
    <script src="/public/static/admin/plus/layer/layer.js"></script>
    <script src="/public/static/admin/plus/laydate/laydate.js"></script>
    <script src="/public/static/admin/plus/fileinput/fileinput.min.js"></script>
    <script src="/public/static/admin/plus/fileinput/zh.js"></script>
    <script src="/public/static/admin/plus/fileinput/sortable.min.js"></script>
    <script src="/public/static/admin/script/common.js"></script>
    <script src="/public/static/admin/ckeditor/ckeditor.js"></script>
	<script src="/public/static/admin/ckeditor/ckfinder/ckfinder.js"></script>
    <script src="/public/static/admin/ckeditor/lang/zh-cn.js"></script>
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
                        <a href="<?php echo url('Cate/catelist'); ?>">站点管理</a>
                    </li>
                   <?php if(is_array($pos) || $pos instanceof \think\Collection || $pos instanceof \think\Paginator): if( count($pos)==0 ) : echo "" ;else: foreach($pos as $k=>$cate): if($k == (count($pos)-1)): if($pos[$k]['level'] == $k): ?>

                                       <li><a href="<?php echo url('content/lsts',(['cate_id'=>$cate['id'],'model_id'=>$cate['model_id']])); ?>"><?php echo $cate['cate_name']; ?></a></li>


                                       <?php else: ?>


                                      <li><a href="<?php echo url('cate/cateList',(['cate_id'=>$cate['id'],'model_id'=>$cate['model_id']])); ?>"><?php echo $cate['cate_name']; ?></a></li>   

                                    <?php endif; else: ?>


                                 <li><a href="<?php echo url('cate/cateList',(['cate_id'=>$cate['id'],'model_id'=>$cate['model_id']])); ?>"><?php echo $cate['cate_name']; ?></a></li>   

                             <?php endif; endforeach; endif; else: echo "" ;endif; ?>
                    <li class="active">编辑文档</li>
                    </ul>
                </div>
                <!-- Page Body -->
                <div class="page-body">
<!-- 
                     <script src="/public/static/admin/plus/ueditor/ueditor.config.js"></script>
<script src="/public/static/admin/plus/ueditor/ueditor.all.min.js"></script>  
<script src="/public/static/admin/plus/ueditor/lang/zh-cn/zh-cn.js"></script>   -->


                 
<script>
    //  上传文件前置路径
    fileServiceRootUrl = '/public/static/index/uploads/att/';
</script>              
<div class="row">
    <div class="col-lg-12 col-sm-12 col-xs-12">
        <div class="widget">
            <div class="widget-header bordered-bottom bordered-blue">
                <span class="widget-caption">编辑文档</span>
            </div>
            <div class="widget-body">
                <div id="horizontal-form">
                    <form enctype="multipart/form-data" class="form-horizontal" role="form" action="" method="post" id="content_form">
                        <input type="hidden" name="id" value="<?php echo $info['id']; ?>">
                        <div class="form-group">
                            <label for="username" class="col-sm-2 control-label no-padding-right">标题</label>
                            <div class="col-sm-6">
                                <input class="form-control"  placeholder="" name="title" required="" type="text" value="<?php echo $info['title']; ?>">
                            </div>
                            <p class="help-block col-sm-4 red">* 必填</p>
                        </div>
                       
                        <div class="form-group">
                            <label for="group_id" class="col-sm-2 control-label no-padding-right">所属栏目</label>
                           
                            <div class="col-sm-6">
                                <select  name="cate_id"  disabled="disabled">
                                    <option value="0">选择栏目</option>
                                    <?php if(is_array($pos) || $pos instanceof \think\Collection || $pos instanceof \think\Paginator): $i = 0; $__LIST__ = $pos;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$cate): $mod = ($i % 2 );++$i;?>
                                        <option <?php if($cate['id'] == $info['cate_id']): ?> selected="selected"<?php endif; ?>  value="<?php echo $cate['id']; ?>"><?php echo $cate['cate_name']; ?></option>
                                    <?php endforeach; endif; else: echo "" ;endif; ?>
                                </select>
                            </div>
                        <input type="hidden" name="cate_id" value="<?php echo $info['cate_id']; ?>">
                        </div>  
                 
                        <div class="form-group">
                            <label for="username" class="col-sm-2 control-label no-padding-right">是否显示</label>
                            <div class="col-sm-6">
                                <!-- 单选 -->
                                <div class="radio" style="float:left; padding-left:10px;">
                                    <label>
                                        <input <?php if($info['show'] == 1): ?> checked="checked" <?php endif; ?> name="show" value="1" type="radio">
                                        <span class="text">是</span>
                                    </label>
                                </div>
                                <!-- 单选 -->
                                <div class="radio" style="float:left; padding-left:10px;">
                                    <label>
                                        <input <?php if($info['show'] == 0): ?> checked="checked" <?php endif; ?> name="show" value="0" type="radio">
                                        <span class="text">否</span>
                                    </label>
                                </div>
                            </div>
                            <p class="help-block col-sm-4 red">* 必填</p>
                        </div>
                        <?php if(array_key_exists(1,$adShows)): ?>
                        <div class="form-group">
                                    <label for="username" class="col-sm-2 control-label no-padding-right"><?php echo $adShows['1']; ?></label>
                                        <div class="col-sm-6">
                                            <!-- 单选 -->
                                            <div class="radio" style="float:left; padding-left:10px;">
                                                <label>
                                                    <input <?php if($info['home'] == 1): ?> checked="checked" <?php endif; ?> name="home" value="1" type="radio">
                                                    <span class="text">是</span>
                                                </label>
                                            </div>
                                            <!-- 单选 -->
                                            <div class="radio" style="float:left; padding-left:10px;">
                                                <label>
                                                    <input  <?php if($info['home'] == 0): ?> checked="checked" <?php endif; ?>  name="home" value="0" type="radio">
                                                    <span class="text">否</span>
                                                </label>
                                            </div>
                                        </div>
                                    <p class="help-block col-sm-4 red">* 必填</p>
                                </div>
                        <?php endif; if(array_key_exists(9,$adShows)): ?>
                        <div class="form-group">
                            <label for="username" class="col-sm-2 control-label no-padding-right"><?php echo $adShows['9']; ?></label>
                                <div class="col-sm-6">
                                    <!-- 单选 -->
                                    <div class="radio" style="float:left; padding-left:10px;">
                                        <label>
                                            <input <?php if($info['related'] == 1): ?> checked="checked" <?php endif; ?> name="related" value="1" type="radio">
                                            <span class="text">是</span>
                                        </label>
                                    </div>
                                    <!-- 单选 -->
                                    <div class="radio" style="float:left; padding-left:10px;">
                                        <label>
                                            <input  <?php if($info['related'] == 0): ?> checked="checked" <?php endif; ?>  name="related" value="0" type="radio">
                                            <span class="text">否</span>
                                        </label>
                                    </div>
                                </div>
                            <p class="help-block col-sm-4 red">* 必填</p>
                        </div>
                        <?php endif; if(array_key_exists(2,$adShows)): ?>
                        <div class="form-group">
                            <label for="username" class="col-sm-2 control-label no-padding-right"><?php echo $adShows['2']; ?></label>
                            <div class="col-sm-6">
                                <input class="form-control" id="time"  placeholder="" name="time" required="" type="text" value="<?php echo date("Y-m-d",$info['time']); ?>">
                            </div>
                            <p class="help-block col-sm-4 red">* 必填</p>
                        </div>
                        <?php endif; if(array_key_exists(7,$adShows)): ?>
                        <div class="form-group">
                            <label for="username" class="col-sm-2 control-label no-padding-right"><?php echo $adShows['7']; ?></label>
                            <div class="col-sm-6">
                                <input class="form-control"  placeholder="" name="writer" type="text" value="<?php echo $info['writer']; ?>">
                            </div>
                        </div>
                        <?php endif; if(array_key_exists(8,$adShows)): ?>
                        <div class="form-group">
                            <label for="username" class="col-sm-2 control-label no-padding-right"><?php echo $adShows['8']; ?></label>
                            <div class="col-sm-6">
                                <input class="form-control"  placeholder="" name="link" type="text" value="<?php echo $info['link']; ?>">
                            </div>
                        </div>
                        <?php endif; if($pos['0']['id'] == 334 or $pos['0']['id'] == 335): ?>
                            <div class="form-group">
                                <label for="username" class="col-sm-2 control-label no-padding-right">视频文件</label>
                                <div class="col-sm-6">
                                    <input  name="mp4_file" type="file" id="mp4">
                                    <input  type="hidden" value="<?php echo $info['mp4_file']; ?>"  id="mp4Url">
                                    
                                </div>
                                <p class="help-block col-sm-4 red">* 必填</p>
                            </div>
                            <script>initFileInput('mp4','mp4Url',0);</script>
                        <?php endif; if(array_key_exists(6,$adShows)): ?>
                        <div class="form-group">
                            <label for="username" class="col-sm-2 control-label no-padding-right"><?php echo $adShows['6']; ?></label>
                            <div class="col-sm-6">
                                <input  name="a_img" type="file" value="<?php echo $info['a_img']; ?>" id="a_img">
                                <input  type="hidden" value="<?php echo $info['a_img']; ?>"  id="imgUrl">
                                
                            </div>
                            <p class="help-block col-sm-4 red">* 必填</p>
                        </div>
                        <script>initFileInput('a_img','imgUrl',1);</script>
                        <?php endif; ?>
            
                        <!--  自定义字段开始 -->
                       <?php foreach ($diyFields as $k => $v) :?>
                           <div class="form-group">
                            <label for="group_id" class="col-sm-2 control-label no-padding-right"><?php echo $v['field_cname']; ?></label>
                            <div class="col-sm-6">
                                <?php
                                    //1、单行 2、单选 3、复选 4、下拉 5、文本域 6、附件 7、浮点 8、整型 9、长文本longtest 
                                    switch ($v['field_type']) {
                                        case 1:
                                        case 7:
                                        case 8:
                                            //$fileType='varchar(150) not null default ""';
                                            echo "<input class='form-control'   name='".
                                            $v['field_ename']."'  type='text' value='".$info[$v['field_ename']]."'  placeholder=".$v['field_values']."  >";
                                            break;
                                        case 5:
                                            echo "<textarea class='form-control'  style='height:150px;'  name='".$v['field_ename']."' placeholder=".$v['field_values']."  >".$info[$v['field_ename']]."</textarea>";
                                            break;
                                        case 2:// 单选 
                                            if($v['field_values']){
                                                $arr=explode(',', $v['field_values']);
                                                foreach ($arr as $k1 => $v1){
                                                    if($info[$v['field_ename']] == $v1){
                                                        $check='checked="checked"';
                                                    }else{
                                                        $check='';
                                                    }
                                                     echo "<div class='radio' style='float:left; padding-left:10px;'>
                                                                <label>
                                                                    <input  type='radio' ".$check." name='".$v['field_ename']."' value='".$v1."'>
                                                                    <span class='text'>".$v1."</span>
                                                                </label>
                                                            </div>";
                                                }
                                            }
                                            break;
                                        case 3:
                                            if($v['field_values']){
                                                $arr=explode(',', $v['field_values']);
                                                $section=$info[$v['field_ename']];
                                                $section=explode(',', $section);
                                                foreach ($arr as $k1 => $v1){
                                                    if(in_array($v1, $section)){
                                                        $check='checked="checked"';
                                                    }else{
                                                        $check='';
                                                    }
                                                     echo "<div class='radio' style='float:left; padding-left:10px;'>
                                                                <label>
                                                                    <input class='colored-blue' ".$check."  type='checkbox' name='".$v['field_ename']."[]' value='".$v1."'>
                                                                    <span class='text'>".$v1."</span>
                                                                </label>
                                                            </div>";
                                                }
                                            }
                                            break;
                                        case 6:
                                      
                                        if($v['id']==0){

                                            echo "<input type='file' style='float:left;' id='".$v['field_ename']."' class='file' name='".$v['field_ename']."'><input type='hidden' value='".$info[$v['field_ename']]."' id='".$v['id']."'> <span class='text'>".$v['field_values']."</span><script>initFileInput('".$v['field_ename']."','".$v['id']."',false);</script>";



                                        }else{

       
                                             echo "<input type='file' style='float:left;' id='".$v['field_ename']."' class='file' name='".$v['field_ename']."'><input type='hidden' value='".$info[$v['field_ename']]."' id='".$v['id']."'> <span class='text'>".$v['field_values']."</span><script>initFileInput('".$v['field_ename']."','".$v['id']."',1);</script>";

                                        }

                                           
                                            break;
                                        case 4:
                                            if($v['field_values']){
                                                    $arr=explode(',', $v['field_values']);
                                                    if($info[$v['field_ename']] == $v1){
                                                            $select=' selected="selected"';
                                                        }else{
                                                            $selected='';
                                                        }
                                                        echo "<select name='".$v['field_ename']."'>";
                                                    foreach ($arr as $k1 => $v1){
                                                         echo "<option ".$select." value='".$v1."'>".$v1."</option>";
                                                    }
                                                    echo "</select>";
                                                }
                                                break;
                                        case 9:
                                            echo get_ueditor($v['field_ename'],$info[$v['field_ename']]);
                                            break;
                                        default:
                                            echo "<input class='form-control'   name='".
                                            $v['field_ename']."'  type='text' value='".$info[$v['field_ename']]."'>";
                                            break;
                                    }
                                ?>
                            </div>
                        </div>  
                      <?php endforeach;?>
                       <!--  自定义字段线束 -->
                       <?php if(array_key_exists(3,$adShows)): ?>
                        <div class="form-group">
                            <label for="group_id" class="col-sm-2 control-label no-padding-right"><?php echo $adShows['3']; ?></label>
                            <div class="col-sm-6">
                                <input class="form-control"  placeholder="" name="keywords"  type="text" value="<?php echo $info['keywords']; ?>">
                            </div>
                        </div>  
                        <?php endif; if(array_key_exists(4,$adShows)): ?>
                        <div class="form-group">
                            <label for="group_id" class="col-sm-2 control-label no-padding-right"><?php echo $adShows['4']; ?></label>
                            <div class="col-sm-6">
                                <textarea name="description" class="form-control" style="height: 100px;"><?php echo $info['description']; ?></textarea>
                            </div>
                        </div>  
                        <?php endif; ?>
                        <div class="form-group">
                            <label for="group_id" class="col-sm-2 control-label no-padding-right">排序</label>
                            <div class="col-sm-6">
                                <input class="form-control"  placeholder="" name="sort" required="" type="text" value="<?php echo $info['sort']; ?>">
                            </div>
                        </div>           
                       <!--ajax删除文件结束-->
                        <?php if(array_key_exists(5,$adShows)): ?>
                        <div class="form-group">
                            <label for="group_id" class="col-sm-2 control-label no-padding-right"><?php echo $adShows['5']; ?></label>
                            <div class="col-sm-6">
								<!-- <input type="text" id="content" name="content" value="<?php echo $info['content']; ?>"> -->
                               <textarea id="content" name="content" value="<?php echo $info['content']; ?>"><?php echo $info['content']; ?></textarea>
                            </div>
                        </div>  
                        <?php endif; if(array_key_exists(10,$adShows)): ?>
                        <div class="form-group">
                            <label for="group_id" class="col-sm-2 control-label no-padding-right"><?php echo $adShows['10']; ?></label>
                            <div class="col-sm-6">
                               <textarea id="all_img" name="all_img"><?php echo $info['all_img']; ?></textarea>
                            </div>
                        </div>  
                        <?php endif; ?>

                         <!--div class="form-group">
                            <label for="group_id" class="col-sm-2 control-label no-padding-right">点击量</label>
                            <div class="col-sm-6">
                                <input class="form-control"  placeholder="" name="click" required="" type="text" value="<?php echo $info['click']; ?>">
                            </div>
                        </div-->  
                        <div class="form-group">
                            <div class="col-sm-offset-2 col-sm-10">
                                <button type="submit" class="btn btn-default btn-info shiny" style="color:#fff !important;">保存信息</button>
                                <div style="padding-top:10px; text-align:center;"><a href="<?php echo url('content/lsts',array('cate_id'=>$info['cate_id'],'model_id'=>$info['model_id'])); ?>" class="btn">返回</a></div>
                            </div>
                        </div>
                    </form>
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
    <script src="/public/static/admin/style/jquery.js"></script>
    <!--Beyond Scripts-->
    <script src="/public/static/admin/style/beyond.js"></script>


    
    <script src="/public/static/admin/script/jquery.form.min.js"></script>
<!-- 	<script type="text/javascript">
	 //实例化编辑器
	var editor_a = new baidu.editor.ui.Editor({initialFrameHeight:400,initialFrameWidth:1000});
	editor_a.render( 'content' ); //此处的参数值为编辑器的id值
	</script> -->
   <script type="text/javascript">
   // var editor;
	   $(function() {
		    CKEDITOR.replace("content"); //参数‘content’是textarea元素的name属性值，而非id属性值 
	
	   })
   </script>
    <script type="text/javascript">
        $('#content_form').on('submit', function(e) {
            e.preventDefault(); // prevent native submit

    var uploadFormData = new FormData($('#content_form')[0]);

       index = layer.load(1,{
              icon: 1
              ,shade: 0.1
            });


            $.ajax({

                type:'post',

                data:uploadFormData,

                 processData: false,
                 contentType: false,

                dataTpye:'json',

                url:"<?php echo url('content/edits',['cate_id'=>$cate_id,'art_id'=>$info['id'],'model_id'=>$model_id]); ?>",


                  success:function(data){

                     layer.close(index)
                   if(data.code==1){
                        layer.msg(data.msg,{icon: 1,time:600,end:function(){
                            window.location.href='<?php echo url("content/lsts",["cate_id"=>$cate_id,"model_id"=>$model_id]); ?>';
                        }});
                    }else{
                        layer.msg(data.msg,{icon: 2,time: 1000})
                        $.each(data.result,function (index,item) {
                             layer.msg(item);
                        })
                    }

                },
                error : function() {
                   layer.msg('服务器或网络失败，请刷新页面后重试!');
                }





            })
            return false;
        });
    </script>

    <script>
    //执行一个laydate实例
    laydate.render({
      elem: '#time' //指定元素
      //,value: new Date(<?php echo $info['time']; ?>)
    });

       function errorImg(img) {
img.style.display = "none";
img.onerror = null;
} 
    </script>
<?php if(array_key_exists(10,$adShows)): ?>
<script type="text/javascript">  
  UE.getEditor('all_img', {
      toolbars:[['source','fullscreen','insertimage']],//这里可以选择自己需要的工具按钮名称,
  });
</script>
<?php endif; ?>

</body></html>