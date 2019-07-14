<?php require 'pages/header.php'; ?>

<?php 
 if(empty($_SESSION['cLogin'])) {
    ?>
    <script type="text/javascript">window.location.href="login.php";</script>
  <?php
  exit;
 }
?>

<div class="container">
  <h2>Meus Anúncios <small>/ Novo Anúncio</small></h2>

  <form method="POST" enctype="multipart/form-data">
  
   <div class="form-group">
    <label for="categoria">Categoria:</label>
    <div class="form-group">      
      <select name="categoria" id="categoria" class="form-control">
        <option></option>
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
    <select name="categoria" id="categoria" class="form-contreol">
        <option value="0">Ruim</option>
        <option value="1">Bom</option>
        <option value="2">Ótimo</option>
    </select>
   </div>
 <input type="submit" value="Adicionar" class="btn btn-default">
  </form>
</div>


<?php require 'footer.php'; ?>