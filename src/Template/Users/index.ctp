<?php //file : src/Templates/Users/index.ctp 
// echo '<pre>';
// var_dump($u, count($u));
// echo '</pre>';
?>

<p>Il y a <?= $u->count() ?> utilisateur(s)</p>
<?php if($auth->user('status') === 'admin') { ?>
    <?= $this->HTML->link(
        $this->HTML->image("../data/icons/add_white.svg").'<span> Ajouter</span>',
        ['action' => 'add'],
        ['class' => 'button', 'escape' => false]) ?>
<?php } ?>

<table>
    <tr>
        <th>Pseudo</th>
        <th>Créé le :</th>
        <th>Modifié le : </th>
    </tr>
    <?php foreach($u as $uneLigne) : ?>
        <tr>
            <td><?= $this->Html->link( $uneLigne->pseudo, ['controller' => 'users', 'action' => 'view', $uneLigne->id]); ?></td>
            <td><?= $uneLigne->created ?></td>
            <td><?= $uneLigne->modified ?></td>
        </tr>
    <?php endforeach; ?>
</table>