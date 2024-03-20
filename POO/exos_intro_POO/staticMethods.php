<?php
class User
{
    protected $name;
    protected $age;
    // propriété static qui ne dépend pas de l'instance de la classe mais de la CLASSE DIRECTEMENT, on y accède via le mon clé self::
    public static $miniLength = 6; 

    public function __construct($name, $age)
    {
        $this->name = $name;
        $this->age = $age;
    }

// méthode static qui peut être appelée sans instancier la classe avec nomDeLaClass::methodeStatic
public static function validate($str){
    if(strlen($str) >= self::$miniLength){
        return true;
    } else {
        return false;
    }
}
}
$password = 'hello1';
if(User::validate($password)){
    echo 'Password is valid';
} else {
    echo 'Password is NOT valid';
}