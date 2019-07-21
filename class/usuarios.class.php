<?php

 class Usuarios {

   //retorna a quantidade de usuarios que estao
    //cadastrados no banco de dados.
    public function getTotalUsuarios() {
      global $pdo;
      
      $sql = $pdo->query("select count(*) as c from tb_usuarios");
      $row = $sql->fetch();

      return $row['c'];
  }
 
    public function cadastrar($nome, $email, $senha, $telefone) {
         global $pdo;
         $sql = $pdo->prepare("SELECT id FROM tb_usuarios where email = :email");
         $sql->bindValue(":email", $email);
         $sql->execute();

         if($sql->rowCount() === 0) {
            $sql = $pdo->prepare("INSERT INTO tb_usuarios SET nome = :nome, email = :email,senha = :senha,telefone = :telefone");
            $sql->bindValue(":nome", $nome);
            $sql->bindValue(":email", $email);
            $sql->bindValue(":senha", md5($senha));
            $sql->bindValue(":telefone", $telefone);
            $sql->execute();
            return true;
         } else {
            return false;
         }
      }

      public function login($email, $senha) {
         global $pdo;

         $sql =  $pdo->prepare("SELECT id FROM tb_usuarios WHERE email = :email AND senha = :senha");
         $sql->bindValue(":email", $email);
         $sql->bindValue(":senha", md5($senha));
         $sql->execute();

         if($sql->rowCount() > 0) {
            $dado = $sql->fetch();
            $_SESSION['cLogin'] = $dado['id'];

            return true;
         } else {
            return false;
         }
      }

   }
?>