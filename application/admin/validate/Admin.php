<?php
namespace app\admin\validate;
use think\Validate;
    class Admin extends Validate
    {
        protected $rule=[
            'uname' => 'require|unique:admin',
            'password' => 'require|min:6',
            'groupid'=>'require',
        ];

        protected $message=[
            'uname.require' => '用户名不能为空！',
            'groupid.require' => '所属用户组不能为空！',
            'uname.require' => '用户名不能重复！',
            'password.require' => '密码不能为空',
            'password.min' => '密码不能少于6位',
        ];

        protected $scene = [
            'add' => ['uname','password','groupid'],
            'edit' => ['uname','password'=>'min:6','groupid'],
        ];

    }






?>