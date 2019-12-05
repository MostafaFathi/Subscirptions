@extends('layouts.main',['title' => 'إضافة مناطق جديدة' , 'js'=>'tasawaq'])

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
            <form action="post" id="regions_submit_form" class="form-horizontal form-validate-jquery" enctype="multipart/form-data">
                {{ csrf_field() }}
                <a href="#" class="blockMe" style="display: none"></a>
                <div class="panel panel-flat" id="table-block">
                    <div class="panel-heading">
                        <h5 class="panel-title">إضافة مناطق جديدة</h5>

                    </div>

                    <div class="panel-body">


                        <div class="form-group">
                            <label class="col-lg-2 control-label">إسم المنطقة:</label>
                            <div class="col-lg-5">
                                <input type="text" id="region_name" name="region_name"  class="form-control" placeholder="إسم المنطقة .." >

                            </div>
                        </div>

                        <div class="form-group">
                            <label class="col-lg-2 control-label">قيمة العمولة:</label>
                            <div class="col-lg-5">
                                <input type="text" id="region_commission" name="region_commission"  class="form-control" placeholder="قيمة العمولة .." >

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


