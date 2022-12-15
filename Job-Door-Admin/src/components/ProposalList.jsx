import React, { useEffect, useState } from "react";
import axios from "axios";
import { toast, ToastContainer } from "react-toastify";
import { Button, Spinner } from "react-bootstrap";

const propsalRoute = "http://localhost:8000/api/getProposals";
const approvalRoute = "http://localhost:8000/api/approveProposals";
const ProposalList = () => {
  let [lst, setList] = useState([]);
  let [approval, setApproval] = useState("");
  let [load, setLoading] = useState(false);

  useEffect(() => {
    axios
      .get(propsalRoute, {
        withCredentials: true,
      })
      .then((r) => {
        setList(r.data.res);
      });
  }, [approval]);

  const handleClick = (e) => {
    let id = e.target.value;
    setLoading(true);

    axios
      .get(`${approvalRoute}/${id}`, {
        withCredentials: true,
      })
      .then((r) => {
        setApproval(r.data.res);
        setLoading(false);
      });
  };

  return (
    <>
      <table className="table">
        <thead>
          <tr>
            <th>From</th>
            <th>Company Name</th>
            <th>Stage</th>
            <th>Job Post</th>
            <th>Proposal</th>
            <th>Status</th>
            <th>Action</th>
          </tr>
        </thead>
        <tbody>
          {lst &&
            lst.map((l, { i, e }) => (
              <tr key={e}>
                <td>{l.name}</td>
                <td>{l.comp}</td>
                <td>TECHNICAL</td>
                <td>{l.title}</td>
                <td>
                  <button className="btn btn-primary">View Proposal</button>
                </td>
                <td>{l.proposal.status}</td>
                <td>
                  {!load ? (
                    l.proposal.status === "PENDING" ? (
                      <button
                        className="btn btn-primary"
                        onClick={handleClick}
                        value={l.proposal.id}
                      >
                        Approve
                      </button>
                    ) : (
                      <button className="btn btn-danger" value={l.proposal.id}>
                        Decline
                      </button>
                    )
                  ) : (
                    <Button variant="primary" disabled>
                      <Spinner
                        as="span"
                        animation="border"
                        size="sm"
                        role="status"
                        aria-hidden="true"
                      />
                      <span>Loading...</span>
                    </Button>
                  )}
                </td>
              </tr>
            ))}
        </tbody>
      </table>
    </>
  );
};
export default ProposalList;
