<!DOCTYPE html>
<html lang="en" class="no-js">
<!-- BEGIN HEAD -->

<head>
    <meta charset="utf-8" />
    <title>{{ $pageTitle }}</title>
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta content="width=device-width, initial-scale=1" name="viewport" />
    <meta content="" name="Phần mềm quản lý hồ sơ nhân sự" />
    <meta content="" name="HuongVu-LifeSoft" />
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <!-- BEGIN GLOBAL MANDATORY STYLES -->
    <link href="http://fonts.googleapis.com/css?family=Open+Sans:400,300,600,700&subset=all" rel="stylesheet"
        type="text/css" />
    <link href="{{ url('assets/global/plugins/font-awesome/css/font-awesome.min.css') }}" rel="stylesheet"
        type="text/css" />
    <link href="{{ url('assets/global/plugins/simple-line-icons/simple-line-icons.min.css') }}" rel="stylesheet"
        type="text/css" />
    <link href="{{ url('assets/global/plugins/bootstrap/css/bootstrap.min.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ url('assets/global/plugins/uniform/css/uniform.default.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ url('assets/global/plugins/bootstrap-switch/css/bootstrap-switch.min.css') }}" rel="stylesheet"
        type="text/css" />
    <!-- END GLOBAL MANDATORY STYLES -->
    <script src="{{ url('assets/global/plugins/jquery.min.js') }}" type="text/javascript"></script>
    <script src="{{ url('assets/global/plugins/jquery-migrate.min.js') }}" type="text/javascript"></script>
    <!-- BEGIN PAGE LEVEL PLUGIN STYLES -->
    <link href="{{ url('assets/global/plugins/bootstrap-daterangepicker/daterangepicker-bs3.css') }}" rel="stylesheet"
        type="text/css" />
    <link href="{{ url('assets/global/plugins/fullcalendar/fullcalendar.min.css" rel="stylesheet') }}"
        type="text/css" />
    <link href="{{ url('assets/global/plugins/morris/morris.css') }}" rel="stylesheet" type="text/css">
    <!-- END PAGE LEVEL PLUGIN STYLES -->
    <!-- BEGIN PAGE STYLES -->
    <link href="{{ url('assets/admin/pages/css/tasks.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ url('assets/global/plugins/bootstrap-wysihtml5/bootstrap-wysihtml5.css') }}" rel="stylesheet"
        type="text/css" />
    @yield('custom-style')
    <!-- END PAGE STYLES -->
    <!-- BEGIN THEME STYLES -->
    <!-- DOC: To use 'rounded corners' style just load 'components-rounded.css' stylesheet instead of 'components.css' in the below style tag -->
    <link href="{{ url('assets/global/css/components-rounded.css') }}" id="style_components" rel="stylesheet"
        type="text/css" />
    <link href="{{ url('assets/global/css/plugins.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ url('assets/admin/layout4/css/layout.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ url('assets/admin/layout4/css/themes/light.css') }}" rel="stylesheet" type="text/css"
        id="style_color" />
    <link href="{{ url('assets/global/plugins/bootstrap-toastr/toastr.min.css') }}" rel="stylesheet" type="text/css" />
    <!-- END THEME STYLES -->
    <style>
            .form-control{
        border: 1px solid #87cefa !important;
    }
    /* .table-bordered>tbody>tr>td, .table-bordered>tbody>tr>th, .table-bordered>tfoot>tr>td, .table-bordered>tfoot>tr>th, .table-bordered>thead>tr>td,
    .table-bordered>thead>tr>th {
    border: 1px solid #87cefa; */
/* } */
    </style>
    <script type="text/javascript">
        function time() {
            var today = new Date();
            var weekday = new Array(7);
            weekday[0] = "Chủ nhật";
            weekday[1] = "Thứ hai";
            weekday[2] = "Thứ ba";
            weekday[3] = "Thứ tư";
            weekday[4] = "Thứ năm";
            weekday[5] = "Thứ sáu";
            weekday[6] = "Thứ bảy";
            var day = weekday[today.getDay()];
            var dd = today.getDate();
            var mm = today.getMonth() + 1; //January is 0!
            var yyyy = today.getFullYear();
            var h = today.getHours();
            var m = today.getMinutes();
            var s = today.getSeconds();
            m = checkTime(m);
            s = checkTime(s);
            nowTime = h + ":" + m + ":" + s;
            if (dd < 10) {
                dd = '0' + dd
            }
            if (mm < 10) {
                mm = '0' + mm
            }
            today = day + ', ' + dd + '/' + mm + '/' + yyyy;

            tmp = '<span class="date"> ' + today + ' | ' + nowTime + '</span>';

            document.getElementById("clock").innerHTML = tmp;

            clocktime = setTimeout("time()", "1000", "JavaScript");

            function checkTime(i) {
                if (i < 10) {
                    i = "0" + i;
                }
                return i;
            }
        }
    </script>
    <link rel="shortcut icon" href="{{ url('images/LIFESOFT.png') }}" type="image/x-icon">
</head>
<!-- END HEAD -->

<!-- BEGIN BODY -->

<body
    class="page page-header-fixed page-footer-fixed page-sidebar-fixed page-sidebar-closed-hide-logo page-sidebar-closed-hide-logo">
    <!-- BEGIN HEADER -->
    <div class="page-header navbar navbar-fixed-top">
        <!-- BEGIN HEADER INNER -->
        <div class="page-header-inner">
            <!-- BEGIN LOGO -->
            <div class="page-logo">
                <a href="">
                    <img src="{{ url('images/LOGO.png') }}" alt="logo" class="logo-default" style="margin-top: 10px;">
                </a>
                <div class="menu-toggler sidebar-toggler">
                    <!-- DOC: Remove the above "hide" to enable the sidebar toggler button on header -->
                </div>
            </div>
            <!-- END LOGO -->
            <!-- BEGIN RESPONSIVE MENU TOGGLER -->
            <a href="javascript:;" class="menu-toggler responsive-toggler" data-toggle="collapse"
                data-target=".navbar-collapse">
            </a>
            <!-- END RESPONSIVE MENU TOGGLER -->

            <!-- BEGIN PAGE TOP -->
            <div class="page-top">
                <!-- BEGIN HEADER SEARCH BOX -->
                <!-- DOC: Apply "search-form-expanded" right after the "search-form" class to have half expanded search box -->
                <form class="search-form" action="extra_search.html" method="GET">
                    <div class="input-group">
                        <!--input type="text" class="form-control input-sm" placeholder="Search..." name="query">
     <span class="input-group-btn">
     <a href="javascript:;" class="btn submit"><i class="icon-magnifier"></i></a>
     </span-->
                    </div>
                </form>
                <!-- END HEADER SEARCH BOX -->
                <!-- BEGIN TOP NAVIGATION MENU -->
                <div class="top-menu">
                    <ul class="nav navbar-nav pull-right">
                        <li class="separator hide">
                        </li>
                        <!-- BEGIN USER LOGIN DROPDOWN -->
                        <li class="dropdown dropdown-user">
                            <a href="" class="dropdown-toggle" data-toggle="dropdown" data-hover="dropdown"
                                data-close-others="true">
                                <img alt="" class="img-circle"
                                    src="{{ url('/images/avatar/default-user.png') }}" />
                                <span class="username">
                                    <b>{{Auth()->user()->name}}</b> </span>
                                <i class="fa fa-angle-down"></i>
                            </a>
                            <ul class="dropdown-menu dropdown-menu-default">
                                @can('edit_taikhoan')
                                <li>
                                    <a href="{{route('viewchangPassword')}}">
                                        <i class="icon-lock"></i> Đổi mật khẩu</a>
                                </li>  
                                @endcan

                                <li>
                                    <a href="{{route('logout')}}">
                                        <i class="icon-key"></i> Đăng xuất </a>
                                </li>
                            </ul>
                        </li>
                        <!-- END USER LOGIN DROPDOWN -->
                    </ul>
                </div>
                <!-- END TOP NAVIGATION MENU -->
            </div>
            <!-- END PAGE TOP -->
        </div>
        <!-- END HEADER INNER -->
    </div>
    <!-- END HEADER -->
    <div class="clearfix">
    </div>
    <!-- BEGIN CONTAINER -->
    <div class="page-container">
        <!-- BEGIN SIDEBAR -->
        <div class="page-sidebar-wrapper">
            <div class="page-sidebar navbar-collapse collapse">
                <ul class="page-sidebar-menu " data-keep-expanded="false" data-auto-scroll="true"
                    data-slide-speed="200">
                    {{-- <li class="start">
                        <a href="">
                            <i class="icon-home"></i>
                            <span class="title">Tổng quan</span>
                        </a>
                    </li> --}}
                    <li>
                        <a href="javascript:;">
                            <i class="fa fa-folder-open-o"></i>
                            <span class="title">Quản lý</span>
                            <span class="arrow "></span>
                        </a>
                        <ul class="sub-menu">
                            @can('list_canbo')
                            <li><a href="{{route('canbo.index')}}"><i class="fa fa-caret-right"></i>Hồ sơ cán bộ</a></li>
                            @endcan
                            
                        </ul>
                    </li>
                    {{-- <li>
                        <a href="javascript:;">
                            <i class="fa fa-sitemap fa-fw"></i>
                            <span class="title">Chức năng</span>
                            <span class="arrow "></span>
                        </a>
                        <ul class="sub-menu">
                           @can('list_bangluong')
                           <li><a href="{{route('bangluong.index')}}"><i class="fa fa-caret-right"></i>Chi trả lương</a></li>
                           @endcan
                            
                            
                            
                        </ul>
                    </li> --}}
                    <li>
                        <a href="javascript:;">
                            <i class="fa fa-search"></i>
                            <span class="title">Tra cứu</span>
                            <span class="arrow "></span>
                        </a>
                        @can('list_canbo')
                        <ul class="sub-menu">
                            <li><a href="{{route('canbo.search')}}"><i class="fa fa-caret-right"></i>Tra cứu hồ sơ cán bộ</a></li>
                        </ul>
                        @endcan

                    </li>
                    <li>
                        <a href="javascript:;">
                            <i class="fa fa-gear"></i>
                            <span class="title">Hệ thống</span>
                            <span class="arrow "></span>
                        </a>
                        <ul class="sub-menu">
                            <li>
                                <a href="javascript:;">
                                    <i class="fa fa-list-alt"></i>
                                    <span class="title">Danh mục</span>
                                    <span class="arrow "></span>
                                </a>
                                <ul class="sub-menu">
                                    @can('list_chucvu')
                                    <li><a href="{{route('chucvu.index')}}"><i class="fa fa-caret-right"></i>Chức vụ</a></li> 
                                    @endcan
                                    @can('list_dmkhoipb')
                                    <li><a href="{{route('dmkhoipb.index')}}"><i class="fa fa-caret-right"></i>Khối phòng ban</a></li>
                                    @endcan
                                    @can('list_phongban')
                                    <li><a href="{{route('phongban.index')}}"><i class="fa fa-caret-right"></i>Phòng ban</a></li>
                                    @endcan
                                    
                                    
                                </ul>
                            </li>
                            <li>
                                <a href="javascript:;">
                                    <i class="icon-user"></i>
                                    <span class="title">Người dùng</span>
                                    <span class="arrow "></span>
                                </a>
                                <ul class="sub-menu">
                                   @can('edit_taikhoan')
                                   <li><a href="{{route('viewchangPassword')}}"><i class="fa fa-caret-right"></i>Đổi mật khẩu</a></li>   
                                   @endcan
                                    
                                                                                                      
                                </ul>
                            </li>
                            @can('list_taikhoan')
                            <li>                                
                                <a href="javascript:;">
                                    <i class="icon-grid"></i>
                                    <span class="title">Phân quyền</span>
                                    <span class="arrow "></span>
                                </a>
                                <ul class="sub-menu">                                  
                                    @can('list_taikhoan')
                                    <li><a href="{{route('user.index')}}"><i class="fa fa-caret-right"></i>Tài khoản</a></li>  
                                    @endcan
        
                                    @can('list_roles')
                                    <li><a href="{{route('roles.index')}}"><i class="fa fa-caret-right"></i>Quản lý quyền</a></li>
                                    @endcan
                                    
                                    @can('list_permission')
                                    <li><a href="{{route('permission.index')}}"><i class="fa fa-caret-right"></i>Quản lý permission</a></li>
                                    @endcan  
                                </ul>
                            </li>
                            @endcan
                            
                        </ul>
                    </li>

                    <li>
                        <a href="{{route('thongtinphanmem')}}">
                            <i class="fa fa-question-circle"></i>
                            <span class="title">Thông tin phần mềm</span>
                            {{-- <span class="arrow "></span> --}}
                        </a>
                        {{-- @can('list_canbo')
                        <ul class="sub-menu">
                            <li><a href="{{route('canbo.search')}}"><i class="fa fa-caret-right"></i>Tra cứu hồ sơ cán bộ</a></li>
                        </ul>
                        @endcan --}}

                    </li>
                    
                </ul>

                <!-- END SIDEBAR MENU -->
            </div>
        </div>
        <!-- END SIDEBAR -->

        <!-- BEGIN CONTENT -->
        <div class="page-content-wrapper">
            <div class="page-content">
                <!-- BEGIN PAGE BREADCRUMB -->
                <div class="page-bar">
                    <ul class="page-breadcrumb breadcrumb">
                        <li>
                            <i class="fa fa-home"></i>
                            <a href="{{ url('') }}">Trang chủ</a>
                            <i class="fa fa-angle-right"></i>
                        </li>
                        <li>
                            {{ $pageTitle }}
                        </li>
                    </ul>

                    <div class="page-toolbar">
                        <div class="page-toolbar">
                            <b>
                                <div id="clock"></div>
                            </b>
                        </div>
                    </div>
                </div>
                <!-- END PAGE BREADCRUMB -->
                @yield('content')
            </div>
        </div>
        <!-- END CONTENT -->
    </div>
    <!-- END CONTAINER -->
    <!-- BEGIN FOOTER -->
    <div class="page-footer">
        <div class="page-footer-tools">
            <!--  2016 &copy; LifeSoft <a href="" >Tiện ích hơn - Hiệu quả hơn</a>-->
            Số đăng ký bản quyền: 282/2015/QTG, được khai thác và phần phối bởi H2SOFT
        </div>
        <div class="scroll-to-top">
            <i class="icon-arrow-up"></i>
        </div>
    </div>
    <!-- END FOOTER -->
    <!-- BEGIN JAVASCRIPTS(Load javascripts at bottom, this will reduce page load time) -->
    <!-- BEGIN CORE PLUGINS -->
    <!--[if lt IE 9]>
<script src="{{ url('assets/global/plugins/respond.min.js') }}"></script>
<script src="{{ url('assets/global/plugins/excanvas.min.js') }}"></script>
<![endif]-->

    <!-- IMPORTANT! Load jquery-ui.min.js before bootstrap.min.js to fix bootstrap tooltip conflict with jquery ui tooltip -->
    <script src="{{ url('js/main.js') }}" type="text/javascript"></script>
    <script src="{{ url('assets/global/plugins/jquery-ui/jquery-ui.min.js') }}" type="text/javascript"></script>
    <script src="{{ url('assets/global/plugins/bootstrap/js/bootstrap.min.js') }}" type="text/javascript"></script>
    <script src="{{ url('assets/global/plugins/bootstrap-hover-dropdown/bootstrap-hover-dropdown.min.js') }}"
        type="text/javascript"></script>
    <script src="{{ url('assets/global/plugins/jquery-slimscroll/jquery.slimscroll.min.js') }}" type="text/javascript">
    </script>
    <script src="{{ url('assets/global/plugins/jquery.blockui.min.js') }}" type="text/javascript"></script>
    <script src="{{ url('assets/global/plugins/jquery.cokie.min.js') }}" type="text/javascript"></script>
    <script src="{{ url('assets/global/plugins/uniform/jquery.uniform.min.js') }}" type="text/javascript"></script>
    <script src="{{ url('assets/global/plugins/bootstrap-switch/js/bootstrap-switch.min.js') }}" type="text/javascript">
    </script>
    <!-- END CORE PLUGINS -->
    <!-- BEGIN PAGE LEVEL PLUGINS -->
    <script src="{{ url('assets/global/plugins/jquery-validation/js/jquery.validate.min.js') }}" type="text/javascript">
    </script>
    <script src="{{ url('assets/global/plugins/jquery-validation/js/additional-methods.min.js') }}" type="text/javascript">
    </script>
    <script src="{{ url('assets/global/plugins/jquery.pulsate.min.js') }}" type="text/javascript"></script>
    <script src="{{ url('assets/global/plugins/bootstrap-daterangepicker/moment.min.js') }}" type="text/javascript">
    </script>
    <script src="{{ url('assets/global/plugins/bootstrap-daterangepicker/daterangepicker.js') }}" type="text/javascript">
    </script>
    <!-- IMPORTANT! fullcalendar depends on jquery-ui.min.js for drag & drop support -->
    <script src="{{ url('assets/global/plugins/fullcalendar/fullcalendar.min.js') }}" type="text/javascript"></script>
    <script src="{{ url('assets/global/plugins/bootstrap-toastr/toastr.min.js') }}"></script>
    <!-- END PAGE LEVEL PLUGINS -->
    <!-- BEGIN PAGE LEVEL SCRIPTS -->
    <script src="{{ url('assets/global/scripts/metronic.js') }}" type="text/javascript"></script>
    <script src="{{ url('assets/admin/layout4/scripts/layout.js') }}" type="text/javascript"></script>
    <script src="{{ url('assets/admin/layout4/scripts/demo.js') }}" type="text/javascript"></script>
    <script src="{{ url('assets/admin/pages/scripts/tasks.js') }}" type="text/javascript"></script>

    @yield('custom-script')
    <!-- END PAGE LEVEL SCRIPTS -->
    <script>
        jQuery(document).ready(function() {
            Metronic.init(); // init metronic core componets
            Layout.init(); // init layout
            Demo.init(); // init demo features
        });
    </script>
    <!-- END JAVASCRIPTS -->
</body>
<!-- END BODY -->

</html>
