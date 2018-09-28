@extends('layouts.dashboard')
@section('content_dashboard')
@include('sweetalert::alert')
<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-body">
                <h4 class="card-title">Danh sách thành viên</h4>
                <div class="table-responsive m-t-40">
                    <div id="myTable_wrapper" class="dataTables_wrapper no-footer">
                        <table id="myTable" class="table table-bordered table-striped dataTable no-footer" role="grid" aria-describedby="myTable_info">
                            <thead>
                                <tr role="row">
                                    <th>#</th>
                                    <th>Full Name</th>
                                    <th>Email</th>
                                    <th>Phone</th>
                                    <th>Role</th>
                                    <th>Ngày tạo</th>
                                    <th>Action</th>

                                </tr>
                            </thead>
                            <tbody>
                                <tr role="row" class="odd">
                                    <td>1</td>
                                    <td>Hùng Phan</td>
                                    <td>hungphanht95@gmail.com</td>
                                    <td>01689813594</td>
                                    <td>Admin</td>
                                     <td>01-09-2018</td>
                                    <td class="text-nowrap">
                                        <a href="#" data-toggle="tooltip" data-original-title="Edit"> <i class="fa fa-pencil text-inverse m-r-10"></i> </a>
                                        <a href="#" data-toggle="tooltip" data-original-title="Block"> <i class="fa fa-close text-danger"></i> </a>
                                    </td>
                                </tr>
                                <tr role="row" class="odd">
                                    <td>2</td>
                                    <td>Phúc Nguyễn</td>
                                    <td>phucnguyenvhb@gmail.com</td>
                                    <td>01633450505</td>
                                    <td>Member</td>
                                     <td>01-09-2018</td>
                                    <td class="text-nowrap">
                                        <a href="#" data-toggle="tooltip" data-original-title="Edit"> <i class="fa fa-pencil text-inverse m-r-10"></i> </a>
                                        <a href="#" data-toggle="tooltip" data-original-title="Block"> <i class="fa fa-close text-danger"></i> </a>
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