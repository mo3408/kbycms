<?php if (!defined('THINK_PATH')) exit(); /*a:3:{s:68:"D:\phpstudy_pro\WWW\www.kbcms.com/application/admin\view\ad\edit.htm";i:1625986351;s:72:"D:\phpstudy_pro\WWW\www.kbcms.com\application\admin\view\common\head.htm";i:1584698602;s:72:"D:\phpstudy_pro\WWW\www.kbcms.com\application\admin\view\common\left.htm";i:1584698602;}*/ ?>
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
                        <a href="<?php echo url('Index/index'); ?>">系统</a>
                    </li>
                                        <li>
                        <a href="<?php echo url('ad/lst'); ?>">广告管理</a>
                    </li>
                                        <li class="active">编辑广告</li>
                                        </ul>
                </div>
                <!-- /Page Breadcrumb -->

                <!-- Page Body -->
                <div class="page-body">
                    
<div class="row">
    <div class="col-lg-12 col-sm-12 col-xs-12">
        <div class="widget">
            <div class="widget-header bordered-bottom bordered-blue">
                <span class="widget-caption">编辑广告</span>
            </div>
            <div class="widget-body">
                <div id="horizontal-form">
                    <form class="form-horizontal" role="form" action="" method="post" enctype="multipart/form-data">
                    <input type="hidden" name="id" value="<?php echo $ad['id']; ?>">
                    <input type="hidden" name="oldimgsrc" value="<?php echo $ad['img_src']; ?>">
                    <input type="hidden" name="type" value="<?php echo $ad['type']; ?>">

                         <div class="form-group">
                            <label for="username" class="col-sm-2 control-label no-padding-right">广告位</label>
                                <div class="col-sm-6">
                                   <select name="adpos_id" onchange="sele()">
                                       <option value="">选择广告位</option>
                                       <?php if(is_array($adposRes) || $adposRes instanceof \think\Collection || $adposRes instanceof \think\Paginator): $i = 0; $__LIST__ = $adposRes;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$adpos): $mod = ($i % 2 );++$i;?>
                                       <option <?php if($adpos['id'] == $ad['adpos_id']): ?> selected="selected" <?php endif; ?> value="<?php echo $adpos['id']; ?>" hh="<?php echo $adpos['height']; ?>" ww="<?php echo $adpos['width']; ?>"><?php echo $adpos['name']; ?></option>
                                       <?php endforeach; endif; else: echo "" ;endif; ?>
                                   </select>
                                </div>
                            <p class="help-block col-sm-4 red">* 必填</p>
                        </div>

                        <div class="form-group">
                            <label for="username" class="col-sm-2 control-label no-padding-right">广告名称</label>
                            <div class="col-sm-6">
                                <input class="form-control"  placeholder="" name="ad_name" required="" type="text" value="<?php echo $ad['ad_name']; ?>">
                            </div>
                            <p class="help-block col-sm-4 red">* 必填</p>
                        </div>

                        <div class="form-group">
                            <label for="username" class="col-sm-2 control-label no-padding-right">是否启用</label>
                            <div class="col-sm-6">
                                <div class="radio"  style="float:left; padding-left:10px;">
                                    <label>
                                        <input name="on" <?php if($ad['on'] == 1): ?> checked="checked"  <?php endif; ?> value="1" type="radio" class="colored-blue">
                                        <span class="text">是</span>
                                    </label>
                                </div>
                                <div class="radio" style="float:left; padding-left:10px;">
                                     <label>
                                        <input  <?php if($ad['on'] == 0): ?> checked="checked"  <?php endif; ?>  name="on" value="0" type="radio" class="colored-blue">
                                        <span class="text">否</span>
                                    </label>
                                </div>
                            </div>
                            <p class="help-block col-sm-4 red">* 必填</p>
                        </div>

                        <div class="form-group">
                            <label for="username" class="col-sm-2 control-label no-padding-right">广告类型</label>
                            <div class="col-sm-6">
                            <div class="radio" style="float:left; padding-left:10px;">
                                   <?php if($ad['type'] == 1): ?><span class="label label-orange">单图</span><?php else: ?><span class="label label-palegreen">轮播</span><?php endif; ?>
                                </div>
                            </div>
                            <p class="help-block col-sm-4 red">* 必填</p>
                        </div>

                        <div class="img" <?php if($ad['type'] != 1): ?> style="display:none;" <?php endif; ?>>
                            <div class="form-group">
                                <label for="username" class="col-sm-2 control-label no-padding-right">图片</label>
                                <div class="col-sm-6">
                                    <div class="radio" style="float:left; padding-left:10px;">
                                        <input style="display:inline;"   placeholder="" name="img_src"  type="file">
                                          <span class="imgsize">1920*450</span>
                                        <img src="/public/static/index/uploads/banner/<?php echo $ad['img_src']; ?>" height="25px;">
                                    </div>
                                </div>
                                <p class="help-block col-sm-4 red">* 必填(单位PX)</p>
                            </div>

                            <div class="form-group">
                                <label for="username" class="col-sm-2 control-label no-padding-right">链接地址</label>
                                <div class="col-sm-6">
                                    <input class="form-control"  placeholder="" name="link"  type="text" value="<?php echo $ad['link']; ?>">
                                </div>
                                <p class="help-block col-sm-4 red">* 必填(单位PX)</p>
                            </div>
                        </div>
                     
                        <div class="lh" <?php if($ad['type'] != 2): ?> style="display:none;" <?php endif; ?>>
                        <?php if(isset($adflashRes)): if(empty($adflashRes) || (($adflashRes instanceof \think\Collection || $adflashRes instanceof \think\Paginator ) && $adflashRes->isEmpty())): ?>
                           
                          <div class="lh">
                            <div class="form-group">
                                <label for="username" class="col-sm-2 control-label no-padding-right"><a href="javascript:;" onclick="dt(this);">[+]</a><a href="javascript:;" onclick="dt(this);">[-]</a></label>
                                <div class="col-sm-8 help-block">
                                   <span class="imgsize1"></span>
                                    <span>图片:</span>
                                    <input style="display:inline;width:140px" placeholder="" name="fimg_src[]"  type="file" ;>
                                    <span>链接地址:</span>
                                    <input style="display:inline; width:180px;"  placeholder="" name="flink[]"  type="text">
                                    <span>名称:</span>
                                    <input style="display:inline;width:100px;" placeholder="" name="title[]"  type="text">
                                    <span>排序:</span>
                                    <input style="display:inline;width:100px;" placeholder="" name="sort[]"  type="text">
                                </div>
                                
                            </div>
                        </div>

                          <?php else: if(is_array($adflashRes) || $adflashRes instanceof \think\Collection || $adflashRes instanceof \think\Paginator): $i = 0; $__LIST__ = $adflashRes;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$adflash): $mod = ($i % 2 );++$i;?>
                            <div class="form-group">
                            <?php if($i == 1): ?>

                                <label for="username" class="col-sm-2 control-label no-padding-right"><a href="javascript:;" id="<?php echo $adflash['id']; ?>" onclick="dt(this);">[+]</a><a href="javascript:;" id="<?php echo $adflash['id']; ?>" onclick="dt(this);">[-]</a></label>
                                <?php else: ?>
                                <label for="username" class="col-sm-2 control-label no-padding-right"><a href="javascript:;" id="<?php echo $adflash['id']; ?>" onclick="dt(this);">[-]</a></label>
                                <?php endif; ?>
                                <div class="col-sm-10 help-block">
                                   <span class="imgsize1"></span>
                                    <span>图片:</span>
                                    <!--input style="display:inline; width:140px;" placeholder="" name="fimg_src[]"  type="file"-->
                                    <img src="/public/static/index/uploads/banner/<?php echo $adflash['fimg_src']; ?>" height="25px;">
                                    <span>链接地址:</span>
                                    <input style="display:inline; width:180px;"  placeholder="" name="oldflink[<?php echo $adflash['id']; ?>]"  type="text" value="<?php echo $adflash['flink']; ?>">
                                    <span>名称:</span>
                                    <input style="display:inline;width:100px;" placeholder="" name="oldtitle[<?php echo $adflash['id']; ?>]"  value="<?php echo $adflash['title']; ?>" type="text">
                                    <span>排序:</span>
                                    <input style="display:inline;width:100px;" placeholder="" name="oldsort[<?php echo $adflash['id']; ?>]"  value="<?php echo $adflash['sort']; ?>" type="text">
                                </div>
                            </div>
                            <?php endforeach; endif; else: echo "" ;endif; endif; endif; ?>
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
                <!-- /Page Body -->
            </div>
            <!-- /Page Content -->
		</div>	
	</div>

	    <!--Basic Scripts-->
    <script src="/public/static/admin/style/jquery_002.js"></script>
    <script src="/public/static/admin/plus/layer/layer.js"></script>
    <script src="/public/static/admin/style/bootstrap.js"></script>
    <script src="/public/static/admin/style/jquery.js"></script>
    <!--Beyond Scripts-->
    <script src="/public/static/admin/style/beyond.js"></script>

    <script>

   $(function(){

  // var height=($("[name=adpos_id]").find("option:selected").attr('hh'));

  //  var width=($("[name=adpos_id]").find("option:selected").attr('ww'));


  //  if(height&&width){


  //  $(".imgsize").html(width+"*"+height);
  //  $(".imgsize1").html(width+"*"+height);


  //  }else{

  //  $(".imgsize").html("");
  //  $(".imgsize1").html("");



  //  }


  

   })



</script>
    <script type="text/javascript">
    $("#img").click(function(){
            $(".img").show();
            $(".lh").hide();
        });
    $("#lh").click(function(){
            $(".img").hide();
            $(".lh").show();
        });



   function sele(){

   // var height=($("[name=adpos_id]").find("option:selected").attr('hh'));

   // var width=($("[name=adpos_id]").find("option:selected").attr('ww'));


   // if(height&&width){


   // $(".imgsize").html(width+"*"+height);
   // $(".imgsize1").html(width+"*"+height);


   // }else{

   // $(".imgsize").html("");
   // $(".imgsize1").html("");



   // }


   }

    //ajax异步删除轮播广告记录
    function ajaxdel(o,id,div){
        layer.confirm('确认删除该广告吗？', {icon: 3, title:'提示'}, function(index){
              //do something
            $.ajax({
                type:"post",
                dataType:"json",
                data:{id:id,},
                url:"<?php echo url('ad/ajaxdel'); ?>",
                success:function(data){
                    if(data==1){
                        layer.msg('删除广告成功！', {icon: 1}); 
                        div.remove();
                    }else{
                        layer.msg('删除广告失败!', {icon: 2}); 
                    }
                }
            });
              layer.close(index);
            });
}

//多图界面生成
    function dt(o){
            var div=$(o).parent().parent();
            var id=$(o).attr("id");
            if($(o).html()==='[+]'){
                var newdiv="<div class='form-group'><label for='username' class='col-sm-2 control-label no-padding-right'><a href='javascript:;' onclick='dt(this);'>[-]</a></label><div class='col-sm-8 help-block'><span>图片:</span><input style='display:inline; width:140px;' placeholder='' name='fimg_src[]'  type='file'><span>链接地址:</span><input style='display:inline; width:180px;'  placeholder='' name='flink[]'  type='text' value=''><span>标题:</span><input style='display:inline; width:100px;'  placeholder='' name='title[]'  type='text' value=''><span>排序:</span><input style='display:inline; width:100px;'  placeholder='' name='sort[]'  type='text' value='999'></div></div>";
                div.after(newdiv);
            }else{
                if(id){
                    ajaxdel(o,id,div);
                }else{
                    div.remove();
                }
            }
        }
    </script>


</body></html>