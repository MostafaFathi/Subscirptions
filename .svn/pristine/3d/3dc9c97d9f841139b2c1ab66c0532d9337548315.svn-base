@extends('layouts.main',['title' => 'إدارة الفروع' , 'js'=>'branches'])

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
        <div class="col-lg-6">
            {{--add users form --}}
            <form action="post" id="branch_submit_form" class="form-horizontal form-validate-jquery" enctype="multipart/form-data">
                {{ csrf_field() }}
                <div class="panel panel-flat">
                    <div class="panel-heading">
                        <h5 class="panel-title">إضافة أو تعديل</h5>

                    </div>

                    <div class="panel-body">

                        <div class="form-group">
                            <label class="col-lg-3 control-label">إسم المركز:</label>
                            <div class="col-lg-9">
                                {{--<input type="text" id="name" name="name" class="form-control" placeholder="mhilles">--}}
                                {{ $center_info['center_name'] }}

                            </div>
                        </div>

                        <div class="form-group">
                            <label class="col-lg-3 control-label">إسم الفرع:</label>
                            <div class="col-lg-9">
                                <input type="text" id="branch_name" name="branch_name" class="form-control" placeholder="الفرع الأول ">

                            </div>
                        </div>

                        <div class="form-group">
                            <label class="col-lg-3 control-label">إسم العنوان:</label>
                            <div class="col-lg-9">
                                <input type="text" id="branch_address" name="branch_address" class="form-control" placeholder="غزة-تل الهوا ">

                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-lg-3 control-label">رقم الجوال:</label>
                            <div class="col-lg-9">
                                <input type="number" id="branch_phone" name="branch_phone" class="form-control" placeholder="0599112233">
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
            <form action="post" id="branch_update_form" class="form-horizontal form-validate-jquery hide" enctype="multipart/form-data">
                {{ csrf_field() }}
                <div class="panel panel-flat " id="branch_update_container" >
                    <div class="panel-heading">
                        <h5 class="panel-title">  تعديل الفروع </h5>

                    </div>

                    <div class="panel-body">
                        <div class="form-group " >

                            <div class="form-group">
                                <label class="col-lg-3 control-label">إسم المركز:</label>
                                <div class="col-lg-9">
                                    {{--<input type="text" id="name" name="name" class="form-control" placeholder="mhilles">--}}
                                    {{ $center_info['center_name'] }}

                                </div>
                            </div>

                            <div class="form-group">
                                <label class="col-lg-3 control-label">إسم الفرع:</label>
                                <div class="col-lg-9">
                                    <input type="text" id="branch_name" name="branch_name" class="form-control" placeholder="الفرع الأول ">
                                    <input type="hidden" id="branch_id" name="branch_id"/>

                                </div>
                            </div>

                            <div class="form-group">
                                <label class="col-lg-3 control-label">إسم العنوان:</label>
                                <div class="col-lg-9">
                                    <input type="text" id="branch_address" name="branch_address" class="form-control" placeholder="غزة-تل الهوا ">

                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-lg-3 control-label">رقم الجوال:</label>
                                <div class="col-lg-9">
                                    <input type="number" id="branch_phone" name="branch_phone" class="form-control" placeholder="0599112233">
                                </div>
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
                </div>
            </form>


        {{--end update users form--}}
        <!-- /traffic sources -->

        </div>


        <div class="col-lg-6">
            <div class="panel panel-flat">
                <div class="panel-heading">
                    <h6 class="panel-title">.</h6>
                    <button type="button" class="btn bg-green-400 btn-labeled new-branch-btn" style="float:left;margin-top: -25px;">
                        <b><i class=" icon-user-plus"></i></b> جديد
                    </button>

                    <div class="heading-elements">

                        <span class="heading-text">قائمة الفروع</span>

                    </div>
                </div>

                <div class="panel-body">
                    <div id="sales-heatmap"></div>
                </div>

                <div class="table-responsive " id="branch-block" style="height: 270px;overflow: auto;max-height: 270px;">
                    <table class="table text-nowrap" id="branch-table">
                        <thead>
                        <tr>
                            <th>اسم الفرع</th>
                            <th>تاريخ الاضافة</th>
                            <th>حذف</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($branches as $item)
                            <tr>
                                <td>
                                    <div class="media-left media-middle" style="padding-right: 0px;">
                                    </div>

                                    <div class="media-body" style="width: 0px">
                                        <div class="media-heading user-names">
                                            <a href="#" class="letter-icon-title update-branch-btn-sub">{{ $item['branch_name'] }}</a>
                                            <input type="hidden" name="user_id" class="user_id" value="{{$item['branch_id']}}" /></h6>
                                        </div>

                                        <div class="text-muted text-size-small"><i class="icon-phone text-size-mini position-left"></i> {{ $item['branch_phone'] }}</div>
                                    </div>
                                </td>
                                <td>
                                    <span class="text-muted text-size-small">{{ $item['created_at'] }}</span>
                                </td>
                                <td>
                                    <h6 class="text-semibold no-margin">
                                        <a href="#"  class="update-branch-btn" data-popup="tooltip" title="تعديل">
                                            <i class="  icon-pencil7 update-icon"></i>
                                        </a>
                                        <a href="#"  class="sweet_combine delete-and-migrate" data-popup="tooltip" title="حذف وترحيل">
                                            <i class="  icon-cancel-square" style=" color: #d84315;font-size: 18px;"></i>
                                        </a>
                                        <a href="#"  class="sweet_combine delete-finaly" data-popup="tooltip" title="حذف كلي">
                                            <i class="  icon-cancel-square2" style=" color: #d84315;font-size: 18px;"></i>
                                        </a>


                                        <input type="hidden" name="branch_id" class="branch_id" value="{{$item['branch_id']}}" /></h6>
                                </td>
                            </tr>
                        @endforeach


                        </tbody>
                    </table>
                </div>
            </div>


        </div>
    </div>
    <!-- /main charts -->





    <!-- Footer -->

@endsection


