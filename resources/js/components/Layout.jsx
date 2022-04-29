import React from 'react';
import { Outlet } from 'react-router-dom';
import NavBar from "../components/Navbar"

const Layout = () => {
    return (
        <>
            <header className="App-header">
                <NavBar />
            </header>
            <main className='container'>
                <Outlet />  
            </main>
            <footer className='footer'>
                2022 г.
            </footer>
        </>
    );
}

export {Layout};
