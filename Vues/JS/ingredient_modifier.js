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
    var AllergeneInput = document.querySelector('input[name="Allergene"]');
    var optionsAllergenesDiv = document.getElementById('optionsAllergenesDiv');
    var AllergenesButton = document.getElementById('AllergenesButton');

    // Créer et initialiser l'input caché avec les ID des allergènes déjà sélectionnés
    var hiddenIdsInput = document.createElement('input');
    hiddenIdsInput.type = 'hidden';
    hiddenIdsInput.name = 'Id_Allergene';
    AllergeneInput.parentNode.appendChild(hiddenIdsInput);

    // Récupérer les checkbox déjà cochées et mettre à jour l'input caché
    var initialCheckedCheckboxes = document.querySelectorAll('input[name="Allergenes[]"]:checked');
    var initialAllergeneIds = Array.from(initialCheckedCheckboxes).map(function (checkbox) {
        return checkbox.getAttribute('data-id');
    });
    hiddenIdsInput.value = initialAllergeneIds.join(" / ");

    AllergeneInput.addEventListener('focus', function () {
        optionsAllergenesDiv.style.display = 'block';
    });

    AllergenesButton.addEventListener('click', function () {
        var checkedCheckboxes = document.querySelectorAll('input[name="Allergenes[]"]:checked');
        var AllergeneNames = [];
        var AllergeneIds = [];

        checkedCheckboxes.forEach(function (checkbox) {
            AllergeneNames.push(checkbox.value);
            AllergeneIds.push(checkbox.getAttribute('data-id'));
        });

        AllergeneInput.value = AllergeneNames.join(" / ");
        hiddenIdsInput.value = AllergeneIds.join(" / ");

        optionsAllergenesDiv.style.display = 'none';
    });

    document.addEventListener('click', function (event) {
        if (!optionsAllergenesDiv.contains(event.target) && event.target !== AllergeneInput) {
            optionsAllergenesDiv.style.display = 'none';
        }
    });
});



/*---------------------------------------------------------------------------Categorie-----------------------------------------------------------------------------*/ 

document.addEventListener('DOMContentLoaded', function () {
    var CategorieInput = document.querySelector('input[name="Categorie"]');
    var optionsCategoriesDiv = document.getElementById('optionsCategoriesDiv');
    var CategoriesButton = document.getElementById('CategoriesButton');

    // Initialiser l'input caché pour l'ID de la catégorie
    var hiddenIdInput = document.createElement('input');
    hiddenIdInput.type = 'hidden';
    hiddenIdInput.name = 'Id_Categorie';
    CategorieInput.parentNode.appendChild(hiddenIdInput);

    var initialCheckedCheckbox = document.querySelector('input[name="Categories[]"]:checked');
    if (initialCheckedCheckbox) {
        hiddenIdInput.value = initialCheckedCheckbox.getAttribute('data-id');
    }

    CategorieInput.addEventListener('focus', function () {
        optionsCategoriesDiv.style.display = 'block';
    });

    CategoriesButton.addEventListener('click', function () {
        var checkedCheckbox = document.querySelector('input[name="Categories[]"]:checked');
    
        if (checkedCheckbox) {
            CategorieInput.value = checkedCheckbox.value;
            hiddenIdInput.value = checkedCheckbox.getAttribute('data-id');
        }

        optionsCategoriesDiv.style.display = 'none';
    });

    document.addEventListener('click', function (event) {
        if (!optionsCategoriesDiv.contains(event.target) && event.target !== CategorieInput) {
            optionsCategoriesDiv.style.display = 'none';
        }
    });
});


/*---------------------------------------------------------------------------Fournisseur-----------------------------------------------------------------------------*/ 


document.addEventListener('DOMContentLoaded', function () {
    var FournisseurInput = document.querySelector('input[name="Fournisseur"]');
    var optionsFournisseursDiv = document.getElementById('optionsFournisseursDiv');
    var FournisseursButton = document.getElementById('FournisseursButton');

    // Initialiser l'input caché pour les ID des fournisseurs
    var hiddenIdsInput = document.createElement('input');
    hiddenIdsInput.type = 'hidden';
    hiddenIdsInput.name = 'Id_Fournisseur';
    FournisseurInput.parentNode.appendChild(hiddenIdsInput);

    var initialCheckedCheckboxes = document.querySelectorAll('input[name="Fournisseurs[]"]:checked');
    var initialFournisseurIds = Array.from(initialCheckedCheckboxes).map(function (checkbox) {
        return checkbox.getAttribute('data-id');
    });
    hiddenIdsInput.value = initialFournisseurIds.join(" / ");

    FournisseurInput.addEventListener('focus', function () {
        optionsFournisseursDiv.style.display = 'block';
    });

    FournisseursButton.addEventListener('click', function () {
        var checkedCheckboxes = document.querySelectorAll('input[name="Fournisseurs[]"]:checked');
        var FournisseurNames = [];
        var FournisseurIds = [];

        checkedCheckboxes.forEach(function (checkbox) {
            FournisseurNames.push(checkbox.value);
            FournisseurIds.push(checkbox.getAttribute('data-id'));
        });

        FournisseurInput.value = FournisseurNames.join(" / ");
        hiddenIdsInput.value = FournisseurIds.join(" / ");

        optionsFournisseursDiv.style.display = 'none';
    });

    document.addEventListener('click', function (event) {
        if (!optionsFournisseursDiv.contains(event.target) && event.target !== FournisseurInput) {
            optionsFournisseursDiv.style.display = 'none';
        }
    });
});

