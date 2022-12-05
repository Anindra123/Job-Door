import React from "react";
import * as ReactDOM from "react-dom";
const InterviewProposal = () => {
    return (
        <div className="container">
            <div className="row">
                <div className="col">
                    <button className="btn btn-primary">
                        Add Interview Proposal
                    </button>
                </div>
            </div>
        </div>
    );
};

export default InterviewProposal;

if (document.getElementById("ip-root")) {
    ReactDOM.render(<InterviewProposal />, document.getElementById("ip-root"));
}
