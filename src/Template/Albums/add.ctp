<?php 
?>
<h1>Ajouter un album</h1>
<!-- Form est un helper comme Htlm-->
<?= $this->Form->create($new, ['enctype' => 'multipart/form-data']) ?>
    <?= $this->Form->control('title', ['label' => 'Titre']) ?>
    <?= $this->Form->control('style', ['label' => 'Genre']) ?>
    <?= $this->Form->control('spotify', ['label' => 'Lien vers son open spotif']) ?>
    <?= $this->Form->control('releaseyear', ['label' => 'Année de parution']) ?>
    <?= $this->Form->control('cover', ['type' => 'file', 'label' => 'Couverture']) ?>
    <?= $this->Form->button(
        $this->HTML->image("../data/icons/add_white.svg").'<span> Ajouter</span>',
        ['class' => 'button', 'escape' => false]) ?>
<?= $this->Form->end() ?>