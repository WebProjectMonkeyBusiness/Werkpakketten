/**
 * Created by Lys on 21.05.2017.
 */

if (document.readyState === 'complete' || document.readyState !== 'loading') {
    init();
} else {
    document.addEventListener('DOMContentLoaded', init);
}

function updateOrCreate() {
    var myForm = document.querySelector('form');
    var getID = myForm.ID.value;
    var formData = new FormData(myForm);
    var realData = {}
    for (var [key, value] of formData.entries()) {
        realData[key] = value;
    }

    fetch(`http://localhost:800/werkpakket3/app.php/events/${getID}`, {
        method: 'PUT',
        body: JSON.stringify(realData)
    });

    alert("Event successful aangepast");
    window.location.reload(true);

}


function setForm(json) {

    Object.keys(json[0]).forEach(key => {
        var input = document.querySelector(`input[name="${key}"]`);
        input.value = json[0][key];
    });

    var myForm = document.getElementById('addForm');
    var button = document.getElementById('editEvent');

    button.disabled = false;
    button.addEventListener('click', updateOrCreate);
    document.getElementById("newEvent").disabled = true;

    myForm.scrollIntoView(false);

}

function init() {
    var button = document.getElementById('newEvent');
        button.addEventListener('click', function () {
            var myForm = document.getElementById('addForm');
            var formData = new FormData(myForm);
            var realData = {}
            for (var [key, value] of formData.entries()) {
                realData[key] = value;
            }

            fetch(`http://localhost:800/werkpakket3/app.php/events`, {
                method: 'POST',
                body: JSON.stringify(realData)
            });

            alert("Event successful aangemaakt");
            window.location.reload(true);
    });

    var myTable = document.querySelector('table');

    fetch(`http://localhost:800/werkpakket3/app.php/events`).then(function (response) {
        return response.json();
    }).then(function (json) {
        for (var i = 0; i < json.length; i++) {
            var tableItem = document.createElement('tr');
            tableItem.innerHTML += '<td>' + json[i].ID + '</td>';
            tableItem.innerHTML += '<td>' + json[i].naam + '</td>';
            tableItem.innerHTML += '<td>' + json[i].beginDatum + '</td>';
            tableItem.innerHTML += '<td>' + json[i].eindDatum + '</td>';
            tableItem.innerHTML += '<td>' + json[i].bezetting + '</td>';
            tableItem.innerHTML += '<td>' + json[i].kost + '</td>';
            tableItem.innerHTML += '<td>' + json[i].materialen + '</td>';
            tableItem.innerHTML += '<td class="clickable"> Edit </td>';
            tableItem.id = json[i].ID;
            myTable.appendChild(tableItem);

        }


        var rows = document.querySelectorAll('.clickable');
        console.log('hi');
        for (var i = 0; i < rows.length; i++) {
            rows[i].addEventListener('click', function () {
                    var number = this.parentNode.id;
                    fetch(`http://localhost:800/werkpakket3/app.php/events/${number}`).then(function (response) {
                        return response.json();
                    }).then(function (json) {
                        setForm(json);
                    });
                }
            )
        }
    }).catch(function (error) {
        console.log('There has been a problem with your fetch operation: ' + error.message);
    });
}

