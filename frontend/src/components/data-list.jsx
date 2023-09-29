import React, { useEffect, useState } from "react";
import Loader from "./loader";
export default function Datalist({ loadData, children }) {
  const [loading, setLoading] = useState(true);

  useEffect(() => {
    async function load() {
      await loadData();
      setLoading(false);
    }
    load();
  }, []);
  return (
    <div>
      {loading ? (
        <div role="status" className="flex justify-center items-center h-96	">
          <Loader/>
        
        </div>
      ) : (
        children
      )}
    </div>
  );
}
