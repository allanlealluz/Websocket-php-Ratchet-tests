<?php
class Controller {
    public $dados;
    public function __construct(){
        $this->dados = array();
    }
    public function carregarTemplate($nomeView,$dadosModel = array()){
        $this->dados = $dadosModel;
        require 'View/template.php';

    }
    public function carregarViewNoTemplate($nomeView,$dadosModel = array()){
        extract($dadosModel);
        require 'View/'.$nomeView.'.php';
    }
}