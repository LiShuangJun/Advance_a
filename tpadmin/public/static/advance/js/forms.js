function formInitial() {
    var e = $(".diagnose");
    if (e.length > 0) {
        var t = {};
        t = e.offset();
        var r = e.width(),
        a = e.height();
        $(".form-diagnose").width(r),
        $(".form-inner-wrapper").css({
            "margin-left": r - a / 2
        }),
        $(".form-outter-wrapper").css({
            top: t.top,
            left: t.left + a / 2
        })
    }
}
function resizeForm() {
    var e = viewport().width,
    t = "block" === $(".form-outter-wrapper").css("display");
    $(".form-outter-wrapper").removeAttr("style"),
    $(".form-inner-wrapper").removeAttr("style"),
    e >= 768 ? t && (formInitial(), $(".form-outter-wrapper").css({
        left: "10%",
        display: "block"
    })) : ($(".app-mask").removeClass().addClass("app-mask").hide(), $(".form-inner-wrapper").removeClass().addClass("form-inner-wrapper"))
}
function animateShowForm() {
    formInitial(),
    $(".app-mask").show(),
    $(".form-outter-wrapper").css({
        display: "block"
    }).animate({
        left: "7.5%"
    },
    {
        duration: 400,
        easing: "easeInOutQuart"
    })
}
$(function() {
    $("body").on("click", "div.diagnose", animateShowForm),
    $(".mobile-diagnose").click(function() {
        $(".mobile-form-outter-wrapper").show()
    }),
    $(window).resize(function() {
        viewport().width >= 768 && $(".mobile-form-outter-wrapper").hide()
    }),
    $(".mobile-close-button").click(function() {
        $(".mobile-form-outter-wrapper").hide()
    }),
    $(".close-button").click(function() {
        $(".form-outter-wrapper").removeAttr("style"),
        $(".form-outter-wrapper").removeClass().addClass("form-outter-wrapper"),
        $(".form-inner-wrapper").removeAttr("style"),
        $(".form-inner-wrapper").removeClass().addClass("form-inner-wrapper"),
        $(".app-mask").removeClass().addClass("app-mask").hide(),
        $(".contract-context").removeClass().addClass("contract-context"),
        $(".contract-context").removeAttr("style"),
        $("#doctor-checkbox").attr("checked", !1),
        $(".optional-checkbox").removeAttr("style"),
        $(".doctor-group").removeAttr("style")
    }),
    $(".form-feedback-btn").click(function() {
        
        $(".close-button").trigger("click"),
        $(".form-feedback-wrapper").removeAttr("style")
        window.location.href=window.location.href;
    }),
    $(window).resize(function() {
        setTimeout(resizeForm, 0)
    })
}),
$(function() {
    function e(e) {
        r.removeClass("current").eq(e).addClass("current"),
        a.removeClass("completed").each(function(t) {
            e > t && $(this).addClass("completed")
        }),
        a.removeClass("current").eq(e).addClass("current"),
        $(".form-navigation .back-to-home").toggle(0 === e),
        $(".form-navigation .previous").toggle(e > 0);
        var t = e >= r.length - 1;
        $(".form-navigation .next").toggle(!t),
        $(".form-navigation [type=submit]").toggle(t),
        $(".checkbox-wrapper").toggle(t);
        var o = $("html, body"),
        n = $(".form-wrapper").offset().top;
        o.stop().animate({
            scrollTop: n
        },
        "1000", "easeOutCubic"),
        $(".relation-between").trigger("click")
    }
    function t() {
        return r.index(r.filter(".current"))
    }
    var r = $(".form-section"),
    a = $(".form-step-indicator span");
    $(".form-navigation .previous").click(function() {
        $(".contract-context").removeAttr("style").removeClass("show"),
        e(t() - 1)
    }),
    $(".form-navigation .next").click(function() {
        r.filter(".current").find("input, select").valid() && e(t() + 1)
    }),
    $(".form-navigation .back-to-home").click(function() {
        $(".form-inner-wrapper").removeClass().addClass("form-inner-wrapper"),
        $(".contract-context").removeClass().addClass("contract-context"),
        $("#doctor-checkbox").attr("checked", !1),
        $(".optional-checkbox").removeAttr("style"),
        $(".doctor-group").removeAttr("style"),
        $("#form-type").val(""),
        $(".app-mask").removeClass().addClass("app-mask")
    }),
    $(".btn-medical").click(function() {
        $(".form-inner-wrapper").addClass("form-show"),
        $(".change-label").text("请详细描述您的情况和需求"),
        e(0)
    }),
    $(".btn-expert").click(function() {
        $(".app-mask").addClass("expert-mask"),
        $(".form-inner-wrapper").addClass("form-show-expert"),
        $("#form-type").val(1),
        $(".optional-checkbox").css("display", "block"),
        $(".change-label").text("请简要说明您的病情，并描述你想要从医疗专家意见书中得知什么")
    }),
    $(".btn-health").click(function() {
        
        $(".optional-checkbox").css({"display":"block","color":"#0775aa"}),
        
        $(".app-mask").addClass("health-mask"),
        $(".form-inner-wrapper").addClass("form-show-health"),
        $(".contract-context").addClass("contract-context2"),
        $("#form-type").val(2)
    }),
    $(".btn-pressure").click(function() {
        $(".optional-checkbox").css({"display":"block","color":"#9d3373"}),
        
        $(".app-mask").addClass("pressure-mask"),
        $(".form-inner-wrapper").addClass("form-show-pressure"),
        $(".contract-context").addClass("contract-context3"),
        $("#form-type").val(3)
    }),
    $(".btn-resource").click(function() {
        $(".optional-checkbox").css({"display":"block","color":"#563e96"}),
        
        $(".app-mask").addClass("resource-mask"),
        $(".form-inner-wrapper").addClass("form-show-resource"),
        $(".contract-context").addClass("contract-context4"),
        $("#form-type").val(4)
    }),
    $("#dtBox").DateTimePicker({
        language: "zh-CN",
        addEventHandlers: function() {
            var e = this;
            e.settings.minDate = e.getDateTimeStringInFormat("Date", "yyyy-MM-dd", new Date(1890, 1, 1)),
            e.settings.maxDate = e.getDateTimeStringInFormat("Date", "yyyy-MM-dd", new Date)
        }
    }),
    $(".relation-between").click(function() {
        $("#is-patient-self1").is(":checked") ? ($("#other-relation").prop("disabled", !0), $("#other-relation").val("0"), $("#other-relation").addClass("not-mandatory"), $("#applicant-name").val($("#patient-name").val())) : $("#is-patient-self2").is(":checked") && ($("#other-relation").prop("disabled", !1), $("#other-relation").removeClass("not-mandatory"))
    });
//    $("#province, #city").citylist({
//        data: data,
//        id: "id",
//        children: "cities",
//        name: "name",
//        metaTag: "name"
//    }),
//    $("#province2, #city2").citylist({
//        data: data,
//        id: "id",
//        children: "cities",
//        name: "name",
//        metaTag: "name"
//    });
    var o = $(".form-wrapper");
    $(".contract-click").on("click",
    function(e) {
        var t = o.offset(),
        r = o.width(),
        a = $(".checkbox-wrapper").offset(),
        n = $(".contract-context").height();
        viewport().width > 768 && $(".contract-context").css({
            "margin-left": "-15px",
            width: r + 30 + "px",
            left: t.left + "px",
            top: a.top - 30 - n
        }),
        $(".contract-context").show().addClass("show")
    }),
    $(window).resize(function() {
        var e = $(".form-wrapper");
        if (e.length > 0) {
            var t = e.offset(),
            r = e.width(),
            a = $(".checkbox-wrapper").offset(),
            o = $(".contract-context").height();
            viewport().width > 768 && $(".contract-context").css({
                "margin-left": "-15px",
                width: r + 30 + "px",
                left: t.left + "px",
                top: a.top - 30 - o
            })
        }
    }),
    $(".contract-close-button").click(function() {
        $(".contract-context").removeClass("show"),
        $(".contract-context").removeAttr("style").hide()
    }),
    $(".optional-checkbox").click(function() {
        $("#doctor-checkbox").is(":checked") ? $(".doctor-group").css("display", "block") : $(".doctor-group").removeAttr("style")
    });
    var n = $(".input-file");
    n.each(function() {
        var e = $(this).next("label");
        $(this).on("change",
        function(t) {
            var r = $(this).val().split("\\").pop();
            r ? e.find(".file-name").html(r).css({
                display: "inline-block"
            }) : e.find(".file-name").removeAttr("style")
        })
    }),
    $("#contract-para").perfectScrollbar(),
    Ps.initialize(document.getElementById("contract-para"))
}),
$(function() {
    $(".medical-form").validate({
        rules: {
            username: {
                required: !0
            },
            birthday: {
                required: !0,
                date: !0
            },
            sex: {
                required: !0
            },
            
            applicant_name: {
                required: !0
            },
            province: {
                valueNotEquals: "0"
            },
            city: {
                valueNotEquals: "0"
            },
            district: {
                valueNotEquals: "0"
            },
            address: {
                required: !0
            },
            zip_code: {
                required: !0
            },
            preferred_phone: {
                required: !0
            },
            email: {
                required: !0,
                email: !0
            },
            preferred_time: {
                required: !0
            },
            illness: {
                required: !0
            },
            aux_file: {
                extension: "jpg|png|bmp|doc|docx|pdf|txt",
                filesize: 3e3
            },
            "contract-checkbox": {
                required: !0
            }
        },
        messages: {
            username: {
                required: "此项为必填项"
            },
            birthday: {
                required: "此项为必填项",
                date: "请填写正确的日期格式"
            },
            sex: {
                required: "此项为必填项"
            },
            
            applicant_name: {
                required: "此项为必填项"
            },
             province: {
                valueNotEquals: "此项为必填项"
            },
            city: {
                valueNotEquals: "此项为必填项"
            },
            district: {
                valueNotEquals: "此项为必填项"
            },
            address: {
                required: "此项为必填项"
            },
            zip_code: {
                required: "此项为必填项"
            },
            preferred_phone: {
                required: "此项为必填项"
            },
            email: {
                required: "此项为必填项",
                email: "请填写合法的email地址"
            },
            preferred_time: {
                required: "此项为必填项"
            },
            illness: {
                required: "此项为必填项"
            },
            aux_file: {
                extension: "文件格式不符合要求",
                filesize: "文件大小应小于3KB"
            },
            "contract-checkbox": {
                required: "请接受服务条款"
            }
        },
        errorPlacement: function(e, t) {
            if ("aux-file" == t.attr("name")) e.appendTo(".file-error");
            else if ("patient_gender" == t.attr("name")) e.appendTo(".gender-error");
            else if ("contract-checkbox" == t.attr("name")) e.appendTo(".contract-check-error");
            else {
                if ("user_time" != t.attr("name")) return ! 1;
                e.appendTo(".user-time-error")
            }
        }
    }),
    $.validator.addMethod("valueNotEquals",
    function(e, t, r) {
        return $(t).hasClass("not-mandatory") ? !0 : r != e
    }),
    $.validator.addMethod("extension",
    function(e, t, r) {
        return r = "string" == typeof r ? r.replace(/,/g, "|") : "png|jpe?g|gif",
        this.optional(t) || e.match(new RegExp("\\.(" + r + ")$", "i"))
    }),
    $.validator.addMethod("filesize",
    function(e, t, r) {
        return this.optional(t) || t.files[0].size <= r
    })
}),
$(function() {
    $(".medical-form").submit(function(e) {
        if (e.preventDefault(), !$(".contract-context").hasClass("show") && $(".medical-form").valid()) {
            $(".medical-form").find("input[type=submit]").prop("disabled", !0),
            $(".medical-form").find("input[type=submit]").val("提交中...");
            for (var t = $(".medical-form").serializeArray(), r = [], a = t.length - 1; a >= 0; a--)"user_time" == t[a].name && (r.push(t[a].value), t.splice(a, 1));
            console.log(r),
            t.push({
                name: "user_time",
                value: r.join(",")
            });
            
            $.ajax({
                url: window.__addurl__,
                type: "POST",
                data: $.param(t),
                success: function(data) {
                    
                    if(data.code==1){
                         $(".form-feedback-wrapper").show()
                    }else{
                        if(data.msg.error==2){
                            window.location.href=window.__loginurl__;
                        }else{
                            alert(data.msg.msg);
                        }
                        
                      
                    }
                   
                },
                complete: function() {
                    $(".medical-form").find("input[type=submit]").prop("disabled", !1),
                    $(".medical-form").find("input[type=submit]").val("提交")
                }
            }),
            console.log($.param(t))
        }
    })
});