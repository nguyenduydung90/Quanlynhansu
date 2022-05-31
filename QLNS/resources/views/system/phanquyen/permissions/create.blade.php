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
            $("#Modulchildrent").select2();
        });
    </script>
@stop

@section('content')


    <!--Modal thông tin chức vụ -->
    {{-- <div id="khoipb-modal" tabindex="-1" role="dialog" aria-hidden="true" class="modal fade"> --}}
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header modal-header-primary">
                    <button type="button" data-dismiss="modal" aria-hidden="true" class="close">&times;</button>
                    <h4 id="modal-header-primary-label" class="modal-title">Thông tin quyền</h4>
                </div>
                <div class="modal-body">
                    <form action="{{route('permission.store')}}" method="post">
                        @csrf
                    <label class="form-control-label">Tên quyền<span class="require">*</span></label>
                    <input type="text" name='tenquyen' id="tenquyen" class="form-control" required>

                    <label class="form-control-label">Mô tả quyền<span class="require">*</span></label>
                    <input type="text" name='diengiai' id="diengiai" class="form-control" required>

                    <label class="form-control-label">Quyền chi tiết<span class="require">*</span></label>
                    <select name="permission_childrent[]" id="Modulchildrent" class="form-control" multiple>
                        <option value="add">Add</option>
                        <option value="edit">Edit</option>
                        <option value="update">Update</option>
                        <option value="delete">Delete</option>
                    </select>
                    <input type="hidden" id="id_quyen" name="id_quyen" />
                </div>
                <div class="modal-footer">
                    <button type="button" data-dismiss="modal" class="btn btn-default">Hủy thao tác</button>
                    <button type="submit" id="submit" name="submit" value="submit" class="btn btn-primary"
                        onclick="cfCV()">Đồng ý</button>
                </div>
            </form>
            </div>
        </div>
    {{-- </div> --}}

    <script>
        function addkhoiPb() {
            var date = new Date();
            $('#tenquyen').val('');
            $('#diengiai').val('');
            $('#Modulchildrent').val('');
            $('#id_quyen').val(0);
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

            var tenquyen = $('#tenquyen').val();
            var diengiai = $('#diengiai').val();
            var permission_childrent = $('#Modulchildrent').val();
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
                    url: "{{route('role.store')}}",
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
