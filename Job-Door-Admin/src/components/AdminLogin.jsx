import React, { useState } from "react";
import Button from "react-bootstrap/Button";
import Container from "react-bootstrap/Container";
import Row from "react-bootstrap/Row";
import Col from "react-bootstrap/Col";
import axios from "axios";
import { Form, redirect } from "react-router-dom";
import { Spinner } from "react-bootstrap";

const loginUrl = "http://localhost:8000/api/loginAdmin";
const sanctumURL = "http://localhost:8000/sanctum/csrf-cookie";
let sucess = null;
let button = <button className="btn btn-primary">Login</button>;
async function login(data) {
  return await axios.post(loginUrl, data, {
    withCredentials: true,
  });
}

export async function action({ request, params }) {
  const formData = await request.formData();
  const loginInfo = Object.fromEntries(formData);
  button = (
    <Button variant="primary" disabled>
      <Spinner
        as="span"
        animation="grow"
        size="sm"
        role="status"
        aria-hidden="true"
      />
      Loading...
    </Button>
  );
  // axios.get(sanctumURL).then(() => {
  sucess = await (await login(loginInfo)).data;

  if (sucess) return redirect("/dashboard");
  return redirect("/");

  // return null;
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
        <Col lg-3></Col>
        <Col lg-6>
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
            <p>{button}</p>
          </Form>
        </Col>
        <Col lg-3></Col>
      </Row>
    </Container>
  );
};

export default AdminLogin;
