$(document).ready(function () {
    $("#submitTheater").click(function () {
        $.ajax({
            url: '/add_theater',
            type: "POST",
            data: $("#theaterForm").serialize(),
            success: function (response) {
                console.log(response);
                $("#Addnewtheater").modal("hide");
            },
            error: function (xhr, status, error) {
                console.error(xhr.responseText);
            },
        });
    });

    $("#submitShows").click(function () {
        var formData = new FormData($("#addShowsForm")[0]); 
        $.ajax({
            url: '/add_shows',
            type: "POST",
            data: formData, 
            processData: false, 
            contentType: false,
            success: function (response) {
                console.log(response);
                $("#Addshows").modal("hide");
            },
            error: function (xhr, status, error) {
                console.error(xhr.responseText);
            },
        });
    });
    
    });

    