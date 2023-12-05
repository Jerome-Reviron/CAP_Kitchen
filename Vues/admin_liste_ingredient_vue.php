<tr>
    <td class="bossu"><?php echo $Ingredient->getNom_Ingredient() ?></td>
    <td class="bossu"><img class="photo" src="data:image/jpeg;base64,<?php echo base64_encode($Ingredient->getPhoto()) ?>" alt="Ingredient Photo"></td>   
    <td class="bossu"><?php echo $Ingredient->getUnite_recette() ?></td>
    <td class="bossu"><?php echo $Ingredient->getConditionnement_achat() ?></td>
    <td class="bossu"><?php echo $Ingredient->getPrix_achat() ?></td>
    <td class="bossu"><?php echo $Ingredient->getUnite_achat() ?></td>

    <?php if ($droit == 1 || $droit == 2 || $droit == 3) {
        echo '<td class="bossu"><a href="index.php?uc=admin_modifier_ingredient&Id=<?php echo $Admin->getId_Ingredient() ?>"><img src="./Vues/Image/refresh.svg"></a></td>';
        } else {
            echo '<td class="bossu">Non autorisé</td>';
        }
    ?>
    <?php if ($droit == 1 || $droit == 2 || $droit == 3) {
        echo '<td class="bossu"><a data-id="'.$Ingredient->getId_Ingredient().'" class="delete-product"><img src="Vues/Image/poubelle.svg"></a></td>';
        } else {
            echo '<td class="bossu">Non autorisé</td>';
        }
    ?>
</tr>