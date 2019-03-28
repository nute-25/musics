<?php

namespace App\Controller;

class BookmarksController extends AppController {
    
    public function index() {
        // on récupère ce qu'on a dans la BDD
        $b = $this->Bookmarks->find();
        $this->set(compact('b'));
    }

}