<?php
namespace app\admin\controller;
use think\Db;
use app\admin\model\Archives;
class Content extends Common
{
    public $position = [];    //面包屑数组 
    public function __construct() 
    {
        parent::__construct();
        $this->assign('con','Cate');
        $this->assign('name','admin/Cate/catelist');

    }
    public function lst()
    {

        $modelId=input('model_id');
        $cate_id=input('cate_id');
        if(request()->isPost()){
            $key=input('keys');
            //echo $key;die;
            if($key){
                $map['a.title']=['like',"%".$key."%"];
            }else{
                $this->error('搜索条件不能为空！');
            }
        }
            if($cate_id){
                $sid=model('cate')->childrenids($cate_id);
                //dump($sid);die;
                $sid[]=intval($cate_id);
                $map['cate_id']=['in',$sid];
            }else{
                $map=1;
            }

        //dump($map);die;
        $artRes=db('archives')->where($map)->field('a.id,a.title,a.attr,a.model_id,c.cate_name,m.model_name')->alias('a')->join('cate c','a.cate_id=c.id')->alias('a')->join('model m','a.model_id=m.id')->order('a.id DESC')->paginate(12);
        
        if(!$modelId){
            $modelId=0;
        }
        $this->assign([
            'modelId'=>$modelId,
            'cateId'=>$cate_id,
            'artRes'=>$artRes,
            ]);
        return view();
    }
    public function upload($picName){
        //获取表单上传文件
        $file = request()->file($picName);
        //移动到框架应用目录
        $info = $file->move(ROOT_PATH . 'public/static/index/uploads/att');
        // var_dump($info);die;die;
        if($info){
            return $info->getSaveName();//输出
        }else{
            return $file->getError();//上传失败获取错误信息
        }
    }

    //添加文章可选栏目
    public function addselect(){
        $_cateRes=db('cate')->select();
        $cateRes=model('cate')->catetree($_cateRes);
        $this->assign([
            'cateRes'=>$cateRes,
            ]);
        return view();
    }

    //ajax获取modelId
    public function ajaxGetModelId($cateid){
        $cates=db('cate')->field('model_id')->find($cateid);
        echo json_decode($cates['model_id']);
    }

    //添加文章
     public function add(){
        $modelId=input('model_id');
        $cateId=input('cate_id');
        if(!$modelId){
            $modelId=0;
        }
        if(request()->isPost()){
            $data=input('post.');
            //dump($_FILES);
            //dump($data);die;
            $columns=array();
            //获取前缀
            $prefix=config('database.prefix');
            $tbArchives=$prefix.'archives';//请文章表名称
            $_columns=Db::query("SHOW COLUMNS FROM {$tbArchives}");
            foreach ($_columns as $v) {
                $columns[]=$v['Field'];
            }
            $archives=array();//主表
            $addtable=array();//附加表
            foreach ($data as $k => $v) {
                if(in_array($k,$columns)){
                    if(is_array($v)){
                        $v=implode(',', $v);
                    }
                $archives[$k]=$v;
            }else{
                if(is_array($v)){
                        $v=implode(',', $v);
                    }
                $addtable[$k]=$v;
                }
            }
            //附加表图片单图或多图上传
            //dump($_FILES);die;
            if($_FILES){
                foreach($_FILES as $k => $v){
                    if($v['name'] != ''){
                        $addtable[$k]=$this->upload($k);
                    }
                }
            }
            $archives['time']=strtotime(input('time')) ;
            $archives['model_id']=$modelId;
            $tableName=db('model')->field('table_name')->find($modelId);//获取附加表名
            $tableName=$tableName['table_name'];
            $addArchives=db('archives')->insertGetId($archives);//添加主表数据并返回Id
            //dump($archives);die;
            $addtable['aid']=$addArchives;
            $_addTable=db($tableName)->insert($addtable); //添加附表数据
            if($addArchives&&$_addTable){
                //$this->success('添加数据成功！','lst');
                model('OperationLog')->add('文章ID'.$addArchives.'添加成功！');
                $this->redirect('lst',array('cate_id'=>$cateId,'model_id'=>$modelId));  
            }else{
                $this->error('添加数据失败！');
            }
            return;
        }
        //获取栏目
        $_cateRes=db('cate')->select();
        $cateRes=model('cate')->catetree($_cateRes);
        //获取当前模型自定义字段
        $diyFields=db('model_fields')->where(['model_id'=>$modelId])->order('sort asc')->select();
        //获取长文本字段
        //$longTextFields=db('model_fields')->where(['model_id'=>$modelId,'field_type'=>9])->select();
        $this->assign([
            'cateRes'=>$cateRes,
            'modelId'=>$modelId,
            'cateId'=>$cateId,
            'diyFields'=>$diyFields,
            //'longTextFields'=>$longTextFields,
            ]);
        return view();
    }


     public function edit()
    {
        $modelId=input('model_id');
        $artId=input('art_id');
        if(!$modelId){
            $modelId=0;
        }
        //附加表数据
        $models=db('model')->field('table_name')->find($modelId);
        $tableName=$models['table_name'];
        $diyvals=db($tableName)->where(array('aid'=>$artId))->find();
        //更新数据
        if(request()->isPost()){
            $data=input('post.');
            $cateId=input('cate_id');
            //dump($_FILES);
            //dump($data);die;
            $columns=array();
            //获取前缀
            $prefix=config('database.prefix');
            $tbArchives=$prefix.'archives';//请文章表名称
            $_columns=Db::query("SHOW COLUMNS FROM {$tbArchives}");
            foreach ($_columns as $v) {
                $columns[]=$v['Field'];
            }
            $archives=array();//主表
            $addtable=array();//附加表
            foreach ($data as $k => $v) {
                if(in_array($k,$columns)){
                    if(is_array($v)){
                        $v=implode(',', $v);
                    }
                $archives[$k]=$v;
            }else{
                if(is_array($v)){
                        $v=implode(',', $v);
                    }
                $addtable[$k]=$v;
                }
            }
            //附加表图片单图或多图上传
            if($_FILES){
                foreach($_FILES as $k => $v){
                    if($v['name'] != ''){
                        $addtable[$k]=$this->upload($k);
                    }
                }
            }
             $archives['time']=strtotime(input('time')) ;
            //dump($archives);
            //dump($addtable);die;
            $saveArchives=db('archives')->update($archives);
            $saveAddtable=db($tableName)->where(array('aid'=>$archives['id']))->update($addtable);
            if($saveArchives !== false && $saveAddtable !== false){
                //$this->success('更新数据成功！');
                model('OperationLog')->add('文章ID'.$archives['id'].'更新成功！');
                $this->redirect('lst',array('cate_id'=>$cateId,'model_id'=>$modelId));  
            }else{
                $this->error('更新数据失败！');
            }
            return;
        }
        
        //主表数据
        $arts=db('archives')->find($artId);
        //获取栏目
        $_cateRes=db('cate')->select();
        $cateRes=model('cate')->catetree($_cateRes);
        //获取当前模型自定义字段
        $diyFields=db('model_fields')->where(['model_id'=>$modelId])->order('sort asc')->select();
        //获取长文本字段
        //$longTextFields=db('model_fields')->where(['model_id'=>$modelId,'field_type'=>9])->select();
        $this->assign([
            'cateRes'=>$cateRes,
            'modelId'=>$modelId,
            'cateId'=>$arts['cate_id'],
            'diyFields'=>$diyFields,
            'arts'=>$arts,
            'diyvals'=>$diyvals,
            'aid'=>$artId,
            'modelId'=>$modelId,
            //'longTextFields'=>$longTextFields,
            ]);
        return view();
    }

    //时间看文章详细页
    public function examine(){
        $modelId=input('model_id');
        $artId=input('art_id');
        if(!$modelId){
            $modelId=0;
        }
        //附加表数据
        $models=db('model')->field('table_name')->find($modelId);
        $tableName=$models['table_name'];
        $diyvals=db($tableName)->where(array('aid'=>$artId))->find();
        
        //主表数据
        $arts=db('archives')->find($artId);
        //获取栏目
        $_cateRes=db('cate')->select();
        $cateRes=model('cate')->catetree($_cateRes);
        //获取当前模型自定义字段
        $diyFields=db('model_fields')->where(['model_id'=>$modelId])->order('sort asc')->select();
        //获取长文本字段
        //$longTextFields=db('model_fields')->where(['model_id'=>$modelId,'field_type'=>9])->select();
        $this->assign([
            'cateRes'=>$cateRes,
            'modelId'=>$modelId,
            'cateId'=>$arts['cate_id'],
            'diyFields'=>$diyFields,
            'arts'=>$arts,
            'diyvals'=>$diyvals,
            'aid'=>$artId,
            'modelId'=>$modelId,
            //'longTextFields'=>$longTextFields,
            ]);
        return view();
    }

    //ajax异步删除附表上传的图片
    public function ajaxDelImg(){
        //if(request()->isAjax()){
            $aid=input('aid');
            $modelId=input('model_id');
            $fieldName=input('field_name');
            // $aid=217;
            // $modelId=4;
            // $fieldName='news_img';
            $models=db('model')->find($modelId);
            $tableName=$models['table_name'];//获取附加表名称
            $jl=db($tableName)->where(array('aid'=>$aid))->find();
            $imgSrc=INDEXATT.$jl[$fieldName];
            @unlink($imgSrc);
            $save=db($tableName)->where(array('aid'=>$aid))->setField($fieldName,'');
            if($save){
                echo 1;//删除成功
            }else{
                echo 2;//删除失败
            }
        // }else{
        //     $this->error("非法操作！");//非ajax请求
        // }

    }

    //异步文件上传
    public function upimg(){
        //dump($this->config);die;
        $file = request()->file('img');
        $info = $file->move(ROOT_PATH . 'public/static/index/uploads/img');
        if($info){
            if($this->config['thumb'] == '是'){
                $thumb_width=$this->config['thumb_width'];
                $thumb_height=$this->config['thumb_height'];
                $water_pos=$this->config['water_pos'];
                $tmd=$this->config['tmd'];
                //缩略图裁剪方式
                switch ($this->config['thumb_way']) {
                    case '等比例缩放':
                        $thumb_way=1;
                        break;
                    case '放后填充':
                        $thumb_way=2;
                        break;
                    case '居中裁剪':
                        $thumb_way=3;
                        break;
                    case '左上角裁剪':
                        $thumb_way=4;
                        break;
                    case '右下角裁剪':
                         $thumb_way=5;
                        break;
                    case '固定尺寸缩放':
                         $thumb_way=6;
                        break;
                    default:
                        $thumb_way=1;
                        break;
                }
                //水印图位置
                switch ($this->config['water_pos']) {
                    case '左上角':
                        $thumb_pos=1;
                        break;
                    case '上居中':
                        $thumb_pos=2;
                        break;
                    case '右上角':
                        $thumb_pos=3;
                        break;
                    case '左居中':
                        $thumb_pos=4;
                        break;
                    case '居中':
                         $thumb_pos=5;
                        break;
                    case '右居中':
                         $thumb_pos=6;
                        break;
                    case '左下角':
                        $thumb_pos=7;
                        break;
                    case '下居中':
                         $thumb_pos=8;
                        break;
                    case '右下角':
                         $thumb_pos=9;
                        break;
                    default:
                        $thumb_pos=9;
                        break;
                }
                //数据处理
                $imgSrc=INDEXIMG.$info->getSaveName();
                //echo $imgSrc;die;
                $image=\think\Image::open($imgSrc);
                 //$imgSrc=INDEXIMG.$info->getSaveName();
                //$image = \think\Image::open($imgSrc);
                //$water=INDEXIMG.'water.png';
                $water=ADMIN_STATIC.'/uploads/'.$this->config['water_img'];
                if($this->config['water'] == '是'){
                    //添加水印图
                    $image->thumb($thumb_width,$thumb_height,$thumb_way)->water($water,$thumb_pos,$tmd)->save($imgSrc);
                }else{
                    //不加水印
                    $image->thumb($thumb_width,$thumb_height,$thumb_way)->save($imgSrc);//生成缩略图
                }
            }
            //如果上传成功
            echo $info->getSaveName();
        }else{
            //上传失败
            echo $file->getError();
        }
    }

    //主表删除图片
    public function delimg(){
        if(request()->isAjax()){
            $artid=input('cateid');
            $imgurl=input('imgurl');
            $imgurl=INDEXIMG.$imgurl;
            $res=@unlink($imgurl);
            if($artid){
                db('archivs')->where('id',$artid)->setField('litpic','');
            }
            if($res){
                echo 1;//删除成功
            }else{
                echo 2;//删除失败
            }
        }else{
            $this->error("非法操作！");//非ajax请求
        }
    }

    //删除文档
    public function del(){
        $artId=input('id/d');
        $archives=db('archives')->field('a_img,model_id')->find($artId);

        if($archives['a_img']){
            $litpicSrc=INDEXIMG.$archives['a_img'];
            if(file_exists($litpicSrc)){
                @unlink($litpicSrc);
            }
        }
        $model_id = $archives['model_id'];
        //删除主表记录
         $delArchives=db('archives')->delete($artId);

         if($model_id){
            $models=db('model')->field('table_name')->find($model_id);
            $addTable=$models['table_name'];
            $delAdds=db($addTable)->where(array('aid'=>$artId))->delete(); 
         }
         
         if($delArchives){
            model('OperationLog')->add('配置项ID'.$artId.'删除成功！');
            $this->success('删除成功！');
         }else{
            $this->error('删除失败！');
         }
    }

/***********************************************************************************************************************************/
     //网站管理文章列表
    public function lsts()
    {
    
        $model_id=input('model_id/d');
        $cate_id=input('cate_id/d');
        $pos=model('cate')->position($cate_id);//面包屑
        $this->assign([
            'cate_id'=>$cate_id,
            'model_id'=>$model_id,
            'pos'=>$pos
            ]);
        return view();
    }

    //  ajax获取信息列表
   public function ajaxList()
    {
        // $model_id=input('model_id/d');
        $cate_id=input('cate_id/d');
        $key = input('key/s');
        $sort = input('sort/s');
        $start_time = input('start_time');
        $end_time   = input('end_time');

        $topid  = model('cate')->topid($cate_id);
        $Modle = new Archives;
        $map['cate_id'] = $cate_id;

        if (!empty($start_time)) {
            $map['time'] = ['between time', [$start_time, $end_time]];
        }

        $key && $map['title'] = ['like',"%$key%"];
        $sort && $order = "$sort desc,";
        $list = $Modle->where($map)->order("top desc,{$order}sort desc,time desc,id desc")->paginate(15);

        $this->assign([
            'list'=>$list,
            'cate_id'=>$cate_id,
            'topid'=>$topid

        ]);
        return view();
    }

//网站管理编辑
         public function edits()
    {
        $model_id=input('model_id');
        $art_id=input('art_id');

          //附加表数据
        $models=db('model')->field('table_name')->find($model_id);
        $tableName=$models['table_name'];
        //更新数据
        if(request()->isPost()){
            $data=input('post.');
            $cate_id=input('cate_id');

            $columns=array();
            //获取前缀
            $prefix=config('database.prefix');
            $tbArchives=$prefix.'archives';//请文章表名称
            $_columns=Db::query("SHOW COLUMNS FROM {$tbArchives}");
            foreach ($_columns as $v) {
                $columns[]=$v['Field'];
            }
            $archives=array();//主表
            $addtable=array();//附加表
            foreach ($data as $k => $v) {
                if(in_array($k,$columns)){
                    if(is_array($v)){
                        $v=implode(',', $v);
                    }
                $archives[$k]=$v;
            }else{
                 $field_type=db('model_fields')->where('field_ename',$k)->value('field_type');

                if(is_array($v)){

                     
                    $v=implode(',', $v);
                       
                    }
                
                if($field_type!==6){

                   $addtable[$k]=$v;

                }
                }
            }
            //附加表图片单图或多图上传
            if($_FILES){
                foreach($_FILES as $k => $v){
                   
                    if(!empty($v['name'])){
                        if($k == 'a_img' || $k=='mp4_file'){
                            $archives[$k]=$this->upload($k);
                        }else{
                            $addtable[$k]=$this->upload($k);
                        }
                    }
                    
                }
            }
             if(isset($data['time'])){
                $archives['time']=strtotime(input('time')) ;
            }
            //dump($archives);die;
            //dump($addtable);die;
           /* $archives = array_filter($archives);*/
            $saveArchives=db('archives')->update($archives);
            $saveAddtable=db($tableName)->where(array('aid'=>$archives['id']))->update($addtable);
            if($saveArchives !== false && $saveAddtable !== false){
                //$this->success('更新数据成功！');
                model('OperationLog')->add('文章ID'.$archives['id'].'更新成功！');
                $this->success('保存成功');  
            }else{
                $this->error('更新数据失败！');
            }
            return;
        }

        $info = db('archives')->where(array('id'=>$art_id))->find();
        $diyvals=db($tableName)->where(array('aid'=>$art_id))->find();
        if(!empty($diyvals)){
            $info = array_merge($info,$diyvals);
        }
        
        //获取当前模型自定义字段
        $diyFields=db('model_fields')->where(['model_id'=>$model_id])->order('sort asc')->select();
        //获取栏目默认条件
        $modelss=db('model')->find($model_id);
        if(!empty($modelss['ad_shows'])){
             $adShows=json_decode($modelss['ad_shows'],true);   
        }else{
            $adShows = [];
        }
      
        $pos=model('cate')->position($info['cate_id']);//面包屑
           
        $this->assign([
            'diyFields'=>$diyFields,
            'info'=>$info,
            'cate_id'=>$info['cate_id'],
            'diyvals'=>$diyvals,
            'pos'=>$pos,
            'model_id'=>$model_id,
            'adShows'=>$adShows,
            ]);
        return view();
    }

    //站点添加文章
     public function adds(){
        
        $cate_id=input('cate_id/d');
        $model_id=input('model_id/d');

        if(request()->isPost()){
            $data=input('post.');
            //dump($_FILES);
            //dump($data);die;
            $columns=array();
            //获取前缀
            $prefix=config('database.prefix');

            $tbArchives=$prefix.'archives';//请文章表名称
            $_columns=Db::query("SHOW COLUMNS FROM {$tbArchives}");
            
            foreach ($_columns as $v) {
                $columns[]=$v['Field'];
            }

            $archives=array();//主表
            $addtable=array();//附加表
            foreach ($data as $k => $v) {
                if(in_array($k,$columns)){
                    if(is_array($v)){
                        $v=implode(',', $v);
                    }
                $archives[$k]=$v;
            }else{
                if(is_array($v)){
                        $v=implode(',', $v);
                    }
                $addtable[$k]=$v;
                }
            }
            //附加表图片单图或多图上传
            //dump($_FILES);die;
            if($_FILES){
                foreach($_FILES as $k => $v){
                   
                    if(!empty($v['name'])){
                        if($k == 'a_img' || $k=='mp4_file'){
                            $archives[$k]=$this->upload($k);
                        }else{
                            $addtable[$k]=$this->upload($k);
                        }
                    }
                    
                }
            }
            if(isset($data['time'])){
                $archives['time']=strtotime(input('time')) ;
            }else{
                $archives['time']=time();
            }
            
            $archives['model_id']=$data['model_id'];
            $tableName=db('model')->field('table_name')->find($data['model_id']);//获取附加表名
            $tableName=$tableName['table_name'];
            //dump($archives);die;
            $addArchives=db('archives')->insertGetId($archives);//添加主表数据并返回Id
            $addtable['aid']=$addArchives;
            $_addTable=db($tableName)->insert($addtable); //添加附表数据
            if($addArchives&&$_addTable){
                //$this->success('添加数据成功！','lst');
                model('OperationLog')->add('文章ID'.$addArchives.'添加成功！');
                $this->success('保存成功');  
            }else{
                $this->error('添加数据失败！');
            }
            return;
        }
        $confs= $this->getConf();
        $pos = model('cate')->position($cate_id);
        //获取当前模型自定义字段
        $diyFields=db('model_fields')->where(['model_id'=>$model_id])->order('sort asc')->select();

        //获取栏目默认条件
        $modelss=db('model')->find($model_id);

        if(!empty($modelss['ad_shows'])){
             $adShows=json_decode($modelss['ad_shows'],true);   
        }else{
            $adShows = [];
        }
       
    
        $this->assign([
            'model_id'=>$model_id,
            'diyFields'=>$diyFields,
            'cate_id'=>$cate_id,
            'adShows'=>$adShows,
            'pos'=>$pos,
            'confs'=>$confs,
            ]);
        return view();
    }

    //  分类
    public function classify(){
        $list = db('cate')->where(['pid'=>258])->field('cate_name,id')->order('sort desc,id asc')->select();
        return $list;
    }

    //会员管理编辑
         public function user()
    {
        $cate_id=input('cid');
        $cateRes=db('cate')->where(array('pid'=>0,'programa'=>1))->order('sort asc')->select();//调用顶级栏目
        $childrenidss=array();
        $childrenids=array();
        foreach ($cateRes as $k => $v) {
            $childrenidss=db('cate')->where(array('pid'=>$v['id']))->select();
            if($childrenidss){//判断是否有子栏目
                $cateRes[$k]['urls']=1;//子栏目存在
            }else{
                $cateRes[$k]['urls']=2;//子栏目不存在
            }
        }
        $cateRessss=db('cate')->where('pid',0)->find();
        if($cate_id==""){//当栏目ID为空时
            $cate_id=$cateRessss['id'];
        }
        $modelId=input('model_id');
        $artId=input('art_id');
        if(!$modelId){
            $modelId=0;
        }
        //附加表数据
        $models=db('model')->field('table_name')->find($modelId);
        $tableName=$models['table_name'];
        $diyvals=db($tableName)->where(array('aid'=>$artId))->find();
        //更新数据
        if(request()->isPost()){
            $data=input('post.');
            $cateId=input('cate_id');
            //dump($_FILES);
            //dump($data);die;
            $columns=array();
            //获取前缀
            $prefix=config('database.prefix');
            $tbArchives=$prefix.'archives';//请文章表名称
            $_columns=Db::query("SHOW COLUMNS FROM {$tbArchives}");
            foreach ($_columns as $v) {
                $columns[]=$v['Field'];
            }
            $archives=array();//主表
            $addtable=array();//附加表
            foreach ($data as $k => $v) {
                if(in_array($k,$columns)){
                    if(is_array($v)){
                        $v=implode(',', $v);
                    }
                $archives[$k]=$v;
            }else{
                if(is_array($v)){
                        $v=implode(',', $v);
                    }
                $addtable[$k]=$v;
                }
            }
            //附加表图片单图或多图上传
            if($_FILES){
                foreach($_FILES as $k => $v){
                    if($v['name'] != ''){
                        $addtable[$k]=$this->upload($k);
                    }
                }
            }
             if(isset($data['time'])){
                $archives['time']=strtotime(input('time')) ;
            }else{
                $archives['time']=time();
            }
            //dump($archives);
            //dump($addtable);die;
            $saveArchives=db('archives')->update($archives);
            if($addtable['user_pass']==""){
                $addtable['user_pass']=$diyvals['user_pass'];
            }else{
                $addtable['user_pass']=md5($addtable['user_pass']);
            }
            $saveAddtable=db($tableName)->where(array('aid'=>$archives['id']))->update($addtable);
            if($saveArchives !== false && $saveAddtable !== false){
                //$this->success('更新数据成功！');
                model('OperationLog')->add('文章ID'.$archives['id'].'更新成功！');
                $this->redirect('lsts',array('cate_id'=>$cateId,'model_id'=>$modelId));  
            }else{
                $this->error('更新数据失败！');
            }
            return;
        }
        
        //主表数据
        $arts=db('archives')->find($artId);
        //获取栏目
        $_cateRes=db('cate')->select();
        $cateRess=model('cate')->catetree($_cateRes);
        //获取当前模型自定义字段
        $diyFields=db('model_fields')->where(['model_id'=>$modelId])->order('sort asc')->select();
        //获取长文本字段
        //$longTextFields=db('model_fields')->where(['model_id'=>$modelId,'field_type'=>9])->select();
        $this->assign([
            'cateRess'=>$cateRess,
            'cateRes'=>$cateRes,
            'modelId'=>$modelId,
            'cateId'=>$arts['cate_id'],
            'cate_id'=>$arts['cate_id'],
            'diyFields'=>$diyFields,
            'arts'=>$arts,
            'diyvals'=>$diyvals,
            'aid'=>$artId,
            'modelId'=>$modelId,
            //'longTextFields'=>$longTextFields,
            ]);
        return view();
    }

    //站点添加文章
     public function useradd(){
        $cate_id=input('cid');
        $cateRes=db('cate')->where(array('pid'=>0,'programa'=>1))->order('sort asc')->select();//调用顶级栏目
        $childrenidss=array();
        $childrenids=array();
        foreach ($cateRes as $k => $v) {
            $childrenidss=db('cate')->where(array('pid'=>$v['id']))->select();
            if($childrenidss){//判断是否有子栏目
                $cateRes[$k]['urls']=1;//子栏目存在
            }else{
                $cateRes[$k]['urls']=2;//子栏目不存在
            }
        }
        $cateRessss=db('cate')->where('pid',0)->find();
        if($cate_id==""){//当栏目ID为空时
            $cate_id=$cateRessss['id'];
        }
        $modelId=input('model_id');
        $cateId=input('cate_id');
        if(!$modelId){
            $modelId=0;
        }
        if(request()->isPost()){
            $data=input('post.');
            //dump($_FILES);
            //dump($data);die;
            $columns=array();
            //获取前缀
            $prefix=config('database.prefix');
            $tbArchives=$prefix.'archives';//请文章表名称
            $_columns=Db::query("SHOW COLUMNS FROM {$tbArchives}");
            foreach ($_columns as $v) {
                $columns[]=$v['Field'];
            }
            $archives=array();//主表
            $addtable=array();//附加表
            foreach ($data as $k => $v) {
                if(in_array($k,$columns)){
                    if(is_array($v)){
                        $v=implode(',', $v);
                    }
                $archives[$k]=$v;
            }else{
                if(is_array($v)){
                        $v=implode(',', $v);
                    }
                $addtable[$k]=$v;
                }
            }
            //附加表图片单图或多图上传
            //dump($_FILES);die;
            if($_FILES){
                foreach($_FILES as $k => $v){
                    if($v['name'] != ''){
                        $addtable[$k]=$this->upload($k);
                    }
                }
            }
            $archives['time']=strtotime(input('time')) ;
            $archives['model_id']=$modelId;
            $archives['title']=input('uname');
            $tableName=db('model')->field('table_name')->find($modelId);//获取附加表名
            $tableName=$tableName['table_name'];
            $addArchives=db('archives')->insertGetId($archives);//添加主表数据并返回Id
            //dump($archives);die;
            $addtable['aid']=$addArchives;
            $addtable['user_pass']=md5(input('user_pass'));
            $_addTable=db($tableName)->insert($addtable); //添加附表数据
            if($addArchives&&$_addTable){
                //$this->success('添加数据成功！','lst');
                model('OperationLog')->add('文章ID'.$addArchives.'添加成功！');
                $this->redirect('lsts',array('cate_id'=>$cateId,'model_id'=>$modelId));  
            }else{
                $this->error('添加数据失败！');
            }
            return;
        }
        //获取栏目
        $_cateRes=db('cate')->select();
        $cateResss=model('cate')->catetree($_cateRes);
        //获取当前模型自定义字段
        $diyFields=db('model_fields')->where(['model_id'=>$modelId])->order('sort asc')->select();
        //获取长文本字段
        //$longTextFields=db('model_fields')->where(['model_id'=>$modelId,'field_type'=>9])->select();
        $this->assign([
            'cateRes'=>$cateRes,
            'cateResss'=>$cateResss,
            'modelId'=>$modelId,
            'cateId'=>$cateId,
            'diyFields'=>$diyFields,
            'cate_id'=>$cate_id,
            //'longTextFields'=>$longTextFields,
            ]);
        return view();
    }

    //在线留言message
         public function message()
    {
        $cate_id=input('cid');
        $cateRes=db('cate')->where(array('pid'=>0,'programa'=>1))->order('sort asc')->select();//调用顶级栏目
        $childrenidss=array();
        $childrenids=array();
        foreach ($cateRes as $k => $v) {
            $childrenidss=db('cate')->where(array('pid'=>$v['id']))->select();
            if($childrenidss){//判断是否有子栏目
                $cateRes[$k]['urls']=1;//子栏目存在
            }else{
                $cateRes[$k]['urls']=2;//子栏目不存在
            }
        }
        $cateRessss=db('cate')->where('pid',0)->find();
        if($cate_id==""){//当栏目ID为空时
            $cate_id=$cateRessss['id'];
        }
        $modelId=input('model_id');
        $artId=input('art_id');
        if(!$modelId){
            $modelId=0;
        }
        //附加表数据
        $models=db('model')->field('table_name')->find($modelId);
        $tableName=$models['table_name'];
        $diyvals=db($tableName)->where(array('aid'=>$artId))->find();
        //更新数据
        if(request()->isPost()){
            $data=input('post.');
            $cateId=input('cate_id');
            //dump($_FILES);
            //dump($data);die;
            $columns=array();
            //获取前缀
            $prefix=config('database.prefix');
            $tbArchives=$prefix.'archives';//请文章表名称
            $_columns=Db::query("SHOW COLUMNS FROM {$tbArchives}");
            foreach ($_columns as $v) {
                $columns[]=$v['Field'];
            }
            $archives=array();//主表
            $addtable=array();//附加表
            foreach ($data as $k => $v) {
                if(in_array($k,$columns)){
                    if(is_array($v)){
                        $v=implode(',', $v);
                    }
                $archives[$k]=$v;
            }else{
                if(is_array($v)){
                        $v=implode(',', $v);
                    }
                $addtable[$k]=$v;
                }
            }
            //附加表图片单图或多图上传
            if($_FILES){
                foreach($_FILES as $k => $v){
                    if($v['name'] != ''){
                        $addtable[$k]=$this->upload($k);
                    }
                }
            }
             $archives['time']=strtotime(input('time')) ;
            //dump($archives);
            //dump($addtable);die;
            $saveArchives=db('archives')->update($archives);
            if($addtable['user_pass']==""){
                $addtable['user_pass']=$diyvals['user_pass'];
            }else{
                $addtable['user_pass']=md5($addtable['user_pass']);
            }
            $saveAddtable=db($tableName)->where(array('aid'=>$archives['id']))->update($addtable);
            if($saveArchives !== false && $saveAddtable !== false){
                //$this->success('更新数据成功！');
                model('OperationLog')->add('留言ID'.$archives['id'].'更新成功！');
                $this->redirect('lsts',array('cate_id'=>$cateId,'model_id'=>$modelId));  
            }else{
                $this->error('更新数据失败！');
            }
            return;
        }
        
        //主表数据
        $arts=db('archives')->find($artId);
        //获取栏目
        $_cateRes=db('cate')->select();
        $cateRess=model('cate')->catetree($_cateRes);
        //获取当前模型自定义字段
        $diyFields=db('model_fields')->where(['model_id'=>$modelId])->order('sort asc')->select();
        //获取长文本字段
        //$longTextFields=db('model_fields')->where(['model_id'=>$modelId,'field_type'=>9])->select();
        $this->assign([
            'cateRess'=>$cateRess,
            'cateRes'=>$cateRes,
            'modelId'=>$modelId,
            'cateId'=>$arts['cate_id'],
            'cate_id'=>$arts['cate_id'],
            'diyFields'=>$diyFields,
            'arts'=>$arts,
            'diyvals'=>$diyvals,
            'aid'=>$artId,
            'modelId'=>$modelId,
            //'longTextFields'=>$longTextFields,
            ]);
        return view();
    }

//相关产品
       public function correlation(){
        if(request()->isPost()){
            $data=input('post.');
            $addtable['related']=json_encode($data['itm']);
            //dump($data);die;
            $saveAddtable=db('archives')->where(array('id'=>$data['art_id']))->update($addtable);
            if($saveAddtable !== false && $saveAddtable !== false){
                //$this->success('更新数据成功！');
                model('OperationLog')->add('ID'.$data['art_id'].'相关产品添加成功！');
                $this->redirect('lsts',array('cate_id'=>$data['cate_id'],'model_id'=>$data['modelId']));  
            }else{
                $this->error('添加数据失败！');
            }
        }
        $art_id=input('art_id');
        $modelId=input('model_id');
        $cateId=input('cate_id');
        $cate_id=$cateId;
        $cateRes=db('cate')->where(array('pid'=>0,'programa'=>1))->order('sort asc')->select();//调用顶级栏目
        $childrenidss=array();
        $childrenids=array();
        foreach ($cateRes as $k => $v) {
            $childrenidss=db('cate')->where(array('pid'=>$v['id']))->select();
            if($childrenidss){//判断是否有子栏目
                $cateRes[$k]['urls']=1;//子栏目存在
            }else{
                $cateRes[$k]['urls']=2;//子栏目不存在
            }
        }
        $cateRessss=db('cate')->where('pid',0)->find();
        $modelId=input('model_id');
        $artId=input('art_id');
        if(!$modelId){
            $modelId=0;
        }
        //附加表数据
        $models=db('model')->field('table_name')->find($modelId);
        $tableName=$models['table_name'];
        $diyvals=db($tableName)->where(array('aid'=>$artId))->find();
        //获取栏目
        $_cateRes=db('cate')->select();
        $cateRess=model('cate')->catetree($_cateRes);
        //获取子栏目
        $cateAr=db('cate')->alias('a')->field('a.*,b.model_name')->join('model b','a.model_id = b.id')->where('pid',18)->order('sort asc')->select();
        foreach ($cateAr as $k => $v) {
            $cateAr[$k]['son']=db('archives')->where(array('cate_id'=>$v['id']))->select();
        }
        //相关产品数据
        //echo $artId;die;
        $artRes=db('archives')->where(array('id'=>$art_id))->find();
        $artRelated=json_decode($artRes['related']);
        //dump($artRes);die;
        $this->assign([
            'cateRes'=>$cateRes,
            'cate_id'=>$cate_id,
            'cateAr'=>$cateAr,
            'art_id'=>$art_id,
            'modelId'=>$modelId,
            'artRelated'=>$artRelated,
            ]);
         return view();
    }

/**
 * 英文网站管理
 */
//网站管理文章列表
    public function enlsts()
    {
        $cateRes=db('cate')->where(array('pid'=>0,'programa'=>1,'language'=>'en'))->order('sort asc')->select();//调用顶级栏目
        $childrenidss=array();
        $childrenids=array();
        foreach ($cateRes as $k => $v) {
            $childrenidss=db('cate')->where(array('pid'=>$v['id']))->select();
            if($childrenidss){//判断是否有子栏目
                $cateRes[$k]['urls']=1;//子栏目存在
            }else{
                $cateRes[$k]['urls']=2;//子栏目不存在
            }
        }
        $modelId=input('model_id');
        $cate_id=input('cate_id');

        if(request()->isPost()){
            $key=input('keys');
            //echo $key;die;
            if($key){
                $map['a.title']=['like',"%".$key."%"];
            }else{
                $this->error('搜索条件不能为空！');
            }
        }
            $map['cate_id']=$cate_id;

        
        $artRes=db('archives')->field('a.id,a.title,a.attr,a.cate_id,a.model_id,c.cate_name,m.model_name,a.show,a.home')->alias('a')->join('cate c','a.cate_id=c.id')->alias('a')->join('model m','a.model_id=m.id')->where($map)->order('a.id DESC')->paginate(12);
        //dump($artRes);die;
        if(!$modelId){
            $modelId=0;
        }
        $this->assign([
            'modelId'=>$modelId,
            'cate_id'=>$cate_id,
            'artRes'=>$artRes,
            'cateRes'=>$cateRes,
            ]);
        return view();
    }

//网站管理编辑
         public function enedits()
    {
        $cate_id=input('cid');
        $cateRes=db('cate')->where(array('pid'=>0,'programa'=>1,'language'=>'en'))->order('sort asc')->select();//调用顶级栏目
        $childrenidss=array();
        $childrenids=array();
        foreach ($cateRes as $k => $v) {
            $childrenidss=db('cate')->where(array('pid'=>$v['id']))->select();
            if($childrenidss){//判断是否有子栏目
                $cateRes[$k]['urls']=1;//子栏目存在
            }else{
                $cateRes[$k]['urls']=2;//子栏目不存在
            }
        }
        $cateRessss=db('cate')->where('pid',0)->find();
        if($cate_id==""){//当栏目ID为空时
            $cate_id=$cateRessss['id'];
        }
        $modelId=input('model_id');
        $artId=input('art_id');
        if(!$modelId){
            $modelId=0;
        }
        //附加表数据
        $models=db('model')->field('table_name')->find($modelId);
        $tableName=$models['table_name'];
        $diyvals=db($tableName)->where(array('aid'=>$artId))->find();
        //更新数据
        if(request()->isPost()){
            $data=input('post.');
            $cateId=input('cate_id');
            //dump($_FILES);
            //dump($data);die;
            $columns=array();
            //获取前缀
            $prefix=config('database.prefix');
            $tbArchives=$prefix.'archives';//请文章表名称
            $_columns=Db::query("SHOW COLUMNS FROM {$tbArchives}");
            foreach ($_columns as $v) {
                $columns[]=$v['Field'];
            }
            $archives=array();//主表
            $addtable=array();//附加表
            foreach ($data as $k => $v) {
                if(in_array($k,$columns)){
                    if(is_array($v)){
                        $v=implode(',', $v);
                    }
                $archives[$k]=$v;
            }else{
                if(is_array($v)){
                        $v=implode(',', $v);
                    }
                $addtable[$k]=$v;
                }
            }
            //附加表图片单图或多图上传
            if($_FILES){
                foreach($_FILES as $k => $v){
                    if($v['name'] != ''){
                        $addtable[$k]=$this->upload($k);
                    }
                }
            }
             if(isset($data['time'])){
                $archives['time']=strtotime(input('time')) ;
            }else{
                $archives['time']=time();
            }
            //dump($archives);die;
            //dump($addtable);die;
            $saveArchives=db('archives')->update($archives);
            $saveAddtable=db($tableName)->where(array('aid'=>$archives['id']))->update($addtable);
            if($saveArchives !== false && $saveAddtable !== false){
                //$this->success('更新数据成功！');
                model('OperationLog')->add('文章ID'.$archives['id'].'更新成功！');
                $this->redirect('enlsts',array('cate_id'=>$cateId,'model_id'=>$modelId));  
            }else{
                $this->error('更新数据失败！');
            }
            return;
        }
        
        //主表数据
        $arts=db('archives')->find($artId);
        //获取栏目
        $_cateRes=db('cate')->where('model_id',$modelId)->select();
        $cateRess=model('cate')->catetree($_cateRes);
        //获取当前模型自定义字段
        $diyFields=db('model_fields')->where(['model_id'=>$modelId])->order('sort asc')->select();
        //获取栏目默认条件
        $modelss=db('model')->find($modelId);

        $adShows=json_decode($modelss['ad_shows']);
        //获取长文本字段
        //$longTextFields=db('model_fields')->where(['model_id'=>$modelId,'field_type'=>9])->select();
        $this->assign([
            'cateRess'=>$cateRess,
            'cateRes'=>$cateRes,
            'modelId'=>$modelId,
            'cateId'=>$arts['cate_id'],
            'cate_id'=>$arts['cate_id'],
            'diyFields'=>$diyFields,
            'arts'=>$arts,
            'diyvals'=>$diyvals,
            'aid'=>$artId,
            'modelId'=>$modelId,
            'adShows'=>$adShows,
            //'longTextFields'=>$longTextFields,
            ]);
        return view();
    }

    //站点添加文章
     public function enadds(){
        $cate_id=input('cid');
        $cateRes=db('cate')->where(array('pid'=>0,'programa'=>1,'language'=>'en'))->order('sort asc')->select();//调用顶级栏目
        $childrenidss=array();
        $childrenids=array();
        foreach ($cateRes as $k => $v) {
            $childrenidss=db('cate')->where(array('pid'=>$v['id']))->select();
            if($childrenidss){//判断是否有子栏目
                $cateRes[$k]['urls']=1;//子栏目存在
            }else{
                $cateRes[$k]['urls']=2;//子栏目不存在
            }
        }
        $cateRessss=db('cate')->where('pid',0)->find();
        if($cate_id==""){//当栏目ID为空时
            $cate_id=$cateRessss['id'];
        }
        $modelId=input('model_id');
        $cateId=input('cate_id');
        if(!$modelId){
            $modelId=0;
        }
        if(request()->isPost()){
            $data=input('post.');
            //dump($_FILES);
            //dump($data);die;
            $columns=array();
            //获取前缀
            $prefix=config('database.prefix');
            $tbArchives=$prefix.'archives';//请文章表名称
            $_columns=Db::query("SHOW COLUMNS FROM {$tbArchives}");
            foreach ($_columns as $v) {
                $columns[]=$v['Field'];
            }
            $archives=array();//主表
            $addtable=array();//附加表
            foreach ($data as $k => $v) {
                if(in_array($k,$columns)){
                    if(is_array($v)){
                        $v=implode(',', $v);
                    }
                $archives[$k]=$v;
            }else{
                if(is_array($v)){
                        $v=implode(',', $v);
                    }
                $addtable[$k]=$v;
                }
            }
            //附加表图片单图或多图上传
            //dump($_FILES);die;
            if($_FILES){
                foreach($_FILES as $k => $v){
                    if($v['name'] != ''){
                        $addtable[$k]=$this->upload($k);
                    }
                }
            }
            if(isset($data['time'])){
                $archives['time']=strtotime(input('time')) ;
            }else{
                $archives['time']=time();
            }
            
            $archives['model_id']=$modelId;
            $tableName=db('model')->field('table_name')->find($modelId);//获取附加表名
            $tableName=$tableName['table_name'];
            //dump($archives);die;
            $addArchives=db('archives')->insertGetId($archives);//添加主表数据并返回Id
            $addtable['aid']=$addArchives;
            $_addTable=db($tableName)->insert($addtable); //添加附表数据
            if($addArchives&&$_addTable){
                //$this->success('添加数据成功！','lst');
                model('OperationLog')->add('文章ID'.$addArchives.'添加成功！');
                $this->redirect('enlsts',array('cate_id'=>$cateId,'model_id'=>$modelId));  
            }else{
                $this->error('添加数据失败！');
            }
            return;
        }
        //获取栏目
        $_cateRes=db('cate')->select();
        $cateResss=model('cate')->catetree($_cateRes);
        //获取当前模型自定义字段
        $diyFields=db('model_fields')->where(['model_id'=>$modelId])->order('sort asc')->select();
        //文章默认设置
        //获取栏目默认条件
        $modelss=db('model')->find($modelId);
        $adShows=json_decode($modelss['ad_shows']);
        //获取长文本字段
        //$longTextFields=db('model_fields')->where(['model_id'=>$modelId,'field_type'=>9])->select();
        $this->assign([
            'cateRes'=>$cateRes,
            'cateResss'=>$cateResss,
            'modelId'=>$modelId,
            'cateId'=>$cateId,
            'diyFields'=>$diyFields,
            'cate_id'=>$cate_id,
            'adShows'=>$adShows,
            //'longTextFields'=>$longTextFields,
            ]);
        return view();
    }

    //会员管理编辑
         public function enuser()
    {
        $cate_id=input('cid');
        $cateRes=db('cate')->where(array('pid'=>0,'programa'=>1,'language'=>'en'))->order('sort asc')->select();//调用顶级栏目
        $childrenidss=array();
        $childrenids=array();
        foreach ($cateRes as $k => $v) {
            $childrenidss=db('cate')->where(array('pid'=>$v['id']))->select();
            if($childrenidss){//判断是否有子栏目
                $cateRes[$k]['urls']=1;//子栏目存在
            }else{
                $cateRes[$k]['urls']=2;//子栏目不存在
            }
        }
        $cateRessss=db('cate')->where('pid',0)->find();
        if($cate_id==""){//当栏目ID为空时
            $cate_id=$cateRessss['id'];
        }
        $modelId=input('model_id');
        $artId=input('art_id');
        if(!$modelId){
            $modelId=0;
        }
        //附加表数据
        $models=db('model')->field('table_name')->find($modelId);
        $tableName=$models['table_name'];
        $diyvals=db($tableName)->where(array('aid'=>$artId))->find();
        //更新数据
        if(request()->isPost()){
            $data=input('post.');
            $cateId=input('cate_id');
            //dump($_FILES);
            //dump($data);die;
            $columns=array();
            //获取前缀
            $prefix=config('database.prefix');
            $tbArchives=$prefix.'archives';//请文章表名称
            $_columns=Db::query("SHOW COLUMNS FROM {$tbArchives}");
            foreach ($_columns as $v) {
                $columns[]=$v['Field'];
            }
            $archives=array();//主表
            $addtable=array();//附加表
            foreach ($data as $k => $v) {
                if(in_array($k,$columns)){
                    if(is_array($v)){
                        $v=implode(',', $v);
                    }
                $archives[$k]=$v;
            }else{
                if(is_array($v)){
                        $v=implode(',', $v);
                    }
                $addtable[$k]=$v;
                }
            }
            //附加表图片单图或多图上传
            if($_FILES){
                foreach($_FILES as $k => $v){
                    if($v['name'] != ''){
                        $addtable[$k]=$this->upload($k);
                    }
                }
            }
             if(isset($data['time'])){
                $archives['time']=strtotime(input('time')) ;
            }else{
                $archives['time']=time();
            }
            //dump($archives);
            //dump($addtable);die;
            $saveArchives=db('archives')->update($archives);
            if($addtable['user_pass']==""){
                $addtable['user_pass']=$diyvals['user_pass'];
            }else{
                $addtable['user_pass']=md5($addtable['user_pass']);
            }
            $saveAddtable=db($tableName)->where(array('aid'=>$archives['id']))->update($addtable);
            if($saveArchives !== false && $saveAddtable !== false){
                //$this->success('更新数据成功！');
                model('OperationLog')->add('会员ID'.$archives['id'].'更新成功！');
                $this->redirect('enlsts',array('cate_id'=>$cateId,'model_id'=>$modelId));  
            }else{
                $this->error('更新数据失败！');
            }
            return;
        }
        
        //主表数据
        $arts=db('archives')->find($artId);
        //获取栏目
        $_cateRes=db('cate')->select();
        $cateRess=model('cate')->catetree($_cateRes);
        //获取当前模型自定义字段
        $diyFields=db('model_fields')->where(['model_id'=>$modelId])->order('sort asc')->select();
        //获取长文本字段
        //$longTextFields=db('model_fields')->where(['model_id'=>$modelId,'field_type'=>9])->select();
        $this->assign([
            'cateRess'=>$cateRess,
            'cateRes'=>$cateRes,
            'modelId'=>$modelId,
            'cateId'=>$arts['cate_id'],
            'cate_id'=>$arts['cate_id'],
            'diyFields'=>$diyFields,
            'arts'=>$arts,
            'diyvals'=>$diyvals,
            'aid'=>$artId,
            'modelId'=>$modelId,
            //'longTextFields'=>$longTextFields,
            ]);
        return view();
    }

    //站点添加文章
     public function enuseradd(){
        $cate_id=input('cid');
        $cateRes=db('cate')->where(array('pid'=>0,'programa'=>1,'language'=>'en'))->order('sort asc')->select();//调用顶级栏目
        $childrenidss=array();
        $childrenids=array();
        foreach ($cateRes as $k => $v) {
            $childrenidss=db('cate')->where(array('pid'=>$v['id']))->select();
            if($childrenidss){//判断是否有子栏目
                $cateRes[$k]['urls']=1;//子栏目存在
            }else{
                $cateRes[$k]['urls']=2;//子栏目不存在
            }
        }
        $cateRessss=db('cate')->where('pid',0)->find();
        if($cate_id==""){//当栏目ID为空时
            $cate_id=$cateRessss['id'];
        }
        $modelId=input('model_id');
        $cateId=input('cate_id');
        if(!$modelId){
            $modelId=0;
        }
        if(request()->isPost()){
            $data=input('post.');
            //dump($_FILES);
            //dump($data);die;
            $columns=array();
            //获取前缀
            $prefix=config('database.prefix');
            $tbArchives=$prefix.'archives';//请文章表名称
            $_columns=Db::query("SHOW COLUMNS FROM {$tbArchives}");
            foreach ($_columns as $v) {
                $columns[]=$v['Field'];
            }
            $archives=array();//主表
            $addtable=array();//附加表
            foreach ($data as $k => $v) {
                if(in_array($k,$columns)){
                    if(is_array($v)){
                        $v=implode(',', $v);
                    }
                $archives[$k]=$v;
            }else{
                if(is_array($v)){
                        $v=implode(',', $v);
                    }
                $addtable[$k]=$v;
                }
            }
            //附加表图片单图或多图上传
            //dump($_FILES);die;
            if($_FILES){
                foreach($_FILES as $k => $v){
                    if($v['name'] != ''){
                        $addtable[$k]=$this->upload($k);
                    }
                }
            }
            $archives['time']=strtotime(input('time')) ;
            $archives['model_id']=$modelId;
            $archives['title']=input('uname');
            $tableName=db('model')->field('table_name')->find($modelId);//获取附加表名
            $tableName=$tableName['table_name'];
            $addArchives=db('archives')->insertGetId($archives);//添加主表数据并返回Id
            //dump($archives);die;
            $addtable['aid']=$addArchives;
            $addtable['user_pass']=md5(input('user_pass'));
            $_addTable=db($tableName)->insert($addtable); //添加附表数据
            if($addArchives&&$_addTable){
                //$this->success('添加数据成功！','lst');
                 model('OperationLog')->add('文章ID'.$addArchives.'更新成功！');
                $this->redirect('enlsts',array('cate_id'=>$cateId,'model_id'=>$modelId));  
            }else{
                $this->error('添加数据失败！');
            }
            return;
        }
        //获取栏目
        $_cateRes=db('cate')->select();
        $cateResss=model('cate')->catetree($_cateRes);
        //获取当前模型自定义字段
        $diyFields=db('model_fields')->where(['model_id'=>$modelId])->order('sort asc')->select();
        //获取长文本字段
        //$longTextFields=db('model_fields')->where(['model_id'=>$modelId,'field_type'=>9])->select();
        $this->assign([
            'cateRes'=>$cateRes,
            'cateResss'=>$cateResss,
            'modelId'=>$modelId,
            'cateId'=>$cateId,
            'diyFields'=>$diyFields,
            'cate_id'=>$cate_id,
            //'longTextFields'=>$longTextFields,
            ]);
        return view();
    }

    //在线留言message
         public function enmessage()
    {
        $cate_id=input('cid');
        $cateRes=db('cate')->where(array('pid'=>0,'programa'=>1,'language'=>'en'))->order('sort asc')->select();//调用顶级栏目
        $childrenidss=array();
        $childrenids=array();
        foreach ($cateRes as $k => $v) {
            $childrenidss=db('cate')->where(array('pid'=>$v['id']))->select();
            if($childrenidss){//判断是否有子栏目
                $cateRes[$k]['urls']=1;//子栏目存在
            }else{
                $cateRes[$k]['urls']=2;//子栏目不存在
            }
        }
        $cateRessss=db('cate')->where('pid',0)->find();
        if($cate_id==""){//当栏目ID为空时
            $cate_id=$cateRessss['id'];
        }
        $modelId=input('model_id');
        $artId=input('art_id');
        if(!$modelId){
            $modelId=0;
        }
        //附加表数据
        $models=db('model')->field('table_name')->find($modelId);
        $tableName=$models['table_name'];
        $diyvals=db($tableName)->where(array('aid'=>$artId))->find();
        //更新数据
        if(request()->isPost()){
            $data=input('post.');
            $cateId=input('cate_id');
            //dump($_FILES);
            //dump($data);die;
            $columns=array();
            //获取前缀
            $prefix=config('database.prefix');
            $tbArchives=$prefix.'archives';//请文章表名称
            $_columns=Db::query("SHOW COLUMNS FROM {$tbArchives}");
            foreach ($_columns as $v) {
                $columns[]=$v['Field'];
            }
            $archives=array();//主表
            $addtable=array();//附加表
            foreach ($data as $k => $v) {
                if(in_array($k,$columns)){
                    if(is_array($v)){
                        $v=implode(',', $v);
                    }
                $archives[$k]=$v;
            }else{
                if(is_array($v)){
                        $v=implode(',', $v);
                    }
                $addtable[$k]=$v;
                }
            }
            //附加表图片单图或多图上传
            if($_FILES){
                foreach($_FILES as $k => $v){
                    if($v['name'] != ''){
                        $addtable[$k]=$this->upload($k);
                    }
                }
            }
             $archives['time']=strtotime(input('time')) ;
            //dump($archives);
            //dump($addtable);die;
            $saveArchives=db('archives')->update($archives);
            if($addtable['user_pass']==""){
                $addtable['user_pass']=$diyvals['user_pass'];
            }else{
                $addtable['user_pass']=md5($addtable['user_pass']);
            }
            $saveAddtable=db($tableName)->where(array('aid'=>$archives['id']))->update($addtable);
            if($saveArchives !== false && $saveAddtable !== false){
                //$this->success('更新数据成功！');
                model('OperationLog')->add('在线留言ID'.$archives['id'].'更新成功！');
                $this->redirect('enlsts',array('cate_id'=>$cateId,'model_id'=>$modelId));  
            }else{
                $this->error('更新数据失败！');
            }
            return;
        }
        
        //主表数据
        $arts=db('archives')->find($artId);
        //获取栏目
        $_cateRes=db('cate')->select();
        $cateRess=model('cate')->catetree($_cateRes);
        //获取当前模型自定义字段
        $diyFields=db('model_fields')->where(['model_id'=>$modelId])->order('sort asc')->select();
        //获取长文本字段
        //$longTextFields=db('model_fields')->where(['model_id'=>$modelId,'field_type'=>9])->select();
        $this->assign([
            'cateRess'=>$cateRess,
            'cateRes'=>$cateRes,
            'modelId'=>$modelId,
            'cateId'=>$arts['cate_id'],
            'cate_id'=>$arts['cate_id'],
            'diyFields'=>$diyFields,
            'arts'=>$arts,
            'diyvals'=>$diyvals,
            'aid'=>$artId,
            'modelId'=>$modelId,
            //'longTextFields'=>$longTextFields,
            ]);
        return view();
    }

//相关产品
       public function encorrelation(){
        if(request()->isPost()){
            $data=input('post.');
            $addtable['related']=json_encode($data['itm']);
            //dump($data);die;
            $saveAddtable=db('archives')->where(array('id'=>$data['art_id']))->update($addtable);
            if($saveAddtable !== false && $saveAddtable !== false){
                //$this->success('更新数据成功！');
                model('OperationLog')->add('ID'.$data['art_id'].'相关产品更新成功！');
                $this->redirect('enlsts',array('cate_id'=>$data['cate_id'],'model_id'=>$data['modelId']));  
            }else{
                $this->error('添加数据失败！');
            }
        }
        $art_id=input('art_id');
        $modelId=input('model_id');
        $cateId=input('cate_id');
        $cate_id=$cateId;
        $cateRes=db('cate')->where(array('pid'=>0,'programa'=>1,'language'=>'en'))->order('sort asc')->select();//调用顶级栏目
        $childrenidss=array();
        $childrenids=array();
        foreach ($cateRes as $k => $v) {
            $childrenidss=db('cate')->where(array('pid'=>$v['id']))->select();
            if($childrenidss){//判断是否有子栏目
                $cateRes[$k]['urls']=1;//子栏目存在
            }else{
                $cateRes[$k]['urls']=2;//子栏目不存在
            }
        }
        $cateRessss=db('cate')->where('pid',0)->find();
        $modelId=input('model_id');
        $artId=input('art_id');
        if(!$modelId){
            $modelId=0;
        }
        //附加表数据
        $models=db('model')->field('table_name')->find($modelId);
        $tableName=$models['table_name'];
        $diyvals=db($tableName)->where(array('aid'=>$artId))->find();
        //获取栏目
        $_cateRes=db('cate')->select();
        $cateRess=model('cate')->catetree($_cateRes);
        //获取子栏目
        $cateAr=db('cate')->alias('a')->field('a.*,b.model_name')->join('model b','a.model_id = b.id')->where('pid',18)->order('sort asc')->select();
        foreach ($cateAr as $k => $v) {
            $cateAr[$k]['son']=db('archives')->where(array('cate_id'=>$v['id']))->select();
        }
        //相关产品数据
        //echo $artId;die;
        $artRes=db('archives')->where(array('id'=>$art_id))->find();
        $artRelated=json_decode($artRes['related']);
        //dump($artRes);die;
        $this->assign([
            'cateRes'=>$cateRes,
            'cate_id'=>$cate_id,
            'cateAr'=>$cateAr,
            'art_id'=>$art_id,
            'modelId'=>$modelId,
            'artRelated'=>$artRelated,
            ]);
         return view();
    }

    //ajax异步修改内容显示状态
    public function arshow(){
        if(request()->isAjax()){
            $id=input('showid');
            $show=db('archives')->field('show')->where('id',$id)->find();
            $show=$show['show'];
            if($show==1){
                db('archives')->where('id',$id)->update(['show'=>0]);
                model('OperationLog')->add('内容ID为'.$id.'开启成功！');
                echo 1;//显示改为隐藏
            }else{
                db('archives')->where('id',$id)->update(['show'=>1]);
                model('OperationLog')->add('内容ID为'.$id.'关闭成功！');
                echo 2;//隐藏改为显示
            }
        }else{
            $this->error("非法操作！");//非ajax请求
        }
    }

    //ajax异步修改内容推荐状态
    public function arhome(){
        if(request()->isAjax()){
            $id=input('homeid');
            $home=db('archives')->field('home')->where('id',$id)->find();
            $home=$home['home'];
            if($home==1){
                db('archives')->where('id',$id)->update(['home'=>0]);
                model('OperationLog')->add('内容ID为'.$id.'开启成功！');
                echo 1;//显示改为隐藏
            }else{
                db('archives')->where('id',$id)->update(['home'=>1]);
                model('OperationLog')->add('内容ID为'.$id.'关闭成功！');
                echo 2;//隐藏改为显示
            }
        }else{
            $this->error("非法操作！");//非ajax请求
        }
    }

    //批量修改内容显示状态
    public function show_sort(){
        $data=input('post.');
        //dump($data);die;
        if(array_key_exists('itm',$data)){
            foreach ($data['itm'] as $k => $v) {
               db('archives')->where('id',$v)->update(['show'=>$data['show']]);

            }
            if($data['show']=1){
                model('OperationLog')->add('操作成功！');
                $this->success('操作成功');
            }else{
                model('OperationLog')->add('操作成功！');
                $this->success('操作成功！');
            }
         }else{
            $this->error('请选中要修改的内容！');
        }

    }

    //批量修改内容推荐状态
    public function home_sort(){
        $data=input('post.');
        if(array_key_exists('itm',$data)){
            foreach ($data['itm'] as $k => $v) {
               db('archives')->where('id',$v)->update(['home'=>$data['home']]);

            }
            if($data['home']=1){
                model('OperationLog')->add('内容批量推荐成功！');
                $this->success('内容批量推荐成功');
            }else{
                model('OperationLog')->add('内容推荐关闭成功！');
                $this->success('内容批量推荐关闭成功！');
            }
        }else{
            $this->success('请选中要修改的内容！');
        }

    }


    //批量删除
    public function dels_sort(){
        $data=input('post.');
        //dump($data);die;
        if(array_key_exists('itm',$data)){
            foreach ($data['itm'] as $k => $v) {
                $models=db('archives')->find($v);
                $modelId=$models['model_id'];
                
                db('archives')->where('id',$v)->delete();

                if($modelId){
                    $models=db('model')->field('table_name')->find($modelId);
                    $tableName=$models['table_name'];//附加表名称 
                    db($tableName)->where(array('aid'=>$v))->delete(); 
                }
               
            }
                model('OperationLog')->add('删除成功！');
                $this->success('删除成功');
        }else{
            $this->error('请选中要删除的信息！');
        }
    }


    //置顶操作
    public function top(){
        if(request()->isAjax()){
            $id=input('showid');
            $info=db('archives')->field('top,cate_id')->where('id',$id)->find();
            // $show=$show['show'];
            if($info['top']==1){
                db('archives')->where('id',$id)->update(['top'=>0]);
                // model('OperationLog')->add('内容ID为'.$id.'开启成功！');
                echo 1;//显示改为隐藏
            }else{
                db('archives')->where('cate_id='.$info['cate_id'])->update(['top'=>0]);
                db('archives')->where('id',$id)->update(['top'=>1]);
                model('OperationLog')->add('内容ID为'.$id.'置顶成功！');
                echo 2;//隐藏改为显示
            }
        }else{
            $this->error("非法操作！");//非ajax请求
        }
    }
    //  修改排序号
    public function save_sort()
    {
        $act = input('act');
        $sort = input('sort');
        $id = input('id/d');

        $rows = db($act)->where(['id'=>$id])->update([
            'sort'=>$sort
        ]);
        if($rows === 0){
            return json(['status'=>2,'msg'=>'未更改']);
        }
        if($rows>0){
            return json(['status'=>1,'msg'=>'修改成功']);
        }else{
            return json(['status'=>0,'msg'=>'修改失败']);
        }
    }
}
