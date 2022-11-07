import $ from "jquery";
window.$ = window.jQuery = $;
$(function () {
    $.ajaxSetup({
        headers: {
            "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
        },
    });
    $(".interviewAnswerSubmit").on("click", (e) => {
        let cls = e.target.className.split(" ").pop();
        let answer = $("#answer").val();

        $.ajax({
            type: "POST",
            url: "/submitAnswer",
            data: { id: cls, ans: answer },
            success: function (data) {
                if (data["success"] === true)
                    window.location.href = "/dashboard";
            },
            error: function (data) {
                console.log("Error getting data");
            },
        });
    });
});
