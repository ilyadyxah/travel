import React from 'react';
import CategoriesSwiper from './CategoriesSwiper';

const TravelCategories = () => {
    return (
        <div className='categories_block'>
            <div className="categories_text text_block">
                <h2 className='home__header'>Категории путешествий</h2>
                <div className='underline_block'></div>
                <p className='text_blue videos__header_text'>Lorem ipsum dolor sit amet consectetur adipisicing elit. Ullam vitae voluptatem voluptate modi, porro aspernatur animi tenetur, consequuntur reprehenderit accusamus aliquam qui maxime amet vel eligendi quod laudantium? Consequuntur nesciunt a numquam expedita porro perspiciatis labore quibusdam officiis eveniet adipisci.</p>
            </div>
            <CategoriesSwiper />
        </div>
    );
}

export default TravelCategories;
