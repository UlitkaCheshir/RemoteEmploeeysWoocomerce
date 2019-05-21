"use strict";

(function (){

    var elements = document.querySelector('#phone');

    new IMask(elements, {
        mask: '+{38}(000)000-00-00',
    });

    let candInfo = $.cookie('bulgariaInfo'); // => "value"

    if(candInfo){
        candInfo = JSON.parse(candInfo);
    }


    let submit_btn = document.querySelector('#submit-btn');

    if(submit_btn){

        submit_btn.addEventListener('click' ,async function (){

            let fio = document.querySelector('#fio');
            let phone = document.querySelector('#phone');
            let email = document.querySelector('#email');

            let fioData = fio.value;
            let phoneData = phone.value;
            let emailData = email.value;


            if(/^[а-яa-z\s]{3,50}$/i.test(fioData) === false ){

                document.querySelector(".hidden-msg").style.display = 'block';
                fio.style.outline = "1px solid red";
                return;

            }//if
            else{
                document.querySelector(".hidden-msg").style.display = 'none';
                fio.style.outline = "-webkit-focus-ring-color auto 5px";
            }

            if(/^\+\d{2}\(\d{3}\)\d{3}-\d{2}-\d{2}$/i.test(phoneData) === false ){

                document.querySelector(".hidden-msg").style.display = 'block';
                phone.style.outline = "1px solid red";
                return;

            }//if
            else{
                document.querySelector(".hidden-msg").style.display = 'none';
                phone.style.outline = "-webkit-focus-ring-color auto 5px";
            }

            if(/^([a-z0-9_-]+\.)*[a-z0-9_-]+@[a-z0-9_-]+(\.[a-z0-9_-]+)*\.[a-z]{2,6}$/i.test(emailData) === false ){

                document.querySelector(".hidden-msg").style.display = 'block';
                email.style.outline = "1px solid red";
                return;

            }//if
            else{
                document.querySelector(".hidden-msg").style.display = 'none';
                email.style.outline = "-webkit-focus-ring-color auto 5px";
            }


            let data = new FormData();

            data.append('FIO', fioData);
            data.append('phone' , phoneData);
            data.append('email' , emailData);
            data.append('small' , '1');

            try{

                let request = await fetch(`https://of-w.com/wp-json/reset_add_candidates_small/v2` , {
                    method: 'POST',
                    body: data
                });

                let response = await request.json();

                if(response.status === 200){

                    $.cookie('bulgariaInfo',
                            JSON.stringify({id: response.id, fio: fioData, phone: phoneData, email: emailData}),
                            { expires: 7, path: '/' }
                        );

                    console.log('response', response);
                 window.location.href = "/thank"
                }//if

            }//try
            catch(ex){

                console.log('ex' , ex);

            }//catch

        });

    }//if

    let submit_btn2 = document.querySelector('#submit-btn2');
    if(submit_btn2){

        document.querySelector('#fio').value = candInfo.fio;
        document.querySelector('#phone').value = candInfo.phone;
        document.querySelector('#email').value = candInfo.email;

        submit_btn2.addEventListener('click' ,async function (){


            let city = document.querySelector('#city');
            let age = document.querySelector('#age');

            let photo = document.querySelector('#photo');
            let soc = document.querySelector('#soc');
            let vacancy = document.querySelector('#vacancy');
            let languageEN = document.querySelector('#language-en');
            let languageDE = document.querySelector('#language-de');
            let bioPassport = document.querySelector('#bio');
            let text = document.querySelector('#text');
            let about = document.querySelector('#from');

            let fioData = fio.value;
            let cityData = city.value;
            let ageData = age.value;
            let phoneData = phone.value;
            let emailData = email.value;
            let photoData = photo.files[0];
            let socData = soc.value;
            let vacancyData = vacancy.value;
            let langDataEN = languageEN.value;
            let langDataDE = languageDE.value;
            let biopassportData = bioPassport.value;
            let textData = text.value;
            let aboutData = about.value;

            if(/^[а-яa-z\s]{3,50}$/i.test(fioData) === false ){

                document.querySelector(".hidden-msg").style.display = 'block';
                fio.style.outline = "1px solid red";
                return;

            }//if
            else{
                document.querySelector(".hidden-msg").style.display = 'none';
                fio.style.outline = "-webkit-focus-ring-color auto 5px";
            }

            if(/^[а-яa-z0-9\s]{3,50}$/i.test(cityData) === false ){

                document.querySelector(".hidden-msg").style.display = 'block';
                city.style.outline = "1px solid red";
                return;

            }//if
            else{
                document.querySelector(".hidden-msg").style.display = 'none';
                city.style.outline = "-webkit-focus-ring-color auto 5px";
            }

            if(/^[0-9\s]{1,2}$/i.test(ageData) === false ){

                document.querySelector(".hidden-msg").style.display = 'block';
                age.style.outline = "1px solid red";
                return;

            }//if
            else{
                document.querySelector(".hidden-msg").style.display = 'none';
                age.style.outline = "-webkit-focus-ring-color auto 5px";
            }

            if(/^\+\d{2}\(\d{3}\)\d{3}-\d{2}-\d{2}$/i.test(phoneData) === false ){

                document.querySelector(".hidden-msg").style.display = 'block';
                phone.style.outline = "1px solid red";
                return;

            }//if
            else{
                document.querySelector(".hidden-msg").style.display = 'none';
                phone.style.outline = "-webkit-focus-ring-color auto 5px";
            }

            if(/^([a-z0-9_-]+\.)*[a-z0-9_-]+@[a-z0-9_-]+(\.[a-z0-9_-]+)*\.[a-z]{2,6}$/i.test(emailData) === false ){

                document.querySelector(".hidden-msg").style.display = 'block';
                email.style.outline = "1px solid red";
                return;

            }//if
            else{
                document.querySelector(".hidden-msg").style.display = 'none';
                email.style.outline = "-webkit-focus-ring-color auto 5px";
            }


            let data = new FormData();

            data.append('FIO', fioData);
            data.append('city', cityData);
            data.append('age' , ageData);
            data.append('position' , vacancyData);
            data.append('langsEN' , langDataEN);
            data.append('langsDE' , langDataDE);
            data.append('experience' , textData);
            data.append('phone' , phoneData);
            data.append('email' , emailData);
            data.append('passport' , biopassportData);

            data.append('websait' , socData);
            data.append('about' , aboutData);

            data.append('idCand' , candInfo.id);



            if(phoneData.length !== 0){
                data.append('photo' , photoData);
            }//if
            else{
                data.append('photo' , null);
            }//else

            try{

                let request = await fetch(`https://of-w.com/wp-json/reset_add_candidates_small/v2` , {
                    method: 'POST',
                    body: data
                });

                let response = await request.json();

                console.log('response',response);
                if(response.status === 200){

                    // document.querySelector(".hidden-msg").style.display = 'block';
                    // document.querySelector(".hidden-msg").textContent ="Заявка принята";
                    // document.querySelector(".hidden-msg").style.color = 'black';
                    switch (vacancyData.trim()) {
                        case 'Бармен':
                            window.location.href = "/bulgaria/thanks/bartender"
                            break;
                        case 'Официант':
                            window.location.href = "/bulgaria/thanks/waiter"
                            break;
                        case 'Аниматор':
                            window.location.href = "/bulgaria/thanks/animator"
                            break;
                        case 'Повар':
                            window.location.href = "/bulgaria/thanks/cook"
                            break;
                        case 'Горничная':
                            window.location.href = "/bulgaria/thanks/maid"
                            break;
                        case 'Портье':
                            window.location.href = "/bulgaria/thanks/portie"
                            break;
                        case 'Разнорабочий':
                            window.location.href = "/bulgaria/thanks/handyman"
                            break;
                        case 'Электрик':
                            window.location.href = "/bulgaria/thanks/electricial"
                            break;
                        case 'Посудомойщица':
                            window.location.href = "/bulgaria/thanks/dishwasher"
                            break;
                        case 'Спасатель':
                            window.location.href = "/bulgaria/thanks/rescuers"
                            break;
                        case 'Танцор':
                            window.location.href = "/bulgaria/thanks/dancer"
                            break;

                    }//switch
                }//if
                else if(response.code === 400 ){
                    document.querySelector(".hidden-msg").style.display = 'block';
                    document.querySelector(".hidden-msg").textContent =`Ваша заявка добавлена в базу данных, но произошла ошибка в загрузке изображения. ${response.message}` ;
                }
                else{
                    document.querySelector(".hidden-msg").style.display = 'block';
                    document.querySelector(".hidden-msg").textContent =`Ошибка в добавлении заявки ${response.message}` ;
                }//else

            }//try
            catch(ex){

                console.log('ex' , ex);

            }//catch

        });

    }//if


})();