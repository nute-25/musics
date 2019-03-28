<?php 
/* echo '<pre>';
var_dump($artists, count($artists));
echo '</pre>'; */

/* echo '<pre>';
var_dump($auth->user('status'));
echo '</pre>'; */
?>

<p>Il y a <?= $artists->count() ?> artiste(s)</p>
<p><?php
    if($auth->user('status') === 'admin') {
        echo $this->HTML->link('Ajouter un artiste', ['action' => 'add']);
    }
?></p>

<table>
    <tr>
        <th>Nom</th>
        <th>Début d'activité</th>
        <th>Spotify</th>
    </tr>
    <?php foreach($artists as $key => $uneLigne) : ?>
        <tr>
            <td><?= $this->Html->link($uneLigne->pseudonym, ['action' => 'view', $uneLigne->id]) ?></td>
            <td><?= $uneLigne->debut ?></td>
            <td><a href='<?= $uneLigne->spotify ?>'>--> voir</a></td>
        </tr>
    <?php endforeach; ?>
</table>
<?php
    echo $this->Paginator->first('first');
    echo $this->Paginator->numbers();
    echo $this->Paginator->last('last');
?>