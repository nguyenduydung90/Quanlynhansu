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
        <div class="col-md-12">
            <div class="portlet light bordered">
                <div class="portlet-title">
                    <div class="caption">
                        <b>LỊCH SỬ THEO DÕI FILE PHẦN MỀM: {{$tenpm}}</b>
                    </div>
                    <div class="actions">
                            <a type="button" href="{{route('file.index')}}" id="_btnaddPB" class="btn btn-default btn-xs" ><i
                                    class="fa fa-backward"></i>&nbsp;Quay lại</a>
                    </div>
                </div>
                <div class="portlet-body form-horizontal">
                    <table id="sample_3" class="table table-hover table-striped table-bordered" style="min-height: 230px">
                        <thead>
                            <tr>
                                <th class="text-center" style="width: 10%">STT</th>
                                <th class="text-center">Tên phần mềm</th>
                                <th class="text-center">Cán bộ </br>phụ trách</th>
                                <th class="text-center">File giới thiệu</th>
                                <th class="text-center">File demo</th>
                                <th class="text-center">Thời gian </br>tạo</th>
                                <th class="text-center">Thời gian </br>cập nhật</th>
                                <th class="text-center">Tài khoản thực hiện</th>
                                {{-- <th class="text-center">Thao tác</th> --}}
                            </tr>
                        </thead>
                        <tbody>
                            @if (isset($model))
                                @foreach ($model as $key => $value)
                                    <tr>
                                        <td class="text-center">{{ $key + 1 }}</td>
                                        <td name="tencv">{{ $value->tenpm }}</td>
                                        <td name="diengiai">{{$value->cbphutrach}}
                                            </td>
                                            <td>{{$value->file_gt}}</td>
                                            <td>{{$value->file_demo}}</td>
                                        <td name="diengiai">{{ \Carbon\Carbon::parse($value->thoigiantao)->format('H:i:s d/m/Y') }}</td>
                                        <td name="diengiai">{{ \Carbon\Carbon::parse($value->thoigianchinhsua)->format('H:i:s d/m/Y') }}</td>
                                        <td name="diengiai">{{ $value->tkthuchien }}</td>

                                    </tr>
                                @endforeach
                            @endif
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    @stop