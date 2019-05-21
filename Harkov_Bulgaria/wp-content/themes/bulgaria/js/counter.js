"use strict";

(async function (){

    let counter = document.querySelector('.counter');

    if(counter){

        let dig1 = document.querySelector('#dig1');
        let dig2 = document.querySelector('#dig2');
        let dig3 = document.querySelector('#dig3');
        let dig4 = document.querySelector('#dig4');


        try{

            let request = await fetch(`https://of-w.com/wp-json/reset_get_count_candidate/v2` , {
                method: 'GET',
            });

            let response = await request.json();

            console.log('response',response);
            if(response.status === 200){

                let  number = response.count[0].count,
                    output = [],
                    sNumber = number.toString();

                for (let i = 0; i < 4; i += 1) {
                    output.push(+sNumber.charAt(i));
                }

                if(number>=100){
                    dig1.textContent = output[3];
                    dig2.textContent = output[0];
                    dig3.textContent = output[1];
                    dig4.textContent = output[2];
                }
                else if(number>=10){
                    dig1.textContent = output[3];
                    dig2.textContent = output[2];
                    dig3.textContent = output[0];
                    dig4.textContent = output[1];
                }
                else if(number<10){
                    dig1.textContent = output[3];
                    dig2.textContent = output[2];
                    dig3.textContent = output[1];
                    dig4.textContent = output[0];
                }
                else{
                    dig1.textContent = output[0];
                    dig2.textContent = output[1];
                    dig3.textContent = output[2];
                    dig4.textContent = output[3];
                }


            }//if

        }//try
        catch(ex){

            console.log('ex' , ex);

        }//catch

    }//if


})();