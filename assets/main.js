var userLogin = document.querySelector('#userLogin');

changeUserGroup();


function maj() {
    changeUserGroup();
    document.querySelector("#groupForm").submit()
}

function changeUserGroup() {
    //les espaces et accent sont transformés dans le cookie, decode uri component permet de retrouver quelchose de lisible
    var nomFr = decodeURIComponent(getCookie('userGroup'));
    document.querySelector('#userGroup').innerText = nomFr;
}
function selectGroup() {
    var select = document.querySelector("#groupListe");
    var valeur = select.options[select.selectedIndex].value;
    return valeur;
}

// function getGroup() {
//     return localStorage.getItem('userGroup');
// }

function getCookie(cookieName) {
    let cookies = document.cookie.split(';');
    for (let cookie of cookies) {
        let [name, value] = cookie.split('=');
        if (name.trim() === cookieName) {
        return value;
        }
    }
    return null;
}
