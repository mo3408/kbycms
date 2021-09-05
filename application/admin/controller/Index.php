<?php
namespace app\admin\controller;
use think\Cache;
class Index extends Common
{
    public function index()
    {
        $sysinfo=array();
        $sysinfo = array(
            'os' => $_SERVER["SERVER_SOFTWARE"], //获取服务器标识的字串
            'version' => PHP_VERSION, //获取PHP服务器版本
            'time' => date("Y-m-d H:i:s", time()), //获取服务器时间
            'pc' => $_SERVER['SERVER_NAME'], //当前主机名
            'osname' => php_uname(), //获取系统类型及版本号
            'language' => $_SERVER['HTTP_ACCEPT_LANGUAGE'], //获取服务器语言
            'port' => $_SERVER['SERVER_PORT'], //获取服务器Web端口
            'max_upload' => ini_get("file_uploads") ? ini_get("upload_max_filesize") : "Disabled", //最大上传
            'max_ex_time' => ini_get("max_execution_time")."秒", //脚本最大执行时间
            'sys_mail'   => ini_get('sendmail_path') ? 'Unix Sendmail ( Path: '.ini_get('sendmail_path').')' :( ini_get('SMTP') ? 'SMTP ( Server: '.ini_get('SMTP').')': 'Disabled' ),
            'mysql_version' => $this->_mysql_version(),//mysql版本
            'ifcookie'   => isset($_COOKIE) ? "SUCCESS" : "FAIL",
        );
        $this->assign('sysinfo',$sysinfo);
        return view();
    }
    private function _mysql_version()
    {
        $version = db('conf')->query("select version() as ver");
        return $version[0]['ver'];
    }
    

    //清空缓存
    public function clearCache(){
        Cache::clear();
        if(cache(NUll)){
            $this->success('缓存清除成功！');
        }else{
            $this->error('缓存清除失败！');
        }
    }
}
