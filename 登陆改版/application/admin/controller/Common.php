<?php
namespace app\admin\controller;
use think\Controller;
use think\Request;
use auth\Auth;
class Common extends Controller
//菜单公共
{
   //配置项
   public $config;
   //后台菜单对应模型
   public function _initialize(){
    // echo request()->module();die;
    // echo request()->controller();die;
    // echo request()->action();die;
    if(!session('uname') && request()->controller()=='Index'){
      exception('异常消息', 404);exit;
            // $this->success('您先登录系统！','Login/login');
    }
    if(!session('uname')){
      $this->error('您先登录系统！','Login/login');
    }

     //  获取路由
    $request = Request::instance();
    $con=$request->controller(); 
    $module=$request->module();
    $action=$request->action();
    $name=$module.'/'.$con.'/'.$action;//组合规则名称
    $name=strtolower($name);//组合规则名称
    $this->assign('con',$con);
    $this->assign('action',$action);
    $this->assign('name',$name);

   
    $auth=new Auth();
    if(!$request->isPost()){
            //显示菜单操作开始
        $group=$auth->getGroups(session('id'));
        $rules=explode(',', $group[0]['rules']);
         // var_dump($name);die;
        $this->getConf();
        $weblanguage=$this->weblanguage();
        $this->assign('weblanguage',$weblanguage);
    
        $menu=array();
        //查询顶级规则
        $map['pid']=['=',0];
        $map['show']=['=',1];
        $map['id']=['in',$rules];
        $_map['id']=['in',$rules];
        $menu=db('authRule')->where($map)->select();
        foreach ($menu as $k => $v) {
            $menu[$k]['children']=db('authRule')->where($_map)->where(array('pid'=>$v['id'],'show'=>1))->select();
            foreach ($menu[$k]['children'] as $k1 => $v1) {
                $menu[$k]['children'][$k1]['children']=db('authRule')->where($_map)->where(array('pid'=>$v1['id'],'show'=>1))->select();
            }
        }

        $this->assign([
          'menu'=>$menu,
          // 'confs'=>$confs
        ]);
 
    }


   
    $noLogin = ['admin/admin/updatepwd','admin/admin/logout'];

    //显示菜单操作结束
    //name是权限的规则
    // if(!$auth->check($name,session('id')) && !in_array($name,$noLogin)){
    //   $this->error('没有该栏目的操作权限！');
    // }
    //dump($this->config);die;
   }

   //输出配置项的数据
   public function getConf(){
    $confRes=array();
    $_confRes=db('conf')->field('ename,value')->select();
    foreach ($_confRes as $v) {
        $confRes[$v['ename']]=$v['value'];
    }
    $this->config=$confRes;
   }

   //语言版本
   public function weblanguage(){
    $webRes=db('conf')->where('ename','language')->find();
      $language = explode(',',$webRes['value']);
      return $language;
   }
}
