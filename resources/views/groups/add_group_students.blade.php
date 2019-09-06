@extends('layouts.main',['title' => 'إضافة مجموعة جديدة' , 'js'=>'groups'])

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
            <a href="/groups/{{ $group_id }}/students" class="group_href_link" style="display: none;"></a>
            <form action="post" id="group_student_submit_form" class="form-horizontal form-validate-jquery" enctype="multipart/form-data">
                {{ csrf_field() }}
                <a href="#" class="blockMe" style="display: none"></a>
                <div class="panel panel-flat" id="table-block">
                    <div class="panel-heading">
                        <h5 class="panel-title">إضافة طلاب على المجموعة</h5>

                    </div>

                    <div class="panel-body">

                        <div class="form-group">
                            <label class="col-lg-2 control-label"> إختر الطلاب:</label>
                            <div class="col-lg-5">
                                <input type="hidden" name="group_id" value="{{ $group_id }}">
                                <select name="student_select_name" class="select-search  student_select_name" id="student_select_name">
                                    <option class="select2-disabled">إختر</option>
                                    @foreach($students as $item)
                                        <option value="{{ $item->student_id }}"><span class="student-select-name">{{ $item->student_name }}</span></option>
                                    @endforeach

                                </select>
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="col-lg-2 control-label">قائمة الطلاب:</label>
                            <div class="col-lg-6">
                                <table class="table table-bordered table-students">
                                    <thead>
                                    <th style="width:50px">عمليات</th>
                                    <th>إسم الطالب</th>
                                    <th style="width:130px">حالة الدفع</th>
                                    <th style="width:150px">قيمة الدفع</th>
                                    </thead>
                                    <tbody>
                                    @foreach($group_students as $item)
                                        <tr>
                                            <td>--</td>
                                            <td>{{ $item->students->student_name }}</td>
                                            <td>
                                                @if($item->payment_status == 'F')
                                                    مدفوع كلي
                                                    @elseif($item->payment_status == 'P')
                                                    مدفوع جزئي
                                                @else
                                                    غير مدفوع
                                                @endif
                                            </td>
                                            <td>{{ $item->payment_value }}</td>
                                        </tr>
                                    @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>





                        <div class="text-right">
                            <button type="submit"  class="btn btn-primary " id="add-button">
                                <i class=" icon-floppy-disk position-right" style="margin-top: 2px"></i>
                                إضافة جديد
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


    <!-- Footer -->

@endsection


