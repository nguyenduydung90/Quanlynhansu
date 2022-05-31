@extends('main')

@section('custom-style')
    <link rel="stylesheet" type="text/css"
        href="{{ url('assets/global/plugins/datatables/plugins/bootstrap/dataTables.bootstrap.css') }}" />
    <link rel="stylesheet" type="text/css" href="{{ url('assets/global/plugins/select2/select2.css') }}" />
    <style>
        .item {
            float: right;
        }

        .media-object {
            width: 198px;
            height: 262px;
            border: 1px solid;
            border-radius: 5px
        }

        .detail {
            border-bottom: 1px dashed #e5e5e5;
            margin-bottom: 5px
        }


        .info {
            height: 18px;
            line-height: 18px
        }

        .btn-default {
            border-color: #87cefa !important;
        }

        .table-bordered>tbody>tr>td {
            border: 1px solid #87cefa;
        }

    </style>
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
    <h3 class="page-title">
        Thông tin phần mềm
    </h3>
    <div class="row">
        <div class="col-md-12">
            <!-- BEGIN EXAMPLE TABLE PORTLET-->
            <div class="portlet box">
                <div class="portlet-title">
                    <div class="caption">
                    </div>
                    <div class="actions">
                        <button type="button" class="btn btn-default btn-sm" data-toggle="modal"
                        data-target="#phanmem-modal">
                            <i class="fa fa-edit"></i> Chỉnh sửa </button>

                    </div>
                </div>
                <div class="portlet-body">
                    <table id="user" class="table table-bordered table-striped">
                        <tbody>

                            <tr>
                                <td style="width:15%">
                                    <b>Tên phần mềm</b>
                                </td>
                                <td name='tenpm' style="width:35%">
                                    <span class="text-muted">{{$thongtinpm->tenpm}}</span>
                                </td>
                            </tr>
                            <tr>
                                <td style="width:15%">
                                    <b>Công nghệ</b>
                                </td>
                                <td name='connghe' style="width:35%">
                                    <span class="text-muted">{{$thongtinpm->congnghe}}</span>
                                </td>
                            </tr>
                            <tr>
                                <td style="width:15%">
                                    <b>Hướng dẫn sử dụng</b>
                                </td>
                                <td name='hdsd' style="width:35%">
                                    <span class="text-muted">
                                        <a href="{{asset($thongtinpm->hdsd)}}">Tải file hướng dẫn sử dụng</a>
                                    </span>
                                </td>

                            </tr>

                            <tr>
                                <td style="width:15%">
                                    <b>Link demo</b>
                                </td>
                                <td name='linkdm' style="width:35%">
                                    <span class="text-muted">{{$thongtinpm->linkdm}}</span>
                                </td>
                            </tr>

                            <tr>
                                <td style="width:15%">
                                    <b>Cán bộ phụ trách</b>
                                </td>
                                <td name='canbophutrach' style="width:35%">
                                    <span class="text-muted">{{$thongtinpm->cbphutrach}}</span>
                                </td>
                            </tr>

                            <tr>
                                <td style="width:15%">
                                    <b>Thời gian phát triển</b>
                                </td>
                                <td name='thoigianphattrien' style="width:35%">
                                    <span class="text-muted">{{$thongtinpm->thoigianphattrien}}</span>
                                </td>
                            </tr>

                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    <!--Modal thông tin chức vụ -->
    <div id="phanmem-modal" tabindex="-1" role="dialog" aria-hidden="true" class="modal fade">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header modal-header-primary">
                    <button type="button" data-dismiss="modal" aria-hidden="true" class="close">&times;</button>
                    <h4 id="modal-header-primary-label" class="modal-title">Thông tin phần mềm</h4>
                </div>
                <div class="modal-body">
                    <form action="{{route('ttpm_store')}}" method="post" enctype="multipart/form-data">
                        @csrf
                        <label class="form-control-label">Tên phần mềm</label>
                        <input type="text" name='tenpm' id="tenpm" value="{{$thongtinpm->tenpm}}" class="form-control">
                        <br>
                        <label class="form-control-label">Công nghệ</label>
                        <input type="text" name='congnghe' id="congnghe"  value="{{$thongtinpm->congnghe}}" class="form-control">
                        <br>
                        <label class="form-control-label">Hướng dẫn sử dụng</label>
                        <input type="file" name='hdsd' id="hdsd"  value="{{$thongtinpm->hdsd}}" class="form-control">
                        <br>
                        <label class="form-control-label">Link demo</label>
                        <input type="text" name='linkdm' id="linkdm"  value="{{$thongtinpm->linkdm}}" class="form-control">
                        <br>
                        <label class="form-control-label">Cán bộ phụ trách</label>
                        <input type="text" name='cbphutrach' id="cbphutrach"  value="{{$thongtinpm->cbphutrach}}" class="form-control">
                        <br>
                        <label class="form-control-label">Thời gian phát triển</label>
                        <input type="text" name='thoigianphattrien' id="thoigianphattrien"  value="{{$thongtinpm->thoigianphattrien}}" class="form-control">
                        <br>
    
                        <input type="hidden" id="id_pb" name="id_pb" />
                   
                    
                </div>
                <div class="modal-footer">
                    <button type="button" data-dismiss="modal" class="btn btn-default">Hủy thao tác</button>
                    <button type="submit" id="submit" name="submit" value="submit" class="btn btn-primary"
                       >Đồng ý</button>
                </div>
            </form>
            </div>
        </div>
    </div>
    <script>
        function editPM() {
            $('#phanmem-modal').modal('show');
        }
        function cfttpm(){
            var tenpm=$('#tenpm').val();
            var congnghe=$('#congnghe').val();
            var hdsd=$('#hdsd').val();
            var linkdm=$('#linkdm').val();
            var cbphutrach=$('#cbphutrach').val();
            var thoigianphattrien=$('#thoigianphattrien').val();

            $.ajaxSetup({
                    headers: {

                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }

                });
                $.ajax({
                    url: "{{route('ttpm_store')}}",
                    type: 'post',
                    data: {
                        // _token: CSRF_TOKEN,
                        tenpm: tenpm,
                        congnghe: congnghe,
                        hdsd: hdsd,
                        linkdm: linkdm,
                        cbphutrach: cbphutrach,
                        thoigianphattrien: thoigianphattrien
                        
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
                $('#phanmem-modal').modal('hide');
        }
    </script>
@stop
