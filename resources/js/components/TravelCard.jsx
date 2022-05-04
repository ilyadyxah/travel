// import { ExpandMore } from '@mui/icons-material';
import { Paper, CardActions, CardContent, CardHeader, CardMedia, Collapse, IconButton, Typography } from '@mui/material';
import { styled } from '@mui/material/styles';
import React from 'react'
import { useState } from 'react';
import MoreVertIcon from '@mui/icons-material/MoreVert';
import FavoriteIcon from '@mui/icons-material/Favorite';
import ShareIcon from '@mui/icons-material/Share';
import ExpandMoreIcon from '@mui/icons-material/ExpandMore';
import Rating from '@mui/material/Rating';
import { Swiper, SwiperSlide } from "swiper/react";
import { useParams } from 'react-router-dom';
import { useEffect } from 'react';

const ExpandMore = styled((props) => {
  const { expand, ...other } = props;
  return <IconButton {...other} />;
})(({ theme, expand }) => ({
  transform: !expand ? 'rotate(0deg)' : 'rotate(180deg)',
  marginLeft: 'auto',
  transition: theme.transitions.create('transform', {
    duration: theme.transitions.duration.shortest,
  }),
}));

const StyledRating = styled(Rating)({
  '& .MuiRating-iconFilled': {
    color: "#39A9B7",
  },
  '& .MuiRating-iconHover': {
    color: '#3C587F',
  },
});



export default function TravelCard({ travel }) {
  const [expanded, setExpanded] = useState(false);
  const [images, setimages] = useState(null);

  // console.log(travel)
  // if (travel) {
  // useEffect(() => {
  //   fetch('/api/all')
  //     .then(res => res.json())
  //     .then(res => {
  //       // console.log(res)
  //       res.pictures.forEach(pic => {
  //         let img = [];
  //         if (pic.place_id == travel.place_id) {
  //           img.push(pic)
  //         }
  //         setimages(img)
  //       });
  //     })
  // }, [expanded]);
  // console.log(images)
  // }


  // const leyer = (images) => {
  //   if (images) {
  //     console.log(images)
  //     return <SwiperSlide><img src={images.image} alt="foto" /></SwiperSlide>
  //   }
  // }




  const handleExpandClick = () => {
    setExpanded(!expanded);
  };

  return (
    <Paper elevation={3} background="#6495ed">
      <CardHeader

        action={
          <IconButton aria-label="settings">
            <MoreVertIcon />
          </IconButton>
        }
        title={travel.title}
        subheader={travel.city}
      />
      <CardMedia
        component="img"
        height="194"
        image={travel.main_picture}
        alt="Picture"
      />
      <StyledRating
        name="simple-controlled"
        // value={travel.raiting}
        value={5}
        readOnly
        onChange={(event, newValue) => {
          setValue(newValue);
        }}
      />
      <CardActions disableSpacing>
        <IconButton aria-label="add to favorites">
          <FavoriteIcon />
        </IconButton>
        <IconButton aria-label="share">
          <ShareIcon />
        </IconButton>
        <ExpandMore
          expand={expanded}
          onClick={handleExpandClick}
          aria-expanded={expanded}
          aria-label="show more"
        >
          <ExpandMoreIcon />
        </ExpandMore>
      </CardActions>
      <Collapse in={expanded} timeout="auto" unmountOnExit>
        <CardContent>
          <Typography paragraph>{travel.description}</Typography>
        </CardContent>
        <CardContent>
          <Swiper >
            {/* {leyer({ images })} */}
          </Swiper>
        </CardContent>
      </Collapse>
    </Paper>
  )
}