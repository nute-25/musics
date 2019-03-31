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
        $pending_requests = $this->Requests->find();
        $pending_requests->where(['status' => 'pending']);
        $pending_pagination = $this->paginate($pending_requests);

    	$accepted_requests = $this->Requests->find();
        $accepted_requests->where(['status' => 'accept']);
        $accepted_pagination = $this->paginate($accepted_requests);

    	$declined_requests = $this->Requests->find();
        $declined_requests->where(['status' => 'decline']);
        $declined_pagination = $this->paginate($declined_requests);

        $this->set(compact('accepted_pagination', 'declined_pagination', 'pending_requests', 'accepted_requests', 'declined_requests'));
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

    public function accept($id) {
    	$accepted_request = $this->Requests->get($id);
        if ($this->request->is(['post', 'put'])) {
            $this->Requests->patchEntity($accepted_request, $this->request->getData());
            $accepted_request->status= 'accept';
            if ($this->Requests->save($accepted_request)) {
                $this->Flash->success('Modif ok');
                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error('Modif plantée');
        }
    }
    
    public function decline($id) {
    	$declined_request = $this->Requests->get($id);
        if ($this->request->is(['post', 'put'])) {
            $this->Requests->patchEntity($declined_request, $this->request->getData());
            $declined_request->status = 'decline';
            if ($this->Requests->save($declined_request)) {
                $this->Flash->success('Modif ok');
                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error('Modif plantée');
        }
    }
}