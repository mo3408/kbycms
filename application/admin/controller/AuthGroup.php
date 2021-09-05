<?php
namespace app\admin\controller;
class AuthGroup extends Common
{
    //用户组列表
    public function lst()
    {
        $authRes=db('authGroup')->paginate(12);
        $this->assign([
            'authRes'=>$authRes,
            ]);
       return view();
    }

    //用户组列表
    public function add()
    {
        if(request()->isPost()){
            $data=input('post.');
            //验证
             $validate=validate('authGroup');
            if(!$validate->scene('add')->check($data)){
                $this->error($validate->getError());
            }
            $add=db('authGroup')->insertGetId($data);
            if($add){
                model('OperationLog')->add('用户组ID为'.$add.'添加成功！');
                $this->success('添加用户组成功！','lst');
            }else{
                $this->error('添加用户组失败！');
            }
            return;
        }
       return view();
    }

    //编辑用户组
    public function edit()
    {
        if(request()->isPost()){
            $data=input('post.');
            //验证
             $validate=validate('authGroup');
            if(!$validate->scene('edit')->check($data)){
                $this->error($validate->getError());
            }
            $save=db('authGroup')->update($data);
            if($save){
                model('OperationLog')->add('用户组ID为'.$data['id'].'编辑成功！');
                $this->success('编辑用户组成功！','lst');
            }else{
                $this->error('编辑用户组失败！');
            }
        }
        $id=input('id');
        $authRes=db('authGroup')->find($id);
        $this->assign([
            'authRes'=>$authRes,
            ]);
       return view();
    }

    //用户组列表
    public function del($id)
    {
        //删除用户组前，先删除用户组下面的用户
        $delAdmin=db('admin')->where(array('groupid'=>$id))->delete();
        $delAdmin=db('auth_group_access')->where(array('group_id'=>$id))->delete();
        $del=db('authGroup')->delete($id);
        if($del&&$delAdmin){
            model('OperationLog')->add('用户组ID为'.$id.'删除成功！');
            $this->success('删除用户组成功！','lst');
        }else{
            $this->error('删除用户组失败！');
        }
       return view();
    }

    //异步修改用户组状态
    public function changeStatus(){
        $id=input('id');
        $status=input('status');
        if($status==1){
            db('authGroup')->where(array('id'=>$id))->update(['status'=>0]);
            model('OperationLog')->add('用户组ID为'.$id.'关闭成功！');
        }else{
            db('authGroup')->where(array('id'=>$id))->update(['status'=>1]);
            model('OperationLog')->add('用户组ID为'.$id.'开启成功！');
        }
    }

    //分配权限
    public function power(){
        if(request()->isPost()){
            $data=input('post.');
            $rules=implode(',', $data['rules']);
            $save=db('authGroup')->where(array('id'=>$data['id']))->update(['rules'=>$rules]);
            if($save !== false){
                model('OperationLog')->add('用户组ID为'.$data['id'].'权限分配成功！');
                $this->success('权限分配成功！');
            }else{
                $this->error('删除权限失败！');
            }
            return;
        }
        $data=db('authRule')->where(array('pid'=>0,'status'=>1))->select();
        foreach ($data as $k => $v) {
            $data[$k]['children']=db('authRule')->where(array('pid'=>$v['id'],'status'=>1))->select();
            foreach ($data[$k]['children'] as $k1 => $v1) {
                $data[$k]['children'][$k1]['children']=db('authRule')->where(array('pid'=>$v1['id'],'status'=>1))->select();
            }
        }
        $id=input('id');
        $authGroups=db('authGroup')->find($id);
        $rules=explode(',', $authGroups['rules']);
        $this->assign([
            'authGroups'=>$authGroups,
            'data'=>$data,
            'rules'=>$rules,
            ]);
        return view();
    }
}
