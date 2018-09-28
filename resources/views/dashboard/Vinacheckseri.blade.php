@extends('layouts.dashboard')
@section('content_dashboard')
<div class="row">
	<div class="col-lg-8">
		<div class="card card-outline-info">
			<div class="card-header">
				<h4 class="m-b-0 text-white">Check seri Vinaphone</h4>
			</div>
			<div class="card-body">
				<form action="#" class="form-horizontal form-bordered">
					<div class="form-body">
						<div class="form-group">
							<label>Nhập Seri Vina</label>
							<textarea class="form-control" rows="10" placeholder="Nhập seri 1 seri 1 dòng"></textarea>
						</div>

					</div>
					<div class="form-actions">
						<div class="row">
							<div class="col-md-12">
								<div class="row">
									<div class="offset-sm-3 col-md-9">
										<button type="submit" class="btn btn-success"> <i class="fa fa-check"></i>Check</button>

									</div>
								</div>
							</div>
						</div>
					</div>
				</form>
			</div>
		</div>
	</div>
	<div class="col-lg-4">
		<div class="card card-outline-info">
			<div class="card-header">
				<h4 class="m-b-0 text-white">Thông tin hóa đơn</h4>
			</div>
			<div class="card-body">
				<table class="table color-table purple-table">
					<tbody>
						<tr>
							<td>Total Seri</td>
							<td></td>
						</tr>
						<tr>
							<td>Đơn giá</td>
							<td></td>	
						</tr>
						
					</tbody>
					
					<div class="clearfix"><div class="float-right text-right">
						<div class="text-bold" id="sotienth">0</div><div class="text-sm">VND</div>
					</div><div class="float-left text-bold text-dark">Số tiền cần thanh toán</div>
				</div>
			</table>
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
									<th > Code Seri</th>
									<th >Mệnh giá</th>
									<th >Ngày sử dụng</th>
									<th >Thuê bao sử dụng</th>
									<th >Ngày hết hạn </th>
									<th >Đơn vị phát hành</th>
									<th >Trạng thái</th>
								</tr>
							</thead>
							<tbody>
								<tr role="row" class="odd">
									<td >1234234123</td>
									<td>500.000</td>
									<td>N/a</td>
									<td>N/a</td>
									<td>2008/11/28</td>
									<td>VINAGAMME</td>
									<td><span class="label label-success">Chưa sử dụng</span></td>
								</tr>
								<tr role="row" class="odd">
									<td >1234234123</td>
									<td>100.000</td>
									<td>N/a</td>
									<td>N/a</td>
									<td>2008/11/28</td>
									<td>VINAGAMME</td>
									<td><span class="label label-success">Chưa sử dụng</span></td>
								</tr>
								<tr role="row" class="odd">
									<td>41233123</td>
									<td>400.000</td>
									<td>Tokyo</td>
									<td>33</td>
									<td>2008/11/28</td>
									<td>$162,700</td>
									<td><span class="label label-warning">Đã sử dụng</span></td>
								</tr>
								<tr role="row" class="odd">
									<td>4123123123</td>
									<td>100.000</td>
									<td>Tokyo</td>
									<td>33</td>
									<td>2008/11/28</td>
									<td>$162,700</td>
									<td><span class="label label-danger">Thẻ không tồn tại</span></td>
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