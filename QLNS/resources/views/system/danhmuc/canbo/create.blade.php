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
                    <form action="{{ route('canbo.store') }}" method="post" id='create-hscb' class="form-horizontal"
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
                                                                required="required" value="{{ old('hoten') }}">
                                                        </div>
                                                    </div>

                                                    <div class="col-md-3">
                                                        <div class="form-group">
                                                            <label class="control-label">Quê quán <span
                                                                class="require">*</span></label>
                                                            <input type="text" name='quequan' class="form-control"
                                                                id='quequan' placeholder="Nhập địa chỉ"
                                                                value="{{ old('quequan') }}">
                                                        </div>
                                                    </div>
                                                    <div class="col-md-3">
                                                        <div class="form-group">
                                                            <label class="control-label">Thường trú <span
                                                                    class="require">*</span> </label>
                                                            <input type="text" name='thuongtru' class="form-control"
                                                                id='thuongtru' placeholder="Chỗ ở hiện tại" required
                                                                value="{{ old('thuongtru') }}">
                                                        </div>
                                                    </div>
                                                    <div class="col-md-3">
                                                        <div class="form-group">
                                                            <label class="control-label">Số điện thoại <span
                                                                    class="require">*</span> </label>
                                                            <input type="tel" name='sdt' class="form-control" id='sdt'
                                                                pattern="[0-9]{9,11}" placeholder="SDT từ 9 đến 11 số"
                                                                required value="{{ old('sdt') }}">
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
                                                                    <option value="">-- Chọn phòng ban ---</option>
                                                                    @foreach ($phongban as $pb)
                                                                        <option value="{{ $pb->id }}">

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
                                                                value="{{ old('ngaysinh') }}" id="ngaysinh"
                                                                class="form-control" required="required">
                                                        </div>
                                                    </div>
                                                    <div class="col-md-3">
                                                        <div class="form-group">
                                                            <label class="control-label">Giới tính <span
                                                                    class="require">*</span></label>
                                                            <select name="gioitinh" id='gioitinh' class="form-control">
                                                                    <option value="">-- Chọn giới tính ---</option>
                                                                    <option value="1" >Nam
                                                                    </option>
                                                                    <option value="0" >Nữ
                                                                    </option>

                                                            </select>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-3">
                                                        <div class="form-group">
                                                            <label class="control-label">Ngày vào công ty <span
                                                                    class="require">*</span></label>
                                                            <input type="date" name='ngayvaoct' class="form-control"
                                                                id='ngayvaoct' required value="{{ old('ngayvaoct') }}">
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
                                                                value="{{ old('tdcm') }}">

                                                        </div>
                                                    </div>
                                                    <div class="col-md-3">
                                                        <div class="form-group">
                                                            <label class="control-label">Trường đào tạo
                                                            </label>

                                                            <input type="text" name='truongdaotao' class="form-control"
                                                                id='truongdaotao' placeholder="Nhập tên trường đào tạo"
                                                                 value="{{ old('truongdaotao') }}">

                                                        </div>
                                                    </div>
                                                    <div class="col-md-3">
                                                        <div class="form-group">
                                                            <label class="control-label">Năm tốt nghiệp
                                                            </label>

                                                            <input type="text" name='namtotnghiep' class="form-control"
                                                                id='namtotnghiep' placeholder="Nhập năm tốt nghiệp" 
                                                                value="{{ old('namtotnghiep') }}">

                                                        </div>
                                                    </div>
                                                    <div class="col-md-3">
                                                        <div class="form-group">
                                                            <label class="control-label">Bằng cấp </label>

                                                            <select name="bangcap" id='bangcap'
                                                                class="form-control select2me" required="required">
                                                                <option value="">-- Chọn bằng cấp---</option>
                                                                    <option value="Cao học">Cao học
                                                                    </option>
                                                                    <option value="Đại học">Đại học
                                                                    </option>
                                                                    <option value="Cao đẳng">Cao đẳng
                                                                    </option>
                                                                    <option value="Trung cấp">Trung cấp
                                                                    </option>
                                                                    <option value="Học nghề">Học nghề
                                                                    </option>
                                                                    <option value="Không bằng cấp">Không bằng cấp
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
                                                                value="{{ old('email') }}">
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
                                                                    <option value="">-- Chọn chức vụ ---</option>
                                                                    @foreach ($chucvu as $cv)
                                                                        <option value="{{ $cv->id }}">
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
                                                                value="{{ old('cccd') }}">
                                                        </div>
                                                    </div>
                                                    <div class="col-md-3">
                                                        <div class="form-group">
                                                            <label class="control-label">Tài khoản đăng nhập<span
                                                                    class="require">*</span>
                                                            </label>
                                                            <input type="text" name='name' class="form-control" id='name'
                                                                placeholder="Nhập tên tài khoản" required
                                                                value="{{ old('name') }}">
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
                                                                value="{{ old('file_cccd') }}">
                                                        </div>
                                                    </div>
                                                    <div class="col-md-3">
                                                        <div class="form-group">
                                                            <label class="control-label"> Ảnh bằng cấp 
                                                            </label>
                                                            <input type="file" name='file_bc[]' class="form-control" id='file_bc'
                                                            accept="image/*" multiple
                                                                value="{{ old('file_bc') }}">
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
                            <button type="submit" class="btn btn-success">Tạo hồ sơ</button>
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
