<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">


    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Educational Center') }}</title>

    <!-- Global stylesheets -->
    <link href="https://fonts.googleapis.com/css?family=Roboto:400,300,100,500,700,900" rel="stylesheet" type="text/css">
    <link href="{{ asset('css/icons/icomoon/styles.css') }}" rel="stylesheet" type="text/css">

    <link href="{{ asset('css/minified/bootstrap.min.css') }}" rel="stylesheet" type="text/css">
    @if(Auth::user()->language == 'ar')
        <link href="{{ asset('css/ar_css/bootstrap-rtl.css') }}" rel="stylesheet" type="text/css">
        <link href="{{ asset('css/ar_css/ar.css') }}" rel="stylesheet" type="text/css">
        <link href="{{ asset('css/ar_css/bootstrap-flipped.min.css') }}" rel="stylesheet" type="text/css">
    @endif
    <link href="{{ asset('css/custom-sheet.css') }}" rel="stylesheet" type="text/css">
    <link href="{{ asset('css/minified/core.min.css') }}" rel="stylesheet" type="text/css">
    <link href="{{ asset('css/minified/components.min.css') }}" rel="stylesheet" type="text/css">
    <link href="{{ asset('css/minified/colors.min.css') }}" rel="stylesheet" type="text/css">
    <link href="{{ asset('css/easyTree.css') }}" rel="stylesheet" type="text/css">

    <!-- /global stylesheets -->

    <!-- Core JS files -->
    <script type="text/javascript" src="{{ asset('js/plugins/loaders/pace.min.js') }}"></script>
    <script type="text/javascript" src="{{ asset('js/core/libraries/jquery.min.js') }}"></script>
    <script type="text/javascript" src="{{ asset('js/core/libraries/bootstrap.min.js') }}"></script>
    <script type="text/javascript" src="{{ asset('js/plugins/loaders/blockui.min.js') }}"></script>
    <!-- /core JS files -->

    <!-- Theme JS files -->
    <script type="text/javascript" src="{{ asset('js/plugins/visualization/d3/d3.min.js') }}"></script>
    <script type="text/javascript" src="{{ asset('js/plugins/visualization/d3/d3_tooltip.js') }}"></script>
    <script type="text/javascript" src="{{ asset('js/plugins/forms/styling/uniform.min.js') }}"></script>
    <script type="text/javascript" src="{{ asset('js/plugins/forms/selects/bootstrap_multiselect.js') }}"></script>
    <script type="text/javascript" src="{{ asset('js/plugins/ui/moment/moment.min.js') }}"></script>
    <script type="text/javascript" src="{{ asset('js/plugins/pickers/daterangepicker.js') }}"></script>

    {{--js for selectable + uploade imges + tags--}}
    <script type="text/javascript" src="{{ asset('js/plugins/forms/selects/select2.min.js') }}"></script>
    <script type="text/javascript" src="{{ asset('js/pages/form_layouts.js') }}"></script>
    {{--js for selectable + uploade imges + tags--}}

    <script type="text/javascript" src="{{ asset('js/plugins/notifications/bootbox.min.js') }}"></script>
    <script type="text/javascript" src="{{ asset('js/plugins/notifications/sweet_alert.min.js') }}"></script>

    <script type="text/javascript" src="{{ asset('js/plugins/notifications/pnotify.min.js') }}"></script>

    <script type="text/javascript" src="{{ asset('js/plugins/velocity/velocity.min.js') }}"></script>
    <script type="text/javascript" src="{{ asset('js/plugins/velocity/velocity.ui.min.js') }}"></script>
    <script type="text/javascript" src="{{ asset('js/plugins/ui/prism.min.js') }}"></script>
    {{--<script type="text/javascript" src="{{ asset('js/plugins/loaders/blockui.min.js') }}"></script>--}}
    <script type="text/javascript" src="{{ asset('js/plugins/tables/datatables/datatables.min.js') }}"></script>
    <script type="text/javascript" src="{{ asset('js/plugins/forms/styling/switch.min.js') }}"></script>
{{--    <script type="text/javascript" src="{{ asset('js/plugins/forms/styling/switchery.min.js') }}"></script>--}}

       {{--<script type="text/javascript" src="{{ asset('js/pages/components_modals.js') }}"></script>--}}

    @if($js == 'users')
        <script type="text/javascript" src="{{ asset('js/users.js') }}"></script>
    @endif
    @if($js == 'branches')
        <script type="text/javascript" src="{{ asset('js/branches.js') }}"></script>
    @endif
    @if($js == 'centers')
        <script type="text/javascript" src="{{ asset('js/centers.js') }}"></script>
    @endif
    @if($js == 'permissions')
        <script type="text/javascript" src="{{ asset('js/permissions.js') }}"></script>
        <script type="text/javascript" src="{{ asset('js/plugins/easyTree.js') }}"></script>
        <script type="text/javascript" src="{{ asset('js/plugins/jquery.bonsai.js') }}"></script>
        <script type="text/javascript" src="{{ asset('js/plugins/jquery.qubit.js') }}"></script>

    @endif
    @if($js == 'students')
        <script type="text/javascript" src="{{ asset('js/student.js') }}"></script>
    @endif
    @if($js == 'teachers')
        <script type="text/javascript" src="{{ asset('js/teachers.js') }}"></script>
    @endif

    @if($js == 'groups')
        <script type="text/javascript" src="{{ asset('js/groups.js') }}"></script>
    @endif

    @if(isset($js2))
    @if($js2 == 'groups')
        <script type="text/javascript" src="{{ asset('js/groups.js') }}"></script>
        @endif
    @endif



    <script type="text/javascript" src="{{ asset('js/core/app.js') }}"></script>

</head>

<body>

<!-- Main navbar -->
<div class="navbar navbar-inverse">
    <div class="navbar-header">
        <a class="navbar-brand" href="index.html">
            <img src="{{asset('/images/logo_light.png')}}" alt="تعليمي دوت كوم" style="    margin-top: 0px;height: 26px;"></a>

        <ul class="nav navbar-nav visible-xs-block">
            <li><a data-toggle="collapse" data-target="#navbar-mobile"><i class="icon-tree5"></i></a></li>
            <li><a class="sidebar-mobile-main-toggle"><i class="icon-paragraph-justify3"></i></a></li>
        </ul>
    </div>

    <div class="navbar-collapse collapse" id="navbar-mobile">
        <ul class="nav navbar-nav">
            <li><a class="sidebar-control sidebar-main-toggle hidden-xs"><i class="icon-paragraph-justify3"></i></a></li>
        </ul>
        <ul class="nav navbar-nav navbar-right float-left margin-left-20">
            <li class="dropdown language-switch">
                <a class="dropdown-toggle" data-toggle="dropdown">
                    <img src="@if(Auth::user()->language == 'en')  {{ asset('images/flags/gb.png') }} @else {{ asset('images/flags/ps.png') }} @endif" class="position-left" alt="">
                    @if(Auth::user()->language == 'en')  English @else عربي @endif
                    <span class="caret"></span>
                </a>

                <ul class="dropdown-menu">
                    <li><a class="@if(Auth::user()->language == 'en')  not-active @endif"  class="english"><img src="{{ asset('images/flags/gb.png') }}" alt=""> English</a></li>
                    <li><a  class="@if(Auth::user()->language == 'ar')  not-active @endif" class="espana"><img src="{{ asset('images/flags/ps.png') }}" alt=""> عربي</a></li>
                </ul>
            </li>


            <li class="dropdown dropdown-user">
                <a class="dropdown-toggle" data-toggle="dropdown">
                    <img src="
@if(Auth::user()->img != 'default_user.png')
{{  asset('uploads/users/'.Auth::user()->img) }}
@else
{{  asset('images/'.Auth::user()->img) }}
@endif
" alt="">
                    <span>{{ Auth::user()->name }}</span>
                    <i class="caret"></i>
                </a>

                <ul class="dropdown-menu dropdown-menu-right">
                    <li><a href="#"><i class="icon-user-plus"></i> My profile</a></li>
                      <li>
                        <a href="{{ route('logout') }}"
                           onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                            <i class="icon-switch2"></i>
                            Logout
                        </a>

                        <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                            {{ csrf_field() }}
                        </form>

                    </li>
                </ul>
            </li>
        </ul>
    </div>
</div>
<!-- /main navbar -->


<!-- Page container -->
<div class="page-container">

    <!-- Page content -->
    <div class="page-content">

        <!-- Main sidebar -->
        <div class="sidebar sidebar-main">
            <div class="sidebar-content">

                <!-- User menu -->
                <div class="sidebar-user">
                    <div class="category-content">
                        <div class="media">
                            <a href="#" class="media-left"><img src="
@if(Auth::user()->img != 'default_user.png')
{{  asset('uploads/users/'.Auth::user()->img) }}
@else
{{  asset('images/'.Auth::user()->img) }}
@endif
" class="img-circle img-sm" alt=""></a>
                            <div class="media-body">
                                <span class="media-heading text-semibold">{{ Auth::user()->name }}</span>
                                <div class="text-size-mini text-muted">
                                    <i class="icon-phone text-size-small"></i> &nbsp;{{ Auth::user()->phone }}
                                </div>
                            </div>

                            <div class="media-right media-middle">
                                <ul class="icons-list">
                                    <li>
                                        <a href="#"><i class="icon-cog3"></i></a>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- /user menu -->


                <!-- Main navigation -->
                <div class="sidebar-category sidebar-category-visible">
                    <div class="category-content no-padding">
                        <ul class="navigation navigation-main navigation-accordion">

                            <!-- Main -->
                             <li class="active"><a href="index.html" class="has-no-ul"><i class="icon-home4"></i> <span>الإحصائيات</span></a></li>
                            @if(CommonFunctions::has_permissions('Screen_31',[],'screen_level'))
                            <li>
                                <a href="#"><i class="icon-stack2"></i> <span>إدارة عامة</span></a>
                                <ul>
                                    @if(CommonFunctions::has_permissions('Screen_42',[],'screen_level'))
                                    <li><a href="/center">إدارة بيانات المركز</a></li>
                                        @endif
                                    @if(CommonFunctions::has_permissions('Screen_47',[],'screen_level'))
                                    <li><a href="/users/branches">إدارة فروع المركز</a></li>
                                        @endif
                                        @if(CommonFunctions::has_permissions('Screen_55',[],'screen_level'))
                                    <li><a href="/permissions">إدارة الصلاحيات</a></li>
                                        @endif

                                        <li><a href="/center/opening">إفتتاح سنة جديدة</a></li>

                                </ul>
                            </li>
                            @endif

                            @if(CommonFunctions::has_permissions('Screen_64',[],'screen_level'))
                            <li>
                                <a href="#"><i class="icon-stack2"></i> <span>المستخدمين</span></a>
                                <ul>
                                    @if(CommonFunctions::has_permissions('Screen_69',[],'screen_level'))
                                    <li><a href="/users">إدارة المستخدمين</a></li>
                                         @endif
                                    @if(CommonFunctions::has_permissions('Screen_65',[],'screen_level'))
                                    <li><a href="/permissions/users">صلاحيات المستخدمين</a></li>
                                        @endif
                                     @if(CommonFunctions::has_permissions('Screen_74',[],'screen_level'))
                                    <li><a href="layout_sidebar_fixed_native.html">تاريخ التعديلات</a></li>
                                        @endif
                                </ul>
                            </li>
                            @endif
                            <li>
                                <a href="#"><i class="icon-stack2"></i> <span>الطـلاب</span></a>
                                <ul>
                                    <li><a href="/students"> إضافة طالب</a></li>
                                    <li><a href="/students/manage">إدارة الطلاب</a></li>
                                    <li><a href="/students/recycle">سلة المحذوفات</a></li>
                                </ul>
                            </li>
                            <li>
                                <a href="#"><i class="icon-stack2"></i> <span>الموظفين</span></a>
                                <ul>
                                    <li><a href="/teachers"> إضافة موظف</a></li>
                                    <li><a href="/teachers/manage">إدارة الموظفين</a></li>
                                </ul>
                            </li>

                            <li>
                                <a href="#"><i class="icon-stack2"></i> <span>الجداول والمجموعات</span></a>
                                <ul>
                                    <li><a href="/groups"> إنشاء مجموعة</a></li>
                                    <li><a href="/groups/manage">إدارة المجموعات</a></li>
                                </ul>
                            </li>

                            <li>
                                <a href="#"><i class="icon-stack2"></i> <span>الرواتب</span></a>
                                <ul>
                                    <li><a href="/salary"> كشف الراتب</a></li>
                                </ul>
                            </li>

                            <!-- /page kits -->

                        </ul>
                    </div>
                </div>
                <!-- /main navigation -->

            </div>
        </div>
        <!-- /main sidebar -->

        <div class="content-wrapper">

            <!-- Page header -->
            <div class="page-header">
                <div class="page-header-content">
                    <div class="page-title">
                        <h4><i class="icon-arrow-left52 position-left"></i> <span class="text-semibold">Home</span> - Dashboard</h4>
                    </div>

                    <div class="heading-elements">
                        <div class="heading-btn-group">
                            <a href="#" class="btn btn-link btn-float has-text"><i class="icon-bars-alt text-primary"></i><span>إحصائيات</span></a>
                            <a href="#" class="btn btn-link btn-float has-text"><i class="icon-calculator text-primary"></i> <span>طلاب المركز</span></a>
                            <a href="#" class="btn btn-link btn-float has-text"><i class="icon-calendar5 text-primary"></i> <span>جدولة مواعيد</span></a>
                        </div>
                    </div>
                </div>

                <div class="breadcrumb-line">
                    <ul class="breadcrumb">
                        <li><a href="/home"><i class="icon-home2 position-left"></i> الصفحة الرئيسية</a></li>
                        @if(isset($has_parent))
                            <li><a href="{{ $parent_url }}"> {{ $parent_name }}</a></li>
                        @endif
                        <li class="active">{{ $title }}</li>
                    </ul>


                </div>
            </div>
            <!-- /page header -->


            <!-- Content area -->
            <div class="content">
        <!-- Main content -->
    @yield('content')
        <div class="footer text-muted">
 جميع الحقوق محفوظة لدى موقع تعليمي 2017&copy;
        </div>
        <!-- /footer -->

    </div>
    <!-- /content area -->

</div>
    <!-- /main content -->

    </div>
    <!-- /page content -->

</div>
<!-- /page container -->

</body>
</html>
