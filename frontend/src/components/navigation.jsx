import Addip from "./add-ip";
import { useState } from "react";
import { BrowserRouter as Router, Routes, Route, Link } from "react-router-dom";
import Changelabel from "./change-label";
import { useAuth } from "../hooks/useAuth";
function Navigation() {
  const {logout} = useAuth()
  const [open, setOpen] = useState(false);
  const [clicked, setClicked] = useState(false);
  return (
    <header className="absolute inset-x-0 top-0 z-50">
      <nav
        className="flex items-center justify-between p-6 lg:px-8"
        aria-label="Global"
      >
        <div className="flex gap-2 justify-center w-11/12">
          <Link
            to="/"
            className="text-sm font-semibold leading-6 hover:text-black text-indigo-900"
          >
            Home
          </Link>
          <Link
            to="/loglist"
            className="text-sm font-semibold leading-6 text-indigo-900 hover:text-black"
          >
            Logs
          </Link>
        </div>
        <button
          type="button"
          onClick={() => setOpen(true)}
          className="flex justify-center rounded-md bg-indigo-600 px-3 py-1.5 text-sm font-semibold leading-6 text-white shadow-sm hover:bg-indigo-500 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-600"
        >
          Add new IP
        </button>
        {/* <button
          type="button" 
          onClick = {()=>setClicked(true)}
          className="flex justify-center rounded-md bg-indigo-600 px-3 py-1.5 text-sm font-semibold leading-6 text-white shadow-sm hover:bg-indigo-500 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-600"
        >
          Change label
        </button> */}
        <button
          type="button" onClick={logout}
          className="flex justify-center rounded-md bg-indigo-600 px-3 py-1.5 text-sm font-semibold leading-6 text-white shadow-sm hover:bg-indigo-500 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-600"
        >
          Logout
        </button>

      </nav>
      <Addip open={open} setOpen={setOpen} />
      {/* <Changelabel clicked={clicked} setClicked={setClicked}/> */}
    </header>
  );
}

export default Navigation;
