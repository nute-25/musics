<?php 
?>
<h1>Modification de la couverture de : <span><?= $album->title ?></span></h1>
<!-- Form est un helper comme Htlm-->
<?= $this->Form->create($album, ['enctype' => 'multipart/form-data']) ?>
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
    <?= $this->Form->control('cover', ['type' => 'file', 'label' => 'Sélectionner une nouvelle couverture : ']) ?>
    <?= $this->Form->button('Envoyer') ?>
<?= $this->Form->end() ?>