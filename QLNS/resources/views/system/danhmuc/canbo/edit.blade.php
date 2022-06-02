@extends('main')

@section('custom-style')
    <link href="{{ url('assets/global/css/plugins.css') }}" rel="stylesheet" type="text/css" />
    <link rel="stylesheet" type="text/css" href="{{ url('assets/global/plugins/select2/select2.css') }}" />
    <link rel="stylesheet" type="text/css" href="{{ url('assets/global/css/canbo.css') }}">
    <style>
        .form-body .form-group {
            margin-right: 0;
            margin-left: 0;
        }

        .form-body .form-group .control-label {
            margin-bottom: 5px;
        }

    </style>
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
                        THÊM MỚI HỒ SƠ CÁN BỘ
                    </div>
                    <div class="tools hidden-xs">
                        <a href="javascript:;" class="collapse">
                        </a>
                    </div>
                </div>

                <div class="portlet-body form">
                    <form action="{{ route('canbo.update',$model->id) }}" method="post" id='create-hscb' class="form-horizontal"
                        enctype="multipart/form-data">
                        @csrf

                        <div id="tab1" class="tab-pane active">
                            <div class="form-horizontal">
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="portlet-body form">
                                            <div class="form-body clearfix">
                                                {{-- <div class="form-content col-md-10"> --}}

                                                <div class="form-horizontal col-md-12">
                                                    <div class="col-md-3">
                                                        <div class="form-group">
                                                            <label class="control-label">Họ tên <span
                                                                    class="require">*</span></label>
                                                            <input type="text" name="hoten" id="hoten"
                                                                class="form-control" placeholder="Nhập họ tên"
                                                                required="required" value="{{ $model->hoten }}">
                                                        </div>
                                                    </div>

                                                    <div class="col-md-3">
                                                        <div class="form-group">
                                                            <label class="control-label">Quê quán <span
                                                                class="require">*</span></label>
                                                            <input type="text" name='quequan' class="form-control"
                                                                id='quequan' placeholder="Nhập địa chỉ"
                                                                value="{{ $model->quequan }}">
                                                        </div>
                                                    </div>
                                                    <div class="col-md-3">
                                                        <div class="form-group">
                                                            <label class="control-label">Thường trú <span
                                                                    class="require">*</span> </label>
                                                            <input type="text" name='thuongtru' class="form-control"
                                                                id='thuongtru' placeholder="Chỗ ở hiện tại" required
                                                                value="{{ $model->thuongtru }}">
                                                        </div>
                                                    </div>
                                                    <div class="col-md-3">
                                                        <div class="form-group">
                                                            <label class="control-label">Số điện thoại <span
                                                                    class="require">*</span> </label>
                                                            <input type="tel" name='sdt' class="form-control" id='sdt'
                                                                pattern="[0-9]{9,11}" placeholder="SDT từ 9 đến 11 số"
                                                                required value="{{ $model->sdt }}">
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="form-horizontal col-md-12">
                                                    <div class="col-md-3">
                                                        <div class="form-group">
                                                            <label class="control-label">Phòng ban <span
                                                                    class="require">*</span></label>
                                                            <select name="phongban_id" id="phongban_id"
                                                                class="form-control select2me" required="required">

                                                                    @foreach ($phongban as $pb)
                                                                        <option value="{{ $pb->id }}"
                                                                            {{ $model->phongban_id == $pb->id ? 'selected' : '' }}>
                                                                            {{ $pb->tenpb }}</option>
                                                                    @endforeach

                                                            </select>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-3">
                                                        <div class="form-group">
                                                            <label class="control-label">Ngày sinh <span
                                                                    class="require">*</span></label>

                                                            <input type="date" name="ngaysinh"
                                                                value="{{ $model->ngaysinh }}" id="ngaysinh"
                                                                class="form-control" required="required">
                                                        </div>
                                                    </div>
                                                    <div class="col-md-3">
                                                        <div class="form-group">
                                                            <label class="control-label">Giới tính <span
                                                                    class="require">*</span></label>
                                                            <select name="gioitinh" id='gioitinh' class="form-control"
                                                                required="required">
                                                                    <option value="1"
                                                                        {{ $model->gioitinh == '1' ? 'selected' : '' }}>
                                                                        Nam
                                                                    </option>
                                                                    <option value="0"
                                                                        {{ $model->gioitinh == '0' ? 'selected' : '' }}>
                                                                        Nữ
                                                                    </option>

                                                            </select>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-3">
                                                        <div class="form-group">
                                                            <label class="control-label">Ngày vào công ty <span
                                                                    class="require">*</span></label>
                                                            <input type="date" name='ngayvaoct' class="form-control"
                                                                id='ngayvaoct' required value="{{ $model->ngayvaoct }}">
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="form-horizontal col-md-12">
                                                    <div class="col-md-3">
                                                        <div class="form-group">
                                                            <label class="control-label">Chuyên môn
                                                            </label>

                                                            <input type="text" name='tdcm' class="form-control" id='tdcm'
                                                                placeholder="Nhập trình độ chuyên môn" 
                                                                value="{{ $model->tdcm }}">

                                                        </div>
                                                    </div>
                                                    <div class="col-md-3">
                                                        <div class="form-group">
                                                            <label class="control-label">Trường đào tạo
                                                            </label>

                                                            <input type="text" name='truongdaotao' class="form-control"
                                                                id='truongdaotao' placeholder="Nhập tên trường đào tạo"
                                                                 value="{{ $model->truongdaotao }}">

                                                        </div>
                                                    </div>
                                                    <div class="col-md-3">
                                                        <div class="form-group">
                                                            <label class="control-label">Năm tốt nghiệp
                                                            </label>

                                                            <input type="text" name='namtotnghiep' class="form-control"
                                                                id='namtotnghiep' placeholder="Nhập năm tốt nghiệp" 
                                                                value="{{ $model->namtotnghiep }}">

                                                        </div>
                                                    </div>
                                                    <div class="col-md-3">
                                                        <div class="form-group">
                                                            <label class="control-label">Bằng cấp </label>

                                                            <select name="bangcap" id='bangcap'
                                                                class="form-control select2me" required="required">
                                                                <option value="">-- Chọn bằng cấp---</option>
                                                                    <option value="Cao học"
                                                                        {{ $model->bangcap == 'Cao học' ? 'selected' : '' }}>
                                                                        Cao học
                                                                    </option>
                                                                    <option value="Đại học"
                                                                        {{ $model->bangcap == 'Đại học' ? 'selected' : '' }}>
                                                                        Đại học
                                                                    </option>
                                                                    <option value="Cao đẳng"
                                                                        {{ $model->bangcap == 'Cao đẳng' ? 'selected' : '' }}>
                                                                        Cao
                                                                        đẳng
                                                                    </option>
                                                                    <option value="Trung cấp"
                                                                        {{ $model->bangcap == 'Trung cấp' ? 'selected' : '' }}>
                                                                        Trung
                                                                        cấp
                                                                    </option>
                                                                    <option value="Học nghề"
                                                                        {{ $model->bangcap == 'Học nghề' ? 'selected' : '' }}>
                                                                        Học
                                                                        nghề
                                                                    </option>
                                                                    <option value="Không bằng cấp"
                                                                        {{ $model->bangcap == 'Không bằng cấp' ? 'selected' : '' }}>
                                                                        Không
                                                                        bằng cấp
                                                                    </option>
                                                            </select>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="form-horizontal col-md-12">
                                                    <div class="col-md-3">
                                                        <div class="form-group">
                                                            <label class="control-label">Email <span
                                                                    class="require">*</span>
                                                            </label>

                                                            <input type="email" name='email' class="form-control"
                                                                id='email' placeholder="Nhập email" required
                                                                value="{{ $model->email }}">
                                                            @if ($errors->first('email'))
                                                                <p class="text-danger">
                                                                    {{ $errors->first('email') }}</p>
                                                            @endif
                                                        </div>
                                                    </div>
                                                    <div class="col-md-3">
                                                        <div class="form-group">
                                                            <label class="control-label">Chức vụ <span
                                                                    class="require">*</span>
                                                            </label>
                                                            <select name="chucvu_id" id="chucvu_id"
                                                                class="form-control select2me" required="required">
                                                                    @foreach ($chucvu as $cv)
                                                                        <option value="{{ $cv->id }}"
                                                                            {{ $model->chucvu_id == $cv->id ? 'selected' : '' }}>
                                                                            {{ $cv->tencv }}</option>
                                                                    @endforeach
                                                            </select>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-3">
                                                        <div class="form-group">
                                                            <label class="control-label">CMND/CCCD <span
                                                                    class="require">*</span>
                                                            </label>
                                                            <input type="text" name='cccd' class="form-control" id='cccd'
                                                                placeholder="Nhập số CMND/CCCD" required
                                                                value="{{ $model->cccd }}">
                                                        </div>
                                                    </div>
                                                    <div class="col-md-3">
                                                        <div class="form-group">
                                                            <label class="control-label">Tài khoản 
                                                            </label>
                                                            <input type="text" name='name' class="form-control" id='name'
                                                                placeholder="Nhập tên tài khoản" required
                                                                value="{{ $taikhoan }}">
                                                            @if ($errors->first('name'))
                                                                <p class="text-danger">
                                                                    {{ $errors->first('name') }}</p>
                                                            @endif
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="form-horizontal col-md-12">
                                                    <div class="col-md-3">
                                                        <div class="form-group">
                                                            <label class="control-label"> Ảnh CMND/CCCD 
                                                            </label>
                                                            <input type="file" name='file_cccd[]' class="form-control" id='file_cccd'
                                                            accept="image/*"  multiple
                                                                value="">
                                                        </div>
                                                    </div>
                                                    <div class="col-md-3">
                                                        <div class="form-group">
                                                            <label class="control-label"> Ảnh bằng cấp 
                                                            </label>
                                                            <input type="file" name='file_bc[]' class="form-control" id='file_bc'
                                                            accept="image/*" multiple
                                                                value="">
                                                        </div>
                                                    </div>
                                                </div>
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
                            <button type="submit" class="btn btn-success">Cập nhật hồ sơ</button>
                            <a href="{{ route('canbo.index') }}" class="btn btn-danger"><i class="fa fa-reply"></i>
                                Quay lại</a>
                        </div>
                    </div>
                </div>
                </form>
            </div>
        </div>
    </div>
    </div>
    <script type="text/javascript">
        function readURL(input) {
            if (input.files && input.files[0]) {
                var reader = new FileReader();
                reader.onload = function(e) {
                    $('#imgSrc').attr('src', e.target.result);
                }
                reader.readAsDataURL(input.files[0]);
            }
        }
        $("#anh").change(function() {
            readURL(this);
        });
        $('#hoten').on('change', function() {
            $('#name').val($(this).val())
        })
    </script>
@stop
