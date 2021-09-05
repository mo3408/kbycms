<?php
namespace app\index\model;
use think\Model;
class Cate extends Model
{
    //面包悄导航
    public function position($cid,$arr=[]){
       $res=db('cate')->field('id,cate_name,pid,cate_attr,level,list_tmp,model_id,article_tmp,img')->find($cid);
        if(empty($res)){
            return false;
        }

        $arr[] = $res;
        if($res['pid']!=0){
            return $this->position($res['pid'],$arr);
        }else{
            return array_reverse($arr);
        }
    }
    public function pos($inId,$arr=[]){
        $res=db('cate')->field('id,cate_name,pid')->where("pid in($inId)")->select();

        if(!empty($res)){
            $str = '';
            foreach ($res as $key => $value) {
               $str .= $value['id'].',';
            }
            $str = rtrim($str,',');
            $res['inId'] = $str;
            $arr = $res;
            return $this->pos($str,$arr); 
        }else{
            return $arr;
        }
    }


        
    public function cate_level($cid){

        $topcid=$this->topid($cid);

        if($cid==$topcid){


        return 1;


        }else{


        $arr1=true;

        $i=1;

        while(true){

         $arr=db('cate')->where('id',$cid)->value('pid');   

        $i++;

        if($arr==$topcid){


        break;


        }

        $cid=$arr;

        }



        return $i;





}







}



    public function bottomchildern($cateid,$un=[]){


       $arr=array();
       $sonarr=db('cate')->where(array('pid'=>$cateid,'status'=>1,'cate_attr'=>1))->order('sort desc')->field('id')->select();

       if($sonarr){
        foreach ($sonarr as $k => $v) {
           
        $arr1=$this->bottomchildern($v['id']);
        
        $arr=array_merge($arr,$arr1); 
        }


       }else{

       $arr[]=$cateid;

       }


     
       foreach ($un as $k => $v) {
           
            if(in_array($v, $arr)){


                $arr=$this->delByValue($arr,$v);
            }
       }


   return $arr;

 }  




 function delByValue($arr, $value){
  if(!is_array($arr)){
    return $arr;
  }
  foreach($arr as $k=>$v){
    if($v == $value){
      unset($arr[$k]);
    }
  }
  return $arr;
}



    public function menu(){
        $list = db('cate')->field('cate_name,id,level')->where(array('pid'=>0,'status'=>1))->where('bottom_nav!=1')->order('sort desc,id asc')->select();
        foreach ($list as $key => $value) {
           if($value['level']==0){
            $list[$key]['son'] = db('archives')->field('title,id,a_img')->where(['cate_id'=>$value['id'],'show'=>1])->order('top desc,sort desc,id desc')->select();
           }else{
                $list[$key]['son'] = db('cate')->field('cate_name,id,img')->where(array('pid'=>$value['id'],'status'=>1))->order('sort desc,id asc')->select();
           }
        }
        return $list;
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
    //根据当前栏目ID获取顶级栏目的ID
    public function getTopId($cid){
        $data=db('cate')->field('id,pid')->select();
        $arr=array();
        foreach ($data as $k => $v) {
            $arr[$v['id']]=$v['pid'];
        }
        $id=$cid;
        while ($arr[$id]) {
            $id=$arr[$id];
        }
        return $id;
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

    //首页截取数据
    public function getPageContent($cid,$length){
        $cates=$this->field('content')->find($cid);
        $content=strip_tags($cates['content']);
        $content=cut_str($content,$length);
        return $content;
    }

    //首页栏目内容截取数据
    public function getPageCates($cid,$length){
        $getcate=array();
        $cates=$this->field('id,cate_name,desc,content,img,cate_ename')->find($cid);
        $content=strip_tags($cates['content']);
        $desc=strip_tags($cates['desc']);
        $getcate['content']=cut_str($content,$length);//内容
        $getcate['desc']=cut_str($desc,$length);//描述
        $getcate['cate_name']=$cates['cate_name'];//标题
        $getcate['cate_ename']=$cates['cate_ename'];//副标题
        $getcate['img']=$cates['img'];//图片
        $getcate['id']=$cates['id'];//id
        return $getcate;
    }

    //查找三级菜单 
    
    public function catetree($pid){
         $catRes=db('cate')->where(array('pid'=>$pid,'status'=>1))->order('sort asc')->select();
            foreach ($catRes as $k => $v) {
                $catRes[$k]['children']=db('cate')->where(array('pid'=>$v['id'],'status'=>1))->order('sort desc')->select();
                foreach ($catRes[$k]['children'] as $k1 => $v1) {
                    $catRes[$k]['children'][$k1]['children']=db('cate')->where(array('pid'=>$v1['id'],'status'=>1))->order('sort desc')->select();
                }
            }
         return $catRes;
   
}

}
