const slidesThreeSlider = (items, wrapper, slider, prevBtn, nextBtn) => {
    let slides = document.querySelectorAll(items),
        prev = document.querySelector(prevBtn),
        next = document.querySelector(nextBtn),
        slidesWrapper = document.querySelector(wrapper),
        slidesField = document.querySelector(slider),
        width = window.getComputedStyle(slidesWrapper).width;



    let offset = 0;
    let slideWidth = 0;

    slidesField.style.display = 'flex';
    slidesField.style.transition = '0.5s all ease';


    slides.forEach(slide => {
        if(document.documentElement.clientWidth >= 768 && document.documentElement.clientWidth < 992){
            slide.style.width = '50%';
            slideWidth = +((+width.slice(0, width.length - 2) - 24)/2).toFixed(2);


            slidesField.style.width = 100*slides.length/2 + '%';

        }
        else if(document.documentElement.clientWidth >= 992){
            slide.style.width = '33.333333333%';
            slideWidth = +((+width.slice(0, width.length - 2) - 24)*33.33333333/100).toFixed(2);


            slidesField.style.width = 100*slides.length/3 + '%';

        }
        else{
            slide.style.width = '100%';
            slideWidth = +(+width.slice(0, width.length - 2) -24).toFixed(2);


            slidesField.style.width = 100*slides.length + '%';

        }

    });






    window.onresize = function (slideWidth){

        slides.forEach(slide => {
            if(document.documentElement.clientWidth >= 768 && document.documentElement.clientWidth < 992){
                slide.style.width = '50%';
                slideWidth = +((+width.slice(0, width.length - 2) - 24)/2).toFixed(2);


                slidesField.style.width = 100*slides.length/2 + '%';

            }
            else if(document.documentElement.clientWidth >= 992){
                slide.style.width = '33.333333333%';
                slideWidth = +((+width.slice(0, width.length - 2) - 24)*33.33333333/100).toFixed(2);


                slidesField.style.width = 100*slides.length/3 + '%';

            }
            else{
                slide.style.width = '100%';
                slideWidth = +(+width.slice(0, width.length - 2) -24).toFixed(2);


                slidesField.style.width = 100*slides.length + '%';

            }

        });
    }

    next.addEventListener('click', () => {
        if(offset > slideWidth * (slides.length- 4)) {
            offset = 0;
        }

        else{
            offset += slideWidth;

        }

        slidesField.style.transform = `translateX(-${offset}px)`;


    });

    prev.addEventListener('click', () => {
        if(offset === 0){

            offset = slideWidth * (slides.length- 3);

        }
        else{
            offset -= slideWidth;

        }

        slidesField.style.transform = `translateX(-${offset}px)`;


    });
};