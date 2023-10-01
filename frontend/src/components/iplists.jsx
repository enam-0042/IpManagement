import React from "react";
import Editip from "./edit-ip";
import { useState } from "react";
function Iplists({ ipList, getIpList }) {
  const [open, setOpen] = useState(false);
  const [selectedIp, setSelectedIp] = useState({});
  //console.log(ipList);
  return (
    <div>
      <div className="mt-8 overflow-x-auto">
        <table className="w-full text-sm text-left text-gray-500 dark:text-gray-400">
          <thead className="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
            <tr>
              <th scope="col" className="px-6 py-3">
                Sl
              </th>
              <th scope="col" className="px-6 py-3">
                Ip Address
              </th>
              <th scope="col" className="px-6 py-3">
                Label
              </th>
              <th scope="col" className="px-6 py-3">
                Action
              </th>
            </tr>
          </thead>
          <tbody>
            {ipList?.map((ip, index) => {
              return (
                <tr
                  className="bg-white border-b dark:bg-gray-800 dark:border-gray-700"
                  key={ip.id}
                >
                  <th
                    scope="row"
                    className="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white"
                  >
                    {index + 1}
                  </th>
                  <td className="px-6 py-4">{ip.ip_address}</td>
                  <td className="px-6 py-4">{ip.label}</td>
                  <td className="px-6 py-4">
                    {" "}
                    <button
                      type="button"
                      onClick={() => {
                        setSelectedIp(ip);
                        //console.log(ip);
                        setOpen(true);
                        
                      }}
                      className="flex justify-center rounded-md bg-blue-600 px-3 py-1.5 text-sm font-semibold leading-6 text-white shadow-sm hover:bg-indigo-500 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-600"
                    >
                      Edit
                    </button>
                  </td>
                </tr>
              );
            })}
          </tbody>
        </table>
        <Editip open={open} setOpen={setOpen} selectedIp={selectedIp} getIpList={getIpList}/>
      </div>
    </div>
  );
}
export default Iplists;
