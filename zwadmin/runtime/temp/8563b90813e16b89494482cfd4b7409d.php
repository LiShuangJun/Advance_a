<?php if (!defined('THINK_PATH')) exit(); /*a:1:{s:55:"D:\www\zwadmin\application\manage\view\common\jump.html";i:1517457967;}*/ ?>
<!DOCTYPE html>
<html>

	<head>
		<meta charset="UTF-8">
		<meta content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no" name="viewport" />
		<meta http-equiv="X-UA-Compatible" content="IE=edge,Chrome=1" />
		<meta name="renderer" content="webkit">
		<title><?php echo $msg; ?></title>
		<link rel="stylesheet" href="<?php echo $lib_path; ?>/amazeui/2.7.2/css/amazeui.css?_=<?php echo $site_version; ?>" />
		<style type="text/css">
			body {
				padding: 20px;
				background-image: linear-gradient(180deg, rgba(255, 255, 255, 0) 60%, #fff), linear-gradient(70deg, #e0f1ff 32%, #fffae3);
			}
			
			.jump-content {
				max-width: 50rem;
				margin-top: -2rem;
				margin-left: auto;
				margin-right: auto;
				padding-top: 30rem;
				padding-top: 50vh;
			}
			
			.jump-content .jump-area {
				width: 100%;
				padding: 2rem;
				background: #fff;
				text-align: center;
				border-radius: 0.5rem;
				transform: translateY(-50%);
			}
			
			.jump-content .jump-area .jump-tip {
				margin-top: 1rem;
				white-space: nowrap;
				overflow: hidden;
				text-overflow: ellipsis;
			}
			
			.jump-content .jump-area .jump-icon {
				font-size: 5rem;
			}
		</style>
	</head>

	<body>
		<div class="jump-content" style="max-width: 500px;">
			<div class="jump-area">
				<h1><span class="<?php echo !empty($code)?'am-icon-check-square':'am-icon-times-circle'; ?> am-icon-lg jump-icon <?php echo !empty($code)?'am-text-success':'am-text-danger'; ?>"></span></h1>
				<h1 class="jump-tip" title="<?php echo $msg; ?>"><?php echo $msg; ?></h1>
<!--				<p>
					<a href="javascript:jumpUrl();"><span class="jump-wait"><?php echo $wait; ?></span> 秒后自动跳转链接</a>
				</p>
                                <p>
					<a href="javascript:jumpUrl();"><span class="jump-wait"><?php echo $wait; ?></span> seconds after the jump automatically</a>
				</p>-->
			</div>
		</div>
		<script type="text/javascript" src="<?php echo $lib_path; ?>/jquery/2.0.0/jquery.min.js?_=<?php echo $site_version; ?>"></script>
		<script>
                    
//			var wait = "<?php echo $wait; ?>";
                       var wait = "2";
			var url = "<?php echo $url; ?>";
                       
			$(function() {
				countDown();
			});

			function countDown() {
//				$('.jump-wait').text(wait);
				wait--;
				if(wait <= 0) {
					setTimeout(jumpUrl, 1000);
				} else {
					setTimeout(countDown, 1000);
				}
			}

			function jumpUrl() {
				if(url) {
					location.href = url;
				} else {
					history.go(-1);
				}
			}
		</script>
	</body>
</html>