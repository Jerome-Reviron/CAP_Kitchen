<tr>
    <td class="bossu"><?php echo $Categorie->getId_Categorie() ?></td>
    <td class="bossu"><?php echo $Categorie->getNom_Categorie() ?></td>
    <td class="bossu"><?php echo $Categorie->getGenre() ?></td>


    <td class="bossu"><a href="index.php?uc=admin_modifier_categorie&Id=<?php echo $Categorie->getId_Categorie() ?>"><img src="./Vues/Image/refresh.svg"></a></td>
    <td class="bossu"><a data-id="<?php echo $Categorie->getId_Categorie(); ?>" class="delete-product"><img src="Vues/Image/poubelle.svg"></a></td>
</tr>