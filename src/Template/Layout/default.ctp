<?php
$cakeDescription = 'Plateforme de musiques';
?>
<!DOCTYPE html>
<html>
<head>
    <?= $this->Html->charset() ?>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>
    <?= $this->fetch('title') ?> - 
        <?= $cakeDescription ?>:
    </title>
    <?= $this->Html->meta('icon') ?>

    <?= $this->Html->css('reset.css') ?>
    <?= $this->Html->css('main.css') ?>
    <?= $this->Html->script('https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js') ?>
    <?= $this->Html->script('script.js') ?>

    <?= $this->fetch('meta') ?>
    <?= $this->fetch('css') ?>
    <?= $this->fetch('script') ?>
</head>
<body>
    <header>
        <h1><?= $this->Html->link('Musics !', ['controller' => 'artists', 'action' => 'index']) ?></h1>
        <nav>
            <?= $this->Html->link('Liste des artistes', ['controller' => 'artists', 'action' => 'index'], [ 'class' => ($this->templatePath === 'Artists' && $this->template === 'index') ? 'active' : '']) ?>
            <?php 
                if($auth->user()) {
                    if($auth->user('status') === 'admin') {
                        echo $this->Html->link('Liste des demandes', ['controller' => 'requests', 'action' => 'index'], [ 'class' => ($this->templatePath === 'Requests' && $this->template === 'index') ? 'active' : '']);
                        echo $this->Html->link('Ajouter un artiste', ['controller' => 'artists', 'action' => 'add'], [ 'class' => ($this->templatePath === 'Artists' && $this->template === 'add') ? 'active' : '']);
                    }
                    else {
                        echo $this->Html->link('Faire une demande d\'ajout', ['controller' => 'requests', 'action' => 'add'], [ 'class' => ($this->templatePath === 'Requests' && $this->template === 'add') ? 'active' : '']);
                    }
                }
            ?>
            <?= $this->Html->link('Liste des utilisateurs', ['controller' => 'users', 'action' => 'index'], [ 'class' => ($this->templatePath === 'Users' && $this->template === 'index') ? 'active' : '']) ?>
            <?php   // si l'utilisateur est non connecté
                if($auth->user() === NULL) {
                    echo $this->Html->link('Se connecter', ['controller' => 'users', 'action' => 'login'], [ 'class' => ($this->templatePath === 'Users' && $this->template === 'login') ? 'active' : '']);
                    echo $this->Html->link('Créer un compte utilisateur', ['controller' => 'users', 'action' => 'add'], [ 'class' => ($this->templatePath === 'Users' && $this->template === 'add') ? 'active' : '']);
                }
            ?>
            <?php   // si l'utilisateur est connecté
                if($auth->user() !== NULL) {
                    echo $this->Html->link('Espace utilisateur', ['controller' => 'users', 'action' => 'view', $auth->user('id')], [ 'class' => ($this->templatePath === 'Users' && $this->template === 'view') ? 'active' : '']);
                    echo $this->Html->link('Se deconnecter', ['controller' => 'users', 'action' => 'logout']);
                }
            ?>
        </nav>
    </header>
    <main>
       
        <!-- Affiche les messages pour l'utilisateur (et les vides de la mémoire) -->
        <div class="messages">
            <?= $this->Flash->render() ?>
        </div>
        
        <!-- affiche le contenu de cette page -->
        <?= $this->fetch('content') ?>
    </main>
    
    <footer>
    </footer>
</body>
</html>
