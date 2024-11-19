// script.js

const userForm = document.getElementById('userForm');
const userTableBody = document.querySelector('#userTable tbody');
const formTitle = document.getElementById('formTitle');

let users = [];

// Charger les utilisateurs initiaux
function loadUsers() {
    users.forEach(user => addRow(user));
}

// Ajouter ou modifier un utilisateur
userForm.addEventListener('submit', (e) => {
    e.preventDefault();
    
    const id = document.getElementById('userId').value;
    const nom = document.getElementById('nom').value;
    const prenom = document.getElementById('prenom').value;
    const email = document.getElementById('email').value;
    const role = document.getElementById('role').value;
    const specialite = document.getElementById('specialite').value;
    const date_creation = document.getElementById('date_creation').value;

    if (id) {
        const user = users.find(u => u.id == id);
        user.nom = nom;
        user.prenom = prenom;
        user.email = email;
        user.role = role;
        user.specialite = specialite;
        user.date_creation = date_creation;

        updateRow(user);
    } else {
        const newUser = {
            id: Date.now().toString(),
            nom,
            prenom,
            email,
            role,
            specialite,
            date_creation
        };

        users.push(newUser);
        addRow(newUser);
    }

    userForm.reset();
    formTitle.textContent = 'Ajouter un Utilisateur';
});

// Ajouter une ligne au tableau
function addRow(user) {
    const row = document.createElement('tr');
    row.innerHTML = `
        <td>${user.id}</td>
        <td>${user.nom}</td>
        <td>${user.prenom}</td>
        <td>${user.email}</td>
        <td>${user.role}</td>
        <td>${user.specialite}</td>
        <td>${user.date_creation}</td>
        <td>
            <button class="edit" onclick="editUser('${user.id}')">Modifier</button>
            <button class="delete" onclick="deleteUser('${user.id}')">Supprimer</button>
        </td>
    `;
    userTableBody.appendChild(row);
}

// Mettre à jour une ligne existante
function updateRow(user) {
    const row = [...userTableBody.children].find(row => row.children[0].textContent == user.id);
    row.children[1].textContent = user.nom;
    row.children[2].textContent = user.prenom;
    row.children[3].textContent = user.email;
    row.children[4].textContent = user.role;
    row.children[5].textContent = user.specialite;
    row.children[6].textContent = user.date_creation;
}

// Modifier un utilisateur
function editUser(id) {
    formTitle.textContent = 'Modifier un Utilisateur';
    const user = users.find(u => u.id == id);
    document.getElementById('userId').value = user.id;
    document.getElementById('nom').value = user.nom;
    document.getElementById('prenom').value = user.prenom;
    document.getElementById('email').value = user.email;
    document.getElementById('role').value = user.role;
    document.getElementById('specialite').value = user.specialite;
    document.getElementById('date_creation').value = user.date_creation;
}

// Supprimer un utilisateur
function deleteUser(id) {
    if (confirm("Voulez-vous vraiment supprimer cet utilisateur ?")) {
        users = users.filter(u => u.id != id);
        const row = [...userTableBody.children].find(row => row.children[0].textContent == id);
        row.remove();
    }
}

// Charger les utilisateurs au démarrage
document.addEventListener('DOMContentLoaded', loadUsers);
