<div id="tab1" class="tab-pane active">
    <div class="form-horizontal">
        <div class="row">
            <div class="col-md-12">
                <div class="portlet-body form">
                    <div class="form-body clearfix">
                        <div class="image col-md-2 float-left">
                            <div class="form-horizontal">

                                <div class="thumb">

                                    <img id="imgSrc" src="{{ asset('/images/avatar/no-image.png') }}">
                                    <div id="uploadCover" class="thumb-cover">
                                        <i class="fa fa-plus-square"></i>
                                        <input type="file" name="anh" id="anh" accept="image/*"
                                            title="Click để thay đổi hình ảnh!">
                                    </div>
                                </div>
                                <h4 style="text-align: center" class="control-label">Chọn ảnh</h4>
                            </div>
                        </div>
                        <div class="form-content col-md-10">

                            <div class="form-horizontal col-md-12">
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label class="col-sm-4 control-label">Họ tên <span
                                                class="require">*</span></label>

                                        <div class="col-sm-8 controls">
                                            <input type="text" name="hoten" id="hoten" class="form-control"
                                                placeholder="Nhập họ tên" required="required"
                                                value="{{ !isset($model) ? '' : $model->hoten }}">
                                        </div>
                                    </div>
                                </div>

                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label class="col-sm-4 control-label">Địa chỉ </label>
                                        <div class="col-sm-8">
                                            <input type="text" name='diachi' class="form-control" id='diachi'
                                                placeholder="Nhập địa chỉ"
                                                value="{{ !isset($model) ? '' : $model->diachi }}">
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label class="col-sm-4 control-label">Số điện thoại<span
                                                class="require">*</span> </label>

                                        <div class="col-sm-8">
                                            <input type="tel" name='dienthoai' class="form-control" id='dienthoai'
                                                pattern="[0-9]{9,11}" placeholder="SDT từ 9 đến 11 số" required
                                                value="{{ !isset($model) ? '' : $model->dienthoai }}">
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="form-horizontal col-md-12">
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label class="col-sm-4 control-label">Phòng ban <span
                                                class="require">*</span></label>

                                        <div class="col-sm-8 controls">
                                            <select name="phongban_id" id="phongban_id" class="form-control select2me"
                                                required="required">
                                                @if ($type == 'create')
                                                    <option value="">-- Chọn phòng ban ---</option>
                                                    @foreach ($phongban as $pb)
                                                        <option value="{{ $pb->id }}">

                                                            {{ $pb->tenpb }}</option>
                                                    @endforeach
                                                @else
                                                    @foreach ($phongban as $pb)
                                                        <option value="{{ $pb->id }}"
                                                            {{ $model->phongban_id == $pb->id ? 'selected' : '' }}>
                                                            {{ $pb->tenpb }}</option>
                                                    @endforeach
                                                @endif

                                            </select>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label class="col-sm-4 control-label">Ngày sinh <span
                                                class="require">*</span></label>

                                        <div class="col-sm-8 controls">
                                            <input type="date" name="ngaysinh"
                                                value="{{ !isset($model) ? '' : $model->ngaysinh }}" id="ngaysinh"
                                                class="form-control" required="required">

                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label class="col-sm-4 control-label">Giới tính<span
                                                class="require">*</span></label>

                                        <div class="col-sm-8">
                                            <select name="gioitinh" id='gioitinh' class="form-control"
                                                required="required">
                                                @if ($type == 'create')
                                                    <option value="">-- Chọn giới tính ---</option>
                                                    <option value="Nam">Nam
                                                    </option>
                                                    <option value="Nữ">Nữ
                                                    </option>
                                                @else
                                                    <option value="Nam"
                                                        {{ $model->gioitinh == 'Nam' ? 'selected' : '' }}>Nam
                                                    </option>
                                                    <option value="Nữ"
                                                        {{ $model->gioitinh == 'Nữ' ? 'selected' : '' }}>
                                                        Nữ
                                                    </option>
                                                @endif

                                            </select>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="form-horizontal col-md-12">
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label class="col-sm-4 control-label">Ngày vào </label>
                                        <div class="col-sm-8">
                                            <input type="date" name='ngayvao' class="form-control" id='ngayvao'
                                                placeholder="Nhập địa chỉ"
                                                value="{{ !isset($model) ? '' : $model->ngayvao }}">
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label class="col-sm-4 control-label">Email<span class="require">*</span>
                                        </label>

                                        <div class="col-sm-8">
                                            <input type="email" name='email' class="form-control" id='email'
                                                placeholder="Nhập email" required
                                                value="{{ !isset($model) ? '' : $model->email }}">
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label class="col-sm-4 control-label">Bằng cấp</label>

                                        <div class="col-sm-8">
                                            <select name="bangcap" id='bangcap' class="form-control select2me"
                                                required="required">
                                                <option value="">-- Chọn bằng cấp---</option>
                                                @if ($type == 'create')
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
                                                @else
                                                    <option value="Cao học"
                                                        {{ $model->bangcap == 'Cao học' ? 'selected' : '' }}>Cao học
                                                    </option>
                                                    <option value="Đại học"
                                                        {{ $model->bangcap == 'Đại học' ? 'selected' : '' }}>Đại học
                                                    </option>
                                                    <option value="Cao đẳng"
                                                        {{ $model->bangcap == 'Cao đẳng' ? 'selected' : '' }}>Cao
                                                        đẳng
                                                    </option>
                                                    <option value="Trung cấp"
                                                        {{ $model->bangcap == 'Trung cấp' ? 'selected' : '' }}>Trung
                                                        cấp
                                                    </option>
                                                    <option value="Học nghề"
                                                        {{ $model->bangcap == 'Học nghề' ? 'selected' : '' }}>Học
                                                        nghề
                                                    </option>
                                                    <option value="Không bằng cấp"
                                                        {{ $model->bangcap == 'Không bằng cấp' ? 'selected' : '' }}>
                                                        Không
                                                        bằng cấp
                                                    </option>
                                                @endif

                                            </select>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="form-horizontal col-md-12">
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label class="col-sm-4 control-label">Số BHXH </label>
                                        <div class="col-sm-8">
                                            <input type="text" name='sobhxh' class="form-control" id='sobhxh'
                                                placeholder="Nhập số BHXH"
                                                value="{{ !isset($model) ? '' : $model->sobhxh }}">
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label class="col-sm-4 control-label">Số BHYT </label>
                                        <div class="col-sm-8">
                                            <input type="text" name='sobhyt' class="form-control" id='sobhyt'
                                                placeholder="Nhập số BHYT"
                                                value="{{ !isset($model) ? '' : $model->sobhyt }}">
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label class="col-sm-4 control-label">Chức vụ <span
                                                class="require">*</span>
                                        </label>

                                        <div class="col-sm-8">
                                            <select name="chucvu_id" id="chucvu_id" class="form-control select2me"
                                                required="required">
                                                @if ($type == 'create')
                                                    <option value="">-- Chọn chức vụ ---</option>
                                                    @foreach ($chucvu as $cv)
                                                        <option value="{{ $cv->id }}">
                                                            {{ $cv->tencv }}</option>
                                                    @endforeach
                                                @else
                                                    @foreach ($chucvu as $cv)
                                                        <option value="{{ $cv->id }}"
                                                            {{ $model->chucvu_id == $cv->id ? 'selected' : '' }}>
                                                            {{ $cv->tencv }}</option>
                                                    @endforeach
                                                @endif
                                            </select>
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


    $(function() {
        $('#create-hscb :submit').click(function() {
            var str = '',
                strb1 = '',
                strb2 = '',
                strb4 = '';
            var ok = true;

            if ($('#hoten').val() == '') {
                strb1 += ' - Họ tên \n';
                $('#hoten').parent().addClass('state-error');
                ok = false;
            }

            if ($('#chucvu_id').val() == '') {
                strb1 += '  - Chức vụ \n';
                $('#chucvu_id').parent().addClass('state-error');
                ok = false;
            }

            if (!$('#dienthoai').val()) {
                strb1 += '  - Số điện thoại \n';
                $('#dienthoai').parent().addClass('state-error');
                ok = false;
            }

            if (!$('#ngaysinh').val()) {
                strb1 += '  - Ngày sinh \n';
                $('#ngaysinh').parent().addClass('state-error');
                ok = false;
            }

            if ($('#phongban_id').val() == '') {
                strb1 += '  - Phòng ban \n';
                $('#phongban_id').parent().addClass('state-error');
                ok = false;
            }

            if ($('#gioitinh').val() == '') {
                strb1 += '  - Giới tính \n';
                $('#gioitinh').parent().addClass('state-error');
                ok = false;
            }

            if ($('#email').val() == '') {
                strb1 += '  - Email \n';
                $('#email').parent().addClass('state-error');
                ok = false;
            }

            //Kết quả
            if (ok == false) {
                if (strb1 != '')
                    str += 'Thông tin cơ bản: \n ' + strb1;
                alert('Các trường: \n' + str + 'Không được để trống');
                $("form").submit(function(e) {
                    e.preventDefault();
                });
            } else {
                $("form").unbind('submit').submit();
            }
        });
    });
</script>
