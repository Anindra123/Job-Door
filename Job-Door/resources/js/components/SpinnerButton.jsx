import React from "react";

const SpinnerButton = ({ cls }) => {
    return (
        <button className={cls} type="button" disabled>
            <span
                class="spinner-border spinner-border-sm"
                role="status"
                aria-hidden="true"
            ></span>
            Loading...
        </button>
    );
};

export default SpinnerButton;
