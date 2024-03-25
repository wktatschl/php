<?php
class Router {
    private $currentController = 'Pages';
    private $currentMethod = 'index';
    private $params = [];

    public function getUrl(){
        if(isset($_GET['url'])){
            // Supprimer les espace à droite après un /
            $url = rtrim($_GET['url'], '/');
            // clean l'url, empecher les injections 
            $url = filter_var($url, FILTER_SANITIZE_URL);
            // découper la chaîne renvoyé par l'url sous forme de tableau 
            $url = explode('/', $url);
            return $url;
        }
    }
    public function __construct(){
        // Appeler la méthode getUrl qui récupère l'url sous forme de tableau 
       $url = $this->getUrl();
       
       // Vérifier le premier param de l'url et appeler le bon controller 
       if (!empty($url) && isset($url[0]) && file_exists('../app/controllers/' . ucfirst($url[0] . '.php'))) {
           $this->currentController = ucfirst($url[0]);
           // On supprime le premier indice du tableau $url
           unset($url[0]);
        }
        // Instancier le controller courant 
        require_once '../app/controllers/'. $this->currentController . '.php';
        $this->currentController = new $this->currentController;
        
        // Vérifier le deuxième param de l'url pour charger la bonne méthode qui représente la page que l'on souhaite charger.
        if(isset($url[1])){
            if(method_exists($this->currentController, $url[1])){
                $this->currentMethod = $url[1];
                unset($url[1]);
            }
        }
        // Récupérer les derniers params 
        // array_values permet de remettre à 0 les indices du tableau $url
        $this->params = $url ? array_values($url) : [];
        
        // Appeler le controller en fonction des nos params 
        // Cette ligne fait charger le bon controller avec sa méthode et ses paramètres éventuels 
        call_user_func_array([$this->currentController, $this->currentMethod], $this->params);
    }
}