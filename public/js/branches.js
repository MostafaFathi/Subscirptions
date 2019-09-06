/**
 * Created by mhilles on 06/06/2017.
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
var base_url = 'http://' + window.location.host+'/';
$(function() {
    var base_url = 'http://' + window.location.host+'/';
    $(document).on('submit', '#branch_submit_form', function() {
        var submit = $(this).find("button[type='submit'] > .loader");
        loader(submit,true);// show loader and disable button
        $.ajax({
            type: 'post',
            dataType: "json",
            url: base_url+'users/branches/add',
            data: new FormData(this),
            cache: "false",
            contentType: false,
            processData: false,
            success: function(data) {
                var url ='';
                // if(data['user'].img != 'default_user.png') url= base_url+'uploads/users'; else url= base_url+'images';
                $("#branch-table tbody tr:last").after('<tr> <td> <div class="media-left media-middle" style="padding-right: 0px;"> </div> <div class="media-body" style="width: 0px"> <div class="media-heading user-names"> <a href="#" class="letter-icon-title update-user-btn-sub">'+data['branch'].branch_name+'</a> <input type="hidden" name="user_id" class="user_id" value="'+data['branch'].id+'" /></h6> </div> <div class="text-muted text-size-small"><i class="icon-phone text-size-mini position-left"></i>'+data['branch'].branch_phone+'</div> </div> </td> <td> <span class="text-muted text-size-small">'+data['branch'].created_at+'</span> </td> <td> <h6 class="text-semibold no-margin"><a href="#" class="update-branch-btn" data-popup="tooltip" title="تعديل"> <i class=" icon-pencil7 update-icon"></i> </a> <a href="#" class="sweet_combine delete-and-migrate" data-popup="tooltip" title="حذف وترحيل"> <i class=" icon-cancel-square" style=" color: #d84315;font-size: 18px;"></i> </a> <a href="#" class="sweet_combine delete-finaly" data-popup="tooltip" title="حذف كلي"> <i class=" icon-cancel-square2" style=" color: #d84315;font-size: 18px;"></i> </a> <input type="hidden" name="branch_id" class="branch_id" value="'+data['branch'].id+'" /></h6> </td> </tr>');


                notificationMessage('رسالة نجاح','تم إضافة مستخدم جديد بنجاح!','bg-success') ;

                var success = data.responseJSON;
                validation(success,'branch_name',true,"#branch_submit_form");
                validation(success,'branch_phone',true,"#branch_submit_form");



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


$(document).on('submit', '#branch_update_form', function() {
    var submit = $(this).find("button[type='submit'] > .loader");
    loader(submit,true);// show loader and disable button
    var block =  $('#branch-block');
    blockLoader(block);
    $.ajax({
        type: 'post',
        dataType: "json",
        url: base_url+'users/branches/update',
        data: new FormData(this),
        cache: "false",
        contentType: false,
        processData: false,
        success: function(data) {
            var url ='';

            // users_table_row.parent().parent().parent().remove();

            if(data['result']=='success'){
                notificationMessage('رسالة نجاح','تم تعديل الفرع بنجاح!','bg-success') ;
                $("#branch-table tbody").find(users_table_row).html(' <td> <div class="media-left media-middle" style="padding-right: 0px;"> </div> <div class="media-body" style="width: 0px"> <div class="media-heading user-names"> <a href="#" class="letter-icon-title update-user-btn-sub">'+data['branch'].branch_name+'</a> <input type="hidden" name="branch_id" class="branch_id" value="'+data['branch'].branch_id+'" /></h6> </div> <div class="text-muted text-size-small"><i class="icon-phone text-size-mini position-left"></i>'+data['branch'].branch_phone+'</div> </div> </td> <td> <span class="text-muted text-size-small">'+data['branch'].created_at+'</span> </td> <td> <h6 class="text-semibold no-margin"><a href="#" class="update-branch-btn" data-popup="tooltip" title="تعديل"> <i class=" icon-pencil7 update-icon"></i> </a> <a href="#" class="sweet_combine delete-and-migrate" data-popup="tooltip" title="حذف وترحيل"> <i class=" icon-cancel-square" style=" color: #d84315;font-size: 18px;"></i> </a> <a href="#" class="sweet_combine delete-finaly" data-popup="tooltip" title="حذف كلي"> <i class=" icon-cancel-square2" style=" color: #d84315;font-size: 18px;"></i> </a> <input type="hidden" name="branch_id" class="branch_id" value="'+data['branch'].branch_id+'" /></h6> </td>');
                // before_row=  before_row.next();
                // users_table_row.parent().parent().parent().remove();
            }else{
                notificationMessage('رسالة خطأ','يوجد خطأ في بعض المدخلات','bg-danger') ;
            }


             var success = data.responseJSON;
            validation(success,'branch_name',true,"#branch_update_form");
            validation(success,'branch_phone',true,"#branch_update_form");


            loader(submit,false);// hide loader and un-disable button
            $(block).unblock();
        },error:function(data){

            notificationMessage('رسالة خطأ','يوجد خطأ في بعض المدخلات','bg-danger') ;


            var errors = data.responseJSON;
            validation(errors,'branch_name',false,"#branch_update_form");
            validation(errors,'branch_phone',false,"#branch_update_form");
            loader(submit,false);// hide loader and un-disable button
            $(block).unblock();
        }

    });
    return false;

});
$(document).on('click','.delete-finaly', function() {
    var branch_id =  $(this).parent().find('.branch_id').val();
    var table_row = $(this);
    swal({
            title: "هل أنت متأكد؟",
            text: "سيتم حذف الفرع وجميع السجلات المرتطبة فيه مثل \n( طلاب , مدرسين , رواتب ) نهائياً.",
            type: "warning",
            showCancelButton: true,
            confirmButtonColor: "#EF5350",
            confirmButtonText: "نعم, قم بالحذف",
            cancelButtonText: "لا, إلغاء الامر",
            closeOnConfirm: false,
            closeOnCancel: false
        },
        function(isConfirm){
            if (isConfirm) {

                $.ajax({
                    type: 'get',
                    dataType: "json",
                    url: base_url+ 'users/branch/'+branch_id+'/true/delete',
                    data: "",
                    cache: "false",
                    success: function(data) {
                        if(data['result'] == 'success'){
                            resultMessage("تم الحذف!","لقد قمت بالحذف بنجاح , ستغلق النافذة خلال 3 ثانية","success","#66BB6A",3000);
                            table_row.parent().parent().parent().remove();
                        }else if(data['result'] == "primary"){
                             resultMessage("حدث خطأ","لا يمكن حذف الفرع الرئيسي !","error","#EF5350",4000);
                        }else {
                            resultMessage("حدث خطأ","حدث خطأ ما أثناء عملية الحذف","error","#EF5350",4000);
                        }

                    }

                });

            }
            else {
                cancelDelete();
            }
        });
    return false;
});

$(document).on('click','.delete-and-migrate', function() {
    var branch_id =  $(this).parent().find('.branch_id').val();
    var table_row = $(this);
    swal({
            title: "هل أنت متأكد؟",
            text: "سيتم حذف الفرع و ( ترحيل ) السجلات المرتطبة فيه مثل \n( طلاب , مدرسين , رواتب ) إلى الفرع الرئيسي.",
            type: "warning",
            showCancelButton: true,
            confirmButtonColor: "#EF5350",
            confirmButtonText: "نعم, قم بالحذف",
            cancelButtonText: "لا, إلغاء الامر",
            closeOnConfirm: false,
            closeOnCancel: false
        },
        function(isConfirm){
            if (isConfirm) {

                $.ajax({
                    type: 'get',
                    dataType: "json",
                    url: base_url+ 'users/branch/'+branch_id+'/false/delete',
                    data: "",
                    cache: "false",
                    success: function(data) {
                        if(data['result'] == 'success'){
                            resultMessage("تم الحذف!","لقد قمت بالحذف بنجاح , ستغلق النافذة خلال 3 ثانية","success","#66BB6A",3000);
                            table_row.parent().parent().parent().remove();
                        }else if(data['result'] == "primary"){
                            resultMessage("حدث خطأ","لا يمكن حذف الفرع الرئيسي !","error","#EF5350",4000);
                        }else{
                            resultMessage("حدث خطأ","حدث خطأ ما أثناء عملية الحذف","error","#EF5350",4000);

                        }

                    }

                });

            }
            else {
                cancelDelete();
            }
        });
    return false;
});

    var users_table_row;
    var before_row;
    $(document).on('click','.update-branch-btn',function(){
        users_table_row = $(this).parent().parent().parent();
        before_row = users_table_row.parent().parent().parent().prev();
        var branch_id =  $(this).parent().find('.branch_id').val();
        $('#branch_submit_form').removeClass('show');
        $('#branch_submit_form').addClass('hide');

        $('#branch_update_form').removeClass('hide');
        $('#branch_update_form').addClass('show');

        $('#branch_update_form').velocity('transition.slideUpBigIn', {
            drag: true
        });

        var success = '';
         validation(success,'branch_name',true,"#branch_update_form");
        validation(success,'branch_phone',true,"#branch_update_form");

        var block = $('#branch_update_container');
        blockLoader(block);


        $.ajax({
            type: 'get',
            dataType: "json",
            url: base_url + 'users/branch/'+branch_id+'/edit',
            data: "",
            cache: "false",
            success: function(data) {
                 $('#branch_update_form').find('#branch_name').val(data['result'][0]['branch_name']);
                $('#branch_update_form').find('#branch_id').val(data['result'][0]['branch_id']);
                $('#branch_update_form').find('#branch_phone').val(data['result'][0]['branch_phone']);
                $('#branch_update_form').find('#branch_address').val(data['result'][0]['branch_address']);


                $(block).unblock();
            }


        });

        return false;
    });


$(document).on('click','.new-branch-btn',function(){

    $('#branch_submit_form').removeClass('hide');
    $('#branch_submit_form').addClass('show');

    $('#branch_update_form').removeClass('show');
    $('#branch_update_form').addClass('hide');

    $('#branch_submit_form').velocity('transition.slideUpBigIn', {
        drag: true
    });
    return false;
});



});