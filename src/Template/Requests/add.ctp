<?php //file : src/Templates/Requests/add.ctp ?>

<?= $this->Form->create($new) ?>
    <h1>Demande d'ajout</h1>
    <?= $this->Form->control('artistname', ['label' => 'Nom de l\'artiste']) ?>
    <?= $this->Form->control('albumtitle', ['label' => 'Titre de l\'album']) ?>
    <?= $this->Form->button('Envoyer') ?>
<?= $this->Form->end() ?>