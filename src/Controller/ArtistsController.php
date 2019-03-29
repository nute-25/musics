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

        // on récupère et on stock dans une variable le favoris s'il existe pour cet user de l'artiste
        $bookmark = $this->Artists->Bookmarks->find('all', 
                                        array('conditions'=>array('Bookmarks.artist_id'=>$id, 'Bookmarks.user_id'=>$this->Auth->user('id'))));

        // on récupère l'ensemble des favoris s'il en existe pour cet artiste
        $bookmarks = $this->Artists->Bookmarks->find('all', 
                                        array('conditions'=>array('Bookmarks.artist_id'=>$id)));
        // cree la variable $artist pour la vue (elle contiendra la valeur de $one)
        $this->set(['artist' => $one, 'bookmark' => $bookmark->first(), 'bookmarks' => $bookmarks->count()]);
    }

    public function add() {
        // on créé une entité vide
        $new = $this->Artists->newEntity();

        if ($this->request->is('post')) {
            // patchEntity recupére les données saisies par l'user dans le form et l'envoi vers l'objet Artists puis la BDD
            //on met les données de l'utilisateur dans l'objet $new
            $new = $this->Artists->patchEntity($new, $this->request->getData());

            // si le fichier correspond à l'un des types autorisés
            if(in_array($this->request->data['picture']['type'], array('image/png', 'image/jpg', 'image/jpeg', 'image/gif'))) {
                
                // recupere l'extension qui était utilisée
                $ext = pathinfo($this->request->getData('picture')['name'], PATHINFO_EXTENSION);
                // création du nouveau nom
                $name = 'a-'.rand(0,3000).'-'.time().'.'.$ext;

                // reconstitution du chemin global du fichier
                $adress = WWW_ROOT.'/data/pictures/'.$name;

                // valeur a enregistrer dans la base
                $new->picture = $name;

                // on le deplace de la mémoire temporaire vers l'emplacement souhaité
                move_uploaded_file($this->request->getData('picture')['tmp_name'], $adress);

            } else {
                $new->picture = null;
                $this->Flash->error('Ce format de fichier n\'est pas autorisé');
            }

            // si la sauvegarde fonctionne, on confirme et on redirige vers la liste globale des artistes
            if($this->Artists->save($new)) {
                // les messages flash sont enregistrés en mémoire tant qu'ils ne sont pas affichés sur une page
                $this->Flash->success('Ok');

                return $this->redirect(['action' => 'index']);
            }

            // [pour qu'on arrive ici, la sauvegarde a planté] on gueule sur l'internaute
            $this->Flash->error('Planté');
        }

        //envoie la variable à la vue
        $this->set(compact('new'));
    }

    public function edit($id) {
        $artist = $this->Artists->get($id);

        // on autorise la methode put pour la modification
        if ($this->request->is(['post', 'put'])) {
            // en ne stockant pas le patchEntity dans une variable, il redonne seulement les champs qui ont été modifiés
            $this->Artists->patchEntity($artist, $this->request->getData());
            if($this->Artists->save($artist)) {
                $this->Flash->success('Ok');

                // redirige vers la page de cet artiste
                return $this->redirect(['action' => 'view', $artist->id]);
            }
            $this->Flash->error('Modif plantée');
        }

        //envoie la variable à la vue
        $this->set(compact('artist'));
    }

    public function delete($id) {

        if ($this->request->is(['post', 'delete'])) {
            // on récupère l'élément ciblé
            $artist = $this->Artists->get($id);

            if ($this->Artists->delete($artist)) {
                $this->Flash->success('Supprimé');
                return $this->redirect(['action' => 'index']);
            } else {
                $this->Flash->error('Suppression plantée');
                // redirige vers la page de cet artiste
                return $this->redirect(['action' => 'view', $id]);
            }
        } else { // sinon on déclenche une erreur 400 parsonnalisée
            throw new NotFoundException('Méthode interdite (c\'est pas beau de tricher)');
        }
        
    }

    public function editImage($id) {
        $artist = $this->Artists->get($id);
        $old_picture = $artist->picture;

        // on autorise la methode put pour la modification
        if ($this->request->is(['post', 'put'])) {
            // en ne stockant pas le patchEntity dans une variable, il redonne seulement les champs qui ont été modifiés
            $this->Artists->patchEntity($artist, $this->request->getData());

            // si le fichier correspond à l'un des types autorisés
            if(!empty($this->request->getData()['picture']['name']) && in_array($this->request->data['picture']['type'], array('image/png', 'image/jpg', 'image/jpeg', 'image/gif'))) {
                
                // recupere l'extension qui était utilisée
                $ext = pathinfo($this->request->getData('picture')['name'], PATHINFO_EXTENSION);
                // création du nouveau nom
                $name = 'a-'.rand(0,3000).'-'.time().'.'.$ext;
                // reconstitution du chemin global du fichier
                $adress = WWW_ROOT.'/data/pictures/'.$name;
                // valeur a enregistrer dans la base
                $artist->picture = $name;
                // on le deplace de la mémoire temporaire vers l'emplacement souhaité
                move_uploaded_file($this->request->getData('picture')['tmp_name'], $adress);

                if($this->Artists->save($artist)) {

                    // suppresion de l'ancien picture
                    // on recré le chemin vers le fichier
                    $old_address = WWW_ROOT.'/data/pictures/'.$old_picture;
                    //si le nom de fichier n'est pas vide et que le fichier existe
                    if (!empty($old_picture) && file_exists($old_address)) {
                        // supprime le fichier en local
                        unlink($old_address);
                    }
    
                    $this->Flash->success('Ok');
                    // redirige vers la page de cette citation
                    return $this->redirect(['action' => 'view', $artist->id]);
                } 

            } else {
                $artist->picture = $old_picture;
                $this->Flash->error('Ce format de fichier n\'est pas autorisé');
            }
 
        }
        //envoie la variable à la vue
        $this->set(compact('artist'));
    }

    public function deleteImage($id) {

        if ($this->request->is('post')) {
            $artist = $this->Artists->get($id);
            $picture = $artist->picture;

            // suppresion de l'ancien picture
            // on recré le chemin vers le fichier
            $old_address = WWW_ROOT.'/data/pictures/'.$picture;
            //si le nom de fichier n'est pas vide et que le fichier existe
            if (!empty($picture) && file_exists($old_address)) {
                // supprime le fichier en local
                unlink($old_address);
            }

            $artist->picture = null;

            if($this->Artists->save($artist)) {
                $this->Flash->success('Image d\'artiste supprimé');
                // redirige vers la page de cette citation
                return $this->redirect(['action' => 'view', $artist->id]);
            } 
            else {
                $this->Flash->error('Suppression plantée');
                // redirige vers la page de cette citation
                return $this->redirect(['action' => 'view', $artist->id]);
            }
        } else { // sinon on déclenche une erreur 400 parsonnalisée
            throw new NotFoundException('Access denied, try again)');
        }

    }
}