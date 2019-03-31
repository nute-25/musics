<?php 
/* echo '<pre>';
var_dump($requests, count($requests));
echo '</pre>'; */

?>


<h2>Demande en attente : <?= $pending_requests->count() ?> </h2>
<table>
    <tr>
        <th>Nom de l'artiste</th>
        <th>Titre de l'album</th>
        <th>Traitement</th>
    </tr>
    <?php foreach($pending_requests as $key => $uneLigne) : ?>
        <tr>
            <td><?= $uneLigne->artistname ?></td>
            <td><?= ($uneLigne->albumtitle) ? $uneLigne->albumtitle : 'non précisé' ?></td>
            <td>
                <?= $this->Form->postLink('Accept', ['action' => 'accept', $uneLigne->id]); ?>
                <?= $this->Form->postLink('Decline', ['action' => 'decline', $uneLigne->id]); ?>
		    </td>
        </tr>
    <?php endforeach; ?>
</table>

<?php
    /* echo $this->Paginator->first('first');
    echo $this->Paginator->numbers();
    echo $this->Paginator->last('last'); */
?>


<h2>Demande acceptée : <?= $accepted_requests->count() ?> </h2>
<table>
    <tr>
        <th>Nom de l'artiste</th>
        <th>Titre de l'album</th>
    </tr>
    <?php foreach($accepted_requests as $key => $uneLigne) : ?>
        <tr>
            <td><?= $uneLigne->artistname ?></td>
            <td><?= ($uneLigne->albumtitle) ? $uneLigne->albumtitle : 'non précisé' ?></td>
        </tr>
    <?php endforeach; ?>
</table>

<?php
    echo $this->Paginator->first('first');
    echo $this->Paginator->numbers();
    echo $this->Paginator->last('last');
?>


<h2>Demande déclinée : <?= $declined_requests->count() ?> </h2>
<table>
    <tr>
        <th>Nom de l'artiste</th>
        <th>Titre de l'album</th>
    </tr>
    <?php foreach($declined_requests as $key => $uneLigne) : ?>
        <tr>
            <td><?= $uneLigne->artistname ?></td>
            <td><?= ($uneLigne->albumtitle) ? $uneLigne->albumtitle : 'non précisé' ?></td>
        </tr>
    <?php endforeach; ?>
</table>

<?php
    echo $this->Paginator->first('first');
    echo $this->Paginator->numbers();
    echo $this->Paginator->last('last');
?>