<?php
//  Les classes détinées à être héritées doivent déclarées leurs propriétés et méthodes en protected ou en public
class User
{
    protected $name;
    protected $age;

    public function __construct($name, $age)
    {
        $this->name = $name;
        $this->age = $age;
    }
}

// Pour faire hériter une autre classe on utilise le mot clé extends
class Customer extends User
{
    private $wallet;

    public function __construct($name, $age, $wallet)
    {
        // Faire hériter le constructeur de la classe parente
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
echo $c1->pay(100);
echo $c1->getWallet();
