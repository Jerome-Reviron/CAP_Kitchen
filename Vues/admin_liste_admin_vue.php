<tr>
    <td class="bossu"><?php echo $Admin->getNom() ?></td>
    <td class="bossu"><?php echo $Admin->getPrenom() ?></td>
    <td class="bossu"><?php echo $Admin->getPseudo() ?></td>
    <td class="bossu"><?php echo str_repeat('*', strlen($Admin->getPassword())); ?></td>
    <td class="bossu"><?php echo $Admin->getAdresse() ?></td>
    <td class="bossu"><?php echo $Admin->getTelephone() ?></td>
    <td class="bossu"><?php echo $Admin->getEmail()?></td>
    <td class="bossu"><?php echo $Admin->getRole() ?></td>
    <td class="bossu"><?php echo $Admin->getId_Entreprise() ?></td>

    <?php if ($droit == 1) {
        echo '<td class="bossu"><a href="index.php?uc=admin_modifier_admin&Id=<?php echo $Admin->getId_Admin() ?>"><img src="./Vues/Image/refresh.svg"></a></td>';
        } else {
            echo '<td class="bossu">Non autorisé</td>';
        }
    ?>
    <?php if ($droit == 1) {
        echo '<td class="bossu"><a data-id="'.$Admin->getId_Admin().'" class="delete-product"><img src="Vues/Image/poubelle.svg"></a></td>';
        } else {
            echo '<td class="bossu">Non autorisé</td>';
        }
    ?>
</tr>