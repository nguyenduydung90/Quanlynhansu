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
                        <b>DANH SÁCH</b>
                    </div>
                    <div class="actions">
                        @can('add_file')
                            <button type="button" id="_btnaddPB" class="btn btn-default btn-xs" onclick="addCV()"><i
                                    class="fa fa-plus"></i>&nbsp;Up File</button>
                        @endcan

                    </div>
                </div>
                <div class="portlet-body form-horizontal">
                    <table id="sample_3" class="table table-hover table-striped table-bordered" style="min-height: 230px">
                        <thead>
                            <tr>
                                <th class="text-center" style="width: 10%">STT</th>
                                <th class="text-center">Tên phần mềm</th>
                                <th class="text-center">Nội dung</th>
                                @can('download_file')
                                <th class="text-center">File giới thiệu</th>
                                <th class="text-center">File demo</th>
                                @endcan
                                <th class="text-center">Thao tác</th>
                            </tr>
                        </thead>
                        <tbody>
                            @if (isset($model))
                                @foreach ($model as $key => $value)
                                    <tr>
                                        <td class="text-center">{{ $key + 1 }}</td>
                                        <td name="tencv">{{$value->ttpm_id == null?'':$value->ttpm->tenpm }}</td>
                                        <td name="diengiai">{{ $value->noidung }}</td>
                                        @can('download_file')
                                        <td name="hdsd">
                                            
                                            @if($value->hdsd)
                                            <a href="{{ asset($value->hdsd) }}">Tải xuống</a>
                                            @else
                                            Chưa có file
                                            @endif
                                          
                                        </td>
                                        <td name="demo">
                                         
                                            @if($value->demo)
                                            <a href="{{ asset($value->demo) }}">Tải xuống</a>
                                            @else
                                            Chưa có file
                                            @endif
                                            
                                        </td>
                                        @endcan
                                        <td class="text-center">
                                            @can('lichsu_file')
                                            <a type="button" href="{{route('file.lichsu',$value->ttpm_id)}}"
                                                class="btn btn-default btn-xs mbs">
                                                <i class="fa fa-edit"></i>&nbsp; Lịch sử theo dõi</a>
                                            @endcan
                                            @can('edit_file')
                                                <button type="button" data-target="#file-modal{{ $value->id }}"
                                                    data-toggle="modal" class="btn btn-default btn-xs mbs">
                                                    <i class="fa fa-edit"></i>&nbsp; Chỉnh sửa</button>
                                            @endcan

                                            @can('delete_file')
                                                <button type="button"
                                                    onclick="cfDel('/thuvien/file/delete/{{ $value->id }}')"
                                                    class="btn btn-default btn-xs mbs" data-target="#delete-modal-confirm"
                                                    data-toggle="modal">
                                                    <i class="fa fa-trash-o"></i>&nbsp; Xóa</button>
                                            @endcan

                                        </td>
                                    </tr>

                                    <!--Modal cập nhật thông tin file phần mềm -->
                                    <div id="file-modal{{ $value->id }}" tabindex="-1" role="dialog" aria-hidden="true"
                                        class="modal fade">
                                        <form action="{{ route('file.update', $value->id) }}" method="post"
                                            enctype="multipart/form-data">
                                            @csrf
                                            <div class="modal-dialog">
                                                <div class="modal-content">
                                                    <div class="modal-header modal-header-primary">
                                                        <button type="button" data-dismiss="modal" aria-hidden="true"
                                                            class="close">&times;</button>
                                                        <h4 id="modal-header-primary-label" class="modal-title">Thông tin File
                                                            phần mềm</h4>
                                                    </div>
                                                    <div class="modal-body">
                                                        <label class="form-control-label">Tên phần mềm</label>
                                                        <select name="ttpm_id" class="form-control select2me" 
                                                            style="margin-bottom:15px ">
                                                            <option value="">-- Chọn phần mềm ---</option>
                                                            @foreach ($pmedit as $item)
                                                                <option value="{{ $item->id }}" {{$item->id==$value->ttpm_id?'selected':''}}>
                                
                                                                    {{ $item->tenpm }}</option>
                                                            @endforeach
                                                        </select>
                                                        <br>
                                                        <label class="form-control-label">Nội dung</label>
                                                        <input type="text" name='noidung' value="{{$value->noidung}}"  class="form-control">
                                                        <br>
                                                        <label class="form-control-label">File giới thiệu phần mềm</label>
                                                        <input type="file" name='hdsd' value="{{$value->hdsd}}"  class="form-control" accept=".doc,.pdf,.docx,.xls,.xlsx">
                                                        <br>
                                                        <label class="form-control-label">File demo</label>
                                                        <input type="file" name='demo' value="{{$value->demo}}" class="form-control" accept=".doc,.pdf,.docx,.xls,.xlsx">
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
        <form action="{{ route('file.store') }}" method="post" enctype="multipart/form-data">
            @csrf
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header modal-header-primary">
                        <button type="button" data-dismiss="modal" aria-hidden="true"
                            class="close">&times;</button>
                        <h4 id="modal-header-primary-label" class="modal-title">Thông tin File phần mềm</h4>
                    </div>
                    <div class="modal-body">
                        <label class="form-control-label">Tên phần mềm</label>
                        <select name="ttpm_id" id="ttpm_id" class="form-control select2me" 
                            style="margin-bottom:15px ">
                            <option value="">-- Chọn phần mềm ---</option>
                            @foreach ($pm as $value)
                                <option value="{{ $value->id }}">

                                    {{ $value->tenpm }}</option>
                            @endforeach
                        </select>
                        <br>
                        <label class="form-control-label">Nội dung</label>
                        <input type="text" name='noidung' id="noidung" class="form-control">
                        <br>
                        <label class="form-control-label">File giới thiệu phần mềm</label>
                        <input type="file" name='hdsd' id="hdsd" class="form-control" accept=".doc,.pdf,.docx,.xls,.xlsx">
                        <br>
                        <label class="form-control-label">File demo</label>
                        <input type="file" name='demo' id="demo" class="form-control" accept=".doc,.pdf,.docx,.xls,.xlsx">
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
