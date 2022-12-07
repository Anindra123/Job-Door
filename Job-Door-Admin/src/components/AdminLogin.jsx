import React, { useState } from "react";
import Button from "react-bootstrap/Button";
import Container from "react-bootstrap/Container";
import Row from "react-bootstrap/Row";
import Col from "react-bootstrap/Col";
import axios from "axios";
import { Form } from "react-router-dom";

const loginUrl = "http://localhost:8000/api/loginAdmin";
const sanctumURL = "http://localhost:8000/sanctum/csrf-cookie";

export async function action({ request, params }) {
  const formData = await request.formData();
  const loginInfo = Object.fromEntries(formData);

  // axios.get(sanctumURL).then(() => {
  axios.post(
    loginUrl,
    loginInfo,
    {
      withCredentials: true,
    },
    (r) => {
      if (r.data.error) {
        console.log(r.data.error);
      } else {
        console.log("hit");
      }
    }
  );
  // });
  return null;
}
const AdminLogin = () => {
  // let [formData, setFormData] = useState({ email: "", password: "" });

  // const handleFormChange = (e) => {
  //   e.preventDefault();
  //   setFormData({ ...formData, [e.target.name]: e.target.value });
  // };

  return (
    <Container className="border-primary p-5 shadow-lg">
      <Row>
        <Col lg>
          <Row>
            <Col>
              <h3>Admin Login</h3>
            </Col>
          </Row>
          <Form method="post">
            <div className="form-group">
              <label htmlFor="email">Email</label>
              <input type="text" className="form-control" name="email" />
            </div>
            <div className="form-group">
              <label htmlFor="password">Password</label>
              <input type="password" className="form-control" name="password" />
            </div>
            <br />
            <p>
              <button type="submit" className="btn btn-danger">
                Login
              </button>
            </p>
          </Form>
        </Col>
      </Row>
    </Container>
  );
};

export default AdminLogin;
