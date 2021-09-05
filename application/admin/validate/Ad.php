<?php
namespace app\admin\validate;
use think\Validate;
    class Ad extends Validate
    {
        protected $rule=[
            'adpos_id' => 'require|number',
            'ad_name' => 'require|unique:ad',
            'on' => 'require|number',
            'type' => 'require|number',
        ];

        protected $message=[
            'adpos_id.require' => '广告位不能为空！',
            'adpos_id.number' => '广告位必须是数字！',
            'ad_name.require' => '广告名称不能为空！',
            'ad_name.unique' => '广告名称不能重复！',
            'on.require' => '是否启用不能为空！',
            'on.number' => '是否启用只能是数字！',
            'type.require' => '广告类型不能为空！',
            'type.number' => '广告类型必须是数字！',
        ];

        protected $scene = [
            'add' => ['adpos_id','adpos_id','on','type'],
            'edit' => ['adpos_id','adpos_id','on','type'],
        ];

    }






?>