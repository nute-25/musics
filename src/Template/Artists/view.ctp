<?php 
/* echo '<pre>';
var_dump($artist); 
echo '</pre>'; */
/* echo '<pre>';
var_dump($bookmark); 
echo '</pre>';  */
?>


<h1>
    <span>
        <?php if(!empty($artist->spotify)) { ?>
            <?= $this->HTML->link(
            $this->HTML->image("../data/icons/spotify.svg"),
            $artist->spotify,
            ['escape' => false]) ?>
         <?php } ?>
    </span>
    
    Artiste : 
    <span><?= $artist->pseudonym ?></span>

    <?php if($auth->user()) {
        if(!empty($bookmark)) { ?>
            <?= $this->Form->postLink($this->HTML->image("../data/icons/bookmark.svg").'<span> Favoris</span>',
            ['controller' => 'bookmarks', 'action' => 'delete', $bookmark->id],
            ['confirm' => 'Etes-vous sûr de vouloir supprimer cet artiste de vos favoris ?', 'escape' => false, 'class' => 'button']) ?>
    <?php }
        else { ?>
            <?= $this->HTML->link(
            $this->HTML->image("../data/icons/no_bookmark.svg").'<span> Favoris</span>',
            ['controller' => 'bookmarks', 'action' => 'add', $artist->id],
            ['class' => 'button', 'escape' => false]) ?>
    <?php } 
    } ?>

    <?php if($auth->user('status') === 'admin') { ?>
    <?= $this->HTML->link(
    $this->HTML->image("../data/icons/edit_white.svg").'<span> Editer</span>',
    ['action' => 'edit', $artist->id],
    ['class' => 'button', 'escape' => false]) ?>
    <?= $this->Form->postLink($this->HTML->image("../data/icons/delete_white.svg").'<span> Supprimer</span>',
    ['action' => 'delete', $artist->id],
    ['confirm' => 'Etes-vous sûr de vouloir supprimer cet artiste ?', 'escape' => false, 'class' => 'button']) ?>
<?php } ?>
</h1>

<p><?php if($bookmarks > 1) { ?>
    <?= $bookmarks.' utilisateurs ont mis cet artiste en favori.' ?> 
<?php } else { ?> 
    <?= $bookmarks.' utilisateur a mis cet artiste en favori' ?></p>
<?php } ?>



<figure>
    <?php 
    // si on a l'image, on l'affiche; sinon, on met une image par défaut
    if (!empty($artist->picture)) { ?>
        <?= $this->HTML->image('../data/pictures/'.$artist->picture, ['alt' => 'affiche de : '.$artist->pseudonym]) ?>
    <?php } else { ?>
        <!-- default.jpg se trouve dans webroot/img -->
        <?= $this->HTML->image('default.jpg', ['alt' => 'Visuel non disponible' ]) ?>
    <?php } 
    if($auth->user('status') === 'admin') { ?>
        <figcaption>
            <?= $this->HTML->link(
            $this->HTML->image("../data/icons/edit_white.svg").'<span> Modifier</span>',
            ['action' => 'editImage', $artist->id],
            ['class' => 'button', 'escape' => false]) ?>
            <?php if (!empty($artist->picture)) { ?>
                <?= $this->Form->postLink($this->HTML->image("../data/icons/delete_white.svg").'<span> Supprimer</span>',
                ['action' => 'deleteImage', $artist->id],
                ['confirm' => 'Etes-vous sûr de vouloir supprimer ce cover ?', 'escape' => false, 'class' => 'button']) ?>
            <?php } ?>
        </figcaption>
    <?php } ?>
</figure>
<p>
    <span class="label">Début d'activité :</span>
    <?=  (!empty($artist->debut)) ? $artist->debut : '<span style="font-style:italic;">Inconnue</span>' ?>
</p>
<p>
    <span class="label">Région d'origine :</span>
    <?=  (!empty($artist->country)) ? $artist->country : ''; ?>
</p>

<p>
    <span class="label">Son widget Spotify :</span>
    <?php 
        $artistSpotify = strstr($artist->spotify, 'artist/');
        $src = 'https://open.spotify.com/embed/'.$artistSpotify;
    ?>
    <iframe src="<?= $src ?>" width="300" height="380" frameborder="0" allowtransparency="true" allow="encrypted-media"></iframe>

<p>
    <span class="label">Liste de ses albums :</span>
    <?php if($auth->user('status') === 'admin') { ?>
        <?= $this->HTML->link(
        $this->HTML->image("../data/icons/add_white.svg").'<span> Ajouter</span>',
        ['controller' => 'albums', 'action' => 'add', $artist->id],
        ['class' => 'button', 'escape' => false]) ?>
    <?php } ?>
    <?php if(empty($artist->albums))
        echo '<p>Il n\'y a pas d\'albums disponibles pour cet artiste</p>';
    else { ?>
        <table>
            <tr>
                <th>Titre</th>
                <th>Date de sortie</th>
                <th>Genre</th>
                <th>Spotify</th>
            </tr>
            <?php foreach($artist->albums as $key => $value) : ?>
                <tr>
                    <td><?= $this->Html->link($value->title, ['controller' => 'albums', 'action' => 'view', $value->id]) ?></td>
                    <td><?= $value->releaseyear ?></td>
                    <td><?= $value->style ?></td>
                    <td><a href='<?= $value->spotify ?>'>--> voir</a></td>
                </tr>
            <?php endforeach; ?>
        </table>
    <?php } ?>
</p>





