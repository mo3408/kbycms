<?php
namespace app\index\controller;
use think\Controller;
class Common extends Controller
{
    public $confTemp;
    public $confs;
    public function _initialize()
    {
        $this->confs=$this->getConf();//网站配置
        if($this->confs['close']=='是'){

        	header('Content-Type: text/html; charset=utf-8');
            die('网站维护中......');
        }

        $tmpFloder=$this->getTemp();
        $this->confTemp=config('template.view_path').$tmpFloder;//获取当前自定义模版文件夹
        $temp_src=config('view_replace_str.temp_src').$tmpFloder;
        $this->confs=$this->getConf();//网站配置
        $menu= model('Cate')->menu();
        //  底部友情链接
        $links = db('archives')->where(['cate_id'=>330,'show'=>1])->field('link,title,a_img')->order('sort desc,id desc')->select();
        $this->assign([
            'temp'=>$this->confTemp,//获取顶级栏目
            'tempp_src'=>$temp_src,
            'menu'=>$menu,
            'links'=>$links,
            'confs'=>$this->getConf(),
            ]);
    }
   

    public function getTemp(){
        $confTemp=db('conf')->field('value')->where(array('ename'=>'temp'))->find();
        return $confTemp['value'];
    }

    //获取配置项
    public function getConf(){
        $confRes=array();
        $_confRes=db('conf')->select();
        foreach ($_confRes as $k => $v) {
            $confRes[$v['ename']]=$v['value'];
        }
        return $confRes;
    }
}
