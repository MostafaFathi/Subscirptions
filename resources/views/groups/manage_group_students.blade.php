@extends('layouts.main',['title' => 'طلاب المجموعة' , 'js'=>'groups'])

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
    <div class="col-lg-12">
        <div class="panel panel-flat">
            <div class="panel-heading">
                <h6 class="panel-title">.</h6>
                <a href="/groups/students/{{ $group_info->group_id }}/add" class="btn bg-green-400 btn-labeled new-center-btn" style="float:left;margin-top: -25px;">
                    <b><i class=" icon-user-plus"></i></b> إضافة طالب للمجموعة
                </a>

                <div class="heading-elements">

                    <span class="heading-text">طلاب مجموعة:
                    <span style="    font-size: 16px;">{{ $group_info->group_name }}</span>
                    </span>


                </div>

            </div>

            <div class="panel-body">
                <div id="sales-heatmap"></div>
                    <span class="info-header">
                        <span>عدد الطلاب: </span>
                        <span class="info-value-header">{{ count($group_students) }}</span>
                    </span>
                     <span class="info-header">
                        <span>تاريخ البدء: </span>
                        <span class="info-value-header">{{ $group_info->group_start_date }}</span>
                    </span>
                     <span class="info-header">
                        <span>مدرس المجموعة: </span>
                        <span class="info-value-header">{{ $group_info->teachers->emp_name }}</span>
                    </span>
            </div>

            <table class="table datatable-basic table-bordered dataTable no-footer" id="students-group-table">
                <thead>
                <tr>
                    <th>رقم</th>
                    <th>إسم الطالب</th>
                    <th>تاريخ التسجيل</th>
                    <th style="width:220px;">حالة الدفع</th>
                    <th style="width:140px;">قيمة الدفع</th>
                    <th>عمليات</th>
                </tr>
                </thead>
                <tbody>
                @foreach($group_students as $key => $item)
                    <tr class="show-details">
                        <td>{{ $key+1 }}</td>
                        <td>{{ $item->students->student_name }}</td>
                        {{--<td><span class="td-level-name">{{ $item->students->levels->level_name }}</span></td>--}}
                        {{--<td><span class="td-branch-name">{{ $item->students->branches->branch_name }}</span></td>--}}
                        <td><span class="td-reg-date">{{ $item->students->student_reg_date }}</span></td>
                        <td>
                    <form action="post"  class="form-horizontal form-validate-jquery student_update_payment_form" id="student_update_payment_form" enctype="multipart/form-data">
                        {{ csrf_field() }}
                            @if($item->payment_status == 'F')
                                <span class="td-payment-status label label-primary">
                                مدفوع كامل
                                </span>
                                @elseif($item->payment_status == 'P')
                                <span class="td-payment-status label label-warning">
                                مدفوع جزء
                                </span>
                                @else
                                <span class="td-payment-status label label-danger">
                               غير مدفوع
                                </span>
                                @endif

                            <span class="input-payment-status hide-something col-md-12">
                                <select name="payment_status" class="select payment_status " id="payment_status">
                                                <option @if($item->payment_status == 'F') selected="selected" @endif  value="F">مدفوع كلي</option>
                                                <option @if($item->payment_status == 'P') selected="selected" @endif  value="P">مدفوع جزئي</option>
                                                <option @if($item->payment_status == 'N') selected="selected" @endif  value="N">غير مدفوع</option>
                                </select>
                                <input type="hidden" name="student_id" value="{{ $item->student_id }}">
                            </span>

                            <span class="input-payment-value hide-something col-md-12" style="margin-top: 5px" >
                                <input type="number" class="form-control payemnt_value" name="payemnt_value" placeholder="قيمة الدفع.." value="{{ $item->payment_value }}">
                            </span>

                            <span class="edit-payments-span" style="position: relative;top: 10px;">
                                <a href="#" class="edit-payments-btn">
                                    <i class=" icon-pencil3" style="font-size: 12px;color: #808080;"></i>
                                </a>
                            </span>

                            <span class="save-payments-span hide-something col-md-12" style="position: relative;top: 10px;text-align: center;">
                                <button type="submit"  class="save-payments-btn btn btn-primary">
                                    <i class="icon-checkmark4" style=""></i>حفظ
                                    <i class="icon-spinner2 spinner position-left hide loader" style="margin-top: 3px;float: left;"></i>
                                </button>
                                <a  class="back-payments-btn btn btn-default">
                                    <i class="icon-redo2" style=""></i>
                                </a>
                            </span>
                    </form>
                        </td>
                        <td>
                            <span class="td-payment-value label label-info">
                            {{$item->payment_value}}
                            </span>

                        </td>
                        <td class="text-center">
                            <a href="#"  class="show-student-btn">
                                <i class="icon-grid52 show-icon"></i>
                            </a>
                            <a href="#"  class="delete-student-group-btn" style="margin: 0px 3px;">
                                <i class="  icon-cancel-square delete-icon" style=" color: #d84315;font-size: 18px;"></i>
                            </a>

                            <input type="hidden" name="student_id" class="student_id" value="{{$item->student_id}}" />
                            <input type="hidden" name="group_id" class="group_id" value="{{$item->group_id}}" />

                        </td>
                    </tr>

                    <tr class="hide-td details-rows">
                        <td colspan="6" class="custom-td-show" style="padding: 0px">
                            <div>
                                <form action="post"  class="form-horizontal form-validate-jquery student_update_form" enctype="multipart/form-data">
                                    {{ csrf_field() }}
                                    <input type="hidden" value="{{ $item->student_id }}" name="student_id" class="student_id">
                                    <div class="form-group img-div" style="margin-bottom: 0px;  margin-top: 10px; ">
                                        @if($item->students->student_gender == 'f')<?php $gender_img='f_student.png'; ?> @else <?php $gender_img='m_student.png'; ?> @endif
                                        <img src="{{asset('images/ui/'.$gender_img)}}" alt="">
                                    </div>
                                    <div class="form-group" style="margin-bottom: 7px;margin-top: 0px;">
                                        <label class="col-lg-3 ">
                                            <span class="labels">إسم الطالب: </span>
                                            <span class="input text_student_name">{{ $item->students->student_name }}</span>
                                        </label>

                                        <label class="col-lg-3">
                                            <span class="labels">عمل ولي الأمر: </span>
                                            <span  class="input text_student_father_work">{{ $item->students->student_father_work }}</span>
                                        </label>

                                        <label class="col-lg-3">
                                            <span class="labels">رقم هاتف (جوال)1: </span>
                                            <span  class="input text_student_phone">{{ $item->students->student_phone }}</span>
                                        </label>

                                        <label class="col-lg-3">
                                            <span class="labels">رقم هاتف (جوال)2: </span>
                                            <span  class="input text_student_phone2">{{ $item->students->student_phone2 }}</span>
                                        </label>

                                    </div>
                                    <div class="form-group" style="margin-bottom: 7px;">
                                        <label class="col-lg-3 ">
                                            <span class="labels">الجنس: </span>
                                            <span  class="input text_student_gender">@if($item->students->student_gender == 'f'){{ 'أنثى' }} @else {{ 'ذكر' }} @endif</span>

                                        </label>

                                        <label class="col-lg-3">
                                            <span class="labels">عُمر الطالب: </span>
                                            <span class="input text_student_age">{{ $item->students->student_age }}</span>
                                        </label>

                                        <label class="col-lg-3">
                                            <span class="labels">مكان الدراسة: </span>
                                            <span class="input text_student_school">{{ $item->students->student_school }}</span>
                                        </label>

                                        <label class="col-lg-3">
                                            <span class="labels">العنوان: </span>
                                            <span class="input text_student_address">{{ $item->students->student_address }}</span>
                                        </label>

                                    </div>
                                    <div class="form-group" style="margin-bottom: 7px;">
                                        <label class="col-lg-3 ">
                                            <span class="labels">تاريخ التسجيل: </span>
                                            <span  class="input text_student_reg_date">{{ $item->students->student_reg_date }}</span>

                                        </label>

                                        <label class="col-lg-3">
                                            <span class="labels">المستوى: </span>
                                            <span class="input text_level_name">{{ $item->students->levels->level_name }}</span>


                                        </label>

                                        <label class="col-lg-3">
                                            <span class="labels">الفرع: </span>
                                            <span class="input text_branch_name">{{ $item->students->branches->branch_name }}</span>


                                        </label>



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


