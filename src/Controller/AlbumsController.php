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

    public function add ($artist_id) {
        $new = $this->Albums->newEntity();

        if ($this->request->is('post')) {
            $new = $this->Albums->patchEntity($new, $this->request->getData());

            $new->artist_id = $artist_id;

            // si le fichier correspond à l'un des types autorisés
            if(in_array($this->request->data['cover']['type'], array('image/png', 'image/jpg', 'image/jpeg', 'image/gif'))) {
                
                // recupere l'extension qui était utilisée
                $ext = pathinfo($this->request->getData('cover')['name'], PATHINFO_EXTENSION);
                // création du nouveau nom
                $name = 'a-'.rand(0,3000).'-'.time().'.'.$ext;

                // reconstitution du chemin global du fichier
                $adress = WWW_ROOT.'/data/covers/'.$name;

                // valeur a enregistrer dans la base
                $new->cover = $name;

                // on le deplace de la mémoire temporaire vers l'emplacement souhaité
                move_uploaded_file($this->request->getData('cover')['tmp_name'], $adress);

            } else {
                $new->cover = null;
                $this->Flash->error('Ce format de fichier n\'est pas autorisé');
            }

            if($this->Albums->save($new)) {
                $this->Flash->success('L\'album a été sauvegardé');
                // on redirige vers la page de l'album enregistré
                return $this->redirect(['controller' => 'artists', 'action' => 'view', $new->artist_id]);
            }
            $this->Flash->error('Try again');
        }

        //envoie la variable à la vue
        $this->set(compact('new'));
    }

    public function delete($id) {

        if ($this->request->is(['post', 'delete'])) {
            // on récupère l'élément ciblé
            $album = $this->Albums->get($id);

            // on stocke l'id de l'artiste dans une variable
            $artist_id = $album->artist_id;
            
            if ($this->Albums->delete($album)) {
                $this->Flash->success('Supprimé');
                return $this->redirect(['controller' => 'artists', 'action' => 'view', $artist_id]);
            } else {
                $this->Flash->error('Suppression plantée');
                // redirige vers la page de cet album
                return $this->redirect(['action' => 'view', $id]);
            }
        } else { // sinon on déclenche une erreur 400 parsonnalisée
            throw new NotFoundException('Méthode interdite (c\'est pas beau de tricher)');
        }
        
    }

}