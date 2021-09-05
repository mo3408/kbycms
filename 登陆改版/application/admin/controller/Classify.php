<?php
namespace app\admin\controller;
class Classify extends Common
{
    public function index(){
        $pid=input('pid');
        $pos = $this->pos=model('cate')->position($pid);//面包屑数组

        //获取栏目
        $list=db('class')->where('pid',$pid)->order('sort desc,id asc')->select();
        $this->assign([
            'pid'=>$pid,    //  上一级栏目id
            'list'=>$list,  //  当前所在栏目列表
            'pos'=>$pos,                //  递归，上级所有栏目
            'level'=>count($pos)       //  当前栏目级别
            ]);
        return view();
    }

    public function ajaxlst(){
        if(request()->isAjax()){
            $cateid=input('cateid');
            return $sonid=model('cate')->childrenids($cateid);
            echo json_encode($cateid);
        }else{
            $this->error('非法操作！');
        }
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
            $status=db('class')->field('status')->where('id',$cateid)->find();
            $status=$status['status'];
            if($status==1){
                db('class')->where('id',$cateid)->update(['status'=>0]);
                echo 1;//显示改为隐藏
            }else{
                db('class')->where('id',$cateid)->update(['status'=>1]);
                echo 2;//隐藏改为显示
            }
        }else{
            $this->error("非法操作！");//非ajax请求
        }
    }
//删除栏目
    public function del(){
        $id=input('id'); 
        $pid=input('pid'); 
        $del=db('class')->delete($id);
        if($del){
            model('OperationLog')->add('栏目ID为'.$id.'删除成功！');
            $this->success('删除栏目成功！',url('index',['pid'=>$pid]));
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

    //站点编辑栏目
    public function edits(){
        $id=input('id');
        $pid=input('pid');
        $rows=db('class')->find($id);

        if(request()->isPost()){
            $data=input('post.');
            $pid=input('pid');
            $id=input('id');

            
            // 附件上传
            $file = request()->file('img');
            if($file != ''){
                $info = $file->move(ROOT_PATH . 'public/static/index/uploads/cateimg');
                if($info){
                $data['img'] = $info->getSaveName();
                }else{
                    echo $file->getError();
                }
            }
           
            //修改栏目
            $save=db('class')->update($data);
            // dump($save);die;
            if($save===0 || !empty($save)){
                //$this->success('修改栏目成功！',url('cateList'));
                model('OperationLog')->add('栏目ID为'.$data['id'].'修改成功！');
                $this->redirect('index',array('pid'=>$pid));  
            }else{
                $this->error('修改栏目失败！');
            }
      
            return;
        
        }
        $pos = $this->pos=model('cate')->position($pid);//面包屑数组
        $this->assign(array(
            'rows'=>$rows,
            'id'=>$id,
            'pid'=>$pid,
            'pos'=>$pos
            ));
        return view();
    }

    //网站管理添加栏目
    public function adds(){
        $pid=input('pid');
        if(request()->isPost()){
            $data=input('post.');
            $data['add_time']=time();

            // 附件上传
            $file = request()->file('img');
            if($file != ''){
                    $info = $file->move(ROOT_PATH . 'public/static/index/uploads/cateimg');
                    if($info){
                    $data['img'] = $info->getSaveName();
                    }else{
                        echo $file->getError();
                    }
            }

            $add=db('class')->insertGetId($data);
            if($add){
                model('OperationLog')->add('栏目ID为'.$add.'添加成功！');
                //$this->success('添加栏目成功！',url('lst'));
                $this->redirect('index',array('pid'=>$pid));  
            }else{
                $this->error('添加栏目失败！');
            }
            return;
        }
        
        $pos = $this->pos=model('cate')->position($pid);//面包屑数组

        $this->assign(
            array(
                'pid'=>$pid,
                'pos'=>$pos,
                )
            );
        return view();
    }
}
