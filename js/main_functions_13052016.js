function ToggleMyDiv(e){$("#"+e).slideToggle()}function div_swap(e,o){$("#"+e).slideDown(),$("#"+o).slideUp()}function checkBoxStyle(e){chk_class=$("#"+e).attr("class"),"fa fa-check-empty"==chk_class?$("#"+e).removeClass("fa fa-check-empty").addClass("fa fa-check"):"fa fa-check"==chk_class&&$("#"+e).removeClass("fa fa-check").addClass("fa fa-check-empty")}function loading_show(){document.getElementById("lodermodal").style.display="block",document.getElementById("loderfade").style.display="block"}function loading_hide(){document.getElementById("lodermodal").style.display="none",document.getElementById("loderfade").style.display="none"}function changeClass(e){this_class=$("#"+e).attr("class"),"fa fa-chevron-up"==this_class?$("#"+e).removeClass("fa fa-chevron-up").addClass("fa fa-chevron-down"):"fa fa-chevron-down"==this_class&&$("#"+e).removeClass("fa fa-chevron-down").addClass("fa fa-chevron-up")}function isNumberKey(e){var o=e.which?e.which:event.keyCode;return o>31&&(48>o||o>57)?!1:!0}function viewCart(e){loading_show();var o=$("#cust_session").val(),t={cust_session:o,getCart:1},s=JSON.stringify(t);$.ajax({url:"includes/main.php",type:"POST",data:s,contentType:"application/json; charset=utf-8",success:function(o){data=JSON.parse(o),"Success"==data.Success?($("#"+e).html(data.resp),$("#cart-count").html(data.count),"content"==e&&0==data.checkout&&$("#checkout-process-btn").hide(),loading_hide()):($("#"+e).html(data.resp),$("#checkout_btn").slideUp(),"content"==e&&0==data.checkout&&$("#checkout-process-btn").hide(),loading_hide())},error:function(e,o,t){$("#model_body").html('<span style="style="color:#F00;">'+e.responseText+"</span>"),$("#error_model").modal("toggle"),loading_hide()},complete:function(){loading_hide()}})}function removeItem(e){loading_show();var o={cart_id:e,deleteFromCart:1},t=JSON.stringify(o);$.ajax({url:"includes/main.php",type:"POST",data:t,contentType:"application/json; charset=utf-8",success:function(e){data=JSON.parse(e),"Success"==data.Success?(viewCart("content"),loading_hide()):(loading_hide(),$("#model_body").html('<span style="style="color:#F00;">'+data.resp+"</span>"),$("#error_model").modal("toggle"))},error:function(e,o,t){loading_hide(),$("#model_body").html('<span style="style="color:#F00;">'+e.responseText+"</span>"),$("#error_model").modal("toggle")},complete:function(){loading_hide()}})}function addToCart(e){loading_show();var o=$("#cust_session").val(),t=$.trim($("#user_prod_quentity"+e).val());(""==t||"undefined"==typeof t)&&(t=1);var s=$("#coupon_code").val();if(""==e)location.href="index.php";else{var a={addToCart:1,prod_id:e,cust_session:o,user_prod_quentity:t,user_coupon_code:s},l=JSON.stringify(a);$.ajax({url:"includes/main.php",type:"POST",data:l,contentType:"application/json; charset=utf-8",success:function(e){data=JSON.parse(e),"Success"==data.Success?($("#my_cart").html(data.resp),$("#cart-count").html(data.count),loading_hide()):($("#model_body").html('<span style="style="color:#F00;">'+data.resp+"</span>"),$("#error_model").modal("toggle"),loading_hide())},error:function(e,o,t){$("#model_body").html('<span style="style="color:#F00;">'+e.responseText+"</span>"),$("#error_model").modal("toggle"),loading_hide()},complete:function(){loading_hide()}})}}function checkMobileUser(e,o,t,s){var a=$("#cust_session").val();if(""==e||""==o||""==t||""==s)$("#"+e).css("border-color",""),$("#"+s).html(""),$("#"+s).slideUp();else{var l={mobile_check:1,cust_mobile_num:o,req_page:t,cust_session:a},n=JSON.stringify(l);$.ajax({url:"includes/main.php",type:"POST",data:n,contentType:"application/json; charset=utf-8",success:function(o){data=JSON.parse(o),"Success"==data.Success?($("#"+e).css("border-color","#00FF00"),$("#"+s).html(""),$("#"+s).slideUp(),loading_hide()):($("#"+e).css("border-color","red"),$("#"+s).slideDown(),$("#"+s).html(data.resp),$("#"+e).val(""),loading_hide())},error:function(e,o,t){loading_hide(),$("#model_body").html('<span style="style="color:#F00;">'+e.responseText+"</span>"),$("#error_model").modal("toggle")},complete:function(){loading_hide()}})}}function updateState(e,o){if(loading_show(),country_val=$("#"+e).val(),""==country_val)loading_hide(),location.href="index.php";else{var t={update_state:1,country_val:country_val},s=JSON.stringify(t);$.ajax({url:"includes/main.php",type:"POST",data:s,contentType:"application/json; charset=utf-8",success:function(e){data=JSON.parse(e),"Success"==data.Success?($("#"+o).html(data.resp),loading_hide()):(loading_hide(),$("#model_body").html('<span style="style="color:#F00;">'+data.resp+"</span>"),$("#error_model").modal("toggle"))},error:function(e,o,t){loading_hide(),$("#model_body").html('<span style="style="color:#F00;">'+e.responseText+"</span>"),$("#error_model").modal("toggle")},complete:function(){loading_hide()}})}}function updateCity(e,o){if(loading_show(),state_val=$("#"+e).val(),""==state_val)location.href="index.php";else{var t={update_city:1,state_val:state_val},s=JSON.stringify(t);$.ajax({url:"includes/main.php",type:"POST",data:s,contentType:"application/json; charset=utf-8",success:function(e){data=JSON.parse(e),"Success"==data.Success?($("#"+o).html(data.resp),loading_hide()):(loading_hide(),$("#model_body").html('<span style="style="color:#F00;">'+data.resp+"</span>"),$("#error_model").modal("toggle"))},error:function(e,o,t){loading_hide(),$("#model_body").html('<span style="style="color:#F00;">'+e.responseText+"</span>"),$("#error_model").modal("toggle")},complete:function(){loading_hide()}})}}function checkEmailUser(e,o,t,s){var a=$("#cust_session").val();if(""==o||""==e||""==t||""==s)$("#"+e).css("border-color",""),$("#"+s).html(""),$("#"+s).slideUp();else{var l={email_check:1,cust_email:o,req_page:t,cust_session:a},n=JSON.stringify(l);$.ajax({url:"includes/main.php",type:"POST",data:n,contentType:"application/json; charset=utf-8",success:function(o){data=JSON.parse(o),"Success"==data.Success?($("#"+e).css("border-color","#00FF00"),$("#"+s).html(""),$("#"+s).slideUp(),loading_hide()):($("#"+e).css("border-color","red"),$("#"+s).slideDown(),$("#"+s).html(data.resp),$("#"+e).val(""),loading_hide())},error:function(e,o,t){loading_hide(),$("#model_body").html('<span style="style="color:#F00;">'+e.responseText+"</span>"),$("#error_model").modal("toggle")},complete:function(){loading_hide()}})}}function chk_password(e,o,t){var s=$.trim($("#"+e).val()),a=$.trim($("#"+o).val());""!=s&&""!=a&&(s==a?$("#"+t).html('<span style="color:green;">Password Matched...</span>'):$("#"+t).html('<span style="color:red;">Password Not Matched...</span>'))}function checkStrength(e,o){var t=$("#"+e).val(),s=0;(t.length=0)&&($("#"+o).removeClass(),$("#"+o).addClass("short"),$("#"+o).html("")),t.length<8&&($("#"+o).removeClass(),$("#"+o).addClass("short"),$("#"+o).html("Too short")),t.length>7&&(s+=1),t.match(/([a-z].*[A-Z])|([A-Z].*[a-z])/)&&(s+=1),t.match(/([a-zA-Z])/)&&t.match(/([0-9])/)&&(s+=1),t.match(/([!,%,&,@,#,$,^,*,?,_,~])/)&&(s+=1),t.match(/(.*[!,%,&,@,#,$,^,*,?,_,~].*[!,%,&,@,#,$,^,*,?,_,~])/)&&(s+=1),2>s?($("#"+o).removeClass(),$("#"+o).addClass("weak"),$("#"+o).html("Weak")):2==s?($("#"+o).removeClass(),$("#"+o).addClass("good"),$("#"+o).html("Good")):($("#"+o).removeClass(),$("#"+o).addClass("strong"),$("#"+o).html("Strong"))}function logout_session(e){if(loading_show(),""==e)location.href="index.php";else{var o={logout_this:1,session_value:e},t=JSON.stringify(o);$.ajax({url:"includes/main.php",type:"POST",data:t,contentType:"application/json; charset=utf-8",success:function(e){data=JSON.parse(e),"Success"==data.Success?window.location.href="index.php":(loading_hide(),$("#model_body").html('<span style="style="color:#F00;">'+data.resp+"</span>"),$("#error_model").modal("toggle"))},error:function(e,o,t){loading_hide(),$("#model_body").html('<span style="style="color:#F00;">'+e.responseText+"</span>"),$("#error_model").modal("toggle")},complete:function(){loading_hide()}})}}function updateCoupon(){loading_show();var e=$("#coupon_code").val(),o=$("#cust_session").val();if(""==o)window.location.href="page-profile.php";else if(""==e)$("#model_body").html('<span style="style="color:#F00;">Coupon Code empty.</span>'),$("#error_model").modal("toggle"),loading_hide();else{var t={user_coupon_code:e,cust_session:o,update_coupon:1},s=JSON.stringify(t);$.ajax({url:"includes/main.php",type:"POST",data:s,contentType:"application/json; charset=utf-8",success:function(e){data=JSON.parse(e),"Success"==data.Success?($("#cart_page").slideUp(),viewCart("cart_page"),$("#cart_page").slideDown(),loading_hide()):(loading_hide(),$("#model_body").html('<span style="style="color:#F00;">'+data.resp+"</span>"),$("#error_model").modal("toggle"))},error:function(e,o,t){loading_hide(),$("#model_body").html('<span style="style="color:#F00;">'+e.responseText+"</span>"),$("#error_model").modal("toggle")},complete:function(){loading_hide()}})}}function getAddressData(e){if(loading_show(),cust_session=$("#cust_session").val(),""==cust_session)window.location.href="index.php";else{var o={loadAddress:1,cust_session:cust_session},t=JSON.stringify(o);$.ajax({url:"includes/main.php",type:"POST",data:t,contentType:"application/json; charset=utf-8",success:function(o){data=JSON.parse(o),"Success"==data.Success?($("#"+e).slideDown(),$("#"+e).html(data.resp),loading_hide()):($("#"+e).slideDown(),$("#"+e).html(data.resp),loading_hide())},error:function(e,o,t){loading_hide()},complete:function(){loading_hide()}})}}function placeOrder(){loading_show();var e=$("#cust_session").val(),o="";$(".my-address-box").each(function(){$("#"+this.id).hasClass("alt")||(o=this.id)});var t=$("input[name=payment_mode]:checked").val(),s=$.trim($("textarea#ord_comment").val());if(""==e||""==o)loading_hide(),$("#model_body").html('<span style="style="color:#F00;">Please select Address.</span>'),$("#error_model").modal("toggle");else if(""==t)loading_hide(),$("#model_body").html('<span style="style="color:#F00;">Please Select palyment Mode</span>'),$("#error_model").modal("toggle");else{var a={cust_session:e,add_id:o,payment_mode:t,ord_comment:s,placeOrder:1},l=JSON.stringify(a);$.ajax({url:"includes/main.php",type:"POST",data:l,contentType:"application/json; charset=utf-8",success:function(e){data=JSON.parse(e),"Success"==data.Success?(loading_hide(),$("#model_body").html('<span style="style="color:#F00;">'+data.resp+"</span>"),$("#error_model").modal("toggle"),loading_hide(),$("button.close-popup").on("click",function(){return window.location.href="page-profile.php",!1})):(loading_hide(),$("#model_body").html('<span style="style="color:#F00;">'+data.resp+"</span>"),$("#error_model").modal("toggle"))},error:function(e,o,t){loading_hide(),$("#model_body").html('<span style="style="color:#F00;">'+e.responseText+"</span>"),$("#error_model").modal("toggle")},complete:function(){loading_hide()}})}}function showOrders(e){loading_show();var o=$("#cust_session").val();if(""==o)location.href="index.php";else{$('input[name="reg_submit_pass"]').attr("disabled","true");var t={cust_session:o,order_id:e,show_orders:1},s=JSON.stringify(t);$.ajax({url:"includes/main.php",type:"POST",data:s,contentType:"application/json; charset=utf-8",success:function(e){data=JSON.parse(e),"Success"==data.Success?($("#order_data").html(data.resp),loading_hide()):($("#order_data").html(data.resp),loading_hide())},error:function(e,o,t){loading_hide(),$("#model_body").html('<span style="style="color:#F00;">'+e.responseText+"</span>"),$("#error_model").modal("toggle")},complete:function(){loading_hide()}})}}function getOrdersList(){loading_show();var e=$("#cust_session").val();if(""==e)location.href="index.php";else{var o={cust_session:e,get_orders:1},t=JSON.stringify(o);$.ajax({url:"includes/main.php",type:"POST",data:t,contentType:"application/json; charset=utf-8",success:function(e){data=JSON.parse(e),"Success"==data.Success?($("#order_list").html(data.resp),$("#users_orders").slideDown(),loading_hide()):loading_hide()},error:function(e,o,t){loading_hide(),$("#model_body").html('<span style="style="color:#F00;">'+e.responseText+"</span>"),$("#error_model").modal("toggle")},complete:function(){loading_hide()}})}}function sendVerificationCode(e){loading_show();var o=$("#cust_session").val();if(""==o)loading_hide(),location.href="index.php";else{$('input[name="reg_submit_mob_verify"]').attr("disabled","true");var t={cust_session:o,req_type:e,send_code:1},s=JSON.stringify(t);$.ajax({url:"includes/main.php",type:"POST",data:s,contentType:"application/json; charset=utf-8",success:function(e){data=JSON.parse(e),"Success"==data.Success?($("#model_body").html('<span style="style="color:#F00;">'+data.resp+"</span>"),$("#error_model").modal("toggle"),loading_hide()):(loading_hide(),$("#model_body").html('<span style="style="color:#F00;">'+data.resp+"</span>"),$("#error_model").modal("toggle"))},error:function(e,o,t){loading_hide(),$("#model_body").html('<span style="style="color:#F00;">'+e.responseText+"</span>"),$("#error_model").modal("toggle")},complete:function(){loading_hide()}})}}function addressSelect(e){$(".my-address-box").each(function(){this.id==e?($("#"+e).removeClass("alt"),$("#"+e).html('<i class="fa fa-check"></i>Selected')):$("#"+this.id).hasClass("alt")||($("#"+this.id).addClass("alt"),$("#"+this.id).html("Select"))})}function orderSelect(e){$(".order_btns").each(function(){this.id==e?$("#"+e).removeClass("alt"):$("#"+this.id).hasClass("alt")||$("#"+this.id).addClass("alt")})}function changeQuantity(e,o){var e=parseInt(e),t={cart_id:e,flag:o,update_prod_quentity:1},s=JSON.stringify(t);$.ajax({url:"includes/main.php",type:"POST",data:s,contentType:"application/json; charset=utf-8",success:function(e){data=JSON.parse(e),"Success"==data.Success?(viewCart("content"),loading_hide()):(loading_hide(),viewCart("content"))},error:function(e,o,t){loading_hide(),viewCart("content")},complete:function(){loading_hide()}})}function buyNow(e){loading_show(),addToCart(e),cust_session=$.trim($("#cust_session").val()),""==cust_session?($("#model_body").html('<span style="style="color:#F00;">Please Login for Checkout...</span>'),$("#error_model").modal("toggle")):window.location.href="page-checkout.php",loading_hide()}$("#user_register").on("submit",function(e){if(e.preventDefault(),$("#user_register").valid()){loading_show();var o=$.trim($("#cust_fname_register").val()),t=$.trim($("#cust_lname_register").val()),s=$.trim($("#cust_email_register").val()),a=$.trim($("#cust_mobile_num_register").val()),l=$.trim($("#cust_address_register").val()),n=$.trim($("#cust_country_register").val()),d=$.trim($("#cust_state_register").val()),r=$.trim($("#cust_city_register").val()),i=$.trim($("#cust_pincode_register").val()),c=$.trim($("#cust_password_register").val()),p=$.trim($("#cust_cpassword_register").val()),_=navigator.userAgent,u="";if($.get("http://ipinfo.io",function(e){u=e.ip},"jsonp"),""==o||""==t||""==s||""==a||""==c||""==p)$("#model_body").html('<span style="style="color:#F00;">Please fill all data.</span>'),$("#error_model").modal("toggle"),loading_hide();else{$('input[name="reg_submit_reg"]').attr("disabled","true");var m={cust_fname:o,cust_lname:t,cust_email:s,cust_mobile_num:a,cust_address:l,cust_country:n,cust_state:d,cust_city:r,cust_pincode:i,cust_password:c,cli_browser_info:_,cli_ip_address:u,user_register:1},h=JSON.stringify(m);$.ajax({url:"includes/main.php",type:"POST",data:h,contentType:"application/json; charset=utf-8",success:function(e){data=JSON.parse(e),"Success"==data.Success?($("#model_body").html('<span style="style="color:#F00;">'+data.resp+"</span>"),$("#error_model").modal("toggle"),loading_hide(),$("button.close-popup").on("click",function(){return window.location.href="page-profile.php",!1})):(loading_hide(),$("#model_body").html('<span style="style="color:#F00;">'+data.resp+"</span>"),$("#error_model").modal("toggle"))},error:function(e,o,t){loading_hide(),$("#model_body").html('<span style="style="color:#F00;">'+e.responseText+"</span>"),$("#error_model").modal("toggle")},complete:function(){loading_hide()}})}}}),$("#user_login").on("submit",function(e){if(e.preventDefault(),$("#user_login").valid()){loading_show();var o=$.trim($("#cust_email_login").val()),t=$.trim($("#cust_password_login").val()),s=navigator.userAgent,a="";if($.getJSON("http://jsonip.com/?callback=?",function(e){console.log(e),a=e.ip}),""==o||""==t)loading_hide(),$("#model_body").html('<span style="style="color:#F00;">Please fill all data.</span>'),$("#error_model").modal("toggle");else{$('input[name="reg_submit_reg"]').attr("disabled","true");var l={cust_email:o,cust_password:t,cli_browser_info:s,cli_ip_address:a,user_login:1},n=JSON.stringify(l);$.ajax({url:"includes/main.php",type:"POST",data:n,contentType:"application/json; charset=utf-8",success:function(e){data=JSON.parse(e),"Success"==data.Success?($("#model_body").html('<span style="style="color:#F00;">'+data.resp+"</span>"),$("#error_model").modal("toggle"),loading_hide(),$("button.close-popup").on("click",function(){return window.location.href="page-profile.php",!1})):(loading_hide(),$("#model_body").html('<span style="style="color:#F00;">'+data.resp+"</span>"),$("#error_model").modal("toggle"))},error:function(e,o,t){loading_hide(),$("#model_body").html('<span style="style="color:#F00;">'+e.responseText+"</span>"),$("#error_model").modal("toggle")},complete:function(){loading_hide()}})}}}),$("#forget_pass").on("submit",function(e){if(e.preventDefault(),$("#forget_pass").valid()){loading_show();var o=$.trim($("#cust_email_fpass").val());if(""==o)loading_hide(),$("#model_body").html('<span style="style="color:#F00;">Please enter email id.</span>'),$("#error_model").modal("toggle");else{$('input[name="forget_pass_submit"]').attr("disabled","true");var t={cust_email:o,forget_pass_mail_send:1},s=JSON.stringify(t);$.ajax({url:"includes/main.php",type:"POST",data:s,contentType:"application/json; charset=utf-8",success:function(e){data=JSON.parse(e),"Success"==data.Success?($("#forget_msg").html(data.resp),$("#forget_msg").show().fadeOut(5e3),loading_hide()):($("#forget_msg").html(data.resp),$("#forget_msg").show().fadeOut(5e3),loading_hide())},error:function(e,o,t){loading_hide(),$("#model_body").html('<span style="style="color:#F00;">'+e.responseText+"</span>"),$("#error_model").modal("toggle")},complete:function(){loading_hide()}})}}}),$.validator.setDefaults({highlight:function(e){$(e).closest(".form-group").addClass("has-error")},unhighlight:function(e){$(e).closest(".form-group").removeClass("has-error")},errorElement:"span",errorClass:"help-block",errorPlacement:function(e,o){o.parent(".input-group").length?e.insertAfter(o.parent()):e.insertAfter(o)}}),$("#add_form").on("submit",function(e){if(e.preventDefault(),$("#add_form").valid()){loading_show();var o=$.trim($("#cust_session").val()),t=$.trim($("#add_address_type_new_address").val()),s=$.trim($("#cust_address_new_address").val()),a=$.trim($("#cust_country_new_address").val()),l=$.trim($("#cust_state_new_address").val()),n=$.trim($("#cust_city_new_address").val()),d=$.trim($("#cust_pincode_new_address").val());if(""==s||""==a||""==l||""==n||""==d||""==t)loading_hide(),$("#model_body").html('<span style="style="color:#F00;">Please fill all data.</span>'),$("#error_model").modal("toggle");else{$('input[name="reg_submit_new_address"]').attr("disabled","true");var r={cust_session:o,add_address_type:t,cust_address:s,cust_country:a,cust_state:l,cust_city:n,cust_pincode:d,add_new_address:1},i=JSON.stringify(r);$.ajax({url:"includes/main.php",type:"POST",data:i,contentType:"application/json; charset=utf-8",success:function(e){if(data=JSON.parse(e),"Success"==data.Success){var o=window.location.pathname,t=o.substring(o.lastIndexOf("/")+1);"page-profile.php"==t?($("#new-address-block").slideUp(),$("#address_data").slideDown(),getAddressData("address_data")):($("#new-address-block").slideUp(),$("#select-address-block").slideDown(),getAddressData("select-address-main"))}else loading_hide(),$("#model_body").html('<span style="style="color:#F00;">'+data.resp+"</span>"),$("#error_model").modal("toggle")},error:function(e,o,t){loading_hide(),$("#model_body").html('<span style="style="color:#F00;">'+e.responseText+"</span>"),$("#error_model").modal("toggle")},complete:function(){loading_hide()}})}}}),$("#change_pass").on("submit",function(e){if(e.preventDefault(),$("#change_pass").valid()){loading_show();var o=$("#cust_session").val(),t=$.trim($("#cust_password_old_change_pass").val()),s=$.trim($("#cust_password_new_change_pass").val());if(""==t||""==s||""==o)loading_hide(),$("#model_body").html('<span style="style="color:#F00;">Please fill all data.</span>'),$("#error_model").modal("toggle");else{$('input[name="reg_submit_pass"]').attr("disabled","true");var a={cust_password_old:t,cust_password_new:s,cust_session:o,change_password:1},l=JSON.stringify(a);$.ajax({url:"includes/main.php",type:"POST",data:l,contentType:"application/json; charset=utf-8",success:function(e){data=JSON.parse(e),"Success"==data.Success?($("#model_body").html('<span style="style="color:#F00;">'+data.resp+"</span>"),$("#error_model").modal("toggle"),loading_hide(),$("button.close-popup").on("click",function(){return location.reload(),!1})):(loading_hide(),$("#model_body").html('<span style="style="color:#F00;">'+data.resp+"</span>"),$("#error_model").modal("toggle"))},error:function(e,o,t){loading_hide(),$("#model_body").html('<span style="style="color:#F00;">'+e.responseText+"</span>"),$("#error_model").modal("toggle")},complete:function(){loading_hide()}})}}}),$("#user_update_info").on("submit",function(e){if(e.preventDefault(),$("#user_update_info").valid()){loading_show();var o=$("#cust_session").val(),t=$.trim($("#cust_fname_update").val()),s=$.trim($("#cust_lname_update").val()),a=$.trim($("#cust_email_update").val()),l=$.trim($("#cust_mobile_num_update").val());if(""==t||""==s||""==a||""==l||""==o)loading_hide(),$("#model_body").html('<span style="style="color:#F00;">Please fill all data.</span>'),$("#error_model").modal("toggle");else{$('input[name="reg_submit_update"]').attr("disabled","true");var n={cust_fname_update:t,cust_lname_update:s,cust_email_update:a,cust_mobile_num_update:l,cust_session:o,update_customer:1},d=JSON.stringify(n);$.ajax({url:"includes/main.php",type:"POST",data:d,contentType:"application/json; charset=utf-8",success:function(e){data=JSON.parse(e),"Success"==data.Success?($("#model_body").html('<span style="style="color:#F00;">'+data.resp+"</span>"),$("#error_model").modal("toggle"),loading_hide(),$("button.close-popup").on("click",function(){return location.reload(),!1})):(loading_hide(),$("#model_body").html('<span style="style="color:#F00;">'+data.resp+"</span>"),$("#error_model").modal("toggle"))},error:function(e,o,t){loading_hide(),$("#model_body").html('<span style="style="color:#F00;">'+e.responseText+"</span>"),$("#error_model").modal("toggle")},complete:function(){loading_hide()}})}}}),$("#mobile_verify").on("submit",function(e){if(e.preventDefault(),$("#mobile_verify").valid()){loading_show();var o=$("#cust_session").val(),t=$.trim($("#cust_mobile_status").val());if(""==t&&""==o)loading_hide(),$("#model_body").html('<span style="style="color:#F00;">Please enter your OTP.</span>'),$("#error_model").modal("toggle");else{$('input[name="reg_submit_mob_verify"]').attr("disabled","true");var s={cust_session:o,cust_mobile_status:t,cust_mobile_verify:1},a=JSON.stringify(s);$.ajax({url:"includes/main.php",type:"POST",data:a,contentType:"application/json; charset=utf-8",success:function(e){data=JSON.parse(e),"Success"==data.Success?($("#model_body").html('<span style="style="color:#F00;">'+data.resp+"</span>"),$("#error_model").modal("toggle"),loading_hide(),$("button.close-popup").on("click",function(){return location.reload(),!1})):(loading_hide(),$("#model_body").html('<span style="style="color:#F00;">'+data.resp+"</span>"),$("#error_model").modal("toggle"))},error:function(e,o,t){loading_hide(),$("#model_body").html('<span style="style="color:#F00;">'+e.responseText+"</span>"),$("#error_model").modal("toggle")},complete:function(){loading_hide()}})}}}),$("#reset_password").on("submit",function(e){if(e.preventDefault(),$("#reset_password").valid()){loading_show();var o=$("#cust_session").val(),t=$.trim($("#cust_password_new_reset").val());if(""==o)$("#model_body").html('<span style="style="color:#F00;">Url expired...</span>'),$("#error_model").modal("toggle"),loading_hide(),window.location.href="index.php";else if(""==t)$("#model_body").html('<span style="style="color:#F00;">Please provide Password...</span>'),$("#error_model").modal("toggle"),loading_hide();else{$('input[name="reg_submit_password_reset"]').attr("disabled","true");var s={cust_password_new:t,cust_session:o,reset_password:1},a=JSON.stringify(s);$.ajax({url:"includes/main.php",type:"POST",data:a,contentType:"application/json; charset=utf-8",success:function(e){data=JSON.parse(e),"Success"==data.Success?($("#model_body").html('<span style="style="color:#F00;">'+data.resp+"</span>"),$("#error_model").modal("toggle"),loading_hide(),$("button.close-popup").on("click",function(){return window.location.href="page-profile.php",!1})):(loading_hide(),$("#model_body").html('<span style="style="color:#F00;">'+data.resp+"</span>"),$("#error_model").modal("toggle"))},error:function(e,o,t){loading_hide(),$("#model_body").html('<span style="style="color:#F00;">'+e.responseText+"</span>"),$("#error_model").modal("toggle")},complete:function(){loading_hide()}})}}}),$("#user_contact").on("submit",function(e){if(e.preventDefault(),$("#user_contact").valid()){loading_show();var o=$.trim($("#conct_name").val()),t=$.trim($("#conct_email").val()),s=$.trim($("#conct_mobile_num").val()),a="Planet Educate",l=$.trim($("textarea#conct_msg").val()),n=navigator.userAgent,d="";if($.get("http://ipinfo.io",function(e){cli_ip_address=e.ip},"jsonp"),""==o||""==t||""==s||""==a||""==l)$("#model_body").html('<span style="style="color:#F00;">Please fill all data.</span>'),$("#error_model").modal("toggle"),loading_hide();else{$('input[name="reg_submit_contact"]').attr("disabled","true");var r={conct_name:o,conct_email:t,conct_sub:a,conct_mobile_num:s,conct_msg:l,conct_user_ip:d,conct_web_info:n,user_contact_us:1},i=JSON.stringify(r);$.ajax({url:"includes/main.php",type:"POST",data:i,contentType:"application/json; charset=utf-8",success:function(e){data=JSON.parse(e),"Success"==data.Success?($("#model_body").html('<span style="style="color:#F00;">'+data.resp+"</span>"),$("#error_model").modal("toggle"),$("button.close-popup").on("click",function(){return location.reload(),!1}),loading_hide()):($("#model_body").html('<span style="style="color:#F00;">'+data.resp+"</span>"),$("#error_model").modal("toggle"),loading_hide())},error:function(e,o,t){$("#model_body").html('<span style="style="color:#F00;">'+e.responseText+"</span>"),$("#error_model").modal("toggle"),loading_hide()},complete:function(){loading_hide()}})}}});