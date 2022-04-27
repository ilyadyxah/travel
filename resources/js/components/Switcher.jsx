import { useState } from "react";
import React from 'react'

export default function Switcher(props) {

  const [option, setOption] = useState(props.option);

  return (
        <select>
          <option>{option}</option>
          <option>{option}</option>
          <option>{option}</option>
          <option>{option}</option>
        </select>
  )
}
