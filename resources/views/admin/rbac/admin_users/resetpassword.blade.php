@extends('admin.layouts.app')





@section('content')
 <div class="layui-fluid">
            <div class="layui-row">
                <form class="form-horizontal layui-form" >

                 



                  

                    <div class="layui-form-item">
                        <label for="menu_name" class="layui-form-label">
                            <span class="x-red">*</span>旧密码</label>
                        <div class="layui-input-inline">
                            <input type="text" id="oldpassword" name="oldpassword" value="" required="" lay-verify="required" autocomplete="off" class="layui-input"></div>
                    </div>
                  
                    <div class="layui-form-item">
                        <label for="menu_name" class="layui-form-label">
                            <span class="x-red">*</span>新密码</label>
                        <div class="layui-input-inline">
                            <input type="text" id="password" name="password" value="" required="" lay-verify="required" autocomplete="off" class="layui-input"></div>
                    </div>
                    <div class="layui-form-item">
                        <label for="menu_name" class="layui-form-label">
                            <span class="x-red">*</span>确认密码</label>
                        <div class="layui-input-inline">
                            <input type="text" id="password_confirmation" name="password_confirmation" value="" required="" lay-verify="required" autocomplete="off" class="layui-input"></div>
                    </div>
                    
                  
                    <div class="layui-form-item">
                        <label for="L_repass" class="layui-form-label"></label>
                        <button class="layui-btn" lay-filter="add" lay-submit="">修改密码</button></div>
                </form>
            </div>
        </div>
@endsection

@section('javascript')
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
                    var oldpassword=data.field.oldpassword,
                    password=data.field.password,
                    password_confirmation=data.field.password_confirmation;
                   
                    $.ajax({
                        type:'post',
                        data:{password_confirmation:password_confirmation,password:password,oldpassword:oldpassword},
                        dataType:'json',
                        url:'{{ route('admin.admin_user.savepassword') }}',
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

@endsection
