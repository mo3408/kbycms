$("head").append('<link rel="stylesheet" type="text/css" href="/static/css/swiper.min.css">');$("body").append('<script type="text/javascript" src="/static/js/plugins/swiper.min.js"></script>');document.write('<div class="swiper-container poster"><div class="swiper-wrapper"></div><div class="swiper-pagination"></div></div>');$(function(){var mySwiper = new Swiper('.swiper-container', {
        spaceBetween: 30,
        effect: 'slide',
        centeredSlides: true,
        autoplay: {
            delay: 3500,
            disableOnInteraction: false
        },
        pagination: {
            el: '.swiper-pagination',
            clickable: true
        },
        loop : true,
        initialSlide :0
    });
    $('.swiper-container').hover(function(){
    mySwiper.autoplay.stop();
    },function(){
    mySwiper.autoplay.start();
    });
    });