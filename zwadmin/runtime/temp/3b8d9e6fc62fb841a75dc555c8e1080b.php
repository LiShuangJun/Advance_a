<?php if (!defined('THINK_PATH')) exit(); /*a:1:{s:64:"D:\www\zwadmin\application\advance\view\login\register_user.html";i:1522663277;}*/ ?>
<!DOCTYPE HTML>
<html>
<head>
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<meta name="viewport" content="width=device-width, initial-scale=1">

<title>注册</title>
<meta name="description" content="">
<meta name="keywords" content="">
<link href="<?php echo $static_path; ?>/login/logIn.css" rel="stylesheet">
<link rel="stylesheet" type="text/css" href="<?php echo $static_path; ?>/login/iconfont.css">

</head>
<body>
  
    <div class="content">
      <form action="" method="post" accept-charset="utf-8" id="regform">
        <div class="information">

          <!-- 注册首页 -->
          <div class="Review">
            <!-- 手机端 标题 -->
            <div class="modal_title">
              <div class="shut_down">
                  <span><a style="text-decoration: none;color:#fff;" href="https://allianzchina.advance-medical.com.cn/">×</a></span>
                  <div class="modal_img"><img src="<?php echo $static_path; ?>/login/3.png" alt=""></div>
              </div>
              <div class="text">
                <span>新用户注册</span>
              </div>
            </div>
            <!-- 手机端 标题 -->

            <!-- pc 标题 -->
            <div class="title" ><span>欢迎登录中德安联人寿/汇医医学专家意见服务客户端</span> <span class="shadow"></span></div>
            <!-- pc 标题 -->
            <!-- 注册验证 -->
            <div class="main">
              <div class="main_left">
                <div class="main_text">
                  <span>首次登录请提交您的信息,确认成功后即可登录</span>
                </div>
                <div class="main_item ">
                  <input id="username" type="text" name="username" value="" placeholder="请输入姓名(必填项)">
                  <i class="icon iconfont icon-yonghu"><span style="color:red;">*</span></i>
                </div> 
                <div class="main_item">
                  <input id="tel" type="text" name="tel"   placeholder="请输入手机号(必填项)">
                  <i class="icon iconfont icon-shouji"><span style="color:red;">*</span></i>
                </div>
                 <div class="main_item">
                  <input id="email" type="email" name="email"   placeholder="请输入邮箱(选填)">
                  <i class="icon iconfont icon-tubiao209"></i>
                </div>
                <div class="main_item">
                  <input id="Orders" type="text" name="Orders"  placeholder="请输入身份证/证件(必填项)">
                  <i class="icon iconfont icon-biaodan"><span style="color:red;">*</span></i>
                </div>
               
                
                <div class="main_item confirm">
                  <button class="determine" type="button">确认</button>
                </div>
                <div class="main_item text_left" style="color:#fff">
                  <span>已有账号？<a href="<?php echo url('index'); ?>">登录</a> </span>
                </div>
              </div>
              <!-- 注册验证 -->

              <!-- logo -->
              <div class="main_right">
                <div class="main_item_top"><img src="<?php echo $static_path; ?>/login/1.png" alt=""/></div>
                <div class="main_right_item">
                  <div class="main_cent"><img src="<?php echo $static_path; ?>/login/logo.png" alt="" width="100%;" height="100%;" /></div>
                </div>
              </div>
              <!-- logo -->
              <div class="clearfloat"></div>
            </div>

            <!-- 手机端 确认 -->
            <div class="modal_bottom">
              <div class="modal_btn">
                <button type="button">确定</button>
              </div>
              <div class="modal_prompt" style="color:#fff">
                 <span>已有账号？<a href="<?php echo url('index'); ?>">登录</a> </span> 
              </div>
            </div>
            <!-- 手机端 确认 -->
          </div>
          <!-- 注册首页 -->

          <!-- 用户名性别验证 -->
          <div class="Application">
            <!-- 手机端 标题 -->
            <div class="modal_title">
              <div class="shut_down">
                   <span><a style="text-decoration: none;color:#fff;" href="https://allianzchina.advance-medical.com.cn/">×</a></span>
                  <div class="modal_img"><img src="<?php echo $static_path; ?>/login/3.png" alt=""></div>
              </div>
              <div class="text">
                <span>账号申请</span>
              </div>
            </div>
            <!-- 手机端 标题 -->

            <div class="main">
              <div class="main_left">
                <!-- pc 标题 -->
                <div class="title min"><span>账号申请</span><span class="shadow"></span></div>
                <!-- pc 标题 -->
                <div class="main_text"><span>请设置您的账号信息</span> </div>

                <!-- 用户名/性别 -->
                <div class="main_item">
                  <input id="usernameTwo" type="text" name="usernameTwo" value="" placeholder="请输入用户名">
                  <i class="icon iconfont icon-yonghu"><span style="color:red;">*</span></i>
                </div>  
                <div class="main_item">
                  <input id="sexM" type="" value="" >
                  <i class="icon iconfont icon-tijianxingbiefenxi"><span style="color:red;">*</span></i>
                  <select id="sex" name="sexM" >
                    <option class="sex"  value="0">请选择性别</option>
                    <option class="sex" value="1">男</option>
                    <option class="sex" value="2">女</option>
                    
                  </select>
                </div>
                
                <div class="main_item confirm">
                  <button class="determine" type="button">下一步</button>
                </div>
              </div>
              <!-- 用户名/性别 -->

              <!-- logo -->
              <div class="main_right min">
                <div class="main_item_top"><img src="<?php echo $static_path; ?>/login/1.png" alt="" /></div>
                <div class="main_right_item">
                  <div class="main_cent"><img src="<?php echo $static_path; ?>/login/logo.png" alt="" width="100%;" height="100%;" /></div>
                </div>
              </div>
              <!-- logo -->
              <div class="clearfloat"></div>
            </div>

            <!-- 手机端下一步 -->
            <div class="modal_bottom">
              <div class="prompt"><span ></span></div>
              <div class="modal_btn">
                <button type="button">下一步</button>
              </div>
            </div>
            <!-- 手机端下一步 -->
          </div>
          <!-- 用户名性别验证 -->


          <!-- 短信验证 -->
          <div class="idcard">
            <!-- 手机端标题 -->
            <div class="modal_title">
              <div class="shut_down">
                   <span><a style="text-decoration: none;color:#fff;" href="https://allianzchina.advance-medical.com.cn/">×</a></span>
                  <div class="modal_img"><img src="<?php echo $static_path; ?>/login/3.png" alt=""></div>
              </div>
              <div class="text">
                <span>身份验证</span>
              </div>
            </div>
            <!-- 手机端标题 -->
            <div class="main">
              <div class="main_left">
                <!-- pc 标题 -->
                <div class="title min"><span >身份验证</span><span class="shadow"></span></div>
                <!-- pc 标题 -->
                <div class="main_text" style="text-align: justify;padding-left:90px;"><span>请您进行身份验证</span> </div>
                <div class="main_item min">
                  <label> 手机号:</label> <p id="telVal" style="display: inline-block;text-indent:16px;" >32132132</p>
                </div>  
                <div class="main_item">
                    <input class="V_input" type="text" value="" placeholder="请输入验证码">
                    <!--<span class="Verification"> 获取验证码</span>-->
                    <input type="button" id="Verification" value="获取验证码" />
                    <i class="icon iconfont icon-dunpai1"><span style="color:red;">*</span></i>
                </div>
                
                <div class="main_item confirm">
                  <button class="determine" type="button" style="width:100%;">下一步</button>
                </div>
                    
              </div>
              <div class="main_right min">
                <div class="main_item_top"><img src="<?php echo $static_path; ?>/login/1.png" alt="" /></div>
                <div class="main_right_item">
                  <div class="main_cent"><img src="<?php echo $static_path; ?>/login/logo.png" alt="" width="100%;" height="100%;" /></div>
                </div>
              </div>
              <div class="clearfloat"></div>
            </div>
            <div class="modal_bottom">
              <div class="prompt"><span ></span></div>
              <div class="modal_btn">
                <button type="button">下一步</button>
              </div>
            </div>
          </div>

            <!-- 登陆信息 -->
            <div class="login">
                <!-- 手机端 标题 -->
                <div class="modal_title">
                    <div class="shut_down">
                         <span><a style="text-decoration: none;color:#fff;" href="https://allianzchina.advance-medical.com.cn/">×</a></span>
                        <div class="modal_img"><img src="<?php echo $static_path; ?>/login/3.png" alt=""></div>
                    </div>
                    <div class="text">
                        <span>登录信息</span>
                    </div>
                </div>
                <!-- 手机端 标题 -->

                <div class="main">
                    <div class="main_left">
                        <!-- pc 标题 -->
                        <div class="title min"><span>登录信息</span><span class="shadow"></span></div>
                        <!-- pc 标题 -->
                        <div class="main_text"><span>首次登录请完善您的信息</span> </div>

                        <!-- 用户名 -->
                        <div class="main_item">
                            <input id="passwordOne" type="password" value="" placeholder="请输入密码" name="pwd">
                           
                            <i class="icon iconfont icon-mima"><span style="color:red;">*</span></i>
                        </div>
                        <div class="main_item">
                            <input id="passwordTwo" type="password" value="" placeholder="请确认密码" name="pwd_agnin">
                            <i class="icon iconfont icon-mima"><span style="color:red;">*</span></i>
                        </div>

                        <!-- 用户名 -->
                        <!-- 密码 -->
                        <div class="main_item confirm">
                            <button class="determine" type="button">登录</button>
                        </div>

                        <div class="promptMax"><span style="font-size:12px;">密码请妥善保管，如忘记密码。请联系我们：400-820-7122</span></div>
                        <!-- 密码 -->
                    </div>
                    <!-- logo -->
                    <div class="main_right min">
                        <div class="main_item_top"><img src="<?php echo $static_path; ?>/login/1.png" alt=""  /></div>
                        <div class="main_right_item">
                            <div class="main_cent"><img src="<?php echo $static_path; ?>/login/logo.png" alt="" width="100%;" height="100%;" /></div>
                        </div>
                    </div>
                    <!-- logo -->
                    <div class="clearfloat"></div>
                </div>

                <!-- 手机端下一步 -->
                <div class="modal_bottom">
                    <div class="prompt"><span style="font-size:12px;">密码请妥善保管，如忘记密码。请联系我们：400-820-7122</span></div>
                    <div class="modal_btn">
                        <button type="button">登录</button>
                    </div>
                </div>
                <!-- 手机端下一步 -->
            </div>
            <!--登陆信息-->


        </div>
      </form>
    
    </div>



    <script type="text/javascript" src="<?php echo $static_path; ?>/login/jquery-3.2.1.min.js"></script>
    <script src="<?php echo $static_path; ?>/laychat/common/layui/layui.js?_=<?php echo $site_version; ?>"></script>

     <script type="text/javascript">
         var signurl="<?php echo url('valid_user'); ?>";
        var smurl="<?php echo url('sendmess'); ?>";
        var validurl="https://cmsweb.chinacloudsites.cn/api/employee/check";
        var validmess="<?php echo url('validmess'); ?>";
        var saveform="<?php echo url('savemsg'); ?>";
        var registerurl="<?php echo url('register_user'); ?>";
        var jumpurl="<?php echo url('index'); ?>";
    </script>
    <script type="text/javascript" src="<?php echo $static_path; ?>/login/login.js"></script>
</body>
</html>