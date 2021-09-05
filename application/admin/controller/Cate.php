<?php
namespace app\admin\controller;
use think\Db;
class Cate extends Common
{
    public $mainColumnList = [];    //  左侧主导航列表
    public $position = [];    //面包屑数组 
   
    //获取栏目
    public function lst(){
        //获取栏目
        $_cateRes=db('cate')->alias('a')->field('a.*,b.model_name')->join('model b','a.model_id = b.id')->order('sort desc,id asc')->select();
        $cateRes=model('cate')->catetree($_cateRes);
        $this->assign('cateRes',$cateRes);
        return view();
    }

    //
    public function ajaxlst(){
        if(request()->isAjax()){
            $cateid=input('cateid');
            return $sonid=model('cate')->childrenids($cateid);
            echo json_encode($cateid);
        }else{
            $this->error('非法操作！');
        }
    }

    public function add(){
        if(request()->isPost()){
            $data=input('post.');
            // 附件上传
            $file = request()->file('cate_file');
            if($file != ''){
                    $info = $file->move(ROOT_PATH . 'public/static/index/uploads/cateimg');
                    if($info){
                    $data['cate_file'] = $info->getSaveName();
                    }else{
                        echo $file->getError();
                    }
            }
            //执行验证
            $validate=validate('cate');
            if(!$validate->scene('add')->check($data)){
                $this->error($validate->getError());
            }
            $add=db('cate')->insertGetId($data);
            if($add){
                model('OperationLog')->add('栏目ID为'.$add.'添加成功！');
                $this->success('添加栏目成功！',url('lst'));
            }else{
                $this->error('添加栏目失败！');
            }
            return;
        }
        //获取栏目
        $_cateRes=db('cate')->select();
        $cateRes=model('cate')->catetree($_cateRes);
        //接收栏目ID
        $cateid=input('cateid');
        //模型信息
        $modelRes=db('model')->field('id,model_name')->select();
        //语言版本
        $_language=db('conf')->where(array('ename'=>"language"))->find();
        $language=explode(',',$_language['values']);
        $this->assign(array('cateRes'=>$cateRes,'cateid'=>$cateid,'modelRes'=>$modelRes,'language'=>$language,));
        return view();
    }

    //编辑栏目
    public function edit(){
        
        //获取栏目
        $_cateRes=db('cate')->select();
        $cateRes=model('cate')->catetree($_cateRes);
        //接收栏目ID
        $cateid=input('cateid');
        $cates=db('cate')->find($cateid);
        //模型ID
        $modelIds=db('cate')->column('model_id');
        //模型信息
        $modelRes=db('model')->field('id,model_name')->select();
        if(request()->isPost()){
            $data=input('post.');
            $cate_pic=input('pid');
            $cid=input('id');
            $childrenids=model('cate')->childrenids($cid);
            $childrenids[]=$cid;
            if(!in_array($cate_pic,$childrenids)){
            $_data=array();
            foreach ($data as $k => $v) {
                $_data[]=$k;
            }
            if(!in_array('status', $_data)){
                 $data['status']=1;
            }
            // 附件上传
            $file = request()->file('cate_file');
            if($file != ''){
                    $info = $file->move(ROOT_PATH . 'public/static/index/uploads/cateimg');
                    if($info){
                    $data['cate_file'] = $info->getSaveName();
                    }else{
                        echo $file->getError();
                    }
                }else{
                    $data['cate_file']=$cates['cate_file'];
                }
            //执行验证
            $validate=validate('cate');
            if(!$validate->scene('edit')->check($data)){
                $this->error($validate->getError());
            }
            //修改栏目
            $save=db('cate')->update($data);
            if($save){
                model('OperationLog')->add('栏目ID为'.$data['id'].'编辑成功！');
                $this->success('修改栏目成功！',url('lst'));
            }else{
                $this->error('修改栏目失败！');
            }
        }else{
            $this->error('自己或子栏目不能做父栏目！');
        }
            return;
        
        }
        //语言版本
        $_language=db('conf')->where(array('ename'=>"language"))->find();
        $language=explode(',',$_language['values']);
        $this->assign(array('cateRes'=>$cateRes,'modelIds'=>$modelIds,'cates'=>$cates,'modelRes'=>$modelRes,'language'=>$language,));
        return view();
    }


    //文件上传
    public function upimg(){
        $file = request()->file('img');
        $info = $file->move(ROOT_PATH . 'public/static/index/uploads/cateimg');
        if($info){
            //如果上传成功
            echo $info->getSaveName();
        }else{
            //上传失败
            echo $file->getError();
        }
    }

//ajax异步修改栏目显示状态
    public function changestatus(){
        if(request()->isAjax()){
            $cateid=input('cateid');
            $status=db('cate')->field('status')->where('id',$cateid)->find();
            $status=$status['status'];
            if($status==1){
                db('cate')->where('id',$cateid)->update(['status'=>0]);
                model('OperationLog')->add('栏目ID为'.$cateid.'开启成功！');
                echo 1;//显示改为隐藏
            }else{
                db('cate')->where('id',$cateid)->update(['status'=>1]);
                model('OperationLog')->add('栏目ID为'.$cateid.'关闭成功！');
                echo 2;//隐藏改为显示
            }
        }else{
            $this->error("非法操作！");//非ajax请求
        }
    }
//批量处理栏目
    public function del_sort(){
        $data=input('post.');
        //dump($data);
        foreach ($data['sort'] as $k => $v) {
           db('cate')->where('id',$k)->update(['sort'=>$v]);
        }
        if(isset($data['itm'])){
          model('cate')->pdel($data['itm']);
         }
         model('OperationLog')->add('栏目批处理成功！');
        $this->success('数据处理成功！',url('lst'));
    }
//删除栏目
    public function del(){
        $cateid=input('cateid');
        $childrenids=model('cate')->childrenids($cateid);
        $childrenids[]=(int)$cateid;
        //删除栏目及文章相关资源
        foreach ($childrenids as $k => $v) {
            //删除栏目缩略图
            $cates=db('cate')->find($v);
            if($cates['img']){
                 $imgSrc=ADMINIMG.$cates['img'];
                if(file_exists($imgSrc)){
                    @unlink($imgSrc);
                }
            }
            //获取当前栏目对应的模型的附加表名称
            $modelId=$cates['model_id'];
            $models=db('model')->field('table_name')->find($modelId);
            $tableName=$models['table_name'];//附加表名称
            //删除文章操作
            $artRes=db('archives')->where(array('cate_id'=>$v))->select();
            //循环删除附加表里的数据
            foreach ($artRes as $k1 => $v1) {
                db($tableName)->where(array('aid'=>$v1['id']))->delete();
            }
            //删除文章主表对应的缩略图和记录
            foreach ($artRes as $k1 => $v1) {
                //删除文章主表图片
                if($v1['litpic']){
                    $artSrc=INDEXIMG.$v1['litpic'];
                    if(file_exists($artSrc)){
                        @unlink($imgSrc);
                }
                }
                //删除文章主表记录
                db('archives')->delete($v1['id']);
            }
        }
        $del=db('cate')->delete($childrenids);
        if($del){
            model('OperationLog')->add('栏目ID为'.$cateid.'删除成功！');
            $this->success('删除栏目成功！',url('lst'));
        }else{
            $this->error('删除栏目失败！');
        }
    }
    //删除图片
    public function delimg(){
        $cateid=input('cateid');
        $imgurl=input('imgurl');
        $file=input('img');
        $imgurl=INDEXIMGS.$imgurl;
        $res=@unlink($imgurl);
        if($cateid){
            db('cate')->where('id',$cateid)->setField($file,'');
        }
        if($res){
            echo 1;//删除成功
        }else{
            echo 2;//删除失败
        }
    }
    //异步获取模版文件名
    public function ajaxcateinfo(){
        if(request()->isAjax()){
        $cateid=input('cateid');
        $data=db('cate')->find($cateid);
        echo json_encode($data);
    }
    }

    //网站管理页面
    public function cateList(){
        $cate_id=input('cate_id');
        $model_id=input('model_id');

        if(empty($cate_id)){
            $cate_id = 0;
        }
        $pos = $this->pos=model('cate')->position($cate_id);//面包屑数组


         if(!$pos){

        $pos=[];

        }

        //获取栏目
        $cateResLst=db('cate')->where('pid',$cate_id)->order('sort desc,id asc')->select();
        
        $this->assign([
            'cateRes'=>$this->mainColumnList,    //  主栏目列表
            'cate_id'=>$cate_id,    //  上一级栏目id
            'model_id'=>$model_id,    //  上一级栏目id
            'cateResLst'=>$cateResLst,  //  当前所在栏目列表
            'pos'=>$pos,                //  递归，上级所有栏目
            'level'=>count($pos)       //  当前栏目级别
            ]);
        return view();
    }


    //站点编辑栏目
    public function edits(){
        $id=input('id/d');
        $cate_id=input('cate_id/d');
        $rows=db('cate')->find($id);
        $pos = $this->pos=model('cate')->position($id);//面包屑数组
        if(request()->isPost()){
            $data=input('post.');
            $cate_pic=input('pid');
            $cid=input('id');

            
            // 附件上传
            $file = request()->file('img');
            // var_dump($file);die;
            if($file != ''){
                $info = $file->move(ROOT_PATH . 'public/static/index/uploads/cateimg');
                if($info){
                $data['img'] = $info->getSaveName();
                @unlink(ROOT_PATH . 'public/static/index/uploads/cateimg/'.$rows['img']);
                }else{
                    echo $file->getError();
                }
            }else{
                $data['img']=$rows['img'];
            }






             $file = request()->file('cate_file');
            // var_dump($file);die;
            if($file != ''){
                $info = $file->move(ROOT_PATH . 'public/static/index/uploads/cateimg');
                if($info){
                $data['cate_file'] = $info->getSaveName();
                @unlink(ROOT_PATH . 'public/static/index/uploads/cateimg/'.$rows['cate_file']);
                }else{
                    echo $file->getError();
                }
            }else{
                $data['cate_file']=$rows['cate_file'];
            }





            //执行验证
            $validate=validate('cate');
            if(!$validate->scene('edit')->check($data)){
                $this->error($validate->getError());
            }
           /* $data = array_filter($data);*/
            //修改栏目
            $save=db('cate')->update($data);
            // dump($save);die;
            if($save！==false){
                $this->success('编辑成功！');
                model('OperationLog')->add('栏目ID为'.$data['id'].'修改成功！');
                // $this->redirect('catelist',array('cate_id'=>$cate_pic));  
            }else{
                $this->error('编辑失败！');
            }
            return;
        }
        $modelss=db('model')->find($rows['model_id']);
         $modelRes=db('model')->field('id,model_name')->select();
        $cateShows=json_decode($modelss['cate_shows']);

        $this->assign(array(
            'cateRes'=>$this->mainColumnList,
            'rows'=>$rows,
            'id'=>$id,
            'cate_id'=>$cate_id,
            'cateShows'=>$cateShows,
            'modelRes'=>$modelRes,
            'pos'=>$pos
            ));
        return view();
    }

    //网站管理添加栏目
    public function adds(){
        $cate_id=input('cate_id/d');
        $model_id=input('model_id/d');
           
        
        if(request()->isPost()){
            $data=input('post.');

            // 图片上传
            $file_img = request()->file('img');
            if($file_img != ''){
                    $info = $file_img->move(ROOT_PATH . 'public/static/index/uploads/cateimg');
                    if($info){
                    $data['img'] = $info->getSaveName();
                    }else{
                        echo $file_img->getError();
                    }
            }
            // 附件上传
            $file = request()->file('cate_file');
            if($file != ''){
                    $info = $file->move(ROOT_PATH . 'public/static/index/uploads/cateimg');
                    if($info){
                    $data['cate_file'] = $info->getSaveName();
                    }else{
                        echo $file->getError();
                    }
            }
            //执行验证
            $validate=validate('cate');
            if(!$validate->scene('add')->check($data)){
                $this->error($validate->getError());
            }
            $add=db('cate')->insertGetId($data);
            if($add){
                model('OperationLog')->add('栏目ID为'.$add.'添加成功！');
                $this->success('添加成功');
            }else{
                $this->error('添加失败');
            }
            return;
        }
        
        $pos = $this->pos=model('cate')->position($cate_id);//面包屑数组
        if(empty($model_id)){
            $model_id = $pos[0]['model_id'];
        }
        //模型信息
        $modelRes=db('model')->field('id,model_name')->select();

        $modelss=db('model')->find($model_id);
        $cateShows=json_decode($modelss['cate_shows']);
        $this->assign(
            array(
                'cateRes'=>$this->mainColumnList,
                'cate_id'=>$cate_id,
                'pos'=>$pos,
                'modelRes'=>$modelRes,
                'model_id'=>$model_id,
                'cateShows'=>$cateShows
                )
            );
        return view();
    }


    //站点管理删除栏目
    public function dels(){
        $cate_id=input('cate_id/d');

        //  查询是否有子栏目
        $sonId = Db::name('cate')->where(['pid'=>$cate_id])->value('id');

        if($sonId){
            $this->error('有子栏目存在，请先删除子栏目');  
        }
        $sonId = Db::name('archives')->where(['cate_id'=>$cate_id])->value('id');
        if($sonId){
            $this->error('有子栏目存在，请先删除子栏目');  
        }

        $row = Db::name('cate')->delete($cate_id);
        if($row){
            model('OperationLog')->add('栏目ID为'.$cateid.'删除成功！');
            $this->success('删除栏目成功！',url('catelist',array('cid'=>$cid)));
        }else{
            $this->error('删除栏目失败！');
        }
    }
}
