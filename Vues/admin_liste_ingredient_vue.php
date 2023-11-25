<tr>
    <td class="bossu"><?php echo $Ingredient->getId_Ingredient() ?></td>
    <td class="bossu"><?php echo $Ingredient->getNom_Ingredient() ?></td>
    <td class="bossu"><img class="photo" src="data:image/jpeg;base64,<?php echo base64_encode($Ingredient->getPhoto()) ?>" alt="Ingredient Photo"></td>   
    <td class="bossu"><?php echo $Ingredient->getUnite_recette() ?></td>
    <td class="bossu"><?php echo $Ingredient->getConditionnement_achat() ?></td>
    <td class="bossu"><?php echo $Ingredient->getPrix_achat() ?></td>
    <td class="bossu"><?php echo $Ingredient->getUnite_achat() ?></td>

    <td class="bossu"><a href="index.php?uc=admin_modifier_ingredient&Id=<?php echo $Ingredient->getId_Ingredient() ?>"><img src="./Vues/Image/refresh.svg"></a></td>
    <td class="bossu"><a data-id="<?php echo $Ingredient->getId_Ingredient(); ?>" class="delete-product"><img src="Vues/Image/poubelle.svg"></a></td>
</tr>