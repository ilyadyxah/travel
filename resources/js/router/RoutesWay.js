import React from 'react'
import { BrowserRouter as Router,
  Routes,
  Route,
  Link } from "react-router-dom";
import Home from "./pages/Home";
import About from "./pages/About";
import Journeys from './pages/Journeys';
import Help from './pages/Help';

export default function RoutesWay() {
  return (
    <div>
      <Router>
        <nav className="navbar">
          <img src="" alt="Logo" />
            <ul className='navbar__inner'>
                <li >
                    <Link to="/home" className='nav_link' >Домой</Link>
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
        
        <Routes path="/home">
          <Route path="/home" element={<Home />} />
        </Routes>
        <Routes>
          <Route path="/journeys" element={<Journeys />} />
        </Routes>
        <Routes path="/about">
           <Route path="/about" element = {<About/>} />
        </Routes>
        <Routes path="/help">
           <Route path="/help" element = {<Help/>} />
        </Routes>
      </Router>
      
    </div>
  )
}
