import axios from "axios";
import React, { useState, useEffect } from "react";
import * as ReactDOM from "react-dom";
import { ToastContainer, toast } from "react-toastify";
import "react-toastify/dist/ReactToastify.css";
import approvalColor from "./ApprovalStyle";

const appliedListUrl = "http://localhost:8000/api/showAppliedJob";

const AppliedJob = () => {
    let [list, setlist] = useState([]);
    let [applied, setApplied] = useState(true);

    useEffect(() => {
        axios
            .get(appliedListUrl, {
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
                        <div class="row">
                            <div class="col-auto m-3">
                                <h1>Applied Job History</h1>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-sm m-3">
                                <table class="table table-striped">
                                    <thead>
                                        <tr>
                                            <th>Company Name</th>
                                            <th>Applied Position</th>
                                            <th>Approval</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        {list &&
                                            list.map((l) => (
                                                <tr key={l.id}>
                                                    <td>{l.comp}</td>
                                                    <td>{l.pos}</td>
                                                    {approvalColor(l.approval)}
                                                </tr>
                                            ))}
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </>
                )
            ) : (
                <div className="container">
                    <div className="row">
                        <div className="col-lg-3"></div>
                        <div className="col-lg-6">
                            <h1>No applied job currently</h1>
                        </div>
                        <div className="col-lg-3"></div>
                    </div>
                </div>
            )}
        </>
    );
};

export default AppliedJob;

if (document.getElementById("appliedjobs-root")) {
    ReactDOM.render(
        <AppliedJob />,
        document.getElementById("appliedjobs-root")
    );
}
