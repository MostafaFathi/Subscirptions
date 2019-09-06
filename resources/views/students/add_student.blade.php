@extends('layouts.main',['title' => 'إضافة طالب جديد' , 'js'=>'students'])

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
            <form action="post" id="student_submit_form" class="form-horizontal form-validate-jquery" enctype="multipart/form-data">
                {{ csrf_field() }}
                <a href="#" class="blockMe" style="display: none"></a>
                <div class="panel panel-flat" id="table-block">
                    <div class="panel-heading">
                        <h5 class="panel-title">إضافة طالب جديد</h5>

                    </div>

                    <div class="panel-body">
                        <div class="form-group">
                            <label class="col-lg-2 control-label"></label>
                            <div class="col-lg-5 text-center" >

                                <img src="{{ asset('images/ui/m_student.png') }}" class="student-image" alt="student"/>
                                <span style="display: block;margin-top: 8px;">
                                <span class="student-name">الاسم: <span class="name" style="color: #2196f3;">إسم طالب جديد</span></span>
                                <br/>
                                <span class="student-gender">الجنس: <span class="gender" style="color: #2196f3;">ذكر</span></span>
                                <br/>
                                <span class="student-level">المستوى: <span class="level" style="color: #2196f3;"> الصف الأول</span>  </span>
                                </span>
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="col-lg-2 control-label">إسم الطالب:</label>
                            <div class="col-lg-5">
                                <input type="text" id="student_name" name="student_name"  class="form-control" placeholder="إسم الطالب .." >
                                <div class="input-search" style="display: none">
                                    <span class=" optimal-loader">
                                        <i class="icon-spinner2 spinner position-left"></i>
                                    </span>
                                    <ul class="list-unstyled">

                                        <li class="no-match-record" style="display: none;">لا يوجد نتائج</li>
                                    </ul>
                                </div>

                            </div>
                            <div class="col-lg-5">

                                <span style="display: none;" class="label label-danger registration-expired">إشتراك منتهي</span>
                                <input type="hidden" class="registration-expired-input" value="false"/>
                                <input type="hidden" class="student_id" id="student_id" name="student_id" value="0" />

                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-lg-2 control-label">عمل ولي الامر:</label>
                            <div class="col-lg-5">
                                <input type="text" id="student_father_work" name="student_father_work"  class="form-control" placeholder="عمل ولي الأمر .." >

                            </div>
                        </div>

                        <div class="form-group">
                            <label class="col-lg-2 control-label">العنوان:</label>
                            <div class="col-lg-5">
                                <input type="text" id="student_address" name="student_address" class="form-control" placeholder="عنوان سكن الطالب..">
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-lg-2 control-label">رقم الهاتف (جوال) 1:</label>
                            <div class="col-lg-3">
                                <input type="number" id="student_phone" name="student_phone"  class="form-control" placeholder="رقم الهاتف او الجوال..">
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-lg-2 control-label">رقم الهاتف (جوال) 2:</label>
                            <div class="col-lg-3">
                                <input type="number" id="student_phone2" name="student_phone2"  class="form-control" placeholder="رقم الهاتف او الجوال..">
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-lg-2 control-label">عمر الطالب:</label>
                            <div class="col-lg-1">
                                <input type="number" id="student_age" name="student_age"  class="form-control" placeholder="">
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="col-lg-2 control-label">الجنس:</label>
                            <div class="col-lg-9">
                                <label class="radio-inline">
                                    <input type="radio"  id="student_gender"  class="styled student_gender m_student_gender" name="student_gender" checked="checked" value="m"/>
                                    ذكر
                                </label>

                                <label class="radio-inline">
                                    <input type="radio" id="student_gender" class="styled student_gender f_student_gender" name="student_gender" value="f"/>
                                    أنثى
                                </label>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-lg-2 control-label">تاريخ التسجيل:</label>
                            <div class="col-lg-3">
                                <input type="date" id="student_reg_date" name="student_reg_date" value="{{ $date_now }}"  class="form-control" placeholder="تاريخ أول يوم للتسجيل..">

                            </div>
                            <div class="col-lg-5">

                                <span style="display: none;position: relative;top: 8px;" class="label label-default old-reg-date"></span>


                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-lg-2 control-label">إسم المدرسة:</label>
                            <div class="col-lg-5">
                                <input type="text" id="student_school" name="student_school" class="form-control" placeholder="إسم المدرسة التي يتعلم فيها الطالب..">
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-lg-2 control-label">إختر المستوى</label>
                            <div class="col-lg-5">
                                <select name="level_id" class="select-search" id="level_id">
                                    @foreach($levels as $item)
                                        <option value="{{ $item->level_id }}">{{ $item->level_name }}</option>
                                    @endforeach

                                </select>
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="col-lg-2 control-label">إختر الفرع</label>
                            <div class="col-lg-5">
                                <select name="branch_id" class="select-search" id="branch_id">
                                    @foreach($branches as $item)
                                        <option value="{{ $item->branch->branch_id }}">{{ $item->branch->branch_name }}</option>
                                    @endforeach

                                </select>
                            </div>
                        </div>

                        <div class="text-right">
                            <button type="button"  class="btn btn-primary bg-teal-400 " id="reset-button">
                                <i class=" icon-rotate-ccw3  position-right" style="margin-top: 2px"></i>
                                تفريغ
                                <i class="icon-spinner2 spinner position-left hide loader" style="margin-top: 3px;float: left;"></i>
                            </button>

                            <button type="submit"  class="btn btn-warning " id="renew-button">
                                <i class="icon-user-check  position-right" style="margin-top: 2px"></i>
                                تجديد الاشتراك
                                <i class="icon-spinner2 spinner position-left hide loader" style="margin-top: 3px;float: left;"></i>
                            </button>

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


