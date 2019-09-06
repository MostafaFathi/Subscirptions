/**
 * Created by mhilles on 12/06/2017.
 */
 //////////////////////////////////////////////////////////////////////////////////////////////
//                              Start Of Common Functions                                   //
//////////////////////////////////////////////////////////////////////////////////////////////


function validation(jsonObject,elementId,ajax_response,form_id){
    if(!ajax_response){// if ajax return error process
        //validation inputs of laravel -- input names
        if(jsonObject.hasOwnProperty(elementId)){
            $(form_id).find('#'+elementId).parent().find('.validation-error').remove();
            $(form_id).find('#'+elementId).parent().parent().addClass("has-error  has-feedback");
            $(form_id).find('#'+elementId).after($('.validation').html());
            $(form_id).find('#'+elementId).parent().find('span').text(jsonObject[elementId]);
        }else{
            $(form_id).find('#'+elementId).parent().parent().removeClass("has-error  has-feedback");
            $(form_id).find('#'+elementId).parent().find('.validation-error').remove();
        }
    }else{
        $(form_id).find('#'+elementId).parent().parent().removeClass("has-error  has-feedback");
        $(form_id).find('#'+elementId).parent().find('.validation-error').remove();
    }

}
function loader(btn , turn){
    // trun : true to show loader , false to hide
    if(turn){
        btn.parent().attr('disabled',true);
        btn.removeClass('hide');
        btn.addClass('show');
    }  else{
        btn.parent().attr('disabled',false);
        btn.removeClass('show');
        btn.addClass('hide');
    }
}

function blockLoader(block){
    $(block).block({
        message: $('.blockui-animation-container'),

        overlayCSS: {
            backgroundColor: '#fff',
            opacity: 0.8,
            cursor: 'wait'
        },
        css: {
            width: 36,
            height: 36,
            color: '#fff',
            border: 0,
            padding: 0,
            backgroundColor: 'transparent'
        }
    });

    var animation = $(this).data("animation");
    $('.blockui-animation-container').addClass("animated " + animation).one("webkitAnimationEnd mozAnimationEnd MSAnimationEnd oanimationend animationend", function () {
        $(this).removeClass("animated " + animation);
    });
}
function resultMessage(title,body,type,button_color,timer){
    swal({
        title: title,
        text: body,
        confirmButtonColor: button_color,
        type: type,
        timer:timer
    });
}
function cancelDelete(){
    swal({
        title: "تم إلغاء الامر",
        text: "لقد قمت بالتراجع عن عملية الحذف",
        confirmButtonColor: "#2196F3",
        type: "error",
        timer:2000
    });
}

function notificationMessage(title,body,color){
    new PNotify({
        title: title,
        text: body,
        addclass: color
    });
}

//////////////////////////////////////////////////////////////////////////////////////////////
//                              End Of Common Functions                                     //
//////////////////////////////////////////////////////////////////////////////////////////////
var add_button = false;
var update_button = false;
$(document).on('click','#add-button',function(){
    add_button = true;
    update_button = false;
});
$(document).on('click','#update-button',function(){
    add_button = false;
    update_button = true;
});

var base_url = 'http://' + window.location.host+'/';
$(function() {
    var base_url = 'http://' + window.location.host+'/';
    $(document).on('submit', '#permissions_submit_form', function() {

        var navigate_to = base_url;
        if(add_button)
            navigate_to+='permissions/add';
        else if(update_button)
            navigate_to+='permissions/'+permission_no+'/update';


        var submit = $(this).find("button[type='submit'] > .loader");
        loader(submit,true);// show loader and disable button
        $.ajax({
            type: 'post',
            dataType: "json",
            url: navigate_to,
            data: new FormData(this),
            cache: "false",
            contentType: false,
            processData: false,
            success: function(data) {
                var url ='';
                $('#permission_parent_no').html(JSON.parse(data['permissions_result']));

                loader(submit,false);// hide loader and un-disable button

            },error:function(data){

                notificationMessage('رسالة خطأ','يوجد خطأ في بعض المدخلات','bg-danger') ;

                var errors = data.responseJSON;
                validation(errors,'branch_name',false,"#branch_submit_form");
                validation(errors,'branch_phone',false,"#branch_submit_form");

                loader(submit,false);// hide loader and un-disable button
            }

        });
        return false;

    });

    var permission_table_row;
    var before_row;
    var permission_no=0;
    $(document).on('click','.update-permission-btn',function(){
        permission_table_row = $(this).parent().parent();
        before_row = permission_table_row.parent().parent().prev();
        permission_no =  $(this).parent().find('.permission_no').val();

        $.ajax({
            type: 'get',
            dataType: "json",
            url: base_url + 'permissions/'+permission_no+'/edit',
            data: "",
            cache: "false",
            success: function(data) {
                var result = data.responseJSON;

                $('#permissions_submit_form').find('#permission_name').val(data['result'].permission_name);
                $('#permissions_submit_form').find('#permission_type').val(data['result'].permission_type);
                $('#permissions_submit_form').find('#permission_parent_no').val(data['result'].permission_parent_no);
              //  alert(data['operations'].length);
                $('#permissions_submit_form').find('#permission_operations').val('');

                var array=[];
                for(var i = 0;i<data['operations'].length;i++){
                    // alert(data['operations'][i]['permission_name']);
                    array[i] = data['operations'][i]['permission_name'];

                }
                $('#permissions_submit_form').find('#permission_operations').val(array);

                $('#permission_type').select2({
                    // options
                });
                $('#permission_parent_no').select2();
                $('#permission_operations').select2();

            }


        });

        return false;
    });
    $('.select-search').select2();

    $(document).on('change','.permission-checkbox',function () {
        if($(this).prop("checked")){
            $(this).parent().removeClass('unselected-permission');
            $(this).parent().addClass('success-permission');
            $(this).parent().next().removeClass('unselected-permission');
            $(this).parent().next().addClass('success-permission');
        }else{
            $(this).parent().addClass('unselected-permission');
            $(this).parent().removeClass('success-permission');
            $(this).parent().next().addClass('unselected-permission');
            $(this).parent().next().removeClass('success-permission');
        }
    });

    $('.select-fixed').select2({
        minimumResultsForSearch: "-1",
        width: 250
    });

    $(document).on('click','.new-permission-btn',function(){
        $('#permissions_submit_form input').val('');
        $('#permissions_submit_form').find('#permission_operations').val('');
        $('#permissions_submit_form').find('#permission_type').val('parent');
        $('#permissions_submit_form').find('#permission_parent_no').val('');
        $('#permission_type').select2({
            // options
        });
        $('#permission_parent_no').select2();
        $('#permission_operations').select2();
        return false;
    });
    $(document).on('submit', '#submit_user_permissions', function() {
        var user_no = $('#user_id').val();
        var navigate_to = base_url+'permissions/users/'+user_no+'/edit';


        var submit = $(this).find("button[type='submit'] > .loader");
        loader(submit,true);// show loader and disable button
        $.ajax({
            type: 'post',
            dataType: "json",
            url: navigate_to,
            data: new FormData(this),
            cache: "false",
            contentType: false,
            processData: false,
            success: function(data) {
                notificationMessage('رسالة نجاح','تم تعديل الصلاحيات بنجاح','bg-success') ;

                loader(submit,false);// hide loader and un-disable button

            },error:function(data){

                notificationMessage('رسالة خطأ','يوجد خطأ في بعض المدخلات','bg-danger') ;


                loader(submit,false);// hide loader and un-disable button
            }

        });
        return false;

    });

});

