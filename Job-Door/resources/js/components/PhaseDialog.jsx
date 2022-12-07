import React, { useState } from "react";

const PhaseDialog = ({ phase, handleTech, handleBehaviour }) => {
    let [phaseType, setPhaseType] = useState("");

    const handleChange = (e) => {
        e.preventDefault();

        setPhaseType(e.target.value);
    };

    return (
        <>
            <h3>Phase {phase}</h3>
            <div className="form-group">
                <label htmlFor="phaseType">Select type of phase :</label>
                <select
                    name="phaseType"
                    id=""
                    value={
                        phaseType === "ti"
                            ? "Technical Interview"
                            : "Behavioural Interview"
                    }
                    className="form-control"
                >
                    <option value="ti">Technical Interview</option>
                    <option value="bi">Bhavioural Interview</option>
                </select>
            </div>
        </>
    );
};

export default PhaseDialog;
