// Funzione per cambiare il tema
const themeToggleButton = document.getElementById('theme-toggle');
const htmlElement = document.getElementById('html-element');

// Verifica il tema salvato nel localStorage
const savedTheme = localStorage.getItem('theme');
if (savedTheme === 'dark') {
    htmlElement.classList.add('dark-mode');
    themeToggleButton.textContent = 'Modalità Light';  // Cambia il testo del bottone
} else {
    htmlElement.classList.remove('dark-mode');
    themeToggleButton.textContent = 'Modalità Dark';
}

themeToggleButton.addEventListener('click', () => {
    htmlElement.classList.toggle('dark-mode');

    // Salva la preferenza dell'utente nel localStorage
    if (htmlElement.classList.contains('dark-mode')) {
        localStorage.setItem('theme', 'dark');
        themeToggleButton.textContent = 'Modalità Light';
    } else {
        localStorage.setItem('theme', 'light');
        themeToggleButton.textContent = 'Modalità Dark';
    }
});