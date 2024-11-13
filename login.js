async function handleLogin(event) {
    event.preventDefault(); // Previene l'invio del form

    const form = document.getElementById('loginForm');
    const formData = new FormData(form);

    // Stampa i dati prima di inviarli
    console.log("Dati inviati:", Object.fromEntries(formData.entries()));

    try {
        const response = await fetch('login.php', {
            method: 'POST',
            body: formData
        });
        
        const result = await response.json();
        
        if (result.success) {
            console.log("Login riuscito!");
            window.location.href = 'sitogioco1.html'; // Reindirizza alla pagina se il login è riuscito
        } else {
            console.error("Errore:", result.error);
            document.getElementById("error-message").style.display = "block";
        }
    } catch (error) {
        console.error("Errore:", error);
        document.getElementById("error-message").style.display = "block";
    }
}
