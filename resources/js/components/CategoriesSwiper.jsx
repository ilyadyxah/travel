import React from 'react';
import { useState, useEffect } from 'react';
import { Swiper, SwiperSlide } from "swiper/react";
import { Pagination, Navigation } from "swiper";
const CaregoriesSwiper = () => {
    // const [travels, setTravels] = useState(null);
    // useEffect(() => {
    //     fetch('/api/all')
    //         .then(res => res.json())
    //         .then(res => setTravels(res))
    // }, [])
    // console.log(travels)
    return (
        <div>
            <Swiper
                slidesPerView={3}
                spaceBetween={30}
                modules={[Navigation, Pagination]}
                pagination={{
                    clickable: true,
                }}
                className="mySwiper">
                {/* {travels.places.map(travel => <SwiperSlide  >
                    <CardTravelSimple travel={travel} />
                </SwiperSlide>)} */}
            </Swiper>
        </div>
    );
}

export default CaregoriesSwiper;
