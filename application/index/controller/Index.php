<?php
namespace app\index\controller;
class Index extends Common
{
    public function index()
    {

        $this->assign([
            'banner'=>$banner,
            'pro_i'=>$pro_i,
            'tic'=>$tic,
            'banner'=>$banner,
            'news_top'=>$news_top,
            'news_i'=>$news_i,
        	]);
        $tempSrc=$this->confTemp.'/index.html';
       
        return $this->fetch($tempSrc);
    }

   
}
