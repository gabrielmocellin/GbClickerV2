<?php

namespace GbClicker\DAO;

class LevelDAO extends Dao implements IDAO
{
    public function insert($model)
    {
        return false;
    }

    public function select()
    {
        return false;
    }

    public function update($model)
    {
        return false;
    }

    public function delete($identifier)
    {
        return false;
    }

    public function selectByEmail($FK_user_email)
    {
        $sql = 'SELECT level, xp_points, max_to_up FROM nivel
            WHERE FK_user_email = :email';
        $stmt = $this->conexao->prepare($sql);
        $stmt->bindValue(':email', $FK_user_email, \PDO::PARAM_STR);
        $stmt->execute();

        return $stmt->fetch(\PDO::FETCH_ASSOC);
    }
}
