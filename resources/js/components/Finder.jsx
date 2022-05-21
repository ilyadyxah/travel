import React from 'react'
import Switcher from './Switcher'
import { useState, useEffect } from 'react';
import SwitcherRange from './SwitcherRange';
import { useSearchParams } from 'react-router-dom';
import { useNavigate } from 'react-router-dom';

export default function Finder() {
  const [findTransport, setFindTransport] = useState([]);
  const [findCity, setFindCity] = useState({ 0: 'City' });
  const [searchParams, setSearchParams] = useSearchParams()
  const navigate = useNavigate()
  // const [findReqwest, setFindReqwest] = useState(null);


  const checkFunc = (data, word) => {
    if (data && data != word) {
      return data
    } else return null

  }

  // Создаём объект из значений полей формы и передаём в URL
  const handlefindReqwest = (e) => {
    e.preventDefault()
    let value = {
      // city: e.target[0].value,
      city: checkFunc(e.target[0].value, 'Город'),
      transport: checkFunc(e.target[1].value, 'Транспорт'),
      // transport: e.target[1].value,
      // complexity: e.target[2].value,
      complexity: checkFunc(e.target[2].value, 'Сложность'),
      // minCost: checkFunc(e.target[3].value ),
      minCost: e.target[3].value,
      maxCost: e.target[4].value,
      minDistance: e.target[5].value,
      maxDistance: e.target[6].value,
    }
    // let city = value.city
    // let transports = value.transports
    // let minCost = value.minCost
    // let maxCost = value.maxCost
    // let difficultyMin = value.difficultyMin
    // let difficultyMax = value.difficultyMax
    // let distanceMin = value.distanceMin
    // let distanceMax = value.distanceMax
    // setSearchParams({ city, transports, minCost, maxCost, difficultyMin, difficultyMax, distanceMin, distanceMax })
    // navigate('/journeys')
    setSearchParams(value)
  }



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
      <form onSubmit={handlefindReqwest} className='finder__form'>
        <h3>Поиск путешествия</h3>
        <div className='finder__form_box'>
          <div className="finder__form_box_inner_switch">
            <Switcher prop={findCity} typeOfSelect="Город" />
            <Switcher prop={findTransport} typeOfSelect="Транспорт" />
            <Switcher prop={['1', '5', '10', '15', '20', '25', '30', '35', '40', '45', '50']} typeOfSelect="Сложность" />
          </div>
          <div className="finder__form_box_inner">
            <SwitcherRange range={{ min: 1, max: 100000 }} name="Цена" />
            {/* <SwitcherRange range={{ min: 1, max: 10 }} name="Сложность" /> */}
            <SwitcherRange range={{ min: 1, max: 1000 }} name="Протяжённость" />
          </div>
        </div>

        <p><input className='btn finder_btn' type="submit" value="Найти путешествие" /></p>
      </form>
    </div>
  )
}
