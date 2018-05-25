$(function () {
    
    

    //注册首页 pc验证
    var Forms = {};
    $(".Review .determine").click(function(){
        var valid = true;
        var Forms = {
            username : $("#username").val(),
            tel : $("#tel").val(),
            email : $("#email").val(),
            Orders : $("#Orders").val()
        };
        console.log(Forms);
        if(valid && !name(Forms.username)){
            valid = false;
            $("#username").css('borderColor','red');
            // var tips = $("#username").attr("data-foolish-msg");
            $("#username").focus();


        }else{
            $("#username").css('border','1px solid #6aaaf2');
        }

        if(valid && !checkMobile(Forms.tel)){
            valid = false;
            $("#tel").css('borderColor','red');
            // var tips = $("#tel").attr("data-foolish-msg");
            $("#tel").focus();


        }else{
            $("#tel").css('border','1px solid #6aaaf2');
        }
        
        if(valid && Forms.email.length>0){
            if(!email(Forms.email)){
                valid = false;
                $("#email").css('border','1px solid red');
                $("#email").focus();
            }else{
                $("#email").css('border','1px solid #6aaaf2');
            }
           
        }else{
             $("#email").css('border','1px solid #6aaaf2');
        }

        if(valid && !OrdersTwo(Forms.Orders)){
            valid = false;
            $("#Orders").css('border','1px solid red');
            // var tips = $("#Orders").attr("data-foolish-msg");
            $("#Orders").focus();


        }else{
            $("#Orders").css('border','1px solid #6aaaf2');
        }
        
        
       


        function name(mobile){
            if((/^[\u4E00-\u9FA5A-Za-z]+$/.test(mobile))){
                return true;
            }else{
                return false;
            }
        }



        function checkMobile(mobile){
            if((/^1[3|4|5|6|7|8]\d{9}$/.test(mobile))){
                return true;
            }else{
                return false;
            }
        }
        function email(str){
            if ((/\w[-\w.+]*@([A-Za-z0-9][-A-Za-z0-9]+\.)+[A-Za-z]{2,14}/.test(str))){
                   return true;
               }else{
                   return false;
               }
       }

        function OrdersTwo(mobile) {
            if((/(^\d{15}$)|(^\d{18}$)|(^\d{17}(\d|X|x)$)/.test(mobile))){
                return true;
            }else if((/^[a-zA-Z]{5,17}$/.test(mobile))){
                return true;
            }else if((/^[a-zA-Z0-9]{5,17}$/.test(mobile))){
                return true;
            }else{
                return false;
            }
        }

        if(!valid){
                            return false;
                        }
     
            layui.use(['layer'], function(){
                var layer = layui.layer;
                var index = layer.load();
                $.ajax({
                 url:signurl,
                 data:{cardId:Forms.Orders,mobile:Forms.tel,realname:Forms.username},
                 dataType:'json',
		 type:'post',
                 async: false,
                 success:function(data){
                     if(data.code==1){
                         
                     

                        $.ajax({
                         url:validurl,
                         data:{cardId:Forms.Orders,mobile:Forms.tel,realname:Forms.username,signature:data.data},
                         dataType:'json',
                         type:'post',
                         async: false,
                         success:function(res){
                            
                             if(res.code==-1){
                                 layer.msg('签名校验错误!', {'time' : 2000});
                                
                             }
                             if(res.code==1){
                                 layer.msg('用户不存在，您的信息无注册权限!', {'time' : 2000});
                                 
                             }
                             if(res.code==2){
                                 layer.msg('您的合同已过期，暂无注册权限!', {'time' : 2000});
                                
                             }
                             if(res.code==3){
                                 $.ajax({
                                        url:saveform,
                                        data:{cardId:Forms.Orders,mobile:Forms.tel,realname:Forms.username,signature:data.data},
                                        dataType:'json',
                                        type:'post',
                                        async: false,
                                        success:function(sdata){
                                           if(sdata.code==0){
                                               layer.msg(sdata.msg, {'time' : 2000});
                                           }else{
                                                $(".Review").css('display','none');
                                                $(".idcard").css('display','block');
                                                $("telVal").text(Forms.tel);

                                                $("#telVal").text($("#tel").val()); //获取电话号码
                                                var str = $("#telVal").text();
                                                $("#telVal").html(str.substring(0,3)+"****"+str.substring(7,11)) //号码加密
                                           }
                                        }
                                    });
                                 
                                
                             }
                              
                         }
                         });
            
                        // $(".Review").css('display','none');
                        //        $(".idcard").css('display','block');
                        //        $("telVal").text(Forms.tel);

                        //        $("#telVal").text($("#tel").val()); //获取电话号码
                        //        var str = $("#telVal").text();
                        //        $("#telVal").html(str.substring(0,3)+"****"+str.substring(7,11)) //号码加密
                                
                     }else{
                         layer.msg('获取签名失败', {'time' : 2000});
                         
                        return false;
                     }
                    
                 },
                 error:function(data){
                     layer.msg('服务器连接失败', {'time' : 2000});
                    
                     
                 }
                });
                layer.close(index); 
            });
             
           
       
         
    });
// 注册首页PC 验证

//$("#email").focus(function(){ 
//    var emailOne = $("#email").val();
//    if(!email(emailOne)){
//        $("#email").css('border','1px solid red');
//        $("#email").focus();
//        // $(".Review .determine").attr({'disabled': 'disabled'});
//        return false;
//    }else{
//        $("#email").css('border','1px solid #6aaaf2');
//        return true;
//    }
//    
//});
//$("#email").blur(function(){
//    var emailOne = $("#email").val();
//    if(!email(emailOne)){
//        $("#email").css('border','1px solid red');
//        $("#email").focus();
//        // $(".Review .determine").attr({'disabled':'disabled'});
//        return false;
//    }else{
//        $("#email").css('border','1px solid #6aaaf2');
//        return true;
//    }
//
//})





// var email = $("#email").val();
//         var Email =  ;
//         if(email !Email.test(email)){
//             alert("213")
//             $("#email").css('border','1px solid red');
//         }else{
//             $("#email").css('border','1px solid #6aaaf2');
//         }

   
//     });

//注册首页手机端验证
    $(".modal_btn button").click(function(){
        var valid = true;
        var Forms = {
            username : $("#username").val(),
            tel : $("#tel").val(),
            email : $("#email").val(),
            Orders : $("#Orders").val()
        };
        console.log(Forms);
        if(valid && !name(Forms.username)){
            valid = false;
            $("#username").focus();
        }else{
        }
        if(valid && !checkMobile(Forms.tel) ){
            valid = false;
            $("#tel").focus();


        }else{
            $("#tel").css('border','1px solid transparent');
        }
        
        if(valid && Forms.email.length>0){
            if(!email(Forms.email)){
                valid = false;
                $("#email").focus();
            }else{
                $("#tel").css('border','1px solid transparent');
            }
           
        }else{
             $("#tel").css('border','1px solid transparent');
        }

        if(valid && !OrdersTwo(Forms.Orders)){
            valid = false;
            $("#Orders").focus();
        }else{
            $("#Orders").css('border','1px solid transparent');
        }

        function name(mobile){
            if((/^[\u4E00-\u9FA5A-Za-z]+$/.test(mobile))){
                return true;
            }else{
                return false;
            }
        }

        function EmailTwo(mobile) {
            // body...
        }
        function checkMobile(mobile){
            if((/^1[3|4|5|6|7|8]\d{9}$/.test(mobile))){
                return true;
            }else{
                return false;
            }
        }
         function email(str){
            if ((/^([a-zA-Z0-9_-])+@([a-zA-Z0-9_-])+(.[a-zA-Z0-9_-])+/.test(str))){
                   return true;
               }else{
                   return false;
               }
       }
        function OrdersTwo(mobile) {
            if((/(^\d{15}$)|(^\d{18}$)|(^\d{17}(\d|X|x)$)/.test(mobile))){
                return true;
            }else if((/^[a-zA-Z]{5,17}$/.test(mobile))){
                return true;
            }else if((/^[a-zA-Z0-9]{5,17}$/.test(mobile))){
                return true;
            }else{
                return false;
            }
        }
         if(!valid){
                            return false;
                        }
     
            layui.use(['layer'], function(){
                var layer = layui.layer;
                var index = layer.load();
                $.ajax({
                 url:signurl,
                 data:{cardId:Forms.Orders,mobile:Forms.tel,realname:Forms.username},
                 dataType:'json',
		 type:'post',
                 async: false,
                 success:function(data){
                     if(data.code==1){
                         
                     
                        $.ajax({
                         url:validurl,
                         data:{cardId:Forms.Orders,mobile:Forms.tel,realname:Forms.username,signature:data.data},
                         dataType:'json',
                         type:'post',
                         async: false,
                         success:function(res){
                             
                             if(res.code==-1){
                                 layer.msg('签名校验错误!', {'time' : 2000});
                                
                             }
                             if(res.code==1){
                                 layer.msg('用户不存在，您的信息无注册权限!', {'time' : 2000});
                                
                             }
                             if(res.code==2){
                                 layer.msg('您的合同已过期，暂无注册权限!', {'time' : 2000});
                                 
                             }
                             if(res.code==3){
                                 $.ajax({
                                        url:saveform,
                                        data:{cardId:Forms.Orders,mobile:Forms.tel,realname:Forms.username,signature:data.data},
                                        dataType:'json',
                                        type:'post',
                                        async: false,
                                        success:function(sdata){
                                           if(sdata.code==0){
                                               layer.msg(sdata.msg, {'time' : 2000});
                                           }else{
                                               $(".Review").css('display','none');
                                                $(".idcard").css('display','block');
                                                $("telVal").text(Forms.tel);

                                                $("#telVal").text($("#tel").val()); //获取电话号码
                                                var str = $("#telVal").text();
                                                $("#telVal").html(str.substring(0,3)+"****"+str.substring(7,11)) //号码加密
                                           }
                                        }
                                    });
                                 
                             }
                             
                         }
                         });
          
//                         $(".Review").css('display','none');
//                        $(".idcard").css('display','block');
//                        $("#telVal").text($("#tel").val()); //获取电话号码
//                        var str = $("#telVal").text();
//                        $("#telVal").html(str.substring(0,3)+"****"+str.substring(7,11)) //号码加密
                        
                     }else{
                         layer.msg('获取签名失败', {'time' : 2000});
                         
                     }
                    
                 },
                 error:function(data){
                     layer.msg('服务器连接失败', {'time' : 2000});
                    
                     
                 }
                });
                layer.close(index);
            });

//        if(valid){
//            $(".Review").css('display','none');
//            $(".idcard").css('display','block');
//            $("#telVal").text($("#tel").val()); //获取电话号码
//            var str = $("#telVal").text();
//            $("#telVal").html(str.substring(0,3)+"****"+str.substring(7,11)) //号码加密
//            return true;
//        }else{
//
//            return false;
//        }

    });
//注册首页手机端验证





//PC端 -- 短信验证
    $(".idcard .main_item.confirm .determine").click(function () {
        var vaild =  true;
        var Forms = {
            V_input :  $(".idcard .main_item .V_input").val()
        };
        if( vaild && Forms.V_input.length <= 0 ){
            vaild = false;
            $(".idcard .main_item .V_input").css('border','1px solid red');
            $(".idcard .main_item .V_input").focus();
        }else{
            $(".idcard .main_item .V_input").css('border','1px solid #6aaaf2');
        }

        if(vaild){
            layui.use(['layer'], function(){
                var layer = layui.layer;
                var index = layer.load();
                $.ajax({
                url:validmess,
                 data:{code:Forms.V_input},
                dataType:'json',
		type:'post',
                async: false,
                 success:function(data){
                     if(data.code==1){
                         
                        $(".idcard").css('display','none');
                          $(".Application").css('display','block');
                    }else{
                         layer.msg(data.msg, {'time' : 2000});
                         
                    }
                 }
             });
             layer.close(index);
       });
      

            
        }else{
             return false;
         }
    });
//PC端 -- 短信验证


//手机端 -- 短信验证
    $(".idcard .modal_btn button").click(function () {

        var vaild =  true;
        var Forms = {
            V_input :  $(".idcard .main_item .V_input").val()
        };
        if( vaild && Forms.V_input.length <= 0 ){
            vaild = false;
            $(".idcard .main_item .V_input").focus();
        }else{
            $(".idcard .main_item .V_input").css('border','1px solid transparent');
        }

        if(vaild){
            layui.use(['layer'], function(){
                var layer = layui.layer;
                var index = layer.load();
                $.ajax({
                 url:validmess,
                 data:{code:Forms.V_input},
                 dataType:'json',
		 type:'post',
                 async: false,
                 success:function(data){
                     if(data.code==1){
                        
                         $(".idcard").css('display','none');
                         $(".Application").css('display','block');
                     }else{
                         layer.msg(data.msg, {'time' : 2000});
                        
                     }
                 }
             });
             layer.close(index);
         });
            
//                         $(".idcard").css('display','none');
//                         $(".Application").css('display','block');

        }else{
            return false;
        }

    });
//手机端 -- 短信验证

(function(){
    $("#nameUl").click(function(){
        $("#nameUl li i").css('display','none');
         $("#nameUl li").toggle();
          $("#nameUl li").click(function(){
          $("#nameUl li i").css('display','block');
            $("#name").val($(this).val());
            $("#nameDiv").html($(this).html());
            console.log($("#name").val());
          });

      });
})();

// PC --用户名/性别验证
    $(".Application .main_item button").click(function(){
        var valid = true;
        var Forms = {
            usernameTwo : $("#usernameTwo").val(),
            name : $("#name").val()
        }
        console.log(Forms);
        if(valid && !user(Forms.usernameTwo)){
            valid = false;
            $("#usernameTwo").css('border','1px solid red');
            $("#usernameTwo").focus();
        }else{
            $("#usernameTwo").css('borderColor','#6aaaf2');

        }
        if(valid && Forms.name <= 0 ){
            valid = false;
            $("#nameDiv").css('border','1px solid red');
            $("#name").focus();
        }else{
            $("#nameDiv").css('borderColor','#6aaaf2');
        }

        function user(str){
            if(/^[a-zA-Z0-9_-]{4,16}$/.test(str)){
                return true;
            }else{
                return false;
            }
        }

        if(valid){
            // window.location.href='login.html';
            $(".Application").css('display','none');

            $(".login").css('display','block');

            
        }else{
            console.log("123");
            return false;
        }

    });// PC ——  —— 用户/性别验证

// 手机端 —— —— 用户/性别验证
    $(".Application .modal_btn button").click(function(){
        $('.idcard').css('display','none');
        var valid = true;
        var Forms = {
            usernameTwo : $("#usernameTwo").val(),
            name : $("#name").val()
        }
        if(valid && !user(Forms.usernameTwo)){
            valid = false;
            $("#usernameTwo").focus();
        }else{
            $("#usernameTwo").css('borderColor','transparent');
        }
        if(valid && Forms.name <=0 ){
            valid = false;
            $("#name").focus();
        }else{
            $("#nameDiv").css('borderColor','transparent');
        }
        function user(str){
            if(/^[a-zA-Z0-9_-]{4,16}$/.test(str)){
                return true;
            }else{
                return false;
            }
        }

        if(valid){
            $(".Application").css('display','none');
            $(".login").css('display','block');
            

        }else{
            return false;
        }


    });   // 手机端 —— —— 用户/性别验证



//短信60s倒计时
    (function () {
        var wait=60;
        function time(o) {
            if (wait == 0) {
                o.removeAttribute("disabled");
                o.value="获取验证码";
                wait = 60;
            } else {

                o.setAttribute("disabled", true);
                o.value= wait + "s";
                wait--;
                setTimeout(function() {
                        time(o)
                    },
                    1000)
            }
        }
//        document.getElementById("Verification").onclick=function(){time(this);}
$("#Verification").click(function(){
           $("#Verification").css('width','80px;');
          var verifi=this;
          
           $.ajax({
                 url:smurl,
                 dataType:'json',
		 type:'post',
                 async:false,
                 success:function(data){
                     if(data.code==0){
                         alert('每天只能获取3次短信');
                     }
                     if(data.code==1){
                         time(verifi);
                     }
                    
                 }
            });
        });
       
    })();
//短信60s倒计时

//密码正则验证
// $("#passwordOne").focus(function(){ $("#passwordOne").css('border','1px solid red'); })
//     $("#passwordOne").blur(function(){
//         var passwordOne = $("#passwordOne").val();
//         var password =  /^[A-Za-z]+[0-9]+[A-Za-z0-9]*|[0-9]+[A-Za-z]+[A-Za-z0-9]*$/g; 
//         if(passwordOne.lenght<= 0 || !password.test(passwordOne)){
//             $("#email").css('border','1px solid red');
//         }else{
//             $("#passwordOne").css('border','1px solid #6aaaf2');
//             $("#passwordTwo").css('border','1px solid #6aaaf2');
            
//         }
//     });
//     


// sex
    // $("#sex").change(function(){
        
    //     // 先清空第二个 
    //     $(".selector2").empty(); 
    //     // 实际的应用中，这里的option一般都是用循环生成多个了 
    //     var option = $("<option>").val(1).text("pxx"); 
    //     $(".selector2").append(option); 
       
    // });

//console.log($("#sex").val());
// sex

    

    //pc密码确认
    $(".login .main_item button").click(function(){
        var passwordOne =  $("#passwordOne").val();
        var passwordTwo = $("#passwordTwo").val();
        
         if(passwordOne == ""){
            $("#passwordOne").focus();
            $("#passwordTwo").val("");
            return false;
        }else if(passwordOne != passwordTwo){
             $("#passwordOne").focus();
            $("#passwordTwo").val("");
        } 
        else{
            $("#passwordOne").css('border','1px solid #6aaaf2');
            $("#passwordTwo").css('border','1px solid #6aaaf2');
            layui.use(['layer'], function(){
                var layer = layui.layer;
                var index = layer.load();
                $.ajax({
                 url:registerurl,
                 data:$("#regform").serialize(),
                 dataType:'json',
		 type:'post',
                 async: false,
                 success:function(data){
                     if(data.code==0){
                         layer.msg(data.msg, {'time' : 2000});
                     }else{
                          alert(data.msg);
                        window.location.href=jumpurl; 
                     }
                      
                     }
                 });
                 layer.close(index);
             });
        }
    });

    //pc密码确认

    //手机端密码确认
$(".login .modal_btn button").click(function(){
        var passwordOne =  $("#passwordOne").val();
        var passwordTwo = $("#passwordTwo").val();
        
         if(passwordOne == ""){
            $("#passwordOne").focus();
            $("#passwordTwo").val("");
            return false;
        }else if(passwordOne != passwordTwo){
             $("#passwordOne").focus();
            $("#passwordTwo").val("");
        } 
        else{
            $("#passwordOne").css('border','1px solid transparent');
            $("#passwordTwo").css('border','1px solid transparent');
            layui.use(['layer'], function(){
                var layer = layui.layer;
                var index = layer.load();
                $.ajax({
                 url:registerurl,
                 data:$("#regform").serialize(),
                 dataType:'json',
		 type:'post',
                 async: false,
                 success:function(data){
                     if(data.code==0){
                         layer.msg(data.msg, {'time' : 2000});
                         
                     }else{
                         
                         alert(data.msg);
                        window.location.href=jumpurl; 
                     }
                      
                     }
                 });
               layer.close(index);  
             });
        }

    });

    //手机端密码确认



});