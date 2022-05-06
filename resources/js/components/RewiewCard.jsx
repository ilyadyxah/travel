import React from 'react';
import Card from '@mui/material/Card';
import CardContent from '@mui/material/CardContent';
import CardMedia from '@mui/material/CardMedia';
import Typography from '@mui/material/Typography';
import { Button, CardActionArea, CardActions } from '@mui/material';
import { Paper } from '@mui/material';

const Rewiewcard = ({ comment }) => {
    return (
        <Card sx={{ maxWidth: 345, margin: 5 }}>
            <Paper elevation={5}>
                <CardActionArea>
                    <CardMedia
                        component="img"
                        height="60"
                        width="60"
                        image='#'
                        alt="Avatar"
                    />
                    <CardContent>
                        <Typography gutterBottom variant="h5" component="div">
                            <strong>{comment[0]}</strong>
                        </Typography>
                        <Typography variant="body2" color="text.secondary">
                            "{comment[1]}"
                        </Typography>
                    </CardContent>
                </CardActionArea>
                <CardActions>
                    <Button size="small" color="primary">
                        Share
                    </Button>
                </CardActions>
            </Paper>
        </Card >
    );
}

export default Rewiewcard;
