@extends('layouts.dashboard')
@section('content_dashboard')
<div class="row">
    <div class="col-lg-12">
        <div class="card card-outline-info">
            <div class="card-header">
                <h4 class="m-b-0 text-white">Thêm User</h4>
            </div>
            <div class="card-body">
                <form action="{{route('adduser.store')}}" method="POST" >
                @csrf
                    <div class="form-body">
                        <h3 class="card-title">Thông tin User</h3>
                        <hr>
                        <div class="row p-t-20">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="control-label">First Name</label>
                                    <input type="text" id="firstName" name="firstName" class="form-control" placeholder="John doe">
                                    
                                </div>
                            </div>
                            <!--/span-->
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="control-label">Last Name</label>
                                    <input type="text" id="lastName" name="lastName" class="form-control" placeholder="John doe">
                                   
                                </div>
                            </div>
                            <!--/span-->
                        </div>
                        <!--/row-->
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="control-label">Email</label>
                                    <input id="email" type="email" name="email" class="form-control" name="email" required autofocus placeholder="abc@gmail.com">
                                    @if ($errors->has('email'))
                                    <span class="help-block">
                                        <strong style="color:red">{{ $errors->first('email') }}</strong>
                                    </span>
                                     @endif
                                </div>
                            </div>
                            <!--/span-->
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="control-label">PassWord</label>
                                    <input id="password" name="password" type="password" class="form-control" name="password" required placeholder="Password">
                                    @if ($errors->has('password'))
                                    <span class="help-block">
                                        <strong style="color:red">{{ $errors->first('password') }}</strong>
                                    </span>
                                     @endif
                                </div>
                            </div>
                            <!--/span-->
                        </div>
                        <!--/row-->
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">

                                    <label class="control-label">Tcoin</label>
                                    <input id="tcoin" name="tcoin"type="number" class="form-control"  required>
                                    @if ($errors->has('tcoin'))
                                    <span class="help-block">
                                        <strong style="color:red">{{ $errors->first('tcoin') }}</strong>
                                    </span>
                                     @endif
                                </div>
                                <div class="form-group">
                                    <label class="control-label">Loại tài khoản</label>
                                   	<select class="form-control custom-select" name="isadmin" id="isadmin">
									    <option value="1">Admin</option>
									    <option value="0">Member</option>   
									</select>
								</div>
								<div class="form-group">
									<label class="control-label">Trạng thái</label>
                                   	<select class="form-control custom-select" name="isactive" id="isactive">
									    <option value="1">Hoạt động</option>
									    <option value="0">Block</option>
									    
									</select>
                                </div>
                            </div>
                            <!--/span-->
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="control-label">Membership</label>
                                    <div class="row">
                                        <div class="col-md-4">
                                            <div class="checkbox checkbox-success">
                                                <input id="checkseriviettel" type="checkbox" name="permissions[]" value="checkseriviettel.create,checkseriviettel.store">
                                                <label for="checkseriviettel">Check seri viettel</label>
                                            </div>
                                            <div class="checkbox checkbox-success">
                                                <input id="checkserivina" type="checkbox" name="permissions[]" value="checkserivina.create,checkserivina.store">
                                                <label for="checkserivina">Check seri Vina</label>
                                            </div>
                                            <div class="checkbox checkbox-success">
                                                <input id="checkserimobi" type="checkbox" name="permissions[]" value="checkserimobi.create,checkserimobi.store">
                                                <label for="checkserimobi">Check seri Mobi</label>

                                            </div>


                                        </div>
                                        <div class="col-md-4">
                                            <div class="checkbox checkbox-success">
                                                <input id="checkbillviettel" type="checkbox">
                                                <label for="checkbillviettel">Check bill viettel</label>
                                            </div>
                                            <div class="checkbox checkbox-success">
                                                <input id="checkbillvina" type="checkbox">
                                                <label for="checkbillvina">Check bill Vina</label>
                                            </div>
                                            <div class="checkbox checkbox-success">
                                                <input id="checkbillmobi" type="checkbox">
                                                <label for="checkbillmobi">Check bill Mobi</label>
                                            </div>


                                        </div>

                                        <div class="col-md-4">

                                            <div class="checkbox checkbox-success">
                                                <input id="paybillviettel" type="checkbox">
                                                <label for="paybillviettel">Pay bill viettel</label>
                                            </div>
                                            <div class="checkbox checkbox-success">
                                                <input id="paybillvina" type="checkbox" name="permissions[]" value="paybillvina.create,topupvina.store">
                                                <label for="paybillvina">Pay bill Vina</label>
                                            </div>
                                            <div class="checkbox checkbox-success">
                                                <input id="paybillmobi" type="checkbox" name="permissions[]" value="paybillmobi.create,checkPhonemobi.store,getOTPmobi.store,getTokenmobi.store,topupmobi.store">
                                                <label for="paybillmobi">Pay bill Mobi</label>
                                            </div>
                                            <div class="checkbox checkbox-success">
                                                <input id="paybillmobi" type="checkbox" name="permissions[]" value="dataphonemobi.create,dataphonemobigetoken.store,dataphonemobiaddphone.store">
                                                <label for="paybillmobi">Data Phone</label>
                                            </div>

                                        </div>

                                    </div>
                                </div>
                            </div>
                            <!--/span-->
                        </div>
                        <!--/row-->
                        <h3 class="box-title m-t-40">Thông tin liên hệ</h3>
                        <hr>
                       
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>phone</label>
                                    <input type="text" id="phone"name="phone" class="form-control" placeholder="Phone number">
                                </div>
                            </div>
                            <!--/span-->
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Facebook</label>
                                    <input type="text" id="facebook" name="facebook" class="form-control"placeholder="ID or username Facebook">
                                </div>
                            </div>
                            <!--/span-->
                        </div>
                        <!--/row-->
                        
                    </div>
                    <div class="form-actions">
                        <button type="submit" id="addUserManager"  class="btn btn-success"> <i class="fa fa-check"></i> Save</button>
                        <button type="button" class="btn btn-inverse">Cancel</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>


@endsection