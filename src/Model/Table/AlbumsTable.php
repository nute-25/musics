<?php

namespace App\Model\Table;

use Cake\ORM\Table;
use Cake\Validation\Validator;

class AlbumsTable extends Table {
    
    public function initialize(array $config) {
        // demande à Cake de gérer les created et modified
        // addBehavior fait le lien avec timestamp existant déjà dans cake
        $this->addBehavior('Timestamp');

        // un album appartient à un artiste (ils sont liés par la colonne artist_id)
        $this->belongsTo('Artists', [
            'foreignKey' => 'artist_id',
            'joinType' => 'INNER'
        ]);
    }

    public function validationDefault(Validator $v) {
        $v->notEmpty('title')
            ->maxLength('title', 100)
            ->allowEmpty('cover')
            ->maxLength('cover', 50)
            ->allowEmpty('style')
            ->maxLength('style', 100)
            ->allowEmpty('spotify')
            ->maxLength('spotify', 300)
            ->allowEmpty('releaseyear');
        return $v;
    }
}