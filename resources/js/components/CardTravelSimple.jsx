import * as React from 'react';
import { styled } from '@mui/material/styles';
import Rating from '@mui/material/Rating';
import { Link } from 'react-router-dom';
import { useState } from 'react';
import { IconButton } from '@mui/material';
import FavoriteIcon from '@mui/icons-material/Favorite';

const StyledRating = styled(Rating)({
  '& .MuiRating-iconFilled': {
    color: "#39A9B7",
  },
  '& .MuiRating-iconHover': {
    color: '#3C587F',
  },
});

function CardTravelSipmle({ travel }) {
  const [likes, setlikes] = useState(travel.likes);
  const addLike = () => {
    let liked = likes + 1;
    setlikes(liked)
  }
  // console.log(travel)
  return (
    <section className='card' >
      <Link to={`journeys/${travel.place_id}`} key={travel.place_id} >
        <div className='card__img_container'>
          <img className='card__img' src={travel.main_picture} alt={travel.city} />
          <div className='card__mask'></div>

          <h2 className='card__head'>{travel.city}, {travel.title}</h2>
        </div>
      </Link>
      <p className='card__like'><IconButton aria-label="add to favorites" onClick={addLike}>
        <p>{likes}</p>
        <FavoriteIcon />
      </IconButton></p>
      {/* <div className='card__bottom'>
      </div> */}
    </section >
  );
}

export default CardTravelSipmle 