/*----------------------------------------------------------------------------------Unité recette-----------------------------------------------------------------------------*/ 

document.addEventListener('DOMContentLoaded', function () {
    // Récupérer l'input Unite_recette
    var uniteRecetteInput = document.querySelector('input[name="Unite_recette"]');
    
    // Récupérer la div d'options
    var optionsUnite_recettesDiv = document.getElementById('optionsUnite_recettesDiv');

    // Récupérer le bouton de Unite_recettes
    var Unite_recettesButton = document.getElementById('Unite_recettesButton');

    // Ajouter un écouteur d'événements sur le focus de l'input Unite_recette
    uniteRecetteInput.addEventListener('focus', function () {
        // Afficher la div d'options
        optionsUnite_recettesDiv.style.display = 'block';
    });

    // Ajouter un écouteur d'événements sur le bouton de Unite_recettes
    Unite_recettesButton.addEventListener('click', function () {
        // Récupérer toutes les cases à cocher cochées
        var checkedCheckboxes = document.querySelectorAll('input[name="Unite_recettes[]"]:checked');
        
        // Construire une chaîne avec les Unite_recettes des cases à cocher séparées par "/"
        var selectedValues = Array.from(checkedCheckboxes).map(function (checkbox) {
            return checkbox.value;
        }).join(" / ");

        // Mettre à jour l'input Unite_recette avec les Unite_recettes sélectionnées
        uniteRecetteInput.value = selectedValues;

        // Masquer la div d'options
        optionsUnite_recettesDiv.style.display = 'none';
    });

    // Ajouter un écouteur d'événements sur le clic du document
    document.addEventListener('click', function (event) {
        // Vérifier si l'événement de clic provient de la div optionsUnite_recettesDiv ou de l'input Unite_recette
        if (!optionsUnite_recettesDiv.contains(event.target) && event.target !== uniteRecetteInput) {
            // Masquer la div d'options lorsque l'utilisateur clique en dehors de la div
            optionsUnite_recettesDiv.style.display = 'none';
        }
    });
});

/*---------------------------------------------------------------------------Conditionnement achat-----------------------------------------------------------------------------*/ 


document.addEventListener('DOMContentLoaded', function () {
    // Récupérer l'input Conditionnement_achat
    var conditionnementAchatInput = document.querySelector('input[name="Conditionnement_achat"]');
    
    // Récupérer la div d'options
    var optionsConditionnement_achatsDiv = document.getElementById('optionsConditionnement_achatsDiv');

    // Récupérer le bouton de validation pour les Conditionnement_achats
    var Conditionnement_achatsButton = document.getElementById('Conditionnement_achatsButton');

    // Ajouter un écouteur d'événements sur le focus de l'input Conditionnement_achat
    conditionnementAchatInput.addEventListener('focus', function () {
        // Afficher la div d'options
        optionsConditionnement_achatsDiv.style.display = 'block';
    });

    // Ajouter un écouteur d'événements sur le bouton de validation pour les Conditionnement_achats
    Conditionnement_achatsButton.addEventListener('click', function () {
        // Récupérer le bouton radio sélectionné
        var selectedRadio = document.querySelector('input[name="Conditionnement_achats"]:checked');
        
        // Mettre à jour l'input Conditionnement_achat avec la valeur sélectionnée
        conditionnementAchatInput.value = selectedRadio ? selectedRadio.value : '';

        // Masquer la div d'options
        optionsConditionnement_achatsDiv.style.display = 'none';
    });

    // Ajouter un écouteur d'événements sur le clic du document
    document.addEventListener('click', function (event) {
        // Vérifier si l'événement de clic provient de la div optionsConditionnement_achatsDiv ou de l'input Conditionnement_achat
        if (!optionsConditionnement_achatsDiv.contains(event.target) && event.target !== conditionnementAchatInput) {
            // Masquer la div d'options lorsque l'utilisateur clique en dehors de la div
            optionsConditionnement_achatsDiv.style.display = 'none';
        }
    });
});


/*---------------------------------------------------------------------------Unite achat-----------------------------------------------------------------------------*/ 


document.addEventListener('DOMContentLoaded', function () {
    // Récupérer l'input Unite_achat
    var uniteAchatInput = document.querySelector('input[name="Unite_achat"]');
    
    // Récupérer la div d'options
    var optionsUnite_achatsDiv = document.getElementById('optionsUnite_achatsDiv');

    // Récupérer le bouton de validation pour les Unite_achats
    var Unite_achatsButton = document.getElementById('Unite_achatsButton');

    // Ajouter un écouteur d'événements sur le focus de l'input Unite_achat_achat
    uniteAchatInput.addEventListener('focus', function () {
        // Afficher la div d'options
        optionsUnite_achatsDiv.style.display = 'block';
    });

    // Ajouter un écouteur d'événements sur le bouton de validation pour les Unite_achats
    Unite_achatsButton.addEventListener('click', function () {
        // Récupérer le bouton radio sélectionné
        var selectedRadio = document.querySelector('input[name="Unite_achats"]:checked');
        
        // Mettre à jour l'input Unite_achat_achat avec la valeur sélectionnée
        uniteAchatInput.value = selectedRadio ? selectedRadio.value : '';

        // Masquer la div d'options
        optionsUnite_achatsDiv.style.display = 'none';
    });

    // Ajouter un écouteur d'événements sur le clic du document
    document.addEventListener('click', function (event) {
        // Vérifier si l'événement de clic provient de la div optionsUnite_achatsDiv ou de l'input Unite_achat
        if (!optionsUnite_achatsDiv.contains(event.target) && event.target !== uniteAchatInput) {
            // Masquer la div d'options lorsque l'utilisateur clique en dehors de la div
            optionsUnite_achatsDiv.style.display = 'none';
        }
    });
});

/*---------------------------------------------------------------------------Allergene-----------------------------------------------------------------------------*/ 

document.addEventListener('DOMContentLoaded', function () {
    // Récupérer l'input Allergene
    var uniteRecetteInput = document.querySelector('input[name="Allergene"]');
    
    // Récupérer la div d'options
    var optionsAllergenesDiv = document.getElementById('optionsAllergenesDiv');

    // Récupérer le bouton de Allergenes
    var AllergenesButton = document.getElementById('AllergenesButton');

    // Ajouter un écouteur d'événements sur le focus de l'input Allergene
    uniteRecetteInput.addEventListener('focus', function () {
        // Afficher la div d'options
        optionsAllergenesDiv.style.display = 'block';
    });

    // Ajouter un écouteur d'événements sur le bouton de Allergenes
    AllergenesButton.addEventListener('click', function () {
        // Récupérer toutes les cases à cocher cochées
        var checkedCheckboxes = document.querySelectorAll('input[name="Allergenes[]"]:checked');
        
        // Construire une chaîne avec les Allergenes des cases à cocher séparées par "/"
        var selectedValues = Array.from(checkedCheckboxes).map(function (checkbox) {
            return checkbox.value;
        }).join(" / ");

        // Mettre à jour l'input Allergene avec les Allergenes sélectionnées
        uniteRecetteInput.value = selectedValues;

        // Masquer la div d'options
        optionsAllergenesDiv.style.display = 'none';
    });

    // Ajouter un écouteur d'événements sur le clic du document
    document.addEventListener('click', function (event) {
        // Vérifier si l'événement de clic provient de la div optionsAllergenesDiv ou de l'input Allergene
        if (!optionsAllergenesDiv.contains(event.target) && event.target !== uniteRecetteInput) {
            // Masquer la div d'options lorsque l'utilisateur clique en dehors de la div
            optionsAllergenesDiv.style.display = 'none';
        }
    });
});

/*---------------------------------------------------------------------------Categorie-----------------------------------------------------------------------------*/ 

document.addEventListener('DOMContentLoaded', function () {
    // Récupérer l'input Categorie
    var CategorieInput = document.querySelector('input[name="Categorie"]');
    
    // Récupérer la div d'options
    var optionsCategoriesDiv = document.getElementById('optionsCategoriesDiv');

    // Récupérer le bouton de Categories
    var CategoriesButton = document.getElementById('CategoriesButton');

    // Ajouter un écouteur d'événements sur le focus de l'input Categorie
    CategorieInput.addEventListener('focus', function () {
        // Afficher la div d'options
        optionsCategoriesDiv.style.display = 'block';
    });

    // Ajouter un écouteur d'événements sur le bouton de Categories
    CategoriesButton.addEventListener('click', function () {
        // Récupérer toutes les cases à cocher cochées
        var checkedCheckboxes = document.querySelectorAll('input[name="Categories[]"]:checked');
        
        // Construire une chaîne avec les Categories des cases à cocher séparées par "/"
        var selectedValues = Array.from(checkedCheckboxes).map(function (checkbox) {
            return checkbox.value;
        }).join(" / ");

        // Mettre à jour l'input Categorie avec les Categories sélectionnées
        CategorieInput.value = selectedValues;

        // Masquer la div d'options
        optionsCategoriesDiv.style.display = 'none';
    });

    // Ajouter un écouteur d'événements sur le clic du document
    document.addEventListener('click', function (event) {
        // Vérifier si l'événement de clic provient de la div optionsCategoriesDiv ou de l'input Categorie
        if (!optionsCategoriesDiv.contains(event.target) && event.target !== CategorieInput) {
            // Masquer la div d'options lorsque l'utilisateur clique en dehors de la div
            optionsCategoriesDiv.style.display = 'none';
        }
    });
});


/*---------------------------------------------------------------------------Fournisseur-----------------------------------------------------------------------------*/ 


document.addEventListener('DOMContentLoaded', function () {
    // Récupérer l'input Fournisseur
    var uniteRecetteInput = document.querySelector('input[name="Fournisseur"]');
    
    // Récupérer la div d'options
    var optionsFournisseursDiv = document.getElementById('optionsFournisseursDiv');

    // Récupérer le bouton de Fournisseurs
    var FournisseursButton = document.getElementById('FournisseursButton');

    // Ajouter un écouteur d'événements sur le focus de l'input Fournisseur
    uniteRecetteInput.addEventListener('focus', function () {
        // Afficher la div d'options
        optionsFournisseursDiv.style.display = 'block';
    });

    // Ajouter un écouteur d'événements sur le bouton de Fournisseurs
    FournisseursButton.addEventListener('click', function () {
        // Récupérer toutes les cases à cocher cochées
        var checkedCheckboxes = document.querySelectorAll('input[name="Fournisseurs[]"]:checked');
        
        // Construire une chaîne avec les Fournisseurs des cases à cocher séparées par "/"
        var selectedValues = Array.from(checkedCheckboxes).map(function (checkbox) {
            return checkbox.value;
        }).join(" / ");

        // Mettre à jour l'input Fournisseur avec les Fournisseurs sélectionnées
        uniteRecetteInput.value = selectedValues;

        // Masquer la div d'options
        optionsFournisseursDiv.style.display = 'none';
    });

    // Ajouter un écouteur d'événements sur le clic du document
    document.addEventListener('click', function (event) {
        // Vérifier si l'événement de clic provient de la div optionsFournisseursDiv ou de l'input Fournisseur
        if (!optionsFournisseursDiv.contains(event.target) && event.target !== uniteRecetteInput) {
            // Masquer la div d'options lorsque l'utilisateur clique en dehors de la div
            optionsFournisseursDiv.style.display = 'none';
        }
    });
});

