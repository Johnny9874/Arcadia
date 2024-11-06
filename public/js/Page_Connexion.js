function showLoginForm() {
    const userType = document.getElementById("user-type").value;
    const loginForm = document.getElementById("login-form");

    let formHtml = '';

    if (userType === 'visitor') {
        formHtml = `
            <form id="visitor-form">
                <label for="username">Nom d'utilisateur :</label>
                <input type="text" id="username" name="username" required>
                <label for="password">Mot de passe :</label>
                <input type="password" id="password" name="password" required>
                <button type="button" onclick="login('visitor')">Se connecter</button>
            </form>
        `;
    } else if (userType === 'admin') { // Utiliser 'admin' en minuscules
        formHtml = `
            <form id="admin-form"> 
                <label for="admin-username">Nom d'utilisateur Admin :</label>
                <input type="text" id="admin-username" required>
                <label for="admin-password">Mot de passe Admin :</label>
                <input type="password" id="admin-password" required>
                <button type="button" onclick="login('admin')">Se connecter en tant qu'Admin</button>
            </form>
        `;
    } else if (userType === 'employee') {
        formHtml = `
            <form id="employee-form">
                <label for="employee-username">Nom d'utilisateur Employé :</label>
                <input type="text" id="employee-username" required>
                <label for="employee-password">Mot de passe Employé :</label>
                <input type="password" id="employee-password" required>
                <button type="button" onclick="login('employee')">Se connecter en tant qu'Employé</button>
            </form>
        `;
    }

    loginForm.innerHTML = formHtml;
}



// Appel initial pour afficher le bon formulaire par défaut
document.addEventListener('DOMContentLoaded', showLoginForm);


function login(userType) {
    let username, password;

    // Récupération des données du formulaire selon le type d'utilisateur
    if (userType === 'admin') {
        username = document.getElementById("admin-username").value; // ID du champ admin
        password = document.getElementById("admin-password").value; // ID du champ admin
    } else if (userType === 'visitor') {
        username = document.getElementById("username").value;
        password = document.getElementById("password").value;
    } else if (userType === 'employee') {
        username = document.getElementById("employee-username").value;
        password = document.getElementById("employee-password").value;
    }

    console.log('Data being sent:', { username, password, userType }); // Pour le debug

    // Envoi de la requête POST avec JSON.stringify() et en-têtes appropriés
    fetch('http://localhost/Arcadia/public/php/login.php', {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json'  // Indique que les données envoyées sont en JSON
        },
        body: JSON.stringify({
            username: username,  // Utilisation des valeurs dynamiques
            password: password,
            userType: userType,  // Le type d'utilisateur (admin, employé, visiteur)
        })
    })
    .then(response => response.json())
    .then(data => {
        console.log(data);
        // Traitez la réponse ici
    })
    .catch(error => console.error('Erreur:', error));
}
