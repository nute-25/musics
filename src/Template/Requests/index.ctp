<?php 
/* echo '<pre>';
var_dump($requests, count($requests));
echo '</pre>'; */

?>

<p>Il y a <?= $requests->count() ?> demande(s)</p>


<table>
    <tr>
        <th>Nom de l'artiste</th>
        <th>Titre de l'album</th>
        <th>Etat</th>
    </tr>
    <?php foreach($requests as $key => $uneLigne) : ?>
        <tr>
            <td><?= $uneLigne->artistname ?></td>
            <td><?= ($uneLigne->albumtitle) ? $uneLigne->albumtitle : 'non précisé' ?></td>
            <td><?= $uneLigne->status ?></td>
        </tr>
    <?php endforeach; ?>
</table>

<?php
    echo $this->Paginator->first('first');
    echo $this->Paginator->numbers();
    echo $this->Paginator->last('last');
?>