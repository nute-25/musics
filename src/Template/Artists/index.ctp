<?php 
/* echo '<pre>';
var_dump($artists, count($artists));
echo '</pre>'; */

/* echo '<pre>';
var_dump($auth->user('status'));
echo '</pre>'; */
?>

<p>Il y a 
    <?php if($artists->count() > 1) { ?>
        <?= $artists->count().' artistes.' ?>
    <?php } else { ?>
        <?= $artists->count().' artiste.' ?>
    <?php } ?> 
</p>

<?php if($auth->user('status') === 'admin') { 
    echo $this->HTML->link('Ajouter un artiste', ['action' => 'add']);
}?>

<div class="container_list">
    <div class="list">
        <?php foreach($artists as $key => $uneLigne) : ?>
            <figure>
                <?php if (!empty($uneLigne->picture)) { ?>
                    <?= $this->HTML->image('../data/pictures/'.$uneLigne->picture, ['alt' => 'photo de '.$uneLigne->pseudonym]) ?>
                <?php } else { ?>
                    <!-- default.jpg se trouve dans webroot/img -->
                    <?= $this->HTML->image('default.jpg', ['alt' => 'Visuel non disponible' ]) ?>
                <?php } ?>
                <figcaption> 
                    <?= $this->Html->link($uneLigne->pseudonym, ['action' => 'view', $uneLigne->id]) ?>
                </figcaption>
            </figure>
        <?php endforeach; ?>
    </div>
</div>
<div class="pagination">
    <?php
        echo $this->Paginator->first('first');
        echo $this->Paginator->numbers();
        echo $this->Paginator->last('last');
    ?>
</div>


<h2>Top 5 des favoris :</h2>
<div class="container_list">
    <div class="list">
        <?php foreach($topartists as $key => $value) : ?>
            <figure>
                <?php if (!empty($value->picture)) { ?>
                    <?= $this->HTML->image('../data/pictures/'.$value->picture, ['alt' => 'photo de '.$value->pseudonym]) ?>
                <?php } else { ?>
                    <!-- default.jpg se trouve dans webroot/img -->
                    <?= $this->HTML->image('default.jpg', ['alt' => 'Visuel non disponible' ]) ?>
                <?php } ?>
                <figcaption> 
                    <?= $this->Html->link($value->pseudonym, ['action' => 'view', $value->id]) ?>
                </figcaption>
            </figure>
        <?php endforeach; ?>
    </div>
</div>


<h2>Top 5 des challengers :</h2>
<div class="container_list">
    <div class="list">
        <?php foreach($topchallengers as $key => $value) : ?>
            <figure>
                <?php if (!empty($value->picture)) { ?>
                    <?= $this->HTML->image('../data/pictures/'.$value->picture, ['alt' => 'photo de '.$value->pseudonym]) ?>
                <?php } else { ?>
                    <!-- default.jpg se trouve dans webroot/img -->
                    <?= $this->HTML->image('default.jpg', ['alt' => 'Visuel non disponible' ]) ?>
                <?php } ?>
                <figcaption> 
                    <?= $this->Html->link($value->pseudonym, ['action' => 'view', $value->id]) ?>
                </figcaption>
            </figure>
        <?php endforeach; ?>
    </div>
</div>