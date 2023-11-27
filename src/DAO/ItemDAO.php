<?php

namespace GbClicker\DAO;

class ItemDAO extends Dao implements IDAO
{
    public function insert($model)
    {
        $sql = "INSERT INTO itens (nome, descricao, preco, minimum_level, quantidade, image_src, tipo) 
        VALUES (?, ?, ?, ?, ?, ?, ?)";
        $stmt = $this->conexao->prepare($sql);
        $stmt->bind_param(
            'ssiiiss',
            $model->getNome(),
            $model->getDescricao(),
            $model->getPreco(),
            $model->getMinimumLevel(),
            $model->getQuantidade(),
            $model->getImageSrc(),
            $model->getTipo()
        );

        if ($stmt->execute()) {
            return true;
        }
        return false;
    }

    public function select()
    {
        $sql = "SELECT * FROM itens";
        $sql_result = $this->conexao->query($sql);
        $results_array = array();
        if ($sql_result->num_rows > 0) {
            while ($row = $sql_result->fetch_assoc()) {
                $results_array[] = $row;
            }
        }
        return $results_array;
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
