import axios from "axios";
import React, { useState, useEffect } from "react";
import * as ReactDOM from "react-dom";
import { ToastContainer, toast } from "react-toastify";
import "react-toastify/dist/ReactToastify.css";
import approvalColor from "./ApprovalStyle";
import PortfolioContent from "./PortfolioContent";
import RejectCandidate from "./RejectCandidate";

const candidateList = "http://localhost:8000/api/getCandidateList";
const approveURL = "http://localhost:8000/api/acceptRequest";

const ManageCandidate = () => {
    let [lst, setList] = useState([]);
    let [approve, setApproved] = useState(false);
    let [reject, setReject] = useState(false);

    const showState = (state) => {
        if (state === "ACTIVE")
            return <td className="text text-success">{state}</td>;
        if (state === "BANNED")
            return <td className="text text-danger">{state}</td>;
    };

    const handleClick = (e) => {
        console.log(e.target.value);
    };

    const approveCandidate = (e) => {
        useEffect(() => {
            let id = e.target.value;
            axios
                .get(`${approveURL}/${id}`, {
                    withCredentials: true,
                    headers: {
                        "Content-Type": "application/x-www-form-urlencoded",
                        "Access-Control-Allow-Origin": "*",
                    },
                })
                .then((r) => {
                    if (r.data.res) setApproved(!approve);
                });
        });
    };
    const rejectCandidate = (e) => {
        let id = e.target.value;

        if (document.getElementById("modal-root")) {
            ReactDOM.render(
                <RejectCandidate handleClick={handleClick} id={id} />,
                document.getElementById("modal-root")
            );
        }
    };

    const showPortfolio = (e) => {
        let id = e.target.value;
        // console.log(id);
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
    }, [approve]);

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
                                        <td>
                                            <button
                                                value={l.id}
                                                onClick={approveCandidate}
                                                class="btn btn-primary btn-sm"
                                            >
                                                Approve
                                            </button>{" "}
                                            <button
                                                data-bs-toggle="modal"
                                                data-bs-target="#confirmModal"
                                                value={l.id}
                                                onClick={rejectCandidate}
                                                class="btn btn-danger btn-sm"
                                            >
                                                Reject
                                            </button>
                                        </td>
                                    </tr>
                                ))}
                        </tbody>
                    </table>
                </div>
            </div>
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
