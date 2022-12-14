import React from "react";
const approvalColor = (status) => {
    if (status === "PENDING")
        return <td class="text text-warning">{status}</td>;
    if (status === "APPROVED")
        return <td class="text text-success">{status}</td>;
    if (status === "REJECTED")
        return <td class="text text-danger">{status}</td>;
};

export default approvalColor;
