<?php
namespace app\admin\model;
use think\Model;
class Cate extends Model
{
    public function catetree($cateRes){
        // if($cateRes == ""){
        //     $cateRes=$this->order('sort desc')->select();
        // }
        return $this->sort($cateRes);
    }
    public function sort($cateRes,$pid=0,$level=0){
        static $arr=array();
        foreach ($cateRes as $k => $v) {
            if($v['pid']==$pid){
                $v['level']=$level;
                $arr[]=$v;
                $this->sort($cateRes,$v['id'],$level+1);
            }
        }
        return $arr;
    }
//获取子栏目ID
    public function childrenids($cateid){
        $data=$this->field('id,pid')->select();
        return $this->_childrenids($data,$cateid);
        }

    private function _childrenids($data,$cateid){
        static $arr=array();
        foreach ($data as $k => $v) {
            if($v['pid']==$cateid){
                $arr[]=$v['id'];
                $this->_childrenids($data,$v['id']);
            }
        }
        return $arr;
    }

    //判断是否有子栏目
    public function childrenidRes($cateid){
        $data=db('cate')->field('id,pid,cate_name')->select();
        //dump($data);die;
        return $this->_childrenids($data,$cateid);
        }

    private function _childrenidRes($data,$cateid){
        foreach ($data as $k => $v) {
            if($v['id'] == $cateid ){
                $data[$k]['urls']=1;
             }else{
                $data[$k]['urls']=2;
            } 
            $this->_childrenidRes($data,$v['id']);
        }
        return $data;
    }

//批量删除
    public function pdel($cateids){
         foreach ($cateids as $k => $v) {
                    $childrenidsarr[]=$this->childrenids($v);
                    $childrenidsarr[]=(int)$v;
                }
                $_childeridsarr=array();
                foreach ($childrenidsarr as $k => $v) {
                    if(is_array($v)){
                        foreach ($v as $k1 => $v1) {
                            $_childeridsarr[]=$v1;
                        }
                    }else{
                        $_childeridsarr[]=$v;
                    }
                 }
            $_childeridsarr=array_unique($_childeridsarr);
            $this::destroy($_childeridsarr);
    }

    //面包悄导航
    public function position($cid,$arr=array()){

        $res=db('cate')->field('id,cate_name,pid,cate_attr,level,model_id,index_tmp,list_tmp,article_tmp')->find($cid);
        if(empty($res)){
            return null;
        }

        $arr[] = $res;
        if($res['pid']!=0){
            return $this->position($res['pid'],$arr);
        }else{
            return array_reverse($arr);
        }
    }
    //顶级子栏目
    public function topid($cid){
       $res=db('cate')->field('id,pid')->find($cid);

        if($res['pid']!=0){
            return $this->topid($res['pid']);
        }else{
            return $res['id'];
        }
    }
}


