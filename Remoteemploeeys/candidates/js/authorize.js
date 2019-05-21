"use strict";

(function () {

    let modal = document.querySelector('.modal');

    let candInfo = $.cookie('reinfo'); // => "value"

    if(!candInfo){

        console.log('modal', modal);
        modal.classList.toggle('modal-open');
    }

    window.paths = {

        AjaxServerUrl: 'http://remotemployees.com/wp-json/',
        AuthCandidates: 'reset_user_auth/v2',
        PutStatusCandidate: 'reset_put_status_candidate/v2',
        PutCommentCandidate: 'reset_put_desc_candidate/v2',
        GetCandidate: 'reset_get_candidate/v2',
        GetStatusCandidate: 'reset_get_status_candidate/v2',

    };

// prevent modal inner from closing parent when clicked
    document.querySelector('.modal-content').addEventListener('click', function (e) {
        e.stopPropagation();
    });

    let authButton = document.querySelector("#authorize");

    if(authButton){
        authButton.addEventListener('click', async function () {

            let loginInput = document.querySelector('#login');
            let login  = loginInput.value;

            let passInput = document.querySelector('#password');
            let pass  = passInput.value;

            let data = new FormData();

            data.append('login', login);
            data.append('password' , pass);


            try{

                let request = await fetch(`${window.paths.AjaxServerUrl}${window.paths.AuthCandidates}` , {
                    method: 'POST',
                    body: data
                });

                let response = await request.json();

                console.log(response);
                if(response.status === 200){

                    $.cookie('reinfo',
                        JSON.stringify({login: login, pass: pass}),
                        { expires: 30, path: '/' }
                    );

                    modal.classList.toggle('modal-open');
                    
                }//if

            }//try
            catch(ex){

                console.log('ex' , ex);

            }//catch
        })
    }
})();