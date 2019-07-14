<?php 

class Anuncios {
    public function getMeusAnuncios() {
        global $pdo;

        $array = array();
        $sql = $pdo->prepare("SELECT *, (select tb_anuncios_imagens.url from tb_anuncios_imagens where 
        tb_anuncios_imagens.id_anuncio = anuncio.id limit 1)
        as url FROM tb_anuncios WHERE id_usuario = :id_usuario");
        $sql->bindValue(":id_usuario", $_SESSION['cLogin']);
        $sql->execute();

        if($sql->rowCount() > 0) {
            $array = $sql->fetchAll();
        }

        return $array;
    }
}

?>