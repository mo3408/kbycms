<?php
namespace app\admin\controller;
class Conf extends Common
{
    //显示列表
    public function conflst()
    {
        if(request()->isPost()){

            //dump($_FILES);die;
            $data=input('post.');
            $enameArr=db('conf')->column('ename');
            //附件类型批量处理
            //dump($_FILES);die;
            $imgcolumn=db('conf')->where(array('dt_type'=>6,'status'=>1))->column('ename');
            $confArr=array();
            foreach ($data as $k => $v) {
                $confArr[]=$k;
                if(is_array($v)){
                    $v=implode(',',$v);
                }
                db('conf')->where('ename',$k)->update(['value'=>$v]);
            }
            foreach ($enameArr as $k => $v) {
                if(!in_array($v, $confArr) && !in_array($v, $imgcolumn)){
                     db('conf')->where('ename',$v)->update(['value'=>'']);
                }
            }
            
            foreach ($imgcolumn as  $k => $v) {
                if($_FILES[$v]['tmp_name'] != ''){
                    $file = request()->file($v);
                    $info = $file->move(ROOT_PATH . 'public/static/index/uploads/img');
                    $imgSrc = $info->getSaveName();
                    if($imgSrc!=''){
                        db('conf')->where('ename',$v)->update(['value'=>$imgSrc]);
                    }
                }
            }
            model('OperationLog')->add('修改配置成功');
            $this->success('修改配置成功！',url('conflst'));
            return;
        }
        $confRes=db('conf')->where('status',1)->order('sort asc')->select();
        $this->assign('confRes',$confRes);
        $cftype=db('cftype')->select();
        $this->assign('cftype',$cftype);
        return view();
    }
    public function lst()
    {
        $confRes=db('conf')->field('id,cname,ename,value,values,status')->order('sort asc')->paginate(12);
        $this->assign('confRes',$confRes);
        return view();
    }
        public function sllst($id)
    {
        $confRes=db('conf')->field('id,cname,ename,value,values')->where('cf_type',$id)->paginate(12);
        $this->assign('confRes',$confRes);
        $this->assign('cf_type',$id);
        return view();
    }
 //添加配置
    public function add($id=1)
    {
        if(request()->isPost()){
            $data=input('post.');
            $validate=validate('conf');
            if(!$validate->scene('add')->check($data)){
                $this->error($validate->getError());
            }
            $add=db('conf')->insertGetId($data);
            if($add){
                model('OperationLog')->add('修改配置项id'.$add.'成功!');
                $this->success('添加配置项成功！',url('lst'));
            }else{
                $this->error('添加配置项失败！');
            }
            //dump(input("post."));//die;
        }
        $cftype=db('cftype')->select();
        $this->assign('cftype',$cftype);
        $this->assign('cf_type',$id);
        return view();
    }
    //编辑配置
    public function edit($id)
    {
        if(request()->isPost()){
            $data=input('post.');
            //dump($data);die;
            $validate=validate('conf');
               // if(!$validate->scene('edit')->check($data)){
                //    $this->error($validate->getError());
               // }
            $save=db('conf')->update($data);
            if($save){
                model('OperationLog')->add('编辑配置项成功！');
                $this->success('编辑配置项成功！',url('lst'));
            }else{
                $this->error('编辑配置项失败');
            }
            //dump(input('post.'));die;
        }
        $confs=db('conf')->find($id);
        $this->assign('confs',$confs);
        $cftype=db('cftype')->select();
        $this->assign('cftype',$cftype);
        return view();
    }
    //删除配置
    public function del($id)
    {
        $del=db('conf')->delete($id);
        if($del){
            model('OperationLog')->add('删除配置项'.$id.'成功！');
            $this->success('删除配置项成功！',url('lst'));
        }else{
            $this->error('删除配置项失败！');
        }
    }
//添加配置类型
    public function cftype()
    {
        $confRes=db('cftype')->field('id,cf_type')->paginate(12);
        $this->assign('confRes',$confRes);
        return view();
      }
      public function addcftype()
    {
        if(request()->isPost()){
            $data=input('post.');
            //dump($data);die;
            $validate=validate('Cftype');
            if(!$validate->check($data)){
                $this->error($validate->getError());
            }
            $add=db('cftype')->insertGetId($data);
            if($add){
                model('OperationLog')->add('配置项ID'.$add.'添加成功！');
                $this->success('添加配置类型项成功！',url('cftype'));
            }else{
                $this->error('添加配置类型项失败！');
            }
            //dump(input("post."));//die;
        }
        return view();
      }
     //编辑配置置项
    public function editcftype($id)
    {
        if(request()->isPost()){
            $data=input('post.');
            $validate=validate('cftype');
                if(!$validate->scene('add')->check($data)){
                    $this->error($validate->getError());
                }
            $save=db('cftype')->update($data);
            if($save){
                model('OperationLog')->add('配置项ID'.$data['id'].'编辑成功！');
                $this->success('编辑配置项成功！',url('cftype'));
            }else{
                $this->error('编辑配置项失败');
            }
            //dump(input('post.'));die;
        }
        $confs=db('cftype')->find($id);
        $this->assign('confs',$confs);
        return view();
    }
    public function delcftype($id)
    {
        $del=db('cftype')->delete($id);
        if($del){
            model('OperationLog')->add('配置项ID'.$id.'删除成功！');
            $this->success('删除配置项成功！',url('cftype'));
        }else{
            $this->error('删除配置项失败！');
        }
    }

        //数据库备份
        public function bak(){
           $type=input("tp");
           $name=input("name");
           $sql=new \org\Baksql(\think\Config::get("database"));
           switch ($type)
            {
            case "backup": //备份
            model('OperationLog')->add('备份数据库成功！');
              return $sql->backup();
              break;  
            case "dowonload": //下载
            model('OperationLog')->add('下载数据库成功！');
              $sql->downloadFile($name);
              break;  
            case "restore": //还原
            model('OperationLog')->add('还原数据库成功！');
              return $sql->restore($name);
              break; 
            case "del": //删除
            model('OperationLog')->add('删除数据库备份成功！');
              return $sql->delfilename($name);
              break;          
            default: //获取备份文件列表
                return $this->fetch("bak",["list"=>$sql->get_filelist()]); 
              
            }
            
        }

}
