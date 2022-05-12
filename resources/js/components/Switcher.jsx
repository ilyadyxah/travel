import { useEffect, useState } from "react";
import React from 'react'
import { toArray } from "lodash";

export default function Switcher({ prop, typeOfSelect }) {
  const [options, setOptions] = useState(Object.values(prop));

  if (options) {
    // console.log(options, prop)
    return (
      <select>
        <option value={typeOfSelect}>{typeOfSelect}</option>
        {options.map(item => <option key={item}>{item}</option>)}
      </select>
    )
  }
}
