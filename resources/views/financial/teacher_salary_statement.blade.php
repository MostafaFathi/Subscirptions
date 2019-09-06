@extends('layouts.main',['title' =>  $data[0]->teachers->emp_name .'كشف راتب المدرس ' , 'js'=>'groups'])

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
                <a href="/groups" class="btn bg-green-400 btn-labeled new-center-btn" style="float:left;margin-top: -25px;">
                    <b><i class=" icon-user-plus"></i></b> إضافة مجموعة جديدة
                </a>

                <div style="    margin: 0 auto;font-size: 16px;text-align: center;">



                    @if(count($data)>0)
                        @if($data[0]->teachers->emp_gender == 'f')
                            <span>كشف راتب الاستاذة: </span>
                        @else
                            <span>كشف راتب الاستاذ: </span>
                        @endif

                        <span>
                              {{ $data[0]->teachers->emp_name }}
                        </span>
                    @endif

                </div>
            </div>

            <div class="panel-body">
                <div id="sales-heatmap"></div>
            </div>

            <?php
            $date = date("Y/m/d") ;
            $day = date('l', strtotime($date));
            ?>
            <table class="table datatable-show-all" id="groups-appointments-table">
                <thead>
                <tr>
                    <td colspan="4"></td>
                    <td>
                        <div class="form-group has-feedback has-feedback-left">
                        <input type="number" class="form-control col-md-12 all_courses_number" placeholder="رقم" value="">
                        <a href="#" class="form-control-feedback form-control-feedback-custom set-all-courses">
                            <i class=" icon-arrow-down16"></i>
                        </a>
                     </div>
                    </td>
                    <td>
                        <div class="form-group has-feedback has-feedback-left">
                            <input type="number" class="form-control col-md-12 all_salary_ratio" placeholder="%"  value="">
                            <a href="#" class="form-control-feedback  form-control-feedback-custom set-all-ratio" >
                                <i class=" icon-arrow-down16"></i>
                            </a>
                        </div>
                    </td>
                    <td></td>
                <tr>
                    <th>إسم الطالب</th>
                    <th>إسم المجموعة</th>
                    <th>حالة الدفع</th>
                    <th style="    width: 140px;">قيمة الدفع</th>
                    <th style="    width: 130px;">عدد الحصص</th>
                    <th style="    width: 130px;">النسبة</th>
                    <th>الناتج</th>
                </tr>
                </thead>
                <tbody>

                </tr>
                <?php $total_payment_value = 0; ?>
                @foreach($data as $item)
                    @foreach($item->students as $item2)
                        <?php $total_payment_value += $item2->payment_value; ?>
                    <tr>
                        <td>
                            {{ $item2->students->student_name }}
                        </td>
                        <td>{{ $item->group_name }}</td>
                        <td>
                            @if($item2->payment_status == 'F')
                                <span class="td-payment-status label label-primary">
                                مدفوع كامل
                                </span>
                            @elseif($item2->payment_status == 'P')
                                <span class="td-payment-status label label-warning">
                                مدفوع جزء
                                </span>
                            @else
                                <span class="td-payment-status label label-danger">
                               غير مدفوع
                                </span>
                            @endif
                        </td>
                        <td>
                            <div class="form-group has-feedback has-feedback-left">
                            <input type="number" class="form-control col-md-12 payment_value" name="payment_value" value="{{ $item2->payment_value }}">
                            <div class="form-control-feedback">
                                <i class="">₪</i>
                            </div>
                            </div>
                        </td>
                        <td>
                            <span>
                            <input type="number" class="form-control col-md-12 courses_number" name="courses_number" value="">
                            </span>

                        </td>
                        <td>
                            <div class="form-group has-feedback has-feedback-left">
                            <input type="number" class="form-control col-md-12 salary_ratio" name="salary_ratio" value="">
                            <div class="form-control-feedback">
                                <i class="">%</i>
                            </div>
                            </div>

                        </td>
                        <td>
                            <span class="row-sum">--</span>
                            <input type="hidden" class="result-payment-row" value="0">
                        </td>

                    </tr>
                    @endforeach
                @endforeach
                <tr>
                    <td colspan="3" style="text-align: left">المجموع: </td>
                    <td>
                        <span class="sum-payments-values">{{ $total_payment_value }}</span>

                    </td>
                    <td>
                       <span class="sum-courses-counts">--</span>
                    </td>
                    <td></td>
                    <td>
                        <span class="sum-total-salary">--</span>
                    </td>
                </tr>

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


