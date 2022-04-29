import React from 'react'
import { useState } from 'react';

export default function JourneyCard(props) {
  const [journey] = useState(props);

  return (
    <div>
      <h2>JourneyCard</h2>
      <section>
        <img src="*" alt="" />
        <h3>Название тура: {journey.name}</h3>
        <p>City of journey: {journey.city }</p>
        <p>Description:  duration of journey {journey.duration}, cost is {journey.cost} </p>
      </section>
    </div>
  )
}
