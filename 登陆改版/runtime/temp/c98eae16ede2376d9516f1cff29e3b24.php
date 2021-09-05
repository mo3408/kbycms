<?php if (!defined('THINK_PATH')) exit(); /*a:4:{s:74:"E:\phpstudy_pro\WWW\www.home.com/application/admin\view\cate\cate_list.htm";i:1612669288;s:71:"E:\phpstudy_pro\WWW\www.home.com\application\admin\view\common\head.htm";i:1584698602;s:70:"E:\phpstudy_pro\WWW\www.home.com\application\admin\view\common\top.htm";i:1625984588;s:71:"E:\phpstudy_pro\WWW\www.home.com\application\admin\view\common\left.htm";i:1584698602;}*/ ?>
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
         
        <div class="page-content">
                <!-- Page Breadcrumb -->
            <div class="page-breadcrumbs">
                <ul class="breadcrumb">
                    <li>
                        <a href="<?php echo url('cate/catelist'); ?>">站点管理</a>
                    </li>
                     <?php if(is_array($pos) || $pos instanceof \think\Collection || $pos instanceof \think\Paginator): if( count($pos)==0 ) : echo "" ;else: foreach($pos as $k=>$cate): if($k == (count($pos)-1)): if($pos[$k]['level'] == $k): ?>

                                       <li><a href="<?php echo url('content/lsts',(['cate_id'=>$cate['id'],'model_id'=>$cate['model_id']])); ?>"><?php echo $cate['cate_name']; ?></a></li>


                                       <?php else: ?>


                                      <li><a href="<?php echo url('cate/cateList',(['cate_id'=>$cate['id'],'model_id'=>$cate['model_id']])); ?>"><?php echo $cate['cate_name']; ?></a></li>   

                                    <?php endif; else: ?>


                                 <li><a href="<?php echo url('cate/cateList',(['cate_id'=>$cate['id'],'model_id'=>$cate['model_id']])); ?>"><?php echo $cate['cate_name']; ?></a></li>   

                             <?php endif; endforeach; endif; else: echo "" ;endif; ?>
                </ul>
            </div>
                <!-- /Page Breadcrumb -->

                <!-- Page Body -->
            <div class="page-body">
                <?php if($cate_id != 0): ?>
                <button type="button" tooltip="添加栏目" class="btn btn-sm btn-azure btn-addon" onClick="javascript:window.location.href = '<?php echo url('Cate/adds',array('cate_id'=>$cate_id,'model_id'=>$model_id)); ?>'">
                <i class="fa fa-plus"></i> 新建栏目
                </button>
                <?php endif; ?>
                <div class="row">
                    <div class="col-lg-12 col-sm-12 col-xs-12">
                        <div class="widget">
                            <div class="widget-body">
                                <div class="flip-scroll">
                                <form method="post" action="<?php echo url('cate/del_sort'); ?>">
                                    <table class="table table-bordered table-hover">
                                        <thead class="">
                                            <tr pid="0">
                                                <th class="text-center" width="8%">ID</th>
                                                <th class="text-center">栏目</th>
                                                <th class="text-center" width="10%">状态</th>
                                                <th class="text-center"  width="10%">属性</th>
                                                <th class="text-center"  width="4%">排序</th>
                                                <th class="text-center" width="25%">操作</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php if(is_array($cateResLst) || $cateResLst instanceof \think\Collection || $cateResLst instanceof \think\Paginator): $i = 0; $__LIST__ = $cateResLst;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$cate): $mod = ($i % 2 );++$i;?>
                                                <tr>
                                                <td class="text-center"><?php echo $cate['id']; ?></td>
                                                <td class="text-center">
                                                <a href="#"><?php echo $cate['cate_name']; ?></a>
                                                </td>
                                                <td class="text-center"><a cateid="<?php echo $cate['id']; ?>" onclick="changestatus(this);" <?php if($cate['status'] == 1): ?> class="btn btn-primary btn-sm shiny" <?php else: ?>  class="btn btn-danger btn-sm shiny" <?php endif; ?>>
                                                        <?php if($cate['status'] == 1): ?>显示<?php else: ?>隐藏<?php endif; ?>
                                                    </a></td>
                                                <td class="text-center"><?php if($cate['cate_attr'] == 1): ?>列表<?php else: ?>单页<?php endif; ?></td>
                                                <td align="center">
                                                    <input type="text" name="" value="<?php echo $cate['sort']; ?>" onblur="save_sort(this,'cate',<?php echo $cate['id']; ?>)" url="<?php echo url('content/save_sort'); ?>">
                                                </td>
                                                <td class="text-center"><a href="<?php echo url('edits',array('cate_id'=>$cate['pid'],'id'=>$cate['id'])); ?>" class="btn btn-primary btn-sm shiny">
                                                        <i class="fa fa-edit"></i> 编辑
                                                    </a>
                                                    
                                                    <?php if($cate['pid'] == 0): else: ?>
                                                    <a href="javascript:;" class="btn btn-danger btn-sm shiny" onclick="del(this)" data-id="<?php echo $cate['id']; ?>">
                                                        <i class="fa fa-trash-o"></i>删除
                                                    </a>
                                                    <?php endif; if($cate['cate_attr'] == 1): ?>
                                                       
                                                        <a href="
                                                            <?php if($level == $cate['level']): ?>
                                                            <?php echo url('Content/lsts',(['cate_id'=>$cate['id'],'model_id'=>$cate['model_id']])); else: ?>
                                                            <?php echo url('Cate/cateList',['cate_id'=>$cate['id'],'model_id'=>$cate['model_id']]); endif; ?>"
                                                             class="btn btn-success btn-sm shiny">
                                                            <i class="fa fa-search"></i>查看列表
                                                        </a>
                                                        <?php endif; ?>
                                            

                                                    </td>
                                                </tr>
                                            <?php endforeach; endif; else: echo "" ;endif; ?>
                                            <tr pid="0">
                                            </tr>
                                            </tbody>
                                    </table>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

            </div>

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
    <script type="text/javascript">
    
    //ajxs异步修改栏目显示状态
    function changestatus(o){
        var cateid=$(o).attr("cateid");
        $.ajax({
            type:"post",
            dataType:"json",
            data:{cateid:cateid},
            url:"<?php echo url('Cate/changestatus'); ?>",
            success:function(data){
                if(data==1){
                    $(o).attr("class","tn btn-danger btn-sm shiny");
                    $(o).text('隐藏');
                    $(o).css({"cursor":"pointer"});
                }else{
                    $(o).attr("class","tn btn-primary btn-sm shiny");
                    $(o).text('显示');
                    $(o).css({"cursor":"pointer"});
                }
            }
        });
    }

    function del(obj) {
        tis = $(obj);
        id = tis.attr('data-id');
    // 删除按钮
    layer.confirm('确认删除？', {
        btn: ['确定', '取消'] //按钮
    }, function () {
        index = layer.load(1);
        $.ajax({
            type: 'post',
            url: "<?php echo url('cate/dels'); ?>",
            data : {cate_id:id},
            dataType: 'json',
            success: function (data) {
                if (data.code == 1) {
                    layer.closeAll();
                   layer.msg(data.msg,{time: 1000})
                   tis.parent().parent().remove();
                } else {
                    layer.msg(data.msg,{icon: 2,time: 2000})
                }
            }
        })
    }, function () {
    });
}

    </script>



</body></html>