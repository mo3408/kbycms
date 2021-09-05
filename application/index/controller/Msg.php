<?php
namespace app\index\controller;
class Msg extends Common
{
    public function index()
    {
        if(request()->isPost()){
            // if(!captcha_check(input('code'))){
            //      //验证失败
            //      return 1;exit;
            // };
               
            $datas=input();
            unset($datas['code']);
            $datas['add_time'] = time();
            $datas['ip'] = request()->ip();
            
            $adds=db('message')->insert($datas);
            if(!empty($adds)){
                return 2;
            }else{
                return 3;
            }
            return;

        }
        // $cateList = db('cate')->where(['pid'=>123,'status'=>1])->order('sort desc,id asc')->select();
        // $tempSrc=$this->confTemp.'/Msg.htm';
        // $this->assign([
        //     'cateList'=>$cateList
        //     ]);
        // return $this->fetch($tempSrc);
    }

  
}
