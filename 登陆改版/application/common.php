<?php
// +----------------------------------------------------------------------
// | ThinkPHP [ WE CAN DO IT JUST THINK ]
// +----------------------------------------------------------------------
// | Copyright (c) 2006-2016 http://thinkphp.cn All rights reserved.
// +----------------------------------------------------------------------
// | Licensed ( http://www.apache.org/licenses/LICENSE-2.0 )
// +----------------------------------------------------------------------
// | Author: 流年 <liu21st@gmail.com>
// +----------------------------------------------------------------------
// 
// 
// 
// 
// 
// 
// 


function imgs($img){
	return $img=str_replace('\\','/',$img);
}
function get_client_ip($type = 0) {
    $type       =  $type ? 1 : 0;
    static $ip  =   NULL;
    if ($ip !== NULL) return $ip[$type];
    if (isset($_SERVER['HTTP_X_FORWARDED_FOR'])) {
        $arr    =   explode(',', $_SERVER['HTTP_X_FORWARDED_FOR']);
        $pos    =   array_search('unknown',$arr);
        if(false !== $pos) unset($arr[$pos]);
        $ip     =   trim($arr[0]);
    }elseif (isset($_SERVER['HTTP_CLIENT_IP'])) {
        $ip     =   $_SERVER['HTTP_CLIENT_IP'];
    }elseif (isset($_SERVER['REMOTE_ADDR'])) {
        $ip     =   $_SERVER['REMOTE_ADDR'];
    }

    
    // IP地址合法验证
    $long = sprintf("%u",ip2long($ip));
    

    $ip   = $long ? array($ip, $long) : array('0.0.0.0', 0);
    return $ip[$type];
} 

function clear_html($str){


$content_02=htmlspecialchars_decode($str);
$content_03=str_replace("&nbsp;","",$content_02);
		                
$str=strip_tags($content_03);
return $str;

}



function utf8_strlen($string = null) {
// 将字符串分解为单元
preg_match_all("/./us", $string, $match);
// 返回单元个数
return count($match[0]);
}

function get_videos($str){



	$tuu=[];

   preg_match_all('/<p>([\S\s]+?)<\/p>/',$str,$mattword);


   $wordd=[];

   foreach ($mattword[1] as $k => $v) {

   	     $content_02=htmlspecialchars_decode($v);
		 $content_03=str_replace("&nbsp;","",$content_02);
		
                
   	     $wordd[]=strip_tags($content_03);
   }


  



  $wordd=array_filter($wordd);

 $wordd=array_values($wordd);


 

  
   preg_match_all('/<(video|embed) ([\S\s]+?)>/',$str,$matt);


   


   foreach ($matt[2] as $k => $v) {

           preg_match_all('/src="([\S\s]+?)"/',$v,$mattt); 

           $tu['url']=$mattt[1][0];


           if(isset($wordd[$k])){

              $tu['title']=$wordd[$k];


           }else{

           	$kk=$k+1;

            $tu['title']='视频'.$kk;

           }


         


           $tuu[]=$tu;


           $tu=[];
           
   }


         
  


   


  return $tuu;






}




function get_video($str){


  
   preg_match_all('/<(video|embed) ([\S\s]+?)>/',$str,$matt);


         
   preg_match_all('/src="([\S\s]+?)"/',$matt[2][0],$mattt);


   


  return $mattt[1][0];






}


function getimg($str){
  

$content=[];
          
preg_match_all('/<img [\S\s]+?\/>/', $str, $matches);



foreach ($matches[0] as $k => $v) {
           
 preg_match_all('/src="([\S\s]+?)"/',$v,$matt);

 preg_match_all('/title="([\S\s]+?)"/',$v,$matitle);
  $content[$k]['img']=$matt[1][0];

  $content[$k]['msg']=$matitle[1][0];

  
}


return $content;

}



function get_ueditor($name,$value=''){


$str=<<<HTML


<textarea name='$name' id='$name' >$value</textarea>


<script type="text/javascript">

var editor_a = new baidu.editor.ui.Editor({initialFrameHeight:400,initialFrameWidth:1000});


 editor_a.render('$name');


</script>

HTML;
return $str;


}

//字符串截取

function cut_str($sourcestr,$cutlength)

{
   $returnstr='';
   $i=0;
   $n=0;
 $str_length=strlen($sourcestr);//字符串的字节数
 while (($n<$cutlength) and ($i<=$str_length))
 {
    $temp_str=substr($sourcestr,$i,1);
$ascnum=Ord($temp_str);//得到字符串中第$i位字符的ascii码
if ($ascnum>=224)//如果ASCII位高与224，
{
$returnstr=$returnstr.substr($sourcestr,$i,3); //根据UTF-8编码规范，将3个连续的字符计为单个字符
 $i=$i+3;//实际Byte计为3
 $n++;//字串长度计1
}
elseif ($ascnum>=192) //如果ASCII位高与192，
{
 $returnstr=$returnstr.substr($sourcestr,$i,2); //根据UTF-8编码规范，将2个连续的字符计为单个字符
 $i=$i+2;//实际Byte计为2
 $n++;//字串长度计1
}
elseif ($ascnum>=65 && $ascnum<=90) //如果是大写字母，
{
   $returnstr=$returnstr.substr($sourcestr,$i,1);
 $i=$i+1;//实际的Byte数仍计1个
 $n++;//但考虑整体美观，大写字母计成一个高位字符
}
else//其他情况下，包括小写字母和半角标点符号，
{
   $returnstr=$returnstr.substr($sourcestr,$i,1);
 $i=$i+1;//实际的Byte数计1个
 $n=$n+0.5;//小写字母和半角标点等与半个高位字符宽...
}
}
if ($str_length>$i){
$returnstr = $returnstr . "...";//超过长度时在尾处加上省略号
}
return $returnstr;

} 

function get_sub_str($str,$len,$is=false){
	$str = strip_tags($str);
	$str = mb_substr($str,0,$len,'utf-8');
	if($is){
		$str.='...';
	}
	return $str;
}
//	将文本域中的回车换成br标签
function get_br($str){
	return str_replace("\n",'<br>',$str);
}

//	将编辑器上传的图片正则匹配出来
function get_img($content)
{
	// 图
	preg_match_all('/<img.*?src="(.*?)".*?>/is',$content,$imgs);
	// 标题
	/**
	preg_match_all('/<img.*?title="(.*?)".*?>/is',$content,$titles);
	*/
	return $imgs[1];
}


function get_img_list($content,$p=false)
{
	$res = array();
	// 图
	preg_match_all('/<img.*?src="(.*?)".*?>/is',$content,$imgs);
	$imgs[1];
	foreach ($imgs[1] as $key => $value) {
		$path = ROOT_PATH.substr($value,strrpos($value,'ueditor'));
		$arr = getimagesize($path);
		//	图片的宽大于高  是横着的图
		if($arr[0]>=$arr[1]){
			$res[0][] = $value;
		}else{
			$res[1][] = $value;
		}
	}
	if($p){
		return $res[0];
	}else{
		return $res[1];
	}
	
}

function file_size($path){
	return round(filesize($path)/1024,2);

}

function get_replace($str)
{
	return str_replace("\\","/",$str);
}

// 数据过滤
function filter($str){
	if(!is_array($str)){
		$str = strip_tags(trim($str));
		$str = str_replace("SCRIPT", "", $str);
		$str = str_replace("/SCRIPT", "", $str);
		$str = str_replace("script", "", $str);
		$str = str_replace("/script", "", $str);
		$str=str_replace("select","",$str);
		$str=str_replace("SELECT","",$str);
		$str=str_replace("join","",$str);
		$str=str_replace("JOIN","",$str);
		$str=str_replace("union","",$str);
		$str=str_replace("UNION","",$str);
		$str=str_replace("where","",$str);
		$str=str_replace("WHERE","",$str);
		$str=str_replace("insert","",$str);
		$str=str_replace("INSERT","",$str);
		$str=str_replace("delete","",$str);
		$str=str_replace("DELETE","",$str);
		$str=str_replace("update","",$str);
		$str=str_replace("UPDATE","",$str);
		$str=str_replace("like","",$str);
		$str=str_replace("LIKE","",$str);
		$str=str_replace("drop","",$str);
		$str=str_replace("DROP","",$str);
		$str=str_replace("create","",$str);
		$str=str_replace("CREATE","",$str);
		$str=str_replace("modify","",$str);
		$str=str_replace("MODIFY","",$str);
		return $str;
	}

	foreach ($str as $key => &$value) {
		$value = strip_tags($value);
		$value = str_replace("SCRIPT", "", $value);
		$value = str_replace("/SCRIPT", "", $value);
		$value = str_replace("script", "", $value);
		$value = str_replace("/script", "", $value);
		$value=str_replace("select","",$value);
		$value=str_replace("SELECT","",$value);
		$value=str_replace("join","",$value);
		$value=str_replace("JOIN","",$value);
		$value=str_replace("union","",$value);
		$value=str_replace("UNION","",$value);
		$value=str_replace("where","",$value);
		$value=str_replace("WHERE","",$value);
		$value=str_replace("insert","",$value);
		$value=str_replace("INSERT","",$value);
		$value=str_replace("delete","",$value);
		$value=str_replace("DELETE","",$value);
		$value=str_replace("update","",$value);
		$value=str_replace("UPDATE","",$value);
		$value=str_replace("like","",$value);
		$value=str_replace("LIKE","",$value);
		$value=str_replace("drop","",$value);
		$value=str_replace("DROP","",$value);
		$value=str_replace("create","",$value);
		$value=str_replace("CREATE","",$value);
		$value=str_replace("modify","",$value);
		$value=str_replace("MODIFY","",$value);
	}
	return $str;
}
