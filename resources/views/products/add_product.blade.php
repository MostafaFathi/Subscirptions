@extends('layouts.main',['title' => 'إضافة منتج جديد' , 'js'=>'tasawaq'])

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
            <form action="post" id="product_submit_form" class="form-horizontal form-validate-jquery" enctype="multipart/form-data">
                {{ csrf_field() }}
                <a href="#" class="blockMe" style="display: none"></a>
                <div class="panel panel-flat" id="table-block">
                    <div class="panel-heading">
                        <h5 class="panel-title">إضافة منتج جديد</h5>

                    </div>

                    <div class="panel-body">


                        <div class="form-group">
                            <label class="col-lg-2 control-label">إسم المنتج:</label>
                            <div class="col-lg-5">
                                <input type="text" id="product_name" name="product_name"  class="form-control" placeholder="إسم المنتج .." >

                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-lg-2 control-label">سعر المنتج:</label>
                            <div class="col-lg-5">
                                <input type="text" id="product_price" name="product_price"  class="form-control" placeholder="سعر المنتج .." >

                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-lg-2 control-label">الوحدة:</label>
                            <div class="col-lg-5">
                                <select name="unit_id" class="select-search" id="unit_id">
                                    @foreach($units as $item)
                                        <option value="{{ $item->id }}">{{ $item->unit_name }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-lg-2 control-label">القسم التابع له:</label>
                            <div class="col-lg-5">
                                <select name="product_section" class="select-search product_section_change" id="product_section">
                                    <option value="--">إختر</option>
                                    <option value="0">المطاعم</option>
                                    <option value="1">خضروات وفواكه</option>
                                    <option value="2">لحوم ومجمدات</option>
                                    <option value="3">مخبوزات ومعجنات</option>
                                    <option value="4">حلويات وجاتوهات</option>
                                    <option value="5">سوبرماركت</option>
                                </select>
                            </div>
                        </div>

                        <div class="form-group show restaurant_section">

                        </div>

                        <div class="form-group show branches_section">

                        </div>

                        <div class="form-group">
                            <label class="col-lg-2 control-label">المحافظة:</label>
                            <div class="col-lg-5">
                                <select name="product_city" class="select-search" id="product_city">
                                    <option value="0">غزة</option>
                                    <option value="1">الوسطى</option>
                                    <option value="2">الجنوب</option>
                                    <option value="3">الشمال</option>
                                </select>
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="col-lg-2 control-label">صورة المنتج:</label>
                            <div class="col-lg-5">
                                <input type="file" name="img" id="img" class="file-styled">
                                <span class="help-block">تقبل الامتدادات التالية: gif, png, jpg. Max file size 2Mb</span>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-lg-2 control-label">صورة البائع:</label>
                            <div class="col-lg-5">
                                <input type="file" name="img_2" id="img_2" class="file-styled">
                                <span class="help-block">تقبل الامتدادات التالية: gif, png, jpg. Max file size 2Mb</span>
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


