<!DOCTYPE HTML>
<html  class="x-admin-sm">
<head>
  <meta charset="UTF-8">
  <title>后台登录</title>
  <meta name="renderer" content="webkit|ie-comp|ie-stand">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
    <meta name="viewport" content="width=device-width,user-scalable=yes, minimum-scale=0.4, initial-scale=0.8,target-densitydpi=low-dpi" />
    <meta http-equiv="Cache-Control" content="no-siteapp" />
  
    <link rel="stylesheet" href="{{ asset('admin/css/font.css') }}">
    <link rel="stylesheet" href="{{ asset('admin/css/login.css') }}">
    <link rel="stylesheet" href="{{ asset('admin/css/xadmin.css') }}">
    <!-- <link rel="stylesheet" href="public/admin/css/theme5.css"> -->
     <link rel="stylesheet" href="{{ asset('admin/css/theme4229.min.css') }}"> 
    
    <script src="{{ asset('admin/lib/layui/layui.js') }}" charset="utf-8"></script>
    <script type="text/javascript" src="{{ asset('admin/js/xadmin.js') }}"></script>
   
    <!--  <script type="text/javascript" src="public/js/echarts.min.js"></script> -->
     <link rel="stylesheet" href="{{ asset('layuiMini/lib/font-awesome-4.7.0/css/font-awesome.min.css') }}" media="all">
      <script type="text/javascript" src="{{ asset('js/jquery-3.2.1.min.js') }}"></script>
    <script src="{{ asset('js/jquery.page.js') }}"></script>
    <script>
            // 是否开启刷新记忆tab功能
           var is_remember = true;
    </script>
    
</head>
<style type="text/css">
	#nav li{
		padding: 10px 0px;
	}
    .left-nav #nav li .sub-menu li a {
    padding: 12px 11px 7px 26px;
    font-size: 14px;
    cursor: pointer;
}
.left-nav #nav li .sub-menu li {
    padding: 5px 0px;
    font-size: 14px;
    cursor: pointer;
}
	cite{
		font-size: 14px;
	}
    .hide{
        display: none;
    }
</style>
    <body class="index">
        <!-- 顶部开始 -->
        <div class="container">
            <div class="logo">
                <a href="./index.html">laravel权限控制后台</a></div>
            <div class="left_open">
                <a><i title="展开左侧栏" class="iconfont">&#xe699;</i></a>
            </div>
            <ul class="layui-nav left fast-add" lay-filter="">
                <li class="layui-nav-item">
                   <!--  <a href="javascript:;">+新增</a> -->
                    <dl class="layui-nav-child">
                        <!-- 二级菜单 -->
                        <dd>
                            <a onclick="xadmin.open('最大化','http://www.baidu.com','','',true)">
                                <i class="iconfont">&#xe6a2;</i>弹出最大化</a></dd>
                        <dd>
                            <a onclick="xadmin.open('弹出自动宽高','http://www.baidu.com')">
                                <i class="iconfont">&#xe6a8;</i>弹出自动宽高</a></dd>
                        <dd>
                            <a onclick="xadmin.open('弹出指定宽高','http://www.baidu.com',500,300)">
                                <i class="iconfont">&#xe6a8;</i>弹出指定宽高</a></dd>
                        <dd>
                            <a onclick="xadmin.add_tab('在tab打开','member-list.html')">
                                <i class="iconfont">&#xe6b8;</i>在tab打开</a></dd>
                        <dd>
                            <a onclick="xadmin.add_tab('在tab打开刷新','member-del.html',true)">
                                <i class="iconfont">&#xe6b8;</i>在tab打开刷新</a></dd>
                    </dl>
                </li>
            </ul>
            <ul class="layui-nav right" lay-filter="">
                <li class="layui-nav-item">
                    <a href="javascript:;">{{$user->email}}</a>
                    <dl class="layui-nav-child">
                        <!-- 二级菜单 -->
                        <dd>
                            <a onclick="xadmin.open('修改密码','{{route('admin.admin_user.resetpassword')}}',1000,800)">修改密码</a></dd>
                       <!--  <dd>
                            <a onclick="xadmin.open('切换帐号','http://www.baidu.com')">切换帐号</a></dd> -->
                        <dd>
                            <a href="{{route('admin/logout')}}">退出</a></dd>
                    </dl>
                </li>
                <li class="layui-nav-item to-index">
                   <!--  <a href="/">前台首页</a></li> -->
            </ul>
        </div>
        <!-- 顶部结束 -->
        <!-- 中部开始 -->
        <!-- 左侧菜单开始 -->
        <div class="left-nav">
            <div id="side-nav">
                <ul id="nav">
                	<li>
                        <a class="tabChange active" data-type="tabChange"   href="javascript:;">
                            <i class="fa fa-tachometer" lay-tips="统计分析"></i>
                            <cite>统计分析</cite>
                         </a>
                        
                    </li>
					 @inject('permissionPresenter','App\Presenters\PermissionPresenter')
        				{!! $permissionPresenter->menus() !!}
                  
                     

                    
                </ul>
            </div>
        </div>
        <!-- <div class="x-slide_left"></div> -->
        <!-- 左侧菜单结束 -->
        <!-- 右侧主体开始 -->
        <div class="page-content">
         
            <div class="layui-tab tab" lay-filter="xbs_tab" lay-allowclose="false">
                <ul class="layui-tab-title">
                    <li lay-id="32" class="home">
                        <i class="layui-icon">&#xe68e;</i>统计分析</li></ul>
                <div class="layui-unselect layui-form-select layui-form-selected" id="tab_right">
                   <!--  <dl> -->
                        <!-- <dd data-type="this">关闭当前</dd> -->
                      <!--   <dd data-type="other">关闭其它</dd>
                        <dd data-type="all">关闭全部</dd></dl> -->
                </div>
                <div class="layui-tab-content">
                    <div class="layui-tab-item layui-show">
                        <iframe src="{{route('admin/home')}}" frameborder="0" scrolling="yes" class="x-iframe"></iframe>
                    </div>
                </div>
                <div id="tab_show"></div>
            </div>
          
           
        </div>
        <div class="page-content-bg"></div>
        <style id="theme_style"></style>
        <!-- 右侧主体结束 -->
        <!-- 中部结束 -->
    
    </body>
    <script type="text/javascript">
        layui.use('element', function(){
  var $ = layui.jquery
  ,element = layui.element; //Tab的切换功能，切换事件监听等，需要依赖element模块
  
  //触发事件
  var active = {
 
   
    tabChange: function(){
      //切换到指定Tab项
      element.tabChange('xbs_tab', '32'); //切换到：用户管理
    }
  };
  
$('.tabChange').on('click', function(){
    var othis = $(this), type = othis.data('type');
    active[type] ? active[type].call(this, othis) : '';
  });

$('.menus-click').on('click', function(){
	var url=$(this).attr('data-url');
	var title=$(this).attr('data-title');
	xadmin.add_tab(title,url);
});
  
  //Hash地址的定位
  var layid = location.hash.replace(/^#test=/, '');
  element.tabChange('test', layid);
  
  element.on('tab(test)', function(elem){
    location.hash = 'test='+ $(this).attr('lay-id');
  });
  
});


    </script>
</html>