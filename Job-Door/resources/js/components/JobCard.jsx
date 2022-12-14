import axios from "axios";
import React, { useState, useEffect } from "react";
import { ToastContainer, toast } from "react-toastify";
import "react-toastify/dist/ReactToastify.css";
import SpinnerButton from "./SpinnerButton";

const baseUrl = "http://localhost:8000/api/getJobVacencyPost";
const applyJobUrl = "http://localhost:8000/api/apply";
const declineJobUrl = "http://localhost:8000/api/decline";
let button, status;

const JobCard = ({ data }) => {
    let [l, setData] = useState(null);
    let [loading, setLoading] = useState(false);
    let [applied, setApplied] = useState(false);
    let [approval, setApproval] = useState("");

    useEffect(() => {
        axios
            .get(`${baseUrl}/${data.id}`, {
                withCredentials: true,
                headers: {
                    "Content-Type": "application/x-www-form-urlencoded",
                    "Access-Control-Allow-Origin": "*",
                },
            })
            .then((res) => {
                res.data.applied === null
                    ? setApproval("")
                    : setApproval(res.data.applied.approval);

                if (res.data.applied) setApplied(true);
                setData(res.data.job);
            });
    }, [applied, approval]);

    const notify = (msg, id) => {
        toast.success(`${msg}`, {
            toastId: `${id}`,
            position: "bottom-right",
            autoClose: 5000,
            hideProgressBar: false,
            closeOnClick: true,
            pauseOnHover: true,
            draggable: true,
            progress: undefined,
            theme: "light",
        });
    };

    const handleDeclineClick = (e) => {
        e.preventDefault();
        setLoading(true);
        // setTimeout(() => {
        axios
            .get(`${declineJobUrl}/${data.id}`, {
                withCredentials: true,
                headers: {
                    "Content-Type": "application/x-www-form-urlencoded",
                    "Access-Control-Allow-Origin": "*",
                },
            })
            .then((res) => {
                if (res) setApplied(!applied);
                setLoading(false);
                notify("Declined Sucessfully", data.id);
            });
        // }, 1000);
    };

    const handleApplyClick = (e) => {
        e.preventDefault();
        setLoading(true);
        // setTimeout(() => {
        axios
            .get(`${applyJobUrl}/${data.id}`, {
                withCredentials: true,
                headers: {
                    "Content-Type": "application/x-www-form-urlencoded",
                    "Access-Control-Allow-Origin": "*",
                },
            })
            .then((res) => {
                if (res) setApplied(!applied);
                setLoading(false);
                notify("Applied Sucessfully", data.id);
            });
        // }, 1000);
    };

    button = applied ? (
        <button onClick={handleDeclineClick} className="btn btn-danger me-2">
            Decline
        </button>
    ) : l && l.vacency_count > 0 ? (
        <button onClick={handleApplyClick} className="btn btn-primary me-2">
            Apply
        </button>
    ) : (
        <button
            onClick={handleApplyClick}
            className="btn btn-primary me-2"
            disabled
        >
            Apply
        </button>
    );

    const showActions = (approval, id) => {
        if (approval === "APPROVED")
            return <p className="text text-success">USER APPROVED</p>;
        if (approval === "REJECTED")
            return (
                <p className="text text-danger">
                    <p>USER REJECTED</p>
                </p>
            );
        return (
            <p>
                {loading ? (
                    <SpinnerButton cls="btn btn-primary me-2" />
                ) : (
                    button
                )}
                <button className="btn btn-primary">View Company Info</button>
            </p>
        );
    };

    status =
        l && l.vacency_count > 0 ? (
            applied ? (
                <p className="text text-success mb-3">Applied</p>
            ) : (
                <p className="text text-primary mb-3">Open</p>
            )
        ) : (
            <p className="text text-danger mb-3">Closed</p>
        );

    return (
        <>
            <div className="container">
                <div className="row">
                    <div className="col">
                        <br />

                        <div className="card">
                            {l && (
                                <div className="card-body">
                                    <h4 className="card-title mb-4">
                                        {l.job_title}
                                    </h4>
                                    <h6 className="card-subtitle mb-1">
                                        <strong>Job Description</strong>
                                    </h6>
                                    <p className="card-text mb-4">
                                        {l.job_description}
                                    </p>
                                    <h6 className="card-subtitle mb-1">
                                        <strong>Company Name</strong>
                                    </h6>
                                    <p className="card-text mb-4">
                                        {l.company_name}
                                    </p>
                                    <h6 className="card-subtitle mb-1">
                                        <strong>Type</strong>
                                    </h6>
                                    <p className="card-text mb-4">
                                        {l.job_type}
                                    </p>
                                    <h6 className="card-subtitle mb-1">
                                        <strong>Address</strong>
                                    </h6>
                                    <p className="card-text mb-4">
                                        {l.address}
                                    </p>
                                    <h6 className="card-subtitle mb-1">
                                        <strong>Location</strong>
                                    </h6>
                                    <p className="card-text mb-4">
                                        {l.job_location_type}
                                    </p>
                                    <h6 className="card-subtitle mb-1">
                                        <strong>Vacency Count</strong>
                                    </h6>
                                    <p className="card-text mb-5">
                                        {l.vacency_count}
                                    </p>
                                    <h5 className="card-subtitle mb-3">
                                        <strong>Salary</strong>
                                    </h5>
                                    <h5 className="card-text mb-4 text-warning">
                                        {l.salary}
                                    </h5>
                                    Status : {status}
                                    {showActions(approval)}
                                </div>
                            )}
                        </div>
                    </div>
                </div>
            </div>
        </>
    );
};

export default JobCard;
