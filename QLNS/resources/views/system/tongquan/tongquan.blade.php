@extends('main')

@section('custom-style')
    <link rel="stylesheet" type="text/css"
        href="{{ url('assets/global/plugins/datatables/plugins/bootstrap/dataTables.bootstrap.css') }}" />
    <link rel="stylesheet" type="text/css" href="{{ url('assets/global/plugins/select2/select2.css') }}" />
@stop

@section('custom-script')
    <script type="text/javascript" src="{{ url('assets/global/plugins/select2/select2.min.js') }}"></script>
    <script type="text/javascript" src="{{ url('assets/global/plugins/datatables/media/js/jquery.dataTables.min.js') }}">
    </script>
    <script type="text/javascript"
        src="{{ url('assets/global/plugins/datatables/plugins/bootstrap/dataTables.bootstrap.js') }}"></script>

    <script src="{{ url('assets/admin/pages/scripts/table-managed.js') }}"></script>
    <script>
        jQuery(document).ready(function() {
            TableManaged.init();
        });
    </script>
@stop

@section('content')
<div class="row">
    <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
        <div class="dashboard-stat2">
            <div class="display">
                <div class="number">
                    <small>THÔNG TIN</small>
                </div>
                <div class="icon">
                    <i class="icon-pie-chart"></i>
                </div>
            </div>
                                <div class="">
                    <li class="list-group-item">Tổng số cán bộ<span class="badge badge-info pull-right">
                        {{$tong->soluong}}</span></li>
                    {{-- <li class="list-group-item">Viên chức<span class="badge badge-info pull-right">
                        0</span></li>
                    <li class="list-group-item">Khác<span class="badge badge-info pull-right">
                        0</span></li> --}}
                </div>
                        </div>
    </div>

    <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
        <div class="dashboard-stat2">
            <div class="display">
                <div class="number">
                    <small>PHÂN LOẠI CÁN BỘ</small>
                </div>
                <div class="icon">
                    <i class="icon-pie-chart"></i>
                </div>
            </div>
            <div class="">
                @foreach ($cb_chucvu as $value)
                <li class="list-group-item">{{$value->chucvu->tencv}}<span
                            class="badge badge-info pull-right">{{$value->soluong}}</span></li>
                @endforeach

            </div>
        </div>
    </div>
    <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
        <div class="dashboard-stat2">
            <div class="display">
                <div class="number">
                    <small>PHÒNG BAN</small>
                </div>
                <div class="icon">
                    <i class="icon-pie-chart"></i>
                </div>
            </div>
            <div class="">
                @foreach ($cb_pb as $value)
                <li class="list-group-item">{{$value->phongban->tenpb}}<span
                            class="badge badge-info pull-right">{{$value->soluong}}</span></li>
                @endforeach

            </div>
        </div>
    </div>

    <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
        <div class="dashboard-stat2">
            <div class="display">
                <div class="number">
                    <small>GIỚI TÍNH</small>
                </div>
                <div class="icon">
                    <i class="icon-pie-chart"></i>
                </div>
            </div>
            <div class="">
                @foreach ($cb_gioitinh as $value)
                <li class="list-group-item">{{$value->gioitinh == 0?'Nữ':'Nam'}}<span
                            class="badge badge-info pull-right">{{$value->soluong}}</span></li>
                @endforeach
            </div>
        </div>
    </div>
</div>
@stop