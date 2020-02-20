@extends('layouts.main',['title' => 'إدارة الاشتراكات' , 'js'=>'tasawaq'])

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
                <a href="/subscription" class="btn bg-green-400 btn-labeled new-center-btn" style="float:left;margin-top: -25px;">
                    <b><i class=" icon-user-plus"></i></b> جديد
                </a>

                <div class="heading-elements">

                    <span class="heading-text">قائمة الاشتراكات</span>

                </div>
            </div>

            <div class="panel-body">
                <form action="" method="get" class="form-horizontal" style="    background: #e9ebee4f;padding: 3px;border-radius: 10px;">
                    <h5 style="    padding: 10px;">بحث</h5>
                    <div class="form-group">


                        <div class="form-group col-md-3">
                            <div class="input-group-prepend">
                                <span class="input-group-text" id="addon-wrapping">اسم المشترك</span>
                            </div>
                            <input type="text" class="form-control" name="name" value="{{request()->get('name')}}"
                                   aria-describedby="addon-wrapping">
                        </div>

                        <div class="form-group col-md-3">
                            <button class="btn btn-success" style="margin: 19px 0px;" type="submit" >

                                بحث</button>

                            <button class="btn btn-info mr-1" style="  margin: 19px 3px;" type="button" data-toggle="collapse" data-target="#collapseExample" aria-expanded="false" aria-controls="collapseExample" >
                                متقدم
                            </button>

                        </div>
                        <div class="collapse w-100 col-md-12" id="collapseExample" >
                            <div class="card card-body">

                                <div class="form-group">
                                    <div class="form-group" style="margin-bottom: 7px;margin-top: 0px;">
                                        <label class="col-lg-3 ">
                                            <span class="labels">مدة الحجز: </span>
                                            <select name="interval" class="form-control">

                                                <option value="0" {{request()->get('interval') ==0 ? 'selected':''}}>إختر</option>
                                                <option value="1" {{request()->get('interval') ==1 ? 'selected':''}}>يومي</option>
                                                <option value="2" {{request()->get('interval') ==2 ? 'selected':''}}>شهر</option>
                                                <option value="3" {{request()->get('interval') ==3 ? 'selected':''}}>3 شهور</option>
                                                <option value="4" {{request()->get('interval') ==4 ? 'selected':''}}>6 شهور</option>
                                                <option value="5" {{request()->get('interval') ==5 ? 'selected':''}}>3سنوي</option>
                                                <option value="6" {{request()->get('interval') ==6 ? 'selected':''}}>VIP</option>
                                            </select>
                                        </label>

                                        <label class="col-lg-3">
                                            <span class="labels">قيمة الاشتراك: </span>
                                            <input type="text" name="payment" class="payment form-control " value="{{request()->get('payment')}}" />
                                        </label>
                                        <label class="col-lg-3">
                                            <span class="labels">رقم الجوال: </span>
                                            <input type="text" name="phone" class="phone form-control " value="{{request()->get('phone')}}" />
                                        </label>
                                        <label class="col-lg-3">
                                            <span class="labels">العنوان: </span>
                                            <input type="text" name="address" class="address form-control " value="{{request()->get('address')}}" />
                                        </label>
                                    </div>



                                    <style>
                                        .bootstrap-tagsinput input {
                                            line-height: 35px;
                                        }
                                    </style>





                                </div>
                            </div>

                        </div>









                    </div>
                </form>
            </div>


            <div class="table-responsive">
                    <table class="table datatable-basic table-bordered dataTable no-footer" id="requests-table">
                        <thead>
                        <tr>
                            <th>إسم المشترك</th>
                            <th>نوع الاشتراك</th>
                            <th>تاريخ نهاية الاشتراك</th>
                            <th>قيمة الاشتراك</th>
                            <th>رقم الجوال</th>
                            <th>ملاحظات</th>
                            <th>عمليات</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($subscriptions as $key => $item)
                            <tr>
                                <td class="name">{{ $item->name }}</td>
                                @php
                                    $interval_text = '';
                                    if($item->interval == 1)  $interval_text = 'يومي';
                                    if($item->interval == 2)  $interval_text = 'شهر';
                                    if($item->interval == 3)  $interval_text = '3 شهور';
                                    if($item->interval == 4)  $interval_text = '6 شهور';
                                    if($item->interval == 5)  $interval_text = 'سنوي';
                                    if($item->interval == 6)  $interval_text = 'VIP';
                                @endphp
                                <td class="interval">{{ $interval_text }}</td>
                                <td class="end_at">{{ $item->end_at }}</td>
                                <td class="payment">{{ $item->payment }}</td>
                                <td class="phone">{{ $item->phone }}</td>
                                <td class="hints">{{ $item->hints }}</td>
                                <td class="text-center">

                                    <a href="#"  class="update-subscription-btn">
                                        <i class="  icon-pencil7 update-icon"></i>
                                    </a>
                                    <a href="#"  class="delete-subscription-btn" style="margin: 0px 3px;">
                                        <i class="  icon-cancel-square delete-icon" style=" color: #d84315;font-size: 18px;"></i>
                                    </a>
                                    <input type="hidden" name="subscriptions_id" class="subscriptions_id" value="{{$item->id}}" />

                                </td>
                            </tr>
                            <tr class="hide-td details-rows">
                                <td colspan="7" class="custom-td-show" style="padding: 0px">
                                    <div style="padding: 20px">
                                        <form action="post"  class="form-horizontal form-validate-jquery subscription_update_form" enctype="multipart/form-data">
                                            {{ csrf_field() }}
                                            <input type="hidden" value="{{ $item->id }}" name="subscriptions_id" class="subscriptions_id">
                                            <div class="form-group" style="margin-bottom: 7px;margin-top: 0px;">
                                                <label class="col-lg-3 ">
                                                    <span class="labels">إسم المشترك: </span>
                                                    <input type="text" name="name" class="name form-control " value="{{ $item->name }}" />
                                                </label>

                                                <label class="col-lg-3">
                                                    <span class="labels">عنوان المشترك: </span>
                                                    <input type="text" name="address" class="address form-control " value="{{ $item->address }}" />
                                                </label>

                                                <label class="col-lg-3">
                                                    <span class="labels">رقم الجوال: </span>
                                                    <input type="text" name="phone" class="phone form-control " value="{{ $item->phone }}" />
                                                </label>

                                                <label class="col-lg-3">
                                                    <span class="labels">الحالة الصحية: </span>
                                                    <input type="text" name="health" class="health form-control " value="{{ $item->health }}" />
                                                </label>




                                            </div>
                                            <div class="form-group" style="margin-bottom: 7px;">
                                                <label class="col-lg-3">
                                                    <span class="labels">مدة الحجز: </span>
                                                    <span class="">
                                                        <div class="col-lg-12">
                                                            <select name="interval" id="interval"
                                                                    class="select-search  interval_manage">
                                                                <option value="1"
                                                                        @if($item->interval == 1) selected="selected" @endif>يومي</option>
                                                                <option value="2"
                                                                        @if($item->interval == 2) selected="selected" @endif>شهر</option>
                                                                <option value="3"
                                                                        @if($item->interval == 3) selected="selected" @endif>3 شهور</option>
                                                                <option value="4"
                                                                        @if($item->interval == 4) selected="selected" @endif>6 شهور</option>
                                                                <option value="5"
                                                                        @if($item->interval == 5) selected="selected" @endif>سنوي</option>
                                                                <option value="6"
                                                                        @if($item->interval == 6) selected="selected" @endif>VIP</option>

                                                            </select>
                                                        </div>
                                                    </span>
                                                </label>

                                                <label class="col-lg-3">
                                                    <span class="labels">قيمة الاشتراك: </span>
                                                    <input type="text" name="payment" class="payment form-control " value="{{ $item->payment }}" />
                                                </label>
                                                <label class="col-lg-3">
                                                    <span class="labels">ملاحظات: </span>
                                                    <input type="text" name="hints" class="hints form-control " value="{{ $item->hints }}" />
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


