import axios from "axios";
import React, { useState, useEffect } from "react";
import * as ReactDOM from "react-dom";
import { ToastContainer, toast } from "react-toastify";
import "react-toastify/dist/ReactToastify.css";
import approvalColor from "./ApprovalStyle";

const interviewHistUrl = "http://localhost:8000/api/showAppliedJob";

const InterviewHistory = () => {
    let [list, setlist] = useState([]);
    let [applied, setApplied] = useState(true);

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
                list && (
                    <>
                        <h1>Screening</h1>
                        <div id="scr-root"></div>
                    </>
                )
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

if (document.getElementById("appliedjobs-root")) {
    ReactDOM.render(
        <InterviewHistory />,
        document.getElementById("appliedjobs-root")
    );
}
