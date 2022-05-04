let sliderOneSlideOpacity = (slideItems, wrapper,  prevBtn, nextBtn) => {
    const slides = document.querySelectorAll(slideItems),
        prev = document.querySelector(prevBtn),
        next = document.querySelector(nextBtn),
        slidesWrapper = document.querySelector(wrapper);
        let slideIndex = 0;

    slides.forEach(slide => {
        slide.style.display = 'none';
        slide.classList.add('animate__animated');
    });
    slides[slideIndex].classList.add('animate__fadeIn');
    slides[slideIndex].style.display = 'block';



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
        slides.forEach(slide => {
            slide.classList.add('animate__fadeOut');
            if(slide.classList.contains('animate__fadeIn')){
                slide.classList.remove('animate__fadeIn');
            }
            slide.style.display = 'none';

        });
        if(slideIndex === slides.length-1){
            slides[0].classList.add('animate__fadeIn');
            if(slides[0].classList.contains('animate__fadeOut')){
                slides[0].classList.remove('animate__fadeOut');
            }
            slides[0].style.display = 'block';

            slideIndex = 0;

        }
        else{

            slides[slideIndex+1].classList.add('animate__fadeIn');
            if(slides[slideIndex+1].classList.contains('animate__fadeOut')){
                slides[slideIndex+1].classList.remove('animate__fadeOut');
            }
            slides[slideIndex+1].style.display = 'block';
            slideIndex++;
        }

        dots.forEach(dot => dot.style.opacity = '.5');
        dots[slideIndex].style.opacity = '1';

    });

    prev.addEventListener('click', () => {
        slides.forEach(slide => {

            slide.classList.add('animate__fadeOut');
            if(slide.classList.contains('animate__fadeIn')){
                slide.classList.remove('animate__fadeIn');
            }
            slide.style.display = 'none';
        });
        if(slideIndex < 1){
            slides[slides.length-1].classList.add('animate__fadeIn');
            if(slides[slides.length-1].classList.contains('animate__fadeOut')){
                slides[slides.length-1].classList.remove('animate__fadeOut');
            }
            slides[slides.length-1].style.display = 'block';
            slideIndex = slides.length-1;
        }
        else{
            slides[slideIndex - 1].classList.add('animate__fadeIn');
            if(slides[slideIndex - 1].classList.contains('animate__fadeOut')){
                slides[slideIndex - 1].classList.remove('animate__fadeOut');
            }
            slides[slideIndex - 1].style.display = 'block';
            slideIndex--;
        }

        dots.forEach(dot => dot.style.opacity = '.5');
        dots[slideIndex].style.opacity = '1';
    });

    dots.forEach(dot => {

        dot.addEventListener('click', (e) => {

            const slideTo = e.target.getAttribute('data-slide-to');
            slideIndex = slideTo - 1;

            slides.forEach(slide => {

                slide.classList.add('animate__fadeOut');
                if(slide.classList.contains('animate__fadeIn')){
                    slide.classList.remove('animate__fadeIn');
                }
                slide.style.display = 'none';
            });

            slides[slideIndex].classList.add('animate__fadeIn');
            if(slides[slideIndex].classList.contains('animate__fadeOut')){
                slides[slideIndex].classList.remove('animate__fadeOut');
            }
            slides[slideIndex].style.display = 'block';


            dots.forEach(dot => dot.style.opacity = '.5');
            dots[slideIndex].style.opacity = '1';
        })
    });


};