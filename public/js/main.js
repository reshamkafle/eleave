
$.ajaxSetup({
    headers: {
    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }
});

function delete_record(id, ajaxURL, redirectURL){

    $.ajax({
        url: ajaxURL,
        data: {
            id:id
        },
        type: "DELETE",
        success: function (data, statusText, xhr) {
            displayMessage("Delete Successfully");
            setTimeout(function(){
                window.location.href = redirectURL;
             }, 1000);
        },
        error: function (xhr) {
            if (xhr.status == 403) {
                alert('Unauthorized');
            }
        },
    });
}

function displayMessage(message) {
    toastr.success(message, 'Record');
} 

$(function(){
    $('.company_checkall').click(function(){
        if (this.checked) {
            $(".checkboxes_company").prop("checked", true);
        } else {
            $(".checkboxes_company").prop("checked", false);
        }	
    });
    
    $(".checkboxes_company").click(function(){
        var numberOfCheckboxes = $(".checkboxes_company").length;
        var numberOfCheckboxesChecked = $('.checkboxes_company:checked').length;
        if(numberOfCheckboxes == numberOfCheckboxesChecked) {
            $(".company_checkall").prop("checked", true);
        } else {
            $(".company_checkall").prop("checked", false);
        }
    });
});


$(function(){
    $('.holiday_checkall').click(function(){
        if (this.checked) {
            $(".checkboxes_holiday").prop("checked", true);
        } else {
            $(".checkboxes_holiday").prop("checked", false);
        }	
    });
    
    $(".checkboxes_holiday").click(function(){
        var numberOfCheckboxes = $(".checkboxes_holiday").length;
        var numberOfCheckboxesChecked = $('.checkboxes_holiday:checked').length;
        if(numberOfCheckboxes == numberOfCheckboxesChecked) {
            $(".holiday_checkall").prop("checked", true);
        } else {
            $(".holiday_checkall").prop("checked", false);
        }
    });
});

$(function(){
    $('.workingday_checkall').click(function(){
        if (this.checked) {
            $(".checkboxes_workingday").prop("checked", true);
        } else {
            $(".checkboxes_workingday").prop("checked", false);
        }	
    });
    
    $(".checkboxes_workingday").click(function(){
        var numberOfCheckboxes = $(".checkboxes_workingday").length;
        var numberOfCheckboxesChecked = $('.checkboxes_workingday:checked').length;
        if(numberOfCheckboxes == numberOfCheckboxesChecked) {
            $(".workingday_checkall").prop("checked", true);
        } else {
            $(".workingday_checkall").prop("checked", false);
        }
    });
});

$(function(){
    $('.department_checkall').click(function(){
        if (this.checked) {
            $(".checkboxes_department").prop("checked", true);
        } else {
            $(".checkboxes_department").prop("checked", false);
        }	
    });
    
    $(".checkboxes_department").click(function(){
        var numberOfCheckboxes = $(".checkboxes_department").length;
        var numberOfCheckboxesChecked = $('.checkboxes_department:checked').length;
        if(numberOfCheckboxes == numberOfCheckboxesChecked) {
            $(".department_checkall").prop("checked", true);
        } else {
            $(".department_checkall").prop("checked", false);
        }
    });
});

$(function(){
    $('.leaveType_checkall').click(function(){
        if (this.checked) {
            $(".checkboxes_leaveType").prop("checked", true);
        } else {
            $(".checkboxes_leaveType").prop("checked", false);
        }	
    });
    
    $(".checkboxes_leaveType").click(function(){
        var numberOfCheckboxes = $(".checkboxes_leaveType").length;
        var numberOfCheckboxesChecked = $('.checkboxes_leaveType:checked').length;
        if(numberOfCheckboxes == numberOfCheckboxesChecked) {
            $(".leaveType_checkall").prop("checked", true);
        } else {
            $(".leaveType_checkall").prop("checked", false);
        }
    });
});

$(function(){
    $('.calendar_checkall').click(function(){
        if (this.checked) {
            $(".checkboxes_calendar").prop("checked", true);
        } else {
            $(".checkboxes_calendar").prop("checked", false);
        }	
    });
    
    $(".checkboxes_calendar").click(function(){
        var numberOfCheckboxes = $(".checkboxes_calendar").length;
        var numberOfCheckboxesChecked = $('.checkboxes_calendar:checked').length;
        if(numberOfCheckboxes == numberOfCheckboxesChecked) {
            $(".calendar_checkall").prop("checked", true);
        } else {
            $(".calendar_checkall").prop("checked", false);
        }
    });
});

$(function(){
    $('.userAccount_checkall').click(function(){
        if (this.checked) {
            $(".checkboxes_userAccount").prop("checked", true);
        } else {
            $(".checkboxes_userAccount").prop("checked", false);
        }	
    });
    
    $(".checkboxes_userAccount").click(function(){
        var numberOfCheckboxes = $(".checkboxes_userAccount").length;
        var numberOfCheckboxesChecked = $('.checkboxes_userAccount:checked').length;
        if(numberOfCheckboxes == numberOfCheckboxesChecked) {
            $(".userAccount_checkall").prop("checked", true);
        } else {
            $(".userAccount_checkall").prop("checked", false);
        }
    });
});

$(function(){
    $('.leave_entitlements_checkall').click(function(){
        if (this.checked) {
            $(".checkboxes_leave_entitlements").prop("checked", true);
        } else {
            $(".checkboxes_leave_entitlements").prop("checked", false);
        }	
    });
    
    $(".checkboxes_leave_entitlements").click(function(){
        var numberOfCheckboxes = $(".checkboxes_leave_entitlements").length;
        var numberOfCheckboxesChecked = $('.checkboxes_leave_entitlements:checked').length;
        if(numberOfCheckboxes == numberOfCheckboxesChecked) {
            $(".leave_entitlements_checkall").prop("checked", true);
        } else {
            $(".leave_entitlements_checkall").prop("checked", false);
        }
    });
});

$(function(){
    $('.leave_type_approving_checkall').click(function(){
        if (this.checked) {
            $(".checkboxes_leave_type_approving").prop("checked", true);
        } else {
            $(".checkboxes_leave_type_approving").prop("checked", false);
        }	
    });
    
    $(".checkboxes_leave_type_approving").click(function(){
        var numberOfCheckboxes = $(".checkboxes_leave_type_approving").length;
        var numberOfCheckboxesChecked = $('.checkboxes_leave_type_approving:checked').length;
        if(numberOfCheckboxes == numberOfCheckboxesChecked) {
            $(".leave_type_approving_checkall").prop("checked", true);
        } else {
            $(".leave_type_approving_checkall").prop("checked", false);
        }
    });
});

$(function(){
    $('.user_account_approving_checkall').click(function(){
        if (this.checked) {
            $(".checkboxes_user_account_approving").prop("checked", true);
        } else {
            $(".checkboxes_user_account_approving").prop("checked", false);
        }	
    });
    
    $(".checkboxes_user_account_approving").click(function(){
        var numberOfCheckboxes = $(".checkboxes_user_account_approving").length;
        var numberOfCheckboxesChecked = $('.checkboxes_user_account_approving:checked').length;
        if(numberOfCheckboxes == numberOfCheckboxesChecked) {
            $(".user_account_approving_checkall").prop("checked", true);
        } else {
            $(".user_account_approving_checkall").prop("checked", false);
        }
    });
});

$(function(){
    $('.leave_application_checkall').click(function(){
        if (this.checked) {
            $(".checkboxes_leave_application").prop("checked", true);
        } else {
            $(".checkboxes_leave_application").prop("checked", false);
        }	
    });
    
    $(".checkboxes_leave_application").click(function(){
        var numberOfCheckboxes = $(".checkboxes_leave_application").length;
        var numberOfCheckboxesChecked = $('.checkboxes_leave_application:checked').length;
        if(numberOfCheckboxes == numberOfCheckboxesChecked) {
            $(".leave_application_checkall").prop("checked", true);
        } else {
            $(".leave_application_checkall").prop("checked", false);
        }
    });
});


$(function(){
    $('.menu_checkall').click(function(){
        if (this.checked) {
            $(".checkboxes_menu").prop("checked", true);
        } else {
            $(".checkboxes_menu").prop("checked", false);
        }	
    });
    
    $(".checkboxes_menu").click(function(){
        var numberOfCheckboxes = $(".checkboxes_menu").length;
        var numberOfCheckboxesChecked = $('.checkboxes_menu:checked').length;
        if(numberOfCheckboxes == numberOfCheckboxesChecked) {
            $(".menu_checkall").prop("checked", true);
        } else {
            $(".menu_checkall").prop("checked", false);
        }
    });
});