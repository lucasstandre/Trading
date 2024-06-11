document.addEventListener('DOMContentLoaded', function() {
    fetchTransactions();

    document.getElementById('transactionForm').addEventListener('submit', function(event) {
        event.preventDefault();
        const type = document.getElementById('type').value;
        const amount = document.getElementById('amount').value;
        addTransaction(type, amount);
    });

    document.getElementById('clearCache').addEventListener('click', function() {
        clearTransactions();
    });
});

function fetchTransactions() {
    fetch('get_transactions.php')
        .then(response => response.json())
        .then(data => {
            renderTransactions(data);
        })
        .catch(error => console.error('Error fetching transactions:', error));
}

function addTransaction(type, amount) {
    fetch('add_transaction.php', {
        method: 'POST',
        headers: {
            'Content-Type': 'application/x-www-form-urlencoded',
        },
        body: `type=${type}&amount=${amount}`
    })
    .then(response => response.text())
    .then(message => {
        console.log(message);
        fetchTransactions();
    })
    .catch(error => console.error('Error adding transaction:', error));
}

function renderTransactions(transactions) {
    const transactionList = document.getElementById('transactionList');
    transactionList.innerHTML = '';
    transactions.forEach(transaction => {
        const li = document.createElement('li');
        li.textContent = `${transaction.type}: $${transaction.amount}`;
        transactionList.appendChild(li);
    });
}

function clearTransactions() {
    // Implement clearing transactions logic if needed
}
