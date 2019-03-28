<?php

namespace App\Model\Table;

use Cake\ORM\Table;
use Cake\Validation\Validator;

class RequestsTable extends Table {
    
    public function initialize(array $config) {
        // demande à Cake de gérer les created et modified
        // addBehavior fait le lien avec timestamp existant déjà dans cake
        $this->addBehavior('Timestamp');

        // une requête appartient à un user (ils sont liés par la colonne user_id)
        $this->belongsTo('Users', [
            'foreignKey' => 'user_id',
            'joinType' => 'INNER'
        ]);
    }

    // ennonce les règles de validation pour ce type de data
    // on surchage la methode validationDefault existant déjà dans la class Table dont ArtistsTable hérite
    public function validationDefault(Validator $v) {
        $v->notEmpty('status')
            ->allowEmpty('artistname')
            ->maxLength('artistname', 100)
            ->allowEmpty('albumtitle')
            ->maxLength('albumtitle', 100);
        return $v;
    }
}