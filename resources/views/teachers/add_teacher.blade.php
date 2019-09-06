@extends('layouts.main',['title' => 'إضافة موظف جديد' , 'js'=>'teachers'])

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
            <form action="post" id="teacher_submit_form" class="form-horizontal form-validate-jquery" enctype="multipart/form-data">
                {{ csrf_field() }}
                <a href="#" class="blockMe" style="display: none"></a>
                <div class="panel panel-flat" id="table-block">
                    <div class="panel-heading">
                        <h5 class="panel-title">إضافة موظف جديد</h5>

                    </div>

                    <div class="panel-body">
                        <div class="form-group">
                            <label class="col-lg-2 control-label">نوع الموظف</label>
                            <div class="col-lg-5">
                                <select name="job_id" class="select-search" id="job_id">
                                    @foreach($jobs as $item)
                                        <option value="{{ $item->job_id }}">{{ $item->job_name }}</option>
                                    @endforeach

                                </select>
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="col-lg-2 control-label">إسم الموظف:</label>
                            <div class="col-lg-5">
                                <input type="text" id="emp_name" name="emp_name"  class="form-control" placeholder="إسم الموظف .." >

                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-lg-2 control-label">الجنس:</label>
                            <div class="col-lg-9">
                                <label class="radio-inline">
                                    <input type="radio"  id="emp_gender"  class="styled emp_gender" name="emp_gender" checked="checked" value="m"/>
                                    ذكر
                                </label>

                                <label class="radio-inline">
                                    <input type="radio" id="emp_gender" class="styled emp_gender" name="emp_gender" value="f"/>
                                    أنثى
                                </label>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-lg-2 control-label">عُمر الموظف:</label>
                            <div class="col-lg-3">
                                <input type="number" id="emp_age" name="emp_age"  class="form-control" placeholder="عمر الموظف ..">
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-lg-2 control-label">التخصص:</label>
                            <div class="col-lg-5">
                                <input type="text" id="emp_specialist" name="emp_specialist"  class="form-control" placeholder="تخصص الموظف .." >

                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-lg-2 control-label">سنوات الخبرة:</label>
                            <div class="col-lg-3">
                                <input type="number" id="emp_experiance" name="emp_experiance"  class="form-control" placeholder="سنوات الخبرة..">
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="col-lg-2 control-label">البريد الإلكتروني:</label>
                            <div class="col-lg-5">
                                <input type="email" id="emp_email" name="emp_email" class="form-control" placeholder="عنوان البريد الإلكتروني..">
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-lg-2 control-label">رقم الهاتف (جوال):</label>
                            <div class="col-lg-3">
                                <input type="number" id="emp_phone" name="emp_phone"  class="form-control" placeholder="رقم الهاتف او الجوال..">
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


