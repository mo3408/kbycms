<?php
namespace app\admin\controller;
use QL\QueryList;
class Note extends Common
{
    //显示节点列表
    public function noteList(){
        //获取前缀
        $prefix=config('database.prefix');
        $modelName=$prefix.'model';
        $noteRes=db('note')->field('n.id,n.note_name,n.model_id,n.output_encoding,n.input_encoding,n.addtime,n.lasttime,m.model_name')->alias('n')->join("$modelName m",'n.model_id=m.id')->paginate(12);
        $this->assign([
            'noteRes'=>$noteRes,
            ]);
        return view();
    }
    //获取栏目
    public function addListRules(){
        if(request()->isPost()){
            $_data=input('post.');
            $data['note_name']=$_data['note_name'];
            $data['model_id']=$_data['model_id'];
            $data['output_encoding']=$_data['output_encoding'];
            $data['input_encoding']=$_data['input_encoding'];
            $data['list_rules']=array(
                'list_url'=>$_data['list_url'],
                'start_page'=>$_data['start_page'],
                'end_page'=>$_data['end_page'],
                'step'=>$_data['step'],
                'range'=>$_data['range'],
                'list_rules'=>array(
                    'url'=>$_data['url'],
                    'litpic'=>$_data['litpic'],
                    ),
                );
            //列表页面采集规则
            $data['list_rules']=json_encode($data['list_rules']);
            $data['addtime'] = time();
            //dump($data);die;
            $id=db('note')->insertGetId($data);//添加数据返回ID主键
            //$add=db('note')->insert($data);
            if($id){
                model('OperationLog')->add('数据采集添加ID'.$id.'栏目节点成功！');
                $this->redirect('additemrules',['model_id'=>$_data['model_id'],'note_id'=>$id]);
            }else{
                $this->error('添加节点失败！');
            }
        }
        $modelRes=db('model')->select();
        $this->assign([
            'modelRes'=>$modelRes,
            ]);
        return view();
    }
 //获取内容
    public function additemrules(){
        $noteId=input('note_id');
        if(request()->isPost()){
            $data=input('post.');
            $rules=array();
            if($data){
                foreach ($data as $k => $v) {
                        $rules[$k][0]=$v[0];
                        $rules[$k][1]=$v[1];
                        $rules[$k][2]=$v[2];
                       array_values($rules[$k]);//多写了一步
                }
            }
            $rules=json_encode($rules);
            $save=db('note')->where(array('id'=>$noteId))->update(['item_rules'=>$rules]);
            if($save){
                model('OperationLog')->add('数据采集添加ID'.$noteId.'内容节点成功！');
                $this->success('添加节点成功！','noteList');
            }else{
                $this->error('添加节点失败！');
            }
            return;
        }
        //自定义模型字段
        $modelId=input('model_id');
        $modelFieldRes=db('model_fields')->field('field_cname,field_ename')->where(array('model_id'=>$modelId))->select();
        $this->assign([
            'modelFieldRes'=>$modelFieldRes,
            ]);
        return view();
    }
    
    //展示采集界面
    public function showCaiji($id){
        //获取栏目
        $_cateRes=db('cate')->select();
        $cateRes=model('cate')->catetree($_cateRes);
        $notes=db('note')->field('model_id,note_name')->find($id);
        $modelId=$notes['model_id'];
        $noteName=$notes['note_name'];
        $this->assign([
            'id'=>$id,
            'cateRes'=>$cateRes,
            'modelId'=>$modelId,
            'note_name'=>$noteName,
            ]);
        return view();
    }



    //执行信息采集
    public function doCaiji($id){
        $notes=db('note')->find($id);
        //采集参数
        $outputEncoding=$notes['output_encoding'];//输出编码
        $inputEncoding=$notes['input_encoding'];//输入编码
        $listRules=$notes['list_rules'];//列表采集配置
        $listRules=json_decode($listRules,true);//json转换数组
        $itemRules=$notes['item_rules'];  //内容页采集规则
        $itemRules=json_decode($itemRules,true); //json转换数组
        $listUrl=$listRules['list_url'];//采集列表网址
        $startPage=$listRules['start_page'];//采集开始页数
        $endPage=$listRules['end_page'];//采集结束页数
        $step=$listRules['step'];//采集步长
        $range=$listRules['range'];//采集范围
        $listcaijiRules=$listRules['list_rules'];//采集规则
        //动态读取采集规则
        $listcaijiRules=array(
            'url'=>array($listcaijiRules['url'],'href'),
            'litpic'=>array($listcaijiRules['litpic'],'src'),
            );
        $_listUrl=[];//转换为实际页码的列表网址
        //处理采集列表网址网址
        for($i=$startPage; $i <= $endPage; $i=$i+$step){
            $_listUrl[]=str_replace('(*)',$i,$listUrl);
        }

        //循环采集数据
        $_data=[];
        foreach ($_listUrl as $k => $url) {
           $_data[] = QueryList::Query($url,$listcaijiRules,$range,$outputEncoding,$inputEncoding)->data;
        }
        //dump($_data);die;
        //数组重构
        $dataList=[];
        foreach ($_data as $k => $v) {
            foreach ($v as $k1 => $v1) {
                $dataList[]=$v1;
            }
        }
        //dump($dataList);die;
        //内容页采集数据采集
        $_dataItem=[];
        foreach ($dataList as $k => $v) {
           $_dataItem[] = QueryList::Query($v['url'],$itemRules,'',$outputEncoding,$inputEncoding)->data;
           $_dataItem[$k][0]['url']=$v['url'];//手动添加url到数据库，写入采集表中
           $_dataItem[$k][0]['litpic']=$v['litpic'];//手动添加采集的缩略图到数据库，写入采集表中
        }
         //dump($_dataItem);die;
        //数组重构
        $dataItem=[];
        foreach ($_dataItem as $k => $v) {
            foreach ($v as $k1 => $v1) {
                $dataItem[]=$v1;
            }
        }
        //将数据写出采集表
        foreach ($dataItem as $k => $v) {
            $data['nid']=$id;
            $data['url']=$v['url'];
            //防止查重
        $reData=db('html')->where(array('url'=>$data['url']))->find();
        if($reData){
            continue;
        }
            $data['url']=$v['url'];
            $data['addtime']=time();
            $data['result']=json_encode($v);
            db('html')->insert($data);
        }
        //节点最后采集时间
        db('note')->where(array('id'=>$id))->update(['lasttime'=>time()]);
        echo 1;//采集完成
    }

    //导出数据
    public function exportdata(){
        $noteId=input('id');//当前节点ID
        $cateId=input('cate_id');//要导出数据所属栏目
        $cate=db('cate')->field('model_id')->find($cateId);
        $modelId=$cate['model_id'];
        $model=db('model')->field('table_name')->find($modelId);
        $tableName=$model['table_name'];
        $data=db('html')->field('id,export,result')->where(array('export'=>0,'nid'=>$noteId))->select();//要导出的数据
        //dump($data);die;
        $arr=array('title','keywords','description','writer','conten','litpic','url');
        $_archives=[];//主表元素数据
        $_addTable=[];//附加表元素数据
        $i=0;
        foreach ($data as $k => $v) {
            $_data=json_decode($v['result'],true);
            foreach ($_data as $k1 => $v1) {
                if(in_array($k1, $arr)){
                    $_archives[$k1]=$v1;
                    if($k1=='url'){
                        unset($_archives[$k1]);
                    }
                }else{
                    $_addTable[$k1]=$v1;
                }
            }
            $_archives['cate_id']=$cateId;
            $_archives['model_id']=$modelId;
            $addId=db('archives')->insertGetId($_archives);
            $_addTable['aid']=$addId;
            db($tableName)->insert($_addTable);
            db('html')->where(array('id'=>$v['id']))->update(['export'=>1]);
            //批量导出
            $i++;
            if(($i%6)==0){
                sleep(2);
            }
        }
        echo 1;//数据导出完成
    }


    //编辑节点信息
    public function edit($id){
        if(request()->isPost()){
            $data=input('post.');
            $base['id']=$data['id'];
            $base['note_name']=$data['note_name'];
            $base['model_id']=$data['model_id'];
            $base['output_encoding']=$data['output_encoding'];
            $base['input_encoding']=$data['input_encoding'];
            $base['list_rules']['list_url']=$data['list_url'];
            $base['list_rules']['start_page']=$data['start_page'];
            $base['list_rules']['end_page']=$data['end_page'];
            $base['list_rules']['step']=$data['step'];
            $base['list_rules']['range']=$data['range'];
            $base['list_rules']['list_rules']['url']=$data['url'];
            $base['list_rules']['list_rules']['litpic']=$data['litpic'];
            $base['list_rules']=json_encode($base['list_rules']);
            $arr=array('note_name','model_id','output_encoding','input_encoding','list_rules','start_page','end_page','step','range','url','litpic');
            foreach ($data as $k => $v) {
                if(in_array($k, $arr)){
                    unset($data[$k]);
                }
            }
            $base['item_rules']=json_encode($data);
            $save=db('note')->update($base);
            if($save){
                model('OperationLog')->add('数据采集添加ID'.$base['id'].'修改节点成功！');
                $this->success('修改节点成功！','noteList');
            }else{
                $this->error('修改节点失败！');
            }
            return;
        }
        //通过节点ID获取节点模型ID
        $notes=db('note')->find($id);
        $listRules=json_decode($notes['list_rules'],true);
        $itemRules=json_decode($notes['item_rules'],true);
        $modelId=$notes['model_id'];
        //根据模型ID获取模型名称
        $models=db('model')->field('model_name')->find($modelId);
        $modelsName=$models['model_name'];
        $modelRes=db('model')->select();
        //自定义模型字段
        $modelFieldRes=db('model_fields')->field('field_cname,field_ename')->where(array('model_id'=>$modelId))->select();
        $this->assign([
            'modelRes'=>$modelRes,
            'modelFieldRes'=>$modelFieldRes,
            'notes'=>$notes,
            'modelId'=>$modelId,
            'modelsName'=>$modelsName,
            'listRules'=>$listRules,
            'itemRules'=>$itemRules,
            'id'=>$id,
            ]);
        return view();
    }

    //删除节点
    public function del($id){
        $del=db('note')->delete($id);
        if($del){
            db('html')->where(array('nid'=>$id))->delete();
            model('OperationLog')->add('数据采集添加ID'.$id.'删除节点成功！');
            $this->success('删除节点成功！','noteList');
        }else{
            $this->error('删除节点失败！');
        }
    }



}
