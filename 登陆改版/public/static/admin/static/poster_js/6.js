$("head").append('<link rel="stylesheet" type="text/css" href="/static/css/jquery.slide-packer.css">');$("body").append('<script type="text/javascript" src="/static/js/plugins/jquery.slide-packer.js"></script>');document.write('<div class="slider slider-6"><div class="switchable-box poster"><ul class="switchable-content"></li></ul><div class="ui-arrow"><a class="ui-prev"></a><a class="ui-next"></a></div></div></div>');$(function(){
        $('body').find('.slider-6').slide({
			effect: 'fade', // random/normal/scroll/fade/fold/slice/slide/shutter/grow
			speed: 'slow',
			navCls: 'switchable-nav',
			contentCls: 'switchable-content',
			caption: false,
			prevBtnCls:'ui-prev',
            nextBtnCls:'ui-next',
			evtype: 'click'
		});
        });