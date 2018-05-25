<?php if (!defined('THINK_PATH')) exit(); /*a:1:{s:60:"D:\www\mlxyadmin\application\dcp\view\index\mobile_form.html";i:1517472451;}*/ ?>
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

  <link rel="stylesheet" type="text/css" href="<?php echo $static_path; ?>/advance/bower_components/bootstrap/dist/css/bootstrap.min.css">
  <link rel="stylesheet" type="text/css" href="<?php echo $static_path; ?>/advance/css/font-awesome.min.css">
  <link rel="stylesheet" type="text/css" href="<?php echo $static_path; ?>/advance/css/perfect-scrollbar.min.css">
  <link rel="stylesheet" type="text/css" href="<?php echo $static_path; ?>/advance/css/DateTimePicker.css">
  <!--[if lt IE 9]>
  <link rel="stylesheet" type="text/css" href="<?php echo $static_path; ?>/advance/css/DateTimePicker-ltie9.min.css">
  <![endif]-->
  <link rel="stylesheet" type="text/css" href="<?php echo $static_path; ?>/advance/css/app.css">
  <link rel="stylesheet" type="text/css" href="<?php echo $static_path; ?>/advance/css/m_form.css">
</head>
<body>
  <div id="page-wrapper">
    <div class="form-wrapper">
      <div class="mobile-form-logo-header">
        <a class="logo-wrapper visible-xs clearfix" href="<?php echo url('/Allianz/DCP'); ?>">
          <span class="logo1"><img src="<?php echo $static_path; ?>/advance/img/logo.png" alt=""></span>
          <span class="logo2 visible-xs"><?php echo $minedata['user_name']; ?></span>
        </a>
        <a class="login-wrapper visible-xs clearfix" href="<?php echo url('login/logout'); ?>"><span class="formlogout">Log out</span></a>
      </div>
      <div class="m-form-step-indicator clearfix"><div><span>Patient information</span></div><div><span>Applicant information</span></div><div><span>Description</span></div></div>
      <form class="medical-form  form-horizontal" role="form">
        <input type="hidden" id="form-type" name="case_type" value="<?php echo $service_id; ?>">
        <div class="form-section current">
          <div class="form-group">
            <label for="patient-name" class="col-xs-4 col-sm-3 control-label medical-label">First name</label>
            <div class="col-xs-8 col-sm-9">
              <input type="text" class="form-control" id="firstname" name="firstname">
            </div>
          </div>
          <div class="form-group">
            <label for="patient-name" class="col-xs-4 col-sm-3 control-label medical-label">Last name</label>
            <div class="col-xs-8 col-sm-9">
              <input type="text" class="form-control" id="lastname" name="lastname">
            </div>
          </div>
          <div class="form-group date-select">
            <label for="birth-date" class="col-xs-4 col-sm-3 control-label medical-label">Date of birth</label>
            <div class="col-xs-8 col-sm-9">
              <input type="text" class="form-control" id="patient-birth" name="birthday" data-field="date" readonly="">
              <div class="box-container"><div id="dtBox"></div></div>
            </div>
          </div>
          <div class="form-group">
            <label for="patient-gender" class="col-xs-4 col-sm-3 control-label medical-label">Gender</label>
            <div class="col-xs-8 col-sm-9">
              <div class="col-xs-6 col-sm-4 gender-single">
                <label for="patient-gender1"><input type="radio" name="sex" id="patient-gender1" value="1" checked><span>Male</span></label>
              </div>
              <div class="col-xs-6 col-sm-4 gender-single">
                <label for="patient-gender2"><input type="radio" name="sex" id="patient-gender2" value="0"><span>Female</span></label>
              </div>
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
            <label for="other-relation" class="col-xs-5 col-sm-4 control-label medical-label">Your relation to the patient
</label>
            <div class="col-xs-7 col-sm-8">
              <div class="select-wrapper"><select id="other-relation" disabled="" name="relationship" class="not-mandatory">
                
                <option value="parents">parents</option>
                <option value="child">child</option>
                <option value="spouse">spouse</option>
                <option value="other">other</option>
              </select>
              </div>
            </div>
          </div>
          <div class="form-group">
            <label for="applicant-name" class="col-xs-5 col-sm-4 control-label medical-label">Name of Applicant</label>
            <div class="col-xs-7 col-sm-8">
              <input type="text" class="form-control" id="applicant-name" name="applicant_name">
            </div>
          </div>
          
            <div class="form-group">
              <label for="country" class="col-xs-5 col-sm-4 control-label medical-label">Country</label>
              <div class="col-xs-7 col-sm-8">
                <select id="country" name="country">
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
<!--                 <div class="col-xs-4 col-sm-4 address-choose">
                    <div class="select-wrapper">
                  <select id="province" name="province">
                      <option value="">Province</option>
                       <?php if(is_array($area) || $area instanceof \think\Collection || $area instanceof \think\Paginator): $i = 0; $__LIST__ = $area;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?>
                         <option  value="<?php echo $vo['id']; ?>" ><?php echo $vo['area_name']; ?></option>
                         <?php endforeach; endif; else: echo "" ;endif; ?>
                  </select>
                    </div>
                </div> 
                 <div class="col-xs-4 col-sm-4 address-choose">
                    <div class="select-wrapper">
                  <select id="city" name="city">
                      <option value="">City</option>
                  
                  </select>
                    </div>
                </div> 
                 <div class="col-xs-4 col-sm-4 address-choose">
                    <div class="select-wrapper">
                  <select id="district" name="district">
                      <option value="">District</option>
                  
                  </select>
                    </div>
                </div> -->
                <div class="col-xs-12 col-sm-12 address-details">
                  <input type="text" class="form-control" id="address-details" name="address" placeholder="Detailed address">
                </div>
              </div>
            </div>
          <div class="form-group">
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
            <label for="user-time" class="col-xs-5 col-sm-6 col-md-5 col-lg-4 control-label medical-label special-label"><div class="time-grid"><span>Convenient Time to be Contacted</span></div></label>
            <div class="col-xs-7 mobile-time-trigger"><button class="btn">Selection Time</button></div>
            <div class="col-sm-6 col-md-7 col-lg-8 user-time">
              <div class="user-time-wrapper">
                  <div class="time-wrapper"><div class="time-inner-wrapper"><label><input type="checkbox" name="preferred_time" value="9am-12am"><span>9am-12am</span></label></div><div class="time-inner-wrapper"><label><input type="checkbox" name="preferred_time" value="12am-3pm"><span>12am-3pm</span></label></div></div>
                  <div class="time-wrapper"><div class="time-inner-wrapper"><label><input type="checkbox" name="preferred_time" value="3pm-6pm"><span>3pm-6pm</span></label></div><div class="time-inner-wrapper"><label><input type="checkbox" name="preferred_time" value="6pm-9pm"><span>6pm-9pm</span></label></div></div>
                  <div class="user-time-close">OK</div>
                </div>
                <div class="user-time-error"></div>
            </div>
          </div>
        </div>
        <div class="form-section">
        <div class="form-group">
          <label class="col-xs-12 col-sm-12 control-label medical-label change-label">I have already read and accept the consent terms</label>
        </div>
        <div class="form-group">
          <div class="col-xs-12 col-sm-12">
            <textarea class="info-details" name="illness"></textarea>
          </div>
        </div>
        <a href="javascript:;" class="a-uploadphone">
                <input type="file" name="upload_file" id="upload_file">Upload my medical history
                
        </a><span id="upload_result"></span>
        <p>File only supports a single JPG, PDF, JPEG, PNG, DOC, ZIP format. For multiple files please compress and ZIP files. Maximum upload size 10MB.</p>
        <div class="form-group optional-checkbox mform-group">
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
              <input type="checkbox" id="contract-checkbox" name="contract-checkbox" checked>
              <label for="contract-checkbox"> I have read and accepted the</label><span class="contract-click">&nbsp;terms and conditions</span>
            </div>
          </div>
        </div>
        <div class="contract-check-error"></div>
        <div class="form-navigation clearfix">
          <a type="button" class="back-to-home btn btn-navigate pull-left" href="<?php echo url('/Allianz/DCP'); ?>">Return</a>
          <button type="button" class="previous btn btn-navigate pull-left"> Prev </button>
          <button type="button" class="next btn btn-navigate pull-right"> Next </button>
          <input type="submit" value="Submit" class="btn btn-navigate pull-right">
        </div>
      </form>
    </div>
    <div class="form-feedback-wrapper">
      <div class="form-feedback">
        <p>Thank You</p>
        <p>We will contact you shortly.</p>
        <a class="btn form-feedback-btn" href="<?php echo url('/Allianz/DCP'); ?>">Return to Main Page</a>
        <p><span class="submit-logo-m"><img src="<?php echo $static_path; ?>/advance/img/logo.png" alt=""></span></p>
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
  </div>
      <script type="text/javascript" src="<?php echo $static_path; ?>/advance/js/vendor/jquery-1.12.0.min.js"></script>
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

// 上传文件
	$('#upload_file').on('change', function(){
		
		var uploadFile = $(this).get(0).files[0];
		
		if(typeof uploadFile == 'undefined'){
			return false;
		}
		
		var formData = new FormData();
		
		formData.append('upload_file', uploadFile);
		var ajaxOption = {
			url 	: '<?php echo url("dcp/Upload/upload"); ?>',
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
   
})
</script>

  <script type="text/javascript" src="<?php echo $static_path; ?>/advance/js/vendor/jquery.validate.min.js"></script>
  <script type="text/javascript" src="<?php echo $static_path; ?>/advance/js/vendor/jquery.flexslider.js"></script>
  <script type="text/javascript" src="<?php echo $static_path; ?>/advance/js/vendor/imagesloaded.pkgd.min.js"></script>

  <script type="text/javascript" src="<?php echo $static_path; ?>/advance/js/vendor/perfect-scrollbar.min.js"></script>
  <script type="text/javascript" src="<?php echo $static_path; ?>/advance/js/vendor/perfect-scrollbar.jquery.min.js"></script>
  <script type="text/javascript" src="<?php echo $static_path; ?>/advance/js/vendor/DateTimePicker.min.js"></script>
  <!--[if lt IE 9]>
    <script type="text/javascript" src="<?php echo $static_path; ?>/advance/js/vendor/DateTimePicker-ltie9.min.js"></script>
    <![endif]-->
    <script type="text/javascript" src="<?php echo $static_path; ?>/advance/js/vendor/DatetimePicker-i18n-zh-CN.js?v=1.0"></script> 
    <script src="<?php echo $static_path; ?>/layer_mobile/layer.js?_=<?php echo $site_version; ?>"></script>
    <script type="text/javascript" src="<?php echo $static_path; ?>/advance/js/m_form.js?v=1.0"></script>
    
  </div>
</body>
</html>
