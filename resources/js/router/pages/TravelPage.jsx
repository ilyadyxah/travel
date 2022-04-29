import React from 'react';
import { useParams } from 'react-router-dom';
import { useState, useEffect } from 'react';
import Rating from '@mui/material/Rating';
import { styled } from '@mui/material/styles';


const StyledRating = styled(Rating)({
  '& .MuiRating-iconFilled': {
    color: "#39A9B7",
  },
  '& .MuiRating-iconHover': {
    color: '#3C587F',
  },
});



const TravelPage = ({travels}) => {
    const { id } = useParams()
    const [travel, setTravel] = useState({ id:1, city: 'Vologda', type: 'Bus tour', duration: 8, dateNextTtavel: "1 августа 2022", raiting: 1.5, price:"300$", imgSrc:"../../img/img_travel_01.jpg"});

    // const useEffect(() => {
    //     fetch(`/&{id}`)
    //          .then(res => res.json())
    //          .then(data => setTravel(data))
    // }, [id]);



    return (
        <>
        <div className='travel__img_container'>
            <img className='travel__img' src='' alt={travel.city} />
            <div className='travel__mask'></div>
            <p className='travel__price'>{travel.price }</p>
            <h2 className='travel__head'>{travel.city}</h2>
        </div>
            
        <div className='travel__bottom'>
            <StyledRating
            name="simple-controlled"
                value={travel.raiting}
                readOnly 
            />
          <p className='travel__dura'>{travel.duration } часов</p>
        </div>
        </>
    );
}

export {TravelPage};
