import React from 'react';
import { useState, useEffect } from "react";

const SwitcherRange = ({ range, name, step }) => {
    const [valueMin, setValueMin] = useState(range.min || 0);
    const [valueMax, setValueMax] = useState(range.max || 10000);

    useEffect(() => {
        setValueMax(range.max)
        setValueMin(range.min)
    }, [range]);

    const handleChangeMin = (event) => {
        setValueMin(event.target.value)
    }
    const handleChangeMax = (event) => {
        setValueMax(event.target.value)
    }

    return (
        <div className='finder__input_box'>
            <label for="name">
                {name} От
                <input className='find_input' type='number' step={step} value={valueMin} min='0' onChange={handleChangeMin} />
            </label>
            <label htmlFor="">
                До
                <input className='find_input' type='number' step={step} value={valueMax} min={valueMin} onChange={handleChangeMax} />
            </label>
        </div>


    );
}

export default SwitcherRange;
