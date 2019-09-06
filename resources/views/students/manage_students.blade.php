@extends('layouts.main',['title' => 'إدارة الطلاب' , 'js'=>'students'])

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

    <div class="col-lg-12">
        <div class="panel panel-flat">
            <div class="panel-heading">
                <h6 class="panel-title">.</h6>


                <div class="heading-elements">

                    <span class="heading-text">بحث</span>

                </div>
            </div>

            <div class="panel-body search-inputs">
                <form action="" class="form-inline">

                    <div class="col-lg-12">
                        <div class="row">
                            <label class="sr-only" for="inlineFormInputGroup">إسم الطالب:</label>
                    <div class="input-group mb-2 mr-sm-2 mb-sm-0">
                        <div class="input-group-addon">إسم الطالب:</div>
                        <input type="text" class="form-control" id="inlineFormInputGroup" placeholder="إسم الطالب">
                    </div>
                        </div>
                    </div>
                    <span class="show-advanced-search" style="display: none;">
                    <div class="col-lg-12" style="margin-top: 20px;">
                        <div class="row">

                            <label class="sr-only" for="inlineFormInputGroup">عمل ولي الامر:</label>
                            <div class="input-group mb-2 mr-sm-2 mb-sm-0">
                                <div class="input-group-addon">عمل ولي الامر:</div>
                                <input type="text" class="form-control" id="inlineFormInputGroup" placeholder="عمل ولي الامر">
                            </div>

                            <label class="sr-only" for="inlineFormInputGroup">العنوان:</label>
                            <div class="input-group mb-2 mr-sm-2 mb-sm-0">
                                <div class="input-group-addon">العنوان:</div>
                                <input type="text" class="form-control" id="inlineFormInputGroup" placeholder="العنوان">
                            </div>

                            <label class="sr-only" for="inlineFormInputGroup">رقم الهاتف (جوال) 1:</label>
                            <div class="input-group mb-2 mr-sm-2 mb-sm-0">
                                <div class="input-group-addon">رقم الهاتف (جوال) 1:</div>
                                <input type="text" class="form-control" id="inlineFormInputGroup" placeholder="رقم الهاتف (جوال) 1">
                            </div>


                        </div>
                    </div>
                    <div class="col-lg-12" style="margin-top: 10px;">
                        <div class="row">
                            <label class="sr-only" for="inlineFormInputGroup">رقم الهاتف (جوال) 2:</label>
                            <div class="input-group mb-2 mr-sm-2 mb-sm-0">
                                <div class="input-group-addon">رقم الهاتف (جوال) 2:</div>
                                <input type="text" class="form-control" id="inlineFormInputGroup" placeholder="رقم الهاتف (جوال) 2">
                            </div>

                            <label class="sr-only" for="inlineFormInputGroup">عمر الطالب:</label>
                            <div class="input-group mb-2 mr-sm-2 mb-sm-0">
                                <div class="input-group-addon">عمر الطالب:</div>
                                <input type="text" class="form-control" id="inlineFormInputGroup" placeholder="عمر الطالب">
                            </div>


                            <label class="sr-only" for="inlineFormInputGroup">الجنس:</label>
                            <div class="input-group mb-2 mr-sm-2 mb-sm-0">
                                <div class="input-group-addon">الجنس:</div>
                                <select name="level_id" class="select-search" id="level_id">
                                    <option value="m">ذكر</option>
                                    <option value="f">أنثى</option>
                                </select>
                            </div>
                        </div>
                    </div>

                    <div class="col-lg-12" style="margin-top: 10px;">
                        <div class="row">

                            <label class="sr-only" for="inlineFormInputGroup">تاريخ التسجيل:</label>
                            <div class="input-group mb-2 mr-sm-2 mb-sm-0">
                                <div class="input-group-addon">تاريخ التسجيل:</div>
                                <input type="date" class="form-control" id="inlineFormInputGroup" placeholder="تاريخ التسجيل">
                            </div>

                            <label class="sr-only" for="inlineFormInputGroup">إسم المدرسة:</label>
                            <div class="input-group mb-2 mr-sm-2 mb-sm-0">
                                <div class="input-group-addon">إسم المدرسة:</div>
                                <input type="text" class="form-control" id="inlineFormInputGroup" placeholder="إسم المدرسة">
                            </div>

                            <label class="sr-only" for="inlineFormInputGroup">الفرع:</label>
                            <div class="input-group mb-4 mr-sm-4 mb-sm-0">
                                <div class="input-group-addon">الفرع:</div>
                                <select name="branch_id" class="select-search" id="branch_id">
                                    @foreach($branches as $item)
                                        <option value="{{ $item->branch->branch_id }}">{{ $item->branch->branch_name }}</option>
                                    @endforeach

                                </select>
                            </div>

                            <label class="sr-only" for="inlineFormInputGroup">المستوى:</label>
                            <div class="input-group mb-4 mr-sm-4 mb-sm-0">
                                <div class="input-group-addon">المستوى:</div>
                                <select name="level_id" class="select-search" id="level_id">
                                    @foreach($levels as $item)
                                        <option value="{{ $item->level_id }}">{{ $item->level_name }}</option>
                                    @endforeach

                                </select>
                            </div>



                        </div>
                    </div>
                    </span>
                    <div class="col-lg-12" style="margin-top: 30px;">
                        <div class="row">
                    <a href="/students" class="btn  btn-primary" style="float:left;margin-top: -25px;">
                        <b><i class=" icon-search4"></i></b> بحث
                    </a>
                    <a href="/students" class="advanced-search-btn btn" style="float:left;margin-top: -25px;">
                        <b><i class=" icon-search4"></i></b> بحث متقدم
                    </a>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <!-- Main charts -->
    <div class="col-lg-12">
        <div class="panel panel-flat">
            <div class="panel-heading">
                <h6 class="panel-title">.</h6>
                <a href="/students" class="btn bg-green-400 btn-labeled new-center-btn" style="float:left;margin-top: -25px;">
                    <b><i class=" icon-user-plus"></i></b> جديد
                </a>

                <div class="heading-elements">

                    <span class="heading-text">قائمة الطلاب</span>

                </div>
            </div>

            <div class="panel-body">
                <div id="sales-heatmap"></div>
            </div>

            <table class="table datatable-basic table-bordered dataTable no-footer" id="students-table">
                <thead>
                <tr>
                    <th>رقم</th>
                    <th>إسم الطالب</th>
                    <th>المستوى</th>
                    <th>الفرع</th>
                    <th>تاريخ التسجيل</th>
                    {{--<th>عمل ولي الأمر</th>--}}
                    {{--<th>رقم هاتف (جوال)1</th>--}}
                    {{--<th>رقم هاتف (جوال)2</th>--}}
                    <th>عمليات</th>
                </tr>
                </thead>
                <tbody>
                @foreach($all_students as $key => $item)
                    <tr class="show-details">
                        <td>{{ $key+1 }}</td>
                        <td>{{ $item->student_name }}</td>
                        <td><span class="td-level-name">{{ $item->levels->level_name }}</span></td>
                        <td><span class="td-branch-name">{{ $item->branches->branch_name }}</span></td>
                        <td><span class="td-reg-date">{{ $item->student_reg_date }}</span></td>
                        {{--<td>{{ $item->student_father_work }}</td>--}}
                        {{--<td>{{ $item->student_phone }}</td>--}}
                        {{--<td>{{ $item->student_phone2 }}</td>--}}
                        <td class="text-center">
                            <a href="#"  class="show-student-btn">
                                <i class="icon-grid52 show-icon"></i>
                            </a>
                            <a href="#"  class="update-student-btn">
                                <i class="  icon-pencil7 update-icon"></i>
                            </a>
                            <a href="#"  class="delete-student-btn" style="margin: 0px 3px;">
                                <i class="  icon-cancel-square delete-icon" style=" color: #d84315;font-size: 18px;"></i>
                            </a>

                            {{--<a href="#"  class="sweet_combine">--}}
                            {{--<i class="  icon-cancel-square" style=" color: #d84315;font-size: 18px;"></i>--}}
                            {{--</a>--}}
                            <input type="hidden" name="student_id" class="student_id" value="{{$item->student_id}}" />

                        </td>
                    </tr>
                    <tr class="hide-td details-rows">
                        <td colspan="6" class="custom-td-show" style="padding: 0px">
                            <div>
                                <form action="post"  class="form-horizontal form-validate-jquery student_update_form" enctype="multipart/form-data">
                                   {{ csrf_field() }}
                                    <input type="hidden" value="{{ $item->student_id }}" name="student_id" class="student_id">
                                <div class="form-group img-div" style="margin-bottom: 0px;  margin-top: 10px; ">
                                    @if($item->student_gender == 'f')<?php $gender_img='f_student.png'; ?> @else <?php $gender_img='m_student.png'; ?> @endif
                                    <img src="{{asset('images/ui/'.$gender_img)}}" alt="">
                                </div>
                                <div class="form-group" style="margin-bottom: 7px;margin-top: 0px;">
                                    <label class="col-lg-3 ">
                                        <span class="labels">إسم الطالب: </span>
                                        <span class="input text_student_name">{{ $item->student_name }}</span>
                                        <input type="text" name="student_name" class="student_name form-control input-hide" value="{{ $item->student_name }}" />
                                    </label>

                                    <label class="col-lg-3">
                                        <span class="labels">عمل ولي الأمر: </span>
                                        <span  class="input text_student_father_work">{{ $item->student_father_work }}</span>
                                        <input type="text" name="student_father_work" class="student_father_work form-control input-hide" value="{{ $item->student_father_work }}" />
                                    </label>

                                    <label class="col-lg-3">
                                        <span class="labels">رقم هاتف (جوال)1: </span>
                                        <span  class="input text_student_phone">{{ $item->student_phone }}</span>
                                        <input type="number" name="student_phone" class="student_phone form-control input-hide" value="{{ $item->student_phone }}" />
                                    </label>

                                    <label class="col-lg-3">
                                        <span class="labels">رقم هاتف (جوال)2: </span>
                                        <span  class="input text_student_phone2">{{ $item->student_phone2 }}</span>
                                        <input type="number" name="student_phone2" class="student_phone2 form-control input-hide" value="{{ $item->student_phone2 }}" />
                                    </label>

                                </div>
                                <div class="form-group" style="margin-bottom: 7px;">
                                    <label class="col-lg-3 ">
                                        <span class="labels">الجنس: </span>
                                        <span  class="input text_student_gender">@if($item->student_gender == 'f'){{ 'أنثى' }} @else {{ 'ذكر' }} @endif</span>
                                        <span class="input-hide">
                                            <div class="form-group">
                                        <div class="col-lg-12">

                                            <label class="radio-inline">
                                                <input type="radio"  id="student_gender"  class="styled student_gender student_gender_m" name="student_gender" @if($item->student_gender == 'm') checked="checked"  @endif value="m"/>
                                                ذكر
                                            </label>

                                            <label class="radio-inline">
                                                <input type="radio" id="student_gender" class="styled student_gender student_gender_f" name="student_gender" @if($item->student_gender == 'f') checked="checked" @endif value="f"/>
                                                أنثى
                                            </label>
                                        </div>
                                            </div>
                                        </span>
                                     </label>

                                    <label class="col-lg-3">
                                        <span class="labels">عُمر الطالب: </span>
                                        <span class="input text_student_age">{{ $item->student_age }}</span>
                                        <input type="number" name="student_age" class="student_age form-control input-hide" value="{{ $item->student_age }}" />
                                    </label>

                                    <label class="col-lg-3">
                                        <span class="labels">مكان الدراسة: </span>
                                        <span class="input text_student_school">{{ $item->student_school }}</span>
                                        <input type="text" name="student_school" class="student_school form-control input-hide" value="{{ $item->student_school }}" />
                                    </label>

                                    <label class="col-lg-3">
                                        <span class="labels">العنوان: </span>
                                        <span class="input text_student_address">{{ $item->student_address }}</span>
                                        <input type="text" name="student_address" class="student_address form-control input-hide" value="{{ $item->student_address }}" />
                                    </label>

                                </div>
                                <div class="form-group" style="margin-bottom: 7px;">
                                        <label class="col-lg-3 ">
                                            <span class="labels">تاريخ التسجيل: </span>
                                            <span  class="input text_student_reg_date">{{ $item->student_reg_date }}</span>
                                            <span class="input-hide">
                                            <input type="date" name="student_reg_date" class="student_reg_date form-control input-hide" value="{{ $item->student_reg_date }}" />
                                        </span>
                                        </label>

                                    <label class="col-lg-3">
                                        <span class="labels">المستوى: </span>
                                        <span class="input text_level_name">{{ $item->levels->level_name }}</span>
                                        <span class="input-hide">
                                            <div class="col-lg-12">
                                                <select name="level_id" class="select-search" id="level_id">
                                                    @foreach($levels as $item2)
                                                        <option value="{{ $item2->level_id }}" @if($item->level_id == $item2->level_id) selected="selected" @endif>{{ $item2->level_name }}</option>
                                                    @endforeach

                                                </select>
                                            </div>
                                            </span>

                                    </label>

                                    <label class="col-lg-3">
                                        <span class="labels">الفرع: </span>
                                        <span class="input text_branch_name">{{ $item->branches->branch_name }}</span>
                                        <span class="input-hide">
                                            <div class="col-lg-12">
                                                <select name="branch_id" class="select-search" id="branch_id">
                                                @foreach($branches as $item2)
                                                    <option value="{{ $item2->branch->branch_id }}" @if($item->branch_id == $item2->branch->branch_id) selected="selected" @endif>{{ $item2->branch->branch_name }}</option>
                                                    @endforeach

                                                    </select>
                                            </div>
                                            </span>

                                    </label>



                                    </div>
                                    <div class="text-right">
                                        <button type="submit"  class="btn btn-primary update-button">
                                            <i class=" icon-floppy-disk position-right" style="margin-top: 2px"></i>
حفظ التغييرات
                                            <i class="icon-spinner2 spinner position-left hide loader" style="margin-top: 3px;float: left;"></i>
                                        </button>
                                    </div>
                                </form>
                            </div>
                        </td>
                    </tr>
                @endforeach


                </tbody>
            </table>


        </div>
    </div>


<script>
//    if($('.student-gender_m').prop('checked')){
//        $('.student-gender_m').parent().addClass('checked');
//    }
//    if($('.student-gender_f').prop('checked')){
//        $('.student-gender_f').parent().addClass('checked');
//    }
</script>
    <!-- Footer -->

@endsection


