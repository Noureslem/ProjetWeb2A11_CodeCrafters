// Variables globales
const coursForm = document.getElementById('coursForm');
const coursTableBody = document.querySelector('#coursTable tbody');
const formTitle = document.getElementById('formTitle');

// Charger les cours existants
function loadCours() {
    // Exemple de données simulées
    const cours = [
        { id: 1, professor_id: 101, types_cours: "Mathématiques", description: "Cours avancé", niveau: "Intermédiaire", prix: 150, langue: "Français", duree: 20, date_creation: "2024-11-18" },
        { id: 2, professor_id: 102, types_cours: "Informatique", description: "Introduction à Python", niveau: "Débutant", prix: 100, langue: "Anglais", duree: 10, date_creation: "2024-10-10" }
    ];

    coursTableBody.innerHTML = '';
    cours.forEach((c) => addRowToTable(c));
}

// Ajouter une ligne dans le tableau
function addRowToTable(cours) {
    const row = document.createElement('tr');
    row.innerHTML = `
        <td>${cours.id}</td>
        <td>${cours.professor_id}</td>
        <td>${cours.types_cours}</td>
        <td>${cours.description}</td>
        <td>${cours.niveau}</td>
        <td>${cours.prix} €</td>
        <td>${cours.langue}</td>
        <td>${cours.duree} heures</td>
        <td>${cours.date_creation}</td>
        <td class="actions">
            <button onclick="editCours(${cours.id})">Modifier</button>
            <button class="delete" onclick="deleteCours(${cours.id})">Supprimer</button>
        </td>
    `;
    coursTableBody.appendChild(row);
}

// Ajouter ou modifier un cours
coursForm.addEventListener('submit', (e) => {
    e.preventDefault();

    const id = document.getElementById('coursId').value;
    const professor_id = document.getElementById('professor_id').value;
    const types_cours = document.getElementById('types_cours').value;
    const description = document.getElementById('description').value;
    const niveau = document.getElementById('niveau').value;
    const prix = document.getElementById('prix').value;
    const langue = document.getElementById('langue').value;
    const duree = document.getElementById('duree').value;
    const date_creation = document.getElementById('date_creation').value;

    if (id) {
        // Modifier un cours existant
        updateCours({ id, professor_id, types_cours, description, niveau, prix, langue, duree, date_creation });
    } else {
        // Ajouter un nouveau cours
        addRowToTable({ id: Date.now(), professor_id, types_cours, description, niveau, prix, langue, duree, date_creation });
    }

    coursForm.reset();
    formTitle.textContent = "Ajouter un Cours";
});

// Modifier un cours
function editCours(id) {
    formTitle.textContent = "Modifier un Cours";
    const row = document.querySelector(`#coursTable tbody tr:nth-child(${id})`);
    document.getElementById('coursId').value = id;
    document.getElementById('professor_id').value = row.children[1].textContent;
    document.getElementById('types_cours').value = row.children[2].textContent;
    document.getElementById('description').value = row.children[3].textContent;
    document.getElementById('niveau').value = row.children[4].textContent;
    document.getElementById('prix').value = row.children[5].textContent.split(' ')[0];
    document.getElementById('langue').value = row.children[6].textContent;
    document.getElementById('duree').value = row.children[7].textContent.split(' ')[0];
    document.getElementById('date_creation').value = row.children[8].textContent;
}

// Supprimer un cours
function deleteCours(id) {
    if (confirm("Voulez-vous vraiment supprimer ce cours ?")) {
        const row = document.querySelector(`#coursTable tr td:first-child:contains("${id}")`).parentElement;
        row.remove();
    }
}

// Charger les cours à l'initialisation
document.addEventListener('DOMContentLoaded', loadCours);
