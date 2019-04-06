<?php 
?>
<h1>Modification de la photo de : <span><?= $artist->pseudonym ?></span></h1>
<!-- Form est un helper comme Htlm-->
<?= $this->Form->create($artist, ['enctype' => 'multipart/form-data']) ?>
    <figure>
        <?php 
        // si on a l'image, on l'affiche; sinon, on met une image par défaut
        if (!empty($artist->picture)) { ?>
                <?= $this->HTML->image('../data/pictures/'.$artist->picture, ['alt' => 'affiche de : '.$artist->title]) ?>
        <?php } else { ?>
                <!-- default.jpg se trouve dans webroot/img -->
                <?= $this->HTML->image('default.jpg', ['alt' => 'Visuel non disponible' ]) ?>
        <?php } ?>
        <figcaption>Image actuelle</figcaption>
    </figure>
    <?= $this->Form->control('picture', ['type' => 'file', 'label' => 'Sélectionner une nouvelle photo :']) ?>
    <?= $this->Form->button(
        $this->HTML->image("../data/icons/send_white.svg").'<span> Envoyer</span>',
        ['class' => 'button', 'escape' => false]) ?>
<?= $this->Form->end() ?>