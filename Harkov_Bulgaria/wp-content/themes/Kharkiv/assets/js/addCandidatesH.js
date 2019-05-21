"use strict";

(function (){

    var elements = document.querySelector('#phone');

    if(elements){
        new IMask(elements, {
            mask: '+{38}(000)000-00-00',
        });
    }

    let submit_btn = document.querySelector('#submit-btn');

    if(submit_btn){

        submit_btn.addEventListener('click' ,async function (){

            let fio = document.querySelector('#fio');
            let age = document.querySelector('#age');
            let phone = document.querySelector('#phone');
            let vacancy = document.querySelector('#vacancy');
            let languageEN = document.querySelector('#language-en');


            let fioData = fio.value;

            let ageData = age.value;
            let phoneData = phone.value;

            let vacancyData = vacancy.value;
            let langDataEN = languageEN.value;


            if(/^[а-яa-z\s]{3,50}$/i.test(fioData) === false ){

                document.querySelector(".hidden-msg").style.display = 'block';
                fio.style.outline = "1px solid red";
                return;

            }//if
            else{
                document.querySelector(".hidden-msg").style.display = 'none';
                fio.style.outline = "-webkit-focus-ring-color auto 5px";
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

            let data = new FormData();

            data.append('FIO', fioData);
            data.append('age' , ageData);
            data.append('position' , vacancyData);
            data.append('langsEN' , langDataEN);
            data.append('phone' , phoneData);

            try{

                let request = await fetch(`https://of-w.com/wp-json/reset_add_candidates_small_harkov/v2` , {
                    method: 'POST',
                    body: data
                });

                let response = await request.json();

                console.log(response);
                if(response.status === 200){

                            window.location.href = "/thanke";
                }//if
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