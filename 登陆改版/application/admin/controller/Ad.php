<?php
namespace app\admin\controller;
class ad extends Common
{
    //广告列表
    public function lst()
    {
        //获取表前缀
        $prefix=config('database.prefix');
        $adposName=$prefix.'adpos';
        $adRes=db('ad')->field('a.*,b.name')->alias('a')->join("$adposName b",'a.adpos_id = b.id')->paginate(12);
        $this->assign('adRes',$adRes);
        return view();
    }

    //添加广告
    public function add()
    { 
        if(request()->isPost()){
            $data=input('post.');
            //验证
             $validate=validate('ad');
            if(!$validate->check($data)){
                $this->error($validate->getError());
            }
            $ad=model('ad');
            $ad->data($data);
            $add=$ad->save();
            if($add){
                //echo $ad->id;die;
                model('OperationLog')->add('添加广告ID'.$ad->id.'成功！');
                $this->success('广告添加成功！','lst');
            }else{
                $this->error('广告添加失败！');
            }
        }
        //广告位信息
        $adposRes=db('adpos')->field('id,name,height,width')->select();
        //dump($adposRes);
        $this->assign([
            'adposRes'=>$adposRes,
            ]);
        return view();
    }

    //编辑广告
    public function edit($id){
        if(request()->isPost()){
            $data=input('post.');
            //验证
            $validate=validate('ad');
            if(!$validate->check($data)){
                     $this->error($validate->getError());
                 }
            $ad=model('ad');
            $save=$ad->update($data);
            if($save!==false){
                model('OperationLog')->add('编辑广告ID'.$id.'成功！');
                $this->success('广告编辑成功！','lst');
            }else{
                $this->error('广告编辑失败！');
            }
        }
        $adposRes=db('adpos')->field('id,name,height,width')->select();
        $ad=db('ad')->find($id);
        if($ad['type']==2){
            $adflashRes=db('adflash')->where(array('ad_id'=>$id))->order('id desc')->select();
            $this->assign('adflashRes',$adflashRes);
        }
        $this->assign([
            'ad'=>$ad,
            'adposRes'=>$adposRes,
            ]);
        return view();
    }

    //删除广告
    public function del($id){
        $ad=model('ad');
        $del=$ad::destroy($id);
        if($del){
            model('OperationLog')->add('删除广告ID'.$id.'成功！');
            $this->success('广告删除成功！','lst');
        }else{
            $thit->error('广告删除失败！');
        }
    }

    //ajax更改广告开启状态
    public function changeStatus(){
        $id=input('id');
        $adposId=input('adposId');
        $ads=db('ad')->find($id);
        if($ads['on']==0){
            //echo 1;die;
            db('ad')->where(array('adpos_id'=>$adposId))->update(['on'=>0]);
            db('ad')->where(array('id'=>$id))->update(['on'=>1]);
            model('OperationLog')->add('开启广告ID'.$id.'成功！');
        }else{
            db('ad')->where(array('id'=>$id))->update(['on'=>0]);
        }
    }

    //删除异步删除轮换广告记录
    public function ajaxdel(){
        $id=input('id');
        $adflash=db('adflash')->find($id);
        $imgSrc=$adflash['fimg_src'];
        $imgSrc=INDEXAD.$imgSrc;
        if(file_exists($imgSrc)){
            @unlink($imgSrc);
        }
        $del=db('adflash')->delete($id);
        if($del){
            model('OperationLog')->add('删除广告ID'.$id.'成功！');
            echo 1;//成功
        }else{
            echo 0;//失败
        }
    }
}
