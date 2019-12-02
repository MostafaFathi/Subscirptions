@extends('layouts.main',['title' => 'إدارة الأقسام الفرعية' , 'js'=>'tasawaq'])

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
                <a href="/branches" class="btn bg-green-400 btn-labeled new-center-btn" style="float:left;margin-top: -25px;">
                    <b><i class=" icon-user-plus"></i></b> جديد
                </a>

                <div class="heading-elements">

                    <span class="heading-text">قائمة الأقسام الفرعية</span>

                </div>
            </div>

            <div class="panel-body">
                <div id="sales-heatmap"></div>
            </div>

            <table class="table datatable-basic table-bordered dataTable no-footer" id="students-table">
                <thead>
                <tr>
                    <th>رقم</th>
                    <th>إسم القسم</th>
                    <th>القسم التابع له</th>
                    <th>عمليات</th>
                </tr>
                </thead>
                <tbody>
                @foreach($restaurant as $key => $item)
                    <tr class="show-details">
                        <td>{{ $key+1 }}</td>
                        <td><span class="rest-name">{{ $item->rest_name }}</span></td>
                        <td><span class="branch-name">
                               @if($item->branch_id != 0)
                                    {{ $item->restaurant->rest_name }}
                                @endif
                            </span></td>
                        <td class="text-center">

                            <a href="#"  class="update-student-btn">
                                <i class="  icon-pencil7 update-icon"></i>
                            </a>
                            <a href="#"  class="delete-branches-btn" style="margin: 0px 3px;">
                                <i class="  icon-cancel-square delete-icon" style=" color: #d84315;font-size: 18px;"></i>
                            </a>
                            <input type="hidden" name="restaurant_id" class="restaurant_id" value="{{$item->id}}" />

                        </td>
                    </tr>
                    <tr class="hide-td details-rows">
                        <td colspan="5" class="custom-td-show" style="padding: 0px">
                            <div style="padding: 20px">
                                <form action="post"  class="form-horizontal form-validate-jquery branches_update_form" enctype="multipart/form-data">
                                   {{ csrf_field() }}
                                    <input type="hidden" value="{{ $item->id }}" name="id" class="id">
                                <div class="form-group" style="margin-bottom: 7px;margin-top: 0px;">
                                    <label class="col-lg-3 ">
                                        <span class="labels">إسم القسم: </span>
                                        <input type="text" name="rest_name" class="rest_name form-control " value="{{ $item->rest_name }}" />
                                    </label>

                                    <label class="col-lg-3">
                                        <span class="labels">الوحدة: </span>
                                        <span class="">
                                            <div class="col-lg-12">
                                                <select name="branch_id" class="select-search" id="branch_id">
                                                <option value="">إختر</option>

                                                    @foreach($branches as $item2)
                                                        <option value="{{ $item2->id }}" @if($item->branch_id == $item2->id) selected="selected" @endif>{{ $item2->rest_name }}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                            </span>

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


