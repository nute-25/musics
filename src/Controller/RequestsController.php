<?php

namespace App\Controller;

class RequestsController extends AppController {
    
    public $paginate = [
        'limit' => 10,
        'order' => [
            'Requests.created' => 'asc'
        ]
    ];

    public function index() {
        $requests = $this->paginate($this->Requests);

        $this->set(compact('requests'));
    }

    public function add() {
        // on créé une entité vide
        $new = $this->Requests->newEntity();
        $new->user_id = $this->Auth->user('id');

        if ($this->request->is('post')) {
            // patchEntity recupére les données saisies par l'user dans le form et l'envoi vers l'objet Requests puis la BDD
            //on met les données de l'utilisateur dans l'objet $new
            $new = $this->Requests->patchEntity($new, $this->request->getData());

            // si la sauvegarde fonctionne, on confirme et on redirige vers la liste globale des demandes
            if($this->Requests->save($new)) {
                $this->Flash->success('Ok');
                return $this->redirect(['controller' => 'artists', 'action' => 'index']);
            }

            // [pour qu'on arrive ici, la sauvegarde a planté] on gueule sur l'internaute
            $this->Flash->error('Planté');
        }

        //envoie la variable à la vue
        $this->set(compact('new'));
    }
}