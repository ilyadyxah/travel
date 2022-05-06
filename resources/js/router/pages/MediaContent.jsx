import React from 'react';
import ImageList from '@mui/material/ImageList';
import ImageListItem from '@mui/material/ImageListItem';
import ImageListItemBar from '@mui/material/ImageListItemBar';
import { useState, useEffect } from 'react';
import { Paper } from '@mui/material';

const Mediacontent = () => {
    const [travels, settravels] = useState([]);
    useEffect(() => {
        fetch('/api/all').then(res => res.json()).then(res => settravels(res))
    }, []);


    if (travels[0]?.image) {
        // console.log(travels[0])
        return (
            <ImageList gap={20}>
                {travels.map(travel =>
                    travel.image.map(item =>
                        <Paper elevation={3} background="#6495ed" margin={10} key={item}>
                            <ImageListItem >
                                <img
                                    src={`${item}?w=248&fit=crop&auto=format`}
                                    srcSet={`${item}?w=248&fit=crop&auto=format&dpr=2 2x`}
                                    alt='{item.title}'
                                    loading="lazy"
                                />
                                <ImageListItemBar
                                    title={travel.title}
                                    subtitle={<span>{travel.city}</span>}
                                    position="below"
                                />
                            </ImageListItem>
                        </Paper>
                    ))}

            </ImageList>
            // <ImageList >
            //     {travels.forEach(travel =>
            //         travel.image.map(item =>
            //             <ImageListItem key={travel.place_id}>
            //                 <Paper elevation={3} background="#6495ed" margin={10}>
            //                     <img
            //                         src={`${item}?w=248&fit=crop&auto=format`}
            //                         // srcSet={`${item.img}?w=248&fit=crop&auto=format&dpr=2 2x`}
            //                         // alt={item.title}
            //                         loading="lazy"
            //                     />
            //                     <ImageListItemBar
            //                         title={travel.title}
            //                         subtitle={travel.city} //{<span>by: {item.author}</span>}
            //                         position="below"
            //                     />
            //                 </Paper>
            //             </ImageListItem>
            //         )
            //     )
            //     }
            // </ImageList >
        );
    }
}

export default Mediacontent;
