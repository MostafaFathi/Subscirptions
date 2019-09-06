@extends('layouts.main',['title' => 'إدارة الصلاحيات' , 'js'=>'permissions'])

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
        <div class="col-lg-12">
            {{--add users form --}}
            <form action="post" id="permissions_submit_form" class="form-horizontal form-validate-jquery" enctype="multipart/form-data">
                {{ csrf_field() }}
                <a href="#" class="blockMe" style="display: none"></a>
                <div class="panel panel-flat" id="table-block">
                    <div class="panel-heading">
                        <h5 class="panel-title">إضافة أو تعديل الصلاحيات</h5>

                    </div>

                    <div class="panel-body">
                        <div class="form-group">
                            <label class="col-lg-2 control-label">إسم الصلاحية:</label>
                            <div class="col-lg-5">
                                <input type="text" id="permission_name" name="permission_name" value="" class="form-control" placeholder="اسم الصلاحية" >

                            </div>
                        </div>

                        <div class="form-group">
                            <label class="col-lg-2 control-label">نوع الصلاحية</label>
                            <div class="col-lg-5">
                            <select name="permission_type"  id="permission_type" class="select">
                                    <option value="parent">أب</option>
                                    <option value="child">إبن</option>
                            </select>
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="col-lg-2 control-label">إختر الصلاحية الأب</label>
                            <div class="col-lg-5">
                            <select name="permission_parent_no" class="select-search" id="permission_parent_no">
                                @foreach($parent_permissions as $item)
                                    @if($item->is_operation == 0)
                                    <option value="{{ $item->permission_no }}">{{ $item->permission_name }}</option>
                                    @endif
                                @endforeach

                            </select>
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="col-lg-2 control-label">العمليات</label>
                            <div class="col-lg-5">
                            <select name="permission_operations[]" multiple="multiple" id="permission_operations" class="select">
                                <option value="Add" selected="selected">إضافة</option>
                                <option value="Edit" selected="selected">تعديل</option>
                                <option value="Delete" selected="selected">حذف</option>
                                <option value="Show" selected="selected">عرض</option>
                                <option value="Credence" selected="selected">إعتماد</option>
                                <option value="Grant" selected="selected">منح</option>
                            </select>
                            </div>
                        </div>



                        <div class="text-right">
                                <button type="submit"  class="btn btn-primary " id="add-button">
                                    <i class=" icon-floppy-disk position-right" style="margin-top: 2px"></i>
                                    إضافة جديد
                                    <i class="icon-spinner2 spinner position-left hide loader" style="margin-top: 3px;float: left;"></i>
                                </button>
                            <button type="submit"  class="btn btn-primary " id="update-button">
                                <i class=" icon-floppy-disk position-right" style="margin-top: 2px"></i>
                                حفظ التغييرات
                                <i class="icon-spinner2 spinner position-left hide loader" style="margin-top: 3px;float: left;"></i>
                            </button>
                        </div>

                    </div>
                </div>
            </form>
        {{--end add users form--}}

        {{--update users form--}}
        {{--end update users form--}}
        <!-- /traffic sources -->

        </div>


    </div>

        <div class="col-lg-12">
            <div class="panel panel-flat">
                <div class="panel-heading">
                    <h6 class="panel-title">Daily sales stats</h6>
                    <button type="button" class="btn bg-green-400 btn-labeled new-permission-btn" style="float:left;margin-top: -25px;">
                        <b><i class=" icon-user-plus"></i></b> جديد
                    </button>

                    <div class="heading-elements">

                        <span class="heading-text">قائمة الصلاحيات المضافة</span>

                    </div>
                </div>

                <div class="panel-body">
                    <div id="sales-heatmap"></div>
                </div>

                <table class="table datatable-show-all">
                    <thead>
                    <tr>
                        <th>إسم الصلاحية</th>
                        <th>النوع</th>
                        <th>الصلاحية الاب</th>
                        <th>العمليات المتاحة </th>
                        <th>عمليات</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($all_permissions as $item)
                        <tr>
                            <td>{{ $item->row_name }}</td>
                             <td>{{ $item->row_type }}</td>
                            <td>{{ $item->parent_name }}</td>
                            <td></td>
                            <td class="text-center">

                                <a href="#"  class="update-permission-btn">
                                    <i class="  icon-pencil7 update-icon"></i>
                                </a>
                                {{--<a href="#"  class="sweet_combine">--}}
                                {{--<i class="  icon-cancel-square" style=" color: #d84315;font-size: 18px;"></i>--}}
                                {{--</a>--}}
                                <input type="hidden" name="permission_no" class="permission_no" value="{{$item->row_no}}" />

                            </td>
                        </tr>
                    @endforeach


                    </tbody>
                </table>


            </div>
        </div>
    <!-- /main charts -->


    <!-- Footer -->

@endsection


