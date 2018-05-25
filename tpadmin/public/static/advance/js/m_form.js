$(function() {
    function e(e) {
        a.removeClass("current").eq(e).addClass("current"),
        i.removeClass("completed").each(function(t) {
            e > t && $(this).addClass("completed")
        }),
        i.removeClass("current").eq(e).addClass("current"),
        $(".form-navigation .back-to-home").toggle(0 === e),
        $(".form-navigation .previous").toggle(e > 0);
        var t = e >= a.length - 1;
        $(".form-navigation .next").toggle(!t),
        $(".form-navigation [type=submit]").toggle(t),
        $(".checkbox-wrapper").toggle(t),
        $(".relation-between").trigger("click")
    }
    function t() {
        return a.index(a.filter(".current"))
    }
    var a = $(".form-section"),
    i = $(".m-form-step-indicator span");
    e(0),
    $(".form-navigation .previous").click(function() {
        e(t() - 1)
    }),
    $(".form-navigation .next").click(function() {
        a.filter(".current").find("input, select").valid() && e(t() + 1)
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
 
    $(".contract-click").on("click",
    function(e) {
        $(".contract-context").show()
    }),
    $(".contract-close-button").click(function() {
        $(".contract-context").hide()
    }),
    $(".mobile-time-trigger").click(function(e) {
        e.preventDefault(),
        e.stopPropagation(),
        $(".user-time").show()
    }),
    $(".user-time-close").click(function(e) {
        var t = [];
        if ($(".user-time-wrapper").find('input[type="checkbox"]').filter(":checked").each(function() {
            t.push($(this).val())
        }), console.log(t), t.length > 0) var a = t.join(", ");
        else var a = "选择时间";
        $(".mobile-time-trigger").find("button").html(a),
        $(".user-time").hide()
    });
    var r = $(".input-file");
    r.each(function() {
        var e = $(this).next("label");
        $(this).on("change",
        function(t) {
            var a = $(this).val().split("\\").pop();
            a ? e.find(".file-name").html(a).css({
                display: "inline-block"
            }) : e.find(".file-name").removeAttr("style")
        })
    }),
    $("#contract-para").perfectScrollbar(),
    Ps.initialize(document.getElementById("contract-para"))
}),
$(function() {
    if (window.location.hash) {
        var e = window.location.hash.substr(1);
        "pressure" === e ? ($(".m-form-step-indicator").addClass("m-form-step-indicator2"), $(".medical-form").addClass("medical-form2"), $(".contract-context").addClass("contract-context2"), $("#form-type").val(2), $(".form-feedback-wrapper").addClass("form-feedback-wrapper2"),$(".optional-checkbox").css({"display":"block","color":"#0775aa"})) : "private" === e ? ($(".m-form-step-indicator").addClass("m-form-step-indicator3"), $(".medical-form").addClass("medical-form3"), $(".contract-context").addClass("contract-context3"), $("#form-type").val(3), $(".form-feedback-wrapper").addClass("form-feedback-wrapper3"),$(".optional-checkbox").css({"display":"block","color":"#9d3373"})) : "medical" === e && ($(".m-form-step-indicator").addClass("m-form-step-indicator4"), $(".medical-form").addClass("medical-form4"), $(".contract-context").addClass("contract-context4"), $("#form-type").val(4), $(".form-feedback-wrapper").addClass("form-feedback-wrapper4"), $(".optional-checkbox").css({"display":"block","color":"#563e96"}))
    }
    $(".optional-checkbox").css("display", "block"),
    $(".change-label").text("请简要说明您的病情，并描述你想要从医疗专家意见书中得知什么");
    $(".optional-checkbox").click(function() {
        $("#doctor-checkbox").is(":checked") ? $(".doctor-group").css("display", "block") : $(".doctor-group").removeAttr("style")
    })
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
    function(e, t, a) {
        return $(t).hasClass("not-mandatory") ? !0 : a != e
    }),
    $.validator.addMethod("extension",
    function(e, t, a) {
        return a = "string" == typeof a ? a.replace(/,/g, "|") : "png|jpe?g|gif",
        this.optional(t) || e.match(new RegExp("\\.(" + a + ")$", "i"))
    }),
    $.validator.addMethod("filesize",
    function(e, t, a) {
        return this.optional(t) || t.files[0].size <= a
    })
}),
$(function() {
    $(".medical-form").submit(function(e) {
        e.preventDefault(),
        !$(".medical-form").valid()
    })
}),
$(function() {
    $(".medical-form").submit(function(e) {
        if (e.preventDefault(), $(".medical-form").valid()) {
            $(".medical-form").find("input[type=submit]").prop("disabled", !0),
            $(".medical-form").find("input[type=submit]").val("提交中...");
            for (var t = $(".medical-form").serializeArray(), a = [], i = t.length - 1; i >= 0; i--)"user_time" == t[i].name && (a.push(t[i].value), t.splice(i, 1));
            console.log(a),
            t.push({
                name: "user_time",
                value: a.join(",")
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