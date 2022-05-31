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
                        <button  type="button" id="_btnaddPB" class="btn btn-success btn-xs" onclick="addkhoiPb()" ><i
                                class="fa fa-plus"></i>&nbsp;Thêm mới quyền</button>
                    </div>
                </div>
                <div class="portlet-body form-horizontal">
                    <table id="sample_3" class="table table-hover table-striped table-bordered" style="min-height: 230px">
                        <thead>
                            <tr>
                                <th class="text-center" style="width: 10%">STT</th>
                                <th class="text-center">Tên quyền</th>
                                <th class="text-center">Mô tả quyền</th>
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
                                            <a type="button" href="{{route('roles.edit',$value->id)}}"
                                                class="btn btn-info btn-xs mbs">
                                                <i class="fa fa-edit"></i>&nbsp; Chỉnh sửa</a>
                                            <button type="button"
                                                onclick="cfDel('/phanquyen/roles/delete/{{ $value->id }}')"
                                                class="btn btn-danger btn-xs mbs" data-target="#delete-modal-confirm"
                                                data-toggle="modal">
                                                <i class="fa fa-trash-o"></i>&nbsp; Xóa</button>
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
    <div id="khoipb-modal" tabindex="-1" role="dialog" aria-hidden="true" class="modal fade">
        <div class="modal-dialog">
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
            $('#tenquyen').val('');
            $('#diengiai').val('');;
            $('#khoipb-modal').modal('show');
        }

        function cfCV() {
            var valid = true;
            var message = '';

            var tenquyen = $('#tenquyen').val();
            var diengiai = $('#diengiai').val();
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
                    url: "{{ route('roles.store') }}",
                    type: 'post',
                    data: {
                        // _token: CSRF_TOKEN,
                        tenquyen: tenquyen,
                        diengiai: diengiai,
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
    </script>

    @include('includes.modal.delete')
@stop
