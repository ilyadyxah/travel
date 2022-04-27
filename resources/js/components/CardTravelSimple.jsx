import * as React from 'react';
import { styled } from '@mui/material/styles';
import CardContent from '@mui/material/CardContent';
import CardActions from '@mui/material/CardActions';
import IconButton from '@mui/material/IconButton';
import Typography from '@mui/material/Typography';
import FavoriteIcon from '@mui/icons-material/Favorite';
import ShareIcon from '@mui/icons-material/Share';
import Rating from '@mui/material/Rating';
import img1 from "../../img/img_travel_01.jpg"

const StyledRating = styled(Rating)({
  '& .MuiRating-iconFilled': {
    color: '1369b9',
  },
  '& .MuiRating-iconHover': {
    color: '#1d54ed',
  },
});

export default function CardTravelSipmle({travels}) {

  // console.log(travels)

  return (
    <section className='card'>
      <img className='card__img' src={img1} alt={travels.city} />
      <h2 className='card__head'>{travels.city}</h2>     
      <Rating
        name="simple-controlled"
        // name="customized-color"
        value={travels.raiting}
        onChange={(event, newValue) => {
          setValue(newValue);
        }}
      />
      
      <CardContent>
        <Typography variant="body2" color="text.secondary">
        Lorem ipsum dolor sit amet consectetur adipisicing elit. Sapiente natus est recusandae laboriosam.
        </Typography>
      </CardContent>
    </section>
  );
}
