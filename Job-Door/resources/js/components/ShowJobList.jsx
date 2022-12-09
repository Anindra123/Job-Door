import React, { useEffect, useState } from "react";
import * as ReactDOM from "react-dom";
import axios from "axios";
import JobCard from "./JobCard";
import { ToastContainer } from "react-toastify";
const baseUrl = "http://localhost:8000/api/getJobVacencyList";
const searchUrl = "http://localhost:8000/api/searchJobVacencyList";

function ShowJobList() {
    let [lst, setList] = useState([]);
    let [search, setSearch] = useState(null);
    let [port, setPort] = useState(false);
    useEffect(() => {
        axios
            .get(baseUrl, {
                withCredentials: true,
                headers: {
                    "Content-Type": "application/x-www-form-urlencoded",
                    "Access-Control-Allow-Origin": "*",
                },
            })
            .then((res) => {
                if (res.data.port !== null) setPort(true);
                setList(res.data.job);
            });
    }, []);

    useEffect(() => {
        let source = axios.CancelToken.source();

        axios
            .get(`${searchUrl}/${search}`, { cancelToken: source.token })
            .then((res) => {
                if (res.data.job.length > 1) {
                    setList(res.data.job);
                } else {
                    const data = [];
                    data.push(res.data.job);
                    setList(data);
                }
            })
            .catch((e) => {});
        return function () {
            source.cancel();
        };
    }, [search]);

    const handleSearch = (e) => {
        setSearch(e.currentTarget.value === "" ? null : e.currentTarget.value);
    };
    return (
        <>
            <div className="container">
                <div className="row">
                    <div className="col-auto m-3">
                        <h2>Apply for Job</h2>
                    </div>
                </div>
                <div className="row">
                    <div className="col">
                        <div className="form-group mb-3">
                            <label htmlFor="job_search" className="form-label">
                                Search for job:
                            </label>
                            <input
                                type="search"
                                className="form-control"
                                name="job_search"
                                placeholder="Enter company name, job type....."
                                id="job_search"
                                onChange={handleSearch}
                            />
                        </div>
                    </div>
                </div>
                <div className="row ">
                    <div className="col-auto m-3 job-posts">
                        {port ? (
                            lst &&
                            lst.map((l) => {
                                return <JobCard data={l} key={l.id} />;
                            })
                        ) : (
                            <div class="alert alert-dismissible alert-danger">
                                <span>
                                    Please create a portfolio for applying to
                                    job
                                </span>
                                <button
                                    type="button"
                                    class="btn-close"
                                    data-bs-dismiss="alert"
                                ></button>
                            </div>
                        )}
                    </div>
                </div>
            </div>
            <ToastContainer />
        </>
    );
}

export default ShowJobList;

if (document.getElementById("jobVacency-root")) {
    ReactDOM.render(
        <ShowJobList />,
        document.getElementById("jobVacency-root")
    );
}
