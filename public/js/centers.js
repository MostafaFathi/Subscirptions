/**
 * Created by mhilles on 08/06/2017.
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

function tableLoader(table_id,span){
    var loader = '<tr><td colspan="'+span+'" style="text-align: center"><i class="icon-spinner2 spinner position-left"></i></td></tr>';
    $(table_id+' tbody').html(loader);
}
function tableLoaderAfter(table_id,span){
    var loader = '<tr><td colspan="'+span+'" style="text-align: center"><i class="icon-spinner2 spinner position-left"></i></td></tr>';
    $(table_id+' tbody tr:last').after(loader);
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

function clearTableRows(table){
   $(table+' tbody').html('');
}
var allowQuery  = true;
var last_id=11;
function getUrl(parent_route,key,source,child_route,last_id){
    var length = key.length;
    //if(length==0) limit = 0;
    var navigate_to = base_url;
    if(length == 0)
        navigate_to += parent_route+'/empty/'+source+'/'+last_id+'/'+child_route;
    else if(length > 0)
        navigate_to += parent_route+'/'+key+'/'+source+'/'+last_id+'/'+child_route;

    return navigate_to;


}


function search(parent_route,key,source,child_route,table_class,html_after) {
    var navigate_to  =  getUrl(parent_route,key,source,child_route,last_id);
     allowQuery = true;
    $.ajax({
        type: 'get',
        dataType: "json",
        url: navigate_to,
        data: '',
        cache: "false",

        success: function(data) {

             if(html_after == 'html'){
                  $('.'+table_class+' tbody').html(JSON.parse(data['result'])) ;
            }
            else if(html_after=='after' && data['counts'] > 0){
                  $('.'+table_class+' tbody tr:last').after(JSON.parse(data['result']));
                  last_id = data['last_id'];
            }

            if( data['counts'] == 0 || data['counts'] < 11){
                allowQuery = false;
                console.log('no count');

            }


         },error:function(data){
        }

    });
    return false;

}

function  handleScroll(component)
{
    var div_hieght = $(component).height();
    var div_scrollTop = $(this).scrollTop();
    var flag_status = false;
    if(div_scrollTop >= div_hieght-50)
        flag_status = true;

    return flag_status;
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
    $(document).on('submit', '#center_submit_form', function(e) {

        var navigate_to = base_url;
        if(add_button)
            navigate_to+='center/add';
        else if(update_button)
            navigate_to+='center/update';

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
                // if(data['user'].img != 'default_user.png') url= base_url+'uploads/users'; else url= base_url+'images';
                // $("#branch-table tbody tr:last").after('<tr> <td> <div class="media-left media-middle" style="padding-right: 0px;"> </div> <div class="media-body" style="width: 0px"> <div class="media-heading user-names"> <a href="#" class="letter-icon-title update-user-btn-sub">'+data['branch'].branch_name+'</a> <input type="hidden" name="user_id" class="user_id" value="'+data['branch'].id+'" /></h6> </div> <div class="text-muted text-size-small"><i class="icon-phone text-size-mini position-left"></i>'+data['branch'].branch_phone+'</div> </div> </td> <td> <span class="text-muted text-size-small">'+data['branch'].created_at+'</span> </td> <td> <h6 class="text-semibold no-margin"><a href="#" class="update-branch-btn" data-popup="tooltip" title="تعديل"> <i class=" icon-pencil7 update-icon"></i> </a> <a href="#" class="sweet_combine delete-and-migrate" data-popup="tooltip" title="حذف وترحيل"> <i class=" icon-cancel-square" style=" color: #d84315;font-size: 18px;"></i> </a> <a href="#" class="sweet_combine delete-finaly" data-popup="tooltip" title="حذف كلي"> <i class=" icon-cancel-square2" style=" color: #d84315;font-size: 18px;"></i> </a> <input type="hidden" name="branch_id" class="branch_id" value="'+data['branch'].id+'" /></h6> </td> </tr>');
                if(data['center'].center_cover_img != 'default_center.png') url= base_url+'uploads/centers'; else url= base_url+'images';
                $('#center_submit_form').find('#center_img').attr('src',url+'/'+data['center'].center_cover_img );
                if(add_button)
                    notificationMessage('رسالة نجاح','تم إضافة مركز جديد بنجاح!','bg-success') ;
                else if(update_button)
                    notificationMessage('رسالة نجاح','تم تعديل بيانات المركز بنجاح','bg-success') ;


                var success = data.responseJSON;
                validation(success,'center_name',true,"#center_submit_form");
                validation(success,'center_phone',true,"#center_submit_form");
                validation(success,'center_address',true,"#center_submit_form");
                validation(success,'center_owner',true,"#center_submit_form");
                validation(success,'center_cover_img',true,"#center_submit_form");
                validation(success,'center_email',true,"#center_submit_form");



                loader(submit,false);// hide loader and un-disable button

            },error:function(data){

                notificationMessage('رسالة خطأ','يوجد خطأ في بعض المدخلات','bg-danger') ;

                var errors = data.responseJSON;
                validation(errors,'center_name',false,"#center_submit_form");
                validation(errors,'center_phone',false,"#center_submit_form");
                validation(errors,'center_address',false,"#center_submit_form");
                validation(errors,'center_owner',false,"#center_submit_form");
                validation(errors,'center_cover_img',false,"#center_submit_form");
                validation(errors,'center_email',false,"#center_submit_form");

                loader(submit,false);// hide loader and un-disable button
            }

        });
        return false;

    });

    var centers_table_row;
    var before_row;
    $(document).on('click','.update-center-btn',function(){
        centers_table_row = $(this).parent().parent();
        before_row = centers_table_row.parent().parent().prev();
        var center_id =  $(this).parent().find('.center_id').val();


        var success = '';
        validation(success,'name',true,"#center_submit_form");
        validation(success,'password',true,"#center_submit_form");
        validation(success,'email',true,"#center_submit_form");
        validation(success,'phone',true,"#center_submit_form");
        validation(success,'branch_id',true,"#center_submit_form");
        validation(success,'gender',true,"#center_submit_form");


        // var block = $('#center_submit_form.blockMe');
        // blockLoader(block);


        $.ajax({
            type: 'get',
            dataType: "json",
            url: base_url + 'center/'+center_id+'/edit',
            data: "",
            cache: "false",
            success: function(data) {
                var result = data.responseJSON;
                $('.form-user-name').text(data['manager_user']);

                $('#center_submit_form').find('#center_name').val(data['result'].center_name);
                $('#center_submit_form').find('#center_id_form').val(data['result'].center_id);
                $('#center_submit_form').find('#center_email').val(data['result'].center_email);
                $('#center_submit_form').find('#center_phone').val(data['result'].center_phone);
                $('#center_submit_form').find('#center_cover_img').val('');
                $('#center_submit_form').find('.filename').text('No file Selected');
                var url='';
                if(data['result'].center_cover_img !== 'default_center.png') url= base_url+'uploads/centers'; else url= base_url+'images';
                $('#center_submit_form').find('#center_img').attr('src',url+'/'+data['result'].center_cover_img );


                if(data['result'].status === 'active'){
                    $('input[name="status"]').bootstrapSwitch('state', true, true);
                }
                else
                {
                    $('input[name="status"]').bootstrapSwitch('state', false, false);
                   // $('#center_submit_form').find('#status').prop('checked',false);
                }


                // $("[name='status']").bootstrapSwitch({
                // });
                // $(block).unblock();
            }


        });

        return false;
    });

    $(document).on('submit', '#open_center_submit_form', function(e) {


        var submit = $(this).find("button[type='submit'] > .loader");
        loader(submit,true);// show loader and disable button

        $.ajax({
            type: 'post',
            dataType: "json",
            url: base_url+'center/opening/update',
            data: new FormData(this),
            cache: "false",
            contentType: false,
            processData: false,
            success: function(data) {

                var success = data.responseJSON;
                validation(success,'open_start_date',true,"#open_center_submit_form");
                notificationMessage('رسالة نجاح','تم إفتتاح سنة جديدة بنجاح!','bg-success') ;


                loader(submit,false);// hide loader and un-disable button

            },error:function(data){

                notificationMessage('رسالة خطأ','يوجد خطأ في بعض المدخلات','bg-danger') ;

                var errors = data.responseJSON;
                validation(errors,'open_start_date',false,"#open_center_submit_form");

                loader(submit,false);// hide loader and un-disable button
            }

        });
        return false;

    });
    //////////////////////////////////// search /////////////////////////////////////////////////
    $(document).on('keyup', '.search-input', function(e) {
        tableLoader('.users-popup-table',3);
        allowQuery = true;
        last_id = 0;
        search('center',$(this).val(),'users','search','users-popup-table','html');
        last_id = 11;
        return false;

    });

    $('#onshown_callback').on('click', function() {
        $('#modal_table_users').on('shown.bs.modal', function() {
            tableLoader('.users-popup-table',3);
            allowQuery = true;
            last_id = 0;
            search('center',$('.search-input').val(),'users','search','users-popup-table','html');
            last_id = 11;
        });
        $('#modal_table_users').on('hidden.bs.modal', function() {

            $('.users-popup-table tbody').html('');
            $('.users-popup-table').scrollTop(1);
            last_id = 11;
        });

    });


    $('.users-popup-table').scroll(function() {

        var div_hieght = $(this).height();
        var div_scrollTop = $(this).scrollTop();
        var div_scrollHeight =  $(this)[0].scrollHeight;

        if(allowQuery){
             if(div_scrollTop >= ((div_scrollHeight-div_hieght)-1)) {
                     search('center', 'empty', 'users', 'search', 'users-popup-table', 'after');
             }
        }
         return false;
    });

    $(document).on('click','.user_id',function(){
        var user_name = $(this).text();
        var user_id = $(this).find('input').val();
        $('.close').click();
        $('.form-user-name').text(user_name);
        $('.form-user-id').val(user_id);
        return false;
    });

    $("[name='status']").bootstrapSwitch({
     });
    $(document).on('click','.new-center-btn',function(){
       $('#center_submit_form input').val('');
        $('#center_submit_form').find('.filename').text('No file Selected');
        var url= base_url+'images/default_center.png';
        $('#center_submit_form').find('#center_img').attr('src',url);
        $('input[name="status"]').bootstrapSwitch('state', true, true);
        $('.form-user-name').text('غير محدد');

        return false;
    });





});

