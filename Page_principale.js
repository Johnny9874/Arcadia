let currentIndex = 0;

function moveSlide(direction) {
    const slides = document.querySelector('.carousel-slide');
    const totalSlides = slides.children.length;

    // Mise à jour de l'index actuel
    currentIndex = (currentIndex + direction + totalSlides) % totalSlides;

    // Calculer le pourcentage de translation
    const offset = -(currentIndex * 100 / totalSlides);
    
    // Appliquer la translation
    slides.style.transform = 'translateX(' + offset + '%)';
}
