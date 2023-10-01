import Addip from "./add-ip";
import { useState } from "react";
import { Link } from "react-router-dom";
import { useAuth } from "../hooks/useAuth";
function Navigation({getIpList}) {
  const { logout } = useAuth();
  const [open, setOpen] = useState(false);
  return (
    <header className="absolute inset-x-0 top-0 z-50 mb-8">
      <nav
        className="flex items-center justify-between p-6 lg:px-8"
        aria-label="Global"
      >
        <div className="flex  grow justify-center gap-2">
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
        <div className="flex gap-2">
          <button
            type="button"
            onClick={() => setOpen(true)}
            className="flex justify-center rounded-md bg-indigo-600 px-3 py-1.5 text-sm font-semibold leading-6 text-white shadow-sm hover:bg-indigo-500 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-600"
          >
            Add new IP
          </button>
          <button
            type="button"
            onClick={logout}
            className="flex justify-center rounded-md bg-indigo-600 px-3 py-1.5 text-sm font-semibold leading-6 text-white shadow-sm hover:bg-indigo-500 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-600"
          >
            Logout
          </button>
        </div>
      </nav>

      <Addip open={open} setOpen={setOpen} getIpList={getIpList}/>
    </header>
  );
}

export default Navigation;