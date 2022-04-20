import React from 'react'

export default function Navbar() {
  return (
      <nav className='navbar'>
          <img src="" alt="Logo" />
          <div className='navbar__inner'>
            <button className='nav_link'>Home</button>
            <button className='nav_link'>Destinations</button>
            <button className='nav_link'>About</button>
            <button className='nav_link'>Partner</button>
            <button className='nav_link btn'>Login</button>
            <button className='nav_link btn'>Register</button>
          </div>
    </nav>
  )
}
