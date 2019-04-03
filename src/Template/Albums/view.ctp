<?php 
/* echo '<pre>';
var_dump($album); 
echo '</pre>';  */
?>


<h1>
    <div>
        <span>
            <?php if(!empty($album->spotify)) { ?>
                <?= $this->HTML->link(
                $this->HTML->image("../data/icons/spotify.svg"),
                $album->spotify,
                ['escape' => false]) ?>
            <?php } ?>
        </span>
        Album : 
        <span><?= $album->title .'<span class="lowercase"> de <span>'. $album->artist->pseudonym?></span>
    </div>
    <div>
        <?php if($auth->user('status') === 'admin') { ?>
            <span>
                <?= $this->HTML->link(
                $this->HTML->image("../data/icons/edit_white.svg").'<span> Editer</span>',
                ['action' => 'edit', $album->id],
                ['class' => 'button', 'escape' => false]) ?>
                <?= $this->Form->postLink($this->HTML->image("../data/icons/delete_white.svg").'<span> Supprimer</span>',
                ['action' => 'delete', $album->id],
                ['confirm' => 'Etes-vous sûr de vouloir supprimer cet album ?', 'escape' => false, 'class' => 'button']) ?>
            </span>
        <?php } ?>
    </div>
</h1>
<figure>
    <?php 
    // si on a l'image, on l'affiche; sinon, on met une image par défaut
    if (!empty($album->cover)) { ?>
        <?= $this->HTML->image('../data/covers/'.$album->cover, ['alt' => 'Cover de : '.$album->title]) ?>
    <?php } else { ?>
        <!-- default.jpg se trouve dans webroot/img -->
        <?= $this->HTML->image('default.jpg', ['alt' => 'Visuel non disponible' ]) ?>
    <?php } 
    if($auth->user('status') === 'admin') { ?>
        <figcaption>
            <?= $this->HTML->link(
            $this->HTML->image("../data/icons/edit_white.svg").'<span> Modifier</span>',
            ['action' => 'editImage', $album->id],
            ['class' => 'button', 'escape' => false]) ?>
            <?php if (!empty($album->cover)) { ?>
                <?= $this->Form->postLink($this->HTML->image("../data/icons/delete_white.svg").'<span> Supprimer</span>',
                ['action' => 'deleteImage', $album->id],
                ['confirm' => 'Etes-vous sûr de vouloir supprimer ce cover ?', 'escape' => false, 'class' => 'button']) ?>
            <?php } ?>
        </figcaption>
    <?php } ?>
</figure>
<p>
    <span class="label">Genre :</span>
    <?=  (!empty($album->style)) ? $album->style : '<span style="font-style:italic;">Inconnue</span>' ?>
</p>
<p>
    <span class="label">Son widget Spotify :</span>
    <?php 
        $albumSpotify = strstr($album->spotify, 'album/');
        $src = 'https://open.spotify.com/embed/'.$albumSpotify;
    ?>
    <iframe src="<?= $src ?>" width="300" height="380" frameborder="0" allowtransparency="true" allow="encrypted-media"></iframe>


