document.addEventListener("DOMContentLoaded", function () {
    // Récupérer les éléments des cases à cocher de la civilité
    var monsieurCheckbox = document.getElementById("monsieur");
    var madameCheckbox = document.getElementById("madame");

    // Ajouter un écouteur d'événement de changement à monsieurCheckbox
    monsieurCheckbox.addEventListener("change", function () {
        // Si monsieur est coché, décocher madame
        if (monsieurCheckbox.checked) {
            madameCheckbox.checked = false;
        }
    });

    // Ajouter un écouteur d'événement de changement à madameCheckbox
    madameCheckbox.addEventListener("change", function () {
        // Si madame est coché, décocher monsieur
        if (madameCheckbox.checked) {
            monsieurCheckbox.checked = false;
        }
    });
});