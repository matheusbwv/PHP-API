<?php
require_once 'Conexao.php';
require_once 'Fruit.php';


class FruitDAO {
    public function create (Fruit $fruit) {
        $sql = 'INSERT INTO fruit (nome, quantidade) VALUES (?,?)';
        $stmt = Conexao::getConn()->prepare($sql);
        $stmt->bindValue(1, $fruit->getNome());
        $stmt->bindValue(2, $fruit->getQuantidade());

        $stmt->execute();
    }

    public function read(){
        $sql = 'SELECT * FROM fruit';

        $stmt = Conexao::getConn()->prepare($sql);
        $stmt->execute();

        if($stmt->rowCount() > 0){
            $resultado = $stmt->fetchAll(\PDO::FETCH_ASSOC);
            return $resultado;
        }else{
            return [];
        }
    }

    public function update(Fruit $fruit) {
        $sql = 'UPDATE fruit SET nome = ?, quantidade = ? WHERE id = ?';
        $stmt = Conexao::getConn()->prepare($sql);
        $stmt->bindValue(1, $fruit->getNome());
        $stmt->bindValue(2, $fruit->getQuantidade());
        $stmt->bindValue(3, $fruit->getId());

        $stmt->execute();
    }

    public function delete($id) {
        $sql = 'DELETE FROM fruit WHERE id = ?';
        $stmt = Conexao::getConn()->prepare($sql);
        $stmt->bindValue(1, $id);

        $stmt->execute();
    }
}
