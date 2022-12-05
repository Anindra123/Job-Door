import axios from "axios";
import React, { useEffect, useState } from "react";
import ReactDOM from "react-dom";
import JobList from "./JobList";

function Example() {
    const baseUrl = "http://localhost:8000/api/getJobVacencyList";
    let [num, setNum] = useState(0);
    let [lst, setList] = useState(null);
    const clickbtn = (e) => {
        num++;
        setNum(num);
    };

    useEffect(() => {
        axios
            .get(baseUrl)
            .then((res) => {
                setList(res.data);
            })
            .catch((e) => {});
    }, []);
    console.log(lst);
    return (
        <div className="container">
            <div className="row justify-content-center">
                <div className="col-md-8">
                    <div className="card">
                        <div className="card-header">Example Component</div>
                        <JobList data={lst} />
                        <div className="card-body">
                            I'm an example component! Count {num}
                        </div>
                        <button className="btn btn-primary" onClick={clickbtn}>
                            Click
                        </button>
                    </div>
                </div>
            </div>
        </div>
    );
}

export default Example;

if (document.getElementById("root")) {
    ReactDOM.render(<Example />, document.getElementById("root"));
}

// const rootNode = document.getElementById("root");
// console.log(rootNode);
// const root = ReactDOM.createRoot(rootNode);
// root.render(<Example/>);
