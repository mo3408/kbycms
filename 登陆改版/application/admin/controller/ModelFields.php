<?php
namespace app\admin\controller;
use think\Db;
class ModelFields extends Common
{
    //获取模型列表
    public function lst(){
        $prefix=config('database.prefix');
        $modelName=$prefix.'model';
        //根据模型查看字段
        $modelId=input('model_id')+0;
        if($modelId){
            $map['a.model_id'] = ['=',$modelId];
        }else{
            $map=1;
        }
        $fieldRes=db('model_fields')->field('a.*,b.model_name')->alias('a')->join( "$modelName b",'a.model_id=b.id')->where($map)->paginate(12);
        $this->assign([
            'fieldRes'=>$fieldRes,
            'model_id'=>$modelId,
            ]);
        return view();
    }
   
    //模型添加
    public function add(){
        $model_id = input('model_id')+0;
        if(request()->isPost()){
            $data=input('post.');
            $tableName=db('model')->field('table_name')->find($data['model_id']);
            $tableName=config("database.prefix").$tableName['table_name'];
             //过虑中文逗号
             if($data['field_values']){
                $data['field_values']=str_replace('，', ',', $data['field_values']);
             }
             //验证数据
             $validate=validate('model_fields');
            if(!$validate->scene('add')->check($data)){
                $this->error($validate->getError());
            }
            //添加
            $add=db('model_fields')->insertGetId($data);
            if($add){
                 //1、单行 2、单选 3、复选 4、下拉 5、文本域 6、附件 7、浮点 8、整型 9、长文本longtest 
                switch ($data['field_type']) {
                    case 1:
                    case 2:
                    case 3:
                    case 4:
                    case 6:
                        $fileType='varchar(150) not null default ""';
                        break;
                    case 5:
                        $fileType='varchar(600) not null default ""';
                        break;
                    case 7:
                        $fileType='float not null default "0.0"';
                        break;
                    case 8:
                        $fileType='int not null default "0"';
                        break;
                    case 9:
                        $fileType='longtext';
                        break;
                    default:
                        $fileType='varchar(150) not null default ""';
                        break;
                }
                $sql="alter table {$tableName} add {$data['field_ename']} {$fileType}";
                Db::execute($sql);
                model('OperationLog')->add('字段ID'.$add.'添加成功！');
                $this->success('添加字段成功！',url('lst'));
            }else{
                $tist->error('添加字段失败！');
            }
            return;
        }
        //调用模型
        $modelRes=db('model')->field('id,model_name')->select();
        $this->assign([
            'modelRes'=>$modelRes,
            'model_fields'=>$model_fields,
            ]);
        return view();
    }

    //编辑字段
    public function edit(){
        if(request()->isPost()){
            $data=input('post.');
            //获取前缀
            $prefix=config('database.prefix');
            $modelName=$prefix.'model';
            //连表查询所需要的表名及名称名称
            $fieldInfo=db('model_fields')->field('a.field_ename,b.table_name')->alias('a')->join("$modelName b",'a.model_id = b.id')->find($data['id']);
             //需要修改字段的表名
            $tableName=$prefix.$fieldInfo['table_name'];
            //需要修改的字段名称
            $oldFieldName=$fieldInfo['field_ename'];
             //过虑中文逗号
             if($data['field_values']){
                $data['field_values']=str_replace('，', ',', $data['field_values']);
             }
            //验证数据
             $validate=validate('model_fields');
            if(!$validate->scene('edit')->check($data)){
                $this->error($validate->getError());
            }
            //执行字段修改
            $save=db('model_fields')->update($data);
            if($save){
                //修改数据表字段
                 //1、单行 2、单选 3、复选 4、下拉 5、文本域 6、附件 7、浮点 8、整型 9、长文本longtest 
                switch ($data['field_type']) {
                    case 1:
                    case 2:
                    case 3:
                    case 4:
                    case 6:
                        $fileType='varchar(150) not null default ""';
                        break;
                    case 5:
                        $fileType='varchar(600) not null default ""';
                        break;
                    case 7:
                        $fileType='float not null default "0.0"';
                        break;
                    case 8:
                        $fileType='int not null default "0"';
                        break;
                    case 9:
                        $fileType='longtext';
                        break;
                    default:
                        $fileType='varchar(150) not null default ""';
                        break;
                    }
               
         //编辑表中的字段sql
            $sql="alter table {$tableName} change {$oldFieldName} {$data['field_ename']} {$fileType}";
            Db::execute($sql);
            model('OperationLog')->add('字段ID'.$data['id'].'更新成功！');
             $this->success('修改字段成功！',url('lst'));
            }else{
                $this->error('修改字段失败！');
            }
            return;
        }
        $modelFields=db('model_fields')->find(input('id'));
        $modelRes=db('model')->field('id,model_name')->select();
        //echo $modelFields['id'];die;
        $this->assign([
            'modelRes'=>$modelRes,
            'modelFields'=>$modelFields,
            ]);
        return view();
    }

//ajax删除字段
    public function ajaxdel(){
        if(request()->isAjax()){
            $modelFieldsId=input('id');
            //获取前缀
            $prefix=config('database.prefix');
            $modelName=$prefix.'model';
            //连表查询所需要的表名及名称名称
            $fieldInfo=db('model_fields')->field('a.field_ename,b.table_name')->alias('a')->join("$modelName b",'a.model_id = b.id')->find($modelFieldsId);
            //需要删除字段的表名
            $tableName=$prefix.$fieldInfo['table_name'];
            //需要删除的字段名称
            $fieldName=$fieldInfo['field_ename'];
            $del=db('model_fields')->delete($modelFieldsId);
            //删除表中的字段sql
            $sql="alter table {$tableName} drop column {$fieldName}";
            Db::execute($sql);
            if($del){
                model('OperationLog')->add('字段ID'.$modelFieldsId.'删除成功！');
                echo 1;//删除模型成功
            }else{
                echo 2;//删除模型失败
            }
        }

    }

}
