import $ from "jquery";
window.$ = window.jQuery = $;
$(function () {
    $(".propsalBtn").on("click", (e) => {
        $(".proposal-modal-body").empty();
        let cls = e.target.className.split(" ").pop();
        $.ajax({
            type: "GET",
            url: `/viewProposal-${cls}`,
            dataType: "html",
            success: function (data) {
                let html = JSON.parse(data)["html"];

                $(".proposal-modal-body").append(html);
            },
            error: function (data) {
                console.log("Error getting data");
            },
        });
    });
});
