<?php

// Controller qui est appelé par defaut, il hérite du controller de base dans libraries/Controller 
class Pages extends Controller {

    public function __construct()
    {
 
    }

    public function index() {
        $data = [
            'title' => 'Bonjour ceci est la page index', 
            'content' => 'fqsdfqsdfqsdfqsdf'
        ];

        $this->render('index', $data);
    }

    public function about() {


        $this->render('about');

    }
}