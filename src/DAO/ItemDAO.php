<?php

namespace GbClicker\DAO;

class ItemDAO extends Dao implements IDAO
{
    public function insert($model)
    {
        $sql = "INSERT INTO itens (nome, descricao, preco, minimum_level, efeito_valor, image_src, FK_id_tipos_itens)
        VALUES (:nome, :descricao, :preco, :minimum_level, :efeito_valor, :image_src, :tipo)";
        $stmt = $this->conexao->prepare($sql);

        $stmt->bindParam(":nome", $model->getNome(), \PDO::PARAM_STR);
        $stmt->bindParam(":descricao", $model->getDescricao(), \PDO::PARAM_STR);
        $stmt->bindParam(":preco", $model->getPreco(), \PDO::PARAM_INT);
        $stmt->bindParam(":minimum_level", $model->getMinimumLevel(), \PDO::PARAM_INT);
        $stmt->bindParam(":efeito_valor", $model->getEfeitoValor(), \PDO::PARAM_INT);
        $stmt->bindParam(":image_src", $model->getImageSrc(), \PDO::PARAM_STR);
        $stmt->bindParam(":tipo", $model->getTipo(), \PDO::PARAM_STR);


        if ($stmt->execute()) {
            return true;
        }
        return false;
    }

    public function selectById($id)
    {
        $sql = 'SELECT * FROM itens WHERE id = :id';
        $stmt = $this->conexao->prepare($sql);
        $stmt->bindValue(':id', $id, \PDO::PARAM_INT);
        $stmt->execute();

        return $stmt->fetch(\PDO::FETCH_ASSOC);
    }

    public function select()
    {
        $sql = "SELECT itens.*, tipos_itens.efeito FROM itens JOIN tipos_itens ON tipos_itens.id = itens.FK_id_tipos_itens";
        $sql_result = $this->conexao->query($sql);
        $sql_result = $sql_result->fetchAll(\PDO::FETCH_ASSOC);
        return $sql_result;
    }

    public function selectAllItemTypes()
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
