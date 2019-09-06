@extends('layouts.main',['title' => 'إدارة الجداول والمجموعات' , 'js'=>'groups'])

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

                <div class="heading-elements">

                    <span class="heading-text">قائمة المدرسين</span>


                </div>
            </div>

            <div class="panel-body">
                <div id="sales-heatmap"></div>
            </div>


            <table class="table datatable-show-all" id="teacher-groups-table">
                <thead>
                <tr>
                    <th>رقم</th>
                    <th>إسم المدرس</th>
                    <th>عدد المجموعات</th>
                    <th>عدد الطلاب</th>
                    <th>الجدول</th>


                </tr>
                </thead>
                <tbody>
                @foreach($teachers as $key => $item)
                    <tr class="show-details">
                        <td>{{ $key+1}}</td>
                        <td>{{ $item['emp_name'] }}</td>
                        <td>{!! \App\Http\Controllers\CommonFunctions::vary_names($item['group_count'],'لا يوجد مجموعات','مجموعة واحدة فقط','مجموعتين فقط','مجموعات','مجموعة') !!}</td>
                        <td>{!! \App\Http\Controllers\CommonFunctions::vary_names($item['student_count'],'لا يوجد طلاب','طالب واحد فقط','طالبين فقط','طلاب','طالب') !!}</td>
                        <td>
                            @if($item['group_count'] > 0)
                            <a href="/groups/{{ $item['emp_id'] }}/schedules">الجدول</a></td>
                        @else
                            الجدول
                            @endif

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


