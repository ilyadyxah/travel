import React from "react";
import CardTravelSimple from './CardTravelSimple'
import { useState, useEffect } from 'react';
import { Swiper, SwiperSlide } from "swiper/react";
import { Pagination, Navigation } from "swiper";
import "swiper/css";
import "swiper/css/pagination"
// import axios from "axios";

const CardsBlock = () => {
    const [travels, setTravels] = useState(null);
    const [page, setPage] = useState(1)

    useEffect(() => {
        fetch('/api/all')
            .then(res => res.json())
            .then(res =>
                setTravels(res))
    }, [])

    if (travels) {
        // console.log(travels)
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
                        {travels.map(travel => <SwiperSlide key={travel.place_id}  ><CardTravelSimple travel={travel} /></SwiperSlide>)}
                    </Swiper>
                </div>
                {/* <div className="slider_btn_container">
                <div className="slider_btn">before</div>
                <div className="slider_btn">after</div>
            </div> */}
            </div>
        )
    }
}

export default CardsBlock;