<?php 
/* echo '<pre>';
var_dump($user); 
echo '</pre>'; */
?>



<h1>
    <div>
        Utilisateur : 
        <span><?= $user->pseudo ?></span>
    </div>
    <div></div>
</h1>


<h2>Favoris :</h2>
<?php if(empty($user->bookmarks))
    echo '<p>Aucun favori</p>';
else { ?>
    <div class="container_list">
        <div class="list">
            <?php foreach($user->bookmarks as $key => $value) : ?>
                <figure>
                    <?php if (!empty($value->artist->picture)) { ?>
                        <?= $this->HTML->image('../data/pictures/'.$value->artist->picture, ['alt' => 'photo de '.$value->artist->pseudonym]) ?>
                    <?php } else { ?>
                        <!-- default.jpg se trouve dans webroot/img -->
                        <?= $this->HTML->image('default.jpg', ['alt' => 'Visuel non disponible' ]) ?>
                    <?php } ?>
                    <figcaption> 
                        <?= $this->Html->link($value->artist->pseudonym, ['controller' => 'artists', 'action' => 'view', $value->artist->id]) ?>
                    </figcaption>
                </figure>
            <?php endforeach; ?>
        </div>
    </div>


    <?php if($auth->user('id') && $user->id !== $auth->user('id')) { ?>

        <h2>Vos favoris en commun :</h2>
        <div class="container_list">
            <div class="list">
                <?php foreach($communbookmarks as $key => $value) : ?>
                    <figure>
                        <?php if (!empty($value->artist->picture)) { ?>
                            <?= $this->HTML->image('../data/pictures/'.$value->artist->picture, ['alt' => 'photo de '.$value->artist->pseudonym]) ?>
                        <?php } else { ?>
                            <!-- default.jpg se trouve dans webroot/img -->
                            <?= $this->HTML->image('default.jpg', ['alt' => 'Visuel non disponible' ]) ?>
                        <?php } ?>
                        <figcaption> 
                            <?= $this->Html->link($value->artist->pseudonym, ['controller' => 'artists', 'action' => 'view', $value->artist->id]) ?>
                        </figcaption>
                    </figure>
                <?php endforeach; ?>
            </div>
        </div>

        <h2>Vous pourriez aimer :</h2>
        <div class="container_list">
            <div class="list">
                <?php foreach($differentbookmarks as $key => $value) : ?>
                    <figure>
                        <?php if (!empty($value->artist->picture)) { ?>
                            <?= $this->HTML->image('../data/pictures/'.$value->artist->picture, ['alt' => 'photo de '.$value->artist->pseudonym]) ?>
                        <?php } else { ?>
                            <!-- default.jpg se trouve dans webroot/img -->
                            <?= $this->HTML->image('default.jpg', ['alt' => 'Visuel non disponible' ]) ?>
                        <?php } ?>
                        <figcaption> 
                            <?= $this->Html->link($value->artist->pseudonym, ['controller' => 'artists', 'action' => 'view', $value->artist->id]) ?>
                        </figcaption>
                    </figure>
                <?php endforeach; ?>
            </div>
        </div>
    <?php } ?>

<?php } ?>
