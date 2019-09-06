@extends('layouts.main',['title' => 'قائمة المستخدمين' , 'js'=>'permissions'])

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
                <h6 class="panel-title">Daily sales stats</h6>


                <div class="heading-elements">

                    <span class="heading-text">قائمة المستخدمين</span>

                </div>
            </div>

            <div class="panel-body">
                <div id="sales-heatmap"></div>
            </div>

            <table class="table datatable-show-all">
                <thead>
                <tr>
                    <th>صورة المستخدم</th>
                    <th>إسم المستخدم</th>
                    <th>البريد الالكتروني</th>
                    <th>رقم الجوال</th>
                    <th>الحالة</th>
                    <th class="text-left">عمليات</th>
                </tr>
                </thead>
                <tbody>
                @foreach($all_users as $item)
                    <tr>
                        <td>
                            @if($item->img == 'default_user.png')
                                <?php $url = 'images/default_user.png' ?>
                            @else
                                <?php  $url = 'uploads/users/'.$item->img  ?>
                            @endif


                            <img src="{{ asset($url) }}" alt="{{ $item->name }}" style="width: 40px" /></td>
                        <td>{{ $item->name }}</td>
                        <td>{{ $item->email }}</td>
                        <td>{{ $item->phone }}</td>
                        <td>
                            @if($item->status == 'active')<span class="label label-success">مفعل</span> @else <span class="label label-default">معطل</span> @endif
                        </td>
                        <td class="">

                            <a href="/permissions/{{ $item->id }}/tree"  class="">
                                <i class="icon-alignment-unalign grant-icon"></i>
                            </a>
                            {{--<a href="#"  class="sweet_combine">--}}
                            {{--<i class="  icon-cancel-square" style=" color: #d84315;font-size: 18px;"></i>--}}
                            {{--</a>--}}


                        </td>
                    </tr>
                @endforeach


                </tbody>
            </table>


        </div>
    </div>
    <!-- /main charts -->


    <!-- Footer -->

@endsection


