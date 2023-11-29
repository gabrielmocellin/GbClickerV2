<?php

namespace GbClicker\Conexao;

class Conexao
{
    public static function criarConexao()
    {
        $dsn = "mysql:host=localhost;dbname=gbclicker_db_mvc";
        $user = "gb";
        $pass = "mysql@204";
        return new \PDO($dsn, $user, $pass);
    }
}
