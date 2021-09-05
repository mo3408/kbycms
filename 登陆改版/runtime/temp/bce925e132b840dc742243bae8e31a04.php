<?php if (!defined('THINK_PATH')) exit(); /*a:3:{s:67:"D:\phpstudy_pro\WWW\www.kbcms.com/application/admin\view\ad\lst.htm";i:1550538060;s:72:"D:\phpstudy_pro\WWW\www.kbcms.com\application\admin\view\common\head.htm";i:1584698602;s:72:"D:\phpstudy_pro\WWW\www.kbcms.com\application\admin\view\common\left.htm";i:1584698602;}*/ ?>
<!DOCTYPE html>
<html><head>
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

    <!--Beyond styles-->
    <link id="beyond-link" href="/public/static/admin/style/beyond.css" rel="stylesheet" type="text/css">
    <link href="/public/static/admin/style/demo.css" rel="stylesheet">
    <link href="/public/static/admin/style/typicons.css" rel="stylesheet">
    <link href="/public/static/admin/style/animate.css" rel="stylesheet">
    
</head>
<body>
	<!-- 头部 -->
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
                        <a href="#">系统</a>
                    </li>
                                        <li class="active">广告管理</li>
                                        </ul>
                </div>
                <!-- /Page Breadcrumb -->

                <!-- Page Body -->
                <div class="page-body">
<?php if(\think\Session::get('groupid') == 1): ?>
<button type="button" tooltip="添加广告" class="btn btn-sm btn-azure btn-addon" onClick="javascript:window.location.href = '<?php echo url('ad/add'); ?>'"> <i class="fa fa-plus"></i> Add
</button>
<?php endif; ?>
<div class="row">
    <div class="col-lg-12 col-sm-12 col-xs-12">
        <div class="widget">
            <div class="widget-body">
                <div class="flip-scroll">
                    <table class="table table-bordered table-hover">
                        <thead class="">
                            <tr>
                                <th class="text-center" width="6%">ID</th>
                                <th class="text-center">广告名称</th>
                                <th class="text-center">所属广告位</th>
                                <th class="text-center" width="10%">是否开启</th>
                                <th class="text-center" width="10%">广告类型</th>
                                <th class="text-center" width="18%">操作</th>
                            </tr>
                        </thead>
                        <tbody>

                            <?php if(is_array($adRes) || $adRes instanceof \think\Collection || $adRes instanceof \think\Paginator): $i = 0; $__LIST__ = $adRes;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$ad): $mod = ($i % 2 );++$i;?>
                            <tr>
                                <td align="center"><?php echo $ad['id']; ?></td>
                                <td align="center"><?php echo $ad['ad_name']; ?></td>
                                <td align="center"><?php echo $ad['name']; ?></td>
                                <td align="center">
                                    <label>
                                        <input id="<?php echo $ad['id']; ?>" adposId="<?php echo $ad['adpos_id']; ?>" onclick="changeStatus(this);" <?php if($ad['on'] == 1): ?> checked="checked" <?php endif; ?> class="checkbox-slider colored-success" type="checkbox">
                                        <span class="text" style="cursor:pointer;"></span>
                                    </label>
                                                        </td>
                                <td align="center"><?php if($ad['type'] == 1): ?><span class="label label-orange">单图</span><?php else: ?><span class="label label-palegreen">轮播</span><?php endif; ?></td>
                                <td align="center">
                                    <a href="<?php echo url('edit',array('id'=>$ad['id'])); ?>" class="btn btn-primary btn-sm shiny">
                                        <i class="fa fa-edit"></i> 编辑
                                    </a>
                                    <a href="#" onClick="warning('确实要删除吗', '<?php echo url('del',array('id'=>$ad['id'])); ?>')" class="btn btn-danger btn-sm shiny">
                                        <i class="fa fa-trash-o"></i> 删除
                                    </a>
                                </td>
                            </tr>
                            <?php endforeach; endif; else: echo "" ;endif; ?>

                          </tbody>
                    </table>
                </div>
                <script type="text/javascript">
                function changeStatus(o){
                    var id=$(o).attr('id');
                    var adposId=$(o).attr('adposId');
                    var isChecked=$(o).is(":checked");
                    $('input[adposId= "'+adposId+'"]').prop('checked',false);
                    if(isChecked){
                        $(o).prop('checked',true);
                    }else{
                        $(o).prop('checked',false);
                    }
                    //alert(adposId);
                    $.ajax({
                        type:'POST',
                        dataType:'json',
                        data:{id:id,adposId:adposId},
                        url:"<?php echo url('Ad/changeStatus'); ?>",
                        success:function(data){
                            //alert(data);
                        }
                    });
                }
                </script>
                <div style="padding-top:10px; text-align:right;"><?php echo $adRes->render(); ?></div>
                <div>
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
    <script src="/public/static/admin/style/jquery_002.js"></script>
    <script src="/public/static/admin/style/bootstrap.js"></script>
    <script src="/public/static/admin/style/jquery.js"></script>
    <!--Beyond Scripts-->
    <script src="/public/static/admin/style/beyond.js"></script>
    


</body></html>