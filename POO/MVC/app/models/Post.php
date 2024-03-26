<?php 
//  Toujours nommer les fichiers modèles au singulier pour ne pas les confondre avec les cntrollers 
class Post {
    private $db;

    public function __construct(){
        $this->db = new Database;
    }


    public function getPosts(){
        $this->db->query('SELECT * FROM posts');

        return $this->db->findAll();
    }
 
}