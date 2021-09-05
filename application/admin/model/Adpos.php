<?php
namespace app\admin\model;
use think\Model;
class Adpos extends Model
{
    protected static function init()
    {
        //前置钩子删除广告位
        Adpos::beforeDelete(function($adpos) {
            $adposid=input('id');
            Ad::destroy(['adpos_id'=>$adposid]);
         });
     }

}


