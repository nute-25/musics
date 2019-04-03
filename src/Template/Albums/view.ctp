<?php 
/* echo '<pre>';
var_dump($album); 
echo '</pre>';  */
?>


<h1>Album : <span><?= $album->title .'<span class="lowercase"> de <span>'. $album->artist->pseudonym?></span></h1>
<figure>
    <?php 
    // si on a l'image, on l'affiche; sinon, on met une image par défaut
    if (!empty($album->cover)) { ?>
        <?= $this->HTML->image('../data/covers/'.$album->cover, ['alt' => 'Cover de : '.$album->title]) ?>
    <?php } else { ?>
        <!-- default.jpg se trouve dans webroot/img -->
        <?= $this->HTML->image('default.jpg', ['alt' => 'Visuel non disponible' ]) ?>
    <?php } ?>
    <figcaption>
        Photo de 
        <?= $album->title;
            if($auth->user('status') === 'admin') {
                echo '<div class="button">'.$this->HTML->link('Modifier la photo', ['action' => 'editImage', $album->id]).'</div>';
                if (!empty($album->cover)) {
                    echo '<div class="button">'.$this->Form->postLink('Supprimer la photo', ['action' => 'deleteImage', $album->id], ['confirm' => 'Etes-vous sûr de vouloir supprimer ce cover ?']).'</div>';
                }
            }
        ?>
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

<?php
    if($auth->user('status') === 'admin') {
        echo '<div class="button">'.$this->HTML->link('Editer', ['action' => 'edit', $album->id]).'</div>';
        echo '<div class="button">'.$this->Form->postLink('Supprimer', ['action' => 'delete', $album->id], ['confirm' => 'Etes-vous sûr de vouloir supprimer cet album ?']).'</div>';
    }
?>
