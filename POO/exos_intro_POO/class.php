<?php

class User {

//  définir une propriété de la classe
// De manière générale, les propriétés sont définies en privé pour éviter les modifications directes ( respecter le principe d'encapsulation)
    public $name;

//  définir une méthode de la classe
    public function sayHello() {
        //  $this fait au contexte appelant CAD par l'intermédiaire ed quelle instance de la classe on appelle la méthode
        return $this->name . ' says Hello';
    }
}


//  instancier la classe
$user1 = new User();
// affecter une valeur à la propriété $name de la classe (!!!!!!! normalement on doit passer par un setteur pour respecter le principe d'encapsulation)
$user1->name = 'Didier';
echo $user1->name;
echo $user1->sayHello();
echo '<br>';
echo '---------------------';



$user2 = new User();

$user2->name = 'Franck';
echo $user2->name;
echo $user2->sayHello();