@extends('layouts.dashboard')
@section('content_dashboard')
<div class="row">
                    <div class="col-lg-8">
                        <div class="card card-outline-info">
                            <div class="card-header">
                                <h4 class="m-b-0 text-white">Pay Bill Mobi</h4>
                            </div>
                            <div class="card-body">
                                <form  class="form-horizontal form-bordered" >
									
                                    <div class="form-body">
                                        <div class="form-group row">
                                            <label class="control-label text-right col-md-3">Phone Number</label>
                                            <div class="col-md-6">
                                                <input type="text" placeholder="nhập số điện thoại" id="phoneNumber" name="phoneNumber" onchange="Custom.checkPhone()" class="form-control">
											</div>
											<div class="col-md-3" id="btnOTP" >
											<button type="button" id="btngetOTP" onClick="Custom.getOTP($('#phoneNumber').val())" class="btn btn-info" data-loading-text="<i class='fa fa-spinner fa-spin '></i> Đang xử lý"> <i class="fa fa-check" ></i>Get OTP</button>
												<div id="timeout">OTP hết hạn sau : <span id="oclock" style="color:red;"></span> s</div>
											</div>
                                        </div>
										<div class="form-group row" id="classOTP" >
                                            <label class="control-label text-right col-md-3">OTP</label>
                                            <div class="col-md-6">
												<input type="hidden" id="deviceId" class="form-control">
                                                <input type="text" placeholder="OTP" id="otp" class="form-control">
											</div>
											<div class="col-md-3">
												<button  type="button" onClick="Custom.getToken($('#phoneNumber').val(), $('#otp').val(), $('#deviceId').val())" class="btn btn-info"> <i class="fa fa-check"></i>Verify</button>
											</div>
                                        </div>
                                        <div class="form-group row">
                                            <label class="control-label text-right col-md-3">Code Card</label>
                                            <div class="col-md-6">
                                                <input type="text" placeholder="nhập mã thẻ" id="codeCard" name="codeCard" class="form-control">
											</div>
                                        </div>
										
										<div class="form-group row" id="classCaptcha" >
                                            <label class="control-label text-right col-md-3">Captcha</label>
                                            <div class="col-md-6">
                                                <input type="text"  id="captcha"class="form-control">
											</div>
											<div class="col-md-3">
												<img id="imgcaptcha" src="" alt="" style="height:40px;">
											</div>
                                        </div>
                                    </div>
                                    <div class="form-actions">
                                        <div class="row">
                                            <div class="col-md-12">
                                                <div class="row">
                                                    <div class="offset-sm-3 col-md-9">
                                                        <button type="button" id="topup" onclick="Custom.Mobitopup()" class="btn btn-success" data-loading-text="<i class='fa fa-spinner fa-spin '></i> Đang xử lý"> <i class="fa fa-check"></i> Submit</button>
                                                        <button type="button" class="btn btn-inverse">Cancel</button>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
</div>
<div class="row">
	<div class="col-12">
		<div class="card">
			<div class="card-body">
				<h4 class="card-title">Kết quả check</h4>
				<div class="table-responsive m-t-40">
					<div id="myTable_wrapper" class="dataTables_wrapper no-footer">
						<table id="myTable" class="table table-bordered table-striped dataTable no-footer" role="grid" aria-describedby="myTable_info">
							<thead>
								<tr role="row">
									<th >ID</th>
									<th >Phone Number</th>
									<th >Code Card</th>
									<th >Mệnh Giá</th>
									<th >Network</th>
									<th >Trạng thái</th>
									<th >Ngày tạo</th>
									<th >Action</th>
								</tr>
							</thead>
							<tbody>
								<tr role="row" class="odd">
								@foreach($paybillmobis as $paybillmobi =>$value)
									<td >{{$value->id}}</td>
									<td>{{$value->phone_number}}</td>
									<td>{{$value->codeCard}}</td>
									<td>{{$value->cardValue}}</td>
									<td>{{$value->network_id}}</td>
									<td><span class="label label-success">Chưa sử dụng</span></td>
									<td>{{$value->created_at}}</td>
									<td>
										 <!-- Example single danger button -->
										 <div class="btn-group">
                                            <button type="button" class="btn btn-secondary">Action</button>
                                            <button type="button" class="btn btn-secondary dropdown-toggle dropdown-toggle-split" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                            </button>
                                            <div class="dropdown-menu">
											
                                                <button class="dropdown-item" href="#">Kiểm toán</button>
                                                <button class="dropdown-item" data-toggle="modal" data-target="#update" type="text" onClick='Custom.getOTP("0"+{{$value->phone_number}})'>Update Token</button>
												
                                            </div>
                                        </div>
									</td>
								</tr>
								@endforeach
							</tbody>
						</table>
					</div>
				</div>
			</div>
		</div>

	</div>
</div>

@endsection
@section('javascript')
<script>
    $(document).ready(function() {
		$('#topup').prop('disabled', true);
		$('#timeout').hide();
		$('#btnOTP').hide();
		$('#classOTP').hide();
		$('#classCaptcha').hide();
    });
    
    </script>
@endsection
