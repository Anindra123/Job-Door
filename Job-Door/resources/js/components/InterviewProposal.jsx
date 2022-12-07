import axios from "axios";
import React, { useEffect, useState } from "react";
import * as ReactDOM from "react-dom";
import PhaseDialog from "./PhaseDialog";

const baserUrl = "http://localhost:8000/api/getVacencyPostList";
const postUrl = "";
const InterviewProposal = () => {
    let [phaseNum, setPhaseNum] = useState(0);
    let [proposal, setProposal] = useState({ jv_id: 0, num_of_phases: 1 });
    let [vacency, setVacency] = useState([]);
    useEffect(() => {
        axios.get(baserUrl).then((r) => {
            setVacency(r.data);
            setProposal({ ...proposal, jv_id: r.data[0].id });
        });
    }, []);

    console.log(vacency);

    const handleFormChange = (e) => {
        e.preventDefault();
        setProposal({ ...proposal, [e.target.name]: e.target.value });
    };

    const handleFormSubmission = (e) => {
        e.preventDefault();
        // console.log(proposal);

        axios.post();
    };

    return (
        <>
            <div class="modal-body">
                <form onSubmit={handleFormSubmission}>
                    <div className="form-group">
                        <label htmlFor="vacencyList">
                            Select a job vacency to create proposal :
                        </label>
                        <select
                            name="jv_id"
                            id=""
                            value={proposal.jv_id}
                            className="form-control"
                            onChange={handleFormChange}
                        >
                            {vacency &&
                                vacency.map((v) => (
                                    <option key={v.id} value={v.id}>
                                        {v.job_title}
                                    </option>
                                ))}
                        </select>
                    </div>
                    <div className="form-group">
                        <label htmlFor="phaseNum">
                            Enter number of phase :
                        </label>
                        <input
                            type="number"
                            className="form-control"
                            name="num_of_phases"
                            value={proposal.num_of_phases}
                            onChange={handleFormChange}
                        />
                    </div>
                    <br />
                    <div class="modal-footer">
                        <button type="submit" className="btn btn-success">
                            Save
                        </button>{" "}
                        <button
                            type="button"
                            class="btn btn-secondary"
                            data-bs-dismiss="modal"
                        >
                            Close
                        </button>
                    </div>
                </form>
            </div>
        </>
    );
};

export default InterviewProposal;

if (document.getElementById("ip-root")) {
    ReactDOM.render(<InterviewProposal />, document.getElementById("ip-root"));
}
