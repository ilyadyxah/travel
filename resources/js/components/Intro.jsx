import React from 'react'
import Finder from './Finder'
import img from '../../img/thousand-01.png'

export default function Intro() {

  return (
    <div className='intro'>
      <div className='intro__inner'>
        <h1>Исследуй и путешествуй</h1>
        <Finder />
      </div>
      <div className='intro_img_box'>
        <img className='intro_img' src={img} alt="img" />
      </div>
    </div>
  )
}
