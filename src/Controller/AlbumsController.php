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

    public function edit($id) {
        $album = $this->Albums->get($id);

        // on autorise la methode put pour la modification
        if ($this->request->is(['post', 'put'])) {
            // en ne stockant pas le patchEntity dans une variable, il redonne seulement les champs qui ont été modifiés
            $this->Albums->patchEntity($album, $this->request->getData());
            if($this->Albums->save($album)) {
                $this->Flash->success('Ok');

                // redirige vers la page de cet album
                return $this->redirect(['action' => 'view', $album->id]);
            }
            $this->Flash->error('Modif plantée');
        }

        //envoie la variable à la vue
        $this->set(compact('album'));
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

    public function deleteImage($id) {

        if ($this->request->is('post')) {
            $album = $this->Albums->get($id);
            $cover = $album->cover;

            // suppresion de l'ancien cover
            // on recré le chemin vers le fichier
            $old_address = WWW_ROOT.'/data/covers/'.$cover;
            //si le nom de fichier n'est pas vide et que le fichier existe
            if (!empty($cover) && file_exists($old_address)) {
                // supprime le fichier en local
                unlink($old_address);
            }

            $album->cover = null;

            if($this->Albums->save($album)) {
                $this->Flash->success('Image d\'album supprimé');
                // redirige vers la page de cette citation
                return $this->redirect(['action' => 'view', $album->id]);
            } 
            else {
                $this->Flash->error('Suppression plantée');
                // redirige vers la page de cette citation
                return $this->redirect(['action' => 'view', $album->id]);
            }
        } else { // sinon on déclenche une erreur 400 parsonnalisée
            throw new NotFoundException('Access denied, try again)');
        }

    }

}