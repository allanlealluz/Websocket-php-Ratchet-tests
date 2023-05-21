<?php

class Core{
    function __construct(){
        $this->run();
    }
    public function run(){
        if(isset($_GET['url'])){
            $url = $_GET['url'];
            $url = explode('/',$url);
            $parametros = array();

            $controller = $url[0].'Controller';
            array_shift($url);
            if(!empty($url)){
                $method = $url[0];
            array_shift($url);
            }else{
                $method = 'index';
            }
            if(count($url) > 0){
                $parametros = $url;
            }
        }else{
            $method = 'index';
            $controller = 'indexController';
            $parametros = array();
        }
        $caminho = 'WEBSOCKET-TESTS2/Controller/'.$controller.'.php';
        if(!file_exists($caminho) && !method_exists($controller,$method)){
            $controller = 'indexController';
            $method = 'index';
        }
        $c = new $controller;
        call_user_func_array(array($c,$method),$parametros);
    }
}