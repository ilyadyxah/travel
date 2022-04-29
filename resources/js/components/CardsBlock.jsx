import React from "react";
import CardTravelSimple from '../components/CardTravelSimple'
import { useState, useEffect } from 'react';
import { Swiper, SwiperSlide } from "swiper/react";
import { Pagination, Navigation } from "swiper";
import "swiper/css";
import "swiper/css/pagination"
import axios from "axios";

const CardsBlock = () => {
    const [travels, setTravels] = useState([]);
    const [page, setPage] = useState(1)
    
  useEffect(() => {
        setTravels([{ id:1, city: 'Park', type: 'Bus tour', duration: 8, dateNextTtavel: "1 августа 2022", raiting: 1.5, price:"300$", imgSrc:"../../img/img_travel_01.jpg" },
          { id: 2, city: 'Forests', type: 'Bus tour', duration: 48, dateNextTtavel: "1 августа 2022", raiting: 4, price:"30$", imgSrc:"../../img/img_travel_01.jpg"},
        { id: 3, city: 'Mountains', type: 'Backpack tour', duration: 4, dateNextTtavel: "1 июля 2022", raiting: 3, price:"320$", imgSrc:"../../img/img_travel_01.jpg" },
        { id: 4, city: 'Lake', type: 'Canoe tour', duration: 5, dateNextTtavel: "18 июня 2022", raiting: 4, price:"33.99$", imgSrc:"../../img/img_travel_01.jpg" },
        { id: 5, city: 'Caves', type: 'Bike tour', duration: 24, dateNextTtavel: "30 мая 2022", raiting: 4.5, price:"100$", imgSrc:"../../img/img_travel_01.jpg" }]);
    },[])
  

    useEffect(() => {
     axios.get("/api/test")
        // fetch(`/api/test`)
            //  .then(res => res.json())
            .then(res => {
                // setTravels(data);
            console.log(res.data)})
    },  );
   
    
    return (
        <div className="slider">
            <div className="slider_container">
                <Swiper
                    slidesPerView={3}
                    spaceBetween={30}
                    modules={[Navigation, Pagination]}
                    pagination={{
                    clickable: true,
                    }}
                    className="mySwiper">
                    {travels.map(travel => <SwiperSlide  key={travel.id} ><CardTravelSimple travel={travel}/></SwiperSlide>)}
                </Swiper>   
            </div>
            {/* <div className="slider_btn_container">
                <div className="slider_btn">before</div>
                <div className="slider_btn">after</div>
            </div> */}
        </div>
    )
}

export default CardsBlock;