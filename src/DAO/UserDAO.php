<?php

namespace GbClicker\DAO;

class UserDAO extends Dao implements IDAO
{
    public function insert($model)
    {
        $sqlUser = "INSERT INTO usuario (
                email,
                password,
                nickname,
                clickValue,
                money,
                multiplier,
                minions,
                image_src,
                FK_id_tipos_contas
            ) VALUES (
                :email,
                :password,
                :nickname,
                :clickValue,
                :money,
                :multiplier,
                :minions,
                :image_src,
                1
            )";

        $sqlLevel = "INSERT INTO nivel (
                FK_user_email,
                level,
                xp_points,
                max_to_up
            ) VALUES (
                    :FK_user_email,
                    1,
                    0,
                    10
                )";

        $transacao = $this->conexao->beginTransaction();
        $sqlUsuarioPreparado = $this->prepararSqlUser($sqlUser, $model);
        $sqlLevelPreparado = $this->prepararSqlLevel($sqlLevel, $model);

        if ($sqlUsuarioPreparado->execute() && $sqlLevelPreparado->execute()) {
            $this->conexao->commit();
            return true;
        }

        $this->conexao->rollBack();
        return false;
    }

    public function update($model)
    {
        $sql = "UPDATE usuario SET clickValue=:clickValue, money=:money, multiplier=:multiplier, minions=:minions 
        WHERE email = :email";
        $sqlPreparado = $this->conexao->prepare($sql);

        $sqlPreparado->bindValue(':email', $model->getEmail(), \PDO::PARAM_STR);
        $sqlPreparado->bindValue(':clickValue', $model->getClickValue(), \PDO::PARAM_STR);
        $sqlPreparado->bindValue(':money', $model->getMoney(), \PDO::PARAM_INT);
        $sqlPreparado->bindValue(':multiplier', $model->getMultiplier(), \PDO::PARAM_INT);
        $sqlPreparado->bindValue(':minions', $model->getMinions(), \PDO::PARAM_INT);

        $sqlPreparado->execute();
    }

    public function select()
    {
        $sql = "SELECT * FROM usuario";
        $sqlPreparado = $this->conexao->query($sql);
        return $sqlPreparado->fetch(\PDO::FETCH_ASSOC);
    }

    public function selectTenPerPage(int $inicio, int $fim)
    {
        $sql = "SELECT usuario.id, usuario.email, usuario.nickname, usuario.image_src, usuario.clickValue,
        usuario.money, usuario.multiplier, usuario.minions, nivel.level, tipos_contas.nome
        FROM usuario
        JOIN nivel
        JOIN tipos_contas
        WHERE usuario.email = nivel.FK_user_email
        AND usuario.FK_id_tipos_contas = tipos_contas.id
        AND tipos_contas.id = 1
        ORDER BY money DESC LIMIT $inicio, $fim;
        ";
        $sqlPreparado = $this->conexao->query($sql);
        return $sqlPreparado->fetchAll(\PDO::FETCH_ASSOC);
    }

    public function selectByEmail(string $email)
    {
        /*$sql = "SELECT * FROM usuario JOIN nivel 
        WHERE usuario.email = nivel.FK_user_email and usuario.email = '$email'";*/
        $sql = "SELECT usuario.*, nivel.*, tipos_contas.nome AS tipo_conta FROM usuario JOIN nivel JOIN tipos_contas
        WHERE usuario.email = nivel.FK_user_email AND usuario.FK_id_tipos_contas = tipos_contas.id AND usuario.email =  '$email';";
        $sqlPreparado = $this->conexao->query($sql);
        return $sqlPreparado->fetch(\PDO::FETCH_ASSOC);
    }

    public function delete($identifier)
    {
        $sql = "DELETE FROM usuario WHERE email = :email";
        $sqlPreparado = $this->conexao->prepare($sql);
        $sqlPreparado->bindValue(':email', $identifier, \PDO::PARAM_STR);
        $sqlPreparado->execute();
    }

    public function prepararSqlUser($sql, $model)
    {
        $sqlUsuarioPreparado = $this->conexao->prepare($sql);

        $senha = $this->criptografarSenha($model);

        $sqlUsuarioPreparado->bindValue(':email', $model->getEmail(), \PDO::PARAM_STR);
        $sqlUsuarioPreparado->bindValue(':password', $model->getPassword(), \PDO::PARAM_STR);
        $sqlUsuarioPreparado->bindValue(':nickname', $model->getNickname(), \PDO::PARAM_STR);
        $sqlUsuarioPreparado->bindValue(':clickValue', $model->getClickValue(), \PDO::PARAM_STR);
        $sqlUsuarioPreparado->bindValue(':money', $model->getMoney(), \PDO::PARAM_INT);
        $sqlUsuarioPreparado->bindValue(':multiplier', $model->getMultiplier(), \PDO::PARAM_INT);
        $sqlUsuarioPreparado->bindValue(':minions', $model->getMinions(), \PDO::PARAM_INT);
        $sqlUsuarioPreparado->bindValue(':image_src', $model->getImageSrc(), \PDO::PARAM_STR);

        return $sqlUsuarioPreparado;
    }

    public function prepararSqlLevel($sql, $model)
    {
        $sqlLevelPreparado = $this->conexao->prepare($sql);

        $sqlLevelPreparado->bindValue(':FK_user_email', $model->getEmail(), \PDO::PARAM_STR);

        return $sqlLevelPreparado;
    }

    public function criptografarSenha($model)
    {
        $senha = $model->getPassword();
        $senhaCriptografada = password_hash($senha, PASSWORD_ARGON2ID);
        $model->setPassword($senhaCriptografada);
        return $senhaCriptografada;
    }
}
