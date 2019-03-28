<?php

namespace App\Model\Behavior;

use Cake\ORM\Behavior;
use Cake\ORM\Entity;
use Cake\Event\Event;
use Cake\Datasource\EntityInterface;
use ArrayObject;

class PictureBehavior extends Behavior {
    //indique sur quelle colonne on travaille
    protected $_defaultConfig = [
        'field' => 'picture'
    ];

    //fonction qui sera appeler à chaque fois que l'on utilisera la méthode ->delete sur un enregistrement artist
    //entity l'objet qu'on va supprimer en base
    public function beforeDelete(Event $event, EntityInterface $entity, ArrayObject $options) {

        // on recré le chemin vers le fichier
        $address = WWW_ROOT.'/data/pictures/'.$entity->picture;

        //si le nom de fichier n'est pas vide et que le fichier existe
        if (!empty($entity->picture) && file_exists($address)) {
            // supprime le fichier en local
            unlink($address);
        }

        return true;
    }
}