


<meta charset="UTF-8">
  <title></title>
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
    .layui-btn  {
    border-color: #1E9FFF;
    background-color: #1E9FFF;
    color: #fff;
}
.layui-btn a {
    height: 28px;
    line-height: 28px;
    margin: 5px 5px 0;
    padding: 0 15px;
    border: 1px solid #dedede;
    background-color: #fff;
    color: #333;
    border-radius: 2px;
    font-weight: 400;
    cursor: pointer;
    text-decoration: none;
}
.layui-form-label {
    float: left;
    display: block;
    padding: 9px 15px;
    width: 150px;
    font-weight: 400;
    line-height: 20px;
    text-align: right;
}
.layui-form-item .layui-input-inline {
    float: left;
    width: 400px;
    margin-right: 10px;
}
</style>
<body style="background: #fff">
        <div class="layui-fluid">
            <div class="layui-row">
                <form class="form-horizontal layui-form" >

                    <div class="layui-form-item">
                        
                       

                        <label for="" class="layui-form-label">
                            <span class="x-red"></span>上级模块</label>
                        <div class="layui-input-inline" id="roles">
                           @inject('permissionPresenter','App\Presenters\PermissionPresenter')

                            {!! $permissionPresenter->topPermissionSelect($permission->fid) !!}
                        </div>
                    </div>

                    <div class="layui-form-item">
                        <label for="menu_name" class="layui-form-label">
                            <span class="x-red">*</span>模块code</label>
                        <div class="layui-input-inline">
                            <input type="text" id="name" name="name" value="{{ $permission->name }}" required="" lay-verify="required" autocomplete="off" class="layui-input"></div>
                    </div>

                    <div class="layui-form-item">
                        <label for="menu_name" class="layui-form-label">
                            <span class="x-red">*</span>路由（多个路由,分隔）</label>
                        <div class="layui-input-inline">
                            
                            <textarea id="url" name="url" placeholder="请输入内容" class="layui-textarea">{{ $permission->url }}</textarea>
                        </div>
                    </div>
                  
                    <div class="layui-form-item">
                        <label for="menu_name" class="layui-form-label">
                            <span class="x-red">*</span>显示名称</label>
                        <div class="layui-input-inline">
                            <input type="text" id="display_name" value="{{ $permission->display_name }}" name="display_name" required="" lay-verify="required" autocomplete="off" class="layui-input"></div>
                    </div>
                  
                     <div class="layui-form-item">
                        <label for="menu_name" class="layui-form-label">
                            <span class="x-red"></span>说明</label>
                        <div class="layui-input-inline">
                            <input type="text" id="description" value="{{ $permission->description }}" name="description"  autocomplete="off" class="layui-input"></div>
                    </div>
                  
                     <div class="layui-form-item">
                        <label for="menu_name" class="layui-form-label">
                            <span class="x-red">*</span>图标</label>
                        <div class="layui-input-inline">
                            <input type="text" id="icon" value="{{ $permission->icon }}" name="icon" required="" lay-verify="required" autocomplete="off" class="layui-input"></div>
                    </div>
               
                    <div class="layui-form-item">
                        <label for="menu_name" class="layui-form-label">
                            <span class="x-red">*</span>是否默认权限</label>
                        <div class="layui-input-inline">
                           <select class="col-xs-10 col-sm-5 input-sm" name="is_default">
                                <option {{ $permission->is_default ? 'selected':'' }} value="1" >是</option>
                                <option {{ $permission->is_default ? '':'selected' }} value="0" >否</option>
                            </select>

                        </div>
                    </div>
                   

                   <div class="layui-form-item">
                        <label for="menu_name" class="layui-form-label">
                            <span class="x-red">*</span>是否菜单</label>
                        <div class="layui-input-inline">
                           <select class="col-xs-10 col-sm-5 input-sm" name="is_menu">
                                <option {{ $permission->is_menu ? 'selected':'' }} value="1" >是</option>
                                <option {{ $permission->is_menu ? '':'selected' }} value="0" >否</option>
                            </select>

                        </div>
                    </div>
                    <input type="hidden" name="url1" value="{{route('admin.permission.update',['id'=>$permission->id])  }}">
                    <input type="hidden" name="_method" value="PUT">
                    <div class="layui-form-item">
                        <label for="menu_name" class="layui-form-label">
                            <span class="x-red">*</span>排序</label>
                        <div class="layui-input-inline">
                            <input type="number" id="sort" value="{{ $permission->sort }}" name="sort" required="" lay-verify="required" autocomplete="off" class="layui-input"></div>
                    </div>

                   


 

                    <div class="layui-form-item">
                        <label for="L_repass" class="layui-form-label"></label>
                        <button class="layui-btn" lay-filter="add" lay-submit="">修改</button></div>
                </form>
            </div>
        </div>
        <script>layui.use(['form', 'layer','jquery','laydate'],
            function() {
                $ = layui.jquery;
                var form = layui.form,
                laydate = layui.laydate,
                layer = layui.layer;

              
                

                //监听提交
                form.on('submit(add)',
                function(data) {

                    console.log(data);
                    //发异步，把数据提交给php
                    var name=data.field.name,
                    fid=data.field.fid,
                    url1=data.field.url1,
                    display_name=data.field.display_name,
                    description=data.field.description,
                    is_default=data.field.is_default,
                    is_menu=data.field.is_menu,
                    sort=data.field.sort,
                     url=data.field.url,
                      _method=data.field._method,
                    icon=data.field.icon;
                  
                    $.ajax({
                        type:'post',
                        data:{name:name,fid:fid,url:url,display_name:display_name,description:description,is_default:is_default,is_menu:is_menu,sort:sort,icon:icon,_method:_method},
                        dataType:'json',
                        url:url1,
                        success:function(data){
                            if(data.code==200){
                                layer.alert(data.message, {
                                    icon: 6
                                },
                                function() {
                                    //关闭当前frame
                                    xadmin.close();

                                    // 可以对父窗口进行刷新 
                                    xadmin.father_reload();
                                });
                                
                            }else{
                                layer.alert(data.message);
                            }
                        }
                    });
                    return false;
                    
                });

            });</script>
      
    </body>

</html>