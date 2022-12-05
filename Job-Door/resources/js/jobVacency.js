import $ from "jquery";
window.$ = window.jQuery = $;
$(function () {
    $.ajax({
        type: "GET",
        url: "findVacency",
        dataType: "json",
        success: function (data) {
            // console.log(data);
            let elem = data["job"];

            let jobMap = {};
            data["applied"].forEach((apply) => {
                jobMap[apply["job_post_id"]] = apply;
            });
            console.log(jobMap);
            elem.forEach((res) => {
                let card = `<div class="card mb-3" style="width:50rem;">
                        <div class="card-body job-post-card-${res["id"]}">
                            <h4 class="card-title mb-4">${res["job_title"]}</h4>
                            <h6 class="card-subtitle mb-1"><strong>Job Description</strong></h6>
                            <p class="card-text mb-4">${res["job_description"]}</p>
                            <h6 class="card-subtitle mb-1"><strong>Company Name</strong></h6>
                            <p class="card-text mb-4">${res["company_name"]}</p>
                            <h6 class="card-subtitle mb-1"><strong>Type</strong></h6>
                            <p class="card-text mb-4">${res["job_type"]}</p>
                            <h6 class="card-subtitle mb-1"><strong>Address</strong></h6>
                            <p class="card-text mb-4">${res["address"]}</p>
                            <h6 class="card-subtitle mb-1"><strong>Location</strong></h6>
                            <p class="card-text mb-4">${res["job_location_type"]}</p>
                            <h6 class="card-subtitle mb-1"><strong>Vacency Count</strong></h6>
                            <p class="card-text mb-5">${res["vacency_count"]}</p>
                            <h5 class="card-subtitle mb-3"><strong>Salary</strong></h5>
                            <h5 class="card-text mb-4 text-warning"> ${res["salary"]}</h5>

                        </div>
                    </div> `;

                $(".job-posts").append(card);
                if (
                    data["applied"] !== null &&
                    jobMap.hasOwnProperty(res["id"]) &&
                    jobMap[res["id"]]["status"] === "ACCEPTED"
                ) {
                    let declineBtn = `
                   
                    <p class="text-success">Application Status : ${
                        jobMap[res["id"]]["status"]
                    }</p>
                     <a href="/declineJob-${
                         res["id"]
                     }" class="btn btn-primary text-muted" style="pointer-events:none;">Decline</a>
                            <a href="/companyInfoShow-${
                                res["id"]
                            }" class="btn btn-primary ">Show Company Info</a>`;

                    $(`.job-post-card-${res["id"]}`).append(declineBtn);
                } else if (
                    data["applied"] !== null &&
                    jobMap.hasOwnProperty(res["id"]) &&
                    jobMap[res["id"]]["status"] === "REJECTED"
                ) {
                    let declineBtn = `
                   
                    <p class="text-danger">Application Status : ${
                        jobMap[res["id"]]["status"]
                    }</p>
                     <a href="/declineJob-${
                         res["id"]
                     }" class="btn btn-primary text-muted" style="pointer-events:none;">Decline</a>
                            <a href="/companyInfoShow-${
                                res["id"]
                            }" class="btn btn-primary ">Show Company Info</a>`;

                    $(`.job-post-card-${res["id"]}`).append(declineBtn);
                } else if (data["port"] === null) {
                    let nav = `<p class="text-info">Status : Open</p>
                    <a href="/applyJob-${res["id"]}" class="btn btn-primary text-muted" style="pointer-events:none;">Apply</a>
                            <a href="/companyInfoShow-${res["id"]}" class="btn btn-primary ">Show Company Info</a>`;
                    $(`.job-post-card-${res["id"]}`).append(nav);
                } else if (
                    data["applied"] !== null &&
                    jobMap.hasOwnProperty(res["id"]) &&
                    res["vacency_count"] === 0
                ) {
                    let obj = data["applied"];
                    let declineBtn = `
                    <p class="text-danger">Status : Closed</p>
                    <p class="text-success"> Application Status : ${
                        jobMap[res["id"]]["status"]
                    }</p>
                     <a href="/declineJob-${
                         res["id"]
                     }" class="btn btn-primary">Decline</a>
                            <a href="/companyInfoShow-${
                                res["id"]
                            }" class="btn btn-primary ">Show Company Info</a>`;

                    $(`.job-post-card-${res["id"]}`).append(declineBtn);
                } else if (
                    data["applied"] !== null &&
                    jobMap.hasOwnProperty(res["id"])
                ) {
                    let obj = data["applied"];
                    let declineBtn = `
                    <p class="text-info">Status : Open</p>
                    <p class="text-success"> Application Status : ${
                        jobMap[res["id"]]["status"]
                    }</p>
                     <a href="/declineJob-${
                         res["id"]
                     }" class="btn btn-primary">Decline</a>
                            <a href="/companyInfoShow-${
                                res["id"]
                            }" class="btn btn-primary ">Show Company Info</a>`;

                    $(`.job-post-card-${res["id"]}`).append(declineBtn);
                } else if (
                    data["port"] !== null &&
                    res["vacency_count"] === 0
                ) {
                    let obj = data["applied"];
                    let nav = ` <p class="text-danger">Status : Closed</p><a href="/applyJob-${res["id"]}" class="btn btn-primary text-muted" style="pointer-events:none;">Apply</a>
                            <a href="/companyInfoShow-${res["id"]}" class="btn btn-primary ">Show Company Info</a>`;

                    $(`.job-post-card-${res["id"]}`).append(nav);
                } else {
                    let nav = ` <p class="text-info">Status : Open</p><a href="/applyJob-${res["id"]}" class="btn btn-primary">Apply</a>
                            <a href="/companyInfoShow-${res["id"]}" class="btn btn-primary ">Show Company Info</a>`;
                    $(`.job-post-card-${res["id"]}`).append(nav);
                }
            });

            if (data["port"] === null) {
                let notification = `<div class="alert alert-dismissible alert-danger">
                <span>Please create a portfolio for applying to job</span>
                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
            </div>`;
                $(".job-posts").prepend(notification);
            }
        },
        error: function (err) {
            console.log("Erorr in getting request");
        },
    });
});
