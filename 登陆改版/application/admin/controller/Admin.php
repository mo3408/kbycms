<?php
namespace app\admin\controller;
use QL\QueryList;
use think\Db;
class Admin extends Common
{
    //显示管理员列表
    public function lst(){
        //管理员数据
        if(session('groupid')!==1){
            $map['groupid']=['>',1];
        }else{
            $map=1;
        }
        $adminRes=db('admin')->alias('a')->field('a.*,g.title')->join('auth_group g','a.groupid=g.id')->where($map)->paginate(12);
        $this->assign('adminRes',$adminRes);
       return view();
    }

    //添加管理员
    public function add(){
        if(request()->isPost()){
            $data=input('post.');
            //验证
             $validate=validate('admin');
            if(!$validate->scene('add')->check($data)){
                $this->error($validate->getError());
            }
            $data['password']=md5($data['password']);
            $data['last_time']=time();
            $data['create_time']=time();
            $add=db('admin')->insertGetId($data);
            $_data=array();//对应管理员和用户组
            $_data['uid']=$add;
            $_data['group_id']=$data['groupid'];
            $addGroup=db('auth_group_access')->insert($_data);
            if($add&&$addGroup){
                model('OperationLog')->add('添加管理员'.$data['uname'].'成功！');
                $this->success('添加用户成功！','lst');
            }else{
                 $this->error('用户添加失败！');
            }
            return;
        }
        //用户组数据
        if(session('groupid')!==1){
            $map['id']=['>',1];
        }else{
            $map=1;
        }
        $groupRes=db('authGroup')->where($map)->select();
        $this->assign([
            'groupRes'=>$groupRes,
            ]);
       return view();
    }

    //编辑管理员
    public function edit(){
        if(request()->isPost()){
            $data=input('post.');
            //验证
             $validate=validate('admin');
            if(!$validate->scene('edit')->check($data)){
                $this->error($validate->getError());
            }
            if($data['password']){
                $data['password']=md5($data['password']);
            }else{
                unset($data['password']);
            }
            //dump($data);die;
            $save=db('admin')->update($data);
            db('auth_group_access')->where(array('uid'=>$data['id']))->update(['group_id'=>$data['groupid']]);
            if($save!==false){
                model('OperationLog')->add('修改管理员ID'.$data['id'].'成功！');
                $this->success('修改用户成功！','index/index');
            }else{
                 $this->error('用户修改失败！');
            }
            return;
        }
        $admin=db('admin')->field('id,uname,groupid')->find(input('id'));
        //用户组数据
        if(session('groupid')!==1){
            $map['id']=['>',1];
        }else{
            $map=1;
        }
        $groupRes=db('authGroup')->where($map)->select();
        $this->assign([
            'groupRes'=>$groupRes,
            'admin'=>$admin,
            ]);
       return view();
    }

     //删除管理员
    public function del($id){
        if($id==1){
            $this->error('超级管理员不能删除！');
        }
        $del=db('admin')->delete($id);
        $delaga=db('auth_group_access')->where('uid',$id)->delete();
        if($del&&$delaga){
            model('OperationLog')->add('修改管理员ID'.$id.'成功！');
            $this->success('删除管理员成功！','lst');
        }else{
            $this->error('删除管理员失败！');
        }
       return view();
    }

    //ajax修改管理员状态
    public function changestatus($id){
        $admins=db('admin')->field('status')->find($id);
        $status=$admins['status'];
        if($status==1){
            db('admin')->where(array('id'=>$id))->update(['status'=>0]);
            model('OperationLog')->add('管理员ID'.$id.'禁用成功！');
    }else{
            db('admin')->where(array('id'=>$id))->update(['status'=>1]);
            model('OperationLog')->add('管理员ID'.$id.'启用成功！');
    }
    }

    //退出登录
    public function logout(){
        model('OperationLog')->add('退出成功！');
        session(null);
        // $this->success('退出成功！','Login/login');
        $this->redirect('Login/login');
    }

    //日志显示
    public function operation(){
            $operationRes=db('operation_log')->alias('a')->field('a.*,g.title')->join('auth_group g','a.group=g.id')->order('a.id DESC')->paginate(12);
            $this->assign('operationRes',$operationRes);
            return view();
    }
    //日志查询显示
    public function logserch(){
         if(request()->isPost()){
            $key=input('key');
            //echo $key;die;
            $operationRes=db('operation_log')->alias('a')->field('a.*,g.title')->join('auth_group g','a.group=g.id')->where('user|action|','like','%'.$key.'%')->order('a.id DESC')->select();
            $this->assign('operationRes',$operationRes);
            //dump($operationRes);
            return view();
        }
    }
    //删除单条日志
    public function deloperation($id){
        $del=db('operation_log')->delete($id);
        if($del){
            model('OperationLog')->add('管理员删除ID为'.$id.'的日志成功！');
            $this->success('删除日志成功！');
        }else{
            $this->error('删除日志失败！');
        }
         return view();
    }
    //删除一周前的日志
    public function dellstoperation(){
        $map['logtime']=['<',strtotime("-2 week")];
        $del=db('operation_log')->where($map)->delete();
        if($del){
            model('OperationLog')->add('管理员批量删除日志成功！');
            $this->success('批量删除日志成功！');
        }else{
            $this->error('批量删除日志失败，没有两周前的日志了！');
        }
         return view();
    }



    /**
     * 修改密码
     */
    public function updatePwd()
    {
        $admin_id = session('id');

        $old_pwd = md5(input('old_pwd/s'));
        $new_pwd = md5(input('new_pwd/s'));
        $uname = input('uname/s');

        $info = Db::name('admin')->find($admin_id);

        if($old_pwd != $info['password']){
            return json(['status'=>-1,'msg'=>'旧密码错误']);
        }

       $row =  Db::name('admin')->update(['id'=>$admin_id,'password'=>$new_pwd,'uname'=>$uname]);

       if($row !== false){
            return json(['status'=>1,'msg'=>'修改成功']);
       }else{
            return json(['status'=>-1,'msg'=>'修改失败']);
       }
    }
}
