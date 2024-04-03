// Écouter les messages postés par le script du panneau d'administration
window.addEventListener("message", function (event) {
  // Vérifier si le message contient une couleur
  if (event.data && typeof event.data === "string") {
    // Appliquer la couleur reçue au fond du corps
    document.body.style.backgroundColor = event.data;
  }
});
