<?php
namespace app\index\controller;
class Article extends Common
{
    public function index()
    {
        $id = input('aid')+0;
        $cid = input('cid')+0;
        if(!empty($id)){
            $arts=db('archives')->find($id);
            //dump($arts);
            $cid=$arts['cate_id'];
        }
         
        $pos=model('cate')->position($cid);//面包屑
        // var_dump($pos);die;
        $artTmp=$pos[0]['article_tmp'];
        $tempSrc=$this->confTemp.'/'.$artTmp;
         //获取对应附加表的信息
        $models=db('model')->field('table_name')->find($pos[0]['model_id']);
        $addTableName=$models['table_name'];
        if($pos[0]['level']===0){
          $cateList=db('archives')->where(['cate_id'=>$pos[0]['id'],'show'=>1])->order('sort desc,id desc')->select();
        }elseif($pos[0]['level']===2){
        $cateList=db('cate')->where(array('pid'=>$pos[0]['id'],'status'=>1))->order('sort desc,id asc')->select(); 

          foreach ($cateList as $key => $value) {
                $cateList[$key]['son'] = db('cate')->where(['pid'=>$value['id'],'status'=>1])->order('sort desc,id asc')->select();
            }
            $info = db('cate')->where(['id'=>$cid,'status'=>1])->find();  
            $this->assign(['info'=>$info]);
        }else{
            
            $cateList=db('cate')->where(array('pid'=>$pos[0]['id'],'status'=>1))->order('sort desc,id asc')->select(); 
            foreach ($cateList as $key => $value) {
                if($value['id'] == $cid){
                    $info = $value;
                }
            }
            $info = db('cate')->where(['id'=>$cid,'status'=>1])->find();
            $this->assign(['info'=>$info]);
        }

        if(empty($id)){
          $id = $cateList[0]['id'];
          $arts=db('archives')->find($id);
        }

        $PN = $this->getNextPrevArticle($id,$arts['cate_id']);
        $this->assign('pn',$PN);
      
        $catesRes=db($addTableName)->where(['aid'=>$id])->find();

        if(!empty($catesRes)){
            $arts = array_merge($arts,$catesRes);
        }

         db()->execute('update tp_archives set click =click+1  where id ='.$id);

         if($pos[0]['id'] == 334 || $pos[0]['id'] == 335){
            preg_match_all('/<img.*?src="(.*?)".*?>/is',$arts['all_img'],$imgs);
            $this->assign('imgs',$imgs[1]); 
         }

        $this->assign([
            'cid'=>$cid,//肖前栏目ID
            'aid'=>$id,//肖前栏目ID
            'cateList'=>$cateList,//子栏目信息
            'pos'=>$pos,//面包屑
            'arts'=>$arts
            ]);
        return $this->fetch($tempSrc);
    }
    private function getNextPrevArticle($id,$pid)
    {
        
        $map['show'] = 1;
        $map['cate_id'] = $pid;

        $list = db('archives')->where($map)->order('top desc,sort desc,time desc,id desc')->field('id,title,cate_id,writer')->select();
        $prev = [];
        $next = [];

        foreach ($list as $key => $value) {
            if($value['id'] == $id){

                if(isset($list[$key-1])){
                    $prev = $list[$key-1];
                }

                if(isset($list[$key+1])){
                    $next = $list[$key+1];
                }
            }
        }
        return ['prev'=>$prev,'next'=>$next];
    }
}
