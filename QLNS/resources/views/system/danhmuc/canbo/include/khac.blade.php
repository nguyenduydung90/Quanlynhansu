<div id="tab4" class="tab-pane">
    <div class="form-body">
        <div class="row">
            <div class="col-md-3">
                <div class="form-group">
                    <label class="col-sm-4 control-label">Số ngày nghỉ</label>
                    <div class="col-sm-8">
                        <input id="ngaynghi" class="form-control baohiem text-right" data-mask="fdecimal"
                            value="{{ !isset($model) ? '0' : $model->ngaynghi }}" name="ngaynghi" type="text">
                    </div>
                </div>
            </div>

            <div class="col-md-3">
                <div class="form-group">
                    <label class="col-sm-4 control-label">Tiền cơm trưa</label>
                    <div class="col-sm-8">
                        <input id="tiencom" class="form-control baohiem text-right" data-mask="fdecimal"
                            value="{{ !isset($model) ? '0' : $model->tiencom }}" name="tiencom" type="text">
                    </div>
                </div>
            </div>

            <div class="col-md-3">
                <div class="form-group">
                    <label class="col-md-4 control-label">Phạt</label>
                    <div class="col-sm-8">
                        <input id="tienphat" class="form-control baohiem text-right" data-mask="fdecimal"
                            value="{{ !isset($model) ? '0' : $model->tienphat }}" name="tienphat" type="text">
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
