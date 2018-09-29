@extends('layouts.app')

@section('content')
<div class="row">
                    <div class="col-lg-8">
                        <div class="card card-outline-info">
                            <div class="card-header">
                                <h4 class="m-b-0 text-white">Xác thực số điện thoại Mobi</h4>
                            </div>
							
                            <div class="card-body">
                                <form action="" method="POST" class="form-horizontal form-bordered" >
								
								
                                    <div class="form-body">
                                        <div class="form-group row">
                                            <label class="control-label text-right col-md-3">Phone Number</label>
                                            <div class="col-md-6">
                                                <input type="text" placeholder="nhập số điện thoại" id="phoneNumber" name="phoneNumber" class="form-control">
											</div>
											<div class="col-md-3" >
												<button type="button" id="btngetOTP"  class="btn btn-info" data-loading-text="<i class='fa fa-spinner fa-spin '></i> Đang xử lý"> <i class="fa fa-check" ></i>Get OTP</button>
                                                <div id="timeout">OTP hết hạn sau : <span id="oclock" style="color:red;"></span> s</div>
                                            </div>
                                            
                                        </div>
										<div class="form-group row" id="classOTP"  >
                                            <label class="control-label text-right col-md-3">OTP</label>
                                            <div class="col-md-6">
												<input type="hidden" id="deviceId" name="deviceId" value="1233312"class="form-control">
                                                <input type="text" placeholder="OTP" id="otp" name="otp" class="form-control" required>
											</div>
											<div class="col-md-3">
												<button  type="button" id="btngetToken" class="btn btn-info"> <i class="fa fa-check"></i>Get Token</button>
											</div>
                                        </div>
                                        <div class="form-group row">
                                            <label class="control-label text-right col-md-3">Token</label>
                                            <div class="col-md-6">
                                                <input type="text" placeholder="Nhập token" id="token" name="token" class="form-control" disabled required>
											</div>
                                        </div>
                                    </div>
                                    <div class="form-actions">
                                        <div class="row">
                                            <div class="col-md-12">
                                                <div class="row">
                                                    <div class="offset-sm-3 col-md-9">
                                                        <button type="button" id="savephone" class="btn btn-success" data-loading-text="<i class='fa fa-spinner fa-spin '></i> Đang xử lý"> <i class="fa fa-check"></i> Lưu</button>
                                                        <button type="button" class="btn btn-inverse">Cancel</button>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </form>
                            </div>
                            <div class="card-body">
                                <textarea id="res" class="form-control" rows="10" placeholder="Kết quả ID"></textarea>
                            </div>
                        </div>
                       
                    </div>
                </div>
</div>


@endsection
@section('script')

<script>
    $(document).ready(function() {
        $('#timeout').hide();
        $('#classOTP').hide();
        $(function() {
			$("#btngetOTP").click(function(){
				getOTP();
            });
            $("#btngetToken").click(function(){
				DataphonegetToken();
            });
            $("#savephone").click(function(){
                var phoneNumber = $('#phoneNumber').val();
                var token = $('#token').val();
                var deviceId = $('#deviceId').val();
                $("#res").append(phoneNumber + "|" + token + "|" +deviceId +"\n");
            });
		});

       

    function getOTP(){
        var phoneNumber = $('#phoneNumber').val();
        jQuery.ajax({
            type: "post",
            url: RoutegetOTPGuest,
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
                    $('#classOTP').show();
                    swal({   
                        title: "Good Job!",  
                        text : "Lấy OTP Thành Công",
                        type: "success",
                        timer: 2000,   
                        showConfirmButton: false 
                    });
                    time =100;
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

    }
    function DataphonegetToken(){
        var phoneNumber = $('#phoneNumber').val();
        var otp = $('#otp').val();
        var deviceId = $('#deviceId').val();
        jQuery.ajax({
            type: "post",
            url: RoutegetTokenGuest,
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
        $('#classOTP').hide();
        swal({   
            title: "Opps!",  
            text : "Hết thời gian, bạn vui lòng lấy lại OTP",
            type: "error",
            timer: 2000,   
            showConfirmButton: false 
        });
    }
}
    });
</script>
@stop