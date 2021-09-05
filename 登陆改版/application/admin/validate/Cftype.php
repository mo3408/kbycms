<?php
namespace app\admin\validate;
use think\Validate;
    class Cftype extends Validate
    {
        protected $rule=[
            'cf_type'=>'require|max:60|unique:conf',
        ];

        protected $message=[
            'cf_type.require'=>'类型名称不能为空！',
            'cf_type.unique'=>'类型名称不能重复！',
        ];

        protected $scene=[
            'add'=>['cf_type',],
            'edit'=>['cf_type',],
        ];
    }






?>