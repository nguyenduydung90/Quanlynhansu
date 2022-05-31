<div id="tab3" class="tab-pane">
    <div class="form-body">
        <div class="row">
            <div class="col-md-3">
                <div class="form-group">
                    <label class="control-label">Bảo hiểm xã hội</label>
                    <input id="ptbhxh" class="form-control baohiem text-right" data-mask="fdecimal" value="8" name="ptbhxh" type="text">
                </div>
            </div>

            <div class="col-md-3">
                <div class="form-group">
                    <label class="control-label">Bảo hiểm y tế</label>
                    <input id="ptbhyt" class="form-control baohiem text-right" data-mask="fdecimal" value="1.5" name="ptbhyt" type="text">
                </div>
            </div>

            <div class="col-md-3">
                <div class="form-group">
                    <label class="control-label">Kinh phí công đoàn</label>
                    <input id="kpcd" class="form-control baohiem text-right" data-mask="fdecimal" value="{{number_format(150000)}}" name="kpcd" type="text">
                </div>
            </div>

            <div class="col-md-3">
                <div class="form-group">
                    <label class="control-label">Bảo hiểm thất nghiệp</label>
                    <input id="ptbhtn" class="form-control baohiem text-right" data-mask="fdecimal" value="1" name="ptbhtn" type="text">
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-md-3">
                <div class="form-group">
                    <label class="control-label">BHXH đơn vị nộp</label>
                    <input id="bhxh_dv" class="form-control baohiem_dv text-right" data-mask="fdecimal" value="17" name="bhxh_dv" type="text">
                </div>
            </div>

            <div class="col-md-3">
                <div class="form-group">
                    <label class="control-label">BHYT đơn vị nộp</label>
                    <input id="bhyt_dv" class="form-control baohiem_dv text-right" data-mask="fdecimal" value="3" name="bhyt_dv" type="text">
                </div>
            </div>

            <div class="col-md-3">
                <div class="form-group">
                    <label class="control-label">KPCĐ đơn vị nộp</label>
                    <input id="kpcd_dv" class="form-control baohiem_dv text-right" data-mask="fdecimal" value="{{number_format(200000)}}" name="kpcd_dv" type="text">
                </div>
            </div>

            <div class="col-md-3">
                <div class="form-group">
                    <label class="control-label">BHTN đơn vị nộp</label>
                    <input id="bhtn_dv" class="form-control baohiem_dv text-right" data-mask="fdecimal" value="1" name="bhtn_dv" type="text">
                </div>
            </div>
        </div>
    </div>
</div>