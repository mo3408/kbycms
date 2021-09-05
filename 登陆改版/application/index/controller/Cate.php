<?php
namespace app\index\controller;
class Cate extends Common
{
    public function index($cid)
    {
        $cid = input('cid')+0;  //顶级id
      
        $pos = model('cate')->position($cid);

        $cateList = db('cate')->where(['pid'=>$pos[0]['id'],'status'=>1])->order('sort desc,id asc')->select();

        if($pos[0]['level']==2){
            foreach ($cateList as $key => $value) {
                $cateList[$key]['son'] = db('cate')->where(['pid'=>$value['id'],'status'=>1])->order('sort desc,id asc')->select();
            }
        }
        
        if(count($pos)==1 && $pos[0]['level']==1){ //  判断传递过来是否是顶级id
            $cid = $cateList[0]['id'];
        }else if (count($pos)==1 && $pos[0]['level']==2){ 
            $cid = $cateList[0]['son'][0]['id'];
           
        }else if (count($pos)==2 && $pos[0]['level']==2){
            foreach ($cateList as $key => $value) {
                if($value['id'] ==$cid){
                    $cid = $value['son'][0]['id'];
                }
             }  
        }

        $info = db('cate')->where(['id'=>$cid,'status'=>1])->find();
       
        //  判断模版
        switch ($info['cate_attr']) {
            case '1':
                $cateTmp = $info['list_tmp'];
            break;
            case '2':
                $cateTmp = $info['index_tmp'];
            break;
            case '3':
                $cateTmp = $info['article_tmp'];
            default:
                $cateTmp = $pos[0]['list_tmp'];
            break;

        }
       
        $where = ['cate_id'=>$cid,'show'=>1];
       
       if($pos[0]['id'] == 334 && count($pos)==1){ //  判断是否有分页
            $list=db('cate')->alias('c')->where(['pid'=>334])->join("archives a",'c.id=a.cate_id and a.show=1 and a.home=1')->field('a.id,a.title,a.time,a.a_img,a.content')->limit(8)->order('a.sort desc,a.id desc')->select();
        }else{
             //获取对应附加表的信息
            $models=db('model')->field('table_name')->find($info['model_id']);
            $addTableName=$models['table_name'];
            if($pos[0]['id'] == 336){
                $list=db('archives')->alias('a')->where($where)->join("$addTableName b",'a.id=b.aid')->order('sort desc,id desc')->paginate(6);
            }else{
                $list=db('archives')->alias('a')->where($where)->join("$addTableName b",'a.id=b.aid')->order('sort desc,id desc')->select();
            }
            
        }
        // $list=db('archives')->alias('a')->where($where)->join("$addTableName b",'a.id=b.aid')->order('sort desc,id desc')->paginate(6);
        // $this->assign('total',$list->total());
      // var_dump($list);die;
        
        // echo $list->total();die;
        $tempSrc=$this->confTemp.'/'.$cateTmp;
        $this->assign([
            'cateList'=>$cateList,//列表信息
            'cid'=>$cid,
            'list'=>$list,
            'info'=>$info,
            'pos'=>$pos,


            ]);
        // echo $tempSrc;die;
        return $this->fetch($tempSrc);
    }

    //搜索结果
    public function search(){
        
        
        //echo $search;die;
        $topcid=0;
        //获取当前栏目和子栏目的ID(子栏目和主栏目要用同一模型)
        $sid=model('cate')->childrenids(17);
        $sid[]=intval(17);
        if(request()->isPost()){
            $search=input('search');
            $map['title']=['like',"%".$search."%"];
        }
        $map['cate_id']=array('in',$sid);
        $map['show']=1;
        $artRes=db('archives')->alias('a')->where($map)->join("news b",'a.id=b.aid')->order('sort asc,id desc')->select();//调用新闻列表(子栏目和主栏目要用同一模型)
        $this->assign([
            'topcid'=>$topcid,
            'artRes'=>$artRes,
            ]);
        $tempSrc=$this->confTemp.'/list_search.htm';
        echo $this->fetch($tempSrc);die;
        return $this->fetch($tempSrc);
        
    }

    public function download(){
        
        $id = input('id')+0;
        $info = db('archives')->field('id,model_id,title')->where("id=$id")->find();
        $models=db('model')->field('table_name')->find($info['model_id']);
        $down = db($models['table_name'])->field('down')->where("aid=$id")->find();
        
        
        $path = ROOT_PATH."public\static\index\uploads\att\\".$down['down'];

        $filename = $info['title'];
        $arr = explode('/',$down['down']);
        $hz = end($arr);

        $filename =  str_replace(" ", "", $filename);
        if(empty($filename)){
            $filename = date("Y-m-d H:i:s",time());
        }

        header('Content-type: application/octet-stream');
        header("Content-length:".filesize($path));
        header('Content-Disposition: attachment; filename='.$filename.".$hz");
        readfile("$path",filesize("$path"));

        
    }
}
