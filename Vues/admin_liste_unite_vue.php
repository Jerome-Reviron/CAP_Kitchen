<tr>
    <td class="bossu"><?php echo $Unite->getId_Unite() ?></td>
    <td class="bossu"><?php echo $Unite->getNom_Unite() ?></td>
    <td class="bossu"><?php echo $Unite->getChiffre() ?></td>
    <td class="bossu"><?php echo $Unite->getValeur() ?></td>

    <td class="bossu"><a href="index.php?uc=admin_modifier_unite&Id=<?php echo $Unite->getId_Unite() ?>"><img src="./Vues/Image/refresh.svg"></a></td>
    <td class="bossu"><a data-id="<?php echo $Unite->getId_Unite(); ?>" class="delete-product"><img src="Vues/Image/poubelle.svg"></a></td>
</tr>