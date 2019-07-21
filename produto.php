<?php require 'pages/header.php'; ?>

<?php
require 'class/anuncios.class.php';
require 'class/usuarios.class.php';
$a = new Anuncios();
$u = new Usuarios();

if(isset($_GET['id']) && !empty($_GET['id'])) {
    $id = addslashes($_GET['id']);
} else {
    ?>
    <script type="text/javascript">window.location.href="index.php";</script>
    <?php
    exit;
}

$info = $a->getAnuncio($id);
?>

<div class="container-fluid">
  <div class="row">
    <div class="col-sm-4">
    
    <div class="carousel slide" data-ride="carousel" id="Carousel">
     <div class="carousel-inner" role="listbox">
         <?php foreach($info['fotos'] as $chave=> $foto) { ?>
            <div class="item <?php echo ($chave=='0')?'active':''; ?>">
                <img src="assets/imagens/anuncios/<?php echo $foto['url']; ?>">
            </div>
         <?php } ?>
     </div>
      <a class="left carousel-control" href="#Carousel" role="button" data-slide="prev"><span> < </span></a>
      <a class="right carousel-control" href="#Carousel" role="button" data-slide="next"><span> > </span></a>  
    </div>

    </div> <!--//col-sm-4-->
    <div class="col-sm-8">
    <h1><?php echo  utf8_encode($info['titulo']); ?></h1>
    <h4><?php echo utf8_encode($info['categoria']); ?></h4>
    <p><?php echo $info['descricao']; ?></p>
    <br><br>
    <h3>R$ <?php echo number_format($info['valor'], 2); ?></h3>
    <h4>Telefone: <?php echo $info['telefone']; ?></h4>
    </div> <!--//col-sm-8-->
  </div> <!--row-->
</div> <!--//container-fluid-->

<?php require 'footer.php'; ?>