import axios from "axios";
import React, { useState, useEffect } from "react";
import * as ReactDOM from "react-dom";
import { ToastContainer, toast } from "react-toastify";
import "react-toastify/dist/ReactToastify.css";
const portfolioUrl = "http://localhost:8000/api/showPortfolio";
const cvLink = "http://localhost:8000/api/downloadCV";
const PortfolioContent = ({ id }) => {
    let [lst, setList] = useState([]);

    useEffect(() => {
        axios
            .get(`${portfolioUrl}/${id}`, {
                withCredentials: true,
                headers: {
                    "Content-Type": "application/x-www-form-urlencoded",
                    "Access-Control-Allow-Origin": "*",
                },
            })
            .then((r) => {
                setList(r.data.res);
            });
    }, []);

    const downloadCv = () => {
        axios
            .get(cvLink, {
                withCredentials: true,
                headers: {
                    "Content-Type": "application/x-www-form-urlencoded",
                    "Access-Control-Allow-Origin": "*",
                },
            })
            .then((r) => {
                console.log(r.data);
            });
    };

    console.log(lst);
    return (
        <>
            <div class="modal-header">
                <h5 class="modal-title">Portfolio</h5>
                <button
                    type="button"
                    class="btn-close"
                    data-bs-dismiss="modal"
                    aria-label="Close"
                >
                    <span aria-hidden="true"></span>
                </button>
            </div>
            <div class="modal-body portfolio-modal-body">
                <div class="container">
                    <div class="row">
                        <div class="col-sm-12">
                            <h3 class="mb-3 mt-3">{lst.title}</h3>
                            <div class="container p-3 mb-3 border border-primary">
                                <h5 class="mb-3 mt-3">Skills</h5>

                                {lst.skills && (
                                    <div class="container border border-primary mb-3 p-3">
                                        <div class="row align-items-center">
                                            <div class="col-sm-8">
                                                <h4 class="mb-3 mt-3">
                                                    Current Skills
                                                </h4>
                                            </div>
                                        </div>
                                        <div class="row mb-3">
                                            <div class="col-sm-12">
                                                {lst.skills.map((l) => (
                                                    <span key={l}>
                                                        <span class="badge m-2 ps-4 pe-4 pt-3 pb-3 bg-primary rounded-pill">
                                                            {l}
                                                        </span>
                                                    </span>
                                                ))}
                                            </div>
                                        </div>
                                    </div>
                                )}
                            </div>
                            <div class="container p-3 mb-3 border border-primary">
                                <div class="row mx-auto align-items-center">
                                    <div class="col-sm-8">
                                        <h5 class="mb-3 mt-3">
                                            Current Experience
                                        </h5>
                                    </div>
                                    {lst.workExp && (
                                        <div class="row align-items-top">
                                            <div
                                                class="col-auto m-3"
                                                style={{
                                                    width: "10 rem",
                                                    height: "auto",
                                                }}
                                            >
                                                {lst.workExp.map((l) => (
                                                    <div
                                                        class="card"
                                                        key={l.id}
                                                    >
                                                        <div class="card-body">
                                                            <h4 class="card-title mb-3">
                                                                {l.work_title}
                                                            </h4>
                                                            <h5 class="card-subtitle mb-3 text-muted">
                                                                {l.company_name}
                                                            </h5>
                                                            <h6 class="card-subtitle mb-1">
                                                                <strong>
                                                                    Description
                                                                </strong>
                                                            </h6>
                                                            <p class="card-text">
                                                                {
                                                                    l.work_description
                                                                }
                                                            </p>
                                                            <h6 class="card-subtitle mb-1">
                                                                <b>
                                                                    Start Date :{" "}
                                                                </b>
                                                            </h6>
                                                            <p class="card-text">
                                                                {l.start_date}
                                                            </p>
                                                            <h6 class="card-subtitle mb-1">
                                                                <b>
                                                                    End Date :
                                                                </b>
                                                            </h6>
                                                            <p class="card-text">
                                                                {l.end_date}
                                                            </p>
                                                        </div>
                                                    </div>
                                                ))}
                                            </div>
                                        </div>
                                    )}
                                </div>
                            </div>
                            <div class="container p-3 mb-3 border border-primary">
                                <div class="row mx-auto align-items-center">
                                    <div class="col-sm-8">
                                        <h5 class="mb-3 mt-3">My Services</h5>
                                    </div>
                                    {lst.services && (
                                        <div class="row align-items-top">
                                            <div
                                                class="col-auto m-3"
                                                style={{
                                                    width: 10,
                                                    height: "auto",
                                                }}
                                            >
                                                {lst.services.map((l) => (
                                                    <div
                                                        class="card"
                                                        key={l.id}
                                                    >
                                                        <div class="card-body">
                                                            <h4 class="card-title mb-3">
                                                                {
                                                                    l.service_title
                                                                }
                                                            </h4>
                                                            <h6 class="card-subtitle mb-1">
                                                                <strong>
                                                                    Service
                                                                    Description
                                                                </strong>
                                                            </h6>
                                                            <p class="card-text">
                                                                {
                                                                    l.service_description
                                                                }
                                                            </p>
                                                        </div>
                                                    </div>
                                                ))}
                                            </div>
                                        </div>
                                    )}
                                </div>
                            </div>
                            <div class="container p-3 mb-3 border border-primary">
                                <h5 class="mb-3 mt-3">My CV</h5>
                                <div class="container border border-primary mb-3 p-3">
                                    <div class="row align-items-center">
                                        <div class="col-sm-2">
                                            {lst.cv_path ? (
                                                <button
                                                    onClick={downloadCv}
                                                    class="btn btn-sm btn-danger"
                                                >
                                                    Download
                                                </button>
                                            ) : (
                                                <p class="text text-danger">
                                                    No CV uploaded currently
                                                </p>
                                            )}
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button
                    type="button"
                    class="btn btn-secondary"
                    data-bs-dismiss="modal"
                >
                    Close
                </button>
            </div>
        </>
    );
};

export default PortfolioContent;
