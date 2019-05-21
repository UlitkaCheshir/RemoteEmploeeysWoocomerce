"use strict";

function AddEvent() {
    let tr = document.querySelectorAll('tr.values');

    tr.forEach(item => {

        let statusId = item.dataset.statusId;
        let candId = item.dataset.candidateId;

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

                    let request = await fetch(`${window.paths.AjaxServerUrl}${window.paths.PutStatusCandidate}`, {
                        method: 'POST',
                        body: data
                    });

                    let response = await request.json();

                    if (response === 1) {

                        let clasName = '';
                        if (this.value == 5) {
                            clasName = 'white';
                        } else if (this.value == 7) {
                            clasName = 'yellow';
                        }
                        else if (this.value == 8) {
                            clasName = 'dark-green';
                        }
                        else {
                            clasName = 'red';
                        }

                        item.removeAttribute('class');
                        item.setAttribute('class', `values ${clasName}`);

                        if(this.value == 6){

                            let indexRow = item.rowIndex;

                            let table = document.querySelector(".table");

                            if(table){
                                table.deleteRow(indexRow);
                                table.innerHTML +=`
                            <tr data-candidate-id =${candId}  data-status-id =${statusId} class="values red">
                                ${item.innerHTML}</tr>`;

                                
                                console.log(item.innerHTML);
                                
                                AddEvent();
                                
                            }//if нашел таблицу
                        }//if не подошел
                    }//if


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

                        let request = await fetch(`${window.paths.AjaxServerUrl}${window.paths.PutCommentCandidate}`, {
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

    });
}


(function () {


    AddEvent();


    let limit = 50;
    let offset = 50



    let statisticButton = document.querySelector("#statistic");

    if(statisticButton){

        statisticButton.addEventListener('click', function () {

            window.location.href = "statistics.php"
        })
    }// if statisticButton


})();