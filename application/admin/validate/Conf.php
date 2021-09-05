<?php
namespace app\admin\validate;
use think\Validate;
    class Conf extends Validate
    {
        protected $rule=[
            'cname'=>'require|max:60|unique:conf',
            'ename'=>'require|max:60|unique:conf',
            'dt_type'=>'require|number',
            'cf_type'=>'require|number',
        ];

        protected $message=[
            'cname.require'=>'中文名称不能为空！',
            'cname.unique'=>'中文名称不能重复！',
            'ename.require'=>'英文名称不能为空！',
            'ename.unique'=>'英文名称不能重复！',
        ];

        protected $scene=[
            'add'=>['cname','ename','dt_type','cf_type'],
            //'edit'=>['cname','ename','dt_type','cf_type'],
        ];
    }






?>