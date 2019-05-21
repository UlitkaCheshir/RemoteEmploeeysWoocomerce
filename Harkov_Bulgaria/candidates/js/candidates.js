"use strict";

function AddEvent() {
    let tr = document.querySelectorAll('tr.values');

    tr.forEach(item => {

        let statusId = item.dataset.statusId;
        let candId = item.dataset.candidateId;
        let hotelId = item.dataset.hotelId;

        let statusSelect = item.querySelector("#statusCandidates");

        let option = statusSelect.querySelector(`option[data-status-id='${statusId}']`)

        if (option) {
            option.selected = true;
        }//if

        if (statusSelect) {
            statusSelect.addEventListener('change', async function () {

                try {

                    let data = new FormData();

                    data.append('idCand', candId);
                    data.append('idStatus', this.value);

                    let request = await fetch(`${window.paths.AjaxServerUrl}reset_put_status_candidate/v2`, {
                        method: 'POST',
                        body: data
                    });

                    let response = await request.json();

                    if (response === 1) {

                        let clasName = '';
                        if (this.value == 1) {
                            clasName = 'white';
                        } else if (this.value == 2) {
                            clasName = 'light-green';
                        } else if (this.value == 3) {
                            clasName = 'dark-green';
                        } else if (this.value == 5) {
                            clasName = 'blue';
                        } else {
                            clasName = 'red';
                        }

                        item.removeAttribute('class');
                        item.setAttribute('class', `values ${clasName}`)
                    }//if


                }//try
                catch (ex) {

                    console.log('ex', ex);

                }//catch
            });
        }//if

        let hotelSelect = item.querySelector("#hotel");

        let optionHotel = hotelSelect.querySelector(`option[data-hotel-id='${hotelId}']`)

        if (optionHotel) {
            optionHotel.selected = true;
        }//if

        if (hotelSelect) {
            hotelSelect.addEventListener('change', async function () {

                try {

                    let data = new FormData();

                    data.append('idCand', candId);
                    data.append('idHotel', this.value);

                    let request = await fetch(`${window.paths.AjaxServerUrl}reset_put_hotel/v2`, {
                        method: 'POST',
                        body: data
                    });

                    let response = await request.json();

                    console.log('response',response);
                    // if (response === 1) {
                    //
                    //     let clasName = '';
                    //     if (this.value == 1) {
                    //         clasName = 'white';
                    //     } else if (this.value == 2) {
                    //         clasName = 'light-green';
                    //     } else if (this.value == 3) {
                    //         clasName = 'dark-green';
                    //     } else if (this.value == 5) {
                    //         clasName = 'blue';
                    //     } else {
                    //         clasName = 'red';
                    //     }
                    //
                    //     item.removeAttribute('class');
                    //     item.setAttribute('class', `values ${clasName}`)
                    // }//if


                }//try
                catch (ex) {

                    console.log('ex', ex);

                }//catch
            });
        }//if

        let descriptionTextArea = item.querySelector('#description');

        if (descriptionTextArea) {
            descriptionTextArea.addEventListener('keydown', async function (event) {

                if (event.ctrlKey && event.keyCode == 13) {
                    let description = descriptionTextArea.value;

                    try {

                        let data = new FormData();

                        data.append('idCand', candId);
                        data.append('desc', description);

                        let request = await fetch(`${window.paths.AjaxServerUrl}reset_put_desc_candidate/v2`, {
                            method: 'POST',
                            body: data
                        });

                        let response = await request.json();

                        if (response === 1) {

                            console.log("OK");
                        }//if


                    }//try
                    catch (ex) {

                        console.log('ex', ex);

                    }//catch
                }//if


            });
        }//if

        let tdMoreText = item.querySelector('.moreText .short');

        if (tdMoreText) {

            tdMoreText.addEventListener('click', async function () {

                if (tdMoreText.innerHTML.trim().length > 15) {

                    let showText = item.querySelector(".showText");

                    showText.classList.remove('showText');
                    showText.classList.add('ShowMoreText');
                }//if


            });
        }//if


        let exit = item.querySelector('#exit');

        if (exit) {

            exit.addEventListener('click', async function () {

                let showText = item.querySelector(".ShowMoreText");

                showText.classList.remove('ShowMoreText');
                showText.classList.add('showText');

            });
        }//if

    });
}


(function () {

    window.paths = {

        AjaxServerUrl: 'https://of-w.com/wp-json/',

    };

    AddEvent();


    let limit = 50;
    let offset = 50


    let buttonMoreCandidate = document.querySelector("#MoreCandidate");

    if (buttonMoreCandidate) {

        buttonMoreCandidate.addEventListener('click', async function () {

            let table = document.querySelector(".table");

            if (table) {

                try {

                    let request = await fetch(`https://of-w.com/wp-json/reset_get_candidate/v2?limit=${limit}&offset=${offset}`, {
                        method: 'GET',

                    });

                    let response = await request.json();

                    let requestStatus = await fetch(`https://of-w.com/wp-json/reset_get_status_candidate/v2`, {
                        method: 'GET',
                    });
                    let responseStatus = await requestStatus.json();

                    let requestHotel = await fetch(`https://of-w.com/wp-json/reset_get_hotels/v2`, {
                        method: 'GET',
                    });
                    let responseHotel = await requestHotel.json();


                    if (response.length > 0) {

                        response.forEach(cand => {

                            let classStatus = "";

                            if (cand.status_id === responseStatus[0].id) {
                                classStatus = 'white';
                            } else if (cand.status_id === responseStatus[1].id) {
                                classStatus = 'light-green';
                            } else if (cand.status_id === responseStatus[2].id) {
                                classStatus = 'dark-green';
                            }
                            else if (cand.status_id === responseStatus[4].id) {
                                classStatus = 'blue';
                            } else {
                                classStatus = 'red';
                            }


                            let opton = '';
                            responseStatus.forEach(status => {

                                opton += `<option value=${status.id} data-status-id = ${status.id}>${status.title}</option>`

                            });

                            let optHotel = '';
                            responseHotel.forEach(hotel => {

                                optHotel += `<option value=${hotel.id} data-hotel-id = ${hotel.id}>${hotel.title}</option>`

                            });

                            table.innerHTML += `
                           <tr data-candidate-id = ${cand.id}  data-status-id =${cand.status_id} class="values ${classStatus}">
                               <td> ${cand.date}</td>
                               <td>${cand.FIO}</td>
                               <td>${cand.city}</td>
                               <td>${cand.age}</td>
                               <td>${cand.positions}</td>
                               <td>${cand.langsEN}</td>
                               <td>${cand.langsDE}</td>
                               <td>${cand.passport}</td>
                               <td class="moreText"> <div class="short">
                                       ${cand.experience}
                                   </div>
                                   <div class="showText">
                                       <span id="exit">X</span>
                                      ${cand.experience}
                                   </div>
                               </td>
                               <td>${cand.phone}</td>
                               <td class="email">${cand.email}</td>
                               <td><img src="${cand.photo}" alt="No image" width="100" height="75"></td>
                               <td class="word-break"><a target="_blank" href="${cand.websait}">Link</a></td>
                               <td style="width: 200px">${cand.about}</td>
                               <td>
                                   <select id="statusCandidates" name="prof-select" style="width: 100px">
                                     ${opton}
                                   </select>
                               </td>
                               <td >
                                    <select id="hotel" name="prof-select" style="width: 100px">
                                        ${optHotel}
                                    </select>
                                </td>
                               <td class="comment">
                                   <textarea id="description" name="comment" cols="30" rows="10">${cand.description}</textarea>
                               </td>
                           </tr>`;
                        })

                        offset += limit;

                        AddEvent();
                    }//if
                    else {
                        buttonMoreCandidate.style.display = "none";
                    }


                }//try
                catch (ex) {

                    console.log('ex', ex);

                }//catch


            }//if table
        });//addeventListenere buttonMoreCandidate
    }//if

    let buttonWriteFile = document.querySelector("#writeFile");

    if (buttonWriteFile) {
        buttonWriteFile.addEventListener('click', async function (event) {

            try {

                let request = await fetch(`https://of-w.com/wp-json/reset_get_candidat_inDatabase/v2`, {
                    method: 'GET',
                });

                if (request.status === 200) {

                    try {
                        let response = await request.clone().blob();

                        let fileName = request.headers.get('Content-Disposition');

                        fileName = fileName.slice(22, fileName.length-1);

                        let a = document.createElement("a");
                        a.style = "display: none";

                        let url = window.URL.createObjectURL(response);

                        a.href = url;
                        a.download = fileName;
                        document.body.appendChild(a);
                        a.click();
                        window.URL.revokeObjectURL(url);
                    }//try
                    catch (e) {

                        let responseJson = await request.clone().json();

                        if(responseJson.status === 202){
                            let divText = document.querySelector('#noinDB');

                            divText.style.display = "block";
                            divText.textContent = `${responseJson.message}`;

                            console.log("responseJson", responseJson)
                        }//if


                    }//catch



                }//if



            }//try
            catch (ex) {

                console.log('ex', ex);

            }//catch

        });//addeventListenere buttonWriteFile

    }//if

    let statisticButton = document.querySelector("#statistic");

    if(statisticButton){

        statisticButton.addEventListener('click', function () {

            window.location.href = "statistics.php"
        })
    }// if statisticButton

    let toExcelButton = document.querySelector("#toExcel");

    if(toExcelButton){

        toExcelButton.addEventListener('click', async function (event) {

            try {

                let request = await fetch(`https://of-w.com/wp-json/reset_get_candidat_inExcel/v2`, {
                    method: 'GET',
                });

                if (request.status === 200) {

                    try {
                        let response = await request.clone().blob();

                        let fileName = request.headers.get('Content-Disposition');

                        fileName = fileName.slice(22, fileName.length-1);

                        let a = document.createElement("a");
                        a.style = "display: none";

                        let url = window.URL.createObjectURL(response);

                        a.href = url;
                        a.download = fileName;
                        document.body.appendChild(a);
                        a.click();
                        window.URL.revokeObjectURL(url);
                    }//try
                    catch (e) {

                        let responseJson = await request.clone().json();

                        if(responseJson.status === 202){
                            let divText = document.querySelector('#noinDB');

                            divText.style.display = "block";
                            divText.textContent = `${responseJson.message}`;

                            console.log("responseJson", responseJson)
                        }//if


                    }//catch



                }//if



            }//try
            catch (ex) {

                console.log('ex', ex);

            }//catch

        });//addeventListenere buttonWriteFile

    }//if toExcelButton

    let candidatesHarkiv = document.querySelector("#toHarkiv");

    if(candidatesHarkiv){

        candidatesHarkiv.addEventListener('click', function () {

            window.location.href = "candidates-harkiv.php"
        })
    }// if statisticButton
})();