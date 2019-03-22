<?php

namespace App\Controller;

class ArtistsController extends AppController {

    public $paginate = [
        'limit' => 25,
        'order' => [
            'Artists.pseudonym' => 'asc'
        ]
    ];

    // affiche le contenu de la BDD
    public function index() {
        $artists = $this->paginate($this->Artists);
        // on transmet le contenu stocké dans $artists à la view
        $this->set(compact('artists'));
    }

}