$(function() {
  var $sections = $('.form-section');
  var $indicators = $('.m-form-step-indicator span');
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
  }

  navigateTo(0);

  function curIndex() {
    return $sections.index($sections.filter('.current'));
  }

  $('.form-navigation .previous').click(function() {
    navigateTo(curIndex() - 1);
  });

  $('.form-navigation .next').click(function() {
    if ($sections.filter('.current').find('input, select').valid()) {
      navigateTo(curIndex() + 1);
    }
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

  $('.contract-click').on('click', function(e) {
    $('.contract-context').show(); 
  });

  $('.contract-close-button').click(function() {
    $('.contract-context').hide();
  });

  $('.mobile-time-trigger').click(function(e) {
    e.preventDefault();
    e.stopPropagation();
    $('.user-time').show();
  });

  $('.user-time-close').click(function(e) {
    $('.user-time').hide();
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
    })
  });

  $('#contract-para').perfectScrollbar();
  Ps.initialize(document.getElementById('contract-para'))
});


$(function() {
  if (window.location.hash) {
    var hash_val = window.location.hash.substr(1);
    if (hash_val === 'pressure') {
      $('.m-form-step-indicator').addClass('m-form-step-indicator2');
      $('.medical-form').addClass('medical-form2');
      $('.contract-context').addClass('contract-context2');
      $('#form-type').val(2);
      $('.form-feedback-wrapper').addClass('form-feedback-wrapper2');
    }
    else if (hash_val === 'private') {
      $('.m-form-step-indicator').addClass('m-form-step-indicator3');
      $('.medical-form').addClass('medical-form3');
      $('.contract-context').addClass('contract-context3');
      $('#form-type').val(3);
      $('.form-feedback-wrapper').addClass('form-feedback-wrapper3');
    }
    else if (hash_val === 'medical') {
      $('.m-form-step-indicator').addClass('m-form-step-indicator4');
      $('.medical-form').addClass('medical-form4');
      $('.contract-context').addClass('contract-context4');
      $('#form-type').val(4);
      $('.form-feedback-wrapper').addClass('form-feedback-wrapper4');
    }
  }
  else {
    $('.optional-checkbox').css('display', 'block');
    $('.change-label').text('请简要说明您的病情，并描述你想要从医疗专家意见书中得知什么');
  }

  $('.optional-checkbox').click(function() {
    if($('#doctor-checkbox').is(':checked')) {
      $('.doctor-group').css('display', 'block');
    } else {
      $('.doctor-group').removeAttr('style');
    }
  });

  
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
      province: {
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
      province: {
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
    if (!$('.medical-form').valid()) {
      return;
    }
  });
});

$(function() {
  $('.medical-form').submit(function(event) {
    event.preventDefault();
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
