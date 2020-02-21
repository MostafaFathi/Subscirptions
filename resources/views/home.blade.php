@extends('layouts.main',['title' => '' , 'js'=>'home'])
@section('content')

    <!-- Main charts -->
    <div class="col-lg-12">
        <div class="panel panel-flat">
            <div class="panel-heading">
                <h6 class="panel-title">.</h6>

                <div class="heading-elements">

                    <span class="heading-text">الاشتركات</span>

                </div>
            </div>

            <div class="panel-body" style="text-align: center">
                <img style="width: 60%;" src="{{ asset("/images/logo_light.png") }}"/>
            </div>
            <div class="table-responsive">
                <table class="table datatable-basic table-bordered dataTable no-footer" id="requests-table">
                    <thead>
                    <tr>
                        <th>إسم المشترك</th>
                        <th>نوع الاشتراك</th>
                        <th>تاريخ نهاية الاشتراك</th>
                        <th>متبقي (أيام)</th>
                        <th>قيمة الاشتراك</th>
                        <th>رقم الجوال</th>
                        <th>ملاحظات</th>
                    </tr>
                    </thead>
                    <tbody>
                    @php $count = 0 @endphp
                    @foreach($requests as $key => $item)
                        @php
                            $now = \Carbon\Carbon::now()->format('Y-m-d');
                            $to = \Carbon\Carbon::createFromFormat('Y-m-d', $item->end_at);
                            $from = \Carbon\Carbon::createFromFormat('Y-m-d', $now);
                            $diff_in_days = $from->diffInDays($to,false);
                        @endphp
                        @if($diff_in_days <= 10 && $diff_in_days >= -2)
                            @php  $count = 1 @endphp
                        <tr style="@if($diff_in_days <= 7) background: #fff2ed; @endif">
                            <td>{{ $item->name }}
                                @if($diff_in_days <= 1 )  <img style="" src="{{ asset("/images/notify.gif") }}"/> @endif
                            </td>
                            @php
                                $interval_text = '';
                                if($item->interval == 1)  $interval_text = 'يومي';
                                if($item->interval == 2)  $interval_text = 'شهر';
                                if($item->interval == 3)  $interval_text = '3 شهور';
                                if($item->interval == 4)  $interval_text = '6 شهور';
                                if($item->interval == 5)  $interval_text = 'سنوي';
                                if($item->interval == 6)  $interval_text = 'VIP';
                            @endphp
                            <td>{{ $interval_text }}</td>

                            <td><span class="@if($diff_in_days <= 7) end_date_danger @else end_date_warning @endif">{{$item->end_at}}</span></td>
                            <td>@if($diff_in_days >= 0) {{$diff_in_days}} @else إشتراك منتهي @endif

                            </td>
                            <td>{{ $item->payment }}</td>
                            <td>{{ $item->phone }}</td>
                            <td>{{ $item->hints }}</td>

                        </tr>
                        @endif
                    @endforeach
                        @if($count == 0)
                        <tr>
                            <td colspan="7" style="text-align: center">لا يوجد اشتراكات توشك على الانتهاء</td>
                        </tr>
                        @endif

                    </tbody>
                </table>
            </div>

        </div>
    </div>

    <style>
        .end_date_danger{
            background-color: #FF5722;
            font-size: larger;
            font-weight: bold;
            color: white;
            padding: 0px 10px;
            border-radius: 5px;
        }
        .end_date_warning{
            background-color: #FFC107;
            font-size: larger;
            font-weight: bold;
            color: white;
            padding: 0px 10px;
            border-radius: 5px;
        }
    </style>

@endsection