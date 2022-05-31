
@extends('main')

@section('custom-style')
    <link href="{{ url('assets/global/css/plugins.css') }}" rel="stylesheet" type="text/css" />
    <link rel="stylesheet" type="text/css" href="{{ url('assets/global/plugins/select2/select2.css') }}" />

@stop

@section('custom-script')
    <script type="text/javascript" src="{{ url('assets/global/plugins/bootstrap-wizard/jquery.bootstrap.wizard.js') }}">
    </script>
    <script type="text/javascript" src="{{ url('assets/global/plugins/select2/select2.min.js') }}"></script>
    <script type="text/javascript" src="{{ url('assets/admin/pages/scripts/form-wizard.js') }}"></script>
    <script>
        jQuery(document).ready(function() {
            FormWizard.init();

        });
    </script>
@stop

@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="portlet box blue" id="form_wizard_1">
                <div class="portlet-title">
                    <div class="caption">
                        CẬP NHẬT THONG TIN PHẦN MỀM
                    </div>
                    <div class="tools hidden-xs">
                        <a href="javascript:;" class="collapse">
                        </a>
                    </div>
                </div>

                <div class="portlet-body form">
                    <div class="form-body clearfix">
                        <form action="" method="get" enctype="multipart/form-data">
                            @csrf
                            <div id="tab1" class="tab-pane active">
                                <div class="form-horizontal">
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label class="col-sm-4 control-label">Tên phần mềm</label>

                                            <div class="col-sm-8 controls">
                                                <input type="text" name="tenpm" id="tenpm" class="form-control">
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label class="col-sm-4 control-label">Công nghệ</span>
                                            </label>
                                            <div class="col-sm-8 controls">
                                                <input type="text" name="hoten" id="hoten" class="form-control">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label class="col-sm-4 control-label">Số điện thoại</label>

                                            <div class="col-sm-8">
                                                <input type="text" name='dienthoai' class="form-control" id='dienthoai'>
                                            </div>
                                        </div>
                                    </div>

                                </div>

                                <div class="form-horizontal">
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label class="col-sm-4 control-label">Phòng ban </label>

                                            <div class="col-sm-8 controls">
                                                <select name="phongban_id" id="phongban_id" class="form-control"
                                                    autofocus="autofocus">
                                                    <option value="">-- Chọn phòng ban ---</option>
                                                    @foreach ($phongban as $pb)
                                                        <option value="{{ $pb->id }}">
                                                            {{ $pb->tenpb }}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label class="col-sm-4 control-label">Ngày sinh </label>
                                            <div class="col-sm-8 controls">
                                                <input type="date" name="ngaysinh" id="ngaysinh" class="form-control">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label class="col-sm-4 control-label">Giới tính</label>

                                            <div class="col-sm-8">
                                                <select name="gioitinh" id='gioitinh' class="form-control">
                                                    <option value="">-- Chọn giới tính ---</option>
                                                    <option value="Nam">Nam
                                                    </option>
                                                    <option value="Nữ">Nữ
                                                    </option>
                                                </select>
                                            </div>
                                        </div>
                                    </div>

                                </div>


                                <div class="form-horizontal">
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label class="col-sm-4 control-label">Email</label>

                                            <div class="col-sm-8">
                                                <input type="text" name='email' class="form-control" id='email'>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label class="col-sm-4 control-label">Địa chỉ </label>

                                            <div class="col-sm-8">
                                                <input type="text" name='diachi' class="form-control" id='diachi'>
                                            </div>
                                        </div>
                                    </div>
                                </div>


                            </div>
                    </div>

                </div>
                <div class="form-actions">
                    <div class="row">
                        <div class="col-md-offset-4 col-md-8">
                            <button type="submit" class="btn btn-success" style="margin-left: 200px;">Tìm kiếm</button>
                        </div>
                    </div>
                </div>
                </form>
            </div>
        </div>
    </div>

@stop
