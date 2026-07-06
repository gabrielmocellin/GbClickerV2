<?php

namespace GbClicker\DAO;

class UserDAO extends Dao implements IDAO
{
    public function register($registerModel) {
        $userSQLPrepared = $this->prepareUserSQL($registerModel);
        $levelSQLPrepared = $this->prepareLevelSQL($registerModel);

        if($this->conexao->beginTransaction()) {

            if ($userSQLPrepared->execute() && $levelSQLPrepared->execute()) {
                $this->conexao->commit();
                return true;
            }

            $this->conexao->rollBack();
        }

        return false;
    }

    public function insert($model)
    {
        $sqlUser = "INSERT INTO usuario (
                email, password, nickname, money, image_src, FK_id_tipos_contas
            ) VALUES (
                :email, :password, :nickname, :money, :image_src, :FK_id_tipos_contas
            )";

        $sqlLevel = "INSERT INTO nivel (
                FK_user_email, level, xp_points, max_to_up
            ) VALUES (
                :FK_user_email, 1, 0, 10
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
        $sql = "UPDATE usuario SET money=:money WHERE email = :email";
        $sqlPreparado = $this->conexao->prepare($sql);

        $sqlPreparado->bindValue(':email', $model->getEmail(), \PDO::PARAM_STR);
        $sqlPreparado->bindValue(':money', $model->getMoney(), \PDO::PARAM_INT);

        return $sqlPreparado->execute();
    }
    
    public function updateMoneyAndLevel($email, $money, $levelData)
    {
        $sql = 'UPDATE usuario, nivel
            SET usuario.money = :money,
                nivel.level = :level,
                nivel.xp_points = :xp_points,
                nivel.max_to_up = :max_to_up
            WHERE usuario.email = nivel.FK_user_email
              AND usuario.email = :email';
        $stmt = $this->conexao->prepare($sql);
        $stmt->bindValue(':money', $money, \PDO::PARAM_INT);
        $stmt->bindValue(':level', $levelData->getLevel(), \PDO::PARAM_INT);
        $stmt->bindValue(':xp_points', $levelData->getXpPoints(), \PDO::PARAM_INT);
        $stmt->bindValue(':max_to_up', $levelData->getMaxToUp(), \PDO::PARAM_INT);
        $stmt->bindValue(':email', $email, \PDO::PARAM_STR);

        return $stmt->execute();
    }
    
    public function addMoney($email, $amount)
    {
        $sql = 'UPDATE usuario
            SET usuario.money = usuario.money + :amount
            WHERE usuario.email = :email';
        $stmt = $this->conexao->prepare($sql);
        $stmt->bindValue(':amount', $amount, \PDO::PARAM_INT);
        $stmt->bindValue(':email', $email, \PDO::PARAM_STR);

        return $stmt->execute();
    }

    public function select()
    {
        $sql = "SELECT * FROM usuario";
        $sqlPreparado = $this->conexao->query($sql);
        return $sqlPreparado->fetch(\PDO::FETCH_ASSOC);
    }

    public function selectTenPerPage(int $offset, int $limit, string $search = '')
    {
        $searchSql = '';
        if (!empty($search)) {
            $searchSql = ' AND (usuario.email LIKE :search OR usuario.nickname LIKE :search) ';
        }

        // Removidos clickValue, multiplier, minions da listagem simples
        $sql = 'SELECT usuario.id, usuario.email, usuario.nickname, usuario.image_src,
        usuario.money, nivel.level, tipos_contas.nome
        FROM usuario
        INNER JOIN nivel ON usuario.email = nivel.FK_user_email
        INNER JOIN tipos_contas ON usuario.FK_id_tipos_contas = tipos_contas.id
        WHERE (tipos_contas.id = 1 OR tipos_contas.id = 2) ' . $searchSql . '
        ORDER BY usuario.money DESC
        LIMIT :offset, :limit';
        
        $stmt = $this->conexao->prepare($sql);
        $stmt->bindValue(':offset', $offset, \PDO::PARAM_INT);
        $stmt->bindValue(':limit', $limit, \PDO::PARAM_INT);
        if (!empty($search)) {
            $stmt->bindValue(':search', '%' . $search . '%', \PDO::PARAM_STR);
        }
        $stmt->execute();

        return $stmt->fetchAll(\PDO::FETCH_ASSOC);
    }

    public function countTotalAccounts(string $search = ''): int
    {
        $searchSql = '';
        if (!empty($search)) {
            $searchSql = ' AND (usuario.email LIKE :search OR usuario.nickname LIKE :search) ';
        }

        $sql = 'SELECT COUNT(usuario.id) as total
        FROM usuario
        INNER JOIN tipos_contas ON usuario.FK_id_tipos_contas = tipos_contas.id
        WHERE (tipos_contas.id = 1 OR tipos_contas.id = 2) ' . $searchSql;

        $stmt = $this->conexao->prepare($sql);
        if (!empty($search)) {
            $stmt->bindValue(':search', '%' . $search . '%', \PDO::PARAM_STR);
        }
        $stmt->execute();

        $result = $stmt->fetch(\PDO::FETCH_ASSOC);
        return (int) $result['total'];
    }

    public function selectByEmail(string $email)
    {
        $sql = 'SELECT usuario.*, nivel.*, tipos_contas.nome AS tipo_conta
            FROM usuario
            INNER JOIN nivel ON usuario.email = nivel.FK_user_email
            INNER JOIN tipos_contas ON usuario.FK_id_tipos_contas = tipos_contas.id
            WHERE usuario.email = :email';
        $stmt = $this->conexao->prepare($sql);
        $stmt->bindValue(':email', $email, \PDO::PARAM_STR);
        $stmt->execute();

        return $stmt->fetch(\PDO::FETCH_ASSOC);
    }

    public function delete($identifier)
    {
        $sql = "DELETE FROM usuario WHERE email = :email";
        $sqlPreparado = $this->conexao->prepare($sql);
        $sqlPreparado->bindValue(':email', $identifier, \PDO::PARAM_STR);
        $sqlPreparado->execute();
    }

    public function prepareUserSQL($registerModel)
    {
        $userSQL = "INSERT INTO usuario (email,
            password,
            nickname,
            money,
            image_src,
            FK_id_tipos_contas)
        VALUES (:email,
            :password,
            :nickname,
            :money,
            :image_src,
            :FK_id_tipos_contas
        )";
        
        $userSQLPrepared = $this->conexao->prepare($userSQL);
        $encryptedPassword = $this->encryptPassword($registerModel->getUserCredentials()->getPassword());

        $userSQLPrepared->bindValue(":email", $registerModel->getUserCredentials()->getEmail(), \PDO::PARAM_STR);
        $userSQLPrepared->bindValue(":password", $encryptedPassword, \PDO::PARAM_STR);
        $userSQLPrepared->bindValue(":money", $registerModel->getUpgradesInfo()->getMoney(), \PDO::PARAM_INT);
        $userSQLPrepared->bindValue(":nickname", $registerModel->getNickname(), \PDO::PARAM_STR);
        $userSQLPrepared->bindValue(":image_src", $registerModel->getImageSrc(), \PDO::PARAM_STR);
        $userSQLPrepared->bindValue(":FK_id_tipos_contas", $registerModel->getTipoConta(), \PDO::PARAM_INT);

        return $userSQLPrepared;

    }

    public function prepareLevelSQL($registerModel)
    {
        $levelSQL = "INSERT INTO nivel (
            FK_user_email, level, xp_points, max_to_up
        ) VALUES (
            :FK_user_email, :level, :xp_points, :max_to_up
        )";

        $levelSQLPrepared = $this->conexao->prepare($levelSQL);

        $levelSQLPrepared->bindValue(":FK_user_email", $registerModel->getUserCredentials()->getEmail(), \PDO::PARAM_STR);
        $levelSQLPrepared->bindValue(":level", $registerModel->getUpgradesInfo()->getLevelData()->getLevel(), \PDO::PARAM_INT);
        $levelSQLPrepared->bindValue(":xp_points", $registerModel->getUpgradesInfo()->getLevelData()->getXpPoints(), \PDO::PARAM_INT);
        $levelSQLPrepared->bindValue(":max_to_up", $registerModel->getUpgradesInfo()->getLevelData()->getMaxToUp(), \PDO::PARAM_INT);
        
        return $levelSQLPrepared;
    }

    public function prepararSqlUser($sql, $model)
    {
        $sqlUsuarioPreparado = $this->conexao->prepare($sql);

        $senha = $this->criptografarSenha($model);

        $sqlUsuarioPreparado->bindValue(':email', $model->getEmail(), \PDO::PARAM_STR);
        $sqlUsuarioPreparado->bindValue(':password', $model->getPassword(), \PDO::PARAM_STR);
        $sqlUsuarioPreparado->bindValue(':nickname', $model->getNickname(), \PDO::PARAM_STR);
        $sqlUsuarioPreparado->bindValue(':money', $model->getMoney(), \PDO::PARAM_INT);
        $sqlUsuarioPreparado->bindValue(':image_src', $model->getImageSrc(), \PDO::PARAM_STR);
        $sqlUsuarioPreparado->bindValue(':FK_id_tipos_contas', $model->getTipoConta() ?? 1, \PDO::PARAM_INT);

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

    public function encryptPassword($password)
    {
        $encryptedPassword = password_hash($password, PASSWORD_ARGON2ID);
        return $encryptedPassword;
    }

    public function updateMoney(string $email, int $precoTotal): bool
    {
        $sql = "UPDATE usuario
            SET money = money - :precoTotal
            WHERE email = :email
              AND money >= :precoTotal";

        $stmt = $this->conexao->prepare($sql);
        $stmt->bindValue(':precoTotal', $precoTotal, \PDO::PARAM_INT);
        $stmt->bindValue(':email', $email, \PDO::PARAM_STR);
        $stmt->execute();

        return $stmt->rowCount() > 0;
    }
}

