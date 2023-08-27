import Iplists from "../components/iplists";
import Layout from "../components/layout";
import { useAuth } from "../hooks/useAuth";
import { useEffect, useState } from "react";
import { get } from "../api/globalFetch";
import Datalist from "../components/data-list";
function Home() {
  const [ipList, setIpList] = useState([]);

  const { user } = useAuth();
  //console.log(user);
  async function getIpList() {
    const response = await get("ip_lists");
    setIpList(response.data);
    //   const response = await fetch("http://localhost/api/ip_lists", {
    //     headers: {
    //       "Content-Type": "application/json",
    //       Authorization: "Bearer " + user.token,
    //       // 'Content-Type': 'application/x-www-form-urlencoded',
    //     },
    //   });
    //   const responseData = await response.json();
    //   setIpList(responseData.data);
    //  // console.log(ipList);
    //
  }

  // useEffect(() => {
  //   getIpList();
  // }, []);
  return (
    <Layout>
     <Datalist loadData={getIpList}>
       <Iplists ipList={ipList} />
      </Datalist>

     
    </Layout>
  );
}

export default Home;
