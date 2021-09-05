(function($){
  var oNav = $('.scroll_nav');//导航壳
  var nav_li = oNav.find('li');//导航
  var aDiv = $('.floor');//楼层
  // var oTop = $('#goTop');
  var oNav_top = $('.scroll_nav_wrap').offset().top;
  var oNav_h = $('.scroll_nav_wrap').height();
  console.log(aDiv.length)
  //回到顶部
  $(window).scroll(function(){
    var winH = $(window).height();//可视窗口高度
    var iTop = $(window).scrollTop();//鼠标滚动的距离
    var bodyH = $('body').height(); 
     
    if(iTop >= oNav_top){
      $('.scroll_nav').css('position','fixed');
      // oNav.fadeIn();
      // oTop.fadeIn();
     //鼠标滑动式改变  
      setTimeout(function(){
      aDiv.each(function(index){
        // console.log('index',index,$(this).index())
        if(iTop == bodyH - winH){
          nav_li.removeClass('active');
          nav_li.eq(aDiv.length - 1).addClass('active');
        } 
        else if(iTop >= $(this).offset().top-oNav_h){
          nav_li.removeClass('active');
          nav_li.eq(index).addClass('active');
          // nav_li.eq($(this).index()).addClass('active');
        }
      })
      }, 20)
    }else{
      /*oNav.fadeOut();
      oTop.fadeOut();*/
      $('.scroll_nav').css('position','relative');
      
     }
  })
  //点击top回到顶部
  /*oTop.click(function(){
    $('body,html').animate({"scrollTop":0},500)
  })*/
  //点击回到当前楼层
  nav_li.click(function(){
    var t = aDiv.eq($(this).index()).offset().top-oNav_h + 10;
    console.log($(this).index())
    $('body,html').animate({"scrollTop":t},500);
    $(this).addClass('active').siblings().removeClass('active');
  });
})(jQuery)