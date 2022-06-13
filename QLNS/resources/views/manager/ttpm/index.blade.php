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
                        <b>DANH SÁCH PHẦN MỀM</b>
                    </div>
                    <div class="actions">
                        @can('add_ttpm')
                            <button type="button" id="_btnaddPB" class="btn btn-default btn-xs" onclick="addCV()"><i
                                    class="fa fa-plus"></i>&nbsp;Thêm phần mềm</button>
                        @endcan

                    </div>
                </div>
                <div class="portlet-body form-horizontal">
                    <table id="sample_3" class="table table-hover table-striped table-bordered" style="min-height: 230px">
                        <thead>
                            <tr>
                                <th class="text-center" style="width: 10%">STT</th>
                                <th class="text-center">Tên phần mềm</th>
                                <th class="text-center">Công nghệ</th>
                                <th class="text-center">Cán bộ </br>phụ trách</th>
                                <th class="text-center">Thời gian </br>phát triển</th>
                                {{-- <th class="text-center">File</th> --}}
                                <th class="text-center">Thao tác</th>
                            </tr>
                        </thead>
                        <tbody>
                            @if (isset($model))
                                @foreach ($model as $key => $value)
                                    <tr>
                                        <td class="text-center">{{ $key + 1 }}</td>
                                        <td name="tencv">{{ $value->tenpm }}</td>
                                        <td name="diengiai">{{ $value->congnghe }}</td>
                                        <td name="diengiai">
                                            {{ $value->canbo_id == null ? 'Chưa phân' : $value->canbo->hoten }}</td>
                                        <td name="diengiai">{{ $value->thoigianphattrien }}</td>
                                        {{-- <td name="diengiai">
                                            @if($value->hdsd)
                                            <a href="{{ asset($value->hdsd) }}">Tải xuống</a>
                                            @else
                                            Trống
                                            @endif
                                        </td> --}}
                                        <td class="text-center">
                                            @can('lichsu_ttpm')
                                            <a type="button" href="{{ route('ttpm.lichsu', $value->id) }}"
                                                class="btn btn-default btn-xs mbs">
                                                <i class="fa fa-edit"></i>&nbsp; Lịch sử theo dõi</a>
                                                @endcan
                                            @can('edit_ttpm')
                                                <button type="button" data-target="#ttpm-modal{{ $value->id }}"
                                                    data-toggle="modal" class="btn btn-default btn-xs mbs">
                                                    <i class="fa fa-edit"></i>&nbsp; Chỉnh sửa</button>
                                            @endcan

                                            @can('delete_ttpm')
                                                <button type="button"
                                                    onclick="cfDel('/thuvien/ttpm/delete/{{ $value->id }}')"
                                                    class="btn btn-default btn-xs mbs" data-target="#delete-modal-confirm"
                                                    data-toggle="modal">
                                                    <i class="fa fa-trash-o"></i>&nbsp; Xóa</button>
                                            @endcan

                                        </td>
                                    </tr>

                                    <!--Modal cập nhật thông tin phần mềm -->
                                    <div id="ttpm-modal{{ $value->id }}" tabindex="-1" role="dialog" aria-hidden="true"
                                        class="modal fade">
                                        <form action="{{ route('ttpm.update', $value->id) }}" method="post"
                                            enctype="multipart/form-data">
                                            @csrf
                                            <div class="modal-dialog">
                                                <div class="modal-content">
                                                    <div class="modal-header modal-header-primary">
                                                        <button type="button" data-dismiss="modal" aria-hidden="true"
                                                            class="close">&times;</button>
                                                        <h4 id="modal-header-primary-label" class="modal-title">Thông tin
                                                            phần mềm</h4>
                                                    </div>
                                                    <div class="modal-body">
                                                        <label class="form-control-label">Tên phần mềm<span
                                                                class="require">*</span></label>
                                                        <input type="text" name='tenpm' id="tenpm"
                                                            value="{{ $value->tenpm }}" class="form-control" required>
                                                        <br>
                                                        <label class="form-control-label">Cán bộ phụ trách</label>
                                                        <select name="canbo_id" id="canbo_id" class="form-control select2me"
                                                            style="margin-bottom:15px ">
                                                            <option value="">-- Chọn cán bộ ---</option>
                                                            @foreach ($canbo as $cb)
                                                                <option value="{{ $cb->id }}"
                                                                    {{ $cb->id == $value->canbo_id ? 'selected' : '' }}>

                                                                    {{ $cb->hoten }}</option>
                                                            @endforeach
                                                        </select>
                                                        <br>
                                                        <label class="form-control-label">Công nghệ sử dụng<span
                                                                class="require">*</span></label>
                                                        <input type="text" name='congnghe' id="congnghe"
                                                            value="{{ $value->congnghe }}" class="form-control" required>
                                                        <br>
                                                        <label class="form-control-label">Thời gian phát triển<span
                                                                class="require">*</span></label>
                                                        <input type="text" name='thoigianphattrien' id="thoigianphattrien"
                                                            value="{{ $value->thoigianphattrien }}" class="form-control"
                                                            required>
                                                        <br>
                                                        {{-- <label class="form-control-label">File giới thiệu phần mềm<span
                                                                class="require">*</span></label>
                                                        <input type="file" name='hdsd' id="hdsd" value="{{ $value->hdsd }}"
                                                            class="form-control"> --}}
                                                    </div>
                                                    <div class="modal-footer">
                                                        <button type="button" data-dismiss="modal"
                                                            class="btn btn-default">Hủy thao tác</button>
                                                        <button type="submit" id="submit" name="submit" value="submit"
                                                            class="btn btn-primary">Đồng ý</button>
                                                    </div>
                                                </div>
                                            </div>
                                        </form>
                                    </div>
                                @endforeach
                            @endif
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    <!--Modal thêm thông tin phần mềm -->
    <div id="ttpm-modal" tabindex="-1" role="dialog" aria-hidden="true" class="modal fade">
        <form action="{{ route('ttpm.store') }}" method="post" enctype="multipart/form-data">
            @csrf
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header modal-header-primary">
                        <button type="button" data-dismiss="modal" aria-hidden="true"
                            class="close">&times;</button>
                        <h4 id="modal-header-primary-label" class="modal-title">Thông tin phần mềm</h4>
                    </div>
                    <div class="modal-body">
                        <label class="form-control-label">Tên phần mềm<span class="require">*</span></label>
                        <input type="text" name='tenpm' id="tenpm" class="form-control" required>
                        <br>
                        <label class="form-control-label">Cán bộ phụ trách</label>
                        <select name="canbo_id" id="canbo_id" class="form-control select2me" 
                            style="margin-bottom:15px ">
                            <option value="">-- Chọn cán bộ ---</option>
                            @foreach ($canbo as $cb)
                                <option value="{{ $cb->id }}">

                                    {{ $cb->hoten }}</option>
                            @endforeach
                        </select>
                        <br>
                        <label class="form-control-label">Công nghệ sử dụng<span class="require">*</span></label>
                        <input type="text" name='congnghe' id="congnghe" class="form-control" required>
                        <br>
                        <label class="form-control-label">Thời gian phát triển<span class="require">*</span></label>
                        <input type="text" name='thoigianphattrien' id="thoigianphattrien" class="form-control" required>
                        <br>
                        {{-- <label class="form-control-label">File giới thiệu phần mềm</label>
                        <input type="file" name='hdsd' id="hdsd" class="form-control"> --}}
                    </div>
                    <div class="modal-footer">
                        <button type="button" data-dismiss="modal" class="btn btn-default">Hủy thao tác</button>
                        <button type="submit" id="submit" name="submit" value="submit" class="btn btn-primary">Đồng
                            ý</button>
                    </div>
                </div>
            </div>
        </form>
    </div>

    <script>
        function addCV() {
            $('#ttpm-modal').modal('show');
        }

        function editCV(e, id) {
            var tr = $(e).closest('tr');
            $('#tencv').val($(tr).find('td[name=tencv]').text());
            $('#diengiai').val($(tr).find('td[name=diengiai]').text());
            $('#id_cv').val(id);
            $('#chucvu-modal').modal('show');
        }

        function cfCV() {
            var valid = true;
            var message = '';

            var tencv = $('#tencv').val();
            var diengiai = $('#diengiai').val();
            var id = $('#id_cv').val();

            if (tencv == '') {
                valid = false;
                message += 'Tên chức vụ không được bỏ trống \n';
            }

            if (valid) {
                $.ajaxSetup({
                    headers: {

                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }

                });
                $.ajax({
                    url: '/danh_muc/chuc_vu_cb/store',
                    type: 'post',
                    data: {
                        // _token: CSRF_TOKEN,
                        tencv: tencv,
                        diengiai: diengiai,
                        id: id
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
                $('#chucvu-modal').modal('hide');
            } else {
                alert(message);
            }
            return valid;
        }
    </script>

    @include('includes.modal.delete')
@stop
