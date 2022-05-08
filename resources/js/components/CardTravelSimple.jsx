import * as React from 'react';
import { styled } from '@mui/material/styles';
import Rating from '@mui/material/Rating';
import { Link } from 'react-router-dom';
import { useState } from 'react';
import LikeBtn from './LikeBtn';

const StyledRating = styled(Rating)({
  '& .MuiRating-iconFilled': {
    color: "#39A9B7",
  },
  '& .MuiRating-iconHover': {
    color: '#3C587F',
  },
});

function CardTravelSipmle({ travel }) {


  // console.log(travel)
  return (
    <section className='card' >
      <Link to={`journeys/${travel.place_id}`} key={travel.place_id} >
        <div className='card__img_container'>
          <div className='card__img_box'>
            <img className='card__img' src={travel.main_picture} alt={travel.city} />
            <div className='card__mask'></div>
          </div>
          <h2 className='card__head'>{travel.city}, {travel.title}</h2>
        </div>
      </Link>
      <p className='card__like'>
        <LikeBtn travel={travel} />
      </p>
      {/* <div className='card__bottom'>
      </div> */}
    </section >
  );
}

export default CardTravelSipmle 