// Sélectionner les éléments du carrousel et les boutons
let index = 0;
const items = document.querySelectorAll('.carousel-item');
const prevButton = document.querySelector('#prev');
const nextButton = document.querySelector('#next');

// Fonction pour afficher l'élément actuel du carrousel
function showItem(i) {
    items.forEach((item, idx) => {
        // Si l'index correspond, on montre l'item, sinon on le cache
        if (idx === i) {
            item.classList.add('active'); // Afficher l'élément actuel
        } else {
            item.classList.remove('active'); // Cacher les autres éléments
        }
    });
}

// Événement bouton "Précédent"
prevButton.addEventListener('click', () => {
    index = (index === 0) ? items.length - 1 : index - 1;
    showItem(index);
});

// Événement bouton "Suivant"
nextButton.addEventListener('click', () => {
    index = (index === items.length - 1) ? 0 : index + 1;
    showItem(index);
});

// Initialisation du premier élément actif
showItem(index);