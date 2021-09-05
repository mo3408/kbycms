<?php if (!defined('THINK_PATH')) exit(); /*a:4:{s:72:"E:\phpstudy_pro\WWW\www.home.com/application/admin\view\conf\conflst.htm";i:1584698602;s:71:"E:\phpstudy_pro\WWW\www.home.com\application\admin\view\common\head.htm";i:1584698602;s:70:"E:\phpstudy_pro\WWW\www.home.com\application\admin\view\common\top.htm";i:1625984588;s:71:"E:\phpstudy_pro\WWW\www.home.com\application\admin\view\common\left.htm";i:1584698602;}*/ ?>
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
                        <a href="#">网站配置</a>
                    </li>
                                        <li class="active">配置列表</li>
                                        </ul>
                </div>
                <!-- /Page Breadcrumb -->

                <!-- Page Body -->
         <div class="page-body">
         <script>
        //  上传文件前置路径
            fileServiceRootUrl = '/public/static/index/uploads/img/';
        </script>             
            <div class="row">
                <div class="col-lg-12 col-sm-12 col-xs-12">
                     <form class="form-horizontal" role="form" action="" method="post" enctype="multipart/form-data">
                            <div class="widget-body">
                                    <div class="widget-main ">
                                        <div class="tabbable">
                                            <ul class="nav nav-tabs tabs-flat" id="myTab11">
                                            <?php foreach ($cftype as $k => $v):?>
                                                <li <?php if ($k==0) :?> 
                                                class="active" 
                                            <?php endif; ?> >
                                                    <a data-toggle="tab" href="#home<?php echo $k ?>">
                                                        <?php echo $v['cf_type']?>
                                                    </a>
                                                </li>
                                            <?php endforeach;?>
                                            </ul>
                                            <div class="tab-content tabs-flat">
                                              <?php foreach ($cftype as $ck => $cv):?>
                                                <div id="home<?php echo $ck ;?>" class="tab-pane <?php if($ck==0):?> active <?php endif;?>">
                                                <?php foreach ($confRes as $k => $v):if($v['cf_type']==$cv['id']):?>
                                                    <div class="form-group">
                                                        <label for="username" class="col-sm-2 control-label no-padding-right"><?php echo $v['cname']?>：</label>
                                                        <div class="col-sm-6">
                                                            <?php if($v['dt_type']==1):?><!-- 单行文本 -->
                                                                <input class="form-control"  placeholder="" name="<?php echo $v['ename'];?>" type="text" value="<?php echo $v['value'];?>">
                                                            <?php endif; if($v['dt_type']==2): $valuesArr=explode(',', $v['values']);
                                                                foreach ($valuesArr as $k1 => $v1):
                                                            ?><!-- 单选 -->
                                                                <div class="radio" style="float:left; padding-left:10px;">
                                                                    <label>
                                                                        <input <?php if($v1 == $v['value']): ?> checked="checked" <?php endif; ?>  type="radio" name="<?php echo $v['ename'];?>" value="<?php echo $v1;?>">
                                                                        <span class="text"><?php echo $v1;?></span>
                                                                    </label>
                                                                </div>

                                                            <?php endforeach; endif; if($v['dt_type']==3): $valuesArr=explode(',', $v['values']);$valueArr=explode(',', $v['value']);?><!-- 复选框 -->
                                                             <?php foreach ($valuesArr as $k1 => $v1): $valuesArr=explode(',', $v['values']);?>
                                                                <div class="checkbox" style="float:left; padding-left:10px;">
                                                                    <label>
                                                                        <input class="colored-blue" <?php if(in_array($v1, $valueArr)):?>checked="checked" <?php endif;?> type="checkbox" value="<?php echo $v1;?>" name="<?php echo $v['ename'];?>[]">
                                                                        <span class="text"><?php echo $v1;?></span>
                                                                    </label>
                                                                </div>
                                                                 <?php endforeach; endif; if($v['dt_type']==4): $valuesArr=explode(',', $v['values']);?><!-- 下拉菜单 -->
                                                                <div class="checkbox"  >
                                                                    <select class="form-control" name="<?php echo $v['ename'];?>" >
                                                                    <option value="">请选择</option>
                                                                    <?php foreach ($valuesArr as $k1 => $v1):?>
                                                                        <option value="<?php echo $v1;?>" <?php if($v1 == $v['value']): ?> checked="checked" <?php endif; ?>><?php echo $v1;?></option>
                                                                    <?php endforeach; ?>
                                                                    </select>
                                                                </div>
                                                            <?php endif; if($v['dt_type']==5):?><!-- 文本域 -->
                                                                <textarea class="form-control" name="<?php echo $v['ename'];?>"><?php echo $v['value'];?></textarea>
                                                            <?php endif; if($v['dt_type']==6):?><!-- 附件 -->
                                                                <input  style="float:left;" class="file" placeholder="" name="<?php echo $v['ename'];?>" id="<?php echo $v['ename'];?>"  type="file">
                                                                <input type="hidden" value="<?php echo $v['value']; ?>" id="<?php echo $v['id']; ?>">
                                                                <script>initFileInput('<?php echo $v['ename']; ?>','<?php echo $v['id']; ?>',1);</script>
                                                            <?php endif; ?>
                                                        </div>
                                                        <p class="help-block col-sm-4 red">* 必填</p>
                                                    </div>
                                                   <?php endif; endforeach;?>
                                                </div>
                                                <?php endforeach;?>
                                        <div class="form-group">
                                            <div class="col-sm-offset-2 col-sm-10">
                                                <button type="submit" class="btn btn-default">保存信息</button>
                                            </div>
                                        </div>
                                    </div>
                             </div>
                       </form>
                     </div>
                            
                </div>   

                <!-- /Page Body -->
            </div>
          
            <!-- /Page Content -->
	</div>	
</div>


	    <!--Basic Scripts-->
    <script src="/public/static/admin/style/jquery_002.js"></script>
    <script src="/public/static/admin/style/bootstrap.js"></script>
    <script src="/public/static/admin/style/jquery.js"></script>
    <!--Beyond Scripts-->
    <script src="/public/static/admin/style/beyond.js"></script>
    
</body>
</html>