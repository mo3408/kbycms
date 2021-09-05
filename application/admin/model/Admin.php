<?php
namespace app\admin\model;
use think\Model;
class Admin extends Model
{
    public function login($data){
        $uname=$data['uname'];
        $password=md5($data['password']);
        $admins=Admin::get(['uname'=>$uname]);
        if($admins){
            $_password=$admins['password'];
            if($_password==$password){
                if($admins['status']==0){
                    return 4;//账号已被禁用
                }
                $admins->last_time = time();
                $admins->save();
                session('uname',$uname);
                session('id',$admins['id']);
                session('groupid',$admins['groupid']);
                model('OperationLog')->add('登录成功！');
                return 1;//密码正确可以登录
            }else{
                return 2;//密码错误
            }
        }else{

        }
    }
}


