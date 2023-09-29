import Iplists from "../components/iplists";
import Layout from "../components/layout";
import { useState } from "react";
import { get } from "../api/globalFetch";
import Datalist from "../components/data-list";
function Home() {
  const [ipList, setIpList] = useState([]);

  async function getIpList() {
    const response = await get("ip_lists");
    setIpList(response.data);
    
  }

  return (
    <Layout>
      <Datalist loadData={getIpList}>
        <Iplists ipList={ipList} />
      </Datalist>
    </Layout>
  );
}

export default Home;
