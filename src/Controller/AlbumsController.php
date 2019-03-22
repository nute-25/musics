<?php

namespace App\Controller;

class AlbumsController extends AppController {
    
    public function view($id) {
        // recupère les infos de l'album qui a l'id et appartient à tel artiste
        // contain liaison en cake possible parce qu'on a déclaré la clef étrangère
        $one = $this->Albums->get($id, [
            'contain' => 'Artists'
        ]);

        /* $query = $this->Movies->Comments->find()->where(['movie_id' => $id]);
        $query->select(['moyenne' => $query->func()->avg('grade')]); */

        /* // on crée une entité vide pour un commentaire
        $c = $this->Movies->Comments->newEntity(); */

        // cree la variable $artist pour la vue (elle contiendra la valeur de $one)
        $this->set('album', $one);
        /* $this->set(['movie' => $one, 'comment' => $c, 'query' => $query->first()]); */
    }

    /* public function add () {
        $new = $this->Comments->newEntity();

        if ($this->request->is('post')) {
            $new = $this->Comments->patchEntity($new, $this->request->getData());

            // USER : c'est l'id de celui qui est connecté
            $new->user_id = $this->Auth->user('id');

            if($this->Comments->save($new)) {
                $this->Flash->success('Le commentaire a été sauvegardé');
                // on redirige vers la page du film qu'on a commenté
                return $this->redirect(['controller' => 'movies', 'action' => 'view', $new->movie_id]);
            }
            $this->Flash->error('Try again');
        }
    } */
}