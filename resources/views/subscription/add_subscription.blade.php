@extends('layouts.main',['title' => 'إضافة إشتراك جديد' , 'js'=>'subscriptions'])

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
            <form action="post" id="subscription_submit_form" class="form-horizontal form-validate-jquery" enctype="multipart/form-data">
                {{ csrf_field() }}
                <a href="#" class="blockMe" style="display: none"></a>
                <div class="panel panel-flat" id="table-block">
                    <div class="panel-heading">
                        <h5 class="panel-title">إضافة اشتراك جديد</h5>

                    </div>

                    <div class="panel-body">


                        <div class="form-group">
                            <label class="col-lg-2 control-label">إسم المشترك:</label>
                            <div class="col-lg-5">
                                <input type="text" id="name" name="name"  class="form-control" placeholder="إسم المشترك .." >

                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-lg-2 control-label">عنوان المشترك:</label>
                            <div class="col-lg-5">
                                <input type="text" id="address" name="address"  class="form-control" placeholder="عنوان المشترك .." >

                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-lg-2 control-label">رقم الجوال:</label>
                            <div class="col-lg-5">
                                <input type="number" id="phone" name="phone"  class="form-control" placeholder="رقم الجوال .." >

                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-lg-2 control-label">الحالة الصحية:</label>
                            <div class="col-lg-5">
                                <input type="text" id="health" name="health"  class="form-control" placeholder="الحالة الصحية .." >

                            </div>
                        </div>

                        <div class="form-group">
                            <label class="col-lg-2 control-label">مدة الحجز:</label>
                            <div class="col-lg-5">
                                <select name="interval" class="select-search" id="unit_id">
                                        <option value="--">إختر</option>
                                        <option value="1">يومي</option>
                                        <option value="2">شهر</option>
                                        <option value="3">3 شهور</option>
                                        <option value="4">6 شهور</option>
                                        <option value="5">سنوي</option>
                                        <option value="6">VIP</option>
                                </select>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-lg-2 control-label">قيمة الاشتراك:</label>
                            <div class="col-lg-5">
                                <input type="number" id="payment" name="payment"  class="form-control" placeholder="قيمة الاشتراك .." >

                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-lg-2 control-label">ملاحظات:</label>
                            <div class="col-lg-5">
                                <input type="text" id="hints" name="hints"  class="form-control" placeholder="ملاحظات .." >

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

        </div>


    </div>


    <!-- Footer -->

@endsection


