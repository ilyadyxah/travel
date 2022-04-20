import React from 'react'
import Finder from './Finder'
import img from '../img/thousand-01.svg'
import { useState } from 'react'

export default function Intro() {
  const [state, setstate] = useState([
    { id: 1, city: 'Vologda', type: 'Bus tour', duration: 48 },
    { id: 2, city: 'N.Novgorod', type: 'Bus tour', duration: 48 },
    { id: 3, city: 'Kiev', type: 'Bus tour', duration: 48 },
    { id: 4, city: 'Murmansk', type: 'Bus tour', duration: 48 },
    {id: 5, city: 'Vologda', type: 'Bus tour', duration: 48 },
]);

  return (
      <div className='intro'>
          <div className='intro__inner'>
            <h1>Исследуй и путешествуй</h1>
        <Finder {...state}/>
          </div>
          <img src={img} alt="img" width="687" height="654" />
          
    </div>
  )
}
