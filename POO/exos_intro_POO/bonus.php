<?php
class User
{
    protected $name;
    protected $age;
    public static $array = [];



    public function __construct($name, $age)
    {
        $this->name = $name;
        $this->age = $age;
        //  Stocker toutes les instances de la classe dans un tableau
        self::$array[] = $this;
    }
     public static function displayUsers(){
        foreach(self::$array as $user){
            echo $user->name . ' is ' . $user->age . ' years old<br>';
        }
    }

    public function getName(){
        return $this->name;
    
    }

}

class Customer extends User{
    private $wallet;

    public function __construct($name, $age, $wallet)
    {
        parent::__construct($name, $age);
        $this->wallet = $wallet;
    }

    public function pay($amount)
    {
        return $this->name . ' paid $' . $amount . ' for the product';
    }

    public function getWallet()
    {
        return $this->wallet;
    }
}
$c1 = new Customer('Didier', 45, 3000); 
$c2 = new Customer('Franck', 33, 3000); 
$c3 = new Customer('John', 65, 3000); 
$c4 = new Customer('Natacha', 32, 3000); 
$c5 = new Customer('Jason', 25, 3000); 

// Afficher tous les utilisateurs par l"intermédiaire de la prop static $array
// foreach(User::$array as $user){
//     echo $user->getName() . '<br>';
// }

// Afficher tous les utilisateurs par l'intermédiaire de la méthode static displayUsers
User::displayUsers();