var app = {
    language: "en",
    edit: function() { $("[data-edittype]").click(function(a) { a.stopPropagation();
            app.showPanel($(this)); return !1 }) },
    showPanel: function(a) {
        function h() { a.attr("href", c.val()).attr("data-href-" + app.language, c.val()).attr("data-text-" + app.language, b.val()).text(b.val());
            app.closePanel() }

        function p() { a.attr("href", c.val()).attr("data-href-" + app.language, c.val());
            a.find("img").attr("src", d.val()).attr("data-src-" + app.language, d.val());
            app.closePanel() }

        function q() {
            a.attr("src", d.val()).attr("data-src-" +
                app.language, d.val());
            app.closePanel()
        }

        function r() { b.val() ? a.html(b.val()).attr("data-text-" + app.language, b.val()) : confirm("Are you sure to remove this row? can not undo!") && a.html(b.val()).attr("data-text-" + app.language, b.val());
            app.closePanel() } app.resetPanel();
        this.language = $(".language").val();
        var t = a.attr("data-edittype"),
            e = $(".editPanelWrap .panel-heading span"),
            k = $(".edit-link"),
            c = k.find("input"),
            f = $(".edit-imglink"),
            d = f.find("input");
        $(".edit-imglink");
        f.find("input");
        var l = $(".edit-para"),
            b = l.find("textarea"),
            g = $(".edit-ok").unbind("click"),
            m = a.attr("data-text-" + this.language) || a.attr("data-fixtext-" + this.language),
            n = a.attr("data-href-" + this.language),
            u = a.find("img").attr("data-src-" + this.language),
            v = a.attr("data-src-" + this.language);
        switch (t) {
            case "textlink":
                e.text("Edit link");
                c.val(n);
                b.val(m);
                k.show();
                l.show();
                g.bind("click", h);
                break;
            case "imglink":
                e.text("Edit link");
                c.val(n);
                d.val(u);
                k.show();
                f.show();
                g.bind("click", p);
                break;
            case "img":
                e.text("Edit image");
                d.val(v);
                f.show();
                g.bind("click", q);
                break;
            case "para":
                e.text("Edit Paragragh"), b.val(m), l.show(), g.bind("click", r)
        }
        $(".editPanelWrap").show()
    },
    closePanel: function() { $(".editPanelWrap").fadeOut() },
    resetPanel: function() { $(".editor-row").hide();
        $(".editPanelWrap *").val("") },
    createEmail: function() {
        function a() {
            var a = $("#email-content-wrap").clone();
            a.find("*").each(function() { $(this).removeAttr("data-edittype data-text-cn data-text-en data-href-cn data-href-en data-src-cn data-src-en") });
            a = a.html();
            return ('<!DOCTYPE html><html><head lang="en"><meta content="width=device-width,initial-scale=1.0,maximum-scale=1.0,user-scalable=no" name="viewport"><meta charset="UTF-8"><title></title></head><body>' +
                a + "</body></html>").replace(/ data-edittype="textlink"/g, "").replace(/ data-edittype="imglink"/g, "").replace(/ data-edittype="para"/g, "")
        }
        var h = this.language;
        this.language = "en";
        this.toggleLanguage();
        $(".result-panel .result-en").text(a());
        this.language = "cn";
        this.toggleLanguage();
        $(".result-panel .result-cn").text(a());
        $(".result-panel").fadeIn();
        this.language = h;
        this.toggleLanguage()
    },
    initLanguageData: function() {
        $('[data-edittype="textlink"]').each(function() {
            $(this).attr({
                "data-href-cn": $(this).attr("href"),
                "data-href-en": $(this).attr("href")
            });
            $(this).attr("data-text-cn") || $(this).attr({ "data-text-cn": $(this).text() });
            $(this).attr("data-text-en") || $(this).attr({ "data-text-en": $(this).text() })
        });
        $('[data-edittype="imglink"]').each(function() { $(this).attr({ "data-href-cn": $(this).attr("href"), "data-href-en": $(this).attr("href") });
            $(this).find("img").attr({ "data-src-cn": $(this).find("img").prop("src"), "data-src-en": $(this).find("img").prop("src") }) });
        $('[data-edittype="img"]').each(function() {
            $(this).attr({
                "data-src-cn": $(this).prop("src"),
                "data-src-en": $(this).prop("src")
            })
        });
        $('[data-edittype="para"]').each(function() { $(this).attr("data-text-cn") || $(this).attr({ "data-text-cn": $(this).text() });
            $(this).attr("data-text-en") || $(this).attr({ "data-text-en": $(this).text() }) });
        $("[data-fixtext-en]").each(function() { $(this).text($(this).attr("data-fixtext-en")) })
    },
    toggleLanguage: function() {
        var a = this.language;
        $('[data-edittype="textlink"]').each(function() {
            $(this).attr("href", $(this).attr("data-href-" + a));
            $(this).text($(this).attr("data-text-" +
                a))
        });
        $('[data-edittype="textlink"]').each(function() { $(this).attr("href", $(this).attr("data-href-" + a)).find("img").attr("src", $(this).attr("data-src-" + a)) });
        $('[data-edittype="img"]').each(function() { $(this).attr("src", $(this).attr("data-src-" + a)) });
        $('[data-edittype="para"]').each(function() { $(this).text($(this).attr("data-text-" + a)) });
        $("[data-fixtext-en]").each(function() { $(this).attr("data-text-" + a) || $(this).text($(this).attr("data-fixtext-" + a)) })
    },
    // init: function() {
    //     $("body").prepend('\x3c!--topbar--\x3e<div class="wf-editor-header"><div class="wf-editor-header-bd"><select class="select language" style="margin-right: 10px;"><option value="en">English</option><option value="cn">Chinese</option></select><div class="btn btn-normal resetEmail">Reset</div>&nbsp;&nbsp;<div class="btn btn-success createEmail">Create</div><div class="cb"></div></div></div>\x3c!--topbar end--\x3e');
    //     app.initLanguageData();
    //     app.edit();
    //     $(".createEmail").on("click", app.createEmail.bind(this));
    //     $(".resetEmail").on("click", function() { confirm("reset email template? this will lose all current content.") && location.reload() });
    //     $(".edit-cancel, .edit-close").on("click", app.closePanel);
    //     $("html").keydown(function(a) { 27 == a.keyCode && app.closePanel() });
    //     $(".language").on("change", function() { app.language = $(".language").val();
    //         app.toggleLanguage() });
    //     $(".result-panel textarea").on("click", function() { $(this).focus().select() });
    //     $(".result-panel .btn-success, .result-panel .btn-default, .result-panel .close").on("click", function() { $(".result-panel").fadeOut() })
    // }
};
$(function() { app.init() });