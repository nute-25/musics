<?php 
/* echo '<pre>';
var_dump($requests, count($requests));
echo '</pre>'; */

?>

<?php if($pending_requests->count() > 1) { ?>
    <?= '<h2 id="pending_request" class="pointer">'.$pending_requests->count().' demandes en attente : </h2>' ?>
<?php } else { ?> 
    <?= '<h2>'.$pending_requests->count().' demande en attente.</h2>' ?>
<?php } ?>
<div id="pending_request_list">
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
</div>
<?php
    /* echo $this->Paginator->first('first');
    echo $this->Paginator->numbers();
    echo $this->Paginator->last('last'); */
?>

<?php if($accepted_requests->count() > 1) { ?>
    <?= '<h2 id="accepted_request" class="pointer">'.$accepted_requests->count().' demandes acceptées : </h2>' ?>
<?php } else { ?> 
    <?= '<h2>'.$accepted_requests->count().' demandes acceptées.</h2>' ?>
<?php } ?>
<div id="accepted_request_list">
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
</div>

<?php
    echo $this->Paginator->first('first');
    echo $this->Paginator->numbers();
    echo $this->Paginator->last('last');
?>


<?php if($declined_requests->count() > 1) { ?>
    <?= '<h2 id="declined_request" class="pointer">'.$declined_requests->count().' demandes déclinées : </h2>' ?>
<?php } else { ?> 
    <?= '<h2>'.$declined_requests->count().' demandes déclinées.</h2>' ?>
<?php } ?>
<div id="declined_request_list">
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
</div>

<?php
    echo $this->Paginator->first('first');
    echo $this->Paginator->numbers();
    echo $this->Paginator->last('last');
?>