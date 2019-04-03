<?php 
?>

<!-- Form est un helper comme Htlm-->
<?= $this->Form->create($artist, ['enctype' => 'multipart/form-data']) ?>
    <h1>Modifier un artiste</h1>
    <?= $this->Form->control('pseudonym', ['label' => 'Nom']) ?>
    <?= $this->Form->control('debut', ['label' => 'Début d\'activité']) ?>
    <?= $this->Form->control('country', ['label' => 'Pays d\'origine']) ?>
    <?= $this->Form->control('spotify', ['label' => 'Lien vers son open spotify']) ?>
    <?= $this->Form->button(
        $this->HTML->image("../data/icons/edit_white.svg").'<span> Editer</span>',
        ['class' => 'button', 'escape' => false]) ?>
<?= $this->Form->end() ?>