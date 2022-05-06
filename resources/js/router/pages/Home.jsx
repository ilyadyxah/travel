import React from 'react'
import CardsBlock from '../../components/CardsBlock'
import Intro from '../../components/Intro'
import Button_simple from '../../components/Button_simple'
import Videos from '../../components/Videos'
import TravelCategories from '../../components/Travel_categories'

export default function Home() {

  return (
    <>
      <Intro />
      <div className='home__cards'>
        <CardsBlock />
        <div className='home__cards_text'>
          <h2 className='home__header'>Удивительные места для новых эмоций от путешествий</h2>
          <div className='underline_block'></div>
          <p className='text_blue' >Lorem ipsum, dolor sit amet consectetur adipisicing elit. Eveniet esse illo deserunt veniam libero ipsam, rem ex iste! Distinctio libero incidunt autem.</p>
          <Button_simple btn_name="Узнать больше" />
        </div>

      </div>
      <Videos />
      <TravelCategories />
    </>
  )
}
