import axios from "axios";
import React, { useState, useEffect, useRef } from "react";
import * as ReactDOM from "react-dom";
import { useForm } from "react-hook-form";
import { ToastContainer, toast } from "react-toastify";
import "react-toastify/dist/ReactToastify.css";
import approvalColor from "./ApprovalStyle";
import PortfolioContent from "./PortfolioContent";
import RejectCandidate from "./RejectCandidate";
import SpinnerButton from "./SpinnerButton";

const candidateList = "http://localhost:8000/api/getCandidateList";
const approveURL = "http://localhost:8000/api/acceptRequest";
const rejectURL = "http://localhost:8000/api/declineRequest";
const ManageCandidate = () => {
    let [lst, setList] = useState([]);
    let [approve, setApproved] = useState(false);
    let [reject, setReject] = useState(false);
    let [load, setLoading] = useState(false);
    const closeRef = useRef();
    let uid = 0;
    let {
        register,
        handleSubmit,
        formState: { errors },
    } = useForm({ defaultValues: {} });

    const showState = (state) => {
        if (state === "ACTIVE")
            return <td className="text text-success">{state}</td>;
        if (state === "BANNED")
            return <td className="text text-danger">{state}</td>;
    };

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

    const onSubmit = (data) => {
        setLoading(true);
        axios
            .post(
                `${rejectURL}`,
                { id: uid, feedback: data.feedback },
                {
                    withCredentials: true,
                    headers: {
                        "Content-Type": "application/json",
                        "Access-Control-Allow-Origin": "*",
                    },
                }
            )
            .then((r) => {
                if (r.data.res) setReject(true);
                setLoading(false);
                notify("Feedback Sent sucessfully", uid);
                closeRef.current.click();
            });
    };

    const approveCandidate = (e) => {
        setLoading(true);
        let id = e.target.value;
        console.log(id);
        axios
            .get(`${approveURL}/${id}`, {
                withCredentials: true,
                headers: {
                    "Content-Type": "application/x-www-form-urlencoded",
                    "Access-Control-Allow-Origin": "*",
                },
            })
            .then((r) => {
                setLoading(false);
                if (r.data.res) setApproved(!approve);
            });
    };
    const rejectCandidate = (e) => {
        uid = e.target.value;

        if (document.getElementById("modal-root")) {
            ReactDOM.render(
                <RejectCandidate
                    name="feedback"
                    register={register}
                    handleSubmit={handleSubmit}
                    error={errors}
                    required={true}
                    onSubmit={onSubmit}
                    load={load}
                    closeRef={closeRef}
                />,
                document.getElementById("modal-root")
            );
        }
    };
    useEffect(() => {
        if (document.getElementById("modal-root")) {
            ReactDOM.render(
                <RejectCandidate
                    name="feedback"
                    register={register}
                    handleSubmit={handleSubmit}
                    error={errors}
                    required={true}
                    onSubmit={onSubmit}
                    load={load}
                    closeRef={closeRef}
                />,
                document.getElementById("modal-root")
            );
        }
    }, [errors, load]);

    const showPortfolio = (e) => {
        let id = e.target.value;

        if (document.getElementById("modal-root")) {
            ReactDOM.render(
                <PortfolioContent id={id} />,
                document.getElementById("modal-root")
            );
        }
    };

    useEffect(() => {
        axios
            .get(candidateList, {
                withCredentials: true,
                headers: {
                    "Content-Type": "application/x-www-form-urlencoded",
                    "Access-Control-Allow-Origin": "*",
                },
            })
            .then((r) => {
                setList(r.data.res);
            });
    }, [approve, reject]);

    const showActions = (approval, id) => {
        if (approval === "APPROVED")
            return (
                <td>
                    <p className="text text-success">USER APPROVED</p>
                </td>
            );
        if (approval === "REJECTED")
            return (
                <td>
                    <p className="text text-danger">
                        <p>USER REJECTED</p>
                    </p>
                </td>
            );
        return (
            <td>
                {load ? (
                    <SpinnerButton cls="btn btn-primary" />
                ) : (
                    <button
                        value={id}
                        onClick={approveCandidate}
                        class="btn btn-primary btn-sm"
                    >
                        Approve
                    </button>
                )}{" "}
                <button
                    data-bs-toggle="modal"
                    data-bs-target="#confirmModal"
                    onClick={rejectCandidate}
                    value={id}
                    class="btn btn-danger btn-sm"
                >
                    Reject
                </button>
            </td>
        );
    };

    return (
        <>
            <div class="row">
                <div class="col-auto m-3">
                    <h1>Applied Candidate List</h1>
                </div>
            </div>

            <div class="row">
                <div class="col-sm m-3">
                    <table class="table table-striped">
                        <thead>
                            <tr>
                                <th>Candidate Name</th>
                                <th>Status</th>
                                <th>Applied Position</th>
                                <th>Portfolio</th>
                                <th>Approval</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            {lst &&
                                lst.map((l) => (
                                    <tr key={l.id}>
                                        <td>{l.name}</td>
                                        {showState(l.status)}
                                        <td>{l.position}</td>
                                        <td>
                                            <button
                                                data-bs-toggle="modal"
                                                data-bs-target="#confirmModal"
                                                value={l.port}
                                                onClick={showPortfolio}
                                                class="btn btn-primary btn-sm"
                                            >
                                                View Portfolio
                                            </button>
                                        </td>
                                        {approvalColor(l.approval)}
                                        {showActions(l.approval, l.id)}
                                    </tr>
                                ))}
                        </tbody>
                    </table>
                </div>
            </div>
            <ToastContainer />
        </>
    );
};

export default ManageCandidate;

if (document.getElementById("managejobVacency-root")) {
    ReactDOM.render(
        <ManageCandidate />,
        document.getElementById("managejobVacency-root")
    );
}
