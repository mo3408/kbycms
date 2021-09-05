<?php
think\Route::rule('', 'index/index');
think\Route::rule('/', 'index/index');
think\Route::rule('page/:aid/[:page]','page/index','GET');
 think\Route::rule('/article/:aid/[:page]','article/index','GET');
return [
    '/cate/[:cid]/[:sid]'=>['cate/index',['method'=>'get'],'ext'=>'html',['cid'=>'\d+','sid'=>'\d+']],
];
