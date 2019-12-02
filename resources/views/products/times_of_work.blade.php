@extends('layouts.main',['title' => 'مواعيد العمل' , 'js'=>'tasawaq'])

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
            <form action="post" id="timesWork_submit_form" class="form-horizontal form-validate-jquery" enctype="multipart/form-data">
                {{ csrf_field() }}
                <a href="#" class="blockMe" style="display: none"></a>
                <div class="panel panel-flat" id="table-block">
                    <div class="panel-heading">
                        <h5 class="panel-title">مواعيد العمل</h5>

                    </div>

                    <div class="panel-body">

                        <div class="form-group">
                            <label class="col-lg-2 control-label">موعد بداية العمل:</label>
                            <div class="col-lg-3">
                                <input type="time" id="time_start" name="time_start"  value="@if(isset($times)){{$times->time_start}}@endif" class="form-control" >

                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-lg-2 control-label">موعد نهاية العمل:</label>
                            <div class="col-lg-3">
                                <input type="time" id="time_end" name="time_end"  value="@if(isset($times)){{$times->time_end}}@endif" class="form-control" >

                            </div>
                        </div>


                        <div class="text-right">
                            <button type="submit"  class="btn btn-primary " id="add-button">
                                <i class=" icon-floppy-disk position-right" style="margin-top: 2px"></i>
                                حفظ التغييرات
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


