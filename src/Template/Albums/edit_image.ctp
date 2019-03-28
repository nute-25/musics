<?php 
?>

<!-- Form est un helper comme Htlm-->
<?= $this->Form->create($album, ['enctype' => 'multipart/form-data']) ?>
    <h1>Modification de la couverture de : <?= $album->title ?></h1>
    <?= $this->Form->control('cover', ['type' => 'file', 'label' => 'Affiche']) ?>
    <figure>
        <?php 
        // si on a l'image, on l'affiche; sinon, on met une image par défaut
        if (!empty($album->cover)) { ?>
                <?= $this->HTML->image('../data/covers/'.$album->cover, ['alt' => 'affiche de : '.$album->title]) ?>
        <?php } else { ?>
                <!-- default.jpg se trouve dans webroot/img -->
                <?= $this->HTML->image('default.jpg', ['alt' => 'Visuel non disponible' ]) ?>
        <?php } ?>
        <figcaption>Image actuelle</figcaption>
    </figure>
    <?= $this->Form->button('Editer') ?>
<?= $this->Form->end() ?>