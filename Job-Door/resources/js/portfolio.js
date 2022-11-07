import $ from "jquery";
window.$ = window.jQuery = $;
import "jquery-ui/ui/widgets/autocomplete.js";

$(function () {
    $(".portBtn").on("click", (e) => {
        $(".portfolio-modal-body").empty();
        let portID = e.target.className.split(" ").pop();

        $.ajax({
            type: "GET",
            url: `viewPortfolio-${portID}`,
            dataType: "html",
            success: function (data) {
                let htmldata = JSON.parse(data)["html"];

                $(".portfolio-modal-body").append(htmldata);
            },
            error: function (data) {
                console.log("Error fetching data");
            },
        });
    });
});
