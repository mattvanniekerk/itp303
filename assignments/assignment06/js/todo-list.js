// Show/hide input when button is pressed
$("#btn-add").click(function() {
    $("#input").slideToggle();
});

// When ENTER is pressed, create new li and append to ul, then clear input
$("#input").keypress(function(e) {
    let keyCode = (e.keyCode ? e.keyCode : e.which);
    if (keyCode == "13") {
        let taskName = $(this).find("input").val();
        if (taskName != "") {
            let task = $("<li/>").html(taskName);

            $("<i/>").attr("class", "far fa-square square").prependTo(task);
            $("#items ul").append(task);
    
            $(this).find("input").val("");
        }
    }
});

// Toggle class to .strike when li is clicked
$("#items>ul").on('click', 'li', function() {
    if (!$(this).hasClass("remove")) {
        // "If the item is not crossed out and a user clicks on the square button, do not cross out the item when it is removed."
        $(this).toggleClass("strike");
    }
});

// Remove li from ul when square is pressed
$("#items>ul").on('click', '.square', function() {
    $(this).addClass("fas");
    let task = $(this).parent();
    task.addClass("remove");
    task.fadeOut(400, function() {
        $(this).remove();
    });
});