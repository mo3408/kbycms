<?php
namespace app\admin\controller;
use think\Controller;
class Login extends Controller
{

    public function login()
    {
        if(session('uname')&&session('id')){
            $this->redirect('Cate/catelist');
        }
        if(request()->isPost()){
            $data=input('post.');
            if(!captcha_check($data['code'])){
                //验证失败
                return json(['code'=>1,'msg'=>'验证码错误']);
            };

            $loginStatus=model('admin')->login($data);
            if($loginStatus==1){
                return json(['code'=>0,'msg'=>'登录成功！','url'=>url('cate/cateList')]);
            }elseif($loginStatus==4) {
                return json(['code'=>2,'msg'=>'当前账号已被禁用！']);
            }else{
                return json(['code'=>-1,'msg'=>'用户名或密码错误！']);
            }
            return;
        }
        $k=rand(1,5);
        $this->assign('k',$k);
        return view();
    }

    public function loginbg2()
    {
        return view();
    }
    public function loginbg1()
    {
        return view();
    }
    public function loginbg3()
    {
        return view();
    }
}
