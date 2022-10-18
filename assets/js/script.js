!(function (n) {
  "use strict";
  function l(e, a) {
    (this.ACTIVE_CLASS = "open"),
      (this.init = function () {
        var a = this;
        e.on("click", ".popup-overlay, .button-close-popup", function (e) {
          e.preventDefault(), e.stopPropagation(), a.close();
        });
      }),
      (this.open = function () {
        n(".wecoder-popup").EdumallPopup("close"),
          e.addClass(this.ACTIVE_CLASS);
      }),
      (this.close = function () {
        e.removeClass(this.ACTIVE_CLASS);
      });
  }
  n.fn.EdumallPopup = function (e) {
    var a,
      t,
      o,
      s = "string" == typeof e ? e : void 0;
    return s
      ? ((a = []),
        this.each(function () {
          var e = n(this).data("EdumallPopup");
          a.push(e);
        }),
        (t =
          1 < arguments.length
            ? Array.prototype.slice.call(arguments, 1)
            : void 0),
        (o = []),
        this.each(function (e) {
          var e = a[e];
          if (!e)
            return (
              console.warn("$.EdumallPopup not instantiated yet"),
              console.info(this),
              void o.push(void 0)
            );
          "function" == typeof e[s]
            ? ((e = e[s].apply(e, t)), o.push(e))
            : console.warn("Method '" + s + "' not defined in $.EdumallPopup");
        }),
        1 < o.length ? o : o[0])
      : this.each(function () {
          var e = n(this),
            a = new l(e);
          e.data("EdumallPopup", a), a.init();
        });
  };
})(jQuery),
  (function (l) {
    "use strict";
    l(document).ready(function () {
      var e = $edumallLogin.validatorMessages,
        e =
          (jQuery.extend(jQuery.validator.messages, {
            required: e.required,
            remote: e.remote,
            email: e.email,
            url: e.url,
            date: e.date,
            dateISO: e.dateISO,
            number: e.number,
            digits: e.digits,
            creditcard: e.creditcard,
            equalTo: e.equalTo,
            accept: e.accept,
            maxlength: jQuery.validator.format(e.maxlength),
            minlength: jQuery.validator.format(e.minlength),
            rangelength: jQuery.validator.format(e.rangelength),
            range: jQuery.validator.format(e.range),
            max: jQuery.validator.format(e.max),
            min: jQuery.validator.format(e.min),
          }),
          l("body")),
        t = l("#popup-pre-loader"),
        a = l("#popup-user-login"),
        o = l("#popup-user-register"),
        s = l("#popup-user-lost-password");

      // 1st time popup open and login functionality
      function n() {
        a.hasClass("popup-loaded")
          ? a.EdumallPopup("open")
          : l.ajax({
              url: wc_registration_popup.ajaxurl,
              type: "GET",
              cache: !1,
              dataType: "html",
              data: {
                action: "edumall_lazy_load_template",
                template: a.data("template"),
              },
              success: function (e) {
                a.find(".popup-content-wrap").html(e),
                  a.addClass("popup-loaded"),
                  a.EdumallPopup("open"),
                  a.find("#wecoder-login-form").validate({
                    rules: {
                      user_login: { required: !0 },
                      password: { required: !0 },
                    },
                    submitHandler: function (e) {
                      var a = l(e);
                      //console.log("login submit", a.serialize());
                      e = a.find('button[type="submit"]');
                      if (!0 === e.attr("disabled")) return !1;
                      e.attr("disabled", !0),
                        l.ajax({
                          url: wc_registration_popup.ajaxurl,
                          type: "POST",
                          cache: !1,
                          dataType: "json",
                          data: a.serialize(),
                          success: function (e) {
                            e.success
                              ? (a
                                  .find(".form-response-messages")
                                  .html(e.messages)
                                  .addClass("success")
                                  .show(),
                                location.reload())
                              : // "" !== e.redirect_url
                                //   ? (window.location.href = e.redirect_url)
                                //   : location.reload()

                                a
                                  .find(".form-response-messages")
                                  .html(e.messages)
                                  .addClass("error")
                                  .show();
                          },
                          beforeSend: function () {
                            a
                              .find(".form-response-messages")
                              .html("")
                              .removeClass("error success")
                              .hide(),
                              a
                                .find('button[type="submit"]')
                                .addClass("updating-icon");
                          },
                          complete: function () {
                            a.find('button[type="submit"]')
                              .removeClass("updating-icon")
                              .attr("disabled", !1);
                          },
                        });
                    },
                  });
              },
              error: function (e, a, t) {
                console.log(t);
              },
              beforeSend: function () {
                l(".wecoder-popup").EdumallPopup("close"), t.addClass("open");
              },
              complete: function () {
                t.removeClass("open");
              },
            });
      }
      // initialize
      l(".wecoder-popup").EdumallPopup(),
        e.hasClass("required-login") && !e.hasClass("logged-in") && n(),
        // popup open modal control
        e.on("click", ".open-popup-login", function (e) {
          e.preventDefault(), e.stopPropagation(), n();
        }),
        // registration popup control
        e.on("click", ".open-popup-register", function (e) {
          e.preventDefault(), e.stopPropagation();

          o.hasClass("popup-loaded")
            ? o.EdumallPopup("open")
            : l.ajax({
                url: wc_registration_popup.ajaxurl,
                type: "GET",
                cache: !1,
                dataType: "html",
                data: {
                  action: "edumall_lazy_load_template",
                  template: o.data("template"),
                },
                success: function (e) {
                  o.find(".popup-content-wrap").html(e),
                    o.addClass("popup-loaded"),
                    o.EdumallPopup("open"),
                    o.find("#wecoder-register-form").validate({
                      rules: {
                        firstname: { required: !0 },
                        lastname: { required: !0 },
                        username: { required: !0, minlength: 4 },
                        email: { required: !0, email: !0 },
                        password: {
                          required: !0,
                          minlength: 8,
                          maxlength: 30,
                        },
                        password2: {
                          required: !0,
                          minlength: 8,
                          maxlength: 30,
                          equalTo: "#ip_reg_password",
                        },
                      },
                      submitHandler: function (e) {
                        var a = l(e),
                          e = a.find('button[type="submit"]');
                        console.log("e", e);
                        if (!0 === e.attr("disabled")) return !1;
                        e.attr("disabled", !0),
                          l.ajax({
                            url: wc_registration_popup.ajaxurl,
                            type: "POST",
                            cache: !1,
                            dataType: "json",
                            data: a.serialize(),
                            success: function (e) {
                              e.success
                                ? (a
                                    .find(".form-response-messages")
                                    .html(e.messages)
                                    .addClass("success")
                                    .show(),
                                  location.reload())
                                : a
                                    .find(".form-response-messages")
                                    .html(e.messages)
                                    .addClass("error")
                                    .show();
                            },
                            beforeSend: function () {
                              a
                                .find(".form-response-messages")
                                .html("")
                                .removeClass("error success")
                                .hide(),
                                a
                                  .find('button[type="submit"]')
                                  .addClass("updating-icon");
                            },
                            complete: function () {
                              a.find('button[type="submit"]')
                                .removeClass("updating-icon")
                                .attr("disabled", !1);
                            },
                          });
                      },
                    });
                },
                error: function (e, a, t) {
                  console.log(t);
                },
                beforeSend: function () {
                  l(".wecoder-popup").EdumallPopup("close"), t.addClass("open");
                },
                complete: function () {
                  t.removeClass("open");
                },
              });
        }),
        // password reset popup control
        e.on("click", ".open-popup-lost-password", function (e) {
          e.preventDefault(),
            e.stopPropagation(),
            s.hasClass("popup-loaded")
              ? s.EdumallPopup("open")
              : l.ajax({
                  url: wc_registration_popup.ajaxurl,
                  type: "GET",
                  cache: !1,
                  dataType: "html",
                  data: {
                    action: "edumall_lazy_load_template",
                    template: s.data("template"),
                  },
                  success: function (e) {
                    s.find(".popup-content-wrap").html(e),
                      s.addClass("popup-loaded"),
                      s.EdumallPopup("open"),
                      s
                        .find("#edumall-lost-password-form")
                        .on("submit", function (e) {
                          e.preventDefault();
                          var a = l(this),
                            e = a.find('button[type="submit"]');
                          if (!0 === e.attr("disabled")) return !1;
                          e.attr("disabled", !0),
                            l.ajax({
                              type: "post",
                              url: wc_registration_popup.ajaxurl,
                              dataType: "json",
                              data: a.serialize(),
                              success: function (e) {
                                (e.success
                                  ? a
                                      .find(".form-response-messages")
                                      .html(e.messages)
                                      .addClass("success")
                                  : a
                                      .find(".form-response-messages")
                                      .html(e.messages)
                                      .addClass("error")
                                ).show();
                              },
                              beforeSend: function () {
                                a
                                  .find(".form-response-messages")
                                  .html("")
                                  .removeClass("error success")
                                  .hide(),
                                  a
                                    .find('button[type="submit"]')
                                    .addClass("updating-icon");
                              },
                              complete: function () {
                                a.find('button[type="submit"]')
                                  .removeClass("updating-icon")
                                  .attr("disabled", !1);
                              },
                            });
                        });
                  },
                  error: function (e, a, t) {
                    console.log(t);
                  },
                  beforeSend: function () {
                    l(".wecoder-popup").EdumallPopup("close"),
                      t.addClass("open");
                  },
                  complete: function () {
                    t.removeClass("open");
                  },
                });
        }),
        // password field show
        e.on("click", "#eye-icon", function (e) {
          e.preventDefault(), e.stopPropagation();
          var e = l(this).parent(".form-input-password"),
            a = e.children("input").attr("type", "text");
          l(this).hide(), l("#eye-off-icon").show();
        });
      e.on("click", "#eye-off-icon", function (e) {
        e.preventDefault(), e.stopPropagation();
        var e = l(this).parent(".form-input-password"),
          a = e.children("input").attr("type", "password");
        l(this).hide(), l("#eye-icon").show();
      });
    });
  })(jQuery);
