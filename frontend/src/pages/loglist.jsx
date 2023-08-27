import React from "react";
import Layout from "../components/layout";
import { useState, useEffect } from "react";
import { useAuth } from "../hooks/useAuth";
import { get } from "../api/globalFetch";

function Loglist() {
  const [logList, setLogList] = useState([]);

  const { user } = useAuth();
 // console.log(logList);
  async function getLogList() {
    const response = await get("log_histories",{cache: 'force-cache'});
    setLogList(response.data);

    // const response = await fetch("http://localhost/api/log_histories", {
    //   headers: {
    //     "Content-Type": "application/json",
    //     Authorization: "Bearer " + user.token,
    //     // 'Content-Type': 'application/x-www-form-urlencoded',
    //   },
    // });
    // const responseData = await response.json();
    // setLogList(responseData.data);
    // console.log(logList);
  }

  useEffect(() => {
    getLogList();
  }, []);

  return (
    <Layout>
      <div className="mt-8 overflow-x-auto">
        <table className="w-full text-sm text-left text-gray-500 dark:text-gray-400">
          <thead className="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
            <tr>
              <th scope="col" className="px-6 py-3">
                Sl
              </th>
              <th scope="col" className="px-6 py-3">
                Description
              </th>
            </tr>
          </thead>
          <tbody>
            {logList.map((log, index) => {
              return (
                <tr className="bg-white border-b dark:bg-gray-800 dark:border-gray-700" key={log.id}>
                  <th
                    scope="row"
                    className="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white"
                  >
                    {index + 1}
                  </th>
                  <td className="px-6 py-4">{log.description}</td>
                </tr>
              );
            })}
          </tbody>
        </table>
      </div>
    </Layout>
  );
}
export default Loglist;
