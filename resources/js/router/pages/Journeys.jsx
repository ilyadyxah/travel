import React from 'react'
import TravelCard from '../../components/TravelCard';
import { useEffect, useState } from 'react';
import { Grid } from '@mui/material';
import Pagination from '@mui/material/Pagination';
import Stack from '@mui/material/Stack';
import Switcher from '../../components/Switcher'
import { breakpoints } from '@mui/system';
import SwitcherRange from '../../components/SwitcherRange'

export default function Journeys() {
  const [page, setPage] = useState(1);
  const [travels, setTravels] = useState(null);
  const [initFind, setInitFind] = useState(false);
  const [findTransport, setFindTransport] = useState([]);
  const [findCity, setFindCity] = useState([]);
  const [findReqwest, setFindReqwest] = useState(null);

  const handleChange = (event, value) => {
    setPage(value);
  };

  const handleFind = (event) => {
    event.preventDefault()
    let value = {
      city: event.target[0].value,
      transport: event.target[1].value,
      minCost: event.target[2].value,
      maxCost: event.target[3].value,
      difficultyMin: event.target[4].value,
      difficultyMax: event.target[5].value,
      distanceMin: event.target[6].value,
      distanceMax: event.target[7].value,
    }
    setFindReqwest(value)
    let init = !initFind
    setInitFind(init)
    console.log(value)
  }

  useEffect(() => {
    fetch('/api/filters/cities')
      .then(res => res.json())
      .then(res => setFindCity(res))
  }, []);

  useEffect(() => {
    fetch('/api/filters/transports')
      .then(res => res.json())
      .then(res => setFindTransport(res))
  }, []);

  // console.log(findTransport, findCity)

  // useEffect(() => {
  //   fetch(`/api/journeys/${page}`)
  //     .then(res => res.json())
  //     .then(res => {
  //       setTravels(res);
  //       // console.log(res)
  //     })
  // }, [page]);

  useEffect(() => {
    findReqwest ?
      fetch(`api/journeys/${page}?city=${findReqwest.city}
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
          // console.log(1, res)
          setTravels(res)
        })
      :
      fetch(`/api/journeys/${page}`)
        .then(res => res.json())
        .then(res => {
          // console.log(2, res)
          setTravels(res)
        })
  }, [initFind, page])




  if (travels) {

    return (
      <>
        <form onSubmit={handleFind} >
          <h3>Поиск путешествия</h3>
          <div className='finder__switchers'>
            <Switcher prop={findCity} typeOfSelect="Город" />
            <Switcher prop={findTransport} typeOfSelect="Транспорт" />
            <SwitcherRange range={{ min: 1, max: 100000 }} name="Цена" />
            <SwitcherRange range={{ min: 1, max: 10 }} name="Сложность" />
            <SwitcherRange range={{ min: 1, max: 1000 }} name="Протяжённость" />
          </div>

          <p><input className='btn finder_btn' type="submit" value="Найти путешествие" /></p>
        </form>
        <Grid container spacing={3} >
          {travels == null
            ?
            <Grid item xs={4} >Путушествия не найдены</Grid>

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
}

