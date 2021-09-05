<?php
namespace app\admin\controller;
class Adpos extends Common
{
    //广告位列表
    public function lst()
    {
        $adposRes=db('adpos')->paginate(12);
        $this->assign('adposRes',$adposRes);
        return view();
    }

    //添加广告位
    public function add()
    {
        if(request()->isPost()){
            $data=input('post.');
            $validate=validate('adpos');
            //验证
            if(!$validate->check($data)){
                $this->error($validate->getError());
            }
            $add=db('adpos')->insertGetId($data);
            if($add){
                model('OperationLog')->add('广告位ID为'.$add.'添加成功！');
                //$this->success('广告位添加成功！','lst');
                return json(['status'=>1,'msg'=>'广告位添加成功！']);
            }else{
                //$this->error('广告位添加失败！');
                return json(['status'=>2,'msg'=>'广告位添加失败！']);
            }
        }
        return view();
    }

    //编辑广告位
    public function edit($id){
        if(request()->isPost()){
            $data=input('post.');
            $validate=validate('adpos');
            //验证
            if(!$validate->check($data)){
                    $this->error($validate->getError());
                }
            $save=db('adpos')->update($data);
            if($save){
                model('OperationLog')->add('广告位ID为'.$id.'编辑成功！');
                return json(['status'=>1,'msg'=>'编辑成功']);
                exit;
            }else{
                return json(['status'=>2,'msg'=>'编辑失败']);
                exit;
            }
        }else{
            $adposs=db('adpos')->find($id);
            $this->assign('adposs',$adposs);
            return view();
        }
        
    }

    //删除广告位
    public function del($id){
        $adpos=model('adpos');
        $del=$adpos::destroy($id);
        if($del){
            model('OperationLog')->add('广告位ID为'.$id.'删除成功！');
            $this->success('广告位删除成功！','lst');
        }else{
            $thit->error('广告位删除失败！');
        }
    }
}
