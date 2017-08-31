$(document).ready(function() {
    $(".flatpickr").flatpickr({
        enableTime: true,
        noCalendar: true,
        enableSeconds: false, // disabled by default
        time_24hr: true, // AM/PM time picker is used by default
        dateFormat: "H:i",
    });

    $(".select-students").on("change", function(e) {
        var parent = $(e.target).closest(".jury-fieldset");
        var studentName = $(e.target).find("option[value="+e.target.value+"]").html();
        var studentId = $(e.target).val();
        var parentId = parent.attr("id");
        var juryId = parentId.slice(-1);

        if( $("#student-"+studentId).length ){
            $("html, body").animate({
                scrollTop: $("#student-"+studentId).offset().top
            },700);
        }else{
            var child = $(".toClone .form-group").clone();

            child.find(".student-name").html(studentName);
            child.attr("id", "student-"+studentId);

            child.find("label[for=from]").attr("for", "results["+juryId+"]["+studentId+"][from]");
            child.find("input[name=from]").attr("name", "results["+juryId+"]["+studentId+"][from]").attr("id", "results["+juryId+"]["+studentId+"][from]");

            child.find("label[for=to]").attr("for", "results["+juryId+"]["+studentId+"][to]");
            child.find("input[name=to]").attr("name", "results["+juryId+"]["+studentId+"][to]").attr("id", "results["+juryId+"]["+studentId+"][to]");

            child.find("a").attr("href", "#student-"+studentId);

            parent.append(child);

            $(".flatpickr").flatpickr({
                enableTime: true,
                noCalendar: true,
                enableSeconds: false, // disabled by default
                time_24hr: true, // AM/PM time picker is used by default
                dateFormat: "H:i",
            });
        }
    });

    $("body").on("click", ".delete-block", function(e) {
        e.preventDefault();

        $($(e.target).attr("href")).remove();
    });
});
