// vérification des date
const form = document.querySelector('#formulaire_annonce');
const date_start = document.querySelector("#date_start");
const date_end = document.querySelector("#date_end");

form.addEventListener("submit", (event) => {
    event.preventDefault(); //evite l'envoi avant le test
    const now = (new Date()).toDateString(); //recupere la date du jour sans l'heure
    const dateStart = (new Date(date_start.value)).toDateString(); //transforme la valeur du formulaire en date valide
    const dateEnd = (new Date(date_end.value)).toDateString(); 
    const valNow = Date.parse(now);
    const valStart = Date.parse(dateStart);
    const valEnd = Date.parse(dateEnd);

        // on evite un retour vers le passé 😉
        if (valStart < valNow) {
            alert ("Attention la date de début est avant aujourd'hui !");
        } else if (valEnd < valStart) {
            alert ("Attention vous avez mis une date de fin antérieur à celle du début !")
        } else if (date_end.value){  //verifie s'il y a une date de fin, sinon on la fixe avant l'envoi
                form.submit(); // Soumet le formulaire
                } else {
                date_end.value = date_start.value
                form.submit(); // Soumet le formulaire
            }
});