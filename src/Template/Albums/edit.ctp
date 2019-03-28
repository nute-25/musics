<?php 
?>

<!-- Form est un helper comme Htlm-->
<?= $this->Form->create($album, ['enctype' => 'multipart/form-data']) ?>
    <h1>Modifier un album</h1>
    <?= $this->Form->control('title', ['label' => 'Titre']) ?>
    <?= $this->Form->control('style', ['label' => 'Genre']) ?>
    <?= $this->Form->control('spotify', ['label' => 'Lien vers son open spotif']) ?>
    <?= $this->Form->control('releaseyear', ['label' => 'Année de parution']) ?>
    <?= $this->Form->button('Editer') ?>
<?= $this->Form->end() ?>