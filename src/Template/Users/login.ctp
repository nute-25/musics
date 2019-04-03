<?php //file : src/Templates/Users/login.ctp ?>
<h1>Se connecter</h1>
<!-- Form est un helper comme Htlm-->
<?= $this->Form->create() ?>
    <?= $this->Form->control('pseudo', ['label' => 'Pseudo']) ?>
    <?= $this->Form->control('password', ['label' => 'Password']) ?>
    <?= $this->Form->button('Se connecter') ?>
<?= $this->Form->end() ?>