
<!DOCTYPE HTML>
<html  class="x-admin-sm">
<head>
  <meta charset="UTF-8">
  <title>后台登录</title>
  <meta name="renderer" content="webkit|ie-comp|ie-stand">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="viewport" content="width=device-width,user-scalable=yes, minimum-scale=0.4, initial-scale=0.8,target-densitydpi=low-dpi" />
    <meta http-equiv="Cache-Control" content="no-siteapp" />
   
   


    <link rel="stylesheet" href="{{ asset('admin/css/font.css') }}">
    <link rel="stylesheet" href="{{ asset('admin/css/login.css') }}">
    <link rel="stylesheet" href="{{ asset('admin/css/xadmin.css') }}">
    <!-- <link rel="stylesheet" href="public/admin/css/theme5.css"> -->
    <!--  <link rel="stylesheet" href="{{ asset('admin/css/theme4229.min.css') }}">  -->
    
    <script src="{{ asset('admin/lib/layui/layui.js') }}" charset="utf-8"></script>
    <script type="text/javascript" src="{{ asset('admin/js/xadmin.js') }}"></script>
   
   
      <script type="text/javascript" src="{{ asset('js/jquery-3.2.1.min.js') }}"></script>
    <script src="{{ asset('js/jquery.page.js') }}"></script>
    <script>
            // 是否开启刷新记忆tab功能
           var is_remember = true;
    </script>
    
    
</head>
<body class="login-bg">
    
    <div class="login layui-anim layui-anim-up">
        <div class="message">后台管理员登录</div>
        <div id="darkbannerwrap"></div>
        
        <form method="post" class="layui-form" >
            {{ csrf_field() }}
            <input name="email" placeholder="用户名" id="username"  type="text" lay-verify="required" class="layui-input" >
            <hr class="hr15">
            <input name="password" lay-verify="required" id="password" placeholder="密码"  type="password" class="layui-input">
            <hr class="hr15">
            <input type="text" placeholder="验证码" style="width: 70%;display: inline-block;" name="captcha" lay-verify="required" class="layui-input" ><img width="100" height="50" src="{{captcha_src()}}" id="imgCaptcha" onclick="javascript:newgdcode(this,this.src);" alt="">
             <hr class="hr15">
            <input value="登录" lay-submit lay-filter="login" style="width:100%;" type="button" class="submit">
            <hr class="hr20" >
        </form>
    </div>
<script language="javascript">
        function newgdcode(obj,url) {
            obj.src = url+ '?nowtime=' + new Date().getTime();
            //后面传递一个随机参数，否则在IE7和火狐下，不刷新图片
        }
    </script>
<script type="text/javascript">
  
  $(".submit").click(function(){
        var data={}
        var t=$('form').serializeArray();
        $.each(t,function(){
            data[this.name]=this.value;
        });
        var email=data.email;
        var password=data.password;
         var captcha=data.captcha;
        if(!email){
          layer.alert('请输入账号');
          return false;
        }
        if(!password){
          layer.alert('请输入密码');
          return false;
        }
         if(!captcha){
          layer.alert('请输入验证码');
          return false;
        }
        $.ajaxSetup({headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')}});
        $.ajax({
            url:'{{ route('admin/submitLogin') }}',
            type:'post',
            data:{email:email,password:password,captcha:captcha},
            dataType:'json',
            error:function(){
         
              layer.alert('网络出错,请刷新重试');
            },
            success:function(data){
                if(data.code==200){
                   layer.alert(data.message,function(){
                     window.location.href="/admin"
                   });
                  
                }
                else{
                    layer.alert(data.message);
                    $('#imgCaptcha').trigger("click");
                    
                }
            },
        })  
    })
</script>
    <!-- 底部结束 -->
   
</body>
</html>
