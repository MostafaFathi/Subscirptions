@extends('layouts.main',['title' => 'عرض مستخدمي التطبيق' , 'js'=>'tasawaq'])

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


                <div class="heading-elements">

                    <span class="heading-text">عرض مستخدمي التطبيق</span>

                </div>
            </div>

            <div class="panel-body">
                <div id="sales-heatmap"></div>
            </div>

            <table class="table datatable-tools-basic dataTable no-footer" id="">
                <thead>
                <tr>
                    <th>رقم</th>
                    <th>إسم المستخدم</th>
                    <th>رقم الجوال</th>
                    <th>العنوان</th>
                    <th>المحافظة</th>
                </tr>
                </thead>
                <tbody>
                @foreach($all_users as $key => $item)
                    <tr >
                        <td>{{ $key+1 }}</td>
                        <td><span class="rest-name">{{ $item->fullName }}</span></td>
                        <td><span class="rest-name">{{ $item->number }}</span></td>
                        <td><span class="rest-name">{{ $item->address }}</span></td>
                        <td><span class="rest-name">{{ $item->city }}</span></td>

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


