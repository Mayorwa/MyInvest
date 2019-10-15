$('#getAccessForm').on('submit', function (e) {
    e.preventDefault();

    var that = $(this), url = that.attr('action'), type = that.attr('method');
    var submitBtn = $("#getAccessForm").find(":submit");
    var loaderImg = $("#getAccessForm").find("#loaderImg");
    
    //hide the submit button to prevent multiple submissions
    submitBtn.hide();
    //display the working spinner
    loaderImg.show();

    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content'),
        }
    });

    $.ajax({
        url: url,
        type: type,
        data: new FormData(this),
        contentType: false,
        processData: false,
        statusCode: {
            500: function (response) {
                loaderImg.hide();
                //hide the button divs
                submitBtn.show();
                console.log(response);
                $("#messages").append("<div class='alert alert-danger alert-dismissable'><button type='button' class='close' data-dismiss='alert'>&times;</button>" + response.message + "</div>");
            },
            403: function (response) {
                loaderImg.hide();
                //hide the button divs
                submitBtn.show();
                //loop through the message array to output friendly ones.
                console.log(response);
                $.each(response.responseJSON.message, function (index, message) {
                    //display response message
                    $("#messages").append("<div class='alert alert-warning alert-dismissable'><button type='button' class='close' data-dismiss='alert'>&times;</button>" + message[0] + "</div>");
                });
            }
        },
        success: function (response) {
            loaderImg.hide();
            console.log(response);
            if(response.error == true) {
                $.each(response.message, function (index, message) {
                    //display response message
                    $("#messages").append("<div class='alert alert-warning alert-dismissable'><button type='button' class='close' data-dismiss='alert'>&times;</button>" +  message[0] + "</div>");
                }); 

                submitBtn.show();
            } else {
                $("#messages").append("<div class='alert alert-success alert-dismissable'><button type='button' class='close' data-dismiss='alert'>&times;</button>"+response.message+"</div>");
                $("#getAccess").hide();
                $("#confirmAccess").show();
            }
        },
    });

    return false;
});

$('#recoverPasswordForm').on('submit', function (e) {
    e.preventDefault();

    var that = $(this), url = that.attr('action'), type = that.attr('method');

    $("#messages").empty();
    $(".alert").hide();

    var submitBtn = $("#recoverPasswordForm").find(":submit");
    var loaderImg = $("#recoverPasswordForm").find("#loaderImg");

    //hide the submit button to prevent multiple submissions
    submitBtn.hide();
    //display the working spinner
    loaderImg.show();

    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content'),
        }
    });

    $.ajax({
        url: url,
        type: type,
        data: new FormData(this),
        contentType: false,
        processData: false,
        500: function (response) {
            loaderImg.hide();
            //hide the button divs
            submitBtn.show();

            $("#messages").append("<div class='alert alert-danger alert-dismissable'><button type='button' class='close' data-dismiss='alert'>&times;</button>" + response.message + "</div>");
        },
        403: function (response) {
            loaderImg.hide();
            //hide the button divs
            submitBtn.show();
            //loop through the message array to output friendly ones.
            $.each(response.responseJSON.data, function (index, message) {
                //display response message
                $("#messages").append("<div class='alert alert-warning alert-dismissable'><button type='button' class='close' data-dismiss='alert'>&times;</button>" + message + "</div>");
            });
        },
        success: function (response) {
            loaderImg.hide();

            submitBtn.show();
            
            $("#messages").append("<div class='alert alert-success alert-dismissable'><button type='button' class='close' data-dismiss='alert'>&times;</button>" + response.message + "</div>");
        },
    });

    return false;
});

function nextForm()
{
    $("#initialForm").hide();
    $("#nextForm").show();

    var getEmail = $("#initialForm").find("#email").val();

    $("#userEmail").val(getEmail);
}

function prevForm() {
    $("#nextForm").hide();
    $("#initialForm").show();
}
