<?php 
?>
<h1>Modification de la photo de : <?= $artist->pseudonym ?></h1>
<!-- Form est un helper comme Htlm-->
<?= $this->Form->create($artist, ['enctype' => 'multipart/form-data']) ?>
    <?= $this->Form->control('picture', ['type' => 'file', 'label' => 'Affiche']) ?>
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
    <?= $this->Form->button('Editer') ?>
<?= $this->Form->end() ?>