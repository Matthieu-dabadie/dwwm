document.addEventListener("DOMContentLoaded", function () {
  // Sélectionner toutes les alertes
  const alerts = document.querySelectorAll(".alert");

  // Masquer chaque alerte après 3 secondes
  alerts.forEach(function (alert) {
    setTimeout(function () {
      alert.style.display = "none";
    }, 3000);
  });
});
