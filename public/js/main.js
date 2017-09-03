$(document).ready(function() {
    $(".flatpickr").flatpickr({
        enableTime: true,
        noCalendar: true,
        enableSeconds: false, // disabled by default
        time_24hr: true, // AM/PM time picker is used by default
        dateFormat: "H:i",
    });

    $("body").on("click", ".delete-block", function(e) {
        e.preventDefault();

        $($(e.target).attr("href")).remove();
    });

    $(".no-js").addClass("hide");
});
