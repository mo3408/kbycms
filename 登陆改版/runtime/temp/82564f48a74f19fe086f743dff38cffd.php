<?php if (!defined('THINK_PATH')) exit(); /*a:1:{s:78:"D:\phpstudy_pro\WWW\www.kbcms.com/application/admin\view\content\ajax_list.htm";i:1596681670;}*/ ?>
<form id="myform" method="post">                                                    
    <table class="table table-bordered table-hover">
        <thead class="">
            <tr>
                <th class="text-center" width="6%">选择</th>
                <th class="text-center"  width="30%">标题</th>
                <th class="text-center"  width="10%">发布日期</th>
                <th class="text-center" width="8%">排序号</th>
                <th class="text-center" width="10%">显示</th>
               <!--  <th class="text-center" width="10%">置顶</th> -->
                <th class="text-center" width="10%">推荐</th>
                <th class="text-center" width="20%">操作</th>
            </tr>
        </thead>
        <tbody>
        <?php if(is_array($list) || $list instanceof \think\Collection || $list instanceof \think\Paginator): $i = 0; $__LIST__ = $list;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$art): $mod = ($i % 2 );++$i;?>
             <tr>
                <td align="center"><label><input name="itm[]"  class="colored-blue" value="<?php echo $art['id']; ?>" type="checkbox"><span class="text"></span></label></td>
                <td ><a href="<?php echo url('edits',array('cate_id'=>$art['cate_id'],'art_id'=>$art['id'],'model_id'=>$art['model_id'])); ?>"> <?php echo $art['title']; ?></a></td>
                <td align="center">
                    <?php echo date("Y-m-d",$art['time']); ?>
                </td>
                <td align="center">
                    <input type="text" name="" value="<?php echo $art['sort']; ?>" onblur="save_sort(this,'archives',<?php echo $art['id']; ?>)" url="<?php echo url('content/save_sort'); ?>">
                </td>
                <td align="center">
                        <?php if($art['show'] == 1): ?>
                            <a showid="<?php echo $art['id']; ?>" onclick="arshow(this);" class="btn btn-palegreen btn-xs edit"><i class="fa fa-check"></i></a>
                        <?php else: ?>
                            <a showid="<?php echo $art['id']; ?>" onclick="arshow(this);" class="btn btn-danger btn-xs delete"><i class="fa fa-times"></i></a>
                        <?php endif; ?>
              </td>
             <!--  <td align="center">
                        <?php if($art['top'] == 1): ?>
                            <a showid="<?php echo $art['id']; ?>" onclick="toutiao(this);" class="btn btn-palegreen btn-xs edit"><i class="fa fa-check">取消置顶</i></a>
                        <?php else: ?>
                            <a showid="<?php echo $art['id']; ?>" onclick="toutiao(this);" class="btn btn-danger btn-xs delete">置顶</a>
                        <?php endif; ?>
              </td> -->
                <td align="center">
                        <?php if($art['home'] == 1): ?>
                            <a homeid="<?php echo $art['id']; ?>" onclick="arhome(this);" class="btn btn-info btn-xs edit"><i class="fa fa-check"></i></a>
                        <?php else: ?>
                            <a homeid="<?php echo $art['id']; ?>" onclick="arhome(this);" class="btn btn-danger btn-xs delete"><i class="fa fa-times"></i></a>
                        <?php endif; ?>
                    </td>
                <td align="center">
                    <a href="<?php echo url('edits',array('cate_id'=>$art['cate_id'],'art_id'=>$art['id'],'model_id'=>$art['model_id'])); ?>" class="btn btn-primary btn-sm shiny">
                        <i class="fa fa-edit"></i> 编辑
                    </a>
                    <a href="javascript:;" onClick="del(this)" class="btn btn-danger btn-sm shiny" data-id="<?php echo $art['id']; ?>">
                        <i class="fa fa-trash-o"></i> 删除
                    </a>
                </td>
            </tr>
        <?php endforeach; endif; else: echo "" ;endif; ?>
        <tr>
        <td colspan="7">
        <div class="col-lg-1" >
            <label>
                <input id="checkall" name="contactway[]"  class="colored-blue" value="" type="checkbox">
                <span class="text">全选</span>
            </label>
        </div>
        <div class="col-lg-1" >
            <span id="buttondels" class="btn btn-danger">删除选中</span>
        </div>
       <div class="col-lg-3" style="width: 210px;margin-left: 20px">
            <div class="col-lg-6" style="Float:left;">
                <select class="form-control" name="show" data-bv-field="country">
                    <option value="1">是</option>
                    <option value="2">否</option>
                </select>
            </div>
            <span id="buttonshow" class="btn btn-palegreen">显示/隐藏</span>
        </div>
        <div class="col-lg-4">    <?php echo $list->render(); ?>
        </div>
        </td>
        </tr>
        </tbody>
    </table>
</form>

<script type="text/javascript">
    $('.pagination a').click(function(){

            var url = $(this).attr('href');
            var arr = url.split("=");
            page = arr[1];
            ajax_list(page);
            return false;
        })

    //全选处理
    $("#checkall").click(function(){   
        if(this.checked){   
            $(".colored-blue ").prop("checked", true);  
        }else{   
            $(".colored-blue ").prop("checked", false);
        }   
    });

     //批量修改显示壮态
    $("#buttonshow").click(function(){
        var newUrl = "<?php echo url('content/show_sort',['cate_id'=>$cate_id]); ?>";    //设置新提交地址
         index = layer.load(1);
        $("#myform").attr('action',newUrl);    //通过jquery为action属性赋值
        $('#myform').ajaxSubmit({
            success:function(data){
                layer.close(index);
               if(data.code==1){
                    layer.msg(data.msg,{icon: 1,time:600,end:function(){
                        ajax_list();
                    }});
                }else{
                    layer.msg(data.msg,{icon: 2,time: 1000})
                }

            },
            error : function() {
               layer.msg('服务器或网络失败，请刷新页面后重试!');
            }
        })
    })
        //批量删除
    $("#buttondels").click(function(){
         layer.confirm('确认删除吗？', {icon: 3, title:'提示'}, function(index){
                index = layer.load(1);
                var newUrl = "<?php echo url('content/dels_sort',['cate_id'=>$cate_id]); ?>";    //设置新提交地址
                $("#myform").attr('action',newUrl);    //通过jquery为action属性赋值
                $('#myform').ajaxSubmit({
                    success:function(data){
                        layer.close(index);
                       if(data.code==1){
                            layer.msg(data.msg,{icon: 1,time:600,end:function(){
                                ajax_list();
                            }});
                        }else{
                            layer.msg(data.msg,{icon: 2,time: 1000})
                        }

                    },
                    error : function() {
                       layer.msg('服务器或网络失败，请刷新页面后重试!');
                    }
                })
            });
        layer.close(index);
        });


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
            url: "<?php echo url('content/del',['cate_id'=>$cate_id]); ?>",
            data : {id:id},
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