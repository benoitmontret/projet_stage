var userLogin = document.querySelector('#userLogin');
var grpList = document.querySelector("#groupListe");

changeUserGroup();

function maj() {
    changeUserGroup();
    document.querySelector("#groupForm").submit()

}
function changeUserGroup() {
    //les espaces et accent sont transformés dans le cookie, decodeURIcomponent permet de retrouver quelchose de lisible
    var nomFr = decodeURIComponent(getCookie('userGroup'));
    document.querySelector('#userGroup').innerText = nomFr;
}
function selectGroup() {
    var valeur = grpList.options[grpList.selectedIndex].value;
    return valeur;
}
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
