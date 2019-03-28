<?php

namespace App\Model\Table;

use Cake\ORM\Table;
use Cake\Validation\Validator;

class ArtistsTable extends Table {
    
    public function initialize(array $config) {
        // demande à Cake de gérer les created et modified
        // addBehavior fait le lien avec timestamp existant déjà dans cake
        $this->addBehavior('Timestamp');
        $this->addBehavior('Picture');

        // un artiste peut avoir plusieurs albums (liés par artist_id)
        $this->hasMany('Albums', [
            'foreignKey' => 'artist_id',
            'dependent' => true,
            'cascadeCallbacks' => true
        ]);
        // un artiste peut être plusieurs fois favoris (liés par artist_id)
        $this->hasMany('Bookmarks', [
            'foreignKey' => 'artist_id',
            'dependent' => true,
            'cascadeCallbacks' => true
        ]);
    }

    // ennonce les règles de validation pour ce type de data
    // on surchage la methode validationDefault existant déjà dans la class Table dont MoviesTable hérite
    public function validationDefault(Validator $v) {
        $v->notEmpty('pseudonym')
            ->maxLength('pseudonym', 100)
            ->allowEmpty('debut')
            ->allowEmpty('country')
            ->maxLength('country', 100)
            ->allowEmpty('spotify')
            ->maxLength('spotify', 300)
            ->allowEmpty('picture')
            ->maxLength('picture', 50);
        return $v;
    }
}