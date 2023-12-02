<tr>
    <td class="bossu"><?php echo $Fournisseur->getForme_Juridique() ?></td>
    <td class="bossu"><?php echo $Fournisseur->getNom_Fournisseur() ?></td>
    <td class="bossu"><?php echo $Fournisseur->getAdresse() ?></td>
    <td class="bossu"><?php echo $Fournisseur->getTelephone() ?></td>
    <td class="bossu"><?php echo $Fournisseur->getEmail()?></td>
    <td class="bossu"><?php echo $Fournisseur->getNumero_SIRET() ?></td>

    <td class="bossu"><a href="index.php?uc=admin_modifier_fournisseur&Id=<?php echo $Fournisseur->getId_Fournisseur() ?>"><img src="./Vues/Image/refresh.svg"></a></td>
    <td class="bossu"><a data-id="<?php echo $Fournisseur->getId_Fournisseur(); ?>" class="delete-product"><img src="Vues/Image/poubelle.svg"></a></td>
</tr>