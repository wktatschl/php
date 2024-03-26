<?php

// Controller qui est appelé par defaut, il hérite du controller de base dans libraries/Controller 

//  Toujours nommer les fichiers controller au pluriel pour ne pas les confondre avec les modèles 
class Pages extends Controller {
    private $postModel;


    public function __construct()
    {
        $this->postModel = $this->model('Post');
       
    }

    public function index() {
        

        $posts = $this->postModel->getPosts();
 
    
        
        $data = [
            'title' => 'Bonjour ceci est la page index', 
            'content' => 'fqsdfqsdfqsdfqsdf', 
            'posts' => $posts
        ];
      
     

        $this->render('index', $data);
    }



    public function about() {


        $this->render('about');

    }
}