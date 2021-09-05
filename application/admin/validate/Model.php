<?php
namespace app\admin\validate;
use think\Validate;
    class Model extends Validate
    {
        protected $rule=[
            'model_name'=>'require|unique:model',
            'table_name'=>'require|unique:model',
            'status'=>'require|number',
        ];

        protected $message=[
            'model_name.require'=>'模型名称不能为空！',
            'model_name.unique'=>'模型名称不能重复！',
            'table_name.require'=>'附加表名不能为空！',
            'table_name.number'=>'附加表名不能重复！',
            'status.require'=>'模型状态不能为空！',
            'status.number'=>'模型状态只能是数字！',
        ];

        protected $scene=[
            'add'=>['model_name','table_name','status'],
            'edit'=>['model_name','table_name','status'],
        ];
    }






?>