/**
 * Created by junyv on 2017/3/29.
 */
var delta=0.08;
var collection;
function floaters() {
    this.items	= [];
    this.addItem	= function(id,x,y,w,h,pos,content)
    {
        document.write('<DIV id='+id+' style="Z-INDEX: 10; POSITION: fixed;  width:'+w+'px; height:'+h+'px;'+pos+':'+x+'px;top:'+y+'px;"><div style="background:#ccc;color:#000;font-size:12px;text-align:center;cursor:pointer;padding:5px 0;width:'+w+'px;" onclick="closeads(\''+id+'\');">关闭广告</div>'+content+'</DIV>');

        var newItem				= {};
        newItem.object			= document.getElementById(id);
        newItem.x				= x;
        newItem.y				= y;

        this.items[this.items.length]		= newItem;
    };
    this.play	= function()
    {
        collection				= this.items;
        //playstr = setInterval(play,10);
    };
}
function play()
{

    for(var i=0;i<collection.length;i++)
    {
        var followObj		= collection[i].object;
        var followObj_y		= collection[i].y;
        if(followObj.offsetTop!=(document.body.scrollTop+followObj_y)) {
            var dy=(document.body.scrollTop+followObj_y-followObj.offsetTop)*delta;
            dy=(dy>0?1:-1)*Math.ceil(Math.abs(dy));
            followObj.style.top=followObj.offsetTop+dy;
        }
        followObj.style.display	= '';
    }
}
function closeads(id){
    clearInterval(playstr);
    document.getElementById('followDiv1').style.display = 'none';
    document.getElementById('followDiv2').style.display = 'none';
}
var theFloaters = new floaters();
theFloaters.play();
