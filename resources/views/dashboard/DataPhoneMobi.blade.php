@extends('layouts.dashboard')
@section('content_dashboard')
<div class="row">
                    <div class="col-lg-8">
                        <div class="card card-outline-info">
                            <div class="card-header">
                                <h4 class="m-b-0 text-white">Xác thực số điện thoại Mobi</h4>
                            </div>
							
                            <div class="card-body">
                                <form action="{{route('dataphonemobiaddphone.store')}}" method="POST" class="form-horizontal form-bordered" >
								@csrf
								
                                    <div class="form-body">
                                        <div class="form-group row">
                                            <label class="control-label text-right col-md-3">Phone Number</label>
                                            <div class="col-md-6">
                                                <input type="text" placeholder="nhập số điện thoại" id="phoneNumber" name="phoneNumber" onchange="Custom.checkPhone()" class="form-control">
											</div>
											<div class="col-md-3" >
												<button type="button" id="btngetOTP" onClick="Custom.getOTP($('#phoneNumber').val())" class="btn btn-info" data-loading-text="<i class='fa fa-spinner fa-spin '></i> Đang xử lý"> <i class="fa fa-check" ></i>Get OTP</button>
                                                <div id="timeout">OTP hết hạn sau : <span id="oclock" style="color:red;"></span> s</div>
                                            </div>
                                            
                                        </div>
										<div class="form-group row"  >
                                            <label class="control-label text-right col-md-3">OTP</label>
                                            <div class="col-md-6">
												<input type="hidden" id="deviceId" name="deviceId" value="1233312"class="form-control">
                                                <input type="text" placeholder="OTP" id="otp" name="otp" class="form-control" required>
											</div>
											<div class="col-md-3">
												<button  type="button" onclick="Custom.DataphonegetToken()" class="btn btn-info"> <i class="fa fa-check"></i>Get Token</button>
											</div>
                                        </div>
                                        <div class="form-group row">
                                            <label class="control-label text-right col-md-3">Token</label>
                                            <div class="col-md-6">
                                                <input type="text" placeholder="Nhập token" id="token" name="token" class="form-control" required>
											</div>
                                        </div>
										
										
                                    </div>
                                    <div class="form-actions">
                                        <div class="row">
                                            <div class="col-md-12">
                                                <div class="row">
                                                    <div class="offset-sm-3 col-md-9">
                                                        <button type="submit" id="savephone" class="btn btn-success" data-loading-text="<i class='fa fa-spinner fa-spin '></i> Đang xử lý"> <i class="fa fa-check"></i> Lưu</button>
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
									<th >OTP</th>
									<th >Driver ID</th>
									<th >Trạng thái</th>
									<th >Ngày tạo</th>
									<th >Action</th>
								</tr>
							</thead>
							<tbody>
							@foreach($datapphones as $data=>$value)
							<tr >
									<td >{{$value->id}}</td>
									<td>{{$value->phoneNumber}}</td>
									<td>{{$value->otp}}</td>
									<td>{{$value->deviceId}}</td>
									@if($value->status == 1)
                                        <td><span class="label label-success">{{$value->note}}</span></td>
                                    @endif
                                    @if( $value->status == 0)
                                        <td><span class="label label-danger">{{$value->note}}</span></td>
                                    @endif 
									<td>{{$value->created_at}}</td>
									<td>
										 <!-- Example single danger button -->
										 <div class="btn-group">
                                            <button type="button" class="btn btn-secondary">Action</button>
                                            <button type="button" class="btn btn-secondary dropdown-toggle dropdown-toggle-split" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                            </button>
                                            <div class="dropdown-menu">
                                                <!-- <a class="dropdown-item" href="#">Nạp Card</a> -->
                                                <button class="dropdown-item" data-toggle="modal" data-target="#update" type="text" onClick='Custom.getOTP("0"+{{$value->phoneNumber}})'>Update Token</button>
												<button class="dropdown-item" >Xóa</button>
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
<div class="modal fade" id="update" tabindex="-1" role="dialog" aria-labelledby="modalLabel" aria-hidden="true">
  <div class="modal-dialog">
	<div class="modal-content">
		<div class="modal-header">
			<button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">×</span><span class="sr-only">Close</span></button>
			<h3 class="modal-title" id="phone"></h3>
            <input type="hidden" id="deviceId" name="deviceId" value="1233312"class="form-control">
            <input type="hidden" id="phoneupdate" name="phoneupdate" class="form-control">
		</div>
		<div class="modal-body">
        <div class="form-group row" id="classOTP" >
                                            <label class="control-label text-right col-md-3">OTP</label>
                                            <div class="col-md-6">
												<input type="hidden" id="deviceId" class="form-control">
                                                <input type="text" placeholder="OTP" id="otpupdate" class="form-control">
											</div>
											<div class="col-md-3">
												<button  type="button" onClick="Custom.getToken($('#phoneupdate').val(),$('#otpupdate').val(),$('#deviceId').val())" class="btn btn-info"> <i class="fa fa-check"></i>Verify</button>
											</div>
                                        </div>
		</div>
		
	</div>
  </div>
</div>

@endsection
@section('javascript')
@if (session()->has('success'))
                    <script type="text/javascript">
                       swal({   
                            title: "Thành công",   
                            type: "success",
                            text: "{{session('success')}}",
                            timer: 3000,   
                            showConfirmButton: false 
                        });
                    
                     </script>
                    <!-- <div class="alert alert-success">{{ session('success') }}</div> -->
                @endif
                @if (session()->has('error'))
                     <script type="text/javascript">
                           swal({   
                                title: "Lỗi",   
                                type: "error",
                                text: "{{session('error')}}",
                                timer: 3000,   
                                showConfirmButton: false 
                            });
                        
                         </script> 
                @endif
<script>
    $(document).ready(function() {
        $('#timeout').hide();
		// $('#savephone').prop('disabled', true);
		// $('#btnOTP').hide();
		// $('#classOTP').hide();
	
    });
    
    </script>
@endsection
