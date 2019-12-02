@extends('layouts.main',['title' => 'إضافة قسم جديد' , 'js'=>'tasawaq'])

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
            <form action="post" id="restaurant_submit_form" class="form-horizontal form-validate-jquery" enctype="multipart/form-data">
                {{ csrf_field() }}
                <a href="#" class="blockMe" style="display: none"></a>
                <div class="panel panel-flat" id="table-block">
                    <div class="panel-heading">
                        <h5 class="panel-title">إضافة قسم جديد</h5>

                    </div>

                    <div class="panel-body">


                        <div class="form-group">
                            <label class="col-lg-2 control-label">إسم القسم:</label>
                            <div class="col-lg-5">
                                <input type="text" id="rest_name" name="rest_name"  class="form-control" placeholder="إسم القسم .." >

                            </div>
                        </div>


                        <div class="form-group">
                            <label class="col-lg-2 control-label">القسم الرئيسي:</label>
                            <div class="col-lg-5">
                                <select name="product_section" class="select-search" id="product_section">
                                    <option value="0">المطاعم</option>
                                    <option value="1">خضروات وفواكه</option>
                                    <option value="2">لحوم ومجمدات</option>
                                    <option value="3">مخبوزات ومعجنات</option>
                                    <option value="4">حلويات وجاتوهات</option>
                                    <option value="5">سوبرماركت</option>
                                </select>
                            </div>
                        </div>


                        <div class="form-group">
                            <label class="col-lg-2 control-label">هل لديه افرع:</label>
                            <div class="col-lg-5">
                                <select name="has_branches" class="select-search" id="has_branches">
                                    <option value="0">لديه افرع</option>
                                    <option value="1">ليس لديه افرع</option>
                                </select>
                            </div>
                        </div>


                        <div class="form-group">
                            <label class="col-lg-2 control-label">نسبة الخصم:</label>
                            <div class="col-lg-5">
                                <input type="number" id="discount" name="discount"  class="form-control" placeholder="نسبة الخصم .." >

                            </div>
                        </div>

                        <div class="form-group">
                            <label class="col-lg-2 control-label">الصورة الاولى:</label>
                            <div class="col-lg-5">
                                <input type="file" name="img" id="img" class="file-styled">
                                <span class="help-block">تقبل الامتدادات التالية: gif, png, jpg. Max file size 2Mb</span>
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="col-lg-2 control-label">الصورة الثانية:</label>
                            <div class="col-lg-5">
                                <input type="file" name="img2" id="img2" class="file-styled">
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


