
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
<div class="modal-dialog modal-content">
    <div class="modal-header modal-header-primary">
        <button type="button" data-dismiss="modal" aria-hidden="true" class="close">&times;</button>
        <h4 id="modal-header-primary-label" class="modal-title">Tạo bảng lương</h4>
    </div>
    <div class="modal-body">
        <div class="form-horizontal">
            <form action="{{route('bangluong.store')}}"  method="post" enctype="multipart/form-data">
                @csrf
            <div class="form-group">
                <label class="col-md-4 control-label"> Tháng<span class="require">*</span></label>
                <div class="col-md-8">
                    <select name="thang" id="thang" class="form-control">
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
        <button type="submit" id="submit" name="submit" value="submit" class="btn btn-primary" >Đồng ý</button>
    </div>
</form>
</div>
@stop