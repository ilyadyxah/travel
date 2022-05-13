import React from 'react'
import TravelCard from '../../components/TravelCard';
import { useEffect, useState } from 'react';
import { Grid } from '@mui/material';
import Pagination from '@mui/material/Pagination';
import Stack from '@mui/material/Stack';
import Finder from '../../components/Finder';

export default function Journeys() {
  const [page, setPage] = useState(1);
  const [travels, setTravels] = useState(null);
  const [initFind, setInitFind] = useState(false);

  const [findReqwest, setFindReqwest] = useState(null);

  const handleChange = (event, value) => {
    setPage(value);
  };

  const handlefindReqwest = (e) => {
    e.preventDefault()
    console.log("onfindReqwest in journeys")
    let value = {
      city: e.target[0].value,
      transport: e.target[1].value,
      minCost: e.target[2].value,
      maxCost: e.target[3].value,
      difficultyMin: e.target[4].value,
      difficultyMax: e.target[5].value,
      distanceMin: e.target[6].value,
      distanceMax: e.target[7].value,
    }
    setFindReqwest(value)
    let init = !initFind;
    setInitFind(init)
    // console.log("onfindReqwest in journeys", value)
  }


  useEffect(() => {
    findReqwest ?
      fetch(`/api/journeys/${page}?city=${findReqwest.city}
        &transports=${findReqwest.transport}`)
        // // & minCost=${findReqwest.minCost}
        // // & maxCost=${findReqwest.maxCost}
        // // & difficultyMin=${findReqwest.difficultyMin}
        // // & difficultyMax=${findReqwest.difficultyMax}
        // // & distanseMin=${findReqwest.distanceMin}
        // // & distanceMax${findReqwest.distanceMax}
        // `)
        .then(res => res.json())
        .then(res => {
          setTravels(res)
        })
      :
      fetch(`/api/journeys/${page}`)
        .then(res => res.json())
        .then(res => {
          setTravels(res)
        })
  }, [initFind, page])

  return (
    <>
      <Finder onfindReqwest={handlefindReqwest} />

      <Grid container spacing={3} >
        {travels == null
          ?
          <Grid item xs={8} ><h3>Путушествия не найдены </h3></Grid>

          // console.log(travels)
          :
          travels.message ?
            <div>{travels.message} </div> :
            travels.map(travel => <Grid item xs={4} key={travel.place_id}>
              <TravelCard travel={travel} /></Grid>
            )}
      </Grid>
      <Stack spacing={3} sx={{ '& .MuiPagination-ul': { justifyContent: 'center', alignContent: 'center' }, '& .MuiButtonBase-root-MuiPaginationItem-root': { fontSize: '25px' } }}>
        <Pagination count={10} size="large" page={page} onChange={handleChange} />
      </Stack>
    </>
  )
}

