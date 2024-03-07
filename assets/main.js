var userLogin = document.querySelector('#userLogin');

// localStorage.removeItem('userGroup')
console.log(localStorage.getItem('userGroup'))

//   localStorage.getItem('userGroup')


if (!localStorage.getItem('userGroup')) {
    localStorage.setItem('userGroup', 'Acceuil');
    
}
console.log(localStorage.getItem('userGroup'))


function maj() {
    changeUserGroup();
    saveStorage();
}

function saveStorage() {
    localStorage.setItem('userGroup', selectGroup())
}
function changeUserGroup() {
    document.querySelector('#userGroup').innerText = selectGroup();
}
function selectGroup() {
    var select = document.querySelector("#groupListe");
    var valeur = select.options[select.selectedIndex].value;
    return valeur;
}
function getGroup() {
    return localStorage.getItem('userGroup');
}