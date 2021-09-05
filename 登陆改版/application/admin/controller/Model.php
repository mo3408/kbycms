<?php
namespace app\admin\controller;
use think\Db;
class Model extends Common
{
    //获取模型列表
    public function lst(){
        $modelRes=db('model')->order('id desc')->paginate(12);
        $prefix=config("database.prefix");
        $this->assign(array('modelRes'=>$modelRes,'prefix'=>$prefix));
        return view();
    }

    //模型添加
    public function add(){
        if(request()->isPost()){
            $data=input('post.');
            //dump($data);die;
            if(isset($data['cate_shows'])){
                $data['cate_shows']=json_encode($data['cate_shows']);
            }
            if(!empty($data['ad_shows'])){
                 foreach ($data['ad_shows'] as $key => $value) {
                   $newArr[$value] =  $data['name'][$value];
                }
                $data['ad_shows']=json_encode($newArr);
            }else{
                $data['ad_shows']=null;
            }
            unset($data['name']);
            
            //dump($data);die;
             $validate=validate('Model');
            if(!$validate->scene('add')->check($data)){
                $this->error($validate->getError());
            }
            $add=db('model')->insertGetId($data);
            if($add){
                $tableName=$data['table_name'];
                $tableName=config("database.prefix").$tableName;
                $sql="create table {$tableName} (aid int unsigned not null) engine=MYISAM default charset=utf8";
                Db::execute($sql);
                model('OperationLog')->add('模型ID'.$add.'添加成功！');
                $this->success('添加模型成功！',url('lst'));
            }else{
                $this->error('添加模型失败！');
            }
            return;
        }
        return view();
    }

    //编辑模型
    public function edit(){
        if(request()->isPost()){
            $data=input('post.');

            if(isset($data['cate_shows'])){
                $data['cate_shows']=json_encode($data['cate_shows']);
               
            }else{
                $data['cate_shows'] = null;
            }

            if(!empty($data['ad_shows'])){
                 foreach ($data['ad_shows'] as $key => $value) {
                   $newArr[$value] =  $data['name'][$value];
                }
                $data['ad_shows']=json_encode($newArr);
            }else{
                $data['ad_shows']=null;
            }
            unset($data['name']);

            $oldTablename=db('model')->field('table_name')->find($data['id']);
            $oldTablename=$oldTablename['table_name'];
            $validate=validate('Model');
            if(!$validate->scene('edit')->check($data)){
                $this->error($validate->getError());
            }
             $save=db('model')->update($data);
             if($oldTablename != $data['table_name']){
                $prefix=config("database.prefix");
                $oldTablename=$prefix.$oldTablename;
                $tableName=$prefix.$data['table_name'];
                $sql="alter table {$oldTablename} rename {$tableName}";
                Db::execute($sql);
             }
            if($save){
                model('OperationLog')->add('模型ID'.$data['id'].'修改成功！');
                $this->success('修改栏目成功！',url('lst'));
            }else{
                $this->error('修改栏目失败！');
            }
            return;
        }
        $model=db('model')->find(input('model_id'));
        $cateShows=json_decode($model['cate_shows']);

        if(!empty($model['ad_shows'])){
            $adShows=json_decode($model['ad_shows'],true);
        }else{
             $adShows=[];
        }

        $this->assign(array('model'=>$model,'cateShows'=>$cateShows,'adShows'=>$adShows));
        return view();
    }

    //ajax删除模型
    public function ajaxdel(){
        if(request()->isAjax()){
            $modelId=input('id');
            $tableName=input('table_name');
            $del=db('model')->delete($modelId);
            $sql="drop table {$tableName}";
            Db::execute($sql);
            if($del){
                model('OperationLog')->add('模型ID'.$modelId.'删除成功！');
                echo 1;//删除模型成功
            }else{
                echo 2;//删除模型失败
            }
        }

    }

    //ajax异步修改栏目显示状态
    public function changestatus(){
        if(request()->isAjax()){
            $modelid=input('modelid');
            $status=db('model')->field('status')->where('id',$modelid)->find();
            $status=$status['status'];
            if($status==1){
                db('model')->where('id',$modelid)->update(['status'=>0]);
                model('OperationLog')->add('模型ID'.$modelid.'隐藏成功！');
                echo 1;//显示改为隐藏
            }else{
                db('model')->where('id',$modelid)->update(['status'=>1]);
                model('OperationLog')->add('模型ID'.$modelid.'显示成功！');
                echo 2;//隐藏改为显示
            }
        }else{
            $this->error("非法操作！");//非ajax请求
        }
    }

}
