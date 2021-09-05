<?php
namespace app\admin\controller;
class AuthRule extends Common
{
    //规则列表
    public function lst()
    {
        $ruleRes=db('authRule')->select();
        $ruleTree=model('authRule')->ruletree($ruleRes);
        $this->assign([
            'ruleTree'=>$ruleTree,
            ]);
        return view();
    }

    //添加规则
    public function add()
    {
        if(request()->isPost()){
            $data=input('post.');
            //验证
             $validate=validate('authRule');
            if(!$validate->scene('add')->check($data)){
                $this->error($validate->getError());
            }
            $add=db('authRule')->insertGetId($data);
            if($add){
                model('OperationLog')->add('规则ID为'.$add.'添加成功！');
                $this->success('添加规则成功！','lst');
            }else{
                $this->error('添加规则失败！');
            }
            return;
        }
        $ruleRes=db('authRule')->select();
        $ruleRes=model('authRule')->ruletree($ruleRes);
        $this->assign([
            'ruleRes'=>$ruleRes,
            ]);
        return view();
    }

    //编辑规则
    public function edit()
    {
        if(request()->isPost()){
            $data=input('post.');
            //验证
             $validate=validate('authRule');
            if(!$validate->scene('edit')->check($data)){
                $this->error($validate->getError());
            }
            $save=db('authRule')->update($data);
            if($save){
                model('OperationLog')->add('规则ID为'.$data['id'].'编辑成功！');
                $this->success('编辑规则成功！','lst');
            }else{
                $this->error('编辑规则失败！');
            }
            return;
        }
        //接收栏目ID
        $ruleid=input('id');
        $rules=db('AuthRule')->find($ruleid);
        $ruleRes=db('AuthRule')->select();
        $ruleRes=model('authRule')->ruletree($ruleRes);
        $this->assign([
            'ruleRes'=>$ruleRes,
            'rules'=>$rules,
            ]);
        return view();
    }

    //删除规则
    public function del($id)
    {
        $cid=model('authRule')->childrenids($id);
        //dump($cid);die;
        $cid[]=$id;
        $del=db('authRule')->delete($cid);
        if($del){
            model('OperationLog')->add('规则ID为'.$id.'删除成功！');
            $this->success('删除规则成功！','lst');
        }else{
            $this->error('删除规则失败！');
        }
        return view();
    }

     //
    public function ajaxlst(){
        if(request()->isAjax()){
        $ruleid=input('ruleid');
        return $sonid=model('authRule')->childrenids($ruleid);
        echo json_encode($ruleid);
        }else{
            $this->error('非法操作！');
        }
    }
}
