import React from 'react'
import Finder from './Finder'
import img from '../../img/thousand-01.png'
import { useNavigate } from 'react-router-dom';
import { useState } from 'react';

export default function Intro() {
  const navigate = useNavigate()

  const handlefindReqwest = (e) => {
    e.preventDefault()
    let value = {
      city: e.target[0].value,
      transport: e.target[1].value,
      minCost: e.target[2].value,
      maxCost: e.target[3].value,
      difficultyMin: e.target[4].value,
      difficultyMax: e.target[5].value,
      distanceMin: e.target[6].value,
      distanceMax: e.target[7].value,
    }
    navigate(`/journeys/1?city=${value.city}
      & transports=${value.transport}`);
  }

  return (
    <div className='intro'>
      <div className='intro__inner'>
        <h1>Исследуй и путешествуй</h1>
        <Finder onfindReqwest={handlefindReqwest} />
      </div>
      <div className='intro_img_box'>
        <img className='intro_img' src={img} alt="img" />
      </div>
    </div>
  )
}
