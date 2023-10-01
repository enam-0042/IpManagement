import React from "react";
import Navigation from "./navigation";

export default function Layout({ children, getIpList }) {

  return (
    <div className="bg-white">
      <Navigation getIpList={getIpList}/>
  
      {children}
    </div>
  );
}
