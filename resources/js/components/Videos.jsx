import React from 'react';
import Grid from '@mui/material/Grid';

const Videos = () => {
    return (
        <div className='videos_block'>
            <div className="videos_text text_block">
                <h2 className='home__header'>Видео</h2>
                <div className='underline_block'></div>
                <p className='text_blue videos__header_text'>Lorem ipsum dolor, sit amet consectetur adipisicing elit. Perferendis similique, maiores dolor praesentium qui quod optio consequatur totam debitis ad odit consequuntur quas soluta, adipisci at ab, assumenda omnis molestiae quisquam quaerat voluptate? Officiis, optio.</p>
            </div>
            <div className='videos_content'>
                <Grid container spacing={2}>
                    <Grid item xs={8}>
                        <div className='videos_content_main'>Окно показа видео</div>
                    </Grid>
                    <Grid item xs={4}>
                        <div className='videos_content_choice'>Окно выбора видео</div>
                    </Grid>
                </Grid>
            </div>
        </div>
    );
}

export default Videos;
