<?php

namespace App\Controller;

class ArtistsController extends AppController {

    // personnalise la façon dont on veut paginner
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

    public function view($id) {
        // recupère les infos de l'artiste qui a l'id, avec en plus ses albums 
        // contain liaison en cake possible parce qu'on a déclaré la clef étrangère
        // $one = $this->Artists->get($id);
        $one = $this->Artists->get($id, [
            'contain' => 'Albums'
        ]);
        /* $one = $this->Artists->get($id, [
            'contain' => ['Albums.Users']
        ]); */

        $query = $this->Artists->Albums->find();
        /* $query = $this->Movies->Comments->find()->where(['movie_id' => $id]);
        $query->select(['moyenne' => $query->func()->avg('grade')]); */

        /* // on crée une entité vide pour un commentaire
        $c = $this->Movies->Comments->newEntity(); */

        // cree la variable $artist pour la vue (elle contiendra la valeur de $one)
        $this->set(['artist' => $one, 'albums' => $query]);
        /* $this->set(['movie' => $one, 'comment' => $c, 'query' => $query->first()]); */
    }
}