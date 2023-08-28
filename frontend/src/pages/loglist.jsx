import React from "react";
import Layout from "../components/layout";
import { useState } from "react";
import { get } from "../api/globalFetch";
import Datalist from "../components/data-list";
import Logtable from "../components/log-table";

function Loglist() {
  const [logList, setLogList] = useState([]);
  async function getLogList() {
    const response = await get("log_histories", { cache: "force-cache" });
    setLogList(response.data);
  }

  return (
    <Layout>
      <Datalist loadData={getLogList}>
        <Logtable logList={logList}/>
      </Datalist>
    </Layout>
  );
}
export default Loglist;
