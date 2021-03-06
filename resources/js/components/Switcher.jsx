import { useEffect, useState } from "react";
import React from 'react'
// import { toArray } from "lodash";

export default function Switcher({ prop, typeOfSelect }) {
  const [options, setOptions] = useState('');

  useEffect(() => {
    setOptions(Object.values(prop))
  }, [prop]);

  if (options) {
    return (
      <select className="find_select">
        <option value={typeOfSelect}>{typeOfSelect}</option>
        {options.map(item => <option key={item}>{item}</option>)}
      </select>
    )
  }
}
