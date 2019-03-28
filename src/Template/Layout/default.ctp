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

    <?= $this->fetch('meta') ?>
    <?= $this->fetch('css') ?>
    <?= $this->fetch('script') ?>
</head>
<body>
    <header>
        <h1><?= $this->Html->link('Musics !', ['controller' => 'artists', 'action' => 'index']) ?></h1>
        <nav>
            <?= $this->Html->link('Ajouter un artiste', ['controller' => 'artists', 'action' => 'add'], [ 'class' => ($this->templatePath === 'Artists' && $this->template === 'add') ? 'active' : '']) ?>
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
