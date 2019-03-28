<?php

namespace App\Controller;

use Cake\Http\Exception\NotFoundException;

class UsersController extends AppController {

    public function initialize() {
        parent::initialize();
        //ajoute l'action 'add' de ce controller à la liste des actions autorisées sans être connecté
        $this->Auth->allow(['add']);
    }

    // affiche le contenu de la BDD
    public function index() {
        // affichage des utilisateurs classés par pseudo
        $u = $this->Users->find()->order('pseudo');
        $this->set(compact('u'));
    }

    public function add() {
        // on créé une entité vide
        $new = $this->Users->newEntity();

        if ($this->request->is('post')) {
            $new = $this->Users->patchEntity($new, $this->request->getData());

            if($this->Users->save($new)) {
                $this->Flash->success('Ok');
                return $this->redirect(['action' => 'index']);
            }

            // [pour qu'on arrive ici, la sauvegarde a planté] on gueule sur l'internaute
            $this->Flash->error('Try again');
        }

        $this->set(compact('new'));
    }

    public function login() {
        if ($this->request->is('post')) {
            // essaye de matcher avec un utilisateur de la base
            $user = $this->Auth->identify();

            if ($user) {
                // on le memorise en session
                $this->Auth->setUser($user);
                //on redirige vers la page d'avant
                return $this->redirect($this->Auth->redirectUrl());
            }
            $this->Flash->error('Votre identifiant ou votre mot de passe est incorrect.');
        }
    }

    public function logout() {
        $this->Flash->success('A bientôt');
        // return $this->redirect($this->Auth->logout());
        $this->Auth->logout();
        return $this->redirect(['controller' => 'Artists', 'action' => 'index']);
    }
}
