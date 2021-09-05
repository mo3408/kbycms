(function($){
  //大图切换
  $(".l_slide").slide({ 
    titCell:".smallImg li", 
    mainCell:".bigImg", 
    effect:"fold", 
    autoPlay:false,
    delayTime:200,
    startFun:function(i,p){
      //控制小图自动翻页
      if(i==0){ 
        $(".l_slide .sPrev").click() 
      } else if( i%4==0 ){ 
        $(".l_slide .sNext").click()
      }
    }
  });

  //小图左滚动切换
  $(".l_slide .smallScroll").slide({ 
    mainCell:"ul",
    delayTime:100,
    vis:4,
    scroll:4,
    effect:"left",
    autoPage:true,
    prevCell:".sPrev",
    nextCell:".sNext",
    pnLoop:false 
  });
})(jQuery)