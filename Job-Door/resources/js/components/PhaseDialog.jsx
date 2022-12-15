import React, { useEffect, useRef, useState } from "react";
import { useForm } from "react-hook-form";
import TechnicalPhase from "./TechnicalPhase";
import * as ReactDOM from "react-dom";
import axios from "axios";
import { toast } from "react-toastify";
import { isEmpty } from "lodash";
import approvalColor from "./ApprovalStyle";

const sendProposal = "http://localhost:8000/api/saveProposal";
const getProposal = "http://localhost:8000/api/getInterviewProposal";

const PhaseDialog = ({ phase, pr, setProp }) => {
    const notify = (msg, id) => {
        toast.success(`${msg}`, {
            toastId: { id },
            position: "bottom-right",
            autoClose: 5000,
            hideProgressBar: false,
            closeOnClick: true,
            pauseOnHover: true,
            draggable: true,
            progress: undefined,
            theme: "light",
        });
    };

    const {
        register,
        handleSubmit,
        watch,
        getValues,
        formState,
        formState: { errors },
    } = useForm({
        defaultValues: {
            title: "",
            description: "",
            stime: "",
            etime: "",
            date: "",
            question: "",
            type: "",
        },
    });

    let [load, setLoad] = useState(false);
    let closeRef = useRef(null);
    let uid = 0;

    useEffect(() => {
        {
            phase &&
                axios.get(`${getProposal}/${phase[0].id}`).then((r) => {
                    setProp(r.data.res);
                });
        }
    }, []);

    console.log(pr);

    const onSubmit = (data) => {
        if (data) {
            setLoad(true);
            axios
                .post(
                    sendProposal,
                    { id: uid, ...data },
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
                        axios.get(`${getProposal}/${uid}`).then((r) => {
                            setProp(r.data.res);
                        });
                    }
                    setLoad(false);
                    closeRef.current.click();
                    notify(
                        "Interview Proposal Created Sucessfully",
                        phase[0].id
                    );
                });
        }
    };
    const handleClick = (e) => {
        e.preventDefault();

        uid = e.target.value;

        ReactDOM.render(
            <TechnicalPhase
                register={register}
                handleSubmit={handleSubmit}
                getValues={getValues}
                errors={errors}
                closeRef={closeRef}
                load={load}
                id={uid}
                onSubmit={onSubmit}
            />,
            document.getElementById("tech-proposal-root")
        );
    };

    useEffect(() => {
        ReactDOM.render(
            <TechnicalPhase
                register={register}
                handleSubmit={handleSubmit}
                getValues={getValues}
                errors={errors}
                closeRef={closeRef}
                load={load}
                id={uid}
                onSubmit={onSubmit}
            />,
            document.getElementById("tech-proposal-root")
        );
    }, [formState, load]);

    return (
        <>
            <br />
            {phase &&
                phase.map((p) => (
                    <div class="card" style={{ width: "30rem" }} key={p.id}>
                        <div class="card-body">
                            <div className="row">
                                <div className="col-sm-9">
                                    <h4 class="card-title mb-4">
                                        Interview Phases for {p.post}
                                    </h4>
                                </div>
                                <div className="col-sm-3">
                                    <button>Delete</button>
                                </div>
                            </div>

                            {[...Array(p.num_of_phases)].map((e, i) => (
                                <div
                                    class="accordion"
                                    id="accordionExample"
                                    key={i}
                                >
                                    <div class="accordion-item ">
                                        <h2
                                            class="accordion-header"
                                            id="headingTwp"
                                        >
                                            <button
                                                class="accordion-button collapsed"
                                                type="button"
                                                data-bs-toggle="collapse"
                                                data-bs-target={
                                                    "#Phase" + (i + 1)
                                                }
                                                aria-expanded="false"
                                                aria-controls="collapseTwo"
                                            >
                                                Phase {i + 1}
                                            </button>
                                        </h2>
                                        <div
                                            id={"Phase" + (i + 1)}
                                            class="accordion-collapse collapse"
                                            aria-labelledby="headingTwo"
                                            data-bs-parent="#accordionExample"
                                        >
                                            <div class="accordion-body">
                                                <>
                                                    {!isEmpty(pr) ? (
                                                        <div className="card">
                                                            <div className="card-body">
                                                                <h4 className="card-title mb-4">
                                                                    {
                                                                        pr.res
                                                                            .title
                                                                    }
                                                                </h4>
                                                                <h6 className="card-subtitle mb-1">
                                                                    <strong>
                                                                        Date
                                                                    </strong>
                                                                </h6>
                                                                <p className="card-text mb-4">
                                                                    {
                                                                        pr.res
                                                                            .date
                                                                    }
                                                                </p>
                                                                <h6 className="card-subtitle mb-1">
                                                                    <strong>
                                                                        Type
                                                                    </strong>
                                                                </h6>
                                                                <p className="card-text mb-4">
                                                                    {pr.type ===
                                                                    "TECH"
                                                                        ? "TECHNICAL INTERVIEW"
                                                                        : "BEHAVIOURAL INTERVIEW"}
                                                                </p>
                                                                Status :{" "}
                                                                {approvalColor(
                                                                    pr.res
                                                                        .status
                                                                )}
                                                                <br />
                                                                {pr.res
                                                                    .status ===
                                                                "APPROVED" ? (
                                                                    <button className="btn btn-primary">
                                                                        Start Process
                                                                    </button>
                                                                ) : (
                                                                    <button
                                                                        className="btn btn-primary"
                                                                        disabled
                                                                    >
                                                                       Start Process
                                                                    </button>
                                                                )}{" "}
                                                                <button className="btn btn-danger">
                                                                    Delete
                                                                </button>{" "}
                                                                <button className="btn btn-secondary">
                                                                    Update
                                                                </button>
                                                            </div>
                                                        </div>
                                                    ) : (
                                                        <button
                                                            value={p.id}
                                                            class="btn btn-primary"
                                                            data-bs-toggle="modal"
                                                            data-bs-target="#proposalModel"
                                                            onClick={
                                                                handleClick
                                                            }
                                                        >
                                                            Create Proposal
                                                        </button>
                                                    )}
                                                </>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            ))}
                        </div>
                    </div>
                ))}
        </>
    );
};

export default PhaseDialog;
