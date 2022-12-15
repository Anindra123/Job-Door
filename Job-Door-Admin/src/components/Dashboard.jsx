import React, { useState } from "react";
import { Form, Link, NavLink, Outlet, redirect } from "react-router-dom";

export async function action({ request, params }) {
  const data = await request.formData();
  return redirect("/");
}

const Dashboard = () => {
  return (
    <>
      <nav class="navbar sticky-top navbar-expand-lg navbar-dark bg-dark">
        <div class="container">
          <a class="navbar-brand" href="adminDashboard">
            Job Door
          </a>
          {/* <button
            class="navbar-toggler"
            type="button"
            data-bs-toggle="collapse"
            data-bs-target="#navbarColor02"
            aria-controls="navbarColor02"
            aria-expanded="false"
            aria-label="Toggle navigation"
          >
            <span class="navbar-toggler-icon"></span>
          </button> */}
          <Form method="post">
            <button type="submit" className="btn btn-primary">
              Logout
            </button>
          </Form>
        </div>
      </nav>
      <div class="container-fluid">
        <div class="row mt-3">
          <div class="col-sm-3" id="sideNav">
            <Link to="/dashboard/getProposal" className="btn btn-primary">
              Interview Proposal
            </Link>
          </div>
          <div class="col-sm-9 mt-2">
            <Outlet />
          </div>
        </div>
      </div>
    </>
  );
};

export default Dashboard;
