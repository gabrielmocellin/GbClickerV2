<?php

namespace GbClicker\DAO;

class UserDAO extends Dao implements IDAO
{
    public function insert($model)
    {
        $sqlUser = "INSERT INTO usuario (email, password, nickname, clickValue, money, multiplier, minions, image_src) 
        VALUES (:email, :password, :nickname, :clickValue, :money, :multiplier, :minions, :image_src)";
        $sqlLevel = "INSERT INTO nivel (FK_user_email, level, xp_points, max_to_up) VALUES (:FK_user_email, 1, 0, 10)";

        $sqlUsuarioPreparado = $this->prepararSqlUser($sqlUser, $model);
        $sqlLevelPreparado = $this->prepararSqlLevel($sqlLevel, $model);
        
        if ($sqlUsuarioPreparado->execute() && $sqlLevelPreparado->execute()) {
            return true;
        }
        return false;
    }

    public function update($model)
    {
        $sql = "UPDATE usuario SET clickValue=:clickValue, money=:money, multiplier=:multiplier, minions=:minions 
        WHERE email = :email";
        $sqlPreparado = $this->conexao->prepare($sql);

        $sqlPreparado->bindParam(':email', $model->getEmail(), \PDO::PARAM_STR);
        $sqlPreparado->bindParam(':clickValue', $model->getClickValue(), \PDO::PARAM_STR);
        $sqlPreparado->bindParam(':money', $model->getMoney(), \PDO::PARAM_INT);
        $sqlPreparado->bindParam(':multiplier', $model->getMultiplier(), \PDO::PARAM_INT);
        $sqlPreparado->bindParam(':minions', $model->getMinions(), \PDO::PARAM_INT);
        
        $sqlPreparado->execute();
    }

    public function select()
    {
        $sql = "SELECT * FROM usuario";
        $sqlPreparado = $this->conexao->query($sql);
        return $sqlPreparado->fetchAll(\PDO::FETCH_ASSOC);
    }

    public function selectByEmailAndPassword(string $email, string $password)
    {
        $sql = "SELECT * FROM usuario JOIN nivel 
        WHERE usuario.email = nivel.FK_user_email and usuario.email = '$email' and password = '$password'";
        $sqlPreparado = $this->conexao->query($sql);
        return $sqlPreparado->fetchAll(\PDO::FETCH_ASSOC);
    }

    public function selectByEmail(string $email)
    {
        $sql = "SELECT * FROM usuario JOIN nivel 
        WHERE usuario.email = nivel.FK_user_email and usuario.email = '$email'";
        $sqlPreparado = $this->conexao->query($sql);
        return $sqlPreparado->fetchAll(\PDO::FETCH_ASSOC);
    }

    public function delete($identifier)
    {
        $sql = "DELETE FROM usuario WHERE email = :email";
        $sqlPreparado = $this->conexao->prepare($sql);
        $sqlPreparado->bindParam(':email', $identifier, \PDO::PARAM_STR);
        $sqlPreparado->execute();
    }

    public function prepararSqlUser($sql, $model)
    {
        $sqlUsuarioPreparado = $this->conexao->prepare($sql);

        $sqlUsuarioPreparado->bindParam(':email', $model->getEmail(), \PDO::PARAM_STR);
        $sqlUsuarioPreparado->bindParam(':password', $model->getPassword(), \PDO::PARAM_STR);
        $sqlUsuarioPreparado->bindParam(':nickname', $model->getNickname(), \PDO::PARAM_STR);
        $sqlUsuarioPreparado->bindParam(':clickValue', $model->getClickValue(), \PDO::PARAM_STR);
        $sqlUsuarioPreparado->bindParam(':money', $model->getMoney(), \PDO::PARAM_INT);
        $sqlUsuarioPreparado->bindParam(':multiplier', $model->getMultiplier(), \PDO::PARAM_INT);
        $sqlUsuarioPreparado->bindParam(':minions', $model->getMinions(), \PDO::PARAM_INT);
        $sqlUsuarioPreparado->bindParam(':image_src', $model->getImageSrc(), \PDO::PARAM_STR);

        return $sqlUsuarioPreparado;
    }

    public function prepararSqlLevel($sql, $model)
    {
        $sqlLevelPreparado = $this->conexao->prepare($sql);

        $sqlLevelPreparado->bindParam(':FK_user_email', $model->getEmail(), \PDO::PARAM_STR);

        return $sqlLevelPreparado;
    }
}
