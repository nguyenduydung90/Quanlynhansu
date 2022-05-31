<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 24/06/2016
 * Time: 4:00 PM
 */
?>
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
                        <b>DANH MỤC CHỨC VỤ CÁN BỘ</b>
                    </div>
                    <div class="actions">
                        @can('add_chucvu')
                        <button type="button" id="_btnaddPB" class="btn btn-success btn-xs" onclick="addCV()"><i
                            class="fa fa-plus"></i>&nbsp;Thêm mới chức vụ</button>  
                        @endcan

                    </div>
                </div>
                <div class="portlet-body form-horizontal">
                    <table id="sample_3" class="table table-hover table-striped table-bordered" style="min-height: 230px">
                        <thead>
                            <tr>
                                <th class="text-center" style="width: 10%">STT</th>
                                <th class="text-center">Tên chức vụ</th>
                                <th class="text-center">Mô tả chức vụ</th>
                                <th class="text-center">Thao tác</th>
                            </tr>
                        </thead>
                        <tbody>
                            @if (isset($model))
                                @foreach ($model as $key => $value)
                                    <tr>
                                        <td class="text-center">{{ $key + 1 }}</td>
                                        <td name="tencv">{{ $value->tencv }}</td>
                                        <td name="diengiai">{{ $value->diengiai }}</td>
                                        <td class="text-center">
                                            @can('edit_chucvu')
                                            <button type="button" onclick="editCV(this, {{ $value->id }})"
                                                class="btn btn-info btn-xs mbs">
                                                <i class="fa fa-edit"></i>&nbsp; Chỉnh sửa</button>    
                                            @endcan
                                        
                                            @can('delete_chucvu')
                                            <button type="button"
                                            onclick="cfDel('/danh_muc/chuc_vu_cb/delete/{{ $value->id }}')"
                                            class="btn btn-danger btn-xs mbs" data-target="#delete-modal-confirm"
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

    <!--Modal thông tin chức vụ -->
    <div id="chucvu-modal" tabindex="-1" role="dialog" aria-hidden="true" class="modal fade">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header modal-header-primary">
                    <button type="button" data-dismiss="modal" aria-hidden="true" class="close">&times;</button>
                    <h4 id="modal-header-primary-label" class="modal-title">Thông tin chức vụ cán bộ</h4>
                </div>
                <div class="modal-body">
                    @include('template.tem_chucvucb')
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
        function addCV() {
            var date = new Date();
            $('#tencv').val('');
            $('#diengiai').val('');
            $('#id_cv').val(0);
            $('#chucvu-modal').modal('show');
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
