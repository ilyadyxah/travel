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
import { Pagination, Navigation } from "swiper";
import { useParams } from 'react-router-dom';
import { useEffect } from 'react';
import { Link } from 'react-router-dom';

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

  const handleExpandClick = () => {
    setExpanded(!expanded);
  };
  // console.log(travel)
  return (
    <Paper elevation={3} background="#6495ed">
      <Link to={`${travel.place_id}`} key={travel.place_id} travel={travel}>
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
      </Link>
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
          <Swiper
            slidesPerView={3}
            spaceBetween={30}
            modules={[Navigation, Pagination]}
            pagination={{
              clickable: true,
            }}>
            {travel.image.map(img =>
              <SwiperSlide>
                <img src={img} alt='Image' />
              </SwiperSlide>
            )}
          </Swiper>
        </CardContent>
      </Collapse>
    </Paper >
  )
}