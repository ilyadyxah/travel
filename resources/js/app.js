require('./bootstrap');
import React from 'react'
import "../styles/index.css"
import Home from "../js/router/pages/Home";
import About from "../js/router/pages/About";
import Journeys from '../js/router/pages/Journeys';
import Help from '../js/router/pages/Help';
import { createRoot } from 'react-dom/client';
import { BrowserRouter as Router, Route, Routes } from 'react-router-dom';
import { Layout } from '../js/components/Layout';
import { TravelPage } from './router/pages/TravelPage';
import { NotFound } from './router/pages/NotFound';
import Mediacontent from './router/pages/MediaContent';
const container = document.getElementById('root');
const root = createRoot(container);
import { MyMap } from "../js/components/Map"

root.render(
    <React.StrictMode >
        <Router>
            <Routes>
                <Route path="/" element={<Layout />}>
                    <Route index element={<Home />} />
                    <Route path="journeys" element={<Journeys />} />
                    <Route path="journeys/:city:transport" element={<Journeys />} />
                    <Route path="journeys/:id" element={<TravelPage />} />
                    <Route path="about" element={<About />} />
                    <Route path="help" element={<Help />} />
                    <Route path="media" element={<Mediacontent />} />
                    <Route path="map" element={<MyMap />} />
                    <Route path="*" element={<NotFound />} />
                </Route>
            </Routes>
        </Router>
    </React.StrictMode>
);

