<?php
namespace app\admin\controller;
use QL\QueryList;
class Caiji extends Common
{
    //获取栏目
    public function index(){
        $rules=[
            "title"=>array('.unit>h1','text'),
            "url"=>array('.unit>h1>a','href'),
            "time"=>array('.unit>h4>span.ago','text'),
        ];
        $hj = QueryList::Query('http://mobile.csdn.net/',$rules);
        // $data = $hj->getData(function($x){
        //     return $x['url'];
        // });
          print_r($hj->data);
    }

}
