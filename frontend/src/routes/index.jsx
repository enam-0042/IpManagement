import { Routes, Route } from "react-router-dom";
import Signin from "../pages/signin";
import Signup from "../pages/signup";
import Home from "../pages/home";
import Loglist from "../pages/loglist";
import { ProtectedRoute } from "./protected-routes";
function Mainroute() {
  return (
    <Routes>
      <Route
        path="/"
        element={
          <ProtectedRoute>
            <Home />
          </ProtectedRoute>
        }
      />

      <Route
        path="/loglist"
        element={
          <ProtectedRoute>
            <Loglist />
          </ProtectedRoute>
        }
      />
      <Route path="/signin" element={<Signin />} />
      <Route path="/signup" element={<Signup />} />
    </Routes>
  );
}
export default Mainroute;
