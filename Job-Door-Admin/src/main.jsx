import React from "react";
import ReactDOM from "react-dom/client";
import App from "./App";
import "./index.css";
import "bootstrap/dist/css/bootstrap.min.css";
import { createBrowserRouter, Route, RouterProvider } from "react-router-dom";
import AdminLogin, { action as loginAction } from "./components/AdminLogin";

const route = createBrowserRouter([
  {
    path: "/",
    element: <AdminLogin />,
    action: loginAction,
  },
]);

ReactDOM.createRoot(document.getElementById("root")).render(
  <React.StrictMode>
    <RouterProvider router={route} />
  </React.StrictMode>
);
