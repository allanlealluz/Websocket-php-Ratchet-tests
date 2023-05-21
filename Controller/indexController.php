<?php
class indexController extends Controller {
    function index(){
        $t = new Connection('chatsocket','localhost','root','');
        $this->carregarTemplate('main');
    }
    function register(){
        $t = new Connection('chatsocket','localhost','root','');
        if(!empty($_POST)){
            $name = htmlentities(addslashes($_POST['name']));
            $email = htmlentities(addslashes($_POST['email']));
            $password = htmlentities(addslashes($_POST['senha']));
            if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
                echo "Por favor, digite um email válido.";
            }else{
                $t->addUser($name,$email,$password);
            }
            
            
        }
        $this->carregarTemplate('register');
    }
    function login(){
        $t = new Connection('chatsocket','localhost','root','');
        if(!empty($_POST))
        {
            $email = htmlentities(addslashes($_POST['email']));
            $password = htmlentities(addslashes($_POST['password']));
            if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
                echo "Por favor, digite um email válido.";
            }else{
                $t->Login($email,$password);                             
                header("Location:/websocket-tests2/index");
            }     
        }
        $this->carregarTemplate('login');
    }
}