const transactionForm = document.getElementById('transactionForm');
const transactionTableBody = document.querySelector('#transactionTable tbody');
const formTitle = document.getElementById('formTitle');

// Charger les transactions simulées
function loadTransactions() {
    const transactions = [
        { id: 1, id_commande: 1001, id_admin: 501, montant_total: 200, part_entreprise: 80, part_professor: 120, date_transaction: '2024-11-17', statut_transaction: 'complété', methode_paiement: 'Carte Bancaire' },
        { id: 2, id_commande: 1002, id_admin: 502, montant_total: 300, part_entreprise: 120, part_professor: 180, date_transaction: '2024-11-16', statut_transaction: 'en attente', methode_paiement: 'PayPal' }
    ];
    transactions.forEach((transaction) => addTransactionRow(transaction));
}

// Ajouter une ligne dans le tableau
function addTransactionRow(transaction) {
    const row = document.createElement('tr');
    row.innerHTML = `
        <td>${transaction.id}</td>
        <td>${transaction.id_commande}</td>
        <td>${transaction.id_admin}</td>
        <td>${transaction.montant_total} €</td>
        <td>${transaction.part_entreprise} €</td>
        <td>${transaction.part_professor} €</td>
        <td>${transaction.date_transaction}</td>
        <td>${transaction.statut_transaction}</td>
        <td>${transaction.methode_paiement}</td>
        <td class="actions">
            <button class="edit" onclick="editTransaction(${transaction.id})">Modifier</button>
            <button class="delete" onclick="deleteTransaction(${transaction.id})">Supprimer</button>
        </td>
    `;
    transactionTableBody.appendChild(row);
}

// Soumettre le formulaire
transactionForm.addEventListener('submit', (e) => {
    e.preventDefault();

    const id = document.getElementById('transactionId').value;
    const id_commande = document.getElementById('id_commande').value;
    const id_admin = document.getElementById('id_admin').value;
    const montant_total = document.getElementById('montant_total').value;
    const part_entreprise = document.getElementById('part_entreprise').value;
    const part_professor = document.getElementById('part_professor').value;
    const date_transaction = document.getElementById('date_transaction').value;
    const statut_transaction = document.getElementById('statut_transaction').value;
    const methode_paiement = document.getElementById('methode_paiement').value;

    if (id) {
        // Modification
        updateTransaction({ id, id_commande, id_admin, montant_total, part_entreprise, part_professor, date_transaction, statut_transaction, methode_paiement });
    } else {
        // Ajout
        const newTransaction = {
            id: Date.now(),
            id_commande,
            id_admin,
            montant_total,
            part_entreprise,
            part_professor,
            date_transaction,
            statut_transaction,
            methode_paiement
        };
        addTransactionRow(newTransaction);
    }

    transactionForm.reset();
    formTitle.textContent = 'Ajouter une Transaction';
});

// Modifier une transaction
function editTransaction(id) {
    formTitle.textContent = 'Modifier une Transaction';
    const row = [...transactionTableBody.children].find(row => row.children[0].textContent == id);
    document.getElementById('transactionId').value = row.children[0].textContent;
    document.getElementById('id_commande').value = row.children[1].textContent;
    document.getElementById('id_admin').value = row.children[2].textContent;
    document.getElementById('montant_total').value = row.children[3].textContent.split(' ')[0];
    document.getElementById('part_entreprise').value = row.children[4].textContent.split(' ')[0];
    document.getElementById('part_professor').value = row.children[5].textContent.split(' ')[0];
    document.getElementById('date_transaction').value = row.children[6].textContent;
    document.getElementById('statut_transaction').value = row.children[7].textContent;
    document.getElementById('methode_paiement').value = row.children[8].textContent;
}

// Supprimer une transaction
function deleteTransaction(id) {
    if (confirm("Voulez-vous vraiment supprimer cette transaction ?")) {
        const row = [...transactionTableBody.children].find(row => row.children[0].textContent == id);
        row.remove();
    }
}

// Charger les transactions au démarrage
document.addEventListener('DOMContentLoaded', loadTransactions);
