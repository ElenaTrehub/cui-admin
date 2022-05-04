let formSend = (formName) => {
    const formList = document.querySelectorAll(formName);
        formList.forEach((form)=>{
        form.addEventListener('submit', function (e) {

            e.preventDefault();
            const formData = new FormData(this);

            ajaxSend(formData)
                .then((response) => {
                    form.reset(); // очищаем поля формы
                })
                .catch((err) => console.error(err))
        });
    });


    const ajaxSend = async (formData) => {
        const fetchResp = await fetch('mail.php', {
            method: 'POST',
            body: formData
        });
        if (!fetchResp.ok) {
            throw new Error(`Ошибка отправки формы ${fetchResp.status}`);
        }
        return await fetchResp.text();
    };
};