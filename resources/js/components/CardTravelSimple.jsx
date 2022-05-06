import * as React from 'react';
import { styled } from '@mui/material/styles';
import Rating from '@mui/material/Rating';
import { Link } from 'react-router-dom';
import { useState } from 'react';

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
          <img className='card__img' src={travel.main_picture} alt={travel.city} />
          <div className='card__mask'></div>
          {/* <p className='card__price'>{travel.price}</p> */}
          <h2 className='card__head'>{travel.city}, {travel.title}</h2>
        </div>
      </Link>
      <div className='card__bottom'>
        <StyledRating
          name="simple-controlled"
          // value={travel.raiting}
          value={5}
          readOnly
          onChange={(event, newValue) => {
            setValue(newValue);
          }}
        />
        {/* <p className='card__dura'>{travel.duration} часов</p> */}
      </div>

    </section >
  );
}

export default CardTravelSipmle 