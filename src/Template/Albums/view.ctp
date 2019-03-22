<?php 
/* echo '<pre>';
var_dump($album); 
echo '</pre>';  */
?>


<h1>Album</h1>
<p><?= $album->title .' de '. $album->artist->pseudonym?></p>
<figure>
    <?php 
    // si on a l'image, on l'affiche; sinon, on met une image par défaut
    if (!empty($album->cover)) { ?>
        <?= $this->HTML->image('../data/posters/'.$album->cover, ['alt' => 'Cover de : '.$album->title]) ?>
    <?php } else { ?>
        <!-- default.jpg se trouve dans webroot/img -->
        <?= $this->HTML->image('default.jpg', ['alt' => 'Visuel non disponible' ]) ?>
    <?php } ?>
    <figcaption>
        Photo de 
        <?= $album->title ?>
        <p>
                <?= $this->HTML->link('Modifier la photo', ['action' => 'editImage', $album->id]) ?>
        </p>
        <?php if (!empty($album->cover)) { 
                echo $this->Form->postLink('Supprimer la photo', ['action' => 'deleteImage', $album->id], ['confirm' => 'Etes-vous sûr de vouloir supprimer ce cover ?']);
        } ?>
    </figcaption>
</figure>
<p>
    <span class="label">Genre :</span>
    <?=  (!empty($album->style)) ? $album->style : '<span style="font-style:italic;">Inconnue</span>' ?>
</p>
<p>
    <span class="label">Lien vers son open spotify :</span>
    <?php  if(!empty($album->spotify)) {
        echo '<a href=';
        echo $album->spotify;
        echo '>--> voir</a>';
    } else {
        echo '<span style="font-style:italic;">Aucun lien disponible</span>';
    } ?>
</p>
<p>
    <span class="label">Son widget Spotify :</span>
    <?php 
        $albumSpotify = strstr($album->spotify, 'album/');
        $src = 'https://open.spotify.com/embed/'.$albumSpotify;
    ?>
    <iframe src="<?= $src ?>" width="300" height="380" frameborder="0" allowtransparency="true" allow="encrypted-media"></iframe>

<p>id #<?= $album->id ?></p>


<p><?= $this->HTML->link('Editer', ['action' => 'edit', $album->id]) ?></p>
<?= $this->Form->postLink('Supprimer', ['action' => 'delete', $album->id], ['confirm' => 'Etes-vous sûr de vouloir supprimer cet album ?']); ?>

