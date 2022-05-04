

    let toggles = document.querySelectorAll(".toggle-hamburger");
    let menu = document.querySelector(".menu_sm");

    if(menu){
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
    }

    //header
    //hfixed



