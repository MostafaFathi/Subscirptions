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
    $(document).on('submit', '#teacher_submit_form', function() {

        var submit = $(this).find("button[type='submit'] > .loader");
        loader(submit,true);// show loader and disable button
        $.ajax({
            type: 'post',
            dataType: "json",
            url: base_url+'teachers/add',
            data: new FormData(this),
            cache: "false",
            contentType: false,
            processData: false,
            success: function(data) {
                var success = data.responseJSON;
                validation(success,'emp_name',true,"#teacher_submit_form");
                notificationMessage('رسالة نجاح','تم إضافة موظف جديد بنجاح!','bg-success') ;
                loader(submit,false);// hide loader and un-disable button
                $('form').find('input:not(input[name=_token]),input:not(input[name=emp_gender])').val('');

            },error:function(data){

                notificationMessage('رسالة خطأ','يوجد خطأ في بعض المدخلات','bg-danger') ;

                var errors = data.responseJSON;
                validation(errors,'emp_name',false,"#teacher_submit_form");

                loader(submit,false);// hide loader and un-disable button
            }

        });
        return false;

    });
    $(document).on('submit', '.teacher_update_form', function() {
        var this_form = $(this);
        var submit = $(this).find("button[type='submit'] > .loader");
        var emp_id = $(this).find(".emp_id").val();
        loader(submit,true);// show loader and disable button
        $.ajax({
            type: 'post',
            dataType: "json",
            url: base_url+'teachers/'+emp_id+'/update',
            data: new FormData(this),
            cache: "false",
            contentType: false,
            processData: false,
            success: function(data) {
                this_form.find('.text_emp_name').text(data['emp'].emp_name);
                this_form.find('.text_emp_specialist').text(data['emp'].emp_specialist);
                this_form.find('.text_emp_age').text(data['emp'].emp_age);
                this_form.find('.text_emp_experiance').text(data['emp'].emp_experiance);
                this_form.find('.text_emp_phone').text(data['emp'].emp_phone);
                this_form.find('.text_emp_email').text(data['emp'].emp_email);
                if(data['emp'].emp_gender == 'f')
                    this_form.find('.text_emp_gender').text('أنثى');
                else
                    this_form.find('.text_emp_gender').text('ذكر');

                var job_select_box = this_form.find('#job_id');
                var emp_job =  job_select_box.find('option[value='+job_select_box.val()+']').text();
                this_form.find('.text_job_name').text(emp_job);

                var branch_select_box = this_form.find('#branch_id');
                var teacher_branch =  branch_select_box.find('option[value='+branch_select_box.val()+']').text();
                this_form.find('.text_branch_name').text(teacher_branch);

                this_form.parent().parent().parent().prev().find('.td-job-name').text(emp_job);
                this_form.parent().parent().parent().prev().find('.td-branch-name').text(teacher_branch);
                this_form.parent().parent().parent().prev().find('.td-emp-specialist').text(data['emp'].emp_specialist);
                var success = data.responseJSON;
                validation(success,'emp_name',true,'.teacher_update_form');

                notificationMessage('رسالة نجاح','تم تعديل الموظف بنجاح!','bg-success') ;
                loader(submit,false);// hide loader and un-disable button

            },error:function(data){

                notificationMessage('رسالة خطأ','يوجد خطأ في بعض المدخلات','bg-danger') ;

                var errors = data.responseJSON;
                validation(errors,'emp_name',false,'.teacher_update_form');

                loader(submit,false);// hide loader and un-disable button
            }

        });
        return false;

    });

    $(document).on('click','.delete-student-btn', function() {
        var student_id =  $(this).parent().find('.student_id').val();
        var table_row = $(this);
        swal({
                title: "هل أنت متأكد؟",
                text: "سيتم حذف الطالب , يمكن إستعادته من شاشة سلة المهملات.",
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
                        url: base_url+ 'students/'+student_id+'/recycle',
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

    $('.select-search').select2();

    var button_clicked = '';
    $(document).on('click', '.show-teacher-btn', function() {
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
                $(this).next().slideToggle(1);

            }
            button_clicked = 'show-details';

            $(this).next().find('.input').css('display','initial');
            $(this).next().find('.input-hide').css('display','none');
            $(this).next().find('.update-button').css('display','none');
            $(this).next().find('.img-div').css('display','initial');

            return false;
        }
    );

    $(document).on('click', '.update-teacher-btn', function() {
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
    $(document).on('change', '.emp_gender', function() {
        var student_gender =  $(this).val();
        if(student_gender == 'm') {
            $('.emp-gender > .gender').text('ذكر');
            $('.emp-image').attr('src',base_url+'images/ui/m_student.png');
        }
        if(student_gender == 'f'){
            $('.emp-gender > .gender').text('أنثى')
            $('.emp-image').attr('src',base_url+'images/ui/f_student.png');};

        $(this).prop('checked',true);

        return false;
    });

});

