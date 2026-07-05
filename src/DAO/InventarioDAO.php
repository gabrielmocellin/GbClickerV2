<?php

namespace GbClicker\DAO;

use GbClicker\Model\InventarioModel;

class InventarioDAO extends Dao implements IDAO
{
    public function insert($model)
    {
        // ON DUPLICATE KEY UPDATE para garantir que, se o usuário já tiver o item, apenas somaremos a quantidade
        $sql = "INSERT INTO inventario (FK_user_email, FK_item_id, quantidade) 
                VALUES (:email, :item_id, :quantidade)
                ON DUPLICATE KEY UPDATE quantidade = quantidade + VALUES(quantidade)";
        
        $stmt = $this->conexao->prepare($sql);
        $stmt->bindValue(':email', $model->getEmailUsuario(), \PDO::PARAM_STR);
        $stmt->bindValue(':item_id', $model->getIdItem(), \PDO::PARAM_INT);
        $stmt->bindValue(':quantidade', $model->getQuantidade(), \PDO::PARAM_INT);
        
        if ($stmt->execute()) {
            return true;
        }
        return false;
    }

    public function select()
    {
        // Not implemented for all
        return false;
    }

    public function selectByUserEmail(string $email)
    {
        $sql = "SELECT inv.*, it.nome AS itemNome, it.efeito_valor AS efeitoValor, ti.efeito 
                FROM inventario inv
                INNER JOIN itens it ON inv.FK_item_id = it.id
                INNER JOIN tipos_itens ti ON it.FK_id_tipos_itens = ti.id
                WHERE inv.FK_user_email = :email";
                
        $stmt = $this->conexao->prepare($sql);
        $stmt->bindValue(':email', $email, \PDO::PARAM_STR);
        $stmt->execute();
        
        $resultados = $stmt->fetchAll(\PDO::FETCH_ASSOC);
        $inventario = [];
        
        foreach ($resultados as $row) {
            $model = new InventarioModel();
            $model->setId($row['id']);
            $model->setEmailUsuario($row['FK_user_email']);
            $model->setIdItem($row['FK_item_id']);
            $model->setQuantidade($row['quantidade']);
            $model->setItemNome($row['itemNome']);
            $model->setEfeitoValor($row['efeitoValor']);
            $model->setEfeito($row['efeito']);
            $inventario[] = $model;
        }
        
        return $inventario;
    }

    public function update($model)
    {
        $sql = "UPDATE inventario SET quantidade = :quantidade WHERE id = :id";
        $stmt = $this->conexao->prepare($sql);
        $stmt->bindValue(':quantidade', $model->getQuantidade(), \PDO::PARAM_INT);
        $stmt->bindValue(':id', $model->getId(), \PDO::PARAM_INT);
        
        return $stmt->execute();
    }

    public function delete($identifier)
    {
        $sql = "DELETE FROM inventario WHERE id = :id";
        $stmt = $this->conexao->prepare($sql);
        $stmt->bindValue(':id', $identifier, \PDO::PARAM_INT);
        return $stmt->execute();
    }
}
