<?php 
/* echo '<pre>';
var_dump($user); 
echo '</pre>'; */
?>



<h1>Utilisateur</h1>
<p><?= $user->pseudo ?></p>


<span class="label">Vos favoris :</span>
<?php if(empty($user->bookmarks))
    echo '<p>Vous n\'avez pas de favori</p>';
else { ?>
    <table>
        <tr>
            <th>Nom de l'artiste</th>
            <th>Spotify</th>
        </tr>
        <?php foreach($user->bookmarks as $key => $value) : ?>
            <tr>
                <td><?= $this->Html->link($value->artist->pseudonym, ['controller' => 'artists', 'action' => 'view', $value->artist->id]) ?></td>
                <td><a href='<?= $value->artist->spotify ?>'>--> voir</a></td>
            </tr>
        <?php endforeach; ?>
    </table>
<?php } ?>
