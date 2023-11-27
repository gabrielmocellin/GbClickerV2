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
        $sql = "SELECT level, xp_points, max_to_up FROM nivel 
        WHERE FK_user_email = '$FK_user_email'";
        $query_result = $this->conexao->query($sql);
        return $query_result->fetch_assoc();
    }
}
