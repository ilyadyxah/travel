import React from 'react'
import Switcher from './Switcher'
import { useState } from 'react';

export default function Finder(props) {
const [findOption, setFindOption] = useState(props);
 console.log(props)
  return (
      <div className='finder'>
          <form>
              <h3>Поиск путешествия</h3>
              <div className='finder__switchers'>
                <Switcher props={findOption} />
                <Switcher />
                <Switcher />
                <Switcher />
              </div>
           
            <p><input className='btn finder_btn' type="submit" value="Найти путешествие"/></p>
          </form>
    </div>
  )
}
