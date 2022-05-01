import React from 'react';
import { useParams } from 'react-router-dom';
import { useState, useEffect } from 'react';
import Rating from '@mui/material/Rating';
import { styled } from '@mui/material/styles';
import pic from "../../../img/img_travel_03.jpg"

const StyledRating = styled(Rating)({
  '& .MuiRating-iconFilled': {
    color: "#39A9B7",
  },
  '& .MuiRating-iconHover': {
    color: '#3C587F',
  },
});



const TravelPage = ({ travels }) => {
  const { id } = useParams()
  const [travel, setTravel] = useState({ id: 1, city: 'Vologda', type: 'Bus tour', duration: 8, dateNextTtavel: "1 августа 2022", raiting: 1.5, price: "300$", imgSrc: ` ${pic}` });

  // const useEffect(() => {
  //     fetch(`/&{id}`)
  //          .then(res => res.json())
  //          .then(data => setTravel(data))
  // }, [id]);



  return (
    <>
      <div className='travel__head_box'>
        <img className='travel__img' src={travel.imgSrc} alt='Image' />
        <div className='travel__head_box-text'>
          <h2 className='travel__head'>Place</h2>
          <h3 className='travel__head_lower'>Название тура/маршрута</h3>
          <p className='travel__dura'>Путешествие на {travel.duration} часов</p>
          <StyledRating
            name="simple-controlled"
            value={travel.raiting}
            readOnly
          />
          <p className='text_blue'>Lorem ipsum dolor sit amet consectetur adipisicing elit. Sed odio voluptate nobis ea illo maiores? Ratione rerum consequatur quibusdam nihil assumenda voluptas vitae itaque laboriosam placeat commodi, maiores quidem, nemo quae recusandae quis porro impedit.</p>
        </div>
      </div>
      <div className='travel__photos'>
        Photos
      </div>
      <div className='travel__revievs'>
        Отзывы
      </div>
      <div className='travel__map'>
        Карта
      </div>
    </>
  );
}

export { TravelPage };
