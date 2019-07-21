<?php 
class Categorias {
    public function getLista() {
        $array = array();
        global $pdo;

        $sql = $pdo->query("SELECT * FROM tb_categorias");
        if($sql->rowCount() > 0) {
            $array = $sql->fetchAll();
        }
        return $array;
    }
}
?>