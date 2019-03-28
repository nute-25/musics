<?php 
/* echo '<pre>';
var_dump($artist); 
echo '</pre>'; */
?>


<h1>Artist</h1>
<p><?= $artist->pseudonym ?></p>
<figure>
    <?php 
    // si on a l'image, on l'affiche; sinon, on met une image par défaut
    if (!empty($artist->picture)) { ?>
        <?= $this->HTML->image('../data/pictures/'.$artist->picture, ['alt' => 'affiche de : '.$artist->pseudonym]) ?>
    <?php } else { ?>
        <!-- default.jpg se trouve dans webroot/img -->
        <?= $this->HTML->image('default.jpg', ['alt' => 'Visuel non disponible' ]) ?>
    <?php } ?>
    <figcaption>
        Photo de 
        <?= $artist->pseudonym ?>
        <p>
                <?= $this->HTML->link('Modifier la photo', ['action' => 'editImage', $artist->id]) ?>
        </p>
        <?php if (!empty($artist->picture)) { 
                echo $this->Form->postLink('Supprimer la photo', ['action' => 'deleteImage', $artist->id], ['confirm' => 'Etes-vous sûr de vouloir supprimer cette photo ?']);
        } ?>
    </figcaption>
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
    <span class="label">Lien vers son open spotify :</span>
    <?php  if(!empty($artist->spotify)) {
        echo '<a href=';
        echo $artist->spotify;
        echo '>--> voir</a>';
    } else {
        echo '<span style="font-style:italic;">Aucun lien disponible</span>';
    } ?>
</p>
<p>
    <span class="label">Son widget Spotify :</span>
    <?php 
        $artistSpotify = strstr($artist->spotify, 'artist/');
        $src = 'https://open.spotify.com/embed/'.$artistSpotify;
    ?>
    <iframe src="<?= $src ?>" width="300" height="380" frameborder="0" allowtransparency="true" allow="encrypted-media"></iframe>

<p>id #<?= $artist->id ?></p>

<p>
    <span class="label">Liste de ses albums :</span>
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
    <p>
        <?php
            if($auth->user('status') === 'admin') {
                echo $this->HTML->link('Ajouter un album', ['controller' => 'albums', 'action' => 'add', $artist->id]);
            }
        ?>
    </p>
</p>

<p><?= $this->HTML->link('Editer', ['action' => 'edit', $artist->id]) ?></p>
<?= $this->Form->postLink('Supprimer', ['action' => 'delete', $artist->id], ['confirm' => 'Etes-vous sûr de vouloir supprimer cet artist ?']); ?>

