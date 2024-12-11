const works = [
    { id: 1, title: "Les Demoiselles d'Avignon", image: "images/Les-Demoiselles-d-Avignon.jpg", link: "https://fr.wikipedia.org/wiki/Les_Demoiselles_d%27Avignon" },
    { id: 2, title: "Guernica", image: "images/Guernica.jpg", link: "https://fr.wikipedia.org/wiki/Guernica_(Picasso)" },
    { id: 3, title: "Jeune fille devant un miroir", image: "images/Jeune-fille-devant-un-miroir.jpg", link: "https://en.wikipedia.org/wiki/Girl_before_a_Mirror#:~:text=Girl%20before%20a%20Mirror%20(French,mirror%20looking%20at%20her%20reflection." },
    { id: 4, title: "Femme asise", image: "images/Femme-asise.jpeg", link: "https://fr.wikipedia.org/wiki/Femme_assise_dans_un_fauteuil_(Picasso,_Paris)" },
    { id: 5, title: "Le Vieux Guitariste aveugle", image: "images/Le-vieux-guitariste-aveugle.jpg", link: "https://fr.wikipedia.org/wiki/Le_Vieux_Guitariste_aveugle" },
    { id: 6, title: "La Femme qui pleure", image: "images/La-femme-qui-pleure.jpeg", link: "https://fr.wikipedia.org/wiki/La_Femme_qui_pleure" },
    { id: 7, title: "Le Rêve", image: "images/Le-reve.jpg", link: "https://fr.wikipedia.org/wiki/Le_R%C3%AAve_(Picasso)" },
    { id: 8, title: "Le Baiser", image: "images/Le-Baiser.jpg", link: "https://www.museepicassoparis.fr/fr/le-baiser-1969" },
    { id: 9, title: "Nude in red armchair", image: "images/Nude-in-red-armchair.jpg", link: "https://en.wikipedia.org/wiki/Woman_in_a_Red_Armchair" },
];

// Fonction pour mélanger un tableau
function shuffle(array) {
    for (let i = array.length - 1; i > 0; i--) {
        const j = Math.floor(Math.random() * (i + 1));
        [array[i], array[j]] = [array[j], array[i]];
    }
    return array;
}

document.addEventListener('DOMContentLoaded', function () {
    const container = document.getElementById('oeuvres-container');

    // Mélanger les œuvres
    const shuffledWorks = shuffle(works);

    // Insérer les œuvres dans l'ordre aléatoire
    shuffledWorks.forEach(work => {
        const col = document.createElement('div');
        col.className = 'col';
        col.innerHTML = `
            <div class="card h-100">
                <img src="${work.image}" class="card-img-top" alt="${work.title}">
                <div class="card-body">
                    <h5 class="card-title">${work.title}</h5>
                    <a href="${work.link}" class="btn btn-primary" target="_blank" rel="noopener noreferrer">
                        En savoir plus
                    </a>
                </div>
            </div>
        `;
        container.appendChild(col);
    });
});
