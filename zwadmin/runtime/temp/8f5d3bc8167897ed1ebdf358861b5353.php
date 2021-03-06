<?php if (!defined('THINK_PATH')) exit(); /*a:1:{s:56:"D:\www\zwadmin\application\advance\view\login\index.html";i:1522637197;}*/ ?>
<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<meta name="viewport" content="width=device-width, initial-scale=1"/>
<title>登录</title>
<meta name="description" content="">
<meta name="keywords" content="">

<link rel="stylesheet" type="text/css" href="<?php echo $static_path; ?>/login/logIn.css">
<link rel="stylesheet" type="text/css" href="<?php echo $static_path; ?>/login/iconfont.css">
</head>
<body>
    <div class="content">
		<form action="<?php echo url('login/dologin'); ?>" method="post" accept-charset="utf-8" id="login_form">
			<div class="information">
				<div id="login" class="Login">
					<div class="modal_title">
						<div class="shut_down">
							<span>×</span>
							<div class="modal_img"><img src="<?php echo $static_path; ?>/login/3.png" alt=""></div>
						</div>
						<div class="text">
							<span>用户登录</span>
						</div>
					</div>
					<div class="title"><span style="color:#fff;">用户登录</span> <span class="shadow"></span></div>
					<div class="main">
						<div class="main_left">
							<div class="main_text"><span>请输入您的账号密码</span></div>
							<div class="main_item">
								<input id="usernametreen" type="text" name="user_name" value="" placeholder="请输入账号">
								<i class="icon iconfont icon-yonghu"></i>
							</div>
							<div class="main_item">
								<input id="password" type="password" name="pwd" value="" placeholder="请输入密码">
								<i class="icon iconfont icon-mima"></i>
							</div>
							<div class="main_item confirm">
								<button class="determine" type="submit">登录</button>
							</div>
							<div class="main_item text_left" style="color:#fff">
								<span>没有账号？<a href="<?php echo url('register_user'); ?>">去注册></a> </span>
							</div>
						</div>
						<div class="main_right">
							<div class="main_item_top"><img src="<?php echo $static_path; ?>/login/1.png" alt="" /></div>
							<div class="main_right_item">
								<div class="main_cent"><img src="<?php echo $static_path; ?>/login/logo.png" alt="" width="100%;" height="100%;" /></div>
							</div>
						</div>
						<div class="clearfloat"></div>
					</div>
					<div class="modal_bottom">
						<div class="modal_btn">
							<button type="submit">确定</button>
						</div>
						<div class="modal_prompt" style="color:#fff">
							
							 <span>没有账号？<a href="<?php echo url('register_user'); ?>">去注册></a> </span>
						</div>
						<div class="modal_bottom_text">
							<span>欢迎登录中德安联人寿汇医医学专家意见服务客户端</span>
						</div>
					</div>
				</div>
			</div>
		</form>

		
    </div>

	<script type="text/javascript" src="<?php echo $static_path; ?>/login/jquery-3.2.1.min.js"></script>
<!--    <script type="text/javascript" src="<?php echo $static_path; ?>/login/login.js"></script>-->
    <script src="<?php echo $static_path; ?>/laychat/common/layui/layui.js?_=<?php echo $site_version; ?>"></script>
<script src="<?php echo $static_path; ?>/laychat/common/jquery.form.js?_=<?php echo $site_version; ?>"></script>
<script type="text/javascript">
    $(function(){
        var options = {
            beforeSubmit:showStart,
            success:showSuccess
        };
        $('#login_form').submit(function(){
            $(this).ajaxSubmit(options);
            return false;
        });

        function showStart(){
            layui.use(['layer'], function(){
                var layer = layui.layer;
                layer.ready(function(){
                    layer.load(0, {shade:false, time:100});
                });
            });
            return true;
        }

        function showSuccess(data){
            layui.use(['layer'], function(){
                var layer = layui.layer;
                layer.ready(function(){
                    if( 1 == data.code ){
                        layer.msg(data.msg, {'time' : 2000});
                        window.location.href = data.data;
                    }else{
                        layer.msg(data.msg, {'time' : 2000});
                    }
                });
            });
        }
    });
</script>
</body>
</html>