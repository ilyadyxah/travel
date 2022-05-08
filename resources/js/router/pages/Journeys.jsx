import React from 'react'
import TravelCard from '../../components/TravelCard';
import { useEffect, useState } from 'react';
import { backdropClasses, Grid } from '@mui/material';
import { forEach, forIn } from 'lodash';


export default function Journeys() {
  const [travels, settravels] = useState(null);

  useEffect(() => {
    fetch('/api/all')
      .then(res => res.json())
      .then(res => settravels(res))
  }, []);

  if (travels) {
    return (
      <Grid container spacing={3} >
        {travels.map(travel => <Grid item xs={4} key={travel.place_id}>
          <TravelCard travel={travel} /></Grid>
        )}
      </Grid>
    )
  }
}
