@extends('main')
@section('custom-style')
    <link rel="stylesheet" type="text/css"
        href="{{ url('assets/global/plugins/datatables/plugins/bootstrap/dataTables.bootstrap.css') }}" />
    <link rel="stylesheet" type="text/css" href="{{ url('assets/global/plugins/select2/select2.css') }}" />
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
    <div class="row">
        <div class="col-md-12">
            <div class="portlet light bordered">
                <div class="portlet-title">
                    <div class="caption text-uppercase">
                        THÔNG TIN CHI TIẾT LƯƠNG CỦA CÁN BỘ: {{ $model->hoten }}
                    </div>
                    <div class="actions">

                    </div>
                </div>
                <div class="portlet-body">
                    {{-- <input type="hidden" id="bhxh" name="bhxh" value="0.08" />
                    <input type="hidden" id="bhyt" name="bhyt" value="0.015" />
                    <input type="hidden" id="bhtn" name="bhtn" value="0" />
                    <input type="hidden" id="kpcd" name="kpcd" value="0" />
                    <input type="hidden" id="bhxh_dv" name="bhxh_dv" value="0.175" />
                    <input type="hidden" id="bhyt_dv" name="bhyt_dv" value="0.03" />
                    <input type="hidden" id="bhtn_dv" name="bhtn_dv" value="0" />
                    <input type="hidden" id="kpcd_dv" name="kpcd_dv" value="0.02" />
                    <input type="hidden" id="luongcoban" name="luongcoban" value="1490000" /> --}}

                    <form method="POST" action="" accept-charset="UTF-8" id="create-hscb"
                        class="horizontal-form form-validate" enctype="multipart/form-data"><input name="_token"
                            type="hidden" value="6QGFVjiP6eF2hI9bRsVXca7Zt5ujbYJ9HvHgL36V">
                        <input type="hidden" id="macanbo" name="macanbo" value="1565583148_1585898148" />
                        <input type="hidden" id="mabl" name="mabl" value="1565583148_1597895786" />
                        <input type="hidden" id="id" name="id" value="253926" />
                        <div class="form-body">
                            <div class="row">
                                <div class="col-md-12">
                                    <!-- BEGIN PORTLET-->
                                    <div class="portlet box blue">
                                        <div class="portlet-title">
                                            <div class="caption">
                                                Thông tin chung
                                            </div>
                                            <div class="tools">
                                                <a href="javascript:;" class="collapse" data-original-title=""
                                                    title=""></a>
                                            </div>
                                        </div>
                                        <div class="portlet-body" style="display: block;">
                                            <div class="row">
                                                <div class="col-md-2">
                                                    <div class="form-group">
                                                        <label class="control-label" style="font-weight: bold">Tổng lương </label>
                                                        <input id="msngbac" class="form-control" readonly="true"
                                                            name="msngbac" type="text"
                                                            value="{{ number_format($model->tongluong) }}">
                                                    </div>
                                                </div>

                                                <div class="col-md-4">
                                                    <div class="form-group">
                                                        <label class="control-label">Công tác phí </label>
                                                        <input id="tennb" class="form-control" readonly="true"
                                                            name="tennb" type="text" value="{{ $model->congtacphi }}">
                                                    </div>
                                                </div>


                                                <div class="col-md-2">
                                                    <div class="form-group">
                                                        <label class="control-label">Tiền cơm
                                                            trưa</label>
                                                        <input id="ttl" class="form-control text-right" data-mask="fdecimal"
                                                              name="ttl" type="text" readonly="true"
                                                            value="{{ number_format($model->tiencom) }}">
                                                    </div>
                                                </div>

                                                <div class="col-md-2">
                                                    <div class="form-group">
                                                        <label class="control-label">Tiền
                                                            phạt</label>
                                                        <input id="tbh" class="form-control text-right" data-mask="fdecimal"
                                                              name="tbh" type="text" readonly="true"
                                                            value="{{ number_format($model->tienphat) }}">
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="row">
                                                <div class="col-md-2">
                                                    <div class="form-group">
                                                        <label class="control-label">Giảm trừ lương </label>
                                                        <input id="giaml" class="form-control tienluong text-right" readonly="true"
                                                            data-mask="fdecimal" name="giaml" type="text" value="0">
                                                    </div>
                                                </div>

                                                <div class="col-md-2">
                                                    <div class="form-group">
                                                        <label class="control-label">Bảo hiểm chi trả </label>
                                                        <input id="bhct" class="form-control tienluong text-right" readonly="true"
                                                            data-mask="fdecimal" name="bhct" type="text" value="0">
                                                    </div>
                                                </div>

                                                <div class="col-md-2">
                                                    <div class="form-group">
                                                        <label class="control-label">Thuế thu nhập </label>
                                                        <input id="thuetn" class="form-control tienluong text-right" readonly="true"
                                                            data-mask="fdecimal" name="thuetn" type="text" value="0">
                                                    </div>
                                                </div>

                                                <div class="col-md-2">
                                                    <div class="form-group">
                                                        <label class="control-label">Khen thưởng </label>
                                                        <input id="tienthuong" class="form-control tienluong text-right" readonly="true"
                                                            data-mask="fdecimal" name="tienthuong" type="text" value="0">
                                                    </div>
                                                </div>

                                                <div class="col-md-2">
                                                    <div class="form-group">
                                                        <label class="control-label">KPCĐ </label>
                                                        <input id="trichnop" class="form-control tienluong text-right" readonly="true"
                                                            data-mask="fdecimal" name="trichnop" type="text" value="{{number_format($model->kpcd)}}">
                                                    </div>
                                                </div>

                                                <div class="col-md-2">
                                                    <div class="form-group">
                                                        <label class="control-label" style="font-weight: bold"><b>Lương thực nhận </b></label>
                                                        <input id="luongtn" class="form-control text-right" readonly='true'
                                                            data-mask="fdecimal" style="font-weight:bold" name="luongtn"
                                                            type="text" value="{{ number_format($model->thucnhan) }}">
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <!-- END PORTLET-->
                                </div>
                            </div>

                            <table id="sample_3" class="table table-hover table-striped table-bordered"
                                style="min-height: 230px">
                                <thead>
                                    <tr>
                                        <th class="text-center" style="width: 5%">STT</th>
                                        <th class="text-center">Thông tin lương</th>
                                        {{-- <th class="text-center" style="width: 15%">Hệ số</th> --}}
                                        <th class="text-center" style="width: 15%">Số tiền</th>
                                        {{-- <th class="text-center" style="width: 10%">Thao tác</th> --}}
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php $stt=1 ?>
                                    <tr>
                                        <td class="text-center">{{$stt++}}</td>
                                        <td>Lương cơ bản</td>
                                        {{-- <td class="text-center">1</td> --}}
                                        <td class="text-right">{{ number_format($model->luongcoban) }}</td>
                                        {{-- <td>
                                            <button type="button" onclick="edit('heso','253926')"
                                                class="btn btn-default btn-xs mbs">
                                                <i class="fa fa-edit"></i>&nbsp; Sửa</button>
                                        </td> --}}
                                    </tr>
                                    <tr>
                                        <td class="text-center">{{$stt++}}</td>
                                        <td>Lương chức vụ</td>
                                        {{-- <td class="text-center">1</td> --}}
                                        <td class="text-right">{{ number_format($model->luongchucvu) }}</td>
                                    </tr>
                                    <tr>
                                        <td class="text-center">{{$stt++}}</td>
                                        <td>Lương thâm niên</td>
                                        {{-- <td class="text-center">1</td> --}}
                                        <td class="text-right">{{ number_format($model->luongthamnien) }}</td>
                                    </tr>
                                    <tr>
                                        <td class="text-center">{{$stt++}}</td>
                                        <td>Lương trách nhiệm</td>
                                        {{-- <td class="text-center">1</td> --}}
                                        <td class="text-right">{{ number_format($model->luongtrachnhiem) }}</td>
                                    </tr>
                                    <tr>
                                        <td class="text-center">{{$stt++}}</td>
                                        <td>Phụ cấp cán bộ phụ trách tài sản</td>
                                        {{-- <td class="text-center">1</td> --}}
                                        <td class="text-right">{{ number_format($model->pccbptts) }}</td>
                                    </tr>
                                    <tr>
                                        <td class="text-center">{{$stt++}}</td>
                                        <td>Lương bậc cán bộ</td>
                                        {{-- <td class="text-center">1</td> --}}
                                        <td class="text-right">{{ number_format($model->lbcb) }}</td>
                                    </tr>
                                    <tr>
                                        <td class="text-center">{{$stt++}}</td>
                                        <td>Lương sản phẩm</td>
                                        {{-- <td class="text-center">1</td> --}}
                                        <td class="text-right">{{ number_format($model->lsp) }}</td>
                                    </tr>
                                    <tr>
                                        <td class="text-center">{{$stt++}}</td>
                                        <td>Phụ cấp ăn trưa</td>
                                        {{-- <td class="text-center">1</td> --}}
                                        <td class="text-right">{{ number_format($model->pcat) }}</td>
                                    </tr>
                                    <tr>
                                        <td class="text-center">{{$stt++}}</td>
                                        <td>Phụ cấp xăng xe</td>
                                        {{-- <td class="text-center">1</td> --}}
                                        <td class="text-right">{{ number_format($model->pcxx) }}</td>
                                    </tr>
                                    <tr>
                                        <td class="text-center">{{$stt++}}</td>
                                        <td>Phụ cấp điện thoại</td>
                                        {{-- <td class="text-center">1</td> --}}
                                        <td class="text-right">{{ number_format($model->pcdt) }}</td>
                                    </tr>
                                </tbody>
                            </table>

                            <div class="row">
                                <div class="col-md-12">
                                    <!-- BEGIN PORTLET-->
                                    <div class="portlet box blue">
                                        <div class="portlet-title">
                                            <div class="caption">
                                                Thông tin khoản phải nộp theo lương (nhập số tiền)
                                            </div>
                                            <div class="tools">
                                                <a href="javascript:;" class="collapse" data-original-title=""
                                                    title=""></a>
                                            </div>
                                        </div>
                                        <div class="portlet-body" style="display: block;">

                                            <div class="row">
                                                <div class="col-md-2">
                                                    <div class="form-group">
                                                        <label class="control-label">Số tiền BHXH </label>
                                                        <input id="stbhxh" class="form-control baohiem text-right" readonly="true"
                                                            data-mask="fdecimal" name="stbhxh" type="text"
                                                            value="{{ number_format($model->ptbhxh) }}">
                                                    </div>
                                                </div>

                                                <div class="col-md-2">
                                                    <div class="form-group">
                                                        <label class="control-label">Số tiền BHYT </label>
                                                        <input id="stbhyt" class="form-control baohiem text-right" readonly="true"
                                                            data-mask="fdecimal" name="stbhyt" type="text"
                                                            value="{{ number_format($model->ptbhyt) }}">
                                                    </div>
                                                </div>

                                                <div class="col-md-2">
                                                    <div class="form-group">
                                                        <label class="control-label">Số tiền KPCĐ </label>
                                                        <input id="stkpcd" class="form-control baohiem text-right" readonly="true"
                                                            data-mask="fdecimal" name="stkpcd" type="text" value="{{number_format($model->kpcd)}}">
                                                    </div>
                                                </div>

                                                <div class="col-md-2">
                                                    <div class="form-group">
                                                        <label class="control-label">Số tiền BHTN </label>
                                                        <input id="stbhtn" class="form-control baohiem text-right" readonly="true"
                                                            data-mask="fdecimal" name="stbhtn" type="text"
                                                            value="{{ number_format($model->ptbhtn) }}">
                                                    </div>
                                                </div>

                                                <div class="col-md-4">
                                                    <div class="form-group">
                                                        <label class="control-label" style="font-weight: bold">Tổng tiền
                                                            cá nhân nộp bảo hiểm </label>
                                                        <input id="ttbh" class="form-control text-right" 
                                                            data-mask="fdecimal" readonly="true" style="font-weight:bold"
                                                            name="ttbh" type="text" value="">
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="row">
                                                <div class="col-md-2">
                                                    <div class="form-group">
                                                        <label class="control-label">BHXH đơn vị nộp</label>
                                                        <input id="stbhxh_dv" class="form-control baohiem_dv text-right" readonly="true"
                                                            data-mask="fdecimal" name="stbhxh_dv" type="text"
                                                            value="{{ number_format(($model->luongcoban * 17)/100) }}">
                                                    </div>
                                                </div>

                                                <div class="col-md-2">
                                                    <div class="form-group">
                                                        <label class="control-label">BHYT đơn vị nộp</label>
                                                        <input id="stbhyt_dv" class="form-control baohiem_dv text-right" readonly="true"
                                                            data-mask="fdecimal" name="stbhyt_dv" type="text" value="{{ number_format(($model->luongcoban * 3)/100) }}">
                                                    </div>
                                                </div>

                                                <div class="col-md-2">
                                                    <div class="form-group">
                                                        <label class="control-label">KPCĐ đơn vị nộp</label>
                                                        <input id="stkpcd_dv" class="form-control baohiem_dv text-right" readonly="true"
                                                            data-mask="fdecimal" name="stkpcd_dv" type="text" value="200,000">
                                                    </div>
                                                </div>

                                                <div class="col-md-2">
                                                    <div class="form-group">
                                                        <label class="control-label">BHTN đơn vị nộp</label>
                                                        <input id="stbhtn_dv" class="form-control baohiem_dv text-right" readonly="true"
                                                            data-mask="fdecimal" name="stbhtn_dv" type="text" value="{{number_format(($model->luongcoban * 1)/100)}}">
                                                    </div>
                                                </div>

                                                <div class="col-md-4">
                                                    <div class="form-group">
                                                        <label class="control-label" style="font-weight: bold">Tổng tiền
                                                            đơn vị nộp bảo hiểm</label>
                                                        <input id="ttbh_dv" class="form-control text-right"
                                                            data-mask="fdecimal" readonly="true" style="font-weight:bold"
                                                            name="ttbh_dv" type="text" value="398948">
                                                    </div>
                                                </div>
                                            </div>

                                            {{-- <div class="row">
                                                <div class="col-md-12">
                                                    <label class="control-label">Ghi chú</label>
                                                    <textarea id="ghichu" class="form-control" rows="3" name="ghichu" cols="50"></textarea>
                                                </div>
                                            </div> --}}
                                        </div>
                                    </div>
                                </div>
                                <!-- END PORTLET-->
                            </div>
                        </div>
                        <hr>
                        <div style="text-align: center;">



                            <a href="{{route('bangluong.show',$model->mabl)}}"
                                class="btn btn-default"><i class="fa fa-reply mlx"></i> Quay lại</a>
                        </div>
                    </form>
                </div>

            </div>

        </div>
    </div>
    {{-- <div class="row">
        <div class="col-md-12">
            <div class="portlet light bordered">
                <div class="portlet-title">
                    <div class="caption">
                        THÔNG TIN CHI TIẾT LƯƠNG CỦA CÁN BỘ {{$model->hoten}}
                    </div>
                    <div class="actions">

                    </div>
                </div>
                <div class="portlet-body">
                    <form action="" class="horizontal-form form-validate">   
                    <div class="form-horizontal">
                            <div class="row">
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label class="col-sm-6 control-label">Mã ngạch </label>

                                        <div class="col-sm-6 controls">
                                            <input type="text" class="form-control">
                                        </div>
                                    </div>
                                </div>

                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label class="col-sm-6 control-label">Nhóm ngạch bậc </label>

                                        <div class="col-sm-6">
                                            <input type="text" class="form-control">
                                        </div>
                                    </div>
                                </div>

                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label class="col-sm-6 control-label">Tên ngạch bậc </label>
                                        <div class="col-sm-6">
                                            <input type="text" class="form-control">
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label class="col-sm-6 control-label">Hệ số lương </label>

                                        <div class="col-sm-6 controls">
                                            <input type="text" class="form-control">
                                        </div>
                                    </div>
                                </div>

                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label class="col-sm-6 control-label">Hệ số vượt khung </label>

                                        <div class="col-sm-6 controls">
                                            <input type="text" class="form-control">
                                        </div>
                                    </div>
                                </div>

                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label class="col-sm-6 control-label">Phụ cấp chức vụ </label>

                                        <div class="col-sm-6 controls">
                                            <input type="text" class="form-control">
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label class="col-sm-6 control-label">PC thâm niên nghề </label>

                                        <div class="col-sm-6 controls">
                                            <input type="text" class="form-control">
                                        </div>
                                    </div>
                                </div>

                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label class="col-sm-6 control-label">PC thâm niên VK </label>

                                        <div class="col-sm-6 controls">
                                            <input type="text" class="form-control">
                                        </div>
                                    </div>
                                </div>

                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label class="col-sm-6 control-label">Phụ cấp kiêm nhiệm </label>

                                        <div class="col-sm-6 controls">
                                            <input type="text" class="form-control">
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label class="col-sm-6 control-label">Phụ cấp trách nhiệm </label>

                                        <div class="col-sm-6 controls">
                                            <input type="text" class="form-control">
                                        </div>
                                    </div>
                                </div>

                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label class="col-sm-6 control-label">Phụ cấp khu vực </label>

                                        <div class="col-sm-6 controls">
                                            <input type="text" class="form-control">
                                        </div>
                                    </div>
                                </div>

                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label class="col-sm-6 control-label">Phụ cấp thu hút </label>

                                        <div class="col-sm-6 controls">
                                            <input type="text" class="form-control">
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label class="col-sm-6 control-label">Phụ cấp ưu đãi </label>

                                        <div class="col-sm-6 controls">
                                            <input type="text" class="form-control">
                                        </div>
                                    </div>
                                </div>

                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label class="col-sm-6 control-label">Phụ cấp đặc biệt </label>

                                        <div class="col-sm-6 controls">
                                            <input type="text" class="form-control">
                                        </div>
                                    </div>
                                </div>

                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label class="col-sm-6 control-label">Phụ cấp lưu động </label>

                                        <div class="col-sm-6 controls">
                                            <input type="text" class="form-control">
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label class="col-sm-6 control-label">Phụ cấp độc hại </label>

                                        <div class="col-sm-6 controls">
                                            <input type="text" class="form-control">
                                        </div>
                                    </div>
                                </div>

                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label class="col-sm-6 control-label">Phụ cấp khác </label>

                                        <div class="col-sm-6 controls">
                                            <input type="text" class="form-control">
                                        </div>
                                    </div>
                                </div>

                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label class="col-sm-6 control-label">Tổng hệ số </label>

                                        <div class="col-sm-6 controls">
                                            <input type="text" class="form-control">
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label class="col-sm-6 control-label">Tổng tiền lương </label>

                                        <div class="col-sm-6 controls">
                                            <input type="text" class="form-control">
                                        </div>
                                    </div>
                                </div>

                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label class="col-sm-6 control-label">Giảm trừ lương </label>

                                        <div class="col-sm-6 controls">
                                            <input type="text" class="form-control">
                                        </div>
                                    </div>
                                </div>

                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label class="col-sm-6 control-label">Bảo hiểm chi trả </label>

                                        <div class="col-sm-6 controls">
                                            <input type="text" class="form-control">
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label class="col-sm-6 control-label">Số tiền BHXH </label>

                                        <div class="col-sm-6 controls">
                                            <input type="text" class="form-control">
                                        </div>
                                    </div>
                                </div>

                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label class="col-sm-6 control-label">Số tiền BHYT </label>

                                        <div class="col-sm-6 controls">
                                            <input type="text" class="form-control">
                                        </div>
                                    </div>
                                </div>

                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label class="col-sm-6 control-label">Số tiền KPCĐ </label>

                                        <div class="col-sm-6 controls">
                                            <input type="text" class="form-control">
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label class="col-sm-6 control-label">Số tiền BHTN </label>

                                        <div class="col-sm-6 controls">
                                            <input type="text" class="form-control">
                                        </div>
                                    </div>
                                </div>

                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label class="col-sm-6 control-label">Tổng tiền bảo hiểm </label>

                                        <div class="col-sm-6 controls">
                                            <input type="text" class="form-control">
                                        </div>
                                    </div>
                                </div>

                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label class="col-sm-6 control-label">Lương thực nhận </label>

                                        <div class="col-sm-6 controls">
                                            <input type="text" class="form-control">
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div style="text-align: center; border-top: 1px solid #eee;">
                            <button style="margin-top: 10px" type="submit" class="btn btn-success">Hoàn thành<i class="fa fa-save mlx"></i></button>
                        </div>
                    </form>
                </div>

            </div>

        </div>
    </div> --}}
    <script>
        $(document).ready(function() {
            var bh = baohiem().toLocaleString('en-US');
            $('#ttbh').val(bh);
            var stbhxh_dv=getdl($('#stbhxh_dv').val());
            var stbhyt_dv=getdl($('#stbhyt_dv').val());
            var stbhtn_dv=getdl($('#stbhtn_dv').val());
            var bh_dv= stbhxh_dv+stbhyt_dv+stbhtn_dv;
            $('#ttbh_dv').val(bh_dv.toLocaleString('en-US'))
        })
        function getdl(str){
            var kq=0;
            str=str.replace(',','');
            if(!isNaN(str)){
                kq=str;
            }
            return parseFloat(kq);
        }

        // function tonghs() {
        //     var hs = 0;
        //     $('.heso').each(function () {
        //         hs += getdl($(this).val());
        //     });
        //     $('#tonghs').val(hs.toFixed(2));
        // }


        function baohiem() {
            var stbhxh = getdl($('#stbhxh').val());
            var stbhyt = getdl($('#stbhyt').val());
            // var stkpcd = getdl($('#stkpcd').val());
            var stbhtn = getdl($('#stbhtn').val());
            //alert(stbhxh);
            return stbhxh + stbhyt + stbhtn;
        }

        // function giamtru(){
        //     var giaml=getdl($('#giaml').val());
        //     var bhct=getdl($('#bhct').val());
        //     return bhct-giaml;
        // }

        function luongtn() {
            // var ttl = parseFloat(tongtl().toFixed(0));
            var bh = baohiem();
            // var gt =giamtru();
            $('#ttl').val(ttl);
            $('#ttbh').val(bh);
            $('#luongtn').val(ttl + gt - bh);
        }
        // $('.heso').change(function(){
        //     tonghs();
        //     luongtn();
        // })

        $('.tienluong').change(function() {
            luongtn();
        })
    </script>
    {{-- @include('includes.script.scripts') --}}
@stop
