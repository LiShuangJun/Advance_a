function formInitial() {
  var $diagnose = $('.diagnose');
  if ($diagnose.length > 0) {
    var offset = {};
    offset = $diagnose.offset();
    var width = $diagnose.width();
    var height = $diagnose.height();
    $('.form-diagnose').width(width);
    $('.form-inner-wrapper').css({
      'margin-left': width - height / 2
    });
    $('.form-outter-wrapper').css({
      top: offset.top,
      left: offset.left + height / 2,
    });
  }
}

function resizeForm() {
  var w_width = viewport().width;
  var is_visible = $('.form-outter-wrapper').css('display') === 'block';
  $('.form-outter-wrapper').removeAttr('style'); 
  $('.form-inner-wrapper').removeAttr('style'); 
  if (w_width >= 768) { 
    if (is_visible) {
      formInitial();
      $('.form-outter-wrapper')
        .css({
          left: '10%',
          display: 'block'
        });
    }
  } else {
    $('.app-mask').removeClass().addClass('app-mask').hide();
    $('.form-inner-wrapper').removeClass().addClass('form-inner-wrapper');
  } 
}

function animateShowForm() {
  formInitial();
  $('.app-mask').show();
  $('.form-outter-wrapper').css({
    display: 'block'
  }).animate({
    left: '7.5%'
  }, {
    duration: 400,
    easing: 'easeInOutQuart'
  });
}

$(function() {
  $('body').on('click', 'div.diagnose', animateShowForm);

  $('.mobile-diagnose').click(function() {
    $('.mobile-form-outter-wrapper').show();
  });

  $(window).resize(function() {
    if (viewport().width >= 768) {
      $('.mobile-form-outter-wrapper').hide();
    }
  })

  $('.mobile-close-button').click(function() {
    $('.mobile-form-outter-wrapper').hide();
  });

  $('.close-button').click(function() {
    $('.form-outter-wrapper').removeAttr('style');
    $('.form-outter-wrapper').removeClass().addClass('form-outter-wrapper');
    $('.form-inner-wrapper').removeAttr('style');
    $('.form-inner-wrapper').removeClass().addClass('form-inner-wrapper');
    $('.app-mask').removeClass().addClass('app-mask').hide();
    $('.contract-context').removeClass().addClass('contract-context');
    $('.contract-context').removeAttr('style');
    $('#doctor-checkbox').attr('checked', false);
    $('.optional-checkbox').removeAttr('style');
    $('.doctor-group').removeAttr('style');
  });

  $('.form-feedback-btn').click(function() {
    $('.close-button').trigger('click');
    $('.form-feedback-wrapper').removeAttr('style');
  });

  $(window).resize(function() {
    setTimeout(resizeForm, 0); 
  });
});

$(function() {
  var $sections = $('.form-section');
  var $indicators = $('.form-step-indicator span');
  function navigateTo(index) {
    $sections
      .removeClass('current')
      .eq(index)
        .addClass('current');
    $indicators
      .removeClass('completed')
      .each(function(i) {
        if (i < index) {
          $(this).addClass('completed');
        }
      });
    $indicators
      .removeClass('current')
      .eq(index)
        .addClass('current');
    $('.form-navigation .back-to-home').toggle(index === 0);
    $('.form-navigation .previous').toggle(index > 0);
    var atTheEnd = index >= $sections.length - 1;
    $('.form-navigation .next').toggle(!atTheEnd);
    $('.form-navigation [type=submit]').toggle(atTheEnd);
    $('.checkbox-wrapper').toggle(atTheEnd);
    var body = $("html, body");
    var end = $('.form-wrapper').offset().top;
    body.stop().animate({scrollTop: end}, '1000', 'easeOutCubic');
  }

  function curIndex() {
    return $sections.index($sections.filter('.current'));
  }

  $('.form-navigation .previous').click(function() {
      $('.contract-context').removeAttr('style').removeClass('show');
      navigateTo(curIndex() - 1);
  });

  $('.form-navigation .next').click(function() {
  	if ($sections.filter('.current').find('input, select').valid()) {
      navigateTo(curIndex() + 1);
    }
  });


  $('.form-navigation .back-to-home').click(function() {
    $('.form-outter-wrapper').removeAttr('style');
    $('.form-outter-wrapper').removeClass().addClass('form-outter-wrapper');
    $('.form-inner-wrapper').removeAttr('style');
    $('.form-inner-wrapper').removeClass().addClass('form-inner-wrapper');
    $('.app-mask').removeClass().addClass('app-mask').hide();
    $('.contract-context').removeClass().addClass('contract-context');
    $('#doctor-checkbox').attr('checked', false);
    $('.optional-checkbox').removeAttr('style');
    $('.doctor-group').removeAttr('style');
  });

  $('.btn-medical').click(function() {
    $('.form-inner-wrapper').addClass('form-show');
    $('.change-label').text('请详细描述您的情况和需求');
    navigateTo(0);
  })

  $('.btn-expert').click(function() {
    $('.app-mask').addClass('expert-mask');
    $('.form-inner-wrapper').addClass('form-show-expert');
    $('#form-type').val(1);
    $('.optional-checkbox').css('display', 'block');
    $('.change-label').text('请简要说明您的病情，并描述你想要从医疗专家意见书中得知什么');
  });

  $('.btn-health').click(function() {
    $('.app-mask').addClass('health-mask');
    $('.form-inner-wrapper').addClass('form-show-health');
    $('.contract-context').addClass('contract-context2');
    $('#form-type').val(2);
  });

  $('.btn-pressure').click(function() {
    $('.app-mask').addClass('pressure-mask');
    $('.form-inner-wrapper').addClass('form-show-pressure');
    $('.contract-context').addClass('contract-context3');
    $('#form-type').val(3);
  });

  $('.btn-resource').click(function() {
    $('.app-mask').addClass('resource-mask');
    $('.form-inner-wrapper').addClass('form-show-resource');
    $('.contract-context').addClass('contract-context4');
    $('#form-type').val(4);
  });

  $('#dtBox').DateTimePicker({
    language: "zh-CN",
    addEventHandlers: function() {
      var oDTP = this;
      oDTP.settings.minDate = oDTP.getDateTimeStringInFormat("Date", "yyyy-MM-dd", new Date(1890,1,1));
      oDTP.settings.maxDate = oDTP.getDateTimeStringInFormat("Date", "yyyy-MM-dd", new Date());
    }
  });

  $('.relation-between').click(function() {
    if ($('#is-patient-self1').is(':checked')) {
      $('#other-relation').prop("disabled", true);
      $('#other-relation').val('0');
      $('#other-relation').addClass('not-mandatory');
    } else if ($('#is-patient-self2').is(':checked')) {
      $('#other-relation').prop("disabled", false);
      $('#other-relation').removeClass('not-mandatory');
    }
  });

  $('#province, #city').citylist({
    data    : data,
    id      : 'id',
    children: 'cities',
    name    : 'name',
    metaTag : 'name'
  });

  $('#province2, #city2').citylist({
    data    : data,
    id      : 'id',
    children: 'cities',
    name    : 'name',
    metaTag : 'name'
  });

  var $form_wrapper = $('.form-wrapper');
  $('.contract-click').on('click', function(e) {
    var form_offset = $form_wrapper.offset();
    var form_width =$form_wrapper.width(); 
    var check_offset = $('.checkbox-wrapper').offset();
    var contract_height = $('.contract-context').height();
    if (viewport().width > 768) {
      $('.contract-context').css({
        "margin-left": "-15px",
        "width": (form_width + 30) + "px",
        "left": form_offset.left + "px",
        "top": check_offset.top - 30 - contract_height
      });
    }
    $('.contract-context').show().addClass('show'); 
  });

  $(window).resize(function() {
    var $form_wrapper = $('.form-wrapper');
    if ($form_wrapper.length > 0) {
      var form_offset = $form_wrapper.offset();
      var form_width =$form_wrapper.width(); 
      var check_offset = $('.checkbox-wrapper').offset();
      var contract_height = $('.contract-context').height();
      if (viewport().width > 768) {
        $('.contract-context').css({
          "margin-left": "-15px",
          "width": (form_width + 30) + "px",
          "left": form_offset.left + "px",
          "top": check_offset.top - 30 - contract_height
        });
      }
    }
  });

  $('.contract-close-button').click(function() {
    $('.contract-context').removeClass('show');
    $('.contract-context').removeAttr('style').hide();
  });

  $('.optional-checkbox').click(function() {
    if($('#doctor-checkbox').is(':checked')) {
      $('.doctor-group').css('display', 'block');
    } else {
      $('.doctor-group').removeAttr('style');
    }
  });

  var $file_inputs = $('.input-file');
  $file_inputs.each(function() {
    var $file_label = $(this).next('label');

    $(this).on('change', function(e) {
      var file_name = $(this).val().split('\\').pop();
      if (file_name) {
        $file_label.find('.file-name').html(file_name).css({
          display: 'inline-block'
        });
      } else {
        $file_label.find('.file-name').removeAttr('style');
      }
    });
  });

  $('#contract-para').perfectScrollbar();
  Ps.initialize(document.getElementById('contract-para'))
}); 


$(function() {
	$(".medical-form").validate({
		rules: {
			"patient-name": {
				required: !0
			},
			"patient-birth": {
				required: !0,
				date: !0
			},
			"patient-gender": {
				required: !0
			},
			"other-relation": {
				valueNotEquals: "0"
			},
			"applicant-name": {
				required: !0
			},
			"province": {
				valueNotEquals: "省"
			},
			"address-details": {
				required: !0
			},
			"user-zip": {
				required: !0
			},
			"user-first-phone": {
				required: !0
			},
			"user-email": {
				required: !0,
				email: !0
			},
			"user-time": {
				required: !0
			},
			"aux-file": {
				extension: "jpg|png|bmp|doc|docx|pdf|txt",
				filesize: 3e3
			},
			"contract-checkbox": {
				required: !0
			}
		},
		messages: {
			"patient-name": {
				required: "此项为必填项"
			},
			"patient-birth": {
				required: "此项为必填项",
				date: "请填写正确的日期格式"
			},
			"patient-gender": {
				required: "此项为必填项"
			},
			"other-relation": {
				valueNotEquals: "此项为必填项"
			},
			"applicant-name": {
				required: "此项为必填项"
			},
			"province": {
				valueNotEquals: "此项为必填项"
			},
			"address-details": {
				required: "此项为必填项"
			},
			"user-zip": {
				required: "此项为必填项"
			},
			"user-first-phone": {
				required: "此项为必填项"
			},
			"user-email": {
				required: "此项为必填项",
				email: "请填写合法的email地址"
			},
			"user-time": {
				required: "此项为必填项"
			},
			"aux-file": {
				extension: "文件格式不符合要求",
				filesize: "文件大小应小于3KB"
			},
			"contract-checkbox": {
				required: "请接受服务条款"
			}
		},
		errorPlacement: function(e, t) {
			if ("aux-file" == t.attr("name")) e.appendTo(".file-error");
			else if ("patient-gender" == t.attr("name")) e.appendTo(".gender-error");
			else if ("contract-checkbox" == t.attr("name")) e.appendTo(".contract-check-error");
			else {
				if ("user-time" != t.attr("name")) return !1;
				e.appendTo(".user-time-error")
			}
		}
	}), $.validator.addMethod("valueNotEquals", function(e, t, r) {
    if ($(t).hasClass('not-mandatory')) {
      return true;
    } else {
      return r != e;
    }
	}), $.validator.addMethod("extension", function(e, t, r) {
		return r = "string" == typeof r ? r.replace(/,/g, "|") : "png|jpe?g|gif", this.optional(t) || e.match(new RegExp("\\.(" + r + ")$", "i"))
	}), $.validator.addMethod("filesize", function(e, t, r) {
		return this.optional(t) || t.files[0].size <= r
	})
});


$(function() {
  $('.medical-form').submit(function(event) {
    event.preventDefault();
    if ($('.contract-context').hasClass('show')) {
      return;
    }
    if (!$('.medical-form').valid()) {
      return;
    }
    $('.medical-form').find('input[type=submit]').prop('disabled', true);
    var values = $('.medical-form').serializeArray();
    var times = [];
    for (var index = values.length - 1; index >= 0; index--) {
      if (values[index].name == "user_time") {
        times.push(values[index].value);
        values.splice(index, 1);
      }
    }
    console.log(times);
    values.push({
      name: "user_time",
      value: times.join(',')
    });
    var country = '中国';
    var province = '';
    var city = '';
    var zone = '';
    var cities = ['北京', '上海', '重庆', '天津'];
    for (var index = values.length - 1; index >= 0; index--) {
      if (values[index].name == "province") {
        if (values[index].value == "海外") {
          country = values[index+1].value;
        }
        else if (cities.indexOf(values[index].value) !== -1) {
          province = values[index].value;
          city = values[index].value + '市';
          zone = values[index+1].value;
        }
        else {
          province = values[index].value;
          city = values[index+1].value;
        }
        values.splice(index, 2);
      }
    }
    values.push({
      name: 'country',
      value: country
    });
    values.push({
      name: 'province',
      value: province
    });
    values.push({
      name: 'city',
      value: city
    });
    for (var index = values.length - 1; index >= 0; index--) {
      if (values[index].name == "address_details") {
          values[index].value = zone + values[index].value;
      }
    }
    console.log(values);
    $.ajax({
      url: 'http://115.28.29.249/simple/case/save',
      type: 'POST',
      data: $.param(values),
      success: function() {
        $('.form-feedback-wrapper').show();
      },
      complete: function() {
        $('.medical-form').find('input[type=submit]').prop('disabled', false);
      }
    });
    console.log($.param(values));
  });
});