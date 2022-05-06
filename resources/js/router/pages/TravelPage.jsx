import React from 'react';
import { useParams } from 'react-router-dom';
import { useState, useEffect } from 'react';
import Rating from '@mui/material/Rating';
import { styled } from '@mui/material/styles';
import { Box, ImageList, ImageListItem } from '@mui/material';
import Rewiewcard from '../../components/RewiewCard';
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

const renderRewiews = (travel) => {
  if (travel.comments)
    return (travel.comments.map(comment => <Rewiewcard comment={comment} ></Rewiewcard>))
  else return <p>No comment yet(</p>
};

const TravelPage = () => {
  const { id } = useParams()
  const [travel, settravel] = useState(null);
  const [likes, setlikes] = useState(null);

  useEffect(() => {
    fetch("/api/all").then(res => res.json()).then(res => {
      res.forEach(el => { if (el.place_id == id) { settravel(el); setlikes(el.likes || null) } });
    })
  }, [id]);

  const addLike = () => {
    let liked = likes + 1;
    setlikes(liked)
  }

  // console.log(travel)
  if (travel) {
    return (
      <>
        <div className='travel__head_box'>
          <img className='travel__img' src={travel.main_picture} alt='Image' />
          <div className='travel__head_box-text'>
            <h2 className='travel__head'>{travel.city}</h2>
            <h3 className='travel__head_lower'>{travel.title}</h3>
            <p className='travel__dura'>Путешествие на '{travel.duration}' часов</p>

            <IconButton aria-label="add to favorites" onClick={addLike}>
              <p>{likes}</p>
              <FavoriteIcon />
            </IconButton>
            <p className='travel__head-text'>{travel.description}</p>
          </div>
        </div>
        <div className='travel__overview'>
          <div className='travel__photos'>
            <Box sm={{ width: 550 }}>
              <ImageList sx={{ width: 500 }}>
                {travel.image.map(img =>
                  <ImageListItem sx={{ maxWidth: 450 }} gap={20} key={img}>
                    <img src={img} alt="" loading='lazy' />
                  </ImageListItem>
                )}
              </ImageList>
            </Box>
          </div>
          <div className='travel__revievs'>
            {renderRewiews(travel)}
          </div>
        </div>

        <div className='travel__map' >
          Map
        </div>
      </>
    )
  }

}

export { TravelPage };
