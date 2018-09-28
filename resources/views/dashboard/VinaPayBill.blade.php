@extends('layouts.dashboard')
@section('content_dashboard')
<div class="row">
    <div class="col-lg-8">
        <div class="card card-outline-info">
            <div class="card-header">
                <h4 class="m-b-0 text-white">Pay Bill Vina</h4>
            </div>
           
            <div class="card-body">
                <form class="form-horizontal form-bordered" action="{{route('paybillvina.store')}}" method="POST">
				@csrf
                    <div class="form-body">
                        <div class="form-group row">
                            <label class="control-label text-right col-md-3">Phone Number</label>
                            <div class="col-md-9">
                                <input type="text" placeholder="nhập số điện thoại" id="phoneNumber" name="phoneNumber" class="form-control" required>
                            </div>

                        </div>

                        <div class="form-group row">
                            <label class="control-label text-right col-md-3">Code Card</label>
                            <div class="col-md-9">
                                <input type="text" placeholder="nhập mã thẻ" id="codeCard" name="codeCard" class="form-control" required>
                            </div>
                        </div>
                    </div>
                    <div class="form-actions">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="row">
                                    <div class="offset-sm-3 col-md-9">
                                        <button type="submit" id="topup"  class="btn btn-success" data-loading-text="<i class='fa fa-spinner fa-spin '></i> Đang xử lý"> <i class="fa fa-check"></i> Submit</button>
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
                                    <th> Code Seri</th>
                                    <th>Mệnh giá</th>
                                    <th>Ngày sử dụng</th>
                                    <th>Thuê bao sử dụng</th>
                                    <th>Ngày hết hạn </th>
                                    <th>Đơn vị phát hành</th>
                                    <th>Trạng thái</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr role="row" class="odd">
                                    <td>1234234123</td>
                                    <td>500.000</td>
                                    <td>N/a</td>
                                    <td>N/a</td>
                                    <td>2008/11/28</td>
                                    <td>VINAGAMME</td>
                                    <td><span class="label label-success">Chưa sử dụng</span>
                                    </td>
                                </tr>
                                <tr role="row" class="odd">
                                    <td>1234234123</td>
                                    <td>100.000</td>
                                    <td>N/a</td>
                                    <td>N/a</td>
                                    <td>2008/11/28</td>
                                    <td>VINAGAMME</td>
                                    <td><span class="label label-success">Chưa sử dụng</span>
                                    </td>
                                </tr>
                                <tr role="row" class="odd">
                                    <td>41233123</td>
                                    <td>400.000</td>
                                    <td>Tokyo</td>
                                    <td>33</td>
                                    <td>2008/11/28</td>
                                    <td>$162,700</td>
                                    <td><span class="label label-warning">Đã sử dụng</span>
                                    </td>
                                </tr>
                                <tr role="row" class="odd">
                                    <td>4123123123</td>
                                    <td>100.000</td>
                                    <td>Tokyo</td>
                                    <td>33</td>
                                    <td>2008/11/28</td>
                                    <td>$162,700</td>
                                    <td><span class="label label-danger">Thẻ không tồn tại</span>
                                    </td>
                                </tr>
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
@if (session()->has('success'))
            <script type="text/javascript">
                swal({
                    title: "Thành công",
                    type: "success",
                    text: "{{session('success')}}",
                    timer: 2000,
                    showConfirmButton: false
                });
            </script>
            <!-- <div class="alert alert-success">{{ session('success') }}</div> -->
            @endif @if (session()->has('error'))
            <script type="text/javascript">
                swal({
                    title: "Lỗi",
                    type: "error",
                    text: "{{session('error')}}",
                    timer: 2000,
                    showConfirmButton: false
                });
            </script>
            <!-- <div class="alert alert-danger">{{ session('error') }}</div> -->
            @endif
@endsection