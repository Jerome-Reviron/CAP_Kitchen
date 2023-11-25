/*----------------------------------------------------------------------------------Unité recette-----------------------------------------------------------------------------*/ 

document.addEventListener('DOMContentLoaded', function () {
    // Récupérer l'input Unite_recette
    var uniteRecetteInput = document.querySelector('input[name="Unite_recette"]');
    
    // Récupérer la div d'options
    var optionsValeursDiv = document.getElementById('optionsValeursDiv');

    // Récupérer le bouton de valeurs
    var valeursButton = document.getElementById('valeursButton');

    // Ajouter un écouteur d'événements sur le focus de l'input Unite_recette
    uniteRecetteInput.addEventListener('focus', function () {
        // Afficher la div d'options
        optionsValeursDiv.style.display = 'block';
    });

    // Ajouter un écouteur d'événements sur le bouton de valeurs
    valeursButton.addEventListener('click', function () {
        // Récupérer toutes les cases à cocher cochées
        var checkedCheckboxes = document.querySelectorAll('input[name="Valeurs[]"]:checked');
        
        // Construire une chaîne avec les valeurs des cases à cocher séparées par "/"
        var selectedValues = Array.from(checkedCheckboxes).map(function (checkbox) {
            return checkbox.value;
        }).join("/");

        // Mettre à jour l'input Unite_recette avec les valeurs sélectionnées
        uniteRecetteInput.value = selectedValues;

        // Masquer la div d'options
        optionsValeursDiv.style.display = 'none';
    });

    // Ajouter un écouteur d'événements sur le clic du document
    document.addEventListener('click', function (event) {
        // Vérifier si l'événement de clic provient de la div optionsValeursDiv ou de l'input Unite_recette
        if (!optionsValeursDiv.contains(event.target) && event.target !== uniteRecetteInput) {
            // Masquer la div d'options lorsque l'utilisateur clique en dehors de la div
            optionsValeursDiv.style.display = 'none';
        }
    });
});

/*---------------------------------------------------------------------------Conditionnement achat-----------------------------------------------------------------------------*/ 


document.addEventListener('DOMContentLoaded', function () {
    // Récupérer l'input Conditionnement_achat
    var conditionnementAchatInput = document.querySelector('input[name="Conditionnement_achat"]');
    
    // Récupérer la div d'options
    var optionsConditionnementsDiv = document.getElementById('optionsConditionnementsDiv');

    // Récupérer le bouton de validation pour les conditionnements
    var conditionnementsButton = document.getElementById('conditionnementsButton');

    // Ajouter un écouteur d'événements sur le focus de l'input Conditionnement_achat
    conditionnementAchatInput.addEventListener('focus', function () {
        // Afficher la div d'options
        optionsConditionnementsDiv.style.display = 'block';
    });

    // Ajouter un écouteur d'événements sur le bouton de validation pour les conditionnements
    conditionnementsButton.addEventListener('click', function () {
        // Récupérer le bouton radio sélectionné
        var selectedRadio = document.querySelector('input[name="Conditionnements"]:checked');
        
        // Mettre à jour l'input Conditionnement_achat avec la valeur sélectionnée
        conditionnementAchatInput.value = selectedRadio ? selectedRadio.value : '';

        // Masquer la div d'options
        optionsConditionnementsDiv.style.display = 'none';
    });

    // Ajouter un écouteur d'événements sur le clic du document
    document.addEventListener('click', function (event) {
        // Vérifier si l'événement de clic provient de la div optionsConditionnementsDiv ou de l'input Conditionnement_achat
        if (!optionsConditionnementsDiv.contains(event.target) && event.target !== conditionnementAchatInput) {
            // Masquer la div d'options lorsque l'utilisateur clique en dehors de la div
            optionsConditionnementsDiv.style.display = 'none';
        }
    });
});


/*---------------------------------------------------------------------------Unite achat-----------------------------------------------------------------------------*/ 


document.addEventListener('DOMContentLoaded', function () {
    // Récupérer l'input Unite_achat
    var uniteAchatInput = document.querySelector('input[name="Unite_achat"]');
    
    // Récupérer la div d'options
    var optionsUnitesDiv = document.getElementById('optionsUnitesDiv');

    // Récupérer le bouton de validation pour les Unites
    var unitesButton = document.getElementById('unitesButton');

    // Ajouter un écouteur d'événements sur le focus de l'input Unite_achat
    uniteAchatInput.addEventListener('focus', function () {
        // Afficher la div d'options
        optionsUnitesDiv.style.display = 'block';
    });

    // Ajouter un écouteur d'événements sur le bouton de validation pour les Unites
    unitesButton.addEventListener('click', function () {
        // Récupérer le bouton radio sélectionné
        var selectedRadio = document.querySelector('input[name="Unites"]:checked');
        
        // Mettre à jour l'input Unite_achat avec la valeur sélectionnée
        uniteAchatInput.value = selectedRadio ? selectedRadio.value : '';

        // Masquer la div d'options
        optionsUnitesDiv.style.display = 'none';
    });

    // Ajouter un écouteur d'événements sur le clic du document
    document.addEventListener('click', function (event) {
        // Vérifier si l'événement de clic provient de la div optionsUnitesDiv ou de l'input Unite_achat
        if (!optionsUnitesDiv.contains(event.target) && event.target !== uniteAchatInput) {
            // Masquer la div d'options lorsque l'utilisateur clique en dehors de la div
            optionsUnitesDiv.style.display = 'none';
        }
    });
});





