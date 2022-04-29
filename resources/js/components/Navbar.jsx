import React from 'react'
import { Link } from 'react-router-dom'
import logo from "../../img/logo.png"

export default function Navbar() {
  return (
     <nav className="navbar">
          <img src={logo} alt="Logo" />
            <ul className='navbar__inner'>
                <li >
                    <Link to="/" className='nav_link' >Домой</Link>
                </li>
                <li >
                    <Link to="/journeys" className='nav_link' >Путешествия</Link>
                </li>
                <li>
                    <Link to="/about" className='nav_link'>О нас</Link>
                </li>
                <li>
                    <Link to="/help" className='nav_link'>Нужна помощь?</Link>
                </li>
                <li>
                  <button className='nav_link btn'>Login</button>
                </li>
                <li><button className='nav_link btn'>Register</button></li>
            </ul>
        </nav>
  )
}
