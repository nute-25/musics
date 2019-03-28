<?php

namespace App\Model\Entity;

use Cake\ORM\Entity;

class Bookmark extends Entity {
    
    // tous est accessible et modifiable sauf l'id que l'on protège
    protected $_accessible = [
        '*' => true,
        'id' => false
    ];

}