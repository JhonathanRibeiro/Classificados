<?php require 'pages/header.php'; ?>

<?php
require 'class/anuncios.class.php';
require 'class/usuarios.class.php';
$a = new Anuncios();
$u = new Usuarios();

$total_anuncios = $a->getTotalAnuncios();
$total_usuarios = $u->getTotalUsuarios();
//página atual
$p = 1;
if(isset($_GET['p']) && !empty($_GET['p'])) {
  $p = addslashes($_GET['p']);
}
//quantidade de anuncios por pagina
$por_pagina = 4;
//controle de paginação
$total_paginas = ceil($total_anuncios / $por_pagina);

$anuncios = $a->getUltimosAnuncios($p, $por_pagina);
?>

<div class="container-fluid">
  <div class="jumbotron">
    <h2>Nós temos hoje <?php echo $total_anuncios; ?> anúncios!</h2>
    <p>E mais de  <?php echo $total_usuarios; ?> usuários cadastrados.</p>
  </div>
  <div class="row">
    <div class="col-sm-4">

      <h4>Pesquisa avançada</h4>

    </div>
    <div class="col-sm-8">

      <h4>Últmos anúncios</h4>
      <table class="table table-striped bg-white">
       <tbody>
       
       <?php foreach($anuncios as $anuncio) { ?>
        <tr>
        <td>
          <?php if(!empty($anuncio['url'])) { ?>
          <img src="assets/imagens/anuncios/<?php echo $anuncio['url'] ?>" height="38">
          <?php } else { ?>
          <img src="assets/imagens/default.jpg" height="38">
          <?php } ?>
        </td>
        <td>
          <!-- insere o nome do anuncio -->
          <a class="link-anuncio" href="produto.php?id=<?php echo $anuncio['id']; ?>"><?php echo $anuncio['titulo'] ?></a><br>
          <!-- retorna o nome da categoria do produto  -->
          <?php echo utf8_encode($anuncio['categoria']); ?>
        </td>
        <td>R$ <?php echo number_format($anuncio['valor'], 2); ?></td>        
        </tr>
       <?php } ?>
       </tbody>
      </table>
      <ul class="pagination">
        <?php for($q=1;$q<=$total_paginas;$q++) { ?>
          <li class="<?php echo ($p==$q)?'active':''; ?>"><a href="index.php?p=<?php echo $q ?>"><?php echo $q; ?> </a></li>          
        <?php } ?>
      </ul>
    </div>
  </div>
</div>

<?php require 'footer.php'; ?>