
<?php require 'config.php'; ?>

<!doctype html>
<html lang="pt-br">
<head>
  <meta charset="UTF-8">
  <meta name="viewport"
        content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <title>Classificados</title>
  <!--  STYLESHEETS -->
  <link rel="stylesheet" href="assets/css/bootstrap.min.css">
  <link rel="stylesheet" href="assets/css/style.css">

  <style>
  @media (min-width: 768px) {.navbar {border-radius: 0px!important;border: none!important;}}
  a {color: #333333;} a:hover{text-decoration: none;color: #333333;}
  </style>
</head>
<body>

<nav class="navbar navbar-inverse">
  <div class="container-fluid">
    <div class="navbar-header">
      <a href="./" class="navbar-brand link">Classificados</a>
    </div>

    <ul class="nav navbar-nav navbar-right">
    
     <?php if(isset($_SESSION['cLogin']) && !empty($_SESSION['cLogin'])) {?>

      <li><a href="meus-anuncios.php"class="link">Meus Anúncios</a></li>
      <li><a href="logout.php"class="link">Sair</a></li>

     <?php } else {?>
     
      <li><a href="cadastre-se.php" class="link">Cadastre-se</a></li>
      <li><a href="login.php" class="link">Login</a></li>
     
      <?php } ?>
    </ul>
  </div>
</nav>