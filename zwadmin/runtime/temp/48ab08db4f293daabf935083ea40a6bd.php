<?php if (!defined('THINK_PATH')) exit(); /*a:1:{s:62:"D:\www\zwadmin\application\advance\view\index\mobile_form.html";i:1522141512;}*/ ?>
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
      <div class="mobile-form-logo-header"><a class="logo-wrapper" href="<?php echo url('/am'); ?>"><span class="logo1"><img src="<?php echo $static_path; ?>/advance/img/logo.png" alt=""></span></a></div>
      <div class="m-form-step-indicator clearfix"><div><span>患者信息</span></div><div><span>申请人信息</span></div><div><span>描述信息</span></div></div>
      <form class="medical-form  form-horizontal" role="form">
        <input type="hidden" id="form-type" name="case_type" value="<?php echo $service_id; ?>">
        <div class="form-section current">
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
                <label for="patient-gender1"><input type="radio" name="sex" id="patient-gender1" value="1" checked><span>男</span></label>
              </div>
              <div class="col-xs-6 col-sm-4 gender-single">
                <label for="patient-gender2"><input type="radio" name="sex" id="patient-gender2" value="0"><span>女</span></label>
              </div>
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
              <div class="select-wrapper"><select id="other-relation" disabled="" name="relationship" class="not-mandatory">
                
                <option value="父母">父母</option>
                <option value="子女">子女</option>
                <option value="配偶">配偶</option>
                <option value="其他">其他</option>
              </select>
              </div>
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
                    <div class="select-wrapper">
                  <select id="province" name="province">
                      <option value="">省</option>
                       <?php if(is_array($area) || $area instanceof \think\Collection || $area instanceof \think\Paginator): $i = 0; $__LIST__ = $area;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?>
                         <option  value="<?php echo $vo['id']; ?>" ><?php echo $vo['area_name']; ?></option>
                         <?php endforeach; endif; else: echo "" ;endif; ?>
                  </select>
                    </div>
                </div>
                <div class="col-xs-4 col-sm-4 address-choose">
                    <div class="select-wrapper">
                  <select id="city" name="city">
                      <option value="">市</option>
                  
                  </select>
                    </div>
                </div>
                <div class="col-xs-4 col-sm-4 address-choose">
                    <div class="select-wrapper">
                  <select id="district" name="district">
                      <option value="">区</option>
                  
                  </select>
                    </div>
                </div>
                <div class="col-xs-12 col-sm-12 address-details">
                  <input type="text" class="form-control" id="address-details" name="address" placeholder="详细地址">
                </div>
              </div>
            </div>

          <div class="form-group">
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
            <label for="user-time" class="col-xs-5 col-sm-6 col-md-5 col-lg-4 control-label medical-label special-label"><div class="time-grid"><span>接听电话</span><span>优选时间</span></div><div>&#40;可多选&#41;</div></label>
            <div class="col-xs-7 mobile-time-trigger"><button class="btn">选择时间</button></div>
            <div class="col-sm-6 col-md-7 col-lg-8 user-time">
              <div class="user-time-wrapper">
                  <div class="time-wrapper"><div class="time-inner-wrapper"><label><input type="checkbox" name="preferred_time" value="9am-12am"><span>9am-12am</span></label></div><div class="time-inner-wrapper"><label><input type="checkbox" name="preferred_time" value="12am-3pm"><span>12am-3pm</span></label></div></div>
                  <div class="time-wrapper"><div class="time-inner-wrapper"><label><input type="checkbox" name="preferred_time" value="3pm-6pm"><span>3pm-6pm</span></label></div><div class="time-inner-wrapper"><label><input type="checkbox" name="preferred_time" value="6pm-9pm"><span>6pm-9pm</span></label></div></div>
                  <div class="user-time-close">确定</div>
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
        <a href="javascript:;" class="a-uploadphone">
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
              <input type="checkbox" id="contract-checkbox" name="contract-checkbox" checked>
              <label for="contract-checkbox">我已阅读并接受</label><span class="contract-click">授权协议</span>
            </div>
          </div>
        </div>
        <div class="contract-check-error"></div>
        <div class="form-navigation clearfix">
          <a type="button" class="back-to-home btn btn-navigate pull-left" href="<?php echo url('/am'); ?>">返回</a>
          <button type="button" class="previous btn btn-navigate pull-left">上一步</button>
          <button type="button" class="next btn btn-navigate pull-right">下一步</button>
          <input type="submit" value="提交" class="btn btn-navigate pull-right">
        </div>
      </form>
    </div>
    <div class="form-feedback-wrapper">
      <div class="form-feedback">
        <p>感谢！我们将尽快与您联系。</p>
        <a class="btn form-feedback-btn" href="<?php echo url('/am'); ?>">我知道了</a>
      </div>
    </div>
    <div class="contract-context">
      <div class="contract-header">
        <span>授权协议</span><span class="contract-close-button"><i class="fa fa-times"></i></span>
      </div>
      <div class="contract-para" id="contract-para">
        <div class="para-outter-wrapper"><p>本人在上文提供的信息是真实的。本人了解专家医疗意见计划的服务内容并同意以下条款：</p></div>
        <div class="para-outter-wrapper"><span>1、</span><p>本登记协议中所包含的，或以任何方式提供给中德安联/汇医的并且与案例相关的所有个人和医疗信息（称为“保密信息”）都仅将用于提供所需服务之唯一目的，且可能在必要时与相关医疗专家和医疗机构分享。</p></div>
        <div class="para-outter-wrapper"><span>2、</span><p>您的信息将被匿名，以保护您的隐私。我们将确保您信息的安全并适当使用。</p></div>
        <div class="para-outter-wrapper"><span>3、</span><p>您在此接受中德安联或其授权合作伙伴汇医及其员工与您联系，获取必要的信息来提供您所要求的服务</p></div>
        <div class="para-outter-wrapper"><span>4、</span><p>您在此同意提供所有相关的个人资料和医疗信息，并且同意汇医按照上述方式使用和披露此信息以提供所需提供的服务。</p></div>
        <div class="para-outter-wrapper"><span>5、</span><p>提供上述咨询服务的专案医生将不会亲自对您进行检查或提供您所提供信息以外的任何信息。汇医不提供任何形式的医学诊断和治疗。“专家医疗意见报告”中提供的其他医学观点不可用于替代您主治医生的建议。 </p></div>
        <div class="para-outter-wrapper"><p>在接收到意见报告之后，由您自行做出下一步的医疗决策和选择。汇医/中德安联所提供的医疗服务客观公正，因此不对您的主观意志和决定及其后果负责。</p></div>
        <div class="para-outter-wrapper"><p>请接受服务条款</p></div>
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
    <script type="text/javascript" src="<?php echo $static_path; ?>/advance/js/vendor/DatetimePicker-i18n-zh-CN.js"></script>
    <script type="text/javascript" src="<?php echo $static_path; ?>/advance/js/m_form.js"></script>
    
  </div>
</body>
</html>
