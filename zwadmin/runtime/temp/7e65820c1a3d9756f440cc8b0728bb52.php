<?php if (!defined('THINK_PATH')) exit(); /*a:2:{s:57:"D:\www\mlxyadmin\application\manage\view\start\login.html";i:1495712130;s:57:"D:\www\mlxyadmin\application\manage\view\common\base.html";i:1505356949;}*/ ?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="UTF-8">
	<meta content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no" name="viewport" />
	<meta http-equiv="X-UA-Compatible" content="IE=edge,Chrome=1" />
	<meta name="renderer" content="webkit">
	<title><?php echo $site_title; ?></title>
	<link rel="stylesheet" href="<?php echo $lib_path; ?>/amazeui/2.7.2/css/amazeui.css?_=<?php echo $site_version; ?>" />
</head>
<body class="theme-white">
<link rel="stylesheet" href="<?php echo $static_path; ?>/manage/common.css?_=<?php echo $site_version; ?>">

<style type="text/css">
body {
	background-image: linear-gradient(180deg, rgba(255, 255, 255, 0) 60%, #fff), linear-gradient(70deg, #e0f1ff 32%, #fffae3);
}
.login-code {
	max-width: 100%;
	height: 38px;
	cursor: pointer;
}
</style>


<div class="am-g tpl-g">

	<div class="tpl-login">
		<div class="tpl-login-content">

			<div class="tpl-login-logo">
				<img src="<?php echo $module_path; ?>/image/logo_manage_black.png" />
			</div>

			<form class="am-form tpl-form-line-form" action="<?php echo $login_url; ?>">
				<div class="am-form-group">
					<input type="text" class="tpl-form-input" name="user_name" value="" placeholder="用户名">
				</div>

				<div class="am-form-group">
					<input type="password" class="tpl-form-input" name="user_passwd" id="user_passwd" value="" placeholder="密码">
				</div>
                
                <?php if(isset($code_url)): ?>
                
				<div class="am-form-group">
					<input type="text" class="tpl-form-input" name="verify_code" id="verify_code" placeholder="验证码">
				</div>

				<div class="am-g am-form-group">
					<div class="am-u-sm-6 am-text-center">
						<a class="login-code-change">
							<img class="login-code" src="<?php echo $code_url; ?>" data-src="<?php echo $code_url; ?>">
						</a>
					</div>
					<div class="am-u-sm-6 am-text-center">
						<a href="javascript:void(0)" class="login-code-change" style="line-height: 40px;">看不清？换一张</a>
					</div>
				</div>
				
				<?php endif; ?>

				<div class="am-form-group">
					<button type="button" class="am-btn am-btn-primary am-btn-block ajax-post" target-form="am-form">登录</button>
				</div>
			</form>

		</div>
	</div>

</div>

<script type="text/javascript" src="<?php echo $lib_path; ?>/jquery/2.0.0/jquery.min.js?_=<?php echo $site_version; ?>"></script>
<script type="text/javascript" src="<?php echo $lib_path; ?>/require/2.3.1/require.js?_=<?php echo $site_version; ?>"></script>
<script type="text/javascript" >
var CMS = {
	'version' : '<?php echo $site_version; ?>',
	'editor' : '<?php echo $manage_editor; ?>',
	'path' : {
		'lib' : '<?php echo $lib_path; ?>',
		'static' : '<?php echo $static_path; ?>'
	},
	'api' : {
		'upload' : '<?php echo url("manage/upload/upload"); ?>',
		'upload_editor' : '<?php echo url("manage/upload/editor"); ?>'
	}
};
require.config({
	'baseUrl' : CMS.path.lib,
	'urlArgs' : '_=' + CMS.version,
	'packages' : [
		{
			'name' : "codemirror",
			'location' : CMS.path.lib + '/code.mirror/5.25.0',
			'main' : "lib/codemirror"
	    }
	],
	'paths' : {
		'jquery' : 'jquery/2.0.0/jquery.min',
		'amazeui' : 'amazeui/2.7.2/js/amazeui.min',
		'alertify' : 'alertify.js/1.8.0/alertify.min',
		'color-picker' : 'color.picker/1.0/colorPicker',
		'wangEditor' : 'wang.editor/2.1.23/js/wangEditor',
		'beautify' : 'js.beautify/1.6.4/beautify.min',
		'beautify-css' : 'js.beautify/1.6.4/beautify-css.min',
		'beautify-html' : 'js.beautify/1.6.4/beautify-html.min',
		'json-editor' : 'json.editor/5.5.11/jsoneditor-minimalist.min',
		'tag-editor' : 'tag.editor/1.0.20/jquery.tag-editor.min',
		'baiduEditor' : 'ueditor/1.4.3.3/ueditor.all.min',
		'ZeroClipboard' : 'zeroclipboard/2.2.0/ZeroClipboard.min',
		'jquery-nestable' : 'jquery.nestable/jquery.nestable',
		'jquery-sortable' : 'jquery.sortable/0.9.13/jquery-sortable-min'
	},
    'shim' : {
    	'alertify' : [
    		'css!alertify.js/1.8.0/css/alertify.min',
    		'css!alertify.js/1.8.0/css/themes/default.min'
    	],
    	'color-picker' : [
    		'color.picker/1.0/colors',
    		'color.picker/1.0/colorPicker.data',
    		'color.picker/1.0/jqColor'
    	],
    	'wangEditor': [
    		'css!wang.editor/2.1.23/css/wangEditor.min',
    		'css!code.mirror/5.25.0/lib/codemirror'
    	],
    	'json-editor' : [
    		'css!json.editor/5.5.11/jsoneditor.min'
    	],
    	'tag-editor' : [
    		'css!tag.editor/1.0.20/jquery.tag-editor',
    		'tag.editor/1.0.20/jquery.caret.min'
    	]
    },
	'map' : {
        '*': {
            'css': 'require.css/0.1.8/css'
        }
    },
    'waitSeconds' : 10
});
require(['amazeui'], function(amazeui, alertify){
	$.AMUI.progress.start();
	require(['alertify', CMS.path.static + '/manage/common.js'], function(alertify){
		
		// 发现alertify与wangEditor冲突，原因待查
		window.alertify = alertify;
		
		$.AMUI.progress.done();
	});
});
</script>

<script type="text/javascript">
	$(function() {
	$('.login-code-change').on('click', function() {
		var src = $('.login-code').attr('data-src');
		$('.login-code').attr('src', src + '?_=' + Math.random());
		$('#verify_code').val('');
		$('#verify_code').focus();
	});
	
	$('#user_passwd').keydown(function(e) {
		if (e.keyCode == 13) {
			$('.ajax-post').click();
		}
	});
	
	$('#verify_code').keydown(function(e) {
		if (e.keyCode == 13) {
			$('.ajax-post').click();
		}
	});
});
</script>

</body>
</html>