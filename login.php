<?php require 'pages/header.php'; ?>
<div class="container">
    <h1>Login</h1>
    <?php 
     require 'class/usuarios.class.php';
     $u = new Usuarios();
     if (isset($_POST['email']) && !empty($_POST['email'])) {
        $email = addslashes($_POST['email']);
        $senha = $_POST['senha'];
        
        if($u->login($email, $senha)){
            ?>
             <script type="text/javascript">window.location.href="./";</script>
            <?php
        } else {
            ?>
             <div class="alert alert-danger">
                 Usuário e/ou senha inválidos!
             </div>
            <?php
        }

     }
    ?>

    <form action="" method="post">
        <div class="form-group">
          <label for="email">E-mail:</label>
          <input type="email" name="email" id="email" class="form-control" placeholder="Digite seu melhor email..." 
          aria-describedby="helpId">
          <!-- <small id="helpId" class="text-muted">Digite seu melhor email</small> -->
        </div>
        <div class="form-group">
          <label for="senha">Senha:</label><br>
          <input type="password" name="senha" id="senha" class="form-control" placeholder="******" 
          aria-describedby="helpId">
            <br>
          <input type="submit" value="Entrar" class="btn btn-default">
        </div>
    </form>


</div>
<?php require 'footer.php'; ?>