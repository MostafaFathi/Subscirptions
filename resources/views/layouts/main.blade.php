<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">


    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title class="title-home">Click Shop</title>

    <!-- Global stylesheets -->
    <link href="https://fonts.googleapis.com/css?family=Roboto:400,300,100,500,700,900" rel="stylesheet" type="text/css">
    {{--<link href="http://adonis.u-psud.fr/adonis/templates/assets/scss/ups/fonts/_icons.css"  type="text/css">--}}
    <link href="{{ asset('css/icomoon/styles.css') }}" rel="stylesheet" type="text/css">

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

    <script type="text/javascript" src="{{ asset('js/tasawaq.js')}}"></script>
    @if($js == 'users')
    <script type="text/javascript" src="{{ asset('js/users.js')}}"></script>
@endif



    <script type="text/javascript" src="{{ asset('js/core/app.js') }}"></script>

</head>

<body>

<!-- Main navbar -->
<div class="navbar navbar-inverse" style="    background-color: #4267b2 !important; border-color: #4267b2 !important;">
    <div class="navbar-header">
        <a class="navbar-brand" style="    text-align: center;font-size: 18px;font-weight: bold;color: #e9f5ea;display: block;width: 75%;" href="/">
            {{--<img src="{{asset('/images/logo_light.png')}}" alt="تعليمي دوت كوم" style="    margin-top: 0px;height: 26px;">--}}
        Click Shop
        </a>

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
        <div class="sidebar sidebar-main" style="    background-color: #e9ebee !important; color: #616161 !important;;">
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
                                <div class="text-size-mini text-muted" style="color: rgb(78, 78, 78) !important;">
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

                <style>
                    .navigation li a {
                        color: rgb(78, 78, 78) !important;
                    }
                    .navigation li a:hover, .navigation li a:focus {
                        background-color: rgba(0,0,0,0.1);
                        color: rgb(78, 78, 78) !important;
                    }
                </style>
                <!-- Main navigation -->
                <div class="sidebar-category sidebar-category-visible">
                    <div class="category-content no-padding">
                        <ul class="navigation navigation-main navigation-accordion">

                            <!-- Main -->
                            <li><a href="/"><i class="icon-stack2"></i><span>الطلبات الحالية</span></a></li>
                            <li><a href="/users"><i class="icon-stack2"></i><span>إدارة المستخدمين</span></a></li>
                            <li><a href="/commition"><i class="icon-stack2"></i><span>تحديث العمولة</span></a></li>
                            <li><a href="/times_of_work"><i class="icon-stack2"></i><span>تحديد مواعيد العمل</span></a></li>
                            <li><a href="/products"><i class="icon-stack2"></i><span>إضافة منتج جديد</span></a></li>
                            <li><a href="/products/manage"><i class="icon-stack2"></i><span>إدارة المنتجات</span></a></li>
                            <li><a href="/restaurant"><i class="icon-stack2"></i><span>إضافة قسم جديد</span></a></li>
                            <li><a href="/restaurant/manage"><i class="icon-stack2"></i><span>إدارة الاقسام</span></a></li>
                            <li><a href="/branches"><i class="icon-stack2"></i><span>إضافة قسم فرعي جديد</span></a></li>
                            <li><a href="/branches/manage"><i class="icon-stack2"></i><span>إدارة الاقسام الفرعية</span></a></li>
                            <li><a href="/app_users"><i class="icon-stack2"></i><span>عرض مستخدمي التطبيق</span></a></li>



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
 جميع الحقوق محفوظة لدى كليك شوب 2019&copy;
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
