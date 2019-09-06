@extends('layouts.main',['title' => 'إفتتاح سنة جديدة' , 'js'=>'centers'])

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
            <form action="post" id="open_center_submit_form" class="form-horizontal form-validate-jquery" enctype="multipart/form-data">
                {{ csrf_field() }}
                <a href="#" class="blockMe" style="display: none"></a>
                <div class="panel panel-flat" id="table-block">
                    <div class="panel-heading">
                        <h5 class="panel-title">إفتتاح سنة جديدة</h5>

                    </div>

                    <div class="panel-body">
                        <div class="form-group">
                            <label class="col-lg-2 control-label">تاريخ بدء الإفتتاح:</label>
                            <div class="col-lg-5">
                                <input type="date" id="open_start_date" name="open_start_date" value="{{ $last_open['open_start_date'] }}" class="form-control" placeholder="أدخل تاريخ بداية الافتتاح" >

                            </div>
                        </div>


                        <div class="text-right">
                            <button type="submit"  class="btn btn-primary " id="update-button">
                                <i class=" icon-floppy-disk position-right" style="margin-top: 2px"></i>
                                تجديد الإفتتاح
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


