let mask = (selector) => {

    let setCursorPosition = (pos, elem) => {
        elem.focus();

        if(elem.setSelectionRange){
            elem.setSelectionRange(pos, pos);
        }
        else if(elem.createTextRange){
            let range = elem.createTextRange();
            range.collapse(true);
            range.moveEnd('character', pos);
            range.moveStart('character', pos)
            range.select();
        }
    };


    function addMask(event){
        let matrix = '+38 (___) ___ __ __',
            def = matrix.replace(/\D/g, ''),
            val = this.value.replace(/\D/g, ''),
            i = 0;

        if(def.length >= val.length){
            val = def;
        }

        this.value = matrix.replace(/./g, function(a){
            return /[_\d]/.test(a) && i < val.length ? val.charAt(i++) : i >= val.length ? '' : a;
        });

        if(event.type === 'blur'){
            if(this.value.length === 3){
                this.value = '';
            }
            this.blur();
        }
        else{
            setCursorPosition(this.value.length, this);
        }
    }
    let inputs = document.querySelectorAll(selector);

    inputs.forEach(input => {
        input.addEventListener('input', addMask);
        input.addEventListener('focus', addMask);
        input.addEventListener('blur', addMask);
    });

};