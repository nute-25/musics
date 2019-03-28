<?php 
?>

<!-- Form est un helper comme Htlm-->
<?= $this->Form->create($new, ['enctype' => 'multipart/form-data']) ?>
    <h1>Ajouter un album</h1>
    <?= $this->Form->control('title', ['label' => 'Titre']) ?>
    <?= $this->Form->control('style', ['label' => 'Genre']) ?>
    <?= $this->Form->control('spotify', ['label' => 'Lien vers son open spotif']) ?>
    <?= $this->Form->control('releaseyear', ['label' => 'Année de parution']) ?>
    <?= $this->Form->control('cover', ['type' => 'file', 'label' => 'Couverture']) ?>
    <?= $this->Form->button('Ajouter') ?>
<?= $this->Form->end() ?>