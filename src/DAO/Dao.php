<?php

namespace GbClicker\DAO;

class Dao
{
    protected $conexao;

    public function __construct(\PDO $pdo)
    {
        $this->conexao = $pdo;
    }
}
