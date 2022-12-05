import React, { useEffect, useState } from "react";
import * as ReactDOM from "react-dom";
import axios from "axios";
import JobCard from "./JobList";
const baseUrl = "http://localhost:8000/api/getJobVacencyList";

function ShowJobList() {
    let [lst, setList] = useState([]);
    let [search, setSearch] = useState("");
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
                setList(res.data.job);
            });
    }, []);

    const handleSearch = (e) => {
        setSearch(e.currentTarget.value);

        if (search.length <= 1) {
            axios
                .get(baseUrl, {
                    withCredentials: true,
                    headers: {
                        "Content-Type": "application/x-www-form-urlencoded",
                        "Access-Control-Allow-Origin": "*",
                    },
                })
                .then((res) => {
                    setList(res.data.job);
                });
        }
        let val = lst.filter((l) => {
            return (
                l.job_title.match(`${search}`) ||
                l.company_name.match(`${search}`)
            );
        });

        setList(val);
    };

    return (
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
                    {lst &&
                        lst.map((l) => {
                            return <JobCard data={l} key={l.id} />;
                        })}
                </div>
            </div>
        </div>
    );
}

export default ShowJobList;

if (document.getElementById("jobVacency-root")) {
    ReactDOM.render(
        <ShowJobList />,
        document.getElementById("jobVacency-root")
    );
}
