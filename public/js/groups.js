/**
 * Created by mhilles on 11/07/2017.
 */
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


  $(document).on('submit', '#group_submit_form', function() {

        var submit = $(this).find("button[type='submit'] > .loader");
        loader(submit,true);// show loader and disable button

      // for payments value
      $(this).find('.payemnt_value').each(function(){
          if($(this).val() == ''){
              $(this).val('0');
          }
      });

    if(update_button)
        var navigate_to ='groups/'+$(this).find('.group_id').val()+'/edit';
        else
      var navigate_to ='groups/add';

        $.ajax({
            type: 'post',
            dataType: "json",
            url: base_url+''+navigate_to,
            data: new FormData(this),
            cache: "false",
            contentType: false,
            processData: false,
            success: function(data) {

                var success = data.responseJSON;
                validation(success,'group_name',true,"#group_submit_form");
                validation(success,'payemnt_value',true,"#group_submit_form");
                validation(success,'group_start_date',true,"#group_submit_form");
                    notificationMessage('رسالة نجاح','تم إضافة مجموعة جديدة بنجاح!','bg-success') ;

                loader(submit,false);// hide loader and un-disable button
                $('#reset-button').click();

            },error:function(data){

                notificationMessage('رسالة خطأ','يوجد خطأ في بعض المدخلات','bg-danger') ;

                var errors = data.responseJSON;
                validation(errors,'group_name',false,"#group_submit_form");
                validation(errors,'payemnt_value',false,"#group_submit_form");
                validation(errors,'group_start_date',false,"#group_submit_form");

                loader(submit,false);// hide loader and un-disable button
            }

        });
        return false;

    });
    $(document).on('submit', '.student_update_payment_form', function() {
        var this_form = $(this);
        var submit = $(this).find("button[type='submit'] > .loader");
        // var student_id = $(this).find(".student_id").val();
        loader(submit,true);// show loader and disable button
        if(this_form.find('.payemnt_value').val() == 0)
            this_form.find('.payemnt_value').val('0');

        $.ajax({
            type: 'post',
            dataType: "json",
            url: base_url+'groups/payment/update',
            data: new FormData(this),
            cache: "false",
            contentType: false,
            processData: false,
            success: function(data) {

                var success = data.responseJSON;
                validation(success,'payment_status',true,'.student_update_payment_form');
                validation(success,'payemnt_value',true,'.student_update_payment_form');


                notificationMessage('رسالة نجاح','تم تعديل الدفع بنجاح!','bg-success') ;
                loader(submit,false);// hide loader and un-disable button
                var payment_status_val = this_form.find('.payment_status:last').val();
                var payment_status = this_form.find('.payment_status:last option:selected').text();
                var payment_value = this_form.find('.payemnt_value').val();

                this_form.find('.input-payment-status').addClass('hide-something');
                this_form.find('.save-payments-span').addClass('hide-something');
                this_form.find('.td-payment-status').text(payment_status).removeClass('hide-something');
                this_form.find('.edit-payments-span').removeClass('hide-something');

                this_form.find('.input-payment-value').addClass('hide-something');
                this_form.find('.td-payment-value').text(payment_value).removeClass('hide-something');
                this_form.parent().parent().find('.td-payment-value').text(payment_value);
                this_form.find('.td-payment-status').removeClass('label-danger label-primary label-warning');
                if(payment_status_val=='P')
                    this_form.find('.td-payment-status').addClass('label-warning');
                else if(payment_status_val == 'F')
                    this_form.find('.td-payment-status').addClass('label-primary');
                else
                    this_form.find('.td-payment-status').addClass('label-danger');


            },error:function(data){

                notificationMessage('رسالة خطأ','يوجد خطأ في بعض المدخلات','bg-danger') ;

                var errors = data.responseJSON;
                validation(errors,'payment_status',false,'.student_update_payment_form');
                validation(errors,'payemnt_value',false,'.student_update_payment_form');

                loader(submit,false);// hide loader and un-disable button
            }

        });
        return false;

    });

    $(document).on('submit', '#group_student_submit_form', function() {
        var this_form = $(this);
        var submit = $(this).find("button[type='submit'] > .loader");
        // var student_id = $(this).find(".student_id").val();
        loader(submit,true);// show loader and disable button
        $(this).find('.payemnt_value').each(function(){
            if($(this).val() == ''){
                $(this).val('0');
            }
        });
        $.ajax({
            type: 'post',
            dataType: "json",
            url: base_url+'groups/students/add',
            data: new FormData(this),
            cache: "false",
            contentType: false,
            processData: false,
            success: function(data) {

                var success = data.responseJSON;
                validation(success,'payment_status',true,'#group_student_submit_form');
                validation(success,'payemnt_value',true,'#group_student_submit_form');

                if(data['result'] == null){
                    notificationMessage('رسالة تنبيه','لم يتم اضافة طلاب','bg-warning') ;
                }else{
                    notificationMessage('رسالة نجاح','تم إضافة طلاب بنجاح!','bg-success') ;
                    window.location = 'http://'+window.location.host+''+$('.group_href_link').attr('href');


                }

                loader(submit,false);// hide loader and un-disable button


            },error:function(data){

                notificationMessage('رسالة خطأ','يوجد خطأ في بعض المدخلات','bg-danger') ;

                var errors = data.responseJSON;
                validation(errors,'payment_status',false,'#group_student_submit_form');
                validation(errors,'payemnt_value',false,'#group_student_submit_form');

                loader(submit,false);// hide loader and un-disable button
            }

        });
        return false;

    });
    $(document).on('click','.delete-student-group-btn', function() {
        var student_id =  $(this).parent().find('.student_id').val();
        var group_id =  $(this).parent().find('.group_id').val();
        var table_row = $(this);
        swal({
                title: "هل أنت متأكد؟",
                text: "سيتم إزالة الطالب من المجموعة.",
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
                        url: base_url+ 'groups/student/'+student_id+'/'+group_id+'/delete',
                        data: "",
                        cache: "false",
                        success: function(data) {
                            if(data['result'] == 'success'){
                                resultMessage("تم الحذف!","لقد قمت بالحذف بنجاح , ستغلق النافذة خلال 3 ثانية","success","#66BB6A",3000);
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

    $(document).on('click','.delete-group-btn', function() {
        var group_id =  $(this).parent().find('.group_id').val();
        var table_row = $(this);
        swal({
                title: "هل أنت متأكد؟",
                text: "سيتم حذف المجموعة التابع للمدرس و جميع بيناتها.",
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
                        url: base_url+ 'groups/'+group_id+'/delete',
                        data: "",
                        cache: "false",
                        success: function(data) {
                            if(data['result'] == 'success'){
                                resultMessage("تم الحذف!","لقد قمت بالحذف بنجاح , ستغلق النافذة خلال 3 ثانية","success","#66BB6A",3000);
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


    $('.select-search').select2();

    $(".control-primary").uniform({
        radioClass: 'choice',
        wrapperClass: 'border-primary-600 text-primary-800'
    });

    $(document).on('change','.day_no',function(){
        if($(this).parent().parent().parent().hasClass('appointment-green')){
            $(this).parent().parent().parent().removeClass('appointment-green');
            $(this).parent().parent().parent().parent().parent().parent().find('.time-label').removeClass('time-label-green');
            $(this).parent().parent().parent().parent().parent().parent().find('.time_from').val(0);
            $(this).parent().parent().parent().parent().parent().parent().find('.time_to').val(0);
            $(this).parent().parent().parent().parent().parent().parent().find('.time_from').attr('disabled','disabled');
            $(this).parent().parent().parent().parent().parent().parent().find('.time_to').attr('disabled','disabled');
        }
        else{
            $(this).parent().parent().parent().addClass('appointment-green');
            $(this).parent().parent().parent().parent().parent().parent().find('.time-label').addClass('time-label-green');
            $(this).parent().parent().parent().parent().parent().parent().find('.time_from').removeAttr('disabled');
            $(this).parent().parent().parent().parent().parent().parent().find('.time_to').removeAttr('disabled');

        }

        return false;
    });

    $(document).on('change','.student_select_name',function(){
        var student_name;
        var student_id;
        student_id = $(this).val();

        student_name =$('.student_select_name').find('option:selected').text();
        var  flag = false;
        $('.table-students tbody tr .table_student_id').each(function (e) {
            if($(this).val() == student_id){
                flag = true;
            }
        });
        if(flag) return false;
        var selectd_student = '<tr>' +
          '<td><a href="#"  class="remove-std-btn" style="margin: 0px 3px;">'+
          '<i class="  icon-cancel-square delete-icon" style=" color: #d84315;font-size: 18px;"></i>'+
          '</a></td>' +
          '<td>'+student_name+'<input type="hidden" value="'+student_id+'" name="student_id[]" class="table_student_id" ></td>' +
          '<td>' +
          '<select name="payment_status[]" class="select payment_status" id="payment_status">' +
          '<option value="F">مدفوع كلي</option>' +
          '<option value="P">مدفوع جزئي</option>' +
          '<option value="N" selected="selected">غير مدفوع</option>' +
          '</select>' +
          '</td>' +
          '<td><input type="number" class="form-control payemnt_value" name="payemnt_value[]" placeholder="قيمة الدفع.." value="0"></td>' +
          '</tr>';

      selectd_student.replace(/(\r\n|\n|\r)/gm,"");
        $('.table-students tbody').append(selectd_student);
        $('.select:last').select2({
            minimumResultsForSearch: "-1"
        });

        return false;
    });

    $(document).on('click','.remove-std-btn',function() {

        $(this).parent().parent().remove();
        return false;
    });
    $(document).on('click','.edit-payments-btn',function() {

        if($(this).parent().parent().find('.input-payment-status').hasClass('hide-something')){
            $(this).parent().parent().find('.input-payment-status').removeClass('hide-something');
            $(this).parent().parent().find('.save-payments-span').removeClass('hide-something');
            $(this).parent().parent().find('.td-payment-status').addClass('hide-something');
            $(this).parent().addClass('hide-something');

            $(this).parent().parent().parent().find('.input-payment-value').removeClass('hide-something');
            $(this).parent().parent().parent().find('.td-payment-value').addClass('hide-something');
            $(this).parent().parent().parent().css('background-color','#f8f8f8');
        }else{

        }

        return false;
    });

    $(document).on('click','.back-payments-btn',function() {

        $(this).parent().parent().find('.input-payment-status').addClass('hide-something');
        $(this).parent().parent().find('.save-payments-span').addClass('hide-something');
        $(this).parent().parent().find('.td-payment-status').removeClass('hide-something');
        $(this).parent().addClass('hide-something');

        $(this).parent().parent().parent().find('.input-payment-value').addClass('hide-something');
        $(this).parent().parent().parent().find('.td-payment-value').removeClass('hide-something');
        $(this).parent().parent().parent().find('.edit-payments-span').removeClass('hide-something');
        $(this).parent().parent().parent().css('background-color','white');

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

    // for courses number counting on typing
    $(document).on('keyup', '.courses_number', function() {

            var total_courses = 0;
            $('.courses_number').each(function(){
                total_courses += Number($(this).val());
            });
            $('.sum-courses-counts').text(total_courses);
            return false;
        }
    );
    // for courses number counting on click all courses btn
    $(document).on('click', '.set-all-courses', function() {

            var total_courses = 0;

            $('.courses_number').val($('.all_courses_number').val());
            $('.courses_number').each(function(){
                total_courses += Number($(this).val());
            });
            $('.sum-courses-counts').text(total_courses);

             $('.courses_number').keyup();
            return false;
        }
    );

    // for salary ratio on typing
    $(document).on('keyup', '.salary_ratio', function() {

            return false;
        }
    );

    // for salary ratio on click all ration btn
    $(document).on('click', '.set-all-ratio', function() {


            $('.salary_ratio').val($('.all_salary_ratio').val());
            $('.salary_ratio').keyup();
            return false;
        }
    );
    $(document).on('keyup', '.payment_value', function() {

            var total_courses = 0;
            $('.payment_value').each(function(){
                total_courses += Number($(this).val());
            });
            $('.sum-payments-values').text(total_courses);
            return false;
        }
    );

    $(document).on('keyup', '.payment_value , .salary_ratio , .courses_number ', function() {
            var this_input = $(this).parent().parent().parent();
            var courses_number = 0;
            var payment_value = 0;
            var salary_ratio = 0;
            var result = 0;
                courses_number = this_input.find('.courses_number').val();
                payment_value = this_input.find('.payment_value').val();
                salary_ratio = this_input.find('.salary_ratio').val();
                result = (payment_value / 12) * (salary_ratio / 100) * courses_number;

                //set summation for a row
                this_input.find('.row-sum').text(result.toFixed(2));
                this_input.find('.result-payment-row').val(result.toFixed(2));

                var total_salary = 0;
                $('.result-payment-row').each(function(){
                    total_salary += Number($(this).val());
                });
                $('.sum-total-salary').text(total_salary.toFixed(2));
            return false;
        }
    );




});

