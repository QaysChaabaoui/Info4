<footer>
    <p>&copy; 2025 FC Burger Dreux</p>
</footer>
<script>
    const themeBtn = document.getElementById('theme-toggle');
    const body = document.body;

    // 1. Fonction pour lire un cookie (vu en cours)
    function getCookie(name) {
        let value = "; " + document.cookie;
        let parts = value.split("; " + name + "=");
        if (parts.length == 2) return parts.pop().split(";").shift();
    }

    // 2. Vérification automatique au chargement (Exigence Prof)
    const savedTheme = getCookie("theme_pref");
    if (savedTheme === "dark") {
        body.classList.add('dark-theme');
        themeBtn.innerText = "☀️";
    }

    // 3. Gestion du clic pour changer de mode sans recharger la page
    themeBtn.addEventListener('click', () => {
        body.classList.toggle('dark-theme');

        let theme = "light";
        if (body.classList.contains('dark-theme')) {
            theme = "dark";
            themeBtn.innerText = "☀️";
        } else {
            themeBtn.innerText = "🌙";
        }

        // 4. Sauvegarde dans un cookie pour 30 jours
        document.cookie = "theme_pref=" + theme + "; max-age=" + (30 * 24 * 60 * 60) + "; path=/";
    });
</script>

<script>
    const passwordInput = document.getElementById('password');
    const togglePassword = document.getElementById('togglePassword');
    const charCounter = document.getElementById('char-counter');

    if (passwordInput) {
        // 1. Fonction 'œil' : Afficher/Cacher le mot de passe
        togglePassword.addEventListener('click', function () {
            // On bascule entre le type 'password' et 'text'
            const type = passwordInput.getAttribute('type') === 'password' ? 'text' : 'password';
            passwordInput.setAttribute('type', type);
            // On change l'icône
            this.textContent = type === 'password' ? '👁️' : '🙈';
        });

        // 2. Compteur de caractères en temps réel (Consigne Phase 3)
        passwordInput.addEventListener('input', function () {
            const length = this.value.length;
            charCounter.textContent = length + " / 20 caractères";

            // Alerte visuelle si on dépasse la limite
            if (length > 20) {
                charCounter.style.color = "red";
            } else {
                charCounter.style.color = "#666";
            }
        });
    }

    // 3. Validation du formulaire avant l'envoi (Zéro rechargement si erreur)
    const form = document.querySelector('form[action="traitement_inscription.php"]');
    if (form) {
        form.addEventListener('submit', function (event) {
            const email = document.querySelector('input[name="login"]').value;
            const pass = passwordInput.value;

            // Vérification du format email (Regex simple)
            const emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;

            if (!emailRegex.test(email)) {
                event.preventDefault(); // On bloque l'envoi vers le serveur
                alert("⚠️ Format d'email invalide !");
            } else if (pass.length < 6) {
                event.preventDefault(); // On bloque l'envoi
                alert("⚠️ Le mot de passe doit faire au moins 6 caractères !");
            }
            // Si tout est bon, le formulaire part normalement vers traitement_inscription.php
        });
    }
</script>
</body>

</html>
