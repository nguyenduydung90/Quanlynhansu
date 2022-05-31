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
                        <b>DANH MỤC TÀI KHOẢN</b>
                    </div>
                    <div class="actions">
                        @can('add_taikhoan')
                        <button type="button" id="_btnaddPB" class="btn btn-success btn-xs" onclick="addTK()"><i
                                class="fa fa-plus"></i>&nbsp;Thêm mới tài khoản</button>
                        @endcan
                    </div>
                </div>
                <div class="portlet-body form-horizontal">
                    <table id="sample_3" class="table table-hover table-striped table-bordered" style="min-height: 230px">
                        <thead>
                            <tr>
                                <th class="text-center" style="width: 10%">STT</th>
                                <th class="text-center">Tên tài khoản</th>
                                <th class="text-center">Email</th>
                                <th class="text-center" style="width:10%">Quyền</th>
                                <th class="text-center">Thao tác</th>
                            </tr>
                        </thead>
                        <tbody>
                            @if (isset($model))
                                @foreach ($model as $key => $value)
                                    <tr>
                                        <td class="text-center">{{ $key + 1 }}</td>
                                        <td name="name">{{ $value->name }}</td>
                                        <td name="email">{{ $value->email }}</td>
                                        <td name="tenquyen">
                                            <select name="role_id" id="role_id_cf{{ $value->id }}"
                                                onchange="cfQuyen({{ $value->id }})" class="form-control role_id">
                                                <option value="">-- Chọn quyền ---</option>
                                                @foreach ($role as $item)
                                                    <option value="{{ $item->id }}"
                                                        {{ $value->roles->contains('id', $item->id) ? 'selected' : '' }}>
                                                        {{ $item->tenquyen }}</option>
                                                @endforeach
                                            </select>
                                        </td>
                                        <td class="text-center">
                                            @can('edit_taikhoan')
                                            <button type="button" data-toggle="modal"
                                                data-target="#taikhoan-modal{{ $value->id }}"
                                                class="btn btn-info btn-xs mbs">
                                                <i class="fa fa-edit"></i>&nbsp; Chỉnh sửa</button>
                                                @endcan
                                                @can('delete_taikhoan')
                                            <button type="button"
                                                onclick="cfDel('/phanquyen/taikhoan/delete/{{ $value->id }}')"
                                                class="btn btn-danger btn-xs mbs" data-target="#delete-modal-confirm"
                                                data-toggle="modal">
                                                <i class="fa fa-trash-o"></i>&nbsp; Xóa</button>
                                                @endcan
                                        </td>
                                    </tr>
                                    <div id="taikhoan-modal{{ $value->id }}" tabindex="-1" role="dialog"
                                        aria-hidden="true" class="modal fade">
                                        <div class="modal-dialog">
                                            <div class="modal-content">
                                                <div class="modal-header modal-header-primary">
                                                    <button type="button" data-dismiss="modal" aria-hidden="true"
                                                        class="close">&times;</button>
                                                    <h4 id="modal-header-primary-label" class="modal-title">Cập nhật tài
                                                        khoản</h4>
                                                </div>
                                                <div class="alert alert-danger edit" style="display:none"></div>
                                                <div class="modal-body">
                                                    <label class="form-control-label">Tên tài khoản<span
                                                            class="require">*</span></label>
                                                    <input type="text" name='name' id="name{{ $value->id }}"
                                                        value="{{ $value->name }}" class="form-control" required>

                                                    <label class="form-control-label">Email<span
                                                            class="require">*</span></label>
                                                    <input type="email" name='email' id="email{{ $value->id }}"
                                                        value="{{ $value->email }}" class="form-control" required>

                                                    <label class="form-control-label">Chọn quyền<span
                                                            class="require">*</span></label>
                                                    <select name="role_id" id="role_id{{ $value->id }}"
                                                        class="form-control">
                                                        <option value="">-- Chọn quyền ---</option>
                                                        @foreach ($role as $item)
                                                            <option value="{{ $item->id }}"
                                                                {{ $value->roles->contains('id', $item->id) ? 'selected' : '' }}>
                                                                {{ $item->tenquyen }}</option>
                                                        @endforeach
                                                    </select>

                                                </div>
                                                <div class="modal-footer">
                                                    <button type="button" data-dismiss="modal" class="btn btn-default">Hủy
                                                        thao tác</button>
                                                    <button type="submit" id="submit" name="submit" value="submit"
                                                        class="btn btn-primary"
                                                        onclick="updateTK({{ $value->id }})">Đồng ý</button>
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

    <!--Modal thông tin chức vụ -->
    <div id="taikhoan-modal" tabindex="-1" role="dialog" aria-hidden="true" class="modal fade">
        <div class="modal-dialog" >
            <div class="modal-content">
                <div class="modal-header modal-header-primary">
                    <button type="button" data-dismiss="modal" aria-hidden="true" class="close">&times;</button>
                    <h4 id="modal-header-primary-label" class="modal-title">Thông tin chức vụ cán bộ</h4>
                </div>
                <div class="alert alert-danger" style="display:none"></div>
                <div class="modal-body">
                    <label class="form-control-label">Tên tài khoản<span class="require">*</span></label>
                    <input type="text" name='name' id="name_add" class="form-control" required>

                    <label class="form-control-label">Email<span class="require">*</span></label>
                    <input type="email" name='email' id="email_add" class="form-control"
                        pattern="[a-z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2,}$" placeholder="ex@characters.domain" required>

                    <label class="form-control-label">Chọn quyền</label>
                    <select name="role_id" id="role_id_add" class="form-control">
                        <option value="">-- Chọn quyền ---</option>
                        @foreach ($role as $item)
                            <option value="{{ $item->id }}">{{ $item->tenquyen }}</option>
                        @endforeach
                    </select>

                    {{-- <label class="form-control-label">Mật khẩu<span class="require">*</span></label>
                    <input type="password" name='password' id="password_add" class="form-control" required>

                    <label class="form-control-label">Nhập lại mật khẩu<span class="require">*</span></label>
                    <input type="password" name='cf_password' id="cf_password_add" class="form-control" required> --}}

                    <input type="hidden" id="id_tk" name="id_tk" />
                </div>
                <div class="modal-footer">
                    <button type="button" data-dismiss="modal" class="btn btn-default">Hủy thao tác</button>
                    <button type="button" class="btn btn-primary" onclick="cfTK()">Đồng ý</button>
                </div>
            </div>
        </div>
    </div>

    <script>
        function addTK() {
            var date = new Date();
            $('#name').val('');
            $('#email').val('');
            $('#password').val('');
            $('#id_tk').val(0);
            $('#taikhoan-modal').modal('show');
        }


        function cfTK() {
            var valid = true;
            var message =[];

            var name = $('#name_add').val();
            var email = $('#email_add').val();
            var role_id = $('#role_id_add').val();
            var password = $('#password_add').val();
            var id = $('#id_tk').val();

            if (name == '') {
                valid = false;
                message.push('Tên tài khoản không được bỏ trống \n') ;
            };
            
            if(email == '') {
                valid = false;
                message.push('Email không được bỏ trống \n') ;
                // message['email'] = 'Email không được bỏ trống \n';
            }

            if (valid) {
                $.ajaxSetup({
                    headers: {

                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }

                });
                $.ajax({
                    url: "{{ route('user.store') }}",
                    type: 'post',
                    data: {
                        // _token: CSRF_TOKEN,
                        name: name,
                        email: email,
                        password: password,
                        role_id: role_id,
                        id: id
                    },
                    dataType: 'JSON',
                    success: function(data) {
                        if (data.errors) {
                            $('.alert-danger').html('');

                            $.each(data.errors, function(key, value) {
                                $('.alert-danger').show();
                                $('.alert-danger').append('<li>' + value + '</li>');
                            });
                            setTimeout(() => {
                                $('.alert-danger').hide();
                            }, 3000);
                            
                        } else {
                            location.reload();
                            $('#taikhoan-modal').modal('hide');
                        }
                    },
                    error: function(message) {
                        alert(message);
                    }
                });
                
            } else {
                $.each(message, function(key, value) {
                                $('.alert-danger').show();
                                $('.alert-danger').append('<li>' + value + '</li>');
                            });
                            setTimeout(() => {
                                $('.alert-danger').hide();
                            }, 3000);
            }
            return valid;
        }

        function updateTK(id) {
            var valid = true;
            var message = [];
            var url="{{ route('user.update') }}";

            var name = $('#name' + id).val();
            var email = $('#email' + id).val();
            var role_id = $('#role_id' + id).val();
            var password = $('#password' + id).val();
            var id = id;


            if (name == '') {
                valid = false;
                message.push('Tên tài khoản không được bỏ trống \n') ;
            };
            
            if(email == '') {
                valid = false;
                message.push('Email không được bỏ trống \n') ;
                // message['email'] = 'Email không được bỏ trống \n';
            }

            if (valid) {
                $.ajaxSetup({
                    headers: {

                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }

                });
                $.ajax({
                    url: url,
                    type: 'post',
                    data: {
                        // _token: CSRF_TOKEN,
                        name: name,
                        email: email,
                        password: password,
                        role_id: role_id,
                        id: id
                    },
                    dataType: 'JSON',
                    success: function(data) {
                        console.log(data.errors);
                        if (data.errors) {
                            $('.edit').html('');

                            $.each(data.errors, function(key, value) {
                                $('.edit').show();
                                $('.edit').append('<li>' + value + '</li>');
                            });

                            setTimeout(() => {
                                $('.edit').hide();
                            }, 3000);
                            
                        } else {
                            location.reload();
                            $('#taikhoan-modal').modal('hide');
                        }
                    },
                    error: function(message) {
                        alert(message);
                    }
                });
                $('#taikhoan-modal').modal('hide');
            } else {
                $.each(message, function(key, value) {
                                $('.alert-danger').show();
                                $('.alert-danger').append('<li>' + value + '</li>');
                            });
                            setTimeout(() => {
                                $('.alert-danger').hide();
                            }, 3000);
            }
            return valid;
        }

        function cfQuyen(id) {
            var id = id;
            var role_id = $('#role_id_cf' + id).val();

            $.ajaxSetup({
                headers: {

                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }

            });

            $.ajax({
                url: "{{ route('user.update') }}",
                type: 'post',
                data: {
                    id: id,
                    role_id: role_id
                },
                dataType: 'JSON',
                success: function(data) {
                    console.log(data)
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
