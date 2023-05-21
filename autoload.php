<?php
spl_autoload_register(function($nome_arquivo){
    if(file_exists('Controller/'.$nome_arquivo.'.php')){
        require 'Controller/'.$nome_arquivo.'.php';
    }elseif(file_exists('Model/'.$nome_arquivo.'.php')){
        require 'Model/'.$nome_arquivo.'.php';
    }elseif(file_exists('Core/'.$nome_arquivo.'.php')){
        require 'Core/'.$nome_arquivo.'.php';
    }
});