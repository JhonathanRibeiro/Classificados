<?php 

class Anuncios {

    //retorna a quantidade de anuncios que estao
    //cadastrados no banco de dados.
    public function getTotalAnuncios() {
        global $pdo;
        
        $sql = $pdo->query("select count(*) as c from tb_anuncios");
        $row = $sql->fetch();

        return $row['c'];
    }

    public function getUltimosAnuncios($page, $perPage) {
        global $pdo;
        //pega a página atual dimminui um e multiplica pela
        //quantidade de anuncios
        $offset = ($page - 1) * $perPage;

        $array = array();
        $sql = $pdo->prepare("SELECT *, 
        (select tb_anuncios_imagens.url from tb_anuncios_imagens where 
        tb_anuncios_imagens.id_anuncio = tb_anuncios.id limit 1)
        as url,
        (select tb_categorias.nome from tb_categorias where 
        tb_categorias.id = tb_anuncios.id_categoria) as categoria
         FROM tb_anuncios order by id desc limit $offset,$perPage");
        $sql->execute();

        if($sql->rowCount() > 0) {
            $array = $sql->fetchAll();
        }

        return $array; 
    }

    public function getMeusAnuncios() {
        global $pdo;

        $array = array();
        $sql = $pdo->prepare("SELECT *, (select tb_anuncios_imagens.url from tb_anuncios_imagens where 
        tb_anuncios_imagens.id_anuncio = tb_anuncios.id limit 1)
        as url FROM tb_anuncios WHERE id_usuario = :id_usuario");
        $sql->bindValue(":id_usuario", $_SESSION['cLogin']);
        $sql->execute();

        if($sql->rowCount() > 0) {
            $array = $sql->fetchAll();
        }

        return $array;
    }

    public function getAnuncio($id) {
        $array = array();
        global $pdo;

        $sql = $pdo->prepare("SELECT *,
        (select tb_categorias.nome from tb_categorias where 
        tb_categorias.id = tb_anuncios.id_categoria) as categoria,
        (select tb_usuarios.telefone from tb_usuarios where 
        tb_usuarios.id = tb_anuncios.id_usuario) as telefone
        FROM tb_anuncios WHERE id = :id");
        $sql->bindValue(":id", $id);
        $sql->execute();

        if($sql->rowCount() > 0) {
            $array = $sql->fetch();
            $array['fotos'] = array();
        
        //pesquisa de imagens
        $sql = $pdo->prepare("SELECT id,url FROM tb_anuncios_imagens WHERE id_anuncio = :id_anuncio");
        $sql->bindValue(":id_anuncio", $id);
        $sql->execute();
        
        if($sql->rowCount() > 0){
            $array['fotos'] = $sql->fetchAll();
        }

        }

        return $array;
    }


    public function addAnuncio($titulo, $categoria, $valor, $descricao, $estado) {
        global $pdo;

        $sql = $pdo->prepare("INSERT INTO tb_anuncios SET titulo = :titulo,
        id_categoria = :id_categoria, id_usuario = :id_usuario, descricao = :descricao,
        valor = :valor, estado = :estado");
        $sql->bindValue(":titulo", $titulo);
        $sql->bindValue(":id_categoria", $categoria);
        $sql->bindValue(":id_usuario", $_SESSION['cLogin']);
        $sql->bindValue(":descricao", $descricao);
        $sql->bindValue(":valor", $valor);
        $sql->bindValue(":estado", $estado);
        $sql->execute();
    }

    public function editAnuncio($titulo, $categoria, $valor, $descricao, $estado, $fotos, $id) {
        global $pdo;

        $sql = $pdo->prepare("UPDATE tb_anuncios SET titulo = :titulo,
        id_categoria = :id_categoria, id_usuario = :id_usuario, descricao = :descricao,
        valor = :valor, estado = :estado WHERE id = :id");
        $sql->bindValue(":titulo", $titulo);
        $sql->bindValue(":id_categoria", $categoria);
        $sql->bindValue(":id_usuario", $_SESSION['cLogin']);
        $sql->bindValue(":descricao", $descricao);
        $sql->bindValue(":valor", $valor);
        $sql->bindValue(":estado", $estado);
        $sql->bindValue(":id", $id);
        $sql->execute();

        if(count($fotos) > 0) {
           for($q=0;$q<count($fotos['tmp_name']);$q++){
             $tipo = $fotos['type'][$q];
             //salva as imagens no caminho especificado no formato jpg
             if(in_array($tipo, array('image/jpeg', 'image/png'))) {
                 //formata a imagem em jpg
                $tmpname = md5(time().rand(0,9999).'.jpg');
                //salva a imagem 
                move_uploaded_file($fotos['tmp_name'][$q], 'assets/imagens/anuncios/'.$tmpname);
                //definindo padrão da largura e altura da imagem
                list($width_orig, $height_orig) = getimagesize('assets/imagens/anuncios/'.$tmpname);
                //divide a altura pela largura
                $ratio = $width_orig/$height_orig;

                $width = 500;
                $height = 500;

                if($width/$height > $ratio) {
                    $width = $height*$ratio;
                } else {
                    $height = $width/$ratio;
                }

                $img = imagecreatetruecolor($width, $height);
                if($tipo == 'image/jpeg') {
                    $origi = imagecreatefromjpeg('assets/imagens/anuncios/'.$tmpname);
                } elseif($tipo == 'image/png'){
                    $origi = imagecreatefrompng('assets/imagens/anuncios/'.$tmpname);
                }

                imagecopyresampled($img, $origi, 0, 0, 0, 0, $width, $height, $width_orig, $height_orig);

                //salva a imagem no servidor
                imagejpeg($img, 'assets/imagens/anuncios/'.$tmpname, 80);

                //salva imagem no banco de dados
                $sql = $pdo->prepare("INSERT INTO tb_anuncios_imagens SET id_anuncio= :id_anuncio, url = :url");
                $sql->bindValue(":id_anuncio", $id);
                $sql->bindValue(":url", $tmpname);
                $sql->execute();
             }
           }
          }
        }

    public function excluirAnuncio($id) {
        global $pdo;

        $sql = $pdo->prepare("DELETE FROM tb_anuncios_imagens WHERE id_anuncio = :id_anuncio");
        $sql->bindValue(":id_anuncio", $id);
        $sql->execute();

        $sql = $pdo->prepare("DELETE FROM tb_anuncios WHERE id = :id");
        $sql->bindValue(":id", $id);
        $sql->execute();

    }

    public function excluirFoto($id) {
        global $pdo;
        $id_anuncio = 0;

        $sql = $pdo->prepare("SELECT id_anuncio FROM tb_anuncios_imagens WHERE id = :id");
        $sql->bindValue(":id", $id);
        $sql->execute();

        if($sql->rowCount() > 0) {
            $row = $sql->fetch();
            $id_anuncio = $row['id_anuncio'];
        }

        $sql = $pdo->prepare("DELETE FROM tb_anuncios_imagens WHERE id = :id");
        $sql->bindValue(":id", $id);
        $sql->execute();

        return $id_anuncio;
    }
}

?>