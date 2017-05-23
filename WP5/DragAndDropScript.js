function allowDrop(ev) {
    ev.preventDefault();
}

function drag(ev) {
    ev.dataTransfer.setData("textBeingDragged", ev.target.id);
}

function drop(ev) {
    ev.preventDefault();
    var dataToReceive = ev.dataTransfer.getData("textBeingDragged");
    ev.target.appendChild(document.getElementById(dataToReceive));
}