import React from 'react'
import Switcher from './Switcher'
import { useState, useEffect } from 'react';
import SwitcherRange from './SwitcherRange';

export default function Finder({ onfindReqwest }) {
  const [findTransport, setFindTransport] = useState([]);
  const [findCity, setFindCity] = useState({ 0: 'City' });

  useEffect(() => {
    fetch('/api/filters/cities')
      .then(res => res.json())
      .then(res => {
        setFindCity(res)
        // console.log(res)
      })
  }, []);

  useEffect(() => {
    fetch('/api/filters/transports')
      .then(res => res.json())
      .then(res => setFindTransport(res))
  }, []);

  return (
    <div className='finder'>
      <form onSubmit={onfindReqwest} className='finder__form'>
        <h3>Поиск путешествия</h3>
        <div className='finder__form_box'>
          <div className="finder__form_box_inner_switch">
            <Switcher prop={findCity} typeOfSelect="Город" />
            <Switcher prop={findTransport} typeOfSelect="Транспорт" />
          </div>
          <div className="finder__form_box_inner">
            <SwitcherRange range={{ min: 1, max: 100000 }} name="Цена" />
            <SwitcherRange range={{ min: 1, max: 10 }} name="Сложность" />
            <SwitcherRange range={{ min: 1, max: 1000 }} name="Протяжённость" />
          </div>
        </div>

        <p><input className='btn finder_btn' type="submit" value="Найти путешествие" /></p>
      </form>
    </div>
  )
}
