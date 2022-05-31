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
                        <b>CHI TIẾT KHỐI PHÒNG {{mb_strtoupper($khoipb->tenkhoi,'UTF-8')}}</b>
                        <div class="truongphong " style="margin-top:10px">
                            Trưởng khối: @foreach ($chucvu as $cv )
                                {{$cv->hoten}}
                            @endforeach
                           
                       </div>
                    </div>
                    <div class="actions">
                        @can('add_phongban')
                        <button type="button" id="_btnaddPB" class="btn btn-success btn-xs" onclick="addPb({{$khoipb->id}})"><i
                            class="fa fa-plus"></i>&nbsp;Thêm mới phòng ban</button>  
                        @endcan

                                <div class="btn-back" style="margin-top:10px">
                                    <a href="{{route('dmkhoipb.index')}}" class='btn btn-info btn-sm '><i
                                        class="fa fa-backward"></i> Quay lại</a>
                                </div>
                    </div>
                </div>
                <div class="portlet-body form-horizontal">
                    <table id="sample_3" class="table table-hover table-striped table-bordered" style="min-height: 230px">
                        <thead>
                            <tr>
                                <th class="text-center" style="width: 10%">STT</th>
                                <th class="text-center">Tên phòng ban</th>
                                <th class="text-center">Mô tả phòng ban</th>
                                <th class="text-center">Thao tác</th>
                            </tr>
                        </thead>
                        <tbody>
                            @if (isset($model))
                                @foreach ($model as $key => $value)
                                    <tr>
                                        <td class="text-center">{{ $key + 1 }}</td>
                                        <td name="tenkhoi">{{ $value->tenpb }}</td>
                                        <td name="diengiai">{{ $value->diengiai }}</td>
                                        <td>
                                            @can('list_phongban')
                                            <a type="button" href="{{route('phongban.detail',$value->id)}}"
                                                class="btn btn-warning btn-xs mbs">
                                                <i class="fa fa-tasks"></i>&nbsp; Chi tiết</a>  
                                            @endcan

                                            @can('edit_phongban')
                                            <button type="button" onclick="editPb(this, {{ $value->id }})"
                                                class="btn btn-info btn-xs mbs">
                                                <i class="fa fa-edit"></i>&nbsp; Chỉnh sửa</button> 
                                            @endcan

                                            @can('delete_phongban')
                                            <button type="button"
                                            onclick="cfDel('/danh_muc/dm_khoi_pb/delete/{{ $value->id }}')"
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

        <!--Modal sửa phòng ban -->
        <div id="phongban-modal" tabindex="-1" role="dialog" aria-hidden="true" class="modal fade">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header modal-header-primary">
                        <button type="button" data-dismiss="modal" aria-hidden="true" class="close">&times;</button>
                        <h4 id="modal-header-primary-label" class="modal-title">Thông tin phòng ban</h4>
                    </div>
                    <div class="modal-body">
                        <label class="form-control-label">Tên phòng ban<span class="require">*</span></label>
                        <input type="text" name='tenpb' id="tenpb-edit" class="form-control" required>
                        <br>
                        {{-- <label class="form-control-label">Khối phòng ban<span class="require"></span></label> --}}
                        {{-- <select name="dmkhoi_id" id="dmkhoi_id" class='form-control' required>
                            <option value="">Chọn khối phòng ban</option>
                            @foreach ($khoipbs as $khoipb)
                                <option value="{{ $khoipb->id }}">{{ $khoipb->tenkhoi }}</option>
                            @endforeach
                        </select> --}}
    
                        <br>
                        <label class="form-control-label">Mô tả phòng ban<span class="require">*</span></label>
                        <textarea name="diengiai" id="diengiai" class="form-control" rows="3" required></textarea>
    
                        <input type="hidden" id="id_pb" name="id_pb" />
                    </div>
                    <div class="modal-footer">
                        <button type="button" data-dismiss="modal" class="btn btn-default">Hủy thao tác</button>
                        <button type="submit" id="submit" name="submit" value="submit" class="btn btn-primary"
                            onclick="cfedPB()">Đồng ý</button>
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
                    <h4 id="modal-header-primary-label" class="modal-title">Chọn phòng ban</h4>
                </div>
                <div class="modal-body">
                   <form action="">
                    <table id="sample_3" class="table table-hover table-striped table-bordered" style="min-height: 230px">
                        <thead>
                            <tr>
                                <th class="text-center" style="width: 10%">STT</th>
                                <th class="text-center">Tên phòng ban</th>
                                <th class="text-center">Mô tả phòng ban</th>
                                <th class="text-center">Thao tác</th>
                            </tr>
                        </thead>
                        <tbody>
                            @if (isset($phongban))
                                @foreach ($phongban as $key => $value)
                                    <tr>
                                        <td class="text-center">{{ $key + 1 }}</td>
                                        <td name="tenpb">{{ $value->tenpb }}</td>
                                        <td name="diengiaipb">{{ $value->diengiai }}</td>
                                        <td>
                                            <button class="btn btn-info btn-sm" onclick="cfPB(this,{{$value->id}})">Chọn</button>
                                        </td>
                                    </tr>
                                @endforeach
                            @endif
                        </tbody>
                    </table>
                   </form>

                    <input type="hidden" id="id_khoipb" name="id_khoipb" value="{{$khoipb->id}}" />
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
        function addPb(id) {
            var date = new Date();
            $('#id_khoipb').val(id);
            $('#khoipb-modal').modal('show');
        }

        function editPb(e, id) {
            var tr = $(e).closest('tr');
            $('#tenpb-edit').val($(tr).find('td[name=tenkhoi]').text());
            $('#diengiai').val($(tr).find('td[name=diengiai]').text());
            $('#id_pb').val(id);
            $('#phongban-modal').modal('show');
        }

        function cfedPB() {
            var valid = true;
            var message = '';
            var tenpb = $('#tenpb-edit').val();
            var diengiai = $('#diengiai').val();
            var khoipb_id = $('#id_khoipb').val();
            var id = $('#id_pb').val();
            if (tenpb == '') {
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
                    url: "{{route('phongban.store')}}",
                    type: 'post',
                    data: {
                        // _token: CSRF_TOKEN,
                        tenpb: tenpb,
                        diengiai: diengiai,
                        dmkhoi_id: khoipb_id,
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

        function cfPB(e, id) {
            var valid = true;
            var message = '';
            var tr = $(e).closest('tr');
            var tenpb = $(tr).find('td[name=tenpb]').text();
            var diengiai = $(tr).find('td[name=diengiaipb]').text();
            var khoipb_id = $('#id_khoipb').val();

            if (tenpb == '') {
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
                    url: "{{route('phongban.store')}}",
                    type: 'post',
                    data: {
                        // _token: CSRF_TOKEN,
                        tenpb: tenpb,
                        diengiai: diengiai,
                        dmkhoi_id: khoipb_id,
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
    </script>

    @include('includes.modal.delete')
@stop
