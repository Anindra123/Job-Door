import axios from "axios";
import React, { useState, useEffect } from "react";
import * as ReactDOM from "react-dom";
import { ToastContainer, toast } from "react-toastify";
import "react-toastify/dist/ReactToastify.css";

const RejectCandidate = ({ handleClick, id }) => {
    return (
        <>
            <div class="modal-header">
                <h5 class="modal-title">Feedback</h5>
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
                <form>
                    <div className="form-group">
                        <label htmlFor="">
                            Please select a reason to provide feedback :
                        </label>

                        <div className="form-control">
                            <input
                                type="radio"
                                value="Need to improve Portfolio"
                                name="feedback"
                                id="f1"
                            />
                            <label htmlFor="f2">
                                Need to improve Portfolio
                            </label>
                        </div>
                        <div className="form-control">
                            <input
                                type="radio"
                                value="Skills does not match the applied role"
                                name="feedback"
                                id="f2"
                            />
                            <label htmlFor="f2">
                                Skills does not match the applied role"
                            </label>
                        </div>
                        <div className="form-control">
                            <input
                                type="radio"
                                value="Proper CV not given"
                                name="feedback"
                                id="f3"
                            />
                            <label htmlFor="f3">Proper CV not given</label>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button
                            type="button"
                            class="btn btn-danger"
                            data-bs-dismiss="modal"
                            value={id}
                            onSubmit={handleClick}
                        >
                            Submit Feedback
                        </button>
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

export default RejectCandidate;
