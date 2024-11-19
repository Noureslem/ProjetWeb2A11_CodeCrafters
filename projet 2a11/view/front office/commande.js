// script.js

const commandeForm = document.getElementById('commandeForm');
const commandeTableBody = document.querySelector('#commandeTable tbody');
const formTitle = document.getElementById('formTitle');

let commandes = [];

// Charger les commandes initiales
function loadCommandes() {
    commandes.forEach(commande => addRow(commande));
}

// Ajouter ou modifier une commande
commandeForm.addEventListener('submit', (e) => {
    e.preventDefault();
    
    const id = document.getElementById('commandeId').value;
    const cour_id = document.getElementById('cour_id').value;
    const etudiant_id = document.getElementById('etudiant_id').value;
    const statut = document.getElementById('statut').value;
    const date_commande = document.getElementById('date_commande').value;

    if (id) {
        const commande = commandes.find(c => c.id == id);
        commande.cour_id = cour_id;
        commande.etudiant_id = etudiant_id;
        commande.statut = statut;
        commande.date_commande = date_commande;

        updateRow(commande);
    } else {
        const newCommande = {
            id: Date.now().toString(),
            cour_id,
            etudiant_id,
            statut,
            date_commande
        };

        commandes.push(newCommande);
        addRow(newCommande);
    }

    commandeForm.reset();
    formTitle.textContent = 'Ajouter une Commande';
});

// Ajouter une ligne au tableau
function addRow(commande) {
    const row = document.createElement('tr');
    row.innerHTML = `
        <td>${commande.id}</td>
        <td>${commande.cour_id}</td>
        <td>${commande.etudiant_id}</td>
        <td>${commande.statut}</td>
        <td>${commande.date_commande}</td>
        <td>
            <button class="edit" onclick="editCommande('${commande.id}')">Modifier</button>
            <button class="delete" onclick="deleteCommande('${commande.id}')">Supprimer</button>
        </td>
    `;
    commandeTableBody.appendChild(row);
}

// Mettre à jour une ligne existante
function updateRow(commande) {
    const row = [...commandeTableBody.children].find(row => row.children[0].textContent == commande.id);
    row.children[1].textContent = commande.cour_id;
    row.children[2].textContent = commande.etudiant_id;
    row.children[3].textContent = commande.statut;
    row.children[4].textContent = commande.date_commande;
}

// Modifier une commande
function editCommande(id) {
    formTitle.textContent = 'Modifier une Commande';
    const commande = commandes.find(c => c.id == id);
    document.getElementById('commandeId').value = commande.id;
    document.getElementById('cour_id').value = commande.cour_id;
    document.getElementById('etudiant_id').value = commande.etudiant_id;
    document.getElementById('statut').value = commande.statut;
    document.getElementById('date_commande').value = commande.date_commande;
}

// Supprimer une commande
function deleteCommande(id) {
    if (confirm("Voulez-vous vraiment supprimer cette commande ?")) {
        commandes = commandes.filter(c => c.id != id);
        const row = [...commandeTableBody.children].find(row => row.children[0].textContent == id);
        row.remove();
    }
}

// Charger les commandes au démarrage
document.addEventListener('DOMContentLoaded', loadCommandes);
