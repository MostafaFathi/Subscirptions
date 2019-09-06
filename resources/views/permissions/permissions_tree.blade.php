@extends('layouts.main',['title' => 'شجرة    الصلاحيات' , 'js'=>'permissions' , 'has_parent' => true , 'parent_url'=>'/permissions/users' , 'parent_name'=>'قائمة المستخدمين'])


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
            <form action="/" method="post" id="submit_user_permissions">
                {{ csrf_field() }}
                <input type="hidden" name="user_id" id="user_id" value="{{$user_id}}" />
            <div class="footer-fixed-bar">
                <button type="submit" class="btn btn-info" id="user-permissions-btn">
                    <i class=" icon-floppy-disk position-right" style="margin-top: 2px"></i>
                    حفظ التغييرات
                    <i class="icon-spinner2 spinner position-left hide loader" style="margin-top: 3px;float: left;"></i>
                </button>
            </div>
            <div class="easy-tree" >
                {!! $tree !!}
            </div>
            </form>


        </div>


    </div>

     <!-- /main charts -->


    <!-- Footer -->
<script type="text/javascript">
   // $('.easy-tree').EasyTree();
   $('#checkboxes').bonsai({
       expandAll: true,
       checkboxes: true, // depends on jquery.qubit plugin
       handleDuplicateCheckboxes: true // optional
   });
$(function(){


   var checkboxes =  $(document).find('#checkboxes li .permission-checkbox').map(function(){
       if($(this).hasClass('yes-checked')){
        return $(this).val();
       }
    });
    $(document).find('#checkboxes li .permission-checkbox').each(function(){
        for(var i = 0 ; i < checkboxes.length;i++){
            if($(this).val() == checkboxes[i])
                $(this).prop('checked',true);
        }

    });
  // console.log(JSON.stringify(checkboxes))

});
</script>
@endsection


