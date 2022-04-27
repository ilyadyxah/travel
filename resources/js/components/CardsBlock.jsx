import React from "react";
import CardTravelSimple from '../components/CardTravelSimple'
import Grid from '@mui/material/Grid';
import { useState, useEffect } from 'react';


const CardsBlock = () => {
       const [travels, setTravels] = useState([]);
  
  useEffect(() => {
     
        setTravels([{ id:1, city: 'Vologda', type: 'Bus tour', duration: 48 },
          { id: 2, city: 'N.Novgorod', type: 'Bus tour', duration: 48, dateNextTtavel: "1 августа 2022", imgSrc:"img_travel_01", raiting: 4},
        { id: 3, city: 'Kiev', type: 'Bus tour', duration: 48, dateNextTtavel: "1 июля 2022" },
        { id: 4, city: 'Murmansk', type: 'Bus tour', duration: 48, dateNextTtavel: "18 июня 2022" },
        { id: 5, city: 'Vologda', type: 'Bus tour', duration: 48, dateNextTtavel: "30 мая 2022" }]);
    },[])
  
    return (
        <Grid container spacing={3}>

            {travels.map(travel => <Grid item sm={6} md={4} ><CardTravelSimple travels={travel} /></Grid>
                
                 )}
        </Grid>
    )
}

export default CardsBlock;