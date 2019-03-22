<?php 
/* echo '<pre>';
var_dump($artists, count($artists));
echo '</pre>'; */
?>

<p>Il y a <?= $artists->count() ?> artiste(s)</p>
<p><?= $this->HTML->link('Ajouter un artiste', ['action' => 'add']) ?></p>

<table>
    <tr>
        <th>Nom</th>
        <th>Début d'activité</th>
        <th>Spotify</th>
    </tr>
    <?php foreach($artists as $key => $uneLigne) : ?>
        <tr>
            <td><?= $uneLigne->pseudonym ?></td>
            <td><?= $uneLigne->debut ?></td>
            <td><a href='<?= $uneLigne->spotify ?>'>--> voir</a></td>
        </tr>
    <?php endforeach; ?>
</table>
