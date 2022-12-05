import React, { useEffect, useState } from "react";
import * as ReactDOM from "react-dom";
import axios from "axios";
import Cookie from "js-cookie";

const Login = () => {
    let config = {
        headers: {
            Accept: "application/json",
        },
    };
    let [unmail, setUnmail] = useState("");
    let [pass, setPass] = useState("");

    const handleSubmit = (e) => {
        e.preventDefault();
        console.log(Cookie.get("XSRF-TOKEN"));
        // if (Cookie.get("XSRF-TOKEN")) {
        //     console.log("FOUND");
        //     axios
        //         .post(
        //             "/login",
        //             {
        //                 unmail: unmail,
        //                 pass: pass,
        //             },
        //             config
        //         )
        //         .then((r) => {
        //             console.log("sucess");
        //         })
        //         .catch((er) => console.log("Error getting data"));
        // } else {
        //     axios.get("/sanctum/csrf-cookie").then((response) => {
        //         axios
        //             .post(
        //                 "/login",
        //                 {
        //                     unmail: unmail,
        //                     pass: pass,
        //                 },
        //                 config
        //             )
        //             .then((r) => {
        //                 console.log("sucess");
        //             })
        //             .catch((er) => console.log("Error getting data"));
        //     });
        // }
    };
    const handleUnmail = (e) => {
        setUnmail(e.target.value);
    };
    const handlePass = (e) => {
        setPass(e.target.value);
    };

    return (
        <>
            <form
                onSubmit={handleSubmit}
                className="shadow-lg mt-5 p-5 bg-white"
            >
                <fieldset>
                    <legend>Sign In</legend>

                    <div class="form-group">
                        <br />
                        <div class="form mb-3">
                            <label for="floatingInput">
                                Username or Email address
                            </label>
                            <input
                                type="text"
                                class="form-control"
                                id="floatingInput"
                                name="unmail"
                                placeholder="User name or Email"
                                onChange={handleUnmail}
                            />
                        </div>
                        <div class="form mb-3">
                            <label for="floatingPassword">Password</label>
                            <input
                                type="password"
                                class="form-control"
                                id="floatingPassword"
                                name="pass"
                                placeholder="Password"
                                onChange={handlePass}
                            />
                        </div>
                        <br />
                        <input
                            type="submit"
                            className="btn btn-primary"
                            value="Sign In"
                        />
                    </div>
                </fieldset>
            </form>
        </>
    );
};
export default Login;

if (document.getElementById("login-root")) {
    ReactDOM.render(<Login />, document.getElementById("login-root"));
}
