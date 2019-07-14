<?php require 'pages/header.php'; ?>
<div class="container">
    <h1>Cadastre-se</h1>
    <?php 
     require 'class/usuarios.class.php';
     $u = new Usuarios();
     if (isset($_POST['nome']) && !empty($_POST['nome'])) {
        $nome = addslashes($_POST['nome']);
        $email = addslashes($_POST['email']);
        $senha = $_POST['senha'];
        $telefone = addslashes($_POST['telefone']);
        if (!empty($nome) && !empty($email) && !empty($senha)) {
            if($u->cadastrar($nome, $email, $senha, $telefone)){
              ?>
                <div class="alert alert-success">
                <strong>Parabéns!</strong>Cadastro efetuado com sucesso. <a href="login.php" class="alert-link">
                  Fazer Login
                </a>
                </div>
          <?php
            } else {
              ?>
                <div class="alert alert-warning">
                <strong>Ops!</strong>Já existe um usuário cadastrado com este email. <a href="login.php" class="alert-link">
                  Fazer Login
                </a>
                </div>
          <?php
            }
        } else {
          ?>
          <div class="alert alert-warning">
           Preencha todos os campos!
          </div>
          <?php
        }

     }
    ?>

    <form action="" method="post">
        <div class="form-group">
          <label for="nome">Nome:</label>
          <input type="text" name="nome" id="nome" class="form-control" placeholder="Digite seu nome..." 
          aria-describedby="helpId" autofocus>
          <!-- <small id="helpId" class="text-muted">Informe seu nome completo</small> -->
        </div>
        <div class="form-group">
          <label for="email">E-mail:</label>
          <input type="email" name="email" id="email" class="form-control" placeholder="Digite seu melhor email..." 
          aria-describedby="helpId">
          <!-- <small id="helpId" class="text-muted">Digite seu melhor email</small> -->
        </div>
        <div class="form-group">
          <label for="telefone">Telefone:</label>
          <input type="tel" name="telefone" id="telefone" class="form-control" placeholder="(40)99912-3456..." 
          aria-describedby="helpId">
          <!-- <small id="helpId" class="text-muted">Digite seu melhor email</small> -->
        </div>
        <div class="form-group">
          <label for="senha">Senha:</label>
          <input type="password" name="senha" id="senha" class="form-control" placeholder="" 
          aria-describedby="helpId">
          <!-- <small id="helpId" class="text-muted">Digite seu melhor email</small> -->
            <br>
          <input type="submit" value="Cadastrar" class="btn btn-default">
        </div>
    </form>


</div>
<?php require 'footer.php'; ?>