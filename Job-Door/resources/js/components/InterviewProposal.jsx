import axios from "axios";
import React, { useEffect, useState } from "react";
import * as ReactDOM from "react-dom";
import { useForm } from "react-hook-form";
import PhaseDialog from "./PhaseDialog";

const baserUrl = "http://localhost:8000/api/getVacencyPostList";
const postUrl = "";
const approvedListUrl = "http://localhost:8000/api/getApprovedList";
const InterviewProposal = () => {
    const {
        register,
        handleSubmit,
        watch,
        setValue,
        formState,
        formState: { errors },
    } = useForm({ defaultValues: { jv_id: 0, num_of_phases: 0 } });
    let [cList, setcList] = useState([]);
    let [proposal, setProposal] = useState({ jv_id: 0, num_of_phases: 0 });
    let [vacency, setVacency] = useState([]);
    useEffect(() => {
        axios.get(baserUrl).then((r) => {
            setVacency(r.data);
            setValue("jv_id", r.data[0].id);
        });
    }, []);

    useEffect(() => {
        const sub = watch((data) => {
            axios.get(`${approvedListUrl}/${data.jv_id}`).then((r) => {
                setcList(r.data.res);
            });
        });

        return () => {
            sub.unsubscribe();
        };
    }, [watch]);

    const handleFormChange = (e) => {
        e.preventDefault();
        setProposal({ ...proposal, [e.target.name]: e.target.value });
    };

    // const handleFormSubmission = (e) => {
    //     e.preventDefault();
    //     // console.log(proposal);

    //     axios.post();
    // };
    const onSubmit = (data) => {};
    console.log(cList);
    return (
        <>
            <div class="modal-body">
                <form onSubmit={handleSubmit(onSubmit)}>
                    <div className="form-group">
                        <label htmlFor="vacencyList">
                            Select a job vacency to create proposal :
                        </label>
                        <select
                            className="form-control"
                            {...register("jv_id", { required: true })}
                        >
                            {vacency &&
                                vacency.map((v) => (
                                    <option key={v.id} value={v.id}>
                                        {v.job_title}
                                    </option>
                                ))}
                        </select>
                        <span className="text text-danger">
                            {errors.jv_id && "Please select a job vacency post"}
                        </span>
                        <br />
                        <h6>Approved Candidate List : </h6>
                        {cList.length > 0 ? (
                            <div className="border border-secondar p-3">
                                <ul class="list-group">
                                    {cList.map((c) => (
                                        <li
                                            class="list-group-item"
                                            key={c.id}
                                        >{`${c.fname} ${c.lname}`}</li>
                                    ))}
                                </ul>
                                <br />
                            </div>
                        ) : (
                            <p className="text text-danger">
                                No Candidates Approved
                            </p>
                        )}
                    </div>

                    <div className="form-group">
                        <label htmlFor="phaseNum">
                            Enter number of phase :
                        </label>
                        <input
                            type="number"
                            className="form-control"
                            {...register("num_of_phases", {
                                required: true,
                                min: 1,
                            })}
                        />
                        <span className="text text-danger">
                            {errors.num_of_phases &&
                                "Please enter a valid phase number"}
                        </span>
                    </div>
                    <br />
                    <div class="modal-footer">
                        {cList.length > 0 ? (
                            <button type="submit" className="btn btn-success">
                                Save
                            </button>
                        ) : (
                            <button
                                type="submit"
                                className="btn btn-success"
                                disabled
                            >
                                Save
                            </button>
                        )}{" "}
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
