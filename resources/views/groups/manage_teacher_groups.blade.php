@extends('layouts.main',['title' => 'إدارة المجموعات' , 'js'=>'groups'])

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
                            <span>جدول الاستاذة: </span>
                                @else
                            <span>جدول الاستاذ: </span>
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
                    <th>#</th>
                    <th>إسم المجموعة</th>
                    <th class="@if($day == 'Saturday') current-day @endif">السبت</th>
                    <th class="@if($day == 'Sunday') current-day @endif">الأحد</th>
                    <th class="@if($day == 'Monday') current-day @endif">الإثنين</th>
                    <th class="@if($day == 'Tuesday') current-day @endif">الثلاثاء</th>
                    <th class="@if($day == 'Wednesday') current-day @endif">الأربعاء</th>
                    <th class="@if($day == 'Thursday') current-day @endif">الخميس</th>

                </tr>
                </thead>
                <tbody>
                @foreach($data as $key => $item)
                    <tr class="show-details">
                        <td>
                            <a href="/groups/{{ $item->group_id }}/update"  class="update-group-btn">
                                <i class="  icon-pencil7 update-icon"></i>
                            </a>
                            <a href="#"  class="delete-group-btn" style="margin: 0px 3px;">
                                <i class="  icon-cancel-square delete-icon" style=" color: #d84315;font-size: 18px;"></i>
                            </a>

                            <input type="hidden" name="group_id" class="group_id" value="{{$item->group_id}}" />
                        </td>
                        <td>

                            <a href="/groups/{{ $item->group_id }}/students">{{ $item->group_name }}</a>
                        </td>
                        <td class="@if($day == 'Saturday') current-day @endif">
                            <?php $flag = false;
                            $appointment_time = '';
                            ?>
                            @foreach($item->appointments as $days_times)
                                @if($days_times->day_no == 1)
                                    <?php $appointment_time = $days_times->time_from.' - '.$days_times->time_to ?>
                                    <?php $flag=true; ?>
                                @endif
                            @endforeach

                            @if(!$flag)
                                --
                            @else
                                <span class="label label-success appointment-bold">
                                    {{ $appointment_time }}
                                    </span>
                            @endif
                        </td>
                        <td class="@if($day == 'Sunday') current-day @endif">
                            <?php $flag = false;
                            $appointment_time = '';
                            ?>
                            @foreach($item->appointments as $days_times)
                                @if($days_times->day_no == 2)
                                    <?php $appointment_time = $days_times->time_from.' - '.$days_times->time_to ?>
                                    <?php $flag=true; ?>
                                @endif
                            @endforeach

                            @if(!$flag)
                                --
                            @else
                                <span class="label label-success appointment-bold">
                                    {{ $appointment_time }}
                                    </span>
                            @endif
                        </td>
                        <td class="@if($day == 'Monday') current-day @endif">
                            <?php $flag = false;
                            $appointment_time = '';
                            ?>
                            @foreach($item->appointments as $days_times)
                                @if($days_times->day_no == 3)
                                    <?php $appointment_time = $days_times->time_from.' - '.$days_times->time_to ?>
                                    <?php $flag=true; ?>
                                @endif
                            @endforeach

                            @if(!$flag)
                                --
                            @else
                                <span class="label label-success appointment-bold">
                                    {{ $appointment_time }}
                                    </span>
                            @endif
                        </td>
                        <td class="@if($day == 'Tuesday') current-day @endif">
                            <?php $flag = false;
                            $appointment_time = '';
                            ?>
                            @foreach($item->appointments as $days_times)
                                @if($days_times->day_no == 4)
                                    <?php $appointment_time = $days_times->time_from.' - '.$days_times->time_to ?>
                                    <?php $flag=true; ?>
                                @endif
                            @endforeach

                            @if(!$flag)
                                --
                            @else
                                <span class="label label-success appointment-bold">
                                    {{ $appointment_time }}
                                    </span>
                            @endif
                        </td>
                        <td class="@if($day == 'Wednesday') current-day @endif">
                            <?php $flag = false;
                            $appointment_time = '';
                            ?>
                            @foreach($item->appointments as $days_times)
                                @if($days_times->day_no == 5)
                                    <?php $appointment_time = $days_times->time_from.' - '.$days_times->time_to ?>
                                    <?php $flag=true; ?>
                                @endif
                            @endforeach

                            @if(!$flag)
                                --
                            @else
                                <span class="label label-success appointment-bold">
                                    {{ $appointment_time }}
                                    </span>
                            @endif
                        </td>
                        <td class="@if($day == 'Thursday') current-day @endif">

                            <?php $flag = false;
                            $appointment_time = '';
                            ?>
                            @foreach($item->appointments as $days_times)
                                @if($days_times->day_no == 6)
                                    <?php $appointment_time = $days_times->time_from.' - '.$days_times->time_to ?>
                                    <?php $flag=true; ?>
                                @endif
                            @endforeach

                            @if(!$flag)
                                --
                            @else
                                <span class="label label-success appointment-bold">
                                    {{ $appointment_time }}
                                    </span>
                            @endif

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


