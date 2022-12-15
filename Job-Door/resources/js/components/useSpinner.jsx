import axios from "axios";
import React, { useEffect, useState } from "react";
import SpinnerButton from "./SpinnerButton";

const useSpinner = ({ cls }) => {
    let [load, setLoad] = useState(false);

    const Spinner = <SpinnerButton cls={cls} />;

    return [load, setLoad, Spinner];
};

export default useSpinner;
