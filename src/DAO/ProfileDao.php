<?php

namespace GbClicker\DAO;

class ProfileDAO extends Dao
{
    public function selectByIdentifier($identifier)
    {
        $sql = "SELECT nickname, clickValue, money, multiplier, minions, image_src, nivel.level,
        (SELECT COUNT(*) FROM usuario WHERE money > (SELECT money FROM usuario WHERE id = :idFirst)) AS rank_atual
        FROM usuario JOIN nivel where usuario.id = :idSecond AND usuario.email = nivel.FK_user_email";

        
        $sqlPreparado = $this->conexao->prepare($sql);
        $sqlPreparado->bindValue(':idFirst', $identifier, \PDO::PARAM_INT);
        $sqlPreparado->bindValue(':idSecond', $identifier, \PDO::PARAM_INT);

        if ($sqlPreparado->execute()) {
            return $sqlPreparado->fetch(\PDO::FETCH_ASSOC);
        }
        
        return false;
    }

    public function selectIdFromRankedPlayers()
    {
        $sql = "SELECT id FROM usuario ORDER BY money DESC LIMIT 10;";
        $sql_result = $this->conexao->query($sql);
        return $sql_result->fetchAll(\PDO::FETCH_ASSOC);
    }
}
