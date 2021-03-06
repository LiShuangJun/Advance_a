<?php if (!defined('THINK_PATH')) exit(); /*a:4:{s:54:"D:\www\mlxyadmin\application\emo\view\index\index.html";i:1515477566;s:54:"D:\www\mlxyadmin\application\emo\view\common\base.html";i:1515467724;s:56:"D:\www\mlxyadmin\application\emo\view\common\header.html";i:1515477549;s:56:"D:\www\mlxyadmin\application\emo\view\common\footer.html";i:1515477530;}*/ ?>
<!doctype html>
<html lang="">
<head>
  <meta charset="utf-8">
  <meta http-equiv="x-ua-compatible" content="ie=edge">
  <title><?php echo $site_title; ?></title>
  <meta name="description" content="">
  <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1.0, user-scalable=0">
  <link rel="apple-touch-icon" href="apple-touch-icon.png">
  <!-- Place favicon.ico in the root directory -->
  <link rel="stylesheet" type="text/css" href="<?php echo $static_path; ?>/advance/bower_components/bootstrap/dist/css/bootstrap.min.css?_=<?php echo $site_version; ?>">
  <link rel="stylesheet" type="text/css" href="<?php echo $static_path; ?>/advance/css/flexslider.css?_=<?php echo $site_version; ?>">
  <link rel="stylesheet" type="text/css" href="<?php echo $static_path; ?>/advance/css/font-awesome.min.css?_=<?php echo $site_version; ?>">
  <link rel="stylesheet" type="text/css" href="<?php echo $static_path; ?>/advance/css/perfect-scrollbar.min.css?_=<?php echo $site_version; ?>">
  <link rel="stylesheet" type="text/css" href="<?php echo $static_path; ?>/advance/css/DateTimePicker.css?_=<?php echo $site_version; ?>">
  <!--[if lt IE 9]>
    <link rel="stylesheet" type="text/css" href="./css/DateTimePicker-ltie9.min.css">
  <![endif]-->
  <link rel="stylesheet" type="text/css" href="<?php echo $static_path; ?>/advance/css/app.css?_=<?php echo $site_version; ?>">
  <link rel="stylesheet" type="text/css" href="<?php echo $static_path; ?>/advance/css/forms.css?_=<?php echo $site_version; ?>">
  <link rel="stylesheet" type="text/css" href="<?php echo $static_path; ?>/advance/css/new.css?_=<?php echo $site_version; ?>">
  
</head>
<body class="loading  ">

  <div class="hide-image" style="display:none;">
    <img src="<?php echo $static_path; ?>/advance/img/001.jpg">
  </div>
  <div id="page-wrapper">
    <section id="preloader">
      <div class="loader" id="loader">
          <div class="loader-img"></div>
      </div>
    </section>
    <div class="top-nav clearfix">
      <a class="logo-wrapper clearfix" href="<?php echo url('/Allianz/EMO'); ?>">
        <span class="logo1 visible-lg visible-md visible-sm"><img src="<?php echo $static_path; ?>/advance/img/logo.png" alt="logo"></span>
        <?php if($userid != 0): ?>
        <span class="logo1 visible-xs"><img src="<?php echo $static_path; ?>/advance/img/logo.png" alt=""></span>
        <span class="logo2 visible-xs"><?php echo $minedata['user_name']; ?></span>
        <?php else: ?>
        <span class="logo3 visible-xs"><img src="<?php echo $static_path; ?>/advance/img/logo.png" alt=""></span>
        <?php endif; ?>
      </a>
        <?php if($userid != 0): ?>
      <a class="login-wrapper visible-xs clearfix" href="<?php echo url('Login/logout'); ?>">Log out</a>
       <?php else: ?>
        <a class="login-wrapper visible-xs" href="<?php echo url('Login/index'); ?>">Log In</a>
       <?php endif; ?>
      <ul class="menu-wrapper clearfix">
        <?php if($userid != 0): ?>
        <li class="menubar-login hidden-xs">
          <a href="<?php echo url('Login/logout'); ?>"><?php echo $minedata['user_name']; ?>丨Log out</a>
        </li>
        <?php else: ?>
        <li class="menubar-login hidden-xs">
          <a href="<?php echo url('Login/index'); ?>"><i class="fa fa-unlock-alt" aria-hidden="true"></i>&nbsp;Log In</a>
        </li>
        <?php endif; if(is_array($service_list) || $service_list instanceof \think\Collection || $service_list instanceof \think\Paginator): $i = 0; $__LIST__ = $service_list;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$sl): $mod = ($i % 2 );++$i;if(in_array(($sl['id']), explode(',',"1"))): ?>
         <li class="menubar menubar-<?php echo $sl['id']; ?>"><a href="<?php echo url('/Allianz/EMO/services/'.$sl['id']); ?>"><span class="bar-background"></span><span class="bar-text"><?php echo $sl['typeename']; ?></span><span class="bottom-gradient"></span></a><span class="right-gradient"></span></li>

         <?php endif; endforeach; endif; else: echo "" ;endif; ?>

      </ul>
    </div>
    <div class="flex-container-outer-wrapper">
    <div class="flex-container-wrapper mb--l">
      <div class="flex-container">
        <div class="flexslider">
          <ul class="slides">
            <li>
              <img src="<?php echo $static_path; ?>/advance/img/001.jpg">
            </li>
            <li>
              <img src="<?php echo $static_path; ?>/advance/img/002.jpg">
            </li>
            <li>
              <img src="<?php echo $static_path; ?>/advance/img/003.jpg">
            </li>
          </ul>
        </div>
      </div>
      <div class="flex-mask">
        <div class="diagnose logvilad" >
          <div class="image-wrapper"><img src="<?php echo $static_path; ?>/advance/img/diagnose.png" alt=""></div>
          <div class="diagnose-text">Get Started</div>
        </div>
        <div class="flex-phone-wrapper">
          <span>1&nbsp;300&nbsp;88&nbsp;1028</span>
        </div>
      </div>
    </div>
  </div>
    <div class="mobile-header mb--s mt--s">
      <div class="image-wrapper">
        <img src="<?php echo $static_path; ?>/advance/img/444.jpg" alt="">
      </div>
    </div>
    <div class="mobile-diagnose logvilad">
      <div class="diagnose-text">Get Started</div>
    </div>


<div class="feature-container clearfix">
      <div class="feature-wrapper">
        <div class="image-wrapper">
          <img src="<?php echo $static_path; ?>/advance/img/111.jpg" alt="">
        </div>
        <div class="feature-desc feature-desc-1">
          <div class="feature-desc-inner-wrapper">
          <h3><span>Global Expert Medical Opinion&nbsp;(GEMO)</span></h3>
          <ul>
            <li><a href="<?php echo url('/Allianz/EMO/services/1'); ?>#Gemomao"><span class="feature-text">What is a GEMO and when to use it?</span><span class="feature-icon"><i class="fa fa-angle-right"></i></span></a></li>
<!--             <li><a href="<?php echo url('/services/1'); ?>#foreign"><span class="feature-text">When to use GEMO?<span class="feature-icon"><i class="fa fa-angle-right"></i></span></span></a></li> -->
          </ul>
          </div>
        </div>
      </div>


        
    </div>


<div class="bottom-nav-wrapper clearfix">
      <ul class="bottom-nav">
        <li><a href="http://advance-medical.net/about">About Advance Medical</a></li>
        <li><a href="<?php echo url('/Allianz/EMO/services/1'); ?>#Gemomao">Global Expert Medical Opinion</a></li>
<!--         <li><a href="" class="special-text">xxxxxx</a></li> -->
      </ul>
    </div>
    <div class="medical-footer">
      <div class="medical-footer-text">These independent advisory services do not constitute any form of medical diagnosis, treatment or prescription.</div>
      <div class="medical-footer-text2">Copyright of Advance Medical 2017</div>
    </div>
  </div>
  <div class="app-mask">
  </div>
    <!--弹出-->
  <div class="mobile-form-outter-wrapper">
    <div class="mobile-form-wrapper">
      <div class="mobile-form-home-header">
          <div class="mobile-home-header-text"> I’d like to request the service of</div>
          <span class="mobile-close-button"><span>&#10006;</span></span>
      </div>
      <div class="m-form-choice-wrapper">
        
        <?php if(is_array($service_list) || $service_list instanceof \think\Collection || $service_list instanceof \think\Paginator): $i = 0; $__LIST__ = $service_list;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$sl): $mod = ($i % 2 );++$i;if(in_array(($sl['id']), explode(',',"1"))): ?>
                <a type="button" class="btn m-btn-medical <?php echo $sl['mobile_style']; ?>" href="<?php echo url('/Allianz/EMO/mobile_form/'.$sl['id']); ?><?php echo $sl['m_id_name']; ?>"><?php echo $sl['typeename']; ?></a>
         <?php endif; endforeach; endif; else: echo "" ;endif; ?>

      </div>
    </div>
  </div>
    <!--登录-->
  <div class="form-outter-wrapper">
    <div class="form-diagnose">
      <div class="image-wrapper"><img src="<?php echo $static_path; ?>/advance/img/diagnose.png" alt=""></div>
      <div class="form-diagnose-text">Get Started</div>
    </div>
    <div class="form-inner-wrapper">
      <div class="form-home-header">
        <div class="home-header-text">Please select your category<span class="image-wrapper"><img src="<?php echo $static_path; ?>/advance/img/form-arrow.png" alt=""></span></div>
        <span class="close-button"><span>&#10006;</span></span>
      </div>
      <div class="form-choice-wrapper">
          <?php if(is_array($service_list) || $service_list instanceof \think\Collection || $service_list instanceof \think\Paginator): $i = 0; $__LIST__ = $service_list;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$sl): $mod = ($i % 2 );++$i;if(in_array(($sl['id']), explode(',',"1"))): ?>
           <button type="button" class="btn btn-medical <?php echo $sl['pc_style']; ?>"><?php echo $sl['typeename']; ?></button>
          <?php endif; endforeach; endif; else: echo "" ;endif; ?>

      </div>
      <div class="form-wrapper">
        <div class="form-feedback-wrapper">
          <div class="form-feedback">
            <p>Thank You</p>
            <p>We will contact you shortly.</p>
            <button class="btn form-feedback-btn">Return to Main Page</button>
            <p><span><img src="<?php echo $static_path; ?>/advance/img/logo.png" alt=""></span></p>
          </div>
        </div>
        <div class="medical-form-header">
          <div class="close-button form-close-button"><span>&#10006;</span></div>
          <div class="form-step-indicator clearfix"><!--
              --><div><span>Patient information</span></div><!--
              --><div><span>Applicant information</span></div><!--
              --><div><span>Description</span></div><!--
          --></div>
        </div>
          <form autocomplete="off" class="medical-form form-horizontal" role="form" method="post" >
          <input type="hidden" id="form-type" name="case_type" value="">
          <div class="form-section">
            <div class="form-group">
              <label for="patient-name" class="col-xs-4 col-sm-3 control-label medical-label">Patient Name</label>
              <div class="col-xs-8 col-sm-9">
                <input type="text" class="form-control" id="patient-name" name="username">
              </div>
            </div>
            <div class="form-group date-select">
              <label for="birth-date" class="col-xs-4 col-sm-3 control-label medical-label">Date of Birth</label>
              <div class="col-xs-8 col-sm-9">
                <input type="text" class="form-control" id="patient-birth" name="birthday" data-field="date" readonly="">
                <div class="box-container"><div id="dtBox"></div></div>
              </div>
            </div>
            <div class="form-group">
              <label for="patient-gender" class="col-xs-4 col-sm-3 control-label medical-label">Gender</label>
              <div class="col-xs-8 col-sm-9">
                <div class="col-xs-6 col-sm-4 gender-single">
                  <label for="patient-gender1"><input type="radio" name="sex" id="patient-gender1" value="1"><span>Male</span></label>
                </div>
                <div class="col-xs-6 col-sm-4 gender-single">
                  <label for="patient-gender2"><input type="radio" name="sex" id="patient-gender2" value="0"><span>Female</span></label>
                </div>
                <div class="col-xs-12 gender-error"></div>
              </div>
            </div>
          </div>
          <div class="form-section">
           <div class="form-group">
              <label for="" class="col-xs-6 col-sm-4 control-label medical-label">Are you the patient</label>
              <div class="col-xs-6 col-sm-8 relation-between">
                <div class="col-xs-6 col-sm-6 relation-single">
                  <label for="is-patient-self1"><input type="radio" name="isme" id="is-patient-self1" value="1" checked><span>Yes</span></label>
                </div>
                <div class="col-xs-6 col-sm-6 relation-single">
                  <label for="is-patient-self2"><input type="radio" name="isme" id="is-patient-self2" value="0"><span>No</span></label>
                </div>
              </div>
            </div>
            <div class="form-group">
              <label for="other-relation" class="col-xs-5 col-sm-4 control-label medical-label">Your relation to the patient</label>
              <div class="col-xs-7 col-sm-8">
                <select id="other-relation" disabled="" name="relationship" class="not-mandatory">
                  <option value=""></option>
                  <option value="parents">parents</option>
                <option value="child">child</option>
                <option value="spouse">spouse</option>
                <option value="other">other</option>
                </select>
              </div>
            </div>
            <div class="form-group">
              <label for="applicant-name" class="col-xs-5 col-sm-4 control-label medical-label">Name of applicant</label>
              <div class="col-xs-7 col-sm-8">
                <input type="text" class="form-control" id="applicant-name" name="applicant_name">
              </div>
            </div>
            
            <div class="form-group">
              <label for="country" class="col-xs-5 col-sm-4 control-label medical-label">Country</label>
              <div class="col-xs-7 col-sm-8">
                <select id="country" name="country" >
                  <?php if(is_array($country_list) || $country_list instanceof \think\Collection || $country_list instanceof \think\Paginator): $i = 0; $__LIST__ = $country_list;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$cl): $mod = ($i % 2 );++$i;if($cl['value'] == 3): ?>
                    <option  value="<?php echo $cl['value']; ?>" ><?php echo $cl['name']; ?></option>
                    <?php endif; endforeach; endif; else: echo "" ;endif; ?>
                </select>
              </div>
            </div>

            <div class="form-group">
              <label for="country" class="col-xs-5 col-sm-4 control-label medical-label">Province</label>
              <div class="col-xs-7 col-sm-8">
                  <input type="text" class="form-control" id="e_province" name="e_province">
              </div>
            </div>
           <div class="form-group">
              <label for="user-address" class="col-xs-5 col-sm-4 control-label medical-label"><span class="has-width">Residence Address</span></label>
              <div class="col-xs-7 col-sm-8">
                <div class="col-xs-4 col-sm-4 address-choose">
                  <select id="province" name="province">
                      <option value="0">Province</option>
                       <?php if(is_array($area) || $area instanceof \think\Collection || $area instanceof \think\Paginator): $i = 0; $__LIST__ = $area;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?>
                         <option  value="<?php echo $vo['id']; ?>" ><?php echo $vo['area_name']; ?></option>
                         <?php endforeach; endif; else: echo "" ;endif; ?>
                  </select>
                </div>
                <div class="col-xs-4 col-sm-4 address-choose">
                  <select id="city" name="city">
                      <option value="0">City</option>
                  
                  </select>
                </div>
                <div class="col-xs-4 col-sm-4 address-choose">
                  <select id="district" name="district">
                      <option value="0">District</option>
                  
                  </select>
                </div>
                <div class="col-xs-12 col-sm-12 address-details">
                  <input type="text" class="form-control" id="address-details" name="address" placeholder="Detailed address">
                </div>
              </div>
            </div>
            <div class="form-group" >
              <label for="user-zip" class="col-xs-5 col-sm-4 control-label medical-label"><span class="has-width">Postal Code</span></label>
              <div class="col-xs-7 col-sm-8">
                <input type="text" class="form-control" id="zip_code" name="zip_code">
              </div>
            </div>
            <div class="form-group">
              <label for="user-first-phone" class="col-xs-5 col-sm-4 control-label medical-label"><span class="has-width">Preferred Telephone Number</span></label>
              <div class="col-xs-7 col-sm-8">
                <input type="text" class="form-control" id="user-first-phone" name="preferred_phone">
              </div>
            </div>
            <div class="form-group">
              <label for="user-second-phone" class="col-xs-5 col-sm-4 control-label medical-label"><span class="has-width">Alternative Telephone Number</span></label>
              <div class="col-xs-7 col-sm-8">
                <input type="text" class="form-control" id="user-second-phone" name="standby_phone">
              </div>
            </div>
            <div class="form-group">
              <label for="user-email" class="col-xs-5 col-sm-4 control-label medical-label"><span class="has-width">Email</span></label>
              <div class="col-xs-7 col-sm-8">
                <input type="text" class="form-control" id="user-email" name="email">
              </div>
            </div>
            <div class="form-group">
              <label for="user-time" class="col-xs-5 col-sm-4 col-md-4 col-lg-4 control-label medical-label special-label">Convenient Time to be Contacted
</label>
              <div class="col-sm-8 col-md-8 col-lg-8 user-time">
                <div class="user-time-wrapper">
                  <div class="time-wrapper"><div class="time-inner-wrapper"><label><input type="checkbox" name="preferred_time" value="9am-12am"><span>9am-12am</span></label></div><div class="time-inner-wrapper"><label><input type="checkbox" name="preferred_time" value="12am-3pm"><span>12am-3pm</span></label></div></div>
                  <div class="time-wrapper"><div class="time-inner-wrapper"><label><input type="checkbox" name="preferred_time" value="3pm-6pm"><span>3pm-6pm</span></label></div><div class="time-inner-wrapper"><label><input type="checkbox" name="preferred_time" value="6pm-9pm"><span>6pm-9pm</span></label></div></div>
                </div>
                <div class="user-time-error"></div>
              </div>
            </div>
          </div>
          <div class="form-section">
            <div class="form-group">
              <label class="col-xs-12 col-sm-12 control-label medical-label change-label">Please briefly describe your diagnosis and questions</label>
            </div>
            <div class="form-group">
              <div class="col-xs-12 col-sm-12">
                <textarea class="info-details" name="illness"></textarea>
              </div>
            </div>
            <a href="javascript:;" class="a-upload">
                <input type="file" name="upload_file" id="upload_file">Upload my medical history
            </a><span id="upload_result"></span>
            <p>File only supports a single JPG, PDF, JPEG, PNG, DOC, ZIP format. For multiple files please compress and ZIP files. Maximum upload size 10MB.</p>
            <div class="form-group optional-checkbox">
              <div class="col-sm-12">
                <input type="checkbox" id="doctor-checkbox" name="doctor_checkbox">
                <label for="doctor-checkbox">My current treatment doctor's information (optional)</label>
              </div>
            </div>
            <div class="form-group doctor-group">
              <label for="doctor-name" class="col-xs-5 col-sm-4 control-label medical-label">Doctor's name</label>
              <div class="col-xs-7 col-sm-8">
                <input type="text" class="form-control doctor-name doctor"  name="treatment_doctor">
              </div>
            </div>
            <div class="form-group doctor-group">
              <label for="doctor-hospital" class="col-xs-5 col-sm-4 control-label medical-label">Hospital</label>
              <div class="col-xs-7 col-sm-8">
                <input type="text" class="form-control doctor-hospital doctor"  name="treatment_hospital">
              </div>
            </div>
            <div class="form-group doctor-group">
              <label for="doctor-major" class="col-xs-5 col-sm-4 control-label medical-label">Specialist</label>
              <div class="col-xs-7 col-sm-8">
                <input type="text" class="form-control doctor-major doctor"  name="specialty">
              </div>
            </div>
          </div>
          <div class="checkbox-wrapper">
            <div class="form-group">
              <div class="col-sm-12">
                <input type="checkbox" id="contract-checkbox" name="contract-checkbox" checked="">
                <label for="contract-checkbox"> I have read and accepted the</label><span class="contract-click">&nbsp;terms and conditions</span>
              </div>
            </div>
          </div>
          <div class="contract-check-error"></div>
          <div class="form-navigation clearfix">
            <button type="button" class="back-to-home btn btn-navigate pull-left">Back</button>
            <button type="button" class="previous btn btn-navigate pull-left">Prev</button>
            <button type="button" class="next btn btn-navigate pull-right">Next</button>
            <input type="submit" value="Submit" class="btn btn-navigate pull-right submit-btn">
          </div>
        </form>
      </div>
    </div>
  </div>
  <div class="contract-context">
    <div class="contract-header">
      <span>Terms and Conditions</span><span class="contract-close-button"><i class="fa fa-times"></i></span>
    </div>
    <div class="contract-para" id="contract-para">
      <div class="para-outter-wrapper"><p>The information provided above is true. I understand the services of the Global  Expert Medical Opinion program and agree to  terms below:</p></div>
      <div class="para-outter-wrapper"><span>1、</span><p>All the personal and medical data, referred to as "CONFIDENTIAL INFORMATION" contained in this enrollment agreement, or provided to ADVANCE MEDICAL/ALLIANZ MALAYSIA in any manner, in relation to your case, will be used with the only purpose of delivering the service required and may be shared with relevant experts and medical institutions when needed.
      </p></div>
      <div class="para-outter-wrapper"><span>2、</span><p>Your data will be anonymized, to protect your privacy. Your data will be used in a proper and secured manner.
      </p></div>
      <div class="para-outter-wrapper"><span>3、</span><p>You hereby accept that ALLIANZ Maylasia or its authorized partner, ADVANCE MEDICAL and its employees, will contact you in order to obtain necessary information to provide you with the service requested.
      </p></div>
      <div class="para-outter-wrapper"><span>4、</span><p>You hereby agree to provide all relevant personal and medical data and you grant ADVANCE MEDICAL permission to use and disclose this information as described to fulfill the service requested. 
      </p></div>
      <div class="para-outter-wrapper"><span>5、</span><p>The Personal Health Advisor rendering the advisory services indicated above will not examine you in person or have any information beyond what you provide. The services delivered to you is not a medical diagnosis, nor does it involve any form of treatment. The information contained in the Expert Medical Opinion Report provides alternative perspectives and shall not be used as a substitute for your physician’s recommendations. 
      </p></div>
      <div class="para-outter-wrapper"><span>6、</span><p>After receiving the report, your decisions and judgment regarding further medical decisions are based on your own judgement. ALLIANZ MALAYSIA/ADVANCE MEDICAL services are unbiased and hence not responsible for the consequences of any personal decisions.
      </p></div>
    </div>
  </div>
   
    
  <script type="text/javascript" src="<?php echo $static_path; ?>/advance/js/vendor/jquery-1.12.0.min.js?_=<?php echo $site_version; ?>"></script>
  <script type="text/javascript" src="<?php echo $static_path; ?>/advance/js/vendor/jquery.validate.min.js?_=<?php echo $site_version; ?>"></script>
  <script type="text/javascript" src="<?php echo $static_path; ?>/advance/js/vendor/jquery.flexslider.js?_=<?php echo $site_version; ?>"></script>
  <script type="text/javascript" src="<?php echo $static_path; ?>/advance/js/vendor/jquery.city.select.min.js?_=<?php echo $site_version; ?>"></script>
  <script type="text/javascript" src="<?php echo $static_path; ?>/advance/js/vendor/perfect-scrollbar.min.js?_=<?php echo $site_version; ?>"></script>
  <script type="text/javascript" src="<?php echo $static_path; ?>/advance/js/vendor/perfect-scrollbar.jquery.min.js?_=<?php echo $site_version; ?>"></script>
  <script type="text/javascript" src="<?php echo $static_path; ?>/advance/js/vendor/DateTimePicker.min.js?_=<?php echo $site_version; ?>"></script>
  <!--[if lt IE 9]>
   <script type="text/javascript" src="<?php echo $static_path; ?>/advance/js/vendor/DateTimePicker-ltie9.min.js"></script>
  <![endif]-->
  <script type="text/javascript" src="<?php echo $static_path; ?>/advance/js/vendor/DatetimePicker-i18n-zh-CN.js?_=<?php echo $site_version; ?>"></script> 
 
  <script type="text/javascript" src="<?php echo $static_path; ?>/advance/js/main.js?_=<?php echo $site_version; ?>"></script>
  <script type="text/javascript" src="<?php echo $static_path; ?>/advance/js/forms.js?_=<?php echo $site_version; ?>"></script>

 
  <script type="text/javascript">
      window.__addurl__='<?php echo url('Index/addCase'); ?>';
      window.__loginurl__='<?php echo url('Login/index'); ?>';
    $(function(){
        


        function isChina(){
             var country_val=$("select[name='country']").val();
             if(country_val!=1){
                 $("#province").hide();
                 $("#city").hide();
                 $("#district").hide();
                 $("#zip_code").parent().parent().hide();
                 $("#e_province").parent().parent().show();
             }else{
                 $("#province").show();
                 $("#city").show();
                 $("#district").show();
                 $("#zip_code").parent().parent().show();
                 $("#e_province").parent().parent().hide();
             }
         }
            

    isChina();

      $("select[name='country']").change(function(){
          
            isChina();
      });
  
      
      function getcity(id){
          		var current_province_id=id;
                  
		
		$.ajax({
			url:"<?php echo url('@module/cases/Interfaces/getCity'); ?>",
			data:{ParentId:current_province_id},
			dataType:'json',
			type:'post',
                        async: false,
			success:function(re){
				var html='<option value="0">Please choose</option>';
                                $("[name='district']").html(html);
				var item=re.data;
				for(var i in item){
					html +='<option value="'+item[i]['id']+'" >'+item[i]['area_name']+'</option>';
				}
				$("[name='city']").html(html);
                                
			}
		})
      }
      
      
      function getdistrict(id){
          		var current_city=id;
		$.ajax({
			url:"<?php echo url('@module/cases/Interfaces/getDistrict'); ?>",
			data:{ParentId:current_city},
			dataType:'json',
			type:'post',
			success:function(re){
				var html='<option value="0">Please choose</option>';
				var item=re.data;
				for(var i in item){
					html +='<option value="'+item[i]['id']+'" >'+item[i]['area_name']+'</option>';
				}
				$("[name='district']").html(html);
			}
		})
      }
      	$("[name='province']").change(function(){
		$("[name='city']").html('<option value="0">Please choose</option>');
                getcity($(this).val());
                $("[name='district']").val();
	})
	$("[name='city']").change(function(){
		$("[name='district']").html('<option value="0">Please choose</option>');

                getdistrict($(this).val());
	})
	var pro_id=$("[name='province']").val();
        if(pro_id>0){
            $("[name='city']").html('<option value="0">Please choose</option>');
            getcity($("[name='province']").val());
            $("[name='district']").html('<option value="0">Please choose</option>');
            getdistrict($("[name='province']").val());
        }


});

$.each($('.logvilad'),function(i){
     $(this).click(function(){
         $.ajax({
			url:"<?php echo url('@module/cases/Interfaces/valid_login'); ?>",
                      
			dataType:'json',
			type:'post',
			success:function(re){
				if(re.msg==0){
                                    window.location.href='<?php echo url('Login/index'); ?>';
                                }
			},
                        error:function(){
                            window.location.href='<?php echo url('Login/index'); ?>';
                        }
		})
     })
     
 })
// 上传文件
	$('#upload_file').on('change', function(){
		
		var uploadFile = $(this).get(0).files[0];
		
		if(typeof uploadFile == 'undefined'){
			return false;
		}
		
		var formData = new FormData();
		
		formData.append('upload_file', uploadFile);
		var ajaxOption = {
			url 	: '<?php echo url("emo/Upload/upload"); ?>',
			type	: 'post',
			data	: formData,
			dataType: 'json',
			timeout	: 0,
			processData : false,
			contentType : false,
			success	: function(res){
				
				if(res.code == 1){
					$('#upload_result').html('<span >['+res.data.hash+'.'+res.data.ext+']</span>');
				       $('#upload_file').before('<input type="hidden" value="'+res.data.url+'" name="options"/>');
				}else{
					$('#upload_result').html('<span >['+res.msg+']</span>');
				}
			},
			error : function(xhr){
				
				$('#upload_result').html('<span >[Network error]</span>');
			}
		};
		$.ajax(ajaxOption);
	});
       
</script>
  
</body>
</html>


