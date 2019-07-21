<?php require 'pages/header.php'; ?>

<?php 
 if(empty($_SESSION['cLogin'])) {
    ?>
    <script type="text/javascript">window.location.href="login.php";</script>
  <?php
  exit;
 }
 require 'class/anuncios.class.php';
 $a = new Anuncios();
 if(isset($_POST['titulo']) && !empty($_POST['titulo'])) {
     $titulo    = addslashes($_POST['titulo']);
     $categoria = addslashes($_POST['categoria']);
     $valor     = addslashes($_POST['valor']);
     $descricao = addslashes($_POST['descricao']);
     $estado    = addslashes($_POST['estado']);

     $a->addAnuncio($titulo, $categoria, $valor, $descricao, $estado);
  ?>
  <div class="alert alert-success">
  Produto adicionado com sucesso!
  </div>
  <?php
 }

?>

<div class="container">
<h2> <a href="meus-anuncios.php" >Meus Anúncios</a> <small>/ Novo Anúncio</small></h2>

  <form method="POST" enctype="multipart/form-data">
  
   <div class="form-group">
    <label for="categoria">Categoria:</label>
    <div class="form-group">      
      <select name="categoria" id="categoria" class="form-control">
        <?php 
         require "class/categorias.class.php";
          $c = new Categorias();
          $cats = $c->getLista();
          foreach($cats as $cat){
        ?>

         <option value="<?php echo $cat['id']; ?>">
         <?php echo utf8_encode($cat['nome']); ?>
         </option>

        <?php } ?>
      </select>
    </div>
   </div>

   <div class="form-group">
    <label for="categoria">Título:</label>
    <input type="text" name="titulo" id="titulo" class="form-control">
   </div>

   <div class="form-group">
    <label for="valor">Valor:</label>
    <input type="text" name="valor" id="valor" class="form-control">
   </div>

   <div class="form-group">
    <label for="descricao">Descrição:</label>
    <textarea name="descricao" class="form-control"></textarea>
   </div>

   <div class="form-group">
    <label for="estado">Estado:</label>
    <select name="estado" id="categoria" class="form-control">
        <option value="0">Ruim</option>
        <option value="1">Bom</option>
        <option value="2">Ótimo</option>
    </select>
   </div>
 <input type="submit" value="Adicionar" class="btn btn-default">
  </form>
</div>


<?php require 'footer.php'; ?>