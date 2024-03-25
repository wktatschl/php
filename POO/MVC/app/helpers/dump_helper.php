<?php
function dd($param){
    // array_map prend 2 params, le premier: une fonction call back qui effectue une action sur chaques params passés en deuxième argument de array_map
    // func_get_args permet de faire passer un nombre indéterminé de param à array_map fonctionne un peu comme le rest paramter en JS 
  array_map(function($ele){
        var_dump($ele);
    }, func_get_args());
  die();
}