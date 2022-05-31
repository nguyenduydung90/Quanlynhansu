
@extends('main')

@section('custom-style')
    <link rel="stylesheet" type="text/css"
        href="{{ url('assets/global/plugins/datatables/plugins/bootstrap/dataTables.bootstrap.css') }}" />
    <link rel="stylesheet" type="text/css" href="{{ url('assets/global/plugins/select2/select2.css') }}" />
    <style>
        .item {
            float: right;
        }

        .media-object {
            width: 198px;
            height: 262px;
            border: 1px solid;
            border-radius: 5px
        }

        .detail {
            border-bottom: 1px dashed #e5e5e5;
            margin-bottom: 5px
        }

        td {
            line-height: 80px !important
        }
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
                        <b>KẾT QUẢ TÌM KIẾM THÔNG TIN CÁN BỘ</b>
                    </div>
                    <div class="actions">
                        <a href="{{route('canbo.search')}}"  type="button" id="_btnaddPB"  
                            class="btn btn-success btn-xs"><i class="fa fa-backward"></i>&nbsp;Quay lại</a>
                    </div>
                </div>
                <div class="portlet-body form-horizontal">
                    <table id="sample_3" class="table table-hover table-striped table-bordered" style="min-height: 230px">
                        <thead>
                            <tr>
                                <th class="text-center" style="width: 2%">STT</th>
                                <th class="text-center" style="width: 5%">Hình ảnh</th>
                                <th class="text-center">Tên cán bộ</th>
                                <th class="text-center">Ngày sinh</th>
                                <th class="text-center">Giới tính</th>
                                <th class="text-center">Email</th>
                                <th class="text-center">Điện thoại</th>
                                {{-- <th class="text-center">Phòng ban</th> --}}
                                {{-- <th class="text-center">Chức vụ</th> --}}
                                <th class="text-center" style="width: 20%">Thao tác</th>
                            </tr>
                        </thead>
                        <tbody>
                            @if (isset($model))
                                @foreach ($model as $key => $value)
                                    <tr>
                                        <td class="text-center">{{ $key + 1 }}</td>
                                        <td class="text-center"><img src="{{ asset($value->anh) }}" alt=""
                                                style="width: 96px; height: 96px"></td>
                                        <td name="tencb">
                                            <p class="info"><b style="color: #5b9bd1">{{ $value->hoten }}</b></p>
                                            <p class="info">Chức vụ: {{ $value->chucvu->tencv }}</p>
                                            <p class="info">Phòng: {{ $value->phongban->tenpb  }}</p>
                                        </td>
                                        <td name="ngaysinh">{{\Carbon\Carbon::parse($value->ngaysinh)->format('d/m/Y') }}</td>
                                        <td name="gioitinh">{{ $value->gioitinh }}</td>
                                        <td name="email">{{ $value->email }}</td>
                                        <td name="dienthoai">{{ $value->dienthoai }}</td>
                                        {{-- <td name="phongban_id">
                                            @if ($value->phongban_id == null)
                                                Chưa phân phòng ban
                                            @else
                                                {{ $value->phongban->tenpb }}
                                            @endif

                                        </td> --}}
                                        {{-- <td name="phongban_id">{{ $value->chucvu->tencv }}</td> --}}
                                        <td class="text-center">
                                            {{-- @can('list_canbo')
                                            <button type="button" data-toggle="modal"
                                            data-target="#canbo-modal{{ $value->id }}"
                                            class="btn btn-warning btn-xs mbs">
                                            <i class="fa fa-tasks"></i>&nbsp; Chi tiết</button>  
                                            @endcan --}}

                                            @can('edit_canbo')
                                            <a type="button" href="{{ route('canbo.edit', $value->id) }}"
                                                class="btn btn-info btn-xs mbs">
                                                <i class="fa fa-edit"></i>&nbsp; Chỉnh sửa</a> 
                                            @endcan

                                            @can('delete_canbo')
                                            <button type="button"
                                            onclick="cfDel('/danh_muc/canbo/delete/{{ $value->id }}')"
                                            class="btn btn-danger btn-xs mbs" data-target="#delete-modal-confirm"
                                            data-toggle="modal">
                                            <i class="fa fa-trash-o"></i>&nbsp; Xóa</button>
                                            @endcan

                                        </td>
                                    </tr>
                                    <!--Modal thông tin chức vụ -->
                                    <div id="canbo-modal{{ $value->id }}" tabindex="-1" role="dialog" aria-hidden="true"
                                        class="modal fade">
                                        <div class="modal-dialog">
                                            <div class="modal-content">
                                                <div class="modal-header modal-header-primary">
                                                    <button type="button" data-dismiss="modal" aria-hidden="true"
                                                        class="close">&times;</button>
                                                    <h4 id="modal-header-primary-label" class="modal-title"><b>Thông tin
                                                            cán bộ</b></h4>
                                                </div>

                                                <div class="modal-body">
                                                    <div class="media">
                                                        <div class="media-left media-middle">
                                                            <a href="#">
                                                                <img class="media-object"
                                                                    src="{{ asset($value->anh) }}" alt="ảnh cán bộ">
                                                            </a>
                                                        </div>
                                                        <div class="media-body form-control">
                                                            <div class="detail"><b>Họ tên:</b>&nbsp;<span
                                                                    class="item">{{ $value->hoten }}</span>
                                                            </div>
                                                            <div class="detail"><b>Ngày
                                                                    sinh:</b>&nbsp;<span
                                                                    class="item">{{ \Carbon\Carbon::parse($value->ngaysinh)->format('d/m/Y') }}</span>
                                                            </div>
                                                            <div class="detail"><b>Giới tính:</b>&nbsp;<span
                                                                    class="item">{{ $value->gioitinh }}</span>
                                                            </div>
                                                            <div class="detail"><b>Email:</b>&nbsp;<span
                                                                    class="item">{{ $value->email }}</span>
                                                            </div>
                                                            <div class="detail"><b>Số điện thoại:</b>&nbsp;<span
                                                                    class="item">{{ $value->dienthoai }}</span>
                                                            </div>
                                                            <div class="detail"><b>Phòng ban:</b>&nbsp;<span
                                                                    class="item">
                                                                    @if ($value->phongban_id == null)
                                                                        Chưa phân phòng ban
                                                                    @else
                                                                        {{ $value->phongban->tenpb }}
                                                                    @endif
                                                                </span> </div>
                                                            <div class="detail"><b>Chức vụ:</b>&nbsp;<span
                                                                    class="item">{{ $value->chucvu->tencv }}</span>
                                                            </div>
                                                            <div class="detail ">
                                                                <b>Địa chỉ:</b> &nbsp;{{ $value->diachi }}
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="modal-footer">
                                                    <button type="button" data-dismiss="modal" class="btn btn-default">Đóng
                                                    </button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                            @endif
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>


    @include('includes.modal.delete')
@stop
