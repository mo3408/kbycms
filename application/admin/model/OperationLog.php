<?php
namespace app\admin\model;
use think\Model;
class OperationLog extends Model
{
    public function add($action){
        $Opera=new OperationLog;
        $Opera->user = session('uname');
        $Opera->group = session('groupid');
        $Opera->action = $action;
        $Opera->logip = $_SERVER["REMOTE_ADDR"];
        $Opera->logtime = time();
        $Opera->save();
    }
}


