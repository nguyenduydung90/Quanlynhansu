<?php
/**
 * Created by PhpStorm.
 * User: MyPC
 * Date: 7/7/2016
 * Time: 2:42 PM
 */
?>
@extends('main')

@section('custom-style')
    <link href="{{ url('assets/global/css/plugins.css') }}" rel="stylesheet" type="text/css" />
    <link rel="stylesheet" type="text/css" href="{{ url('assets/global/plugins/select2/select2.css') }}" />
    <link rel="stylesheet" type="text/css" href="{{ url('assets/global/css/canbo.css') }}">

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
                        QUẢN LÝ THÔNG TIN TÀI KHOẢN
                    </div>
                    <div class="tools hidden-xs">
                        <a href="javascript:;" class="collapse">
                        </a>
                    </div>
                </div>

                <div class="portlet-body form">
                    <div class="form-body clearfix">
                        <form method="POST" action="{{ route('doimatkhau') }}" accept-charset="UTF-8" id="form-changepass"
                            class="form-horizontal form-validate">
                            @csrf
                            <div class="form-body">
                                @if (session('errors'))
                                    <br>
                                    <div class="alert alert-danger">
                                        {{ session('errors') }}
                                    </div>
                                @endif
                                @if (session('success'))
                                    <br>
                                    <div class="alert alert-success">
                                        {{ session('success') }}
                                    </div>
                                @endif
                                <div class="form-group">
                                    <label for="current-password" class="col-sm-5 control-label">Mật khẩu cũ <span
                                            class="require">*</span></label>
                                    <div class="col-sm-4">
                                        <input id="current-password" class="form-control required" autofocus="autofocus"
                                            name="current-password" type="password" value="">
                                    </div>

                                </div>
                                <div class="form-group">
                                    <label for="newpassword" class="col-sm-5 control-label">Mật khẩu mới <span
                                            class="require">*</span></label>
                                    <div class="col-sm-4">
                                        <input id="newpassword" class="form-control required" name="newpassword"
                                            type="password" value="">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="newpassword2" class="col-sm-5 control-label">Nhập lại mật khẩu mới <span
                                            class="require">*</span></label>
                                    <div class="col-sm-4">
                                        <input id="newpassword2" class="form-control required" name="newpassword2"
                                            type="password" value="">
                                        <br>
                                        <span id='message' class=""></span>
                                    </div>

                                </div>
                                <br>
                                <span id='message' class=""></span>
                            </div>

                    </div>
                    <div class="form-actions">
                        <div class="row">
                            <div class="col-md-offset-4 col-md-8">
                                {{-- <a href="{{route('doimatkhau')}}"  name="previous" value="Previous"
                                    class="btn btn-info">
                                    <i class="fa fa-arrow-circle-o-left mrx"></i>Hủy
                                </a> --}}

                                <button type="submit" class="btn btn-success" style="margin-left: 126px ">Cập nhật</button>
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
        //click hiện avata
        $("#anh").change(function() {
            readURL(this);
        });
        // check nhập lại mật khẩu
        $(document).ready(function() {

            $('#newpassword2').on('keyup', function() {
                if ($('#newpassword').val() == $('#newpassword2').val()) {
                    $('#message').html('Nhập lại mật khẩu đúng').css('color', 'green');
                } else
                    $('#message').html('Nhập lại mật khẩu chưa đúng').css('color', 'red');
            });
        })
    </script>
@stop
