import React from 'react';
import { IconButton } from '@mui/material';
import FavoriteIcon from '@mui/icons-material/Favorite';
import { useState } from 'react';

const LikeBtn = ({ travel }) => {
    const [likes, setLikes] = useState(travel.likes);
    const [liked, setLiked] = useState(false);
    const addLike = () => {
        if (liked == false) {
            if (likes) {
                let like = likes + 1;
                fetch(`/api/like/${travel.place_id}`)
                setLikes(like)
                setLiked(true)
            } else {
                fetch(`/api/like/${travel.place_id}`)
                setLikes(1)
                setLiked(true)
            }
        } else {
            let like = likes - 1;
            fetch(`api/dislike/${travel.place_id}`)
            setLikes(like)
            setLiked(false)
        }
    }
    return (

        <IconButton aria-label="add to favorites" onClick={addLike}>
            <p>{likes}</p>
            <FavoriteIcon />
        </IconButton>
    );
}

export default LikeBtn;
