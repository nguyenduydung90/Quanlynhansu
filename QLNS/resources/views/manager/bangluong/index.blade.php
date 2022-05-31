
@extends('main')

@section('custom-style')
    <link rel="stylesheet" type="text/css" href="{{url('assets/global/plugins/datatables/plugins/bootstrap/dataTables.bootstrap.css')}}"/>
    <link rel="stylesheet" type="text/css" href="{{url('assets/global/plugins/select2/select2.css')}}"/>
@stop

@section('custom-script')
    <script type="text/javascript" src="{{url('assets/global/plugins/select2/select2.min.js')}}"></script>
    <script type="text/javascript" src="{{url('assets/global/plugins/datatables/media/js/jquery.dataTables.min.js')}}"></script>
    <script type="text/javascript" src="{{url('assets/global/plugins/datatables/plugins/bootstrap/dataTables.bootstrap.js')}}"></script>

    <script src="{{url('assets/admin/pages/scripts/table-managed.js')}}"></script>
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
                    <div class="caption">DANH SÁCH BẢNG LƯƠNG CỦA CÁN BỘ</div>
                    <div class="actions">
                        <button type="button" id="_btnadd" class="btn btn-default btn-xs" onclick="add()"><i class="fa fa-plus"></i>&nbsp;Thêm mới bảng lương</button>
                        {{-- <a type="button" href="{{route('bangluong.create')}}" id="_btnadd" class="btn btn-default btn-xs" ><i class="fa fa-plus"></i>&nbsp;Thêm mới bảng lương</a> --}}
                    </div>
                </div>
                <div class="portlet-body form-horizontal">
                    <table id="sample_3" class="table table-hover table-striped table-bordered" style="min-height: 230px">
                        <thead>
                            <tr>
                                <th class="text-center" style="width: 5%">STT</th>
                                <th class="text-center">Tháng</th>
                                <th class="text-center">Năm</th>
                                <th class="text-center">Nội dung bảng lương</th>
                                <th class="text-center">Thao tác</th>
                            </tr>
                        </thead>
                        <tbody>
                            @if(isset($model))
                                @foreach($model as $key=>$value)
                                    <tr>
                                        <td class="text-center">{{$key+1}}</td>
                                        <td>{{$value->thang}}</td>
                                        <td>{{$value->nam}}</td>
                                        <td>{{$value->noidung}}</td>
                                        <td>
                                            @can('edit_bangluong')
                                            <button type="button" onclick="edit({{$value->id}})" class="btn btn-info btn-xs mbs">
                                                <i class="fa fa-edit"></i>&nbsp; Chỉnh sửa</button>
                                                <button onclick="updatect({{$value->id}})" class="btn btn-primary btn-xs mbs">
                                                    <i class="fa fa-refresh"></i>&nbsp; Cập nhật bảng lương</button> 
                                            @endcan

                                            @can('list_bangluong')
                                            <a href="{{route('bangluong.show',$value->id)}}" class="btn btn-warning btn-xs mbs">
                                                <i class="fa fa-th-list"></i>&nbsp; Chi tiết</a>
                                            <a href="{{route('bangluong.inbangluong',$value->id)}}" class="btn btn-success btn-xs mbs" TARGET="_blank">
                                                <i class="fa fa-print"></i>&nbsp; In bảng lương</a> 
                                            @endcan

                                            @can('delete_bangluong')
                                            <button type="button" onclick="cfDel('/chucnang/bangluong/delete/{{$value->id}}')" class="btn btn-danger btn-xs mbs" data-target="#delete-modal-confirm" data-toggle="modal">
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
        <!--Modal cập nhật bảng lương -->
        {{-- <form method="post" action="{{route('bangluong.updatect')}}" accept-charset="UTF-8" id="frmcapnhat" enctype="multipart/form-data">
            @csrf --}}
            <div id="capnhat-modal-confirm" tabindex="-1" role="dialog" aria-hidden="true" class="modal fade">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header modal-header-primary">
                            <button type="button" data-dismiss="modal" aria-hidden="true" class="close">×</button>
                            <h4 id="modal-header-primary-label" class="modal-title">Đồng ý cập nhật lại bảng lương ?</h4>
                        </div>
                        <div class="modal-body">
                            <div class="form-group">
                                <label><b>Chi tiết bảng lương sẽ được cập nhật lại theo thông tin cán bộ mới nhất. Bạn có chắc chắn muốn cập nhật ?</b></label>
                            </div>
                        </div>
            
                        <input type="hidden" id="mabl_capnhat" name="mabl_capnhat">
                        <div class="modal-footer">
                            <button type="button" data-dismiss="modal" class="btn btn-default">Hủy thao tác</button>
                            <button type="submit" onclick="cfupdatect()" id="submit" name="submit" value="submit" class="btn btn-primary">Đồng ý</button>
                        </div>
                    </div>
                </div>
            </div>
            {{-- </form> --}}
    <!--Modal thông tin chi tiết -->

    <div id="chitiet-modal" tabindex="-1" role="dialog" aria-hidden="true" class="modal fade">
        <div class="modal-dialog modal-content">
                <div class="modal-header modal-header-primary">
                    <button type="button" data-dismiss="modal" aria-hidden="true" class="close">&times;</button>
                    <h4 id="modal-header-primary-label" class="modal-title">Tạo bảng lương</h4>
                </div>
                <div class="modal-body">
                    <div class="form-horizontal">
                        <div class="form-group">
                            <label class="col-md-4 control-label"> Tháng<span class="require">*</span></label>
                            <div class="col-md-8">
                                <select name="thang" id="thang" class="form-control">
                                    <option value="">--Chọn tháng--</option>
                                    @for ($i=1;$i<=12;$i++)
                                        <option $value='{{$i}}'>{{$i}}</option>
                                    @endfor
                                </select>
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="col-md-4 control-label"> Năm<span class="require">*</span></label>
                            <div class="col-md-8">
                                <select name="nam" id="nam" class="form-control">
                                    <option value="">--Chọn năm--</option>
                                    @foreach ($nam as $value )
                                        <option value="{{$value}}">{{$value}}</option>
                                    @endforeach
                                </select>
                                
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="col-md-4 control-label"> Nội dung</label>
                            <div class="col-md-8">
                                <textarea name="noidung" id="noidung" class="form-control" rows="3"></textarea>
                            </div>
                        </div>

                        <input type="hidden" id="id_ct" name="id_ct"/>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" data-dismiss="modal" class="btn btn-default">Hủy thao tác</button>
                    <button type="submit" id="submit" name="submit" value="submit" class="btn btn-primary" onclick="confirm()">Đồng ý</button>
                </div>
            </div>
    </div>
    <script>
        function add(){
            $('#thang').val('');
            $('#nam').val('');
            $('#noidung').val('');
            $('#id_ct').val(0);
            $('#chitiet-modal').modal('show');
        }

        function updatect(id){
            $('#mabl_capnhat').val(id);
            $('#capnhat-modal-confirm').modal('show');
        }

        function cfupdatect(){
            var id=$('#mabl_capnhat').val();
            var CSRF_TOKEN = $('meta[name="csrf-token"]').attr('content');
            $.ajax({
                url: "{{route('bangluong.updatect')}}",
                type: 'post',
                data: {
                    _token: CSRF_TOKEN,
                    id: id
                },
                dataType: 'JSON',
                success: function (data) {
                    console.log(data);
                    if (data.status == 'success') {
                                location.reload();
                                // window.location.href = data.message;
                            }
                    
                },
                error: function(message){
                    toastr.error(message,'Lỗi!');
                }               
            });
            $('#capnhat-modal-confirm').modal('hide');
        }

        function edit(id){
            //var tr = $(e).closest('tr');
            var CSRF_TOKEN = $('meta[name="csrf-token"]').attr('content');
            $.ajax({
                url: "{{route('bangluong.edit')}}",
                type: 'GET',
                data: {
                    _token: CSRF_TOKEN,
                    id: id
                },
                dataType: 'JSON',
                success: function (data) {
                    $('#thang').val(data.thang);
                    $('#nam').val(data.nam);
                    $('#noidung').val(data.noidung);
                    $('#id_ct').val(data.id);
                },
                error: function(message){
                    toastr.error(message,'Lỗi!');
                }
            });

            $('#id_ct').val(id);
            $('#chitiet-modal').modal('show');
        }

        function confirm(){
            var valid=true;
            var message='';

            var thang=$('#thang').val();
            var nam=$('#nam').val();
            var noidung=$('#noidung').val();

            var id=$('#id_ct').val();

            if(thang==''){
                valid=false;
                message +='Tháng bảng lương không được bỏ trống \n';
            }
            if(nam==''){
                valid=false;
                message +='Năm bảng lương không được bỏ trống \n';
            }
            if(valid){
                var CSRF_TOKEN = $('meta[name="csrf-token"]').attr('content');
                if(id==0){//Thêm mới
                    $.ajax({
                        url: "/chucnang/bangluong/store",
                        type: 'post',
                        data: {
                            _token: CSRF_TOKEN,
                            thang: thang,
                            nam: nam,
                            noidung: noidung
                        },
                        dataType: 'JSON',
                        success: function (data) {
                            if (data.status == 'success') {
                                location.reload();
                                // window.location.href = data.message;
                            }
                        },
                        error: function(message){
                            alert(message);
                        }
                    });
                }else{//Cập nhật
                    $.ajax({
                        url: "{{route('bangluong.update')}}",
                        type: 'post',
                        data: {
                            _token: CSRF_TOKEN,
                            thang: thang,
                            nam: nam,
                            noidung: noidung,
                            id: id
                        },
                        dataType: 'JSON',
                        success: function (data) {
                            if (data.status == 'success') {
                                location.reload();
                            }
                        },
                        error: function(message){
                            alert(message);
                        }
                    });
                };
                $('#chitiet-modal').modal('hide');
            }else{
                alert(message);
            }
            return valid;
        }

    </script>
    @include('includes.modal.delete')
@stop