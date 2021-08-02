const sliderOneSlide = (slides, dir, prev, next) => {
    let slideIndex = 1,
        paused = false;
    const items = document.querySelectorAll(slides);



    let maxHeightItem = 0;
    items.forEach(item => {
        if(item.offsetHeight > maxHeightItem){
            maxHeightItem = item.offsetHeight;
        }
    });

    items.forEach(item => {
        item.style.height = maxHeightItem + 'px';
    });

    function showSlides(n){
        if(n > items.length){
            slideIndex = 1;
        }

        if(n < 1){
            slideIndex = items.length;
        }

        items.forEach(item => {
            item.classList.add('animate__animated');
            item.style.display = 'none';
        });

        items[slideIndex - 1].style.display = 'block';
    }
    showSlides(slideIndex);

    function plusSlides(n){
        showSlides(slideIndex += n);
    }

    try{
        const prevBtn = document.querySelector(prev),
            nextBtn = document.querySelector(next);

        prevBtn.addEventListener('click', () => {
            plusSlides(-1);
            if(dir === 'vertical'){
                items[slideIndex - 1].classList.add('animate__fadeInDown');
            }
            else{
                items[slideIndex - 1].classList.remove('animate__fadeInLeft');
                items[slideIndex - 1].classList.add('animate__fadeInRight');
            }

        });

        nextBtn.addEventListener('click', () => {
            plusSlides(1);
            if(dir === 'vertical'){
                items[slideIndex - 1].classList.add('animate__fadeInDown');
            }
            else{
                items[slideIndex - 1].classList.remove('animate__fadeInRight');
                items[slideIndex - 1].classList.add('animate__fadeInLeft');
            }

        });
    }
    catch(e){

    }

    function activateAnimation() {
        if(dir === 'vertical'){
            paused = setInterval(function () {
                plusSlides(1);
                items[slideIndex - 1].classList.add('animate__fadeInDown');
            }, 3000);
        }
        else{
            paused = setInterval(function () {
                plusSlides(1);
                items[slideIndex - 1].classList.add('animate__fadeInLeft');
            }, 3000);
        }
    }

    //activateAnimation();

    items[0].parentNode.addEventListener('mouseenter', () => {
        clearInterval(paused);
    });

    items[0].parentNode.addEventListener('mouseleave', () => {
        activateAnimation();
    });
};