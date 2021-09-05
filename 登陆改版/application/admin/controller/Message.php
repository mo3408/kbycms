<?php
namespace app\admin\controller;
class Message extends Common
{
     public function __construct() 
    {
        parent::__construct();
        $this->mainColumnList=db('cate')->where(array('pid'=>0,'language'=>'cn'))->order('sort asc')->select();
        $this->assign(['cateRes'=>$this->mainColumnList]);
    }
    //获取栏目
    public function index(){

    	if(request()->isAjax()){
    		$id = input('id')+0;
	   		$res = db('message')->where(['id'=>$id])->delete($id);
	   		if(!empty($res)){
	   			echo 1;
	   		}else{
	   			echo 2;
	   		}
	   		exit;
    	}
        $list = db('message')->order('id desc')->paginate(15);
        $this->assign(['list'=>$list]);
        return view();
    }

   	public function del(){
   		
   	}

}
