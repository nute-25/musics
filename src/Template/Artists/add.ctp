<?php 
?>
<h1>Ajouter un artiste</h1>
<!-- Form est un helper comme Htlm-->
<?= $this->Form->create($new, ['enctype' => 'multipart/form-data']) ?>
    <?= $this->Form->control('pseudonym', ['label' => 'Nom']) ?>
    <?= $this->Form->control('debut', ['label' => 'Début d\'activité']) ?>
    <?= $this->Form->control('country', ['label' => 'Pays d\'origine']) ?>
    <?= $this->Form->control('spotify', ['label' => 'Lien vers son open spotify']) ?>
    <?= $this->Form->control('picture', ['type' => 'file', 'label' => 'Photo']) ?>
    <?= $this->Form->button('Ajouter') ?>
<?= $this->Form->end() ?>