require('./bootstrap');

import React from 'react'
import RoutesWay from "./router/RoutesWay"
import "../css/index.css"

import { createRoot } from 'react-dom/client';
const container = document.getElementById('root');
const root = createRoot(container);
root.render(
    <React.StrictMode >
         <div className="App">
             <header className="App-header">
                <RoutesWay/>
             </header>
         </div>
    </React.StrictMode>
);

