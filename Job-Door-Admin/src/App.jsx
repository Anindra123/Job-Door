import { useState } from "react";
import reactLogo from "./assets/react.svg";
import "./App.css";
import AdminLogin from "./components/AdminLogin";

function App() {
  const [count, setCount] = useState(0);

  return (
    <div className="App">
      <AdminLogin />
    </div>
  );
}

export default App;
