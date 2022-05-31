
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
                        <b>DANH MỤC PHÒNG BAN</b>
                    </div>
                    <div class="actions">
                        @can('add_phongban')
                        <button type="button" id="_btnaddPB" class="btn btn-success btn-xs" onclick="addPB()"><i
                            class="fa fa-plus"></i>&nbsp;Thêm mới phòng ban</button>    
                        @endcan


                    </div>
                </div>
                <div class="portlet-body form-horizontal">
                    <table id="sample_3" class="table table-hover table-striped table-bordered" style="min-height: 230px">
                        <thead>
                            <tr>
                                <th class="text-center" style="width: 10%">STT</th>
                                <th class="text-center">Tên phòng ban</th>
                                <th class="text-center">Mô tả phòng ban</th>
                                <th class="text-center">Khối phòng ban</th>
                                <th class="text-center">Thao tác</th>
                            </tr>
                        </thead>
                        <tbody>
                            @if (isset($model))
                                @foreach ($model as $key => $value)
                                    <tr>
                                        <td class="text-center">{{ $key + 1 }}</td>
                                        <td name="tenpb">{{ $value->tenpb }}</td>
                                        <td name="diengiai">{{ $value->diengiai }}</td>
                                        <td name="dmkhoi_name">
                                            @if (in_array($value->dmkhoi_id, $id_kpb))
                                            @foreach ($khoipbs as $l)
                                                @if ($value->dmkhoi_id == $l->id)
                                                    {{ $l->tenkhoi }}
                                                @endif
                                            @endforeach
                                        @else
                                            Chưa phân khối phòng ban
                                        @endif
                                        </td>
                                        {{-- <td name="dmkhoi_id" class="hidden" >{{ $value->dmkhoi_id }}</td> --}}
                                        <td>
                                            @can('list_phongban')
                                            <a href="{{route('phongban.detail',$value->id)}}"
                                                class="btn btn-warning btn-xs mbs">
                                                <i class="fa fa-tasks"></i>&nbsp; Chi tiết</a>
                                            @endcan

                                            @can('edit_phongban')
                                            <button type="button" onclick="editPB(this, {{ $value->id }})"
                                                class="btn btn-info btn-xs mbs">
                                                <i class="fa fa-edit"></i>&nbsp; Chỉnh sửa</button> 
                                            @endcan

                                            @can('delete_phongban')
                                            <button type="button"
                                            onclick="cfDel('/danh_muc/dm_phongban/delete/{{ $value->id }}')"
                                            class="btn btn-danger btn-xs mbs" data-target="#delete-modal-confirm"
                                            data-toggle="modal">
                                            <i class="fa fa-trash-o"></i>&nbsp; Xóa</button>   
                                            @endcan
 
                                        </td>
                                        <input type="hidden" name='dmkhoi_id' value={{$value->dmkhoi_id}}>
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
    <div id="phongban-modal" tabindex="-1" role="dialog" aria-hidden="true" class="modal fade">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header modal-header-primary">
                    <button type="button" data-dismiss="modal" aria-hidden="true" class="close">&times;</button>
                    <h4 id="modal-header-primary-label" class="modal-title">Thông tin phòng ban</h4>
                </div>
                <div class="modal-body">
                    <label class="form-control-label">Tên phòng ban<span class="require">*</span></label>
                    <input type="text" name='tenpb' id="tenpb" class="form-control" required>
                    <br>
                    <label class="form-control-label">Khối phòng ban</label>
                    <select name="dmkhoi_id" id="dmkhoi_id" class='form-control' required>
                        <option value="">Chọn khối phòng ban</option>
                        @foreach ($khoipbs as $khoipb)
                            <option value="{{ $khoipb->id }}">{{ $khoipb->tenkhoi }}</option>
                        @endforeach
                    </select>

                    <br>
                    <label class="form-control-label">Mô tả phòng ban<span class="require">*</span></label>
                    <textarea name="diengiai" id="diengiai" class="form-control" rows="3" required></textarea>

                    <input type="hidden" id="id_pb" name="id_pb" />
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
        function addPB() {
            var date = new Date();
            $('#tenpb').val('');
            $('#diengiai').val('');
            $('#dmkhoi_id').val('');
            $('#id_pb').val(0);
            $('#phongban-modal').modal('show');
        }

        function editPB(e, id) {
            var tr = $(e).closest('tr');
            $('#tenpb').val($(tr).find('td[name=tenpb]').text());
            $('#diengiai').val($(tr).find('td[name=diengiai]').text());
            $('#dmkhoi_id').val($(tr).find('input[name=dmkhoi_id]').val());
            $('#id_pb').val(id);
            $('#phongban-modal').modal('show');
        }

        function cfCV() {
            var valid = true;
            var message = '';

            var tenpb = $('#tenpb').val();
            var diengiai = $('#diengiai').val();
            var dmkhoi_id = $('#dmkhoi_id').val();
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
                    url: '/danh_muc/dm_phongban/store',
                    type: 'post',
                    data: {
                        tenpb: tenpb,
                        diengiai: diengiai,
                        dmkhoi_id: dmkhoi_id,
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
                $('#phongban-modal').modal('hide');
            } else {
                alert(message);
            }
            return valid;
        }
    </script>

    @include('includes.modal.delete')
@stop
