(function() {

    "use strict";

    let toggles = document.querySelectorAll(".toggle-hamburger");
    let menu = document.querySelector("nav");
    //let menu_ul = document.querySelector("nav ul");
    //let logo = document.querySelector(".logo");
    //let container = document.querySelector(".container");



    // if(menu_ul.clientWidth > window.innerWidth - logo.clientWidth - (window.innerWidth - container.clientWidth)){
    //     if(menu.classList.contains('menu')){
    //         menu.classList.remove('menu');
    //     }
    //     menu.classList.add('menu_small');
    //     if(toggles[0].classList.contains('d-none')){
    //         toggles[0].classList.remove('d-none');
    //     }
    // }
    // else{
    //     toggles[0].classList.add('d-none');
    // }
    //
    // window.addEventListener('resize', ()=> {
    //
    //     // console.log(menu.clientWidth);
    //     // console.log('---------------------------------------');
    //     // console.log(window.innerWidth - logo.clientWidth - (window.innerWidth - container.clientWidth));
    //
    //
    //     if(menu_ul.clientWidth > window.innerWidth - logo.clientWidth - (window.innerWidth - container.clientWidth)){
    //         if(menu.classList.contains('menu')){
    //             menu.classList.remove('menu');
    //             menu.classList.add('menu_small');
    //             toggles[0].classList.add('d-none');
    //         }
    //     }
    //     else{
    //         if(menu.classList.contains('menu_small')){
    //             menu.classList.remove('menu_small');
    //             menu.classList.add('menu');
    //             if(toggles[0].classList.contains('d-none')){
    //                 toggles[0].classList.remove('d-none');
    //             }
    //
    //         }
    //     }
    // });



    menu.classList.add('animate__animated');


    for (let i = toggles.length - 1; i >= 0; i--) {
        let toggle = toggles[i];
        toggleHandler(toggle);
    };

    let isMenuShow = false;
    function toggleHandler(toggle) {
        toggle.addEventListener( "click", function(e) {
            e.preventDefault();
            (this.classList.contains("is-active") === true) ? this.classList.remove("is-active") : this.classList.add("is-active");
            if(!isMenuShow){

                menu.classList.remove('animate__fadeOut');
                menu.classList.add('animate__fadeIn');
                menu.style.display = 'block';
                isMenuShow = true;
            }
            else{
                menu.classList.add('animate__fadeOut');
                menu.classList.remove('animate__fadeIn');

                //menu.style.display = 'none';

                isMenuShow = false;
            }

        });
    }


    //header-fixed

})();