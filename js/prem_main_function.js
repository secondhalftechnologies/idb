function ToggleMyDiv(a) {
    $("#" + a).slideToggle()
}

function div_swap(a, b) {
    $("#" + a).slideDown(), $("#" + b).slideUp()
}

function changePrice(a) {
    actual_recommended_price = parseInt($("#actual_recommended_price").val()), actual_recommended_new_price = a * actual_recommended_price, $("#main_recommended_price").html(actual_recommended_new_price), actual_list_price = parseInt($("#actual_list_price").val()), 0 != actual_list_price && (actual_list_new_price = a * actual_list_price, $("#main_list_price").html(actual_list_new_price))
}

function checkBoxStyle(a) {
    chk_class = $("#" + a).attr("class"), "fa fa-check-empty" == chk_class ? $("#" + a).removeClass("fa fa-check-empty").addClass("fa fa-check") : "fa fa-check" == chk_class && $("#" + a).removeClass("fa fa-check").addClass("fa fa-check-empty")
}

function loading_show() {
    document.getElementById("lodermodal").style.display = "block", document.getElementById("loderfade").style.display = "block"
}

function loading_hide() {
    document.getElementById("lodermodal").style.display = "none", document.getElementById("loderfade").style.display = "none"
}

function changeClass(a) {
    this_class = $("#" + a).attr("class"), "fa fa-chevron-up" == this_class ? $("#" + a).removeClass("fa fa-chevron-up").addClass("fa fa-chevron-down") : "fa fa-chevron-down" == this_class && $("#" + a).removeClass("fa fa-chevron-down").addClass("fa fa-chevron-up")
}

function isNumberKey(a) {
    var b = a.which ? a.which : event.keyCode;
    return !(b > 31 && (b < 48 || b > 57))
}

function viewCart(a) {
    loading_show();
    var b = $("#cust_session").val(),
        c = {
            cust_session: b,
            cart_id: a,
            getCart: 1
        },
        d = JSON.stringify(c);
    $.ajax({
        url: base_url + "includes/main.php",
        type: "POST",
        data: d,
        contentType: "application/json; charset=utf-8",
        async: !1,
        success: function(b) {
            data = JSON.parse(b), "Success" == data.Success ? ($("#" + a).html(data.resp), $("#cart-count").html(data.count), "content" == a && 0 == data.checkout && $("#checkout-process-btn").hide(), loading_hide()) : ($("#" + a).html(data.resp), $("#checkout_btn").slideUp(), $("#cart-count").html(data.count), "content" == a && 0 == data.checkout && $("#checkout-process-btn").hide(), loading_hide())
        },
        error: function(a, b, c) {
            $("#model_body").html('<span style="style="color:#F00;">' + a.responseText + "</span>"), $("#error_model").modal("toggle"), loading_hide()
        },
        complete: function() {
            loading_hide()
        }
    })
}

function removeItem(a) {
    loading_show();
    var b = {
            cart_id: a,
            deleteFromCart: 1
        },
        c = JSON.stringify(b);
    $.ajax({
        url: base_url + "includes/main.php",
        type: "POST",
        data: c,
        contentType: "application/json; charset=utf-8",
        async: !1,
        success: function(a) {
            data = JSON.parse(a), "Success" == data.Success ? (viewCart("content"), loading_hide()) : (loading_hide(), $("#model_body").html('<span style="style="color:#F00;">' + data.resp + "</span>"), $("#error_model").modal("toggle"))
        },
        error: function(a, b, c) {
            loading_hide(), $("#model_body").html('<span style="style="color:#F00;">' + a.responseText + "</span>"), $("#error_model").modal("toggle")
        },
        complete: function() {}
    })
}

function addToCart(a) {
    loading_show();
    var b = $("#cust_session").val(),
        c = $.trim($("#user_prod_quentity" + a).val());
    "" != c && "undefined" != typeof c || (c = 1);
    var d = $("#coupon_code").val();
    if ("" == a) location.href = "https://www.planeteducate.com";
    else {
        var e = {
                addToCart: 1,
                prod_id: a,
                cust_session: b,
                user_prod_quentity: c,
                user_coupon_code: d
            },
            f = JSON.stringify(e);
        $.ajax({
            url: base_url + "includes/main.php",
            type: "POST",
            data: f,
            contentType: "application/json; charset=utf-8",
            async: !1,
            success: function(a) {
                data = JSON.parse(a), "Success" == data.Success ? ($("#my_cart").html(data.resp), $("#cart-count").html(data.count), loading_hide()) : ($("#cart-count").html(data.count), $("#model_body").html('<span style="style="color:#F00;">' + data.resp + "</span>"), $("#error_model").modal("toggle"), loading_hide())
            },
            error: function(a, b, c) {
                $("#model_body").html('<span style="style="color:#F00;">' + a.responseText + "</span>"), $("#error_model").modal("toggle"), loading_hide()
            },
            complete: function() {}
        })
    }
}

function checkMobileUser(a, b, c, d) {
    var e = $("#cust_session").val();
    if ("" == a || "" == b || "" == c || "" == d) $("#" + a).css("border-color", ""), $("#" + d).html(""), $("#" + d).slideUp();
    else {
        var f = {
                mobile_check: 1,
                cust_mobile_num: b,
                req_page: c,
                cust_session: e
            },
            g = JSON.stringify(f);
        $.ajax({
            url: base_url + "includes/main.php",
            type: "POST",
            data: g,
            contentType: "application/json; charset=utf-8",
            async: !1,
            success: function(b) {
                data = JSON.parse(b), "Success" == data.Success ? ($("#" + a).css("border-color", "#00FF00"), $("#" + d).html(""), $("#" + d).slideUp(), loading_hide()) : ($("#" + a).css("border-color", "red"), $("#" + d).slideDown(), $("#" + d).html(data.resp), $("#" + a).val(""), loading_hide())
            },
            error: function(a, b, c) {
                loading_hide(), $("#model_body").html('<span style="style="color:#F00;">' + a.responseText + "</span>"), $("#error_model").modal("toggle")
            },
            complete: function() {}
        })
    }
}

function updateState(a, b) {
    if (loading_show(), country_val = $("#" + a).val(), "" == country_val) loading_hide(), location.href = "/";
    else {
        var c = {
                update_state: 1,
                country_val: country_val
            },
            d = JSON.stringify(c);
        $.ajax({
            url: base_url + "includes/main.php",
            type: "POST",
            data: d,
            contentType: "application/json; charset=utf-8",
            async: !1,
            success: function(a) {
                data = JSON.parse(a), "Success" == data.Success ? ($("#" + b).html(data.resp), loading_hide()) : (loading_hide(), $("#model_body").html('<span style="style="color:#F00;">' + data.resp + "</span>"), $("#error_model").modal("toggle"))
            },
            error: function(a, b, c) {
                loading_hide(), $("#model_body").html('<span style="style="color:#F00;">' + a.responseText + "</span>"), $("#error_model").modal("toggle")
            },
            complete: function() {}
        })
    }
}

function updateCity(a, b) {
    if (loading_show(), state_val = $("#" + a).val(), "" == state_val) location.href = "/";
    else {
        var c = {
                update_city: 1,
                state_val: state_val
            },
            d = JSON.stringify(c);
        $.ajax({
            url: base_url + "includes/main.php",
            type: "POST",
            data: d,
            contentType: "application/json; charset=utf-8",
            async: !1,
            success: function(a) {
                data = JSON.parse(a), "Success" == data.Success ? ($("#" + b).html(data.resp), loading_hide()) : (loading_hide(), $("#model_body").html('<span style="style="color:#F00;">' + data.resp + "</span>"), $("#error_model").modal("toggle"))
            },
            error: function(a, b, c) {
                loading_hide(), $("#model_body").html('<span style="style="color:#F00;">' + a.responseText + "</span>"), $("#error_model").modal("toggle")
            },
            complete: function() {}
        })
    }
}

function checkEmailUser(a, b, c, d) {
    var e = $("#cust_session").val();
    if ("" == b || "" == a || "" == c || "" == d) $("#" + a).css("border-color", ""), $("#" + d).html(""), $("#" + d).slideUp();
    else {
        var f = {
                email_check: 1,
                cust_email: b,
                req_page: c,
                cust_session: e
            },
            g = JSON.stringify(f);
        $.ajax({
            url: "includes/main.php",
            type: "POST",
            data: g,
            contentType: "application/json; charset=utf-8",
            async: !1,
            success: function(b) {
                data = JSON.parse(b), "Success" == data.Success ? ($("#" + a).css("border-color", "#00FF00"), $("#" + d).html(""), $("#" + d).slideUp(), loading_hide()) : ($("#" + a).css("border-color", "red"), $("#" + d).slideDown(), $("#" + d).html(data.resp), $("#" + a).val(""), loading_hide())
            },
            error: function(a, b, c) {
                loading_hide(), $("#model_body").html('<span style="style="color:#F00;">' + a.responseText + "</span>"), $("#error_model").modal("toggle")
            },
            complete: function() {}
        })
    }
}

function chk_password(a, b, c) {
    var d = $.trim($("#" + a).val()),
        e = $.trim($("#" + b).val());
    "" != d && "" != e && (d == e ? $("#" + c).html('<span style="color:green;">Password Matched...</span>') : $("#" + c).html('<span style="color:red;">Password Not Matched...</span>'))
}

function checkStrength(a, b) {
    var c = $("#" + a).val(),
        d = 0;
    (c.length = 0) && ($("#" + b).removeClass(), $("#" + b).addClass("short"), $("#" + b).html("")), c.length < 8 && ($("#" + b).removeClass(), $("#" + b).addClass("short"), $("#" + b).html("Too short")), c.length > 7 && (d += 1), c.match(/([a-z].*[A-Z])|([A-Z].*[a-z])/) && (d += 1), c.match(/([a-zA-Z])/) && c.match(/([0-9])/) && (d += 1), c.match(/([!,%,&,@,#,$,^,*,?,_,~])/) && (d += 1), c.match(/(.*[!,%,&,@,#,$,^,*,?,_,~].*[!,%,&,@,#,$,^,*,?,_,~])/) && (d += 1), d < 2 ? ($("#" + b).removeClass(), $("#" + b).addClass("weak"), $("#" + b).html("Weak")) : 2 == d ? ($("#" + b).removeClass(), $("#" + b).addClass("good"), $("#" + b).html("Good")) : ($("#" + b).removeClass(), $("#" + b).addClass("strong"), $("#" + b).html("Strong"))
}

function logout_session(a) {
    if (loading_show(), "" == a) location.href = "/";
    else {
        var b = {
                logout_this: 1,
                session_value: a
            },
            c = JSON.stringify(b);
        $.ajax({
            url: base_url + "includes/main.php",
            type: "POST",
            data: c,
            async: !1,
            contentType: "application/json; charset=utf-8",
            success: function(a) {
                data = JSON.parse(a), "Success" == data.Success ? window.location.href = "/" : (loading_hide(), $("#model_body").html('<span style="style="color:#F00;">' + data.resp + "</span>"), $("#error_model").modal("toggle"))
            },
            error: function(a, b, c) {
                loading_hide(), $("#model_body").html('<span style="style="color:#F00;">' + a.responseText + "</span>"), $("#error_model").modal("toggle")
            },
            complete: function() {}
        })
    }
}

function updateCoupon() {
    loading_show();
    var a = $("#coupon_code").val(),
        b = $("#cust_session").val();
    if ("" == b) window.location.href = "/page-profile";
    else if ("" == a) $("#model_body").html('<span style="style="color:#F00;">Coupon Code empty.</span>'), $("#error_model").modal("toggle"), loading_hide();
    else {
        var c = {
                user_coupon_code: a,
                cust_session: b,
                update_coupon: 1
            },
            d = JSON.stringify(c);
        $.ajax({
            url: base_url + "includes/main.php",
            type: "POST",
            data: d,
            contentType: "application/json; charset=utf-8",
            async: !1,
            success: function(a) {
                data = JSON.parse(a), "Success" == data.Success ? ($("#model_body").html('<span style="style="color:#F00;">' + data.resp + "</span>"), $("#error_model").modal("toggle"), loading_hide(), $("#content").slideUp(), viewCart("content"), $("#content").slideDown()) : (loading_hide(), $("#model_body").html('<span style="style="color:#F00;">' + data.resp + "</span>"), $("#error_model").modal("toggle"))
            },
            error: function(a, b, c) {
                loading_hide(), $("#model_body").html('<span style="style="color:#F00;">' + a.responseText + "</span>"), $("#error_model").modal("toggle")
            },
            complete: function() {}
        })
    }
}

function getAddressData(a, b) {
    if (loading_show(), cust_session = $("#cust_session").val(), "" == cust_session) window.location.href = "/";
    else {
        var c = {
                loadAddress: 1,
                page_type: b,
                cust_session: cust_session
            },
            d = JSON.stringify(c);
        $.ajax({
            url: "includes/main.php",
            type: "POST",
            data: d,
            contentType: "application/json; charset=utf-8",
            async: !1,
            success: function(b) {
                data = JSON.parse(b), "Success" == data.Success ? ($("#" + a).slideDown(), $("#" + a).html(data.resp), loading_hide()) : ($("#" + a).slideDown(), $("#" + a).html(data.resp), loading_hide())
            },
            error: function(a, b, c) {
                loading_hide()
            },
            complete: function() {}
        })
    }
}

function placeOrder() {
    loading_show();
    var a = $("#cust_session").val(),
        b = "";
    $(".my-address-box").each(function() {
        $("#" + this.id).hasClass("alt") || (b = this.id)
    });
    var c = $("input[name=payment_mode]:checked").val(),
        d = 0;
    c && (d = $("input[name=pay_online_mode]:checked").val());
    var e = $.trim($("textarea#ord_comment").val());
    if ("" == a || "" == b) loading_hide(), $("#model_body").html('<span style="style="color:#F00;">Please select Address.</span>'), $("#error_model").modal("toggle");
    else if ("" == c) loading_hide(), $("#model_body").html('<span style="style="color:#F00;">Please Select palyment Mode</span>'), $("#error_model").modal("toggle");
    else {
        var f = {
                cust_session: a,
                pay_online_mode: d,
                add_id: b,
                payment_mode: c,
                ord_comment: e,
                placeOrder: 1
            },
            g = JSON.stringify(f);
        $.ajax({
            url: base_url + "includes/main.php",
            type: "POST",
            data: g,
            contentType: "application/json; charset=utf-8",
            async: !1,
            success: function(a) {
                data = JSON.parse(a), "Success" == data.Success ? (loading_hide(), "" != data.url ? "payu" == data.url ? ($("#payment_info").html(data.paymentData), document.getElementById("payuPayment").submit()) : window.location.href = "" + data.url : "undefined" == typeof data.url && ($("#model_body").html('<span style="style="color:#F00;">' + data.resp + "</span>"), $("#error_model").modal("toggle"), loading_hide(), $("button.close-popup").on("click", function() {
                    return window.location.href = "/page-profile", !1
                }))) : (loading_hide(), $("#model_body").html('<span style="style="color:#F00;">' + data.resp + "</span>"), $("#error_model").modal("toggle"))
            },
            error: function(a, b, c) {
                loading_hide(), $("#model_body").html('<span style="style="color:#F00;">' + a.responseText + "</span>"), $("#error_model").modal("toggle")
            },
            complete: function() {}
        })
    }
}

function showOrders(a) {
    loading_show();
    var b = $("#cust_session").val();
    if ("" == b) location.href = "/";
    else {
        $('input[name="reg_submit_pass"]').attr("disabled", "true");
        var c = {
                cust_session: b,
                order_id: a,
                show_orders: 1
            },
            d = JSON.stringify(c);
        $.ajax({
            url: base_url + "includes/main.php",
            type: "POST",
            data: d,
            async: !1,
            contentType: "application/json; charset=utf-8",
            success: function(a) {
                data = JSON.parse(a), "Success" == data.Success ? ($("#order_data").html(data.resp), loading_hide()) : ($("#order_data").html(data.resp), loading_hide())
            },
            error: function(a, b, c) {
                loading_hide(), $("#model_body").html('<span style="style="color:#F00;">' + a.responseText + "</span>"), $("#error_model").modal("toggle")
            },
            complete: function() {}
        })
    }
}

function getOrdersList() {
    loading_show();
    var a = $("#cust_session").val();
    if ("" == a) location.href = "/";
    else {
        var b = {
                cust_session: a,
                get_orders: 1
            },
            c = JSON.stringify(b);
        $.ajax({
            url: base_url + "includes/main.php",
            type: "POST",
            data: c,
            contentType: "application/json; charset=utf-8",
            async: !1,
            success: function(a) {
                data = JSON.parse(a), "Success" == data.Success ? ($("#order_list").html(data.resp), $("#users_orders").slideDown(), loading_hide()) : loading_hide()
            },
            error: function(a, b, c) {
                loading_hide(), $("#model_body").html('<span style="style="color:#F00;">' + a.responseText + "</span>"), $("#error_model").modal("toggle")
            },
            complete: function() {}
        })
    }
}

function sendVerificationCode(a) {
    loading_show();
    var b = $("#cust_session").val();
    if ("" == b) loading_hide(), location.href = "/";
    else {
        $('input[name="reg_submit_mob_verify"]').attr("disabled", "true");
        var c = {
                cust_session: b,
                req_type: a,
                send_code: 1
            },
            d = JSON.stringify(c);
        $.ajax({
            url: base_url + "includes/main.php",
            type: "POST",
            data: d,
            contentType: "application/json; charset=utf-8",
            async: !1,
            success: function(a) {
                data = JSON.parse(a), "Success" == data.Success ? ($("#model_body").html('<span style="style="color:#F00;">' + data.resp + "</span>"), $("#error_model").modal("toggle"), loading_hide()) : (loading_hide(), $("#model_body").html('<span style="style="color:#F00;">' + data.resp + "</span>"), $("#error_model").modal("toggle"))
            },
            error: function(a, b, c) {
                loading_hide(), $("#model_body").html('<span style="style="color:#F00;">' + a.responseText + "</span>"), $("#error_model").modal("toggle")
            },
            complete: function() {}
        })
    }
}

function addressSelect(a) {
    $(".my-address-box").each(function() {
        this.id == a ? ($("#" + a).removeClass("alt"), $("#" + a).html('<i class="fa fa-check-square-o"></i>&nbsp;Deliver to this address')) : $("#" + this.id).hasClass("alt") || ($("#" + this.id).addClass("alt"), $("#" + this.id).html('<i class="fa fa-square-o"></i>&nbsp;Deliver to this address'))
    })
}

function orderSelect(a) {
    $(".order_btns").each(function() {
        this.id == a ? $("#" + a).removeClass("alt") : $("#" + this.id).hasClass("alt") || $("#" + this.id).addClass("alt")
    })
}

function changeQuantity(a, b) {
    loading_show();
    var a = parseInt(a),
        c = {
            cart_id: a,
            flag: b,
            update_prod_quentity: 1
        },
        d = JSON.stringify(c);
    $.ajax({
        url: base_url + "includes/main.php",
        type: "POST",
        data: d,
        contentType: "application/json; charset=utf-8",
        async: !1,
        success: function(a) {
            data = JSON.parse(a), "Success" == data.Success ? (viewCart("content"), viewCart("checkout-page"), loading_hide()) : (loading_hide(), viewCart("content"))
        },
        error: function(a, b, c) {
            loading_hide(), viewCart("content")
        },
        complete: function() {}
    })
}

function buyNow(a) {
    loading_show(), addToCart(a), cust_session = $.trim($("#cust_session").val()), "" == cust_session ? window.location.href = "/page-cart" : window.location.href = "/page-checkout", loading_hide()
}

function submitThreadReview(a) {
    loading_show();
    var b = $.trim($("#thread_reply" + a).val()),
        c = $.trim($("#cust_session").val());
    if ("" == b) loading_hide(), $("#model_body").html('<span style="style="color:#F00;">Please Comment first </span>'), $("#error_model").modal("toggle");
    else {
        var d = {
                review_id: a,
                thread_reply: b,
                cust_session: c,
                insert_thread_review: 1
            },
            e = JSON.stringify(d);
        $.ajax({
            url: "includes/main.php",
            type: "POST",
            data: e,
            contentType: "application/json; charset=utf-8",
            success: function(a) {
                data = JSON.parse(a), "Success" == data.Success ? (location.reload(), loading_hide()) : ($("#model_body").html('<span style="style="color:#F00;">' + data.resp + "</span>"), $("#error_model").modal("toggle"), loading_hide())
            },
            error: function(a, b, c) {
                loading_hide(), $("#model_body").html('<span style="style="color:#F00;">' + a.responseText + "</span>"), $("#error_model").modal("toggle")
            },
            complete: function() {}
        })
    }
}

function getSuggestion(a) {
    if ("" == $.trim(a)) $("#search_suggestion").html(""), $("#search_suggestion").slideUp();
    else {
        var b = {
                search_text: a,
                search_on_front: 1
            },
            c = JSON.stringify(b);
        $.ajax({
            url: "includes/main.php",
            type: "POST",
            data: c,
            contentType: "application/json; charset=utf-8",
            success: function(a) {
                data = JSON.parse(a), "Success" == data.Success ? ($("#search_suggestion").html(data.resp), $("#search_suggestion").slideDown()) : ($("#search_suggestion").html(""), $("#search_suggestion").slideUp())
            },
            error: function(a, b, c) {
                loading_hide(), $("#model_body").html('<span style="style="color:#F00;">' + a.responseText + "</span>"), $("#error_model").modal("toggle")
            },
            complete: function() {}
        })
    }
}

function clearSearch() {
    $("#search_suggestion").html(""), $("#search_suggestion").slideUp()
}
var base_url = window.location.origin + "/";
$("#user_register").on("submit", function(a) {
    if (a.preventDefault(), $("#user_register").valid()) {
        loading_show();
        var b = $.trim($("#cust_fname_register").val()),
            c = $.trim($("#cust_lname_register").val()),
            d = $.trim($("#cust_email_register").val()),
            e = $.trim($("#cust_mobile_num_register").val()),
            f = $.trim($("#cust_address_register").val()),
            g = $.trim($("#cust_country_register").val()),
            h = $.trim($("#cust_state_register").val()),
            i = $.trim($("#cust_city_register").val()),
            j = $.trim($("#cust_pincode_register").val()),
            k = $.trim($("#cust_password_register").val()),
            l = $.trim($("#cust_cpassword_register").val()),
            m = $("input:radio[name=cust_type]:checked").val(),
            n = $("input:checkbox[name=Agreement]:checked").val(),
            o = navigator.userAgent,
            p = "";
        if (p = "0.0.0.0", "" == b || "" == c || "" == d || "" == e || "" == k || "" == l || "undefined" == typeof m || "undefined" == typeof n) $("#model_body").html('<span style="style="color:#F00;">Please fill all data.</span>'), $("#error_model").modal("toggle"), loading_hide();
        else {
            $('input[name="reg_submit_reg"]').attr("disabled", "true");
            var q = {
                    cust_fname: b,
                    cust_lname: c,
                    cust_email: d,
                    cust_mobile_num: e,
                    cust_address: f,
                    cust_country: g,
                    cust_state: h,
                    cust_city: i,
                    cust_pincode: j,
                    cust_password: k,
                    cli_browser_info: o,
                    cli_ip_address: p,
                    user_register: 1
                },
                r = JSON.stringify(q);
            $.ajax({
                url: base_url + "includes/main.php",
                type: "POST",
                data: r,
                async: !1,
                contentType: "application/json; charset=utf-8",
                success: function(a) {
                    data = JSON.parse(a), "Success" == data.Success ? ($("#model_body").html('<span style="style="color:#F00;">' + data.resp + "</span>"), $("#error_model").modal("toggle"), loading_hide(), $("button.close-popup").on("click", function() {
                        var a = $("#redirect_to").val();
                        "" != a ? window.location.href = base_url + a : window.location.href = base_url + "page-profile"
                    })) : (loading_hide(), $("#model_body").html('<span style="style="color:#F00;">' + data.resp + "</span>"), $("#error_model").modal("toggle"))
                },
                error: function(a, b, c) {
                    loading_hide(), $("#model_body").html('<span style="style="color:#F00;">' + a.responseText + "</span>"), $("#error_model").modal("toggle")
                },
                complete: function() {}
            })
        }
    }
}), $("#user_login").on("submit", function(a) {
    if (a.preventDefault(), $("#user_login").valid()) {
        loading_show();
        var b = $.trim($("#cust_email_login").val()),
            c = $.trim($("#cust_password_login").val()),
            d = navigator.userAgent,
            e = "";
        if (e = "0:0:0:0", "" == b || "" == c) loading_hide(), $("#model_body").html('<span style="style="color:#F00;">Please fill all data.</span>'), $("#error_model").modal("toggle");
        else {
            $('input[name="reg_submit_reg"]').attr("disabled", "true");
            var f = {
                    cust_email: b,
                    cust_password: c,
                    cli_browser_info: d,
                    cli_ip_address: e,
                    user_login: 1
                },
                g = JSON.stringify(f);
            $.ajax({
                url: base_url + "includes/main.php",
                type: "POST",
                data: g,
                contentType: "application/json; charset=utf-8",
                async: !1,
                success: function(a) {
                    if (data = JSON.parse(a), "Success" == data.Success) {
                        var b = $("#redirect_to").val();
                        return "" != b ? window.location.href = base_url + b : window.location.href = base_url + "page-profile", !1
                    }
                    loading_hide(), $("#model_body").html('<span style="style="color:#F00;">' + data.resp + "</span>"), $("#error_model").modal("toggle")
                },
                error: function(a, b, c) {
                    loading_hide(), $("#model_body").html('<span style="style="color:#F00;">' + a.responseText + "</span>"), $("#error_model").modal("toggle")
                },
                complete: function() {}
            })
        }
    }
}), $("#forget_pass").on("submit", function(a) {
    if (a.preventDefault(), $("#forget_pass").valid()) {
        loading_show();
        var b = $.trim($("#cust_email_fpass").val());
        if ("" == b) loading_hide(), $("#model_body").html('<span style="style="color:#F00;">Please enter email id.</span>'), $("#error_model").modal("toggle");
        else {
            $('input[name="forget_pass_submit"]').attr("disabled", "true");
            var c = {
                    cust_email: b,
                    forget_pass_mail_send: 1
                },
                d = JSON.stringify(c);
            $.ajax({
                url: base_url + "includes/main.php",
                type: "POST",
                data: d,
                contentType: "application/json; charset=utf-8",
                async: !1,
                success: function(a) {
                    data = JSON.parse(a), "Success" == data.Success ? ($("#forget_email_error").html(data.resp), $("#forget_email_error").show().fadeOut(5e3), loading_hide()) : ($("#forget_email_error").html(data.resp), $("#forget_email_error").show().fadeOut(5e3), loading_hide())
                },
                error: function(a, b, c) {
                    loading_hide(), $("#model_body").html('<span style="style="color:#F00;">' + a.responseText + "</span>"), $("#error_model").modal("toggle")
                },
                complete: function() {}
            })
        }
    }
}), $.validator.setDefaults({
    highlight: function(a) {
        $(a).closest(".form-group").addClass("has-error")
    },
    unhighlight: function(a) {
        $(a).closest(".form-group").removeClass("has-error")
    },
    errorElement: "span",
    errorClass: "help-block",
    errorPlacement: function(a, b) {
        b.parent(".input-group").length ? a.insertAfter(b.parent()) : a.insertAfter(b)
    }
}), $("#add_form").on("submit", function(a) {
    if (a.preventDefault(), $("#add_form").valid()) {
        loading_show();
        var b = $.trim($("#cust_session").val()),
            c = $.trim($("#add_address_type_new_address").val()),
            d = $.trim($("#cust_address_new_address").val()),
            e = $.trim($("#cust_country_new_address").val()),
            f = $.trim($("#cust_state_new_address").val()),
            g = $.trim($("#cust_city_new_address").val()),
            h = $.trim($("#cust_pincode_new_address").val());
        if ("" == d || "" == e || "" == f || "" == g || "" == h || "" == c) loading_hide(), $("#model_body").html('<span style="style="color:#F00;">Please fill all data.</span>'), $("#error_model").modal("toggle");
        else {
            $('input[name="reg_submit_new_address"]').attr("disabled", "true");
            var i = {
                    cust_session: b,
                    add_address_type: c,
                    cust_address: d,
                    cust_country: e,
                    cust_state: f,
                    cust_city: g,
                    cust_pincode: h,
                    add_new_address: 1
                },
                j = JSON.stringify(i);
            $.ajax({
                url: "includes/main.php",
                type: "POST",
                data: j,
                contentType: "application/json; charset=utf-8",
                async: !1,
                success: function(a) {
                    if (data = JSON.parse(a), "Success" == data.Success) {
                        var b = window.location.pathname,
                            c = b.substring(b.lastIndexOf("/") + 1);
                        "page-profile.php" == c ? ($("#new-address-block").slideUp(), $("#address_data").slideDown(), getAddressData("address_data")) : ($("#new-address-block").slideUp(), $("#select-address-block").slideDown(), getAddressData("select-address-main"))
                    } else loading_hide(), $("#model_body").html('<span style="style="color:#F00;">' + data.resp + "</span>"), $("#error_model").modal("toggle")
                },
                error: function(a, b, c) {
                    loading_hide(), $("#model_body").html('<span style="style="color:#F00;">' + a.responseText + "</span>"), $("#error_model").modal("toggle")
                },
                complete: function() {}
            })
        }
    }
}), $("#change_pass").on("submit", function(a) {
    if (a.preventDefault(), $("#change_pass").valid()) {
        loading_show();
        var b = $("#cust_session").val(),
            c = $.trim($("#cust_password_old_change_pass").val()),
            d = $.trim($("#cust_password_new_change_pass").val());
        if ("" == c || "" == d || "" == b) loading_hide(), $("#model_body").html('<span style="style="color:#F00;">Please fill all data.</span>'), $("#error_model").modal("toggle");
        else {
            $('input[name="reg_submit_pass"]').attr("disabled", "true");
            var e = {
                    cust_password_old: c,
                    cust_password_new: d,
                    cust_session: b,
                    change_password: 1
                },
                f = JSON.stringify(e);
            $.ajax({
                url: base_url + "includes/main.php",
                type: "POST",
                data: f,
                contentType: "application/json; charset=utf-8",
                async: !1,
                success: function(a) {
                    data = JSON.parse(a), "Success" == data.Success ? ($("#model_body").html('<span style="style="color:#F00;">' + data.resp + "</span>"), $("#error_model").modal("toggle"), loading_hide(), $("button.close-popup").on("click", function() {
                        return location.reload(), !1
                    })) : (loading_hide(), $("#model_body").html('<span style="style="color:#F00;">' + data.resp + "</span>"), $("#error_model").modal("toggle"))
                },
                error: function(a, b, c) {
                    loading_hide(), $("#model_body").html('<span style="style="color:#F00;">' + a.responseText + "</span>"), $("#error_model").modal("toggle")
                },
                complete: function() {}
            })
        }
    }
}), $("#user_update_info").on("submit", function(a) {
    a.preventDefault(), $("#user_update_info").valid() && (loading_show(), $.ajax({
        url: base_url + "includes/main.php",
        type: "POST",
        data: new FormData(this),
        contentType: !1,
        cache: !1,
        processData: !1,
        async: !0,
        success: function(a) {
            data = JSON.parse(a), "Success" == data.Success ? ($("#model_body").html('<span style="style="color:#F00;">' + data.resp + "</span>"), $("#error_model").modal("toggle"), loading_hide(), $("button.close-popup").on("click", function() {
                return location.reload(), !1
            })) : (loading_hide(), $("#model_body").html('<span style="style="color:#F00;">' + data.resp + "</span>"), $("#error_model").modal("toggle"))
        },
        error: function(a, b, c) {
            loading_hide(), $("#model_body").html('<span style="style="color:#F00;">' + a.responseText + "</span>"), $("#error_model").modal("toggle")
        },
        complete: function() {}
    }))
}), $("#mobile_verify").on("submit", function(a) {
    if (a.preventDefault(), $("#mobile_verify").valid()) {
        loading_show();
        var b = $("#cust_session").val(),
            c = $.trim($("#cust_mobile_status").val());
        if ("" == c && "" == b) loading_hide(), $("#model_body").html('<span style="style="color:#F00;">Please enter your OTP.</span>'), $("#error_model").modal("toggle");
        else {
            $('input[name="reg_submit_mob_verify"]').attr("disabled", "true");
            var d = {
                    cust_session: b,
                    cust_mobile_status: c,
                    cust_mobile_verify: 1
                },
                e = JSON.stringify(d);
            $.ajax({
                url: base_url + "includes/main.php",
                type: "POST",
                data: e,
                contentType: "application/json; charset=utf-8",
                async: !1,
                success: function(a) {
                    data = JSON.parse(a), "Success" == data.Success ? ($("#model_body").html('<span style="style="color:#F00;">' + data.resp + "</span>"), $("#error_model").modal("toggle"), loading_hide(), $("button.close-popup").on("click", function() {
                        return location.reload(), !1
                    })) : (loading_hide(), $("#model_body").html('<span style="style="color:#F00;">' + data.resp + "</span>"), $("#error_model").modal("toggle"))
                },
                error: function(a, b, c) {
                    loading_hide(), $("#model_body").html('<span style="style="color:#F00;">' + a.responseText + "</span>"), $("#error_model").modal("toggle")
                },
                complete: function() {}
            })
        }
    }
}), $("#reset_password").on("submit", function(a) {
    if (a.preventDefault(), $("#reset_password").valid()) {
        loading_show();
        var b = $("#cust_session").val(),
            c = $.trim($("#cust_password_new_reset").val());
        if ("" == b) $("#model_body").html('<span style="style="color:#F00;">Url expired...</span>'), $("#error_model").modal("toggle"), loading_hide(), window.location.href = "/";
        else if ("" == c) $("#model_body").html('<span style="style="color:#F00;">Please provide Password...</span>'), $("#error_model").modal("toggle"), loading_hide();
        else {
            $('input[name="reg_submit_password_reset"]').attr("disabled", "true");
            var d = {
                    cust_password_new: c,
                    cust_session: b,
                    reset_password: 1
                },
                e = JSON.stringify(d);
            $.ajax({
                url: base_url + "includes/main.php",
                type: "POST",
                data: e,
                contentType: "application/json; charset=utf-8",
                async: !1,
                success: function(a) {
                    data = JSON.parse(a), "Success" == data.Success ? ($("#model_body").html('<span style="style="color:#F00;">' + data.resp + "</span>"), $("#error_model").modal("toggle"), loading_hide(), $("button.close-popup").on("click", function() {
                        return window.location.href = "/page-profile", !1
                    })) : (loading_hide(), $("#model_body").html('<span style="style="color:#F00;">' + data.resp + "</span>"), $("#error_model").modal("toggle"))
                },
                error: function(a, b, c) {
                    loading_hide(), $("#model_body").html('<span style="style="color:#F00;">' + a.responseText + "</span>"), $("#error_model").modal("toggle")
                },
                complete: function() {}
            })
        }
    }
}), $("#user_contact").on("submit", function(a) {
    if (a.preventDefault(), $("#user_contact").valid()) {
        loading_show();
        var b = $.trim($("#conct_name").val()),
            c = $.trim($("#conct_email").val()),
            d = $.trim($("#conct_mobile_num").val()),
            e = "Planet Educate",
            f = $.trim($("textarea#conct_msg").val()),
            g = navigator.userAgent,
            h = "";
        if (cli_ip_address = "0.0.0.0", "" == b || "" == c || "" == d || "" == e || "" == f) $("#model_body").html('<span style="style="color:#F00;">Please fill all data.</span>'), $("#error_model").modal("toggle"), loading_hide();
        else {
            $('input[name="reg_submit_contact"]').attr("disabled", "true");
            var i = {
                    conct_name: b,
                    conct_email: c,
                    conct_sub: e,
                    conct_mobile_num: d,
                    conct_msg: f,
                    conct_user_ip: h,
                    conct_web_info: g,
                    user_contact_us: 1
                },
                j = JSON.stringify(i);
            $.ajax({
                url: base_url + "includes/main.php",
                type: "POST",
                data: j,
                contentType: "application/json; charset=utf-8",
                async: !1,
                success: function(a) {
                    data = JSON.parse(a), "Success" == data.Success ? ($("#model_body").html('<span style="style="color:#F00;">' + data.resp + "</span>"), $("#error_model").modal("toggle"), $("button.close-popup").on("click", function() {
                        return location.reload(), !1
                    }), loading_hide()) : ($("#model_body").html('<span style="style="color:#F00;">' + data.resp + "</span>"), $("#error_model").modal("toggle"), loading_hide())
                },
                error: function(a, b, c) {
                    $("#model_body").html('<span style="style="color:#F00;">' + a.responseText + "</span>"), $("#error_model").modal("toggle"), loading_hide()
                },
                complete: function() {}
            })
        }
    }
}), $("#comment-form").on("submit", function(a) {
    if (a.preventDefault(), $("#comment-form").valid()) {
        loading_show();
        var b = $.trim($("#cust_session").val()),
            c = $.trim($("#rating").val()),
            d = $.trim($("textarea#review_content").val()),
            e = $.trim($("#review_prod_id").val()),
            f = $.trim($("#review_title").val());
        if ("" == b) loading_hide(), $("#model_body").html('<span style="style="color:#F00;">Please Login.</span>'), $("#error_model").modal("toggle");
        else {
            $('input[name="submit_review"]').attr("disabled", "true");
            var g = {
                    cust_session: b,
                    rating: c,
                    review_content: d,
                    review_prod_id: e,
                    review_title: f,
                    insert_user_review: 1
                },
                h = JSON.stringify(g);
            $.ajax({
                url: "includes/main.php",
                type: "POST",
                data: h,
                contentType: "application/json; charset=utf-8",
                success: function(a) {
                    data = JSON.parse(a), "Success" == data.Success ? (location.reload(), loading_hide()) : ($("#model_body").html('<span style="style="color:#F00;">' + data.resp + "</span>"), $("#error_model").modal("toggle"), loading_hide())
                },
                error: function(a, b, c) {
                    loading_hide(), $("#model_body").html('<span style="style="color:#F00;">' + a.responseText + "</span>"), $("#error_model").modal("toggle")
                },
                complete: function() {}
            })
        }
    }
});






function ToggleMyDiv(a) {
    $("#" + a).slideToggle()
}

function div_swap(a, b) {
    $("#" + a).slideDown(), $("#" + b).slideUp()
}

function changePrice(a) {
    actual_recommended_price = parseInt($("#actual_recommended_price").val()), actual_recommended_new_price = a * actual_recommended_price, $("#main_recommended_price").html(actual_recommended_new_price), actual_list_price = parseInt($("#actual_list_price").val()), 0 != actual_list_price && (actual_list_new_price = a * actual_list_price, $("#main_list_price").html(actual_list_new_price))
}

function checkBoxStyle(a) {
    chk_class = $("#" + a).attr("class"), "fa fa-check-empty" == chk_class ? $("#" + a).removeClass("fa fa-check-empty").addClass("fa fa-check") : "fa fa-check" == chk_class && $("#" + a).removeClass("fa fa-check").addClass("fa fa-check-empty")
}

function loading_show() {
    document.getElementById("lodermodal").style.display = "block", document.getElementById("loderfade").style.display = "block"
}

function loading_hide() {
    document.getElementById("lodermodal").style.display = "none", document.getElementById("loderfade").style.display = "none"
}

function changeClass(a) {
    this_class = $("#" + a).attr("class"), "fa fa-chevron-up" == this_class ? $("#" + a).removeClass("fa fa-chevron-up").addClass("fa fa-chevron-down") : "fa fa-chevron-down" == this_class && $("#" + a).removeClass("fa fa-chevron-down").addClass("fa fa-chevron-up")
}

function isNumberKey(a) {
    var b = a.which ? a.which : event.keyCode;
    return !(b > 31 && (b < 48 || b > 57))
}

function viewCart(a) {
    loading_show();
    var b = $("#cust_session").val(),
        c = {
            cust_session: b,
            cart_id: a,
            getCart: 1
        },
        d = JSON.stringify(c);
    $.ajax({
        url: base_url + "includes/main.php",
        type: "POST",
        data: d,
        contentType: "application/json; charset=utf-8",
        async: !1,
        success: function(b) {
            data = JSON.parse(b), "Success" == data.Success ? ($("#" + a).html(data.resp), $("#cart-count").html(data.count), "content" == a && 0 == data.checkout && $("#checkout-process-btn").hide(), loading_hide()) : ($("#" + a).html(data.resp), $("#checkout_btn").slideUp(), $("#cart-count").html(data.count), "content" == a && 0 == data.checkout && $("#checkout-process-btn").hide(), loading_hide())
        },
        error: function(a, b, c) {
            $("#model_body").html('<span style="style="color:#F00;">' + a.responseText + "</span>"), $("#error_model").modal("toggle"), loading_hide()
        },
        complete: function() {
            loading_hide()
        }
    })
}

function removeItem(a) {
    loading_show();
    var b = {
            cart_id: a,
            deleteFromCart: 1
        },
        c = JSON.stringify(b);
    $.ajax({
        url: base_url + "includes/main.php",
        type: "POST",
        data: c,
        contentType: "application/json; charset=utf-8",
        async: !1,
        success: function(a) {
            data = JSON.parse(a), "Success" == data.Success ? (viewCart("content"), loading_hide()) : (loading_hide(), $("#model_body").html('<span style="style="color:#F00;">' + data.resp + "</span>"), $("#error_model").modal("toggle"))
        },
        error: function(a, b, c) {
            loading_hide(), $("#model_body").html('<span style="style="color:#F00;">' + a.responseText + "</span>"), $("#error_model").modal("toggle")
        },
        complete: function() {}
    })
}

function addToCart(a) {
    loading_show();
    var b = $("#cust_session").val(),
        c = $.trim($("#user_prod_quentity" + a).val());
    "" != c && "undefined" != typeof c || (c = 1);
    var d = $("#coupon_code").val();
    if ("" == a) location.href = "https://www.planeteducate.com";
    else {
        var e = {
                addToCart: 1,
                prod_id: a,
                cust_session: b,
                user_prod_quentity: c,
                user_coupon_code: d
            },
            f = JSON.stringify(e);
        $.ajax({
            url: base_url + "includes/main.php",
            type: "POST",
            data: f,
            contentType: "application/json; charset=utf-8",
            async: !1,
            success: function(a) {
                data = JSON.parse(a), "Success" == data.Success ? ($("#my_cart").html(data.resp), $("#cart-count").html(data.count), loading_hide()) : ($("#cart-count").html(data.count), $("#model_body").html('<span style="style="color:#F00;">' + data.resp + "</span>"), $("#error_model").modal("toggle"), loading_hide())
            },
            error: function(a, b, c) {
                $("#model_body").html('<span style="style="color:#F00;">' + a.responseText + "</span>"), $("#error_model").modal("toggle"), loading_hide()
            },
            complete: function() {}
        })
    }
}

function checkMobileUser(a, b, c, d) {
    var e = $("#cust_session").val();
    if ("" == a || "" == b || "" == c || "" == d) $("#" + a).css("border-color", ""), $("#" + d).html(""), $("#" + d).slideUp();
    else {
        var f = {
                mobile_check: 1,
                cust_mobile_num: b,
                req_page: c,
                cust_session: e
            },
            g = JSON.stringify(f);
        $.ajax({
            url: base_url + "includes/main.php",
            type: "POST",
            data: g,
            contentType: "application/json; charset=utf-8",
            async: !1,
            success: function(b) {
                data = JSON.parse(b), "Success" == data.Success ? ($("#" + a).css("border-color", "#00FF00"), $("#" + d).html(""), $("#" + d).slideUp(), loading_hide()) : ($("#" + a).css("border-color", "red"), $("#" + d).slideDown(), $("#" + d).html(data.resp), $("#" + a).val(""), loading_hide())
            },
            error: function(a, b, c) {
                loading_hide(), $("#model_body").html('<span style="style="color:#F00;">' + a.responseText + "</span>"), $("#error_model").modal("toggle")
            },
            complete: function() {}
        })
    }
}

function updateState(a, b) {
    if (loading_show(), country_val = $("#" + a).val(), "" == country_val) loading_hide(), location.href = "/";
    else {
        var c = {
                update_state: 1,
                country_val: country_val
            },
            d = JSON.stringify(c);
        $.ajax({
            url: base_url + "includes/main.php",
            type: "POST",
            data: d,
            contentType: "application/json; charset=utf-8",
            async: !1,
            success: function(a) {
                data = JSON.parse(a), "Success" == data.Success ? ($("#" + b).html(data.resp), loading_hide()) : (loading_hide(), $("#model_body").html('<span style="style="color:#F00;">' + data.resp + "</span>"), $("#error_model").modal("toggle"))
            },
            error: function(a, b, c) {
                loading_hide(), $("#model_body").html('<span style="style="color:#F00;">' + a.responseText + "</span>"), $("#error_model").modal("toggle")
            },
            complete: function() {}
        })
    }
}

function updateCity(a, b) {
    if (loading_show(), state_val = $("#" + a).val(), "" == state_val) location.href = "/";
    else {
        var c = {
                update_city: 1,
                state_val: state_val
            },
            d = JSON.stringify(c);
        $.ajax({
            url: base_url + "includes/main.php",
            type: "POST",
            data: d,
            contentType: "application/json; charset=utf-8",
            async: !1,
            success: function(a) {
                data = JSON.parse(a), "Success" == data.Success ? ($("#" + b).html(data.resp), loading_hide()) : (loading_hide(), $("#model_body").html('<span style="style="color:#F00;">' + data.resp + "</span>"), $("#error_model").modal("toggle"))
            },
            error: function(a, b, c) {
                loading_hide(), $("#model_body").html('<span style="style="color:#F00;">' + a.responseText + "</span>"), $("#error_model").modal("toggle")
            },
            complete: function() {}
        })
    }
}

function checkEmailUser(a, b, c, d) {
    var e = $("#cust_session").val();
    if ("" == b || "" == a || "" == c || "" == d) $("#" + a).css("border-color", ""), $("#" + d).html(""), $("#" + d).slideUp();
    else {
        var f = {
                email_check: 1,
                cust_email: b,
                req_page: c,
                cust_session: e
            },
            g = JSON.stringify(f);
        $.ajax({
            url: "includes/main.php",
            type: "POST",
            data: g,
            contentType: "application/json; charset=utf-8",
            async: !1,
            success: function(b) {
                data = JSON.parse(b), "Success" == data.Success ? ($("#" + a).css("border-color", "#00FF00"), $("#" + d).html(""), $("#" + d).slideUp(), loading_hide()) : ($("#" + a).css("border-color", "red"), $("#" + d).slideDown(), $("#" + d).html(data.resp), $("#" + a).val(""), loading_hide())
            },
            error: function(a, b, c) {
                loading_hide(), $("#model_body").html('<span style="style="color:#F00;">' + a.responseText + "</span>"), $("#error_model").modal("toggle")
            },
            complete: function() {}
        })
    }
}

function chk_password(a, b, c) {
    var d = $.trim($("#" + a).val()),
        e = $.trim($("#" + b).val());
    "" != d && "" != e && (d == e ? $("#" + c).html('<span style="color:green;">Password Matched...</span>') : $("#" + c).html('<span style="color:red;">Password Not Matched...</span>'))
}

function checkStrength(a, b) {
    var c = $("#" + a).val(),
        d = 0;
    (c.length = 0) && ($("#" + b).removeClass(), $("#" + b).addClass("short"), $("#" + b).html("")), c.length < 8 && ($("#" + b).removeClass(), $("#" + b).addClass("short"), $("#" + b).html("Too short")), c.length > 7 && (d += 1), c.match(/([a-z].*[A-Z])|([A-Z].*[a-z])/) && (d += 1), c.match(/([a-zA-Z])/) && c.match(/([0-9])/) && (d += 1), c.match(/([!,%,&,@,#,$,^,*,?,_,~])/) && (d += 1), c.match(/(.*[!,%,&,@,#,$,^,*,?,_,~].*[!,%,&,@,#,$,^,*,?,_,~])/) && (d += 1), d < 2 ? ($("#" + b).removeClass(), $("#" + b).addClass("weak"), $("#" + b).html("Weak")) : 2 == d ? ($("#" + b).removeClass(), $("#" + b).addClass("good"), $("#" + b).html("Good")) : ($("#" + b).removeClass(), $("#" + b).addClass("strong"), $("#" + b).html("Strong"))
}

function logout_session(a) {
    if (loading_show(), "" == a) location.href = "/";
    else {
        var b = {
                logout_this: 1,
                session_value: a
            },
            c = JSON.stringify(b);
        $.ajax({
            url: base_url + "includes/main.php",
            type: "POST",
            data: c,
            async: !1,
            contentType: "application/json; charset=utf-8",
            success: function(a) {
                data = JSON.parse(a), "Success" == data.Success ? window.location.href = "/" : (loading_hide(), $("#model_body").html('<span style="style="color:#F00;">' + data.resp + "</span>"), $("#error_model").modal("toggle"))
            },
            error: function(a, b, c) {
                loading_hide(), $("#model_body").html('<span style="style="color:#F00;">' + a.responseText + "</span>"), $("#error_model").modal("toggle")
            },
            complete: function() {}
        })
    }
}

function updateCoupon() {
    loading_show();
    var a = $("#coupon_code").val(),
        b = $("#cust_session").val();
    if ("" == b) window.location.href = "/page-profile";
    else if ("" == a) $("#model_body").html('<span style="style="color:#F00;">Coupon Code empty.</span>'), $("#error_model").modal("toggle"), loading_hide();
    else {
        var c = {
                user_coupon_code: a,
                cust_session: b,
                update_coupon: 1
            },
            d = JSON.stringify(c);
        $.ajax({
            url: base_url + "includes/main.php",
            type: "POST",
            data: d,
            contentType: "application/json; charset=utf-8",
            async: !1,
            success: function(a) {
                data = JSON.parse(a), "Success" == data.Success ? ($("#model_body").html('<span style="style="color:#F00;">' + data.resp + "</span>"), $("#error_model").modal("toggle"), loading_hide(), $("#content").slideUp(), viewCart("content"), $("#content").slideDown()) : (loading_hide(), $("#model_body").html('<span style="style="color:#F00;">' + data.resp + "</span>"), $("#error_model").modal("toggle"))
            },
            error: function(a, b, c) {
                loading_hide(), $("#model_body").html('<span style="style="color:#F00;">' + a.responseText + "</span>"), $("#error_model").modal("toggle")
            },
            complete: function() {}
        })
    }
}

function getAddressData(a, b) {
    if (loading_show(), cust_session = $("#cust_session").val(), "" == cust_session) window.location.href = "/";
    else {
        var c = {
                loadAddress: 1,
                page_type: b,
                cust_session: cust_session
            },
            d = JSON.stringify(c);
        $.ajax({
            url: "includes/main.php",
            type: "POST",
            data: d,
            contentType: "application/json; charset=utf-8",
            async: !1,
            success: function(b) {
                data = JSON.parse(b), "Success" == data.Success ? ($("#" + a).slideDown(), $("#" + a).html(data.resp), loading_hide()) : ($("#" + a).slideDown(), $("#" + a).html(data.resp), loading_hide())
            },
            error: function(a, b, c) {
                loading_hide()
            },
            complete: function() {}
        })
    }
}

function placeOrder() {
    loading_show();
    var a = $("#cust_session").val(),
        b = "";
    $(".my-address-box").each(function() {
        $("#" + this.id).hasClass("alt") || (b = this.id)
    });
    var c = $("input[name=payment_mode]:checked").val(),
        d = 0;
    c && (d = $("input[name=pay_online_mode]:checked").val());
    var e = $.trim($("textarea#ord_comment").val());
    if ("" == a || "" == b) loading_hide(), $("#model_body").html('<span style="style="color:#F00;">Please select Address.</span>'), $("#error_model").modal("toggle");
    else if ("" == c) loading_hide(), $("#model_body").html('<span style="style="color:#F00;">Please Select palyment Mode</span>'), $("#error_model").modal("toggle");
    else {
        var f = {
                cust_session: a,
                pay_online_mode: d,
                add_id: b,
                payment_mode: c,
                ord_comment: e,
                placeOrder: 1
            },
            g = JSON.stringify(f);
        $.ajax({
            url: base_url + "includes/main.php",
            type: "POST",
            data: g,
            contentType: "application/json; charset=utf-8",
            async: !1,
            success: function(a) {
                data = JSON.parse(a), "Success" == data.Success ? (loading_hide(), "" != data.url ? "payu" == data.url ? ($("#payment_info").html(data.paymentData), document.getElementById("payuPayment").submit()) : window.location.href = "" + data.url : "undefined" == typeof data.url && ($("#model_body").html('<span style="style="color:#F00;">' + data.resp + "</span>"), $("#error_model").modal("toggle"), loading_hide(), $("button.close-popup").on("click", function() {
                    return window.location.href = "/page-profile", !1
                }))) : (loading_hide(), $("#model_body").html('<span style="style="color:#F00;">' + data.resp + "</span>"), $("#error_model").modal("toggle"))
            },
            error: function(a, b, c) {
                loading_hide(), $("#model_body").html('<span style="style="color:#F00;">' + a.responseText + "</span>"), $("#error_model").modal("toggle")
            },
            complete: function() {}
        })
    }
}

function showOrders(a) {
    loading_show();
    var b = $("#cust_session").val();
    if ("" == b) location.href = "/";
    else {
        $('input[name="reg_submit_pass"]').attr("disabled", "true");
        var c = {
                cust_session: b,
                order_id: a,
                show_orders: 1
            },
            d = JSON.stringify(c);
        $.ajax({
            url: base_url + "includes/main.php",
            type: "POST",
            data: d,
            async: !1,
            contentType: "application/json; charset=utf-8",
            success: function(a) {
                data = JSON.parse(a), "Success" == data.Success ? ($("#order_data").html(data.resp), loading_hide()) : ($("#order_data").html(data.resp), loading_hide())
            },
            error: function(a, b, c) {
                loading_hide(), $("#model_body").html('<span style="style="color:#F00;">' + a.responseText + "</span>"), $("#error_model").modal("toggle")
            },
            complete: function() {}
        })
    }
}

function getOrdersList() {
    loading_show();
    var a = $("#cust_session").val();
    if ("" == a) location.href = "/";
    else {
        var b = {
                cust_session: a,
                get_orders: 1
            },
            c = JSON.stringify(b);
        $.ajax({
            url: base_url + "includes/main.php",
            type: "POST",
            data: c,
            contentType: "application/json; charset=utf-8",
            async: !1,
            success: function(a) {
                data = JSON.parse(a), "Success" == data.Success ? ($("#order_list").html(data.resp), $("#users_orders").slideDown(), loading_hide()) : loading_hide()
            },
            error: function(a, b, c) {
                loading_hide(), $("#model_body").html('<span style="style="color:#F00;">' + a.responseText + "</span>"), $("#error_model").modal("toggle")
            },
            complete: function() {}
        })
    }
}

function sendVerificationCode(a) {
    loading_show();
    var b = $("#cust_session").val();
    if ("" == b) loading_hide(), location.href = "/";
    else {
        $('input[name="reg_submit_mob_verify"]').attr("disabled", "true");
        var c = {
                cust_session: b,
                req_type: a,
                send_code: 1
            },
            d = JSON.stringify(c);
        $.ajax({
            url: base_url + "includes/main.php",
            type: "POST",
            data: d,
            contentType: "application/json; charset=utf-8",
            async: !1,
            success: function(a) {
                data = JSON.parse(a), "Success" == data.Success ? ($("#model_body").html('<span style="style="color:#F00;">' + data.resp + "</span>"), $("#error_model").modal("toggle"), loading_hide()) : (loading_hide(), $("#model_body").html('<span style="style="color:#F00;">' + data.resp + "</span>"), $("#error_model").modal("toggle"))
            },
            error: function(a, b, c) {
                loading_hide(), $("#model_body").html('<span style="style="color:#F00;">' + a.responseText + "</span>"), $("#error_model").modal("toggle")
            },
            complete: function() {}
        })
    }
}

function addressSelect(a) {
    $(".my-address-box").each(function() {
        this.id == a ? ($("#" + a).removeClass("alt"), $("#" + a).html('<i class="fa fa-check-square-o"></i>&nbsp;Deliver to this address')) : $("#" + this.id).hasClass("alt") || ($("#" + this.id).addClass("alt"), $("#" + this.id).html('<i class="fa fa-square-o"></i>&nbsp;Deliver to this address'))
    })
}

function orderSelect(a) {
    $(".order_btns").each(function() {
        this.id == a ? $("#" + a).removeClass("alt") : $("#" + this.id).hasClass("alt") || $("#" + this.id).addClass("alt")
    })
}

function changeQuantity(a, b) {
    loading_show();
    var a = parseInt(a),
        c = {
            cart_id: a,
            flag: b,
            update_prod_quentity: 1
        },
        d = JSON.stringify(c);
    $.ajax({
        url: base_url + "includes/main.php",
        type: "POST",
        data: d,
        contentType: "application/json; charset=utf-8",
        async: !1,
        success: function(a) {
            data = JSON.parse(a), "Success" == data.Success ? (viewCart("content"), viewCart("checkout-page"), loading_hide()) : (loading_hide(), viewCart("content"))
        },
        error: function(a, b, c) {
            loading_hide(), viewCart("content")
        },
        complete: function() {}
    })
}

function buyNow(a) {
    loading_show(), addToCart(a), cust_session = $.trim($("#cust_session").val()), "" == cust_session ? window.location.href = "/page-cart" : window.location.href = "/page-checkout", loading_hide()
}

function submitThreadReview(a) {
    loading_show();
    var b = $.trim($("#thread_reply" + a).val()),
        c = $.trim($("#cust_session").val());
    if ("" == b) loading_hide(), $("#model_body").html('<span style="style="color:#F00;">Please Comment first </span>'), $("#error_model").modal("toggle");
    else {
        var d = {
                review_id: a,
                thread_reply: b,
                cust_session: c,
                insert_thread_review: 1
            },
            e = JSON.stringify(d);
        $.ajax({
            url: "includes/main.php",
            type: "POST",
            data: e,
            contentType: "application/json; charset=utf-8",
            success: function(a) {
                data = JSON.parse(a), "Success" == data.Success ? (location.reload(), loading_hide()) : ($("#model_body").html('<span style="style="color:#F00;">' + data.resp + "</span>"), $("#error_model").modal("toggle"), loading_hide())
            },
            error: function(a, b, c) {
                loading_hide(), $("#model_body").html('<span style="style="color:#F00;">' + a.responseText + "</span>"), $("#error_model").modal("toggle")
            },
            complete: function() {}
        })
    }
}

function getSuggestion(a) {
    if ("" == $.trim(a)) $("#search_suggestion").html(""), $("#search_suggestion").slideUp();
    else {
        var b = {
                search_text: a,
                search_on_front: 1
            },
            c = JSON.stringify(b);
        $.ajax({
            url: "includes/main.php",
            type: "POST",
            data: c,
            contentType: "application/json; charset=utf-8",
            success: function(a) {
                data = JSON.parse(a), "Success" == data.Success ? ($("#search_suggestion").html(data.resp), $("#search_suggestion").slideDown()) : ($("#search_suggestion").html(""), $("#search_suggestion").slideUp())
            },
            error: function(a, b, c) {
                loading_hide(), $("#model_body").html('<span style="style="color:#F00;">' + a.responseText + "</span>"), $("#error_model").modal("toggle")
            },
            complete: function() {}
        })
    }
}

function clearSearch() {
    $("#search_suggestion").html(""), $("#search_suggestion").slideUp()
}
var base_url = window.location.origin + "/";
$("#user_register").on("submit", function(a) {
    if (a.preventDefault(), $("#user_register").valid()) {
        loading_show();
        var b = $.trim($("#cust_fname_register").val()),
            c = $.trim($("#cust_lname_register").val()),
            d = $.trim($("#cust_email_register").val()),
            e = $.trim($("#cust_mobile_num_register").val()),
            f = $.trim($("#cust_address_register").val()),
            g = $.trim($("#cust_country_register").val()),
            h = $.trim($("#cust_state_register").val()),
            i = $.trim($("#cust_city_register").val()),
            j = $.trim($("#cust_pincode_register").val()),
            k = $.trim($("#cust_password_register").val()),
            l = $.trim($("#cust_cpassword_register").val()),
            m = $("input:radio[name=cust_type]:checked").val(),
            n = $("input:checkbox[name=Agreement]:checked").val(),
            o = navigator.userAgent,
            p = "";
        if (p = "0.0.0.0", "" == b || "" == c || "" == d || "" == e || "" == k || "" == l || "undefined" == typeof m || "undefined" == typeof n) $("#model_body").html('<span style="style="color:#F00;">Please fill all data.</span>'), $("#error_model").modal("toggle"), loading_hide();
        else {
            $('input[name="reg_submit_reg"]').attr("disabled", "true");
            var q = {
                    cust_fname: b,
                    cust_lname: c,
                    cust_email: d,
                    cust_mobile_num: e,
                    cust_address: f,
                    cust_country: g,
                    cust_state: h,
                    cust_city: i,
                    cust_pincode: j,
                    cust_password: k,
                    cli_browser_info: o,
                    cli_ip_address: p,
                    user_register: 1
                },
                r = JSON.stringify(q);
            $.ajax({
                url: base_url + "includes/main.php",
                type: "POST",
                data: r,
                async: !1,
                contentType: "application/json; charset=utf-8",
                success: function(a) {
                    data = JSON.parse(a), "Success" == data.Success ? ($("#model_body").html('<span style="style="color:#F00;">' + data.resp + "</span>"), $("#error_model").modal("toggle"), loading_hide(), $("button.close-popup").on("click", function() {
                        var a = $("#redirect_to").val();
                        "" != a ? window.location.href = base_url + a : window.location.href = base_url + "page-profile"
                    })) : (loading_hide(), $("#model_body").html('<span style="style="color:#F00;">' + data.resp + "</span>"), $("#error_model").modal("toggle"))
                },
                error: function(a, b, c) {
                    loading_hide(), $("#model_body").html('<span style="style="color:#F00;">' + a.responseText + "</span>"), $("#error_model").modal("toggle")
                },
                complete: function() {}
            })
        }
    }
}), $("#user_login").on("submit", function(a) {
    if (a.preventDefault(), $("#user_login").valid()) {
        loading_show();
        var b = $.trim($("#cust_email_login").val()),
            c = $.trim($("#cust_password_login").val()),
            d = navigator.userAgent,
            e = "";
        if (e = "0:0:0:0", "" == b || "" == c) loading_hide(), $("#model_body").html('<span style="style="color:#F00;">Please fill all data.</span>'), $("#error_model").modal("toggle");
        else {
            $('input[name="reg_submit_reg"]').attr("disabled", "true");
            var f = {
                    cust_email: b,
                    cust_password: c,
                    cli_browser_info: d,
                    cli_ip_address: e,
                    user_login: 1
                },
                g = JSON.stringify(f);
            $.ajax({
                url: base_url + "includes/main.php",
                type: "POST",
                data: g,
                contentType: "application/json; charset=utf-8",
                async: !1,
                success: function(a) {
                    if (data = JSON.parse(a), "Success" == data.Success) {
                        var b = $("#redirect_to").val();
                        return "" != b ? window.location.href = base_url + b : window.location.href = base_url + "page-profile", !1
                    }
                    loading_hide(), $("#model_body").html('<span style="style="color:#F00;">' + data.resp + "</span>"), $("#error_model").modal("toggle")
                },
                error: function(a, b, c) {
                    loading_hide(), $("#model_body").html('<span style="style="color:#F00;">' + a.responseText + "</span>"), $("#error_model").modal("toggle")
                },
                complete: function() {}
            })
        }
    }
}), $("#forget_pass").on("submit", function(a) {
    if (a.preventDefault(), $("#forget_pass").valid()) {
        loading_show();
        var b = $.trim($("#cust_email_fpass").val());
        if ("" == b) loading_hide(), $("#model_body").html('<span style="style="color:#F00;">Please enter email id.</span>'), $("#error_model").modal("toggle");
        else {
            $('input[name="forget_pass_submit"]').attr("disabled", "true");
            var c = {
                    cust_email: b,
                    forget_pass_mail_send: 1
                },
                d = JSON.stringify(c);
            $.ajax({
                url: base_url + "includes/main.php",
                type: "POST",
                data: d,
                contentType: "application/json; charset=utf-8",
                async: !1,
                success: function(a) {
                    data = JSON.parse(a), "Success" == data.Success ? ($("#forget_email_error").html(data.resp), $("#forget_email_error").show().fadeOut(5e3), loading_hide()) : ($("#forget_email_error").html(data.resp), $("#forget_email_error").show().fadeOut(5e3), loading_hide())
                },
                error: function(a, b, c) {
                    loading_hide(), $("#model_body").html('<span style="style="color:#F00;">' + a.responseText + "</span>"), $("#error_model").modal("toggle")
                },
                complete: function() {}
            })
        }
    }
}), $.validator.setDefaults({
    highlight: function(a) {
        $(a).closest(".form-group").addClass("has-error")
    },
    unhighlight: function(a) {
        $(a).closest(".form-group").removeClass("has-error")
    },
    errorElement: "span",
    errorClass: "help-block",
    errorPlacement: function(a, b) {
        b.parent(".input-group").length ? a.insertAfter(b.parent()) : a.insertAfter(b)
    }
}), $("#add_form").on("submit", function(a) {
    if (a.preventDefault(), $("#add_form").valid()) {
        loading_show();
        var b = $.trim($("#cust_session").val()),
            c = $.trim($("#add_address_type_new_address").val()),
            d = $.trim($("#cust_address_new_address").val()),
            e = $.trim($("#cust_country_new_address").val()),
            f = $.trim($("#cust_state_new_address").val()),
            g = $.trim($("#cust_city_new_address").val()),
            h = $.trim($("#cust_pincode_new_address").val());
        if ("" == d || "" == e || "" == f || "" == g || "" == h || "" == c) loading_hide(), $("#model_body").html('<span style="style="color:#F00;">Please fill all data.</span>'), $("#error_model").modal("toggle");
        else {
            $('input[name="reg_submit_new_address"]').attr("disabled", "true");
            var i = {
                    cust_session: b,
                    add_address_type: c,
                    cust_address: d,
                    cust_country: e,
                    cust_state: f,
                    cust_city: g,
                    cust_pincode: h,
                    add_new_address: 1
                },
                j = JSON.stringify(i);
            $.ajax({
                url: "includes/main.php",
                type: "POST",
                data: j,
                contentType: "application/json; charset=utf-8",
                async: !1,
                success: function(a) {
                    if (data = JSON.parse(a), "Success" == data.Success) {
                        var b = window.location.pathname,
                            c = b.substring(b.lastIndexOf("/") + 1);
                        "page-profile.php" == c ? ($("#new-address-block").slideUp(), $("#address_data").slideDown(), getAddressData("address_data")) : ($("#new-address-block").slideUp(), $("#select-address-block").slideDown(), getAddressData("select-address-main"))
                    } else loading_hide(), $("#model_body").html('<span style="style="color:#F00;">' + data.resp + "</span>"), $("#error_model").modal("toggle")
                },
                error: function(a, b, c) {
                    loading_hide(), $("#model_body").html('<span style="style="color:#F00;">' + a.responseText + "</span>"), $("#error_model").modal("toggle")
                },
                complete: function() {}
            })
        }
    }
}), $("#change_pass").on("submit", function(a) {
    if (a.preventDefault(), $("#change_pass").valid()) {
        loading_show();
        var b = $("#cust_session").val(),
            c = $.trim($("#cust_password_old_change_pass").val()),
            d = $.trim($("#cust_password_new_change_pass").val());
        if ("" == c || "" == d || "" == b) loading_hide(), $("#model_body").html('<span style="style="color:#F00;">Please fill all data.</span>'), $("#error_model").modal("toggle");
        else {
            $('input[name="reg_submit_pass"]').attr("disabled", "true");
            var e = {
                    cust_password_old: c,
                    cust_password_new: d,
                    cust_session: b,
                    change_password: 1
                },
                f = JSON.stringify(e);
            $.ajax({
                url: base_url + "includes/main.php",
                type: "POST",
                data: f,
                contentType: "application/json; charset=utf-8",
                async: !1,
                success: function(a) {
                    data = JSON.parse(a), "Success" == data.Success ? ($("#model_body").html('<span style="style="color:#F00;">' + data.resp + "</span>"), $("#error_model").modal("toggle"), loading_hide(), $("button.close-popup").on("click", function() {
                        return location.reload(), !1
                    })) : (loading_hide(), $("#model_body").html('<span style="style="color:#F00;">' + data.resp + "</span>"), $("#error_model").modal("toggle"))
                },
                error: function(a, b, c) {
                    loading_hide(), $("#model_body").html('<span style="style="color:#F00;">' + a.responseText + "</span>"), $("#error_model").modal("toggle")
                },
                complete: function() {}
            })
        }
    }
}), $("#user_update_info").on("submit", function(a) {
    a.preventDefault(), $("#user_update_info").valid() && (loading_show(), $.ajax({
        url: base_url + "includes/main.php",
        type: "POST",
        data: new FormData(this),
        contentType: !1,
        cache: !1,
        processData: !1,
        async: !0,
        success: function(a) {
            data = JSON.parse(a), "Success" == data.Success ? ($("#model_body").html('<span style="style="color:#F00;">' + data.resp + "</span>"), $("#error_model").modal("toggle"), loading_hide(), $("button.close-popup").on("click", function() {
                return location.reload(), !1
            })) : (loading_hide(), $("#model_body").html('<span style="style="color:#F00;">' + data.resp + "</span>"), $("#error_model").modal("toggle"))
        },
        error: function(a, b, c) {
            loading_hide(), $("#model_body").html('<span style="style="color:#F00;">' + a.responseText + "</span>"), $("#error_model").modal("toggle")
        },
        complete: function() {}
    }))
}), $("#mobile_verify").on("submit", function(a) {
    if (a.preventDefault(), $("#mobile_verify").valid()) {
        loading_show();
        var b = $("#cust_session").val(),
            c = $.trim($("#cust_mobile_status").val());
        if ("" == c && "" == b) loading_hide(), $("#model_body").html('<span style="style="color:#F00;">Please enter your OTP.</span>'), $("#error_model").modal("toggle");
        else {
            $('input[name="reg_submit_mob_verify"]').attr("disabled", "true");
            var d = {
                    cust_session: b,
                    cust_mobile_status: c,
                    cust_mobile_verify: 1
                },
                e = JSON.stringify(d);
            $.ajax({
                url: base_url + "includes/main.php",
                type: "POST",
                data: e,
                contentType: "application/json; charset=utf-8",
                async: !1,
                success: function(a) {
                    data = JSON.parse(a), "Success" == data.Success ? ($("#model_body").html('<span style="style="color:#F00;">' + data.resp + "</span>"), $("#error_model").modal("toggle"), loading_hide(), $("button.close-popup").on("click", function() {
                        return location.reload(), !1
                    })) : (loading_hide(), $("#model_body").html('<span style="style="color:#F00;">' + data.resp + "</span>"), $("#error_model").modal("toggle"))
                },
                error: function(a, b, c) {
                    loading_hide(), $("#model_body").html('<span style="style="color:#F00;">' + a.responseText + "</span>"), $("#error_model").modal("toggle")
                },
                complete: function() {}
            })
        }
    }
}), $("#reset_password").on("submit", function(a) {
    if (a.preventDefault(), $("#reset_password").valid()) {
        loading_show();
        var b = $("#cust_session").val(),
            c = $.trim($("#cust_password_new_reset").val());
        if ("" == b) $("#model_body").html('<span style="style="color:#F00;">Url expired...</span>'), $("#error_model").modal("toggle"), loading_hide(), window.location.href = "/";
        else if ("" == c) $("#model_body").html('<span style="style="color:#F00;">Please provide Password...</span>'), $("#error_model").modal("toggle"), loading_hide();
        else {
            $('input[name="reg_submit_password_reset"]').attr("disabled", "true");
            var d = {
                    cust_password_new: c,
                    cust_session: b,
                    reset_password: 1
                },
                e = JSON.stringify(d);
            $.ajax({
                url: base_url + "includes/main.php",
                type: "POST",
                data: e,
                contentType: "application/json; charset=utf-8",
                async: !1,
                success: function(a) {
                    data = JSON.parse(a), "Success" == data.Success ? ($("#model_body").html('<span style="style="color:#F00;">' + data.resp + "</span>"), $("#error_model").modal("toggle"), loading_hide(), $("button.close-popup").on("click", function() {
                        return window.location.href = "/page-profile", !1
                    })) : (loading_hide(), $("#model_body").html('<span style="style="color:#F00;">' + data.resp + "</span>"), $("#error_model").modal("toggle"))
                },
                error: function(a, b, c) {
                    loading_hide(), $("#model_body").html('<span style="style="color:#F00;">' + a.responseText + "</span>"), $("#error_model").modal("toggle")
                },
                complete: function() {}
            })
        }
    }
}), $("#user_contact").on("submit", function(a) {
    if (a.preventDefault(), $("#user_contact").valid()) {
        loading_show();
        var b = $.trim($("#conct_name").val()),
            c = $.trim($("#conct_email").val()),
            d = $.trim($("#conct_mobile_num").val()),
            e = "Planet Educate",
            f = $.trim($("textarea#conct_msg").val()),
            g = navigator.userAgent,
            h = "";
        if (cli_ip_address = "0.0.0.0", "" == b || "" == c || "" == d || "" == e || "" == f) $("#model_body").html('<span style="style="color:#F00;">Please fill all data.</span>'), $("#error_model").modal("toggle"), loading_hide();
        else {
            $('input[name="reg_submit_contact"]').attr("disabled", "true");
            var i = {
                    conct_name: b,
                    conct_email: c,
                    conct_sub: e,
                    conct_mobile_num: d,
                    conct_msg: f,
                    conct_user_ip: h,
                    conct_web_info: g,
                    user_contact_us: 1
                },
                j = JSON.stringify(i);
            $.ajax({
                url: base_url + "includes/main.php",
                type: "POST",
                data: j,
                contentType: "application/json; charset=utf-8",
                async: !1,
                success: function(a) {
                    data = JSON.parse(a), "Success" == data.Success ? ($("#model_body").html('<span style="style="color:#F00;">' + data.resp + "</span>"), $("#error_model").modal("toggle"), $("button.close-popup").on("click", function() {
                        return location.reload(), !1
                    }), loading_hide()) : ($("#model_body").html('<span style="style="color:#F00;">' + data.resp + "</span>"), $("#error_model").modal("toggle"), loading_hide())
                },
                error: function(a, b, c) {
                    $("#model_body").html('<span style="style="color:#F00;">' + a.responseText + "</span>"), $("#error_model").modal("toggle"), loading_hide()
                },
                complete: function() {}
            })
        }
    }
}), $("#comment-form").on("submit", function(a) {
    if (a.preventDefault(), $("#comment-form").valid()) {
        loading_show();
        var b = $.trim($("#cust_session").val()),
            c = $.trim($("#rating").val()),
            d = $.trim($("textarea#review_content").val()),
            e = $.trim($("#review_prod_id").val()),
            f = $.trim($("#review_title").val());
        if ("" == b) loading_hide(), $("#model_body").html('<span style="style="color:#F00;">Please Login.</span>'), $("#error_model").modal("toggle");
        else {
            $('input[name="submit_review"]').attr("disabled", "true");
            var g = {
                    cust_session: b,
                    rating: c,
                    review_content: d,
                    review_prod_id: e,
                    review_title: f,
                    insert_user_review: 1
                },
                h = JSON.stringify(g);
            $.ajax({
                url: "includes/main.php",
                type: "POST",
                data: h,
                contentType: "application/json; charset=utf-8",
                success: function(a) {
                    data = JSON.parse(a), "Success" == data.Success ? (location.reload(), loading_hide()) : ($("#model_body").html('<span style="style="color:#F00;">' + data.resp + "</span>"), $("#error_model").modal("toggle"), loading_hide())
                },
                error: function(a, b, c) {
                    loading_hide(), $("#model_body").html('<span style="style="color:#F00;">' + a.responseText + "</span>"), $("#error_model").modal("toggle")
                },
                complete: function() {}
            })
        }
    }
});