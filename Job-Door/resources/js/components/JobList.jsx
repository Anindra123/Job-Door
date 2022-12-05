import React from "react";

const JobCard = ({ data }) => {
    let l = data;
    return (
        <div className="container">
            <div className="row">
                <div className="col">
                    <br />

                    <div className="card">
                        <div class="card-body">
                            <h4 class="card-title mb-4">{l.job_title}</h4>
                            <h6 className="card-subtitle mb-1">
                                <strong>Job Description</strong>
                            </h6>
                            <p className="card-text mb-4">
                                {l.job_description}
                            </p>
                            <h6 className="card-subtitle mb-1">
                                <strong>Company Name</strong>
                            </h6>
                            <p className="card-text mb-4">{l.company_name}</p>
                            <h6 className="card-subtitle mb-1">
                                <strong>Type</strong>
                            </h6>
                            <p className="card-text mb-4">{l.job_type}</p>
                            <h6 className="card-subtitle mb-1">
                                <strong>Address</strong>
                            </h6>
                            <p className="card-text mb-4">{l.address}</p>
                            <h6 className="card-subtitle mb-1">
                                <strong>Location</strong>
                            </h6>
                            <p className="card-text mb-4">
                                {l.job_location_type}
                            </p>
                            <h6 className="card-subtitle mb-1">
                                <strong>Vacency Count</strong>
                            </h6>
                            <p className="card-text mb-5">{l.vacency_count}</p>
                            <h5 className="card-subtitle mb-3">
                                <strong>Salary</strong>
                            </h5>
                            <h5 className="card-text mb-4 text-warning">
                                {l.salary}
                            </h5>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    );
};

export default JobCard;
