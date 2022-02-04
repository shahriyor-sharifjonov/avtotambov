const popupClose = document.querySelector('.popup__close'),
    body = document.querySelector('body'),
    popup = document.querySelector('.popup'),
    btn = document.querySelectorAll('.btn');

btn.forEach(element => {
    element.addEventListener('click', ()=>{
        popup.classList.add('active')
        body.style.overflowX = 'hidden'
        body.style.overflowY = 'hidden'
    })        
});

popupClose.addEventListener('click', ()=>{
    popup.classList.remove('active')
    body.style.overflowX = 'visible'
    body.style.overflowY = 'visible'
})




document.addEventListener('DOMContentLoaded', function () {
    const form = document.getElementById('form');
    const popupForm = document.getElementById('popup__form');
    form.addEventListener('submit', formSend);
    popupForm.addEventListener('submit', popupFormSend);

    async function formSend(e) {
        e.preventDefault();
        let formData = new FormData(form);
        form.classList.add('sending');
        let response = await fetch('sendmail.php', {
            method: 'POST',
            body: formData
        });
        if(response.ok){
            let result = await response.json();
            form.classList.add('success');
            form.classList.remove('sending');
            form.reset();
        }else{
            alert("Ошибка");
            form.classList.remove('sending');
        }
    }

    async function popupFormSend(e) {
        e.preventDefault();
        let formData = new FormData(popupForm);
        popupForm.classList.add('sending');
        let response = await fetch('sendmail.php', {
            method: 'POST',
            body: formData
        });
        if(response.ok){
            let result = await response.json();
            popupForm.classList.add('success');
            popupForm.classList.remove('sending');
            popupForm.reset();
        }else{
            alert("Ошибка");
            popupForm.classList.remove('sending');
        }
    }
})