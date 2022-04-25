import React from 'react'
import JourneyCard from '../../JourneyCard'
import { useState } from 'react';

export default function Journeys() {
    const [journeyBase, setjourneyBase] = useState([
    { id: 1, city: 'Vologda', type: 'Bus tour', duration: 48 },
    { id: 2, city: 'N.Novgorod', type: 'Bus tour', duration: 48 },
    { id: 3, city: 'Kiev', type: 'Bus tour', duration: 48 },
    { id: 4, city: 'Murmansk', type: 'Bus tour', duration: 48 },
    {id: 5, city: 'Vologda', type: 'Bus tour', duration: 48 },
    ]);
  console.log(journeyBase)
  return (
      <div>
      <h2>Journeys</h2>
      {journeyBase.map(item => <JourneyCard {...item} />
      )}
    </div>
  )
}
