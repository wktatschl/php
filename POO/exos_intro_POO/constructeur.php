<?php
class User {

        public $name;
        public $age;

        // Le constructeur est une méthode qui est appelée automatiquement à chaque fois qu'une nouvelle instance de la classe est créée, son rôle est d'initialiser les propriétés de la classe
        public function __construct($name, $age) {
            // __CLASS__ est une constante magique qui retourne le nom de la classe
            echo 'Class ' . __CLASS__ . ' instantiated<br>';
            $this->name = $name;
            $this->age = $age;
        }
  
        public function sayHello() {
            return $this->name . ' says Hello';
        }

//  Le destructeur est appelé automatiquement à la fin du script ou lorsque l'objet n'est plus référencé. 
//  généralement utilisé pour Fermer la connection aux BDD, supprimer des fichiers temporaires, etc.
        public function __destruct()
        {
            echo 'destructor ran...';
        }
    }
    
    $user1 = new User('Didier', 45);
    echo $user1->name . ' is ' . $user1->age . ' years old';