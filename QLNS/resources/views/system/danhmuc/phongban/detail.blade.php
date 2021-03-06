@extends('main')

@section('custom-style')
    <link rel="stylesheet" type="text/css"
        href="{{ url('assets/global/plugins/datatables/plugins/bootstrap/dataTables.bootstrap.css') }}" />
    <link rel="stylesheet" type="text/css" href="{{ url('assets/global/plugins/select2/select2.css') }}" />
    <style>
                .info{
            height: 18px;
            line-height: 18px
        }
    </style>
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
                        <b>DANH SÁCH CÁN BỘ PHÒNG {{ $tenpb }}</b>
                        <div class="truongphong " style="margin-top:10px">
                             Trưởng phòng: @foreach ($model as $value)
                                    @if ($value->tencv == 'Trưởng phòng')
                                        {{ $value->hoten }}
                                    @endif
                                @endforeach
                            
                        </div>
                    </div>

                    <div class="actions">
                        @can('add_canbo')
                        <button type="button" id="_btnaddCB" class="btn btn-default btn-xs"><i
                            class="fa fa-plus"></i>&nbsp;Thêm mới cán bộ</button>
                        @endcan

                        <div class="btn-back" style="margin-top:10px">
                            <button class='btn btn-info btn-sm ' onclick="history.go(-1)"><i class="fa fa-backward"></i>
                                Quay lại</button>
                        </div>

                    </div>
                </div>
                <div class="portlet-body form-horizontal">
                    <table id="sample_3" class="table table-hover table-striped table-bordered" style="min-height: 230px">
                        <thead>
                            <tr>
                                <th class="text-center" style="width: 2%">STT</th>
                                <th class="text-center">Tên cán bộ</th>
                                <th class="text-center">Ngày sinh</th>
                                <th class="text-center">Giới tính</th>
                                <th class="text-center">Email</th>
                                <th class="text-center">Điện thoại</th>
                                {{-- <th class="text-center">Phòng ban</th> --}}
                                <th class="text-center" style="width: 30%">Địa chỉ</th></th>
                                <th class="text-center">Thao tác</th>
                            </tr>
                        </thead>
                        <tbody>
                            @if (isset($model))
                                @foreach ($model as $key => $value)
                                    <tr>
                                        <td class="text-center">{{ $key + 1 }}</td>
                                        <td name="tencv">
                                            <p class="info"><b style="color: #5b9bd1">{{ $value->hoten }}</b></p>
                                            <p class="info">Chức vụ: {{ $value->tencv }}</p>
                                            <p class="info">Phòng: {{ $value->tenpb  }}</p>
                                        </td>
                                        <td name="ngaysinh">
                                            {{ \Carbon\Carbon::parse($value->ngaysinh)->format('d/m/Y') }}
                                        </td>
                                        <td name="gioitinh">{{ $value->gioitinh == 1 ? 'Nam' : 'Nữ' }}</td>
                                        <td name="email">{{ $value->email }}</td>
                                        <td name="dienthoai">{{ $value->sdt }}</td>
                                        {{-- <td name="phongban_id">{{ $value->tenpb }}</td> --}}
                                        <td name="phongban_id">{{ $value->thuongtru }}</td>
                                        <td>
                                            @can('edit_canbo')
                                            <a type="button" href="{{ route('canbo.edit', $value->id) }}"
                                                class="btn btn-default btn-xs mbs">
                                                <i class="fa fa-edit"></i>&nbsp; Chỉnh sửa</a>
                                            @endcan

                                            @can('delete_canbo')
                                            <button type="button"
                                            onclick="cfDel('/danh_muc/canbo/delete/{{ $value->id }}')"
                                            class="btn btn-default btn-xs mbs" data-target="#delete-modal-confirm"
                                            data-toggle="modal">
                                            <i class="fa fa-trash-o"></i>&nbsp; Xóa</button>
                                            @endcan

                                        </td>
                                    </tr>
                                @endforeach
                            @endif
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    <!--Modal thông tin chức vụ -->
    <div id="canbo-modal" tabindex="-1" role="dialog" aria-hidden="true" class="modal fade">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header modal-header-primary">
                    <button type="button" data-dismiss="modal" aria-hidden="true" class="close">&times;</button>
                    <h4 id="modal-header-primary-label" class="modal-title">Danh sách cán bộ</h4>
                </div>
                <div class="modal-body">
                    <table id="sample_3" class="table table-hover table-striped table-bordered" style="min-height: 230px">
                        <thead>
                            <tr>
                                <th class="text-center" style="width: 10%">STT</th>
                                <th class="text-center">Tên cán bộ</th>
                                <th class="text-center">Ngày sinh</th>
                                <th class="text-center">Giới tính</th>
                                <th class="text-center">Email</th>
                                <th class="text-center">Điện thoại</th>
                                {{-- <th class="text-center">Phòng ban</th> --}}
                                <th class="text-center">Chức vụ</th>
                                <th class="text-center">Thao tác</th>
                            </tr>
                        </thead>
                        <tbody>
                            @if (isset($canbo))
                                @foreach ($canbo as $key => $value)
                                    <tr>
                                        <td class="text-center">{{ $key + 1 }}</td>
                                        <td name="tencv">{{ $value->hoten }}</td>
                                        <td name="ngaysinh">
                                            {{ \Carbon\Carbon::parse($value->ngaysinh)->format('d/m/Y') }}
                                        </td>
                                        <td name="gioitinh">{{  $value->gioitinh == 1 ? 'Nam' : 'Nữ' }}</td>
                                        <td name="email">{{ $value->email }}</td>
                                        <td name="dienthoai">{{ $value->sdt }}</td>
                                        {{-- <td name="phongban_id">{{ $value->tenpb }}</td> --}}
                                        <td name="phongban_id">{{ $value->chucvu->tencv }}</td>
                                        <td>
                                            <form action="{{ route('canbo.update', $value->id) }}" method="post"
                                                enctype="multipart/form-data">
                                                @csrf
                                                <input type="hidden" name="hoten" value="{{ $value->hoten }}">
                                                <input type="hidden" name="gioitinh" value="{{ $value->gioitinh }}">
                                                <input type="hidden" name="quequan" value="{{ $value->quequan }}">
                                                <input type="hidden" name="thuongtru" value="{{ $value->thuongtru }}">
                                                <input type="hidden" name="ngaysinh" value="{{ $value->ngaysinh }}">
                                                <input type="hidden" name="chucvu_id" value="{{ $value->chucvu_id }}">
                                                <input type="hidden" name="phongban_id" value="{{ $phongban->id }}">
                                                <input type="hidden" name="sdt" value="{{ $value->sdt }}">
                                                <input type="hidden" name="cccd" value="{{ $value->cccd }}">
                                                <input type="hidden" name="email" value="{{ $value->email }}">
                                                <input type="hidden" name="tdcm" value="{{ $value->tdcm }}">
                                                <input type="hidden" name="truongdaotao" value="{{ $value->truongdaotao }}">
                                                <input type="hidden" name="bangcap" value="{{ $value->bangcap }}">
                                                <input type="hidden" name="namtotnghiep" value="{{ $value->namtotnghiep }}">
                                                <input type="hidden" name="ngayvaoct" value="{{ $value->ngayvaoct }}">
                                                <input type="hidden" name="theodoi" value="{{ $value->theodoi }}">
                                                <input type="hidden" name="theodoi" value="{{ $value->users_id }}">
                                                <input type="hidden" name="id_pb" value="dscb_pb">
                                                <button type="submit" class="btn btn-info btn-xs mbs">
                                                    &nbsp; Chọn</button>
                                            </form>

                                        </td>
                                    </tr>
                                @endforeach
                            @endif
                        </tbody>
                    </table>
                </div>
                <div class="modal-footer">
                    <button type="button" data-dismiss="modal" class="btn btn-default">Hủy thao tác</button>
                </div>
            </div>
        </div>
    </div>
    <script>
        $(document).ready(function() {
            $('#_btnaddCB').on('click', function() {
                $('#canbo-modal').modal('show')
            });
        })
    </script>


    @include('includes.modal.delete')
@stop
