/**
 * Created by mhilles on 19/06/2017.
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
function optimal_loader(span_class,show_hide){
    if(show_hide == 'show'){
        $(span_class).css('display','initial');
    }else{
        $(span_class).css('display','none');
    }
}

//////////////////////////////////////////////////////////////////////////////////////////////
//                              End Of Common Functions                                     //
//////////////////////////////////////////////////////////////////////////////////////////////
var add_button = false;
var renew_button = false;
$(document).on('click','#add-button',function(){
    add_button = true;
    renew_button = false;
});
$(document).on('click','#renew-button',function(){
    add_button = false;
    renew_button = true;
});

var base_url = 'http://' + window.location.host+'/';
$(function() {
    var base_url = 'http://' + window.location.host+'/';

    //
    // $(document).on('change', '#product_section', function() {
    //   if($('#product_section').val() == 0){
    //       $('.restaurant_section').removeClass('hide');
    //       $('.restaurant_section').addClass('show');
    //   }else{
    //       $('.restaurant_section').removeClass('show');
    //       $('.restaurant_section').addClass('hide');
    //   }
    //   $('#product_rest').val('').select2();
    //     return false;
    // });


    $(document).on('change', '.product_section_manage', function() {
      if($(this).val() == 0){
          $(this).parent().parent().parent().parent().find('.restaurant_section').removeClass('hide');
          $(this).parent().parent().parent().parent().find('.restaurant_section').addClass('show');
      }else{
          $(this).parent().parent().parent().parent().find('.restaurant_section').removeClass('show');
          $(this).parent().parent().parent().parent().find('.restaurant_section').addClass('hide');
      }
        $(this).parent().parent().parent().parent().find('#product_rest').val('').select2();
        return false;
    });


    $(document).on('submit', '#product_submit_form', function() {

        var submit = $(this).find("button[type='submit'] > .loader");
        loader(submit,true);// show loader and disable button
        var student_id = $('#student_id').val();
        var navigate_to = base_url;
        if(add_button)
            navigate_to+='products/add';



        $.ajax({
            type: 'post',
            dataType: "json",
            url: navigate_to,
            data: new FormData(this),
            cache: "false",
            contentType: false,
            processData: false,
            success: function(data) {

                var success = data.responseJSON;
                validation(success,'product_name',true,"#product_submit_form");
                if(add_button)
                    notificationMessage('رسالة نجاح','تم إضافة منتج جديد بنجاح!','bg-success') ;


                loader(submit,false);// hide loader and un-disable button
                $('#reset-button').click();

            },error:function(data){

                loader(submit,false);// hide loader and un-disable button

                notificationMessage('رسالة خطأ','يوجد خطأ في بعض المدخلات','bg-danger') ;
                var errors = data.responseJSON;

                validation(errors,'product_name',false,"#product_submit_form");
            }

        });
        return false;

    });


    $(document).on('submit', '#restaurant_submit_form', function() {

        var submit = $(this).find("button[type='submit'] > .loader");
        loader(submit,true);// show loader and disable button
        var navigate_to = base_url;
        if(add_button)
            navigate_to+='restaurant/add';

        $.ajax({
            type: 'post',
            dataType: "json",
            url: navigate_to,
            data: new FormData(this),
            cache: "false",
            contentType: false,
            processData: false,
            success: function(data) {

                var success = data.responseJSON;
                validation(success,'rest_name',true,"#restaurant_submit_form");
                if(add_button)
                    notificationMessage('رسالة نجاح','تم إضافة قسم جديد بنجاح!','bg-success') ;


                loader(submit,false);// hide loader and un-disable button
                $('#reset-button').click();

            },error:function(data){

                notificationMessage('رسالة خطأ','يوجد خطأ في بعض المدخلات','bg-danger') ;

                var errors = data.responseJSON;
                validation(errors,'rest_name',false,"#restaurant_submit_form");

                loader(submit,false);// hide loader and un-disable button
            }

        });
        return false;

    });


    $(document).on('submit', '#branch_submit_form', function() {

        var submit = $(this).find("button[type='submit'] > .loader");
        loader(submit,true);// show loader and disable button
        var navigate_to = base_url;
        if(add_button)
            navigate_to+='branches/add';

        $.ajax({
            type: 'post',
            dataType: "json",
            url: navigate_to,
            data: new FormData(this),
            cache: "false",
            contentType: false,
            processData: false,
            success: function(data) {

                var success = data.responseJSON;
                validation(success,'rest_name',true,"#branch_submit_form");
                if(add_button)
                    notificationMessage('رسالة نجاح','تم إضافة قسم فرعي جديد بنجاح!','bg-success') ;


                loader(submit,false);// hide loader and un-disable button
                $('#reset-button').click();

            },error:function(data){

                notificationMessage('رسالة خطأ','يوجد خطأ في بعض المدخلات','bg-danger') ;

                var errors = data.responseJSON;
                validation(errors,'rest_name',false,"#branch_submit_form");

                loader(submit,false);// hide loader and un-disable button
            }

        });
        return false;

    });


    $(document).on('submit', '#regions_submit_form', function() {

        var submit = $(this).find("button[type='submit'] > .loader");
        loader(submit,true);// show loader and disable button
        var navigate_to = base_url;
        if(add_button)
            navigate_to+='region/add';

        $.ajax({
            type: 'post',
            dataType: "json",
            url: navigate_to,
            data: new FormData(this),
            cache: "false",
            contentType: false,
            processData: false,
            success: function(data) {

                var success = data.responseJSON;
                validation(success,'region_name',true,"#regions_submit_form");
                validation(success,'region_commission',true,"#regions_submit_form");
                if(add_button)
                    notificationMessage('رسالة نجاح','تم إضافة منطقة جديدة بنجاح!','bg-success') ;


                loader(submit,false);// hide loader and un-disable button
                $('#reset-button').click();

            },error:function(data){

                notificationMessage('رسالة خطأ','يوجد خطأ في بعض المدخلات','bg-danger') ;

                var errors = data.responseJSON;
                validation(errors,'region_name',false,"#regions_submit_form");
                validation(errors,'region_commission',false,"#regions_submit_form");

                loader(submit,false);// hide loader and un-disable button
            }

        });
        return false;

    });


    $(document).on('submit', '#commition_submit_form', function() {

        var submit = $(this).find("button[type='submit'] > .loader");
        loader(submit,true);// show loader and disable button
        var navigate_to = base_url;
        if(add_button)
            navigate_to+='commition/update';

        $.ajax({
            type: 'post',
            dataType: "json",
            url: navigate_to,
            data: new FormData(this),
            cache: "false",
            contentType: false,
            processData: false,
            success: function(data) {

                var success = data.responseJSON;
                validation(success,'value',true,"#commition_submit_form");
                if(add_button)
                    notificationMessage('رسالة نجاح','تم تحديث العمولة بنجاح!','bg-success') ;


                loader(submit,false);// hide loader and un-disable button
                $('#reset-button').click();

            },error:function(data){

                notificationMessage('رسالة خطأ','يوجد خطأ في بعض المدخلات','bg-danger') ;

                var errors = data.responseJSON;
                validation(errors,'value',false,"#commition_submit_form");

                loader(submit,false);// hide loader and un-disable button
            }

        });
        return false;

    });

    $(document).on('submit', '#timesWork_submit_form', function() {

        var submit = $(this).find("button[type='submit'] > .loader");
        loader(submit,true);// show loader and disable button
        var navigate_to = base_url;
        if(add_button)
            navigate_to+='timesWork/update';

        $.ajax({
            type: 'post',
            dataType: "json",
            url: navigate_to,
            data: new FormData(this),
            cache: "false",
            contentType: false,
            processData: false,
            success: function(data) {

                var success = data.responseJSON;
                validation(success,'value',true,"#timesWork_submit_form");
                if(add_button)
                    notificationMessage('رسالة نجاح','تم تحديث مواعيد العمل بنجاح!','bg-success') ;


                loader(submit,false);// hide loader and un-disable button

            },error:function(data){

                notificationMessage('رسالة خطأ','يوجد خطأ في بعض المدخلات','bg-danger') ;

                var errors = data.responseJSON;
                validation(errors,'value',false,"#timesWork_submit_form");

                loader(submit,false);// hide loader and un-disable button
            }

        });
        return false;

    });


    $(document).on('submit', '.product_update_form', function() {
        var this_form = $(this);
        var submit = $(this).find("button[type='submit'] > .loader");
        var product_id = $(this).find(".product_id").val();
        loader(submit,true);// show loader and disable button
        $.ajax({
            type: 'post',
            dataType: "json",
            url: base_url+'products/'+product_id+'/update',
            data: new FormData(this),
            cache: "false",
            contentType: false,
            processData: false,
            success: function(data) {

                var product_section_select_box = this_form.find('#product_section');
                var product_section =  product_section_select_box.find('option[value='+product_section_select_box.val()+']').text();

                var unit_id_select_box = this_form.find('#unit_id');
                var unit_id =  unit_id_select_box.find('option[value='+unit_id_select_box.val()+']').text();

                var product_rest_select_box = this_form.find('#product_rest');
                var product_rest="";
                if (product_rest_select_box.val()!==''){
                    product_rest =  product_rest_select_box.find('option[value='+product_rest_select_box.val()+']').text();
                }

                var product_city_select_box = this_form.find('#product_city');
                var product_city =  product_city_select_box.find('option[value='+product_city_select_box.val()+']').text();

                this_form.parent().parent().parent().prev().find('.product-name').text(data['product'].product_name);
                this_form.parent().parent().parent().prev().find('.product-price').text(data['product'].product_price);
                this_form.parent().parent().parent().prev().find('.section-name').text(product_section);
                this_form.parent().parent().parent().prev().find('.unit-id').text(unit_id);
                this_form.parent().parent().parent().prev().find('.rest-name').text(product_rest);
                // this_form.parent().parent().parent().prev().find('.city-name').text(product_city);
                var success = data.responseJSON;
                validation(success,'product_name',true,'.product_update_form');

                notificationMessage('رسالة نجاح','تم تعديل المنتج بنجاح!','bg-success') ;
                loader(submit,false);// hide loader and un-disable button

            },error:function(data){

                notificationMessage('رسالة خطأ','يوجد خطأ في بعض المدخلات','bg-danger') ;

                var errors = data.responseJSON;
                validation(errors,'product_name',false,'.product_update_form');

                loader(submit,false);// hide loader and un-disable button
            }

        });
        return false;

    });

    $(document).on('submit', '.restaurant_update_form', function() {
        var this_form = $(this);
        var submit = $(this).find("button[type='submit'] > .loader");
        var id = $(this).find(".id").val();
        loader(submit,true);// show loader and disable button
        $.ajax({
            type: 'post',
            dataType: "json",
            url: base_url+'restaurant/'+id+'/update',
            data: new FormData(this),
            cache: "false",
            contentType: false,
            processData: false,
            success: function(data) {


                var product_section_select_box = this_form.find('#product_section');
                var product_section =  product_section_select_box.find('option[value='+product_section_select_box.val()+']').text();


                var has_branches_select_box = this_form.find('#has_branches');
                var has_branches =  has_branches_select_box.find('option[value='+has_branches_select_box.val()+']').text();


                this_form.parent().parent().parent().prev().find('.section-name').text(product_section);
                this_form.parent().parent().parent().prev().find('.has-branches').text(has_branches);


                this_form.parent().parent().parent().prev().find('.rest-name').text(data['rest'].rest_name);
                this_form.parent().parent().parent().prev().find('.discount').text(data['rest'].discount);

                var success = data.responseJSON;
                validation(success,'rest_name',true,'.restaurant_update_form');

                notificationMessage('رسالة نجاح','تم تعديل القسم بنجاح!','bg-success') ;
                loader(submit,false);// hide loader and un-disable button

            },error:function(data){

                notificationMessage('رسالة خطأ','يوجد خطأ في بعض المدخلات','bg-danger') ;

                var errors = data.responseJSON;
                validation(errors,'rest_name',false,'.restaurant_update_form');

                loader(submit,false);// hide loader and un-disable button
            }

        });
        return false;

    });

    $(document).on('submit', '.branches_update_form', function() {
        var this_form = $(this);
        var submit = $(this).find("button[type='submit'] > .loader");
        var id = $(this).find(".id").val();
        loader(submit,true);// show loader and disable button
        $.ajax({
            type: 'post',
            dataType: "json",
            url: base_url+'branches/'+id+'/update',
            data: new FormData(this),
            cache: "false",
            contentType: false,
            processData: false,
            success: function(data) {


                var branch_id_select_box = this_form.find('#branch_id');
                var branch_id =  branch_id_select_box.find('option[value='+branch_id_select_box.val()+']').text();


                this_form.parent().parent().parent().prev().find('.branch-name').text(branch_id);


                this_form.parent().parent().parent().prev().find('.rest-name').text(data['rest'].rest_name);

                var success = data.responseJSON;
                validation(success,'rest_name',true,'.branches_update_form');

                notificationMessage('رسالة نجاح','تم تعديل القسم بنجاح!','bg-success') ;
                loader(submit,false);// hide loader and un-disable button

            },error:function(data){

                notificationMessage('رسالة خطأ','يوجد خطأ في بعض المدخلات','bg-danger') ;

                var errors = data.responseJSON;
                validation(errors,'rest_name',false,'.branches_update_form');

                loader(submit,false);// hide loader and un-disable button
            }

        });
        return false;

    });


    $(document).on('submit', '.region_update_form', function() {
        var this_form = $(this);
        var submit = $(this).find("button[type='submit'] > .loader");
        var id = $(this).find(".id").val();
        loader(submit,true);// show loader and disable button
        $.ajax({
            type: 'post',
            dataType: "json",
            url: base_url+'region/'+id+'/update',
            data: new FormData(this),
            cache: "false",
            contentType: false,
            processData: false,
            success: function(data) {
                this_form.parent().parent().parent().prev().find('.region-name').text(data['rest'].region_name);
                this_form.parent().parent().parent().prev().find('.region-commission').text(data['rest'].region_commission);

                var success = data.responseJSON;
                validation(success,'region_name',true,'.region_update_form');
                validation(success,'region_commission',true,'.region_update_form');

                notificationMessage('رسالة نجاح','تم تعديل المنطقة بنجاح!','bg-success') ;
                loader(submit,false);// hide loader and un-disable button

            },error:function(data){

                notificationMessage('رسالة خطأ','يوجد خطأ في بعض المدخلات','bg-danger') ;

                var errors = data.responseJSON;
                validation(errors,'region_name',false,'.region_update_form');
                validation(errors,'region_commission',false,'.region_update_form');

                loader(submit,false);// hide loader and un-disable button
            }

        });
        return false;

    });

    $(document).on('click','.delete-product-btn', function() {
        var product_id =  $(this).parent().find('.product_id').val();
        var table_row = $(this);
        swal({
                title: "هل أنت متأكد؟",
                text: "سيتم حذف المنتج بشكل نهائي.",
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
                        url: base_url+ 'products/'+product_id+'/delete',
                        data: "",
                        cache: "false",
                        success: function(data) {
                            if(data['result'] == 'success'){
                                resultMessage("تم الحذف!","لقد قمت بالحذف بنجاح , ستغلق النافذة خلال 3 ثانية","success","#66BB6A",3000);
                                table_row.parent().parent().next().remove();
                                table_row.parent().parent().remove();
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
    $(document).on('click','.certify-request-btn', function() {
        var request_id =  $(this).parent().find('.request_id').val();
        var table_row = $(this);
        $.ajax({
            type: 'get',
            dataType: "json",
            url: base_url+ 'requests/'+request_id+'/certify',
            data: "",
            cache: "false",
            success: function(data) {
                if(data['result'] == 'success'){
                    table_row.parent().parent().remove();
                    $('.request_'+request_id).remove();
                }

            }

        });
        return false;
    });
    $(document).on('click','.delete-restaurant-btn', function() {
        var restaurant_id =  $(this).parent().find('.restaurant_id').val();
        var table_row = $(this);
        swal({
                title: "هل أنت متأكد؟",
                text: "سيتم حذف القسم بشكل نهائي.",
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
                        url: base_url+ 'restaurant/'+restaurant_id+'/delete',
                        data: "",
                        cache: "false",
                        success: function(data) {
                            if(data['result'] == 'success'){
                                resultMessage("تم الحذف!","لقد قمت بالحذف بنجاح , ستغلق النافذة خلال 3 ثانية","success","#66BB6A",3000);
                                table_row.parent().parent().next().remove();
                                table_row.parent().parent().remove();
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
    $(document).on('click','.delete-branches-btn', function() {
        var restaurant_id =  $(this).parent().find('.restaurant_id').val();
        var table_row = $(this);
        swal({
                title: "هل أنت متأكد؟",
                text: "سيتم حذف القسم بشكل نهائي.",
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
                        url: base_url+ 'branches/'+restaurant_id+'/delete',
                        data: "",
                        cache: "false",
                        success: function(data) {
                            if(data['result'] == 'success'){
                                resultMessage("تم الحذف!","لقد قمت بالحذف بنجاح , ستغلق النافذة خلال 3 ثانية","success","#66BB6A",3000);
                                table_row.parent().parent().next().remove();
                                table_row.parent().parent().remove();
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

    $(document).on('click','.delete-region-btn', function() {
        var restaurant_id =  $(this).parent().find('.region_id').val();
        var table_row = $(this);
        swal({
                title: "هل أنت متأكد؟",
                text: "سيتم حذف المنطقة بشكل نهائي.",
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
                        url: base_url+ 'region/'+restaurant_id+'/delete',
                        data: "",
                        cache: "false",
                        success: function(data) {
                            if(data['result'] == 'success'){
                                resultMessage("تم الحذف!","لقد قمت بالحذف بنجاح , ستغلق النافذة خلال 3 ثانية","success","#66BB6A",3000);
                                table_row.parent().parent().next().remove();
                                table_row.parent().parent().remove();
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


    $(document).on('change', '.product_section_change', function() {
        var section_id = $(this).val();
        $.ajax({
            type: 'get',
            dataType: "json",
            url: base_url+ 'getSubMain/'+section_id,
            data: "",
            cache: "false",
            success: function(data) {

            $('.restaurant_section').html(data['select']);
            $('#product_rest').select2();
                $('.branches_section').html('');
            }

        });

            return false;
        }
    );

    $(document).on('change', '.product_rest_change', function() {
        var section_id = $(this).val();
        $.ajax({
            type: 'get',
            dataType: "json",
            url: base_url+ 'getBranches/'+section_id,
            data: "",
            cache: "false",
            success: function(data) {

            $('.branches_section').html(data['select']);
            $('#product_rest_branch').select2();
            }

        });

            return false;
        }
    );



























    $(document).on('click','.undo-delete-student-btn', function() {
        var student_id =  $(this).parent().find('.student_id').val();
        var table_row = $(this);
        swal({
                title: "هل أنت متأكد؟",
                text: "سيتم إستعادة جميع بيانات الطالب.",
                type: "warning",
                showCancelButton: true,
                confirmButtonColor: "#ffbd22",
                confirmButtonText: "نعم, قم بالإرجاع",
                cancelButtonText: "لا, إلغاء الامر",
                closeOnConfirm: false,
                closeOnCancel: false
            },
            function(isConfirm){
                if (isConfirm) {

                    $.ajax({
                        type: 'get',
                        dataType: "json",
                        url: base_url+ 'students/'+student_id+'/undo_recycle',
                        data: "",
                        cache: "false",
                        success: function(data) {
                            if(data['result'] == 'success'){
                                resultMessage("تم الحذف!","لقد قمت بالإرجاع بنجاح , ستغلق النافذة خلال 3 ثانية","success","#66BB6A",3000);
                                table_row.parent().parent().next().remove();
                                table_row.parent().parent().remove();
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

    $(document).on('keyup', '#student_name', function() {
        // var student_name = $(this).val() != '' ? $(this).val() : 'all';
        var student_name = $(this).val();
        if(student_name.length < 2){
            $('.input-search').css('display','none');
            return false;
        }
        $('.input-search').css('display','initial');
        optimal_loader('.optimal-loader','show');
        $.ajax({
            type: 'get',
            dataType: "json",
            url: base_url+'students/'+student_name+'/search/basic',
            data: new FormData(this),
            cache: "false",
            contentType: false,
            processData: false,
            success: function(data) {
                optimal_loader('.optimal-loader','hide');
                if(data['count-students'] == 0){
                $('.input-search').css('display','none');
                $('.no-match-record').css('display','block');
                $('.input-search ul .record').remove();
                }else{
                    $('.input-search ul .record').remove();

                    $('.no-match-record').css('display','none');
                    $('.no-match-record').before(data['search-result']);
                }
            },error:function(data){


            }

        });
        return false;

    });
    $(document).mouseup(function(e)
    {
        var container = $(".input-search");

        // if the target of the click isn't the container nor a descendant of the container
        if (!container.is(e.target) && container.has(e.target).length === 0)
        {
            container.hide();
        }
    });
    $(document).on('click','#student_name',function(e)
    {
        var container = $(".input-search");
        var has_items = $(".input-search ul .record").length;
        if(has_items < 1){
            return false;
        }
        if (!container.is(e.target) && container.has(e.target).length === 0)
        {
            container.show();
        }
    });

    $(document).on('click','.record',function(e)
    {
        get_set('#student_id',$(this).find('.list-student-id'));
        get_set('#student_name',$(this).find('.list-student-name'));
        get_set('#student_address',$(this).find('.list-student-address'));
        get_set('#student_father_work',$(this).find('.list-student-father-work'));
        get_set('#student_age',$(this).find('.list-student-age'));
        get_set('.student_gender',$(this).find('.list-student-gender'));
        get_set('#student_phone',$(this).find('.list-student-phone'));
        get_set('#student_phone2',$(this).find('.list-student-phone2'));
         get_set('#student_school',$(this).find('.list-student-school'));
        get_set('#level_id',$(this).find('.list-student-level'));
        get_set('#branch_id',$(this).find('.list-student-branch'));
        if($(this).find('.list-student-gender').val() == 'm'){
            $('.f_student_gender').parent().removeClass('checked');
            $('.m_student_gender').prop('checked',true);
            $('.m_student_gender').parent().addClass('checked');

            $('.student-gender > .gender').text('ذكر');
            $('.student-image').attr('src',base_url+'images/ui/m_student.png');
        }
        if($(this).find('.list-student-gender').val() == 'f')
        {
            $('.m_student_gender').parent().removeClass('checked');
            $('.f_student_gender').prop('checked',true);
            $('.f_student_gender').parent().addClass('checked');

            $('.student-gender > .gender').text('أنثى')
            $('.student-image').attr('src',base_url+'images/ui/f_student.png');
        }

        //old date
        $('.old-reg-date').css('display','initial');
        $('.old-reg-date').text('تاريخ الاشتراك القديم: '+$(this).find('.list-student-reg-date').val());
        //

        // student cart
        $('.student-name > .name').text($(this).find('.list-student-name').val());
         $('#level_id').change();
        //
        $('.input-search').css('display','none');
        $('#level_id').select2();
        $('#branch_id').select2();
       return false;

    });
    $(document).on('click', '#reset-button', function() {
            $('#student_submit_form').find(
                'input[name=student_name],input[name=student_address],input[name=student_father_work],input[name=student_age],input[name=student_school],input[name=student_phone],input[name=student_phone2],input[name=student_id]').val('');
        $('#level_id').val(1);
        $('#level_id').select2();
        $('#branch_id').select2();
        $('.old-reg-date').css('display','none');
        $('.old-reg-date').text('');
        $('.student-name > .name').text('طالب جديد');
        $('#level_id').change();
        return false;
        }
    );
    function get_set(set_for,get_from){
        $(set_for).val($(get_from).val());
    }

    $('.select-search').select2();


    $(document).on('keyup', '#student_name', function() {
        var student_name =  $(this).val();
        $('.student-name > .name').text(student_name);
        return false;
    });
    $(document).on('change', '.student_gender', function() {
        var student_gender =  $(this).val();
        if(student_gender == 'm') {
            $('.student-gender > .gender').text('ذكر');
            $('.student-image').attr('src',base_url+'images/ui/m_student.png');
        }
        if(student_gender == 'f'){
            $('.student-gender > .gender').text('أنثى')
            $('.student-image').attr('src',base_url+'images/ui/f_student.png');};

      $(this).prop('checked',true);

        return false;
    });

    $(document).on('change', '#level_id', function() {
        var student_level =  $(this).find('option[value='+$(this).val()+']').text();
        $('.student-level > .level').text(student_level);
        return false;
    });

    var button_clicked = '';
    $(document).on('click', '.show-student-btn', function() {
            // $('#students-table .details-rows').addClass('hide-td');
            // $('#students-table .details-rows .input-hide').css('display','none');
            $(this).parent().parent().next().find('.input-hide').css('display','none');
            // $('#students-table tr:odd').removeClass('selected-td-show');


            $(this).parent().parent().addClass('selected-td-show');
            if(button_clicked == 'update-btn'){
                button_clicked = 'show-details';
            }else{
                if($(this).parent().parent().next().css('display') == 'table-row')
                    $(this).parent().parent().removeClass('selected-td-show');
                $(this).parent().parent().next().slideToggle(1);
            }
            button_clicked = 'show-details';
            $(this).parent().parent().next().find('.input').css('display','initial');
            $(this).parent().parent().next().find('.img-div').css('display','initial');
            $(this).parent().parent().next().find('.update-button').css('display','none');
        return false;
    }
     );
    $(document).on('click', '.show-details', function() {
        // $('#students-table .details-rows').addClass('hide-td');
        // $('#students-table tr:odd').removeClass('selected-td-show');
            $(this).addClass('selected-td-show');
        if(button_clicked == 'update-btn'){
            button_clicked = 'show-details';
        }else{
            if($(this).next().css('display') == 'table-row')
                $(this).removeClass('selected-td-show');
            var request_id = $(this).find('.request_id').val();
            $('.request_'+request_id).slideToggle(1);

        }
        button_clicked = 'show-details';

        $(this).next().find('.input').css('display','initial');
        $(this).next().find('.input-hide').css('display','none');
        $(this).next().find('.update-button').css('display','none');
        $(this).next().find('.img-div').css('display','initial');

            return false;
        }
    );

    $(document).on('click', '.update-student-btn', function() {
            //     $('#students-table .details-rows').addClass('hide-td');
            $(this).parent().parent().next().find('.input').css('display','none');
            // $('#students-table tr:odd').removeClass('selected-td-show');
            $(this).parent().parent().addClass('selected-td-show');
            if(button_clicked == 'show-details'){
                button_clicked = 'update-btn';
            }else{
                if($(this).parent().parent().next().css('display') == 'table-row')
                    $(this).parent().parent().removeClass('selected-td-show');
                $(this).parent().parent().next().slideToggle(1);
            }
            button_clicked = 'update-btn';
            $(this).parent().parent().next().find('.input-hide').css('display','initial');
            $(this).parent().parent().next().find('.update-button').css('display','initial');
            $(this).parent().parent().next().find('.img-div').css('display','none');

            return false;
        }
    );

    $(document).on('click', '.advanced-search-btn', function() {
          $('.show-advanced-search').slideToggle(1000);

            return false;
        }
    );


});

