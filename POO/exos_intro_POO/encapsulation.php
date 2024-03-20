<?php

class User {
// Pour respecter le principes d'encapsulation, on doit modifier la visibilité des attributs de la classe en private

// private permet de rendre inaccessible l'attribut en dehors de la classe
// Pour y accèder on doit passer par un getter ou un setteur pour modifier sa valeur
    private $name;
    private $age;


    public function __construct($name, $age) {
    
        $this->name = $name;
        $this->age = $age;
    }
// Faire un getter et un setter pour chaque attribut de la classe
    public function getName() {
        return $this->name;
    }

    public function setName($name) {
        return $this->name = $name;
    }


    // Méthode magique __get pour accéder à un attribut privé et __set pour modifier la valeur d'un attribut privé

    // Ne pas prioriser cette méthode car ne respecte pas le pricipe de responsabilité unique (SRP) !!!! 

    public function __get($property) {
        if(property_exists($this, $property)) {
            return $this->$property;
        }
    }
    public function __set($property, $value) {
        if(property_exists($this, $property)) {
            $this->$property = $value;
        }
        return $this;

    }
}


$user1 = new User('Didier', 45);
// Pas possible d'aller directement modifier la valeur de l'attribut name car il est en private
// $user1->name = 'Franck';
echo $user1->getName();
$user1->setName('Franck');
echo $user1->getName();

echo $user1->__get('age');
$user1->__set('age', 40);
echo $user1->__get('age');