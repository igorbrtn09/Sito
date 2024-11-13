async function handleRegistration(event) {
    event.preventDefault(); // Previene l'invio del form

    const form = document.getElementById('registerForm');
    const formData = new FormData(form);

    try {
        const response = await fetch('register.php', {
            method: 'POST',
            body: formData
        });

        const result = await response.json();

        if (result.success) {
            // Successo, mostra il messaggio e reindirizza
            document.getElementById("success-message").style.display = "block";
            setTimeout(() => {
                window.location.href = 'accesso.html'; // Reindirizza alla pagina di login
            }, 2000);
        } else {
            // Errore, mostra il messaggio di errore
            document.getElementById("error-message").textContent = result.error;
            document.getElementById("error-message").style.display = "block";
        }
    } catch (error) {
        console.error("Errore:", error);
        document.getElementById("error-message").style.display = "block";
    }
}
