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
            // $(".Modulchildrent").select2();
            $(".modulchildren").select2();
        });
    </script>
@stop

@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="portlet light bordered">
                <div class="portlet-title">
                    <div class="caption">
                        <b>DANH MỤC PERMISSION</b>
                    </div>
                    <div class="actions">
                        <button type="button" id="_btnaddPB" class="btn btn-default btn-xs" onclick="addkhoiPb()"><i
                                class="fa fa-plus"></i>&nbsp;Thêm mới permission</button>
                    </div>
                </div>
                <div class="portlet-body form-horizontal">
                    <table id="sample_3" class="table table-hover table-striped table-bordered" style="min-height: 230px">
                        <thead>
                            <tr>
                                <th class="text-center" style="width: 10%">STT</th>
                                <th class="text-center">Tên modul</th>
                                <th class="text-center">Mô tả </th>
                                <th class="text-center">Thao tác</th>
                            </tr>
                        </thead>
                        <tbody>
                            @if (isset($model))
                                @foreach ($model as $key => $value)
                                    <tr>
                                        <td class="text-center">{{ $key + 1 }}</td>
                                        <td name="tenquyen">{{ $value->tenquyen }}</td>
                                        <td name="diengiai">{{ $value->diengiai }}</td>
                                        <td>
                                            <button type="button"  class="btn btn-default btn-xs mbs" data-target="#permission-modal{{ $value->id }}"
                                            data-toggle="modal"><i class="fa fa-edit"></i>&nbsp;Chỉnh sửa</button>
                                            <button type="button"
                                                onclick="cfDel('/phanquyen/permissions/delete/{{ $value->id }}')"
                                                class="btn btn-default btn-xs mbs" data-target="#delete-modal-confirm"
                                                data-toggle="modal">
                                                <i class="fa fa-trash-o"></i>&nbsp; Xóa</button>
                                        </td>
                                    </tr>
                                    <div id="permission-modal{{ $value->id }}" tabindex="-1" role="dialog" aria-hidden="true" class="modal fade">
                                        <form action="{{route('permission.update',$value->id)}}" method="post" enctype="multipart/form-data">
                                            @csrf
                                        <div class="modal-dialog">
                                            <div class="modal-content">
                                                <div class="modal-header modal-header-primary">
                                                    <button type="button" data-dismiss="modal" aria-hidden="true" class="close">&times;</button>
                                                    <h4 id="modal-header-primary-label" class="modal-title">Thông tin permission</h4>
                                                </div>
                                                <div class="modal-body">
                                                    <label class="form-control-label">Tên modul<span class="require">*</span></label>
                                                    <input type="text" name='tenquyen' id="tenquyen{{$value->id}}" value="{{ $value->tenquyen }}" class="form-control" required>
                                
                                                    <label class="form-control-label">Mô tả<span class="require">*</span></label>
                                                    <input type="text" name='diengiai' id="diengiai{{$value->id}}" value="{{ $value->diengiai }}" class="form-control" required>
                                
                                                    {{-- <label class="form-control-label">Quyền chi tiết<span class="require">*</span></label>
                                                    <select name="permission_childrent[]" id="Modulchildrent{{$value->id}}" class="form-control modulchildren" multiple>
                                                        <option value="list" {{$value->permissionChildrent->contains('tenquyen','list')?'selected':''}}>Xem danh sách</option>
                                                        <option value="edit"{{$value->permissionChildrent->contains('tenquyen','edit')?'selected':''}}>Sửa quyền</option>
                                                        <option value="add"{{$value->permissionChildrent->contains('tenquyen','add')?'selected':''}}>Thêm quyền</option>
                                                        <option value="delete"{{$value->permissionChildrent->contains('tenquyen','delete')?'selected':''}}>Xóa quyền</option>   
                                                  </select> --}}
                                                    {{-- <input type="hidden" id="id_quyen" class="id_quyen" name="id_quyen" value="{{$value->id}}" /> --}}
                                                </div>
                                                <div class="modal-footer">
                                                    <button type="button" data-dismiss="modal" class="btn btn-default">Hủy thao tác</button>
                                                    <button type="submit" id="submit" name="submit" value="submit" class="btn btn-primary"
                                                       >Đồng ý</button>
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

    <!--Modal thông tin chức vụ -->
    <div id="khoipb-modal" tabindex="-1" role="dialog" aria-hidden="true" class="modal fade">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header modal-header-primary">
                    <button type="button" data-dismiss="modal" aria-hidden="true" class="close">&times;</button>
                    <h4 id="modal-header-primary-label" class="modal-title">Thông tin permission</h4>
                </div>
                <div class="modal-body">
                    <label class="form-control-label">Tên modul<span class="require">*</span></label>
                    <input type="text" name='tenquyen' id="tenquyen_add" class="form-control" required>

                    <label class="form-control-label">Mô tả<span class="require">*</span></label>
                    <input type="text" name='diengiai' id="diengiai_add" class="form-control" required>

                    {{-- <label class="form-control-label">Quyền chi tiết khác</label>
                    <select name="permission_childrent[]" id="Modulchildrent_add" class="form-control Modulchildrent select2me" placeholder='-- Chọn thêm quyền chi tiết ---' multiple>
                        <option value="lichsu">Xem lịch sử</option>
                        <option value="download">Download</option>
                    </select> --}}
                    <input type="hidden" id="id_quyen_add" name="id_quyen" />
                </div>
                <div class="modal-footer">
                    <button type="button" data-dismiss="modal" class="btn btn-default">Hủy thao tác</button>
                    <button type="submit" id="submit" name="submit" value="submit" class="btn btn-primary"
                        onclick="cfCV()">Đồng ý</button>
                </div>
            </div>
        </div>
    </div>

    <script>
        function addkhoiPb() {
            var date = new Date();
            $('#tenquyen_add').val('');
            $('#diengiai_add').val('');
            $('#Modulchildrent_add').val('');
            $('#id_quyen_add').val(0);
            $('#khoipb-modal').modal('show');
        }

        function editkhoiPb(e, id) {
            var tr = $(e).closest('tr');
            $('#tenquyen').val($(tr).find('td[name=tenquyen]').text());
            $('#diengiai').val($(tr).find('td[name=diengiai]').text());
            $('#id_quyen').val(id);
            $('#khoipb-modal').modal('show');
        }

        function cfCV() {
            var valid = true;
            var message = '';

            var tenquyen = $('#tenquyen_add').val();
            var diengiai = $('#diengiai_add').val();
            var permission_childrent = $('#Modulchildrent_add').val();
            var id = $('#id_quyen_add').val();
            if (tenquyen == '') {
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
                    url: "{{route('permission.store')}}",
                    type: 'post',
                    data: {
                        // _token: CSRF_TOKEN,
                        tenquyen: tenquyen,
                        diengiai: diengiai,
                        permission_childrent: permission_childrent,
                        id: id
                    },
                    dataType: 'JSON',
                    success: function(data) {
                        console.log(data);
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

        function edRole(id) {
            var valid = true;
            var message = '';

            var tenquyen = $('#tenquyen'+id).val();
            var diengiai = $('#diengiai'+id).val();
            var permission_childrent = $('#Modulchildrent'+id).val();
            var id = id;
            if (tenquyen == '') {
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
                    url: "{{route('permission.store')}}",
                    type: 'post',
                    data: {
                        // _token: CSRF_TOKEN,
                        tenquyen: tenquyen,
                        diengiai: diengiai,
                        permission_childrent: permission_childrent,
                        id: id
                    },
                    dataType: 'JSON',
                    success: function(data) {
                        console.log(data);
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
