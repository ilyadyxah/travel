import React from 'react'
import TravelCard from '../../components/TravelCard';
import { useEffect, useState } from 'react';
import { backdropClasses, Grid } from '@mui/material';
import { forEach, forIn } from 'lodash';

// const trBase = (base) => {
//   let result = [];
//   for (const part of base) {
//     part => {
//       for (let i = 0; i < base[part].length; i++)
//         if (base.part[i]) {
//           let item = {
//             place_id: base[part][i].place_id,
//             title: base[part][i].title,
//             main_picture: base[part][i].main_picture,
//             description: base[part][i].description,
//             city: base[part][i].city,
//           }
//           console.log(base.places, item)
//         }
//     }
//     result.push(item)
//   }
// for (let i = 0; i < base.places.length; i++)
//   if (base.places[i]) {
//     let item = {
//       place_id: base.places[i].place_id,
//       title: base.places[i].title,
//       main_picture: base.places[i].main_picture,
//       description: base.places[i].description,
//       city: base.places[i].city,
//     }
//     console.log(base.places, item)
//     result.push(item)
//   }
// return result
// }



export default function Journeys() {
  const [travels, settravels] = useState(null);

  useEffect(() => {
    fetch('/api/all')
      .then(res => res.json())
      .then(res => settravels(res))
  }, []);

  if (travels) {

    return (
      <Grid container spacing={3}>
        {travels.places.map(travel => <Grid item xs={4}>
          <TravelCard travel={travel} key={travel.id} /></Grid>
        )}
      </Grid>
    )
  }
}
