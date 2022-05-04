let accordion = (triggersSelector) => {
    const btns = document.querySelectorAll(triggersSelector);

    btns.forEach(item => {
        item.addEventListener('click', function () {
            if(this.classList.contains('active-style')){
                this.classList.remove('active-style');
                this.nextElementSibling.classList.remove('active-content');
                btns.forEach(item => {

                    item.nextElementSibling.style.maxHeight = '0px';
                    item.classList.remove('active-style');
                    item.nextElementSibling.classList.remove('active-content');


                });
            }
            else{
                this.classList.add('active-style');
                this.nextElementSibling.classList.add('active-content');

                if(this.classList.contains('active-style')){
                    btns.forEach(item => {
                        if(item !== this){
                            item.nextElementSibling.style.maxHeight = '0px';
                            item.classList.remove('active-style');
                            item.nextElementSibling.classList.remove('active-content');
                        }

                    });
                    this.nextElementSibling.style.maxHeight = this.nextElementSibling.scrollHeight + 30 + 'px';
                }
                else{
                    this.nextElementSibling.style.maxHeight = '0px';
                }
            }

        });
    });
};