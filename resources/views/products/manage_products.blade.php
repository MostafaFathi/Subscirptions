@extends('layouts.main',['title' => 'إدارة المنتجات' , 'js'=>'tasawaq'])

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
                <a href="/products" class="btn bg-green-400 btn-labeled new-center-btn" style="float:left;margin-top: -25px;">
                    <b><i class=" icon-user-plus"></i></b> جديد
                </a>

                <div class="heading-elements">

                    <span class="heading-text">قائمة المنتجات</span>

                </div>
            </div>

            <div class="panel-body">
                <div id="sales-heatmap"></div>
            </div>

            <table class="table datatable-basic table-bordered dataTable no-footer" id="students-table">
                <thead>
                <tr>
                    <th>رقم</th>
                    <th>إسم المنتج</th>
                    <th>السعر</th>
                    <th>الوحدة</th>
                    <th>القسم الرئيسي</th>
                    <th>القسم الاول</th>
                    <th>القسم الثاني</th>
                    <th>عمليات</th>
                </tr>
                </thead>
                <tbody>
                @foreach($all_products as $key => $item)
                    <tr class="show-details">
                        <td>{{ $key+1 }}</td>
                        <td><span class="product-name">{{ $item->product_name }}</span></td>
                        <td><span class="product-price">{{ $item->product_price }}</span></td>
                        <td><span class="unit-id">{{ $item->units->unit_name }}</span></td>
                        <td><span class="section-name">
                                @if($item->product_section == 0) مطاعم@endif
                                @if($item->product_section == 1) خضروات وفواكه@endif
                                @if($item->product_section == 2) لحوم ومجمدات@endif
                                @if($item->product_section == 3) مخبوزات ومعجنات@endif
                                @if($item->product_section == 4) حلويات وجاتوهات@endif
                                @if($item->product_section == 5) سوبرماركت@endif
                            </span></td>
                        <td><span class="rest-name">
                                @if($item->product_rest != null)
                                {{ $item->restaurant->rest_name }}
                                @endif
                            </span></td>
                        <td><span class="rest-branch-name">
                                @if($item->restaurant_branch != null)
                                {{ $item->restaurant_branch->rest_name }}
                                @endif
                            </span></td>

                        {{--<td>{{ $item->student_father_work }}</td>--}}
                        {{--<td>{{ $item->student_phone }}</td>--}}
                        {{--<td>{{ $item->student_phone2 }}</td>--}}
                        <td class="text-center">

                            <a href="#"  class="update-student-btn">
                                <i class="  icon-pencil7 update-icon"></i>
                            </a>
                            <a href="#"  class="delete-product-btn" style="margin: 0px 3px;">
                                <i class="  icon-cancel-square delete-icon" style=" color: #d84315;font-size: 18px;"></i>
                            </a>
                            <input type="hidden" name="product_id" class="product_id" value="{{$item->id}}" />

                        </td>
                    </tr>
                    <tr class="hide-td details-rows">
                        <td colspan="8" class="custom-td-show" style="padding: 0px">
                            <div style="padding: 20px">
                                <form action="post"  class="form-horizontal form-validate-jquery product_update_form" enctype="multipart/form-data">
                                   {{ csrf_field() }}
                                    <input type="hidden" value="{{ $item->id }}" name="product_id" class="product_id">
                                <div class="form-group" style="margin-bottom: 7px;margin-top: 0px;">
                                    <label class="col-lg-3 ">
                                        <span class="labels">إسم المنتج: </span>
                                        <input type="text" name="product_name" class="product_name form-control " value="{{ $item->product_name }}" />
                                    </label>

                                    <label class="col-lg-3">
                                        <span class="labels">سعر المنتج: </span>
                                        <input type="text" name="product_price" class="product_price form-control " value="{{ $item->product_price }}" />
                                    </label>

                                    <label class="col-lg-3">
                                        <span class="labels">الوحدة: </span>
                                        <span class="">
                                            <div class="col-lg-12">
                                                <select name="unit_id" class="select-search" id="unit_id">
                                                <option value="">إختر</option>

                                                    @foreach($units as $item2)
                                                        <option value="{{ $item2->id }}" @if($item->unit_id == $item2->id) selected="selected" @endif>{{ $item2->unit_name }}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                            </span>

                                    </label>

                                    <label class="col-lg-3">
                                        <span class="labels">القسم: </span>
                                        <span class="">
                                            <div class="col-lg-12">
                                                <select name="product_section" id="product_section" class="select-search  product_section_manage">
                                                    <option value="0" @if($item->product_section == 0) selected="selected" @endif>مطاعم</option>
                                                    <option value="1" @if($item->product_section == 1) selected="selected" @endif>خضروات وفواكه</option>
                                                    <option value="2" @if($item->product_section == 2) selected="selected" @endif>لحوم ومجمدات</option>
                                                    <option value="3" @if($item->product_section == 3) selected="selected" @endif>مخبوزات ومعجنات</option>
                                                    <option value="4" @if($item->product_section == 4) selected="selected" @endif>حلويات وجاتوهات</option>
                                                    <option value="5" @if($item->product_section == 5) selected="selected" @endif>سوبرماركت</option>

                                                </select>
                                            </div>
                                            </span>

                                    </label>


                                </div>
                                <div class="form-group" style="margin-bottom: 7px;">
                                    <label class="col-lg-3 restaurant_section @if($item->product_section == 0) show @else hide @endif">
                                        <span class="labels">قسم المأكولات: </span>
                                        <span class="">
                                            <div class="col-lg-12">
                                                <select name="product_rest" class="select-search" id="product_rest">
                                                <option value="">إختر</option>

                                                    @foreach($restaurant as $item2)
                                                        <option value="{{ $item2->id }}" @if($item->product_rest == $item2->id) selected="selected" @endif>{{ $item2->rest_name }}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                            </span>

                                    </label>
                                    <label class="col-lg-3">
                                        <span class="labels">المحافظة: </span>
                                        <span class="">
                                            <div class="col-lg-12">
                                                <select name="product_city" class="select-search" id="product_city">
                                                    <option value="0" @if($item->product_city == 0) selected="selected" @endif>غزة</option>
                                                    <option value="1" @if($item->product_city == 1) selected="selected" @endif>الوسطى</option>
                                                    <option value="2" @if($item->product_city == 2) selected="selected" @endif>الجنوب</option>
                                                    <option value="3" @if($item->product_city == 3) selected="selected" @endif>الشمال</option>

                                                </select>
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


