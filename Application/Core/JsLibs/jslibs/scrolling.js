let scrolling = (upSelector) => {

    const upElem = document.querySelector(upSelector);


    window.addEventListener('scroll', () => {

        if(document.documentElement.scrollTop > 100){
            upElem.style.opacity = '1';
            upElem.classList.add('animate__animated', 'animate__fadeIn');
            upElem.classList.remove('animate__fadeOut');
        }
        else{
            upElem.style.opacity = '0';
            upElem.classList.add('animate__fadeOut');
            upElem.classList.remove( 'animate__fadeIn');
        }
    });

    const element = document.documentElement,
        body = document.body;


    const links = document.querySelectorAll('[href^="#"]');

    const calcScroll = () => {

        links.forEach(link => {
            link.addEventListener('click', function (e) {

                let href = this.getAttribute('href').substring(1);

                const scrollTarget = document.getElementById(href);

                const elementPosition = scrollTarget.getBoundingClientRect().top;
                const offsetPosition = elementPosition - 50;

                window.scrollTo(0, offsetPosition);

            });
        })



    };

};