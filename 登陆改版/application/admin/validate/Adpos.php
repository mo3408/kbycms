<?php
namespace app\admin\validate;
use think\Validate;
    class Adpos extends Validate
    {
        protected $rule=[
            'name' => 'require|max:60|unique:adpos',
            'height' => 'require|number',
            'width' => 'require|number',
        ];

        protected $message=[
            'name.require' => '广告位名称不能为空！',
            'name.unique' => '广告位名称不能重复！',
            'height.require' => '广告位高度不能为空！',
            'height.number' => '广告位高度必须是数字！',
            'width.require' => '广告位宽度不能为空！',
            'width.number' => '广告位宽度必须是数字！',
        ];

    }






?>