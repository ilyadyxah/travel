import React from 'react';
import { useParams } from 'react-router-dom';
import { useState, useEffect } from 'react';
import Rating from '@mui/material/Rating';
import { styled } from '@mui/material/styles';
import pic from "../../../img/img_travel_03.jpg"
import { Swipe } from '@mui/icons-material';
import { ImageList, ImageListItem } from '@mui/material';



const StyledRating = styled(Rating)({
  '& .MuiRating-iconFilled': {
    color: "#39A9B7",
  },
  '& .MuiRating-iconHover': {
    color: '#3C587F',
  },
});


const TravelPage = () => {
  const { id } = useParams()
  const [travel, settravel] = useState(null);
  useEffect(() => {
    fetch("/api/all").then(res => res.json()).then(res => {
      res.forEach(el => { if (el.place_id == id) { settravel(el) } });
    })
  }, [id]);

  const ref = React.useRef(null);
  const [map, setMap] = React.useState();

  React.useEffect(() => {
    if (ref.current && !map) {
      setMap(new window.google.maps.Map(ref.current, {}));
    }
  }, [ref, map]);





  console.log(travel, id)
  if (travel) {
    return (
      <>
        <div className='travel__head_box'>
          <img className='travel__img' src={travel.main_picture} alt='Image' />
          <div className='travel__head_box-text'>
            <h2 className='travel__head'>{travel.city}</h2>
            <h3 className='travel__head_lower'>{travel.title}</h3>
            <p className='travel__dura'>Путешествие на '{travel.duration}' часов</p>
            <StyledRating
              name="simple-controlled"
              // value={travel.raiting}
              value={4}
              readOnly
            />
            <p className='text_blue'>{travel.description}</p>
          </div>
        </div>
        <div className='travel__photos'>
          <ImageList sx={{ width: 500, height: 450 }}>
            {travel.image.map(img =>
              <ImageListItem sx gap={20}>
                <img src={img} alt="" loading='lazy' />
              </ImageListItem>
            )}
          </ImageList>
        </div>
        <div className='travel__revievs'>
          {travel.comments.map(comment =>
            <p>{comment[0]}: <span>{comment[1]}</span></p>
          )}
        </div>
        <div className='travel__map' >
          Map
        </div>
      </>
    )
  }

}

export { TravelPage };
