import React from 'react'
import Navigation from './navigation'
export default function Layout({children}) {
  return (
<div className="bg-white">
        <Navigation />
        {children}
      </div>
  )
}
