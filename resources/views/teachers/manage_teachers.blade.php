@extends('layouts.main',['title' => 'إدارة الموظفين' , 'js'=>'teachers'])

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
                <a href="/teachers" class="btn bg-green-400 btn-labeled new-center-btn" style="float:left;margin-top: -25px;">
                    <b><i class=" icon-user-plus"></i></b> جديد
                </a>

                <div class="heading-elements">

                    <span class="heading-text">قائمة الموظفين</span>

                </div>
            </div>

            <div class="panel-body">
                <div id="sales-heatmap"></div>
            </div>

            <table class="table datatable-show-all" id="teachers-table">
                <thead>
                <tr>
                    <th>رقم</th>
                    <th>إسم الموظف</th>
                    <th>نوع الموظف</th>
                    <th>التخصص</th>
                    <th>الفرع</th>
                    <th>عمليات</th>
                </tr>
                </thead>
                <tbody>
                @foreach($all_teachers as $key => $item)
                    <tr class="show-details">
                        <td>{{ $key+1 }}</td>
                        <td>
                            @if($item->emp_gender == 'f')<?php $gender_img='f_teacher.png'; ?> @else <?php $gender_img='m_teacher.png'; ?> @endif
                            <img src="{{asset('images/ui/'.$gender_img)}}" alt="" style="    width: 35px;">
                                {{ $item->emp_name }}</td>
                        <td><span class="td-job-name">{{ $item->job->job_name }}</span></td>
                        <td><span class="td-emp-specialist">{{ $item->emp_specialist }}</span></td>
                        <td><span class="td-branch-name">{{ $item->branches->branch_name }}</span></td>

                        <td class="text-center">
                            <a href="#"  class="show-teacher-btn">
                                <i class="icon-grid52 show-icon"></i>
                            </a>
                            <a href="#"  class="update-teacher-btn">
                                <i class="  icon-pencil7 update-icon"></i>
                            </a>
                            <a href="#"  class="delete-teacher-btn" style="margin: 0px 3px;">
                                <i class="  icon-cancel-square delete-icon" style=" color: #d84315;font-size: 18px;"></i>
                            </a>

                            {{--<a href="#"  class="sweet_combine">--}}
                            {{--<i class="  icon-cancel-square" style=" color: #d84315;font-size: 18px;"></i>--}}
                            {{--</a>--}}
                            <input type="hidden" name="student_id" class="student_id" value="{{$item->emp_id}}" />

                        </td>
                    </tr>
                    <tr class="hide-td details-rows">
                        <td colspan="6" class="custom-td-show" style="padding: 0px">
                            <div>
                                <form action="post"  class="form-horizontal form-validate-jquery teacher_update_form" enctype="multipart/form-data">
                                    {{ csrf_field() }}
                                    <input type="hidden" value="{{ $item->emp_id }}" name="emp_id" class="emp_id">
                                    <div class="form-group img-div" style="margin-bottom: 0px;  margin-top: 10px; ">
                                        @if($item->emp_gender == 'f')<?php $gender_img='f_teacher.png'; ?> @else <?php $gender_img='m_teacher.png'; ?> @endif
                                        <img src="{{asset('images/ui/'.$gender_img)}}" alt="">
                                    </div>
                                    <div class="form-group" style="margin-bottom: 7px;margin-top: 0px;">
                                        <label class="col-lg-3 ">
                                            <span class="labels">إسم الموظف: </span>
                                            <span class="input text_emp_name">{{ $item->emp_name }}</span>
                                            <input type="text" name="emp_name" class="emp_name form-control input-hide" value="{{ $item->emp_name }}" />
                                        </label>

                                        <label class="col-lg-3">
                                            <span class="labels">نوع الموظف: </span>
                                            <span class="input text_job_name">{{ $item->job->job_name }}</span>
                                            <span class="input-hide">
                                            <div class="col-lg-12">
                                                <select name="job_id" class="select-search" id="job_id">
                                                    @foreach($jobs as $item2)
                                                        <option value="{{ $item2->job_id }}" @if($item->job_id== $item2->job_id) selected="selected" @endif>{{ $item2->job_name }}</option>
                                                    @endforeach

                                                </select>
                                            </div>
                                            </span>

                                        </label>

                                        <label class="col-lg-3">
                                            <span class="labels">التخصص: </span>
                                            <span  class="input text_emp_specialist">{{ $item->emp_specialist }}</span>
                                            <input type="text" name="emp_specialist" class="emp_specialist form-control input-hide" value="{{ $item->emp_specialist }}" />
                                        </label>



                                        <label class="col-lg-3 ">
                                            <span class="labels">الجنس: </span>
                                            <span  class="input text_emp_gender">@if($item->emp_gender == 'f'){{ 'أنثى' }} @else {{ 'ذكر' }} @endif</span>
                                            <span class="input-hide">
                                            <div class="form-group">
                                        <div class="col-lg-12">

                                            <label class="radio-inline">
                                                <input type="radio"  id="emp_gender"  class="styled emp_gender emp_gender_m" name="emp_gender" @if($item->emp_gender  == 'm') checked="checked"  @endif value="m"/>
                                                ذكر
                                            </label>

                                            <label class="radio-inline">
                                                <input type="radio" id="emp_gender" class="styled emp_gender emp_gender_f" name="emp_gender" @if($item->emp_gender  == 'f') checked="checked" @endif value="f"/>
                                                أنثى
                                            </label>
                                        </div>
                                            </div>
                                        </span>
                                        </label>

                                    </div>
                                    <div class="form-group" style="margin-bottom: 7px;">


                                        <label class="col-lg-3">
                                            <span class="labels">عُمر الموظف: </span>
                                            <span class="input text_emp_age">{{ $item->emp_age }}</span>
                                            <input type="number" name="emp_age" class="emp_age form-control input-hide" value="{{ $item->emp_age  }}" />
                                        </label>

                                        <label class="col-lg-3">
                                            <span class="labels">سنوات الخبرة: </span>
                                            <span class="input text_emp_experiance">{{ $item->emp_experiance }}</span>
                                            <input type="text" name="emp_experiance" class="emp_experiance form-control input-hide" value="{{ $item->emp_experiance }}" />
                                        </label>
                                        <label class="col-lg-3">
                                            <span class="labels">رقم هاتف (جوال): </span>
                                            <span  class="input text_emp_phone">{{ $item->emp_phone }}</span>
                                            <input type="number" name="emp_phone" class="emp_phone form-control input-hide" value="{{ $item->emp_phone }}" />
                                        </label>
                                        <label class="col-lg-3">
                                            <span class="labels">البريد الإلكتروني: </span>
                                            <span class="input text_emp_email">{{ $item->emp_email }}</span>
                                            <input type="email" name="emp_email" class="emp_email form-control input-hide" value="{{ $item->emp_email }}" />
                                        </label>

                                    </div>
                                    <div class="form-group" style="margin-bottom: 7px;">




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


