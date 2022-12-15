import axios from "axios";
import React, { useEffect, useRef, useState } from "react";
import * as ReactDOM from "react-dom";
import { useForm } from "react-hook-form";
import { ToastContainer } from "react-toastify";
import PhaseDialog from "./PhaseDialog";
import SpinnerButton from "./SpinnerButton";
import useSpinner from "./useSpinner";

const baserUrl = "http://localhost:8000/api/getVacencyPostList";
const postUrl = "http://localhost:8000/api/saveProposalPhase";
const approvedListUrl = "http://localhost:8000/api/getApprovedList";
const phasesUrl = "http://localhost:8000/api/getPhases";
const getProposal = "http://localhost:8000/api/getInterviewProposal";
const InterviewProposal = () => {
    const {
        register,
        handleSubmit,
        watch,
        setValue,
        formState: { errors },
    } = useForm({ defaultValues: { jv_id: 0, num_of_phases: 0 } });
    let [load, setLoad] = useState(false);
    let [cList, setcList] = useState([]);
    let [proposal, setProposal] = useState({ jv_id: 0, num_of_phases: 0 });
    let [vacency, setVacency] = useState([]);
    let [pList, setpList] = useState(null);
    let [isprop, setProp] = useState(false);
    let [prop, setIntProp] = useState(null);
    let closeRef = useRef(null);

    useEffect(() => {
        axios.get(baserUrl).then((r) => {
            setVacency(r.data);
            setValue("jv_id", r.data[0].id);
        });
    }, []);

    useEffect(() => {
        axios
            .get(phasesUrl, {
                withCredentials: true,
                headers: {
                    "Content-Type": "application/json",
                    "Access-Control-Allow-Origin": "*",
                },
            })
            .then((r) => {
                setpList(r.data.res);
                axios
                    .get(`${getProposal}/${r.data.res[0].id}`, {
                        withCredentials: true,
                        headers: {
                            "Content-Type": "application/json",
                            "Access-Control-Allow-Origin": "*",
                        },
                    })
                    .then((r) => {
                        console.log(r.data);
                        setIntProp(r.data);
                    });
            });
    }, []);

    useEffect(() => {
        ReactDOM.render(
            <PhaseDialog phase={pList} pr={prop} setProp={setIntProp} />,
            document.getElementById("proposal-root")
        );
    }, [pList, prop]);

    useEffect(() => {
        const sub = watch((data) => {
            axios.get(`${approvedListUrl}/${data.jv_id}`).then((r) => {
                setcList(r.data.res);
            });
            axios
                .get(`${phasesUrl}/${data.jv_id}`, {
                    withCredentials: true,
                    headers: {
                        "Content-Type": "application/json",
                        "Access-Control-Allow-Origin": "*",
                    },
                })
                .then((r) => {
                    setProp(r.data.res);
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

    const onSubmit = (data) => {
        setLoad(true);
        axios
            .post(
                postUrl,
                {
                    jv_id: data.jv_id,
                    num_of_phases: Number(data.num_of_phases),
                },
                {
                    withCredentials: true,
                    headers: {
                        "Content-Type": "application/json",
                        "Access-Control-Allow-Origin": "*",
                    },
                }
            )
            .then((r) => {
                if (r.data.res) {
                    axios
                        .get(phasesUrl, {
                            withCredentials: true,
                            headers: {
                                "Content-Type": "application/json",
                                "Access-Control-Allow-Origin": "*",
                            },
                        })
                        .then((r) => {
                            setpList(r.data.res);
                            setLoad(false);
                            closeRef.current.click();
                        });
                }
            });
    };
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
                            load ? (
                                <SpinnerButton cls="btn btn-success" />
                            ) : isprop ? (
                                <>
                                    <span className="text text-danger">
                                        Already proposal phase set
                                    </span>{" "}
                                    <button
                                        type="submit"
                                        className="btn btn-success"
                                        disabled
                                    >
                                        Save
                                    </button>
                                </>
                            ) : (
                                <button
                                    type="submit"
                                    className="btn btn-success"
                                >
                                    Save
                                </button>
                            )
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
                            ref={closeRef}
                        >
                            Close
                        </button>
                    </div>
                </form>
            </div>
            <ToastContainer />
        </>
    );
};

export default InterviewProposal;

if (document.getElementById("ip-root")) {
    ReactDOM.render(<InterviewProposal />, document.getElementById("ip-root"));
}
