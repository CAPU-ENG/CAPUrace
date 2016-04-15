<div class="pgright">

<div class="content">
	<h3 class="text-center">赛场与赛道</h3>
	<hr><br>

    以下是2015年全国高校山地车交流赛赛道，14届赛道请等待更新  : )<br><br>

	<h4>一、   赛场具体地点：</h4><br>
	<img src="<?=base_url()?>/assets/images/map.png" class="center-block" width="660px"></img>
    <br/><br/>
    <!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
    <html xmlns="http://www.w3.org/1999/xhtml">
    <head>
    <meta http-equiv="Content-Type" content="text/html; charset=gb2312" />
    <meta name="keywords" content="百度地图,百度地图API，百度地图自定义工具，百度地图所见即所得工具" />
    <meta name="description" content="百度地图API自定义地图，帮助用户在可视化操作下生成百度地图" />
    <title>百度地图API自定义地图</title>
    <!--引用百度地图API-->
    <style type="text/css">
    html,body{margin:0;padding:0;}
    .iw_poi_title {color:#CC5522;font-size:14px;font-weight:bold;overflow:hidden;padding-right:13px;white-space:nowrap}
        .iw_poi_content {font:12px arial,sans-serif;overflow:visible;padding-top:4px;white-space:-moz-pre-wrap;word-wrap:break-word}
        </style>
        <script type="text/javascript" src="http://api.map.baidu.com/api?key=&v=1.1&services=true"></script>
        </head>
        
        <body>
        <!--百度地图容器-->
        <div style="width:660px;height:550px;border:#ccc solid 1px;" id="dituContent"></div>
        </body>
        <script type="text/javascript">
        //创建和初始化地图函数：
        function initMap(){
            createMap();//创建地图
            setMapEvent();//设置地图事件
            addMapControl();//向地图添加控件
            addMarker();//向地图中添加marker
        }
        
        //创建地图函数：
        function createMap(){
            var map = new BMap.Map("dituContent");//在百度地图容器中创建一个地图
            var point = new BMap.Point(116.315271,39.484403);//定义一个中心点坐标
            map.centerAndZoom(point,13);//设定地图的中心点和坐标并将地图显示在地图容器中
            window.map = map;//将map变量存储在全局
        }
        
        //地图事件设置函数：
        function setMapEvent(){
            map.enableDragging();//启用地图拖拽事件，默认启用(可不写)
            map.enableScrollWheelZoom();//启用地图滚轮放大缩小
            map.enableDoubleClickZoom();//启用鼠标双击放大，默认启用(可不写)
            map.enableKeyboard();//启用键盘上下左右键移动地图
        }
        
        //地图控件添加函数：
        function addMapControl(){
            //向地图中添加缩放控件
            var ctrl_nav = new BMap.NavigationControl({anchor:BMAP_ANCHOR_TOP_LEFT,type:BMAP_NAVIGATION_CONTROL_LARGE});
            map.addControl(ctrl_nav);
            //向地图中添加缩略图控件
            var ctrl_ove = new BMap.OverviewMapControl({anchor:BMAP_ANCHOR_BOTTOM_RIGHT,isOpen:1});
            map.addControl(ctrl_ove);
            //向地图中添加比例尺控件
            var ctrl_sca = new BMap.ScaleControl({anchor:BMAP_ANCHOR_BOTTOM_LEFT});
            map.addControl(ctrl_sca);
        }
        
        //标注点数组
        var markerArr = [{title:"比赛场地",content:"晚会场地&nbsp;露营场地",point:"116.313924|39.48283",isOpen:0,icon:{w:23,h:25,l:46,t:21,x:9,lb:12}}
        ,{title:"大广高速固安出口",content:"无",point:"116.286939|39.47041",isOpen:0,icon:{w:21,h:21,l:46,t:0,x:6,lb:5}}
        ,{title:"106国道北京方向",content:"无",point:"116.331351|39.504379",isOpen:0,icon:{w:21,h:21,l:46,t:0,x:6,lb:5}}
        ,{title:"廊涿高速固安出口",content:"无",point:"116.32244|39.397626",isOpen:0,icon:{w:21,h:21,l:46,t:0,x:6,lb:5}}
        ,{title:"固安县政府",content:"无",point:"116.304905|39.445005",isOpen:0,icon:{w:21,h:21,l:46,t:0,x:6,lb:5}}
        ,{title:"固安汽车站",content:"无",point:"116.316556|39.445827",isOpen:0,icon:{w:21,h:21,l:46,t:0,x:6,lb:5}}
        ];
        //创建marker
        function addMarker(){
            for(var i=0;i<markerArr.length;i++){
                var json = markerArr[i];
                var p0 = json.point.split("|")[0];
                var p1 = json.point.split("|")[1];
                var point = new BMap.Point(p0,p1);
                var iconImg = createIcon(json.icon);
                var marker = new BMap.Marker(point,{icon:iconImg});
                var iw = createInfoWindow(i);
                var label = new BMap.Label(json.title,{"offset":new BMap.Size(json.icon.lb-json.icon.x+10,-20)});
                marker.setLabel(label);
                map.addOverlay(marker);
                label.setStyle({
                               borderColor:"#808080",
                               color:"#333",
                               cursor:"pointer"
                               });
                
                (function(){
                 var index = i;
                 var _iw = createInfoWindow(i);
                 var _marker = marker;
                 _marker.addEventListener("click",function(){
                                          this.openInfoWindow(_iw);
                                          });
                 _iw.addEventListener("open",function(){
                                      _marker.getLabel().hide();
                                      })
                 _iw.addEventListener("close",function(){
                                      _marker.getLabel().show();
                                      })
                 label.addEventListener("click",function(){
                                        _marker.openInfoWindow(_iw);
                                        })
                 if(!!json.isOpen){
                 label.hide();
                 _marker.openInfoWindow(_iw);
                 }
                 })()
            }
        }
        //创建InfoWindow
        function createInfoWindow(i){
            var json = markerArr[i];
            var iw = new BMap.InfoWindow("<b class='iw_poi_title' title='" + json.title + "'>" + json.title + "</b><div class='iw_poi_content'>"+json.content+"</div>");
            return iw;
        }
        //创建一个Icon
        function createIcon(json){
            var icon = new BMap.Icon("http://app.baidu.com/map/images/us_mk_icon.png", new BMap.Size(json.w,json.h),{imageOffset: new BMap.Size(-json.l,-json.t),infoWindowOffset:new BMap.Size(json.lb+5,1),offset:new BMap.Size(json.x,json.h)})
            return icon;
        }
        
        initMap();//创建和初始化地图
        </script>
        </html>
	<br><br>
	<h4>二、   赛道示意图：</h4><br>
	<img src="<?=base_url()?>/assets/images/racemap.jpg" class="center-block" width="660px"></img>
	<div style="padding: 10px">
		<strong><span class="red">重要提示：</span></strong><br>
		1. 本届比赛，各组所用赛道完全一致，长度相同（3.5km/圈）难度相同。不同组别圈数不同，总里程不同。<br>
		2. 由于时间原因，本届比赛不设试赛道时间。北大车协为您提供赛道骑行实况视频，请参看本报名网站<br>
	</div><br>
	<h4>三、   会场示意图：</h4><br>
	<img src="<?=base_url()?>/assets/images/raceinfo.png" class="center-block" width="660px"></img>

</div>
</div>
</div>