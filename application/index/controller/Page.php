<?php
namespace app\index\controller;
class Page extends Common
{
    public function index($cid)
    {
        
       $catesRes=db('cate')->find($cid);//查询当前栏目信息
        //判断指定栏目的跳转
        if(!$catesRes['jump_id']==0){
            $cid=$catesRes['jump_id'];
            $catesRes=db('cate')->find($cid);//查询当前栏目信息
        }
       $cateTmp=$catesRes['index_tmp'];//当前栏目加载的名称
        $tempSrc=$this->confTemp.'/'.$cateTmp;//组装模版路径加载
        $topcid=model('cate')->getTopId($cid);//顶级栏目ID
         $topCates=db('cate')->find($topcid);//顶级栏目信息
         $sonCateRes=db('cate')->where(array('pid'=>$topcid,'status'=>1))->order('sort asc')->select();//根据主栏目id获取当前主栏目下所有二级栏目
         $pos=model('cate')->position($cid);//面包屑
        $sonCateRes=db('cate')->where(array('pid'=>$topcid,'status'=>1))->order('sort asc')->select();//根据主栏目id获取当前主栏目下所有二级栏目
        $sonCateRess=model('cate')->catetree($topcid);//查找三级菜单
        $sonPid=model('cate')->sonPid($cid,$topcid);//二级栏目ID
         //dump($pos);die;
        $this->assign([
            'topcid'=>$topcid,//顶级栏目ID
            'cid'=>$cid,//当前栏目Id
            'topCates'=>$topCates,//顶级栏目信息
            'sonCateRes'=>$sonCateRes,//子栏目
            'catesRes'=>$catesRes,//当前栏目信息
            'pos'=>$pos,//面包屑信息
            'sonCateRess'=>$sonCateRess,
            ]);
        return $this->fetch($tempSrc);
    }

 
}
