<!--form1 thông tin cơ bản -->
<div id="tab2" class="tab-pane" >
    <div class="form-horizontal">
        <div class="row">
            <div class="col-md-4">
                <div class="form-group">
                    <label class="col-sm-6 control-label">Lương thâm niên </label>

                    <div class="col-sm-6 controls">
                        {{-- {!!Form::text('pccv', null, array('id' => 'pccv','class' => 'form-control', 'data-mask'=>'fdecimal'))!!} --}}
                        <input type="text" name="luongthamnien" id="luongthamnien" class="form-control" value="{{!isset($model)?'':$model->luongthamnien}}">
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="form-group">
                    <label class="col-sm-6 control-label">Lương trách nhiệm </label>

                    <div class="col-sm-6 controls">
                        {{-- {!!Form::text('pctnn', null, array('id' => 'pctnn','class' => 'form-control', 'data-mask'=>'fdecimal'))!!} --}}
                        <input type="text" name="luongtrachnhiem" id="luongtrachnhiem" class="form-control" value="{{!isset($model)?'':$model->luongtrachnhiem}}">

                    </div>
                </div>
            </div>

            <div class="col-md-4">
                <div class="form-group">
                    <label class="col-sm-6 control-label">Lương phụ trách tài sản </label>

                    <div class="col-sm-6 controls">
                        {{-- {!!Form::text('pcvk', null, array('id' => 'pcvk','class' => 'form-control', 'data-mask'=>'fdecimal'))!!} --}}
                        <input type="text" name="pccbptts" id="pccbptts" class="form-control" value="{{!isset($model)?'':$model->pccbptts}}">

                    </div>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-md-4">
                <div class="form-group">
                    <label class="col-sm-6 control-label">Lương bậc cán bộ </label>

                    <div class="col-sm-6 controls">
                        {{-- {!!Form::text('pckn', null, array('id' => 'pckn','class' => 'form-control', 'data-mask'=>'fdecimal'))!!} --}}
                        <input type="text" name="lbcb" id="lbcb" class="form-control" value="{{!isset($model)?'':$model->lbcb}}">

                    </div>
                </div>
            </div>

            <div class="col-md-4">
                <div class="form-group">
                    <label class="col-sm-6 control-label">Lương sản phẩm </label>

                    <div class="col-sm-6 controls">
                        {{-- {!!Form::text('pctn', null, array('id' => 'pctn','class' => 'form-control', 'data-mask'=>'fdecimal'))!!} --}}
                        <input type="text" name="lsp" id="lsp" class="form-control" value="{{!isset($model)?'':$model->lsp}}">

                    </div>
                </div>
            </div>

            <div class="col-md-4">
                <div class="form-group">
                    <label class="col-sm-6 control-label">Phụ cấp ăn trưa </label>

                    <div class="col-sm-6 controls">
                        {{-- {!!Form::text('pckv', null, array('id' => 'pckv','class' => 'form-control', 'data-mask'=>'fdecimal'))!!} --}}
                        <input type="text" name="pcat" id="pcat" class="form-control" value="{{!isset($model)?'':$model->pcat}}">

                    </div>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-md-4">
                <div class="form-group">
                    <label class="col-sm-6 control-label">Phụ cấp xăng xe </label>

                    <div class="col-sm-6 controls">
                        {{-- {!!Form::text('pcth', null, array('id' => 'pcth','class' => 'form-control', 'data-mask'=>'fdecimal'))!!} --}}
                        <input type="text" name="pcxx" id="pcxx" class="form-control" value="{{!isset($model)?'':$model->pcxx}}">

                    </div>
                </div>
            </div>

            <div class="col-md-4">
                <div class="form-group">
                    <label class="col-sm-6 control-label">Phụ cấp điện thoại </label>

                    <div class="col-sm-6 controls">
                        {{-- {!!Form::text('pcudn', null, array('id' => 'pcudn','class' => 'form-control', 'data-mask'=>'fdecimal'))!!} --}}
                        <input type="text" name="pcdt" id="pcdt" class="form-control" value="{{!isset($model)?'':$model->pcdt}}">

                    </div>
                </div>
            </div>

            {{-- <div class="col-md-4">
                <div class="form-group">
                    <label class="col-sm-6 control-label">Phụ cấp đặc biệt </label>

                    <div class="col-sm-6 controls">
                        {!!Form::text('pcdbn', null, array('id' => 'pcdbn','class' => 'form-control', 'data-mask'=>'fdecimal'))!!}
                    </div>
                </div>
            </div> --}}
        </div>

        {{-- <div class="row">
            <div class="col-md-4">
                <div class="form-group">
                    <label class="col-sm-6 control-label">Phụ cấp lưu động </label>

                    <div class="col-sm-6 controls">
                        {!!Form::text('pcld', null, array('id' => 'pcld','class' => 'form-control', 'data-mask'=>'fdecimal'))!!}
                    </div>
                </div>
            </div>

            <div class="col-md-4">
                <div class="form-group">
                    <label class="col-sm-6 control-label">Phụ cấp độc hại </label>

                    <div class="col-sm-6 controls">
                        {!!Form::text('pcdh', null, array('id' => 'pcdh','class' => 'form-control', 'data-mask'=>'fdecimal'))!!}
                    </div>
                </div>
            </div>

            <div class="col-md-4">
                <div class="form-group">
                    <label class="col-sm-6 control-label">Phụ cấp khác </label>

                    <div class="col-sm-6 controls">
                        {!!Form::text('pck', null, array('id' => 'pck','class' => 'form-control', 'data-mask'=>'fdecimal'))!!}
                    </div>
                </div>
            </div>
        </div> --}}
    </div>
</div>
{{-- @include('includes.script.func_msnb') --}}
<!--end form4 -->