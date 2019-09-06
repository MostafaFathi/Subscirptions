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
            <form action="post" id="group_submit_form" class="form-horizontal form-validate-jquery" enctype="multipart/form-data">
                {{ csrf_field() }}
                <a href="#" class="blockMe" style="display: none"></a>
                <div class="panel panel-flat" id="table-block">
                    <div class="panel-heading">
                        <h5 class="panel-title">إضافة مجموعة جديدة</h5>

                    </div>

                    <div class="panel-body">

                        <div class="form-group">
                            <label class="col-lg-2 control-label">إسم المجموعة:</label>
                            <div class="col-lg-5">
                                <input type="text" id="group_name" name="group_name"  class="form-control" placeholder="إسم المجموعة .." >

                            </div>
                        </div>

                        <div class="form-group">
                            <label class="col-lg-2 control-label">المُدرس</label>
                            <div class="col-lg-5">
                                <select name="emp_id" class="select-search" id="emp_id">
                                    @foreach($teachers as $item)
                                        <option value="{{ $item->emp_id }}">{{ $item->emp_name }}</option>
                                    @endforeach

                                </select>
                            </div>
                        </div>


                                <div class="form-group">
                                    <label class="col-lg-2 control-label">المواعيد: </label>
                                    <div class="row appointment-rows">
                                        <div class="col-md-6">
                                           <div class="row">
                                               <div class="col-md-2">
                                                <div class="checkbox">
                                                    <label class="days-label">
                                                        <input type="checkbox" class="control-primary day_no" name="day_time[1][]" value="1">
                                                        السبت
                                                    </label>
                                                </div>
                                               </div>
                                               <div class="col-md-6 form-inline">
                                                   <div class="form-group">
                                                       <label for="time" class="control-label time-label">من</label>
                                                       <input type="time" class="form-control col-md-6 time_from" name="day_time[1][]" disabled="disabled">
                                                   </div>
                                                   <div class="form-group">
                                                       <label class="time-label">إلى</label>
                                                       <input type="time" class="form-control col-md-6 time_to" name="day_time[1][]"disabled="disabled">
                                               </div>
                                               </div>
                                           </div>

                                            <div class="row">
                                                <div class="col-md-2">
                                                    <div class="checkbox">
                                                        <label class="days-label">
                                                            <input type="checkbox" class="control-primary day_no" name="day_time[2][]" value="2">
                                                                       الأحد
                                                        </label>
                                                    </div>
                                                </div>
                                                <div class="col-md-6 form-inline">
                                                    <div class="form-group">
                                                        <label for="time" class="control-label time-label">من</label>
                                                        <input type="time" class="form-control col-md-6 time_from" name="day_time[2][]"disabled="disabled">
                                                    </div>
                                                    <div class="form-group">
                                                        <label class="time-label">إلى</label>
                                                        <input type="time" class="form-control col-md-6 time_to" name="day_time[2][]"disabled="disabled">
                                                    </div>
                                                </div>
                                            </div>


                                            <div class="row">
                                                <div class="col-md-2">
                                                    <div class="checkbox">
                                                        <label class="days-label">
                                                            <input type="checkbox" class="control-primary day_no" name="day_time[3][]" value="3">
                                                            الإثنين
                                                        </label>
                                                    </div>
                                                </div>
                                                <div class="col-md-6 form-inline">
                                                    <div class="form-group">
                                                        <label for="time" class="control-label time-label">من</label>
                                                        <input type="time" class="form-control col-md-6 time_from" name="day_time[3][]"disabled="disabled">
                                                    </div>
                                                    <div class="form-group">
                                                        <label class="time-label">إلى</label>
                                                        <input type="time" class="form-control col-md-6 time_to" name="day_time[3][]"disabled="disabled">
                                                    </div>
                                                </div>
                                            </div>



                                            <div class="row">
                                                <div class="col-md-2">
                                                    <div class="checkbox">
                                                        <label class="days-label">
                                                            <input type="checkbox" class="control-primary day_no" name="day_time[4][]" value="4">
                                                            الثلاثاء
                                                        </label>
                                                    </div>
                                                </div>
                                                <div class="col-md-6 form-inline">
                                                    <div class="form-group">
                                                        <label for="time" class="control-label time-label">من</label>
                                                        <input type="time" class="form-control col-md-6 time_from" name="day_time[4][]"disabled="disabled">
                                                    </div>
                                                    <div class="form-group">
                                                        <label class="time-label">إلى</label>
                                                        <input type="time" class="form-control col-md-6 time_to" name="day_time[4][]"disabled="disabled">
                                                    </div>
                                                </div>
                                            </div>



                                            <div class="row">
                                                <div class="col-md-2">
                                                    <div class="checkbox">
                                                        <label class="days-label">
                                                            <input type="checkbox" class="control-primary day_no" name="day_time[5][]" value="5">
                                                            الأربعاء
                                                        </label>
                                                    </div>
                                                </div>
                                                <div class="col-md-6 form-inline">
                                                    <div class="form-group">
                                                        <label for="time" class="control-label time-label">من</label>
                                                        <input type="time" class="form-control col-md-6 time_from" name="day_time[5][]"disabled="disabled">
                                                    </div>
                                                    <div class="form-group">
                                                        <label class="time-label">إلى</label>
                                                        <input type="time" class="form-control col-md-6 time_to" name="day_time[5][]"disabled="disabled">
                                                    </div>
                                                </div>
                                            </div>


                                            <div class="row">
                                                <div class="col-md-2">
                                                    <div class="checkbox">
                                                        <label class="days-label">
                                                            <input type="checkbox" class="control-primary day_no" name="day_time[6][]" value="6">
                                                            الخميس
                                                        </label>
                                                    </div>
                                                </div>
                                                <div class="col-md-6 form-inline">
                                                    <div class="form-group">
                                                        <label for="time" class="control-label time-label">من</label>
                                                        <input type="time" class="form-control col-md-6 time_from" name="day_time[6][]"disabled="disabled">
                                                    </div>
                                                    <div class="form-group">
                                                        <label class="time-label">إلى</label>
                                                        <input type="time" class="form-control col-md-6 time_to" name="day_time[6][]"disabled="disabled">
                                                    </div>
                                                </div>
                                            </div>


                                        </div>

                                    </div>
                                </div>


                        <div class="form-group">
                            <label class="col-lg-2 control-label">تاريخ البدء:</label>
                            <div class="col-lg-5">
                                <input type="date" id="group_start_date" name="group_start_date"value="{{ $date_now }}"  class="form-control" placeholder="تاريخ البدء الحقيقي .." >

                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-lg-2 control-label"> الفرع</label>
                            <div class="col-lg-5">
                                <select name="branch_id" class="select-search" id="branch_id">
                                    @foreach($branches as $item)
                                        <option value="{{ $item->branch->branch_id }}">{{ $item->branch->branch_name }}</option>
                                    @endforeach

                                </select>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-lg-2 control-label"> إختر الطلاب:</label>
                            <div class="col-lg-5">
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


