import axios from "axios";
import React, { useState, useEffect } from "react";
import { useForm } from "react-hook-form";
import * as ReactDOM from "react-dom";
import { ToastContainer, toast } from "react-toastify";
import "react-toastify/dist/ReactToastify.css";
import SpinnerButton from "./SpinnerButton";

const RejectCandidate = ({
    name,
    register,
    handleSubmit,
    onSubmit,
    error,
    load,
    closeRef,
}) => {
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
                <form onSubmit={handleSubmit(onSubmit)}>
                    <div className="form-group">
                        <label htmlFor="">
                            Please select a reason to provide feedback :
                        </label>

                        <div className="form-check">
                            <input
                                type="radio"
                                value="Need to improve Portfolio"
                                {...register(name, { required: true })}
                                id="f1"
                            />
                            <label htmlFor="f1">
                                Need to improve Portfolio
                            </label>
                        </div>
                        <div className="form-check">
                            <input
                                type="radio"
                                value="Skills does not match the applied role"
                                {...register(name, { required: true })}
                                id="f2"
                            />
                            <label htmlFor="f2">
                                Skills does not match the applied role
                            </label>
                        </div>
                        <div className="form-check">
                            <input
                                type="radio"
                                value="Proper CV not given"
                                id="f3"
                                {...register(name, { required: true })}
                            />
                            <label htmlFor="f3">Proper CV not given</label>
                        </div>
                        {error.feedback && (
                            <p className="text text-danger">
                                Please Enter a feedback
                            </p>
                        )}
                    </div>
                    <div class="modal-footer">
                        {load ? (
                            <SpinnerButton cls="btn btn-danger" />
                        ) : (
                            <button type="submit" class="btn btn-danger">
                                Submit Feedback
                            </button>
                        )}

                        <button
                            type="button"
                            class="btn btn-secondary"
                            data-bs-dismiss="modal"
                            ref={closeRef}
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
