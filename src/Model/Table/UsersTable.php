<?php
// src/Model/Table/UsersTable.php

namespace App\Model\Table;

use Cake\ORM\Table;
use Cake\Validation\Validator;

class UsersTable extends Table {
    
    public function initialize(array $config) {
        // demande à Cake de gérer les created et modified
        // addBehavior fait le lien avec timestamp existant déjà dans cake
        $this->addBehavior('Timestamp');

        // un user peut avoir plusieurs favoris (liés par user_id)
        $this->hasMany('Bookmarks', [
            'foreignKey' => 'user_id',
            'dependent' => true,
            'cascadeCallbacks' => true
        ]);

        // un user peut avoir plusieurs demandes (liés par user_id)
        $this->hasMany('Requests', [
            'foreignKey' => 'user_id',
            'dependent' => true,
            'cascadeCallbacks' => true
        ]);
    }

    // ennonce les règles de validation pour ce type de data
    // on surchage la methode validationDefault existant déjà dans la class Table dont UsersTable hérite
    public function validationDefault(Validator $v) {
        $v->notEmpty('pseudo')
            ->maxLength('pseudo', 50)
            ->notEmpty('password')
            ->notEmpty('status');
        return $v;
    }
}