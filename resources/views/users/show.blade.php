@extends('layouts.main',['title' => 'إدارة المستخدمين' , 'js'=>'users'])

@section('content')
    {{--for validation errors--}}
    <validation class="validation hide">
        <error class="validation-error">
            <div class="form-control-feedback">
                <i class="icon-cancel-circle2"></i>
            </div>
            <span class="help-block">Error input</span>
        </error>
    </validation>
    {{--for validation errors--}}


        <!-- Main charts -->
        <div class="row">
            <div class="col-lg-7">
                {{--add users form --}}
                <?php $hide_show = 'show' ?>
                    <?php $hide_show = 'hide' ?>
                <form action="post" id="users_submit_form" class="form-horizontal form-validate-jquery" enctype="multipart/form-data">
                    {{ csrf_field() }}
                    <div class="panel panel-flat">
                        <div class="panel-heading">
                            <h5 class="panel-title">إضافة أو تعديل</h5>

                        </div>

                        <div class="panel-body">
                            <div class="form-group">
                                <label class="col-lg-3 control-label">إسم المستخدم:</label>
                                <div class="col-lg-9">
                                    <input type="text" id="name" name="name" class="form-control" placeholder="mhilles">

                                </div>
                            </div>

                            <div class="form-group">
                                <label class="col-lg-3 control-label">كلمة السر:</label>
                                <div class="col-lg-9">
                                    <input type="password" id="password" name="password" class="form-control" placeholder="كلمة السر الخاصة بالمستخدم">
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-lg-3 control-label">البريد الالكتروني:</label>
                                <div class="col-lg-9">
                                    <input type="email" id="email" name="email" class="form-control" placeholder="mhilles@yahoo.com">
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-lg-3 control-label">رقم الجوال:</label>
                                <div class="col-lg-9">
                                    <input type="number" id="phone" name="phone" class="form-control" placeholder="0599112233">
                                </div>
                            </div>
                            {{--<div class="form-group">--}}
                                {{--<label class="col-lg-3 control-label">الفرع:</label>--}}
                                {{--<div class="col-lg-9">--}}
                                    {{--<select id="branch_id" name="branch_id" class="select">--}}
                                        {{--@foreach($branches as $item)--}}
                                            {{--<option value="{{ $item['branch_id'] }}">{{ $item['branch_name'] }}</option>--}}
                                        {{--@endforeach--}}

                                    {{--</select>--}}
                                {{--</div>--}}
                            {{--</div>--}}

                            <div class="form-group">
                                <label class="col-lg-3 control-label">الجنس:</label>
                                <div class="col-lg-9">
                                    <label class="radio-inline">
                                        <input type="radio"  id="gender" name="gender" class="styled" name="gender" checked="checked" value="m">
                                            ذكر
                                    </label>

                                    <label class="radio-inline">
                                        <input type="radio" id="gender" name="gender" class="styled" name="gender" value="f">
                                        أنثى
                                    </label>
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="col-lg-3 control-label">الصورة الشخصية:</label>
                                <div class="col-lg-9">
                                    <input type="file" name="img" id="img" class="file-styled">
                                    <span class="help-block">تقبل الامتدادات التالية: gif, png, jpg. Max file size 2Mb</span>
                                </div>
                            </div>


                            <div class="text-right">
                                <button type="submit"  class="btn btn-primary">
                                    <i class=" icon-floppy-disk position-right" style="margin-top: 2px"></i>
                                    حفظ
                                    <i class="icon-spinner2 spinner position-left hide loader" style="margin-top: 3px;float: left;"></i>
                                </button>
                            </div>
                        </div>
                    </div>
                </form>
                {{--end add users form--}}

                {{--update users form--}}
                <form action="post" id="users_update_form" class="form-horizontal form-validate-jquery {{ $hide_show }}" enctype="multipart/form-data">
                    {{ csrf_field() }}
                    <div class="panel panel-flat " id="users_update_container" >
                        <div class="panel-heading">
                            <h5 class="panel-title">  تعديل المستخدم </h5>

                        </div>

                        <div class="panel-body">
                            <div class="form-group " >
                                <label class="col-lg-3 control-label">إسم المستخدم:</label>
                                <div class="col-lg-9">
                                    <input type="text" id="name" name="name" class="form-control" placeholder="mhilles">
                                    <input type="hidden" id="id" name="id"/>

                                </div>
                            </div>

                            <div class="form-group">
                                <label class="col-lg-3 control-label">كلمة السر:</label>
                                <div class="col-lg-9">
                                    <input type="password" id="password" name="password" class="form-control" placeholder="كلمة السر الخاصة بالمستخدم">
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-lg-3 control-label">البريد الالكتروني:</label>
                                <div class="col-lg-9">
                                    <input type="email" id="email" name="email" class="form-control" placeholder="mhilles@yahoo.com">
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-lg-3 control-label">رقم الجوال:</label>
                                <div class="col-lg-9">
                                    <input type="number" id="phone" name="phone" class="form-control" placeholder="0599112233">
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="col-lg-3 control-label">الجنس:</label>
                                <div class="col-lg-9">
                                    <label class="radio-inline">
                                        <input type="radio"  id="gender" name="gender" class="styled" name="gender" checked="checked" value="m">
                                        ذكر
                                    </label>

                                    <label class="radio-inline">
                                        <input type="radio" id="gender" name="gender" class="styled" name="gender" value="f">
                                        أنثى
                                    </label>
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="col-lg-3 control-label">الصورة الشخصية:</label>
                                <div class="col-lg-9">
                                    <input type="file" name="img" id="img" class="file-styled">
                                    <span class="help-block">تقبل الامتدادات التالية: gif, png, jpg. Max file size 2Mb</span>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-lg-3 control-label">الصورة السابقة:</label>
                                <div class="col-lg-3" id="user-block" style="    width: auto;padding: 0;margin: 0px;">
                                    <img src="{{asset('images/default_user.png')}}" id="user_img" alt="">
                                </div>
                                <div class="col-lg-3"></div>
                                <div class="col-lg-3"> </div>
                            </div>


                            <div class="text-right">
                                <button type="submit"  class="btn btn-primary">
                                    <i class=" icon-floppy-disk position-right" style="margin-top: 2px"></i>
                                    حفظ التغييرات
                                    <i class="icon-spinner2 spinner position-left hide loader" style="margin-top: 3px;float: left;"></i>
                                </button>
                            </div>
                        </div>


                    </div>
                    <div class="blockui-animation-container">
                        <span class="text-semibold"><i class="icon-spinner10 spinner no-edge-top"></i></span>
                    </div>
                </form>

            </div>

            <div class="col-lg-5">
                <div class="panel panel-flat">
                    <div class="panel-heading">
                        <h6 class="panel-title">Daily sales stats</h6>
                        <button type="button" class="btn bg-green-400 btn-labeled new-user-btn" style="float:left;margin-top: -25px;">
                            <b><i class=" icon-user-plus"></i></b> جديد
                        </button>
                        <div class="heading-elements">

                            <span class="heading-text">قائمة المستخدمين</span>

                        </div>
                    </div>

                    <div class="panel-body">
                        <div id="sales-heatmap"></div>
                    </div>

                    <div class="table-responsive" style="height: 405px;overflow: auto;max-height: 405px;">
                        <table class="table text-nowrap" id="users-table">
                            <thead>
                            <tr>
                                <th>المستخدم</th>
                                <th>تاريخ التسجيل</th>
                                <th>عمليات</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($users_array as $item)
                                @if($item['is_delete'] == 0)
                            <tr>
                                <td>
                                    <div class="media-left media-middle" style="padding-right: 0px;">

                                        <img style="border-radius: 50%" src="@if($item['img'] != "default_user.png")  {{ asset('uploads/users/' . $item['img']) }} @else
{{ asset('images/default_user.png' ) }} @endif" alt=""/>
                                    </div>

                                    <div class="media-body" style="width: 0px">
                                        <div class="media-heading">
                                            <a href="#" class="letter-icon-title update-user-btn-sub">{{ $item['name'] }}</a>
                                            <input type="hidden" name="user_id" class="user_id" value="{{$item['id']}}" /></h6>
                                        </div>

                                        <div class="text-muted text-size-small"><i class="icon-phone text-size-mini position-left"></i> {{ $item['phone'] }}</div>
                                    </div>
                                </td>
                                <td>
                                    <span class="text-muted text-size-small">{{ $item['created_at'] }}</span>
                                </td>
                                <td>
                                    <h6 class="text-semibold no-margin">

                                        <a href="#"  class="update-user-btn" data-popup="tooltip" title="تعديل">
                                            <i class="  icon-pencil7 update-icon"></i>
                                        </a>
                                        <a href="#"  class="sweet_combine" data-popup="tooltip" title="حذف">
                                            <i class=" icon-user-cancel delete-icon"></i>
                                        </a>


                                        <input type="hidden" name="user_id" class="user_id" value="{{$item['id']}}" /></h6>
                                </td>
                            </tr>
                            @endif
                            @endforeach


                            </tbody>
                        </table>
                    </div>
                </div>


            </div>
        </div>
        <!-- /main charts -->


    </div>


        <!-- Footer -->

 @endsection


