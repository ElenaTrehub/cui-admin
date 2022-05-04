let sliderOneSlideAllWidth = (slideItems, wrapper, slider,  prevBtn, nextBtn) => {

    const slides = document.querySelectorAll(slideItems),
        slidesWrapper = document.querySelector(wrapper),
        slidesField = document.querySelector(slider),
        prev = document.querySelector(prevBtn),
        next = document.querySelector(nextBtn),
        width = window.getComputedStyle(slidesWrapper).width;

    let slideIndex = 1;
    let offset = 0;


    slidesField.style.width = 100*slides.length + '%';
    slidesField.style.display = 'flex';
    slidesField.style.transition = '0.5s all ease';

    slides.forEach(slide => {
        slide.style.width = width;
    });

    const indicators = document.createElement('ol'),
        dots = [];
    indicators.classList.add('carousel-indicators');
    slidesWrapper.append(indicators);

    for(let i = 0; i < slides.length; i++){
        const dot = document.createElement('li');
        dot.setAttribute('data-slide-to', i + 1);
        if(i === 0){
            dot.style.opacity = '1';
        }
        indicators.append(dot);
        dots.push(dot);
    }



    next.addEventListener('click', () => {
        if(offset === +width.slice(0, width.length - 2) * (slides.length- 1)){
            offset = 0;
            slideIndex = 1;
        }
        else{
            offset += +width.slice(0, width.length - 2);
            slideIndex++;
        }
        slidesField.style.transform = `translateX(-${offset}px)`;

        dots.forEach(dot => dot.style.opacity = '.5');
        dots[slideIndex-1].style.opacity = '1';
        //console.log(slideIndex);
    });

    prev.addEventListener('click', () => {
        if(offset === 0){
            offset = +width.slice(0, width.length - 2)*(slides.length - 1);
            slideIndex = slides.length;
        }
        else{
            offset -= +width.slice(0, width.length - 2);
            slideIndex--;
        }
        slidesField.style.transform = `translateX(-${offset}px)`;

        dots.forEach(dot => dot.style.opacity = '.5');
        dots[slideIndex-1].style.opacity = '1';
    });

    dots.forEach(dot => {

        dot.addEventListener('click', (e) => {

            const slideTo = e.target.getAttribute('data-slide-to');
            slideIndex = slideTo;

            offset = +width.slice(0, width.length - 2)*(slideTo - 1);
            slidesField.style.transform = `translateX(-${offset}px)`;

            dots.forEach(dot => dot.style.opacity = '.5');
            dots[slideIndex-1].style.opacity = '1';
        })
    });



};