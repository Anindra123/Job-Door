import axios from "axios";
import React, { useState, useEffect } from "react";
import * as ReactDOM from "react-dom";
import { ToastContainer, toast } from "react-toastify";
import "react-toastify/dist/ReactToastify.css";
import approvalColor from "./ApprovalStyle";

const interviewHistUrl = "http://localhost:8000/api/getInterviewHist";

const InterviewHistory = () => {
    let [list, setlist] = useState([]);
    let [applied, setApplied] = useState(true);
    const setPhase = (name) => {
        if (name === "SCR") return "SCREENING";
        if (name === "TECH") return "TECHNICAL";
    };
    useEffect(() => {
        axios
            .get(interviewHistUrl, {
                withCredentials: true,
                headers: {
                    "Content-Type": "application/x-www-form-urlencoded",
                    "Access-Control-Allow-Origin": "*",
                },
            })
            .then((r) => {
                setlist(r.data.res);
            })
            .catch((e) => {
                setApplied(!applied);
            });
    }, []);

    console.log(list);

    return (
        <>
            {applied ? (
                <table className="table">
                    <thead>
                        <tr>
                            <th>Company Name</th>
                            <th>Phase</th>
                            <th>Applied Position</th>
                            <th>Status</th>
                        </tr>
                    </thead>
                    <tbody>
                        {list &&
                            list.map((l, i) => (
                                <tr key={i}>
                                    <td>{l.company}</td>
                                    <td>{setPhase(l.phase)}</td>
                                    <td>{l.position}</td>
                                    {approvalColor(l.status)}
                                </tr>
                            ))}
                    </tbody>
                </table>
            ) : (
                <div className="container">
                    <div className="row">
                        <div className="col-lg-3"></div>
                        <div className="col-lg-6">
                            <h1>No job interview phase taken</h1>
                        </div>
                        <div className="col-lg-3"></div>
                    </div>
                </div>
            )}
        </>
    );
};

export default InterviewHistory;

if (document.getElementById("history-root")) {
    ReactDOM.render(
        <InterviewHistory />,
        document.getElementById("history-root")
    );
}
