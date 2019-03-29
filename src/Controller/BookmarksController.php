<?php

namespace App\Controller;

use Cake\Http\Exception\NotFoundException;

class BookmarksController extends AppController {
    
    public function index() {
        // on récupère ce qu'on a dans la BDD
        $b = $this->Bookmarks->find();
        $this->set(compact('b'));
    }

    public function add ($artist_id) {
        $new = $this->Bookmarks->newEntity();

        $new->artist_id = $artist_id;
        $new->user_id = $this->Auth->user('id');

        if($this->Bookmarks->save($new)) {
            $this->Flash->success('L\'artiste a été ajouté à vos favoris');
            // on redirige vers la page de l'artiste
            return $this->redirect(['controller' => 'artists', 'action' => 'view', $new->artist_id]);
        }
        $this->Flash->error('Try again');

        //envoie la variable à la vue
        $this->set('bookmark', $new);
    }

    public function delete($id) {

        if ($this->request->is(['post', 'delete'])) {
            // on récupère l'élément ciblé
            $bookmark = $this->Bookmarks->get($id);

            // on stocke l'id de l'artiste dans une variable
            $artist_id = $bookmark->artist_id;
            
            if ($this->Bookmarks->delete($bookmark)) {
                $this->Flash->success('Supprimé');
            } else {
                $this->Flash->error('Suppression plantée');
            }
            return $this->redirect(['controller' => 'artists', 'action' => 'view', $artist_id]);
        }else { // sinon on déclenche une erreur 400 parsonnalisée
            throw new NotFoundException('Méthode interdite (c\'est pas beau de tricher)');
        }
        
    }
}