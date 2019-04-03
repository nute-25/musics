<?php //file : src/Templates/Users/add.ctp ?>
<h1>Ajouter un utilisateur</h1>
<!-- Form est un helper comme Htlm-->
<?= $this->Form->create($new) ?>
    <?= $this->Form->control('pseudo', ['label' => 'Pseudo']) ?>
    <?= $this->Form->control('password', ['label' => 'Password']) ?>
    <?= $this->Form->button(
        $this->HTML->image("../data/icons/add_white.svg").'<span> Ajouter</span>',
        ['class' => 'button', 'escape' => false]) ?>
<?= $this->Form->end() ?>