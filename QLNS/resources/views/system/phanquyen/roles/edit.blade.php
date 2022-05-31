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
                        <b>PHÂN QUYỀN</b>
                    </div>

                </div>
                <form action="{{ route('roles.update', $role->id) }}" method="post">
                    @csrf
                    <div class="group">
                        <div class="tenquyen col-md-4">
                            <label class="form-control-label">Tên quyền<span class="require">*</span></label>
                            <input type="text" name='tenquyen' id='tenquyen' value="{{ $role->tenquyen }}"
                                class="form-control" required='required'>
                        </div>
                        <div class="diengiai col-md-8">
                            <label class="form-control-label">Mô tả quyền</label>
                            <input type="text" name='diengiai' id='diengiai' value="{{ $role->diengiai }}"
                                class="form-control" required='required'>
                        </div>
                    </div>


                    <label class="form-control-label" style="padding-top:10px">Chọn các quyền</label>
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
                                    <th>Sửa</th>
                                    <th>Thêm<main></main></th>
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
                                            @foreach ($permissionParent->permissionChildrent as $permissionParentItem)
                                                <td>
                                                    <input type="checkbox" name="permission_id[]" value="{{ $permissionParentItem->id }}"
                                                        class="permission_id"
                                                        @foreach ($role->permissions as $value) {{ $value->id == $permissionParentItem->id ? 'checked' : '' }} @endforeach>
                                                    {{-- {{ $permissionParentItem->tenquyen }} --}}
                                                </td>
                                            @endforeach


                                        </tr>
                                    @endforeach
                                @endif
                            </tbody>
                        </table>
                    </div>

                    <div class="modal-footer">
                        <a href="{{route('roles.index')}}" type="button" data-dismiss="modal" class="btn btn-default">Hủy thao tác</a>
                        <button type="submit" id="submit" name="submit" value="submit" class="btn btn-primary">Đồng
                            ý</button>
                    </div>
                </form>



            </div>
        </div>
    </div>

    @include('includes.modal.delete')
@stop
