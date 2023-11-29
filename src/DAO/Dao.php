<?php

namespace GbClicker\DAO;

use GbClicker\Conexao\Conexao;

class Dao
{
    protected $conexao;

    public function __construct()
    {
        $this->conexao = Conexao::criarConexao();
    }
}
