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

        /* td {
                                                line-height: 80px !important;
                                               
                                            }
                                            .diachi{
                                                line-height: 18px !important;
                                            } */
        .info {
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
                        <b>DANH SÁCH CÁN BỘ</b>
                    </div>
                    <div class="actions">
                        <button type="button" class="btn btn-lg btn-default" data-target="#danhsach-modal"
                            data-toggle="modal">
                            <i class="fa fa-print"></i> In danh sách
                        </button>
                        @can('add_canbo')
                            <a href="{{ route('canbo.create') }}" type="button" id="_btnaddPB"
                                class="btn btn-default btn-xs"><i class="fa fa-plus"></i>&nbsp;Thêm mới cán bộ</a>
                        @endcan

                    </div>
                </div>

                <div class="portlet-body form-horizontal">
                    <table id="sample_3" class="table table-hover table-striped table-bordered" style="min-height: 230px">
                        <thead>
                            <tr>
                                <th class="text-center" style="width: 2%">STT</th>
                                {{-- <th class="text-center" style="width: 5%">Hình ảnh</th> --}}
                                <th class="text-center">Tên cán bộ</th>
                                <th class="text-center">Ngày sinh</th>
                                <th class="text-center" style="width:3%">Giới</br>tính</th>
                                <th class="text-center">Email</th>
                                <th class="text-center">Điện thoại</th>
                                <th class="text-center" style="width: 25%">Địa chỉ hiện tại</th>
                                <th class="text-center" style="width: 11%">Phân loại </br>theo dõi</th>
                                {{-- <th class="text-center">Chức vụ</th> --}}
                                <th class="text-center" style="width: 25%">Thao tác</th>
                            </tr>
                        </thead>
                        <tbody>
                            @if (isset($model))
                                @foreach ($model as $key => $value)
                                    <tr>
                                        <td class="text-center">{{ $key + 1 }}</td>
                                        {{-- <td class="text-center"><img src="{{ asset($value->anh) }}" alt=""
                                                style="width: 96px; height:96px"></td> --}}
                                        <td name="tencb">
                                            <p class="info"><b style="color: #5b9bd1">{{ $value->hoten }}</b>
                                            </p>
                                            <p class="info">Chức vụ: {{ $value->chucvu->tencv }}</p>
                                            <p class="info">Phòng: {{ $value->phongban->tenpb }}</p>
                                        </td>
                                        <td name="ngaysinh">
                                            {{ \Carbon\Carbon::parse($value->ngaysinh)->format('d/m/Y') }}
                                        </td>
                                        <td name="gioitinh">{{ $value->gioitinh == 1 ? 'Nam' : 'Nữ' }}</td>
                                        <td name="email">{{ $value->email }}</td>
                                        <td name="dienthoai">{{ $value->sdt }}</td>
                                        <td name="diachi" class="diachi">{{ $value->thuongtru }}</td>
                                        <td name="theodoi" class="theodoi">
                                            <select name="theodoi" id='theodoi{{ $value->id }}'
                                                onchange="theodoi({{ $value->id }})" class="form-control">
                                                <option value="1" {{ $value->theodoi == 1 ? 'selected' : '' }}>Đang công tác
                                                </option>
                                                <option value="0" {{ $value->theodoi == 0 ? 'selected' : '' }}>Ngừng theo dõi
                                                </option>
                                            </select>
                                        </td>
                                        <td class="text-center">
                                            @can('edit_canbo')
                                                <a type="button" href="{{ route('canbo.edit', $value->id) }}"
                                                    class="btn btn-default btn-xs mbs">
                                                    <i class="fa fa-edit"></i>&nbsp; Chỉnh sửa</a>
                                            @endcan

                                            <a href="{{ route('canbo.inchitiet', $value->id) }}"
                                                class="btn btn-default btn-xs mbs" TARGET="_blank">
                                                <i class="fa fa-print"></i>&nbsp; In hồ sơ</a>

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
    <!--Modal thông tin cán bộ -->
    <div id="canbo-modal" tabindex="-1" role="dialog" aria-hidden="true" class="modal fade">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header modal-header-primary">
                    <button type="button" data-dismiss="modal" aria-hidden="true" class="close">&times;</button>
                    <h4 id="modal-header-primary-label" class="modal-title"><b class="hoten">Thông tin
                            cán bộ </b></h4>
                </div>
                <div class="modal-body">
                    <div class="media">
                        <table id="user" class="table table-bordered table-striped">
                            <tbody>
                                <tr>
                                    <td style="width:15%">
                                        <b>Chức vụ</b>
                                    </td>
                                    <td name='chucvu' style="width:35%">
                                        <span class="text-muted"></span>
                                    </td>
                                </tr>
                                <tr>
                                    <td style="width:15%">
                                        <b>Phòng ban</b>
                                    </td>
                                    <td name='phongban' style="width:35%">
                                        <span class="text-muted"></span>
                                    </td>
                                </tr>
                                <tr>
                                    <td style="width:15%">
                                        <b>Quê quán</b>
                                    </td>
                                    <td name='quequan' style="width:35%">
                                        <span class="text-muted"></span>
                                    </td>
                                </tr>
                                <tr>
                                    <td style="width:15%">
                                        <b>Địa chỉ thường trú</b>
                                    </td>
                                    <td name='thuongtru' style="width:35%">
                                        <span class="text-muted"></span>
                                    </td>
                                </tr>
                                <tr>
                                    <td style="width:15%">
                                        <b>Ngày sinh</b>
                                    </td>
                                    <td name='ngaysinh' style="width:35%">
                                        <span class="text-muted">

                                        </span>
                                    </td>

                                </tr>
                                <tr>
                                    <td style="width:15%">
                                        <b>CMND/CCCD</b>
                                    </td>
                                    <td name='cccd' style="width:35%">
                                        <span class="text-muted"></span>
                                    </td>
                                </tr>

                                <tr>
                                    <td style="width:15%">
                                        <b>Số điện thoại</b>
                                    </td>
                                    <td name='sdt' style="width:35%">
                                        <span class="text-muted"></span>
                                    </td>
                                </tr>

                                <tr>
                                    <td style="width:15%">
                                        <b>Trình độ chuyên môn</b>
                                    </td>
                                    <td name='tdcm' style="width:35%">
                                        <span class="text-muted"></span>
                                    </td>
                                </tr>

                                <tr>
                                    <td style="width:15%">
                                        <b>Bằng cấp</b>
                                    </td>
                                    <td name='bangcap' style="width:35%">
                                        <span class="text-muted"></span>
                                    </td>
                                </tr>
                                <tr>
                                    <td style="width:15%">
                                        <b>Trường đào tạo</b>
                                    </td>
                                    <td name='truongdaotao' style="width:35%">
                                        <span class="text-muted"></span>
                                    </td>
                                </tr>
                                <tr>
                                    <td style="width:15%">
                                        <b>Năm tốt nghiệp</b>
                                    </td>
                                    <td name='namtotnghiep' style="width:35%">
                                        <span class="text-muted"></span>
                                    </td>
                                </tr>
                                <tr>
                                    <td style="width:15%">
                                        <b>Ngày vào công ty</b>
                                    </td>
                                    <td name='ngayvaoct' style="width:35%">
                                        <span class="text-muted"></span>
                                    </td>
                                </tr>

                            </tbody>
                        </table>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" data-dismiss="modal" class="btn btn-default">Đóng
                    </button>
                </div>
            </div>
        </div>
    </div>

    <!--Modal thông tin in cán bộ -->
    <div id="danhsach-modal" tabindex="-1" role="dialog" aria-hidden="true" class="modal fade">
        <div class="modal-dialog">
            <form action="{{ route('canbo.indanhsach') }}" method="post" target="_blank" enctype="multipart/form-data">
                @csrf
                <div class="modal-content">
                    <div class="modal-header modal-header-primary">
                        <button type="button" data-dismiss="modal" aria-hidden="true"
                            class="close">&times;</button>
                        <h4 id="modal-header-primary-label" class="modal-title"><b class="hoten">Thông tin danh
                                sách
                                cán bộ </b></h4>
                    </div>

                    <div class="modal-body">
                        <div class="media">
                            <div class="col-md-12">
                                <label class="control-label">Khối/Tổ công tác</label>
                                <select name="dmkhoi_id" class="form-control select2me select2-offscreen" tabindex="-1"
                                    title="">
                                    <option value="">-- Chọn khối/tổ công tác --</option>
                                    @foreach ($khoipb as $item)
                                        <option value="{{ $item->id }}">{{ $item->tenkhoi }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="col-md-12" style="margin-top: 5px">
                                <label class="control-label">Phòng ban công tác</label>
                                <select name="phongban_id" class="form-control select2me select2-offscreen" tabindex="-1"
                                    title="">
                                    <option value="">-- Chọn phòng ban công tác --</option>
                                    @foreach ($phongban as $item)
                                        <option value="{{ $item->id }}">{{ $item->tenpb }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" data-dismiss="modal" class="btn btn-default">Đóng
                        </button>
                        <button type="submit" id="submit" name="submit" value="submit" class="btn btn-primary">Đồng
                            ý</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
    <script>
        function chitiet(id) {
            var CSRF_TOKEN = $('meta[name="csrf-token"]').attr('content');
            $.ajax({
                url: "{{ route('canbo.chitiet') }}",
                type: 'GET',
                data: {
                    _token: CSRF_TOKEN,
                    id: id
                },
                dataType: 'JSON',
                success: function(data) {
                    console.log(data.chucvu.tencv);
                    $('#user').find('td[name=quequan]').text(data.quequan);
                    $('#user').find('td[name=thuongtru]').text(data.thuongtru);
                    $('#user').find('td[name=ngaysinh]').text(data.ngaysinh);
                    $('#user').find('td[name=cccd]').text(data.cccd);
                    $('#user').find('td[name=sdt]').text(data.sdt);
                    $('#user').find('td[name=tdcm]').text(data.tdcm);
                    $('#user').find('td[name=bangcap]').text(data.bangcap);
                    $('#user').find('td[name=truongdaotao]').text(data.truongdaotao);
                    $('#user').find('td[name=namtotnghiep]').text(data.namtotnghiep);
                    $('#user').find('td[name=chucvu]').text(data.chucvu.tencv);
                    $('#user').find('td[name=phongban]').text(data.phongban.tenpb);
                    $('#user').find('td[name=ngayvaoct]').text(data.ngayvaoct);
                    $('#modal-header-primary-label').find('.hoten').text('Thông tin cán bộ: ' + data.hoten);
                },
                error: function(message) {
                    alert(message);
                }
            });
            $('#canbo-modal').modal('show')
        }

        function theodoi(id) {
            var theodoi = $('#theodoi' + id).val();
            $.ajaxSetup({
                headers: {

                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }

            });
            $.ajax({
                url: "{{ route('canbo.theodoi') }}",
                type: 'GET',
                data: {
                    id: id,
                    theodoi: theodoi
                },
                dataType: 'JSON',
                success: function(data) {
                    if (data.status == 'success') {
                        location.reload();
                    }
                },
                error: function(message) {
                    alert(message);
                }
            });

        }
    </script>

    @include('includes.modal.delete')
@stop
