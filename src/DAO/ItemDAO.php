<?php

namespace GbClicker\DAO;

class ItemDAO extends Dao implements IDAO
{
    public function insert($model)
    {
        $sql = "INSERT INTO itens (nome, descricao, preco, minimum_level, quantidade, image_src, FK_id_tipos_itens)
        VALUES (:nome, :descricao, :preco, :minimum_level, :quantidade, :image_src, :tipo)";
        $stmt = $this->conexao->prepare($sql);

        $stmt->bindParam(":nome", $model->getNome(), \PDO::PARAM_STR);
        $stmt->bindParam(":descricao", $model->getDescricao(), \PDO::PARAM_STR);
        $stmt->bindParam(":preco", $model->getPreco(), \PDO::PARAM_INT);
        $stmt->bindParam(":minimum_level", $model->getMinimumLevel(), \PDO::PARAM_INT);
        $stmt->bindParam(":quantidade", $model->getQuantidade(), \PDO::PARAM_INT);
        $stmt->bindParam(":image_src", $model->getImageSrc(), \PDO::PARAM_STR);
        $stmt->bindParam(":tipo", $model->getTipo(), \PDO::PARAM_STR);


        if ($stmt->execute()) {
            return true;
        }
        return false;
    }

    public function selectById($id)
    {
        $sql = "SELECT preco, minimum_level, quantidade FROM itens WHERE id = $id;";
        $sql_result = $this->conexao->query($sql);
        $sql_result = $sql_result->fetch(\PDO::FETCH_ASSOC);
        return $sql_result;
    }

    public function select()
    {
        $sql = "SELECT itens.*, tipos_itens.classificacao FROM itens JOIN tipos_itens WHERE tipos_itens.id = itens.FK_id_tipos_itens";
        $sql_result = $this->conexao->query($sql);
        $sql_result = $sql_result->fetchAll(\PDO::FETCH_ASSOC);
        return $sql_result;
    }

    public function selectTipos()
    {
        $sql = "SELECT * FROM tipos_itens";
        $sql_result = $this->conexao->query($sql);
        $sql_result = $sql_result->fetchAll(\PDO::FETCH_ASSOC);
        return $sql_result;

    }

    public function update($model)
    {
        return false;
    }

    public function delete($identifier)
    {
        return false;
    }
}
