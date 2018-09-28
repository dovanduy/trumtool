var token = $('meta[name="csrf-token"]').attr('content');
var Custom = {
    checkPhone : function(){
        var phoneNumber =$('#phoneNumber').val();
        jQuery.ajax({
            type: "post",
            url: RoutecheckPhone,
            data: {
            _token : token,
            phoneNumber : phoneNumber,
            },
            success: function(res) {
                res = JSON.parse(res);
                console.log(res.statuscode);
                if(res.statuscode ==200){
                    $('#btnOTP').hide();
                    $('#classOTP').hide();
                    $('#topup').prop('disabled', false);
                    swal({   
                        title: "Good Job!",  
                        text : res.message,
                        type: "success",
                        timer: 2000,   
                        showConfirmButton: false 
                    });
                   
                }else{
                    swal({   
                        title: "Opps!",  
                        text : res.message,
                        type: "error",
                        timer: 2000,   
                        showConfirmButton: false 
                    });
                    $('#btnOTP').show();
                    $('#classOTP').show();
                }
            },
            error: function(e, c, d) {
                console.log(e);
            },
        })
    },
    getOTP : function( phoneNumber){
        
        $('#phoneupdate').val(phoneNumber);
        jQuery.ajax({
            type: "post",
            url: RoutegetOTP,
            data: {
            _token : token,
            phoneNumber : phoneNumber,
            },
            success: function(res) {
               
                res = JSON.parse(res);
                console.log(res.statuscode);
                if(res.statuscode ==200 & res.isSuccess === true){
                    $('#deviceId').val(res.deviceId);
                    // $('#phoneNumber').prop('disabled', true);
                    $('#btngetOTP').hide();
                    $('#timeout').show();
                    swal({   
                        title: "Good Job!",  
                        text : "Lấy OTP Thành Công",
                        type: "success",
                        timer: 2000,   
                        showConfirmButton: false 
                    });
                    time =60;
                    Timeout();
                }else{
                    swal({   
                        title: "Opps!",  
                        text : res.message,
                        type: "error",
                        timer: 2000,   
                        showConfirmButton: false 
                    });
                }
            },
            error: function(e, c, d) {
                console.log(e);
            },
        })

    },
    
    getToken : function(phoneNumber, otp, deviceId){
      
        jQuery.ajax({
            type: "post",
            url: RoutegetToken,
            data: {
                _token : token,
                phoneNumber : phoneNumber,
                deviceId : deviceId,
                otp : otp
            },
            success: function(res) {
                res = JSON.parse(res);
                if(res.statuscode == 200){
                    swal({   
                        title: "Good Job!",  
                        text : res.message,
                        type: "success",
                        timer: 2000,   
                        showConfirmButton: false 
                    });
                    $('#topup').prop('disabled', false);
                    $('#btnOTP').hide();
                    $('#classOTP').hide();
                }else{
                    swal({   
                        title: "Opps!",  
                        text : res.message,
                        type: "error",
                        timer: 2000,   
                        showConfirmButton: false 
                    });
                }
               
            },
            error: function(e, c, d) {
                console.log(e);
            },
        })
    },
    Mobitopup : function(){
        var phoneNumber = $('#phoneNumber').val();
        var codeCard = $('#codeCard').val();
        var captcha = $('#captcha').val();
        jQuery.ajax({
            type: "post",
            url: RouteMobiTopup,
            data: {
                _token : token,
                phoneNumber : phoneNumber,
                codeCard : codeCard,
                captcha : captcha
            },
            success: function(res) {
                res = JSON.parse(res);
                console.log(res.statuscode);
                if(res.statuscode==200){
                    swal({   
                        title: "Good Job!",  
                        text : res.message,
                        type: "success",
                        timer: 2000,   
                        showConfirmButton: false 
                    });
                   

                }else if(res.statuscode==600){
                    $('#classCaptcha').show();
                    $('#imgcaptcha').attr('src', res.fields);
                    
                }else if(res.statuscode==401){
                    swal({   
                        title: "Opps!",  
                        text : res.message,
                        type: "error",
                        timer: 2000,   
                        showConfirmButton: false 
                    });
                    $('#btnOTP').show();
                    $('#classOTP').show();
                }else{
                    swal({   
                        title: "Opps!",  
                        text : res.message,
                        type: "error",
                        timer: 2000,   
                        showConfirmButton: false 
                    });
                   
                }
               console.log(res);
            },
            error: function(e, c, d) {
                console.log(e);
            },
        })
    },

    Vinatopup : function(){
        var phoneNumber = $('#phoneNumber').val();
        var codeCard = $('#codeCard').val();
        jQuery.ajax({
            type: "post",
            url: RouteVinaTopup,
            data: {
                _token : token,
                phoneNumber : phoneNumber,
                codeCard : codeCard,
            },
            success: function(res) {
                console.log(res);
            },
            error: function(e, c, d) {
                console.log(e);
            },
        })
    },
    // viettel
    ViettelCheckSeri : function(){
       
        var arrseri = $('#serial').val().trim("").split("\n");
        arrseri.forEach(function(serial) {
            console.log(serial);
            jQuery.ajax({
                    type: "post",
                    url: RouteViettelCheckSeri,
                    data: {
                        _token : token,
                        serial : serial,
                       
                    },
                    success: function(res) {
                        // res = JSON.parse(res);
                        if(res.error == 0 && res.dateUsed ==""){
                            $.toast({
                                heading: 'Thành công',
                                text: res.msg,
                                position: 'top-right',
                                loaderBg:'#ff6849',
                                icon: 'success',
                                hideAfter: 3500, 
                               
                              });
                        }else if(res.error == 0){
                            $.toast({
                                heading: "thành công",
                                text: 'Seri ' + serial + " đã được thuê bao : " + res.isdn + " sử dụng ngày " + res.dateUsed,
                                position: 'top-right',
                                loaderBg:'#ff6849',
                                icon: 'warning',
                                hideAfter: 3500, 
                               
                              });
                        }else{
                            $.toast({
                                heading: 'lỗi',
                                text: res.msg,
                                position: 'top-right',
                                loaderBg:'#ff6849',
                                icon: 'error',
                                hideAfter: 3500
                                
                              });
                        }
                    },
                    error: function(e, c, d) {
                        console.log(e);
                    },
                })
          });
       
    },

    //dataphone
    DataphonegetToken : function(){
        var phoneNumber = $('#phoneNumber').val();
        var otp = $('#otp').val();
        var deviceId = $('#deviceId').val();
        
        jQuery.ajax({
            type: "post",
            url: RoutegetTokenDataphone,
            data: {
                _token : token,
                phoneNumber : phoneNumber,
                deviceId : deviceId,
                otp : otp
            },
            success: function(res) {
                // res = JSON.parse(res);
                if(res.statuscode ==200){
                  
                    $('#token').val(res.token);
                }else{
                    swal({   
                        title: "Opps!",  
                        text : "Token lỗi hoặc hết hạn",
                        type: "error",
                        timer: 2000,   
                        showConfirmButton: false 
                    });
                }

            },
            error: function(e, c, d) {
                console.log(e);
            },
        })
    },
    // DataphoneaddPhone : function(){
    //     var phoneNumber = $('#phoneNumber').val();
    //     var otp = $('#otp').val();
    //     var deviceId = $('#deviceId').val();
    //     var token = $('#token').val();
       
    //     jQuery.ajax({
    //         type: "post",
    //         url: RoutegetTokenDataphone,
    //         data: {
    //             _token : token,
    //             phoneNumber : phoneNumber,
    //             deviceId : deviceId,
    //             otp : otp,
    //             token : token,
    //         },
    //         success: function(res) {
    //             res = JSON.parse(res);
    //             if(res.statuscode ==200){
    //                 console.log(res.token);
    //                 $('#token').val(res.token);

    //             }else{
    //                 swal({   
    //                     title: "Opps!",  
    //                     text : res.message,
    //                     type: "error",
    //                     timer: 2000,   
    //                     showConfirmButton: false 
    //                 });
    //             }
                
               
    //         },
    //         error: function(e, c, d) {
    //             console.log(e);
    //         },
    //     })
    // },
}
function Timeout(){
    time --;
    if(time!=0){
        var a = time;
        console.log(time);
        document.getElementById('oclock').innerHTML = time;
        setTimeout("Timeout()",1000);
    }else{
        $('#timeout').hide();
        $('#btngetOTP').show();
       
        swal({   
            title: "Opps!",  
            text : "Hết thời gian, bạn vui lòng lấy lại OTP",
            type: "error",
            timer: 2000,   
            showConfirmButton: false 
        });
    }
}