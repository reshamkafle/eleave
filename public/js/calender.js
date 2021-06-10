
$(document).ready(function () {

    $("#btnDelete").hide();
    
    $.ajaxSetup({
        headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
    
    $('#calendar').fullCalendar({
        header: {
            left: 'prev,next today',
            center: 'title',
            right: 'listWeek,month'
        },
        defaultView: 'listWeek',
            events: "/calender",
            eventColor: '#378006',
            displayEventTime: true,
            displayEventEnd:true,
            eventRender: function (event, element, view) {      
                if (event.wholeDay === 1) {
                        event.allDay = true;
                } else {
                        event.allDay = false;
                }
            },
            selectable: true,
            selectHelper: true,
            
            eventClick:  function(event, jsEvent, view) {
                if(event.leave == '' || event.leave == null)
                {
                    $('#title').val(event.title);
                    $('#type').val('update');
    
                    var start = moment(event.start).format('Y-MM-DD');
    
                    $("#start").val(start);
                    $("#id").val(event.id);
    
                    if(event.wholeDay == 0){             
                        $("#start_time").show();
                        $("#end_time").show();
                        $("#wholeDay").prop( "checked", false );
    
                        var end = moment(event.end).format('Y-MM-DD');
                        $("#end").val(end);
    
                        var start_time = moment(event.start).format('HH:mm');
                        $("#start_time").val(start_time);
    
                        var end_time = moment(event.end).format('HH:mm');
                        $("#end_time").val(end_time);
                    }
                    else //whole day
                    {
                        $("#start_time").hide();
                        $("#end_time").hide();
                        $("#wholeDay").prop( "checked", true );
    
                        var end = moment(event.end).subtract(1, "days").format('Y-MM-DD');
                        $("#end").val(end);
    
                    }
                    $('#modalBody').html(event.description);
                    $('#eventUrl').attr('href',event.url);
                    $("#btnDelete").show();
                    var title = event.title.split("-");
                    $("#title").val($.trim(title[0]));
                    $('#calendarModal').modal();
                }
            },
    
        });
        
    });
        
    function displayMessage(message) {
        toastr.success(message, 'Event');
    } 
    
    
    function addCalenderModal(){
    
        //reset
        $("#type").val('add');
        $("#start_time").val('');
        $("#end_time").val('');
        var dt = new Date();
    
        var start_time = dt.getHours() + ":" + dt.getMinutes();        
        $("#start_time").val(start_time);
        $("#start_time").show();
    
        var end_time = dt.getHours() + 1 + ":" + dt.getMinutes();
        $("#end_time").val(end_time);
        $("#end_time").show();
    
        $("#title").val('');
        $("#type").val('add');
        $("#wholeDay").prop( "checked", false );
    
        $("#btnDelete").hide()
    
        $('#calendarModal').modal();
    }
    
    $("#wholeDay").change(function() {
        if(this.checked) {
            $("#start_time").hide();
            $("#end_time").hide();
        }
        else{
            $("#start_time").show();
            $("#end_time").show();
        }
    });
    
    $("#btnDelete").click(function() {
    
        var id = $("#id").val();
    
        $.ajax({
            url: "/calenderAjax",
            data: {
                id: id,
                type: "delete"
            },
            type: "POST",
            success: function (data, statusText, xhr) {
                displayMessage("Event delete Successfully");
                location.reload();
            },
            error: function (xhr) {
                if (xhr.status == 403) {
                    alert('Unauthorized');
                }
            },
        });
    
    });
    
    $("#btnSave").click(function() {
    
        var error = "";
    
        if($("#title").val() == ''){
            error += "Title is required";
        }
    
        start = moment($("#start").val()).format('Y-MM-DD');
        end = moment($("#end").val()).format('Y-MM-DD');
    
        if(moment(end).isBefore(start)){
            error += "End date should be same or after than start date";
        }
    
        if(error != ""){
            alert(error);
            return false;
        }
    
    
        var title = $("#title").val();
        var wholeDay = 0;
    
        if($("#wholeDay").is(":checked")){
            wholeDay= 1;
        }
    
        var start;
        var end;
    
        if(wholeDay == 1){
            start = moment($("#start").val()).format('Y-MM-DD');
            end = moment($("#end").val()).format('Y-MM-DD');
        }
        else {
    
            start = moment($("#start").val()+" " + $("#start_time").val()).format('Y-MM-DD HH:mm');
            end = moment($("#end").val()+" " + $("#end_time").val()).format('Y-MM-DD HH:mm');
        }
    
        var type= $("#type").val();
        var id = $("#id").val();
     
        $.ajax({
            url: "/calenderAjax",
            data: {
                title: title,
                id:id,
                start: start,
                end: end,
                type: type,
                wholeDay: wholeDay
            },
            type: "POST",
            success: function (data, statusText, xhr) {
                displayMessage("Event delete Successfully");
                location.reload();
            },
            error: function (xhr) {
                if (xhr.status == 403) {
                    alert('Unauthorized');
                }
            },
        });
    });
    
    $('#start').on('input',function(e){
        var start = $(this).val();
        $("#end").val(start);
    });