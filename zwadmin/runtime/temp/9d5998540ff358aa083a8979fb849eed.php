<?php if (!defined('THINK_PATH')) exit(); /*a:4:{s:56:"D:\www\zwadmin\application\advance\view\index\index.html";i:1511331742;s:56:"D:\www\zwadmin\application\advance\view\common\base.html";i:1511767701;s:58:"D:\www\zwadmin\application\advance\view\common\header.html";i:1500345938;s:58:"D:\www\zwadmin\application\advance\view\common\footer.html";i:1511767678;}*/ ?>
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
<body class="loading">

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
      <a class="logo-wrapper" href="<?php echo url('/am'); ?>">
        <span class="logo1"><img src="<?php echo $static_path; ?>/advance/img/logo.png" alt=""></span>
      </a>
        <?php if($userid != 0): ?>
      <a class="login-wrapper" href="<?php echo url('Login/logout'); ?>"><?php echo mb_substr($minedata['user_name'],0,4,'utf-8'); ?>,退出</a>
       <?php else: ?>
        <a class="login-wrapper" href="<?php echo url('Login/index'); ?>">登录</a>
       <?php endif; ?>
      <ul class="menu-wrapper clearfix">
         <?php if(is_array($service_list) || $service_list instanceof \think\Collection || $service_list instanceof \think\Paginator): $i = 0; $__LIST__ = $service_list;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$sl): $mod = ($i % 2 );++$i;?>
         <li class="menubar menubar-<?php echo $sl['id']; ?>"><a href="<?php echo url('/services/'.$sl['id']); ?>"><span class="bar-background"></span><span class="bar-text"><?php echo $sl['typename']; ?></span><span class="bottom-gradient"></span></a><span class="right-gradient"></span></li>
        <?php endforeach; endif; else: echo "" ;endif; ?>

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
          <div class="diagnose-text">一键咨询</div>
        </div>
        <div class="flex-phone-wrapper">
          <span>400&#45;920&#45;2069</span>
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
      <div class="diagnose-text">一键咨询</div>
    </div>


<div class="feature-container clearfix">
      <div class="feature-wrapper">
        <div class="image-wrapper">
          <img src="<?php echo $static_path; ?>/advance/img/111.jpg" alt="">
        </div>
        <div class="feature-desc feature-desc-1">
          <div class="feature-desc-inner-wrapper">
          <h3><span>国际权威专家意见</span></h3>
          <ul>
            <li><a href="<?php echo url('/services/1'); ?>#diagnose"><span class="feature-text">诊疗意见<span class="feature-icon"><i class="fa fa-angle-right"></i></span></span></a></li>
            <li><a href="<?php echo url('/services/1'); ?>#foreign"><span class="feature-text">海外治疗<span class="feature-icon"><i class="fa fa-angle-right"></i></span></span></a></li>
          </ul>
          </div>
        </div>
      </div>
      <div class="feature-wrapper">
        <div class="image-wrapper">
          <img src="<?php echo $static_path; ?>/advance/img/222.jpg" alt="">
        </div>
        <div class="feature-desc feature-desc-2">
          <div class="feature-desc-inner-wrapper">
          <h3><span>慢病管理</span></h3>
          <ul>
            <li><a href="<?php echo url('/services/2'); ?>#pressure"><span class="feature-text"><span class="special-text">专属心理和职业教练疏导</span><span class="feature-icon"><i class="fa fa-angle-right"></i></span></span></a></li>
          </ul>
        </div>
        </div>
      </div>
      <div class="feature-wrapper">
        <div class="image-wrapper">
          <img src="<?php echo $static_path; ?>/advance/img/333.jpg" alt="">
        </div>
        <div class="feature-desc feature-desc-3">
          <div class="feature-desc-inner-wrapper">
          <h3><span>体检报告专业解读</span></h3>
          <ul>
            <li><a href="<?php echo url('/services/3'); ?>#statistics"><span class="feature-text">体检数据解读<span class="feature-icon"><i class="fa fa-angle-right"></i></span></span></a></li>
            <li><a href="<?php echo url('/services/3'); ?>#subhealth"><span class="feature-text">亚健康/慢病管理<span class="feature-icon"><i class="fa fa-angle-right"></i></span></span></a></li>
          </ul>
        </div>
        </div>
      </div>
      <div class="feature-wrapper">
        <div class="image-wrapper">
          <img src="<?php echo $static_path; ?>/advance/img/444.jpg" alt="">
        </div>
        <div class="feature-desc feature-desc-4">
          <div class="feature-desc-inner-wrapper">
          <h3><span>医疗资源安排</span></h3>
          <ul>
            <li><a href="<?php echo url('/services/4'); ?>#resource"><span class="feature-text"><span class="special-text">医生推荐和医疗机构导航</span><span class="feature-icon"><i class="fa fa-angle-right"></i></span></span></a></li>
          </ul>
        </div>
        </div>
      </div>
    </div>


<div class="bottom-nav-wrapper clearfix">
      <ul class="bottom-nav">
        <li><a href="<?php echo url('/services/1'); ?>#diagnose">诊疗意见</a></li>
        <li><a href="<?php echo url('/services/1'); ?>#foreign">海外治疗</a></li>
        <li><a href="<?php echo url('/services/2'); ?>#pressure" class="special-text">专属心理和职业教练疏导</a></li>
        <li><a href="<?php echo url('/services/3'); ?>#statistics">体检数据解读</a></li>
        <li><a href="<?php echo url('/services/3'); ?>#subhealth" class="special-text">亚健康/慢病管理</a></li>
        <li><a href="<?php echo url('/services/4'); ?>#resource" class="special-text">医生推荐和医疗机构导航</a></li>
      </ul>
    </div>
    <div class="medical-footer">
      <div class="medical-footer-text">汇医健康顾问门户网站所提供的服务旨在向用户提供医疗咨询。在任何情况下，这些咨询服务仅应被视为医疗咨询的建议。而这些医疗咨询的建议是根据客户提供的医疗信息所做出的，并不能取代专业医疗机构的医疗诊断。</div>
    </div>
  </div>
  <div class="app-mask">
  </div>
    <!--弹出-->
  <div class="mobile-form-outter-wrapper">
    <div class="mobile-form-wrapper">
      <div class="mobile-form-home-header">
          <div class="mobile-home-header-text">选择咨询类别</div>
          <span class="mobile-close-button"><span>&#10006;</span></span>
      </div>
      <div class="m-form-choice-wrapper">
        
        <?php if(is_array($service_list) || $service_list instanceof \think\Collection || $service_list instanceof \think\Paginator): $i = 0; $__LIST__ = $service_list;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$sl): $mod = ($i % 2 );++$i;?>
                <a type="button" class="btn m-btn-medical <?php echo $sl['mobile_style']; ?>" href="<?php echo url('/mobile_form/'.$sl['id']); ?><?php echo $sl['m_id_name']; ?>"><?php echo $sl['typename']; ?></a>
        <?php endforeach; endif; else: echo "" ;endif; ?>

      </div>
    </div>
  </div>
    <!--登录-->
  <div class="form-outter-wrapper">
    <div class="form-diagnose">
      <div class="image-wrapper"><img src="<?php echo $static_path; ?>/advance/img/diagnose.png" alt=""></div>
      <div class="form-diagnose-text">一键咨询</div>
    </div>
    <div class="form-inner-wrapper">
      <div class="form-home-header">
        <div class="home-header-text">请先选择您的问诊类别<span class="image-wrapper"><img src="<?php echo $static_path; ?>/advance/img/form-arrow.png" alt=""></span></div>
        <span class="close-button"><span>&#10006;</span></span>
      </div>
      <div class="form-choice-wrapper">
          <?php if(is_array($service_list) || $service_list instanceof \think\Collection || $service_list instanceof \think\Paginator): $i = 0; $__LIST__ = $service_list;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$sl): $mod = ($i % 2 );++$i;?>
           <button type="button" class="btn btn-medical <?php echo $sl['pc_style']; ?>"><?php echo $sl['typename']; ?></button>
          <?php endforeach; endif; else: echo "" ;endif; ?>

      </div>
      <div class="form-wrapper">
        <div class="form-feedback-wrapper">
          <div class="form-feedback">
            <p>递交成功，我们将会尽快联系您。</p>
            <button class="btn form-feedback-btn">我知道了</button>
          </div>
        </div>
        <div class="medical-form-header">
          <div class="close-button form-close-button"><span>&#10006;</span></div>
          <div class="form-step-indicator clearfix"><!--
              --><div><span>患者信息</span></div><!--
              --><div><span>申请人信息</span></div><!--
              --><div><span>描述信息</span></div><!--
          --></div>
        </div>
          <form autocomplete="off" class="medical-form form-horizontal" role="form" method="post" >
          <input type="hidden" id="form-type" name="case_type" value="">
          <div class="form-section">
            <div class="form-group">
              <label for="patient-name" class="col-xs-4 col-sm-3 control-label medical-label">患者姓名</label>
              <div class="col-xs-8 col-sm-9">
                <input type="text" class="form-control" id="patient-name" name="username">
              </div>
            </div>
            <div class="form-group date-select">
              <label for="birth-date" class="col-xs-4 col-sm-3 control-label medical-label">出生日期</label>
              <div class="col-xs-8 col-sm-9">
                <input type="text" class="form-control" id="patient-birth" name="birthday" data-field="date" readonly="">
                <div class="box-container"><div id="dtBox"></div></div>
              </div>
            </div>
            <div class="form-group">
              <label for="patient-gender" class="col-xs-4 col-sm-3 control-label medical-label">患者性别</label>
              <div class="col-xs-8 col-sm-9">
                <div class="col-xs-6 col-sm-4 gender-single">
                  <label for="patient-gender1"><input type="radio" name="sex" id="patient-gender1" value="1"><span>男</span></label>
                </div>
                <div class="col-xs-6 col-sm-4 gender-single">
                  <label for="patient-gender2"><input type="radio" name="sex" id="patient-gender2" value="0"><span>女</span></label>
                </div>
                <div class="col-xs-12 gender-error"></div>
              </div>
            </div>
          </div>
          <div class="form-section">
           <div class="form-group">
              <label for="" class="col-xs-6 col-sm-4 control-label medical-label">是否为患者本人</label>
              <div class="col-xs-6 col-sm-8 relation-between">
                <div class="col-xs-6 col-sm-6 relation-single">
                  <label for="is-patient-self1"><input type="radio" name="isme" id="is-patient-self1" value="1" checked><span>是</span></label>
                </div>
                <div class="col-xs-6 col-sm-6 relation-single">
                  <label for="is-patient-self2"><input type="radio" name="isme" id="is-patient-self2" value="0"><span>否</span></label>
                </div>
              </div>
            </div>
            <div class="form-group">
              <label for="other-relation" class="col-xs-5 col-sm-4 control-label medical-label">与患者关系</label>
              <div class="col-xs-7 col-sm-8">
                <select id="other-relation" disabled="" name="relationship" class="not-mandatory">
                  <option value=""></option>
                  <option value="父母">父母</option>
                  <option value="子女">子女</option>
                  <option value="配偶">配偶</option>
                  <option value="其他">其他</option>
                </select>
              </div>
            </div>
            <div class="form-group">
              <label for="applicant-name" class="col-xs-5 col-sm-4 control-label medical-label">申请人姓名</label>
              <div class="col-xs-7 col-sm-8">
                <input type="text" class="form-control" id="applicant-name" name="applicant_name">
              </div>
            </div>
              <div class="form-group">
              <label for="country" class="col-xs-5 col-sm-4 control-label medical-label">国家</label>
              <div class="col-xs-7 col-sm-8">
                <select id="country" name="country" >
                  <?php if(is_array($country_list) || $country_list instanceof \think\Collection || $country_list instanceof \think\Paginator): $i = 0; $__LIST__ = $country_list;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$cl): $mod = ($i % 2 );++$i;?>
                    <option  value="<?php echo $cl['value']; ?>" ><?php echo $cl['name']; ?></option>
                  <?php endforeach; endif; else: echo "" ;endif; ?>
                </select>
              </div>
            </div>
              <div class="form-group">
              <label for="country" class="col-xs-5 col-sm-4 control-label medical-label">省(州)</label>
              <div class="col-xs-7 col-sm-8">
                  <input type="text" class="form-control" id="e_province" name="e_province">
              </div>
            </div>
            <div class="form-group">
              <label for="user-address" class="col-xs-5 col-sm-4 control-label medical-label"><span class="has-width">地址</span></label>
              <div class="col-xs-7 col-sm-8">
                <div class="col-xs-4 col-sm-4 address-choose">
                  <select id="province" name="province">
                      <option value="0">省</option>
                       <?php if(is_array($area) || $area instanceof \think\Collection || $area instanceof \think\Paginator): $i = 0; $__LIST__ = $area;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?>
                         <option  value="<?php echo $vo['id']; ?>" ><?php echo $vo['area_name']; ?></option>
                         <?php endforeach; endif; else: echo "" ;endif; ?>
                  </select>
                </div>
                <div class="col-xs-4 col-sm-4 address-choose">
                  <select id="city" name="city">
                      <option value="0">市</option>
                  
                  </select>
                </div>
                <div class="col-xs-4 col-sm-4 address-choose">
                  <select id="district" name="district">
                      <option value="0">区</option>
                  
                  </select>
                </div>
                <div class="col-xs-12 col-sm-12 address-details">
                  <input type="text" class="form-control" id="address-details" name="address" placeholder="详细地址">
                </div>
              </div>
            </div>
            <div class="form-group" >
              <label for="user-zip" class="col-xs-5 col-sm-4 control-label medical-label"><span class="has-width">邮编</span></label>
              <div class="col-xs-7 col-sm-8">
                <input type="text" class="form-control" id="zip_code" name="zip_code">
              </div>
            </div>
            <div class="form-group">
              <label for="user-first-phone" class="col-xs-5 col-sm-4 control-label medical-label"><span class="has-width">首选电话</span></label>
              <div class="col-xs-7 col-sm-8">
                <input type="text" class="form-control" id="user-first-phone" name="preferred_phone">
              </div>
            </div>
            <div class="form-group">
              <label for="user-second-phone" class="col-xs-5 col-sm-4 control-label medical-label"><span class="has-width">备用电话</span></label>
              <div class="col-xs-7 col-sm-8">
                <input type="text" class="form-control" id="user-second-phone" name="standby_phone">
              </div>
            </div>
            <div class="form-group">
              <label for="user-email" class="col-xs-5 col-sm-4 control-label medical-label"><span class="has-width"><span class="little-character">E&#45;mail</span>地址</span></label>
              <div class="col-xs-7 col-sm-8">
                <input type="text" class="form-control" id="user-email" name="email">
              </div>
            </div>
            <div class="form-group">
              <label for="user-time" class="col-xs-5 col-sm-4 col-md-4 col-lg-4 control-label medical-label special-label"><div class="time-grid"><span>接听电话</span><span>优选时间</span></div><div>&#40;可多选&#41;</div></label>
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
              <label class="col-xs-12 col-sm-12 control-label medical-label change-label">请详细描述您的情况和需求</label>
            </div>
            <div class="form-group">
              <div class="col-xs-12 col-sm-12">
                <textarea class="info-details" name="illness"></textarea>
              </div>
            </div>
            <a href="javascript:;" class="a-upload">
                <input type="file" name="upload_file" id="upload_file">点击上传文件
            </a><span id="upload_result"></span>
            <p>文件仅支持单个JPG,PDF,JPEG,PNG,DOC,ZIP格式,多个文件请压缩ZIP上传,最大上传大小为10M</p>
            <div class="form-group optional-checkbox">
              <div class="col-sm-12">
                <input type="checkbox" id="doctor-checkbox" name="doctor_checkbox">
                <label for="doctor-checkbox">我当前的治疗医生的信息（选填）</label>
              </div>
            </div>
            <div class="form-group doctor-group">
              <label for="doctor-name" class="col-xs-5 col-sm-4 control-label medical-label">医生姓名</label>
              <div class="col-xs-7 col-sm-8">
                <input type="text" class="form-control doctor-name doctor"  name="treatment_doctor">
              </div>
            </div>
            <div class="form-group doctor-group">
              <label for="doctor-hospital" class="col-xs-5 col-sm-4 control-label medical-label">医院</label>
              <div class="col-xs-7 col-sm-8">
                <input type="text" class="form-control doctor-hospital doctor"  name="treatment_hospital">
              </div>
            </div>
            <div class="form-group doctor-group">
              <label for="doctor-major" class="col-xs-5 col-sm-4 control-label medical-label">专科</label>
              <div class="col-xs-7 col-sm-8">
                <input type="text" class="form-control doctor-major doctor"  name="specialty">
              </div>
            </div>
          </div>
          <div class="checkbox-wrapper">
            <div class="form-group">
              <div class="col-sm-12">
                <input type="checkbox" id="contract-checkbox" name="contract-checkbox" checked="">
                <label for="contract-checkbox">我已阅读并接受</label><span class="contract-click">授权协议</span>
              </div>
            </div>
          </div>
          <div class="contract-check-error"></div>
          <div class="form-navigation clearfix">
            <button type="button" class="back-to-home btn btn-navigate pull-left">返回</button>
            <button type="button" class="previous btn btn-navigate pull-left">上一步</button>
            <button type="button" class="next btn btn-navigate pull-right">下一步</button>
            <input type="submit" value="提交" class="btn btn-navigate pull-right submit-btn">
          </div>
        </form>
      </div>
    </div>
  </div>
  <div class="contract-context">
    <div class="contract-header">
      <span>授权协议</span><span class="contract-close-button"><i class="fa fa-times"></i></span>
    </div>
    <div class="contract-para" id="contract-para">
      <div class="para-outter-wrapper"><p>在开始医疗专家意见书服务之前，您必须阅读，理解并同意以下条款和条件。</p></div>
      <div class="para-outter-wrapper"><span>1、</span><p>您在此授权您的治疗医师和其他医疗服务提供者将所有相关的个人和医疗数据披露给高级医疗公司，用于获得第二个意见，并授予高级医疗公司，许可其按在我们的隐私声明中所描述方式使用和披露这一信息。如果需要，您将为每个医师或其他医疗服务提供者签署单独的授权表，允许他们与我们分享保护的健康信息。您同意，您提供给我们的信息尽您所知将是准确和完整的。您有责任确保所有相关资料已提供给高级医疗公司。</p></div>
      <div class="para-outter-wrapper"><span>2、</span><p>该报告是关于您的案件的医疗专家的意见，这基于您提供给我们的，以及我们经您许可，从您的医生获得的医疗信息。润色医疗专家意见报告的医生，不会获得亲自为您检查，订购额外的测试，或者获取超出您所提供的信息之外的任何信息的利益。由于医学专家将没有亲自检查您，或订购额外的测试，它不属于医疗诊断。通过医疗专家意见书项目的医学专家，不会并不能仅基于我们收到的信息，为您的医疗负责。医疗决策应在亲自检查和诊断测试之后做出，如您的检查和病史所示。该报告旨在为您提供信息来补充您已经从您的治疗医生那里获得的信息。医疗专家意见报告中包含的信息不得用于替代您的医生的建议。您应该与自己的、负责您的医疗的医生讨论此报告。</p></div>
      <div class="para-outter-wrapper"><span>3、</span><p>您确认，您的健康保险可能不包括建议在医疗专家意见报告中推荐的特定测试或治疗，因为涵盖范围取决于您的健康保险条款。高级医疗公司和医疗专家不会为您的健康保险决定健康福利涵盖范围的决定。请参考您的保险公司，以核实涵盖范围和预授权处理。</p></div>
      <div class="para-outter-wrapper"><span>4、</span><p>为了给您进行服务，高级医疗公司将从您和您的医疗服务提供者收集您的医疗信息，并转交给我们在美国的办公室，或其他的高级医疗公司办公室。可应要求提供涉及您的案件中涉及的个人和国家的详细信息。</p></div>
      <div class="para-outter-wrapper"><span>5、</span><p>如果申请人不是病人或病人的代表，我们需要患者的书面授权，才能披露其任何医疗或个人识别数据。 </p></div>
      <div class="para-outter-wrapper"><p>本人保证上述信息尽我所知是准确的。我已阅读并理解了上述信息，并同意这些条款。</p></div>
      <div class="para-outter-wrapper"><p>我保证医疗专家意见书的参与者是公司的员工，或其合格的配偶，或公司的员工的家庭伴侣，或公司员工的有资格的、受抚养的子女。</p></div>
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
				var html='<option value="0">请选择</option>';
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
				var html='<option value="0">请选择</option>';
				var item=re.data;
				for(var i in item){
					html +='<option value="'+item[i]['id']+'" >'+item[i]['area_name']+'</option>';
				}
				$("[name='district']").html(html);
			}
		})
      }
      	$("[name='province']").change(function(){
		$("[name='city']").html('<option value="0">请选择</option>');
                getcity($(this).val());
                $("[name='district']").val();
	})
	$("[name='city']").change(function(){
		$("[name='district']").html('<option value="0">请选择</option>');

                getdistrict($(this).val());
	})
	var pro_id=$("[name='province']").val();
        if(pro_id>0){
            $("[name='city']").html('<option value="0">请选择</option>');
            getcity($("[name='province']").val());
            $("[name='district']").html('<option value="0">请选择</option>');
            getdistrict($("[name='province']").val());
        }


});
 $.each($('.logvilad'),function(i){
     $(this).click(function(){
         if(<?php echo $userid; ?>==0){
             window.location.href='<?php echo url('Login/index'); ?>';
         }
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
			url 	: '<?php echo url("advance/Upload/upload"); ?>',
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
				
				$('#upload_result').html('<span >[网络链接错误]</span>');
			}
		};
		$.ajax(ajaxOption);
	});
</script>
  
</body>
</html>


