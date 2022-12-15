import moment from "moment/moment";
import React, { useState } from "react";
import { useForm } from "react-hook-form";
import SpinnerButton from "./SpinnerButton";

const TechnicalPhase = ({
    id,
    register,
    handleSubmit,
    onSubmit,
    errors,
    load,
    closeRef,
    getValues,
}) => {
    const checkDate = (d) => {
        return new Date(d).getDay() >= new Date().getDay();
    };

    const checkStime = (s) => {
        const stime = moment(s, "h:mm:ss a");
        const now = moment(new Date().getDate(), "h:mm:ss a");

        return stime.isAfter(now);
    };

    const checkEtime = (e) => {
        const etime = moment(e, "h:mm:ss a");
        const stime = moment(getValues("stime"), "h:mm:ss a");

        return etime.isAfter(stime);
    };
    return (
        <>
            <div className="modal-body">
                <form onSubmit={handleSubmit(onSubmit)}>
                    <div className="form-group">
                        <div className="form-control">
                            <label htmlFor="">Enter title:</label>
                            <input
                                type="text"
                                {...register("title", { required: true })}
                            />
                            <br />
                            <span className="text text-danger">
                                {errors.title && "Please enter a title"}
                            </span>
                        </div>
                    </div>

                    <div className="form-group">
                        <div className="form-control">
                            <label htmlFor="">Enter description:</label>
                            <br />
                            <textarea
                                type="text"
                                rows="10"
                                cols="30"
                                {...register("description", { required: true })}
                            ></textarea>
                            <br />
                            <span className="text text-danger">
                                {errors.description &&
                                    "Please enter a description"}
                            </span>
                        </div>
                    </div>
                    <div className="form-group">
                        <div className="form-control">
                            <label htmlFor="">Set Interview type:</label>
                            <select {...register("type", { required: true })}>
                                <option value="TECH">
                                    Technical Interview
                                </option>
                            </select>
                            <br />
                            <span className="text text-danger">
                                {errors.type && "Please select a type"}
                            </span>
                        </div>
                    </div>
                    <div className="form-group">
                        <div className="form-control">
                            <label htmlFor="">Enter date:</label>
                            <input
                                type="date"
                                {...register("date", {
                                    required: true,
                                    validate: checkDate,
                                })}
                            />
                            <br />
                            <span className="text text-danger">
                                {errors.date && "Please enter a valid date"}
                            </span>
                        </div>
                    </div>

                    {/* <div className="form-group">
                        <div className="form-control">
                            <label htmlFor="">Enter start time:</label>
                            <input
                                type="time"
                                {...register("stime", {
                                    required: true,
                                    validate: checkStime,
                                })}
                            />
                            <br />
                            <span className="text text-danger">
                                {errors.stime &&
                                    "Please enter a valid start time"}
                            </span>
                        </div>
                    </div>

                    <div className="form-group">
                        <div className="form-control">
                            <label htmlFor="">Enter end time:</label>
                            <input
                                type="time"
                                {...register("etime", {
                                    required: true,
                                    validate: checkEtime,
                                })}
                            />
                            <br />
                            <span className="text text-danger">
                                {errors.etime &&
                                    "Please enter a valid end time"}
                            </span>
                        </div>
                    </div> */}

                    <div className="form-group">
                        <div className="form-control">
                            <br />
                            <label htmlFor="">Enter question:</label>
                            <textarea
                                type="question"
                                rows="10"
                                cols="30"
                                {...register("question", { required: true })}
                            ></textarea>
                            <br />
                            <span className="text text-danger">
                                {errors.question && "Please enter the question"}
                            </span>
                        </div>
                    </div>
                    <div class="modal-footer">
                        {load ? (
                            <SpinnerButton cls="btn btn-danger" />
                        ) : (
                            <button type="submit" class="btn btn-danger">
                                Submit
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

export default TechnicalPhase;
