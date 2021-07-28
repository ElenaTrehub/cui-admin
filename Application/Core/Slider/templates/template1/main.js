 const mainSlides = document.querySelectorAll('.main-slider-item'),
        prevMain = document.querySelector('.main-prev-btn'),
        nextMain = document.querySelector('.main-next-btn'),
        total = document.querySelector('#total'),
        current = document.querySelector('#current'),
        mainSlidesWrapper = document.querySelector('.main'),
        mainSlidesField = document.querySelector('.main-slider'),
        widthMainSlidesWrapper = window.getComputedStyle(mainSlidesWrapper).width;
    //console.log(slidesField);
    let mainSlideIndex = 1;
    let mainOffset = 0;


 mainSlidesField.style.width = 100*mainSlides.length + '%';
 mainSlidesField.style.display = 'flex';
 mainSlidesField.style.transition = '0.5s all ease';

 mainSlides.forEach(slide => {
        slide.style.width = widthMainSlidesWrapper;
    });

    const indicators = document.createElement('ol'),
        dots = [];
    indicators.classList.add('carousel-indicators');
 mainSlidesWrapper.append(indicators);

    for(let i = 0; i < mainSlides.length; i++){
        const dot = document.createElement('li');
        dot.setAttribute('data-slide-to', i + 1);
        if(i === 0){
            dot.style.opacity = '1';
        }
        indicators.append(dot);
        dots.push(dot);
    }



 nextMain.addEventListener('click', () => {
        if(mainOffset === +widthMainSlidesWrapper.slice(0, widthMainSlidesWrapper.length - 2) * (mainSlides.length- 1)){
            mainOffset = 0;
            mainSlideIndex = 1;
        }
        else{
            mainOffset += +widthMainSlidesWrapper.slice(0, widthMainSlidesWrapper.length - 2);
            mainSlideIndex++;
        }
     mainSlidesField.style.transform = `translateX(-${mainOffset}px)`;

        dots.forEach(dot => dot.style.opacity = '.5');
        dots[mainSlideIndex-1].style.opacity = '1';
        //console.log(slideIndex);
    });

 prevMain.addEventListener('click', () => {
        if(mainOffset === 0){
            mainOffset = +widthMainSlidesWrapper.slice(0, widthMainSlidesWrapper.length - 2)*(mainSlides.length - 1);
            mainSlideIndex = mainSlides.length;
        }
        else{
            mainOffset -= +widthMainSlidesWrapper.slice(0, widthMainSlidesWrapper.length - 2);
            mainSlideIndex--;
        }
     mainSlidesField.style.transform = `translateX(-${mainOffset}px)`;

        dots.forEach(dot => dot.style.opacity = '.5');
        dots[mainSlideIndex-1].style.opacity = '1';
    });

    dots.forEach(dot => {

        dot.addEventListener('click', (e) => {

            const slideTo = e.target.getAttribute('data-slide-to');
            mainSlideIndex = slideTo;

            mainOffset = +widthMainSlidesWrapper.slice(0, widthMainSlidesWrapper.length - 2)*(slideTo - 1);
            mainSlidesField.style.transform = `translateX(-${mainOffset}px)`;

            dots.forEach(dot => dot.style.opacity = '.5');
            dots[mainSlideIndex-1].style.opacity = '1';
        })
    });

