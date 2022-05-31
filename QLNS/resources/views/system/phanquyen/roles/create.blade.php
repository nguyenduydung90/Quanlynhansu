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
                        <b>DANH MỤC QUYỀN</b>
                    </div>
                    <div class="actions">
                        <button type="button" id="_btnaddPB" class="btn btn-success btn-xs" onclick="addkhoiPb()"><i
                                class="fa fa-plus"></i>&nbsp;Thêm mới quyền</button>
                    </div>
                </div>
                <form action="{{ route('roles.store') }}" method="post">
                    @csrf
                    <div class="group">
                        <div class="tenquyen col-md-4">
                            <label class="form-control-label">Tên quyền<span class="require">*</span></label>
                            <input type="text" name='name' id='name' class="form-control" required='required'>
                        </div>
                        <div class="diengiai col-md-8">
                            <label class="form-control-label">Mô tả quyền</label>
                            <input type="text" name='description' id='description' class="form-control"
                                required='required'>
                        </div>
                    </div>


                    <label class="form-control-label">Chọn các quyền</label>
                    <div class="portlet-body form-horizontal">
                        <table id="quyen_ct" class="table table-hover table-striped table-bordered"
                            style="min-height: 230px">
                            <thead>
                                <tr>
                                    <th class="text-center" style="width: 10%" rowspan="2">STT</th>
                                    <th class="text-center" style="width: 20%" rowspan="2">Tên quyền</th>
                                    <th class="text-center" style="width: 30%" rowspan="2">Mô tả quyền</th>
                                    <th class="text-center" colspan="4" style="border-bottom:1px solid #ddd">Thao tác
                                    </th>
                                </tr>
                                <tr>
                                    <th>Xem danh sách</th>
                                    <th>Thêm</th>
                                    <th>Sửa</th>
                                    <th>Xóa</th>
                                </tr>
                            </thead>
                            <tbody>
                                @if (isset($model))
                                    @foreach ($model as $key => $permissionParent)
                                        <tr>
                                            <td class="text-center">{{ $key + 1 }}</td>
                                            <td name="tenquyen">{{ $permissionParent->tenquyen }}</td>
                                            <td name="diengiai">{{ $permissionParent->diengiai }}</td>
                                            @foreach ($permissionParent->permissionChildrent as $value)
                                                <td>
                                                    <input type="checkbox" name="permission_id" value="{{ $value->id }}"
                                                        class="permission_id">{{ $value->tenquyen }}
                                                </td>
                                            @endforeach


                                        </tr>
                                    @endforeach
                                @endif
                            </tbody>
                        </table>
                    </div>

                    <div class="modal-footer">
                        <button type="button" data-dismiss="modal" class="btn btn-default">Hủy thao tác</button>
                        <button type="submit" id="submit" name="submit" value="submit" class="btn btn-primary">Đồng
                            ý</button>
                    </div>
                </form>



            </div>
        </div>
    </div>

    <!--Modal thông tin chức vụ -->
    {{-- <div id="khoipb-modal" tabindex="-1" role="dialog" aria-hidden="true" class="modal fade">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header modal-header-primary">
                    <button type="button" data-dismiss="modal" aria-hidden="true" class="close">&times;</button>
                    <h4 id="modal-header-primary-label" class="modal-title">Thông tin quyền</h4>
                </div>
                <div class="modal-body">
                    <label class="form-control-label">Tên quyền<span class="require">*</span></label>
                    <input type="text" name='tenquyen' id="tenquyen" class="form-control" required>

                    <label class="form-control-label">Mô tả quyền<span class="require">*</span></label>
                    <input type="text" name='diengiai' id="diengiai" class="form-control" required>
                    <br>
                    <label class="form-control-label">Chọn quyền chi tiết<span class="require">*</span></label>

                    <table id="quyen_ct" class="table table-hover table-striped table-bordered" style="min-height: 230px">
                        <thead>
                            <tr>
                                <th class="text-center" style="width: 10%" rowspan="2">STT</th>
                                <th class="text-center" style="width: 20%" rowspan="2">Tên quyền</th>
                                <th class="text-center" style="width: 30%" rowspan="2">Mô tả quyền</th>
                                <th class="text-center" colspan="4" style="border-bottom:1px solid #ddd">Thao tác</th>
                            </tr>
                            <tr>
                                <th>Xem danh sách</th>
                                <th>Thêm</th>
                                <th>Sửa</th>
                                <th>Xóa</th>
                            </tr>
                        </thead>
                        <tbody>
                            @if (isset($permissionParents))
                                @foreach ($permissionParents as $key => $permissionParent)
                                    <tr>
                                        <td class="text-center">{{ $key + 1 }}</td>
                                        <td name="tenquyen">{{ $permissionParent->tenquyen }}</td>
                                        <td name="diengiai">{{ $permissionParent->diengiai }}</td>
                                        @foreach ($permissionParent->permissionChildrent as $value)
                                            <td>
                                                <input type="checkbox" name="permission_id" value="{{ $value->id }}"
                                                    class="permission_id">
                                            </td>
                                        @endforeach


                                    </tr>
                                @endforeach
                            @endif
                        </tbody>
                    </table>


                    <input type="hidden" id="id_quyen" name="id_quyen" />
                </div>
                <div class="modal-footer">
                    <button type="button" data-dismiss="modal" class="btn btn-default">Hủy thao tác</button>
                    <button type="submit" id="submit" name="submit" value="submit" class="btn btn-primary"
                        onclick="cfCV()">Đồng ý</button>
                </div>
            </div>
        </div>
    </div> --}}

    {{-- <script>
        function addkhoiPb() {
            var date = new Date();
            $('#tenquyen').val('');
            $('#diengiai').val('');
            // $('.permission_id').val('');
            $('#id_quyen').val(0);
            $('#khoipb-modal').modal('show');
        }

        function editkhoiPb(e, id) {
            var tr = $(e).closest('tr');
            $('#tenquyen').val($(tr).find('td[name=tenquyen]').text());
            $('#diengiai').val($(tr).find('td[name=diengiai]').text());
            var curent_permission=$('.old_permission_id').val();

            console.log(curent_permission);
            $('#id_quyen').val(id);
            $('#khoipb-modal').modal('show');
        }

        function cfCV() {
            var valid = true;
            var message = '';

            var tenquyen = $('#tenquyen').val();
            var diengiai = $('#diengiai').val();
            var permission_id = [];

            $('input[name=permission_id]:checked').map(function() {
                permission_id.push($(this).val());
            });
            var id = $('#id_quyen').val();


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
                    url: "{{ route('role.store') }}",
                    type: 'post',
                    data: {
                        // _token: CSRF_TOKEN,
                        tenquyen: tenquyen,
                        diengiai: diengiai,
                        permission_id: permission_id,
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
                $('#khoipb-modal').modal('hide');
            } else {
                alert(message);
            }
            return valid;
        }
    </script> --}}

    @include('includes.modal.delete')
@stop
