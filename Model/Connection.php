<?php 
class Connection {
    private $pdo;

    public function __construct($dbname,$host,$user,$password)
    {
        try {
            $this->pdo = new PDO('mysql:dbname='.$dbname.';host='.$host,$user,$password);  
          } catch (Exception $ex) {
            echo $ex->getCode(),$ex->getMessage(),$ex->getLine();  
          }
    }
    public function addUser($nome,$email,$senha)
    {
       $cmd = $this->pdo->prepare("INSERT INTO usuarios (nome,email,senha) VALUES (:n,:e,:s)");
       $cmd->bindValue(':n' ,$nome);
       $cmd->bindValue(':e' ,$email);
       $cmd->bindValue(':s' ,md5($senha));
       $cmd->execute();
    }
    public function Login($email,$senha){
      $cmd = $this->pdo->prepare('SELECT * FROM usuarios WHERE email = :e AND senha = :s');
      $cmd->bindValue(':e',$email);
      $cmd->bindValue(':s',md5($senha));
      $cmd->execute();     
      if($cmd->rowCount() > 0){
        $dados = $cmd->fetch(PDO::FETCH_ASSOC);
        session_start();
            if($dados['id'] == 1 ) 
            {
                $_SESSION['admin'] = 1;
            }else{
                $_SESSION['user'] = $dados['id'];
            }      
           return true;
        }else{
            return false;
        }
    }
}