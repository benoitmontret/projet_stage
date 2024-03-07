var userLogin = document.querySelector('#userLogin');
// var groupListe = document.querySelector('#groupListe');




// function saveStorage() {
//     localStorage.setItem('userLogin', )
// }

function changeUser() {
    userLogin.value = groupListe.value;
}

// groupListe.onchange = changeUser();
groupListe.addEventListener("change", (event) => {
    // console.log(userLogin.textContent);
    // console.log(userLogin.innerHTML);
    // console.log(userLogin.innerText);
    console.log(document.getElementById('groupListe').selectedIndex);
    console.log(document.groupListe.selectedIndex);
    // changeUser();

    });