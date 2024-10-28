// script.js
function showLoginForm() {
    const userType = document.getElementById("user-type").value;
    const loginForm = document.getElementById("login-form");

    let formHtml = '';

    if (userType === 'visitor') {
        formHtml = `
            <label for="username">Nom d'utilisateur :</label>
            <input type="text" id="username" name="username" required>
            <label for="password">Mot de passe :</label>
            <input type="password" id="password" name="password" required>
            <button onclick="login('visitor')">Se connecter</button>
        `;
    } else if (userType === 'admin') {
        formHtml = `
            <label for="admin-username">Nom d'utilisateur Admin :</label>
            <input type="text" id="admin-username" required>
            <label for="admin-password">Mot de passe Admin :</label>
            <input type="password" id="admin-password" required>
            <button onclick="login('admin')">Se connecter en tant qu'Admin</button>
        `;
    } else if (userType === 'employee') {
        formHtml = `
            <label for="employee-username">Nom d'utilisateur Employé :</label>
            <input type="text" id="employee-username" required>
            <label for="employee-password">Mot de passe Employé :</label>
            <input type="password" id="employee-password" required>
            <button onclick="login('employee')">Se connecter en tant qu'Employé</button>
        `;
    }

    loginForm.innerHTML = formHtml;
}

function login(userType) {
    let username, password;

    if (userType === 'admin') {
        username = document.getElementById("admin-username").value;
        password = document.getElementById("admin-password").value;
    } else if (userType === 'visitor') {
        username = document.getElementById("username").value;
        password = document.getElementById("password").value;
    } else if (userType === 'employee') {
        username = document.getElementById("employee-username").value;
        password = document.getElementById("employee-password").value;
    }

    // Ici, tu dois appeler l'API pour vérifier les identifiants
    fetch('/login', {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json',
        },
        body: JSON.stringify({ username, password, userType }),
    })
    .then(response => response.json())
    .then(data => {
        if (data.success) {
            if (userType === 'admin') {
                window.location.href = 'admin.html'; // Redirection vers la page Admin
            } else {
                // Redirection vers la page de l'utilisateur ou de l'employé
                window.location.href = `${userType}.html`;
            }
        } else {
            alert(data.message); // Afficher un message d'erreur
        }
    })
    .catch(error => console.error('Erreur:', error));
}

// Afficher le formulaire par défaut
document.addEventListener('DOMContentLoaded', showLoginForm);
