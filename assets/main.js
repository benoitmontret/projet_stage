var userLogin = document.querySelector('#userLogin');

// localStorage.removeItem('userGroup')
console.log(localStorage.getItem('userGroup'))


if (!localStorage.getItem('userGroup')) {
    localStorage.setItem('userGroup', 'Acceuil');
}
changeUserGroup();
// document.getElementById("formulaireLocalStorage").submit();
console.log(localStorage.getItem('userGroup'))


function maj() {
    saveStorage();
    changeUserGroup();
    document.getElementById("formulaireLocalStorage").submit();
}

function saveStorage() {
    localStorage.setItem('userGroup', selectGroup());
    localStorage.setItem("valeur", "valeurDeLocalStorage");
    document.getElementById("valeurLocalStorage").value = localStorage.getItem("userGroup");
}
function changeUserGroup() {
    document.querySelector('#userGroup').innerText = getGroup();
}
function selectGroup() {
    var select = document.querySelector("#groupListe");
    var valeur = select.options[select.selectedIndex].value;
    return valeur;
}
function getGroup() {
    return localStorage.getItem('userGroup');
}