@extends('layouts.main',['title' => 'إدارة الأقسام' , 'js'=>'tasawaq'])

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
                <a href="/restaurant" class="btn bg-green-400 btn-labeled new-center-btn" style="float:left;margin-top: -25px;">
                    <b><i class=" icon-user-plus"></i></b> جديد
                </a>

                <div class="heading-elements">

                    <span class="heading-text">قائمة الأقسام</span>

                </div>
            </div>

            <div class="panel-body">
                <div id="sales-heatmap"></div>
            </div>
            <div class="table-responsive">
            <table class="table datatable-basic table-bordered dataTable no-footer" id="students-table">
                <thead>
                <tr>
                    <th>رقم</th>
                    <th>إسم القسم</th>
                    <th>القسم الرئيسي</th>
                    <th>لديه افرع؟</th>
                    <th>نسبة الخصم</th>
                    <th>عمليات</th>
                </tr>
                </thead>
                <tbody>
                @foreach($restaurant as $key => $item)
                    <tr class="show-details">
                        <td>{{ $key+1 }}</td>
                        <td><span class="rest-name">{{ $item->rest_name }}</span></td>

                        <td><span class="section-name">
                                @if($item->main_section == 0) مطاعم@endif
                                @if($item->main_section == 1) خضروات وفواكه@endif
                                @if($item->main_section == 2) لحوم ومجمدات@endif
                                @if($item->main_section == 3) مخبوزات ومعجنات@endif
                                @if($item->main_section == 4) حلويات وجاتوهات@endif
                                @if($item->main_section == 5) سوبرماركت@endif
                            </span></td>
                        <td><span class="has-branches">
                                @if($item->has_branches == 0) لديه افرع@endif
                                @if($item->has_branches == 1) ليس لديه افرع@endif
                            </span></td>
                        <td><span class="discount">{{ $item->discount }}</span></td>
                        <td class="text-center">

                            <a href="#"  class="update-student-btn">
                                <i class="  icon-pencil7 update-icon"></i>
                            </a>
                            <a href="#"  class="delete-restaurant-btn" style="margin: 0px 3px;">
                                <i class="  icon-cancel-square delete-icon" style=" color: #d84315;font-size: 18px;"></i>
                            </a>
                            <input type="hidden" name="restaurant_id" class="restaurant_id" value="{{$item->id}}" />

                        </td>
                    </tr>
                    <tr class="hide-td details-rows">
                        <td colspan="6" class="custom-td-show" style="padding: 0px">
                            <div style="padding: 20px">
                                <form action="post"  class="form-horizontal form-validate-jquery restaurant_update_form" enctype="multipart/form-data">
                                   {{ csrf_field() }}
                                    <input type="hidden" value="{{ $item->id }}" name="id" class="id">
                                <div class="form-group" style="margin-bottom: 7px;margin-top: 0px;">
                                    <label class="col-lg-3 ">
                                        <span class="labels">إسم القسم: </span>
                                        <input type="text" name="rest_name" class="rest_name form-control " value="{{ $item->rest_name }}" />
                                    </label>

                                    <label class="col-lg-3">
                                        <span class="labels">القسم الرئيسي: </span>
                                        <span class="">
                                            <div class="col-lg-12">
                                                <select name="product_section" id="product_section" class="select-search  product_section_manage">
                                                    <option value="0" @if($item->main_section == 0) selected="selected" @endif>مطاعم</option>
                                                    <option value="1" @if($item->main_section == 1) selected="selected" @endif>خضروات وفواكه</option>
                                                    <option value="2" @if($item->main_section == 2) selected="selected" @endif>لحوم ومجمدات</option>
                                                    <option value="3" @if($item->main_section == 3) selected="selected" @endif>مخبوزات ومعجنات</option>
                                                    <option value="4" @if($item->main_section == 4) selected="selected" @endif>حلويات وجاتوهات</option>
                                                    <option value="5" @if($item->main_section == 5) selected="selected" @endif>سوبرماركت</option>

                                                </select>
                                            </div>
                                            </span>

                                    </label>
                                    <label class="col-lg-3">
                                        <span class="labels">لديه افرع: </span>
                                        <span class="">
                                            <div class="col-lg-12">
                                                <select name="has_branches" id="has_branches" class="select-search  product_section_manage">
                                                    <option value="0" @if($item->has_branches == 0) selected="selected" @endif>لديه افرع</option>
                                                    <option value="1" @if($item->has_branches == 1) selected="selected" @endif>ليس لديه افرع</option>
                                                </select>
                                            </div>
                                            </span>

                                    </label>

                                    <label class="col-lg-3 ">
                                        <span class="labels">نسبة الخصم: </span>
                                        <input type="text" name="discount" class="discount form-control " value="{{ $item->discount }}" />
                                    </label>

                                    <label class="col-lg-3">
                                        <span class="labels">الصورة الاولى: </span>
                                        <span class="">
                                            <div class="col-lg-12">
                                                <input type="file" name="img" id="img" class="file-styled">
                                            </div>
                                            </span>

                                    </label>
                                    <label class="col-lg-3">
                                        <span class="labels">الصورة الثانية: </span>
                                        <span class="">
                                            <div class="col-lg-12">
                                                <input type="file" name="img2" id="img2" class="file-styled">
                                            </div>
                                            </span>

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


