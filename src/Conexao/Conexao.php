<?php

namespace GbClicker\Conexao;

class Conexao
{
    public static function criarConexao()
    {
        $dsn = "mysql:host=localhost;dbname=gbclicker_db_mvc";
        $user = "x";
        $pass = "x";
        return new \PDO($dsn, $user, $pass);
    }
}
